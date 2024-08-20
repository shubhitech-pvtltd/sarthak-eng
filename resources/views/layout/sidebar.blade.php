<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{url('/')}}">
				<img src="{{url('images/sarthak-logo.png')}}" alt="sarthak">
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="{{url('/')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="{{url('/user')}}"  class="dropdown-toggle no-arrow">
							<span class="fa fa-user"></span><span class="mtext">User</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="{{url('/client')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-table"></span><span class="mtext">Clients</span>
						</a>

					</li>

					<li class="dropdown">
						<a href="{{url('/machine')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-industry"></span><span class="mtext">	Machine</span>
						</a>

					</li>

					<li class="dropdown">
						<a href="{{url('/spare')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-wrench"></span><span class="mtext">Spare</span>
						</a>

					</li>

					<li class="dropdown">
						<a href="{{url('/customerprice')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-wallet"></span><span class="mtext">Price</span>
						</a>

					</li>

					<li class="dropdown">
						<a href="{{url('/buyer')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-regular fa-address-card"></span><span class="mtext">Buyers</span>
						</a>

					</li>

					<li class="dropdown">
						<a href="{{url('/quotation')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-indent"></span><span class="mtext">Quotation</span>
						</a>

					</li>

                    <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-option="off">
							<span class="fa fa-regular fa-calendar"></span><span class="mtext">Stock Inventory</span>
						</a>
						<ul class="submenu" style="display: none;">
                            <li><a href="/stockinventory/availablestock">Available Stock</a></li>
							<li><a href="/stockinventory/incomingstock">Incoming</a></li>
							<li><a href="/stockinventory/outgoingstock">Outgoing</a></li>
                            <li><a href="/stockinventory/reports">Reports</a></li>

						</ul>
					</li>

					{{-- <li class="dropdown">
						<a href="{{url('/datewisetransaction')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-regular fa-calendar"></span><span class="mtext">Date Wise <br>Transactions</span>
						</a>

					</li>
					<li class="dropdown">
						<a href="{{url('/invoice')}}" class="dropdown-toggle no-arrow">
							<span class="fa fa-regular fa-file-lines"></span><span class="mtext">Invoice</span>
						</a>

					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle ">
							<span class="fa fa-plug"></span><span class="mtext">Additional Pages</span>
						</a>

					</li> --}}
				</ul>
			</div>
		</div>
	</div>
