@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{ isset($spare) ? "Edit" : "Create" }} Spare</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/spare')}}">Spare</a></li>
            <li class="breadcrumb-item active textChng">{{ isset($spare) ? "Edit" : "Create" }} Spare</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <div class="col-md-12">
            <form action="{{ isset($spare) ? url('/spare/' . $spare->id) : url('/spare') }}" method="post"
                enctype="multipart/form-data" name="spareForm">

                <!-- CSRF Token -->
                @csrf

                {{-- Method PUT for Update --}}
                @isset($spare)
                @method('PUT')
                @endisset

                <h5 class="text-primary">Machine Name</h5>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Machine Name<span class="text-danger"></span></label>
                        <select class="js-example-basic-single1  form-control" name="machine_id">
                            <option value="">Select Machine</option>
                            @foreach($machines as $machine)
                            <option value="{{ $machine->id }}" @if(isset($spare->machine_id) && $spare->machine_id ==
                                $machine->id) selected @endif>
                                {{ $machine->machine_name }} [{{ $machine->model_no }}]
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                        <input type="text" name="part_no" value="{{ isset($spare) ? $spare->part_no : '' }}"
                            class="form-control" id="part_no" placeholder="Enter Your Part No.">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="description" class="col-form-label fw-bold">Part Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                            placeholder="Enter Your Part Description"
                            value="{{ isset($spare) ? $spare->description : '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 fw-bold">
                        <label for="purchase_from" class="col-form-label">Purchase From</label>
                        <select class="js-example-basic-single1 form-control" name="purchase_from" id="purchase_from">
                            <option value="">Purchase From</option>
                            @foreach(getBuyersName() as $buyer)
                            <option value="{{ $buyer->buyer_name }}"
                                {{ isset($spare) && $spare->purchase_from == $buyer->buyer_name ? 'selected' : '' }}>
                                {{ $buyer->buyer_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-1 d-flex align-items-end justify-content-end">
                         <a class="btn btn-primary text-white" id="add_btn">Add <i class="fas fa-plus attractive"></i></a>
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label for="buying_price" class="col-form-label">Buying Price<span
                                class="text-danger">*</span></label>
                        <input type="text" name="buying_price" value="{{ isset($spare) ? $spare->buying_price : '' }}"
                            class="form-control" id="buying_price" placeholder="Enter Your Buying Price">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="selling_price" value="{{ isset($spare) ? $spare->selling_price : '' }}"
                            class="form-control" id="selling_price" placeholder="Enter Your Selling Price">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Gea Selling Price</label>
                        <input type="text" name="gea_selling_price"
                            value="{{ isset($spare) ? $spare->gea_selling_price : '' }}" class="form-control"
                            id="gea_selling_price" placeholder="Enter Your Gea Selling Price">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Unit<span class="text-danger">*</span></label>
                        <input type="text" name="unit" value="{{ isset($spare) ? $spare->unit : '' }}"
                            class="form-control" id="unit" placeholder="Enter Your Unit">
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">HSN Code<span class="text-danger">*</span></label>
                        <input type="text" name="hsn_code" value="{{ isset($spare) ? $spare->hsn_code : '' }}"
                            class="form-control" id="hsn_code" placeholder="Enter Your HSN Code">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Dimension/Size</label>
                        <input type="text" name="dimension" value="{{ isset($spare) ? $spare->dimension : '' }}"
                            class="form-control" id="dimension" placeholder="Enter Your Dimension">
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label fw-bold">Drawing Upload</label>
                        @if(isset($spare) && !empty($spare->drawing_upload))
                        <!-- Eye icon for triggering the modal -->
                        <a href="#" data-toggle="modal" data-target="#drawingModal">
                            <i class="fas fa-eye"></i>
                        </a>
                        <div class="modal fade" id="drawingModal" tabindex="-1" role="dialog"
                            aria-labelledby="drawingModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="drawingModalLabel">Drawing Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/images/upload/sparedrawing/' . $spare->drawing_upload) }}"
                                            alt="Drawing Image" class="img-fluid">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <input type="file" name="drawing_upload"
                            value="{{ isset($spare) ? $spare->drawing_upload : '' }}" class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="col-form-label fw-bold">Comment</label>
                        <textarea class="form-control" name="comment"
                            placeholder="Comment">{{ isset($spare) ? $spare->comment : '' }}</textarea>
                    </div>
                </div>

                <div class="form-group text-center">
                    <a href="/" class="btn btn-success">Back</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addBuyerModal" tabindex="-1" aria-labelledby="addBuyerModalLabel" aria-hidden="true">
    <form action="{{ url('/buyer/add')}}"  method="post" name="buyerForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBuyerModalLabel">Add New Buyer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 fw-bold">
                            <label for="buyer_name" class="form-label">Buyer Name</label>
                            <input type="text" class="form-control" id="buyer_name" name="buyer_name" required>
                        </div>
                        <div class="col-sm-6 fw-bold">
                            <label for="buyer_email" class="form-label">Buyer Email</label>
                            <input type="email" class="form-control" id="buyer_email" name="buyer_email" required>
                        </div>
                        <div class="col-sm-6 fw-bold">
                            <label for="buyer_phone_no" class="form-label">Buyer Phone</label>
                            <input type="text" class="form-control" id="buyer_phone_no" name="buyer_phone_no" required>
                        </div>
                        <div class="col-sm-6 fw-bold">
                            <label for="buyer_address" class="form-label">Buyer Address</label>
                            <input type="text" class="form-control" id="buyer_address" name="buyer_address" required>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
    </form>
</div>


<script>
$(document).ready(function() {

    $('.js-example-basic-single1').select2();


    $('#add_btn').click(function() {
        $('#addBuyerModal').modal('show');
    });

});
</script>

@endsection
