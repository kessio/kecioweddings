<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$website_id = array(
    
    "id"=>$_SESSION['userid']
 
);
//print_r($website_id);
$display_data = $little->shaz_curl(json_encode($website_id), \NsLittle\Little::ROUTE.'/website_info.php');

$data_decoded = json_decode($display_data);
//print_r($data_decoded);
$email           = $data_decoded->data->email;
$phone_number    = $data_decoded->data->phone_number;
$bride           = $data_decoded->data->bride_name;
$groom           = $data_decoded->data->groom_name;
$weddingaddress  = $data_decoded->data->wedding_venue;
$weddingdate     = $data_decoded->data->wedding_date;
$newdate         = strtotime($weddingdate);
$wedding_date    = date("F d, Y",$newdate);
//echo $wedding_date;


$display_info = array(
    
    "user_id"=>$_SESSION['userid']
 
);

$display_profile = $little->shaz_curl(json_encode($display_info), \NsLittle\Little::ROUTE.'/display_profile.php');
//print_r($display_profile);
$profile_decode = json_decode($display_profile);
$profile_data   = $profile_decode->data;

$my_image       = $profile_data->cimage;
$bride_pic      = $profile_data->bride_pic;
$groom_pic      = $profile_data->groom_pic;
$facebook       = $profile_data->facebook;
$instagram      = $profile_data->instagram;
$bio_image      = $profile_data->bio_img;



include_once 'modals/modals-couple-profile-pic.php';
include_once 'modals/modals-bride-pic.php';
include_once 'modals/modals-groom-pic.php';
include_once 'modals/modals-password-change.php';
?>

    <!-- =============================
       *
       *   Page Content Start
       *
    =============================== -->
    <style>
        .cropper-crop-box, .cropper-view-box {
    border-radius: 50%;
}

