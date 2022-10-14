<?php 
/**
 *  Admin can change only those options
 *  ----------------------------------- 
 */
$to 		= 'mhitesh2212@gmail.com';

$message    = '';

foreach( $_GET as $key => $value ){

	$message .=  $key .' : '.stripslashes( $value ) ."\r\n\n";
}

$subject  	= isset( $_GET['subject'] ) && $_GET['subject'] !== '' ? $_GET['subject'] : 'Your Subject';

$mail 		= @mail($to, $subject, $message, "From:".$_GET['email'] );

if($mail) {

	header("Location:index.php");

} else {

	echo 'Message could not be sent!';
}

?>