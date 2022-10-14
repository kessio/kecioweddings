<?php
 
namespace NsCategory;

class Category{
    
    
     function get_category_name($cat_id){
          
        $mysqli     = $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt       = $mysqli->prepare("select name from category where cat_id=?");
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();        
        $result     = $stmt->get_result();        
        $array = $result->fetch_assoc();
        $stmt->close();
        $data = array();
        
        $data['name']  =  $array['name'];
        $status = "SUCCESS";
         return json_encode(array("status"=>$status, "data"=>$data)); 
        
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
    
    function get_countyname_by_id($id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT county_name from counties where county_id = '". $id ."'";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();       
       $resp = $result->fetch_assoc();
       return $resp['county_name'];
        
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
    
    
    
    function single_suppliers_listing($listing_id){
    $mysqli    = \NsDbconnect\Dbconnect::dbcon();
    $stmt      = $mysqli->prepare("SELECT vendor_id, listing_name,cat_id,subcategory,tents,facility,entertainment,furniture,price,about,country,region,subregion,services,amenities,facebook,instagram,whatsapp,gallery,cover_picture FROM listing WHERE listing_id=?");
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $result   = $stmt->get_result();
    $rows     = $result->num_rows;
    $data     = array();
    while($array =  $result->fetch_assoc()){
    $data[] = array('vendor_id'=>$array['vendor_id'],'listing_name'=>$array['listing_name'],'subcategory'=>$array['subcategory'],'cat_id'=>$array['cat_id'],'category'=>self::get_category_by_id($array['cat_id']),'entertainment'=>$array['entertainment'],'tents'=>$array['tents'],'facility'=>$array['facility'],'furniture'=>$array['furniture'],'price'=>$array['price'], 'about'=>$array['about'],'country'=>$array['country'],'region'=>$array['region'],'county_name'=>self::get_countyname_by_id($array['region']),'subregion'=>$array['subregion'],'town_name'=>self::get_subregionname_by_id($array['subregion']),'services'=>$array['services'],'amenities'=>$array['amenities'],'facebook'=>$array['facebook'],'instagram'=>$array['instagram'],'whatsapp'=>$array['whatsapp'],'gallery'=>$array['gallery'],'cover_picture'=>$array['cover_picture']);
    if($rows > 0 ){
    $status = "SUCCESS";

   }else{

       $status = "FAIL";
   } 

    }
    
        return json_encode(array("status"=>$status, "data"=>$data)); 
         
   }
   
    function display_supplier_listing($cat_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_id,listing_name,featured_image,price,about FROM listing WHERE cat_id=?  order by listing_name ASC");
      $stmt->bind_param("i", $cat_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
      while($array =  $result->fetch_assoc()){
            
        $data[] = array('listing_id'=>$array['listing_id'],'listing_name'=>$array['listing_name'],'featured_image'=>$array['featured_image'],'price'=>$array['price'], 'about'=>$array['about']);
        if($rows > 0 ){


       $status = "SUCCESS";


    }else{

       $status = "FAIL";
    } 

    }
    
        return json_encode(array("status"=>$status, "data"=>$data)); 
         
   }
    
    
   function display_category(){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT cat_id,name,caption,cover_pic,profile_pic FROM category";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();
       $rows = $result->num_rows;
       $data = array();
       
       while($array = $result->fetch_assoc() ){
           
         $data[] = array('cat_id'=>$array['cat_id'],'name'=>$array['name'],'caption'=>$array['caption'],'cover_pic'=>$array['cover_pic'],'profile_pic'=>$array['profile_pic']); 
         
         if($rows > 0){
               $status = "SUCCESS";
           }else{
               $status = "FAIL";
           }
         
         
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
       
   } 
    
    function category_details($cat_id){
         $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT name,caption,cover_pic,profile_pic FROM category WHERE cat_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i", $cat_id);
       $stmt->execute();
       $result = $stmt->get_result();
       $rows = $result->num_rows;
       $data = array();
       
       while($array = $result->fetch_assoc() ){
           
         $data[] = array('name'=>$array['name'],'caption'=>$array['caption'],'cover_pic'=>$array['cover_pic'],'profile_pic'=>$array['profile_pic']); 
         
         if($rows > 0){
               $status = "SUCCESS";
           }else{
               $status = "FAIL";
           }
         
         
       }
       
       return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
}