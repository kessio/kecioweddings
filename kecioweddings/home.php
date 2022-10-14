<?php

$get_category = array();

$categories = $little->shaz_curl(json_encode($get_category), \NsLittle\Little::ROUTE.'/get_category.php');
//print_r($categories);
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
//print_r($cat);

$get_counties = array();
$select_counties =$little->shaz_curl(json_encode($get_counties), \NsLittle\Little::ROUTE.'/filterlocation.php');
//print_r($select_counties);
$counties_decode = json_decode($select_counties);
$counties = $counties_decode->data;
//print_r($counties);


$getlocation = array();
$get_location =$little->shaz_curl(json_encode($getlocation), \NsLittle\Little::ROUTE.'/loop_location.php');
//print_r($get_location);
$location_decode = json_decode($get_location);
$mylocations = $location_decode->todo;

//print_r($mylocations);

// featured listings ================================================//

$supplierlist = array();
    
//print_r($supplierlist);
$data = $little->shaz_curl(json_encode($supplierlist), \NsLittle\Little::ROUTE.'/filterlist.php');
$data_decode = json_decode($data);
$mylist = $data_decode->data;
//print_r($mylist);
$count_list = count($mylist);

//=========================== Realweddings =======================================//

$realwed = array();
$display_realwed =$little->shaz_curl(json_encode($realwed), \NsLittle\Little::ROUTE. '/dispaly_realwed.php');
//print_r($display_realwed);
$realwed_decoded = json_decode($display_realwed);
$realweddata = $realwed_decoded->data;
//print_r($realweddata);


?>

<style>
    

.select2-dropdown {
    overflow-y: scroll;
    height: 350px;
}
.select2-container--open .select2-dropdown--above {
  border-bottom: none;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0; 
  height:200px;
}
 .style-second {
  background: url(images/native/IMG_6351.jpg) no-repeat center center;
 }
</style>
<!------------ start of slider ------------------------------------------------------>
<section class="slider-wrap style-second">
        <div class="slider-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 mx-auto">
                        <h1>Find the Perfect Wedding Vendor</h1>
                        <p class="lead txt-white text-center">We are here to help you find wedding vendors with reviews, pricing, availability and more</p>
                        <div class="form-bg row no-gutters align-items-center">
                            <div class="col-12 col-md-5">
                                <select class="form-light-select theme-combo home-select-cat" id="home-catgeory" name="state">
                                    <option value="">Choose Vendor Type</option>
                                   <?php 
                                                  for($n = 0; $n < count($cat); $n++){
                                                    $cat_ids = $cat[$n]->cat_id; 
                                                     $cat_name = $cat[$n]->name; 

                                                     //echo $cat_name;  
                                                  ?>
                                        <option value="<?php  echo $cat_ids ;?>"><?php echo $cat_name ;?></option>
                                                  <?php  } ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="px-2 w-100">
                                    <select class="form-light-select theme-combo home-select-location" id="home-location" name="state">
                                        <option value="">Choose Location</option>
                                        <?php
                                        for($c = 0; $c< count($mylocations); $c++){
                                                    $county_ids = $mylocations[$c]->county_id; 
                                                     $county_name = $mylocations[$c]->county_name; 
                                                      $town_id = $mylocations[$c]->town_id; 
                                                     $town_name = $mylocations[$c]->Town_name; 
                                        
                                        ?>
                                   <option value="<?php echo $county_ids;?>"><?php echo $county_name ;?></option>
                                   
                                        <?php  } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <button id="search-home" class="btn btn-default text-nowrap btn-block" >Search Now</button>
                            </div>
                        </div>
                        <p class="lead txt-white text-center">Or browse featured categories</p>
                        <div class="slider-category">
                             <?php 
                                for($n = 0; $n < 9; $n++){
                                  $cat_ids = $cat[$n]->cat_id; 
                                   $cat_name = $cat[$n]->name; 
                                       ?>
                            <?php if($cat_ids == 1){?>
                            <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_heart_double_face"></i></a>
                            <?php }else if($cat_ids == 2){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_cake_floor"></i></a>
                             <?php  }else if($cat_ids == 3){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_music"></i></a>
                             <?php }else if($cat_ids == 4){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_florist"></i></a>
                             <?php }else if($cat_ids == 5){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_location_heart"></i></a>
                             <?php }else if($cat_ids == 6){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_tent"></i></a>
                             <?php }else if($cat_ids == 7){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_camera"></i></a>
                             <?php }else if($cat_ids == 8){?>
                              <a href="suppliers-list/<?php echo $cat_ids; ?>"><i class="weddingdir_videographer"></i></a>
                             <?php }?>
                              
                              
                              
                                <?php } ?>
                            
                            
                            
                        </div>
                    </div>
                </div>           
            </div>
            
        </div>
    </section>
