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

							<div class="text-center mb-3">
								<h1 class="h2">Register as a resident</h1>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<?php echo form_open('resident/add'); ?>
											<div class="form-group">
												<label>First Name</label>
												<input class="form-control form-control-lg" type="text" name="fname"/>
											</div>
                                            <div class="form-group">
												<label>Last Name</label>
												<input class="form-control form-control-lg" type="text" name="lname"/>
											</div>
                                            <div class="form-group">
												<label>Address</label>
												<input class="form-control form-control-lg" type="text" name="address"/>
											</div>
											<div class="form-group">
												<label>Contact Number</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-lg border-right-0" name="phone"/>
                                                    <button class="btn btn-outline-light border verify-code" type="button" data-toggle="modal" data-target="#verify-modal" style="display: none"><span class="text-success" data-toggle="tooltip" title="Click to verify"><i class="align-middle" data-feather="check"></i></span></button>
                                                    <button class="btn btn-outline-light text-success border send-code" type="button">Send Code</button>
                                                </div>
											</div>
											
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Register as a resident</button>
											</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
                            <div class="text-center mb-3">
								<p>Already have an account? <a href="<?php echo base_url(); ?>">Log In</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

    <div class="modal fade" id="voter-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h4 class="modal-title">Voter's ID</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-0">Before registering, we require you to enter your Voter's ID to idenfity if you are a resident.</p>
                    <div class="form-group my-5">
                        <input type="text" class="text-center form-control form-control-lg" id="voters-id" placeholder="Enter your ID here..."/>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-success" id="voters-check">Check</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="verify-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h5 class="modal-title mb-1" id="staticBackdropLabel">Please enter the One-Time Password to verify your account</h5>
                        <p class="otp-guide mb-0">One-Time Password has been sent to Badang</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="d-flex justify-content-center">
                            <input type="text" class="text-center" name="otp" style="border: none; border-bottom: 1px solid black; font-size: 60px; width: 300px"/>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary px-5 mb-3 verify-code validate">Validate</button><br/>
                        <button class="btn btn-transparent send-code"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script src="<?php echo base_url('assets/js/app.js');?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

    <!-- Phone Number JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.10.49/libphonenumber-js.min.js"></script>

	<script>
		// Notifications
		<?php if ($this->session->flashdata('register_status')): ?>
			<?php $notification = $this->session->flashdata('register_status'); ?>

			// Prompt Notification
            window.notyf.open({
                type: '<?php echo $notification['type']; ?>',
                message: '<?php echo $notification['message']; ?>',
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });

		<?php endif ?>

        $(document).ready(() => {

            // Show modal
            $('#voter-modal').modal('show');

            // Minaw icheck ang voter's
            $('#voters-check').on('click', ({ currentTarget }) => {

                // Voters
                const voters_id = $('#voters-id').val();

                // Check ug nay gienter
                if (!voters_id) {
                    return window.notyf.open({
                        type: 'error',
                        message: 'Please enter you\'re Voter\'s ID',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });
                }

                // Ipatuyok2
                const button = $(currentTarget).prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Verifying...
                `);

                // Verify
                $.ajax({
                    url: '../api/voter_check',
                    method: 'POST',
                    dataType: 'json',
                    data: {  make_request: true, id: voters_id }
                })
                .done(({ status, message }) => {

                    // Tanawn ug ok ba ang status
                    if (status && status == true) {

                        // Include to form
                        $('form').prepend(`<input type="hidden" name="voters_id" value="${ voters_id }"/>`);

                        // Inotify unsa ang OTP
                        window.notyf.open({
                            type: 'success',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });

                        $('.modal').modal('hide');
                    }
                    else {

                        // Balik button
                        button.prop('disabled', false).text('Check');

                        // Error message
                        window.notyf.open({
                            type: 'error',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });
                    }
                })
                .fail((error) => {

                    // Balik sa original
                    button.prop('disabled', false).text('Check');

                    // Error message
                    window.notyf.open({
                        type: 'error',
                        message: 'Failed to verify OTP.<br/>Please try again later.',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });
                });
            });

            // Verified
            let verified = false;

            // Minaw send code
            $('.send-code').on('click', send_code);

            // Minaw ivalidate ang code
            $('.validate').on('click', (e) => {

                const input = $('[name="otp"]').val();

                try {
                    // Tan awn ug naa ba input
                    if (!input) {
                        throw 'Please enter code'
                    };
                }
                catch (error) {
                    // Prompt Error
                    window.notyf.open({
                        type: 'error',
                        message: error,
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });

                    return false;
                }

                // Spinner
                const button = $(e.currentTarget).prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Verifying...
                `);

                // Padaganon ang Api Controller kay iverify ang otp
                $.ajax({
                    url: '../api/verify_otp',
                    method: 'POST',
                    dataType: 'json',
                    data: {  make_request: true, code: input }
                })
                .done(({ status, message }) => {

                    // Tanawn ug ok ba ang status
                    if (status && status == true) {

                        verified = true;

                        $('[name="phone"]').prop('readonly', true);
                        $('.verify-code').replaceWith(`<button class="btn btn-outline-light border" type="button"><span class="text-success">Verified</span></button>`);
                        $('.send-code').remove();

                        // Inotify unsa ang OTP
                        window.notyf.open({
                            type: 'success',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });

                        $('.modal').modal('hide');
                    }
                    else {

                        // Ipakita ang input, erason ang sud
                        $('#otp-input').val('');

                        // Balik button
                        button.prop('disabled', false).text('Validate');

                        // Error message
                        window.notyf.open({
                            type: 'error',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });
                    }
                })
                .fail((error) => {

                    // Ipakita ang input, erason ang sud
                    $('[name="otp"]').val('');

                    // Taguon ang spinner, ipakita ang resend
                    button.prop('disabled', false).text('Validate');

                    // Error message
                    window.notyf.open({
                        type: 'error',
                        message: 'Failed to verify OTP.<br/>Please try again later.',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });
                });
            });

            // Minaw mosubmit
            $('form').on('submit', (e) => {

                e.preventDefault();

                // Check ug verified
                if (!verified) {

                    // Prompt Error
                    window.notyf.open({
                        type: 'error',
                        message: 'Verify phone number first',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });

                    return false;
                }

                // Disable
                const submitter = $(e.originalEvent.submitter).prop('disabled', true);

                // Data
                const data = new FormData();
                data.append('name', [$(e.target).find('[name="fname"]').val(), $(e.target).find('[name="lname"]').val()].join(' '));
                data.append('address', $(e.target).find('[name="address"]').val());
                data.append('contact_num', $(e.target).find('[name="phone"]').val());
                data.append('voters_id', $(e.target).find('[name="voters_id"]').val());

                // Get form data
                $.ajax({
                    url: e.target.action,
                    method: 'POST',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: data,
                    success: async ({ status, message, username, password, redirect }) => {
                    
                        // Show message if there is
                        if (message) {
                            Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                            }).fire({
                                icon: message.type,
                                title: message.message
                            });
                        }

                        // Password
                        if (username && password) {
                            await Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                showCloseButton: true
                            }).fire({
                                icon: 'success',
                                title: `
                                    <b>Username</b><br/>
                                    ${ username }<br/>
                                    <b>Password</b><br/>
                                    ${ password }
                                `
                            });
                        }

                        // Check if status is ok and redirect
                        if (status && status == true) {
                            window.location.replace(redirect);

                            return true;
                        }

                        // Enable ang gasubmit
                        submitter.prop('disabled', false);
                    },
                    error: () => {
                        // Show error
                        Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                        }).fire({
                            icon: 'error',
                            title: 'Something went wrong. Please try again later'
                        });

                        // Enable ang gasubmit
                        submitter.prop('disabled', false);
                    }
                });

                return false;
            });

            // Send code
            function send_code() {

                // Check ug sakto ang phone
                let number_input, phone;
  
                try {
                    number_input = $('[name="phone"]');
                    phone = libphonenumber.parsePhoneNumber(number_input.val(), 'PH');
                
                    // Check ug valid ba ang phone
                    if (!phone.isValid()) {
                        throw new Error();
                    }
                }
                catch (error) {

                    // Prompt Error
                    window.notyf.open({
                        type: 'error',
                        message: 'Invalid mobile number',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });

                    return;
                }

                number_input.val(phone.number);

                const button = $('.send-code').prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Sending...
                `);

                // Padaganon ang Api Controller kay mokuha ug otp
                $.ajax({
                    url: '../api/generate_otp',
                    method: 'POST',
                    dataType: 'json',
                    data: { make_request: true, number: number_input.val() }
                })
                .done(({ status, message, otp, guide }) => {

                    // Tanawn ug ok ba ang status
                    if (status && status == true) {

                        // Taguon ang spinner, show verify, update modal
                        button.html(`Resend in <span></span>`) && $('.verify-code').show() && $('.otp-guide').text(guide) && $('#verify-modal').modal('show');

                        // Start ang countdown makasend otp balik
                        start_countdown(200, button.find('span').get(), () => $('.verify-code').not('.validate, .validated').hide() && button.prop('disabled', false).html(`Send Code`));

                        // Inotify unsa ang OTP
                        Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            showCloseButton: true,
                        }).fire({
                            icon: 'info',
                            title: `<b>One Time Pin</b><br/>${otp}`
                        });
                    }
                    else {

                        button.prop('disabled', false).html(`Send Code`);

                        // Error message
                        window.notyf.open({
                            type: 'error',
                            message: message,
                            duration: 3000,
                            position: {
                                x: 'center',
                                y: 'top'
                            }
                        });
                    }
                })
                .fail(() => {

                    button.prop('disabled', false).html(`Send Code`);

                    // Error message
                    window.notyf.open({
                        type: 'error',
                        message: 'Failed to generate OTP.<br/>Please try again later.',
                        duration: 3000,
                        position: {
                            x: 'center',
                            y: 'top'
                        }
                    });
                });
            }

            // Magbuhat ug countdown
            function start_countdown(duration, elements, callback) {

                // Set ang timer sa gihatag na duration
                let timer = duration;

                // Update timer
                function update_timer() {

                    // Update ang element display
                    elements.map((x) => x.innerHTML = timer + 's');

                    // Countdown is done
                    if (timer <= 0) {

                        // Clear interval
                        clearInterval(interval);
                        
                        // Iparun ang mahitabo ig human
                        callback();
                    }

                    timer--;
                }

                // Display ang initial nga time
                update_timer();

                // Set Interval
                const interval = setInterval(update_timer, 1000);
            }
        });
	</script>

</body>
</html>