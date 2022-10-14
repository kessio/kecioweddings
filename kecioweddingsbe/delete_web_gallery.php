<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/wedding_website.class.php';

$connect   = new \NsDbconnect\Dbconnect();
$security  = new \NsSecurity\Security();
$website   = new \NsWebsite\Website();

$content	= file_get_contents('php://input');
$data		= json_decode($content, TRUE);

$user_id         = $data['user_id'];
$gallery         = $data['gallery'];

$return = $website->delete_web_gallery($user_id, $gallery);
echo $return;