<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex justify-content-between">
                                    <h1 class="h3 mt-2">Reservation</h1>
                                    <a href="<?php echo base_url('reservation/reservation_index'); ?>" class="btn btn-success p-2">Add Reservation</a>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Reservation ID</th>
                                                <th class="text-center">Date of Reservation</th>
                                                <th class="text-center">Reserved Resources</th>
                                                <th class="text-center">Reserver</th>
                                                <th class="text-center">Date Reserved</th>
                                                <th class="text-center" style="width: 150px !important;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Reservation table body -->
                                            <?php foreach ($reservations as $reservation): ?>
                                            <tr>
                                                <?php
                                                    // Get Facilities
                                                    $facilities = array_filter($reservation->resources, function ($resource) {
                                                        return $resource->data->type == RESOURCE_FACILITY;
                                                    });

                                                    // Get Amenities
                                                    $amenities = array_filter($reservation->resources, function ($resource) {
                                                        return $resource->data->type == RESOURCE_AMENITY;
                                                    });
                                                ?>
                                                <td><?php echo $reservation->formatted_id; ?></td>
                                                <td class="text-center"><?php echo date('F j, Y', strtotime($reservation->date_reservation)); ?></td>
                                                <td class="text-center" style="max-width: 150px">
                                                    <?php if (!empty($facilities)): ?>
                                                        <span class="text-ellipsis">
                                                            <b>Facility:</b>
                                                            <span class="text-muted">
                                                                <?php echo implode(', ', array_map(function ($facility) {
                                                                    return $facility->data->name;
                                                                }, $facilities)); ?>
                                                            </span>
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if (!empty($amenities)): ?>
                                                        <span class="text-ellipsis">
                                                            <b>Amenity:</b>
                                                            <span class="text-muted">
                                                                <?php echo implode(', ', array_map(function ($amenity) {
                                                                    return $amenity->data->name;
                                                                }, $amenities)); ?>
                                                            </span>
                                                        </span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center"><?php echo $reservation->reserver; ?></td>
                                                <td class="text-center"><?php echo date('F j, Y - g:i A', strtotime($reservation->date_reserved)); ?></td>
                                                <td class="text-center">
                                                    <!--Reservation Information Button-->
                                                    <button class="btn border-0 text-info" data-toggle="modal" data-target="#reservationinfo" data-data='<?= json_encode($reservation) ?>'> 
                                                        <i data-feather="info"></i>
                                                    </button>
                                                    <a href="<?php echo base_url('reservation/edit/' . $reservation->id); ?>" class="btn border-0 text-primary">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
	<?php include('application\views\reservation\modals.php'); ?>
	<script src="<?php echo base_url('assets/js/reservation.js');?>"></script>
	
	<script>
		// Notifications
		<?php if ($this->session->flashdata('resource_status')): ?>
			<?php $notification = $this->session->flashdata('resource_status'); ?>

			// Prompt Notification
			Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
			}).fire({
				icon: '<?php echo $notification['type']; ?>',
				title: '<?php echo $notification['message']; ?>'
			});

		<?php endif ?>
	</script>
		
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables with Buttons
			var datatablesButtons = $("#datatables-buttons").DataTable({
				responsive: true,
				lengthChange: !1,
				buttons: ["copy", "print"]
			});
			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
		});
	</script>
</body>
</html>
