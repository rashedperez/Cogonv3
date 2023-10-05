
	<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header d-md-flex justify-content-between">
									<!--Notification-->
								<?php if ($this->session->flashdata('added_resident') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('added_resident');?>"></span>
								<?php elseif($this->session->flashdata('failed_resident')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('failed_resident');?>"></span>
								<?php endif ?>

								<?php if ($this->session->flashdata('update_resident') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('update_resident');?>"></span>
								<?php elseif($this->session->flashdata('update_resident')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('update_resident');?>"></span>
								<?php endif ?>
								<?php if ($this->session->flashdata('delete_resident') != null ): ?>
													<span  class = "d-none" id = "<?php echo $this->session->flashdata('delete_resident');?>"></span>
								<?php elseif($this->session->flashdata('delete_resident')!=null):?>
													<span class = "d-none" id = "<?php echo $this->session->flashdata('delete_resident');?>"></span>
								<?php endif ?>
										<!--End Notification-->
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
												<a href="<?php echo base_url('resident/delete/' .$resident->id);?>" onclick="return confirm('Are you sure you want to remove this resident? This action cannot be undone.');"><button class ="btn border-0 text-danger"><i data-feather="trash"></i></button></a>
													
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
      <?php include('application\views\menu\resident_modal.php'); ?>
	  <script src="<?php echo base_url('assets/js/resident.js');?>"></script>
	  
		
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
