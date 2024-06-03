@extends('layout.main')

@section('main-section')

<div class="main-container ml-4">

	<h1 class="my-4">Profile</h1>

	<div class="row">
	        <div class="col-xl-8 col-lg-10 col-md-12 mb-30 mx-auto">
						<div class="pd-20 bg-white border-radius-4 box-shadow">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="{{url('images/profile.jpg')}}" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="{{url('images/profile.jpg')}}" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center">{{session('name')}}</h5>
							<p class="text-center text-muted">This is my website.</p>
							<div class="profile-info">
								<h5 class="mb-20 weight-500">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										{{session('email')}}
									</li>
									<li>
										<span>Phone Number:</span>
										{{session('mobile')}}
									</li>
									<li>
										<span>Country:</span>
										India
									</li>
									<li>
										<span>Address:</span>
										{{session('address')}}
									</li>
								</ul>
							</div>
							<div class="profile-social">
								<h5 class="mb-20 weight-500">Social Links</h5>
								<ul class="clearfix">
									<li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-brands fa-facebook"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-brands fa-twitter"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-brands fa-linkedin"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-brands fa-instagram"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fa fa-brands fa-dribbble"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="fa fa-brands fa-dropbox"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-brands fa-google-plus"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i class="fa fa-brands fa-pinterest-p"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-brands fa-skype"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i class="fa fa-brands fa-vine"></i></a></li>
								</ul>
							</div>
							<div class="profile-skills">
								<h5 class="mb-20 weight-500">Key Skills</h5>
								<h6 class="mb-5">HTML</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5">Css</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5">jQuery</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5">Bootstrap</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5">PHP Core</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5">My SQL</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5">Laravel</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
	</div>

</div>

@endsection
