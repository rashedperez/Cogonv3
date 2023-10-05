<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header d-md-flex justify-content-between">
									<!--Notification-->
								<?php if ($this->session->flashdata('added_facility') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('added_facility');?>"></span>
								<?php elseif($this->session->flashdata('failed_facility')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('failed_facility');?>"></span>
								<?php endif ?>

								<?php if ($this->session->flashdata('update_facility') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('update_facility');?>"></span>
								<?php elseif($this->session->flashdata('update_facility')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('update_facility');?>"></span>
								<?php endif ?>
								<?php if ($this->session->flashdata('delete_facility') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('delete_facility');?>"></span>
								<?php elseif($this->session->flashdata('delete_facility')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('delete_facility');?>"></span>
								<?php endif ?>
										<!--End Notification-->
                <h1 class="h3 mt-2">Facility List</h1>
                <?php 
                            // Add FacilitY Button
                            $addfacility_attr = array(
                              'class' => "btn btn-success" ,
                              'data-toggle' => 'modal',
                              'data-target' => '#addfacilitymodal',
                              'content' => 'Add New Facility'
                            );
                            echo form_button($addfacility_attr);
                          ?>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Facility</th>
												<th>Price</th>
												<th>Quantity</th>
												<th class="text-center" style="width: 150px !important;">Action</th>
											</tr>
										</thead>
										<tbody>
											<!--Facility table body -->
											<?php foreach ($facilities as $facility): ?>
											<tr>
												<td><?php echo $facility->name?></td>
												<td><?php echo $facility->price?></td>
												<td><?php echo $facility->quantity?></td>
												<td class="text-center">
												<!--Facility Information Button-->
												<button class="btn border-0 text-info" data-toggle="modal" data-target="#facilityinfo" data-data='<?= json_encode($facility) ?>'> 
													<i data-feather="info"></i>
												</button>
												<button class ="btn border-0 text-primary" data-toggle="modal" data-target="#updatefacilitymodal"
												data-data='<?= json_encode($facility)?>'>
												<i data-feather="edit"></i>
												</button>
												<a href="<?php echo base_url('facility/delete/' .$facility->id);?>" onclick="return confirm('Are you sure you want to remove this facility? This action cannot be undone.');"><button class ="btn border-0 text-danger"><i data-feather="trash"></i></button></a>
													
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
      <?php include('application\views\menu\modals.php'); ?>
	  <script src="<?php echo base_url('assets/js/facility.js');?>"></script>
	  
		
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
