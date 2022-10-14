<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/favourites.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$favs        = new \NsFavourite\Favourite();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id         = $data['user_id'];
$listing_id      = $data['listing_id'];
$cat_id          = $data['cat_id'];
$listing_name    = $data['listing_name'];
$featured_image  = $data['featured_image'];
$notes           = $data['notes'];
$state           = $data['state'];

$result = $favs->favourites($user_id, $listing_id, $cat_id, $listing_name, $featured_image, $notes, $state);
echo $result;