<?php
if (!empty($_FILES['file']['name'])) {
	
	$file_name = "";

	$totalFile = count($_FILES['file']['name']);

	for ($i=0; $i < $totalFile ; $i++) {

	    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'jpeg', 'jpg');

	    if (in_array($extension, $allowExtn)) {
		$newName = rand() . ".". $extension;
		$uploadFilePath = "../images/vendor_listings/".$newName;
		move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);
		$file_name .= $newName ." , ";				
	    }
	}
}