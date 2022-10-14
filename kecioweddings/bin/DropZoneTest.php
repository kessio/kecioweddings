<?php

$imgname =$_FILES['file']['name'];

$countimg = count($imgname);

for($i =0; $i < $countimg;  $i++){
    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'jpeg', 'jpg');

	    if (in_array($extension, $allowExtn)) {
		$newName = rand() . ".". $extension;
		$uploadFilePath = "../images/vendor_listings/".$newName;
		move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
		$file_name = $newName ." , ";	
}
//print_r($file_name);
}

$data = array(
    "customer" =>filter_input(INPUT_POST, 'customer', FILTER_SANITIZE_SPECIAL_CHARS),
     "amenity" =>filter_input(INPUT_POST, 'amenity',  FILTER_SANITIZE_SPECIAL_CHARS)
);

print_r($data);
    	
   
