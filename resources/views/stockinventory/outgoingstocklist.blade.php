 @extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Outgoing Stock</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/stockinventory/outgoingstock/create')}}" class="btn btn-primary">Add Outgoing Stock
                </a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Machine Model<span class="text-danger">*</span></label>
                <select class="js-example-basic-single1 form-control" name="machine_id" id="machine_id">
                    <option value="">Select Machine</option>
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">
                            {{ $machine->model_no }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                <select class="js-example-basic-single1 form-control" name="part_id" id="part_id">
                    <option value="">Select Part</option>
                    @foreach($spares as $spare)
                        <option value="{{ $spare->id }}">
                            {{ $spare->part_no }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Date</th>
                            <th>Rack No.</th>
                            <th>Part No.</th>
                            <th>Machine Model</th>
                            <th>Carrot No</th>
                            <th>Unit</th>
                            <th>Outgoing</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{!! url('/outgoingstock/data') !!}",
            data: function(d) {
                d.machine_id = $('#machine_id').val();
                d.part_id = $('#part_id').val();
            }
        },
        columns: [
            { data: 'date', name: 'date' },
            { data: 'rack_no', name: 'rack_no' },
            { data: 'part_no', name: 'part_no' },
            { data: 'machine_model', name: 'machine_model' },
            { data: 'carrot_no', name: 'carrot_no' },
            { data: 'unit', name: 'unit' },
            { data: 'outgoing', name: 'outgoing' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        "language": {
            "info": "_START_ to _END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        },

    });

    $('#machine_id, #part_id').on('change', function() {
        table.draw();
    });
});

</script>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script>

@endsection
