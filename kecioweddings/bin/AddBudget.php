<?php
session_start();
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$add_budget = array(
    'user_id' =>$security->sane_inputs("user_id","POST"),
    'cat_id' =>$security->sane_inputs("cat_id", "POST"),
    'expense' =>$security->sane_inputs("expense", "POST"),
    'estimate' =>$security->sane_inputs("estimate", "POST"),
    'actual' =>$security->sane_inputs("actual", "POST"),
    'paid' =>$security->sane_inputs("paid", "POST"),
    'pending' =>$security->sane_inputs("pending", "POST")
      
);


$mybudget = $little->shaz_curl(json_encode($add_budget), \NsLittle\Little::ROUTE.'/add_budget.php');
print_r($mybudget);



?>

