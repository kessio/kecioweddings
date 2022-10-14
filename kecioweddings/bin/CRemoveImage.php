<?php
echo "hello there recovery"; die;
/*error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$update = array(
    "user_id" => $security->sane_inputs("user_id", "POST")
);

//print_r($update);
$data = $little->shaz_curl(json_encode($update), \NsLittle\Little::ROUTE.'/remove_prof_pic.php');
print_r($data);
 * 
 */