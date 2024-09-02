@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Spare</h3>
            </div>
            <div class="pull-right">
                <a href="{{ url('/spare/create')}}" class="btn btn-primary">Add Spare</a>
                <a href="{{ url('/spare/bulkupload')}}" class="btn btn-primary">Bulk Upload</a>
                <button id="downloadExcelBtn" class="btn btn-success">Download Excel</button>
            </div>
        </div>
        <div class="row">
            <table id="spareTable" class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Part Id</th>
                        <th>Part No</th>
                        <th>Machine Id</th>
                        <th>Machine Name</th>
                        <th>Machine Model No</th>
                        <th>Part Description</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#spareTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('/spare/data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'part_no', name: 'part_no' },
                { data: 'machine_id', name: 'machine_id' },
                { data: 'machine_name', name: 'machine_name' },
                { data: 'model_no', name: 'model_no' },
                { data: 'description', name: 'description' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            language: {
                info: "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            }
        });

        $('#downloadExcelBtn').on('click', function () {
            // Clone the table to avoid modifying the original
            var clonedTable = $('#spareTable').clone();

            // Remove the "Action" column from the cloned table
            clonedTable.find('th:last-child, td:last-child').remove();

            // Convert the modified table to Excel
            var wb = XLSX.utils.table_to_book(clonedTable[0], { sheet: "Spare Data" });
            var sheet = wb.Sheets[Object.keys(wb.Sheets)[0]];

            // Adjust column widths (optional)
            sheet['!cols'] = [
                { wch: 10 },  // Part Id
                { wch: 20 },  // Part No
                { wch: 15 },  // Machine Id
                { wch: 30 },  // Machine Name
                { wch: 20 },  // Machine Model No
                { wch: 50 }   // Part Description
            ];

            var currentDate = new Date();
            var formattedDate = currentDate.toISOString().split('T')[0];
            var filename = `SpareData-${formattedDate}.xlsx`;

            XLSX.writeFile(wb, filename);
        });
    });
</script>

<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script> {{-- Custom sweet alert code --}}
@endsection
