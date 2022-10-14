<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$display_listing = array("vendor_id"=>$_SESSION['userid']);
//print_r($display_listing);

$data = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/display_listing.php');

//print_r($data);

$decode_data = json_decode($data);
//print_r($decode_data);
$listing = $decode_data->data;


$listing_count = count($listing);
?>

    <!-- =============================
       *
       *   Page Content Start
       *
      =============================== -->
<style>
    .search-result-header { border-bottom: transparent; background: url("images/vendor_listings/28147850.jpg") no-repeat center; background-size: cover; min-height: 350px; }
</style>
    <!--  Search Result Header Start -->
    <section class="search-result-header mt-lg-5">
        <div class="container">
            <div class="row">
               <h1><?php echo $_SESSION['business_name'];?></h1>
            </div>
                       
        </div>
    </section>
   
        <section class="wide-tb-50">
            <div class="container">
                <div class="row"> 
                                   
                    <div class="col-lg-12 bg-white">
                        <div class="result-count">
                            <strong>244 results:</strong>
                            <ul class="nav nav-pills theme-tabbing list-style-map" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link show active" id="pills-listing-tab" data-toggle="pill" href="#pills-listing" role="tab" aria-controls="pills-listing" aria-selected="false"><i class="fa fa-list-ul"></i> List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-images-tab" data-toggle="pill" href="#pills-images" role="tab" aria-controls="pills-images" aria-selected="true"><i class="fa fa-th-large"></i> Images</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false"><i class="fa fa-map-marker"></i> Map</a>
                                </li>
                            </ul>
                            <!-- <span class="list-style-map">
                                <a href="javascript:" class="active"></a>
                                <a href="javascript:"></a>
                                <a href="javascript:"></a>
                            </span> -->
                        </div>

                        <div class="tab-content theme-tabbing search-result-tabbing" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
                                <?php

                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $about = $listing[$l]->about;
                                           
                                     ?>
                                <div class="result-list">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img">
                                                <span class="featured">
                                                    <i class="fa fa-star"></i>
                                                    <span>Featured</span>
                                                </span>
                                                <a href="javascript:"><img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>"></a>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-9">
                                            <div class="content">
                                                <div class="head">
                                                   <h3><a href="javascript:">Lotus Wedding Florist</a></h3>
                                                    <div class="rating">
                                                        <span class="stars">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <i class="fa fa-star-o"></i>                                    
                                                        </span>
                                                        (22 review)  /  Surat, Gujrat, India
                                                    </div>
                                                </div>
                                                <p><?php echo implode(' ', array_slice(explode(' ', $listing[$l]->about), 0, 40))."..." ?></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                     <?php } ?>
                                <!-- Search Result Pagination -->
                                <div class="theme-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Post Pagination -->
                            </div>
                            <div class="tab-pane fade" id="pills-images" role="tabpanel" aria-labelledby="pills-images-tab">
                                <div class="row">
                                     <?php

                                     for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                           
                                     ?>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="wedding-listing">
                                            <div class="img">
                                                <a href="javascript:"><img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>"></a>
                                                <div class="img-content">
                                                    <div class="top">
                                                        <span class="price">
                                                            <i class="fa fa-tag"></i>
                                                            <span>$500-$800</span>
                                                        </span>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="tags" href="javascript">
                                                            Fashion
                                                        </a>
                                                        <a class="favorite" href="javascript">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="gap">
                                                    <h3><a href="javascript:">Happy Wedding Fashions <span class="verified"><i class="fa fa-check-circle"></i></span></a></h3>
                                                    <div><i class="fa fa-map-marker"></i> Surat, Gujrat, India</div>
                                                </div>
                                                <div class="reviews">
                                                    <span class="stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                        <i class="fa fa-star-o"></i>                                    
                                                    </span>
                                                    (6 review)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                     <?php } ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
                                <div id="map-holder">
                                    <div id="map_extended" class="vendor-single-popup-wrap">
                                        <p>This will be replaced with the Google Map.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </section>
<?php } else {include_once 'login.php';}?>

    
   