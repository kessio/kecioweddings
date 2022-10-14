<?php

namespace NsFilterListing;

class FilterListing{
    
   function search_by_cat_location($cat_id,$region,$subregion){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_id,listing_name,about,featured_image FROM listing WHERE cat_id=? AND region=? AND subregion=? order by listing_name ASC");
      $stmt->bind_param("iii",$cat_id,$region,$subregion);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('listing_id'=>$array['listing_id'],'listing_name'=>$array['listing_name'],'about'=>$array['about'],'featured_image'=>$array['featured_image']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status,"data"=>$data));
        
   }
    
   function get_phonenumberby_id($id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT phone_number from users where id= '". $id ."'";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();       
       $resp = $result->fetch_assoc();
       return $resp['phone_number'];
       
   }
   
    function get_countyname_by_id($id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT county_name from counties where county_id = '". $id ."'";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();       
       $resp = $result->fetch_assoc();
       return $resp['county_name'];
        
    }
    
     function loop_location(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $county_id = self:: group_location();
      
     for($s = 0; $s < count($county_id); $s ++){
        $id  = $county_id[$s]['county_id'];
        $query = "SELECT `town_id`, `County_id`, `Town_name` FROM `constituencies` WHERE County_id LIKE? ORDER BY town_id ASC";
        $stmt  = $mysqli->prepare($query);
        //echo $mysqli->error;die; //check for errors in te query
        $stmt->bind_param("i",$id);
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
        //$county_name = self::get_countyname_by_id($id);
        
        
        $todo[] = array('county_id'=>$id,'county_name'=>self::get_countyname_by_id($id), 'records'=>$response);
        
        
     }
     return json_encode(array("statuss"=>$status, "todo"=>$todo)); 
         
    }
    
    function group_location(){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "SELECT county_id FROM constituencies GROUP BY county_id ORDER BY county_id";
     $stmt  = $mysqli->prepare($query);
     //echo $mysqli->error;die; //check for errors in te query
     $stmt->execute();
     $result = $stmt->get_result();
     $rows   = $result->num_rows;
     
     $data = array();
     
     while($array = $result->fetch_assoc()){
     $data[]  = array('county_id'=>$array['county_id']);
         if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
     }
      
     return $data; 
    }
    
    
    
    function filterlocation(){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT County_id,town_id,Town_name FROM `constituencies` order by `County_id`, `Town_name` ASC";
       $stmt  = $mysqli->prepare($query);
        $stmt->execute();
       $result = $stmt->get_result();
        $rows = $result->num_rows;
       $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('County_id'=>$array['County_id'], 'County_name'=>$this->get_countyname_by_id($array['County_id']),'town_id'=>$array['town_id'] ,'Town_name'=>$array['Town_name']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
       }
   
      return json_encode(array("status"=>$status,"data"=>$data));
       }
   
    
    function selectCounties(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT county_id,county_name from counties";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();
       $rows = $result->num_rows;
       $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('county_id'=>$array['county_id'],'county_name'=>$array['county_name']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status,"data"=>$data));
                
        
    }
    
     function selectSubregion(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT town_id,Town_name from constituencies";
      $stmt   = $mysqli->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('town_id'=>$array['town_id'],'Town_name'=>$array['Town_name']);
            if($rows > 0 ){
              $status = "SUCCESS";
        }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status,"data"=>$data));
       
    }
   
    function get_subregionname_by_id($id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT Town_name from constituencies where town_id = '". $id ."'";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();       
       $resp = $result->fetch_assoc();
       return $resp['Town_name'];
        
    }
    
    
    
  function filterlist($cat_id,$subcategory,$region,$subregion,$amenities,$tents,$entertaiment,$furniture){
 $mysqli = \NsDbconnect\Dbconnect::dbcon();
 $qstr = "WHERE listing_id != '' AND status ='Approved' "; 
     
 
 if(!empty($cat_id)){
        
        $qstr .= " and cat_id="."'$cat_id'";
        
    }
    if(!empty($subcategory)){
        
        $qstr .= " and subcategory="."'$subcategory'";
        
    }
    
    if(!empty($region)){
        
        $qstr .= " and region="."'$region'";
        
    }
     if(!empty($subregion)){
        
        $qstr .= " and subregion="."'$subregion'";
        
    }
    if(!empty($amenities)){
        
        $qstr .= " and amenities="."'$amenities'";
        
    }
    if(!empty($tents)){
        
        $qstr .= "and tents="."'$tents'";
        
    }
    
     if(!empty($entertaiment)){
        
        $qstr .= "and entertaiment="."'$entertaiment'";
        
    }
    
     if(!empty($furniture)){
        
        $qstr .= "and furniture="."'$furniture'";
        
    }
  
 $query = ("select cat_id,vendor_id, listing_id, listing_name, price, about, region, subregion,featured_image,whatsapp,status from listing ".$qstr);
// echo $query;die;
   $stmt = $mysqli->prepare($query);
    //echo $mysqli->error;die;
     $stmt->execute();
    $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
       while($array =  $result->fetch_assoc()){
            
       $data[] = array('cat_id'=>$array['cat_id'],'vendor_id'=>$array['vendor_id'],'listing_id'=>$array['listing_id'],'listing_name'=>$array['listing_name'],'price'=>$array['price'], 'about'=>$array['about'],'region'=>$array['region'],'County_name'=>$this->get_countyname_by_id($array['region']),'subregion'=>$array['subregion'],'Town_name'=>self::get_subregionname_by_id($array['subregion']),'featured_image'=>$array['featured_image'],'whatsapp'=>$array['whatsapp'],'phone_number'=>self::get_phonenumberby_id($array['vendor_id']),'status'=>$array['status']);
       if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status, "data"=>$data)); 
       
    } 
    
    
}