.cropper-view-box {
    box-shadow: 0 0 0 1px #39f;
    outline: 0;
}
img {
		  	display: block;
		  	max-width: 100%;
		}

		
    </style>
    
          <div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <h2>My Profile</h2>
                    </div>
                    <!-- Page Heading -->
                    
                    <div class="row">
                        <!-- Profile Tabbing Start -->
                        <div class="col-12 col-lg-3">
                            <div class="nav flex-column nav-pills theme-tabbing-vertical" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-general" role="tab"
                                    aria-controls="v-pills-general" aria-selected="true">Couple Profile</a>
                                <a class="nav-link" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab"
                                    aria-controls="v-pills-vendor" aria-selected="false">Wedding Information</a>
                                <a class="nav-link" id="v-pills-pricing-tab" data-toggle="pill" href="#v-pills-pricing" role="tab"
                                    aria-controls="v-pills-pricing" aria-selected="false">Social Media</a>
                                <a class="nav-link" data-toggle="modal" data-target="#passwordchange">Password Change</a>
                                
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="card-shadow">
                                        <div class="card-shadow-header">
                                            <div class="head-simple">
                                                Couple Profile
                                            </div>                                            
                                        </div>

                                        <div class="card-shadow-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="custom-file-wrap">
                                                                <div class="custom-file-holder" >
                                                                 <?php if (!empty($my_image)){?>
                                                                    <img src="images/profile_pic/<?php echo $my_image ;?>" id="couple-cropper-uploaded-image"  class="rounded-circle" />
                                                                   <?php } else {?><i class="fa fa-picture-o"></i> <?php } ?>  
                                                                     <div class="custom-file">
                                                                        <input type="file" name="image" class="image" id="couple-cropper-upload-image" style="display:none" accept="image/*" />
                                                                        <label class="custom-file-label" for="couple-cropper-upload-image"><i class="fa fa-pencil"></i></label>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-file-text">
                                                                    <div class="head">Upload Profile Image</div>
                                                                    <div>Allowed files types are <strong>png/jpg/jpeg/gif</strong>.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-dark" name="Name" value="<?php echo $_SESSION['name'];?>" placeholder="Name">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-dark" name="Name" value="<?php echo $email;?>" placeholder="email" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-dark" name="Contact_Number" value="<?php echo $phone_number;?>" placeholder="Contact Number" disabled>
                                                        </div>
                                                    </div>
                                                             
                                                </div>
                                            </form>                                            
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
                                    <div class="card-shadow">
                                        <div class="card-shadow-header">
                                            <div class="head-simple">
                                                Wedding Information
                                            </div>                                            
                                        </div>

                                        <div class="card-shadow-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="custom-file-wrap w-100">
                                                                <div class="custom-file-holder">
                                                                 <?php if (!empty($groom_pic)){?>
                                                                    <img src="images/bride_groom/<?php echo $groom_pic ;?>" id="groom-cropper-image"  class="rounded-circle" />
                                                                   <?php } else {?><i class="fa fa-picture-o"></i> <?php } ?>  
                                                                     <div class="custom-file">
                                                                        <input type="file" name="image" class="image" id="groom-cropper-upload-image" style="display:none" accept="image/*" />
                                                                        <label class="custom-file-label" for="groom-cropper-upload-image"><i class="fa fa-pencil"></i></label>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-file-text">
                                                                    <div class="head">Upload Groom Image</div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="custom-file-wrap w-100">
                                                                <div class="custom-file-holder" >
                                                                 <?php if (!empty($bride_pic)){?>
                                                                    <img src="images/bride_groom/<?php echo $bride_pic ;?>" id="bride-cropper-uploaded-image"  class="rounded-circle" />
                                                                   <?php } else {?><i class="fa fa-picture-o"></i> <?php } ?>  
                                                                     <div class="custom-file">
                                                                        <input type="file" name="image" class="image" id="bride-cropper-upload-image" style="display:none" accept="image/*" />
                                                                        <label class="custom-file-label" for="bride-cropper-upload-image"><i class="fa fa-pencil"></i></label>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-file-text">
                                                                    <div class="head">Upload Bride Image</div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" id="profemail" class="form-control form-dark" name="Name" value="<?php echo $email;?>" placeholder="email">
                                                           <span class="text-danger small" id="edivprofemail" style="display:none">Invalid email</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input type="text" id="profphone_no" class="form-control form-dark" name="Contact_Number" value="<?php echo $phone_number;?>" placeholder="Contact Number">&nbsp;<span id="errmsg"></span>
                                                            <span class="text-danger small" id="editprofphone_no" style="display:none">Invalid phone number</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Wedding Date</label>
                                                            <input type="text" class="form-control datepicker" id="couple-weddingdate"  value="<?php echo $wedding_date;?>" placeholder="Select Wedding Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label>Bride Name</label>
                                                            <input type="text" class="form-control" id="couple-bride-name"  value="<?php echo $bride;?>" placeholder="Bride Full Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                             <label>Groom Name</label>
                                                            <input type="text" class="form-control" id="couple-groom" value="<?php echo $groom;?>" placeholder="Groom Full Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                             <label>Wedding Venue</label>
                                                            <input type="text" class="form-control" id="couple-weddingvenue" value="<?php echo $weddingaddress;?>" placeholder="Wedding Venue">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" id="couple-wedding-info" class="btn btn-primary btn-rounded">Update Wedding Information</button>
                                                    </div> 
                                                                                                              
                                                </div>
                                            </form>                                            
                                        </div>                                        
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing-tab">
                                    <div class="card-shadow">
                                        <div class="card-shadow-header">
                                            <div class="head-simple">
                                                Social Media
                                            </div>                                            
                                        </div>
                                        <div class="card-shadow-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Facebook</label>
                                                            <input type="text" class="form-control form-dark" name="Facebook" id="couple-facebook" value="<?php echo $facebook;?>" placeholder="https://www.facebook.com/username">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Instagram</label>
                                                            <input type="text" class="form-control form-dark" name="Instagram" id="couple-instagram" value="<?php echo $instagram;?>" placeholder="https://www.instagram.com/username">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-12">
                                                        <button type="button" id="couple_socialmedia" class="btn btn-primary btn-rounded">Update Social Profile</button>
                                                    </div>
                                                            
                                                </div>
                                            </form>                                            
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile Tabbing End -->
                    </div>

                    
                </div>
            </div>
            
        </div>        

<?php } else{    include_once 'login.php';}?>
    
    <!-- Back to Top
    ================================================== -->
   