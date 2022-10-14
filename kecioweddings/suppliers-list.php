<?php
$supplierlist = array(
    
   "cat_id"  => $url_id,
   "region"  => $url_region
    
);
//print_r($supplierlist);
$data = $little->shaz_curl(json_encode($supplierlist), \NsLittle\Little::ROUTE.'/filterlist.php');
$data_decode = json_decode($data);
$mylist = $data_decode->data;
//print_r($mylist);
$count_list = count($mylist);

// location-----------//

$getlocation = array();
$get_location =$little->shaz_curl(json_encode($getlocation), \NsLittle\Little::ROUTE.'/loop_location.php');
//print_r($get_location);
$location_decode = json_decode($get_location);
$mylocations = $location_decode->todo;

//=================== categories=============================================================//
$get_category = array();

$categories = $little->shaz_curl(json_encode($get_category), \NsLittle\Little::ROUTE.'/get_category.php');
//print_r($categories);
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
 
//========= favorites =======================================///
  
$favourites = array(
    "user_id" => $_SESSION['userid']
);
                   
          
$fdata = $little->shaz_curl(json_encode($favourites), \NsLittle\Little::ROUTE.'/display_favourites.php');
//echo  \NsLittle\Little::ROUTE.'/display_favourites.php';
//print_r($fdata);
$favs_array = json_decode($fdata);




include_once 'modals/modals-request-quote.php';

