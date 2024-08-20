@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>Create Incoming Stock</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/incomingstock') }}">Incoming Stock</a></li>
            <li class="breadcrumb-item active textChng">Create Incoming Stock</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

        <div class="col-md-12">
        <form action="{{ url('/stockinventory/incomingstock') }}" method="post">
        @csrf
             @isset($incomingstock)
                @method('PUT')
                @endisset

                <h5 class="text-primary">Incoming Stock</h5>
            <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" name="date" value="" class="form-control">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Rack No.<span class="text-danger">*</span></label>
                        <select name="rack_no" class="form-control">
                            <option value="">Select Rack No.</option>
                            @foreach (getRack_no() as $rack)
                                <option value="{{ $rack }}">{{ $rack }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Carrot No.<span class="text-danger">*</span></label>
                        <input type="text" name="carrot_no" value="" class="form-control" placeholder="Enter Carrot No.">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Description<span class="text-danger">*</span></label>
                        <input type="text" name="description" value="" class="form-control" placeholder="Enter Description">
                    </div>
                </div>
            <div class="form-group row">
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label">Machine Name<span class="text-danger">*</span></label>
                    <select class="js-example-basic-single1 form-control" name="machine_id" id="machine_id">
                        <option value="">Select Machine</option>
                        @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">
                            {{ $machine->machine_name }} [{{ $machine->model_no }}]
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                    <select class="js-example-basic-single1 form-control" name="part_id" id="part_id">
                        <option value="">Select Part</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">DWG No.<span class="text-danger">*</span></label>
                        <input type="text" name="dwg_no" value="" class="form-control" placeholder="Enter DWG No.">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Quantity<span class="text-danger">*</span></label>
                        <input type="text" name="quantity" value="" class="form-control quantity" placeholder="Enter Quantity "disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Unit<span class="text-danger">*</span></label>
                        <input type="text" name="unit" value="" class="form-control unit" placeholder="Enter Unit">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Incoming<span class="text-danger">*</span></label>
                        <input type="text" name="incoming" value="" class="form-control" placeholder="Enter Incoming">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Stock In Hand<span class="text-danger">*</span></label>
                        <input type="text" name="stock_in_hand" value="" class="form-control" placeholder="Enter Stock In Hand" disabled>
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Minimum Stock Alert<span class="text-danger">*</span></label>
                        <input type="text" name="minimum_stock_alert" value="" class="form-control minimum_stock_alert" placeholder="Enter Minimum Stock Alert" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Purchasing Price<span class="text-danger">*</span></label>
                        <input type="text" name="purchasing_price" value="" class="form-control buying_price" placeholder="Enter Purchasing Price">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Total Purchasing<span class="text-danger">*</span></label>
                        <input type="text" name="total_purchasing" value="" class="form-control" placeholder="Enter Total Purchasing">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="selling_price" value="" class="form-control selling_price" placeholder="Enter Selling Price">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Total Selling Price Unit<span class="text-danger">*</span></label>
                        <input type="text" name="total_selling_price" value="" class="form-control" placeholder="Enter Total Selling Price Unit">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Export Selling Price Unit<span class="text-danger">*</span></label>
                        <input type="text" name="export_selling_price" value="" class="form-control" placeholder="Enter Export Selling Price Unit">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Gea Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="gea_selling_price" value="" class="form-control gea_selling_price" placeholder="Enter Gea Selling Price">
                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label fw-bold">Dimension/Size</label>
                        <input type="text" name="dimension" value=""
                            class="form-control dimension" id="dimension" placeholder="Enter Your Dimension">
                    </div>
            <div class="text-center mt-4">
                <a href="/" class="btn btn-success">Back</a>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn">Save</button>
                </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {

    // Ensure jQuery and Select2 are initialized
    $('.js-example-basic-single1').select2();

    // AJAX setup
    $('#machine_id').on("change", function() {
        let selectedMachine = $(this).val();

        $.ajax({
            url: '{{ route("getIncomingstockDetails") }}',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                machineId: selectedMachine
            },
            success: function(response) {
                console.log("AJAX response:", response);
                $('#part_id').empty();
                $('#part_id').append('<option value="">Select Part</option>');
                if (response.length) {
                    response.forEach(function(spare) {
                        $('#part_id').append(
                            `<option value="${spare.id}"
                                    data-buying-price="${spare.buying_price}"
                                    data-gea-selling-price="${spare.gea_selling_price}"
                                    data-selling-price="${spare.selling_price}"
                                    data-unit="${spare.unit}"
                                    data-minimum_stock_alert="${spare.minimum_stock_alert}"
                                    data-quantity="${spare.quantity}"
                                    data-dimension="${spare.dimension}">
                                ${spare.description} [ ${spare.part_no} ]
                            </option>`
                        );
                    });
                } else {
                    console.warn("No parts found for the selected machine(s).");
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
            }
        });
    });

    $('#part_id').on("change", function() {
        let option = $(this).find('option:selected');
        let buying_price = option.data('buying-price');
        let gea_selling_price = option.data('gea-selling-price');
        let selling_price = option.data('selling-price');
        let unit = option.data('unit');
        let minimum_stock_alert = option.data('minimum_stock_alert');
        let quantity = option.data('quantity');
        let dimension = option.data('dimension');

        console.log("Part selected - Buying Price:", buying_price, "Gea Selling Price:", gea_selling_price, "Selling Price:", selling_price, "Unit:", unit, "minimum_stock_alert:", minimum_stock_alert, "quantity:", quantity);

        $('.buying_price').val(buying_price);
        $('.gea_selling_price').val(gea_selling_price);
        $('.selling_price').val(selling_price);
        $('.unit').val(unit);
        $('.minimum_stock_alert').val(minimum_stock_alert);
        $('.quantity').val(quantity);
        $('.dimension').val(dimension);
    });

    function updateStockInHand() {
        let quantity = parseFloat($('input[name="quantity"]').val()) || 0;
        let incoming = parseFloat($('input[name="incoming"]').val()) || 0;
        let outgoing = parseFloat($('input[name="outgoing"]').val()) || 0;
        let stockInHand = quantity + incoming - outgoing;

        console.log("Quantity:", quantity, "Incoming:", incoming, "Outgoing:", outgoing, "Stock In Hand:", stockInHand);

        $('input[name="stock_in_hand"]').val(stockInHand);
    }

    // Attach event listeners to inputs
    $('input[name="quantity"], input[name="incoming"], input[name="outgoing"]').on('input', function() {
        updateStockInHand();
    });


});
</script>


@endsection
