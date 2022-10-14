<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$recoverypass = array("email"  => $security->sane_inputs("email", "POST"));
//print_r($recoverypass);
$data = $little->shaz_curl(json_encode($recoverypass), \NsLittle\Little::ROUTE.'/recover_password.php');
print_r($data);