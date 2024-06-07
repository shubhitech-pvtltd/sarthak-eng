@extends('layout.main')

@section('main-section')

<div class="main-container mt-5 ml-4">
  <div class="row">
    <div class="col-md-6 mx-auto">
         <h1>{{ isset($spare) ? "Edit" : "Create" }} Spare</h1>
      <form class="mt-4" action="{{ isset($spare) ? url('/spare/'.$spare->id) : url('/spare') }}" method="post" enctype="multipart/form-data">        
        @csrf
        @isset($spare)
          @method('PUT')    
        @endisset
        <div class="form-group row">
          <label class="col-sm-12 col-md-3 col-form-label">Machine Name</label>
          <div class="col-sm-12 col-md-9">
              <select name="machine_id" class="form-control">
                  <option value="">Select Machine</option>
                  @foreach($machines as $machine)
                      <option value="{{ $machine->id }}" @if(isset($spare->machine_id) == $machine->id) selected @endif>
                          {{ $machine->machine_name }} [{{$machine->model_no}}]
                      </option>
                  @endforeach
              </select>
          </div>
        </div>     
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Part No</label>
            <div class="col-sm-12 col-md-9">
                <input type="text" name="part_no" value="{{ isset($spare) ? $spare->part_no : '' }}" class="form-control" id="part_no" placeholder="Enter your Part No">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Description</label>
            <div class="col-sm-12 col-md-9">
                <input type="text" name="description" value="{{ isset($spare) ? $spare->description : '' }}" class="form-control" id="description" placeholder="Enter your Description">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Purchase From</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"   name="purchase_from" value="{{ isset($spare) ? $spare->purchase_from : '' }}" class="form-control" id="purchase_from" placeholder="Enter your purchase from">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Buying Price</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"   name="buying_price" value="{{ isset($spare) ? $spare->buying_price : '' }}" class="form-control" id="buying_price" placeholder="Enter your buying price">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Selling Price</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"   name="selling_price" value="{{ isset($spare) ? $spare->selling_price : '' }}" class="form-control" id="selling_price" placeholder="Enter your selling price">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Drawing Upload</label>
            <div class="col-sm-12 col-md-9">
                <input type="file" name="drawing_upload" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Gea Selling Price</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"  name="gea_selling_price" value="{{ isset($spare) ? $spare->gea_selling_price : '' }}"  class="form-control" id="gea_selling_price" placeholder="Enter your Gea selling price">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Unit</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"   name="unit" value="{{ isset($spare) ? $spare->unit : '' }}" class="form-control" id="unit" placeholder="Enter your unit">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Hsn Code</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"  name="hsn_code" value="{{ isset($spare) ? $spare->hsn_code : '' }}" class="form-control" id="hsn_code" placeholder="Enter your HSN code">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Currency Sellection</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"   name="currency" value="{{ isset($spare) ? $spare->currency : '' }}" class="form-control" id="currency_selection" placeholder="Enter your currency selection">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Dimension</label>
            <div class="col-sm-12 col-md-9">
                <input type="text"  name="dimension" value="{{ isset($spare) ? $spare->dimension : '' }}" class="form-control" id="dimension" placeholder="Enter your dimension">
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


