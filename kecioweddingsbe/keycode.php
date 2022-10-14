<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/recovery_password.class.php';

$connect        = new \NsDbconnect\Dbconnect();
$security       = new \NsSecurity\Security();
$recover_pass   = new \NsRecoverPassword\RecoverPassword();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$recovery_code         = $data['recovery_code'];
$email                 = $data['email'];
$result         = $recover_pass->keycode($recovery_code, $email);
echo $result;