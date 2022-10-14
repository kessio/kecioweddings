<?php
error_reporting(0);

header('Content-Type:application/json;charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/budget.class.php';

$connection = new \NsDbconnect\Dbconnect();
$security   = new \NsSecurity\Security();
$budget     = new \NsBudget\Budget();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$get_category = $budget->get_category();
echo $get_category;