?>

    <!-- =============================
       *
       *   Page Content Start
       *
      =============================== -->
    

 

    <!--  Search Result Header Start -->
    
    <?php include_once 'slider-supplier-list.php';?>
   
        <section class="wide-tb-50 bg-white">
            <div class="container">
                <div class="row"> 
                     <input id="totalpagelistings" type="hidden" value="<?php echo $count_list;?>">                 
                    <div class="col-lg-12 bg-white">
                        <div class="result-count">
                            <strong><?php echo $count_list;?> Results:</strong>
                            <ul class="nav nav-pills theme-tabbing list-style-map" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link show active" id="pills-listing-tab" data-toggle="pill" href="#pills-listing" role="tab" aria-controls="pills-listing" aria-selected="false"><i class="fa fa-list-ul"></i> List</a>
                                </li>
                                
                                </ul>
                           
                        </div>

                        <div class="tab-content theme-tabbing search-result-tabbing" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
                            <div class="table-responsive mt-2">
                            <table class="table mb-0" id="supplier_list_datatable">
                                    <thead class="thead-light">
                                   <tr>
                                        <th scope="col">Results</th>
                                   </tr>
                                    </thead>
                                    <tbody>    <!-- Search Result List -->   
                                
                  <?php

	        for($stuff = 0; $stuff < $count_list; $stuff ++){
                $status = $mylist[$stuff]->status;
		$vendor_id = $mylist[$stuff]->vendor_id;
                
                 if($status === "Approved"){
                ?>
                                
                               
                                <tr>
                               <td>
                                <input type="hidden" id="name<?php echo $mylist[$stuff]->listing_id; ?>" value="<?php echo $mylist[$stuff]->listing_name; ?>">
                                <input type="hidden" id="featured<?php echo $mylist[$stuff]->listing_id; ?>" value="<?php echo $mylist[$stuff]->featured_image; ?>">
                                
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="">
                                                <a href="supplier-singular/<?php echo $mylist[$stuff]->listing_id;?>"><img src="images/listing_featured/<?php if(!empty($mylist[$stuff]->featured_image)){echo $mylist[$stuff]->featured_image; }else{?>vendor_img_1.jpg <?php } ?>" class="rounded keciolisviews" alt="" id="lv-<?php echo $mylist[$stuff]->listing_id; ?>"></a>
                                            </div>
                                            <input type="hidden" id="listview-<?php echo $mylist[$stuff]->listing_id;?>" value="1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="content">
                                                <div class="head">
                                                    <a href="javascript:" class="favorite active" style="display: none" id="shazr-<?php echo $mylist[$stuff]->listing_id;?>" ><i class="fa fa-heart"></i></a>
                                                     <?php if(in_array($mylist[$stuff]->listing_id, $favs_array)){?>  <a href="javascript:" class="favorite active" id="kec<?php echo $mylist[$stuff]->listing_id;?>" ><i class="fa fa-heart"></i></a><?php }else{ ?>
                                                     <?php if($_SESSION['user_session_exists'] !== "TRUE"){?>
                                                      <a href="javascript:" class="favorite" data-toggle="modal" data-target="#general-login" ><i class="fa fa-heart" ></i></a>
                                                     <?php   }else{ ?>
                                                    <a href="javascript:" id="<?php echo $mylist[$stuff]->listing_id;?>,<?php echo $mylist[$stuff]->cat_id ?>" class="favorite wishlist-sign"><i class="fa fa-heart"></i></a>
                                                     <?php } } ?>
                                                    
                                                     <h3><a href="supplier-singular/<?php echo $mylist[$stuff]->listing_id;?>" class="keciolistviews" id="namlist-<?php echo $mylist[$stuff]->listing_id;?>"><?php echo ucwords($mylist[$stuff]->listing_name);?></a></h3>
                                                      <?php $eachlisting = $mylist[$stuff]->listing_id;
                                                        //echo $eachlisting;
                                                        $listingarray = array(
                                                            
                                                            "listing_id" =>$eachlisting
                                                        );
                                                    
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
                                                    <div class="rating">
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
                                                        <?php } else if($ratings === '5.0'){?>
                                                         <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                                                                
                                                        </span>
                                                        <?php }else if($ratings > '4.0' && $ratings < '5.0'){ ?>
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </span>
                                                        <?php } ?>
                                                        <?php echo number_format($review_ratings,1);?>
                                                        
                                                        (<?php echo $review_totals;?> reviews)  <i class="fa fa-map-marker"></i>  <?php echo $mylist[$stuff]->Town_name;?>, <?php echo $mylist[$stuff]->County_name;?>
                                                    </div>
                                                </div>
                                               <p><?php echo implode(' ', array_slice(explode(' ', $mylist[$stuff]->about), 0, 40))."..." ?></p>
                                                <div class="bottom">
                                                    <p><span><a href="https://wa.me/<?php echo $mylist[$stuff]->whatsapp;?>?text=hello,%20I'm%20Intrested%20in%20your%20KecioWeddings%20Ad:%20<?php   echo $mylist[$stuff]->listing_name;  ?>%20%20<?php echo $supplier_url.$mylist[$stuff]->listing_id;?>%20%20">
                                                    <img src="images/native/whatsapp-32.png" width="40px" height="40px" class="keciowhatsapp" id="whts-<?php echo $mylist[$stuff]->listing_id; ?>" ></a></span>
                                                        <input type="hidden" id="wh-<?php echo $mylist[$stuff]->listing_id; ?>" value="1">  
                                                          <?php 
                                                           $phone = substr_replace($mylist[$stuff]->phone_number, "254",0,1);
                                                          
                                                          ?>
                                                        
                                                        <a href="tel:<?php echo $phone;?>"><span class="p-3"><img src="images/native/phone.png" width="40px" class="keciogetphone" id="get-<?php echo $mylist[$stuff]->listing_id; ?>" height="40px"></span></a>
                                                        <input type="hidden" id="ph-<?php echo $mylist[$stuff]->listing_id; ?>" value="1">
                                                        
                                                      </p>
                                                       
                                                    <?php
                                                    
                                        $listing_id          = array(
                                         "listing_id"       =>$mylist[$stuff]->listing_id);
                                        $data               = $little->shaz_curl(json_encode($listing_id), \NsLittle\Little::ROUTE.'/displaygallery.php');
                                        $gallery_decode     = json_decode($data);
                                        $gallery            = $gallery_decode->data->gallery;
                                        $explode_gallery   = explode(',', $gallery);
                                        $prefixed_array    =  $explode_gallery;
                                        $remove            = array_pop($prefixed_array);
                                        
                                        //print_r($prefixed_array);
                                        ?>
                                       <div class="isotope-gallery vendor-img-gallery row">
                                      <a href="images/vendor_listings/<?php echo $prefixed_array[0];?>" title="<?php echo $mylist[$stuff]->listing_name;?>">
                                     <button class="btn btn-outline-primary btn-rounded keciogal" id="gv-<?php echo $mylist[$stuff]->listing_id; ?>" alt="">View Gallery</button>
                                     <input type="hidden" id="galviews-<?php echo $mylist[$stuff]->listing_id; ?>" value="1">
                                      </a>                                            
                                         
                                         <?php 
                                         array_shift($prefixed_array) ;
                                         foreach($prefixed_array as $photos){
                                            $array_photos = explode('.', $photos);
                                            $array1       = $array_photos[0];
                                            $newphotos    = $array1.'.webp';
                                           // print_r($newphotos);
                                             
                                         ?>
                                            <a href="images/vendor_listings/<?php echo $newphotos;?>" title="<?php echo $mylist[$stuff]->listing_name;?>">
                                               </a>                                            
                                           
                                         <?php } ?>
                                                 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </td>
                                </tr>
                <?php } } ?>
                                 </tbody>
                                </table>
                            </div>
                              
                                <!-- Post Pagination -->
                            </div>
                            

                            
                        </div>

                        
                    </div>
                </div>
            </div>
        </section>
 

    
    
        