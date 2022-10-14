<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/guest_manager.class.php';
include 'classes/security.class.php';

$connection        = new \NsDbconnect\Dbconnect();
$guestmanager      = new \NsGuestmanager\Guestmanager();    
$security          = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$invite_sent = $data['invite_sent'];
$guest_id    = $data['guest_id'];
$user_id     = $data['user_id'];



$guests = $guestmanager->guest_invite($invite_sent, $guest_id, $user_id);

echo $guests;
