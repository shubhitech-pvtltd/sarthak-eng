@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Machine</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/machine/create')}}" class="btn btn-primary">Add Machine</a>
            </div>
        </div>
        <table class="data-table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">Machine Name</th>
                    <th>Description</th>
                    <th>Model No</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
$('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! url('/machine/data') !!}',
    columns: [{
            data: 'machine_name',
            name: 'machine_name'
        },
        {
            data: 'description',
            name: 'description'
        },
        {
            data: 'model_no',
            name: 'model_no'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
            
        }
    ],
    "language": {
        "info": "_START_-_END_ of _TOTAL_ entries",
        searchPlaceholder: "Search"
    },
});
</script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script> 

@endsection