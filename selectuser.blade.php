@extends('layout.main')

@section('main-section')

<div class="main-container">
		<div class="mt-2 ml-2">
			<h2>Select User</h2>
		</div>
		<div class="mt-5">
			<ul>
				@foreach($users as $user)
                   <li>
                   	  <a href="{{url('/view/'.$user->id)}}">
                   	  <div class="d-flex border-bottom m-4">
                   	  <i class="fa-solid fa-user h4"></i>
                   	  <h4 class="pl-4 text-uppercase">{{$user->name}}</h4>
                   	  </div>
                   	  </a>
                   </li>
				@endforeach
			</ul>
		</div>
	    
	    <div class="row mt-5">
             <div class="col-md-6 bg-success text-white text-center pt-2">
			    <p><strong>Total Credit : {{$transactions->total_credit}}</strong></p>
			 </div>
			 <div class="col-md-6 bg-danger text-white text-center pt-2">   
			    <p><strong>Total Debit : {{$transactions->total_debit}}</strong></p>
             </div>
		</div>

</div>
	
	
@endsection