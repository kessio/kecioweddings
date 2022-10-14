<?php

error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/guest_manager.class.php';
include 'classes/security.class.php';

$connection        = new \NsDbconnect\Dbconnect();
$guestmanager      = new \NsGuestmanager\Guestmanager();    
$security          = new \NsSecurity\Security();

$content	= file_get_contents('php://input');
$data		= json_decode($content, TRUE);

$guest_id       = $data['guest_id'];

$delete_guest = $guestmanager->delete_guest($guest_id);
echo $delete_guest;