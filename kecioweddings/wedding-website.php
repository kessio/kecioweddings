<?php
session_start();
error_reporting(0);

include 'classes/security.class.php';
include 'classes/little.class.php';


$security = new \NsSecurity\Security();
$little   = new \NsLittle\Little();


$request    = $_SERVER['REQUEST_URI'];
$params     = explode("/", $request);


$user_id = array(
    "id"  => $security->sane_inputs("userid","GET")
);

$referid = $user_id['id'];


$display_data = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/website_info.php');

$data_decoded = json_decode($display_data);
//print_r($data_decoded);
$userid = $website_id['id'];
$bride           = $data_decoded->data->bride_name;
$groom           = $data_decoded->data->groom_name;
$weddingaddress  = $data_decoded->data->wedding_venue;
$weddingdate     = $data_decoded->data->wedding_date;
$bride_explode = explode(" ", $bride);
$groom_explode = explode(" ", $groom);
$newdate = strtotime($weddingdate);
$wedding_date = date("l - F d Y",$newdate);
$count_down = $wedding_date = date("F d, Y",$newdate);



$display_website_data = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_create_website.php');
//print_r($display_website_data);
$display_website_decode = json_decode($display_website_data);

$about_groom     = $display_website_decode->data->about_groom;
$about_bride     = $display_website_decode->data->about_bride;
$ceremony_venue = $display_website_decode->data->church_venue;
$reception_venue = $display_website_decode->data->reception_venue;
$church_time     = $display_website_decode->data->church_time;
$reception_time  = $display_website_decode->data->reception_time;
$town            = $display_website_decode->data->town;
$rsvp_deadline   = $display_website_decode->data->rsvp_deadline;
$guest_message   = $display_website_decode->data->guest_message;
$cover_pic       = $display_website_decode->data->cover_pic;
$ourstory        = $display_website_decode->data->ourstory;
$webgallery      = $display_website_decode->data->webgallery;
$rsvpdate       = strtotime($rsvp_deadline);

$church_time_explode = explode(":", $church_time);
$church_hours = $church_time_explode[0];
$church_minutes = $church_time_explode[1];
if($church_hours >= 12){
    $cmeridian = "PM";
}else{
    $cmeridian = "AM";
}

$reception_time_explode = explode(":", $reception_time);
$reception_hours = $reception_time_explode[0];
$reception_minutes = $reception_time_explode[1];
if($reception_hours >= 12){
    $meridian = "PM";
}else{
    $meridian = "AM";
}

        



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







?>


<!DOCTYPE html>
<!--

**********************************************************************************************************
Copyright (c) 2020
**********************************************************************************************************  

Template Name: WeddingDir - HTML Template
Version: 1.0.0
Author: wp-organic

-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]>
-->
<html lang="en">
<!-- <![endif]-->
<!-- head -->

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Basic Page Needs
        ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Specific Meta
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="KecioWeddings - Wedding Directory">
    <meta name="keywords"
        content="bride, business, couple, directory, groom, listing, login, map, marketing, realwedding, registration, rsvp, vendor, wedding, wedding planner, weddings kenya, venue">
    <meta name="author" content="kecioweddings">
    <meta name="MobileOptimized" content="320" />

    <!-- Titles
        ================================================== -->
    <title>KecioWedding - Wedding Directory</title>
     <base href="http://localhost/kecioweddings/"> 

    <!-- Favicons
        ================================================== -->
        <link rel="apple-touch-icon" href="assets/images/favicon/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="images/native/favicons/favicon-32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="images/native/favicons/favicon-16.png" sizes="16x16" type="image/png">
        <link rel="icon" href="images/native/favicons/favicon.ico">

    <!-- CSS ( Bootstrap + Owlcarouses + Fontawesome + Animate + Select2 + Custom Style )
        ======================================================================================= -->
    <link href="assets/library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/library/fontawesome/font-awesome.min.css" rel="stylesheet">
    <link href="assets/library/select2/css/select2.min.css" rel="stylesheet">
    <link href="assets/library/owlcarousel/css/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/library/magnific-popup/magnific-popup.css" rel="stylesheet">

    <link href="assets/library/couple-website/css/style.css" rel="stylesheet">

   
</head>
<!-- end head -->
<!--body start-->
<style>
     .home-background{
    background: url(images/website_gallery/<?php echo $cover_pic;?>) no-repeat top center;
    min-height: 768px;
    background-size: cover;
    position: relative;
}

