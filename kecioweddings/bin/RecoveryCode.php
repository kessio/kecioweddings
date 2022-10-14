<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$recoverycode = array(
    "recovery_code"  => $security->sane_inputs("recovery_code", "POST"),
    "email"          => $security->sane_inputs("email", "POST"));


$data = $little->shaz_curl(json_encode($recoverycode), \NsLittle\Little::ROUTE.'/keycode.php');
print_r($data);

