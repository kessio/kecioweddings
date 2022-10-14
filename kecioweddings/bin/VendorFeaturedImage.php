
<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$featured_image = $_FILES['file']['name'];
//print_r($featured_image);die;

$type = $_FILES['file']['type'];
$tmp = $_FILES['file']['tmp_name'];

$target = "../images/listing_featured/";

if(file_exists($target)){
array_map('unlink', glob($target.$featured_image));
//echo "file exists";die;
}  

$upload_img = array(
            "listing_id" =>$security->sane_inputs("cropped_listing_id", "GET"),
            "featured_image"  =>$featured_image
        );
       //print_r($upload_img);die;

$mydata = $little->shaz_curl(json_encode($upload_img), \NsLittle\Little::ROUTE.'/edit_featuredimage.php');

$imgtarget = "../images/listing_featured/".$featured_image;
 move_uploaded_file($tmp, $imgtarget);
print_r($mydata);