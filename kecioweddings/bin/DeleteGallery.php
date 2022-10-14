<?php

//echo "gallery";
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$edit_gallery = array(
    
"listing_id"    =>$security->sane_inputs("listing_id", "POST"),
  "gallery"     =>$security->sane_inputs("gal_image","POST")
    );

  // print_r($edit_gallery);die;
 $my_image = $edit_gallery["gallery"];
// echo $my_image;die;
   
   $target = "../images/vendor_listings/";

if(file_exists($target)){
array_map('unlink', glob($target.$my_image));
   
$newgallery = $little->shaz_curl(json_encode($edit_gallery),\NsLittle\Little::ROUTE.'/edit_gallery.php');
print_r($newgallery);

}