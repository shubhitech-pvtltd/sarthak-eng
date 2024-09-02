@extends('layout.main')

@section('main-section')
<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h3 class="text-blue">Bulk Upload - Incoming Stock</h3>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/stockinventory/incomingstock') }}">Incoming Stock</a></li>
            <li class="breadcrumb-item">Bulk Upload</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{ url('/stockinventory/incomingstock/bulkupload/submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h5 class="text-primary">Upload CSV</h5>
            <div class="form-body">
                <hr>
                <div class="row">
                    <div class="row col-md-12">
                        <h6 class="m-2">CSV File 
                            <a class="text-primary" href="{{ url('csvfiles/incomingstocksample2.xlsx') }}" download="">Download Sample</a>
                        </h6>
                        <div class="form-group col-sm-6">
                            <input type="file" class="form-control" name="stock_bulk_csv" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Upload CSV</button>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h5 class="text-primary mb-2">Field Evaluation</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Required</th>
                                        <th>Value</th>
                                        <th>Default</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Date <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Date (Y-m-d)</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Part ID. <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Machine ID <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Rack <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Carrot No <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Quantity <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Integer</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Incoming <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Integer</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Stock In Hand <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Integer</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Minimum Stock Alert <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Integer</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Unit <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Purchasing Price <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Decimal</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Total Purchasing <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Decimal</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Selling Price <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Decimal</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Total Selling Price <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Decimal</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Export Selling Price</td>
                                        <td>No</td>
                                        <td>Decimal</td>
                                        <td>Null</td>
                                    </tr>
                                    <tr>
                                        <td>GEA Selling Price</td>
                                        <td>No</td>
                                        <td>Decimal</td>
                                        <td>Null</td>
                                    </tr>
                                    <tr>
                                        <td>Description <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>DWG No <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Dimension</td>
                                        <td>No</td>
                                        <td>String</td>
                                        <td>Null</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
