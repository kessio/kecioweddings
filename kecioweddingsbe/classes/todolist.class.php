<?php

namespace NsTodolist;

class Todolist{
    
    function update_task_due($todo_id){
       $mysqli  = \NsDbconnect\Dbconnect::dbcon();  
        $query   = "UPDATE todolist SET status=? WHERE status='pending' AND todo_id=? ";
        $stmt    = $mysqli->prepare($query);
        $duedate = self::task_due($todo_id);
       //return $duedate;
        $today = strtotime('today');
        //return $todo_id;
        if($today > strtotime($duedate)){ $statuss = 'due';  } 
        
        $stmt->bind_param("si", $statuss, $todo_id);
        $update =$stmt->execute();
        $stmt->close();
        $data = array();
        if($update){ $status = "SUCCESS";}else{ $status = "FAIL"; }
       
      return json_encode (array("status"=>$status,"data"=>$data));
     
        
    }
    
    function task_due($todo_id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "SELECT duedate from todolist WHERE todo_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("i",$todo_id);
        $stmt ->execute();
        $result = $stmt->get_result();
        $array  = $result->fetch_assoc();
        return $array['duedate'];
        
    }
    
  
    function delete_todo_item($todo_id,$user_id){
        $mysqli  = \NsDbconnect\Dbconnect::dbcon();
        $query   = "DELETE FROM todolist WHERE todo_id=?";
        $stmt    = $mysqli->prepare($query);
        $stmt->bind_param("i",$todo_id);
        $delete  =$stmt->execute();
        $stmt->close();
        
        if($delete){
       
      $qry  = "SELECT COUNT(status) as totals_pending FROM todolist WHERE status = 'pending' AND user_id=?";
       $pstmt  = $mysqli->prepare($qry);
       $pstmt->bind_param("i",$user_id);
       $pstmt->execute();       
       $action = $pstmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $pdata['pending_no'] = $array['totals_pending'];
          
       $pstatus = "SUCCESS";
       }else{$pstatus = "FAIL";}
       
    }
    if($delete){
       
      $myqry  = "SELECT COUNT(status) as totals_complete FROM todolist WHERE status = 'complete' AND user_id=?";
       $cstmt  = $mysqli->prepare($myqry);
       $cstmt->bind_param("i",$user_id);
       $cstmt->execute();       
       $caction = $cstmt->get_result();
       $carray = $caction->fetch_assoc();
       $numrows = $caction->num_rows;
       
       if($numrows > 0) {
       $cdata['complete_no'] = $carray['totals_complete'];
          
       $cstatus= "SUCCESS";
       }else{$cstatus = "FAIL";}
       
    }
    if($delete){
       
      $myquery  = "SELECT COUNT(status) as totals_tasks FROM todolist WHERE user_id=?";
       $astmt  = $mysqli->prepare($myquery);
       $astmt->bind_param("i",$user_id);
       $astmt->execute();       
       $result = $astmt->get_result();
       $aarray = $result->fetch_assoc();
       
       if($numrows > 0) {
       $adata['total_no'] = $aarray['totals_tasks'];
         $astatus= "SUCCESS";
       }else{$astatus = "FAIL";} 
      
    }
    
