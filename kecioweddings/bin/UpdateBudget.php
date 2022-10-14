<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//var dataString = 'estimate=' + estimate + '&actual=' + actual + '&paid='+ paid + '&pending=' + pending;

$update_budget = array(
    'user_id' =>$security->sane_inputs("user_id","POST"),
    'cat_id' =>$security->sane_inputs("cat_id", "POST"),
    'budgetcat_id' =>$security->sane_inputs("budgetcat_id", "POST"),
    'estimate' =>$security->sane_inputs("estimate", "POST"),
    'actual' =>$security->sane_inputs("actual", "POST"),
    'paid' =>$security->sane_inputs("paid", "POST"),
    
      
);

//print_r($update_budget);
$data = $little->shaz_curl(json_encode($update_budget), \NsLittle\Little::ROUTE.'/update_budget.php');

print_r($data);