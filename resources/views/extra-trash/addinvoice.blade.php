@extends('layout.main')

@section('main-section')

<div class="main-container">

    <!-- Add Invoice Form -->
    <form action="javascript:void(0)" id="myForm">
        <input type="hidden" id="invoice-id" value="">
	    <div class="row m-4">
		    	<div class="form-check col-md-6 col-sm-12">
		    		<label class="col-sm-12 col-md-2 col-form-label">Select</label>
					 <select class="custom-select col-12" id="party">
							<option selected="">Choose party name</option>    	         @foreach($parties as $party)
							<option value="{{$party->id}}" data-gstin="{{$party->GSTIN}}">{{$party->name}}</option>
    	                    @endforeach
			         </select>
	            </div>
	            <div class="form-check col-md-6 col-sm-12">
		    		  <label class="col-sm-12 col-md-2 col-form-label">GSTIN</label>
					  <input type="text" class="form-control" id="GSTIN" value="">
					  
	            </div>
        </div>    
	    <div class="row mx-4">
				<div class="form-check col-md-4 col-sm-12">
					<div class="form-group">
						<label>Invoice number</label>
						<input type="integer" class="form-control" id="invoice_number">
					</div>
				</div>
				<div class="form-check col-md-4 col-sm-12">
					<div class="form-group">
						<label>Taxable amount</label>
						<input type="integer" name="taxable_amount" id="taxable_amount" class="form-control">
					</div>
				</div>
				<div class="form-check col-md-4 col-sm-12">
					<div class="form-group">
						<label>Tax Slab</label>
						<select class="custom-select col-12" name="tax_slab" id="tax_slab">
							<option selected="">Choose Tax Slab</option>
							<option value="0">0%</option>
							<option value="5">5%</option>
							<option value="18">18%</option>
							<option value="28">28%</option>
			            </select>
					</div>
				</div>
	    </div>
	    <div class="row mx-4">
		    	<div class="form-check col-md-6 col-sm-12">
		    		<label class="col-form-label">Invoice Date :</label>
		            <div>
		                <input type="text" class="form-control date-picker" id="date" placeholder="Enter Date">
		            </div>
		       </div>
	            <div class="form-check col-md-6 col-sm-12">
		    		  <label class="col-form-label">Total Amount</label>
					  <input type="integer" class="form-control" id="total_amount" value="">
					  
	            </div>
        </div>
		 <button type="submit" id="addBtn" class="btn btn-warning text-center w-100 m-5 fs-5">Add Invoice</button>
    </form>

    <!-- Table  Start -->

	<div class="pd-20 bg-white border-radius-4 box-shadow mb-30" id="pdf-content">
		<table class="table table-striped">
			<thead>
				<tr>
                    <th>Party Name</th>
                    <th>GSTIN</th>
					<th>Invoice No.</th>
					<th>Taxable Amt</th>
					<th>Tax slab</th>
					<th>Total Amt</th>
					<th>Invoice Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="transbody">
				@foreach($invoices as $invoice)
				<tr>
					<td>{{$invoice->name}}</td>
					<td>{{$invoice->GSTIN}}</td>
					<td>{{$invoice->invoice_number}}</td>
					<td>{{$invoice->taxable_amount}}</td>
					<td>{{$invoice->tax_slab}}%</td>
					<td>{{$invoice->total_amount}}</td>
					<td>{{$invoice->invoice_date}}</td>

					<td>
						<a class="btn editInvoice" href="#" data-id="{{$invoice->id}}" data-name="{{$invoice->name}}" data-partyid="{{$invoice->party_id}}" data-gstin="{{$invoice->GSTIN}}" data-number="{{$invoice->invoice_number}}" data-txamt="{{$invoice->taxable_amount}}" data-ttlamt="{{$invoice->total_amount}}" data-date="{{$invoice->invoice_date}}" data-txslab="{{$invoice->tax_slab}}"><i class="fa fa-pencil fa-lg text-success"></i>
						</a>

						<a class="btn deleteInvoice" href="#" data-id="{{$invoice->id}}"><i class="fa-solid fa-trash fa-lg text-danger"></i>
						</a>
					</td>	
				</tr>
				@endforeach
			</tbody>
 		</table>

