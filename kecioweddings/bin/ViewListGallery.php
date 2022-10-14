<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$listing_id = array(
    "listing_id" =>$security->sane_inputs("listing_id", "POST")
);
//print_r($listing_id);
$data = $little->shaz_curl(json_encode($listing_id), \NsLittle\Little::ROUTE.'/displaygallery.php');
//print_r($data);
$gallery_decode = json_decode($data);
$gallery  = $gallery_decode->data->gallery;

$explode_gallery = explode(',', $gallery);
///print_r($explode_gallery);
  //$myarray = array("test", "test2", "test3");    
$prefixed_array = preg_filter('/^/', 'images/vendor_listings/', $explode_gallery);
$remove = array_pop($prefixed_array);
//print_r($prefixed_array);

?>


                    
                 

 <script src="assets/library/magnific-popup/jquery.magnific-popup.min.js"></script> 
 <script>
 $('.vendor-img-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
                       preload: [0,1], // Will preload 0 - before current, and 1 after the current image
                       arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>'
                      
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
			
		}
	});
</script>