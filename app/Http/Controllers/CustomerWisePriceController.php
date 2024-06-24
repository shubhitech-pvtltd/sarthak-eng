<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customerprice;
use App\Models\Machine;
use App\Models\Spare;
use App\Models\Client;


class CustomerWisePriceController extends Controller
{
    public function index()
    {
        $customerprices = Customerprice::all();
        $machines = Machine::all()->sortBy('machine_name');
        $clients = Client::all();
       
return view('customerprice.customerpricelist', compact('customerprices', 'machines', 'clients'));

        return view('customerprice.customerpricelist', compact('customerprices', 'machines', 'company_name'));

    }


    public function getcustomerprice()
    {
        $customerprices = Customerprice::select([
            'customerprices.id',
            'customerprices.part_no',
        ])
        ->join('machines', 'customerprices.machine_id', '=', 'machines.id')
        ->get();

        return datatables()->of($customerprices)
            ->addColumn('action', function ($customerprice) {
                return '';
            })
            ->rawColumns(['action'])
            ->make(true);
      
    }   

    public function create()
    {
        $machines = Machine::all()->sortBy('machine_name'); 
        return view('spare.addcustomerprice', compact('machines'));
    }

    public function store(Request $request)
{
    
    $request->validate([
       'machine_id' => 'required',
         'part_id' => 'required',
    ]);
    

    try {
        foreach ($request->customer_id as $index => $customer_id) {
            $data = [
                "machine_id" => $request->machine_id,
                "part_id" => $request->part_id,
                "customer_id" => $customer_id,
                "price" => $request->price[$index],
                "discount" => $request->discount[$index] ?? null,
                "discount_percent" => $request->discount_percent[$index] ?? null,
                "currency" => $request->currency[$index] ?? null,
                "created_by" => session('id'),
                "updated_by" => session('id')
            ];
        
            if ($request->customerwiseprice_id[$index]) {
                Customerprice::where('id', $request->customerwiseprice_id[$index])->update($data);
            } else {
                Customerprice::create($data);
            }
        }
        
        return redirect('/')->with('success', 'Spare added successfully');
    } catch (\Exception $e) {
        Log::error('Error while adding the record: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error while adding the record');
    }
}
    public function destroy($id)
    {
        try {
            $result = Customerprice::destroy($id);
            return redirect('/spare')->with('success', 'Spare deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error while deleting the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while deleting the record');
        }
    }

    public function getMachineDetails(Request $request)
    {
        $machineIds = $request->input('machineIds');
        $machines = Spare::where('machine_id', $machineIds)->get();
        
        return response()->json($machines);
    }

    public function get_customerlist_details(Request $request)
    {
        $customerId = $request->input('customerIds');
        $partId = $request->input('partIds');
    
       $customerDetails = CustomerPrice::where('customer_id', $customerId)
                                        ->where('part_id', $partId)
                                        ->first();

        if ($customerDetails) {
            return response()->json($customerDetails);
        } else {
            return response()->json(['message' => 'No record found']);
        }
   
    }      
}