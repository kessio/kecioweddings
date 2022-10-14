<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$guestupdate = array(
    "user_id"=>$security->sane_inputs("user_id", "POST"),
    "guest_id"=>$security->sane_inputs("new_id", "POST"),
    "invite_sent"=>$security->sane_inputs("invite_sent", "POST"),
    );
    //print_r($guestupdate);
$data = $little->shaz_curl(json_encode($guestupdate), \NsLittle\Little::ROUTE.'/guest_invite.php');

print_r($data);
      
