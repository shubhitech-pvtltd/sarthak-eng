@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Machine</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/machine/create')}}" class="btn btn-primary">Add Machine</a>
                <a href="{{ url('/machine/bulkupload')}}" class="btn btn-primary">Bulk Upload</a>
                <button id="downloadExcelBtn" class="btn btn-success">Download Excel</button>
            </div>
        </div>
        <table id="machineTable" class="data-table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">ID Machine</th>
                    <th>Machine Name</th>
                    <th>Description</th>
                    <th>Model No</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
   $(document).ready(function () {
    var table = $('#machineTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('/machine/data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'machine_name', name: 'machine_name' },
            { data: 'description', name: 'description' },
            { data: 'model_no', name: 'model_no' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        language: {
            info: "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        }
    });

    $('#downloadExcelBtn').on('click', function () {
        // Clone the table to avoid modifying the original
        var clonedTable = $('#machineTable').clone();

        // Remove the "Action" column from the cloned table
        clonedTable.find('th:last-child, td:last-child').remove();

        // Convert the modified table to Excel
        var wb = XLSX.utils.table_to_book(clonedTable[0], { sheet: "Machine Data" });
        var sheet = wb.Sheets[Object.keys(wb.Sheets)[0]];

        // Adjust column widths (optional)
        sheet['!cols'] = [
            { wch: 15 },  // ID Machine
            { wch: 30 },  // Machine Name
            { wch: 50 },  // Description
            { wch: 20 }   // Model No
        ];

        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().split('T')[0];
        var filename = `MachineData-${formattedDate}.xlsx`;

        XLSX.writeFile(wb, filename);
    });

    });
</script>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script> 

@endsection
