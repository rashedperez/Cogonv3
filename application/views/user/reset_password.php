
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
								<h1 class="h2">Reset password</h1>
								<p class="lead">
									For security, update your temporary password
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<?php echo form_open('user/update_new_password'); ?>
											<input type="hidden" name="id" value="<?php echo $this->session->userdata('reset_password_user_id'); ?>">
											<div class="form-group">
												<label>Enter New Password</label>
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter New Password" />
											</div>
                                            <div class="form-group">
												<label>Confirm New Password</label>
												<input class="form-control form-control-lg" type="password" name="password_confirm" placeholder=" Confirm New Password" />
											</div>
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Reset password</button>
											</div>
										<?php echo form_open(); ?>
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
		$(document).ready(() => {

			// Bantay nay mosubmit nga form
			$('form').on('submit', (e) => {

				// Dili isubmit
				e.preventDefault();

				// Disable ang nagsubmit
				const submitter = $(e.originalEvent.submitter).prop('disabled', true);

				// Get form data
				$.ajax({
					url: e.target.action,
					method: 'POST',
					dataType: 'json',
					data: $(e.target).serialize(),
					success: ({ status, message, redirect }) => {
						
						// Show message if there is
						if (message) {
							window.notyf.open({
								type: message.type,
								message: message.message,
								duration: 3000,
								position: {
									x: 'right',
									y: 'top'
								}
							});
						}

						// Check if status is ok and redirect
						if (status && status == true) {

							// Hawanan ang session
							sessionStorage.clear();

							// Balhin
							window.location.replace(redirect);

							return true;
						}

						// Enable ang gasubmit
						submitter.prop('disabled', false);
					},
					error: () => {
						// Show error
						window.notyf.open({
							type: 'error',
							message: 'Something went wrong. Please try again later',
							duration: 3000,
							position: {
								x: 'right',
								y: 'top'
							}
						});

						// Enable ang gasubmit
						submitter.prop('disabled', false);
					}
				});

				// Dili isubmit
				return false;
			});
		});
	</script>

</body>


<!-- Mirrored from appstack.bootlab.io/pages-reset-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Jan 2021 13:06:31 GMT -->
</html>