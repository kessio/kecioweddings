<?php

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$cimage = $_FILES['file']['name'];

$type = $_FILES['file']['type'];
$tmp = $_FILES['file']['tmp_name'];
 

$upload_img = array(
            "user_id" =>$security->sane_inputs("user_id", "GET"),
            "cimage"  =>$cimage
        );
       //print_r($upload_img);

$target = "../images/coverpic/" . $cimage;
move_uploaded_file($tmp, $target);  
$mydata = $little->shaz_curl(json_encode($upload_img), \NsLittle\Little::ROUTE.'/create_website.php');
print_r($mydata);