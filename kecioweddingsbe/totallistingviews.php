<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/listing.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$listing     = new \NsListing\Listing();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);


$listing_id        = $data['listing_id'];
$whatsapp_views    = $data['whatsapp_views'];
$gallery_views     = $data['gallery_views'];
$phone_views       = $data['phone_views'];
$listing_views     = $data['listing_views'];

$result = $listing->totallistingviews($listing_id, $whatsapp_views, $gallery_views, $phone_views, $listing_views);
echo $result;
