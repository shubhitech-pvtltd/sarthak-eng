@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($spare) ? "Edit" : "Create"}} Spare</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item">spare</li>
            <li class="breadcrumb-item active textChng">{{isset($spare) ? "Edit" : "Create"}}  Spare</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

    <div class="col-md-12">
    <form action="{{ isset($spare) ? url('/spare/'.$spare->id) : url('/spare') }}" method="post">
        
        <!-- CSRF Token -->
        @csrf

        {{-- Method PUT for Update --}}
        @isset($spare)
           @method('PUT')    
        @endisset
        
        <h5 class="text-primary">Machine Name</h5>

        <div class="form-group row">

        <div class="col-sm-6  fw-bold">
         <label class="col-form-label ">Machine Name<span class="text-danger">*</span></label>
           <select class="custom-select" name="machine_id">
                  <option value="">Select Machine</option>
                  @foreach($machines as $machine)
                      <option value="{{ $machine->id }}" @if(isset($spare->machine_id) == $machine->id) selected @endif>
                          {{ $machine->machine_name }} [{{$machine->model_no}}]
                      </option>
                  @endforeach
              </select>
          </div> 
          <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                <input type="text"  name="part_no" value="{{ isset($spare) ? $spare->part_no : '' }}" class="form-control" id="part_no" placeholder="Enter Your Part No.">
            </div>  
        </div>
    
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Purchase From<span class="text-danger">*</span></label>
                <input type="text" name="purchase_from" value="{{ isset($spare) ? $spare->purchase_from : '' }}" class="form-control" id="purchase_from" placeholder="Enter Your Purchase From">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                <input type="text"   name="buying_price" value="{{ isset($spare) ? $spare->buying_price : '' }}" class="form-control" id="buying_price" placeholder="Enter Your Buying Price">
            </div>
        </div>    
        
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Selling Price<span class="text-danger">*</span></label>
                <input type="text"   name="selling_price" value="{{ isset($spare) ? $spare->selling_price : '' }}" class="form-control" id="selling_price" placeholder="Enter Your Selling Price">
            </div> 
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Gea Selling Price<span class="text-danger"></span></label>
                <input type="text"  name="gea_selling_price" value="{{ isset($spare) ? $spare->gea_selling_price : '' }}"  class="form-control" id="gea_selling_price" placeholder="Enter Your Gea Selling Price">
            </div> 
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="col-form-label fw-bold">Unit<span class="text-danger">*</span></label>
                <input type="text"   name="unit" value="{{ isset($spare) ? $spare->unit : '' }}" class="form-control" id="unit" placeholder="Enter Your Unit">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">HSN Code<span class="text-danger">*</span></label>
                <input type="text"  name="hsn_code" value="{{ isset($spare) ? $spare->hsn_code : '' }}" class="form-control" id="hsn_code" placeholder="Enter Your HSN Code">
            </div>

        <div class="col-sm-6 fw-bold">
        <label class="col-form-label fw-bold">Currency Selection<span class="text-danger">*</span></label>
        <select class="custom-select" name="currency">
       <option disabled selected>Select  Currency</option>
       <option value="USD" {{ isset($spare) && $spare->currency == "USD" ? "selected" : "" }}>USD - United States Dollar</option>
        <option value="EUR" {{ isset($spare) && $spare->currency == "EUR" ? "selected" : "" }}>EUR - Euro</option>
        <option value="GBP" {{ isset($spare) && $spare->currency == "GBP" ? "selected" : "" }}>GBP - British Pound Sterling</option>
        <option value="AUD" {{ isset($spare) && $spare->currency == "AUD" ? "selected" : "" }}>AUD - Australian Dollar</option>
        <option value="CAD" {{ isset($spare) && $spare->currency == "CAD" ? "selected" : "" }}>CAD - Canadian Dollar</option>
        <option value="JPY" {{ isset($spare) && $spare->currency == "JPY" ? "selected" : "" }}>JPY - Japanese Yen</option>
        <option value="CHF" {{ isset($spare) && $spare->currency == "CHF" ? "selected" : "" }}>CHF - Swiss Franc</option>
        <option value="CNY" {{ isset($spare) && $spare->currency == "CNY" ? "selected" : "" }}>CNY - Chinese Yuan</option>
        <option value="SEK" {{ isset($spare) && $spare->currency == "SEK" ? "selected" : "" }}>SEK - Swedish Krona</option>
        <option value="NZD" {{ isset($spare) && $spare->currency == "NZD" ? "selected" : "" }}>NZD - New Zealand Dollar</option>
        <option value="MXN" {{ isset($spare) && $spare->currency == "MXN" ? "selected" : "" }}>MXN - Mexican Peso</option>
        <option value="SGD" {{ isset($spare) && $spare->currency == "SGD" ? "selected" : "" }}>SGD - Singapore Dollar</option>
        <option value="HKD" {{ isset($spare) && $spare->currency == "HKD" ? "selected" : "" }}>HKD - Hong Kong Dollar</option>
        <option value="NOK" {{ isset($spare) && $spare->currency == "NOK" ? "selected" : "" }}>NOK - Norwegian Krone</option>
        <option value="DKK" {{ isset($spare) && $spare->currency == "DKK" ? "selected" : "" }}>DKK - Danish Krone</option>
        <option value="INR" {{ isset($spare) && $spare->currency == "INR" ? "selected" : "" }}>INR - Indian Rupee</option>
        <option value="KRW" {{ isset($spare) && $spare->currency == "KRW" ? "selected" : "" }}>KRW - South Korean Won</option>
        <option value="TRY" {{ isset($spare) && $spare->currency == "TRY" ? "selected" : "" }}>TRY - Turkish Lira</option>
        <option value="RUB" {{ isset($spare) && $spare->currency == "RUB" ? "selected" : "" }}>RUB - Russian Ruble</option>
        <option value="BRL" {{ isset($spare) && $spare->currency == "BRL" ? "selected" : "" }}>BRL - Brazilian Real</option>
        <option value="ZAR" {{ isset($spare) && $spare->currency == "ZAR" ? "selected" : "" }}>ZAR - South African Rand</option>
        <option value="AED" {{ isset($spare) && $spare->currency == "AED" ? "selected" : "" }}>AED - United Arab Emirates Dirham</option>
        <option value="THB" {{ isset($spare) && $spare->currency == "THB" ? "selected" : "" }}>THB - Thai Baht</option>
        <option value="IDR" {{ isset($spare) && $spare->currency == "IDR" ? "selected" : "" }}>IDR - Indonesian Rupiah</option>
        <option value="MYR" {{ isset($spare) && $spare->currency == "MYR" ? "selected" : "" }}>MYR - Malaysian Ringgit</option>
        <option value="PHP" {{ isset($spare) && $spare->currency == "PHP" ? "selected" : "" }}>PHP - Philippine Peso</option>
        <option value="EGP" {{ isset($spare) && $spare->currency == "EGP" ? "selected" : "" }}>EGP - Egyptian Pound</option>
        <option value="CZK" {{ isset($spare) && $spare->currency == "CZK" ? "selected" : "" }}>CZK - Czech Koruna</option>
        <option value="HUF" {{ isset($spare) && $spare->currency == "HUF" ? "selected" : "" }}>HUF - Hungarian Forint</option>
        <option value="PLN" {{ isset($spare) && $spare->currency == "PLN" ? "selected" : "" }}>PLN - Polish Zloty</option>
        <option value="ILS" {{ isset($spare) && $spare->currency == "ILS" ? "selected" : "" }}>ILS - Israeli New Shekel</option>
        <option value="SAR" {{ isset($spare) && $spare->currency == "SAR" ? "selected" : "" }}>SAR - Saudi Riyal</option>
        <option value="RON" {{ isset($spare) && $spare->currency == "RON" ? "selected" : "" }}>RON - Romanian Leu</option>
        <option value="ARS" {{ isset($spare) && $spare->currency == "ARS" ? "selected" : "" }}>ARS - Argentine Peso</option>
        <option value="CLP" {{ isset($spare) && $spare->currency == "CLP" ? "selected" : "" }}>CLP - Chilean Peso</option>
        <option value="COP" {{ isset($spare) && $spare->currency == "COP" ? "selected" : "" }}>COP - Colombian Peso</option>
      </select>
   </div>

        </div>

            <div class="form-group row">
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">Dimension<span class="text-danger"></span></label>
                <input type="text"  name="dimension" value="{{ isset($spare) ? $spare->dimension : '' }}" class="form-control" id="dimension" placeholder="Enter Your Dimension">
            </div>
            
            <!-- <div class="form-group row"> -->
            <div class="col-sm-6">
            <label class="col-form-label fw-bold">Drawing Upload</label>
                <input type="file" name="drawing_upload" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
         </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Description<span class="text-danger"></span></label>
            <textarea class="form-control" name="description" value="{{ isset($spare) ? $spare->description : '' }}" class="form-control" id="description" placeholder="Enter Your Description"></textarea>
            </div>
        </div>
        <div class="form-group icon-input text-center">
            <a href="/" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn"> Save </button>
        </div>
    </form>
   </div> 
  </div>  

</div>
                            
@endsection
