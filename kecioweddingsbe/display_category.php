<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/category.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$category     = new \NsCategory\Category();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);


$result = $category->display_category();
echo $result;