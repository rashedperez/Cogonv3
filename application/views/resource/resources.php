<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex justify-content-between">
                                    <h1 class="h3 mt-2">Resources</h1>
                                    <?php 
                                        // Add Resource Button
                                        $addresource_attr = array(
                                            'class' => "btn btn-success" ,
                                            'data-toggle' => 'modal',
                                            'data-target' => '#addresourcemodal',
                                            'content' => 'Add New Resource'
                                        );
                                        echo form_button($addresource_attr);
                                    ?>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Resource Type</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-center" style="width: 150px !important;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--Facility table body -->
                                            <?php foreach ($resources as $resource): ?>
                                            <tr>
                                                <td><?php echo ucfirst($resource->type); ?></td>
                                                <td><?php echo $resource->name;?></td>
                                                <td><?php echo $resource->price; ?></td>
                                                <td><?php echo $resource->quantity; ?></td>
                                                <td class="text-center">
                                                    <!--Resource Information Button-->
                                                    <button class="btn border-0 text-info" data-toggle="modal" data-target="#resourceinfo" data-data='<?= json_encode($resource) ?>'> 
                                                        <i data-feather="info"></i>
                                                    </button>
                                                    <button class ="btn border-0 text-primary" data-toggle="modal" data-target="#updateresourcemodal"
                                                        data-data='<?= json_encode($resource)?>'>
                                                        <i data-feather="edit"></i>
                                                    </button>
                                                    <button class="btn border-0 delete text-danger" data="<?php echo $resource->id; ?>"><i data-feather="trash"></i></button>
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
	<?php include('application\views\resource\modals.php'); ?>
	<script src="<?php echo base_url('assets/js/resource.js');?>"></script>
	
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
        $(document).ready(() => {

            // Event Listener for delete
            $('.delete').click(({ currentTarget }) => {

                // Show confirmation
                Swal.fire({
                    title: 'Are you sure you want to remove this resource?',
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
