<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$website_id = array(
    
    "id"=>$_SESSION['userid']
 
);
$realwed_user = $website_id['id'];

$display_data = $little->shaz_curl(json_encode($website_id), \NsLittle\Little::ROUTE.'/website_info.php');

$data_decoded = json_decode($display_data);
//print_r($data_decoded);

$bride           = $data_decoded->data->bride_name;
$groom           = $data_decoded->data->groom_name;
$weddingaddress  = $data_decoded->data->wedding_venue;
$weddingdate     = $data_decoded->data->wedding_date;
$newdate = strtotime($weddingdate);
$wedding_date = date("F d, Y",$newdate);


$realwed = array(
    "user_id" => $_SESSION['userid']
);

$display_realwed =$little->shaz_curl(json_encode($realwed), \NsLittle\Little::ROUTE. '/select_realwed.php');
//print_r($display_realwed);
$realwed_decoded = json_decode($display_realwed);
$realwed_id   = $realwed_decoded->data->realwed_id;
$realwed_user_id   = $realwed_decoded->data->user_id;
$realwed_bride     = $realwed_decoded->data->bride_name;
$realwed_groom     = $realwed_decoded->data->groom_name;
$realwed_town      = $realwed_decoded->data->town;
$realwed_date      = $realwed_decoded->data->wedding_date;
$wedding_theme     = $realwed_decoded->data->wedding_theme;
$realwed_featured  = $realwed_decoded->data->featured_image;
$realwed_gallery   = $realwed_decoded->data->gallery;

$realwed_bride_explode = explode(" ", $realwed_bride);
$realwed_groom_explode = explode(" ", $realwed_groom);

//echo $realwed_featured;
//----- vendor manager==========================================================================================//

  $favourite = $little->shaz_curl($realwed, \NsLittle\Little::ROUTE.'/group_favourite.php');
  //print_r($favourite);
