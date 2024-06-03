@extends('layout.main')

@section('main-section')


<div class="main-container mt-5 ml-4">
   
	<div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Select Date :</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" class="form-control date-picker" id="date" placeholder="Enter Date">
            </div>

		    <button class="text-center btn btn-secondary w-100 mt-5" id="showdata">Show Data</button>

	</div>
	<!-- Table  Start -->

	<div class="pd-20 bg-white border-radius-4 box-shadow mb-30 h-75">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Date</th>
					<th scope="col">Cr.Amt</th>
					<th scope="col">Dbt.Amt</th>
					<th scope="col">Note</th>
				</tr>
			</thead>
			<tbody id="transbody">
				
			</tbody>
		</table>

    </div>

   
</div>

<script type="text/javascript">
	
$(document).ready(function() {

		   $('#showdata').click(function(){

		   	       $.ajaxSetup({
				         headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				         }
                   });

			   	   $.ajax({
			            url: "{{url('/date/gettransactiondata')}}",
			            type: 'POST',
			            data: {
			                date : $('#date').val()
			            },
			            success: function(response) {

                             $('#transbody').empty();


			            	 $.each(response, function(key, transaction) {

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
		                    	'<tr>'+
		                    	'<td>' + formattedDate + '</td>'+
		                    	'<td>' + transaction.credit + '</td>'+
		                    	'<td>' + transaction.debit + '</td>'+
		                    	'<td>' + transaction.note + '</td>'+
		                    	'</tr>'
		                    	);
		                    
		                    });

			                // Handle the successful response from the server
			                console.log(response);

			            },
			            error: function(xhr, status, error) {
			                // Handle errors
			                console.error(error);
			            }
			            });
		   });
});
</script>
                            
@endsection