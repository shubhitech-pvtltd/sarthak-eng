@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="clearfix">
        <div class="pull-left">
            <h2>Customer Price</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Customer Price</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4>Customer Price</h4>
            </div>
            <div class="pull-right">
                <a href="{{ route('customerprice.create') }}" class="btn btn-primary">Add Customer Price</a>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Machine Name<span class="text-danger">*</span></label>
                <select class="form-control js-example-basic-single1" id="filter_machine_id" name="machine_id">
                    <option value="">Select Machine</option>
                    @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}">{{ $machine->machine_name }} [{{ $machine->model_no }}]</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">List Of Customer<span class="text-danger">*</span></label>
                <select class="form-control" id="filter_customer_id" name="customer_id">
                    <option value="">Select Customer</option>
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table id="customerprice-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Part No.</th>
                        <th>Customer Name</th>
                        <th>Machine Name</th>
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
        $('.js-example-basic-single1').select2();

        var table = $('#customerprice-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{!! route('customerprice.data') !!}",
                data: function (d) {
                    d.machine_id = $('#filter_machine_id').val();
                    d.customer_id = $('#filter_customer_id').val();
                }
            },
            columns: [
                { data: 'part_no', name: 'part_no' }, 
                { data: 'company_name', name: 'customer_name' },
                { data: 'machine_name', name: 'machine_name' },            
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            }
        });

        $('#filter_machine_id').change(function() {
            let selectedMachine = $(this).val();

            $.ajax({
                url: '{{ route("getMachineDetails") }}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    machineIds: selectedMachine
                },
                success: function(response) {
                    $('#filter_part_id').empty();
                    $('#filter_part_id').append('<option value="">Select Part</option>');
                    if (response.length) {
                        response.forEach(function(part) {
                            $('#filter_part_id').append(
                                '<option value="' + part.id + '">' + part.description + ' [' + part.part_no + ']</option>'
                            );
                        });
                    } else {
                        console.warn("No parts found for the selected machine.");
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
            table.draw();
        });

        $('#filter_part_id, #filter_customer_id').change(function() {
            table.draw();
        });
    });
</script>
@endsection
