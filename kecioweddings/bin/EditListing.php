<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
//echo "i love you";


$add_list = array(
    
"listing_id"    =>$security->sane_inputs("listing_id", "POST"),
"listing_name"  =>$security->sane_inputs("listing_name", "POST"),
"tents"         => $security->sane_inputs("tents", "POST"),  
"furniture"     => $security->sane_inputs("furniture", "POST"), 
"facility"      => $security->sane_inputs("facility", "POST"),
"price"         => $security->sane_inputs("price", "POST"),
"about"         => $security->sane_inputs("about", "POST"),
"services"      => $security->sane_inputs("services", "POST"),
"whatsapp"      => $security->sane_inputs("whatsapp", "POST"),
"facebook"      => $security->sane_inputs("facebook", "POST"),
"instagram"     => $security->sane_inputs("instagram", "POST"),

);

//print_r($add_list);die;

$data = $little->shaz_curl(json_encode($add_list),\NsLittle\Little::ROUTE.'/edit_listing.php');

print_r($data);

