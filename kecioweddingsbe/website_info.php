<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/wedding_website.class.php';

$connect          = new \NsDbconnect\Dbconnect();
$security         = new \NsSecurity\Security();
$website          = new \NsWebsite\Website();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$id                     = $data['id'];

$wedinfo                 = $website->website_info($id);
echo $wedinfo;