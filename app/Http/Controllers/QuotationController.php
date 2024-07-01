<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customerprice;
use App\Models\Machine;
use App\Models\Spare;
use App\Models\Client;
use App\Models\Quotation;
use App\Models\Quotationlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationController extends Controller
{
    public function index()
    {
        $customers = Client::select('id', 'company_name')->orderBy('company_name')->get();
        return view('quotation.quotationlist', compact('customers'));
    }

    public function data(Request $request)
    {
        $query = Quotation::select(['quotations.id', 'clients.company_name', 'quotations.title', 'quotations.date', 'quotations.description', 'quotations.grand_total'])
                          ->join('clients', 'quotations.customer_id', '=', 'clients.id')
                          ->orderBy('quotations.date', 'desc');
        
        if ($request->has('customer_id') && $request->customer_id != '') {
            $query->where('quotations.customer_id', $request->customer_id);
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('quotations.date', $request->date);
        }

        $quotation = $query->get();
        return DataTables::of($quotation)
            ->addColumn('action', function ($quotation) {
                return '<div class="dropdown">
                            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="'.url('/quotation/'.$quotation->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                                <a class="dropdown-item deleteBtn" data-url="'.url('/quotation/'.$quotation->id).'"><i class="fa fa-trash"></i> Delete</a>
                                <a class="dropdown-item" href="'.url('/quotation/'.$quotation->id.'/view').'"><i class="fa fa-eye"></i> Preview/Download</a>
                            </div>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function get_customerlist_details(Request $request)
    {
        $client = Client::select('owner_name', 'company_gst_no')->find($request->customer_id);
        if ($client) {
            return $client;
        }
        return response()->json([], 404);
    }

    public function getCustomerprice(Request $request)
    {
        $customerPrice = Customerprice::where('customer_id', $request->customer_id)
            ->where('part_id', $request->part_id)
            ->first();

        $buyingprice = Spare::select('buying_price')->find($request->part_id);
        $unit = Spare::select('unit')->find($request->part_id);


        if (!$customerPrice) {
            $customerPrice = Spare::select('selling_price as price')->find($request->part_id);
        }

        if (!$customerPrice && !$buyingprice && !$unit) {
            return response()->json(['error' => 'No data found for the given customer and part ID'], 404);
        }

        $response = [
            'price' => $customerPrice ? $customerPrice->price : null,
            'discount' => $customerPrice ? $customerPrice->discount : null,
            'discount_percent' => $customerPrice ? $customerPrice->discount_percent : null,
            'currency' => $customerPrice ? $customerPrice->currency : null,
            'buying_price' => $buyingprice ? $buyingprice->buying_price : null,
            'unit' => $unit ? $unit->unit : null
        ];
        return response()->json($response);
    }

    public function create()
    {
        $customers = Client::select('id', 'company_name')->get();
        $machines = Machine::orderBy('machine_name')->get();
        return view('quotation.quotationadd', compact('customers', 'machines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'customer_id' => 'required|exists:clients,id',
            'date' => 'required',
            'unit' => '',
            'machine_id.*' => 'required|exists:machines,id',
            'part_id.*' => 'required|exists:spares,id',
            'price.*' => '',
            'quantity.*' => '',
            'discount.*' => '',
            'discount_percent.*' => '',
        ]);

        try {
            DB::beginTransaction();
            $quotation = new Quotation();
            $quotation->title = $request->title;
            $quotation->description = $request->description;
            $quotation->date = $request->date;
            $quotation->machine_id = $request->machine_id ?? [];
            $quotation->grand_total = $request->grand_total;
            $quotation->customer_id = $request->customer_id;
            $quotation->created_by = Session::get('id');
            $quotation->updated_by = Session::get('id');
            $quotation->save();
            
            foreach ($request->part_id as $index => $partId) {
                Quotationlist::create([
                    'quotation_id' => $quotation->id,
                    'part_id' => $partId,
                    'price' => $request->price[$index],
                    'quantity' => $request->quantity[$index],
                    'discount' => $request->discount[$index],
                    'discount_percent' => $request->discount_percent[$index],
                    'unit' => $request->unit[$index],
                    'total' => $request->total[$index],
                    'created_by' => Session::get('id'),
                    'updated_by' => Session::get('id'),
                ]);
            }
            DB::commit();
            return redirect('/quotation')->with('success', 'Quotation created successfully!'); 
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while adding the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding the record');
        }
    }

    public function show($id)
    {
        $quotation = Quotation::find($id);
        $machines = Machine::orderBy('machine_name')->get();
        $customers = Client::all();
        $parts = Spare::all();  
        return view('quotation.show', compact('quotation', 'machines', 'customers', 'parts'));
    }

    public function edit($id)
    {
        $quotation = Quotation::with('quotationlists')->findOrFail($id);
        $customers = Client::all();
        $parts = Spare::where('machine_id', $quotation->machine_id)->get();
        $machine = Machine::select('id','machine_name','model_no')->where('id',$quotation->machine_id)->first();
        return view('quotation.quotationedit', compact('quotation', 'customers','parts','machine'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required',
            'customer_id' => 'required|exists:clients,id',
            'machine_id.*' => 'required|exists:machines,id',
            'part_id.*' => 'required|exists:spares,id',
            'price.*' => 'required|numeric',
            'quantity.*' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();
            $quotation = Quotation::findOrFail($id);
            $quotation->title = $request->title;
            $quotation->description = $request->description;
            $quotation->date = $request->date;
            $quotation->machine_id = $request->machine_id ?? [];
            $quotation->grand_total = $request->grand_total;
            $quotation->customer_id = $request->customer_id;
            $quotation->updated_by = Session::get('id');
            $quotation->save();
            $quotation->quotationlists()->delete();

            foreach ($request->part_id as $index => $partId) {
                Quotationlist::create([
                    'quotation_id' => $quotation->id,
                    'part_id' => $partId,
                    'price' => $request->price[$index],
                    'quantity' => $request->quantity[$index],
                    'discount' => $request->discount[$index],
                    'discount_percent' => $request->discount_percent[$index],
                    'total' => $request->total[$index],
                    'unit' => $request->unit[$index],
                    'created_by' => $quotation->created_by,
                    'updated_by' => Session::get('id'),
                ]);
            }
            DB::commit();
            return redirect('/quotation')->with('success', 'Quotation updated successfully'); 
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record');
        }
    }

    public function downloadPDF($id)
    {
        $quotation = Quotation::with('client', 'quotationlists')->findOrFail($id);
        $pdf = Pdf::loadView('quotation.quotationview', compact('quotation'));
        return $pdf->download('quotation.pdf');
    }

    public function destroy($id)
{
    try {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();
 
    } catch (\Exception $e) {
        Log::error('Error while deleting the record: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error while deleting the record');
    }
}

    public function viewQuotation($id)
    {
        $quotation = Quotation::with('client', 'quotationlists')->findOrFail($id);
        $machine = Machine::select('machine_name','model_no')->where('id',$quotation->machine_id)->first();
        return view('quotation.quotationview', compact('quotation','machine'));
    }

    
}