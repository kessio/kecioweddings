<?php
namespace NsVendorProfile;

class VendorProfile{
    
    function displayusersprofile($user_id){
    
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT business_name,email,phone_number FROM users WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows; 
        $data = array();
         if($rows > 0 ){
           
           $data['business_name']  = $array['business_name'];
           $data['email']          = $array['email'];
           $data['phone_number']   = $array['phone_number'];
           
          $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
         return json_encode(array("status"=>$status, "data"=>$data));   
    }
    
    function phone_exists($phone_number,$user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select phone_number from users where id !=? AND phone_number=?");
        $stmt->bind_param("is",$user_id,$phone_number);
        $stmt->execute();        
      $result = $stmt->get_result();
        if($result->num_rows > 0) {return true; } else { return false; }
           
            
       
   }
   
    function user_exists($email,$user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select email from users where id !=? AND email = ?");
        $stmt->bind_param("is",$user_id, $email);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
     
    
    function vendorchangeemailphone($user_id,$business_name, $phone_number, $email){
       $user_exists = self::user_exists($email,$user_id);
       $phone_exists = self::phone_exists($phone_number,$user_id);
      $data = array();
      
      if(!($user_exists) && !($phone_exists)){  
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "UPDATE users SET business_name=?, email=?,phone_number=? WHERE id=?";
     $stmt = $mysqli->prepare($query);  
     $stmt->bind_param("sssi", $business_name,$email,$phone_number,$user_id);
     $update =$stmt->execute();
    $stmt->close();
    $data = array();
    $data['user_exists'] = 'FALSE';
    if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
       }else{
        $data['user_exists'] = "TRUE";
      
        $status = "FAIL";
        //$data['message'] = "User name already taken!";
          
      }  
     return json_encode(array("status"=>$status, "data"=>$data));   
       
    }
    
    function display_vendor_profile($user_id){
      
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT name, profile_image, instagram, facebook, twitter, youtube, phone_number, address, website, banner FROM vendor_profile WHERE vendor_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
       $data = array();
       
       if($rows > 0 ){
           
           $data['name']                   = $array['name'];
           $data['profile_image']          = $array['profile_image'];
           $data['instagram']              = $array['instagram'];
           $data['facebook']               = $array['facebook'];
           $data['twitter']                = $array['twitter'];
           $data['youtube']                = $array['youtube'];
           $data['phone_number']           = $array['phone_number'];
           $data['address']                = $array['address'];
           $data['website']                = $array['website'];
           $data['banner']                 = $array['banner'];
           
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        return json_encode(array("status"=>$status, "data"=>$data)); 
        
        
        
        
    }
    
    
    
   function vprofile_exists($vendor_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select vendor_id from vendor_profile where vendor_id = ?");
        $stmt->bind_param("i", $vendor_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   
   function vendor_profilepic($vendor_id,$profile_image){
        $profile_exists = self::vprofile_exists($vendor_id);
    
          $data = array();
          
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
        $query ="INSERT INTO vendor_profile(vendor_id,profile_image) VALUES (?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("is",$vendor_id,$profile_image);
       $insert =$stmt->execute();
       $stmt->close();
       
       $data['profile_exists'] = 'FALSE';
       
           
       if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
       
       }else{
           
          $query = "UPDATE vendor_profile SET profile_image=? WHERE vendor_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$profile_image,$vendor_id);
           $update =$stmt->execute();
          $stmt->close();
           
          
          $data['profile_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
            
       }
       
       
       return json_encode(array("status"=>$status,"data"=>$data));    
              
              
     
              
          }
          
         
     
   function vendor_Profile($vendor_id,$name,$instagram,$facebook,$twitter,$youtube,$phone_number,$address,$website){
       
        $profile_exists = self::vprofile_exists($vendor_id);
        $data = array();
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if(!$profile_exists){
   
       $query = "INSERT INTO vendor_profile(vendor_id, name, instagram, facebook, twitter, youtube, phone_number, address, website) VALUES (?,?,?,?,?,?,?,?,?)";
       $stmt =  $mysqli->prepare($query);
       $stmt->bind_param("issssssss",$vendor_id,$name,$instagram,$facebook,$twitter,$youtube,$phone_number,$address,$website);
       $insert =$stmt->execute();
       $stmt->close();
       $data['profile_exists'] = 'FALSE';
      if($insert){ $status = "SUCCESS";}else{$status = "FAIL"; }
       
       }else if($profile_exists){  
           $query = "UPDATE vendor_profile SET name=?,instagram=?,facebook=?,twitter=?,youtube=?,phone_number=?,address=?,website=? WHERE vendor_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("ssssssssi",$name,$instagram,$facebook,$twitter,$youtube,$phone_number,$address,$website,$vendor_id);
           $update =$stmt->execute();
          $stmt->close();
          $data['profile_exists'] = 'TRUE';
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
           
              
              
          }
       
       return json_encode(array("status"=>$status,"data"=>$data));
         
       
   } 
 
}


