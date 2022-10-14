<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/users.class.php';
include 'classes/security.class.php';

// instantiate classes
$connection = new \NsDbconnect\Dbconnect();
$users      = new \NsUsers\Users();
$security   = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$name          =  $data['name'];
$email         =  $data['email'];
$bride_name    =  $data['bride_name'];
$groom_name    =  $data['groom_name'];
$wedding_date  =  $data['wedding_date'];
$phone_number  =  $data['phone_number'];
$wedding_venue =  $data['wedding_venue'];
$password      =  $data['password'];

$result = $users->coupleSignup($name, $email, $bride_name, $groom_name, $wedding_date, $phone_number, $wedding_venue, $password);

echo $result;






