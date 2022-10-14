<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/wedding_website.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$website     = new \NsWebsite\Website();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id            = $data['user_id'];
$about_groom        = $data['about_groom'];
$about_bride        = $data['about_bride'];
$church_venue       = $data['church_venue'];
$reception_venue    = $data['reception_venue'];
$church_time        = $data['church_time'];
$reception_time     = $data['reception_time'];
$town               = $data['town'];
$rsvp_deadline      = $data['rsvp_deadline'];
$guest_message      = $data['guest_message'];
$ourstory           = $data['ourstory'];



$create_website = $website->create_website($user_id, $about_groom, $about_bride, $church_venue, $reception_venue, $church_time, $reception_time, $town, $rsvp_deadline, $guest_message, $ourstory);

echo $create_website;

