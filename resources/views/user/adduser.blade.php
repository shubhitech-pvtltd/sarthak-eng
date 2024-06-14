@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($user) ? "Edit" : "Create"}} User</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active textChng">{{isset($user) ? "Edit" : "Create"}} User</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

        <div class="col-md-12">
            <form action="{{isset($user) ? url('/user/'.$user->id) : url('/user')}}" method="post">

                <!-- CSRF Token -->
                @csrf

                {{-- Method PUT for Update --}}
                @isset($user)
                @method('PUT')
                @endisset

                <h5 class="text-primary">USER ACCOUNT</h5>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Role <span class="text-danger">*</span></label>
                        <select class="custom-select" name="role_id">
                            <option {{ isset($user) && $user->role_id == 1 ? "selected" : ""}} value="1">Super Admin
                            </option>
                            <option {{ isset($user) && $user->role_id == 2 ? "selected" : ""}} value="2">Admin</option>
                            <option {{ isset($user) && $user->role_id == 3 ? "selected" : ""}} value="3">Employee
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">User Name<span class="text-danger">*</span></label>
                        <input type="text" name="username" value="{{isset($user) ? $user->username : ''}}" required
                            class="form-control" placeholder="Enter User Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" name="password" value="" class="form-control"
                            placeholder="Enter Password">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" value="" class="form-control"
                            placeholder="Re-Enter Password">
                    </div>
                </div>
                <hr>
                <h5 class="text-primary mt-4">USER INFORMATION</h5>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                        <input type="text" name="first_name" value="{{isset($user) ? $user->first_name : ''}}" required
                            class="form-control" placeholder="Enter Your First Name">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Last Name<span class="text-danger"></span></label>
                        <input type="text" name="last_name" value="{{isset($user) ? $user->last_name : ''}}"
                            class="form-control" placeholder="Enter Your Last Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="col-form-label fw-bold">Email-ID<span class="text-danger">*</span></label>
                        <input type="email" name="email" required value="{{isset($user) ? $user->email : ''}}"
                            class="form-control" id="email" placeholder="Enter Your Email Id">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Mobile<span class="text-danger">*</span></label>
                        <input type="integer" name="mobile" required value="{{isset($user) ? $user->mobile : ''}}"
                            class="form-control" id="mobile" placeholder="Enter Your Mobile">
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Gender<span class="text-danger">*</span></label>
                        <select class="custom-select" name="gender_id">
                            <option {{ isset($user) && $user->gender_id == 1 ? "selected" : ""}} value="1">Male</option>
                            <option {{ isset($user) && $user->gender_id == 2 ? "selected" : ""}} value="2">Female
                            </option>
                            <option {{ isset($user) && $user->gender_id == 3 ? "selected" : ""}} value="3">Other
                            </option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="user_address_1" class="col-form-label fw-bold">User Address 1<span
                                class="text-danger"></span></label>
                        <input type="text" class="form-control" name="user_address_1" id="user_address_1"
                            value="{{ isset($user) ? $user->user_address_1 : '' }}" placeholder="User Address Line-1">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="user_address_2" class="col-form-label fw-bold">User Address 2<span
                                class="text-danger"></span></label>
                        <input type="text" class="form-control" name="user_address_2" id="user_address_2"
                            value="{{ isset($user) ? $user->user_address_2 : '' }}" placeholder="User Address Line-2">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Country Selection<span class="text-danger">*</span></label>
                            <select class="js-example-basic-single1 form-control" name="country" id="country"
                            value="{{ isset($user) ? $user->country : '' }}">
                            <option disabled selected>Select Country</option>
                            @foreach(getCountry() as $key => $value)
                            <option value="{{ $key }}"
                                {{ isset($user) && $user->country == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">State<span class="text-danger"></span></label>
                        <input type="integer" name="state" value="{{isset($user) ? $user->state : ''}}"
                            class="form-control" id="state" placeholder="Enter User State">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label ">City<span class="text-danger"></span></label>
                        <input type="city" name="city" value="{{isset($user) ? $user->city : ''}}" class="form-control"
                            placeholder="Enter User City ">
                    </div>

                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Pin/Zip Code<span class="text-danger"></span></label>
                        <input type="integer" name="pincode" value="{{isset($user) ? $user->pincode : ''}}"
                            class="form-control" id="pincode" placeholder="Enter User Pin/Zip Code">
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


<script>
$(document).ready(function() {
    $('.js-example-basic-single1').select2();
});
</script>

@endsection