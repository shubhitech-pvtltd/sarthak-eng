@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($buyer) ? "Edit" : "Create"}} Buyer</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/buyer')}}">Buyer</a></li>
            <li class="breadcrumb-item active textChng">{{isset($buyer) ? "Edit" : "Create"}} Buyer</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

        <div class="col-md-12">
            <form action="{{isset($buyer) ? url('/buyer/'.$buyer->id) : url('/buyer')}}" method="post">


                <!-- CSRF Token -->
                @csrf

                {{-- Method PUT for Update --}}
                @isset($buyer)
                @method('PUT')
                @endisset

                <h5 class="text-primary">Owner Details</h5>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Buyer Name<span class="text-danger">*</span></label>
                        <input type="text" name="buyer_name" value="{{isset($buyer) ? $buyer->buyer_name : ''}}"
                            class="form-control" placeholder="Enter Buyer Name">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Buyer Email<span class="text-danger">*</span></label>
                        <input type="buyer_email" name="buyer_email"
                            value="{{isset($buyer) ? $buyer->buyer_email : ''}}" class="form-control"
                            placeholder="Enter Buyer Email ">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Buyer Phone No.<span class="text-danger">*</span></label>
                        <input type="buyer_phone_no" name="buyer_phone_no"
                            value="{{isset($buyer) ? $buyer->buyer_phone_no : ''}}" class="form-control"
                            placeholder="Enter Buyer Phone No. ">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Buyer Aadhar Card No.<span class="text-danger"></span></label>
                        <input type="buyer_aadhar_no " name="buyer_aadhar_no"
                            value="{{isset($buyer) ? $buyer->buyer_aadhar_no : ''}}" class="form-control"
                            placeholder="Enter Buyer Aadhar No.">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="buyer_address" class="col-form-label fw-bold">Buyer Address <span
                                class="text-danger"></span></label>
                        <input type="text" class="form-control" name="buyer_address" id="buyer_address"
                            value="{{ isset($buyer) ? $buyer->buyer_address : '' }}"
                            placeholder="Buyer Address">
                    </div>
                </div>
              
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Country Selection<span
                                class="text-danger">*</span></label>

                        <select class="js-example-basic-single1 form-control" name="country" id="country"
                            value="{{ isset($buyer) ? $buyer->country : '' }}">
                            <option disabled selected>Select Country</option>
                            @foreach(getCountry() as $key => $value)
                            <option value="{{ $key }}"
                                {{ isset($buyer) && $buyer->country == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">State<span class="text-danger"></span></label>
                        <input type="integer" name="state" value="{{isset($buyer) ? $buyer->state : ''}}"
                            class="form-control" id="state" placeholder="Enter Buyer  State.">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label ">City<span class="text-danger"></span></label>
                        <input type="city" name="city" value="{{isset($buyer) ? $buyer->city : ''}}"
                            class="form-control" placeholder="Enter Buyer City ">
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Pin/Zip Code<span class="text-danger"></span></label>
                        <input type="integer" name="pincode" value="{{isset($buyer) ? $buyer->pincode : ''}}"
                            class="form-control" id="pincode" placeholder="Enter Buyer Pin/Zip Code">
                    </div>
                </div>
                <hr>
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