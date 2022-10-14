<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//var dataString = 'user_id=' +user_id + '&tasktitle=' + task + '&timeframe='+ timeframe + '&taskdate=' + duedate ;

$todo = array(
    
    "user_id"=>$security->sane_inputs("user_id", "POST"),  
    "todo_id"=>$security->sane_inputs("new_todo", "POST")
    
);

//print_r($todo);

$data = $little->shaz_curl(json_encode($todo), \NsLittle\Little::ROUTE.'/delete_todo_item.php');

print_r($data);


