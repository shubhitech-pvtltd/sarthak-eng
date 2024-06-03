@extends('layout.main')

@section('main-section')

<div class="main-container">
		<div class="w-25  mx-auto mt-5 pt-5">
			<div class="text-center">
				<a href="{{url('/addparty')}}">
				<i class="fa-solid fa-user-plus fa-2xl "></i>
				<h4 class="mt-2">Add Party</h4>
				</a>
			</div>
			<div class="mt-5 text-center">
				<a href="{{url('/addinvoice')}}">
				<i class="fa-regular fa-folder-open fa-2xl"></i>
				<h4 class="mt-2">My Invoices</h4>
			    </a>
			</div>
			<div class="mt-5 text-center">
				<a href="{{url('/invoicereport')}}">
				<i class="fa-solid fa-file-invoice fa-2xl"></i>
				<h4 class="mt-2">Invoice Report</h4>
			    </a>
			</div>
		</div>
</div>
	
	
@endsection