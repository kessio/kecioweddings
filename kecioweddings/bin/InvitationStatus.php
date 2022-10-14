<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$sent_status = array(
    "user_id"   =>$security->sane_inputs("user_id", "POST"),
    "guest_id"  =>$security->sane_inputs("new_id", "POST"),
    "rsvp"      =>$security->sane_inputs("invitation_status", "POST")
    
);

//print_r($sent_status);

$data = $little->shaz_curl(json_encode($sent_status), \NsLittle\Little::ROUTE.'/send_rsvp.php');
print_r($data);