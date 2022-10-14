<?php
//echo "hello there";die;
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$recoverypass = array("email"  => $security->sane_inputs("email", "POST"));

$data = $little->shaz_curl(json_encode($recoverypass), \NsLittle\Little::ROUTE.'/recover_password.php');
print_r($data);




