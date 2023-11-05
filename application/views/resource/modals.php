<!-- BEGIN Add Resource modal -->
<div class="modal fade" id="addresourcemodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Resource</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('resource/add');?>
        <div class="modal-body mx-3 py-3">
          <!--Resource Price -->
          <div class = "row">
            <div class="col-12 mt-3">
              <!-- Resource Type Gi Mano2 ug ug echo kay walay selected disabled sa form dropdown codeigniter -->
              <label for="validationCustom01" class="form-label font-weight-bold">Resource Type</label>
              <select name="type" class="form-control">
                <option selected disabled>Choose...</option>
                <option value="<?php echo RESOURCE_FACILITY; ?>"><?php echo ucfirst(RESOURCE_FACILITY); ?></option>
                <option value="<?php echo RESOURCE_AMENITY; ?>"><?php echo ucfirst(RESOURCE_AMENITY); ?></option>
              </select>
              <!--End Resource Type -->
            </div>
            <div class="col-12 mt-3">
              <!-- Resource Name -->
              <label for="validationCustom01" class="form-label font-weight-bold">Resource Name</label>
              <?php 
                $addresource_name_attr = array(
                  'rows' => '1',
                  'id' => 'name',
                  'class' => 'form-control',
                  'name' => "name",
                  'placeholder' => 'Enter Resource Name',
                  'required' => 'required'
                );
                
                echo form_input($addresource_name_attr);
              ?>
              <!--End Resource Name -->
            </div>
            <div class = "col-md-6 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold">Price per</label>
              <select name="per" class="form-control">
                <option selected disabled>Choose...</option>
                <option value="<?php echo HOUR; ?>"><?php echo ucfirst(HOUR); ?></option>
                <option value="<?php echo KILOMETER; ?>"><?php echo ucfirst(KILOMETER); ?></option>
                <option value="<?php echo QUANTITY; ?>"><?php echo ucfirst(QUANTITY); ?></option>
              </select>
            </div>
            <div class = "col-md-6 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold price-label">Price</label>
              <div class = "input-group">
                <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
                <?php 
                  $addresource_price_attr = array(
                    'rows' => '1',
                    'id' => 'price',
                    'class' => 'form-control',
                    'name' => "price",
                    'placeholder' => '00.00',
                    'required' => 'required',
                    'type' => 'number'
                  );

                  echo form_input($addresource_price_attr);
                ?>
              </div>
            </div>
            <div class="col-md-6 mt-3" style="display: none">
              <label for="validationCustom05" class="from-label font-weight-bold">Rental Fee</label>
              <?php
                $resource_rental_fee_attr = array(
                  'id' => 'rental-fee',
                  'class' => 'form-control rental-fee',
                  'name' => 'rental_fee',
                  'placeholder' => '',
                  'type' => 'number'
                );

                echo form_input($resource_rental_fee_attr);
              ?>
            </div>
            <div class="col-md-6 mt-3">
              <label for="validationCustom05" class="from-label font-weight-bold">Quantity</label>
              <?php
                $resource_qty_attr = array(
                  'rows' => '1',
                  'id' => 'quantity',
                  'class' => 'form-control',
                  'name' => 'quantity',
                  'placeholder' => '',
                  'required' => 'required',
                  'type' => 'number'
                );

                echo form_input($resource_qty_attr);
              ?>
            </div>
            <div class="col-12 mt-3">
              <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description <span class="text-muted">(Optional)</span></label>
                <?php
                  // Resource Description
                  $addresource_desc_attr = array(
                      'rows' => '4',
                      'id' => 'description',
                      'class' => 'form-control',
                      'name' => 'description'
                  );

                  echo form_textarea($addresource_desc_attr);
                ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php 
            // Add Resource Button
            $add_resource_attr = array(
              'class' => 'btn btn-success',
              'value' => 'Add Resource',
              'type' => 'submit',
              'content' => 'Save Resources'
            );

            echo form_button($add_resource_attr);
          ?>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- END Add Resource Modal -->

