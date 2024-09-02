@extends('layout.main')

@section('main-section')
<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h3 class="text-blue">Bulk Upload - Spares</h3>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/spare') }}">Spares</a></li>
            <li class="breadcrumb-item">Bulk Upload</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{ url('/spare/bulkupload/submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h5 class="text-primary">Upload CSV</h5>
            <div class="form-body">
                <hr>
                <div class="row">
                    <div class="row col-md-12">
                        <h6 class="m-2">CSV File 
                            <a class="text-primary" href="{{ url('csvfiles/sparesample.csv') }}" download="">Download Sample</a>
                        </h6>
                        <div class="form-group col-sm-6">
                            <input type="file" class="form-control" name="spare_bulk_csv" required>
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
                                        <td>Machine ID <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Part No <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Description <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Purchase From <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Buying Price <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Numeric</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Selling Price <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Numeric</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Drawing Upload</td>
                                        <td>No</td>
                                        <td>File (JPEG, PNG, JPG, WebP)</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>GEA Selling Price <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>Numeric</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Unit <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>HSN Code <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td>No</td>
                                        <td>String</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Dimension <span class="text-danger">*</span></td>
                                        <td>Yes</td>
                                        <td>String</td>
                                        <td>N/A</td>
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
