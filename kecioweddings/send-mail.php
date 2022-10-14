<?php
$to = "kecioweddings@gmail.com";
$subject = "My subject";
$message = "Hello world!";



mail($to,$subject,$message);
 $retval = mail ($to,$subject,$message);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
?>
