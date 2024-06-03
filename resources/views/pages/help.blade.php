@extends('layout.main')

@section('main-section')

<div class="main-container">

	<div class="ml-4">

			<h1 class="my-4">FAQs</h1>

            <div class="faq-wrap">
					<h4 class="mb-20">Frequently Asked questions</h4>
					<div id="accordion">
						<div class="card">
							<div class="card-header">
								<button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
									How to add user in Users table?
								</button>
							</div>
							<div id="faq1" class="collapse show" data-parent="#accordion">
								<div class="card-body">
									Click on Add User appear on top left corner of your page and enter user detail and click on submit button.
									You can see your saved users in My transactions table.
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2">
									How to reset password?
								</button>
							</div>
							<div id="faq2" class="collapse" data-parent="#accordion">
								<div class="card-body">
									 accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq3">
									How to change profile picture?
								</button>
							</div>
							<div id="faq3" class="collapse" data-parent="#accordion">
								<div class="card-body">
									<p> accusamus labore sustainable VHS.</p>
									<p class="mb-0"> accusamus labore sustainable VHS.</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq4">
									How to edit my profile?
								</button>
							</div>
							<div id="faq4" class="collapse" data-parent="#accordion">
								<div class="card-body">
									 accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq5">
									Why transactions are not adding in my transaction table?
								</button>
							</div>
							<div id="faq5" class="collapse" data-parent="#accordion">
								<div class="card-body">
									 accusamus labore sustainable VHS.
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq6">
									Where can i see my pdfs?
								</button>
							</div>
							<div id="faq6" class="collapse" data-parent="#accordion">
								<div class="card-body">
									<p> accusamus labore sustainable VHS.</p>
									<p class="mb-0"> accusamus labore sustainable VHS.</p>
								</div>
							</div>
						</div>
					</div>

				</div>
	</div>

</div>

@endsection
