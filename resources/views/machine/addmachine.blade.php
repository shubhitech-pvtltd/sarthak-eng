@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($machine) ? "Edit" : "Create"}} Machine</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Machine</li>
            <li class="breadcrumb-item active textChng">{{isset($machine) ? "Edit" : "Create"}} Machine</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

    <div class="col-md-12">
    <form action="{{isset($machine) ? url('/machine/'.$machine->id) : url('/machine')}}" method="post">
        
        <!-- CSRF Token -->
        @csrf

        {{-- Method PUT for Update --}}
        @isset($user)
           @method('PUT')    
        @endisset
        
        <h5 class="text-primary">Machine Details</h5>

        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">machine Name<span class="text-danger">*</span></label>
                <input type="text" name="machine_name" value="{{isset($machine) ? $machine->machine_name : ''}}" class="form-control" placeholder="machine Name">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Model No<span class="text-danger">*</span></label>
                <input type="model_no" name="model_no" value="{{isset($machine) ? $machine->model_no : ''}}" class="form-control" placeholder="Enter Model No ">
            </div>
        </div> 
        
          <div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Description<span class="text-danger">*</span></label>
            <textarea class="form-control" cols="10" rows="2" name="description" value="{{isset($machine) ? $machine->description : ''}}"  class="form-control" id="name" placeholder="Enter your Description "></textarea>
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
                            
@endsection
