<?php



$folder = "images/listing_featured/";
$images = scandir($folder);

$dots = array_shift($images);
$dots = array_shift($images);

//print_r($images);

foreach ($images as $image){
    $image = substr($image,0,-4);
    
    $input  = "C:/xampp/htdocs/kecioweddings/images/listing_featured/".$image.".jpg";
    $output = "C:/xampp/htdocs/kecioweddings/images/listing_featured/".$image.".webp";
    
    exec("C:/xampp/htdocs/kecioweddings/libwebp/bin/cwebp {$input} -o {$output}");
    
    echo $output."</br>";
}


?>