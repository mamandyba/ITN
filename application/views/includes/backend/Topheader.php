<!--start header -->
<header>
<div class="topbar">
	<nav class="navbar navbar-expand gap-2 align-items-center">
		<div class="mobile-toggle-menu d-flex"><i class='bx bx-menu'></i>
		</div>

<!-- 		  <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
			 <a href="avascript:;" class="btn d-flex align-items-center"><i class="bx bx-search"></i>Search</a>
		  </div> -->

		  <div class="top-menu ms-auto">
			<ul class="navbar-nav align-items-center gap-1">
				<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
					<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
					</a>
				</li>
				<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;" data-bs-toggle="dropdown"><img src="<?=base_url()?>assets/backend/images/county/02.png" width="22" alt="">
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="<?=base_url()?>assets/backend/images/county/01.png" width="20" alt=""><span class="ms-2">English</span></a>
						</li>
						<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="<?=base_url()?>assets/backend/images/county/03.png" width="20" alt=""><span class="ms-2">French</span></a>
						</li>
					</ul>
				</li>
				<li class="nav-item dark-mode d-none d-sm-flex">
					<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
					</a>
				</li>

				<li class="nav-item dropdown dropdown-app">
					<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><i class='bx bx-grid-alt'></i></a>
					<div class="dropdown-menu dropdown-menu-end p-0">
						<div class="app-container p-2 my-2">
						  <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
							 <div class="col">
							  <a href="javascript:;">
								<div class="app-box text-center">
								  <div class="app-icon">
									  <img src="<?=base_url()?>assets/backend/images/app/slack.png" width="30" alt="">
								  </div>
								  <div class="app-name">
									  <p class="mb-0 mt-1">Slack</p>
								  </div>
								  </div>
								</a>
							 </div>
							 <div class="col">
							  <a href="javascript:;">
								<div class="app-box text-center">
								  <div class="app-icon">
									  <img src="<?=base_url()?>assets/backend/images/app/behance.png" width="30" alt="">
								  </div>
								  <div class="app-name">
									  <p class="mb-0 mt-1">Behance</p>
								  </div>
								  </div>
							  </a>
							 </div>
							 <div class="col">
							  <a href="javascript:;">
								<div class="app-box text-center">
								  <div class="app-icon">
									<img src="<?=base_url()?>assets/backend/images/app/google-drive.png" width="30" alt="">
								  </div>
								  <div class="app-name">
									  <p class="mb-0 mt-1">Dribble</p>
								  </div>
								  </div>
								</a>
							 </div>
							 <div class="col">
							  <a href="javascript:;">
								<div class="app-box text-center">
								  <div class="app-icon">
									  <img src="<?=base_url()?>assets/backend/images/app/outlook.png" width="30" alt="">
								  </div>
								  <div class="app-name">
									  <p class="mb-0 mt-1">Outlook</p>
								  </div>
								  </div>
								</a>
							 </div>
							 <div class="col">
							  <a href="javascript:;">
								<div class="app-box text-center">
								  <div class="app-icon">
									  <img src="<?=base_url()?>assets/backend/images/app/github.png" width="30" alt="">
								  </div>
								  <div class="app-name">
									  <p class="mb-0 mt-1">GitHub</p>
								  </div>
								  </div>
								</a>
							 </div>
							 <div class="col">
							  <a href="javascript:;">
								<div class="app-box text-center">
								  <div class="app-icon">
									  <img src="<?=base_url()?>assets/backend/images/app/stack-overflow.png" width="30" alt="">
								  </div>
								  <div class="app-name">
									  <p class="mb-0 mt-1">Stack</p>
								  </div>
								  </div>
								</a>
							 </div>
	
						  </div><!--end row-->
	
						</div>
					</div>
				</li>

				<li class="nav-item dropdown dropdown-large">
					<div class="dropdown-menu dropdown-menu-end">

						<div class="header-notifications-list">
						
						</div>

					</div>
				</li>
				<li class="nav-item dropdown dropdown-large">
					<div class="dropdown-menu dropdown-menu-end">
						<div class="header-message-list">
							
							
						</div>
					</div>
				</li>


			</ul>
		</div>
		<div class="user-box dropdown px-3">
			<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<img src="<?=base_url()?>assets/frontend/img/logo/ub.png" class="user-img" alt="user avatar">
				<div class="user-info">
					<p class="user-name mb-0">Admin</p>
					<p class="designattion mb-0">Web Admin</p>
				</div>
			</a>
			<ul class="dropdown-menu dropdown-menu-end">
				<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
				</li>
				<li>
					<div class="dropdown-divider mb-0"></div>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
				</li>
			</ul>
		</div>
	</nav>
</div>
</header>
<!--end header -->



<!--start page wrapper -->
<div class="page-wrapper">

