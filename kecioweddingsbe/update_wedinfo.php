<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/wedding_website.class.php';

$connect          = new \NsDbconnect\Dbconnect();
$security         = new \NsSecurity\Security();
$website          = new \NsWebsite\Website();

$content          = file_get_contents('php://input');
$data		  = json_decode($content, TRUE);

$email            = $data['email'];
$phone_number     = $data['phone_number'];
$bride_name       = $data['bride_name'];
$groom_name       = $data['groom_name'];
$wedding_date     = $data['wedding_date'];
$wedding_venue    = $data['wedding_venue'];
$user_id          = $data['user_id'];

$sendrsvp = $website->update_wedinfo($email, $phone_number, $bride_name, $groom_name, $wedding_date, $wedding_venue, $user_id);
echo $sendrsvp;