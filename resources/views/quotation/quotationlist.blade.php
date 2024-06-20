@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="clearfix">
        <div class="pull-left">
            <h2>Quotation List</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Quotation</li>
            <li class="breadcrumb-item active">Quotation List</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4>Quotation List</h4>
            </div>
            <div class="pull-right">
                <a href="{{route('quotation.create')}}" class="btn btn-primary waves-effect waves-light">Add Quotation</a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="quotations-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Final Total</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#quotations-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('quotation.data') !!}",
            columns: [
                { data: 'company_name', name: 'company_name' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'total', name: 'total' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            }
        });
    });
</script>


@endsection
