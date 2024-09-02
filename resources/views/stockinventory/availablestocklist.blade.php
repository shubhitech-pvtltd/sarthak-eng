@extends('layout.main')

@section('main-section')
<div class="main-container mt-5 ml-4">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h3 class="text-blue">Available Stock</h3>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Machine Model<span class="text-danger">*</span></label>
                <select class="js-example-basic-single1 form-control" name="machine_id" id="machine_id">
                    <option value="">Select Machine</option>
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->model_no }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="minimum_stock_alert" value="{{ old('minimum_stock_alert') }}">
            <div class="col-sm-4 fw-bold">
                <label class="col-form-label">Part No.<span class="text-danger">*</span></label>
                <select class="js-example-basic-single1 form-control" name="part_id" id="part_id">
                    <option value="">Select Part</option>
                    @foreach($spares as $spare)
                        <option value="{{ $spare->id }}">{{ $spare->part_no }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <table class="data-table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Part No.</th>
                        <th>Machine Model</th>
                        <th>Available Quantity</th>
                        <th>Minimum Stock Alert</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{!! url('/availablestock/data') !!}",
                data: function (d) {
                    d.machine_id = $('#machine_id').val();
                    d.part_id = $('#part_id').val();
                }
            },
            columns: [
                {
                    data: 'created_at',
                    name: 'availablestocks.created_at',
                    render: function (data) {
                        if (data) {
                            var date = new Date(data);
                            var day = ("0" + date.getDate()).slice(-2);
                            var month = ("0" + (date.getMonth() + 1)).slice(-2);
                            var year = date.getFullYear().toString().slice(-2);
                            return day + '/' + month + '/' + year;
                        }
                        return data;
                    }
                },
                { data: 'part_no', name: 'spares.part_no' },
                { data: 'machine_model', name: 'machines.model_no' },
                { data: 'quantity', name: 'availablestocks.quantity' },
                {
                    data: 'minimum_stock_alert',
                    name: 'spares.minimum_stock_alert',
                    render: function (data, type, row) {
                        return `<span class="min-stock-alert" data-id="${row.id}">${data}</span>`;
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return '<button class="btn btn-sm btn-primary edit-alert" data-id="' + data + '">Update</button>';
                    },
                    orderable: false,
                    searchable: false
                }
            ],
            rowCallback: function (row, data) {
                var availableQuantity = data.quantity;

                $(row).find('td').removeClass('low-quantity alert-yellow');

                if (availableQuantity <= 3) {
                    $(row).find('td:eq(3)').addClass('low-quantity');
                }

            },
            "language": {
                "info": "_START_ to _END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
        });

        $('#machine_id, #part_id').change(function () {
            table.draw();
        });

        $(document).on('click', '.edit-alert', function () {
            var id = $(this).data('id');
            var button = $(this);
            var minStockAlertSpan = button.closest('tr').find('.min-stock-alert');
            var currentAlert = minStockAlertSpan.text();

            if (button.text() === 'Update') {
                var input = $('<input>', {
                    type: 'number',
                    class: 'form-control',
                    value: currentAlert,
                    min: 0
                });

                minStockAlertSpan.replaceWith(input);
                button.text('Save');

                input.focus();

                input.on('blur', function () {
                    var newAlert = $(this).val();
                    if (newAlert !== currentAlert) {
                        $.ajax({
                            url: '/availablestock/update-alert/' + id,
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                minimum_stock_alert: newAlert
                            },
                            success: function (response) {
                                if (response.success) {
                                    input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${newAlert}</span>`);
                                } else {
                                    input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${currentAlert}</span>`);
                                }
                                button.text('Update');
                            },
                            error: function () {
                                input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${currentAlert}</span>`);
                                button.text('Update');
                            }
                        });
                    } else {
                        input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${currentAlert}</span>`);
                        button.text('Update');
                    }
                });
            } else if (button.text() === 'Save') {
                var input = button.closest('tr').find('input.form-control');
                var newAlert = input.val();

                if (newAlert !== currentAlert) {
                    $.ajax({
                        url: '/availablestock/update-alert/' + id,
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            minimum_stock_alert: newAlert
                        },
                        success: function (response) {
                            if (response.success) {
                                input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${newAlert}</span>`);
                            } else {
                                input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${currentAlert}</span>`);
                            }
                            button.text('Update');
                        },
                        error: function () {
                            input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${currentAlert}</span>`);
                            button.text('Update');
                        }
                    });

                } else {
                    input.replaceWith(`<span class="min-stock-alert" data-id="${id}">${currentAlert}</span>`);
                    button.text('Update');
                }
            }
        });
    });
</script>

<style>
    .low-quantity {
        background-color: red !important;
    }

    .alert-yellow {
        background-color: yellow !important;
    }
</style>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
<script src="{{ asset('vendor/sweetalert2/sweet-alert.init.js') }}"></script>

@endsection
