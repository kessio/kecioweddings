<div class="modal fade" id="login_form" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered register-tab">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                        <h2 class="m-0" >Couple Sign Up</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                    
                    
                        <div class="p-3 px-4 pt-0">
                                <form>
                                  <div class="form-group">
                                        <input class="form-control" placeholder="Full Name" type="text" name="fullname" id="couple-name" value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Bride Name" type="text" name="bridename" id="bridename">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Groom Name" type="text" name="groomname" id="groomname">
                                    </div>
                                    <div class="form-group">
                                    <input id="couple-weddingdate" name="weddingdate" type="text" placeholder="Wedding Date" class="form-control" data-toggle="datepicker" >
                                 </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email Address" type="email" name="email" id="couple-email">
                                            <span id="couple-invalid-email" class="text-danger" style="display: none;">Invalid email</span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Phone Number e.g 071234..." type="text" name="phoneneumber" id="couple-phonenumber">&nbsp;<span id="errmsgss"></span>
                                            <span id="couple-phonecount" class="text-danger" style="display: none;">Invalid Phone number</span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Wedding Venue" type="text" name="weddingvenue" id="couple-weddingvenue">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" type="password" name="password" id="couple-password">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirmpassword" id="couple-confirmpassword">
                                            <span id="couple-passwordmismatch" class="text-danger" style="display:none;">Password Mismatch</span>
                                    </div>
                                    <div class="custom-control custom-checkbox form-dark">
                                    <input type="checkbox" class="custom-control-input" id="coupleterms">
                                    <label class="custom-control-label pl-0" for="coupleterms">&nbsp;</label>
                                    <span>I agree to the <a href="terms-and-conditions" class="btn-link"> Terms and conditions</a></span>
                                    <div class="text-danger" id="agree-terms" style="display:none">Kindly agree to our terms and conditions</div>
                                  </div>
                                    <div class="form-group">
                                        <button type="button" id="couple_signup" class="btn btn-default btn-rounded mt-3">Register</button>
                                    </div>
                                </form>
                      </div>
                </div>
            </div>
        </div>
    </div>