<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customerprice;
use App\Models\Machine;
use App\Models\Client;
use App\Models\Spare;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CustomerWisePriceController extends Controller
{
    public function index()
    {
        $machines = Machine::all()->sortBy('machine_name');
        $clients = Client::all();
        return view('customerprice.customerpricelist', compact('machines', 'clients'));
    }

    public function getCustomerprice(Request $request)
    {
        $query = Customerprice::select([
            'customerprices.id',
            'spares.part_no',
            'machines.machine_name',
            'machines.model_no',
            'clients.company_name',
        ])
        ->join('machines', 'customerprices.machine_id', '=', 'machines.id')
        ->join('clients', 'customerprices.customer_id', '=', 'clients.id')
        ->join('spares', 'customerprices.part_id', '=', 'spares.id')

        ->when($request->machine_id, function ($query) use ($request) {
            return $query->where('customerprices.machine_id', $request->machine_id);
        })
        ->when($request->part_id, function ($query) use ($request) {
            return $query->where('customerprices.part_id', $request->part_id);
        })
        ->when($request->customer_id, function ($query) use ($request) {
            return $query->where('customerprices.customer_id', $request->customer_id);
        })
        ->get();

        return DataTables::of($query)
            ->addColumn('action', function ($customerprice) {
                return '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.route('customerprice.edit', $customerprice->id).'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.route('customerprice.destroy', $customerprice->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create()
    {
        $machines = Machine::select('id','machine_name', 'model_no')
                    ->orderBy('machine_name')
                    ->get();
            
        $clients = Client::select('id','company_name') 
                    ->get();
    
    
        return view('customerprice.customerpriceadd', compact('machines', 'clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'machine_id' => 'required',
            'customer_id' => 'required|array',
            'customer_id.*' => 'required|integer',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->customer_id as $index => $customer_id) {
                $data = [
                    "machine_id" => $request->machine_id,
                    "part_id" => $request->part_id,
                    "customer_id" => $customer_id,
                    "price" => $request->price[$index],
                    "discount" => $request->discount[$index] ?? null,
                    "discount_percent" => $request->discount_percent[$index] ?? null,
                    "created_by" => session('id'),
                    "updated_by" => session('id')
                ];

                if (isset($request->customerwiseprice_id[$index])) {
                    Customerprice::where('id', $request->customerwiseprice_id[$index])->update($data);
                } else {
                    Customerprice::create($data);
                }
            }
            DB::commit();
            return redirect('/customerprice')->with('success', 'Customer price added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while adding the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding the record');
        }
    }

    public function edit($id)
    {
        $customerprice = Customerprice::findOrFail($id);
        $machines = Machine::select('id','machine_name', 'model_no')
        ->orderBy('machine_name')
        ->get();

      $clients = Client::select('id','company_name') 
        ->get();

        $parts = Spare::where('machine_id',$customerprice->machine_id)->get();

        return view('customerprice.customerpriceedit', compact('customerprice', 'machines', 'clients','parts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'machine_id' => 'required',
            'part_id' => 'required',
            'customer_id' => 'required|array',
            'customer_id.*' => 'required|integer',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->customer_id as $index => $customer_id) {
                $data = [
                    "machine_id" => $request->machine_id,
                    "part_id" => $request->part_id,
                    "customer_id" => $customer_id,
                    "price" => $request->price[$index],
                    "discount" => $request->discount[$index] ?? null,
                    "discount_percent" => $request->discount_percent[$index] ?? null,
                    "updated_by" => session('id')
                ];

                if (isset($request->customerwiseprice_id[$index])) {
                    Customerprice::where('id', $request->customerwiseprice_id[$index])->update($data);
                }
            }
            DB::commit();
            return redirect('/customerprice')->with('success', 'Customer price updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record');
        }
    }

    public function destroy($id)
    {
        try {
            Customerprice::destroy($id);
            return response()->json(['success' => 'Customer price deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error while deleting the record: ' . $e->getMessage());
            return response()->json(['error' => 'Error while deleting the record'], 500);
        }
    }

    public function getMachineDetails(Request $request)
    {
        $machineId = $request->input('machineId');
        $parts = Spare::select('id','part_no','description','buying_price')->where('machine_id', $machineId)->get();
        
        return response()->json($parts);
    }

    public function get_customerlist_details(Request $request)
    {
        $customerId = $request->input('customerIds');
        $partId = $request->input('partIds');
    
        $customerDetails = Customerprice::where('customer_id', $customerId)
                                        ->where('part_id', $partId)
                                        ->first();

        if ($customerDetails) {
            return response()->json($customerDetails);
        } else {
            return response()->json(['message' => 'No record found']);
        }
    }
}