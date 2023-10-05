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
											<h3 class="mb-2">2</h3>
											<p class="mb-2">Today's Reservation</p>
										</div>
										<div class="d-inline-block ml-3">
											<div class="stat">
												<i class="align-middle" data-feather="calendar" style="color: red !important"></i>
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
											<h3 class="mb-2">43</h3>
											<p class="mb-2">Upcoming Reservation</p>
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
