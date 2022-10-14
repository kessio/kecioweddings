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


$content        = file_get_contents('php://input');
$data	        = json_decode($content, TRUE);

$user_id        = $data['user_id'];
$business_name  = $data['business_name'];
$email          = $data['email'];
$phone_number   = $data['phone_number'];

$result        = $vprofile->vendorchangeemailphone($user_id, $business_name, $phone_number, $email);
echo $result;