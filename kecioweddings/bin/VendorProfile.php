<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
 
//echo "i loveeeeeeee you";
$profile = array(
    
    "user_id"         =>$security->sane_inputs("vendor_id", "POST"),
    "name"           =>$security->sane_inputs("vendor_name", "POST"),
    "instagram"      =>$security->sane_inputs("vendor_instagram", "POST"),
    "facebook"       =>$security->sane_inputs("vendor_facebook", "POST"),
    "twitter"        =>$security->sane_inputs("vendor_twitter", "POST"),
    "youtube"        =>$security->sane_inputs("vendor_youtube", "POST"),
    "phone_number"   =>$security->sane_inputs("phone_number", "POST"),
    "address"        =>$security->sane_inputs("business_address", "POST"),
    "website"        =>$security->sane_inputs("business_website", "POST"),
   
 
);


//print_r($profile);die;

  $data = $little->shaz_curl(json_encode($profile), \NsLittle\Little::ROUTE.'/vendor_Profile.php');
  
  print_r($data);  
          



