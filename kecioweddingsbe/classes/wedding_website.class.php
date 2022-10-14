<?php

namespace NsWebsite;

class Website{
    
    function website_coverimg($cover_pic,$user_id){
         $webisite_exists = self::cprofile_exists($user_id);
       $data = array();
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       if(!$webisite_exists){
        $query = "INSERT INTO wedding_website(user_id, cover_pic) VALUES(?,?)"; 
       $stmt   = $mysqli->prepare($query);
       $stmt->bind_param("is",$user_id,$cover_pic);
       $insert = $stmt->execute();
       $stmt->close();
      
       $data['website_exists'] = "FALSE";
       
       if($insert){$status = "SUCCESS";}else{ $status = "FAIL";}
       }else{
          $query   = "UPDATE wedding_website SET cover_pic =? WHERE user_id=?";
         $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("si",$cover_pic,$user_id);
        $update =$stmt->execute();
        $stmt->close();
        $data = array();   
          if($update){
             $data['website_exists'] = "TRUE";
              $status = "SUCCESS";}
              else{$status = "FAIL"; }  
           
           
       }
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
     function delete_webgal($user_id,$gallery){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT webgallery FROM wedding_website WHERE user_id=?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
      $gallery .= ",";
      $gall =  $array['webgallery'];
      $replace = str_replace($gallery, "", $gall);
       return $replace;
       
       
   }
   function delete_web_gallery ($user_id,$gallery){
         $data = array();
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
         $newgallery = self::delete_webgal($user_id,$gallery);
        $query  = "UPDATE wedding_website SET webgallery=? WHERE user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si",$newgallery,$user_id);
       $update = $stmt->execute();
       $stmt->close();
        if($update){$status = "SUCCESS";} else{$status = "FAIL";}
      // $status = "SUCCESS";
       return json_encode(array("mystatus"=>$status,"data"=>$data));

        
   }
    
    
    
