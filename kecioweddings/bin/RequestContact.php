<?php
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$request_phone = array(
   // "recepient_id" =>$security->sane_inputs("vendor_id", "POST"),
     "listing_id" =>$security->sane_inputs("listing_id", "POST"),
    // "name" =>$security->sane_inputs("name", "POST"),
    // "phone" =>$security->sane_inputs("phone", "POST")
     
);

//print_r($request_phone);die;
$data = $little->shaz_curl(json_encode($request_phone), \NsLittle\Little::ROUTE.'/request_pricing.php');
print_r($data);