<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/wedding_website.class.php';

$connect          = new \NsDbconnect\Dbconnect();
$security         = new \NsSecurity\Security();
$website          = new \NsWebsite\Website();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id       = $data['user_id'];
$rsvp          = $data['rsvp'];
$guest_id      = $data['guest_id'];


$sendrsvp = $website->send_rsvp($user_id, $rsvp, $guest_id);
echo $sendrsvp;