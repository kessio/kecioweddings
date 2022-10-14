<?php

error_reporting(0);

header('Content-Type:application/json; charset=utf-8'); // make the page code json

include 'classes/connection.class.php';
include 'classes/security.class.php';
include 'classes/cronjob.class.php';

$connect          = new \NsDbconnect\Dbconnect();
$security         = new \NsSecurity\Security();
$cronjob          = new \NsCronJob\CronJob();

$duedate = $cronjob->check_duetasks();
echo $duedate;

//$payments  = $cronjob->payments();
//echo $payments;