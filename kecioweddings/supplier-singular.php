<?php

$supplierlisting    = array(
    
    "listing_id"   =>$url_id,
   
);
$data             = $little->shaz_curl(json_encode($supplierlisting), \NsLittle\Little::ROUTE.'/single_suppliers_listing.php');
$data_decode      = json_decode($data);
$mysuppliers = $data_decode->data;
$count_mysuppliers = count($mysuppliers);
for($s = 0; $s < $count_mysuppliers; $s++){
     $vendor_id     = $mysuppliers[$s]->vendor_id;
      $listing_name = $mysuppliers[$s]->listing_name;
      $facility     = $mysuppliers[$s]->facility;
      $cat_id       = $mysuppliers[$s]->cat_id;
      $about        = $mysuppliers[$s]->about;
      $price        = $mysuppliers[$s]->price;
      $services     = $mysuppliers[$s]->services;
      $amenities    = $mysuppliers[$s]->amenities;
      $county_name  = $mysuppliers[$s]->county_name;
      $subregion    = $mysuppliers[$s]->subregion;
      $town_name    = $mysuppliers[$s]->town_name;
      $whatsapp     = $mysuppliers[$s]->whatsapp;
      $facebook     = $mysuppliers[$s]->facebook;
      $instagram    = $mysuppliers[$s]->instagram;  
      $tents        = $mysuppliers[$s]->tents;
      $furniture    = $mysuppliers[$s]->furniture;
      $gallery      = $mysuppliers[$s]->gallery;
     $cover_picture = $mysuppliers[$s]->cover_picture;
    
}
$display_reviews   = $little->shaz_curl(json_encode($supplierlisting), \NsLittle\Little::ROUTE.'/display_allreview.php');
$decode_reviews    = json_decode($display_reviews);
$reviews           = $decode_reviews->data;
$display_info = array(
    
    "user_id"=>$_SESSION['userid']
 
);

$display_profile = $little->shaz_curl(json_encode($display_info), \NsLittle\Little::ROUTE.'/display_profile.php');
$profile_decode  = json_decode($display_profile);
$profile_data    = $profile_decode->data;
$my_image        = $profile_data->cimage;

/// display profile =================================================================================///

$profileuser = array(
    "id" => $vendor_id
);
//print_r($profileuser);
$display_data   = $little->shaz_curl(json_encode($profileuser), \NsLittle\Little::ROUTE.'/display_vprofile.php');
//print_r($display_data);
$data_decoded   = json_decode($display_data);
$phone_number   = $data_decoded->data->phone_number;
$business_name  = $data_decoded->data->business_name;
$business_email = $data_decoded->data->email;
// ================== Vendor profile ====================================================================//
$vendoruser = array(
    "user_id" => $vendor_id
);
$vendor_profile = $little->shaz_curl(json_encode($vendoruser), \NsLittle\Little::ROUTE.'/display_vendor_profile.php');
//print_r($vendor_profile);
$vendor_decode  = json_decode($vendor_profile);
$vendor_data    = $vendor_decode->data;
$vendor_image   = $vendor_data->cimage;
$facebook       = $vendor_data->facebook;
$instagram      = $vendor_data->instagram;
$website        = $vendor_data->website;
// review avearage=========================================================================
$reviewdata = $little->shaz_curl(json_encode($supplierlisting), \NsLittle\Little::ROUTE.'/average_review.php');
$reviewdata_decode = json_decode($reviewdata);
$review_ratings = $reviewdata_decode->data->average_ratings;
$ratings = number_format($review_ratings,1);


$reviewtotals = $little->shaz_curl(json_encode($supplierlisting), \NsLittle\Little::ROUTE.'/total_reviews.php');
$totalsdata_decode = json_decode($reviewtotals);
$review_totals = $totalsdata_decode->data->total_reviews;

 // my reviews ======================================//////////////////////////
$listingid = array(
    "user_id" => $_SESSION['userid']
);
$userreviews       = $little->shaz_curl(json_encode($listingid), \NsLittle\Little::ROUTE.'/display_myreview.php');
$userreview_decod  = json_decode($userreviews);
$myreviewss        = $userreview_decod->data;
$revieexist        = $little->shaz_curl(json_encode($listingid), \NsLittle\Little::ROUTE.'/review_exist.php');
$reviewexist_array = json_decode($revieexist);
$favourites = array(
    "user_id" => $_SESSION['userid']
);
          
