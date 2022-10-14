<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$display_listing     = array("vendor_id"=>$_SESSION['userid']);
//print_r($display_listing);
$data                = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/display_listing.php');
$decode_data         = json_decode($data);
$listing             = $decode_data->data;
$listing_count       = count($listing);

// Count Approved ======================================================================================///
$approveddata         = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/count_userapprovedlisting.php');
$approvedecode_data   = json_decode($approveddata);
$approved             = $approvedecode_data->data;
$approve_total        = $approved->approved_no;
// Count Unpublished ======================================================================================///
$unpublishedddata          = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/count_unpublishedlisting.php');
$unpublishedecode_data     = json_decode($unpublishedddata);
$unpublished               = $unpublishedecode_data->data;
$unpublished_total         = $unpublished->unpublished_no;
// Count published ======================================================================================///
$publishedddata          = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/count_publishedlisting.php');
$publishedecode_data     = json_decode($publishedddata);
$published               = $publishedecode_data->data;
$published_total         = $published->published_no;
// Count Declined ======================================================================================///
$declinedddata         = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/count_userdeclinedlisting.php');
$declineddecode_data   = json_decode($declinedddata);
$declined              = $declineddecode_data->data;
$declined_total        = $declined->declined_no;



include_once 'modals/modals-cropper-listing-cover.php';

?>

    <!-- =============================
       *
       *   Page Content Start
       *
    =============================== -->
   
        
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
                            <div><strong>Listings</strong></div>
                        </div>

                        <div class="card-shadow-body p-0">
                            <ul class="nav nav-pills mb-3 my-listing-tab horizontal-tab-second justify-content-center nav-fill" id="pills-tab1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-hr-all-listing-tab" data-toggle="pill" href="#pills-hr-all-listing" role="tab" aria-controls="pills-hr-all-listing" aria-selected="true">Unpublished <span>(<?php echo $unpublished_total;?>)</span></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-pending-tab" data-toggle="pill" href="#pills-hr-pending" role="tab" aria-controls="pills-hr-pending" aria-selected="false">Pending <span>(<?php echo $published_total;?>)</span></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-approved-tab" data-toggle="pill" href="#pills-hr-approved" role="tab" aria-controls="pills-hr-approved" aria-selected="false">Published <span>(<?php echo $approve_total;?>)</span></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-removed-tab" data-toggle="pill" href="#pills-hr-removed" role="tab" aria-controls="pills-hr-removed" aria-selected="false">Rejected<span>(<?php echo $declined_total;?>)</span></a>
                                </li>
                                
                            </ul>
                            <div class="tab-content" id="pills-tabContent1">
                                <div class="tab-pane fade show active" id="pills-hr-all-listing" role="tabpanel" aria-labelledby="pills-hr-all-listing-tab">
                                    <ul class="list-unstyled my-listing">
                                         <?php

                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                            if($status == "Unpublished"){

                                     ?>
                                        <li id="li-<?php echo $listing[$l]->listing_id; ?>">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                                        <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                                        <input id="<?php echo $listing[$l]->listing_id;?>" type="file" name="image" class="custom-file-input upload-image"style="display: none" accept="image/*">
                                                        <label class="custom-file-label" for="<?php echo $listing[$l]->listing_id;?>"><i class="fa fa-pencil"></i></label>
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
                                                                <?php echo $status;?>
                                                            </span>
                                                        </div>
                                                        <div class="badge-wrap text-right">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="vendor-edit-listing/<?php echo $listing[$l]->listing_id;?>"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item" href="supplier-singular/<?php echo $listing[$l]->listing_id;?>"><i class="fa fa-eye"></i> Preview</a>
                                                                    <a class="dropdown-item publish-sha" id="<?php echo $listing[$l]->listing_id;?>" href="javascript:"><i class="fa fa-paper-plane"></i> Publish</a>
                                                                    <a class="dropdown-item del-declined-list"  id="dec-<?php echo $listing[$l]->listing_id; ?>"><i class="fa fa-trash"></i> Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                     <?php } } ?>
                                        
                                        
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="pills-hr-pending" role="tabpanel" aria-labelledby="pills-hr-pending-tab">
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
                                                      <div class="btn btn-outline-primary">
                                                       <a class="dropdown-item" href="vendor-edit-listing/<?php echo $listing[$l]->listing_id;?>"><i class="fa fa-pencil"></i> Edit</a>     
                                                        </div>   
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
                                       $listingid = $listing[$l]->listing_id;
                                       $listinarray = array(
                                           "listing_id"  => $listingid
                                        );
                                       // print_r($listinarray);
                                       $viewdata        = $little->shaz_curl(json_encode($listinarray), \NsLittle\Little::ROUTE.'/displayviews.php');
                                      // print_r($viewdata);
                                       $decodeviews     = json_decode($viewdata);
                                       $allviews        = $decodeviews->data;
                                       $whatsapp_views  = $allviews[0]->whatsapp_views;
                                       $gallery_views   = $allviews[0]->gallery_views;
                                       $phone_views     = $allviews[0]->phone_views;
                                       $listing_views   = $allviews[0]->listing_views;
                                       
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
                                                            <span class="badge badge-success">                                                        
                                                                Published
                                                            </span>
                                                            <div><span><i class="fa fa-eye"> Listings Views:</i><?php echo $listing_views;?></span>
                                                            <span><i class="fa fa-phone"> Phone Clicks:</i><?php echo $phone_views;?></span>
                                                            <span><i class="fa fa-whatsapp"> WhatsApp Clicks:</i><?php echo $whatsapp_views;?></span>
                                                            <span><i class="fa fa-picture-o"> Gallery Clicks:</i><?php echo $gallery_views;?></span>
                                                            </div>
                                                            
                                                        </div>
                                                      <div class="btn btn-outline-primary">
                                                       <a class="dropdown-item" href="vendor-edit-listing/<?php echo $listing[$l]->listing_id;?>"><i class="fa fa-pencil"></i> Edit</a>     
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
                                                        <div class="badge-wrap text-right">
                                                            <div>Action</div>
                                                            <div class="dropdown hover_out listing-action">
                                                                <button class="btn listing-action-link" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                   ...
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="vendor-edit-listing/<?php echo $listing[$l]->listing_id;?>"><i class="fa fa-pencil"></i> Edit</a>
                                                                    <a class="dropdown-item unpublish-sha" id="<?php echo $listing[$l]->listing_id; ?>" href="javascript:" ><i class="fa fa-paper-plane"></i> Un-Publish</a>
                                                                    <a class="dropdown-item del-declined-list" id="dec-<?php echo $listing[$l]->listing_id; ?>" href="javascript:"><i class="fa fa-trash"></i> Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                     <?php } } ?>  
                                          
                                    </ul>
                                </div>
                                
                            </div>
                            
                        </div>

                    </div>
                    <!-- My Listing Section -->                    
                </div>
            </div>
            
        </div>        
<?php }else{include_once 'login.php';}?>

    
    