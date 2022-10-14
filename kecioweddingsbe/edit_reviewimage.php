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

$user_id        = $data['user_id'];
$profile_image  = $data['profile_image'];


$result = $listing->edit_reviewimage($user_id, $profile_image);

echo $result;