<?php

error_reporting(0);

//echo "hello";

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$sendrsvp = array(
    
    "user_id" =>$security->sane_inputs("userid", "POST"),
    "guest_id"=>$security->sane_inputs("guest_id", "POST"),
    "rsvp"=>$security->sane_inputs("rsvp", "POST"),
    
);

//print_r($sendrsvp);
$rsvp = $little->shaz_curl(json_encode($sendrsvp), \NsLittle\Little::ROUTE.'/send_rsvp.php');
print_r($rsvp);