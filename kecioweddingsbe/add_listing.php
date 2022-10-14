<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/add_listing.class.php';

$connect             = new \NsDbconnect\Dbconnect();
$security            = new \NsSecurity\Security();
$listing             = new \NsAddListing\AddListing();

$content	     = file_get_contents('php://input');
$data	             = json_decode($content, TRUE);

$listing_id          = $data['listing_id'];
$vendor_id           = $data['vendor_id'];
$listing_name        = $data['listing_name'];
$cat_id              = $data['cat_id'];
$subcategory         = $data['subcategory'];
$tents               = $data['tents'];
$entertainment       = $data['entertainment'];
$furniture           = $data['furniture'];
$facility            = $data['facility'];
$price               = $data['price'];
$country             = $data['country'];
$region              = $data['region'];
$subregion           = $data['subregion'];
$about               = $data['about'];
$services            = $data['services'];
$amenities           = $data['amenities'];
$cover_picture       = $data['cover_picture'];
$facebook            = $data['facebook'];
$instagram           = $data['instagram'];
$whatsapp            = $data['whatsapp'];
$gallery             = $data['gallery'];
$featured            = $data['featured'];


$result = $listing->add_listing($listing_id, $vendor_id, $listing_name, $cat_id, $subcategory, $tents, $entertainment, $furniture, $facility, $price, $country, $region, $subregion, $about, $services, $amenities, $cover_picture, $facebook, $instagram, $whatsapp, $gallery, $featured);
echo $result;