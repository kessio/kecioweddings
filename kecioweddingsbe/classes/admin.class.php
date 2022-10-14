<?php

namespace NsAdmin;

class Admin{
    
    function count_vendors(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(role) as vendors FROM users WHERE role='vendor'";
       $stmt  = $mysqli->prepare($query);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['vendor_no'] = $array['vendors'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function count_couples(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(role) as couple FROM users WHERE role='couple'";
       $stmt  = $mysqli->prepare($query);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['couple_no'] = $array['couple'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function select_couple(){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT name,business_name,email,phone_number,bride_name,groom_name,wedding_date,wedding_venue,role,date_joined,status,plan_type,active_days FROM users";
      $stmt = $mysqli->prepare($query);
      $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        
       $data = array();
        while($array =  $result->fetch_assoc()){
            
            $data[] = array('name'=>$array['name'],'business_name'=>$array['business_name'],'email'=>$array['email'],'phone_number'=>$array['phone_number'],'bride_name'=>$array['bride_name'],'groom_name'=>$array['groom_name'],'wedding_date'=>$array['wedding_date'],'role'=>$array['role'],'date_joined'=>$array['date_joined'],'wedding_venue'=>$array['wedding_venue'],'status'=>$array['status'],'plan_type'=>$array['plan_type'],'active_days'=>$array['active_days']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        }
       
        return json_encode(array("status"=>$status, "data"=>$data)); 
        
        
        
        
    }
    
    function count_declinedlisting(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as declined_status FROM listing WHERE status='Declined'";
       $stmt  = $mysqli->prepare($query);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['declined_no'] = $array['declined_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function count_approvedlisting(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as approved_status FROM listing WHERE status='Approved'";
       $stmt  = $mysqli->prepare($query);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['approved_no'] = $array['approved_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function count_pendinglisting(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as pending_status FROM listing WHERE status='Pending'";
       $stmt  = $mysqli->prepare($query);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['pending_no'] = $array['pending_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function declineListings($listing_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "UPDATE listing SET status = 'Declined' WHERE listing_id=? ";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$listing_id);
       $update = $stmt->execute();
       $stmt->close();
       $data = array();
         if($update){$status = "SUCCESS" ;} else{$status = "FAIL";}
         
          return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    function approvedListings($listing_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "UPDATE listing SET status = 'Approved', dateapproved = NOW() WHERE listing_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$listing_id);
       $update = $stmt->execute();
       $stmt->close();
       $data = array();
         if($update){$status = "SUCCESS" ;} else{$status = "FAIL";}
         
          return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function get_regionname_by_id($id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT county_name from counties where county_id = '". $id ."'";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();       
       $resp = $result->fetch_assoc();
       return $resp['county_name'];
        
    }
    
    function get_subtownname_by_id($id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT Town_name from constituencies where town_id = '". $id ."'";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();       
       $resp = $result->fetch_assoc();
       return $resp['Town_name'];
        
    }
    
    function myAllListings(){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT listing_id,listing_name,about,region,subregion,featured_image,gallery,status FROM listing";
      $stmt = $mysqli->prepare($query);
      $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        
       $data = array();
        while($array =  $result->fetch_assoc()){
            
            $data[] = array('listing_id'=>$array['listing_id'],'listing_name'=>$array['listing_name'],'about'=>$array['about'],'region'=>$array['region'],'region_name'=>self::get_regionname_by_id($array['region']),'subregion'=>$array['subregion'],'subregion_name'=>self::get_subtownname_by_id($array['subregion']),'featured_image'=>$array['featured_image'],'gallery'=>$array['gallery'],'status'=>$array['status']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        }
       
        return json_encode(array("status"=>$status, "data"=>$data)); 
         
   } 
        
        
    
    
    
    
    
}
