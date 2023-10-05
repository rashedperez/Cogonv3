<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header d-md-flex justify-content-between">
									<!--Notification-->
								<?php if ($this->session->flashdata('added_amenity') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('added_amenity');?>"></span>
								<?php elseif($this->session->flashdata('failed_amenity')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('failed_amenity');?>"></span>
								<?php endif ?>

								<?php if ($this->session->flashdata('update_amenity') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('update_amenity');?>"></span>
								<?php elseif($this->session->flashdata('update_amenity')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('update_amenity');?>"></span>
								<?php endif ?>
								<?php if ($this->session->flashdata('delete_amenity') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('delete_amenity');?>"></span>
								<?php elseif($this->session->flashdata('delete_amenity')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('delete_amenity');?>"></span>
								<?php endif ?>
										<!--End Notification-->
                <h1 class="h3 mt-2">Amenity List</h1>
                <?php 
                            // Add amenity Button
                            $addamenity_attr = array(
                              'class' => "btn btn-success" ,
                              'data-toggle' => 'modal',
                              'data-target' => '#addamenitymodal',
                              'content' => 'Add New amenity'
                            );
                            echo form_button($addamenity_attr);
                          ?>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th>Amenity</th>
												<th>Price</th>
												<th>Quantity</th>
												<th class="text-center" style="width: 150px !important;">Action</th>
											</tr>
										</thead>
										<tbody>
											<!--amenity table body -->
											<?php foreach ($amenities as $amenity): ?>
											<tr>
												<td><?php echo $amenity->name?></td>
												<td><?php echo $amenity->price?></td>
												<td><?php echo $amenity->quantity?></td>
												<td class="text-center">
												<!--amenity Information Button-->
												<button class="btn border-0 text-info" data-toggle="modal" data-target="#amenityinfo" data-data='<?= json_encode($amenity) ?>'> 
													<i data-feather="info"></i>
												</button>
												<button class ="btn border-0 text-primary" data-toggle="modal" data-target="#updateamenitymodal"
												data-data='<?= json_encode($amenity)?>'>
												<i data-feather="edit"></i>
												</button>
												<a href="<?php echo base_url('amenity/delete/' .$amenity->id);?>" onclick="return confirm('Are you sure you want to remove this amenity? This action cannot be undone.');"><button class ="btn border-0 text-danger"><i data-feather="trash"></i></button></a>
													
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
	  <script src="<?php echo base_url('assets/js/amenity.js');?>"></script>
	  
		
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
