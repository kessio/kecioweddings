<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
//echo "i love you";



$imgname = $_FILES['file']['name'];
//print_r($imgname);die;
if(!empty($imgname)){

$countimg = count($imgname);
//echo $countimg;die;

for($i =0; $i < $countimg;  $i++){
    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'gif', 'jpg','jpeg');

	    if (in_array($extension, $allowExtn)) {
		$newName = rand() . ".". $extension;
               
                $uploadFilePath = "../images/website_gallery/".$newName;
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
              //  print_r($uploadFilePath);
		$file_name .= $newName .",";
              //  print_r($file_name);
}

}

//print_r($file_name);die;

$mygal = array(
    "webgallery"  =>$file_name,
     "user_id"    =>$security->sane_inputs("user_id", "POST")
);
//print_r($mygal);die;

$webgallery = $little->shaz_curl(json_encode($mygal), \NsLittle\Little::ROUTE.'/website_gallery.php');
print_r($webgallery);

}
