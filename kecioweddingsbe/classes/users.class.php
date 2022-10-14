<?php

namespace NsUsers;

class Users{
    function cprofile_exists($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select user_id from couple_profile where user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   function phone_exists($phone_number){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select id from users where phone_number = ?");
        $stmt->bind_param("s",$phone_number);
        $stmt->execute();        
      $result = $stmt->get_result();
        if($result->num_rows > 0) {return true; } else { return false; }
           
            
       
   }
   
    function user_exists($email){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select id from users where email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   
   function getPassword($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "SELECT password FROM users WHERE id=?";
      $stmt = $mysqli->prepare($query);
        //echo $mysqli->error;die;
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        return $array['password'];
        
       
   } 
   
   
   function passwordChange($user_id,$newpass,$keyedpass){
       $oldpassword = self::getPassword($user_id);
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $md5keyedpass = md5($keyedpass);
      if($oldpassword === $md5keyedpass){
          $query     ="UPDATE users SET password=? WHERE id=?";
          $stmt      = $mysqli->prepare($query);
          $md5pswd   = md5($newpass);
         $stmt->bind_param("si",$md5pswd,$user_id);
         $stmt->execute();
         $stmt->close();
         $data = array();
       $status = "Password Match";
          }else{
              $status = "Password Mismatch";
          }
          return json_encode(array("status"=>$status, "data"=>$data));
   }
   
   
  function edit_users($name,$email,$user_id){
       $user_exists = self::user_exists($email);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if($user_exists){
              
          $query = "UPDATE users SET name=?,email=? WHERE id=?"; 
         $stmt  = $mysqli->prepare($query);
         $stmt->bind_param("ssi",$name,$email,$user_id);
         $update =$stmt->execute();
         $stmt->close();
         
         $data['profile_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
          
      }
       return json_encode(array("status"=>$status, "data"=>$data));
   }
   
    
    
    
    function display_vprofile($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT phone_number,business_name, email from users WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
       $data = array();
       
       if($rows > 0 ){
           
           $data['phone_number']       = $array['phone_number'];
           $data['business_name']      = $array['business_name'];
           $data['email']             = $array['email'];
           
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        return json_encode(array("status"=>$status, "data"=>$data)); 
        
        
    }
    
   
    
    function Login($phone_number,$password){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT * FROM users WHERE phone_number=? and password=?";
        $stmt = $mysqli->prepare($query);
        //echo $mysqli->error;die;
        $md5pswd = md5($password);
        $stmt->bind_param("ss",$phone_number,$md5pswd);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
        $data = array();
        
        if($rows > 0){
            
            
           $data['userid']        = $array['id'];
           $data['email']         = $array['email'];
           $data['phone_number']  = $array['phone_number'];
           $data['business_name'] = $array['business_name'];
           $data['name']          = $array['name'];
           $data['role']          = $array['role'];
           $data['bride_name']    = $array['bride_name'];
           $data['groom_name']    = $array['groom_name'];
           $data['wedding_date']  = $array['wedding_date'];
           $data['wedding_venue'] = $array['wedding_venue'];
        //   $data['password']      = $array['password'];
          $status = "SUCCESS";
       
        }else{
            $status = "FAIL";
        }
        
       return json_encode(array("status"=>$status, "data"=>$data)); 
        
    }
    
    
    
    
   function vendorSignup($business_name,$email,$password,$phone_number){
       $user_exists = self::user_exists($email);
       $phone_exists = self::phone_exists($phone_number);
      $data = array();
      
      if(!($user_exists) && !($phone_exists)){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "INSERT INTO users(business_name,email,password,phone_number,role,status,plan_type,active_days,date_joined)VALUES(?,?,?,?,?,?,?,?,NOW())";
      $stmt = $mysqli->prepare($query);   
      $md5pswd = md5($password);
      $role = 'vendor';
      $status = 'Active';
      $plan_type = 'Free';
      $active_days = 30;
      $stmt->bind_param("sssssssi",$business_name,$email,$md5pswd,$phone_number,$role,$status,$plan_type,$active_days);
      $insert = $stmt->execute();
      $stmt->close();
      
      if($insert){
          
           $data['user_exists'] = "FALSE";
          $status = "SUCCESS";
          
      }
         
      
      }else{
        $data['user_exists'] = "TRUE";
      
        $status = "FAIL";
        //$data['message'] = "User name already taken!";
          
      }
         return json_encode(array("status"=>$status,"data"=>$data)); // convert array into json string  
      }
   
   
   
    
    
  function coupleSignup($name,$email,$bride_name,$groom_name,$wedding_date,$phone_number,$wedding_venue,$password){
      
       $user_exists = self::user_exists($email);
        $phone_exists = self::phone_exists($phone_number);
      $data = array();
      
      if(!$user_exists  && !($phone_exists)){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "INSERT INTO users(name,email,bride_name,groom_name,wedding_date,phone_number,wedding_venue,password,role,date_joined)VALUES(?,?,?,?,?,?,?,?,?,NOW())";
      $stmt = $mysqli->prepare($query);
      $md5pswd = md5($password);
      $role = 'couple';
      $stmt->bind_param("sssssssss",$name,$email,$bride_name,$groom_name,$wedding_date,$phone_number,$wedding_venue,$md5pswd,$role);
      $insert = $stmt->execute();
      $stmt->close();
      if($insert){
          
          $status = "SUCCESS";
      
      }else{
          $status = "FAIL"; }
         
      
      }else{
           $data['user_exists'] = "TRUE";
      }
 
         return json_encode(array("status"=>$status,"data"=>$data)); // convert array into json string  
      }
      
  
      
  }  
    
    
    

