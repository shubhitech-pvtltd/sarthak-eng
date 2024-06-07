@extends('layout.main')

    
@section('main-section')

<div class="main-container mt-5 ml-4">
    <!-- Datatable start -->
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Users</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/user/create')}}" class="btn btn-primary">Add User</a>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="table-plus">{{$user->first_name}} {{$user->last_name}}</td>
                        <td><span  class="badge badge-success">{{getRoleName($user->role_id)}}</span></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    {{-- <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a> --}}
                                    <a class="dropdown-item" href="{{ url('/user/'.$user->id.'/edit')}}"><i class="fa fa-pencil"></i> Edit</a>
                                    <a class="dropdown-item deleteBtn" data-url="{{ url('/user/'.$user->id)}}"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Datatable End -->
</div>


<script>
       
       $('.data-table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
        });
        
</script>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script> {{-- Custom sweet alert code --}}

@endsection
