@extends('layout.main')

@section('main-section')

<div class="main-container mt-5 ml-4">
  <div class="row">
    <div class="col-md-6 mx-auto">
         <h1>{{ isset($machine) ? "Edit" : "Create" }} Machine</h1>
      <form class="mt-4" action="{{ isset($machine) ? url('/machine/'.$machine->id) : url('/machine') }}" method="post">
        
        @csrf

        @isset($machine)
          @method('PUT')    
        @endisset
                   
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Machine Name</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="machine_name" value="{{isset($machine) ? $machine->machine_name : ''}}" required class="form-control" id="name" placeholder="Enter your Machine name">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Description</label>
            <div class="col-sm-12 col-md-10">
            <input type="text" name="description" value="{{isset($machine) ? $machine->description : ''}}"  class="form-control" id="name" placeholder="Enter your Description ">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Model No</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="model_no" value="{{isset($machine) ? $machine->model_no : ''}}"  class="form-control" id="name" placeholder="Enter your model no">
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
