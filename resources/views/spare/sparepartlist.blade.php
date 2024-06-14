@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Spare</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/spare/create')}}" class="btn btn-primary">Add Spare</a>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Machine Name</th>
                        <th>Part No</th>
                        <th>Description</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

<script>
$('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! url('/spare/data') !!}',
    columns: [{
            data: 'machine_name',
            name: 'machine_name'
        },
        {
            data: 'part_no',
            name: 'part_no'
        },
        {
            data: 'description',
            name: 'description'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }
    ],
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
    language: {
        info: "_START_-_END_ of _TOTAL_ entries",
        searchPlaceholder: "Search"
    }
});
</script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script> {{-- Custom sweet alert code --}}
@endsection