<?php

error_reporting(0);

//echo "hello";

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$searchcontact = array(
    
    "user_id" =>$security->sane_inputs("userid", "POST"),
    "contact"=>$security->sane_inputs("contact", "POST")
    
);

//print_r($searchcontact);die;
$data = $little->shaz_curl(json_encode($searchcontact), \NsLittle\Little::ROUTE.'/search_guest_rsvp.php');


print_r($data);