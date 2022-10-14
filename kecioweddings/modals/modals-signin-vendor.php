<div class="modal fade" id="vendor_form" tabindex="-1" aria-labelledby="vendor_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered register-tab">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                        <h2 class="m-0" >Vendor Sign Up</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                    
                    
                    <div class="p-3 px-4 pt-0">
                        
                             <form id="myvendorsignup">
                                    
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Business Name" type="text" name="businessname" id="businessname">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="email" placeholder="Email Address" name="email" id="vemail">
                                            <span id="invalid_email" class="text-danger small" style="display: none">Invalid email</span>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Phone Number" type="tel" name="phone_no" id="phone_no">&nbsp;<span id="errmsg"></span>
                                            <div id="phonecount" class="text-danger" style="display: none">Invalid phone number</div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" type="password" name="password" id="passwordregister">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" type="password" name="conpassword" id="conpassword">
                                            <span class="text-danger small" id="pass_match" style="display:none">Password Mismatch!</span>   
                                    </div>
                                 <div class="custom-control custom-checkbox form-dark">
                                    <input type="checkbox" class="custom-control-input" id="checkboxterms">
                                    <label class="custom-control-label pl-0" for="checkboxterms">&nbsp;</label>
                                    <span>I agree to the <a href="terms-and-conditions" class="btn-link"> Terms and conditions</a></span>
                                    <div class="text-danger" id="agreeterms" style="display:none">Kindly agree to our terms and conditions</div>
                                  </div>
                                    
                                    <div class="form-group">
                                        <button type="button" id="vendor_signup" class="btn btn-default btn-rounded mt-3">Register</button>
                                    </div>
                                </form>
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div>