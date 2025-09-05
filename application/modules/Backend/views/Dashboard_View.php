<?php include VIEWPATH.'includes/backend/Header.php' ;?>
<?php include VIEWPATH.'includes/backend/Sidebar.php' ;?>
<?php include VIEWPATH.'includes/backend/Topheader.php' ;?>



<div class="page-content">
	<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<p class="mb-0 text-secondary">Revenue</p>
							<h4 class="my-1">$4805</h4>
							<p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last week</p>
						</div>
						<div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
						</div>
					</div>
					<div id="chart1"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<p class="mb-0 text-secondary">Total Customers</p>
							<h4 class="my-1">8.4K</h4>
							<p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>14% Since last week</p>
						</div>
						<div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-group'></i>
						</div>
					</div>
					<div id="chart2"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<p class="mb-0 text-secondary">Store Visitors</p>
							<h4 class="my-1">59K</h4>
							<p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last week</p>
						</div>
						<div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
						</div>
					</div>
					<div id="chart3"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row row-cols-1 row-cols-lg-3">
		<div class="col d-flex">
			<div class="card radius-10 w-100">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0">Top Categories</h5>
						</div>
						<div class="dropdown ms-auto">
							<a href="javascript:;" class="dropdown-toggle-nocaret more-options dropdown-toggle"
								data-bs-toggle="dropdown">
								<i class='bx bx-dots-vertical-rounded'></i>
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="javascript:;">Action</a>
								</li>
								<li><a class="dropdown-item" href="javascript:;">Another action</a>
								</li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="javascript:;">Something else here</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="mt-5" id="chart15"></div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Kids <span class="badge bg-success rounded-pill">25</span>
					</li>
					<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Women <span class="badge bg-danger rounded-pill">10</span>
					</li>
					<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Men <span class="badge bg-primary rounded-pill">65</span>
					</li>
					<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Furniture <span class="badge bg-warning text-dark rounded-pill">14</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="col d-flex">
			<div class="card radius-10 w-100">
				<div class="card-body">
					<p class="font-weight-bold mb-1 text-secondary">Visitors</p>
					<div class="d-flex align-items-center">
						<div>
							<h4 class="mb-0">43,540</h4>
						</div>
						<div class="">
							<p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4 <i class='bx bxs-up-arrow-alt mr-2'></i>
							</p>
						</div>
					</div>
					<div id="chart21"></div>
				</div>
			</div>
		</div>
		<div class="col d-flex">
			<div class="card radius-10 w-100 overflow-hidden">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0">Sales Overiew</h5>
						</div>
						<div class="dropdown ms-auto">
							<a href="javascript:;" class="dropdown-toggle-nocaret more-options dropdown-toggle"
								data-bs-toggle="dropdown">
								<i class='bx bx-dots-vertical-rounded'></i>
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="javascript:;">Action</a>
								</li>
								<li><a class="dropdown-item" href="javascript:;">Another action</a>
								</li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="javascript:;">Something else here</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="mt-5" id="chart20"></div>
				</div>
				<div class="card-footer bg-transparent border-top-0">
					<div class="d-flex align-items-center justify-content-between text-center">
						<div>
							<h6 class="mb-1 font-weight-bold">$289.42</h6>
							<p class="mb-0 text-secondary">Last Week</p>
						</div>
						<div class="mb-1">
							<h6 class="mb-1 font-weight-bold">$856.14</h6>
							<p class="mb-0 text-secondary">Last Month</p>
						</div>
						<div>
							<h6 class="mb-1 font-weight-bold">$987,25</h6>
							<p class="mb-0 text-secondary">Last Year</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end row-->
	
	<!--end row-->
	<div class="card radius-10">
		<div class="card-body">
			<div class="d-flex align-items-center">
				<div>
					<h5 class="mb-0">Recent Orders</h5>
				</div>
				<div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
				</div>
			</div>
			<hr/>
			<div class="table-responsive">
				<table class="table align-middle mb-0">
					<thead class="table-light">
						<tr>
							<th>Order id</th>
							<th>Product</th>
							<th>Customer</th>
							<th>Date</th>
							<th>Price</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>#897656</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/chair.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Light Blue Chair</h6>
									</div>
								</div>
							</td>
							<td>Brooklyn Zeo</td>
							<td>12 Jul 2020</td>
							<td>$64.00</td>
							<td>
								<div class="d-flex align-items-center text-danger">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Pending</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td>#987549</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/shoes.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Green Sport Shoes</h6>
									</div>
								</div>
							</td>
							<td>Martin Hughes</td>
							<td>14 Jul 2020</td>
							<td>$45.00</td>
							<td>
								<div class="d-flex align-items-center text-primary">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Dispatched</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td>#685749</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/headphones.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Red Headphone 07</h6>
									</div>
								</div>
							</td>
							<td>Shoan Stephen</td>
							<td>15 Jul 2020</td>
							<td>$67.00</td>
							<td>
								<div class="d-flex align-items-center text-success">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Completed</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td>#887459</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/idea.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Mini Laptop Device</h6>
									</div>
								</div>
							</td>
							<td>Alister Campel</td>
							<td>18 Jul 2020</td>
							<td>$87.00</td>
							<td>
								<div class="d-flex align-items-center text-success">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Completed</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td>#335428</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/user-interface.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Purple Mobile Phone</h6>
									</div>
								</div>
							</td>
							<td>Keate Medona</td>
							<td>20 Jul 2020</td>
							<td>$75.00</td>
							<td>
								<div class="d-flex align-items-center text-danger">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Pending</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td>#224578</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/watch.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">Smart Hand Watch</h6>
									</div>
								</div>
							</td>
							<td>Winslet Maya</td>
							<td>22 Jul 2020</td>
							<td>$80.00</td>
							<td>
								<div class="d-flex align-items-center text-primary">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Dispatched</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td>#447896</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="recent-product-img">
										<img src="<?=base_url()?>assets/backend/images/icons/tshirt.png" alt="">
									</div>
									<div class="ms-2">
										<h6 class="mb-1 font-14">T-Shirt Blue</h6>
									</div>
								</div>
							</td>
							<td>Emy Jackson</td>
							<td>28 Jul 2020</td>
							<td>$96.00</td>
							<td>
								<div class="d-flex align-items-center text-danger">	<i class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
									<span>Pending</span>
								</div>
							</td>
							<td>
								<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
									<a href="javascript:;" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
		


<?php include VIEWPATH.'includes/backend/Footer.php' ;?>
