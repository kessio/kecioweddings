<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/real_wedding.class.php';

$connect   = new \NsDbconnect\Dbconnect();
$security  = new \NsSecurity\Security();
$listing   = new \NsRealWedding\RealWedding();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id      = $data['user_id'];
$gallery      = $data['gallery'];

$return = $listing->edit_realwedgallery($user_id, $gallery);
echo $return;