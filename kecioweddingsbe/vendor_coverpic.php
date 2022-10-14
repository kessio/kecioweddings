<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/listing.class.php';
include 'classes/security.class.php';

//instantiate classes

$connection = new \NsDbconnect\Dbconnect();
$listing    = new \NsListing\Listing();
$security   = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$cover_picture           = $data['cover_picture'];
$listing_id              = $data['listing_id'];

$result = $listing->vendor_coverpic($listing_id, $cover_picture);
  echo $result;



