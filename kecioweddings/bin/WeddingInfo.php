<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


//var dataString =  'wed_date=' + weddingdate + '&weddingaddress' + weddingaddress + '&bride=' + bride + '&groom' + groom;


$weddinginfo = array(
    
  "user_id"      =>$security->sane_inputs("user_id", "POST"),
  "email"        =>$security->sane_inputs("email", "POST"),  
  "phone_number" =>$security->sane_inputs("phone_number", "POST"),
  "bride_name"   =>$security->sane_inputs("bride", "POST"),
  "groom_name"   =>$security->sane_inputs("groom", "POST"),
  "wedding_venue"=>$security->sane_inputs("weddingaddress", "POST"),
  "wedding_date"=>$security->sane_inputs("weddingdate", "POST"),
   
);

//print_r($weddinginfo);die;

$data = $little->shaz_curl(json_encode($weddinginfo), \NsLittle\Little::ROUTE.'/update_wedinfo.php');

print_r($data);

 

//print_r($data);


