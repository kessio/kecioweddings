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

$review_id           = $data['review_id'];
$listing_id          = $data['listing_id'];
$user_id             = $data['user_id'];
$name                = $data['name'];
$email               = $data['email'];
$review              = $data['review'];
$ratings             = $data['ratings'];
$profile_image       = $data['profile_image'];
$feedback            = $data['feedback'];
$vendor_name         = $data['vendor_name'];
$listing_name        = $data['listing_name'];
$vendor_id           = $data['vendor_id'];

$result = $listing->add_review($review_id, $listing_id, $user_id, $vendor_id, $name, $email, $review, $listing_name, $ratings, $profile_image, $feedback, $vendor_name);
echo $result;


