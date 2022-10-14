<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$addguest = array(
    
   "user_id"   =>$security->sane_inputs("user_id", "POST"),
   "name"      =>$security->sane_inputs("name", "POST"),
   "relation"  =>$security->sane_inputs("relation", "POST"),
   "contact"   =>$security->sane_inputs("contact", "POST"),
   "whatsapp"  =>$security->sane_inputs("whatsapp", "POST")
   
);

//print_r($addguest);die;

$data = $little->shaz_curl(json_encode($addguest), \NsLittle\Little::ROUTE. '/add_guest.php');
print_r($data);