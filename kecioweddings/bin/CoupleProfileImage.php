<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$profile_image = $_FILES['file']['name'];
//print_r($profile_image);die;

$type = $_FILES['file']['type'];
$tmp = $_FILES['file']['tmp_name'];
//print_r($tmp);die;
$array_cimage = explode('.', $profile_image);
$array1 = $array_cimage[0];
$array2 = $array_cimage[1];
//print_r($array1);die;
$imageName = $array1.time().'.'.$array2;
   //print_r($imageName);die;
$user_id = array("user_id" =>$security->sane_inputs("user_id", "GET"),);
//print_r($user_id);

$imagedata = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_profile.php');
//print_r($imagedata);die;

$imagedata_decode = json_decode($imagedata);
$myimage_data = $imagedata_decode->data;
$my_image = $myimage_data->cimage;

$target = "../images/profile_pic/";

if(file_exists($target)){
array_map('unlink', glob($target.$my_image));
//echo "file exists";
}  

$imgtarget = "../images/profile_pic/".$imageName;
 
 move_uploaded_file($tmp, $imgtarget);

$upload_img = array(
            "user_id" =>$security->sane_inputs("user_id", "GET"),
            "cimage"  =>$imageName,
            "profile_image" =>$imageName
        );
       // print_r($upload_img);

$mydata = $little->shaz_curl(json_encode($upload_img), \NsLittle\Little::ROUTE.'/cprof_pic.php');
$reviewimage  = $little->shaz_curl(json_encode($upload_img), \NsLittle\Little::ROUTE.'/edit_reviewimage.php');
$imgtarget = "../images/profile_pic/".$imageName;
 
 move_uploaded_file($tmp, $imgtarget);

print_r($mydata);
print_r($reviewimage); 