$fdata      = $little->shaz_curl(json_encode($favourites), \NsLittle\Little::ROUTE.'/display_favourites.php');
$favs_array = json_decode($fdata);
$url        = "https://www.kecioweddings.com/supplier-singular/" ;


?>
 
    <!-- =============================
       *
       *   Page Content Start
       *
      =============================== -->
    <style>
    .top-singular {
  
  margin-top: 100px;
 
}
 </style> 
    
 
        <div class="card-shadow pos-rel top-singular">
                            <a id="gallery" class="anchor-fake"></a>
                            <div class="card-shadow-header">
                                <h3><?php echo ucwords($listing_name);?></h3>
                                <h5><i class="fa fa-star"> <?php echo $ratings;?></i><a href="javacript:" class="btn btn-link-primary">(<?php echo $review_totals;?> Reviews)</a><i class="fa fa-map-marker"> <?php echo $town_name;?>, <?php echo $county_name;?></i></h5>
                            </div>
                            <div class="card-shadow-body">
                                <div class="row vendor-img-gallery">
                                    <?php
                                    $explode_gallery   = explode(',', $gallery);
                                   // print_r($explode_gallery);
                                    $prefixed_array    =  $explode_gallery;
                                    $remove            = array_pop($prefixed_array);
                                        
                                    ?>
                                    <div class="col-md-3 mb-0">
                                        <div class="vendor-gallery">
                                            <a href="images/vendor_listings/<?php echo $prefixed_array[0];?>" title="<?php echo $listing_name;?>">
                                                <img src="images/vendor_listings/<?php echo $prefixed_array[0];?>" class="rounded" alt="">
                                            </a>                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-0">
                                        <div class="vendor-gallery">
                                            <a href="images/vendor_listings/<?php echo $prefixed_array[1];?>" title="<?php echo $listing_name;?>">
                                                <img src="images/vendor_listings/<?php echo $prefixed_array[1];?>" class="rounded" alt="">
                                            </a>  
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-0">
                                        <div class="vendor-gallery">
                                            <a href="images/vendor_listings/<?php echo $prefixed_array[2];?>" title="<?php echo $listing_name;?>">
                                                <img src="images/vendor_listings/<?php echo $prefixed_array[2];?>" class="rounded" alt="">
                                            </a>
                                        </div>
                                    </div>
                                   
                                <div class="col-md-12 text-center mt-lg-5">
                                    <a href="images/vendor_listings/<?php echo $prefixed_array[3];?>" title="<?php echo $listing_name;?>">
                                     <button class="btn btn-default btn-rounded text-uppercase btn-lg" alt="">View All Photos</button>
                                      </a>
                                  
                                </div>
                                
                                       <?php 
                                          array_shift($prefixed_array) ;
                                          
                                       foreach(array_slice($prefixed_array,3) as $photos){
                                          // echo $photos;
                                            
                                         ?>
                                          
                                                <a href="images/vendor_listings/<?php echo $photos;?>" title="<?php echo $listing_name;?>">
                                               </a>                                            
                                           
                                         <?php } ?>
                                </div>
                            </div>
                        </div>

           
           
        <!-- Vendor Background End -->
        <input id="thisvendor" type="hidden" value="<?php echo $vendor_id;?>">
        <input id="prof_image" type="hidden" value="<?php echo $my_image; ?>">
         <input id="listing_id" type="hidden" value="<?php echo $supplierlisting['listing_id']; ?>">
         <input type="hidden" id="cat_id" value="<?php echo $cat_id;?>">
         <input  type="hidden" id="listname" value="<?php echo $listing_name;?>">
