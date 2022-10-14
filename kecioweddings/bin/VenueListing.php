<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';


$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$listing = array(
    
          "listing_id"=>$security->sane_inputs("new_id","POST")
    
    ); 

    print_r($listing);
$data = $little->shaz_curl(json_encode($listing), \NsLittle\Little::ROUTE.'/single_venue_listing.php');


$data_decoded = json_decode($data);
//print_r($data_decoded);

$status = $data_decoded->status;
//print_r($status);
$mylisting = $data_decoded->data;
//print_r($mylisting);
if($status == "SUCCESS" ){
    
    //print_r($listing);
    
   $count_listing = count($mylisting);
   
   for($s = 0; $s < $count_listing; $s++){
       
      $listing_name = $mylisting[$s]->listing_name;
      //echo $listing_name;
      $facility   = $mylisting[$s]->facility;
      $price      = $mylisting[$s]->price;
      $about      = $mylisting[$s]->about;
      $services   = $mylisting[$s]->services;
      $facebook   = $mylisting[$s]->facebook;
      $instagram  = $mylisting[$s]->instagram;
      
   }
   
   print_r($data);
    
    
}
