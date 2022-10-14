<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
 
//echo "i loveeeeeeee you";
$update = array(
    
    
    "user_id"=>$security->sane_inputs("user_id", "POST"),
    "facebook"=>$security->sane_inputs("facebook", "POST"),
    "instagram"=>$security->sane_inputs("instagram", "POST")
 
);

  $data = $little->shaz_curl(json_encode($update), \NsLittle\Little::ROUTE.'/cProfile.php');
  
  print_r($data);  
          

