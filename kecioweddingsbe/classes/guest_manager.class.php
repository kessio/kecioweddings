<?php

namespace NsGuestmanager;

class Guestmanager{
    
    function count_waitingguests($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "SELECT COUNT(rsvp) as waiting_guests FROM guestlist WHERE rsvp ='Waiting' AND user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['waiting'] = $array['waiting_guests'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
     function count_declinedguests($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "SELECT COUNT(rsvp) as declined_guests FROM guestlist WHERE rsvp ='Declined' AND user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['declined'] = $array['declined_guests'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function count_attendingguests($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "SELECT COUNT(rsvp) as confirmed_guests FROM guestlist WHERE rsvp ='Attending' AND user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['attending_guests'] = $array['confirmed_guests'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function delete_guest($guest_id){
    $mysqli  = \NsDbconnect\Dbconnect::dbcon();
    $query   = "DELETE FROM guestlist WHERE guest_id=? AND rsvp='Waiting'";
    $stmt    = $mysqli->prepare($query);
    $stmt->bind_param("i",$guest_id);
    $stmt->execute();
    $rows = $stmt->affected_rows;
    $stmt->close();
    $data = array();
    
    if($rows > 0){
    
     $status = "SUCCESS" ;}
     else{
        $status = "FAIL";
    }
        
    return json_encode(array("status"=>$status,"data"=>$data));  
        
        
    }
    
    
    
    function guest_invite($invite_sent,$guest_id,$user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $query  = "UPDATE guestlist SET invite_sent = ? WHERE guest_id = ? and user_id=?";
    $stmt  = $mysqli->prepare($query);
    $stmt->bind_param("sii",$invite_sent,$guest_id,$user_id);
    $update =$stmt->execute();
    $stmt->close();
    $data = array();   
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
        
        return json_encode(array("status"=>$status,"data"=>$data));  
      
    }
    
    function display_guests($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $sql    = "SELECT guest_id,name,relation,contact,invite_sent,rsvp,whatsapp FROM guestlist WHERE user_id = ?";
      $stmt   =$mysqli->prepare($sql);
      $stmt->bind_param("i",$user_id);
      $stmt->execute();
      $result = $stmt->get_result();     
      $rows   = $result->num_rows;
      
       $data = array();
        
       while($array =  $result->fetch_assoc()){
           
           $data [] = array('guest_id'=>$array['guest_id'],'name'=>$array['name'],'relation'=>$array['relation'],'contact'=>$array['contact'],'invite_sent'=>$array['invite_sent'],'rsvp'=>$array['rsvp'],'whatsapp'=>$array['whatsapp']);
           
           if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
           
       }
       
       
       return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    function add_guest($user_id,$name,$relation,$contact,$whatsapp){
        
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $sql    = "INSERT INTO guestlist (user_id,name,relation,contact,whatsapp,rsvp)VALUES (?,?,?,?,?,?)";
        $stmt   = $mysqli->prepare($sql);
        $rsvp   = "Waiting";
        $stmt->bind_param("isssss",$user_id,$name,$relation,$contact,$whatsapp,$rsvp);
        $insert = $stmt->execute();
        $stmt->close();
        $data = array();
        if($insert){$status = "SUCCESS";}else{$status = "FAIL";}
        
        return json_encode(array("status"=>$status,"data"=>$data));
        
        
    }
    
    
    
    
    
}
