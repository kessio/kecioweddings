<?php

namespace NsFavourite;

class Favourite{
    
     
    function count_favourites($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "SELECT COUNT(fav_id) as favs FROM favourites WHERE user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['favorites'] = $array['favs'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    function count_hired($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "SELECT COUNT(state) as hired FROM favourites WHERE state ='Hired' AND user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['hired'] = $array['hired'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    
    function delete_favourites($user_id,$listing_id){
      $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "DELETE FROM  favourites WHERE listing_id=? AND user_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("ii",$listing_id,$user_id);
        $delete  =$stmt->execute();
        $stmt->close(); 
        $data = array();
        if($delete){$status = "SUCCESS" ;}else {$status = "FAIL";}
         return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    function group_favourite($user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $category_array = self::get_unique_cat_array($user_id);
      for($c = 0; $c < count($category_array) ; $c++){
       $cat_id = $category_array[$c];
         $query = "SELECT listing_name,listing_id,cat_id,featured_image,notes,state FROM favourites  WHERE  cat_id like ? AND user_id=?";
         $stmt = $mysqli->prepare($query);
         $stmt->bind_param("ii", $cat_id,$user_id);
          //echo $mysqli->error;die;
         $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        
        $response = array();
        while($array = $result->fetch_assoc()){          
           
            $response[] = $array; 
            if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
        }
          $cat_name = self::get_category_by_id($cat_id);
          
         $favourites[] = array('cat_id'=>$cat_id,'category'=>$cat_name, 'records'=>$response);
          
      }
      
      
        return json_encode(array("statuss"=>$status, "favourites"=>$favourites)); 
    }
    
    function get_unique_cat_array($user_id){
        
        $cat_array = self::get_categories_array($user_id);
        $unique_cat = array_unique($cat_array);
        
        return array_values($unique_cat) ;
    }
            
    
    
    function get_categories_array($user_id){
        $mysqli   = $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt     = $mysqli->prepare("select cat_id from favourites WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
       while($array =  $result->fetch_assoc()){            
            $data .= ','.$array['cat_id'];  
           //$data .= ','.self::get_category_by_id($array['cat_id']); 
           //$data[] = array('cat_id'=>$array['cat_id']); 
        }
        
        //return $data;
   
       $clea_data = explode(',', ltrim($data, ','));   
        
      return $clea_data;
        
      
    }
     
    function myfavs($user_id){
      
       $ids_array = self::get_fav_listing_id($user_id);
       
       foreach($ids_array as $list_id){ 
          $details[] = self::favs_listing_details($list_id); 
       }
       
       return json_encode($details); 
        
    }
    
    function  favs_listing_details($list_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_name,cat_id,about FROM listing WHERE  listing_id=? order by cat_id ASC"); 
      $stmt->bind_param('i', $list_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $array  =  $result->fetch_assoc();          
      $data   = array('listing_name'=>$array['listing_name'],'cat_id'=>$array['cat_id'],'category'=>self::get_category_by_id($array['cat_id']),'about'=>$array['about']);
        
        return $data;
       
    }
    
    
    function get_fav_listing_id($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_id from favourites WHERE user_id=? ");
       $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
    
     // $data = array();
       while($array =  $result->fetch_assoc()){            
            $data .= ','.$array['listing_id'];  
        }
        
        //echo $data; return;
    
        $clean_data = explode(',', ltrim($data, ','));   
        
        return $clean_data;
        
    }
    
    
    function display_favourites($user_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_id from favourites WHERE user_id=? ");
       $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $result = $stmt->get_result();
    
     // $data = array();
       while($array =  $result->fetch_assoc()){            
            $data .= ','.$array['listing_id'];  
        }
        
        //echo $data; return;
    
        $clean_data = explode(',', ltrim($data, ','));  
        return json_encode($clean_data);
        
    }
    
    
    function display_allfavourites(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT fav_id,user_id,listing_id,cat_id FROM favourites");
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('fav_id'=>$array['fav_id'],'user_id'=>$array['user_id'],'listing_id'=>$array['listing_id'],'cat_id'=>$array['cat_id'],'category'=>self::get_category_by_id($array['cat_id']));
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status,"data"=>$data));
          
       
    }
    
    
    function favourites($user_id,$listing_id,$cat_id,$listing_name,$featured_image,$notes,$state){
      $data = array();
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $fav_exist = self::fav_exists($user_id,$listing_id);
      if(!($fav_exist)){
      $query = "INSERT INTO favourites(user_id,listing_id,cat_id,listing_name,featured_image,state)VALUES(?,?,?,?,?,?)";
      $stmt = $mysqli->prepare($query); 
      $state = "Evaluating";
      $stmt->bind_param("iiisss",$user_id,$listing_id,$cat_id,$listing_name,$featured_image,$state);
      $insert = $stmt->execute();
      $stmt->close();
       if($insert){$status = "SUCCESS";} else{ $status = "FAIL";  } 
       $data['favorite_exists'] = "False";
      }else{
          $mquery = "UPDATE favourites SET notes=?,state=? WHERE user_id=? AND listing_id=?";
          $stmt  = $mysqli->prepare($mquery);
          $stmt->bind_param("ssii", $notes,$state,$user_id,$listing_id);
          $update = $stmt->execute();
          $stmt->close();
         if($update){$status = "SUCCESS";} else{ $status = "FAIL";  } 
         $data['favorite_exist'] = "TRUE"; 
          
      }
       return json_encode(array("status"=>$status,"data"=>$data));
        
        
    }
     function fav_exists($user_id,$listing_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select user_id,listing_id from favourites where user_id = ? AND listing_id=?");
        $stmt->bind_param("ii", $user_id,$listing_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }   
         
     }
    
    function get_category_by_id($cat_id){
          
        $mysqli     = $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt       = $mysqli->prepare("select name from category where cat_id=?");
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();        
        $result     = $stmt->get_result();        
        $array = $result->fetch_assoc();
        $stmt->close();
        
        return $array['name'];
        
    }
    
     
    
}