                        <!--START FACILITY MODALS-->
<!-- BEGIN Add Facility modal -->
<div class="modal fade" id="addfacilitymodal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Add New Facility</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
                        <?php echo form_open('facility/add');?>
												<div class="modal-body m-3">
                        <!-- Facility Name -->
                        <label for="validationCustom01" class="form-label font-weight-bold">Facility Name</label>
                            <?php 
                          $facility_name_attr = array(
                            'rows' => '1',
                            'id' => 'name',
                            'class' => 'form-control',
                            'name' => "name",
                            'placeholder' => 'Enter Facility Name',
                            'required' => 'required'
                            );
                              echo form_input($facility_name_attr);
                            ?>
                            <!--End Facility Name -->
                            <!--Facility Price -->
                            <div class = "row">
                         <div class = "col-md-6 mt-3">
                        <label for="validationCustom01" class="form-label font-weight-bold mt-2">Price</label>
                        <div class = "input-group">
                        <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
                           <?php 
                          $facility_price_attr = array(
                            'rows' => '1',
                            'id' => 'price',
                            'class' => 'form-control',
                            'name' => "price",
                            'placeholder' => '00.00',
                            'required' => 'required',
                            'type' => 'number'
                            );
                              echo form_input($facility_price_attr);
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <label for="validationCustom05" class="from-label font-weight-bold mt-2">Quantity</label>
                          <?php
                            $facility_qty_attr = array(
                              'rows' => '1',
                              'id' => 'quantity',
                              'class' => 'form-control',
                              'name' => 'quantity',
                              'placeholder' => '0',
                              'required' => 'required',
                              'type' => 'number'
                            );
                            echo form_input($facility_qty_attr);
                          ?>
                        </div>
                        </div>
                         <div class="col-12- mt-3">
                            <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description </label>
                            <?php
                            // Facility Description
                            $facility_desc_attr = array(
                              'rows' => '4',
                              'id' => 'description',
                              'class' => 'form-control',
                              'name' => 'description',
                              'placeholder' => '(Optional)',
                              'required' => 'required'
                            );
                            echo form_textarea($facility_desc_attr);
                          ?>
                        </div>
												</div>
                       
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <?php 
                            // Add FacilitY Button
                            $add_facility_attr = array(
                              'class' => "btn btn-success" ,
                              'value' => "Add Facility",
                              'type' => "submit",
                              'content' => "Add Facility"
                            );
                            echo form_button($add_facility_attr);
                          ?>
                            </div>
                          <?php echo form_close(); ?>
											</div>
										</div>
									</div>
<!-- END Add Facility Modal -->

<!-- BEGIN Update Facility modal -->
<div class="modal fade" id="updatefacilitymodal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Update Facility</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
                        <?php echo form_open('facility/update');?>
                        <input type="hidden" name="id" id = "id">
												<div class="modal-body m-3">
                        <!-- Facility Name -->
                        <label for="validationCustom01" class="form-label font-weight-bold">Facility Name</label>
                            <?php 
                          $updatefacility_name_attr = array(
                            'rows' => '1',
                            'id' => 'name',
                            'class' => 'form-control',
                            'name' => "name",
                            'placeholder' => 'Enter Facility Name',
                            'required' => 'required'
                            );
                              echo form_input($updatefacility_name_attr);
                            ?>
                            <!--End Facility Name -->
                            <!--Facility Price -->
                            <div class = "row">
                         <div class = "col-md-6 mt-3">
                        <label for="validationCustom01" class="form-label font-weight-bold mt-2">Price</label>
                        <div class = "input-group">
                        <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
                           <?php 
                          $updatefacility_price_attr = array(
                            'rows' => '1',
                            'id' => 'price',
                            'class' => 'form-control',
                            'name' => "price",
                            'placeholder' => '00.00',
                            'required' => 'required',
                            'type' => 'number'
                            );
                              echo form_input($updatefacility_price_attr);
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <label for="validationCustom05" class="from-label font-weight-bold mt-2">Quantity</label>
                          <?php
                            $updatefacility_qty_attr = array(
                              'rows' => '1',
                              'id' => 'quantity',
                              'class' => 'form-control',
                              'name' => 'quantity',
                              'placeholder' => '0',
                              'required' => 'required',
                              'type' => 'number'
                            );
                            echo form_input($updatefacility_qty_attr);
                          ?>
                        </div>
                        </div>
                         <div class="col-12- mt-3">
                            <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description </label>
                            <?php
                            // Facility Description
                            $updatefacility_desc_attr = array(
                              'rows' => '4',
                              'id' => 'description',
                              'class' => 'form-control',
                              'name' => 'description',
                              'placeholder' => '(Optional)',
                              'required' => 'required'
                            );
                            echo form_textarea($updatefacility_desc_attr);
                          ?>
                        </div>
												</div>
                       
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <?php 
                            // Add FacilitY Button
                            $update_facility_attr = array(
                              'class' => "btn btn-primary" ,
                              'value' => "Update Facility",
                              'type' => "submit",
                              'content' => "Update Facility"
                            );
                            echo form_button($update_facility_attr);
                          ?>
                            </div>
                          <?php echo form_close(); ?>
											</div>
										</div>
									</div>
	<!-- END Update Facility Modal -->

  <!--Begin Facility Info Modal-->
  <div class="modal fade" id="facilityinfo" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Facility Information</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
												<div class="modal-body m-3 font-weight-bold">
                        <p><span class="font-weight-bolder" style="margin-right: 10px;">Facility Name:</span><span  id="name"> </span></p>   <br/>
                        <p><span class="font-weight-bolder" style="margin-right: 60px;" >Price: </span> ₱  <span id="price"></span>.00</p>   <br/>
                        <p> <span class="font-weight-bolder" style="margin-right: 44px;" >Quantity:</span><span  id="quantity"> </span> </p>   <br/>
                        <p><span class="font-weight-bolder" style="margin-right: 22px;">Description:</span> <span  id="description"> </span> </p>  <br/>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
