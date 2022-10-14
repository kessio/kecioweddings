<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$all_furniture = array();

$myfurniture = $little->shaz_curl(json_encode($mylisting_id), \NsLittle\Little::ROUTE.'/display_all_furniture.php');
//print_r($myfurniture);
$myfurniture_decode = json_decode($myfurniture);
$myallfurniture = $myfurniture_decode->data;
//print_r($myallfurniture);


$all_tents = array();

$mytents = $little->shaz_curl(json_encode($mylisting_id), \NsLittle\Little::ROUTE.'/display_all_tents.php');
//print_r($mytents);
$my_tents_decode = json_decode($mytents);
//print_r($my_tents_decode);
$myalltents = $my_tents_decode->data;


// getting listingid from url ///
$mylisting_id = array(
    "listing_id" =>$url_id
    
);

//print_r($mylisting_id);

foreach ($mylisting_id as $list_id) {
    $listing_id = $list_id;
   
}
//echo $mylisting_id;

$data = $little->shaz_curl(json_encode($mylisting_id), \NsLittle\Little::ROUTE.'/single_suppliers_listing.php');
//print_r($data);
$decode_data = json_decode($data);
//print_r($decode_data);
$mylisting = $decode_data->data;
//print_r($mylisting);

for ($ml = 0; $ml < count($mylisting); $ml++){
    $listing_name    = $mylisting[$ml]->listing_name;
    $category        = $mylisting[$ml]->category;
    $cat_id          = $mylisting[$ml]->cat_id;
    $tents           = $mylisting[$ml]->tents;
    $subcategory     = $mylisting[$ml]->subcategory;
    $facility        = $mylisting[$ml]->facility;
    $entertainment   = $mylisting[$ml]->entertainment;
    $furniture       = $mylisting[$ml]->furniture;
    $price           = $mylisting[$ml]->price;
    $about           = $mylisting[$ml]->about;
    $services        = $mylisting[$ml]->services;
    $amenities       = $mylisting[$ml]->amenities;
    $facebook        = $mylisting[$ml]->facebook;
    $instagram       = $mylisting[$ml]->instagram;
    $gallery         = $mylisting[$ml]->gallery;
    $whatsapp        = $mylisting[$ml]->whatsapp;
    $cover_picture   = $mylisting[$ml]->cover_picture;
    
}

$explode_furniture = explode(',',$furniture);
///print_r($explode_furniture);

$explode_tents = explode(',', $tents);
//print_r($explode_tents);

$explode_amenities = explode(',',$amenities);
//print_r($explode_amenities);
 
?>
<style>
    .vendor-banner-cover { border-bottom: transparent; background: url(images/listing_coverpic/<?php echo $cover_picture;?>) no-repeat center; background-size: cover; min-height: 340px; }
</style>
<div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h2>Edit Listing</h2>
                            <div class="d-flex align-items-center mt-2 mt-md-0">
                            </div>
                        </div>                           
                    </div>
                    <!-- Page Heading -->

                    <div class="card-shadow">
                        
