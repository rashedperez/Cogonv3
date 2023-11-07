<!--START RESIDENT MODALS-->
  <!-- BEGIN Add Resident modal -->
<div class="modal fade" id="addresidentmodal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Add New Resident</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
                        <?php echo form_open('resident/add');?>
                        <input type="hidden" name="id" id = "id">
												<div class="modal-body m-3">
                        <!-- Resident Name -->
                        <label for="validationCustom01" class="form-label font-weight-bold">Resident Name</label>
                            <?php 
                          $resident_name_attr = array(
                            'rows' => '1',
                            'id' => 'name',
                            'class' => 'form-control',
                            'name' => "name",
                            'placeholder' => 'Enter Resident Name',
                            'required' => 'required'
                            );
                              echo form_input($resident_name_attr);
                            ?>
                            <!--End Resident Name -->
                            <!--Resident Price -->
                        <label for="validationCustom01" class="form-label font-weight-bold mt-2">Address</label>
                        <div class = "input-group">
                           <?php 
                          $resident_address_attr = array(
                            'rows' => '1',
                            'id' => 'address',
                            'class' => 'form-control',
                            'name' => "address",
                            'placeholder' => 'Enter resident address',
                            'required' => 'required'
                            );
                              echo form_input($resident_address_attr);
                        ?>
                        </div>
                          <label for="validationCustom05" class="from-label font-weight-bold mt-2">Contact Number</label>
                          <?php
                            $resident_qty_attr = array(
                              'rows' => '1',
                              'id' => 'contact_num',
                              'class' => 'form-control mb-3',
                              'name' => 'contact_num',
                              'placeholder' => 'Enter Contact Number',
                              'required' => 'required',
                              'type' => 'text'
                            );
                            echo form_input($resident_qty_attr);
                          ?>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <?php 
                            // Add Resident Button
                            $add_resident_attr = array(
                              'class' => "btn btn-success" ,
                              'value' => "Add Resident",
                              'type' => "submit",
                              'content' => "Add Resident"
                            );
                            echo form_button($add_resident_attr);
                          ?>
                            </div>
                          <?php echo form_close(); ?>
											</div>
										</div>
									</div>
                          </div>
<!-- END Add Resident Modal -->

<!-- BEGIN Update Resident modal -->
<div class="modal fade" id="updateresidentmodal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Update Resident</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
                        <?php echo form_open('resident/update');?>
                        <input type="hidden" name="id" id = "id">
												<div class="modal-body m-3">
                        <!-- Resident Name -->
                        <label for="validationCustom01" class="form-label font-weight-bold">Resident Name</label>
                            <?php 
                          $updateresident_name_attr = array(
                            'rows' => '1',
                            'id' => 'name',
                            'class' => 'form-control',
                            'name' => "name",
                            'placeholder' => 'Enter Resident Name',
                            'required' => 'required'
                            );
                              echo form_input($updateresident_name_attr);
                            ?>
                            <!--End Resident Name -->
                            <!--Resident Price -->
                        <label for="validationCustom01" class="form-label font-weight-bold mt-2">Address</label>
                        <div class = "input-group">
                           <?php 
                          $updateresident_address_attr = array(
                            'rows' => '1',
                            'id' => 'address',
                            'class' => 'form-control',
                            'name' => "address",
                            'placeholder' => 'Enter resident address',
                            'required' => 'required'
                            );
                              echo form_input($updateresident_address_attr);
                        ?>
                        </div>
                          <label for="validationCustom05" class="from-label font-weight-bold mt-2">Contact Number</label>
                          <?php
                            $updateresident_qty_attr = array(
                              'rows' => '1',
                              'id' => 'contact_num',
                              'class' => 'form-control mb-3',
                              'name' => 'contact_num',
                              'placeholder' => 'Enter Contact Number',
                              'required' => 'required',
                              'type' => 'text'
                            );
                            echo form_input($updateresident_qty_attr);
                          ?>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <?php 
                            // Add Resident Button
                            $update_resident_attr = array(
                              'class' => "btn btn-success" ,
                              'value' => "Update Resident",
                              'type' => "submit",
                              'content' => "Update Resident"
                            );
                            echo form_button($update_resident_attr);
                          ?>
                            </div>
                          <?php echo form_close(); ?>
											</div>
										</div>
									</div>