</div>    


<script type="text/javascript">
	
  $(document).ready(function(){
        

      
        $('#party').change(function(){

            $('#GSTIN').val($(this).find(':selected').data('gstin'));
            $('#GSTIN').prop('disabled', true);

        });

        

        function updateTotalAmount() {

			    var taxable_amt = parseFloat($('#taxable_amount').val()); // Parse as float
			    var tax_percent = parseFloat($('#tax_slab').val()); // Parse as float

			    var total_amount = taxable_amt + taxable_amt * tax_percent/100;

 			   $('#total_amount').val(total_amount);

			   }

				// Bind the function to the change event of both #tax_slab and #taxable_amount
				$('#tax_slab, #taxable_amount').change(updateTotalAmount);
        
        $('#myForm').submit(function(event) {

		        $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		        });

		        event.preventDefault(); // Prevent the default form submission


		        $.ajax({
		            url: "{{url('/invoice/submitform')}}",
		            type: 'POST',
		            data: {
		                id : $('#invoice-id').val(),
		                party_id: $('#party').val(),
		                invoice_number: $('#invoice_number').val(),
		                taxable_amount: $('#taxable_amount').val(),
		                tax_slab: $('#tax_slab').val(),
		                total_amount: $('#total_amount').val(),
                        date: $('#date').val(),
		            },
		            success: function(response) {
		         
		                // Handle the successful response from the server
		                console.log(response);
		         
		                // In case of update empty the fields again  
		                $('#myForm').find('#invoice-id').val('');
		                $('#myForm').find('#date').val('');
		                $('#myForm').find('#party').val('');
		                $('#myForm').find('#invoice_number').val('');
		                $('#myForm').find('#taxable_amount').val('');
		                $('#myForm').find('#tax_slab').val('');
		                $('#myForm').find('#total_amount').val('');
		                $('#GSTIN').val('');
		                $('#addBtn').html('Add Invoice');
                        $('#GSTIN').prop('disabled', false);
		                
		                // Reload the page
                        location.reload();

		            },
		            error: function(xhr, status, error) {
		                // Handle errors
		                console.error(error);
		            }
		        });
        });

        $(document).on('click','.editInvoice',function(){
        
					// Assuming your original date is in the format 'yyyy-mm-dd'
					var date = $(this).data('date');

					// Convert the original date to a JavaScript Date object
					var inputDate = new Date(date);

					// Manually construct the desired output format
					var day = inputDate.getDate();
					var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
					var month = monthNames[inputDate.getMonth()];
					var year = inputDate.getFullYear();

                    var formattedDate = day + ' ' + month + ' ' + year;

			        $('#invoice-id').val(($(this).data('id')));
			        $('#party').val(($(this).data('partyid')));
			        $('#GSTIN').val(($(this).data('gstin')));
			        $('#GSTIN').prop('disabled',true);
			        $('#taxable_amount').val(($(this).data('txamt')));
			        $('#total_amount').val(($(this).data('ttlamt')));
			        $('#invoice_number').val(($(this).data('number')));
			        $('#tax_slab').val(($(this).data('txslab')));
			        $('#date').val(formattedDate);
			        $('#addBtn').html('Update Invoice');
	    });

	    $(document).on('click', '.deleteInvoice', function () {

          var invoice_id = $(this).data('id');

          $.ajax({
            url: "{{url('/invoice/delete')}}/" + invoice_id,
            type: 'GET',
            data: {},
            success: function (response) {

                    console.log(response);

            },
            error: function (error) {
                    console.log(error);
            }
          });
    });
 
 });


</script>

@endsection
