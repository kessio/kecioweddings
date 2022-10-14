<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/listing.class.php';
include 'classes/security.class.php';

$connection = new \NsDbconnect\Dbconnect();
$listing    = new \NsListing\Listing();
$security   = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$listing_id  = $data['listing_id'];

$result = $listing->display_vcoverpic($listing_id);
  echo $result;
