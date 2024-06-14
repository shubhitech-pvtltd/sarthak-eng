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
                @isset($client)
                @method('PUT')
                @endisset

                <h5 class="text-primary">Owner Details</h5>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Owner Name<span class="text-danger">*</span></label>
                        <input type="text" name="owner_name" value="{{isset($client) ? $client->owner_name : ''}}"
                            class="form-control" placeholder="Enter Owner Name">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Owner Email<span class="text-danger">*</span></label>
                        <input type="owner_email" name="owner_email"
                            value="{{isset($client) ? $client->owner_email : ''}}" class="form-control"
                            placeholder="Enter Owner Email ">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Owner Phone No.<span class="text-danger">*</span></label>
                        <input type="owner_phone_no" name="owner_phone_no"
                            value="{{isset($client) ? $client->owner_phone_no : ''}}" class="form-control"
                            placeholder="Enter Owner Phone No. ">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Owner Aadhar Card No.<span class="text-danger"></span></label>
                        <input type="owner_aadhar_no " name="owner_aadhar_no"
                            value="{{isset($client) ? $client->owner_phone_no : ''}}" class="form-control"
                            placeholder="Enter Owner Aadhar No.">
                    </div>
                </div>
                <hr>
                <h5 class="text-primary mt-4">Company Details</h5>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                        <input type="text" name="company_name" value="{{isset($client) ? $client->company_name : ''}}"
                            required class="form-control" placeholder="Enter Company Name">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Company Email ID<span class="text-danger">*</span></label>
                        <input type="text" name="company_email" value="{{isset($client) ? $client->company_email : ''}}"
                            class="form-control" placeholder="Enter  Company Email Id">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label ">Company Phone No.<span class="text-danger"></span></label>
                        <input type="company_phone_no" name="company_phone_no"
                            value="{{isset($client) ? $client->company_phone_no : ''}}" class="form-control"
                            placeholder="Enter Company Phone No. ">
                    </div>

                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Company PAN No.<span class="text-danger"></span></label>
                        <input type="integer" name="company_pan_no" required
                            value="{{isset($client) ? $client->company_pan_no : ''}}" class="form-control" id="mobile"
                            placeholder="Enter Company PAN No.">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label ">Company GST No.<span class="text-danger"></span></label>
                        <input type="company_gst_no" name="company_gst_no"
                            value="{{isset($client) ? $client->company_gst_no : ''}}" class="form-control"
                            placeholder="Enter Company GST No. ">
                    </div>

                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Company CIN No./ Licenss No.<span
                                class="text-danger"></span></label>
                        <input type="integer" name="company_cin_no"
                            value="{{isset($client) ? $client->company_cin_no : ''}}" class="form-control" id="mobile"
                            placeholder="Enter Company CIN No.">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="company_address_1" class="col-form-label fw-bold">Company Address 1<span
                                class="text-danger"></span></label>
                        <input type="text" class="form-control" name="company_address_1" id="company_address_1"
                            value="{{ isset($client) ? $client->company_address_1 : '' }}"
                            placeholder="Company Address Line-1">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="company_address_2" class="col-form-label fw-bold">Company Address 2<span
                                class="text-danger"></span></label>
                        <input type="text" class="form-control" name="company_address_2" id="company_address_2"
                            value="{{ isset($client) ? $client->company_address_2 : '' }}"
                            placeholder="Company Address Line-2">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Country Selection<span class="text-danger">*</span></label>

                        <select class="js-example-basic-single1 form-control" name="country" id="country"
                            value="{{ isset($client) ? $client->country : '' }}">
                            <option disabled selected>Select Country</option>
                            @foreach(getCountry() as $key => $value)
                            <option value="{{ $key }}"
                                {{ isset($client) && $client->country == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">State<span class="text-danger"></span></label>
                        <input type="integer" name="state" value="{{isset($client) ? $client->state : ''}}"
                            class="form-control" id="state" placeholder="Enter Company  State.">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label ">City<span class="text-danger"></span></label>
                        <input type="city" name="city" value="{{isset($client) ? $client->city : ''}}"
                            class="form-control" placeholder="Enter Company City ">
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Pin/Zip Code<span class="text-danger"></span></label>
                        <input type="integer" name="pincode" value="{{isset($client) ? $client->pincode : ''}}"
                            class="form-control" id="pincode" placeholder="Enter Company Pin/Zip Code">
                    </div>
                </div>
                <hr>
        </div>
        <h5 class="text-primary">Bank Details</h5>
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Bank Name<span class="text-danger"></span></label>
                <input type="text" name="bank_name" value="{{isset($client) ? $client->bank_name : ''}}"
                    class="form-control" placeholder="Enter Bank Name">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Account No.<span class="text-danger"></span></label>
                <input type="account_no" name="account_no" value="{{isset($client) ? $client->account_no : ''}}"
                    class="form-control" placeholder="Enter Account No. ">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">

                <label class="col-form-label">IFSC/Swift Code<span class="text-danger"></span></label>
                <input type="ifsc_no " name="ifsc_no" value="{{isset($client) ? $client->ifsc_no : ''}}"
                    class="form-control" placeholder="Enter IFSC/Swift Code">
            </div>
            <div class="col-sm-6 fw-bold">

                <label class="col-form-label">Branch Name<span class="text-danger"></span></label>
                <input type="bank_branch_name" name="bank_branch_name"
                    value="{{isset($client) ? $client->bank_branch_name : ''}}" class="form-control"
                    placeholder="Enter Bank Branch Name ">
            </div>
        </div>
        <div class="form-group icon-input text-center">
            <a href="/" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn"> Save </button>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-single1').select2();
});
</script>

@endsection