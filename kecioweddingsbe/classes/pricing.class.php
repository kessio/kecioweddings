<?php

namespace NsPricing;

class Pricing{
    
    function display_invoice($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT id,user_id,plan_type,active_days,payment_dates from invoice WHERE user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        $data = array();
        while($array = $result->fetch_assoc()){
          
            if($rows > 0){
                
            $data[] = array("id"=>$array['id'],"user_id"=>$array['user_id'],"plan_type"=>$array['plan_type'],"active_days"=>$array['active_days'],"payment_dates"=>$array['payment_dates']);
            $status = "SUCCESS";
             
         }else{
             $status = "FAIL";
             
         }
        }
        
         return json_encode(array("status"=>$status, "data"=>$data));  
        
    }
    
    function display_payments($user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT status,plan_type,active_days from users WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array  =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
       $data = array();
       
       if($rows > 0 ){
           
           $data['status']            = $array['status'];
           $data['plan_type']         = $array['plan_type'];
           $data['active_days']       = $array['active_days'];
           
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        return json_encode(array("status"=>$status, "data"=>$data)); 
           
        
        
    }
    
    function invoice ($user_id,$validtydays,$plan_type){
   $mysqli = \NsDbconnect\Dbconnect::dbcon();  
  $query   = "INSERT INTO invoice(user_id,payment_dates, active_days, plan_type) VALUES (?,?,?,?)";  
  $stmt   = $mysqli->prepare($query);
  $payment_date = date("Y-m-d");
  $stmt->bind_param("isis",$user_id,$payment_date,$validtydays,$plan_type);
  $update =$stmt->execute();
  $stmt->close();
  $data = array();
  
  if($update){$status = "SUCCESS";}  else{ $status = "FAIL";}
      
  return json_encode(array("status"=>$status,"data"=>$data));    
        
        
    }
    
    function active_days($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "SELECT active_days FROM users WHERE id=?";
     $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $array =  $result->fetch_assoc();
    return $array['active_days'];
    }  
    
function payments($user_id,$validtydays,$plan_type){
   $activedays = self::active_days($user_id);
   //return $activedays;die;
  $mysqli = \NsDbconnect\Dbconnect::dbcon();  
  $query  = "UPDATE users SET status = ?, payment_date= NOW(),active_days=?,plan_type=? WHERE id=?"; 
  $stmt  = $mysqli->prepare($query);
  $status = 'Active'; 
  $total_activedays = $activedays + $validtydays;
  $stmt->bind_param("sisi",$status,$total_activedays,$plan_type,$user_id);
  $update =$stmt->execute();
  $stmt->close();
  $data = array();
  
  if($update){$status = "SUCCESS";}  else{ $status = "FAIL";}
      
  return json_encode(array("status"=>$status,"data"=>$data));  
   
}    
    
    
    
    
}