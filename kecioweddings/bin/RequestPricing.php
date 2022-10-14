<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
// var dataString =  'nameq=' + nameq + '&emailq=' + emailq + '&phoneq=' + phoneq +  '&comments=' + message;

$request_price = array(
    
"sender_id"       =>$security->sane_inputs("sender_id", "POST"),
"recepient_id"    => $security->sane_inputs("recepient_id", "POST"),
"listing_id"      => $security->sane_inputs("listing_id", "POST"),
"name"           => $security->sane_inputs("nameq", "POST"),
"email"          => $security->sane_inputs("emailq", "POST"),
"phone"          => $security->sane_inputs("phoneq", "POST"),
"message"        => $security->sane_inputs("message", "POST"),

    
    );
   // print_r($request_price);
$data = $little->shaz_curl(json_encode($request_price), \NsLittle\Little::ROUTE.'/request_pricing.php');
print_r($data);