$decode_favourite = json_decode($favourite);
//print_r($decode_favourite);
$favs = $decode_favourite->favourites;

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
                        <h2>Real Wedding</h2>
                    </div>
                    <!-- Page Heading -->
                    <div class="card-shadow">
                    <div class="card-shadow-body p-3">
                    <div class="row">
                        <div class="col-xl-12">
                            <input type="text" value="<?php echo $realwed_url.$realwed_user;?>" id="myInput" style="display:none"><span class="text-primary text-small"></span><span class="ml-4"><button onclick="myFunction()" class="btn btn-outline-primary">Copy URL</button></span><a href="<?php echo $realwed_url.$realwed_user;?>" class="btn btn-outline-primary ml-2"><i class="fa fa-eye">View My Real wedding</i></a>
                      </div>
                    </div>
                    </div>
                    </div>
                    
                    <form enctype='multipart/form-data'>
                        <div class="card-shadow">
                            <div class="card-shadow-header p-0 d-flex align-items-center">
                                <span class="budget-head-icon"> <i class="weddingdir_location_heart text-white"></i></span>
                                <span class="head-simple">Wedding Info</span>                                
                            </div>
                            <div class="card-shadow-body p-3">
                                <div class="row">
                                    <input type="hidden" id="relwedid" value="<?php echo $realwed_id;?>">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                         <label>Bride Name</label>
                                         <input type="text" class="form-control" id="couple-bride-name" name="bride_name"  value="<?php echo $bride;?>" placeholder="Bride Full Name" disabled>
                                     </div>
                                 </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                         <label>Groom Name</label>
                                         <input type="text" class="form-control" id="couple-groom" name="groom_name" value="<?php echo $groom;?>" placeholder="Groom Full Name" disabled>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Wedding Date</label>
                                        <input type="text" class="form-control datepicker" id="couple-weddingdate" name="wedding_date"  value="<?php echo $wedding_date;?>" placeholder="Select Wedding Date" disabled>
                                    </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Wedding Theme</label>
                                        <input type="text" class="form-control" id="couple-weddingtheme" value="<?php echo $wedding_theme; ?>" name="wedding_theme"  placeholder="Wedding Theme">
                                    </div>  
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Wedding Town</label>
                                            <input type="text" class="form-control" id="couple-weddingtown" name="town"  placeholder="Town/City Wedding took place" value="<?php echo $realwed_town; ?>">
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>

                        <div class="card-shadow">
                            <div class="card-shadow-header p-0 d-flex align-items-center">
                                <span class="budget-head-icon"> <i class="weddingdir_heart_double_face text-white"></i></span>
                                <span class="head-simple">Set Featured Images</span> 
                                
                            </div>
                          <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                            <span class="m-4 text-warning">make sure your image has a minimum width of 800px. Image should be lanscape size.</span>
                            <div class="vendor-profile-img">
                               <div class="vendor-btn">
                                    <input type="file" id="cover_picture" name="featured_image"   accept="image/*">
                                    <span id="coverpicerror" class="text-danger" style="display:none">Cover Picture needed!</span>
                                </div>
                                
                            </div>
                        

                        </div>
                        </div>

                        <div class="card-shadow">
                            <div class="card-shadow-header p-0">
                                <div class="d-flex align-items-center row">
                                    <div class="col-md-5">
                                        <div class="d-flex align-items-center">
                                            <span class="budget-head-icon"> <i class="weddingdir_dove text-white"></i></span>
                                            <span class="head-simple">Upload Real wedding Gallery</span>  
                                        </div>                                        
                                    </div>
                                       
                                    <div class="col-md-7 pr-4">
                                        
                                        <div class="d-flex align-items-center justify-content-md-end px-3 ml-auto my-3 my-md-0">
                                            <span class="mr-3 text-muted"><small>Maximum of 10 images can be uploaded at ago and Minimum of 5 images</small></span>
                                            <div class="custom-file button-style">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                                           
                            </div>
                            <div class="card-shadow-body p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="dropzone" id="realwed-gallery"></div>
                                </div> 
                                </div>
                            </div>
                          
                        <div class="col-md-12">
                        <button type="button" id="real-wedding-info" class="btn btn-primary btn-rounded mb-5">Upload Wedding Information</button>
                       </div>
                        </div>
                       </div>
                      </form>
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
                <div class="card-shadow mt-5">
                <div class="card-shadow-header p-0 d-flex align-items-center">
                <span class="budget-head-icon"> <i class="weddingdir_heart_double_face text-white"></i></span>
                <span class="head-simple">Gallery</span> 

                    </div>
                    <div class="guest-list-table table-responsive">
                     <div class="single-guest-tab">
                              <?php
                      
                            $explode_gallery = explode(",", $realwed_gallery);
                           // print_r($explode_gallery);
                          array_pop($explode_gallery); // removes last element of an array which was a blank value
                         // print_r($explode_gallery);


                            ?>
                                                        
                <table class="table bg-white"  id="gallery-table">
                  <thead>
                    <tr>
                    <th>Image</th>
                    <th>Action</th>

                     </tr>
                    </thead>
                    <tbody>
                        <?php

                  foreach($explode_gallery as $gal){

                        $trid = str_replace(".","",$gal);
                       // echo $trid;
                     ?>
                  <tr id="tash-<?php echo $trid; ?>">
                      <td><img src="images/realwed/<?php echo $gal;?>" class="img-thumbnail img-responsive" style="width:20% !important;"></td><input type="hidden"value="<?php echo $gal;?>">
                  <td id="<?php echo $gal; ?>" class="editwebgal"><a href="javascript:" ><i class="fa fa-trash"></i></a></td>
                 </tr>
              <?php  } ?>
                </tbody>
            </table>
        </div>
       </div> 
          </div>
           </div>
           
        </div>
        </div>
       
            
  <script>
function myFunction() {
  //alert("hello");/* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
   swal({
        title: "Copied!",
        icon:"success",
        type: "sucess"
    });
  
}
</script>
<?php } else{ include_once 'login.php';}?>