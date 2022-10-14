<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$statusupdate = array(
    "todo_id"      =>$security->sane_inputs("new_id", "POST"),
    "user_id"      =>$security->sane_inputs("user_id", "POST"),
    "status"       =>$security->sane_inputs("status", "POST"),
    "datecompleted" =>$security->sane_inputs("datecompleted", "POST")
    
    );
    //print_r($statusupdate);
 $data = $little->shaz_curl(json_encode($statusupdate), \NsLittle\Little::ROUTE.'/status_update.php');

print_r($data);
      