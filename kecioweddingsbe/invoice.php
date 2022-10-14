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
$validtydays  = $data['validitydays'];
$plan_type    = $data['plan_type'];

$pricing = $price->invoice($user_id, $validtydays, $plan_type);
echo $pricing;