<!--END Facility Info Modal-->
                                  <!--END FACILITY MODALS-->

                                 <!--START AMENITY MODALS-->

<!-- BEGIN Add Amenity modal -->
<div class="modal fade" id="addamenitymodal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Add New Amenity</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
                        <?php echo form_open('amenity/add');?>
												<div class="modal-body m-3">
                        <!-- Amenity Name -->
                        <label for="validationCustom01" class="form-label font-weight-bold">Amenity Name</label>
                            <?php 
                          $amenity_name_attr = array(
                            'rows' => '1',
                            'id' => 'name',
                            'class' => 'form-control',
                            'name' => "name",
                            'placeholder' => 'Enter Amenity Name',
                            'required' => 'required'
                            );
                              echo form_input($amenity_name_attr);
                            ?>
                            <!--End Amenity Name -->
                            <!-- Start Amenity Price -->
                            <div class = "row">
                         <div class = "col-md-6 mt-3">
                        <label for="validationCustom01" class="form-label font-weight-bold mt-2">Price</label>
                        <div class = "input-group">
                        <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
                           <?php 
                          $amenity_price_attr = array(
                            'rows' => '1',
                            'id' => 'price',
                            'class' => 'form-control',
                            'name' => "price",
                            'placeholder' => '00.00',
                            'required' => 'required',
                            'type' => 'number'
                            );
                              echo form_input($amenity_price_attr);
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <label for="validationCustom05" class="from-label font-weight-bold mt-2">Quantity</label>
                          <?php
                            $amenity_qty_attr = array(
                              'rows' => '1',
                              'id' => 'quantity',
                              'class' => 'form-control',
                              'name' => 'quantity',
                              'placeholder' => '0',
                              'required' => 'required',
                              'type' => 'number'
                            );
                            echo form_input($amenity_qty_attr);
                          ?>
                        </div>
                        </div>
                         <div class="col-12- mt-3">
                            <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description </label>
                            <?php
                            // Amenity Description
                            $amenity_desc_attr = array(
                              'rows' => '4',
                              'id' => 'description',
                              'class' => 'form-control',
                              'name' => 'description',
                              'placeholder' => '(Optional)',
                              'required' => 'required'
                            );
                            echo form_textarea($amenity_desc_attr);
                          ?>
                        </div>
												</div>
                       
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <?php 
                            // Add Amenity Button
                            $add_amenity_attr = array(
                              'class' => "btn btn-success" ,
                              'value' => "Add Amenity",
                              'type' => "submit",
                              'content' => "Add Amenity"
                            );
                            echo form_button($add_amenity_attr);
                          ?>
                            </div>
                          <?php echo form_close(); ?>
											</div>
										</div>
									</div>
<!-- END Add Amenity Modal -->

