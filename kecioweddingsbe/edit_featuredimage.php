<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/add_listing.class.php';

$connect   = new \NsDbconnect\Dbconnect();
$security  = new \NsSecurity\Security();
$listing   = new \NsAddListing\AddListing();

$content	     = file_get_contents('php://input');
$data		     = json_decode($content, TRUE);

$listing_id          = $data['listing_id'];
$featured_image      = $data['featured_image'];

$result = $listing->edit_featuredimage($listing_id, $featured_image);
echo $result;