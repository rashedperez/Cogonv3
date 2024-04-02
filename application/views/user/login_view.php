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

	<!-- END SETTINGS -->	
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column position-relative">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mb-3">
								<h1 class="h2">Sign In</h1>
							</div>

							<div class="card">
								<div class="card-body">
                                <div class=" d-flex justify-content-center mb-3 ">
					            <a class="mt-3" href="<?php echo base_url('dashboard/index');?>"><i><img src="<?php echo base_url('assets/img/photos/logo.svg'); ?>" alt="" style="width: 100px; height: auto;"></i> </a>
				            </div>
                            <h4 class="lead d-flex justify-content-center mb-3">
									Facility & Amenity Reservation System
                                </h4>
									<div class="m-sm-4">
										<?php echo form_open('user/login'); ?>
											<div class="form-group">
												<label>Username</label>
												<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter Username" />
											</div>
											<div class="form-group">
												<label>Password</label>
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											</div>
											
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
											</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div style="position: absolute; top: 5%; right: 5%">
					<a href="<?php echo base_url('user/register'); ?>" style="color: black"><h6 class="mb-0"><u>Register as a resident</u></h6></a>
				</div>
			</div>
		</main>
	</div>

	<script src="<?php echo base_url('assets/js/app.js');?>"></script>

	<script>
		// Notifications
		<?php if ($this->session->flashdata('login_status')): ?>
			<?php $notification = $this->session->flashdata('login_status'); ?>

			// Prompt Notification
            window.notyf.open({
                type: '<?php echo $notification['type']; ?>',
                message: `<?php echo $notification['message']; ?>`,
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });

		<?php endif ?>
	</script>

</body>
</html>