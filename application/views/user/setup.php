<!-- <body> -->
    <!-- <div class="wrapper"> -->
        <!-- <div class="main"> -->
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex justify-content-between">
                                    <h1 class="h3 mt-2">Staff Set-up</h1>
                                    <?php 
                                        // Add User Button
                                        $add_attr = array(
                                            'class' => "btn btn-success" ,
                                            'data-toggle' => 'modal',
                                            'data-target' => '#addusermodal',
                                            'content' => 'Add New User'
                                        );
                                        echo form_button($add_attr);
                                    ?>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Status</th>
                                                <th class="text-center" style="width: 150px !important;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--User table body -->
                                            <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?php echo ucfirst($user->role); ?></td>
                                                <td><?php echo $user->full_name;?></td>
                                                <td><?php echo $user->name; ?></td>
                                                <td><?php echo ucfirst($user->status); ?></td>
                                                <td class="text-center">
                                                    <!--User Information Button-->
                                                    <button class ="btn border-0 text-primary" data-toggle="modal" data-target="#updateusermodal"
                                                        data-data='<?= json_encode($user)?>'>
                                                        <i data-feather="edit"></i>
                                                    </button>
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
	<?php include('application\views\user\modals.php'); ?>
	<script src="<?php echo base_url('assets/js/user.js');?>"></script>
	
	<script>
		// Notifications
		<?php if ($this->session->flashdata('setup_status')): ?>
			<?php $notification = $this->session->flashdata('setup_status'); ?>

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
</body>
</html>
