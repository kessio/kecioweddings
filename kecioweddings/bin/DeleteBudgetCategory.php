<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$budget_category = array(
    
    "cat_id" =>$security->sane_inputs("budget_catid", "POST")
    
);

//print_r($budget_category);
$data = $little->shaz_curl(json_encode($budget_category), \NsLittle\Little::ROUTE.'/delete_budget_category.php');
print_r($data);