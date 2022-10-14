<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$changepass = array(
    "email"     => $security->sane_inputs("email", "POST"),
    "password"  => $security->sane_inputs("password", "POST")
    );

$data = $little->shaz_curl(json_encode($changepass), \NsLittle\Little::ROUTE.'/recovery_change_pass.php');
print_r($data);