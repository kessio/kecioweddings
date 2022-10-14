<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$user_id = array(
    
    "user_id"=>$_SESSION['userid']
 
);

$usersprofile   = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/displayusersprofile.php');
//print_r($usersprofile);
$user_decode    = json_decode($usersprofile);
$usersinfo      = $user_decode->data;
$businessname   = $usersinfo->business_name;
$vemail         = $usersinfo->email;
$phonenumber    = $usersinfo->phone_number;
     

$display_profile = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_vendor_profile.php');
$data_decoded    = json_decode($display_profile);
$vendor_profile = $data_decoded->data;
$name           = $data_decoded->data->name;
$instagram      = $data_decoded->data->instagram;
$facebook       = $data_decoded->data->facebook;
$twitter        = $data_decoded->data->twitter;
$youtube        = $data_decoded->data->youtube;
$phone_number   = $data_decoded->data->phone_number;
$address        = $data_decoded->data->address;
$website        = $data_decoded->data->website;
$profile_image  = $data_decoded->data->profile_image;


$getpass = $little->shaz_curl(json_encode($user_id), NsLittle\Little::ROUTE.'/getPassword.php');
// print_r($getpass);
$decodepass = json_decode($getpass);
//  print_r($decodepass);
$oldpass = $decodepass->data->password;




include_once 'modals/modals-cropper-vprofile.php';
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
                                    aria-controls="v-pills-general" aria-selected="true">Profile</a>
                               <a class="nav-link text-info" data-toggle="modal" data-target="#passwordchange">Password Change</a>
                                
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="card-shadow">
                                        <div class="card-shadow-header">
                                            <div class="head-simple">
                                                Profile
                                            </div>                                            
                                        </div>
                                        <div class="card-shadow-body">
                                       
                                            <form>
                                                <div class="row">
                                                  
                                                  <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="custom-file-wrap">
                                                                <div class="custom-file-holder" id="vendor-cropper-uploaded-image">
                                                                    <?php if(!empty($profile_image)){?>
                                                                    <img src="images/profile_pic/<?php echo $profile_image ;?>"  class="rounded-circle" />
                                                                   <?php } else {?> <i class="fa fa-picture-o"></i>   <?php } ?>
                                                                     <div class="custom-file">
                                                                        <input type="file" name="image" class="image" id="vendor-cropper-upload-image" style="display:none" accept="image/*" />
                                                                        <label class="custom-file-label" for="vendor-cropper-upload-image"><i class="fa fa-pencil"></i></label>
                                                                    </div>
                                                                </div>
                                                                <div class="custom-file-text">
                                                                    <div class="head">Upload Profile Image</div>
                                                                    <div> Allowed files types are <strong>png/jpg</strong>.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                 </div>
                                            </form>                                            
                                              <form>
                                                <div class="row">
                                                   <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="businessname" name="Business_name" value="<?php echo $businessname;?>">
                                                        </div>
                                                    </div>
                                                   <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" id="vendorchangeemail" class="form-control form-dark" value="<?php echo $vemail;?>" name="Name">
                                                            <span id="edinvalidemail" style="display:none" class="text-danger small">Invalid email</span>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="text" id="vendorchangephone" class="form-control form-dark" name="Contact_Number" value="<?php echo $phonenumber;?>" placeholder="Contact Number">&nbsp;<span id="errmsg"></span>
                                                            <span id="editphonecount" style="display:none" class="text-danger small">Invalid Phone</span>
                                                        </div>
                                                    </div>
                                                   </div>
                                                  <div class="px-3 pt-0">
                                                <button type="button" id="save-email-phone" class="btn btn-primary btn-rounded mb-4">Save Changes</button>        
                                               </div>
                                                <div class="card-shadow-header">
                                                                                      
                                              </div>
                                                
                                          <div class="todo-subhead">
                                                <h3>Business Profile</h3>
                                            </div>

                                            <div class="px-3 pt-0">

                                                <div class="row">

                                                    

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label class="control-label" for="Website Link">Website Link</label>
                                                            <input type="link" id="business-website" class="form-control"  name="Busines_Website" value="<?php echo $website;?>" placeholder="https://www.websitename.com">
                                                        </div>
                                                    </div>

                                                    

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="Business Address">Business Address</label>
                                                            <input type="text" id="business-address" class="form-control form-dark" name="Address" value="<?php echo $address;?>" placeholder=" Business Address e.g street, town, building, etc">
                                                        </div>
                                                    </div>  
                                                    
                                                    
                                                 <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="facebook">Facebook</label>
                                                    <input id="vendor-facebook" name="facebook" type="url"  placeholder="https://www.facebook.com/username" value="<?php echo $facebook;?>" class="form-control ">
                                                </div>
                                                 </div>
                                                    <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="instagram">Instagram</label>
                                                     <input id="vendor-instagram" name="instagram" type="url"  placeholder="https://www.instagram.com/username" value="<?php echo $instagram;?>" class="form-control ">
                                                </div>
                                                 </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="facebook">Twitter</label>
                                                     <input id="vendor-twitter" name="facebook" type="url"  placeholder="https://www.twitter.com/username" value="<?php echo $twitter;?>" class="form-control ">
                                                </div>
                                                 </div>
                                                    <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="facebook">Youtube</label>
                                                     <input id="vendor-youtube" name="facebook" type="url"  placeholder="https://www.youtube.com/username" value="<?php echo $youtube;?>" class="form-control ">
                                                </div>
                                                 </div>
         
                                                </div>
                                            </div>
 
                                            <div class="px-3 pt-0">
                                             <button type="button" id="save-business-profile" class="btn btn-primary btn-rounded mb-4">Update Business Profile</button>        
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

    
  