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
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mt-4">
								<h1 class="h2">Forgot password</h1>
								<p class="lead">
									Enter your username to reset your password.
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<?php echo form_open('user/check_username'); ?>
											<div class="form-group">
												<label>Username</label>
												<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your Username" required/>
											</div>
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Continue Resetting Password</button>
											</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script src="<?php echo base_url('assets/js/app.js');?>"></script>

	<script>
		// Notifications
		<?php if ($this->session->flashdata('forgot_password_status')): ?>
			<?php $notification = $this->session->flashdata('forgot_password_status'); ?>

			// Prompt Notification
            window.notyf.open({
                type: '<?php echo $notification['type']; ?>',
                message: '<?php echo $notification['message']; ?>',
                duration: 3000,
                position: {
                    x: 'center',
                    y: 'top'
                }
            });

		<?php endif ?>
	</script>

</body>


<!-- Mirrored from appstack.bootlab.io/pages-reset-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jan 2021 13:06:31 GMT -->
</html>