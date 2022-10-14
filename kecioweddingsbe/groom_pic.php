<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // ake the page code json

include 'classes/connection.class.php';
include 'classes/couple_profile.class.php';
include 'classes/security.class.php';

$connection    = new \NsDbconnect\Dbconnect();
$cprofile      = new \NsCoupleProfile\CoupleProfile();
$security      = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id      = $data['user_id'];
$groom_pic    = $data['groom_pic'];



$result = $cprofile->groom_pic($user_id, $groom_pic);

echo $result;
