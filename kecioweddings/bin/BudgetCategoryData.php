<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//var dataString = 'user_id=' + user_id + '&category=' + category;

$budgetcategory = array(
                
        "budgetcat_id" => $security->sane_inputs("catid", "POST")
);

//print_r($budgetcategory);

$data = $little->shaz_curl(json_encode($budgetcategory), \NsLittle\Little::ROUTE.'/displaybudget_modal.php');

print_r($data);