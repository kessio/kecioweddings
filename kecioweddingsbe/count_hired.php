
<?php
error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/favourites.class.php';

$connect     = new \NsDbconnect\Dbconnect();
$security    = new \NsSecurity\Security();
$favs        = new \NsFavourite\Favourite();

$content     = file_get_contents('php://input');
$data	     = json_decode($content, TRUE);

$user_id     = $data['user_id'];

$countapproved = $favs->count_hired($user_id);
echo $countapproved;

