<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
   public function index(){

      return view('client.clientlist');

   }


   public function getClients()
   
   {
        $clients = Client::select(['id', 'company_name', 'owner_name', 'company_email','owner_phone_no']);

        return DataTables::of($clients)
            ->addColumn('action', function ($client) {
                return '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.url('/client/'.$client->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.url('/client/'.$client->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
   

   public function create()
   {

   
     return view('client.addclient');
   }
 

   public function store(Request $request)
   {

      $request->validate([
         'owner_name' => 'required',
         'owner_email' => 'required',
         'owner_phone_no' => 'required',
         'owner_aadhar_no' => '',
        'company_name' => 'required',
        'company_email' => 'required|email',
        'company_phone_no' => 'required',
        'country'=>'required',
   
        
       
      ]);
      
      try{
            Client::create([
                            "owner_name" => $request->owner_name,
                            "owner_email" => $request->owner_email,
                            "owner_phone_no" => $request->owner_phone_no,
                            "owner_aadhar_no" => $request->owner_aadhar_no,
                            "company_name" => $request->company_name,
                            "company_email" => $request->company_email,
                            "company_phone_no" => $request->company_phone_no,
                            "company_pan_no" => $request->company_pan_no,
                            "company_gst_no" => $request->company_gst_no,
                            "company_cin_no" => $request->company_cin_no,
                            'company_address_1' =>  $request->company_address_1,
                             "company_address_2" => $request->company_address_2,
                             "country"=>$request->country,
                            "state" => $request->state,
                            "city" =>$request->city,
                            "pincode" =>$request->pincode,
                            "bank_branch_name" => $request->bank_branch_name,
                            "bank_name"=>$request->bank_name,
                            "account_no" => $request->account_no,
                            "ifsc_no" => $request->ifsc_no,
                            // "bank_address" => $request->bank_address,
                            'created_by' => session('id'),
                            'updated_by' => session('id')]);

            return redirect('/client')->with('success','Client Added SuccessFully');

        }catch(\Exception $e){
            Log::error($e);
            return redirect()->back()->with('error','Error While Adding the Record');

        }

    }

   public function edit(Client $client)
   {
     return view('client.addclient', compact('client'));
   }

   public function update(Request $request,$id)
   {
      $request->validate([
        'owner_name' => 'required',
        'owner_email' => 'required',
        'owner_phone_no' => 'required',
        'owner_aadhar_no' => '',
       'company_name' => 'required',
       'company_email' => 'required|email',
       'company_phone_no' => 'required',

       

      ]);
      
      try{

        $client = Client::findorFail($id);

        $client->update([
            "owner_name" => $request->owner_name,
            "owner_email" => $request->owner_email,
            "owner_phone_no" => $request->owner_phone_no,
            "owner_aadhar_no" => $request->owner_aadhar_no,
            "company_name" => $request->company_name,
            "company_email" => $request->company_email,
            "company_phone_no" => $request->company_phone_no,
            "company_pan_no" => $request->company_pan_no,
            "company_gst_no" => $request->company_gst_no,
            "company_cin_no" => $request->company_cin_no,
            'company_address_1' =>  $request->company_address_1,
            "company_address_2" => $request->company_address_2,
            "country"=>$request->country,
            "state" => $request->state,
            "city" =>$request->city,
            "pincode" =>$request->pincode,
            "bank_branch_name"=>$request->bank_branch_name,
            "account_no" => $request->account_no,
            "ifsc_no" => $request->ifsc_no,
            // "bank_address" => $request->bank_address,
            'updated_by' => session('id')]);

            return redirect('/client')->with('success','Client Updated SuccessFully');
        }catch(\Exception $e){
            Log::error($e);
            return redirect()->back()->with('error','Error While Updating the Record');
        }

   }

    public function destroy($id)
    {
       $result = Client::destroy($id);
    }
}