<!-- Vendor Profile Single Start -->
        <div class="vendor-profile-single pb-0 pt-4">            
            <div class="container pos-rel">
               <div class="row align-items-end">
                  <div class="col-lg-12 text-lg-right pr-auto mt-lg-0 mt-4 bg-white">
                       <a href="javascript:" class="btn btn-primary mb-2" id="click-favs" style="display:none"><i class="fa fa-heart-o"></i> Favorite</a>
                       <?php if(in_array($supplierlisting['listing_id'], $favs_array)){?><a href="javascript:" class="btn btn-primary mb-2" id="myfavs" ><i class="fa fa-heart-o"></i> Favorite</a><?php } else{?>
                        <?php if($_SESSION['user_session_exists'] !== "TRUE"){?>
                        
                        <a href="javascript:" class="btn btn-outline-white mb-2 "data-toggle="modal" data-target="#general-login"><i class="fa fa-heart-o"></i> Favorites</a>
                       <?php   }else{ ?>
                        <?php if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "couple"){?>
                        <a href="javascript:" class="btn btn-outline-white mb-2 kecio-whishlist" ><i class="fa fa-heart-o"></i> Favorite</a>
                       <?php } } }?>
                       <?php if(!empty($price)){?>
                        
                        <a target="_blank" href="pdffiles/<?php echo $price;?>" class="btn btn-primary mb-2"></i> View Prices</a>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <section class="wide-tb-90 pt-2">
            <div class="container">
                <div class="row">

                    <!-- Vendor Single Content -->
                    <div class="col-lg-8 col-md-12">

                        <!-- Description -->
                        <div class="card-shadow pos-rel">
                            <a id="description" class="anchor-fake"></a>
                            <div class="card-shadow-header">
                                <h3><i class="fa fa-file-text"></i><?php echo ucwords($listing_name);?></h3>
                            </div>
                            <div class="card-shadow-body">
                                <h4>About Us</h4>
                                <p class="pt-1"><?php echo $about;?></p>
                                <?php if (!empty($facility)){?>
                                 <h4>Facility</h4>
                                <p><?php echo $facility;?></p>
                                <?php } ?>
                                <?php if (!empty($services)){?>
                                 <h4>Services Offered</h4>
                                <p><?php echo $services;?></p>
                                <?php } ?>
                                <?php if(!empty($furniture && $cat_id == '10')){      ?> 
                               <h5>Available Furniture</h5>
                                  <ul class="list-unstyled arrow">
                                <?php
                                
                                $explode_furniture = explode(',', $furniture);
                                foreach ($explode_furniture as $fe) {
                                    
                                
                               
                                ?>
                                     
                                      <li><?php   echo $fe; ?></li>   
                                <?php   } ?> 
                                 </ul>
                                <?php }  ?>
                                
                                 <?php  if($cat_id == '6'){ ?>
                                
                                 <h5>Available Tents</h5>
                                
                                <ul class="list-unstyled arrow">
                                     <?php       
                                    $explode_tents = explode(',', $tents);
                                    
                                    foreach($explode_tents as $te){
                                    
                                    ?>
                                    
                                    <li><?php echo $te; ?></li>
                                    
                                    
                                <?php  }?>
                                  
                                </ul>
                                
                                 <?php  } ?>
                                 
                            </div>
                        </div>
                        <!-- Description -->

                        <!-- Reviews -->
                        <div class="card-shadow pos-rel">
                            <a id="reviews" class="anchor-fake"></a>
                            <div class="card-shadow-header d-md-flex justify-content-between align-items-center">
                                <h4><i class="fa fa-star-o"></i> Reviews For <?php echo ucwords($listing_name);?></h4>
                                
                            </div>
                            <div class="card-shadow-body border-bottom">
                                <div class="row no-gutters">
                                    <div class="col-md-auto">
                                        <div class="review-count">
                                            <span><?php echo number_format($review_ratings, 1);?></span>
                                            <small>out of 5.0</small>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="card-shadow-body d-md-flex justify-content-between align-items-center py-3">
                                <strong><?php echo $review_totals;?> Reviews for <?php echo ucwords($listing_name);?></strong>
                                
                            </div>
                        </div>
                        
                      <?php if(in_array($supplierlisting['listing_id'], $reviewexist_array)){?>
                       <div class="card-shadow pos-rel" >
                            <a id="review-form" class="anchor-fake" tabindex="-1"></a>
                            <div class="card-shadow-header">
                                <h3><i class="fa fa-pencil"></i>Vendor Reviewed</h3>
                            </div>
                            <div class="card-shadow-body">
                             <a href="couple-reviews"><button class="btn btn-primary">View my Reviews</button></a>
                            </div>
                       </div>
                        
                      <?php }else{?>
                        <?php if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "couple"){ ?>
                        <!-- Write A Review -->
                        <div class="card-shadow pos-rel" >
                            <a id="review-form" class="anchor-fake" tabindex="-1"></a>
                            <div class="card-shadow-header">
                                <h3><i class="fa fa-pencil"></i> Write A Review</h3>
                            </div>
                           <div class="card-shadow-body">
                             <div class="row rating-stars-wrap">
                                <div class="col-md-4 col-6 mb-3 mb-md-0">
                                        <div class="review-option">
                                           <div class="count">
                                               <strong>Star Rating</strong> 
                                                <div class="star-rating" id="ratings">
                                                       <input type="radio" class="stars" id="5-fstars" name="ratings" value="5" />
                                                       <label for="5-fstars" class="star">&#9733;</label>
                                                       <input type="radio" class="stars"id="4-fstars" name="ratings" value="4" />
                                                       <label for="4-fstars" class="star">&#9733;</label>
                                                       <input type="radio" class="stars" id="3-fstars" name="ratings" value="3" />
                                                       <label for="3-fstars" class="star">&#9733;</label>
                                                       <input type="radio" class="stars" id="2-fstars" name="ratings" value="2" />
                                                       <label for="2-fstars" class="star">&#9733;</label>
                                                       <input type="radio" class="stars" id="1-fstar" name="ratings" value="1" />
                                                       <label for="1-fstar" class="star">&#9733;</label>
                                                       </div>
                                                <span class="text-danger" id="ratingsrequired" style="display: none">Ratings is required!</span>
                                                      
                                            </div>
                                        </div>
                                    </div>
                                    <!-- review-option -->
                                
                                </div>

                                <!-- Leave a Reply -->
                                <div class="row mt-4">
                                    <div class="col-md-12 mb-0">
                                        <div class="form-group">
                                            <textarea class="form-control" id="review" rows="5" placeholder="Your Comments"></textarea>
                                            <span id="reviewwords" class="text-danger" style="display:none">You can not send a blank review!</span>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="<?php echo $_SESSION['name'];?>" id="rname" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="remail" value="<?php echo  $_SESSION['email'];?>" placeholder="Your Email">
                                        </div>
                                    </div>                                    
                                </div>
                                <?php if($_SESSION['user_session_exists'] !== "TRUE"){?>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#general-login">Review</button>
                                </div>
                                <?php }else { ?>
                                <div class="mt-3">
                                    <button type="button" id="save_review" class="btn btn-primary">Post Your Review</button>                                    
                                </div>
                                <?php } ?>
                                <!-- Leave a Reply -->
                            </div>
                        </div>
                      <?php } } ?>
                        <!-- Write A Review -->
                        <div class="card-shadow pos-rel">
                            <div class="card-shadow-body border-top">
                                <!-- Review Media -->
                                <table id="reviews-datatables" class="table">
                                <thead>
                                    <tr>
                                                                    
                                        <th><?php echo ucwords($listing_name);?> Reviews</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                      <?php
                      
                      for($r = 0; $r < count($reviews); $r ++){
                      
                      
                      ?>
                       <tr> 
                           <td>
                                 <div class="reviews-media">
                                    <div class="media">
                                        <img class="thumb rounded-circle" src="images/profile_pic/<?php echo $reviews[$r]->profile_image; ?>" style="width:60px; height:60px;" alt="" />
                                       <div class="media-body">
                                            <div class="heading-wrap no-gutters">
                                                <div class="heading">
                                                    <div class="col pl-0">
                                                        <h4 class="mb-0"><?php  echo ucwords($reviews[$r]->name);?></h4>
                                                        <div class="review-option-btn">
                                                            <a data-toggle="collapse" href="#review-option-toggle-3" role="button" aria-expanded="false" class="collapsed">
                                                                <?php if ($reviews[$r]->ratings === '1'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                 <?php if ($reviews[$r]->ratings === '2'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                 <?php if ($reviews[$r]->ratings === '3'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                <?php if ($reviews[$r]->ratings === '4'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                <?php if ($reviews[$r]->ratings === '5'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                <span><?php echo number_format($reviews[$r]->ratings,1);  ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <small><?php $datesent = strtotime($reviews[$r]->date_sent); echo "Sent On ".date("F d, Y",$datesent);  ?></small>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                           <p><?php echo $reviews[$r]->review;  ?></p>
                                           <?php if(!empty($reviews[$r]->feedback)){?>
                                           <div class="media reply-box">
                                                <div class="media-body">
                                                    <div class="d-md-flex justify-content-between mb-3">
                                                        <h4 class="mb-0"><?php echo ucwords($reviews[$r]->vendor_name) ;?></h4>
                                                        <small class="txt-blue">Replied On: <?php $responsedatesent = strtotime($reviews[$r]->response_date_sent); echo date("F d, Y",$responsedatesent);?></small>
                                                    </div>
                                                    <?php echo $reviews[$r]->feedback?>
                                                </div>
                                            </div>
                                           <?php }?>
                                        </div>
                                    </div>
                                </div>
                             </td>
                       </tr>
                       
                        <?php      }  ?>
                       </tbody>
                       </table>
                           </div>
                        </div>
                        <!-- Reviews -->

                        <!-- Faq’s -->
                        
                        <!-- Faq’s -->

                        <!-- Location -->
                        
                        <!-- Location -->

                    </div>
                    <!-- Vendor Single Content -->

                    <!-- Vendor Sidebar -->
                    <div class="col-lg-4 col-md-12">
                        <aside class="row sidebar-widgets">
                            <!-- Sidebar Secondary Start -->
                            <div class="sidebar-secondary col-lg-12 col-md-6">
                                <!-- Widget Wrap -->
                                
                                <!-- Widget Wrap -->


                                <!-- Widget Wrap -->
                                <div class="widget bg-white">
                                    <h3 class="widget-title">Author Profile</h3>

                                    <div class="profile-avatar">
                                       
                                        <div class="content">
                                            <small>Added By</small>
                                           <?php echo $business_name;?>
                                        </div>
                                    </div>
                                   
                                    <div class="icon-box-style-3 sided mt-3 mb-0">
                                        <i class="fa fa-phone"></i>
                                        <span> <?php echo $phone_number;?></span>
                                    </div>

                                    <div class="icon-box-style-3 sided mt-3 mb-0">
                                        <i class="fa fa-envelope-o"></i>
                                        <span> <?php echo $business_email;?></span>
                                    </div>
                                      <?php if(!empty($website)){?>
                                    <div class="icon-box-style-3 sided mt-3 mb-0">
                                        <i class="fa fa-wpexplorer"></i>
                                        <span> <a href="<?php echo $website;?>" target="_new" class="btn-link btn-link-secondary"><?php echo $website;?></a> </span>
                                    </div>
                                      <?php } ?>
                                    <div class="social-sharing sidebar-social border-top">
                                        <?php if (!empty($instagram)){?> <a href="<?php echo $instagram?>" target="_new" class="share-btn-instagram"><i class="fa fa-instagram"></i></a><?php }?>
                                        <?php if (!empty($facebook)){?> <a href="<?php echo $facebook;?>" target="_new" class="share-btn-facebook"><i class="fa fa-facebook"></i></a><?php }?>
                                        <?php if (!empty($twitter)){?><a href="<?php echo $twitter;?>" target="_new" class="share-btn-twitter"><i class="fa fa-twitter"></i></a><?php } ?>
                                        <?php if (!empty($youtube)){?><a href="<?php echo $youtube;?>" target="_new" class="share-btn-twitter"><i class="fa fa-youtube-play"></i></a><?php  } ?> 
                                        
                                    </div>
                                </div>
                                <!-- Widget Wrap -->

                                <!-- Widget Wrap -->
                                <!--- featured listing --------->
                                <!-- Widget Wrap -->
                            </div>
                            <!-- Sidebar Secondary End -->

                            
                        </aside>
                    </div>
                    <!-- Vendor Sidebar -->
                </div>
            </div>
        </section>
      
        
    
    <!-- Back to Top
    ================================================== -->
   

    <!-- Request Quote Modal -->
    
    