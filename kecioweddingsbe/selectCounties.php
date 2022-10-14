<?php

error_reporting(0);

header('Content-Type:application/json;charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/filter_list.class.php';

$connection = new \NsDbconnect\Dbconnect();
$security   = new \NsSecurity\Security();
$filter     = new \NsFilterListing\FilterListing();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$get_county = $filter->selectCounties();
echo $get_county;