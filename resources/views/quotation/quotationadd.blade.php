@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/quotation') }}">Quotation</a></li>
            <li class="breadcrumb-item">Quotation Add</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{ url('/quotation') }}" method="post">
            @csrf
            <h5 class="text-primary">Quotation</h5>
            <div class="form-group row">
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title">
                </div>
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Quotation Date<span class="text-danger">*</span></label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-control">
                </div>
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Quotation Total<span class="text-danger"></span></label>
                    <input type="text" name="grand_total" value="{{ old('grand_total') }}" id="grand_total"
                        class="form-control" readonly placeholder="Quotation Total">
                </div>
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label fw-bold">Machine Name<span class="text-danger">*</span></label>
                    <select class="form-control" id="machine_id" name="machine_id">
                        <option value="">Select Machine</option>
                        @foreach ($machines as $machine)
                        <option value="{{ $machine->id }}">{{$machine->machine_name}} [ {{  $machine->model_no}} ]
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label">Description<span class="text-danger">*</span></label>
                    <input type="text" name="description" value="{{ old('description') }}" class="form-control"
                        placeholder="Description">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">List Of Customer<span class="text-danger">*</span></label>
                    <select class="form-control" id="customer_id" name="customer_id">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $client)
                        <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Owner Name<span class="text-danger">*</span></label>
                    <input type="text" name="owner_name[]" value="" class="form-control owner_name"
                        placeholder="Owner Name" disabled>
                </div>
                <div class="col-sm-3 fw-bold">
                    <label class="col-form-label">GST Number<span class="text-danger">*</span></label>
                    <input type="text" name="company_gst_no[]" value="" class="form-control company_gst_no"
                        placeholder="GST No." disabled>
                </div>
                <div class="col-sm-1 d-flex align-items-end justify-content-end">
                    <a class="btn btn-primary text-white" id="add_btn">Add <i class="fas fa-plus attractive"></i></a>
                </div>
            </div>
            <div class="customeritem" id="customeritems">
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


    let customerWiseForm = `
        <div class="form-group row border p-3 mb-3 bg-light rounded customer-wise-form">
            <div class="row">
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                    <select class="form-control part_id" name="part_id[]">
                        <option value="">Select Part</option>
                    </select>
                </div>
            
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                    <input type="text" name="buying_price[]" value="" class="form-control buying_price"
                        placeholder="Buying Price" disabled>
                </div>

                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Selling Price<span class="text-danger">*</span></label>
                    <input type="text" name="price[]" class="form-control price" placeholder="Selling Price">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Quantity<span class="text-danger">*</span></label>
                    <input type="text" name="quantity[]" class="form-control" placeholder="Quantity">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Discount Price<span class="text-danger">*</span></label>
                    <input type="text" name="discount[]" class="form-control discount" placeholder="Discount Price">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Discount %<span class="text-danger">*</span></label>
                    <input type="text" name="discount_percent[]" class="form-control discount_percent" placeholder="Discount Percent">
                </div>

                 <div class="col-sm-10">
                    <label class="col-form-label fw-bold">Total<span class="text-danger">*</span></label>
                    <input type="text" name="total[]" class="form-control total" placeholder="Total" readonly oninput="calculateGrandTotal()">
                </div>
                <div class="col-sm-2 mb-1 d-flex align-items-end">
                    <a class="btn btn-danger text-white deleteBtn">
                        Delete <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
        </div>`;

    $('#add_btn').click(function() {
        $('#customeritems').append(customerWiseForm);
        $('.deleteBtn').show();
    });

    $(document).on('click', '.deleteBtn', function() {
        $(this).closest('.customer-wise-form').remove();
    });

    $(document).on('change', '#machine_id', function() {
    var selectedMachineId = $(this).val();
    var partSelect = $('.customer-wise-form').find('.part_id');
    partSelect.empty();
    partSelect.append('<option value="">Select Part</option>');
    if (selectedMachineId) {
        $.ajax({
            url: '{{ route("getMachineDetails") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                machineId: [selectedMachineId]
            },
            success: function(response) {
                if (response.length) {
                    response.forEach(function(part) {
                        partSelect.append(
                            '<option value="' + part.id + '">' + part.description + ' [' + part.part_no + ']</option>'
                        );
                    });
                  
                    customerWiseForm = generateCustomerWiseForm(response);
                } else {
                    console.warn("No parts found for the selected machine.");
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
            }
        });
    }
});

