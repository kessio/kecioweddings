<?php

namespace NsRecoverPassword;

class RecoverPassword{
    
    function recovery_change_pass($email,$password){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();    
     $stmt = $mysqli->prepare("UPDATE users SET password=? WHERE email =?");  
     $md5pswd   = md5($password);
     $stmt->bind_param("ss",$md5pswd,$email);
    $update = $stmt->execute();
     $stmt->close();
     $data = array();
    if($update){
        $status = "SUCCESS"; 
    }else{
        $status = "FAIL";
    }
    return json_encode(array("status"=>$status, "data"=>$data));   
        
        
    }
    
    
    function keycode($recovery_code,$email){
     $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $stmt = $mysqli->prepare("select * from users where recovery_code = ? AND email=?");
    $stmt->bind_param("ss", $recovery_code,$email);
    $stmt->execute();        
    $result = $stmt->get_result();
     $array =  $result->fetch_assoc();
     $data = array();
    if($result->num_rows > 0) { 
      $data['email'] = $array['email'] ; 
      $status  = "SUCCESS";
      } else { 
      $status = "FAIL"; }  
      
      return json_encode(array("status"=>$status, "data"=>$data)); 
    }

 function user_exists($to){
    $mysqli = \NsDbconnect\Dbconnect::dbcon();
    $stmt = $mysqli->prepare("select id from users where email = ?");
    $stmt->bind_param("s", $to);
    $stmt->execute();        
    $result = $stmt->get_result();

    if($result->num_rows > 0) { return true; } else { return false; }
       
   }
   
 function send_mail($to,$recovery_code){
$headers  = 'From:info@ajaxcash.com'; 
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$subject    = "Password Recovery - KecioWeddings";
$otp_message = '
    <html>
    <head>
        <title>Reset Password</title>
    </head>
    <body>
        <h1>Code: '. $recovery_code.'</h1>


<br><br>
Thank you.<br>
--<br>
KecioWeddings Team
</p>
    </body>
    </html>';

return mail($to, $subject, $otp_message, $headers);
   
       
   }
    
function recover_password($to){
    $user_exists = self::user_exists($to);
    $data          = array(); 
    $mailsent = array();
     $mysqli        = \NsDbconnect\Dbconnect::dbcon();
    if($user_exists){
    $query         = "UPDATE users SET recovery_code =? WHERE email=?"; 
    $stmt          = $mysqli->prepare($query);
    $recovery_code = rand(1231,7879);
    $stmt->bind_param("ss",$recovery_code,$to);
    $stmt->execute();
    $stmt->close();
    $data['Email_Exists'] = "YES";
    $status         = "SUCCESS";
    $send_mail      = self::send_mail($to,$recovery_code);
    if($send_mail){
       
        $mailsent['Email_sent'] = "TRUE";
    }else{
     $mailsent['Email_sent'] = "FALSE";   
    }
    
    }else{
     $data['Email_Exists'] = "NO"; 
     $status = "FAIL";
     $mailsent['Email_sent'] = "FALSE";
    }
    return json_encode(array("status"=>$status,"data"=>$data,"mailsent"=>$mailsent));

       } 
    
    
    
}