    function website_gallery($webgallery,$user_id){
         $webisite_exists = self::cprofile_exists($user_id);
         
       $data = array();
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       if(!$webisite_exists){
        $query = "INSERT INTO wedding_website(user_id, webgallery) VALUES(?,?)"; 
       $stmt   = $mysqli->prepare($query);
       $stmt->bind_param("is",$user_id,$webgallery);
       $insert = $stmt->execute();
       $stmt->close();
      
       $data['website_exists'] = "FALSE";
       
       if($insert){$status = "SUCCESS";}else{ $status = "FAIL";}
       }else{
        $oldgal = self::select_gallery($user_id);
        $newgallery = $oldgal.$webgallery;
          $query   = "UPDATE wedding_website SET webgallery =? WHERE user_id=?";
         $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("si",$newgallery,$user_id);
        $update =$stmt->execute();
        $stmt->close();
        $data = array();   
          if($update){
             $data['website_exists'] = "TRUE";
              $status = "SUCCESS";}
              else{$status = "FAIL"; }  
           
           
       }
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function select_gallery($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT webgallery FROM wedding_website WHERE user_id=?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
       $oldgallery = $array['webgallery'];
       return $oldgallery;
               
        
    }
     function phone_exists($phone_number,$user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select phone_number from users where id !=? AND phone_number=?");
        $stmt->bind_param("is",$user_id,$phone_number);
        $stmt->execute();        
      $result = $stmt->get_result();
        if($result->num_rows > 0) {return true; } else { return false; }
           
            
       
   }
   
    function emailexists($email,$user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select email from users where id !=? AND email = ?");
        $stmt->bind_param("is",$user_id, $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
    function update_wedinfo($email,$phone_number,$bride_name,$groom_name,$wedding_date,$wedding_venue,$user_id){
        $phoneexists    = self::phone_exists($phone_number,$user_id);
        $myemailexists  = self::emailexists($email,$user_id);  
        if(!($phoneexists) && !($myemailexists)){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "UPDATE users SET email=?, phone_number=?, bride_name =?,groom_name=?,wedding_date=?,wedding_venue=? WHERE id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("ssssssi",$email,$phone_number,$bride_name,$groom_name,$wedding_date,$wedding_venue,$user_id);
        $update =$stmt->execute();
        $stmt->close();
        $data = array(); 
          $data['emailphone_exists'] = 'FALSE';
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
        }else{
            $data['emailphone_exists'] = 'TRUE';  
        }
        return json_encode(array("status"=>$status,"data"=>$data));
    }
   function website_info($id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "SELECT email,phone_number,bride_name,groom_name,wedding_date,wedding_venue FROM users WHERE id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array  =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        $data   = array();
       
       if($rows > 0 ){
           $data['email']           = $array['email'];
           $data['phone_number']    = $array['phone_number'];
           $data['bride_name']      = $array['bride_name'];
           $data['groom_name']      = $array['groom_name'];
           $data['wedding_date']    = $array['wedding_date'];
           $data['wedding_venue']   = $array['wedding_venue'];
           
           $status = "SUCCESS";
           
       }else{
           $status = "FAIL";
      }
        
      return json_encode(array("status"=>$status,"data"=>$data));
        
           
       
       
       
   }
    
    
    function send_rsvp($user_id,$rsvp,$guest_id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "UPDATE guestlist SET rsvp = ? WHERE user_id=? AND guest_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("sii",$rsvp, $user_id,$guest_id);
        $update =$stmt->execute();
        $stmt->close();
        $data = array();   
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
        
        return json_encode(array("status"=>$status,"data"=>$data));
       
    }
    
    
    function search_guest_rsvp($user_id,$contact){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "SELECT guest_id,name,rsvp FROM  guestlist WHERE user_id=? AND contact=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("is", $user_id,$contact);
        $stmt->execute();
        $result = $stmt->get_result();
        $array  =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        $data   = array();
       
       if($rows > 0 ){
           
           $data['name']      = $array['name'];
           $data['guest_id']  = $array['guest_id'];
           $data['rsvp']      = $array['rsvp'];
           
           $status = "SUCCESS";
           
       }else{
           $status = "FAIL";
      }
        
      return json_encode(array("status"=>$status,"data"=>$data));
        
        
                
       
    }
    
    
    
    function display_create_website($user_id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "SELECT about_groom, about_bride, church_venue, reception_venue, church_time, reception_time, town, rsvp_deadline, guest_message, cover_pic, ourstory, webgallery FROM wedding_website WHERE user_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
       $data = array();
       
       if($rows > 0 ){
           
            $data['about_groom']       = $array['about_groom'];
            $data['about_bride']      = $array['about_bride'];
            $data['church_venue']      = $array['church_venue'];
            $data['reception_venue']   = $array['reception_venue'];
            $data['church_time']       = $array['church_time'];
            $data['reception_time']    = $array['reception_time'];
            $data['town']              = $array['town'];
            $data['rsvp_deadline']     = $array['rsvp_deadline'];
            $data['guest_message']     = $array['guest_message'];
            $data['cover_pic']         = $array['cover_pic'];
            $data['ourstory']          = $array['ourstory'];
            $data['webgallery']        = $array['webgallery'];
            
           
           $status = "SUCCESS";
           
       }else{
           $status = "FAIL";
      }
        
      return json_encode(array("status"=>$status,"data"=>$data));
       
       
       
   }
    
   function create_website($user_id,$about_groom,$about_bride,$church_venue,$reception_venue,$church_time,$reception_time,$town,$rsvp_deadline,$guest_message,$ourstory){
       $webisite_exists = self::cprofile_exists($user_id);
       $data = array();
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       if(!$webisite_exists){
      $query  = "INSERT INTO wedding_website(user_id,about_groom,about_bride, church_venue, reception_venue, church_time, reception_time, town, rsvp_deadline,guest_message, ourstory) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
       $stmt   = $mysqli->prepare($query);
       $stmt->bind_param("issssssssss",$user_id,$about_groom,$about_bride,$church_venue,$reception_venue,$church_time,$reception_time,$town,$rsvp_deadline,$guest_message,$ourstory);
       $insert = $stmt->execute();
       $stmt->close();
      
       $data['website_exists'] = "FALSE";
       
       if($insert){$status = "SUCCESS";}else{ $status = "FAIL";}
       }else{
       $query  = "UPDATE wedding_website SET about_groom=?,about_bride=?, church_venue =?,reception_venue=?,church_time=?,reception_time=?,town=?,rsvp_deadline=?,guest_message=?,ourstory=? WHERE user_id=?";
       $stmt   = $mysqli->prepare($query);
       $stmt->bind_param("ssssssssssi",$about_groom,$about_bride,$church_venue,$reception_venue,$church_time,$reception_time,$town,$rsvp_deadline,$guest_message,$ourstory,$user_id);
       $update = $stmt->execute();
       $stmt->close();
          
       $data['cover_pic_exists'] ="TRUE";
         if($update){$status = "SUCCESS";}else{ $status = "FAIL";}  
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
       
   } 
   
     function cprofile_exists($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select user_id from wedding_website where user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
    
    
    
    
}
