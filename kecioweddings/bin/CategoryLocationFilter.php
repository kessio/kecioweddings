<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$list = array(
    
    "cat_id"     =>$security->sane_inputs("cat_id", "POST"),
    "region"     =>$security->sane_inputs("region", "POST"),
    "subregion"  =>$security->sane_inputs("subregion", "POST")
    
);

//print_r($list);
$data = $little->shaz_curl(json_encode($list), \NsLittle\Little::ROUTE.'/search_by_cat_location.php');
print_r($data);