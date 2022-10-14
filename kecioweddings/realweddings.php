<?php
$realwed = array(
    "user_id" => $url_id
);

$display_realwed =$little->shaz_curl(json_encode($realwed), \NsLittle\Little::ROUTE. '/select_realwed.php');
//print_r($display_realwed);
$realwed_decoded = json_decode($display_realwed);

$realwed_user_id   = $realwed_decoded->data->user_id;
$realwed_bride     = $realwed_decoded->data->bride_name;
$realwed_groom     = $realwed_decoded->data->groom_name;
$realwed_town      = $realwed_decoded->data->town;
$realwed_date      = $realwed_decoded->data->wedding_date;
$realwed_featured  = $realwed_decoded->data->featured_image;
$realwed_gallery   = $realwed_decoded->data->gallery;

$realwed_bride_explode = explode(" ", $realwed_bride);
$realwed_groom_explode = explode(" ", $realwed_groom);

$favourite = $little->shaz_curl(json_encode($realwed), \NsLittle\Little::ROUTE.'/group_favourite.php');
  //print_r($favourite);
$decode_favourite = json_decode($favourite);
//print_r($decode_favourite);
$favs = $decode_favourite->favourites;


?>


<!-------------------------- Real wedding section --------------------------------------------------------------------------------------------------------> 
<style>
      .real-wedding-single-img {
  background: url(images/realwed/<?php echo $realwed_featured;?>) no-repeat
    center center;
  background-size: cover;
  position: absolute;
  height: 100%;
  width: 100%;
}
@media only screen and (max-width : 1000px) {
    .real-wedding-single{
        padding-top:129px;
        height:150px;
        margin-bottom:10px;
    }    

    }
  </style>

     
<section class="real-wedding-single-wrap mt-3">
            <div class="real-wedding-single-img"></div>
            <div class="real-wedding-single">
                <div class="container h-25">
                    <div class="row align-items-lg-end d-flex h-25 align-items-center">
                        <div class="col-lg-5">
                            <div class="name">
                                
                                <div>
                                    <h4 class="text-white"><?php echo $realwed_groom_explode[0]; ?> & <?php echo $realwed_bride_explode[0];?></h4>
                                    <span><i class="fa fa-map-marker"></i> <?php echo $realwed_town;?></span>
                                    <span><i class="fa fa-calendar"></i><?php echo $realwed_date;?></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="wide-tb-90">
            <div class="container">
                
                <!-- Photo Gallery -->
                <div class="card-shadow pos-rel">
                    <div class="card-shadow-header d-lg-flex align-items-center justify-content-between">
                        <h3><i class="fa fa-image"></i> Photo Gallery</h3>
                        
                    </div>
                    <div class="card-shadow-body">
                        <div class="isotope-gallery vendor-img-gallery row">
                            
                             <?php
                              $explode_gallery = explode(',', $realwed_gallery);
                              //print_r($explode_gallery);
                               $prefixed_array = preg_filter('/^/', 'images/realwed/', $explode_gallery);
                                 $remove = array_pop($prefixed_array); 
                                  // print_r($prefixed_array);
                                   
                                      foreach($prefixed_array as $photo) {
                                    
                              
                               ?>
                            
                            
                            <div class="gallery-item col-lg-4 col-md-6 col-12 mahendi">
                                <div class="vendor-gallery">
                                    <a href="<?php echo $photo;?>" title="Wedding Photos">
                                        <img src="<?php echo $photo;?>" class="rounded" alt="">
                                    </a>                                            
                                </div>
                            </div>
                                      <?php } ?> 
                        </div>
                    </div>
                </div>
                <!-- Photo Gallery -->

                <!-- Tagged Vendors -->
               <div class="card-shadow pos-rel mt-5">
                    <div class="card-shadow-header">
                        <h3><i class="fa fa-tags"></i>Vendors Hired</h3>
                      
                    </div>
                    <div class="card-shadow-body">
                        <div class="row">
                            <?php
                                      for($t = 0; $t < count($favs); $t++){
                                        $records = $favs[$t]->records;
                                       // print_r($records);
                                      $fav_category = $favs[$t]->cat_id;
                                    for($dt = 0; $dt < count($records); $dt++) { 
                                        
                                    
                                              ?> 
                            <!-- Vendor Details Stories -->
                            <div class="col-lg-3 col-md-6">
                               <div class="tagged-vendors">
                                   <?php if($fav_category== 0) {?>
                                     <i class="weddingdir_bell"></i>
                                    <?php }else if ($fav_category == 1){?>
                                    <i class="weddingdir_heart_double_face"></i>
                                    <?php } elseif($fav_category == 2){?>
                                     <i class="weddingdir_cake"></i>
                                    <?php } elseif($fav_category == 3){?>
                                     <i class="weddingdir_guitar"></i>
                                    <?php } elseif($fav_category == 4){?>
                                     <i class="weddingdir_florist"></i>
                                    <?php } elseif($fav_category == 5){?>
                                     <i class="weddingdir_location_heart"></i>
                                    <?php } elseif($fav_category == 6){?>
                                     <i class="weddingdir_tent"></i>
                                    <?php } elseif($fav_category == 7){?>
                                     <i class="weddingdir_camera"></i>
                                    <?php } elseif($fav_category == 8){?>
                                     <i class="weddingdir_videographer"></i>
                                    <?php } elseif($fav_category == 9){?>
                                     <i class="weddingdir_pheras"></i>
                                    <?php } elseif($fav_category == 10){?>
                                     <i class="weddingdir_seating_chart"></i>
                                    <?php } elseif($fav_category == 11){?>
                                     <i class="weddingdir_fashion"></i>
                                    <?php } elseif($fav_category == 12){?>
                                     <i class="weddingdir_vendor_manager"></i>
                                    <?php } elseif($fav_category == 13){?>
                                     <i class="weddingdir_heart_envelope"></i>
                                    <?php }elseif($fav_category == 14){?>
                                     <i class="weddingdir_church"></i>
                                    <?php } elseif($fav_category == 15){?>
                                     <i class="weddingdir_vendor_truck"></i>
                                    <?php } elseif($fav_category == 16){?>
                                     <i class="weddingdir_venue"></i>
                                    <?php }  ?>
                                   
                               
                                   <h3><?php echo ucwords($records[$dt]->listing_name);?></h3>
                                    
                                   <p><?php echo  $favs[$t]->category;?></p>
                                   <a href="supplier-singular/<?php echo $records[$dt]->listing_id ?>">View Vendor</a>
                               </div>
                            </div>
                            <!-- Vendor Details Stories --> 
                                      <?php } }  ?>
                       </div>                        
                    </div>
                </div>
                <!-- Tagged Vendors -->

                
            </div>
        </section>    

    