<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$vendor_id = array("vendor_id" =>$_SESSION['userid']);


$data = $little->shaz_curl(json_encode($vendor_id), \NsLittle\Little::ROUTE.'/display_listing.php');

//print_r($data);
//print_r($vendor_id);

$decode_data = json_decode($data);
//print_r($decode_data);
$listing = $decode_data->data;
//print_r($listing);
$listing_count = count($listing);


?>
<style>
    .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}
</style>
        <div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <h2>Reviews</h2>
                    </div>
                    <!-- Page Heading -->

                    <!-- Reviews Section -->
                   <input type="hidden" value="<?php echo $_SESSION['business_name'];?>" id="vendorname">

                    <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                            <div class="d-flex justify-content-between row border-bottom p-4">
                                <div class="col-md-4">
                                    <div class="search-review-list">
                                        Reviews
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                <select class="theme-combo selectreview" name="state" id="exampleFormControlSelect2">
                                    <option>Select Listing</option>
                                 <?php
                                       for($v = 0; $v < $listing_count; $v++){
                                   ?>
                               
                                <option class="kecio-list" value="<?php echo $listing[$v]->listing_id; ?>"><?php  echo $listing[$v]->listing_name; ?></option>
                                       <?php      }  ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div id="reviews-div"></div>
                    </div>
                    <!-- Reviews Section -->  
                </div>
            </div>
            
        </div>        
<?php } else {include_once 'login.php';}?>       
    