@extends('layout.main')

@section('main-section')


<div class="main-container mt-5 ml-4">
   
	<div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Start Date :</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" class="form-control date-picker" id="startDate" placeholder="Enter Date">
            </div>
            
            <label class="col-sm-12 col-md-2 col-form-label">End Date :</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" class="form-control date-picker" id="endDate" placeholder="Enter Date">
            </div>

		    <button class="text-center btn btn-secondary w-100 mt-5" id="showdata">Show Data</button>

	</div>

    <table class="table table-striped" id="table">
        <thead>
            <tr>
                <th>Party Name</th>
                <th>GSTIN</th>
                <th>Invoice no.</th>
                <th>Invoice Date</th>
                <th>Taxable Amount</th>
                <th>Tax slab</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
        </tbody>
    </table>
    <div id="pdfbutton">
        
    </div>

    <div id="excelbutton">
        
    </div>

</div>

<script type="text/javascript">
    
$(document).ready(function(){

      $('#showdata').click(function(){

          $('#tbody ,#pdfbutton').empty();

          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });
         
          $.ajax({

                url: "/invoice/getreport",
                type: "POST",
                data: {
                  startDate : $('#startDate').val(),
                  endDate : $('#endDate').val()
                  },

                success : function(response){
                    

                    $.each(response,function(key,invoice){


                        $('#tbody').append(
                            '<tr>' +
                            '<td>' + invoice.name + '</td>' +
                            '<td>' + invoice.GSTIN + '</td>' +
                            '<td>' + invoice.invoice_number + '</td>' +
                            '<td>' + invoice.invoice_date + '</td>' +
                            '<td>' + invoice.taxable_amount + '</td>' +
                            '<td>' + invoice.tax_slab + '%</td>' + 
                            '<td>' + invoice.total_amount + '</td>' +
                            '</tr>'
                            );
                    });

                    $('#pdfbutton').append(
                       "<a href='{{url('invoice/getpdf/')}}/"+$('#startDate').val()+"&"+$('#endDate').val()+"' class='btn btn-primary mt-5 w-100 pdfDown'>Download as PDF</a>"
                    );

                    $('#excelbutton').append(
                     "<a href='{{url('/invoice/getexcel')}}/"+$('#startDate').val()+"&"+$('#endDate').val()+"' class='btn btn-primary mt-5 w-100'>Download as Excel</a>"
                    );
                    
                    console.log(response);


                },
                error : function(error){
                    console.error(error);
                }  

          });

      });

      
});



</script>

@endsection
