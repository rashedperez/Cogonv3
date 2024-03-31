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
                                                    <div class="d-flex justify-content-center">
                                                        <?php if ($this->session->userdata('role') == RESIDENT): ?>
                                                        <button class="btn btn-outline-secondary btn-sm mr-1 rounded" data-toggle="modal" data-target="#reservationinfo" data-data='<?= json_encode($reservation) ?>'>Info</button>
                                                        <a href="<?php echo base_url('reservation/edit/' . $reservation->id); ?>" class="btn btn-outline-info btn-sm rounded">Update</a>
                                                        <?php else: ?>
                                                        <button class="btn btn-outline-warning btn-sm rounded" data-toggle="modal" data-target="#reservation-payment" data-data='<?= json_encode($reservation) ?>'>Confirm Reservation</button>
                                                        <!-- Dropleft (Muabli sa wala ig click sa naay data-toggle="dropdown") -->
                                                        <div class="dropleft">
                                                            <!-- Three Dots Button-->
                                                            <button class="btn btn-transparent p-1" data-toggle="dropdown" aria-expanded="false">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <!-- Reservation Information Button-->
                                                                <a class="dropdown-item border-0" data-toggle="modal" data-target="#reservationinfo" data-data='<?= json_encode($reservation) ?>'> 
                                                                    <i class="mr-2" data-feather="info"></i>Info
                                                                </a>
                                                                <!-- Reservation Update Button-->
                                                                <a href="<?php echo base_url('reservation/edit/' . $reservation->id); ?>" class="dropdown-item border-0">
                                                                    <i class="mr-2" data-feather="edit"></i>Update
                                                                </a>
                                                            </ul>
                                                        </div>
                                                        <?php endif ?>
                                                    </div>
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
            <?php include('application\views\menu\footer.php'); ?>
        </div>
    </div>
	<?php include('application\views\reservation\modals.php'); ?>
	<script src="<?php echo base_url('assets/js/reservation.js');?>"></script>
	
	<script>
		// Notifications
		<?php if ($this->session->flashdata('reservation_status')): ?>
			<?php $notification = $this->session->flashdata('reservation_status'); ?>

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

            // Event Listener for Pay Clicked
            $('.btn-pay').click(({ currentTarget }) => {

                // Show confirmation
                Swal.fire({
                    title: 'Confirm Payment',
                    text: 'This reservation will be marked as paid',
                    showDenyButton: true,
                    confirmButtonText: 'Confirm',
                    confirmButtonColor: '#4bbf73',
                    denyButtonText: 'Cancel',
                    denyButtonColor: '#495057',
                    reverseButtons: true
                }).then((result) => {
                    
                    // Confirmed
                    if (result.isConfirmed) {
                        
                        // Submit form
                        $(currentTarget).closest('form').trigger('submit');
                    }
                    else {
                        Swal.mixin({
                            toast: true,
                            position: 'center',
                            showConfirmButton: false,
                            timer: 1000,
                        }).fire({
                            icon: 'error',
                            text: 'Payment cancelled'
                        });

                        // Close modal
                        $('#reservation-payment').modal('hide');
                    }
                });
            });
        });
    </script>
</body>
</html>
