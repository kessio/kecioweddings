<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/vendor_profile.class.php';
include 'classes/security.class.php';
//instatiate class
$connection    = new \NsDbconnect\Dbconnect();
$vprofile      = new \NsVendorProfile\VendorProfile();
$security      = new \NsSecurity\Security();


$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$vendor_id      = $data['vendor_id'];
$profile_image  = $data['profile_image'];

$result = $vprofile->vendor_profilepic($vendor_id, $profile_image);
        

echo $result;
