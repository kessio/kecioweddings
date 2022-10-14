<div class="modal fade" id="general-login" tabindex="-1" aria-labelledby="general-login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered register-tab">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                        <h3 class="m-0" >Login</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                    
                    
                    <div class="p-3 px-4 pt-0">
                        
                            <div class="tab-pane fade show active" id="vpills-login" role="tabpanel" aria-labelledby="vpills-login-tab">
                                <form>
                                    <span id="vloginerr" class="text-danger mb-5" style="display:none;">Phone number or password Incorrect!</span>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="login-phone-number" placeholder="Phone number" autocomplete="off">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="vendorpassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <a href="forgot-password" class="btn btn-link"> Forgot Password ?</a>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="vendor_login" class="btn btn-default btn-rounded mt-3">Login</button>
                                        <button type="button" id="load-login" class="btn btn-default btn-rounded mt-3 buttonload" style="display:none"><i class="fa fa-spinner fa-spin"></i>loading</button>
                                    </div>
                                </form>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>