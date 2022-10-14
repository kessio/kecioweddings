<?php

error_reporting(0);
//echo "heeey";die;
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$getpassword = array(
 "id"          =>$security->sane_inputs("user_id", "POST"),
"password"      => $security->sane_inputs("newpass", "POST"),
"keyedpass"    => $security->sane_inputs("keyedpass", "POST")
    );

       
   // print_r($getpassword);die;  
      $get_password_data = $little->shaz_curl(json_encode($getpassword), \NsLittle\Little::ROUTE.'/passwordChange.php');
      print_r($get_password_data);
     
     
      