    return json_encode(array("pstatus"=>$pstatus,"pdata"=>$pdata,"cstatus"=>$cstatus,"cdata"=>$cdata,"astatus"=>$astatus,"adata"=>$adata));
    }
    
    function count_due_task($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT COUNT(status) as totals_due FROM todolist WHERE status= 'due' AND user_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$user_id);
       $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['due_no'] = $array['totals_due'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
    }
    
    
    
    function count_pending_task($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query  = "SELECT COUNT(status) as totals_pending FROM todolist WHERE status LIKE 'pending' AND user_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$user_id);
       $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $data['pending_no'] = $array['totals_pending'];
          
       $status = "SUCCESS";
       }else{$status = "FAIL";}
       
        return json_encode(array("status"=>$status,"data"=>$data));
    }
     function count_tasks($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT COUNT(status)as shaz FROM todolist WHERE user_id=?";
       //echo $mysqli->error;die;
        $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$user_id);
       $stmt->execute();       
       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
           
       $sharon = $array['shaz'];
       
       $status = "SUCCESS";
       }else{$status = "FAIL"; }
       
        
        
        return json_encode(array("status"=>$status,"data"=>$sharon));  
               
         
     }  
     function count_status($user_id){
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "SELECT COUNT(status) as atuta FROM todolist WHERE status ='complete' AND user_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$user_id);
       $stmt->execute();       
       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
       $num_rows = $action->num_rows;
       
       if($num_rows > 0) {
       $atuta = $array['atuta'];
       
       $status = "SUCCESS";
       }else{$status = "FAIL"; }
       
       return json_encode(array("status"=>$status,"data"=>$atuta));  
               
         
     } 
     
     
     function status_update($todo_id,$user_id,$statuss,$datecompleted){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $query  = "UPDATE todolist SET status = ?,datecompleted=? WHERE todo_id = ?";
    $stmt  = $mysqli->prepare($query);
    $stmt->bind_param("ssi",$statuss,$datecompleted,$todo_id);
    $update =$stmt->execute();
    $stmt->close();
    
    if($update){
              
       $query  = "SELECT COUNT(status) as sharon FROM todolist WHERE status = 'pending' AND user_id=?";
       $pstmt  = $mysqli->prepare($query);
       $pstmt->bind_param("i",$user_id);
       $pstmt->execute();       
       $paction = $pstmt->get_result();
       $parray = $paction->fetch_assoc();
      // $num_rows = $action->num_rows;
       $pdata['pending_no'] = $parray['sharon'];
       
       $pstatus = "SUCCESS";
          
          }else{ $pstatus = "FAIL";}
          
          if($update){ 
             
             // $data = array('status'=>$statuss,'todo_id'=>$todo_id,'user_id'=>$user_id);
        $query  = "SELECT COUNT(status) as atuta FROM todolist WHERE status = 'complete' AND user_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$user_id);
       $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
      // $num_rows = $action->num_rows;
       $cdata['complete_no'] = $array['atuta'];
              
              $cstatus = "SUCCESS";
              
          }else{ $cstatus = "FAIL";}
          
          if($update){ 
             
             // $data = array('status'=>$statuss,'todo_id'=>$todo_id,'user_id'=>$user_id);
        $dquery  = "SELECT COUNT(status) as total_due FROM todolist WHERE status = 'due' AND user_id=?";
       $dstmt  = $mysqli->prepare($dquery);
       $dstmt->bind_param("i",$user_id);
       $dstmt->execute();       
       $daction = $dstmt->get_result();
       $darray = $daction->fetch_assoc();
      // $num_rows = $action->num_rows;
       $ddata['due_no'] = $darray['total_due'];
              
              $dstatus = "SUCCESS";
              
          }else{ $dstatus = "FAIL";}
          
          
         return json_encode(array("pstatus"=>$pstatus,"pdata"=>$pdata,"cstatus"=>$cstatus,"cdata"=>$cdata,"dstatus"=>$dstatus,"ddata"=>$ddata));
         
     }
     
   
    function complete_status_update($todo_id,$user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $query  = "UPDATE todolist SET status = ?, datecompleted= NOW() WHERE todo_id = ? and user_id=?";
    $stmt  = $mysqli->prepare($query);
    $statuss = 'complete';
    $stmt->bind_param("sii",$statuss,$todo_id,$user_id);
    $update =$stmt->execute();
    $stmt->close();
        
          if($update){ 
              
             // $data = array('status'=>$statuss,'todo_id'=>$todo_id,'user_id'=>$user_id);
        $query  = "SELECT COUNT(status) as atuta FROM todolist WHERE status = 'complete' AND user_id=?";
       $stmt  = $mysqli->prepare($query);
       $stmt->bind_param("i",$user_id);
       $stmt->execute();       
       $action = $stmt->get_result();
       $array = $action->fetch_assoc();
      // $num_rows = $action->num_rows;
       $data['complete_no'] = $array['atuta'];
              
              $status = "SUCCESS";
              
          }else{ $status = "FAIL";}
          
        return json_encode(array("status"=>$status,"data"=>$data));  
      
    }
    
    function all_task($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "select todo_id,task,status,duedate,datecompleted from todolist where user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i",$user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
        
        while($array = $result->fetch_assoc()){
           //$check_todoid =  array("todo_id"=>$array['todo_id']);
            if($rows > 0){
                
               $data[] = array("todo_id"=>$array['todo_id'],"task"=>$array['task'],"status"=>$array['status'],"duedate"=>$array['duedate']); 
         
             $status = "SUCCESS";
             
         }else{
             $status = "FAIL";
             
         }
        }
       
       
         return json_encode(array("status"=>$status, "data"=>$data)); 
         
    }
    
    
   function due_task($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $query = "select todo_id,task,status,duedate,datecompleted from todolist where status = 'due' AND user_id=?";
      $stmt  = $mysqli->prepare($query);
      $stmt->bind_param("i",$user_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows   = $result->num_rows;
      $data = array();
        
        while($array = $result->fetch_assoc()){
           //$check_todoid =  array("todo_id"=>$array['todo_id']);
            if($rows > 0){
                
               $data[] = array("todo_id"=>$array['todo_id'],"task"=>$array['task'],"status"=>$array['status'],"duedate"=>$array['duedate']); 
         
             $status = "SUCCESS";
             
         }else{
             $status = "FAIL";
             
         }
        }
       
       
         return json_encode(array("mstatus"=>$status, "data"=>$data)); 
         
    } 
    
    
    function pending_task($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "select todo_id,task,status,duedate,datecompleted from todolist where status = 'pending' AND user_id=?";
        $stmt  = $mysqli->prepare($query);
        //echo $mysqli->error;die; //check for errors in te query
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
       $rows   = $result->num_rows;
       $data = array();
        
        while($array = $result->fetch_assoc()){
           //$check_todoid =  array("todo_id"=>$array['todo_id']);
            if($rows > 0){
                
               $data[] = array("todo_id"=>$array['todo_id'],"task"=>$array['task'],"status"=>$array['status'],"duedate"=>$array['duedate']); 
         
             $status = "SUCCESS";
             
         }else{
             $status = "FAIL";
             
         }
        }
       
       
         return json_encode(array("mstatus"=>$status, "data"=>$data)); 
         
    }
    
   
    
     function completed_task($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $startdate = self:: group_complete_startdate($user_id);
      
     for($s = 0; $s < count($startdate); $s ++){
        $month_year = $startdate[$s]['startdate'];
        $query = "select todo_id,task,status,duedate,datecompleted from todolist where status = 'complete' AND startdate like ? ORDER BY datecompleted ASC";
        $stmt  = $mysqli->prepare($query);
        //echo $mysqli->error;die; //check for errors in te query
        $stmt->bind_param("s",$month_year);
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
        
        $todo[] = array('title'=>$month_year, 'records'=>$response);
        
        
     }
     return json_encode(array("statuss"=>$status, "todo"=>$todo)); 
         
    }
    
    
    
    function loop_startdate($user_id){
      $mysqli = \NsDbconnect\Dbconnect::dbcon();
      $startdate = self:: group_startdate($user_id);
      
     for($s = 0; $s < count($startdate); $s ++){
        $month_year = $startdate[$s]['startdate'];
        $query = "select todo_id,task, duedate,taskdate,status,datecompleted from todolist where startdate like ? AND user_id=? ORDER BY sortdate ASC";
        $stmt  = $mysqli->prepare($query);
        //echo $mysqli->error;die; //check for errors in te query
        $stmt->bind_param("si",$month_year,$user_id);
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
        
        $todo[] = array('title'=>$month_year, 'records'=>$response);
        
        
     }
     return json_encode(array("statuss"=>$status, "todo"=>$todo)); 
         
    }
    
    function group_startdate ($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "SELECT startdate FROM todolist WHERE  user_id =? GROUP BY startdate ORDER BY sortdate ASC ";
     $stmt  = $mysqli->prepare($query);
     //echo $mysqli->error;die; //check for errors in te query
     $stmt->bind_param("i",$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     $rows   = $result->num_rows;
     
     $data = array();
     
     while($array = $result->fetch_assoc()){
     $data[]  = array('startdate'=>$array['startdate']);
         if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
     }
      
     return $data; 
    }
    
    function group_complete_startdate ($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
     $query = "SELECT startdate FROM todolist WHERE  user_id =? AND status='complete' GROUP BY startdate ORDER BY sortdate ASC ";
     $stmt  = $mysqli->prepare($query);
     //echo $mysqli->error;die; //check for errors in te query
     $stmt->bind_param("i",$user_id);
     $stmt->execute();
     $result = $stmt->get_result();
     $rows   = $result->num_rows;
     
     $data = array();
     
     while($array = $result->fetch_assoc()){
     $data[]  = array('startdate'=>$array['startdate']);
         if($rows  > 0){
         
             $status = "SUCCESS";
             
         }else{$status = "FAIL";}
     }
      
     return $data; 
    }
    
    
    function display_todolist($user_id){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
        $query = "SELECT task,timeframe,duedate FROM todolist WHERE user_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = $result->num_rows;
        
       $data = array();
        while($array =  $result->fetch_assoc()){
            
            $data[] = array('task'=>$array['task'], 'timeframe'=>$array['timeframe'], 'duedate'=>$array['duedate'] );
        
       
       if($rows > 0 ){
           
       
           $status = "SUCCESS";
           
           
       }else{
           
           $status = "FAIL";
       }
        
        }
        
        return json_encode(array("status"=>$status, "data"=>$data)); 
         
     } 
    
    
   function couple_todolist($user_id,$task,$timeframe,$duedate,$mystatus){
      
   
       $mysqli = \NsDbconnect\Dbconnect::dbcon();
       $query  = "INSERT INTO todolist(user_id,task,timeframe,startdate,taskdate,duedate,sortdate,status) VALUES(?,?,?,?,?,?,?,?)";
       $stmt   = $mysqli->prepare($query);
       $groupstartdate = date("F-Y",strtotime("$duedate-$timeframe"));
       $taskdate = date("d-F-Y",strtotime("$duedate-$timeframe"));
       //$new_duedate = date('Y-m-d', strtotime($duedate));
        $sortdate = strtotime($duedate);
       $stmt->bind_param("isssssis",$user_id,$task,$timeframe,$groupstartdate,$taskdate,$duedate,$sortdate,$mystatus);
       $insert = $stmt->execute();
       $stmt->close();
       $data = array();
       if($insert){
       $status ="SUCCESS";
          
          }else{ $status = "FAIL";}
       
  return json_encode(array("status"=>$status,"data"=>$data)); 
    
}

}