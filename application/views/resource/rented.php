<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="h3 mt-2">Rented Resources</h1>
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
                                                <th class="text-center">Total Amount Paid</th>
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
                                                <td class="text-center">₱<?php echo $reservation->total_amount_paid; ?> </td>
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
            <?php include('application\views\menu\footer.php'); ?>
        </div>
    </div>
	<?php include('application\views\reservation\modals.php'); ?>
	<script src="<?php echo base_url('assets/js/reservation.js');?>"></script>
	
	<script>
		// Notifications
		<?php if ($this->session->flashdata('resource_status')): ?>
			<?php $notification = $this->session->flashdata('resource_status'); ?>

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
		
	<script>
		$(document).ready(() => {
            
            // Set DataTable Instance
            $('table').DataTable({
                dom: 'Bfrtip',
				responsive: true,
				lengthChange: !1,
                buttons: ['copy', 'print']
			});
        });
	</script>
</body>
</html>
