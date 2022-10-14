<?php

error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$reviews = array(
    
   "listing_id"=>$security->sane_inputs("listing_id", "POST") 
    
    
);
//print_r($reviews);

$data = $little->shaz_curl(json_encode($reviews), \NsLittle\Little::ROUTE.'/display_vendorreview.php');
//print_r($data);die;

$data_decode = json_decode($data);
$myreview = $data_decode->data;
//print_r($myreview);

$count_review = count($myreview);

?>

<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card review-summary-table table-responsive">
                            <table class="table" id="allguest-datatables">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Rating</th>
                                        <th>Email</th>
                                        <th>Review</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                    
                                    for($r = 0;  $r < $count_review; $r++){
                                    
                                        $name          = $myreview[$r]->name;
                                        $email         = $myreview[$r]->email;
                                        $review        = $myreview[$r]->review;
                                        $ratings       = $myreview[$r]->ratings;
                                        $datesent      = $myreview[$r]->date_sent;
                                        $profile_image = $myreview[$r]->profile_image;
                                        
                                        
                                        
                                    
                                    ?>
                                    
                                    <tr>
                                        <td class="review-summary-name"><?php echo $name;    ?></td>
                                        <?php    if($ratings == 1) {           ?>
                                        <td class="review-summary-rating"> <span class="rated"><i class="fa fa-star"></i> </span><span class="ml-2"><?php echo $ratings;  ?></span></td>
                                        <?php }else if($ratings == 2){  ?>
                                        <td class="review-summary-rating"> <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> </span><span class="ml-2"><?php echo $ratings;  ?></span></td>
                                        <?php }elseif($ratings == 3){ ?>
                                        <td class="review-summary-rating"> <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span><span class="ml-2"><?php echo $ratings;  ?></span></td>
                                        <?php }elseif($ratings == 4){ ?>
                                        <td class="review-summary-rating"> <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span><span class="ml-2"><?php echo $ratings;  ?></span></td>
                                        <?php }elseif($ratings == 5){ ?>
                                        <td class="review-summary-rating"> <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i></span><span class="ml-2"><?php echo $ratings;  ?></span></td>
                                        <?php  } ?>
                                        <td class="review-summary-id"><?php  echo $email;   ?></td>
                                        <td class="review-summary-action"><a class="btn btn-outline-pink btn-xs" data-toggle="collapse" id="example-<?php echo $r; ?>" data-text-swap="close" data-text-original="Details" href="#collapseExample<?php echo $r; ?>" aria-expanded="false" aria-controls="collapseExample<?php echo $r; ?>">Details  </a></td>
                                        <td class="requester-action"><a href="#" class="btn btn-outline-pink btn-xs ">delete</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="expandable-info">
                                            <div class="collapse expandable-collapse" id="collapseExample<?php  echo $r;   ?>">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <!-- review-user -->
                                                        <div class="review-user">
                                                            <div class="user-img"> <img src="images/coupleprofile/<?php echo $profile_image; ?>" alt="star rating jquery" style="width:30px;height: 30px;" class="rounded-circle"></div>
                                                            <div class="user-meta">
                                                                <span class="user-name"><?php  echo $name;   ?></span>
                                                                <span class="user-review-date"><?php  $date = strtotime($datesent); echo date("F m Y",$date);  ?></span>
                                                                <div class="given-review">
                                                                      <?php    if($ratings == 1) {           ?>
                                                                    <span class="rated"><i class="fa fa-star"></i> </span>
                                                                      <?php    }elseif($ratings == 2) {           ?>
                                                                    <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i>   </span>
                                                                      <?php    }elseif($ratings == 3) {           ?>
                                                                    <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>  </span>
                                                                     <?php    }elseif($ratings == 4) {           ?>
                                                                    <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span>
                                                                     <?php    }elseif($ratings == 5) {           ?>
                                                                    <span class="rated"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span>
                                                                    <?php  } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.review-user -->
                                                        <!-- review-descripttions -->
                                                        <div class="review-descriptions">
                                                            <p><?php echo $review;      ?> </p>
                                                           
                                                        </div>
                                                        <!-- /.review-descripttions -->
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php   }  ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

