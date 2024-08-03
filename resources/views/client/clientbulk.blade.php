@extends('layout.main')

@section('main-section')

<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h3 class="text-blue">Clients</h3>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ url('/quotation') }}">Client</a></li>
            <li class="breadcrumb-item">Bulk Upload</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">
        <form action="{{ url('/client/bulkupload/submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h5 class="text-primary">Bulk Upload</h5>
            <div class="form-body">
                <hr>
                <div class="row">
                    <div class="row col-md-12">
                        <h6 class="m-2"> CSV File <a class="text-primary" href="{{ url('csvfiles/clientsample.csv') }}" download="">Download Sample</a></h6>
                        <div class="form-group col-sm-6">
                            <input type="file" class="form-control" name="client_bulk_csv">
                        </div>
                        <div class="form-group col-sm-6">
                            <button type="submit" class="btn btn-info"><i
                                    class="fa fa-check"></i> Upload CSV</button>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h5 class="text-primary mb-2">Field Evaulation</h5>

                            <table class="table table-striped">
                                <tr>
                                    <th>Field Name</th>
                                    <th>Required</th>
                                    <th>Value</th>
                                    <th>Default</th>
                                </tr>
                                <tr>
                                    <td>owner_name <span class="text-danger">*</span></td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>owner_email</td>
                                    <td>No</td>
                                    <td>Email</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>owner_phone_no</td>
                                    <td>No</td>
                                    <td>Integer</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>owner_aadhar_no </td>
                                    <td>No</td>
                                    <td>Integer</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_name <span class="text-danger">*</span></td>
                                    <td>Yes</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_email </td>
                                    <td>No</td>
                                    <td>Email</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_phone_no</td>
                                    <td>No</td>
                                    <td>Integer</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_pan_no </td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_gst_no </td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_cin_no</td>
                                    <td>No</td>
                                    <td>String or Integer</td>
                                    <td>Null</td>
                                </tr>
                                <tr>
                                    <td>country</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_address_1</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>company_address_2</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>state</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>city</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>pincode</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>currency</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>bank_branch_name</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>bank_name</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>account_no</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>ifsc_no</td>
                                    <td>No</td>
                                    <td>String</td>
                                    <td>N/A</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection