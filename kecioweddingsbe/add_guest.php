<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/guest_manager.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$guest       = new \NsGuestmanager\Guestmanager();
$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id    = $data['user_id'];
$name       = $data['name'];
$relation   = $data['relation'];
$contact    = $data['contact'];
$whatsapp   = $data['whatsapp'];

$result = $guest->add_guest($user_id, $name, $relation, $contact, $whatsapp);
echo $result;