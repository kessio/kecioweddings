<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/real_wedding.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$realwed     = new \NsRealWedding\RealWedding();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$realwed_id    = $data['realwed_id'];
$user_id       = $data['user_id'];
$bride_name    = $data['bride_name'];
$groom_name    = $data['groom_name'];
$wedding_date  = $data['wedding_date'];
$town          = $data['town'];
$wedding_theme = $data['wedding_theme'];
$gallery       = $data['gallery'];
$featured_image = $data['featured_image']; 


$result = $realwed->myrealwedding($realwed_id, $user_id, $bride_name, $groom_name, $wedding_date, $town, $wedding_theme, $gallery, $featured_image);
echo $result;