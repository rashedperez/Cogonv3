<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Brgy. Cogon Pardo Facility & Amenity Reservation System</title>

	<link rel="shortcut icon" href="<?php echo base_url('assets/img/photos/logo.svg');?>">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/light.css');?>" rel="stylesheet">
	<link class="js-stylesheet" href="<?php echo base_url('assets/css/light.css');?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.1.6/sumoselect.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

	<!-- Custom CSS -->
	<style>
		.text-ellipsis {
			display: inline-block;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
			max-width: 100%;
		}
	</style>

	<!-- END SETTINGS -->	
</head>
<!--SideBar--->
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">		
			<div class="sidebar-content js-simplebar " style="background-color: #e03444;">
				<div class="d-flex justify-content-center mt-3">
					<a href="<?php echo base_url('dashboard/index');?>"><i><img src="<?php echo base_url('assets/img/photos/logo.svg'); ?>" alt="" style="width: 100px; height: auto;"></i> </a>
				</div>
				<a class="sidebar-brand" href="<?php echo base_url('dashboard/index');?>">
          			<span class="align-middle mr-3"><h5 class = "text-white m-0">Facility & Amenity Reservation System</h5></span>
      		  	</a>
				<!--Dashboard SideBar-->
				<ul class="sidebar-nav">
					<li class="sidebar-item active">
						<a href="<?php echo base_url('dashboard/index');?>" class="sidebar-link">
							<i class="align-middle text-white" data-feather="sliders"></i> <span class="align-middle text-white">Dashboard</span>
						</a>
					</li>
					<!-- Resources SideBar -->
					<li class="sidebar-item">
						<a href="<?php echo base_url('resource/resource_index');?>"  class="sidebar-link collapsed text-white">
							<i class="align-middle text-white" data-feather="layout"></i> <span class="align-middle text-white">Resources</span>
						</a>
					</li>
					<!-- Resident SideBar-->
					<li class="sidebar-item">
						<a href="<?php echo base_url('resident/resident_index');?>" class="sidebar-link collapsed text-white">
							<i class="align-middle text-white" data-feather="users"></i> <span class="align-middle">Residents</span>
						</a>
					</li>
					<!-- Reservation SideBar-->
					<li class="sidebar-item">
						<a href="#reservation" data-toggle="collapse" class="sidebar-link collapsed text-white">
							<i class="align-middle text-white" data-feather="calendar"></i> <span class="align-middle text-white">Reservation</span>
						</a>
						<ul id="reservation" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link text-white" href="<?php echo base_url('reservation/reservation_index');?>">Add Reservation</a></li>
							<li class="sidebar-item"><a class="sidebar-link text-white" href="<?php echo base_url('reservation/list');?>">Reservation List</a></li>
						</ul>
					</li>
					<!-- Rented Resources SideBar-->
					<li class="sidebar-item">
						<a href="<?php echo base_url('resource/rented');?>" class="sidebar-link collapsed text-white">
							<i class="align-middle text-white" data-feather="users"></i> <span class="align-middle">Rented Resources</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<form class="d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Search..." aria-label="Search">
						<div class="input-group-append">
							<button class="btn" type="button">
								<i class="align-middle" data-feather="search"></i>
							</button>
						</div>
					</div>
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
								<span style="color: #495057"><i class="mr-1" data-feather="user" style="color: #495057"></i>Rashed Perez</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="mr-3" data-feather="help-circle" style="color: #495057"></i>Help</a>
								<a class="dropdown-item" href="#"><i class="mr-3" data-feather="log-out" style="color: #495057"></i>Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		<!-- </div> -->
	<!-- </div> -->
	<script src="<?php echo base_url('assets/js/app.js');?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.1.6/jquery.sumoselect.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<!-- </body> -->
