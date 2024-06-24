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
        $customerPrice = Customerprice::where('customer_id', $request->customer_id)
            ->where('part_id', $request->part_id)
            ->first();

        if (!$customerPrice) {
            $customerPrice = Spare::select('selling_price as price')
                ->find($request->part_id);
        }

        return response()->json($customerPrice);
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
        $quotation = Quotation::find($id);
        $machines = Machine::orderBy('machine_name')->get();
        $customers = Client::all();
        $parts = Spare::all();

        return view('quotation.quotationedit', compact('quotation', 'machines', 'customers', 'parts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:clients,id',
            'machine_id' => 'required|exists:machines,id',
            'part_id' => 'required|exists:spares,id',
            'price.*' => 'required|numeric',
            'quantity.*' => 'required|integer',
            'discount.*' => 'nullable|numeric',
            'discount_percent.*' => 'nullable|numeric',
            'currency.*' => 'required|string|max:255',
        ]);

        try {
            $quotation = Quotation::find($id);
            $quotation->update($request->all());

            return redirect('/quotation')->with('success', 'Quotation updated successfully!');
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
        $customerPrice = Customerprice::where('customer_id', $request->customer_id)
            ->where('part_id', $request->part_id)
            ->first();

        if (!$customerPrice) {
            $customerPrice = Spare::select('selling_price as price')
                ->find($request->part_id);
        }

        return response()->json($customerPrice);
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
        $quotation = Quotation::find($id);
        $machines = Machine::orderBy('machine_name')->get();
        $customers = Client::all();
        $parts = Spare::all();

        return view('quotation.quotationedit', compact('quotation', 'machines', 'customers', 'parts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:clients,id',
            'machine_id' => 'required|exists:machines,id',
            'part_id' => 'required|exists:spares,id',
            'price.*' => 'required|numeric',
            'quantity.*' => 'required|integer',
            'discount.*' => 'nullable|numeric',
            'discount_percent.*' => 'nullable|numeric',
            'currency.*' => 'required|string|max:255',
        ]);

        try {
            $quotation = Quotation::find($id);
            $quotation->update($request->all());

            return redirect('/quotation')->with('success', 'Quotation updated successfully!');
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
