 <?php
 
// if users are not logged in redirect to login page
if($_SESSION['user_session_exists'] === "TRUE"){

$get_category      = array();
$categories        = $little->shaz_curl(json_encode($get_category), \NsLittle\Little::ROUTE.'/get_category.php');
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
// selec counties =============================================================================================
$get_counties     = array();
$select_counties  =$little->shaz_curl(json_encode($get_counties), \NsLittle\Little::ROUTE.'/selectCounties.php');
$counties_decode  = json_decode($select_counties);
$counties = $counties_decode->data;
$mycounty       = count($counties);
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
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h2>Add New Listing</h2>
                            
                        </div>                           
                    </div>
                    <!-- Page Heading -->

                    <div class="card-shadow">
                        <div class="card-shadow-header">
                            <strong><small>Add your business listing under category, title, descriptions, gallery, etc..</small></strong>                                       
                        </div>

                        <form id="addlisting">
                            <div class="todo-subhead">
                                <h3>Listing Info</h3>
                            </div>
                            <div class="d-flex align-items-right ml-4 mb-5">
                                <small>Do you want to show this listing as a featured listing ?</small>
                                <div class="custom-control custom-switch ml-3">
                                    <input type="checkbox" name="featured" class="custom-control-input" id="customSwitch1" value="featured">
                                    <label class="custom-control-label p-0" for="customSwitch1">&nbsp;</label>
                                  </div>
                            </div>
                            
                            <input id="vendorid" name="title" type="hidden" class="form-control" value="<?php echo $_SESSION['userid']; ?>">
                            <div class="px-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="title" class="form-control form-dark" placeholder="Listing Name">
                                            <div id="listingname" class="text-danger small"style="display:none">Listing Name Required!</div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group shaz-category">
                                            <select id="mycategory_id" class="theme-combo"  style="width: 100%;">
                                                <option value="">Choose Category</option>
                                               <?php 
                                                  for($c = 0; $c < count($cat); $c++){
                                                    $cat_ids = $cat[$c]->cat_id; 
                                                     $cat_name = $cat[$c]->name; 
  
                                                  ?>
                                                
                                                 <option value="<?php echo $cat_ids;?>"><?php echo $cat_name;?></option>                                                
                                                     <?php } ?>
                                              
                                            </select>
                                            <div id="categoryfield" class="text-danger small" style="display:none">Category Required!</div>
                                        </div>
                                    </div>
                                       <div class="form-group col-md-12" id="category-controls-div"></div>
                                       
                                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                      <div class="form-group">
                                          
                                          <select class="wide" style="width: 100%;" id="region">
                                                <option value="">Choose County</option>
                                                <?php
                                        for($co = 0; $co < count($counties); $co++){
                                                      
                                        ?>
                                   <option value="<?php echo $counties[$co]->county_id;?>"><?php echo $counties[$co]->county_name ;?></option>
                                   
                                        <?php  } ?>
                                           </select>
                                         
                                          <div id="countyfield" class="text-danger small" style="display:none">County Required!</div>
                                        </div>
                                    </div>
                                        <div class="col-md-6" id="county-controls-div">
                                        
                                    </div>
                                        <div class="col-md-12"> 
                                      <div class="form-group">
                                        <textarea class="form-control" id="about" name="editordata" rows="6" placeholder="About Listing (Minimum of 50 words)" required></textarea>
                                        <div id="aboutfield" class="text-danger small" style="display:none">About Vendor Required!</div>
                                        <div id="aboutcount" class="text-danger small" style="display:none">Your words are less than 250</div>
                                        </div>
                                           
                                       </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="services" name="editordata" rows="6" placeholder="Services Offered(Optional)" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="todo-subhead">
                                <h3>Amenities (Optional)</h3>
                            </div>
                            <div class="px-4 pt-0">

                                <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2">

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Table_chairs" value="Table and chairs">
                                                <label class="custom-control-label" for="Table_chairs">Tables and chairs</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Ready_Rooms" value="Get Ready Rooms">
                                                <label class="custom-control-label" for="Ready_Rooms">Get Ready Rooms</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Event_Rentals" value="Event Rentals">
                                                <label class="custom-control-label" for="Event_Rentals">Event Rentals</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Bar_Services" value="Bar Services">
                                                <label class="custom-control-label" for="Bar_Services">Bar Services</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Catering_Services" value="Catering Services">
                                                <label class="custom-control-label" for="Catering_Services">Catering Services</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Clean_Up" value="Clean Up">
                                                <label class="custom-control-label" for="Clean_Up">Clean Up</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Wifi" value="Wi-fi">
                                                <label class="custom-control-label" for="Wifi">Wifi</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Pet_Friendly" value="Pet Friendly">
                                                <label class="custom-control-label" for="Pet_Friendly">Pet Friendly</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Accommodations" value="Accommodations">
                                                <label class="custom-control-label" for="Accommodations">Accommodation</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox form-light">
                                                <input type="checkbox" name="amenity" class="custom-control-input" id="Other_ameneties">
                                                <label class="custom-control-label" for="Other_ameneties">Other</label>
                                            </div>
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
                                            <input id="facebook" name="facebook" type="url" placeholder="https://www.facebook.com" class="form-control ">
                                        </div>
                                    </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="instagram">Instagram</label>
                                            <input id="instagram" name="instagram" type="url" placeholder="https://www.instagram.com" class="form-control">
                                        </div>
                                    </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label class="control-label" for="whatsapp">Whatsapp Number</label>
                                            <input id="whatsapp" name="whatsapp" type="phone" placeholder="e.g 0712345678" class="form-control" maxlength="10" required>&nbsp;<span id="errmsg"></span>
                                            <div id="myphonecount" class="text-danger" style="display: none">Invalid phone number</div>
                                        </div>
                                    </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                 <span class="text-small">Attach Pricing Quote</span>
                                        
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                      <input class="pdt20 mb-4" type="file" id="price" name="price" accept=".pdf"/> 
                               
                               </div>
                            </div>
                            <div class="todo-subhead">
                                <h3>Cover Picture</h3>
                            </div>
                            <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                            <div class="vendor-banner-cover">
                                <i class="fa fa-picture-o"></i>
                                Upload Cover Image for your listing
                                <span>Best Size 1000 x 400</span>
                            </div>
                            <div class="vendor-profile-img">
                               <div class="vendor-btn">
                                    
                                    <input type="file" id="cover_picture" name="cover_picture" accept="image/*">
                                    <span id="coverpicerror" class="text-danger" style="display:none">Cover Picture needed!</span>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                            <div class="todo-subhead">
                                <h3>Upload Listing Gallery</h3><small>Upload a minimum of 5 images and a maximum of 10 images. More images can be added when editing a listing.</small>
                            </div>
                            <div class="px-3 pt-0">
                            <div class="col-md-12">
                               <div id="add-listing-dropzone" class="dropzone"></div> 
                            </div>
                            </div>

                            
                            <div class="px-3 pt-0">
                                <button type="button" id="savemylisting" class="btn btn-primary btn-rounded mb-4 mt-5">Save my Listing</button>        
                            </div>
                                    
                        </form>
                        
                       
                    </div>
               

    <script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#image-preview").attr("src", reader.result);
            },
 
            reader.readAsDataURL(file);
        }
    }
</script>
                    
                    
                </div>
            </div>
            
        </div>  
<?php } else{include_once 'login.php';}?>
  
    