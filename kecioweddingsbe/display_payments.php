<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/pricing.class.php';

$connect   = new \NsDbconnect\Dbconnect();
$security  = new \NsSecurity\Security();
$price     = new \NsPricing\Pricing();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id      = $data['user_id'];


$pricing = $price->display_payments($user_id);
echo $pricing;