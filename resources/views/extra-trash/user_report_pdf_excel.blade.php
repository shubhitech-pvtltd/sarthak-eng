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
}

.customer-info-container p.text-capitalize {
    text-transform: capitalize;
}

.customer-info-container strong {
    font-weight: bold;
}

/* Custom CSS for Transaction Table */
.table-container {
    padding: 20px;
    background-color: #fff; 
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    margin-bottom: 30px;
}

.table-container table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.table-container th, .table-container td {
    border: 1px solid #ddd; 
    padding: 8px;
    text-align: left;
}

.table-container th {
    background-color: #f2f2f2; 
}


@media (max-width: 768px) {
    .table-container th, .table-container td {
        font-size: 14px;
    }
}

</style>



<div class="customer-info-container">
	<h1>Customer Information</h1>
			<p class="text-capitalize mt-4"><strong>Name : </strong> {{$user->name}}</p>
			<p><strong>Mobile : </strong>{{$user->mobile}}</p>
			<p class="text-capitalize"><strong>Address : </strong>{{$user->address}}</p>
			<p><strong>Opening Date : </strong>{{$user->created_at}}</p>
            <p><strong>Total Credit : </strong>{{$sum->total_credit}}<strong> , Total Debit : </strong>{{$sum->total_debit}}</p>
            <p><strong>Balance Amount : </strong>{{$sum->total_credit - $sum->total_debit}}</p>
            

</div>

<!-- Table  Start -->

<div class="table-container">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Date</th>
				<th scope="col">Cr.Amt</th>
				<th scope="col">Dbt.Amt</th>
				<th scope="col">Note</th>
				<th scope="col">File</th>
             
			</tr>
		</thead>
		<tbody>
			@foreach($transactions as $transaction)
			<tr>
				<td>{{$transaction->updated_at}}</td>
				<td>{{$transaction->credit}}</td>
				<td>{{$transaction->debit}}</td>
				<td>{{$transaction->note}}</td>
				<td>{{$transaction->file}}</td>
			</tr>
		    @endforeach
		</tbody>
		</table>
</div>

