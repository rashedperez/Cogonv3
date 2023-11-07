<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
			<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header d-md-flex justify-content-between">
									<h1 class="h3 mt-2">Resident List</h1>
									<?php 
										// Add Resident Button
										$addresident_attr = array(
											'class' => "btn btn-success" ,
											'data-toggle' => 'modal',
											'data-target' => '#addresidentmodal',
											'content' => 'Add New Resident'
										);
										echo form_button($addresident_attr);
									?>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Resident</th>
												<th>Address</th>
												<th>Contact Number</th>
												<th class="text-center" style="width: 150px !important;">Action</th>
											</tr>
										</thead>
										<tbody>
											<!--Resident table body -->
											<?php foreach ($resident as $resident): ?>
											<tr>
												<td><?php echo $resident->name?></td>
												<td><?php echo $resident->address?></td>
												<td><?php echo $resident->contact_num?></td>
												<td class="text-center">
													<button class ="btn border-0 text-primary" data-toggle="modal" data-target="#updateresidentmodal"
													data-data='<?= json_encode($resident)?>'>
													<i data-feather="edit"></i>
													</button>
													<button class="btn border-0 delete text-danger" data="<?php echo $resident->id; ?>"><i data-feather="trash"></i></button>
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
	<?php include('application\views\menu\resident_modal.php'); ?>
	<script src="<?php echo base_url('assets/js/resident.js');?>"></script>

	<!-- Phone Number JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.10.49/libphonenumber-js.min.js"></script>
	  
	<script>
		// Notifications
		<?php if ($this->session->flashdata('resident_status')): ?>
			<?php $notification = $this->session->flashdata('resident_status'); ?>

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
		$(document).ready(() => {

			// Set DataTable Instance
            $('table').DataTable({
                dom: 'Bfrtip',
				responsive: true,
				lengthChange: !1,
                buttons: ['copy', 'print']
			});

			// Event Listener for delete
			$('.delete').click(({ currentTarget }) => {

				// Show confirmation
				Swal.fire({
					title: 'Are you sure you want to remove this resident?',
					text: 'This action cannot be undone',
					showDenyButton: true,
					confirmButtonText: 'Delete',
					confirmButtonColor: '#E03444',
					denyButtonText: 'Cancel',
					denyButtonColor: '#495057',
					reverseButtons: true
				}).then((result) => {
					
					// Confirmed
					if (result.isConfirmed) {
						
						// Delete
						window.location = 'delete/' + currentTarget.getAttribute('data');
					}
				});
			});
		});
	</script>
</body>
