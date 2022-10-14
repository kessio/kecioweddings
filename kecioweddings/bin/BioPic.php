<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$bio_image = $_FILES['couple-coverpic']['name'];
//print_r($bio_image);die;

 $type = $_FILES['couple-coverpic']['type'];
 $tmp = $_FILES['couple-coverpic']['tmp_name'];
 //print_r($tmp);die;
 $size = $_FILES['couple-coverpic']['size'];
$fileinfo = getimagesize($_FILES["couple-coverpic"]["tmp_name"]);
$width = $fileinfo[0];
$height = $fileinfo[1];
//echo $height;die;

if($height > $width && $height > 800){
    
//print_r($tmp);die;
$array_cimage = explode('.', $bio_image);
$array1 = $array_cimage[0];
$array2 = $array_cimage[1];
//print_r($array1);die;

 
$user_id = array("user_id" =>$security->sane_inputs("user_id", "GET"),);
//print_r($user_id);
 $couple_id = $user_id['user_id'];
$imageName = $couple_id.'-bio'. '.'.$array2;
  //echo $imageName;die;

$imagedata = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_profile.php');
//print_r($imagedata);die;
$imagedata_decode = json_decode($imagedata);
$myimage_data = $imagedata_decode->data;
$my_image = $myimage_data->bio_img;

//print_r($my_image);die;

$target = "../images/bride_groom/";

if(file_exists($target)){
array_map('unlink', glob($target.$my_image));
//echo "file exists";
}  

$imgtarget = "../images/bride_groom/".$imageName;
 

$upload_img = array(
            "user_id"  =>$security->sane_inputs("user_id", "GET"),
            "bio_img"  =>$imageName
        );
     // print_r($upload_img);die;
$mydata = $little->shaz_curl(json_encode($upload_img), \NsLittle\Little::ROUTE.'/bio_pic.php');
 move_uploaded_file($tmp, $imgtarget);

print_r($mydata);

}else{
   $dimension_status = "Image Small";
   
   $dimesion_json = json_encode(array("dimension"=>$dimension_status));
   print_r($dimesion_json);
}
 
 