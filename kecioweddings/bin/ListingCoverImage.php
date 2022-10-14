<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//echo "yeey";die;
 


$cover_image = $_FILES['vendor-coverpic']['name'];
//print_r($cover_image);die;
$type = $_FILES['vendor-coverpic']['type'];
$tmp = $_FILES['vendor-coverpic']['tmp_name'];
//print_r($tmp);die;
$array_cimage = explode('.', $cover_image);
$array1 = $array_cimage[0];
$array2 = $array_cimage[1];

$listing_id = array("listing_id" =>$security->sane_inputs("listing_id", "GET"),);
//print_r($listing_id);die;
$listingid = $listing_id['listing_id'];
$imageName = $listingid.'-coverpicture'.'.'.$array2;
 //print_r($imageName);die;
 $target = "../images/listing_coverpic/";


$imagedata = $little->shaz_curl(json_encode($listing_id), \NsLittle\Little::ROUTE.'/display_vcoverpic.php');
//print_r($imagedata);
$imagedata_decode = json_decode($imagedata);
//print_r($imagedata_decode);die;
$myimage_data = $imagedata_decode->data;
$my_image = $myimage_data->cover_image;



if(file_exists($target)){
array_map('unlink', glob($target.$my_image));
//echo "file exists";
}  
 
$imgtarget = "../images/listing_coverpic/".$imageName;
//print_r($imgtarget);die;
move_uploaded_file($tmp, $imgtarget);

$cover_array = array(
    "cover_picture"       =>$imageName,
    "listing_id"          =>$security->sane_inputs("listing_id", "GET")
);
//print_r($cover_array);die;
$mydata       = $little->shaz_curl(json_encode($cover_array), \NsLittle\Little::ROUTE.'/vendor_coverpic.php');
print_r($mydata);