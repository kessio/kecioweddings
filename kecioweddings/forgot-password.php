<section class="wide-tb-70" style="margin-top: 80px">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 mx-auto">
                        <div class="text-center">
                            <h2 class="fw-7">Password Recovery</h2>
                           <div class="card-shadow-body bg-white">
                            <form id="recoverycode">
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                              <input id="recovery_email" type="email" class="form-control" name="recovery-email" placeholder="Email">
                                         <span class="text-danger small" style="display: none" id="invalid-email">Invalid email</span>       
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="send-email" class="btn btn-primary btn-rounded">Send Code</button>
                                    </div>

                                </div>
                            </form> 
                               <form id="get-recovery-code" style="display: none">
                                    <input type="hidden" id="code-email">
                                   <p>Enter the 4 digit code sent to your email</p>
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="recovercode" type="text" class="form-control" name="recovery-code" maxlength="4" placeholder="4 digit Code">&nbsp;<span id="errmsg" class="text-danger"></span>
                                         <span class="text-danger small" style="display: none" id="invalid-code">Invalid code</span>       
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="keyin-code" class="btn btn-primary btn-rounded">Send Code</button>
                                    </div>

                                </div>   
                                   
                               </form>
                          <form id="change-password" style="display: none">
                            <div class="row">
                                <input type="hidden" id="changepass-email">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="password-eye">
                                            <input id="New_Password" type="password" class="form-control" name="New_Password" placeholder="New Password">
                                            <span data-toggle="#New_Password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="password-eye">
                                            <input id="Confirm_Password" type="password" class="form-control" name="Confirm_Password" placeholder="Confirm Password">
                                            <span data-toggle="#Confirm_Password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        <span class="text-danger small" id="passmismatch" style="display:none">Password Mismatch</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="button" id="recovery-changepass" class="btn btn-primary btn-rounded">Change Password</button>
                                </div>

                            </div>
                        </form>
                        </div>
                                
                        </div>
                    </div>
                </div>            
            </div>
        </section>