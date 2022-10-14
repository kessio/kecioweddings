<?php

error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/users.class.php';
include 'classes/security.class.php';

//instantiate classes

$connection = new \NsDbconnect\Dbconnect();
$users      = new \NsUsers\Users();
$security   = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$phone_number = $data['phone_number'];
//$email        = $data['email'];
$password     = $data['password'];



$result = $users->Login($phone_number, $password);

echo $result;
