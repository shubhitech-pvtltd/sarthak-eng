<style type="text/css">
	/* Custom CSS for Customer Information */
.customer-info-container {
    margin-top: 1.5rem;
    margin-left: 1.5rem;
    border-bottom: 1px solid #000;
}

.customer-info-container h1 {
    font-size: 2rem;
}

.customer-info-container p {
    margin-top: 1rem;
    font-size: 1.2rem;
}

.customer-info-container p.text-capitalize {
    text-transform: capitalize;
}

/* Custom CSS for Transaction Table */
.table-container {
    padding: 20px;
    background-color: #fff; 
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    margin-bottom: 30px;
    font-size:1.08rem;
}

.table-container table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1.2rem;
}

.table-container th, .table-container td {
    border: 1px solid #ddd; 
    padding: 8px;
    text-align: left;
}

.table-container th {
    background-color: #f2f2f2; 
}

</style>


<div class="customer-info-container">
	<h1>Personal Information</h1>
			<p class="text-capitalize mt-4"><strong>Name : </strong> {{session('name')}}</p>
			<p><strong>GSTIN : </strong>{{session('GSTIN')}}</p>
            <p><strong>Mobile : </strong>{{session('mobile')}}</p>
			<p class="text-capitalize"><strong>Address : </strong>{{session('address')}}</p>
			<p><strong>From : </strong>{{$startDate}}</p>
            <p><strong>To : </strong>{{$endDate}}</p>
            <p><strong>Total Purchase for the period : </strong>{{$totalsum->total}}</p>
            
</div>

<!-- Table  Start -->

<div class="table-container">
	<table class="table table-striped">
		<thead>
			<tr>
                <th>Party Name</th>
                <th>Party Address</th>
                <th>GSTIN</th>
                <th>Invoice no.</th>
                <th>Invoice Date</th>
                <th>Taxable Amount</th>
                <th>Tax slab</th>
                <th>Total Amount</th>
            </tr>
		</thead>
		<tbody>
			@foreach($invoices as $invoice)
			<tr>
				<td>{{$invoice->name}}</td>
				<td>{{$invoice->address}}</td>
				<td>{{$invoice->GSTIN}}</td>
				<td>{{$invoice->invoice_number}}</td>
				<td>{{$invoice->invoice_date}}</td>
				<td>{{$invoice->taxable_amount}}</td>
				<td>{{$invoice->tax_slab}}</td>
				<td>{{$invoice->total_amount}}</td>

			</tr>
		    @endforeach
		</tbody>
		</table>
</div>

