<?php
session_start();
error_reporting(0);

//error_reporting(0);
//echo "hey you!";
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$logininput = array(
    
    "email"=>$security->sane_inputs("aemail", "POST"),
    "password"=>$security->sane_inputs("apassword", "POST")
   
);

  //print_r($logininput);

  $login = $little->shaz_curl(json_encode($logininput), \NsLittle\Little::ROUTE.'\adminLogin.php');
  
  //echo \NsLittle\Little::ROUTE.'\coupleLogin.php';
 
  $login_decoded = json_decode($login);
  
  //print_r($login_decoded);die;
  
  $status         = $login_decoded->status;
 /// echo $status;
  $data           = $login_decoded->data;
  $vendor_id        =$login_decoded->data->vendor_id;
  
  //echo $vendor_id;
  if($status == "SUCCESS" ){
      
      $_SESSION['vendor_session_exists'] = "TRUE";
      $_SESSION['vendorid']       = $data->vendorid;
      $_SESSION['email']          = $data->email;
      $_SESSION['role']           = $data->role;
      
      
      //print_r($_SESSION['vendorid']); 
      
      
  } 
  
  
 print_r($login);

