<div class="modal fade" id="passwordchange" tabindex="-1" role="dialog" aria-labelledby="modalpasswordchangeLabel" aria-hidden="true">
        <div class="modal-dialog mymodal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                        </button>
                </div>
            <div class="modal-body">

              <form>
                  <input type="hidden" id="password-change-id" value="<?php echo  $_SESSION['userid'];?>" >
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                    <label class="control-label" for="currentpassword">Current Password</label>
                    <div class="password-eye">
                    <input id="keyed_Password" name="currentpassword" type="password" placeholder="" class="form-control ">
                    <span data-toggle="#keyed_Password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <span id="currentpass" class="text-danger small" style="display:none">Field Required!</span>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label class="control-label" for="newpassword">New Password</label>
                            <div class="password-eye">
                                <input id="New_Password" type="password" class="form-control" name="New_Password" placeholder="New Password">
                                <span data-toggle="#New_Password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                             <span id="newpass" class="text-danger small" style="display: none">Field Required!</span>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="retypepassword">Confirm Password</label>
                            <div class="password-eye">
                                <input id="Confirm_Password" type="password" class="form-control" name="Confirm_Password" placeholder="Confirm Password">
                                <span data-toggle="#Confirm_Password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <span id="passmatch" class="text-danger small" style="display: none">Password Mismatch</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="button" id="vchange_password" class="btn btn-primary btn-rounded">Change Password</button>
                    </div>

                </div>
            </form>   
                  
            </div>
        </div>
        </div>
</div>