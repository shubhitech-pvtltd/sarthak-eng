@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="clearfix">
        <div class="pull-left">
            <h2>Quotation </h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Quotation</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4>Quotation </h4>
            </div>
            <div class="pull-right">
                <a href="{{route('quotation.create')}}" class="btn btn-primary waves-effect waves-light">Add
                    Quotation</a>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Quotation Date<span class="text-danger">*</span></label>
                <input type="date" id="filter_date" class="form-control">
            </div>
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">List Of Customer<span class="text-danger">*</span></label>
                <select class="form-control" id="filter_customer_id" name="customer_id">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $client)
                    <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table id="quotations-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Title</th>
                        <th>Date</th>
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
    var table = $('#quotations-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{!! route('quotation.data') !!}",
            data: function(d) {
                d.customer_id = $('#filter_customer_id').val();
                d.date = $('#filter_date').val();
            }
        },
        columns: [{
                data: 'company_name',
                name: 'company_name'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'grand_total',
                name: 'grand_total'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        "order": [
            [2, 'desc']
        ],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        }
    });

    $('#filter_date, #filter_customer_id').change(function() {
        table.draw();
    });
});
</script>
@endsection