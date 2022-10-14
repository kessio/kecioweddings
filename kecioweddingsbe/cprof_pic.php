<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/couple_profile.class.php';
include 'classes/security.class.php';

// instantiate classes
$connection    = new \NsDbconnect\Dbconnect();
$cprofile      = new \NsCoupleProfile\CoupleProfile();
$security      = new \NsSecurity\Security();

$content       = file_get_contents('php://input');
$data	       = json_decode($content, TRUE);

$user_id      = $data['user_id'];
$cimage       = $data['cimage'];



$result = $cprofile->cprof_pic($user_id, $cimage);

echo $result;
