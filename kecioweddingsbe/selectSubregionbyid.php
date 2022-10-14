<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); 

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/add_listing.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$listing     = new \NsAddListing\AddListing();

$content     = file_get_contents('php://input');
$data	     = json_decode($content, TRUE);

$County_id   = $data['County_id'];

$subregion   = $listing->selectSubregionbyid($County_id);
echo $subregion;