@include('layout.head');

<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="{{url('/images/login-img.png')}}" alt="login" class="login-img">
			<h2 class="text-center mb-30">Forgot Password</h2>
			<form action="{{url('/create-new-password')}}" method="POST">

                {{csrf_field()}}

				<div class="input-group custom input-group-lg">
					<input type="password" class="form-control" placeholder="Enter Your New Password" name="password">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
						<div class="input-group">
								<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
       					</div>
				</div>
			</form>
		</div>
	</div>

@include('layout.footer');	