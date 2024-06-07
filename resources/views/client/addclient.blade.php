@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($client) ? "Edit" : "Create"}} Client</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Client</li>
            <li class="breadcrumb-item active textChng">{{isset($client) ? "Edit" : "Create"}} Client</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

    <div class="col-md-12">
    <form action="{{isset($client) ? url('/client/'.$client->id) : url('/client')}}" method="post">
        
        <!-- CSRF Token -->
        @csrf

        {{-- Method PUT for Update --}}
        @isset($user)
           @method('PUT')    
        @endisset
        
        <h5 class="text-primary">Owner Details</h5>

        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Name<span class="text-danger">*</span></label>
                <input type="text" name="owner_name" value="{{isset($client) ? $client->owner_name : ''}}" class="form-control" placeholder="Enter Owner Name">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Email<span class="text-danger">*</span></label>
                <input type="owner_email" name="owner_email" value="{{isset($client) ? $client->owner_email : ''}}" class="form-control" placeholder="Enter Owner Email ">
            </div>
        </div> 
        
        <div class="form-group row">
        <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Phone No.<span class="text-danger">*</span></label>
                <input type="owner_phone_no" name="owner_phone_no" value="{{isset($client) ? $client->owner_phone_no : ''}}" class="form-control" placeholder="Enter Owner Phone No ">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Aadhar Card No.<span class="text-danger"></span></label>
                <input type="owner_aadhar_no " name="owner_aadhar_no" value="{{isset($client) ? $client->owner_phone_no : ''}}" class="form-control" placeholder="Enter Owner Aadhar no">
            </div>
        </div> 
        <!-- <div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Owner Address<span class="text-danger"></span></label>
            <textarea class="form-control" name="owner_address"cols="6" rows="1"  value="{{isset($client) ? $client->owner_address : '' }}" class="form-control" id="address" placeholder="Address"></textarea>
            </div>
        </div>    -->

        <hr>
        <h5 class="text-primary mt-4">Company Details</h5>
        
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                <input type="text" name="company_name" value="{{isset($client) ? $client->company_name : ''}}" required class="form-control" placeholder="Enter Company name">
            </div> 
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Company Email ID<span class="text-danger">*</span></label>
                <input type="text" name="company_email" value="{{isset($client) ? $client->company_email : ''}}"  class="form-control" placeholder="Enter  Company Email Id">
            </div> 
        </div>

        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label ">Company Phone No.<span class="text-danger"></span></label>
                <input type="company_phone_no" name="company_phone_no" value="{{isset($client) ? $client->company_phone_no : ''}}" class="form-control" placeholder="Enter Company Phone No ">
            </div>
           
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">Company PAN No.<span class="text-danger"></span></label>
                <input type="integer" name="company_pan_no" required value="{{isset($client) ? $client->company_pan_no : ''}}" class="form-control" id="mobile" placeholder="Enter Company PAN No." >
            </div>
      </div>  
      <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label ">Company GST No.<span class="text-danger"></span></label>
                <input type="company_gst_no" name="company_gst_no"  value="{{isset($client) ? $client->company_gst_no : ''}}" class="form-control" placeholder="Enter Company GST No ">
            </div>
           
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">Company CIN No./ Licenss No.<span class="text-danger"></span></label>
                <input type="integer" name="company_cin_no"  value="{{isset($client) ? $client->company_cin_no : ''}}" class="form-control" id="mobile" placeholder="Enter Company CIN No." >
            </div>
      </div>  

        <label class="col-form-label fw-bold">Country<span class="text-danger">*</span></label>
         <select class="custom-select" name="country"   value="{{isset($client) ? $client->country : ''}}">
          <option disabled selected>Select a country</option>
          <option value="USA" {{ isset($user) && $user->country == "USA" ? "selected" : "" }}>United States</option>
          <option value="UK" {{ isset($user) && $user->country == "UK" ? "selected" : "" }}>United Kingdom</option>
          <option value="CAN" {{ isset($user) && $user->country == "CAN" ? "selected" : "" }}>Canada</option>
          <option value="AUS" {{ isset($user) && $user->country == "AUS" ? "selected" : "" }}>Australia</option>
          <option value="GER" {{ isset($user) && $user->country == "GER" ? "selected" : "" }}>Germany</option>
          <option value="FRA" {{ isset($user) && $user->country == "FRA" ? "selected" : "" }}>France</option>
          <option value="JPN" {{ isset($user) && $user->country == "JPN" ? "selected" : "" }}>Japan</option>
          <option value="BRA" {{ isset($user) && $user->country == "BRA" ? "selected" : "" }}>Brazil</option>
          <option value="IND" {{ isset($user) && $user->country == "IND" ? "selected" : "" }}>India</option>
          <option value="CHN" {{ isset($user) && $user->country == "CHN" ? "selected" : "" }}>China</option>
          <option value="ESP" {{ isset($user) && $user->country == "ESP" ? "selected" : "" }}>Spain</option>
          <option value="ITA" {{ isset($user) && $user->country == "ITA" ? "selected" : "" }}>Italy</option>
    
</select>

<div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Company Address<span class="text-danger"></span></label>
            <textarea class="form-control" name="company_address"cols="6" rows="1"   value="{{isset($client) ? $client->company_address : ''}}" class="form-control" id="company_address" placeholder="Address"></textarea>
            </div>
        </div>   
        <hr> 

</div>

<h5 class="text-primary">Bank Details</h5>

<div class="form-group row">
    <div class="col-sm-6 fw-bold">
        <label class="col-form-label">Bank Name<span class="text-danger"></span></label>
        <input type="text" name="bank_name"  value="{{isset($client) ? $client->bank_name : ''}}" class="form-control" placeholder="Enter Bank Name">
    </div>
    <div class="col-sm-6 fw-bold">
        <label class="col-form-label">Bank Branch Name<span class="text-danger"></span></label>
        <input type="bank_branch_name" name="bank_branch_name"  value="{{isset($client) ? $client->bank_branch_name : ''}}" class="form-control" placeholder="Enter Bank Branch Name ">
    </div>
</div> 

<div class="form-group row">
<div class="col-sm-6 fw-bold">
        <label class="col-form-label">Account NO.<span class="text-danger"></span></label>
        <input type="account_no" name="account_no"  value="{{isset($client) ? $client->account_no : ''}}" class="form-control" placeholder="Enter Account No ">
    </div>
    <div class="col-sm-6 fw-bold">
        <label class="col-form-label">IFSC NO.<span class="text-danger"></span></label>
        <input type="ifsc_no " name="ifsc_no" value="{{isset($client) ? $client->ifsc_no : ''}}" class="form-control" placeholder="Enter IFSC No">
    </div>
</div> 

        

        <!-- <div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Bank Address<span class="text-danger"></span></label>
            <textarea class="form-control" name="bank_address"cols="10" rows="2"  value="{{isset($client) ? $client->bank_address : '' }}" class="form-control" id="bank_address" placeholder="Bank Address"></textarea>
            </div>
        </div> -->
        <div class="form-group icon-input text-center">
            <a href="/" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn"> Save </button>
        </div>
</div>
    </form>
   </div> 
  </div>  

</div>
                            
@endsection
