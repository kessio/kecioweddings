<?php
//error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/vendor_profile.class.php';
include 'classes/security.class.php';

// instantiate classes
$connection    = new \NsDbconnect\Dbconnect();
$vprofile      = new \NsVendorProfile\VendorProfile();
$security      = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$vendor_id      = $data['user_id'];
$name           = $data['name'];
$instagram      = $data['instagram'];
$facebook       = $data['facebook'];
$twitter        = $data['twitter'];
$youtube        = $data['youtube'];
$phone_number   = $data['phone_number'];
$address        = $data['address'];
$website        = $data['website'];


$result = $vprofile->vendor_Profile($vendor_id, $name, $instagram, $facebook, $twitter, $youtube, $phone_number, $address, $website);
        

echo $result;
