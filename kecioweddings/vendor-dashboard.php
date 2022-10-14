<?php
// if users are not logged in redirect to login page

if($_SESSION['user_session_exists'] === "TRUE"){

$display_listing = array("vendor_id"=>$_SESSION['userid']);
//print_r($display_listing);
$data = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/display_listing.php');
$decode_data = json_decode($data);
//print_r($decode_data);
$listing = $decode_data->data;
$listing_count = count($listing);


$tdata = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/total_user_reviews.php');
//print_r($tdata);
$tdecode_data = json_decode($tdata);
$tuser = $tdecode_data->data;
//print_r($tuser);
$total_reviews = $tuser->total_reviews;
// ===================Pricings ==========================
$display_plan  = array("user_id"=>$_SESSION['userid']);
$pricedata          = $little->shaz_curl(json_encode($display_plan), \NsLittle\Little::ROUTE.'/display_payments.php');
//print_r($data);
$pricedecode_data   = json_decode($pricedata);
$status        = $pricedecode_data->data->status;
$plan_type     = $pricedecode_data->data->plan_type;
$activedays    = $pricedecode_data->data->active_days;


?>

    <!-- =============================
       *
       *   Page Content Start
       *
    =============================== -->
   
        
        <div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>My Dashboard</h2>
                            <a href="vendor-addlisting" class="btn btn-default"><i class="fa fa-plus"></i> Add New Listing</a>
                        </div>                           
                    </div>
                   <!-- My Pricing Section -->
                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            <div class="row align-items-center">
                                <div class="mb-0 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing-plan">
                                        <span class="sub-head">Plan Type</span>
                                        <h3><?php  if(!empty($plan_type)){echo $plan_type;}else{ echo "Not Paid";} ;?></h3>
                                    </div>
                                </div>

                                <!---<div class="mb-0 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing-plan">
                                        <span class="sub-head">Plan Days</span>
                                        <h3><?php //echo $activedays;?></h3>
                                    </div>
                                </div>
                                 <div class="mb-0 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing-plan">
                                       <a href="pricings" class="btn btn-outline-primary ml-2"><i class="fa fa-eye"></i>View Pricing</a>
                                    </div>
                                </div> --->
                                
                                
                                <div class="mb-0 col-xl-1 col-lg-4 col-sm-6">
                                    <div class="pricing-plan p-0 text-xl-right text-md-left pl-md-3 text-center">
                                        <?php if($status === "Active"){?>
                                        <div class="badge badge-success">&nbsp;</div>
                                        <small><?php echo $status;?></small>
                                        <?php }else{ ?>
                                        <div class="badge badge-danger">&nbsp;</div>
                                        <small><?php echo "Not Active";?></small>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                            <div class="card-shadow">
                                <div class="card-shadow-body">
                                    <div class="couple-info vendor-stats">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                                <?php echo $listing_count;?>
                                            </div>
                                            <div class="text">
                                                <div class="div"><strong>Listed Items</strong></div>
                                                <a href="vendor-listing" class="btn-veiw-all">View All</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                            <div class="card-shadow">
                                <div class="card-shadow-body">
                                    <div class="couple-info vendor-stats">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                                <?php echo $total_reviews;?>
                                            </div>
                                            <div class="text">
                                                <div class="div"><strong>Your Reviews</strong></div>
                                                <a href="vendor-reviews" class="btn-veiw-all">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-shadow mt-dashboard mt-5">
                        <div class="card-shadow-header">
                            <div class="dashboard-head">
                                <h3>
                                    Listings
                                </h3>
                                <div class="links">
                                    <a href="vendor-listing">View All <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-shadow-body p-0">
                            <ul class="list-unstyled my-listing">
                                         <?php
                                   
                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                          

                                     ?>
                                        <li id="li-<?php echo $listing[$l]->listing_id; ?>">
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
                                                                <?php echo $status;?>
                                                            </span>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                   <?php  }  ?>
                            </ul>
                        </div>
                        
                    </div>
  
                </div>
            </div>
            
        </div>        
<?php
}else{
    include_once 'login.php';   
 } ?>
 


    


