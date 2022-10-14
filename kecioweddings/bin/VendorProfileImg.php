<?php
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$cimage = $_FILES['file']['name'];
//print_r($cimage);die;

$type = $_FILES['file']['type'];
$tmp = $_FILES['file']['tmp_name'];
//print_r($tmp);die;
$array_cimage = explode('.', $cimage);
$array1 = $array_cimage[0];
$array2 = $array_cimage[1];
//print_r($array2);die;
$imageName = $array1.'-'.time().'.'.$array2;
   //print_r($imageName);die;

$user_id = array("user_id" =>$security->sane_inputs("vendorid", "GET"),);
//print_r($user_id);

$imagedata = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_vendor_profile.php');
//print_r($imagedata);die;
$imagedata_decode = json_decode($imagedata);
$myimage_data = $imagedata_decode->data;
$my_image = $myimage_data->profile_image;

$target = "../images/profile_pic/";

if(file_exists($target)){
array_map('unlink', glob($target.$my_image));
//echo "file exists";
}

$imgtarget = "../images/profile_pic/".$imageName;
 
$upload_profile = array(
   
    "vendor_id"        =>$security->sane_inputs("vendorid", "GET"),
    "profile_image"  =>$imageName
       );
   // print_r($upload_profile); die;
$mydata       = $little->shaz_curl(json_encode($upload_profile), \NsLittle\Little::ROUTE.'/vendor_profilepic.php');
$decode_data = json_decode($mydata);
$status = $decode_data->status;
if($status === "SUCCESS"){

move_uploaded_file($tmp, $imgtarget);
}

print_r($mydata);

