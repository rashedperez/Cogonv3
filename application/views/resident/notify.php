<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
        <main class="content">
				<div class="container-fluid p-0">
                    <h1 class="h3 mt-2">Notify Resident</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header border-bottom">
                                    <div class="row">
                                        <div class="col-auto align-items-center">
                                            <div class="d-inline-block bg-dark" style="height: 50px; width: 50px; border-radius: 50%"></div>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <p class="d-inline-block mb-0">This feature allows the barangay to send SMS messages to residents in order to inform them about updates, initiatives, and upcoming events within the barangay.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-5">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="message" required/>
                                            <button class="btn btn-primary btn-send">Send</button>
                                        </div>
                                    </form>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php include('application\views\menu\footer.php'); ?>
		</div>
	</div>

	<script>
		$(document).ready(() => {

            // Bantay iclick ang send
            $('form').submit('click', (e) => {

                const submitter = $(e.originalEvent.submitter).prop('disabled', true);
                const message_input = $('#message');

                // Perform request
                $.ajax({
                    url: '../api/notify_resident',
                    method: 'POST',
                    dataType: 'json',
                    data: { make_request: true, message: message_input.val() },
                    success: ({ status, message }) => {

                        // Check status
                        if (status && status == true) {

                            // Prompt Notification
                            window.notyf.open({
                                type: 'success',
                                message: message,
                                duration: 3000,
                                position: {
                                    x: 'right',
                                    y: 'top'
                                }
                            });

                            // Empty ang message
                            message_input.val('');
                        }
                        else {
                            // Show error
                            Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                }).fire({
                                    icon: 'error',
                                    title: message
                                });
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
		});
	</script>
</body>
