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
use DataTables;
use Session; 

class QuotationController extends Controller
{
    public function index()
    {
        return view('quotation.quotationlist');
    }

    public function data()
{
    $quotations = Quotation::select([
        'quotations.id',
        'clients.company_name as company_name',
        'quotations.title',
        'quotations.description',
        'quotations.total',
    ])->leftJoin('clients', 'quotations.customer_id', '=', 'clients.id');

    return DataTables::of($quotations)
        ->addColumn('action', function ($quotation) {
            return 
           ' <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.url('/quotation/'.$quotation->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.url('/quotation/'.$quotation->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            
        })
        ->rawColumns(['action'])
        ->make(true);
}

    public function get_customerlist_details(Request $request)
    {
        $client = Client::select('owner_name','company_gst_no')->find($request->customer_id);
        if ($client) {
            return $client;
        }
        return response()->json([], 404);
    }

    public function getCustomerprice(Request $request)
{
    // Find customer price
    $customerPrice = Customerprice::where('customer_id', $request->customer_id)
        ->where('part_id', $request->part_id)
        ->first();

    // Get the buying price from Spare
    $buyingprice = Spare::select('buying_price')->find($request->part_id);

    // If customer price not found, get the selling price from Spare
    if (!$customerPrice) {
        $customerPrice = Spare::select('selling_price as price')->find($request->part_id);
    }

    // If no customer price and no spare found
    if (!$customerPrice && !$buyingprice) {
        return response()->json(['error' => 'No data found for the given customer and part ID'], 404);
    }

    // Merge the customer price and buying price
    $response = [
        'price' => $customerPrice ? $customerPrice->price : null,
        'discount' => $customerPrice ? $customerPrice->discount : null,
        'discount_percent' => $customerPrice ? $customerPrice->discount_percent : null,
        'currency' => $customerPrice ? $customerPrice->currency : null,
        'buying_price' => $buyingprice ? $buyingprice->buying_price : null
    ];

    return response()->json($response);
}


    public function create()
    {
        $customers = Client::select('id','company_name')->get();
        $machines = Machine::orderBy('machine_name')->get();

        return view('quotation.quotationadd', compact('customers', 'machines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'customer_id' => 'required|exists:clients,id',
            'machine_id.*' => 'required|exists:machines,id',
            'part_id.*' => 'required|exists:spares,id',
            'price.*' => 'required|numeric',
            'quantity.*' => 'required|integer',
            'discount.*' => 'required|numeric',
            'discount_percent.*' => 'required|numeric',
            'currency.*' => 'required|string|max:255',
        ]);
    
        try {
            $quotation = new Quotation();
            $quotation->title = $request->title;
            $quotation->description = $request->description;
            $quotation->customer_id = $request->customer_id;
            $quotation->created_by = Session::get('id');
            $quotation->updated_by = Session::get('id');
            $quotation->save();
    
            foreach ($request->machine_id as $index => $machineId) {
                Quotationlist::create([
                    'quotation_id' => $quotation->id,
                    'machine_id' => $machineId,
                    'part_id' => $request->part_id[$index],
                    'price' => $request->price[$index],
                    'quantity' => $request->quantity[$index],
                    'discount' => $request->discount[$index],
                    'discount_percent' => $request->discount_percent[$index],
                    'currency' => $request->currency[$index],                 
                    'created_by' => Session::get('id'),
                    'updated_by' => Session::get('id'),
                ]);
            }
    
            return redirect()->back()->with('success', 'Quotation created successfully!');
        } catch (\Exception $e) {
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
        $machines = Machine::all();
        $parts = Spare::all();
        return view('quotation.quotationedit', compact('quotation', 'customers', 'machines', 'parts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'customer_id' => 'required|exists:clients,id',
            'machine_id.*' => 'required|exists:machines,id',
            'part_id.*' => 'required|exists:spares,id',
            'price.*' => 'required|numeric',
            'quantity.*' => 'required|integer',
            'discount.*' => 'required|numeric',
            'discount_percent.*' => 'required|numeric',
            'currency.*' => 'required|string|max:255',
        ]);

        try {
            $quotation = Quotation::findOrFail($id);
            $quotation->title = $request->title;
            $quotation->description = $request->description;
            $quotation->customer_id = $request->customer_id;
            $quotation->updated_by = Session::get('id');
            $quotation->save();

            
            $quotation->quotationlists()->delete();

          
            foreach ($request->machine_id as $index => $machineId) {
                Quotationlist::create([
                    'quotation_id' => $quotation->id,
                    'machine_id' => $machineId,
                    'part_id' => $request->part_id[$index],
                    'price' => $request->price[$index],
                    'quantity' => $request->quantity[$index],
                    'discount' => $request->discount[$index],
                    'discount_percent' => $request->discount_percent[$index],
                    'currency' => $request->currency[$index],
                    'created_by' => $quotation->created_by,
                    'updated_by' => Session::get('id'),
                ]);
            }

            return redirect()->route('quotation.index')->with('success', 'Quotation updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error while updating the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record');
        }
    }





























    public function destroy($id)
{
    try {
      
        $quotation = Quotation::findOrFail($id);

        $quotation->delete();

       
    } catch (\Exception $e) {
        \Log::error('Error while deleting the record: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error while deleting the record');
    }
}

}
