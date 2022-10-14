<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();
//echo "i love you";



$imgname = $_FILES['file']['name'];
//print_r($imgname);
if(!empty($imgname)){

$countimg = count($imgname);
//echo $countimg;die;

for($i =0; $i < $countimg;  $i++){
    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'gif', 'jpg','jpeg');

	    if (in_array($extension, $allowExtn)) {
		$newName = rand() . ".". $extension;
               
                $uploadFilePath = "../images/vendor_listings/".$newName;
                if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath)){
                   $array_cimage = explode('.', $newName);
              // print_r($array_cimage);
                  $array1 = $array_cimage[0];
                  $array2 = $array_cimage[1]; 
                  $input = "C:/xampp/htdocs/kecioweddings/images/vendor_listings/".$array1.".".$array2;
                  $output = "C:/xampp/htdocs/kecioweddings/images/vendor_listings/".$array1.".webp"; 
                  exec("C:/xampp/htdocs/kecioweddings/libwebp/bin/cwebp {$input} -o {$output}"); 
                    
                }
              //  print_r($uploadFilePath);
		$file_name .= $newName .",";
              //  print_r($file_name);
}

}


$add_list = array(
    
"listing_id"   =>$security->sane_inputs("listing_id","POST"),
 "gallery"    =>$file_name
    );
  // print_r($add_list);die;


$data = $little->shaz_curl(json_encode($add_list), \NsLittle\Little::ROUTE.'/add_gallery.php');
print_r($data);


}
