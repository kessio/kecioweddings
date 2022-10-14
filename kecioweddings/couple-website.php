<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$website_id = array(
    
    "id"=>$_SESSION['userid']
 
);

$display_data = $little->shaz_curl(json_encode($website_id), \NsLittle\Little::ROUTE.'/website_info.php');

$data_decoded = json_decode($display_data);
//print_r($data_decoded);
$userid = $website_id['id'];
$bride           = $data_decoded->data->bride_name;
$groom           = $data_decoded->data->groom_name;
$weddingaddress  = $data_decoded->data->wedding_venue;
$weddingdate     = $data_decoded->data->wedding_date;

$display_website_data = $little->shaz_curl(json_encode($website_id), \NsLittle\Little::ROUTE.'/display_create_website.php');
//print_r($display_website_data);
$display_website_decode = json_decode($display_website_data);

$about_groom     = $display_website_decode->data->about_groom;
$about_bride     = $display_website_decode->data->about_bride;
$ceremony_venue  = $display_website_decode->data->church_venue;
$reception_venue = $display_website_decode->data->reception_venue;
$church_time     = $display_website_decode->data->church_time;
$reception_time  = $display_website_decode->data->reception_time;
$town            = $display_website_decode->data->town;
$rsvp_deadline   = $display_website_decode->data->rsvp_deadline;
$guest_message   = $display_website_decode->data->guest_message;
$cover_pic       = $display_website_decode->data->cover_pic;
$ourstory        = $display_website_decode->data->ourstory;
$webgallery      = $display_website_decode->data->webgallery;





?>


