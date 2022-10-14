<?php

error_reporting(0);

//try{
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
//echo "i love you";


$views = array(
    
"listing_id"    =>$security->sane_inputs("listing_id", "POST"),
"phone_views"    =>$security->sane_inputs("phone_views", "POST"),
"whatsapp_views" =>$security->sane_inputs("whatsapp_views", "POST"),
"gallery_views"  =>$security->sane_inputs("gallery_views", "POST"),
"listing_views" =>$security->sane_inputs("listing_views", "POST")

    );
    //print_r($views);
 $data = $little->shaz_curl(json_encode($views),\NsLittle\Little::ROUTE.'/totallistingviews.php');
 
 //echo \NsLittle\Little::ROUTE.'/totallistingviews.php';
//}catch(Exception $e){
   // echo $e->getMessage();
   print_r($data);
