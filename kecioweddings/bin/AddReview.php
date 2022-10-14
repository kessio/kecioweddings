<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$add_review = array(
"listing_id"          => $security->sane_inputs("listing_id", "POST"),
"user_id"             => $security->sane_inputs("user_id", "POST"),
"name"                => $security->sane_inputs("name", "POST"),
"email"               => $security->sane_inputs("email", "POST"),
"ratings"             => $security->sane_inputs("ratings", "POST"),
"review"              => $security->sane_inputs("review", "POST"),
"profile_image"       => $security->sane_inputs("profile_image", "POST"), 
"listing_name"        => $security->sane_inputs("listing_name", "POST"),
"vendor_id"           => $security->sane_inputs("vendor_id", "POST"),
);


$data = $little->shaz_curl(json_encode($add_review), \NsLittle\Little::ROUTE.'/add_review.php');
print_r($data);