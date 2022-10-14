<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$budget_id = array(
    
    "budgetcat_id" =>$security->sane_inputs("budgetcat_id", "POST")
);

//print_r($budget_id);

$modaldata = $little->shaz_curl(json_encode($budget_id), \NsLittle\Little::ROUTE.'/displaybudget_modal.php');
print_r($modaldata);