<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/add_listing.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$listing     = new \NsAddListing\AddListing();

$content	= file_get_contents('php://input');
$data		= json_decode($content, TRUE);

$vendor_id     = $sata['vendor_id'];

$result = $listing->display_pending_listing($vendor_id);
echo $result;