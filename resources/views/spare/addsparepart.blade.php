@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($user) ? "Edit" : "Create"}} Spare</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active textChng">{{isset($spare) ? "Edit" : "Create"}}  Spare</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

    <div class="col-md-12">
    <form action="{{ isset($spare) ? url('/spare/'.$spare->id) : url('/spare') }}" method="post">
        
        <!-- CSRF Token -->
        @csrf

        {{-- Method PUT for Update --}}
        @isset($user)
           @method('PUT')    
        @endisset
        
        <h5 class="text-primary">Machine Name</h5>

        <div class="form-group row">

        <div class="col-sm-6  fw-bold">
         <label class="col-form-label ">Machine Name<span class="text-danger">*</span></label>
           <select class="custom-select" name="gender_id">
                  <option value="">Select Machine</option>
                  @foreach($machines as $machine)
                      <option value="{{ $machine->id }}" @if(isset($spare->machine_id) == $machine->id) selected @endif>
                          {{ $machine->machine_name }} [{{$machine->model_no}}]
                      </option>
                  @endforeach
              </select>
          </div> 
          <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Part No<span class="text-danger">*</span></label>
                <input type="text"  name="part_no" value="{{ isset($spare) ? $spare->part_no : '' }}" class="form-control" id="part_no" placeholder="Enter your Part No">
            </div>  
        </div>
    
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Purchase From<span class="text-danger">*</span></label>
                <input type="text" name="purchase_from" value="{{ isset($spare) ? $spare->purchase_from : '' }}" class="form-control" id="purchase_from" placeholder="Enter your purchase from">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                <input type="text"   name="buying_price" value="{{ isset($spare) ? $spare->buying_price : '' }}" class="form-control" id="buying_price" placeholder="Enter your buying price">
            </div>
        </div>    
        
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Selling Price<span class="text-danger">*</span></label>
                <input type="text"   name="selling_price" value="{{ isset($spare) ? $spare->selling_price : '' }}" class="form-control" id="selling_price" placeholder="Enter your selling price">
            </div> 
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Gea Selling Price<span class="text-danger"></span></label>
                <input type="text"  name="gea_selling_price" value="{{ isset($spare) ? $spare->gea_selling_price : '' }}"  class="form-control" id="gea_selling_price" placeholder="Enter your Gea selling price">
            </div> 
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="col-form-label fw-bold">Unit<span class="text-danger">*</span></label>
                <input type="text"   name="unit" value="{{ isset($spare) ? $spare->unit : '' }}" class="form-control" id="unit" placeholder="Enter your unit">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">HSN Code<span class="text-danger">*</span></label>
                <input type="text"  name="hsn_code" value="{{ isset($spare) ? $spare->hsn_code : '' }}" class="form-control" id="hsn_code" placeholder="Enter your HSN code">
            </div>

            <div class="col-sm-6 fw-bold">
                <label class="col-form-label fw-bold">Currency Sellection<span class="text-danger">*</span></label>
                <input type="text"   name="currency" value="{{ isset($spare) ? $spare->currency : '' }}" class="form-control" id="currency_selection" placeholder="Enter your currency selection">
            </div>
        </div>

            <div class="form-group row">
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">Dimension<span class="text-danger"></span></label>
                <input type="text"  name="dimension" value="{{ isset($spare) ? $spare->dimension : '' }}" class="form-control" id="dimension" placeholder="Enter your dimension">
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
            <textarea class="form-control" name="description" value="{{ isset($spare) ? $spare->description : '' }}" class="form-control" id="description" placeholder="Enter your Description"></textarea>
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
