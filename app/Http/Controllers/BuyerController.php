<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Buyer;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BuyerController extends Controller
{
    public function index()
    {
        return view('buyer.buyerlist');
    }

    public function getBuyers()
    {
        $buyers = Buyer::select(['id', 'buyer_name', 'buyer_email', 'buyer_phone_no']);

        return DataTables::of($buyers)
            ->addColumn('action', function ($buyer) {
                return '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.url('/buyer/'.$buyer->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.url('/buyer/'.$buyer->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('buyer.addbuyer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone_no' => 'required',
            'buyer_aadhar_no' => 'required',
            'buyer_address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
           
        ]);

        try {
            DB::beginTransaction();
            Buyer::create([
                "buyer_name" => $request->buyer_name,
                "buyer_email" => $request->buyer_email,
                "buyer_phone_no" => $request->buyer_phone_no,
                "buyer_aadhar_no" => $request->buyer_aadhar_no,
                "buyer_address" => $request->buyer_address,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "pincode" => $request->pincode,
                'created_by' => session('id'),
                'updated_by' => session('id')
            ]);
            DB::commit();
            return redirect('/buyer')->with('success', 'Buyer Added Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('error', 'Error While Adding the Record');
        }
    }
    public function edit(Buyer $buyer)
    {
        return view('buyer.addbuyer', compact('buyer'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone_no' => 'required',
            'buyer_aadhar_no' => 'required',
            'buyer_address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            
        ]);

        try {
            DB::beginTransaction();
            $buyer = Buyer::findOrFail($id);
            $buyer->update([
                "buyer_name" => $request->buyer_name,
                "buyer_email" => $request->buyer_email,
                "buyer_phone_no" => $request->buyer_phone_no,
                "buyer_aadhar_no" => $request->buyer_aadhar_no,
                "buyer_address" => $request->buyer_address,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "pincode" => $request->pincode,  
                'updated_by' => session('id')
            ]);
            DB::commit();
            return redirect('/buyer')->with('success', 'Buyer Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('error', 'Error While Updating the Record');
        }
    }

    public function destroy($id)
    {
        try {
            Buyer::destroy($id);
            return response()->json(['success' => 'Buyer Deleted Successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Error While Deleting the Record']);
        }
    }
    
    public function addBuyer(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone_no' => 'required',
            'buyer_address' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $buyer = Buyer::create([
                "buyer_name" => $request->buyer_name,
                "buyer_email" => $request->buyer_email,
                "buyer_phone_no" => $request->buyer_phone_no,
                "buyer_address" => $request->buyer_address,
                'created_by' => session('id'),
                'updated_by' => session('id')
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Buyer Added Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->back()->with('success', 'Error while adding the record');
        }
    }
        
    
}