@extends('layout.main')

    
@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Clients</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/client/create')}}" class="btn btn-primary">Add client</a>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Company Name </th>
                        <th>Owner Name</th>
                        <th>Company Email</th>
                        <th>Owner Mobile No</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>


<script>
       
       $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('/client/data') !!}',
                columns: [
                    { data: 'company_name', name: 'company_name' },
                    { data: 'owner_name', name: 'owner_name' },
                    { data: 'company_email', name: 'company_email' },
                    { data: 'owner_phone_no', name: 'owner_phone_no' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
        });
        
</script>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script> {{-- Custom sweet alert code --}}

@endsection
