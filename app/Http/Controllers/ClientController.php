<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;


class ClientController extends Controller
{
   public function index(){

      return view('client.clientlist');

   }

  //  For Server Side Datatable
   public function getClients()
   {
        $clients = Client::select(['id', 'company_name', 'company_email', 'owner_name', 'address']);

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
      $client = Client::create([
                    "company_name" => $request->company_name,
                    "owner_name" => $request->owner_name,
                    "office_phone" => $request->office_phone,
                    "owner_phone" => $request->owner_phone,
                    "company_email" => $request->company_email,
                    "owner_email" => $request->owner_email,
                    "address" => $request->address,
                    "country" => $request->country,
                    "gst_no" => $request->gst_no,
                    "pan_no" => $request->pan_no,
                    "bank_name" => $request->bank_name,
                    "bank_branch" => $request->bank_branch,
                    "bank_ifsc" => $request->bank_ifsc,
                    "bank_acc_no" => $request->bank_acc_no,
                    "description" => $request->description,
                    'created_by' => session('id'),
                    'updated_by' => session('id')]);

        return redirect('/client');

    }

   public function edit(Client $client)
   {
     return view('client.addclient', compact('client'));
   }

   public function update(Request $request,$id)
   {
      $client = Client::findorFail($id);

      $client->update(["company_name" => $request->company_name,
                        "owner_name" => $request->owner_name,
                        "office_phone" => $request->office_phone,
                        "owner_phone" => $request->owner_phone,
                        "company_email" => $request->company_email,
                        "owner_email" => $request->owner_email,
                        "address" => $request->address,
                        "country" => $request->country,
                        "gst_no" => $request->gst_no,
                        "pan_no" => $request->pan_no,
                        "bank_name" => $request->bank_name,
                        "bank_branch" => $request->bank_branch,
                        "bank_ifsc" => $request->bank_ifsc,
                        "bank_acc_no" => $request->bank_acc_no,
                        "description" => $request->description,
                        'updated_by' => session('id')]);

        return redirect('/client');


   }

   

    public function destroy($id)
    {
       $result = Client::destroy($id);
    }
}