<input id="editlisting_id"  type="hidden" name="listing_id" class="form-control" value="<?php echo $listing_id; ?>">
                        <form>
                            <div class="todo-subhead">
                                <h3>Listing Info</h3>
                            </div>
                            <div class="px-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id ="edittitle" class="form-control form-dark" value="<?php echo $listing_name; ?>">
                                             
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         <input  name="category" type="text" value="<?php  echo $category; ?>" class="form-control" disabled>
                                          <input type="hidden"value="<?php  echo $cat_id; ?>" class="form-control">   
                                        </div>
                                    </div>
 <?php if($cat_id == '3'){ ?>
          <div class="col-md-6">
                   <div class="form-group" style="margin-bottom:1rem" >
                           <select class="theme-combo" id="entertainment">
                                <option value="<?php echo $entertainment;?>"><?php echo $entertainment;?></option>
                                
                            </select>
                        </div>
                                </div>
                                    <?php } ?>
                                     <?php if($cat_id == '10') {    

 ?> 

                        <div class="px-4 pt-0 mb-5">
                            <h3>Furniture Offered</h3>
                                <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2">
                                     <?php foreach($myallfurniture as $f)  {
                                            
                                            if(in_array($f, $explode_furniture)){
                                            
                                            ?>
                                    <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck<?php  echo $f;?>" checked value="<?php  echo $f;?>">
                                            <label class="custom-control-label" for="customCheck<?php  echo $f;?>"><?php  echo $f;?></label>
                                        </div>
                                         </div>
                                    </div>
                                            <?php }else{ ?>
                                                
                                              <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck<?php  echo $f;?>" value="<?php  echo $f;?>">
                                            <label class="custom-control-label" for="customCheck<?php  echo $f;?>"><?php  echo $f;?></label>
                                        </div>
                                         </div>
                                    </div>  
                                            
                                            <?php } }?>
                                </div>
                        </div>
                  <?php } ?>
                                <?php
                                    if($cat_id == '5') { ?> 
 
                                    <div class="col-md-12">
                                     <div class="form-group" style="margin-bottom:1rem" >
                                            <select class="theme-combo"  style="width: 100%;" id="subcategory">
                                                <option value="<?php echo $subcategory;  ?>"><?php echo $subcategory;  ?></option>
                                            </select>
                                            </div>
                                         <div class="form-group">
                                            <label class="control-label" for="summernote">Facilities and Capacity </label>
                                            <textarea class="form-control" id="facilities" name="editordata" rows="6" placeholder="<?php  echo $facility;   ?>"></textarea>
                                        </div>
                                </div>
<?php } ?>  
                                     <?php  if($cat_id == '6') {   ?> 

 
    

<div class="px-4 pt-0 mb-5">
                            <h3>Tents Offered</h3>
                                <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2">
                                   <?php              
                                    foreach ($myalltents as $t){
                                        
                                       if(in_array($t,$explode_tents)){ 
                                    ?>
                                     <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck<?php echo $t;?>" checked value="<?php echo $t;?>">
                                            <label class="custom-control-label" for="customCheck<?php echo $t;?>"><?php echo $t;?></label>
                                        </div>
                                         </div>
                                     </div>
                                       <?php  }else{ ?>
                                    <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck<?php echo $t;?>"value="<?php echo $t;?>">
                                            <label class="custom-control-label" for="customCheck<?php echo $t;?>"><?php echo $t;?></label>
                                        </div>
                                         </div>
                                     </div>
                                    
                                    <?php } }?>
                                </div>
</div>
                                         <?php } ?>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="price"><?php echo $price; ?> <small>(Quote)</small></label>
                                            <input id="editprice" type="file" placeholder="Price" value="<?php echo $price; ?>" class="form-control">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-12"> 
                                      <div class="form-group">
                                          <label class="control-label" for="editabout">About Listing</label>
                                        <textarea class="form-control" id="editabout" name="editordata" rows="6"  required><?php echo $about;?></textarea>
                                       <div id="aboutcount" class="text-danger small" style="display:none">Your words are less than 50</div>
                                        </div>
                                           
                                       </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="editservices">Services Offered</label>
                                            <textarea class="form-control" id="editservices" name="editordata" rows="6" required><?php echo $services;?></textarea>
                                        </div>
                                    </div>
  
                                </div>
                                
                            </div>

                         <div class="todo-subhead">
                                <h3>Social Media</h3>
                            </div>
                            <div class="px-3 pt-0 row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="facebook">Facebook</label>
                                             <input id="editfacebook" name="facebook" type="url" value="<?php echo $facebook; ?>" placeholder="https://www.facebook.com" class="form-control ">
                                        </div>
                                    </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="instagram">Instagram</label>
                                            <input id="editinstagram" name="instagram" type="url" value="<?php echo $instagram;?>" placeholder="https://www.instagram.com" class="form-control">
                                        </div>
                                    </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="instagram">WhatsApp Number</label>
                                            <?php
                                            $editwhatsapp = substr($whatsapp,3);
                                            //echo $editwhatsapp;
                                            ?>
                                            <input id="editwhatsapp" name="whatsapp" type="tel" value="0<?php echo $editwhatsapp;?>" placeholder="071234.." class="form-control" maxlength="10">&nbsp;<span id="editerrmsg"></span>
                                            <div id="editphonecount" class="text-danger" style="display: none">Invalid phone number</div>
                                        </div>
                                    </div>
                                
                            </div> 
                            <button type="button" id="editlist" class="btn btn-primary btn-rounded m-4">Update Business Profile</button>      
                                   
                        </form>  
                <!--<div class="todo-subhead">
                              <h3>Listing Cover Pic</h3>
                            </div>
                            <div class="px-3 pt-0 ">
                        <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                          <div class="vendor-banner-cover">
                               
                            </div>
                            <div class="vendor-profile-img">
                                <label for="vendor-coverpic">
                                <i class="btn btn-outline-primary fa fa-upload"> Upload cover pic</i>
                               </label>
                                 <input name="vendor-coverpic" id="vendor-coverpic" type="file" style="display: none"/>
                            </div>
                                    
                                    
                                </div>
                                
                            </div>
                            </div>

                            <div class="todo-subhead">
                                <h3>Gallery</h3>
                            </div>
                --->

     <div class="todo-subhead">
      <h3>Gallery</h3>
        </div>
                
        <form class="m-3">
            <span>You can only upload a maximum of 10 images at ago.</span>
            <div class="dropzone" id="edit-gall-dropzone"></div> 
            
           <button type="button" id="addeditgallery" class="btn btn-primary btn-rounded m-4">Add gallery</button>  
        </form>
    

<div class="todo-subhead">
        <h3>Edit Gallery</h3>
            </div>

<div class="guest-list-table table-responsive">
                                                    <div class="single-guest-tab">
                                                        <?php
                                        //echo $gallery;
                                        $explode_gallery = explode(",", $gallery);
                                       // print_r($explode_gallery);
                                      array_pop($explode_gallery); // removes last element of an array which was a blank value
                                     // print_r($explode_gallery);
                                    
                                        
                                        ?>
                                                        
                                                        <table class="table" style="width:100%;" id="gallery-table">
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
                                                                    <td><img src="images/vendor_listings/<?php echo $gal;?>" class="img-thumbnail img-responsive" style="width:20% !important;"></td><input type="hidden"value="<?php echo $gal;?>">
                                                                <td id="<?php echo $gal; ?>" class="editgal"><a href="#" ><i class="fa fa-trash"></i></a></td>
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
<?php } else{include_once 'login.php';}?>