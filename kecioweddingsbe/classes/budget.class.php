<?php

namespace NsBudget;

class Budget{
    
    function budget_total($user_id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "SELECT sum(pending)as pending,sum(actual)as actual,sum(paid)as paid,sum(estimate)as estimate FROM budget_category WHERE user_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $array =  $result->fetch_assoc();
        $rows   = $result->num_rows;
        
       $data = array();
       
       if($rows > 0 ){
           
           $data['pending']  = $array['pending'];
           $data['actual']   = $array['actual'];
           $data['paid']     = $array['paid'];
           $data['estimate'] = $array['estimate'];
           //return $data;
           $status = "SUCCESS";
           
       }else{
           $status = "FAIL";
      }
        
      return json_encode(array("status"=>$status,"data"=>$data));
    }
    
    function pending_total($cat_id,$user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query   = ("SELECT sum(pending)as pending FROM budget_category WHERE cat_id=? AND user_id=?");
       $stmt = $mysqli->prepare($query);
       $stmt->bind_param("ii",$cat_id,$user_id);
       $stmt->execute();
       $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
       return $array['pending'];
       
    }
    
    function paid_total($cat_id,$user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query   = ("SELECT sum(paid)as paid FROM budget_category WHERE cat_id=? AND user_id=?");
       $stmt = $mysqli->prepare($query);
       $stmt->bind_param("ii",$cat_id,$user_id);
       $stmt->execute();
       $result = $stmt->get_result();
       $array   = $result->fetch_assoc();
       
       return $array['paid'];
       
    }
   
    function actual_total($cat_id,$user_id){
          $mysqli = \NsDbconnect\Dbconnect::dbcon();
          $query   = ("SELECT sum(actual)as actual FROM budget_category WHERE cat_id=? AND user_id=?");
           $stmt = $mysqli->prepare($query);
           $stmt->bind_param("ii",$cat_id,$user_id);
           $stmt->execute();
           $result = $stmt->get_result();
           $array = $result->fetch_assoc();
           return $array['actual'];

          }
    
       function estimate_total($cat_id,$user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query   = ("SELECT sum(estimate)as estimate FROM budget_category WHERE cat_id=? AND user_id=?");
       $stmt = $mysqli->prepare($query);
       $stmt->bind_param("ii",$cat_id,$user_id);
       $stmt->execute();
       $result = $stmt->get_result();
       $array  = $result->fetch_assoc();
           
         return $array['estimate']; 
       
    }
    
