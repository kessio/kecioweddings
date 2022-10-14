<?php
error_reporting(0);
//echo "heeeeey";die;



include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

//echo "i love you";

$display_review = array(
    
"listing_id"          => $security->sane_inputs("listing_id", "POST"),
 "review_id"            =>$security->sane_inputs("next_last_id", "POST")
        
    
    );
    //print_r($display_review);
$display_reviews = $little->shaz_curl(json_encode($display_review), \NsLittle\Little::ROUTE.'/display_review.php');

//print_r($display_reviews);

$decode_reviews = json_decode($display_reviews);
//print_r($decode_reviews);
$reviews = $decode_reviews->data;


                      
                      for($r = 0; $r < count($reviews); $r ++){
                   ?>
                       
                        <div class="card border card-shadow-none ">
                            <!-- review-user -->
                            <div class="card-header bg-white mb0">
                                <div class="review-user">
                                    <div class="user-img"> <?php  if(!empty($reviews[$r]->profile_image)) {  ?><img src="images/coupleprofile/<?php echo $reviews[$r]->profile_image; ?>" alt="star rating jquery" style="width:30px;height: 30px;" class="rounded-circle">    <?php   }else{ ?>  <img src="images/catergory-florist.jpg" alt="star rating jquery" style="width:30px;height: 30px;" class="rounded-circle"> <?php   } ?> </div>
                                    <div class="user-meta">
                                        <h5 class="user-name mb-0"><?php  echo $reviews[$r]->name;       ?>  <span class="user-review-date"><?php $datesent = strtotime($reviews[$r]->date_sent); echo "Sent On ".date("F d Y",$datesent);  ?></span></h5>
                                        <div class="given-review">
                                            <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="far  fa-star"></i> <i class="far  fa-star"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.review-user -->
                            <div class="card-body">
                                <!-- review-descripttions -->
                                <div class="review-descriptions">
                                    <p><?php echo $reviews[$r]->review;  ?> </p>
                                </div>
                                <!-- /.review-descripttions -->
                            </div>
                        </div>
                        
                        <?php      }  ?>
                        
                        <div class="gallery-btn" id="next-<?php echo $decode_reviews->next_last_id?>">
                                <a data-toggle="collapse" href="#more-reviews" role="button" aria-expanded="false" class="collapsed">
                                 <i class="fa fa-angle-down"></i> <span class="text">Reviews</span></a>
                                 
                       </div>