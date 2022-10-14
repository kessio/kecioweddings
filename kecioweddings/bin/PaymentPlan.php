<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$paypackage      = array(
 "user_id"       =>$security->sane_inputs("vendor_id", "POST"),
 "validitydays"  =>$security->sane_inputs("validitydays", "POST"),
  "plan_type"    =>$security->sane_inputs("plan_type", "POST")  
);

//print_r($paypackage);die;
$data = $little->shaz_curl(json_encode($paypackage), \NsLittle\Little::ROUTE.'/payments.php');

print_r($data);
