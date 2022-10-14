<?php
namespace NsAddListing;

class AddListing{
    
    function displaygallery($listing_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT gallery FROM listing WHERE listing_id=?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
        $rows   = $result->num_rows;
       $data = array();
       if($rows > 0 ){
       $data['gallery']  = $array['gallery'];
       $status = "SUCCESS";
       }else{
         $status = "Fail";  
       }     
      return json_encode(array("status"=>$status,"data"=>$data));  
    }
    
    
    
    function get_maxListingid(){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT MAX(listing_id) as listing_id FROM listing";
        //echo $mysqli->error;die;
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();
       $array =  $result->fetch_assoc();
       $rows   = $result->num_rows;
        
       $data = array();
            if($rows > 0 ){
                
           $data['listing_id']  = $array['listing_id'];
           $status = "SUCCESS";
          }else{
           
           $status = "FAIL";
       } 
       
   
      return json_encode(array("status"=>$status,"data"=>$data));
       
    }
    
    function delete_listing($listing_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "DELETE FROM listing WHERE listing_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$listing_id);
       $delete = $stmt->execute();
       $stmt->close();
       $data = array();
       if($delete){$status = "SUCCESS" ;} else{$status = "FAIL";}
         
       return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
     function unpublish_listing($listing_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "UPDATE listing SET status = 'Unpublished' WHERE listing_id=? ";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$listing_id);
       $update = $stmt->execute();
       $stmt->close();
       $data = array();
         if($update){$status = "SUCCESS" ;} else{$status = "FAIL";}
         
          return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    function display_payments($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT status from users WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;  
        $data = array();
       
            
            $data[] = array('status'=>$array['status']);
            if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
       
       return $data; 
    }
    
    function publish_listing($listing_id,$user_id){
        $payments = self::display_payments($user_id);
        ///return $payments;
        $mystatus = $payments[0]['status'];
      //  echo $mystatus;
       if($mystatus === 'Active'){
         $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "UPDATE listing SET status = 'Pending' WHERE listing_id=? ";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$listing_id);
       $update = $stmt->execute();
       $stmt->close();
       $data = array();
       $data['status_active'] = "TRUE";
         if($update){$status = "SUCCESS" ;} else{$status = "FAIL";}
         
       }else{
          $data['status_active'] = "FALSE";  
         // $status = "Not Active"; 
       }
          return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
   function select_gallery($listing_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT gallery FROM listing WHERE listing_id=?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
       $oldgallery = $array['gallery'];
       return $oldgallery;
               
        
    }
    
    function add_gallery($listing_id,$gallery){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $oldgal = self::select_gallery($listing_id);
        $newgallery = $oldgal.$gallery;
       //return $newgallery;die;
        $query  = "UPDATE listing SET gallery=?,status='Unpublished' WHERE listing_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si",$newgallery,$listing_id);
        $update = $stmt->execute();
       $stmt->close();
       $data = array();
        if($update){$status = "SUCCESS";} else{$status = "FAIL";}
      // $status = "SUCCESS";
       return json_encode(array("mystatus"=>$status,"data"=>$data));
        
    }
   function delete_gal($listing_id,$gallery){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT gallery FROM listing WHERE listing_id=?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
      $gallery .= ",";
      $gall =  $array['gallery'];
      $replace = str_replace($gallery, "", $gall);
       return $replace;
       
       
   }
   function edit_gallery ($listing_id,$gallery){
         $data = array();
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
         $newgallery = self::delete_gal($listing_id,$gallery);
        $query  = "UPDATE listing SET gallery=? WHERE listing_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si",$newgallery,$listing_id);
       $update = $stmt->execute();
       $stmt->close();
        if($update){$status = "SUCCESS";} else{$status = "FAIL";}
      // $status = "SUCCESS";
       return json_encode(array("mystatus"=>$status,"data"=>$data));

        
   }
   
    
   function display_featuredimg_listing($listing_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT featured_image FROM listing WHERE listing_id=?";
      $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        
       $data = array();
        while($array =  $result->fetch_assoc()){
            
            $data[] = array('featured_image'=>$array['featured_image']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        }
       
        return json_encode(array("status"=>$status, "data"=>$data)); 
         
   } 
    
     function display_pending_listing($vendor_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT listing_id,listing_name,about,subregion,featured_image,gallery,status FROM listing WHERE vendor_id=? AND status = 'Pending'";
      $stmt = $mysqli->prepare($query);
       //echo $mysqli->error;die;
        $stmt->bind_param("i",$vendor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        
       $data = array();
        while($array =  $result->fetch_assoc()){
            
            $data[] = array('listing_id'=>$array['listing_id'],'listing_name'=>$array['listing_name'],'about'=>$array['about'],'subregion'=>$array['subregion'],'featured_image'=>$array['featured_image'],'gallery'=>$array['gallery'],'status'=>$array['status']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        }
       
        return json_encode(array("mystatus"=>$status, "data"=>$data)); 
         
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
    
     function selectSubregionbyid($County_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT town_id,Town_name from constituencies WHERE County_id=?";
      $stmt   = $mysqli->prepare($query);
      $stmt->bind_param("i",$County_id);
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
    
    
   function display_listing($vendor_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT listing_id,listing_name,about,region,subregion,featured_image,gallery,status FROM listing WHERE vendor_id=?";
      $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$vendor_id);
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
   
  
   
   function edit_listing($listing_name,$tents,$facility,$price,$about,$services,$whatsapp,$facebook,$instagram,$listing_id){
      $listing_exist        = self::listing_exists($listing_id);
      $data = array();
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       if($listing_exist){
       $query = "UPDATE listing SET listing_name=?,tents=?,facility=?,price=?,about=?,services=?,whatsapp=?,facebook=?,instagram=?,status='Unpublished' WHERE listing_id=?";
      // echo $mysqli->error;die;
       $stmt = $mysqli->prepare($query);
      $wa_whatsapp = substr_replace($whatsapp, "254",0,1);
       $stmt->bind_param("sssssssssi", $listing_name,$tents,$facility,$price,$about,$services,$wa_whatsapp,$facebook,$instagram,$listing_id);
       $update = $stmt->execute();
       $stmt->close();
       $data['listing_exist'] = "TRUE";
       
         if($update){$status = "SUCCESS" ;} else{$status = "FAIL";}
       
      }else{
       $data['listing_exist'] = "FALSE";
        
      }
           return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
     function listing_exists($listing_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select listing_id from listing where listing_id = ?");
        $stmt->bind_param("i", $listing_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
    
    function listingname_exists($listing_name){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select listing_id from listing where listing_name = ?");
        $stmt->bind_param("s", $listing_name);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   
   
    function add_listing($listing_id,$vendor_id,$listing_name,$cat_id,$subcategory,$tents,$entertainment,$furniture,$facility,$price,$country,$region,$subregion,$about,$services,$amenities,$cover_picture,$facebook,$instagram,$whatsapp,$gallery,$featured){
     $data = array();
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
      
      $query  = "INSERT INTO listing(listing_id,vendor_id,listing_name,cat_id,subcategory,tents,entertainment,furniture,facility,price,country,region,subregion,about,services,amenities,cover_picture,facebook,instagram,whatsapp,gallery,status,featured)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      // echo $mysqli->error;die;
       $stmt   = $mysqli->prepare($query);
       $wa_whatsapp = substr_replace($whatsapp, "254", 0, 1);
        $status = "Unpublished";
       $stmt->bind_param("iisisssssssssssssssssss",$listing_id,$vendor_id,$listing_name,$cat_id,$subcategory,$tents,$entertainment,$furniture,$facility,$price,$country,$region,$subregion,$about,$services,$amenities,$cover_picture,$facebook,$instagram,$wa_whatsapp,$gallery,$status,$featured);
       $insertto = $stmt->execute();
       $stmt->close();
      if($insertto){
           $status = "SUCCESS";
           
       } else{ $status = "FAIL!";  }
       
       return json_encode(array("status"=>$status,"data"=>$data));
    }
    
    
   
     
   function edit_featuredimage($listing_id,$featured_image){
      $data = array();
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "UPDATE listing SET featured_image=? WHERE listing_id=?";
       $stmt   = $mysqli->prepare($query);      
       $stmt->bind_param("si",$featured_image,$listing_id);
       $edit = $stmt->execute();        
       $stmt->close();
        
        if($edit) {$status = "SUCCESS";} else{ $status = "FAIL!";  } 
        return json_encode(array("status"=>$status,"data"=>$data));
       
   } 
    
    
    
    
}