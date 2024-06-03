@extends('layout.main')

@section('main-section')

<div class="main-container">
    <div class="mt-3 ml-3 border-bottom">
		<h1>Customer Information</h1>
				<p class="text-capitalize mt-4"><strong>Name : </strong> {{$user->name}}</p>
				<p><strong>Mobile : </strong>{{$user->mobile}}</p>
				<p class="text-capitalize"><strong>Address : </strong>{{$user->address}}</p>
				<p><strong>Opening Date : </strong>{{$user->created_at}}</p>
                <p><strong>Total Credit : </strong><span id="totalCredit"></span><strong> , Total Debit : </strong><span id="totalDebit"></span></p>
                <p><strong>Balance Amount : </strong><span id="totalBalance"></span></p>
                

    </div>
    <div class="bg-warning text-center py-2">
    	<h5>Add Transaction</h5>
    </div>

    <!-- Add Transaction Form -->
    <form action="javascript:void(0)" id="myForm">
        <input type="hidden" id="trans-id" value="">
	    <div class="row m-4">
		    	<div class="form-check col-md-6 col-sm-12">
					  <input value="credit" class="form-check-input" type="radio" checked name="amountType">
					  <label class="form-check-label">
					    Credit ( + )
					  </label>
	            </div>
	            <div class="form-check col-md-6 col-sm-12">
					  <input value="debit" class="form-check-input" type="radio" name="amountType">
					  <label class="form-check-label">
					    Debit ( - )
					  </label>
	            </div>
        </div>    
	    <div class="row m-2">    
				<div class="form-group col-md-6 col-sm-12">
						<input id="amount" type="text" class="form-control" name="credit" placeholder="Enter Amount" value="">
				</div>
				<div class="form-group col-md-6 col-sm-12">
						<input type="text" id="date" class="form-control datetimepicker" name="created_at" placeholder="Select date and time" value="">
				</div>
		</div>
		<div class="row mx-2 ">    
				<div class="form-group col-md-12">
						<input type="text" class="form-control" id="note" name="note" placeholder="Write Description" value="">
				</div>
		
		 <button type="submit" id="addBtn" class="btn btn-primary mb-2 ml-3">Add</button>
    </form>

    <!-- Table  Start -->

	<div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="pdf-content">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Date</th>
					<th scope="col">Cr.Amt</th>
					<th scope="col">Dbt.Amt</th>
					<th scope="col">Note</th>
                    <th scope="col">Action</th>
				</tr>
			</thead>
			<tbody id="transbody">
				
			</tbody>
 		</table>

    <a href="{{url('/getpdf')}}/{{$user->id}}" class="text-center btn btn-secondary w-100 mt-5"  target="_blank">Download as PDF</a>

    <a href="{{url('/excel')}}/{{$user->id}}" class="text-center btn btn-secondary w-100 mt-5"  target="_blank">Download as Excelsheet</a>
    </div>



<script type="text/javascript">	
$(document).ready(function() {

    var user_id = {{ $user->id }};

    function loadTransactions() {
        $.ajax({
            url: "{{url('/view/api')}}/" + user_id,
            type: 'GET',
            data: {},
            success: function(response) {
                // Clear existing rows
                $('#transbody').empty();

                var totalCredit = 0;
                var totalDebit = 0;


                // Append new rows
                $.each(response, function(key, transaction) {

                  totalCredit += transaction.credit ;
                  totalDebit += transaction.debit ;


                   if (transaction.credit == 0) {
                    var amountType = 'debit';
                    var amount = transaction.debit;
                   }else{
                    var amountType = 'credit';
                    var amount = transaction.credit;
                   }
                   
                    // converting date format to dd monthname yyyy hh:mm AM/PM
                    var dateString = transaction.updated_at;
                    var inputDate = new Date(dateString);

                    // Manually construct the desired output format
                    var day = inputDate.getDate();
                    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var month = monthNames[inputDate.getMonth()];
                    var year = inputDate.getFullYear();
                    var hours = inputDate.getHours();
                    var minutes = inputDate.getMinutes();
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // Handle midnight (12:00 AM)

                    var formattedDate = day + ' ' + month + ' ' + year + ' ' + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + ampm;

                    $('#transbody').append(
                        '<tr>' +
                            '<td>' + formattedDate + '</td>' +
                            '<td>' + transaction.credit + '</td>' +
                            '<td>' + transaction.debit + '</td>' +
                            '<td>' + transaction.note + '</td>' +
                            '<td>' +
                                '<a class="btn editTrans" href="#" ' +
                                    'data-id="' + transaction.id + '" ' +
                                    'data-note="' + transaction.note + '" ' +
                                    'data-date="' + formattedDate + '" ' +
                                    'data-amount="' + amount + '" ' +
                                    'data-amountType="' + amountType + '">' +
                                    '<i class="fa fa-pencil fa-lg text-success"></i>' +
                                '</a>' +
                                '<a class="btn deleteTrans" href="#" data-id="' + transaction.id + '">' +
                                    '<i class="fa-solid fa-trash fa-lg text-danger"></i>' +
                                '</a>' +
                            '</td>' +
                        '</tr>'
                    );



                });

                  var totalBalance = totalCredit - totalDebit ;
                  $('#totalCredit').text(totalCredit);
                  $('#totalDebit').text(totalDebit);                                       
                  $('#totalBalance').text(totalBalance);


            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    }

    // Initial load of transactions
    loadTransactions();

    

    $('#myForm').submit(function(event) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        event.preventDefault(); // Prevent the default form submission


        $.ajax({
            url: "{{url('/view/submitform')}}",
            type: 'POST',
            data: {
                id : $('#trans-id').val(),
                user_id: user_id,
                amount: $('#amount').val(),
                note: $('#note').val(),
                date: $('#date').val(),
                amountType : $('input[name="amountType"]:checked').val()
            },
            success: function(response) {
                // Handle the successful response from the server
                console.log(response);
                // Reload transactions after successful form submission
                loadTransactions();
        
                // In case of update empty the fields again  
                $('#myForm').find('#trans-id').val('');
                $('#myForm').find('#date').val('');
                $('#myForm').find('#note').val('');
                $('#myForm').find('#amount').val('');
                $('#addBtn').html('Add');
                $('input[name="amountType"]').attr('disabled', false);
                $('input[name="amountType"][value="credit"]').prop('checked', true);


            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    });


    $(document).on('click','.editTrans',function(){

        $('#trans-id').val(($(this).data('id')));
        $('#date').val(($(this).data('date')));
        $('#note').val(($(this).data('note')));
        $('#amount').val(($(this).data('amount')));

        // if amountType is credit then checked and if debit then checked
        var amountType = $(this).data('amountType');
        $('input[name="amountType"][value="'+amountType+'"]').prop('checked', true);
        
        // disable the radio buttons
        $('input[name="amountType"]').attr('disabled', true);

        $('#addBtn').html('Update');
    });

    $(document).on('click', '.deleteTrans', function () {

          var trans_id = $(this).data('id');

          $.ajax({
            url: "{{url('/view/api/delete')}}/" + trans_id,
            type: 'GET',
            data: {},
            success: function (response) {

                    console.log(response);

                    // Reload transactions after successful form submission
                    loadTransactions();

            },
            error: function (error) {
                    console.log(error);
            }
          });
    });
   

});

</script>

@endsection