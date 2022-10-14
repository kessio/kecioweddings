<?php
//echo"passwordcange";die;
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();



$vendorsignup = array(

    "business_name"=>$security->sane_inputs("business_name","POST"),
    "email"=>$security->sane_inputs("email","POST"),
    "password"=>$security->sane_inputs("password","POST"),
    "phone_number"=>$security->sane_inputs("phone_no","POST"),
  
);
 

$data = $little->shaz_curl(json_encode($vendorsignup), \NsLittle\Little::ROUTE.'/vendorsignup.php');


print_r($data);
