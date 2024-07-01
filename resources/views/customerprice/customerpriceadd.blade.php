@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/customerprice')}}">Price</a></li>

            <li class="breadcrumb-item">Customer Price</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{  url('/customerprice') }}" method="post">
            @csrf
            <h5 class="text-primary">Customer Price</h5>
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

            <div class="form-group row" id="customer_wise_form">
                <input type="hidden" name="customerwiseprice_id[]" class="customerwiseprice_id">
                <div class="col-sm-2 fw-bold">
                    <label class="col-form-label">List Of Customer<span class="text-danger">*</span></label>
                    <select class="form-control customer_id" name="customer_id[]">
                        <option value="">Select Customer</option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->company_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2 fw-bold">
                    <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                    <input type="text" readonly value="" class="form-control buying_price" placeholder="Buying Price">
                </div>

                <div class="col-sm-2 fw-bold">
                    <label class="col-form-label">Selling Price<span class="text-danger">*</span></label>
                    <input type="text" name="price[]" class="form-control price" placeholder="Selling Price">
                </div>

                <div class="col-sm-2 fw-bold">
                    <label class="col-form-label">Discount<span class="text-danger">*</span></label>
                    <input type="text" name="discount[]" class="form-control discount" placeholder="Discount">
                </div>

                <div class="col-sm-2 fw-bold">
                    <label class="col-form-label">Discount %<span class="text-danger">*</span></label>
                    <input type="text" name="discount_percent[]" class="form-control discountpercent"
                        placeholder="Discount Percent">
                </div>

                <div class="pull-right col-sm-2 fw-bold d-flex align-items-end mb-2">
                    <a class="text-danger deleteBtn fs-5" style="display:none;">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>

            <div class="pull-left mt-4 text-white">
                <a class="btn btn-primary" id="add_btn">Add <i class="fas fa-plus attractive"></i></a>
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

    $('.js-example-basic-single1').select2();

    $('#machine_id').on("change", function() {
        let selectedMachine = $(this).val();

        $.ajax({
            url: '{{ route("getMachineDetails") }}',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                machineId: selectedMachine
            },
            success: function(response) {
                console.log(response)
                $('#part_id').empty();
                $('#part_id').append('<option value="">Select Part</option>');
                if (response.length) {
                    response.forEach(function(spare) {
                        $('#part_id').append(
                            `<option value="${spare.id}" data-buying-price="${spare.buying_price}">
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
        $('.buying_price').val(buying_price);
    });


    $('#add_btn').click(function() {
        let customer_wise_form = '<div class="form-group row">';
        customer_wise_form += $('#customer_wise_form').html();
        customer_wise_form += '</div>';

        $('#customer_wise_form').after(customer_wise_form);
        $('#customer_wise_form').next().find('.deleteBtn').show();

        let buying_price = $('#part_id').find('option:selected').data('buying-price');
        $('.buying_price').val(buying_price);
    });

    $(document).on('click', '.deleteBtn', function() {
        $(this).closest('.row').remove();
    });

    $(document).on('change', '.customer_id', function() {
        let selectedCustomers = $(this).val();
        let selectedPartIds = $('#part_id').val();
        let _this = $(this);

        $.ajax({
            url: '{{ route("get-customerlist-details") }}',
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                customerIds: selectedCustomers,
                partIds: selectedPartIds
            },
            success: function(response) {
                if (response.message === "No record found") {
                    console.warn(
                        "No record found for the selected customer and part combination."
                        );
                    let form = _this.closest('.form-group');
                    form.find('.price').val('');
                    form.find('.discount').val('');
                    form.find('.discountpercent').val('');
                    form.find('.currency').val('');
                    form.find('.customerwiseprice_id').val('');
                } else {
                    let form = _this.closest('.form-group');
                    form.find('.price').val(response.price);
                    form.find('.discount').val(response.discount);
                    form.find('.discountpercent').val(response.discount_percent);
                    form.find('.currency').val(response.currency);
                    form.find('.customerwiseprice_id').val(response.id);
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
            }
        });
    });
});
</script>
@endsection