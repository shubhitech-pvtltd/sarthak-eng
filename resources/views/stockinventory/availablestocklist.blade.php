@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Available Stock</h3>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Machine Model<span class="text-danger">*</span></label>
                <select class="js-example-basic-single1 form-control" name="machine_id" id="machine_id">
                    <option value="">Select Machine</option>
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->model_no }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                <select class="js-example-basic-single1 form-control" name="part_id" id="part_id">
                    <option value="">Select Part</option>
                    @foreach($spares as $spare)
                        <option value="{{ $spare->id }}">{{ $spare->part_no }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Part No.</th>
                        <th>Machine Model</th>
                        <th>Available Quantity</th>
                        <th>Minimum stock alert</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! url('/availablestock/data') !!}",
        columns: [
            {
                data: 'created_at',
                name: 'availablestocks.created_at',
                render: function (data) {
                    if (data) {
                        var date = new Date(data);
                        var day = ("0" + date.getDate()).slice(-2);
                        var month = ("0" + (date.getMonth() + 1)).slice(-2);
                        var year = date.getFullYear().toString().slice(-2);
                        return day + '/' + month + '/' + year;
                    }
                    return data;
                }
            },
            { data: 'part_no', name: 'spares.part_no' },
            { data: 'machine_model', name: 'machines.model_no' },
            { data: 'quantity', name: 'spares.quantity' },
            { data: 'minimum_stock_alert', name: 'spares.minimum_stock_alert' }
        ],
        rowCallback: function(row, data) {
            var availableQuantity = data.quantity;
            var minStockAlert = data.minimum_stock_alert;

            $(row).find('td').removeClass('low-quantity alert-yellow');

            if (availableQuantity <= 2) {
                $(row).find('td:eq(3)').addClass('low-quantity');
            }

            if (minStockAlert <= 5) {
                $(row).find('td:eq(4)').addClass('alert-yellow');
            }
        },
        "language": {
            "info": "_START_ to _END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        },
    });
});
</script>

<style>
.low-quantity {
    background-color: red !important;
}
.alert-yellow {
    background-color: yellow !important;
}
</style>





<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script>

@endsection