<!-- BEGIN Update Resource modal -->
<div class="modal fade" id="updateresourcemodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Resource</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('resource/update');?>
        <input type="hidden" name="id" id="id"/>
        <div class="modal-body mx-3 py-3">
          <!--Resource Price -->
          <div class = "row">
            <div class="col-12 mt-3">
              <!-- Resource Type -->
              <label for="validationCustom01" class="form-label font-weight-bold">Resource Type</label>
              <?php 
                $updateresource_type_attr = array(
                  RESOURCE_FACILITY => ucfirst(RESOURCE_FACILITY),
                  RESOURCE_AMENITY => ucfirst(RESOURCE_AMENITY)
                );
                
                echo form_dropdown('type', $updateresource_type_attr, [], ['class' => 'form-control', 'id' => 'type']);
              ?>
              <!--End Resource Type -->
            </div>
            <div class="col-12 mt-3">
              <!-- Resource Name -->
              <label for="validationCustom01" class="form-label font-weight-bold">Resource Name</label>
              <?php 
                $updateresource_name_attr = array(
                  'rows' => '1',
                  'id' => 'name',
                  'class' => 'form-control',
                  'name' => "name",
                  'placeholder' => 'Enter Resource Name',
                  'required' => 'required'
                );
                
                echo form_input($updateresource_name_attr);
              ?>
              <!--End Resource Name -->
            </div>
            <div class = "col-md-6 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold">Price per</label>
              <select id="per" name="per" class="form-control">
                <option selected disabled>Choose...</option>
                <option value="<?php echo HOUR; ?>"><?php echo ucfirst(HOUR); ?></option>
                <option value="<?php echo KILOMETER; ?>"><?php echo ucfirst(KILOMETER); ?></option>
                <option value="<?php echo QUANTITY; ?>"><?php echo ucfirst(QUANTITY); ?></option>
              </select>
            </div>
            <div class = "col-md-6 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold price-label">Price</label>
              <div class = "input-group">
                <span class = "input-group-text" id = "inputGroupPrepend">₱</span>
                <?php 
                  $updateresource_price_attr = array(
                    'rows' => '1',
                    'id' => 'price',
                    'class' => 'form-control',
                    'name' => "price",
                    'placeholder' => '00.00',
                    'required' => 'required',
                    'type' => 'number'
                  );

                  echo form_input($updateresource_price_attr);
                ?>
              </div>
            </div>
            <div class="col-md-6 mt-3" style="display: none">
              <label for="validationCustom05" class="from-label font-weight-bold">Rental Fee</label>
              <?php
                $resource_rental_fee_attr = array(
                  'id' => 'rental-fee',
                  'class' => 'form-control rental-fee',
                  'name' => 'rental_fee',
                  'placeholder' => '',
                  'type' => 'number'
                );

                echo form_input($resource_rental_fee_attr);
              ?>
            </div>
            <div class="col-md-6 mt-3">
              <label for="validationCustom05" class="from-label font-weight-bold">Quantity</label>
              <?php
                $updateresource_qty_attr = array(
                  'rows' => '1',
                  'id' => 'quantity',
                  'class' => 'form-control',
                  'name' => 'quantity',
                  'placeholder' => '',
                  'required' => 'required',
                  'type' => 'number'
                );

                echo form_input($updateresource_qty_attr);
              ?>
            </div>
            <div class="col-12 mt-3">
              <label for="validationCustom05" class="form-label font-weight-bold mt-2"> Description <span class="text-muted">(Optional)</span></label>
              <?php
                // Resource Description
                $updateresource_desc_attr = array(
                    'rows' => '4',
                    'id' => 'description',
                    'class' => 'form-control',
                    'name' => 'description',
                    'required' => 'required'
                );

                echo form_textarea($updateresource_desc_attr);
                ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php 
            // Add Resource Button
            $update_resource_attr = array(
              'class' => 'btn btn-success',
              'value' => 'Update Resource',
              'type' => 'submit',
              'content' => 'Update Resource'
            );

            echo form_button($update_resource_attr);
          ?>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- END Update Resource Modal -->

<!--Begin Facility Info Modal-->
<div class="modal fade" id="resourceinfo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Facility Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3 font-weight-bold">
        <div class="row">
          <div class="col-4">
            <p class="font-weight-bolder">Resource Type:</p>
          </div>
          <div class="col-8">
            <p id="type"></p>
          </div>
          <div class="col-4">
            <p class="font-weight-bolder">Resource Name:</p>
          </div>
          <div class="col-8">
            <p id="name"></p>
          </div><div class="col-4">
            <p class="font-weight-bolder">Price per <span id="per"></span>:</p>
          </div>
          <div class="col-8">
            <p>₱<span id="price"></span></p>
          </div><div class="col-4">
            <p class="font-weight-bolder">Quantity:</p>
          </div>
          <div class="col-8">
            <p id="quantity"></p>
          </div>
          <div class="col-4">
            <p class="font-weight-bolder">Description:</p>
          </div>
          <div class="col-8">
            <p id="description"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--END Facility Info Modal-->