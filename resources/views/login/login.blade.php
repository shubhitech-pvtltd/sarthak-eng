@include('layout.head')
<body>
    
    

	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">

		<div class="login-box bg-white box-shadow pd-30 border-radius-5">

			<img src="{{url('images/login-img.png')}}" alt="login" class="login-img">
			<h2 class="text-center mb-30">Login</h2>

			<!-- Show msg about password change or faliure etc. -->
		    @if(session()->has('showMsg'))
		    <div class="pd-5">
	        <strong class="text-danger">{{session('showMsg')}}</strong>
		    </div>
		    @endif


			<form method="post" action="{{url('/login')}}">
        
            @csrf

				<div class="input-group custom input-group-lg">
					<input type="email"  class="form-control" placeholder="Email" name="email">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" required class="form-control" placeholder="**********" name="password">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
								<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Sign In">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="forgot-password padding-top-10"><a href="{{url('forgot-password')}}">Forgot Password</a></div>
					</div>
				</div>
			</form>
		</div>
	</div>

@include('layout.footer')