    function budget_exists($budgetcat_id){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $stmt = $mysqli->prepare("select budgetcat_id from budget_category where budgetcat_id = ?");
        $stmt->bind_param("i", $budgetcat_id);
        $stmt->execute();        
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   
    
    function displaybudget_modal($budgetcat_id){
        
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "SELECT expense,estimate, actual, paid,pending,cat_id FROM budget_category WHERE budgetcat_id=? ";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$budgetcat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        $data   =$result->fetch_assoc() ;
       
       if($rows > 0){
            $status = "SUCCESS";
        }else{
            $status = "FAIL";
        }
       
           return json_encode(array("status"=>$status,"data"=>$data));
       
    }
    
    
    function delete_budget_category($cat_id){
     $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "DELETE FROM budget_category WHERE cat_id=?";
        $stmt    = $mysqli->prepare($query);   
        $stmt->bind_param("i",$cat_id);
        $delete  =$stmt->execute();
        $stmt->close();
        $data = array();
        
        if($delete){$status = "SUCCESS";}else{$status = "FAIL";}
        
        return json_encode(array("status"=>$status,"data"=>$data));
        
        
        
    }
    
    
    function delete_budget_item($budgetcat_id,$cat_id,$user_id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "DELETE FROM budget_category WHERE budgetcat_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("i",$budgetcat_id);
        $delete  =$stmt->execute();
        $stmt->close();
       
        
        if($delete){
            $sql = "SELECT budgetcat_id, sum(estimate)as estimate,sum(actual)as actual,sum(paid)as paid, sum(pending)as pending FROM budget_category WHERE cat_id=? AND user_id=?";
            $dstmt = $mysqli->prepare($sql);
            $dstmt->bind_param("ii",$cat_id,$user_id);
            $dstmt->execute();
            $result = $dstmt->get_result();
            $array =  $result->fetch_assoc();
            $rows = $result->num_rows;
            $data = array(); 
            $check = $array['budgetcat_id'];
            
            if($rows > 0 && !empty($check)){
            
            $data['estimate'] = number_format($array['estimate']);
          //$data['estimate'] = number_format(round($array['estimate'],2),0);
            $data['actual']   = number_format($array['actual']);
            $data["paid"]     = number_format($array["paid"]);
            $data["pending"]  = number_format($array["pending"]);
            $status = "SUCCESS";
             
            }
            
            else{
            
                $status = "FAIL";
                
            }
            
            if($delete){
                $mysql = "SELECT sum(estimate)as total_estimate,sum(actual)as total_actual,sum(paid)as total_paid,sum(pending)as total_pending FROM budget_category WHERE user_id=?";
                $tstmt = $mysqli->prepare($mysql);
                $tstmt->bind_param("i", $user_id);
                $tstmt->execute();
                $tresult = $tstmt->get_result();
                $arrayy   = $tresult->fetch_assoc();
                $dataa   = array();
                
                $dataa['testimate'] = number_format($arrayy['total_estimate']);
                $dataa['tactual']   = number_format($arrayy['total_actual']);
                $dataa['tpaid']     = number_format($arrayy['total_paid']);
                $dataa['tpending']  =  number_format($arrayy['total_pending']);
                
                //$statuss == "SUCCESS";
                
            }
            
            
        }
           
       return json_encode(array("status"=>$status,"data"=>$data,"dataa"=>$dataa));
            
      
    }
    
    function get_category(){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query = "SELECT cat_id,name FROM category";
       $stmt  = $mysqli->prepare($query);
       $stmt->execute();
       $result = $stmt->get_result();
       $rows = $result->num_rows;
       $data = array();
       
       while($array = $result->fetch_assoc() ){
           
         $data[] = array('cat_id'=>$array['cat_id'],'name'=>$array['name']); 
         
         if($rows > 0){
               $status = "SUCCESS";
           }else{
               $status = "FAIL";
           }
         
       }
       
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
   
   
    function display_budgetcategory($user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $categoryarray = self::unique_cat_array($user_id);
       
       for($ct = 0; $ct <count($categoryarray); $ct++){
        $cat_id = $categoryarray[$ct];
       $query  = "SELECT budgetcat_id,expense,estimate,actual,paid,pending FROM budget_category WHERE cat_id like ? AND user_id=? ORDER BY cat_id DESC";       
       $stmt   = $mysqli->prepare($query);
       //echo $mysqli -> error;die;
       $stmt->bind_param("ii",$cat_id,$user_id);
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
        
        $category_name = self::get_category_by_id($cat_id);
        $estimate_total = self::estimate_total($cat_id,$user_id);
        $actual_total = self::actual_total($cat_id,$user_id);
        $paid_total = self::paid_total($cat_id,$user_id);
        $pending_total = self::pending_total($cat_id,$user_id);
        
        $budget_group[] = array('category'=>$category_name,'cat_id'=>$cat_id, 'records'=>$response,'estimate_total'=>$estimate_total,'actual_total'=>$actual_total,'paid_total'=>$paid_total,'pending_total'=>$pending_total);
        
           
           } 
        
          return json_encode(array("statuss"=>$status, "budget_group"=>$budget_group)); 
     
       }
       
        function unique_cat_array($user_id){
        
        $budget_catid = self::budget_categoryid($user_id);
        $unique_cat = array_unique($budget_catid);
        
        return array_values($unique_cat) ;
    }
      
       
   function budget_categoryid($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "SELECT cat_id FROM  budget_category WHERE user_id =? ";
     $stmt  = $mysqli->prepare($query);
     //echo $mysqli->error;die; //check for errors in te query
     $stmt->bind_param("i",$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     //$rows   = $result->num_rows;
     
    /// $data = array();
     
     while($array =  $result->fetch_assoc()){            
            $data .= ','.$array['cat_id'];  
          // $data .= ','.self::get_category_by_id($array['cat_id']); 
           //$data[] = array('cat_id'=>$array['cat_id']); 
        }
        
        //return $data;
    
       $clea_data = explode(',', ltrim($data, ','));   
        
      return $clea_data;
    } 
       
    function update_budget($budgetcat_id,$user_id,$cat_id,$estimate,$actual,$paid){
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "UPDATE budget_category SET estimate=?,actual=?,paid=?,pending=? WHERE budgetcat_id=? and user_id=?";      
        $stmt   = $mysqli->prepare($query);
        $pending = $actual - $paid;
        $stmt->bind_param("ddddii", $estimate,$actual,$paid,$pending,$budgetcat_id,$user_id);
        $update =$stmt->execute();
        //$rows  = $stmt->num_rows;
        $stmt->close();
       
        if($update){
            $sql = "SELECT estimate,actual,paid,pending FROM budget_category WHERE budgetcat_id=?";
            $dstmt = $mysqli->prepare($sql);
            $dstmt->bind_param("i",$budgetcat_id);
            $dstmt->execute();
            $result = $dstmt->get_result();
            $array =  $result->fetch_assoc();
            $rows = $result->num_rows;
            $data = array(); 
            
            if($rows > 0){
            
            $data['estimate'] = number_format($array['estimate']);
          //$data['estimate'] = number_format(round($array['estimate'],2),0);
            $data['actual']   = number_format($array['actual']);
            $data["paid"]     = number_format($array["paid"]);
            $data["pending"]  = number_format($array["pending"]);
            $status = "SUCCESS";
            
            }   
        }
        
        if($update){
            
            $sql = "SELECT budgetcat_id, sum(estimate)as estimate,sum(actual)as actual,sum(paid)as paid, sum(pending)as pending FROM budget_category WHERE cat_id=?";
            $sstmt = $mysqli->prepare($sql);
            $sstmt->bind_param("i",$cat_id);
            $sstmt->execute();
            $sresult = $sstmt->get_result();
            $sarray =  $sresult->fetch_assoc();
            $srows = $sresult->num_rows;
            $sdata = array(); 
            $check = $sarray['budgetcat_id'];
            
            if($srows > 0 && !empty($check)){
            
            $sdata['estimate'] = number_format($sarray['estimate']);
          //$data['estimate'] = number_format(round($array['estimate'],2),0);
            $sdata['actual']   = number_format($sarray['actual']);
            $sdata["paid"]     = number_format($sarray["paid"]);
            $sdata["pending"]  = number_format($sarray["pending"]);
            $sstatus = "SUCCESS";
             
            }
        }
        
        if($update){
               $mysql = "SELECT sum(estimate)as total_estimate,sum(actual)as total_actual,sum(paid)as total_paid,sum(pending)as total_pending FROM budget_category WHERE user_id=?";
                $tstmt = $mysqli->prepare($mysql);
                $tstmt->bind_param("i", $user_id);
                $tstmt->execute();
                $tresult = $tstmt->get_result();
                $arrayy   = $tresult->fetch_assoc();
                $tdata   = array();
                
                $tdata['testimate'] = number_format($arrayy['total_estimate']);
                $tdata['tactual']   = number_format($arrayy['total_actual']);
                $tdata['tpaid']     = number_format($arrayy['total_paid']);
                $tdata['tpending']  =  number_format($arrayy['total_pending']);
                $tstatus = "SUCCESS";
            
        }
        
        
      return json_encode(array("status"=>$status,"data"=>$data,"sstatus"=>$sstatus,"sdata"=>$sdata,"tstatus"=>$tstatus,"tdata"=>$tdata));
        
    } 
    
       
    function add_budget($user_id,$cat_id,$expense,$estimate,$actual,$paid){
        
         $data = array();
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "INSERT INTO budget_category(user_id,cat_id,expense,estimate,actual,paid,pending) VALUES(?,?,?,?,?,?,?)";
        $stmt   = $mysqli->prepare($query);
        $pending = ($actual - $paid);
        $stmt->bind_param("iisdddd",$user_id,$cat_id,$expense,$estimate,$actual,$paid,$pending);
        $update = $stmt->execute();
        $stmt->close();
         
        if($update){$status = "SUCCESS";}else{$status = "FAIL";}
        
        if($update){
            
      $query = "SELECT budgetcat_id,expense,estimate,actual,paid,pending FROM budget_category WHERE cat_id=? and user_id=? ORDER BY budgetcat_id DESC" ;
      $stmt   =$mysqli->prepare($query);
      $stmt->bind_param("ii",$cat_id,$user_id);
      $stmt->execute();
      $result = $stmt->get_result();     
     // $rows   = $result->num_rows;
      
      $response = array();
        
        while($array = $result->fetch_assoc()){          
           
            $response[] = $array; 
            
        }
      
      
       $category_name = self::get_category_by_id($cat_id);
       
       $data [] = array('category_name'=>$category_name,'cat_id'=>$cat_id,'records'=>$response);
       
       
        }
        
        
      return json_encode(array("status"=>$status,"data"=>$data));
        
    } 
    
    function budget_category($user_id,$category){
        $data = array();
        $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query  = "INSERT INTO  budget_category (user_id,category) VALUES(?,?)";
        $stmt   = $mysqli->prepare($query);
        $stmt->bind_param("is",$user_id,$category);
        $insert = $stmt->execute();
        $stmt->close();
        
       if($insert){$status = "SUCCESS";}else{$status = "FAIL"; }
        
        return json_encode(array("status"=>$status,"data"=>$data)); // convert array into json string  
   
    }
    
}
