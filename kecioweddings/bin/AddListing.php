<?php
session_start();
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$imgname = $_FILES['file']['name'];

if(!empty($imgname)){

$countimg = count($imgname);
for($i =0; $i < $countimg;  $i++){
    $fileName = $_FILES['file']['name'][$i]; 
	    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
	    $allowExtn = array('png', 'jpeg', 'jpg');

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
                    
                    
                
		
		$file_name .= $newName .",";	
}

}

$coverpic  = $_FILES['cover_picture']['name'];
//print_r($coverpic);die;
$mytype = $_FILES['cover_picture']['type'];
$mytmp = $_FILES['cover_picture']['tmp_name'];
$array_pic = explode('.',$coverpic);
//print_r($array_pic);
$arraypic1 = $array_pic[0];
$arraypic2 = $array_pic[1];
//echo $arraypic2; die;
$last_id = array();

$lastid_data = $little->shaz_curl(json_encode($last_id),\NsLittle\Little::ROUTE.'/get_maxListingid.php');
//print_r($lastid_data);die;
$lastid_decode = json_decode($lastid_data);
$mylastid = $lastid_decode->data->listing_id;
//print_r($mylastid);die;
$current_listingid = $mylastid + 1;

$coverpicName = $current_listingid.'-coverpicture'.'.'.$arraypic2;
//print_r($coverpicName);
$coverpictarget = "../images/listing_coverpic/".$coverpicName;
 move_uploaded_file($mytmp, $coverpictarget);
 // pdf upload 

$pricingpdf = $_FILES['price']['name'];
//print_r($_FILES['price']);die;
$type = $_FILES['price']['type'];
$tmp = $_FILES['price']['tmp_name'];
//print_r($tmp);die;
$array_pdf = explode('.', $pricingpdf);
$array1 = $array_pdf[0];
$array2 = $array_pdf[1];
if(!empty($pricingpdf)){
$pdfName = $current_listingid.'-price'.'.'.$array2;
}else{
  $pdfName = '';
}
$pdftarget = "../pdffiles/".$pdfName;
move_uploaded_file($tmp, $pdftarget);

$add_list = array(
"listing_id"   =>$current_listingid,  
"vendor_id"     =>$security->sane_inputs("vendor_id", "POST"),
"listing_name"  =>$security->sane_inputs("listing_name", "POST"),
"cat_id"        =>$security->sane_inputs("cat_id", "POST"),
"subcategory"   => $security->sane_inputs("subcategory", "POST"),
"tents"         => $security->sane_inputs("tent", "POST"),  
"entertainment" => $security->sane_inputs("entertainment", "POST"), 
"furniture"     => $security->sane_inputs("furniture", "POST"), 
"price"         =>$pdfName,
"facility"      => $security->sane_inputs("facility", "POST"),
"country"       => $security->sane_inputs("country", "POST"),
"region"        => $security->sane_inputs("region", "POST"),
"subregion"     => $security->sane_inputs("subregion", "POST"), 
"about"         => $security->sane_inputs("about", "POST"),
"services"      => $security->sane_inputs("services", "POST"),
"amenities"     => $security->sane_inputs("amenity", "POST"),
"cover_picture" =>$coverpicName,
"facebook"      => $security->sane_inputs("facebook", "POST"),
"instagram"     => $security->sane_inputs("instagram", "POST"),
"whatsapp"      => $security->sane_inputs("whatsapp", "POST"),
"gallery"       => $file_name,
"featured"      => $security->sane_inputs("featured", "POST"),
    
);
//print_r($add_list);die;
$data = $little->shaz_curl(json_encode($add_list),\NsLittle\Little::ROUTE.'/add_listing.php');

print_r($data); 



}