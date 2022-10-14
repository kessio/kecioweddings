<?php

$display_listing = array();
//print_r($display_listing);

$data = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/myAllListings.php');
//print_r($data);

$decode_data = json_decode($data);
//print_r($decode_data);
$listing = $decode_data->data;
//print_r($listing);

$listing_count = count($listing);
$countpending = $little->shaz_curl(json_encode($display_listing),\NsLittle\Little::ROUTE.'/count_pendinglisting.php');
//print_r($countpending);
$decode_count = json_decode($countpending);
$mypending = $decode_count->data;
//print_r($mypending);

$countapproved = $little->shaz_curl(json_encode($display_listing),\NsLittle\Little::ROUTE.'/count_approvedlisting.php');
//print_r($countpending);
$decode_countapproved = json_decode($countapproved);
$myapproved = $decode_countapproved->data;

$countdeclined = $little->shaz_curl(json_encode($display_listing),\NsLittle\Little::ROUTE.'/count_declinedlisting.php');
//print_r($countpending);
$decode_countdeclined = json_decode($countdeclined);
$mydeclined = $decode_countdeclined->data;


?>
                 
        <div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>My Listing</h2>
                            <a href="vendor-addlisting" class="btn btn-default"><i class="fa fa-plus"></i> Add New Listing</a>
                        </div>                           
                    </div>
                    <!-- Page Heading -->

                    <!-- My Listing Section -->
                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            <div><strong>Create your wedding business listing on Kecio Weddings to start building customers.</strong></div>
                        </div>

                        <div class="card-shadow-body p-0">
                            <ul class="nav nav-pills mb-3 my-listing-tab horizontal-tab-second justify-content-center nav-fill" id="pills-tab1" role="tablist">
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active show" id="pills-hr-pending-tab" data-toggle="pill" href="#pills-hr-pending" role="tab" aria-controls="pills-hr-pending" aria-selected="false">Pending</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-approved-tab" data-toggle="pill" href="#pills-hr-approved" role="tab" aria-controls="pills-hr-approved" aria-selected="false">Approved</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-removed-tab" data-toggle="pill" href="#pills-hr-removed" role="tab" aria-controls="pills-hr-removed" aria-selected="false">Rejected</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-expired-tab" data-toggle="pill" href="#pills-hr-expired" role="tab"
                                        aria-controls="pills-hr-expired" aria-selected="false">Expired <span>(0)</span></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent1">
                                
                                <div class="tab-pane fade active show" id="pills-hr-pending" role="tabpanel" aria-labelledby="pills-hr-pending-tab">
                                    <ul class="list-unstyled my-listing">
                                       <?php

                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                            if($status == "Pending"){

                                     ?>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                                        <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                                            <div><?php  echo $listing[$l]->listing_name;  ?></div>
                                                            <span><?php echo ($listing[$l]->region_name);?>, <?php echo ($listing[$l]->subregion_name);  ?></span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-pending">                                                        
                                                                Pending
                                                            </span>
                                                        </div>
                                                        <button class="btn btn-primary approve-shaz" id="<?php echo $listing[$l]->listing_id;?>">Approve</button> 
                                                        <button class="btn btn-primary decline-shaz" id="<?php echo $listing[$l]->listing_id;?>">Decline</button>
                                                    </div>
                                                 
                                                </div>
                                                 
                                            </div>
                                        </li>
                                     <?php } } ?>  
                                        
                                        
                                        
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="pills-hr-approved" role="tabpanel" aria-labelledby="pills-hr-approved-tab">
                                    <ul class="list-unstyled my-listing">
                                        <?php

                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                            if($status == "Approved"){

                                     ?>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                                        <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                                            <div><?php  echo $listing[$l]->listing_name;  ?></div>
                                                            <span><?php echo ($listing[$l]->region_name);?>, <?php echo ($listing[$l]->subregion_name);  ?></span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-approved">                                                        
                                                                Published
                                                            </span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </li>
                                     <?php } } ?> 
                                     
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="pills-hr-removed" role="tabpanel" aria-labelledby="pills-hr-removed-tab">
                                    <ul class="list-unstyled my-listing">
                                        
                                       <?php

                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                            if($status == "Declined"){

                                     ?>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="javascript:">
                                                        <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                                            <div><?php  echo $listing[$l]->listing_name;  ?></div>
                                                            <span><?php echo ($listing[$l]->region_name);?>, <?php echo ($listing[$l]->subregion_name);  ?></span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-danger">                                                        
                                                                Rejected
                                                            </span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                     <?php } } ?>  
                                        
                                        
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="pills-hr-expired" role="tabpanel" aria-labelledby="pills-hr-expired-tab">
                                    <ul class="list-unstyled my-listing">
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="javascript:">
                                                        <img src="assets/images/vendors/vendor_img_1.jpg" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="listing-singular.html">
                                                            <div>Fiona</div>
                                                            <span>Paris</span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        <div class="badge-wrap">
                                                            <div>Task Date</div>
                                                            <span class="badge badge-primary">                                                        
                                                                September 18, 2020
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-danger">                                                        
                                                                Expired
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap text-center">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton19" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton19">
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="javascript:">
                                                        <img src="assets/images/vendors/vendor_img_2.jpg" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="listing-singular.html">
                                                            <div>Fiona</div>
                                                            <span>Paris</span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        <div class="badge-wrap">
                                                            <div>Task Date</div>
                                                            <span class="badge badge-primary">                                                        
                                                                September 18, 2020
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-danger">                                                        
                                                                Expired
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap text-center">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton20" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton20">
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="javascript:">
                                                        <img src="assets/images/vendors/vendor_img_3.jpg" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="listing-singular.html">
                                                            <div>Fiona</div>
                                                            <span>Paris</span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        <div class="badge-wrap">
                                                            <div>Task Date</div>
                                                            <span class="badge badge-primary">                                                        
                                                                September 18, 2020
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-danger">                                                        
                                                                Expired
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap text-center">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton21" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton21">
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="javascript:">
                                                        <img src="assets/images/vendors/vendor_img_4.jpg" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="listing-singular.html">
                                                            <div>Fiona</div>
                                                            <span>Paris</span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        <div class="badge-wrap">
                                                            <div>Task Date</div>
                                                            <span class="badge badge-primary">                                                        
                                                                September 18, 2020
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-danger">                                                        
                                                                Expired
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap text-center">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton22" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton22">
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="javascript:">
                                                        <img src="assets/images/vendors/vendor_img_5.jpg" class="rounded" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="title-listing">
                                                        <a href="listing-singular.html">
                                                            <div>Fiona</div>
                                                            <span>Paris</span>
                                                        </a>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-listing">
                                                        <div class="badge-wrap">
                                                            <div>Task Date</div>
                                                            <span class="badge badge-primary">                                                        
                                                                September 18, 2020
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap">
                                                            <div>Status</div>
                                                            <span class="badge badge-danger">                                                        
                                                                Expired
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap text-center">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton23" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton23">
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-eye"></i> Preview</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-clone"></i> Duplicate</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                                    <a class="dropdown-item" href="javascript:"><i class="fa fa-trash"></i> Removed</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <!-- My Listing Section -->                    
                </div>
            </div>
            
        </div>        


    
    