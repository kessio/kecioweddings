<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$budget_item = array(
    
    'budgetcat_id' => $security->sane_inputs("budgetitem","POST"),
    'cat_id'       => $security->sane_inputs("cat_id","POST"),
    'user_id'       => $security->sane_inputs("user_id","POST"),
    
    );
    
   // print_r($budget_item);
$data = $little->shaz_curl(json_encode($budget_item), \NsLittle\Little::ROUTE.'/delete_budget_item.php');
print_r($data);