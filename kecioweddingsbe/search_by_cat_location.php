<?php

error_reporting(0);

header('Content-Type:application/json;charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/filter_list.class.php';

$connection = new \NsDbconnect\Dbconnect();
$security   = new \NsSecurity\Security();
$filter     = new \NsFilterListing\FilterListing();

$content    = file_get_contents('php://input');
$data	     = json_decode($content, TRUE);

$cat_id      = $data['cat_id'];
$region      = $data['region'];
$subregion   = $data['subregion']; 

$mylist = $filter->search_by_cat_location($cat_id, $region, $subregion);
echo $mylist;