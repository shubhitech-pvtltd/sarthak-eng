<body>
	<div class="pre-loader"></div>
	<div class="header clearfix">
		<div class="header-right">
			<div class="brand-logo">
				<a href="{{ url('/')}}">
					<img src="{{url('images/logo.png')}}" alt="" class="mobile-logo" height="40px" width="40px">
				</a>
			</div>
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fa fa-user-o"></i></span>
						<span class="user-name">{{session('name')}}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{url('/profile')}}"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a>
						<a class="dropdown-item" href="{{url('/setting')}}"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
						<a class="dropdown-item" href="{{url('/help')}}"><i class="fa fa-question" aria-hidden="true"></i> Help</a>
						<a class="dropdown-item" href="{{url('/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>