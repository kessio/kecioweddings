<?php
session_start();
error_reporting(0);

//error_reporting(0);
//echo "hey you!";
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$listid = array(
    "listing_id" => $security->sane_inputs("listing_id", "POST"),
    "user_id"    => $security->sane_inputs("user_id", "POST")
    
);


$data = $little->shaz_curl(json_encode($listid), \NsLittle\Little::ROUTE.'/publish_listing.php' );
print_r($data);