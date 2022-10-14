<?php
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
//echo "i love you";

//echo $file_name;

$coverpic  = $_FILES['featured_image']['name'];
//print_r($mycoverpic);
$mytype = $_FILES['featured_image']['type'];
$mytmp = $_FILES['featured_image']['tmp_name'];
$mysize = $_FILES['featured_image']['size'];
$fileinfo = getimagesize($_FILES["featured_image"]["tmp_name"]);
$width = $fileinfo[0];
$height = $fileinfo[1];



$imgname = $_FILES['file']['name'];
//print_r($imgname);
if(!empty($imgname) && $width >= 800){

$countimg = count($imgname);

for($i =0; $i < $countimg;  $i++){
    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'jpeg', 'jpg');

	    if (in_array($extension, $allowExtn)) {
		$newName = rand() . ".". $extension;
		$uploadFilePath = "../images/realwed/".$newName;
		move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
		$file_name .= $newName .",";	
}
//print_r($file_name);
}


$array_pic = explode('.',$coverpic);
//print_r($array_pic);
$arraypic1 = $array_pic[0];
$arraypic2 = $array_pic[1];
//echo $arraypic2; die;
$last_id = array();

$lastid_data = $little->shaz_curl(json_encode($last_id),\NsLittle\Little::ROUTE.'/get_maxrealwedid.php');
//print_r($lastid_data);die;
$lastid_decode = json_decode($lastid_data);
$mylastid = $lastid_decode->data->realwed_id;
//print_r($mylastid);die;

$realweduser_id = array("user_id"  =>$security->sane_inputs("user_id", "POST"));
$display_realwed =$little->shaz_curl(json_encode($realweduser_id), \NsLittle\Little::ROUTE. '/select_realwed.php');
//print_r($display_realwed);die;
$realwed_decoded = json_decode($display_realwed);
$realwed_id   = $realwed_decoded->data->realwed_id;
//echo $realwed_id;die;
if($realwed_id === "NONE"){

$current_weddingid = $mylastid + 1;
}else{
  $current_weddingid = $realwed_id ; 
}

$coverpicName = $current_weddingid.'-realwedcover'.'.'.$arraypic2;
//print_r($coverpicName);die;
$coverpictarget = "../images/realwed/".$coverpicName;

$realwedding = array(
 "realwed_id"   =>$current_weddingid, 
"user_id"       =>$security->sane_inputs("user_id", "POST"),  
"bride_name"     =>$security->sane_inputs("bride_name", "POST"),
"groom_name"     =>$security->sane_inputs("groom_name", "POST"),
"wedding_date"   =>$security->sane_inputs("wedding_date", "POST"),
"town"           =>$security->sane_inputs("town", "POST"), 
"wedding_theme"  =>$security->sane_inputs("wedding_theme", "POST"),
"featured_image" =>$coverpicName,
"gallery"        =>$file_name
    
    );

   //print_r($realwedding);
$data = $little->shaz_curl(json_encode($realwedding),\NsLittle\Little::ROUTE.'/myrealwedding.php');
move_uploaded_file($mytmp, $coverpictarget);
print_r($data);

}else{
    
   $dimension_status = "ImageSmall";
   
   $dimesion_json = json_encode(array("dimension"=>$dimension_status));
   print_r($dimesion_json); 
    
}