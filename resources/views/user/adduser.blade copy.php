@extends('layout.main')

@section('main-section')


<div class="main-container mt-5 ml-4">
  <div class="row">
    <div class="col-md-6 mx-auto">
    <h1>{{isset($user) ? "Edit" : "Create"}} User</h1>
    <form class="mt-3" action="{{isset($user) ? url('/user/'.$user->id) : url('/user')}}" method="post">
        
        <!-- CSRF Token -->
        @csrf

        {{-- Method PUT for Update --}}
        @isset($user)
           @method('PUT')    
        @endisset
        
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Role</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select" name="role_id">
                    <option {{ isset($user) && $user->role_id == 1 ? "selected" : ""}} value="1">Super Admin</option>
                    <option {{ isset($user) && $user->role_id == 2 ? "selected" : ""}} value="2">Admin</option>
                    <option {{ isset($user) && $user->role_id == 3 ? "selected" : ""}} value="3">Employee</option>
                </select>
            </div>    
        </div>    
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Name</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="name" value="{{isset($user) ? $user->name : ''}}" required class="form-control" id="name" placeholder="Enter your name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
            <div class="col-sm-12 col-md-10">
                <input type="email" name="email" required value="{{isset($user) ? $user->email : ''}}" class="form-control" id="email" placeholder="Enter your email address">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Password</label>
            <div class="col-sm-12 col-md-10">
                <input type="password" name="password" value="" class="form-control" id="password" placeholder="Enter Password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Mobile</label>
            <div class="col-sm-12 col-md-10">
                <input type="integer" name="mobile" required value="{{isset($user) ? $user->mobile : ''}}" class="form-control" id="mobile" placeholder="Enter your mobile" >
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Address</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="address"  value="{{isset($user) ? $user->address : ''}}" class="form-control" id="address" placeholder="Enter your address" >
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


