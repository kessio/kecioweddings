<?php

error_reporting(0);

//error_reporting(0);
//echo "hey you!";
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$listid = array(
    "listing_id" => $security->sane_inputs("listing_id", "POST")
    
);

//print_r($listid);
$data = $little->shaz_curl(json_encode($listid), \NsLittle\Little::ROUTE.'/approvedListings.php' );
print_r($data);