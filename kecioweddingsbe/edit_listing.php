<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/add_listing.class.php';

$connect   = new \NsDbconnect\Dbconnect();
$security  = new \NsSecurity\Security();
$listing   = new \NsAddListing\AddListing();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$listing_name   = $data['listing_name'];
$tents          = $data['tents'];
$facility       = $data['facility'];
$price          = $data['price'];
$about          = $data['about'];
$services       = $data['services'];
$whatsapp       = $data['whatsapp'];
$facebook       = $data['facebook'];
$instagram      = $data['instagram'];
$listing_id     = $data['listing_id'];

$edit_listing = $listing->edit_listing($listing_name, $tents, $facility, $price, $about, $services, $whatsapp, $facebook, $instagram, $listing_id);
echo $edit_listing;

