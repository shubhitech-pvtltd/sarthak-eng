@extends('layout.main')

@section('main-section')

<div class="main-container mt-4">
  <div class="row">
    <div class="col-md-10 mx-auto">
    <h1>{{isset($client) ? "Edit" : "Create" }} Client</h1>
    <form class="mt-4" action="{{isset($client) ? url('/client/'.$client->id) : url('/client')}}" method="post">
        
        @csrf

        @isset($client)
          @method('PUT')    
        @endisset

        <div class="form-group row">
            <div class="col-md-6">
                <input type="text" name="company_name" value="{{isset($client) ? $client->company_name : '' }}" class="form-control"  placeholder="Enter Company Name*">
            </div>
            <div class="col-md-6">
                <input type="text" name="owner_name" value="{{isset($client) ? $client->owner_name : '' }}" class="form-control" placeholder="Enter Owner Name*">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="number" name="office_phone" value="{{isset($client) ? $client->office_phone : '' }}" class="form-control" placeholder="Enter Office Number*" >
            </div>
            <div class="col-md-6">
                <input type="number" name="owner_phone" value="{{isset($client) ? $client->owner_phone : '' }}" class="form-control" placeholder="Enter Owner Number*" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="email" name="company_email" value="{{isset($client) ? $client->company_email : '' }}" class="form-control" placeholder="Enter Company Email*" >
            </div>
            <div class="col-md-6">
                <input type="email" name="owner_email" value="{{isset($client) ? $client->owner_email : '' }}" class="form-control" placeholder="Enter Owner email*" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="text" name="address" value="{{isset($client) ? $client->address : '' }}" class="form-control" placeholder="Enter Company Address*" >
            </div>
            <div class="col-md-6">
                <input type="text" name="country" value="{{isset($client) ? $client->country : '' }}" class="form-control" placeholder="Enter Company Country*" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="text" name="gst_no" value="{{isset($client) ? $client->gst_no : '' }}" class="form-control" placeholder="Enter Company GSTIN*" >
            </div>
            <div class="col-md-6">
                <input type="text" name="pan_no" value="{{isset($client) ? $client->pan_no : '' }}" class="form-control" placeholder="Enter Company PAN">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="text" name="bank_name" value="{{isset($client) ? $client->bank_name : '' }}" class="form-control" placeholder="Enter Company Bank Name*" >
            </div>
            <div class="col-md-6">
                <input type="text" name="bank_branch" value="{{isset($client) ? $client->bank_branch : '' }}" class="form-control" placeholder="Enter Company Bank Branch Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="text" name="bank_ifsc" value="{{isset($client) ? $client->bank_ifsc : '' }}" class="form-control" placeholder="Enter Company Bank IFSC" >
            </div>
            <div class="col-md-6">
                <input type="number" name="bank_acc_no" value="{{isset($client) ? $client->bank_acc_no : '' }}" class="form-control" placeholder="Enter Company Bank Account No.">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <input type="text" name="description" value="{{isset($client) ? $client->description : '' }}" class="form-control" placeholder="Enter Details">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger">Submit</button>
        </div>

    </form>
   </div> 
  </div>  

</div>
                            
@endsection