<?php
error_reporting(0);

//echo "hello";

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
 //url: 'bin/CoupleProfile.php?user_id=' + user_id +'&phone=' + phone + '&description=' + description + '&facebook=' +facebook +'&instagram='+ instagram, 

$cimage = $_FILES['mywebcoverpic']['name'];
//print_r($cimage);die;
$type = $_FILES['mywebcoverpic']['type'];
$tmp = $_FILES['mywebcoverpic']['tmp_name'];
$size = $_FILES['mywebcoverpic']['size'];
 
$fileinfo = getimagesize($_FILES["mywebcoverpic"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    
   if($width>=800){
   
$imageExt = explode('.', $cimage);
//print_r($imageExt);
$AllowExt = strtolower(end($imageExt));
//print_r($AllowExt);die;
$allow = array('jpg', 'jpeg', 'png');

// rename image
$image = explode('.', $cimage);//print_r($image); die;
$name_array_1 = $image[0]; //print_r($name_array_1); die;
$userid_array = array("user_id"=>$security->sane_inputs("user_id", "GET") );
$userid = $userid_array['user_id'];
$imagename = $userid."-webcover".".".$AllowExt;
//echo $imagename;die;



$display_create_website = $little->shaz_curl(json_encode($userid_array), \NsLittle\Little::ROUTE.'/display_create_website.php');
//print_r($display_create_website);die;
$create_website_decoded = json_decode($display_create_website);
//print_r($create_website_decoded);
$cover_pic = $create_website_decoded->data->cover_pic;

$target1 = "../images/website_gallery/";

if(file_exists($target1)){
array_map('unlink', glob($target1.$cover_pic));

} 

$target = "../images/website_gallery/" . $imagename;

$image_upload = array(
    "user_id"     =>$userid,
    "cover_pic"   =>$imagename
);
//print_r($image_upload);die;

if (in_array($AllowExt, $allow)) {
    
    move_uploaded_file($tmp, $target); 
    
  $data = $little->shaz_curl(json_encode($image_upload), \NsLittle\Little::ROUTE.'/website_coverimg.php');
  print_r($data);
  
   
}
   }else{
       $dimension_status = "WidthSmall";
   
   $dimesion_json = json_encode(array("dimension"=>$dimension_status));
   print_r($dimesion_json);
   }