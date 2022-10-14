<?php

error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/listing.class.php';

$connect   = new \NsDbconnect\Dbconnect();
$security  = new \NsSecurity\Security();
$listing   = new \NsListing\Listing();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$result = $listing->display_favs_listing();

echo $result;
