<?php

error_reporting(0);
header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/todolist.class.php';
include 'classes/security.class.php';

$connection = new \NsDbconnect\Dbconnect();
$todolist   = new \NsTodolist\Todolist();
$security   = new \NsSecurity\Security();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$user_id = $data['user_id'];

$return = $todolist->pending_task($user_id);

echo $return;