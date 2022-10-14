<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$guest_item = array(
    
    'guest_id' => $security->sane_inputs("new_guest_id","POST"),
    
    );
    
   // print_r($guest_item);
$data = $little->shaz_curl(json_encode($guest_item), \NsLittle\Little::ROUTE.'/delete_guest.php');
print_r($data);