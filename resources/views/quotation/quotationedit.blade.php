@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/quotation') }}">Quotation</a></li>
            <li class="breadcrumb-item">Edit Quotation</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{ route('quotation.update', $quotation->id) }}" method="post" id="editQuotationForm">
            @csrf
            @method('PUT')
            <h5 class="text-primary">Edit Quotation</h5> 

            {{-- Hidden Fields --}}
            <input type="hidden" name="quotation_id" value="{{ $quotation->id }}">

            <div class="form-group row">
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label">Title<span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $quotation->title) }}" class="form-control"
                        placeholder="Title">
                </div>
                <div class="col-sm-6 fw-bold">
                    <label class="col-form-label">Description<span class="text-danger">*</span></label>
                    <input type="text" name="description" value="{{ old('description', $quotation->description) }}"
                        class="form-control" placeholder="Description">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">List Of Customer<span class="text-danger">*</span></label>
                    <select class="form-control" id="customer_id" name="customer_id">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $client)
                        <option value="{{ $client->id }}"
                            {{ $client->id == old('customer_id', $quotation->customer_id) ? 'selected' : '' }}>
                            {{ $client->company_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 fw-bold">
                    <label class="col-form-label">Owner Name<span class="text-danger">*</span></label>
                    <input type="text" name="owner_name[]" value="{{ old('owner_name') }}"
                        class="form-control owner_name" placeholder="Owner Name" disabled>
                </div>

                <div class="col-sm-3 fw-bold">
                    <label class="col-form-label">GST Number<span class="text-danger">*</span></label>
                    <input type="text" name="company_gst_no[]" value="{{ old('company_gst_no') }}"
                        class="form-control company_gst_no" placeholder="GST No." disabled>
                </div>

                <div class="col-sm-1 d-flex align-items-end justify-content-end">
                    <a class="btn btn-primary text-white" id="add_btn">Add <i class="fas fa-plus attractive"></i></a>
                </div>
            </div>

            <div class="customeritem" id="customeritems">
                @foreach($quotation->quotationlists as $list)
                <div class="form-group row border p-3 mb-3 bg-light rounded customer-wise-form">
                    <!-- <div class="row"> -->
                        <input type="hidden" name="quotationlist_id[]" value="{{ $list->id }}">
                        <div class="col-sm-6">
                            <label class="col-form-label fw-bold">Machine Name<span class="text-danger">*</span></label>
                            <select class="form-control machine_id" name="machine_id[]">
                                <option value="">Select Machine</option>
                                @foreach ($machines as $machine)
                                <option value="{{ $machine->id }}"
                                    {{ $machine->id == $list->machine_id ? 'selected' : '' }}>
                                    {{ $machine->machine_name }} [{{ $machine->model_no }}]
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                            <select class="form-control part_id" name="part_id[]">
                                <option value="">Select Part</option>
                                @foreach ($parts as $part)
                                <option value="{{ $part->id }}" {{ $part->id == $list->part_id ? 'selected' : '' }}>
                                    {{$part->description }} [{{ $part->part_no }}]
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-3 fw-bold">
                            <label class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                            <input type="text" name="buying_price[]" value="{{ $list->buying_price }}" class="form-control buying_price"
                                placeholder="Buying Price" disabled>
                        </div>

                        <div class="col-sm-4">
                            <label class="col-form-label fw-bold">Selling Price<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="price[]" value="{{ $list->price }}" class="form-control price"
                                placeholder="Selling Price">
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label fw-bold">Quantity<span class="text-danger">*</span></label>
                            <input type="text" name="quantity[]" value="{{ $list->quantity }}" class="form-control"
                                placeholder="Quantity">
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label fw-bold">Discount Price<span class="text-danger">*</span></label>
                            <input type="text" name="discount[]" value="{{ $list->discount }}"
                                class="form-control discount" placeholder="Discount Price">
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label fw-bold">Discount %<span class="text-danger">*</span></label>
                            <input type="text" name="discount_percent[]" value="{{ $list->discount_percent }}"
                                class="form-control discount_percent" placeholder="Discount Percent">
                        </div>


                        <div class="col-sm-3">
                           <label class="col-form-label fw-bold">Total<span class="text-danger">*</span></label>
                           <input type="text" name="Total[]" class="form-control total" placeholder="Total" readonly>
                        </div>

                        
                        <div class="col-sm-4">
                            <label class="col-form-label fw-bold">Currency<span class="text-danger">*</span></label>
                            <select class="form-control currency" name="currency[]">
                                <option disabled>Select Currency</option>
                                @foreach (getCurrency() as $key => $value)
                                <option value="{{ $key }}" {{ $key == $list->currency ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 mb-1 d-flex align-items-end">
                            <a class="btn btn-danger text-white deleteBtn">
                                Delete <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    <!-- </div> -->
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/quotation') }}" class="btn btn-success">Back</a>
                <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
            </div>
        </form>
    </div>
</div>

@php
$machineOptions = [];
foreach ($machines as $machine) {
$machineOptions[$machine->id] = $machine->machine_name . ' [' . $machine->model_no . ']';
}
@endphp
<script>
$(document).ready(function() {

    getCustomerDetails();

    var customerWiseForm = `
        <div class="form-group row border p-3 mb-3 bg-light rounded customer-wise-form">
            <div class="row">
                <div class="col-sm-6">
                    <label class="col-form-label fw-bold">Machine Name<span class="text-danger">*</span></label>
                    <select class="form-control machine_id" name="machine_id[]">
                        <option value="">Select Machine</option>
                        @foreach ($machineOptions as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label fw-bold">Part No.<span class="text-danger">*</span></label>
                    <select class="form-control part_id" name="part_id">
                        <option value="">Select Part</option>
                    </select>
                </div>
                 <div class="col-sm-3">
                    <label class="col-form-label fw-bold">Buying Price<span class="text-danger">*</span></label>
                    <input type="text" name="buying_price[]" class="form-control buying_price" placeholder="Buying Price">
                </div>

                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Selling Price<span class="text-danger">*</span></label>
                    <input type="text" name="price[]" class="form-control price" placeholder="Selling Price" disabled>
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Quantity<span class="text-danger">*</span></label>
                    <input type="text" name="quantity[]" class="form-control" placeholder="Quantity">
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Discount Price<span class="text-danger">*</span></label>
                    <input type="text" name="discount[]" class="form-control discount" placeholder="Discount Price">
                </div>
                <div class="col-sm-3">
                    <label class="col-form-label fw-bold">Discount %<span class="text-danger">*</span></label>
                    <input type="text" name="discount_percent[]" class="form-control discount_percent" placeholder="Discount Percent">
                </div>

                <div class="col-sm-3">
                   <label class="col-form-label fw-bold">Total<span class="text-danger">*</span></label>
                   <input type="text" name="Total[]" class="form-control total" placeholder="Total" readonly>
                </div>


                <div class="col-sm-4">
                    <label class="col-form-label fw-bold">Currency<span class="text-danger">*</span></label>
                    <select class="form-control currency" name="currency[]">
                        <option disabled selected>Select Currency</option>
                        @foreach (getCurrency() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
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

    $(document).on('change', '.machine_id', function() {
        var selectedMachineId = $(this).val();
        var partSelect = $(this).closest('.row').find('.part_id');
        partSelect.empty();
        partSelect.append('<option value="">Select Part</option>');
        if (selectedMachineId) {
            $.ajax({
                url: '{{ route("getMachineDetails") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    machineIds: [selectedMachineId]
                },
                success: function(response) {
                    if (response.length) {
                        response.forEach(function(part) {
                            partSelect.append(
                                '<option value="' + part.id + '">' + part
                                .description + ' [' + part.part_no +
                                ']</option>'
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
        }
    });

    $('#customer_id').on('change', function() {
        getCustomerDetails();
    });

    function getCustomerDetails(){    
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
        var form = $(this).closest('.form-group');

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
                    form.find('.currency').val(response.currency);


                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }
    });


});
</script>


@endsection