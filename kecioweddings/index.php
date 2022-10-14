<?php
session_start();
error_reporting(0);

include 'pages.php';
include 'classes/users.class.php';
include 'classes/security.class.php';
include 'classes/little.class.php';


$security = new \NsSecurity\Security();
$little   = new \NsLittle\Little();
$users   = new NsUsers\Users();

if(isset($_GET['logout']) && $_GET['logout'] == "true"){
    $users->logout();
 }

$request    = $_SERVER['REQUEST_URI'];
$params     = explode("/", $request);


$main            = $params[2];
$url_id          = $params[3];
$url_region      = $params[4];




$index_userid = $_SESSION['userid'];

$website_url    = "https://www.kecioweddings/wedding-website.php?%26userid=";
$supplier_url   = "https://www.kecioweddings/supplier-singular/";
$realwed_url    = "localhost/kecioweddings/realweddings/";

// change title dynamically

$titlesupplies    = array(
    
    "vendors"   =>$url_id,
    "main"      =>$main
   
);
$titlevendors = $titlesupplies['vendors'];
$titlemain    = $titlesupplies['main'];
//echo $titlemain;
//echo $titlevendors;
switch("$titlemain") 
{ 
case '': 
     $title     = "Kecioweddings Kenya| Find wedding service providers in one platform."; 
     $metatag   = "Kecioweddings will help you find wedding venues, photographers, videographers, cakes, decor, florist and more with reviews and contacts in one platform. Kenya's No.1 wedding directory for wedding suppliers.It also has wedding planning tools for brides-to-be.";
     break; 
 case 'index.php': 
     $title     = "Kecioweddings Kenya| Find wedding service providers in one platform."; 
     $metatag   = "Kecioweddings will help you find wedding venues, photographers, videographers, cakes, decor, florist and more with reviews and contacts in one platform. Kenya's No.1 wedding directory for wedding suppliers.It also has wedding planning tools for brides-to-be.";
     break; 
 case 'suppliers-list': 
     $title     = "Wedding service Providers in Kenya - kecioweddings"; 
     $metatag   = "Kecioweddings will help you find wedding venues, photographers, videographers, cakes, decor, florist and more with reviews and contacts in one platform. Kenya's No.1 wedding directory for wedding suppliers.It also has wedding planning tools for brides-to-be.";
     break;
}


switch("$titlevendors") 
{ 
case '1': 
     $title     = "Wedding Makeup artists in Kenya - Kecioweddings"; 
     $metatag   = "Find, compare and contact a variety of wedding makeup artists in Kenya at kecioweddings. Browse affordable makeup artists that fit your budget and style, read verified reviews and info all in one place";
     break; 
case '2': 
     $title     = "Wedding Cake Providers in Kenya - kecioweddings"; 
    $metatag    = "Find, compare and contact variety of wedding cake providers in Kenya at kecioweddings; that fits your budget and style with verified reviews and info all in one place"; 
     break;
case '3': 
     $title     = "Wedding MCs, Djs, PAs, music bands and more in Kenya - kecioweddings"; 
     $metatag   = "Find, compare and contact a variety of wedding Mcs, Djs, Public address, Sound systems and bands in Kenya at kecioweddings; that fits your budget and style with verified reviews and info all in one place";
     break; 
 case '9': 
     $title     = "Wedding caterers in Kenya - kecioweddings"; 
     $metatag   = "Find, compare and contact a variety of wedding caterers at kecioweddings that fits your budget and style with verified reviews and info all in one place";
     break; 

} 

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
    
    <?php include_once 'head.php';?>
    <!-- end head -->
    <!--body start-->
    <body class="open">    
    
   
        
        
    <!-- preloader -->
    <div class="preloader">
        <div class="status">
            <img src="images/native/favicons/favicon-16x16.png" alt="">
        </div>
    </div>
   
   
    <!-- end preloader -->
<header class="fixed-top header-anim"> 
    <!--  WeddingDir top -->
    <?php include_once'menu.php';?>
    <?php include_once 'menu-mobile.php';?>
    <!--  WeddingDir top -->
</header>
    <!-- =============================
       *
       *   Page Content Start
       *
      =============================== -->
 
        <main id="body-content">
        <div id="loading"></div>
          <input type="hidden" id="userid" value="<?php echo $_SESSION['userid'];?>">
          
        <?php include_once 'side-menu.php';?>
       
 <?php
 
    if(isset($main) && !empty($main) && $main !='index.php' && $main !='index.php?logout=true'){
        
        if(in_array($main,$permitted_pages)){
            include $main.".php";
        }
         
    }else{
        include 'home.php';
    }
    
    ?>

    </main>
     <?php include_once 'footer.php';?>
    <!-- Back to Top
    ================================================== -->
    <a id="back-to-top" href="javascript:" class="btn btn-outline-primary back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- Request Quote Modal -->
    
    <!-- Request Quote Modal -->

    <!-- Modal -->
   <?php include_once'modals/modals-signin-couple.php';?>
    <?php include_once'modals/modals-signin-vendor.php';?>
      <?php include_once'modals/modals-login.php';?>

    
    <!-- All The JS Files
      ================================================== -->
  <?php include_once 'jquery.php';?>
    
    <script>
  $(window).on('load',function() {
    $('#loading').hide();
  });
</script>
</body>
</html>