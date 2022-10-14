<?php
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$reviews = array(
    
   "review_id"     =>$security->sane_inputs("review_id", "POST"),   
   "feedback"      =>$security->sane_inputs("feedback", "POST"),
   "vendor_name"   =>$security->sane_inputs("vendor_name", "POST")
);

//print_r($reviews);

$data = $little->shaz_curl(json_encode($reviews), \NsLittle\Little::ROUTE.'/add_review.php');
print_r($data);