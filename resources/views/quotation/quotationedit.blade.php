@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/quotation') }}">Quotation</a></li>
            <li class="breadcrumb-item">Quotation Edit</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{ url('quotation/'.$quotation->id) }}" method="post" id="editQuotationForm">
            @csrf
            @method('PUT')
            <h5 class="text-primary">Edit Quotation</h5>

            {{-- Hidden Fields --}}
            <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">

            <div class="form-group row">
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $quotation->title) }}" class="form-control" placeholder="Title">
                </div>
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Quotation Date<span class="text-danger">*</span></label>
                    <input type="date" name="date" value="{{ old('date', $quotation->date) }}" class="form-control">
                </div>
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Quotation Total<span class="text-danger"></span></label>
                    <input type="text" name="grand_total" value="{{ old('grand_total', $quotation->grand_total) }}" id="grand_total" class="form-control" readonly placeholder="Quotation Total">
                </div>

                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label fw-bold">Machine Name<span class="text-danger">*</span></label>
                    <input type="hidden" name="machine_id" value="{{$machine->id}}">
                    <input type="text" class="form-control" readonly value="{{$machine->machine_name}} [ {{ $machine->model_no }}">
                </div>
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label">Description<span class="text-danger">*</span></label>
                    <input type="text" name="description" value="{{ old('description', $quotation->description) }}" class="form-control" placeholder="Description">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">List Of Customer<span class="text-danger">*</span></label>
                    <select class="form-control" id="customer_id" name="customer_id">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $client)
                        <option value="{{ $client->id }}" {{ $client->id == old('customer_id', $quotation->customer_id) ? 'selected' : '' }}>{{ $client->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Owner Name<span class="text-danger">*</span></label>
                    <input type="text" name="owner_name[]" value="{{ old('owner_name', $quotation->client->owner_name) }}" class="form-control owner_name" placeholder="Owner Name" disabled>
                </div>

                <div class="col-sm-3 fw-bold">
                    <label class="col-form-label">GST Number<span class="text-danger">*</span></label>
                    <input type="text" name="company_gst_no[]" value="{{ old('company_gst_no', $quotation->client->company_gst_no) }}" class="form-control company_gst_no" placeholder="GST No." disabled>
                </div>

                <div class="col-sm-1 d-flex align-items-end justify-content-end">
                    <a class="btn btn-primary text-white" id="add_btn">Add <i class="fas fa-plus attractive"></i></a>
                </div>
            </div>

            <div class="customeritem" id="customeritems">
                @foreach($quotation->quotationlists as $list)
                <div class="form-group row border p-3 mb-3 bg-light rounded customer-wise-form">
                    <input type="hidden" name="quotationlist_id[]" value="{{ $list->id }}">
                   
                    <div class="col-sm-4">
                        <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                        <select class="form-control part_id" name="part_id[]" onchange="getPartDetails(this)">
                            <option value="">Select Part</option>
                            @foreach ($parts as $part)
                            <option value="{{ $part->id }}" {{ $part->id == $list->part_id ? 'selected' : '' }}>
                                {{ $part->description }} [{{ $part->part_no }}]
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4 fw-bold">
                        <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                        <input type="text" name="buying_price[]" value="{{ $list->buying_price }}" class="form-control buying_price" placeholder="Buying Price" disabled>
                    </div>

                    <div class="col-sm-4">
                        <label class="col-form-label fw-bold">Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="price[]" value="{{ $list->price }}" class="form-control price" placeholder="Selling Price">
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label fw-bold">Quantity<span class="text-danger">*</span></label>
                        <input type="text" name="quantity[]" value="{{ $list->quantity }}" class="form-control" placeholder="Quantity">
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label fw-bold">Discount Price<span class="text-danger">*</span></label>
                        <input type="text" name="discount[]" value="{{ $list->discount }}" class="form-control discount" placeholder="Discount Price">
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label fw-bold">Discount %<span class="text-danger">*</span></label>
                        <input type="text" name="discount_percent[]" value="{{ $list->discount_percent }}" class="form-control discount_percent" placeholder="Discount Percent">
                    </div>
                    <div class="col-sm-10">
                        <label class="col-form-label fw-bold">Total<span class="text-danger">*</span></label>
                        <input type="text" name="total[]" value="{{ $list->total }}" class="form-control total" placeholder="Total" readonly oninput="calculateGrandTotal()">
                    </div>

                    <input type="hidden" name="unit[]" value="{{ $list->unit }}" class="form-control unit">

                    <div class="col-sm-2 mb-1 d-flex align-items-end">
                        <a class="btn btn-danger text-white deleteBtn">
                            Delete <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>

                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/quotation') }}" class="btn btn-success">Back</a>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    
    getCustomerDetails();

    let customerWiseForm = `
        <div class="form-group row border p-3 mb-3 bg-light rounded customer-wise-form">
            <div class="row">
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                    <select class="form-control part_id" name="part_id[]" onchange="getPartDetails(this)">
                            <option value="">Select Part</option>
                            @foreach ($parts as $part)
                            <option value="{{ $part->id }}">
                                {{ $part->description }} [{{ $part->part_no }}]
                            </option>
                            @endforeach
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

    $('#add_btn').click(function() {
        $('#customeritems').append(customerWiseForm);
        $('.deleteBtn').show();
    });

    $(document).on('click', '.deleteBtn', function() {
        $(this).closest('.customer-wise-form').remove();
        calculateGrandTotal(); 
    });

});

$('#customer_id').on('change', function() {
    getCustomerDetails();
});

function getCustomerDetails() {
    var customer_id = $('#customer_id').val();
    var form = $('#customer_id').closest('.form-group');

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
}

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

                calculateTotal(form); 
            },
            error: function(xhr) {
                console.error('Error:', xhr);
            }
        });
    }
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
