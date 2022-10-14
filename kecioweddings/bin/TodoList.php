<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//var dataString = 'user_id=' +user_id + '&tasktitle=' + task + '&timeframe='+ timeframe + '&taskdate=' + duedate ;

$todo = array(
    
    "user_id"   =>$security->sane_inputs("user_id", "POST"),  
    "task"      =>$security->sane_inputs("task", "POST"),
    "timeframe" =>$security->sane_inputs("timeframe", "POST"),  
    "duedate"   =>$security->sane_inputs("duedate", "POST"),
    "status"    =>$security->sane_inputs("status", "POST")
 
);

//print_r($todo);

$data = $little->shaz_curl(json_encode($todo), \NsLittle\Little::ROUTE.'/couple_todolist.php');

print_r($data);

