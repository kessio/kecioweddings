<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$listingid = array(
    "user_id" => $_SESSION['userid']
);
$userreviews = $little->shaz_curl(json_encode($listingid), \NsLittle\Little::ROUTE.'/display_myreview.php');
$userreview_decod = json_decode($userreviews);
$myreviewss = $userreview_decod->data;
//print_r($myreviewss);



?>

<div class="body-content">
            <div class="main-contaner">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <h2>My Reviews</h2>
                        </div>                        
                    </div>
                    <!-- Page Heading -->

                    <div class="card-shadow pos-rel">
                            <div class="card-shadow-body border-top">
                                <!-- Review Media -->
                                <table id="my_reviews_datatables" class="table">
                                <thead>
                                    <tr>
                                                                    
                                        <th>Reviews</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                      <?php
                      
                      for($rr = 0; $rr < count($myreviewss); $rr ++){
                      
                      
                      ?>
                       <tr> 
                           <td>
                                 <div class="reviews-media">
                                    <div class="media">
                                      <div class="media-body">
                                            <div class="heading-wrap no-gutters">
                                                <div class="heading">
                                                    <div class="col pl-0">
                                                        <h4 class="mb-0"><?php  echo $myreviewss[$rr]->listing_name; ?></h4>
                                                        <div class="review-option-btn">
                                                            <a data-toggle="collapse" href="#review-option-toggle-3" role="button" aria-expanded="false" class="collapsed">
                                                                <?php if ($myreviewss[$rr]->ratings === '1'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                 <?php if ($myreviewss[$rr]->ratings === '2'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                 <?php if ($myreviewss[$rr]->ratings === '3'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                  <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                <?php if ($myreviewss[$rr]->ratings === '4'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star-o"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                <?php if ($myreviewss[$rr]->ratings === '5'){ ?>
                                                               <span class="stars">
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                 <i class="fa fa-star"></i>
                                                                    
                                                                </span>
                                                                <?php } ?>
                                                                <span><?php echo number_format($myreviewss[$rr]->ratings,1);  ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <small><?php $datesent = strtotime($myreviewss[$rr]->date_sent); echo "Sent On ".date("F d Y",$datesent);   ?></small>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                           <p><?php echo  $myreviewss[$rr]->review;  ?></p>
                                           <?php if(!empty($myreviewss[$rr]->feedback)){?>
                                           <div class="media reply-box">
                                                <div class="media-body">
                                                    <div class="d-md-flex justify-content-between mb-3">
                                                        <h4 class="mb-0"><?php echo $myreviewss[$rr]->vendor_name;?></h4>
                                                        <small class="txt-blue">Replied On: <?php $responsedatesent = strtotime($myreviewss[$rr]->response_date_sent); echo date("F d, Y",$responsedatesent);?></small>
                                                    </div>
                                                    <?php echo $myreviewss[$rr]->feedback?>
                                                </div>
                                            </div>
                                           <?php }?>
                                        </div>
                                    </div>
                                </div>
                             </td>
                       </tr>
                       
                        <?php      }  ?>
                       </tbody>
                       </table>
                           </div>
                        </div>

                </div>
            </div>
           
        </div>  
<?php }else{include_once 'login.php';}?>

