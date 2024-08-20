@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>Edit Incoming Stock</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/incomingstock') }}">Incoming Stock</a></li>
            <li class="breadcrumb-item active textChng">Edit Incoming Stock</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

        <div class="col-md-12">
            <form action="{{ url('/stockinventory/incomingstock/' . $incomingstock->id) }}" method="post">

                <!-- CSRF Token -->
                @csrf

                <!-- PUT method required for updates -->
                @method('PUT')

                <h5 class="text-primary">Incoming Stock</h5>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" name="date" value="{{ old('date', $incomingstock->date) }}" class="form-control">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Rack No.<span class="text-danger">*</span></label>
                        <select name="rack_no" class="form-control">
                            <option value="">Select Rack No.</option>
                            @foreach (getRack_no() as $rack)
                                <option value="{{ $rack }}" {{ old('rack_no', $incomingstock->rack_no) == $rack ? 'selected' : '' }}>
                                    {{ $rack }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Carrot No.<span class="text-danger">*</span></label>
                        <input type="text" name="carrot_no" value="{{ old('carrot_no', $incomingstock->carrot_no) }}" class="form-control" placeholder="Enter Carrot No.">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Description<span class="text-danger">*</span></label>
                        <input type="text" name="description" value="{{ old('description', $incomingstock->description) }}" class="form-control" placeholder="Enter Description">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Machine Name<span class="text-danger">*</span></label>
                        <select class="js-example-basic-single1 form-control" name="machine_id" id="machine_id">
                            <option value="">Select Machine</option>
                            @foreach($machines as $machine)
                            <option value="{{ $machine->id }}" {{ old('machine_id', $incomingstock->machine_id) == $machine->id ? 'selected' : '' }}>
                                {{ $machine->machine_name }} [{{ $machine->model_no }}]
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                        <select class="js-example-basic-single1 form-control" name="part_id" id="part_id">
                            <option value="">Select Part</option>
                            @foreach($spares as $spare)
                            <option value="{{ $spare->id }}" {{ old('part_id', $incomingstock->part_id) == $spare->id ? 'selected' : '' }}>
                                {{ $spare->description }} [{{ $spare->part_no }}]
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">DWG No.<span class="text-danger">*</span></label>
                        <input type="text" name="dwg_no" value="{{ old('dwg_no', $incomingstock->dwg_no) }}" class="form-control" placeholder="Enter DWG No.">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Quantity<span class="text-danger">*</span></label>
                        <input type="text" name="quantity" value="{{ old('quantity', $incomingstock->quantity) }}" class="form-control" placeholder="Enter Quantity">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Unit<span class="text-danger">*</span></label>
                        <input type="text" name="unit" value="{{ old('unit', $incomingstock->unit) }}" class="form-control unit" placeholder="Enter Unit">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Incoming<span class="text-danger">*</span></label>
                        <input type="text" name="incoming" value="{{ old('incoming', $incomingstock->incoming) }}" class="form-control" placeholder="Enter Incoming">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Stock In Hand<span class="text-danger">*</span></label>
                        <input type="text" name="stock_in_hand" value="{{ old('stock_in_hand', $incomingstock->stock_in_hand) }}" class="form-control" placeholder="Enter Stock In Hand">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Minimum Stock Alert<span class="text-danger">*</span></label>
                        <input type="text" name="minimum_stock_alert" value="{{ old('minimum_stock_alert', $incomingstock->minimum_stock_alert) }}" class="form-control" placeholder="Enter Minimum Stock Alert">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Purchasing Price<span class="text-danger">*</span></label>
                        <input type="text" name="purchasing_price" value="{{ old('purchasing_price', $incomingstock->purchasing_price) }}" class="form-control buying_price" placeholder="Enter Purchasing Price">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Total Purchasing<span class="text-danger">*</span></label>
                        <input type="text" name="total_purchasing" value="{{ old('total_purchasing', $incomingstock->total_purchasing) }}" class="form-control" placeholder="Enter Total Purchasing">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="selling_price" value="{{ old('selling_price', $incomingstock->selling_price) }}" class="form-control selling_price" placeholder="Enter Selling Price">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Total Selling Price Unit<span class="text-danger">*</span></label>
                        <input type="text" name="total_selling_price" value="{{ old('total_selling_price', $incomingstock->total_selling_price) }}" class="form-control" placeholder="Enter Total Selling Price Unit">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Export Selling Price Unit<span class="text-danger">*</span></label>
                        <input type="text" name="export_selling_price" value="{{ old('export_selling_price', $incomingstock->export_selling_price) }}" class="form-control" placeholder="Enter Export Selling Price Unit">
                    </div>

                    <div class="col-sm-6 fw-bold">
                        <label class="col-form-label">Gea Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="gea_selling_price" value="{{ old('gea_selling_price', $incomingstock->gea_selling_price) }}" class="form-control gea_selling_price" placeholder="Enter Gea Selling Price">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="/" class="btn btn-success">Back</a>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn">Update</button>
                </div>
            </form>
        </div>
    </div>



@endsection
