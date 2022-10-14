<?php
error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/todolist.class.php';

$connection = new NsDbconnect\Dbconnect();
$security   = new NsSecurity\Security();
$todolist   = new NsTodolist\Todolist();

$content		= file_get_contents('php://input');
$data			= json_decode($content, TRUE);

$todo_id       = $data['todo_id'];


$update_task_due = $todolist->update_task_due($todo_id);

echo $update_task_due;
   