function generateCustomerWiseForm(parts) {
    var options = parts.map(function(part) {
        return '<option value="' + part.id + '">' + part.description + ' [' + part.part_no + ']</option>';
    }).join('');

    return `
        <div class="form-group row border p-3 mb-3 bg-light rounded customer-wise-form">
            <div class="row">
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                    <select class="form-control part_id" name="part_id[]">
                        <option value="">Select Part</option>
                        ${options}
                    </select>
                </div>
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                    <input type="text" name="buying_price[]" value="" class="form-control buying_price"
                        placeholder="Buying Price" disabled>
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Selling Price<span class="text-danger">*</span></label>
                    <input type="text" name="price[]" class="form-control price" placeholder="Selling Price">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Quantity<span class="text-danger">*</span></label>
                    <input type="text" name="quantity[]" class="form-control" placeholder="Quantity">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Discount Price<span class="text-danger">*</span></label>
                    <input type="text" name="discount[]" class="form-control discount" placeholder="Discount Price">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Discount %<span class="text-danger">*</span></label>
                    <input type="text" name="discount_percent[]" class="form-control discount_percent" placeholder="Discount Percent">
                </div>
                <div class="col-sm-10">
                    <label class="col-form-label fw-bold">Total<span class="text-danger">*</span></label>
                    <input type="text" name="total[]" class="form-control total" placeholder="Total" readonly oninput="calculateGrandTotal()">
                </div>

                <input type="hidden" name="unit[]" class="form-control unit">

                <div class="col-sm-2 mb-1 d-flex align-items-end">
                    <a class="btn btn-danger text-white deleteBtn">
                        Delete <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
        </div>`;
}

    $('#customer_id').on('change', function() {
        var customer_id = $(this).val();
        var form = $(this).closest('.form-group');
        $('#customeritems').html('');

        if (customer_id) {
            $.ajax({
                url: '{{ route("get-customerlist-details") }}',
                type: 'GET',
                data: {
                    customer_id: customer_id
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        form.find('.owner_name').val(response.owner_name);
                        form.find('.company_gst_no').val(response.company_gst_no);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status, error);
                }
            });
        } else {
            form.find('.owner_name').val('');
            form.find('.company_gst_no').val('');
        }
    });

    $(document).on('change', '.part_id', function() {
        var part_id = $(this).val();
        var customer_id = $('#customer_id').val();
        var form = $(this).closest('.customer-wise-form');

        if (customer_id) {
            $.ajax({
                url: '{{ route("getCustomerprice") }}',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    customer_id,
                    part_id
                },
                success: function(response) {
                    console.log(response);
                    form.find('.buying_price').val(response.buying_price);
                    form.find('.price').val(response.price);
                    form.find('.discount').val(response.discount);
                    form.find('.discount_percent').val(response.discount_percent);
                    form.find('.unit').val(response.unit);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }
    });
});

function calculateGrandTotal() {
    let grandTotal = 0;

    $('input[name="total[]"]').each(function() {
        let totalVal = parseFloat($(this).val()) || 0;
        grandTotal += totalVal;
    });
    $('#grand_total').val(grandTotal);
}

function calculateTotal(row) {
    let quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
    let price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
    let discountPrice = parseFloat(row.find('input[name="discount[]"]').val()) || 0;

    let total = (price - discountPrice) * quantity;
    row.find('input[name="total[]"]').val(total.toFixed(2)).trigger('input');
}

function updateDiscountFromPercent(row) {
    let price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
    let discountPercent = parseFloat(row.find('input[name="discount_percent[]"]').val()) || 0;

    let discountPrice = (price * discountPercent) / 100;
    row.find('input[name="discount[]"]').val(discountPrice.toFixed(2));

    calculateTotal(row);
}

function updatePercentFromDiscount(row) {
    let price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
    let discountPrice = parseFloat(row.find('input[name="discount[]"]').val()) || 0;

    if (price !== 0) {
        let discountPercent = (discountPrice / price) * 100;
        row.find('input[name="discount_percent[]"]').val(discountPercent.toFixed(2));
    } else {
        row.find('input[name="discount_percent[]"]').val('');
    }

    calculateTotal(row);
}

$(document).on('input', 'input[name="quantity[]"], input[name="price[]"]', function() {
    let row = $(this).closest('.customer-wise-form');
    updateDiscountFromPercent(row);
});

$(document).on('input', 'input[name="discount_percent[]"]', function() {
    let row = $(this).closest('.customer-wise-form');
    updateDiscountFromPercent(row);
});

$(document).on('input', 'input[name="discount[]"]', function() {
    let row = $(this).closest('.customer-wise-form');
    updatePercentFromDiscount(row);
});

$('.customer-wise-form').each(function() {
    calculateTotal($(this));
});
</script>
@endsection