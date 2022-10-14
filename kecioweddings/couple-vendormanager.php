
<?php       
if($_SESSION['user_session_exists'] === "TRUE"){
$fav_user = array("user_id" => $_SESSION['userid'] );
   
  $favourite = $little->shaz_curl(json_encode($fav_user), \NsLittle\Little::ROUTE.'/group_favourite.php');
  //print_r($favourite);
$decode_favourite = json_decode($favourite);
//print_r($decode_favourite);
$favs = $decode_favourite->favourites;
//print_r($favs);
//echo count($favs);
$first_records = $favs[0]->records;
//print_r($first_records);

 $first_cat =  $favs[0]->cat_id;
// print_r($first_cat);


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
                        <h2>Vendor Manager</h2>
                        <h5>(Like vendors to add them here)</h5> 
                    </div>
                    <!-- Page Heading -->

                    <div class="row">
                        <!-- Budget Start -->
                        <div class="col-12 col-xl-3">
                            <div class="d-flex flex-column flex-xl-column-reverse">
                                <div class="nav flex-column nav-pills theme-tabbing-vertical budget-tab mb-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-<?php echo $first_cat;?>-tab" data-toggle="pill" href="#v-pills-<?php echo $first_cat;?>" role="tab"
                                    aria-controls="v-pills-venue" aria-selected="true">
                                        <?php if($first_cat== 0) {?>
                                     <i class="weddingdir_bell"></i>
                                    <?php }else if ($first_cat == 1){?>
                                    <i class="weddingdir_heart_double_face"></i>
                                    <?php } elseif($first_cat == 2){?>
                                     <i class="weddingdir_cake"></i>
                                    <?php } elseif($first_cat == 3){?>
                                     <i class="weddingdir_guitar"></i>
                                    <?php } elseif($first_cat == 4){?>
                                     <i class="weddingdir_florist"></i>
                                    <?php } elseif($first_cat == 5){?>
                                     <i class="weddingdir_location_heart"></i>
                                    <?php } elseif($first_cat == 6){?>
                                     <i class="weddingdir_tent"></i>
                                    <?php } elseif($first_cat == 7){?>
                                     <i class="weddingdir_camera"></i>
                                    <?php } elseif($first_cat == 8){?>
                                     <i class="weddingdir_videographer"></i>
                                    <?php } elseif($first_cat == 9){?>
                                     <i class="weddingdir_pheras"></i>
                                    <?php } elseif($first_cat == 10){?>
                                     <i class="weddingdir_seating_chart"></i>
                                    <?php } elseif($first_cat == 11){?>
                                     <i class="weddingdir_fashion"></i>
                                    <?php } elseif($first_cat == 12){?>
                                     <i class="weddingdir_vendor_manager"></i>
                                    <?php } elseif($first_cat == 13){?>
                                     <i class="weddingdir_heart_envelope"></i>
                                    <?php }elseif($first_cat == 14){?>
                                     <i class="weddingdir_church"></i>
                                    <?php } elseif($first_cat == 15){?>
                                     <i class="weddingdir_vendor_truck"></i>
                                    <?php } elseif($first_cat == 16){?>
                                     <i class="weddingdir_venue"></i>
                                    <?php }  ?>
                                       
                                    <?php if($first_cat == 0){ echo "No vendor Added";}else{echo $favs[0]->category; }?></a>
                                    
                                      <?php
                                      for($t = 1; $t < count($favs); $t++){
                                        $records = $favs[$t]->records;
                                       // print_r($records);
                                      $fav_category = $favs[$t]->cat_id;
                                      //print_r($fav_category);
                                       ?>
                                     <a class="nav-link" id="v-pills-<?php echo $fav_category; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $fav_category; ?>" role="tab"
                                    aria-controls="v-pills-photographer" aria-selected="true">
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
                                         
                                      <?php if($fav_category == 0){ echo "Other";}else{ echo  $favs[$t]->category;} ?></a>
                                    
                                      <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-12 col-xl-9">
                            <div class="tab-content budget-tab-content" id="v-pills-tabContent">

                                <!-- Venue -->
                                <div class="tab-pane fade show active" id="v-pills-<?php echo $first_cat;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $first_cat;?>-tab">                                    
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2">
                                       <?php for($c=0; $c < count($first_records); $c ++){  ?>
                                        
                                        <div class="col-sm-6 col-md-4 col-xl-4" id="list-<?php echo $first_records[$c]->listing_id;?>">
                                            <div class="wedding-listing">
                                                <div class="img">
                                                    <a href="supplier-singular/<?php echo $first_records[$c]->listing_id;?>">
                                                        <img src="images/listing_featured/<?php echo $first_records[$c]->featured_image;?>" alt="">
                                                    </a>
                                                    <div class="img-content">
                                                        <div class="top text-right">                                                           
                                                            <a class="favorite deletefav" id="del<?php echo $first_records[$c]->listing_id;?>" href="javascript:">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="gap">
                                                        <h4><a href="supplier-singular/<?php echo $first_records[$c]->listing_id;?>"><?php echo ucwords($first_records[$c]->listing_name);?></a></h4>
                                                       <div class="form-group mt-2">
                                                            <select class="theme-combo" id="state<?php echo $first_records[$c]->listing_id; ?>" name="state">
                                                                <option value="Evaluating">Evaluating</option>
                                                                <option value="Hired">Hired</option>
                                                            </select>
                                                        </div>
                                                    
                                            <ul class="list-unstyled status-list">
                                                <?php if($first_records[$c]->state == "Hired"){?>
                                            <li>
                                                <a href="javascript:"><span class="badge badge-success">&nbsp;</span> Hired </a>
                                            </li>
                                                <?php }else if($first_records[$c]->state == "Evaluating"){ ?>
                                           <li>
                                                <a href="javascript:"><span class="badge badge-danger">&nbsp;</span> Evaluating</a>
                                            </li>
                                                <?php } ?>
                                            
                                        </ul>
                                                        

                                                        <div class="mt-3">
                                                            <label>Notes</label>
                                                            <textarea class="form-control" id="text-<?php echo $first_records[$c]->listing_id; ?>" placeholder="Text here" rows="3"><?php echo $first_records[$c]->notes; ?></textarea>
                                                        </div>
                                                        <button class="btn btn-outline-default mt-2 savefavs" id="<?php echo $first_records[$c]->listing_id;?>">Save</button>
                                                        
                                                    </div>
                                                    <div class="bottom-footer">
                                                        
                                                        <span><a href="supplier-singular/<?php echo $first_records[$c]->listing_id;?>"><i class="fa fa-eye"></i> View Vendor</a></span>
                                                        
                                                    </div>    
                                                </div>                                                
                                            </div>
                                        </div>
                                       <?php } ?>
                                    </div>
                                </div>
                                <!-- Venue -->

                                <!-- Photographer -->
                                <?php 
                                for($t = 1; $t < count($favs); $t++){
                                    
                                    ?>
                                <div class="tab-pane fade" id="v-pills-<?php echo $favs[$t]->cat_id;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $favs[$t]->cat_id;?>-tab">
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2">
                                        <?php 
                                      $records = $favs[$t]->records;
                                     //echo count($records);
                                    for($dt = 0; $dt < count($records); $dt++) { ?> 
                                        <div class="col-md-4 col-xl-4" id="list-<?php  echo $records[$dt]->listing_id;  ?>">
                                            <div class="wedding-listing">
                                                <div class="img">
                                                    <a href="supplier-singular/<?php  echo $records[$dt]->listing_id;  ?>">
                                                        <img src="images/listing_featured/<?php echo $records[$dt]->featured_image; ?>" alt="">
                                                    </a>
                                                    <div class="img-content">
                                                        <div class="top text-right">                                                           
                                                            <a class="favorite" href="javascript:">
                                                                <i class="fa fa-times deletefav" id="del<?php echo $records[$dt]->listing_id;?>"></i>
                                                            </a>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="gap">
                                                        <h4><a href="supplier-singular/<?php echo $records[$dt]->listing_id; ?>"><?php echo ucwords($records[$dt]->listing_name);?></a></h4>
                                                       <div class="form-group mt-2">
                                    <select class="theme-combo" id="state<?php echo $records[$dt]->listing_id; ?>" name="state">
                                                                <option value="Evaluating">Evaluating</option>
                                                                <option value="Hired">Hired</option>
                                                            </select>
                                                        </div>

                                                        <ul class="list-unstyled status-list">
                                                        <?php if($records[$dt]->state == "Hired"){?>
                                                    <li>
                                                        <a href="javascript:"><span class="badge badge-success">&nbsp;</span> Hired </a>
                                                    </li>
                                                        <?php }else if($records[$dt]->state == "Evaluating"){ ?>
                                                   <li>
                                                        <a href="javascript:"><span class="badge badge-danger">&nbsp;</span> Evaluating</a>
                                                    </li>
                                                        <?php } ?>

                                                     </ul>

                                                        <div class="mt-3">
                                                            <label>Notes</label>
                                                            <textarea class="form-control" id="text-<?php echo $records[$dt]->listing_id; ?>" placeholder="Text here" rows="3"><?php echo $records[$dt]->notes; ?></textarea>
                                                        </div>
                                                        <button class="btn btn-outline-default mt-2 savefavs" id="<?php echo $records[$dt]->listing_id;?>">Save</button>
                                                        
                                                    </div>
                                                      
                                                </div>                                                
                                            </div>
                                        </div>
                                     <?php }  ?>
                                        
                                    </div>
                                </div>
                                <?php  } ?>    <!-- Photographer -->
                               
                            </div>
                        </div>
                        <!-- Budget End -->
                    </div>

                    
                </div>
            </div>
            
        </div>        
<?php }else{include_once 'login.php';}?>

    
  