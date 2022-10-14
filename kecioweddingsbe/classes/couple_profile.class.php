<?php

namespace NsCoupleProfile;
class CoupleProfile{
  
    
    // display my profile
  
    //wedding details function
  
    // my profile update
    
    function remove_prof_pic($user_id){
     $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "UPDATE couple_profile SET cimage='' WHERE user_id = ?";
        $stmt    = $mysqli->prepare($query);
        //echo $mysqli->error;die;
        $stmt->bind_param("i",$user_id);
        $delete  =$stmt->execute();
        $stmt->close();
        $data = array();
        
        if($delete){$status = "SUCCESS";}else{$status = "FAIL";}
        
        return json_encode(array("status"=>$status,"data"=>$data));
        
        
        
    }
    
    function bio_pic($user_id,$bio_img){
       
    $profile_exists = self::cprofile_exists($user_id);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
   
       $query = "INSERT INTO couple_profile(user_id,bio_img)VALUES(?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("is",$user_id,$bio_img);
       $insert =$stmt->execute();
       $stmt->close();
       
       $data['profile_exists'] = 'FALSE';
       
           
       if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
      
       }else{
           
           $query = "UPDATE couple_profile SET bio_img=? WHERE user_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$bio_img,$user_id);
           $update =$stmt->execute();
          $stmt->close();
          
          $data['profile_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
          
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
       
   }
    
    
    function groom_pic($user_id,$groom_pic){
       
    $profile_exists = self::cprofile_exists($user_id);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
   
       $query = "INSERT INTO couple_profile(user_id,groom_pic)VALUES(?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("is",$user_id,$groom_pic);
       $insert =$stmt->execute();
       $stmt->close();
       
       $data['profile_exists'] = 'FALSE';
       
           
       if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
      
       }else{
           
           $query = "UPDATE couple_profile SET groom_pic=? WHERE user_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$groom_pic,$user_id);
           $update =$stmt->execute();
          $stmt->close();
          
          $data['profile_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
          
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
       
   }
    
    
    function bride_pic($user_id,$bride_pic){
       
    $profile_exists = self::cprofile_exists($user_id);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
   
       $query = "INSERT INTO couple_profile(user_id,bride_pic)VALUES(?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("is",$user_id,$bride_pic);
       $insert =$stmt->execute();
       $stmt->close();
       
       $data['profile_exists'] = 'FALSE';
       
           
       if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
      
       }else{
           
           $query = "UPDATE couple_profile SET bride_pic=? WHERE user_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$bride_pic,$user_id);
           $update =$stmt->execute();
          $stmt->close();
          
          $data['profile_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
          
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
       
   }
    
    
    
    
    
    
    function cprof_pic($user_id,$cimage){
       
    $profile_exists = self::cprofile_exists($user_id);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
   
       $query = "INSERT INTO couple_profile(user_id,cimage)VALUES(?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("is",$user_id,$cimage);
       $insert =$stmt->execute();
       $stmt->close();
       
       $data['profile_exists'] = 'FALSE';
       
           
       if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
      
       }else{
           
           $query = "UPDATE couple_profile SET cimage=? WHERE user_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$cimage,$user_id);
           $update =$stmt->execute();
          $stmt->close();
          
          $data['profile_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
          
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
       
   } 
    
  
    function cprofile_exists($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select user_id from couple_profile where user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   
   
   
   
    function display_wedinfo($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT bride_pic,groom_pic,bride,groom,weddingaddress,weddingdate FROM couple_profile WHERE user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
       $data = array();
       
       if($rows > 0 ){
           
           $data['bride']          = $array['bride'];
           $data['groom']          = $array['groom'];
           $data['weddingaddress'] = $array['weddingaddress'];
           $data['weddingdate']    = $array['weddingdate'];
          
           
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        return json_encode(array("status"=>$status, "data"=>$data)); 
         
     } 
    
    
   
    //wedding info functions
   
   function weddinginfo($user_id,$bride,$groom,$weddingaddress,$weddingdate){
     $profile_exists = self::cprofile_exists($user_id);
      
     $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
              
           
         $query = "INSERT INTO couple_profile(user_id,bride,groom,weddingaddress,weddingdate)VALUES(?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("issss",$user_id,$bride,$groom,$weddingaddress,$weddingdate);
            $insertin = $stmt->execute();
            $stmt->close();
            
             $data['profile_exists'] = 'FALSE'; 
             
             if($insertin){ $status = "SUCCESS";}else{$status = "FAIL"; }
              
           
          }else{
              
         $query = "UPDATE couple_profile SET bride=?,groom=?,weddingaddress=?,weddingdate=? WHERE user_id=?"; 
         $stmt  = $mysqli->prepare($query);
         $stmt->bind_param("ssssi",$bride,$groom,$weddingaddress,$weddingdate,$user_id);
         $update =$stmt->execute();
         $stmt->close();
         $data['profile_exists'] = 'TRUE';
           if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
          
          }
        return json_encode(array("status"=>$status,"data"=>$data));  
  
   }
   
   function display_profile($user_id){
      
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT cimage,bride_pic,groom_pic,bio_img,bride,groom,phone,description,instagram,facebook FROM couple_profile WHERE user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
       $data = array();
       
       if($rows > 0 ){
           
           $data['cimage']            = $array['cimage'];
           $data['phone']             = $array['phone'];
           $data['bride_pic']         = $array['bride_pic'];
           $data['groom_pic']         = $array['groom_pic'];
           $data['bio_img']           = $array['bio_img'];
           $data['bride']             = $array['bride'];
           $data['groom']             = $array['groom'];
           $data['description']       = $array['description'];
           $data['instagram']         = $array['instagram'];
           $data['facebook']          = $array['facebook'];
           
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        return json_encode(array("status"=>$status, "data"=>$data)); 
        
        
        
        
    }
    
    //profile function
    
   function cProfile($user_id,$instagram,$facebook){
       
    $profile_exists = self::cprofile_exists($user_id);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
   
       $query = "INSERT INTO couple_profile(user_id,instagram,facebook)VALUES(?,?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("iss",$user_id,$instagram,$facebook);
       $insert =$stmt->execute();
       $stmt->close();
       
       $data['profile_exists'] = 'FALSE';
       
           
       if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
       
           
         
       
       }else{
           
          $query = "UPDATE couple_profile SET  instagram=?, facebook=? WHERE user_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("ssi",$instagram,$facebook,$user_id);
           $update =$stmt->execute();
          $stmt->close();
           
          
          $data['profile_exists'] = 'TRUE';
          
          
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
           
           
           
       }
       
       
       return json_encode(array("status"=>$status,"data"=>$data));
         
       
   } 
    
   
    
    
    
    
}




?>

