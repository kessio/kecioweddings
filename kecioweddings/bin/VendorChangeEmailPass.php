<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//echo "i loveeeeeeee you";
$profile = array(

"user_id"         =>$security->sane_inputs("vendor_id", "POST"),
"business_name"  =>$security->sane_inputs("business_name", "POST"),
"email"           =>$security->sane_inputs("email", "POST"),
"phone_number"    =>$security->sane_inputs("phone_number", "POST"));
 
//print_r($profile);die;

$data = $little->shaz_curl(json_encode($profile), \NsLittle\Little::ROUTE.'/vendorchangeemailphone.php');
  
  print_r($data);  
