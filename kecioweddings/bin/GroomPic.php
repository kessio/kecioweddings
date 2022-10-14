<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
//echo ("hello");
$groom_image = $_FILES['file']['name'];
//print_r($groom_image);die;

$type = $_FILES['file']['type'];
$tmp = $_FILES['file']['tmp_name'];
//echo $tmp;die;

$array_cimage = explode('.', $groom_image);
$array1 = $array_cimage[0];
$array2 = $array_cimage[1];

$user_id = array("user_id" =>$security->sane_inputs("user_id", "GET"),);
//print_r($user_id);die;

$imagedata = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_profile.php');
//print_r($imagedata);die;

$imagedata_decode = json_decode($imagedata);
$myimage_data = $imagedata_decode->data;
$my_image = $myimage_data->groom_pic;

$target = "../images/bride_groom/";

if(file_exists($target)){
array_map('unlink', glob($target.$my_image));
//echo "file exists";
}  



$imgtarget = "../images/bride_groom/".$groom_image;
$upload_img = array(
            "user_id" =>$security->sane_inputs("user_id", "GET"),
            "groom_pic"  =>$groom_image
        );
      //  print_r($upload_img);die;
$mydata = $little->shaz_curl(json_encode($upload_img), \NsLittle\Little::ROUTE.'/groom_pic.php');

move_uploaded_file($tmp, $imgtarget);
    
    
print_r($mydata);
