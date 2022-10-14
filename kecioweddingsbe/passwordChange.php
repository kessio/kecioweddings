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

$user_id   = $data['id'];
$newpass   = $data['password'];
$keyedpass = $data['keyedpass'];

$result = $users->passwordChange($user_id, $newpass, $keyedpass);

echo $result;