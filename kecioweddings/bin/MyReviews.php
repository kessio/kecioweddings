<?php
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$reviews = array(
    
   "listing_id"=>$security->sane_inputs("listing_id", "POST")   
);


$data = $little->shaz_curl(json_encode($reviews), \NsLittle\Little::ROUTE.'/display_vendorreview.php');
//print_r($data);die;

$data_decode = json_decode($data);
$myreview = $data_decode->data;
//print_r($myreview);

$count_review = count($myreview);

?>

<div class="card-shadow-body p-0">
                            <div class="row no-gutters" id="<?php echo $reviews[listing_id];?>">
                              <div class="col-md-4">
                               <div class="reviews-tabbing-wrap">
                                <div class="nav flex-column nav-pills theme-tabbing-vertical reviews-tabbing" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                             <?php   
                                    
                                    for($r = 0;  $r < $count_review; $r++){
                                    
                                        $name          = $myreview[$r]->name;
                                        $email         = $myreview[$r]->email;
                                        $review        = $myreview[$r]->review;
                                        $ratings       = $myreview[$r]->ratings;
                                        $datesent      = $myreview[$r]->date_sent;
                                        $profile_image = $myreview[$r]->profile_image;
                                       
                                    ?>
                                            <a class="nav-link" id="v-pills-home-tab-<?php echo $r;?>" data-toggle="pill" href="#v-pills-general-<?php echo $r;?>" role="tab"
                                                aria-controls="v-pills-general-<?php echo $r;?>" aria-selected="false">
                                                <div class="reviews-media">
                                                    <div class="media">
                                                        <img class="thumb" src="images/vendor_listings/1110249153.jpg" alt="">
                                                        <div class="media-body">
                                                            <div class="heading-wrap no-gutters">
                                                                <div class="heading">
                                                                  <h4 class="mb-0"><?php echo ucwords($name);?></h4>
                                                                  <div class="review-option-btn">
                                                                        
                                                                <span class="stars">
                                                                    <?php if($ratings == 1){?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <?php } if($ratings == 2){ ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <?php }if($ratings == 3){ ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <?php } if($ratings == 4){ ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star-o"></i>
                                                                    <?php } if($ratings == 5){ ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star"></i> 
                                                                    <i class="fa fa-star"></i> 
                                                                    <?php } ?>


                                                                </span>
                                                                <span><?php echo $ratings;?>.0</span>
                                                                 </div>
                                                                 <small>Date sent on <?php  $date = strtotime($datesent); echo date("F m Y",$date);  ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </a>
                                            <?php } ?> 
                                        </div>
                                    </div>
                                </div>
                                   
                                <div class="col-md-8">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <?php   
                                    
                                    for($l = 0;  $l < $count_review; $l++){
                                    
                                        $name          = $myreview[$l]->name;
                                        $email         = $myreview[$l]->email;
                                        $review        = $myreview[$l]->review;
                                        $ratings       = $myreview[$l]->ratings;
                                        $datesent      = $myreview[$l]->date_sent;
                                        $profile_image = $myreview[$l]->profile_image;
                                        $feedback      = $myreview[$l]->feedback;
                                        $vendor_name   = $myreview[$l]->vendor_name;
                                    
                                    ?>
                                        <div class="tab-pane fade show" id="v-pills-general-<?php echo $l?>" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab-<?php echo $l?>">
                                            <!-- Review Media -->
                                            <div class="reviews-media">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4 class="fw-7"><?php echo ucwords($name); ?></h4>
                                                       <div class="review-option-btn">

                                                <span class="stars">
                                                    <?php if($ratings == 1){?>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <?php } if($ratings == 2){ ?>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <?php }if($ratings == 3){ ?>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <?php } if($ratings == 4){ ?>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                      <i class="fa fa-star-o"></i>
                                                    <?php } if($ratings == 5){ ?>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <?php } ?>


                                                </span>
                                                <span><?php echo $ratings;?>.0</span>
                                           </div>
                                            <P><?php echo $review;?></P>
                                             </div>
                                            </div>
                                    <?php if(empty($feedback)){?>
                                                <input type="hidden" id="<?php echo $myreview[$l]->review_id?>" value="<?php echo $myreview[$l]->review_id?>">
                                              <textarea class="form-control" id="web-<?php echo $myreview[$l]->review_id?>" name="editordata" rows="6" placeholder="Respond to your review" ><?php echo $feedback;?></textarea>
                                               <span class="text-danger" id="words-<?php echo $myreview[$l]->review_id?>" style="display: none">Your words is less than 10!</span>
                                                <a href="javascript:" id="reveiew-<?php echo $myreview[$l]->review_id?>" class="btn btn-default btn-sm mt-3 kecio-fedback">Add Your Reply</a> 
                                    <?php } else{ ?>
                                              <div class="media reply-box">
                                                           <div class="media-body">
                                                                <div class="d-md-flex justify-content-between mb-3">
                                                                    <h4 class="mb-0"><?php echo ucwords($vendor_name);?></h4>
                                                                    <small class="txt-blue"><?php $datesent = strtotime($myreview[$l]->response_date_sent); echo "Replied On ".date("F d, Y",$datesent);  ?></small>
                                                                </div>
                                                                <?php echo  $feedback;   ?>
                                                            </div>
                                                        </div>  
                                                
                                    <?php } ?>
                                                
                                            </div>
                                            <!-- Review Media -->
                                        </div>
                                    <?php } ?>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
