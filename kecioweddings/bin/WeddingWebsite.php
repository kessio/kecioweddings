<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$weddingwebsite = array(
    
    "user_id"                 =>$security->sane_inputs("user_id", "POST"),
    "about_groom"             =>$security->sane_inputs("about_groom", "POST"),
    "about_bride"             =>$security->sane_inputs("about_bride", "POST"),
    "church_venue"            =>$security->sane_inputs("church_venue", "POST"),
    "reception_venue"         =>$security->sane_inputs("reception_venue", "POST"),
    "church_time"             =>$security->sane_inputs("ceremony_time", "POST"),
    "reception_time"          =>$security->sane_inputs("reception_time", "POST"),
    "town"                    =>$security->sane_inputs("town", "POST"),
    "rsvp_deadline"           =>$security->sane_inputs("rsvp_deadline", "POST"),
    "guest_message"           =>$security->sane_inputs("guest_message", "POST"),
    "ourstory"                =>$security->sane_inputs("our_story", "POST")
    
);

//print_r($weddingwebsite);
$webdata = $little->shaz_curl(json_encode($weddingwebsite), \NsLittle\Little::ROUTE.'/create_website.php');
print_r($webdata);

