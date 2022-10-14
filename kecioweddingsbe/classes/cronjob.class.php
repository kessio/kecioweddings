<?php

namespace NsCronJob;

class CronJob{
    
    function display_duedate(){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "SELECT todo_id, duedate,status FROM todolist";
     $stmt  = $mysqli->prepare($query);
     $stmt->execute();
     $result = $stmt->get_result();
     $rows   = $result->num_rows;
     
     $data = array();
     
     while($array = $result->fetch_assoc()){
     $data[]  = array('todo_id'=>$array['todo_id'],'duedate'=>$array['duedate'],'status'=>$array['status']);
         if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
     }
      
     return $data; 
    }
    
    function check_duetasks(){
    $mysqli        = \NsDbconnect\Dbconnect::dbcon();
    $duetasks      = self::display_duedate();
  //  return $duetasks;die;
     for($m = 0; $m < count($duetasks); $m++){
       $todoid  = $duetasks[$m]['todo_id'];
       $duedate  = $duetasks[$m]['duedate'];
       $status   = $duetasks[$m]['status'];
       if($status !== 'complete'){
       $query     = "UPDATE todolist SET status=? WHERE todo_id=?";
      $stmt      = $mysqli->prepare($query); 
     
      $today     = strtotime(date("m/d/Y"));
        $myduedate = strtotime($duedate);  
      //echo "-datetoday-".$today."-due-".$myduedate."-duedates-".$duedate;
      
    //  $today = strtotime("23/01/2022");
     // echo $today."-id-".$todoid."-due-". strtotime($duedate)."</br>";
      
      if($today > $myduedate){
          $newstatus = "due";
      
  $stmt->bind_param("si",$newstatus,$todoid);
  $stmt->execute();
  $stmt->close();
     // echo $newstatus."-".$todoid;
      }
       }
   
     }    
        
    }
    
 
    function display_payments(){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT id, status,plan_type,active_days,payment_date from users";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;  
        $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('id'=>$array['id'],'status'=>$array['status'],'plan_type'=>$array['plan_type'],'active_days'=>$array['active_days'],'payment_date'=>$array['payment_date']);
            if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
       }
       return $data; 
    }
    
    function payments (){
     $mysqli        = \NsDbconnect\Dbconnect::dbcon();
     $payment_info  = self:: display_payments();
     for($i = 0; $i < count($payment_info); $i++){
     $user_id       = $payment_info[$i]['id'];
     $active_days   = $payment_info[$i]['active_days'];
     $plan_type     = $payment_info[$i]['plan_type'];
     $payment_date  = $payment_info[$i]['payment_date'];
    $query          = "UPDATE users SET payment_date=?, plan_type=?, status =? ,active_days =? WHERE id=?";
    $stmt           = $mysqli->prepare($query);
    if($active_days != 0){
        $newstatus = 'Active';
    }else{
        $newstatus = "Not Active";
    }
    if($active_days !=0){
    $new_activedays = $active_days - 1;
    }else{
        $new_activedays = 0;
    }
    if($newstatus === "Not Active"){
      $new_plan = "None";  
    }else{
        $new_plan = $plan_type;
    }
    if($newstatus === "Not Active"){
        $new_dates = "Not Paid";
    }else{
        $new_dates = $payment_date;
    }
    $stmt->bind_param("sssii",$new_dates,$new_plan,$newstatus,$new_activedays,$user_id);
  $stmt->execute();
  $stmt->close();
 
      
     }
    }
    
    
    
    
}