<!---- end of slider ---------------------------------------------------->

<section class="wide-tb-70">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Kecio Weddings Features</h1>
                    <p>These Planning Tools will help you get organized as you plan your wedding</p>
                </div>            
                <div class="row">
                    <?php if(empty($_SESSION['userid'])){?>
                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div data-toggle="modal" data-target="#general-login" class="icon-big-cirlce  mx-auto">
                                <i class="weddingdir_budget"></i>
                            </div>
                            <h4>Budget</h4>
                            <div data-toggle="modal" data-target="#general-login" class="circle-arrow"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div data-toggle="modal" data-target="#general-login" class="icon-big-cirlce mx-auto">
                                <i class="weddingdir_calendar_heart"></i>
                            </div>
                            <h4>Guest List</h4>
                            <div data-toggle="modal" data-target="#general-login" class="circle-arrow"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div data-toggle="modal" data-target="#general-login" class="icon-big-cirlce mx-auto">
                                <i class="weddingdir_seating_chart"></i>
                            </div>
                            <h4>Wedding Website</h4>
                            <div data-toggle="modal" data-target="#general-login" class="circle-arrow"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div data-toggle="modal" data-target="#general-login" class="icon-big-cirlce mx-auto">
                                <i class="weddingdir_heart_ring"></i>
                            </div>
                            <h4>To Do List</h4>
                            <div data-toggle="modal" data-target="#general-login" class="circle-arrow"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div data-toggle="modal" data-target="#general-login" data-toggle="modal" data-target="#general-login" class="icon-big-cirlce mx-auto">
                                <i class="weddingdir_bell"></i>
                            </div>
                            <h4>Vendor Manger</h4>
                            <div data-toggle="modal" data-target="#general-login" class="circle-arrow"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div data-toggle="modal" data-target="#general-login" class="icon-big-cirlce mx-auto">
                                <i class="fa fa-shopping-bag"></i>
                            </div>
                            <h4>RSVP</h4>
                            <div data-toggle="modal" data-target="#general-login" class="circle-arrow"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                    <!-- Features Icons -->
                    
                   
                    <div class="col-md-12">
                        <div class="text-center mt-lg-5">
                            <button  class="btn btn-default btn-rounded text-uppercase btn-lg" data-toggle="modal" data-target="#login_form">Get Started Now</button>
                        </div>
                    </div>
                     <?php } else{ ?>
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div  class="icon-big-cirlce  mx-auto">
                                <i class="weddingdir_budget"></i>
                            </div>
                            <h4>Budget</h4>
                            <a href='couple-budget' class="circle-arrow"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div  class="icon-big-cirlce  mx-auto">
                                <i class="weddingdir_calendar_heart"></i>
                            </div>
                            <h4>Guest List</h4>
                            <a href='couple-guestlist' class="circle-arrow"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div  class="icon-big-cirlce  mx-auto">
                                <i class="weddingdir_seating_chart"></i>
                            </div>
                            <h4>Wedding Website</h4>
                            <a href='couple-website' class="circle-arrow"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div  class="icon-big-cirlce  mx-auto">
                                <i class="weddingdir_budget"></i>
                            </div>
                            <h4>To Do List</h4>
                            <a href='couple-todolist' class="circle-arrow"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
                    <div class="col-lg-4 col-xl-2 text-center col-6">
                        <div class="why-choose-icons">
                            <div  class="icon-big-cirlce  mx-auto">
                                <i class="weddingdir_budget"></i>
                            </div>
                            <h4>Vendor Manager</h4>
                            <a href='couple-vendormanager' class="circle-arrow"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <!-- Features Icons -->

                    <!-- Features Icons -->
         
                    
                    
                     <?php } ?>
                </div>
                
            </div>
        </section>
        <!-- Wedding Dir Features End -->
        
        <!-- Top Wedding Listings Start -->
        <section class="wide-tb-120 floral-bg">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Latest Wedding Listings</h1>
                    <p>Latest wedding vendors</p>
                </div>
                <div class="owl-carousel owl-theme dots-black" id="home-slider-listing">
                      <?php
                     if(!empty($mylist[0]->listing_id)){
                for($l = 0; $l < $count_list ; $l++){
                    $status = $mylist[$l]->status;
                    $vendor_id = $mylist[$l]->vendor_id;
                       ?>
                    
                    <!-- Wedding List -->
                    <div class="item">
                        <div class="wedding-listing">
                            <div class="img">
                                <a href="supplier-singular/<?php echo $mylist[$l]->listing_id; ?>">
                                    <img src="images/listing_featured/<?php if(!empty($mylist[$l]->featured_image)){ echo $mylist[$l]->featured_image;}else{ ?> vendor_img_1.jpg <?php } ?>" alt="">                                                    
                                </a>
                                
                            </div>
                            <div class="content">
                                <div class="gap">
                                    <h3><a href="supplier-singular/<?php echo $mylist[$l]->listing_id;?>"><?php echo ucwords($mylist[$l]->listing_name);?> <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                    <div><i class="fa fa-map-marker"></i> <?php echo $mylist[$l]->Town_name;?>, <a href="suppliers-list//<?php echo $mylist[$l]->region;?>"><?php echo $mylist[$l]->County_name;?></a></div>
                                </div>
                                <?php $eachlisting = $mylist[$l]->listing_id;
                                                        //echo $eachlisting;
                                $listingarray = array(

                                    "listing_id" =>$eachlisting
                                );
                              //  print_r($listingarray);
                                       $reviewtotals = $little->shaz_curl(json_encode($listingarray), \NsLittle\Little::ROUTE.'/total_reviews.php');
                                //print_r($reviewtotals);
                                $totalsdata_decode = json_decode($reviewtotals);
                                $review_totals = $totalsdata_decode->data->total_reviews;
                                //============== Average reviews =========================================///
                                $reviewdata = $little->shaz_curl(json_encode($listingarray), \NsLittle\Little::ROUTE.'/average_review.php');
                                //print_r($reviewdata);
                                $reviewdata_decode = json_decode($reviewdata);
                                $review_ratings = $reviewdata_decode->data->average_ratings;
                                $ratings = number_format($review_ratings,1);

                                ?> 
                                <div class="reviews">
                                <?php if($ratings === '0.0'){?>
                                    <span class="stars">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>
                                    <?php }else if($ratings === '1.0'){  ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>
                                    <?php } else if($ratings > '1.0' && $ratings < '2.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>

                                    <?php } else if($ratings === '2.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>

                                    <?php }else if($ratings > '2.0' && $ratings < '3.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>

                                    <?php } else if($ratings === '3.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>
                                    <?php }else if($ratings > '3.0' && $ratings < '4.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>
                                    <?php }else if($ratings === '4.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>                                    
                                    </span>
                                    <?php }else if($ratings > '4.0' && $ratings < '5.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>                                    
                                    </span>
                                    <?php }else if($ratings > '4.0' && $ratings < '5.0'){ ?>
                                    <span class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>                                    
                                    </span>
                                    <?php } ?>
                                (<?php echo $review_totals;?> review)
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Wedding List -->
                      <?php } }else{
                     for($fe = 0; $fe < 9 ; $fe++){
                   
                       ?>
                    
                    <div class="item">
                        <div class="wedding-listing">
                            <div class="img">
                                <a href="javascript:">
                                    <img src="images/native/Advertisehere.jpg" alt="List your wedding business">                                                    
                                </a>
                                
                            </div>
                            <div class="content">
                                
                              
                                
                            </div>
                        </div>
                    </div>
                      <?php  } } ?>
                    
                    
                    
                </div>
            </div>
        </section>
        <!-- Wedding Dir Features End -->

       

       
        <!-- Real Wedding Start -->
        <section class="wide-tb-120">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Real Wedding</h1>
                    <p>Real weddings in KecioWeddings</p>
                </div>
                <div class="row">
                    <?php 
                    
                    for ($r =0; $r < count($realweddata); $r++){
                        ?>
                    <!-- Real Wedding Stories -->
                    <div class="col-lg-4 col-md-6 bg-white">
                        <div class="real-wedding-wrap top-heading mt-5">
                            
                            <div class="real-wedding">
                                <div class="head">
                                    <h3><a href="realweddings/<?php echo $realweddata[$r]->user_id;?>"><?php $bride = $realweddata[$r]->bride_name; $explode_bride = explode(" ", $bride); echo $explode_bride[0]; ?> Weds <?php $groom = $realweddata[$r]->groom_name; $explode_groom = explode(" ", $groom); echo $explode_groom[0]; ?> </a></h3>
                                    <p><i class="fa fa-map-marker"></i> <?php echo  $realweddata[$r]->town;?></p>
                                </div>
                                <div class="img">
                                    <div class="overlay">
                                        <i class="weddingdir_heart_double_alt"></i>
                                        Our Wedding
                                    </div>
                                    <?php
                               $realwed_gallery = $realweddata[$r]->gallery;
                              $explode_gallery = explode(',', $realwed_gallery);
                             // print_r($explode_gallery);
                               $prefixed_array = preg_filter('/^/', 'images/realwed/', $explode_gallery);
                                 $remove = array_pop($prefixed_array); 
                                  // print_r($prefixed_array);
                                   
                                         
                                    ?>
                                    <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>"><img src="<?php echo $prefixed_array[0];?>" alt=""></a>
                                    <div class="date">
                                       <?php $weddate = strtotime($realweddata[$r]->wedding_date); echo date("F d, Y",$weddate);?>
                                    </div>
                                </div>
                                <ul class="list-unstyled gallery">
                               
                                    <li>
                                        <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>">
                                            <img src="<?php echo $prefixed_array[0];?>" alt="">
                                        </a>
                                    </li>

                                    <li>
                                        <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>">
                                            <img src="<?php echo $prefixed_array[1];?>" alt="">
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>">
                                            <div class="load-more">
                                                Load <br>More
                                            </div>
                                            <img src="<?php echo $prefixed_array[3];?>" alt="">
                                        </a>
                                    </li>
                                      
                                </ul>
                            </div>                            
                        </div>
                    </div>
                    <?php }  ?>
                    <!-- Real Wedding Stories -->                    
                   
                </div>
                <div class="text-center mt-5">
                <a href="realweddings-list" class="btn btn-default btn-rounded btn-lg">More Real Weddings</a>
                </div>
            </div>
        </section>
        <!-- Real Wedding End -->

        <!-- Meat Our Team Start -->
        

        <!-- Customer Feedback Start -->
        

        <!-- Wedding Fashion Gallery Start -->
        

    
         