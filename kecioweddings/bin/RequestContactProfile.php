<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$listing_id = array(
    "listing_id"  =>$security->sane_inputs("listing_id", "POST")
);

print_r($listing_id);
$data = $little->shaz_curl(json_encode($listing_id), \NsLittle\Little::ROUTE.'/display_contactinfo.php');
print_r($data);