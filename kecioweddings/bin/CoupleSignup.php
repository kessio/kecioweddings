<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
 //echo "hey you";die;

$signup = array(

    "name"          =>$security->sane_inputs("name", "POST"),
    "email"         =>$security->sane_inputs("email", "POST"),
    "bride_name"    =>$security->sane_inputs("bride_name", "POST"),
    "groom_name"    =>$security->sane_inputs("groom_name", "POST"),
    "wedding_date"  =>$security->sane_inputs("wedding_date", "POST"),
    "phone_number"  =>$security->sane_inputs("phone_number", "POST"),
    "wedding_venue" =>$security->sane_inputs("wedding_venue", "POST"),
    "password"      =>$security->sane_inputs("password", "POST")
    

);
 
//print_r($signup);die;
$data = $little->shaz_curl(json_encode($signup), \NsLittle\Little::ROUTE.'/coupleSignup.php');
//echo \NsLittle\Little::ROUTE.'/coupleSignup.php';

print_r($data);  

