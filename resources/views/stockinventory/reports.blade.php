@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Reports</h3>
            </div>
            <div class="pull-right">
                <button id="downloadExcelBtn" class="btn btn-primary mb-3"> Download Excel</button>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-3">
                <label class="col-form-label fw-bold">Machine Model<span class="text-danger">*</span></label>
                <select class="js-example-basic-single form-control" name="machine_id" id="machine_id">
                    <option value="">Select Machine</option>
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->model_no }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 col-md-3">
                <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                <select class="js-example-basic-single form-control" name="part_id" id="part_id">
                    <option value="">Select Part</option>
                    @foreach($spares as $spare)
                        <option value="{{ $spare->id }}">{{ $spare->part_no }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 mb-3 mb-md-0">
                <label class="col-form-label fw-bold">Start Date</label>
                <input type="date" class="form-control" id="start_date">
            </div>
            <div class="col-sm-3 col-md-3">
                <label class="col-form-label fw-bold">End Date</label>
                <input type="date" class="form-control" id="end_date">
            </div>
        </div>
        <div class="row">
            <table id="tableId" class="data-table table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Part No.</th>
                        <th>Machine Model</th>
                        <th>Rack</th>
                        <th>Carrot No</th>
                        <th>Quantity</th>
                        <th>Incoming</th>
                        <th>Outgoing</th>
                        <th>Stock In Hand</th>
                        <th>Minimum Stock Alert</th>
                        <th>Unit</th>
                        <th>Purchasing Price</th>
                        <th>Total Purchasing</th>
                        <th>Selling Price</th>
                        <th>Total Selling Price</th>
                        <th>Export Selling Price</th>
                        <th>GEA Selling Price</th>
                        <th>Description</th>
                        <th>DWG No</th>
                        <th>Dimension</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{!! route('report.data') !!}",
                data: function (d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                    d.machine_id = $('#machine_id').val();
                    d.part_id = $('#part_id').val();
                }
            },
            columns: [
                { data: 'date', name: 'date' },
                { data: 'part_no', name: 'part_no' },
                { data: 'machine_model', name: 'machine_model' },
                { data: 'rack_no', name: 'rack_no' },
                { data: 'carrot_no', name: 'carrot_no' },
                { data: 'quantity', name: 'quantity' },
                { data: 'incoming', name: 'incoming' },
                { data: 'outgoing', name: 'outgoing' },
                { data: 'stock_in_hand', name: 'stock_in_hand' },
                { data: 'minimum_stock_alert', name: 'minimum_stock_alert' },
                { data: 'unit', name: 'unit' },
                { data: 'purchasing_price', name: 'purchasing_price' },
                { data: 'total_purchasing', name: 'total_purchasing' },
                { data: 'selling_price', name: 'selling_price' },
                { data: 'total_selling_price', name: 'total_selling_price' },
                { data: 'export_selling_price', name: 'export_selling_price' },
                { data: 'gea_selling_price', name: 'gea_selling_price' },
                { data: 'description', name: 'description' },
                { data: 'dwg_no', name: 'dwg_no' },
                { data: 'dimension', name: 'dimension' }
            ],
            language: {
                info: "_START_ to _END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
            responsive: true
        });

        $('#machine_id, #part_id, #start_date, #end_date').on('change', function () {
            table.ajax.reload();
        });

        $(document).on("click", "#downloadExcelBtn", function () {
            var wb = XLSX.utils.table_to_book(document.getElementById('tableId'));
            var sheet = wb.Sheets[Object.keys(wb.Sheets)[0]];

            sheet['!cols'] = [
                { wch: 10 },
                { wch: 16 },
                { wch: 16 },
                { wch: 12 },
                { wch: 18 },
                { wch: 16 },
                { wch: 18 },
                { wch: 18 }
            ];

            var currentDate = new Date();
            var formattedDate = currentDate.toISOString().split('T')[0];

            XLSX.writeFile(wb, `LabReport-${formattedDate}.xlsx`);
        });
    });
</script>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script>

@endsection