</style>
<body id="page-top">

    <!-- preloader -->
    <div class="preloader">
        <div class="status">
            <img src="images/native/logo/weblogo.png" alt="">
        </div>
    </div>
    <!-- end preloader -->

    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-md fixed-top header-anim" id="mainNav">
            <div class="logo-wrap">
                <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="images/native/logo/weblogo-light.png"></a>
                <!-- Toggle Button Start -->
               <!--- <button class="navbar-toggler x collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
                <!-- Toggle Button End -->
           <!-- </div> 
            <div class="container">                
                
                <div class="collapse navbar-collapse justify-content-md-center" id="navbarResponsive">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#page-top">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#couple">Couple</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#our-story">Our Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#when-where">Wedding Venue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#latest-news">RSVP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </nav>
    </header>

    <!--  Home Banner Start -->
    <section class="home-background">
        <div class="home-content">
            <div class="container">
                <div class="name">
                    <h1><?php echo $groom_explode[0];?> <i class="weddingdir_heart_ring"></i> <?php echo $bride_explode[0];?></h1>
                    <em>Are getting Married!</em>
                    <div class="date">
                        <h3><?php echo $wedding_date;?></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Home Banner End -->
    <input type="hidden" id="userid" value="<?php echo $referid; ?>">
    <input type="hidden" id="bio-wedding-date" value="<?php echo $count_down;?>">
    <div id="body-content">

        <section class="will-you-attend wide-tb-120" id="latest-news">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="head">
                            <h1>Will You Attend?</h1>
                            <p><span>Kindly respond before <?php if(empty($rsvpdate)){}else{ echo date("F d, Y",$rsvpdate); }?></span></p>
                            <i class="weddingdir_cake_stand"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rsvp-form" id="fillrsvp">
                            <div class="head">
                                <h5>R.S.V.P.</h5>
                                <img src="assets/library/couple-website/images/flower_art.png" alt="">
                                <p>Enter your phone number to RSVP</p>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Enter Phone Number" id="contact" class="form-control">
                            </div>
                            
                            <button type="button" id="search_no" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <div class="rsvp-form" id="myrsvp" style="display:none">
                            <div class="head">
                            </div>
                            <input type="hidden" id="guest-id" value="">
                           <input type="hidden" id="rsvpstate" value="">
                           <h3 id="guest-name"></h3>
                           <p>The best gift you can give us is by attending our wedding.</p>
                            
                            <div class="form-group">
                                <p><strong class="txt-orange">Will You Attend?</strong></p>
                            </div>
                           <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline mb-3">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Yes, I'll be there</label>
                                </div>
                           </div>
                           <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline mb-3">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Sorry, I can't make it</label>
                                </div>
                           </div>
                            <button type="button" id="send-rsvp" class="btn btn-primary btn-block">Send your RSVP</button>
                        </div>
                      </div>
                    
                </div>
                
            </div>
        </section>
        
        
        <!--  The Couple Start -->
        <section id="couple" class="wide-tb-120 bg-light">
            <div class="container">
                <div class="section-title text-center">
                    <h1>The Couple</h1>
                    <p class="sub-head"><?php echo $guest_message;?></p>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="text-center">
                            <img src="images/profile_pic/<?php echo $my_image;?>" class="rounded-circle" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 order-lg-13">
                        <div class="couple-info">
                            <span>Groom</span>
                            <h3><?php echo $groom_explode[0];?></h3>
                            <p><?php echo $about_groom;?></p>
                            
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 order-lg-2">
                        <div class="couple-info">
                            <span>Bride</span>
                            <h3><?php echo $bride_explode[0];?></h3>
                            <p><?php echo $about_bride;?></p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  The Couple End -->

        <!--  Our Story Start -->
        <section id="our-story" class="wide-tb-120 pb-0">
            <div class="container broken-layout">
                <div class="section-title text-center">
                    <h1>Our Story</h1>
                    <p class="sub-head"><?php echo $ourstory;?></p>
                </div>
                
                
            </div>

            <div class="bg-countdown bg-dark">
                <div class="container">
                    <ul id="wedding-countdown" class="list-unstyled list-inline">
                        <li class="list-inline-item" id="mydays"><span class="days">00</span><div class="days_text">Days</div></li>
                        <li class="list-inline-item" id="myhours"><span class="hours">00</span><div class="hours_text">Hours</div></li>
                        <li class="list-inline-item" id="myminutes"><span class="minutes">00</span><div class="minutes_text">Minutes</div></li>
                        <li class="list-inline-item" id="myseconds"><span class="seconds">00</span><div class="seconds_text">Seconds</div></li>
                    </ul>
                </div>
            </div>
        </section>
        <!--  Our Story End -->

        <!--  Wedding Place Start -->
        <section id="when-where" class="wide-tb-120">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Wedding Venue and Day</h1>
                    <p class="sub-head"><?php echo $guest_message;?></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="when-where-box">
                            <div class="place-icon">
                                <i class="weddingdir_hanging_heart"></i>
                            </div>
                            <h3>Wedding Ceremony</h3>
                            <p></p>
                            <div class="img">
                                <div class="place-info">
                                    <?php echo  date("l, d F,  Y",$newdate)?> — <?php echo $church_hours.":".$church_minutes." " . $cmeridian  ;?> — <?php echo $ceremony_venue;?>, <?php echo $town?>
                                </div>
                                <img src="assets/library/couple-website/images/place_1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="when-where-box">
                            <div class="place-icon">
                                <i class="weddingdir_wine"></i>
                            </div>
                            <h3>Wedding Reception</h3>
                            <p></p>
                            <div class="img">
                                <div class="place-info bg-primary">
                                    <?php echo  date("l, d F,  Y",$newdate)?> — <?php echo $reception_hours.":".$reception_minutes." ".$meridian; ?> — <?php echo $reception_venue;?>, <?php echo $town;?>
                                </div>
                                <img src="assets/library/couple-website/images/place_1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  Wedding Place End -->
          <!--  RSVP start-->
       <section class="" >
            
            
        </section>
        
       
        
        <!--  RSVP ends  -->
        <!--  Captured Moments Start -->
        <section class="wide-tb-120 captured-moments" id="gallery">
            <div class="container">
                <div class="section-title text-center">
                    <h1>Captured Moments</h1>
                    <p class="sub-head"><?php echo $guest_message;?></p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="portfolio-flters" class="list-unstyled">
                            <li data-filter="*" class="filter-active"><a href="javascript:">Our Photos</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="isotope-gallery captured-img-gallery row">
                     <?php
                            //echo $gallery;
                            $explode_gallery = explode(",", $webgallery);
                           // print_r($explode_gallery);
                          array_pop($explode_gallery); // removes last element of an array which was a blank value
                         // print_r($explode_gallery);
 

                  foreach($explode_gallery as $gal){ ?>

                            
                  <div class="gallery-item col-lg-3 col-md-6 col-12 engagement">
                        <div class="captured-gallery-item">
                            <a href="images/website_gallery/<?php echo $gal;?>" title="Title Come here">
                                <img src="images/website_gallery/<?php echo $gal; ?>" class="rounded" alt="">
                            </a>
                        </div>
                    </div>
                  <?php } ?>
                </div>
                
            </div>
        </section>
        <!--  Captured Moments End -->

        <!--  Latest News & Updates Start -->
        
        <!--  Latest News & Updates End -->

    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="text">
                <h3>Just Get Married</h3>
                <h1><?php echo $groom_explode[0];?> <i class="weddingdir_heart_ring"></i> <?php echo $bride_explode[0];?></h1>
                <img src="assets/library/couple-website/images/flower_art_2.png" alt="">
            </div>
            <div class="copyrights">
                Copyright © 2020 — kecioweddingske
            </div>
        </div>
    </footer>

    <!-- Back to Top
    ================================================== -->
    <a id="back-to-top" href="javascript:" class="btn btn-outline-primary back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/library/jquery/jquery-min.js"></script>
    <script src="assets/library/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/library/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="assets/library/owlcarousel/js/owl.carousel.min.js"></script>
    <script src="assets/library/select2/js/select2.min.js"></script>
    <script src="assets/library/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="assets/library/jquery-ui/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/library/magnific-popup/jquery.magnific-popup.min.js"></script>  
    <script src="assets/library/countdown/js/jquery.countdown.min.js"></script>  
    <script src="assets/library/isotope-layout/isotope.pkgd.min.js"></script> 
    <script src="assets/library/datepicker/js/datepicker.js"></script> 
    <script src="assets/library/couple-website/js/script.js"></script>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="assets/library/maps/jquery.gmap.min.js"></script> 
    
    <!--- custom js --------------------->
    <script src="js/sweetalerts/sweetalert.min.js"></script>
     <script src="js/countdown.js"></script>
     <script src="js/rsvp.js"></script>

</body>

</html>