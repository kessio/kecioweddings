<?php
session_start();
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


$logininput = array(
    "password"      =>$security->sane_inputs("cpassword", "POST"),
    "phone_number"  =>$security->sane_inputs("phone_number", "POST")
   
);

  //print_r($logininput);

  $login = $little->shaz_curl(json_encode($logininput), \NsLittle\Little::ROUTE.'/Login.php');
  
 
  $login_decoded = json_decode($login);
  $status         = $login_decoded->status;
  $data           = $login_decoded->data;
  if($status == "SUCCESS" ){
      
      $_SESSION['user_session_exists'] = "TRUE";
      $_SESSION['userid']         = $data->userid;
      $_SESSION['email']          = $data->email;
      $_SESSION['phone_number']   = $data->phone_number;
      $_SESSION['business_name']  = $data->business_name;
      $_SESSION['name']           = $data->name;
      $_SESSION['country']        = $data->country;
      $_SESSION['role']           = $data->role;
      $_SESSION['bride_name']     = $data->bride_name;
      $_SESSION['groom_name']     = $data->groom_name;
      $_SESSION['wedding_date']   = $data->wedding_date;
      $_SESSION['wedding_venue']  = $data->wedding_venue;
      $_SESSION['password']       = $data->password;
      
      // set cookies
     // setcookie("user_phone",$_SESSION['phone_number'], time() + (2 * 365 * 24 * 60 * 60)); // phone number stores as cookie
    //  setcookie("user_password",$_SESSION['password'],time() + (2 * 365 * 24 * 60 * 60)); // password stored
      
      
  } 
    //echo $_SESSION['role']; 
  
 print_r($login);


