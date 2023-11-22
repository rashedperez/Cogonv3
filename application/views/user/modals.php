<!-- BEGIN Add User modal -->
<div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <?php echo form_open('user/add');?>
      <div class="modal-header">
        <h5 class="modal-title">Add New User</h5>
      </div>
        <div class="modal-body mx-3 py-3">
          <div class = "row">
            <div class="col-12 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold">Role</label>
              <select name="role" id="role" class="form-control">
                <option selected disabled>Choose...</option>
                <option value="<?php echo ADMIN; ?>"><?php echo ucfirst(ADMIN); ?></option>
                <option value="<?php echo STAFF; ?>"><?php echo ucfirst(STAFF); ?></option>
              </select>
            </div>
            <div class="col-12 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold">Full name</label>
              <?php 
                $addfullname_attr = array(
                  'id' => 'full_name',
                  'class' => 'form-control',
                  'name' => "full_name",
                  'required' => 'required'
                );
                
                echo form_input($addfullname_attr);
              ?>
            </div>
            <div class="col-12 mt-3">
              <!-- User Name -->
              <label for="validationCustom01" class="form-label font-weight-bold">Username</label>
              <?php 
                $addusername_attr = array(
                  'id' => 'username',
                  'class' => 'form-control',
                  'name' => "username",
                  'required' => 'required'
                );
                
                echo form_input($addusername_attr);
              ?>
              <!--End User Name -->
            </div>
            <div class="col-12 mt-3">
              <!-- Password Name -->
              <label for="validationCustom01" class="form-label font-weight-bold">Password</label>
              <?php 
                $addpassword_attr = array(
                  'id' => 'name',
                  'type' => 'password',
                  'class' => 'form-control',
                  'name' => "password",
                  'required' => 'required'
                );
                
                echo form_input($addpassword_attr);
              ?>
              <!--End Password Name -->
            </div>
            <div class="col-12 mt-3">
              <!-- Confirim Password Name -->
              <label for="validationCustom01" class="form-label font-weight-bold">Confirm Password</label>
              <?php 
                $addconfirmpassword_attr = array(
                  'id' => 'name',
                  'type' => 'password',
                  'class' => 'form-control',
                  'name' => "password_confirm",
                  'required' => 'required'
                );
                
                echo form_input($addconfirmpassword_attr);
              ?>
              <!--End Confirim Password Name -->
            </div>
          </div>
        </div>
        <div class="modal-footer mx-3 py-3">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php 
            // Add Resource Button
            $add_resource_attr = array(
              'class' => 'btn btn-success px-4',
              'value' => 'Add Resource',
              'type' => 'submit',
              'content' => 'Add User'
            );

            echo form_button($add_resource_attr);
          ?>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- END Add User Modal -->

<!-- BEGIN Update User modal -->
<div class="modal fade" id="updateusermodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <?php echo form_open('user/update');?>
        <div class="modal-header">
          <h5 class="modal-title">Update User</h5>
          <label>
              <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="status" id="status">
                  <label class="form-check-label">Active</label>
              </div>
          </label>
        </div>
        <div class="badang" style="display: none">
          <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-qv3pQfyqQjs%2FXs6IG8kjpDI%2FAAAAAAAACqI%2FXojjhdY5rw0ZVrfaiQJS9X1uHEcc5ynlgCLcBGAsYHQ%2Fs1600%2FWallpaper-Badang-Tribal-Warrior-Skin-Mobile-Legends-HD-for-Mobile-Hobigame.jpg&f=1&nofb=1&ipt=b35852d16bf71ad3e205c416512b49c5b57c752e46806b5eb815ac92bf1054ca&ipo=images" alt="" class="img-fluid"/>
        </div>
        <div class="modal-body mx-3 py-3">
          <input type="hidden" id="id" name="id"/>
          <div class = "row">
            <div class="col-12 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold">Role</label>
              <select name="role" id="role" class="form-control" disabled>
                <option selected disabled>Choose...</option>
                <option value="<?php echo ADMIN; ?>"><?php echo ucfirst(ADMIN); ?></option>
                <option value="<?php echo STAFF; ?>"><?php echo ucfirst(STAFF); ?></option>
              </select>
            </div>
            <div class="col-12 mt-3">
              <label for="validationCustom01" class="form-label font-weight-bold">Full name</label>
              <?php 
                $updatefullname_attr = array(
                  'id' => 'full_name',
                  'class' => 'form-control',
                  'name' => "full_name",
                  'required' => 'required',
                  'disabled' => 'disabled'
                );
                
                echo form_input($updatefullname_attr);
              ?>
            </div>
            <div class="col-12 mt-3">
              <!-- User Name -->
              <label for="validationCustom01" class="form-label font-weight-bold">Username</label>
              <?php 
                $updateusername_attr = array(
                  'id' => 'username',
                  'class' => 'form-control',
                  'name' => "username",
                  'required' => 'required',
                  'disabled' => 'disabled'
                );
                
                echo form_input($updateusername_attr);
              ?>
              <!--End User Name -->
            </div>
            <div class="col-12 mt-3">
              <a href="#resetpassword">Reset Password</a>
            </div>
          </div>
        </div>
        <div class="modal-footer mx-3 py-3">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php 
            // Add Resource Button
            $add_resource_attr = array(
              'class' => 'btn btn-success',
              'value' => 'Add Resource',
              'type' => 'submit',
              'content' => 'Update Member'
            );

            echo form_button($add_resource_attr);
          ?>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- END Update User Modal -->

<!-- Reset Password Modal -->
<div class="modal fade" id="resetpasswordmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <?php echo form_open('user/temp_reset');?>
        <div class="modal-body mx-3 py-3">
          <div class="title text-center">
            <h2>Reset Password for <span>"Bangangdaang"</span></h2>
            <h4 class="text-muted">Create temporary password</h4>
          </div>
          <input type="hidden" id="id" name="id"/>
          <div class="mx-3 py-3 d-flex justify-content-center">
            <?php 
              // Add Resource Button
              $add_resource_attr = array(
                'class' => 'btn btn-primary',
                'value' => 'Add Resource',
                'type' => 'submit',
                'content' => 'Reset'
              );

              echo form_button($add_resource_attr);
            ?>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- Reset Password Modal -->