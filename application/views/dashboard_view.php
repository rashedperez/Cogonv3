			<main class="content">
				<div class="container-fluid p-0">

					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3>Dashboard</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-6 col-xxl d-flex">
							<div class="card flex-fill">
								<div class="card-body py-4">
									<div class="media">
										<div class="media-body">
											<h3 class="mb-2"><?php echo count($confirmed); ?></h3>
											<p class="mb-2">Confirmed Reservations</p>
										</div>
										<div class="d-inline-block ml-3">
											<div class="stat">
												<i class="align-middle" data-feather="calendar" style="color: green !important"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-xxl d-flex">
							<div class="card flex-fill">
								<div class="card-body py-4">
									<div class="media">
										<div class="media-body">
											<h3 class="mb-2"><?php echo count($pending); ?></h3>
											<p class="mb-2">Pending Reservations</p>
										</div>
										<div class="d-inline-block ml-3">
											<div class="stat text-success">
												<i class="align-middle" data-feather="calendar"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

	<script>
		// Notifications
		<?php if ($this->session->flashdata('dashboard_status')): ?>
			<?php $notification = $this->session->flashdata('dashboard_status'); ?>

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
	</script>

	<!-- Calendar Script -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datetimepicker-dashboard").datetimepicker({
				inline: true,
				sideBySide: false,
				format: "L"
			});
		});
	</script>
</body>