<!--Begin Amenity Info Modal-->
<div class="modal fade" id="amenityinfo" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Amenity Information</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
												</div>
												<div class="modal-body m-3 font-weight-bold">
                        <p><span class="font-weight-bolder" style="margin-right: 10px;">Amenity Name:</span><span  id="name"> </span></p>   <br/>
                        <p><span class="font-weight-bolder" style="margin-right: 60px;" >Price: </span> ₱  <span id="price"></span>.00</p>   <br/>
                        <p> <span class="font-weight-bolder" style="margin-right: 44px;" >Quantity:</span><span  id="quantity"> </span> </p>   <br/>
                        <p><span class="font-weight-bolder" style="margin-right: 22px;">Description:</span> <span  id="description"> </span> </p>  <br/>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
<!--END Facility Info Modal-->

<!-- BEGIN Update Amenity modal -->
<div class="modal fade" id="updateamenitymodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Amenity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
      </div>
      <?php echo form_open('amenity/update');?>
      <input type="hidden" name="id" id = "id">
      <div class="modal-body m-3">
      <!-- Amenity Name -->
      <label for="validationCustom01" class="form-label font-weight-bold">Amenity Name</label>
          <?php 
        $updateamenity_name_attr = array(
          'rows' => '1',
          'id' => 'name',
          'class' => 'form-control',
          'name' => "name",
          'placeholder' => 'Enter Amenity Name',
          'required' => 'required'
          );
            echo form_input($updateamenity_name_attr);
          ?>
          <!--End Amenity Name -->
          <!--Amenity Price -->
          <div class = "row">
        <div class = "col-md-6 mt-3">
      <label for="validationCustom01" class="form-label font-weight-bold mt-2">Price</label>
      <div class = "input-group">
      <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
          <?php 
        $updateamenity_price_attr = array(
          'rows' => '1',
          'id' => 'price',
          'class' => 'form-control',
          'name' => "price",
          'placeholder' => '00.00',
          'required' => 'required',
          'type' => 'number'
          );
            echo form_input($updateamenity_price_attr);
      ?>
      </div>
      </div>
      <div class="col-md-6 mt-3">
        <label for="validationCustom05" class="from-label font-weight-bold mt-2">Quantity</label>
        <?php
          $updateamenity_qty_attr = array(
            'rows' => '1',
            'id' => 'quantity',
            'class' => 'form-control',
            'name' => 'quantity',
            'placeholder' => '0',
            'required' => 'required',
            'type' => 'number'
          );
          echo form_input($updateamenity_qty_attr);
        ?>
      </div>
      </div>
        <div class="col-12- mt-3">
          <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description </label>
          <?php
          // Amenity Description
          $updateamenity_desc_attr = array(
            'rows' => '4',
            'id' => 'description',
            'class' => 'form-control',
            'name' => 'description',
            'placeholder' => '(Optional)',
            'required' => 'required'
          );
          echo form_textarea($updateamenity_desc_attr);
        ?>
      </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?php 
          // Add Amenity Button
          $update_amenity_attr = array(
            'class' => "btn btn-primary" ,
            'value' => "Update Amenity",
            'type' => "submit",
            'content' => "Update Amenity"
          );
          echo form_button($update_amenity_attr);
        ?>
          </div>
        <?php echo form_close(); ?>
    </div>
  </div>
</div>
	<!-- END Update Amenity Modal -->

                            <!--END AMENITY MODALS-->

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
                            <div class = "row">
                         <div class = "col-md-6 mt-3">
                        <label for="validationCustom01" class="form-label font-weight-bold mt-2">Price</label>
                        <div class = "input-group">
                        <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
                           <?php 
                          $resident_price_attr = array(
                            'rows' => '1',
                            'id' => 'price',
                            'class' => 'form-control',
                            'name' => "price",
                            'placeholder' => '00.00',
                            'required' => 'required',
                            'type' => 'number'
                            );
                              echo form_input($resident_price_attr);
                        ?>
                        </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <label for="validationCustom05" class="from-label font-weight-bold mt-2">Quantity</label>
                          <?php
                            $resident_qty_attr = array(
                              'rows' => '1',
                              'id' => 'quantity',
                              'class' => 'form-control',
                              'name' => 'quantity',
                              'placeholder' => '0',
                              'required' => 'required',
                              'type' => 'number'
                            );
                            echo form_input($resident_qty_attr);
                          ?>
                        </div>
                        </div>
                         <div class="col-12- mt-3">
                            <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description </label>
                            <?php
                            // Resident Description
                            $resident_desc_attr = array(
                              'rows' => '4',
                              'id' => 'description',
                              'class' => 'form-control',
                              'name' => 'description',
                              'placeholder' => '(Optional)',
                              'required' => 'required'
                            );
                            echo form_textarea($resident_desc_attr);
                          ?>
                        </div>
												</div>
                       
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
<!-- END Add Resident Modal -->
