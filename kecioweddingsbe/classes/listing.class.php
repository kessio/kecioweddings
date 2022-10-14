<?php

namespace NsListing;

class Listing{
    
    
    function count_unpublishedlisting($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as unpublished_status FROM listing WHERE status='Unpublished' AND vendor_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['unpublished_no'] = $array['unpublished_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function count_publishedlisting($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as published_status FROM listing WHERE status='Pending' AND vendor_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['published_no'] = $array['published_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    function count_userapprovedlisting($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as approved_status FROM listing WHERE status='Approved' AND vendor_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['approved_no'] = $array['approved_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    function count_userdeclinedlisting($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT COUNT(status) as declined_status FROM listing WHERE status='Declined' AND vendor_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i", $user_id);
        $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['declined_no'] = $array['declined_status'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    
    
    function display_vcoverpic($listing_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();  
         $query = "SELECT cover_picture FROM listing WHERE listing_id=?";
      $stmt = $mysqli->prepare($query);
        //echo $mysqli->error;die;
        $stmt->bind_param("i",$listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $data = array();
        if($result->num_rows > 0) {
            $status = "SUCESS"; 
             $data['cover_picture'] = $array['cover_picture'];
        } 
            else { $status = "Fail"; }
        
         return json_encode(array("status"=>$status,"data"=>$data));
    }
    
     function user_exists($id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select email from users where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
    function vendor_coverpic($listing_id,$cover_picture){
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          $query = "UPDATE listing SET cover_picture=? WHERE listing_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$cover_picture,$listing_id);
           $update =$stmt->execute();
          $stmt->close();
           if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
         
       return json_encode(array("status"=>$status,"data"=>$data));
      
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
    
    function display_contactinfo($listing_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();   
      $stmt  = $mysqli->prepare("SELECT phone_number,name from vendor_profile WHERE listing_id=? ");
       $stmt->bind_param("i", $listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array  =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        $data   = array();
        if($rows > 0 ){
           
           $data['phone_number']  = $array['phone_number'];
           $data['name']          = $array['name'];
           
           $status = "SUCCESS";
        }else{
            $status = "FAIL";
        }
         return json_encode(array("status"=>$status,"data"=>$data));
    }
    
    function display_request_pricing($listing_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_id,name,phone from messages WHERE listing_id=? ");
       $stmt->bind_param("i", $listing_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('name'=>$array['name'],'listing_id'=>$array['listing_id'],'phone'=>$array['phone']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status,"data"=>$data));
              
    }
    function phone_exists($phone,$listing_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select id from messages where phone = ? AND listing_id=?");
        $stmt->bind_param("si",$phone,$listing_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        if($result->num_rows > 0) {return true; } else { return false; }
           
            
       
   }
    
    function request_pricing($recepient_id,$listing_id,$name,$phone){
     $data = array();
     $phoneexists  = self::phone_exists($phone,$listing_id);
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
     if(!$phoneexists){
     $query = "INSERT INTO messages(recepient_id, listing_id, name, phone)VALUES(?,?,?,?)";
      $stmt = $mysqli->prepare($query);   
      $stmt->bind_param("iiss",$recepient_id,$listing_id,$name,$phone);
      $insert = $stmt->execute();
      $stmt->close();
      $status = "SUCCESS";
     } 
       if($insert){
           
        $mstmt  = $mysqli->prepare("SELECT phone_number,business_name from users WHERE id=?");
       // echo $mstmt;die;
        $mstmt->bind_param("i", $recepient_id);
        $mstmt->execute();
        $result = $mstmt->get_result();
        $marray  =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        $mdata  = array();
        if($rows > 0 ){
           
           $mdata['phone_number']      = $marray['phone_number'];
           $mdata['business_name']     = $marray['business_name']; 
           $mstatus = "SUCCESS";}else{$mstatus = "FAIL";}
       
       } else{ 
         $astmt  = $mysqli->prepare("SELECT phone_number,business_name from users WHERE id=?");
       //echo $astmt;die;
        $astmt->bind_param("i", $recepient_id);
        $astmt->execute();
        $aresult = $astmt->get_result();
        $array  =  $aresult->fetch_assoc();
        $arows   = $aresult->num_rows;
        $adata  = array();
        if($arows > 0 ){
           
           $adata['phone_number']    = $array['phone_number'];
           $adata['business_name']    = $array['business_name']; 
           $astatus = "SUCCESS";
           
        } else{
            $astatus = "FAIL";
            
        } 
           
           
             } 
       
       return json_encode(array("status"=>$status,"data"=>$data,"mstatus"=>$mstatus,"mdata"=>$mdata,"astatus" => $astatus,"adata"=>$adata));
        
    }
    
    
    
    function phone_modalid($listing_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT vendor_id FROM listing WHERE listing_id=?";
       $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("i", $listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array  =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        $data   = array();
        if($rows > 0 ){
           
           $data['vendor_id']      = $array['vendor_id'];
           $status = "SUCCESS";
        }else{
            $status = "FAIL";
        }
         return json_encode(array("status"=>$status,"data"=>$data));
        
    }
    
    //==================== Views ===================================================================================//
    
    function displayviews($listing_id){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $query  = "SELECT whatsapp_views,gallery_views,phone_views,listing_views FROM listing WHERE listing_id=? ";
    $stmt   = $mysqli->prepare($query);
    $stmt->bind_param("i",$listing_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $array  =  $result->fetch_assoc();
    $rows   = $result->num_rows;
  
    $data[] = array('whatsapp_views'=>$array['whatsapp_views'],'gallery_views'=>$array['gallery_views'],'phone_views'=>$array['phone_views'],'listing_views'=>$array['listing_views']);
    if($rows  > 0){ $status = "SUCCESS";  }else{$status = "FAIL";} 
    return json_encode(array("status"=>$status,"data"=>$data)); 
    }
    
    function get_view($listing_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $query  = "SELECT whatsapp_views,gallery_views,phone_views,listing_views FROM listing WHERE listing_id=? ";
    $stmt   = $mysqli->prepare($query);
    $stmt->bind_param("i",$listing_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $array  =  $result->fetch_assoc();
    //$rows   = $result->num_rows;
    $data   = array();
    $data[] = array('whatsapp_views'=>$array['whatsapp_views'],'gallery_views'=>$array['gallery_views'],'phone_views'=>$array['phone_views'],'listing_views'=>$array['listing_views']);
          
      
     return $data; 
      
        
    }
    
    
    function totallistingviews($listing_id,$whatsapp_views,$gallery_views,$phone_views,$listing_views){
    
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
    
      try{ 
          
    $myviews = self::get_view($listing_id);
    for($m = 0; $m < count($myviews); $m++){
      $whatsapp    = $myviews[$m]['whatsapp_views'];  
      $gallery     = $myviews[$m]['gallery_views'];
      $phone       = $myviews[$m]['phone_views'];
      $listings    = $myviews[$m]['listing_views'];
      
    }
    
    if(!empty($whatsapp_views)){
        $new_whatsappviews = $whatsapp + $whatsapp_views;
        $qstr   =  " whatsapp_views ="."'$new_whatsappviews'";
    }
     if(!empty($gallery_views)){
        $new_gallery_views = $gallery + $gallery_views;
       $qstr  .= "gallery_views ="."'$new_gallery_views'";
     } 
     if(!empty($phone_views)){
       $new_phone_views = $phone + $phone_views;
       $qstr  .= "phone_views ="."'$new_phone_views'";
    
     }
      if(!empty($listing_views)){
       $new_listing_views = $listings + $listing_views;
      $qstr  .= "listing_views ="."'$new_listing_views'";
      }
 $qstr  .= " WHERE listing_id ="."'$listing_id'";
 
  $query = "UPDATE listing SET ".$qstr;
  
  $stmt = $mysqli->prepare($query);
  $update = $stmt->execute();
  $stmt->close();
  $data = array();
  
  $error = "";
  
  }catch(\Throwable $e) {
      $error = $e->getMessage();
  }
    
  if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
         
   return json_encode(array("status"=>$status,"data"=>$data));

  
  
        
        
    }
    
    
  //=================================== reviews =============================================================================================================//
   
    function total_reviews($listing_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon(); 
    $query  = "SELECT COUNT(review) as total_reviews FROM reviews WHERE listing_id =?";
    $stmt   = $mysqli->prepare($query);
    $stmt->bind_param("i",$listing_id);
    $stmt->execute();       
    $action = $stmt->get_result();
    $array = $action->fetch_assoc();
    $num_rows = $action->num_rows;
    $data = array();
    if($num_rows > 0) {
        
    $data['total_reviews']   = $array['total_reviews'];
    
    $status = "SUCCESS";
    }else{
        $status = "FAIL";
    }
    return json_encode(array("status"=>$status,"data"=>$data));
        
        
    }
    
     function total_user_reviews($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon(); 
    $query  = "SELECT COUNT(review_id) as total_reviews FROM reviews WHERE vendor_id =?";
    $stmt   = $mysqli->prepare($query);
    $stmt->bind_param("i",$user_id);
    $stmt->execute();       
    $action = $stmt->get_result();
    $array = $action->fetch_assoc();
    $num_rows = $action->num_rows;
    $data = array();
    if($num_rows > 0) {
        
    $data['total_reviews']   = $array['total_reviews'];
    
    $status = "SUCCESS";
    }else{
        $status = "FAIL";
    }
    return json_encode(array("status"=>$status,"data"=>$data));
        
        
    }
    
    function average_review($listing_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();   
    $query ="SELECT AVG(ratings) as average_ratings from reviews WHERE listing_id=?";
    $stmt = $mysqli->prepare($query);
   // echo $mysqli->error;die;
    $stmt->bind_param("i",$listing_id);
    $stmt->execute();       
    $action = $stmt->get_result();
    $array = $action->fetch_assoc();
    $num_rows = $action->num_rows;
    $data = array();
    if($num_rows > 0) {
        
    $data['average_ratings']   = $array['average_ratings'];
    
    $status = "SUCCESS";
    }else{
        $status = "FAIL";
    }
    return json_encode(array("status"=>$status,"data"=>$data));
      }
      
      
    
    function display_vendorreview($listing_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "SELECT review_id,name,email,review,date_sent,ratings,profile_image,feedback,vendor_name,response_date_sent FROM reviews WHERE listing_id=?";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("i", $listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        $data = array();
        
        while($array = $result->fetch_assoc()){
            
           $data[] = array('review_id'=>$array['review_id'],'name'=>$array['name'],'email'=>$array['email'],'review'=>$array['review'],'date_sent'=>$array['date_sent'],'ratings'=>$array['ratings'],'profile_image'=>$array['profile_image'],'feedback'=>$array['feedback'],'vendor_name'=>$array['vendor_name'],'response_date_sent'=>$array['response_date_sent']); 
         
          if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
            
        
    }
     return json_encode(array("status"=>$status,"data"=>$data));
    
    }
    
   
    
    function display_myreview($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "SELECT name,email,review,listing_name,date_sent,ratings,feedback,vendor_name,response_date_sent FROM reviews WHERE user_id=?";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        $data = array();
        
        while($array = $result->fetch_assoc()){
           
           $data[] = array('name'=>$array['name'],'email'=>$array['email'],'review'=>$array['review'],'listing_name'=>$array['listing_name'],'date_sent'=>$array['date_sent'],'ratings'=>$array['ratings'],'feedback'=>$array['feedback'],'vendor_name'=>$array['vendor_name'],'response_date_sent'=>$array['response_date_sent']); 
         
          if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
           
           
           
        }
        
      
        
       return json_encode(array("status"=>$status,"data"=>$data)); 
        
    }
    
    
  
    
    function display_allreview($listing_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "SELECT name,email,review,date_sent,ratings,profile_image,feedback,vendor_name,response_date_sent FROM reviews WHERE listing_id=?";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("i", $listing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        $data = array();
        
        while($array = $result->fetch_assoc()){
            
           $data[] = array('name'=>$array['name'],'email'=>$array['email'],'review'=>$array['review'],'date_sent'=>$array['date_sent'],'ratings'=>$array['ratings'],'profile_image'=>$array['profile_image'],'feedback'=>$array['feedback'],'vendor_name'=>$array['vendor_name'],'response_date_sent'=>$array['response_date_sent']); 
         
          if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
           
           
           
        }
        
      
        
       return json_encode(array("status"=>$status,"data"=>$data)); 
        
    }
    function edit_reviewimage($user_id,$profile_image){
        $review_exists = self::review_exists($user_id);
          $data = array();
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          if($review_exists){
          $query = "UPDATE reviews SET profile_image=? WHERE user_id=?"; 
           $stmt =  $mysqli->prepare($query);
           $stmt->bind_param("si",$profile_image,$user_id);
           $update =$stmt->execute();
          $stmt->close();
          
          $data['review_exists'] = 'TRUE';
          
          if($update){ $status = "SUCCESS";}else{$status = "FAIL"; }
         
       return json_encode(array("status"=>$status,"data"=>$data));
       
    }
  
    }
    
    function add_review($review_id,$listing_id,$user_id,$vendor_id,$name,$email,$review,$listing_name,$ratings,$profile_image,$feedback,$vendor_name){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $review_exists = self::review_idexists($review_id);
       if(!($review_exists)){
        $query = "INSERT INTO reviews (listing_id,user_id,vendor_id,name,email,review,listing_name,ratings,profile_image,date_sent)VALUES(?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("iiissssds", $listing_id,$user_id,$vendor_id,$name,$email,$review,$listing_name,$ratings,$profile_image);
       $insert = $stmt->execute();
       $stmt->close();
       $data = array();
       
       if($insert){
           $data['review_does_not_exists'] = "TRUE";
           $status = "SUCCESS";} else{ $status = "FAIL";  } 
       }else{
         $query = "UPDATE  reviews SET feedback=?,response_date_sent=CURRENT_TIMESTAMP ,vendor_name=? WHERE review_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssi",$feedback,$vendor_name,$review_id);
       $update = $stmt->execute();
       $stmt->close();  
         if($update){
           $data['review_does_not_exists'] = "False";
           $status = "SUCCESS";} else{ $status = "FAIL";  }   
           
       }
       return json_encode(array("status"=>$status,"data"=>$data));
    }
    
    
    function review_idexists($review_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select review_id from reviews where review_id = ?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
    
    
    
    
    function review_exists($user_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select listing_id from reviews where user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        while($array =  $result->fetch_assoc()){            
            $data .= ','.$array['listing_id'];  
        }
        
       // echo $data; return;
    
        $clean_data = explode(',', ltrim($data, ','));  
        return json_encode($clean_data);
        
    }
       

    
    
    function display_all_tents(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();  
       $stmt  = $mysqli->prepare("SELECT all_tents FROM all_tents");
       $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
      
        
       //$data = array();
       
       $data = $array['all_tents'];
       
      $clean_data = explode(',',$data);   
      
      
           return json_encode(array("data"=>$clean_data));
    }
    
    
    function display_all_furniture(){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();  
       $stmt  = $mysqli->prepare("SELECT furniture FROM all_furniture");
       $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
      
        
       //$data = array();
       
       $data = $array['furniture'];
       
      $clean_data = explode(',',$data);   
      
      
           return json_encode(array("data"=>$clean_data));
    }
    
    
    
    function display_listing_list($cat_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $stmt  = $mysqli->prepare("SELECT listing_id,listing_name,about FROM listing WHERE cat_id=? order by listing_name ASC");
       $stmt->bind_param("i", $cat_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
       while($array =  $result->fetch_assoc()){
            
            $data[] = array('listing_id'=>$array['listing_id'],'listing_name'=>$array['listing_name'],'about'=>$array['about']);
            if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       } 
        
        }
    
        return json_encode(array("status"=>$status,"data"=>$data));
        
         
   }
  
    
}