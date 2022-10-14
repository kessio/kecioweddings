
<div class="modal fade" id="request_quote" tabindex="-1" aria-labelledby="request_quote" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered register-tab">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                        <h3 class="m-0" >Get Phone Number</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                    <input type="hidden" id="listingid">
                    <input type="hidden" id="vendor-id">
                    <div class="p-3 px-4 pt-0">
                        <div class="request-quote-form" id="fillcontact">
                            <div class="form-group">
                                <input type="text" placeholder="Full Name" id="modal-name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="phone" placeholder="Phone Number" id="modal-phone" class="form-control" />&nbsp;<span class="text-danger" id="couple-errmsgs"></span>
                                <span id="phonecount" class="text-danger" style="display: none">Invalid phone</span>
                            </div>
                            
                            <button type="button" id="requestphone" class="btn btn-primary">Get Phone Number</button>
                        </div>
                        
                        <div id="givecontact" style="display: none">
                            <p>Name: <span id="vname"></span></p>
                            <p>Phone Number: <a href="" id="vphone_number"></a></p>  
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