<div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <h2>Wedding Website Information</h2>
                    </div>
                    <!-- Page Heading -->
                    <div class="card-shadow">
                        <div class="card-shadow-body">
                          <div class="col-xl-2 text-small">Website URL</div>
                                    <div class="col-xl-12">
                                        <input type="text" value="http://localhost/kecioweddings/wedding-website.php?&userid=<?php echo $userid;?>" id="myInput" style="display:none"><span class="ml-4"><button onclick="myFunction()" class="btn btn-outline-primary">Copy URL</button></span><a href="http://localhost/kecioweddings/wedding-website.php?&userid=<?php echo $userid;?>" class="btn btn-outline-primary ml-2"><i class="fa fa-eye">View Site</i></a>
                                    </div>  
                        </div>
                    </div>
                    
                        <div class="card-shadow">
                            <div class="card-shadow-body">                            
                                <div class="row">
                                    <div class="col-md-6 border-right no-mobile">
                                        <div class="d-flex">
                                           <div class="w-100">
                                                <h3 class="mb-4">Groom Info</h3>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-dark" name="Groom_First_Name" value="<?php echo $groom;?>" placeholder="Groom Name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>About Groom</label>
                                                    <textarea class="form-control" id="about-groom" name="editordata" rows="6" placeholder="About Groom"><?php echo $about_groom;?></textarea>
                                                </div>
                                         </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex">
                                           <div class="w-100">
                                                <h3 class="mb-4">Bride Info</h3>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-dark" name="Bride_First_Name" value="<?php echo $bride;?>" placeholder="Bride Name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>About Bride</label>
                                                    <textarea class="form-control" id="about-bride" name="editordata" rows="6" placeholder="About Bride"><?php echo $about_bride;?></textarea>
                                                </div>
                                           </div>
                                        </div>
                                        
                                    </div>
                                   </div>                                                  
                            </div>                                        
                        </div>
                   
                        <div class="card-shadow">
                            <div class="card-shadow-header p-0 d-flex align-items-center">
                                <span class="budget-head-icon"> <i class="weddingdir_location_heart text-white"></i></span>
                                <span class="head-simple">Wedding Info</span>                                
                            </div>
                            <div class="card-shadow-body p-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Wedding Date</label>
                                            <input type="text" class="form-control datepicker" id="web-weddingg-date" placeholder="Wedding Date" value="<?php echo $weddingdate;?>" name="Wedding_Date" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ceremony Venue</label>
                                            <input type="text" class="form-control" id="church-venue" value="<?php echo $ceremony_venue ;?>" placeholder="Ceremony Venue" name="church venue">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reception Venue</label>
                                            <input type="text" class="form-control" id="reception-venue" value="<?php echo $reception_venue; ?>" placeholder="Reception Venue" name="reception">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ceremony Start time</label>
                                            <input type="time" class="form-control" id="ceremony-time" value="<?php echo $church_time;?>" placeholder="Ceremony Time" name="ceremony">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reception Start time</label>
                                            <input type="time" class="form-control" id="reception-time" value="<?php echo $reception_time;?>" placeholder="Reception Time" name="reception_time">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Wedding Town/City</label>
                                            <input type="text" class="form-control" id="wedding-town" value="<?php echo $town; ?>" placeholder="Reception Venue" name="reception">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Deadline for RSVP</label>
                                            <input type="text" class="form-control datepicker" id="rsvp-deadline" value="<?php echo $rsvp_deadline;?>" placeholder="RSVP deadline" name="rsvp">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="card-shadow">
                            <div class="card-shadow-header p-0">
                                <div class="d-flex align-items-center">
                                    <span class="budget-head-icon"> <i class="weddingdir_wine text-white"></i></span>
                                    <span class="head-simple">Our Story</span>  
                                </div>
                            </div>
                             <div class="card-shadow-body p-3">
                            <div class="col-md-12 mt-3">
                            <div class="form-group">
                               <textarea class="form-control" id="web-ourstory" name="editordata" rows="6" placeholder="Share with your guests your story"><?php echo $ourstory;?></textarea>
                            </div>
                            </div>
                             </div>
                        </div>
                        <div class="card-shadow">
                            <div class="card-shadow-header p-0">
                                <div class="d-flex align-items-center">
                                    <span class="budget-head-icon"> <i class="weddingdir_mail text-white"></i></span>
                                    <span class="head-simple">Message to our Guests</span>  
                                </div>
                            </div>
                            <div class="card-shadow-body">
                            <div class="col-md-12">
                            <div class="form-group">
                               <textarea class="form-control" id="web-message" name="editordata" rows="6" placeholder="Message for guests who visit your website"><?php echo $guest_message;?></textarea>
                            </div>
                            </div>
                             
                            </div>
                        <div class="pl-4">
                        <button class="btn btn-primary btn-rounded mb-4 mt-5" id="save-web-info">Save Website Information</button>
                        </div>
                        </div>
                        <div class="card-shadow">
                            <div class="card-shadow-header p-0 d-flex align-items-center">
                                <span class="budget-head-icon"> <i class="weddingdir_heart_double_face text-white"></i></span>
                                <span class="head-simple">Set Featured Images</span> <small class="text-warning"> (Your Image might not appear like this on the website, Kindly view your website to get the right size.)</small>                               
                            </div>
                            
                        <div class="card-shadow-body p-0">
                          <div class="vendor-banner-cover" style=" border-bottom: transparent; background: url(images/website_gallery/<?php echo $cover_pic;?>) no-repeat center; background-size: cover; min-height: 340px;">
                            </div>
                            <div class="vendor-profile-img">
                                <label for="mywebcoverpic">
                                    <btn class="btn btn-outline-primary"> <i class="fa fa-upload"> Upload cover pic</i></btn>
                               </label>
                                 <input name="mywebcoverpic" id="mywebcoverpic" type="file" style="display: none"/>
                            </div>
                              </div>
                         </div>

                        <div class="card-shadow">
                            <div class="card-shadow-header p-0">
                                <div class="d-flex align-items-center row">
                                    <div class="col-md-5">
                                        <div class="d-flex align-items-center">
                                            <span class="budget-head-icon"> <i class="weddingdir_dove text-white"></i></span>
                                            <span class="head-simple">Our Images</span>  
                                        </div>                                        
                                    </div>
                                       
                                    <div class="col-md-7 pr-4">
                                        
                                        <div class="d-flex align-items-center justify-content-md-end px-3 ml-auto my-3 my-md-0">
                                            <span class="mr-3 text-muted"><small> Upload a minimum of 5 photos and maximum of 10 photos at a time.</small></span>
                                            
                                        </div>
                                    </div>
                                </div>
                                                           
                            </div>
                            <div class="card-shadow-body p-3">
                                <div class="dropzone" id="wed-website-gallery"></div>
                            </div>
                            <div class="px-3 pt-0">
                    <button type="button" id="save-wedding-gallery" class="btn btn-primary btn-rounded mb-4 mt-5">Save Gallery</button>  
                    <button type="button" id="web-gal-loading" class="btn btn-primary btn-rounded mb-4 mt-5" style="display:none"><i class="fa fa-spinner fa fa-spin"></i> Loading</button> 
                </div>
               </div>
                    
                    
                  <div class="card-shadow">
                            <div class="card-shadow-header p-0">
                                <div class="d-flex align-items-center row">
                                    <div class="col-md-5">
                                        <div class="d-flex align-items-center">
                                            <span class="budget-head-icon"> <i class="weddingdir_dove text-white"></i></span>
                                            <span class="head-simple">Our Images</span>  
                                        </div>                                        
                                    </div>
                                       
                                    <div class="col-md-7 pr-4">
                                        
                                        <div class="d-flex align-items-center justify-content-md-end px-3 ml-auto my-3 my-md-0">
                                            <span class="mr-3 text-muted"></span>
                                            
                                        </div>
                                    </div>
                                </div>
                                                           
                            </div>
                <div class="guest-list-table table-responsive">
                                        <div class="single-guest-tab">
                                            <?php
                            //echo $gallery;
                            $explode_gallery = explode(",", $webgallery);
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
                      <td><img src="images/website_gallery/<?php echo $gal;?>" class="img-thumbnail img-responsive" style="width:20% !important;"></td><input type="hidden"value="<?php echo $gal;?>">
                  <td id="<?php echo $gal; ?>" class="editwebgal"><a href="#" ><i class="fa fa-trash"></i></a></td>
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
<?php }else{ include_once 'login.php';}?>