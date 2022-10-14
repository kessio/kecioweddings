<?php
namespace NsRealWedding;

class RealWedding{
    
    function delete_gal($user_id,$gallery){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT gallery FROM real_wedding WHERE user_id=?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
      $gallery .= ",";
      $gall =  $array['gallery'];
      $replace = str_replace($gallery, "", $gall);
       return $replace;
       
       
   }
   function edit_realwedgallery ($user_id,$gallery){
         $data = array();
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
         $newgallery = self::delete_gal($user_id,$gallery);
        $query  = "UPDATE real_wedding SET gallery=? WHERE user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si",$newgallery,$user_id);
       $update = $stmt->execute();
       $stmt->close();
        if($update){$status = "SUCCESS";} else{$status = "FAIL";}
      // $status = "SUCCESS";
       return json_encode(array("mystatus"=>$status,"data"=>$data));

        
   }
    
     function dispaly_realwed(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT realwed_id, user_id, bride_name, groom_name, town, wedding_theme, gallery, featured_image, wedding_date FROM real_wedding";
      $stmt   = $mysqli->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
       $data = array();
        while($array =  $result->fetch_assoc()){
        $data[] = array('user_id'=>$array['user_id'],'realwed_id'=>$array['realwed_id'],'bride_name'=>$array['bride_name'],'groom_name'=>$array['groom_name'],'town'=>$array['town'],'wedding_theme'=>$array['wedding_theme'],'gallery'=>$array['gallery'],'featured_image'=>$array['featured_image'],'wedding_date'=>$array['wedding_date']);
            if($rows > 0 ){
            $status = "SUCCESS";
           
       }else{
           
           $status = "FAIL";
       } 
             }
       
      return json_encode(array("status"=>$status,"data"=>$data));
        
        
    }
    
    
    function select_realwed($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT user_id,realwed_id, bride_name, groom_name, town, wedding_theme, gallery, featured_image, wedding_date FROM real_wedding WHERE user_id=?";
      //echo $query;die;
      $stmt   = $mysqli->prepare($query);
      $stmt->bind_param("i",$user_id);
      $stmt->execute();
      $result = $stmt->get_result();
       $array =  $result->fetch_assoc();
       $rows   = $result->num_rows;
        
       $data = array();
            if($rows > 0 ){
                
           $data['realwed_id']    = $array['realwed_id'];
           $data['user_id']       = $array['user_id'];
           $data['bride_name']    = $array['bride_name'];
           $data['groom_name']    = $array['groom_name'];
           $data['town']          = $array['town'];
           $data['wedding_theme'] = $array['wedding_theme'];
           $data['gallery']       = $array['gallery'];
           $data['featured_image'] = $array['featured_image'];
           $data['wedding_date']   = $array['wedding_date'];
           $status = "SUCCESS";
          }else{
           $data["realwed_id"] = "NONE";
           $status = "FAIL";
       } 
       
      return json_encode(array("status"=>$status,"data"=>$data));
        
        
    }
    
     function get_maxrealwedid(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT MAX(realwed_id) as realwed_id FROM real_wedding";
        //echo $mysqli->error;die;
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();
       $array =  $result->fetch_assoc();
       $rows   = $result->num_rows;
        
       $data = array();
            if($rows > 0 ){
                
           $data['realwed_id']  = $array['realwed_id'];
           $status = "SUCCESS";
          }else{
           
           $status = "FAIL";
       } 
       
   
      return json_encode(array("status"=>$status,"data"=>$data));
       
    }
    
    
 
 function myrealwedding($realwed_id,$user_id,$bride_name,$groom_name,$wedding_date,$town,$wedding_theme,$gallery,$featured_image){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
   $realweddingexist = self::realwedding_exists($user_id);
     if(!($realweddingexist)){ 
    $query  = "INSERT INTO real_wedding (realwed_id,user_id, bride_name, groom_name, town, wedding_theme,  gallery, featured_image, wedding_date) VALUES (?,?,?,?,?,?,?,?,?)";
     $stmt  = $mysqli->prepare($query);
     $stmt->bind_param("iisssssss",$realwed_id,$user_id,$bride_name,$groom_name,$town,$wedding_theme,$gallery,$featured_image,$wedding_date);
     $insert = $stmt->execute();        
     $stmt->close();
     $data = array();
     $data['real_data_exist'] = "FALSE";
     if($insert) {$status = "SUCCESS";} else{ $status = "FAIL!";  } 
     }else{
    $oldgal = self::select_gallery($user_id);
     $newgallery = $oldgal.$gallery;   
     $equery  = "UPDATE real_wedding SET bride_name=?, groom_name=?, town=?, wedding_theme=?,  gallery=?, featured_image=?, wedding_date=? WHERE user_id=?";
     $estmt  = $mysqli->prepare($equery);
     $estmt->bind_param("sssssssi",$bride_name,$groom_name,$town,$wedding_theme,$newgallery,$featured_image,$wedding_date,$user_id);
     $update = $estmt->execute();        
     $estmt->close();
     $data['real_data_exist'] = "TRue";  
       if($update) {$status = "SUCCESS";} else{ $status = "FAIL!";  }    
     }
      return json_encode(array("status"=>$status,"data"=>$data));
     
     
 }
 
 function select_gallery($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT gallery FROM real_wedding WHERE user_id=?";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i",$user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $array   = $result->fetch_assoc();
      $oldgallery = $array['gallery'];
      return $oldgallery;
               
        
    }
 
   function realwedding_exists($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select user_id from real_wedding where user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }   
    
    
    
}
