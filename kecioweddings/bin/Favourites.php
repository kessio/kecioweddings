<?php
session_start();
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$favourites = array(
    
    "user_id"        =>$security->sane_inputs("user_id", "POST"),
    "listing_id"     =>$security->sane_inputs("listing_id", "POST"),
    "cat_id"         =>$security->sane_inputs("cat_id", "POST"),
    "listing_name"   =>$security->sane_inputs("listing_name", "POST"),
    "featured_image"  =>$security->sane_inputs("featured_image", "POST")
    
    
);

//print_r($favourites);

 
$data = $little->shaz_curl(json_encode($favourites), \NsLittle\Little::ROUTE.'/favourites.php');
print_r($data);

 