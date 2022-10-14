<?php

$display_listing = array();
//print_r($display_listing);

$data = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/myAllListings.php');
//print_r($data);

$decode_data = json_decode($data);
//print_r($decode_data);
$listing = $decode_data->data;
//print_r($listing);

$listing_count = count($listing);
$countpending = $little->shaz_curl(json_encode($display_listing),\NsLittle\Little::ROUTE.'/count_pendinglisting.php');
//print_r($countpending);
$decode_count = json_decode($countpending);
$mypending = $decode_count->data->pending_no;
//print_r($mypending);

$countapproved = $little->shaz_curl(json_encode($display_listing),\NsLittle\Little::ROUTE.'/count_approvedlisting.php');
//print_r($countpending);
$decode_countapproved = json_decode($countapproved);
$myapproved = $decode_countapproved->data->approved_no;
//print_r($myapproved);
$countdeclined = $little->shaz_curl(json_encode($display_listing),\NsLittle\Little::ROUTE.'/count_declinedlisting.php');
//print_r($countpending);
$decode_countdeclined = json_decode($countdeclined);
$mydeclined = $decode_countdeclined->data;


?>
<div class="body-content">
            <div class="main-contaner">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <h2>Listings</h2>
                            
                        </div>                        
                    </div>
                    <!-- Page Heading -->

                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            <div class="couple-info p-0">
                                <div class="row row-cols-2 row-cols-md-4 row-cols-sm-2">
                                    <div class="col">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                              <?php  echo $myapproved;?>
                                            </div>
                                            <div class="text">
                                                <strong>Total Approved</strong>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                                  <?php echo $mypending;?>
                                            </div>
                                            <div class="text">
                                                <strong>Pending</strong>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            
                            
                        </div>
                          <div class="ml-3">
                        <ul class="nav nav-pills mb-3 horizontal-tab-second justify-content-center nav-fill" id="pills-tab1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-hr-general-tab" data-toggle="pill" href="#pills-hr-general" role="tab" aria-controls="pills-hr-general" aria-selected="true">Pending (<?php echo $mypending;?>)</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-vendor-tab" data-toggle="pill" href="#pills-hr-vendor" role="tab" aria-controls="pills-hr-vendor" aria-selected="false">Approved (<?php echo $myapproved;?>)</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-groom-tab" data-toggle="pill" href="#pills-hr-groom" role="tab" aria-controls="pills-hr-groom" aria-selected="false">Expired</a>
                                </li>
                                
                            </ul>
                        <div class="tab-content" id="pills-tabContent1">
                                <div class="tab-pane fade show active" id="pills-hr-general" role="tabpanel" aria-labelledby="pills-hr-general-tab">
                                    
                             <div class="table-responsive mt-2">
                            <table class="table mb-0" id="example-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Action</th>
                                        
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                          for($l = 0; $l < $listing_count; $l ++){
                                          $featured_image = $listing[$l]->featured_image;
                                          $status = $listing[$l]->status;
                                            if($status == "Pending"){
                                        ?>
                                    <tr>
                                        <td class="text-nowrap"><a href="supplier-singular/<?php echo $listing[$l]->listing_id;?>">
                                           <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                           </a></td>
                                        <td class="text-nowrap"><?php  echo $listing[$l]->listing_name;  ?></td>
                                        <td class="text-nowrap"><?php echo ($listing[$l]->region_name);?>, <?php echo ($listing[$l]->subregion_name);  ?></td>
                                        <td class="text-nowrap">
                                          <button class="btn btn-primary approve-shaz" id="<?php echo $listing[$l]->listing_id;?>">Approve</button> 
                                          <button class="btn btn-primary decline-shaz" id="<?php echo $listing[$l]->listing_id;?>">Decline</button>
                                        </td>
                                         
                                       
                                        
                                    </tr>
                                          <?php } } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>  
                                </div>
                                <div class="tab-pane fade" id="pills-hr-vendor" role="tabpanel" aria-labelledby="pills-hr-vendor-tab">
                               <div class="table-responsive mt-2">
                            <table class="table mb-0" id="attending-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Location</th>
                                        
                                        
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                          for($la = 0; $la < $listing_count; $la ++){
                                          $featured_image = $listing[$la]->featured_image;
                                          $status = $listing[$la]->status;
                                            if($status == "Approved"){
                                        ?>
                                    <tr>
                                        <td class="text-nowrap"><a href="supplier-singular/<?php echo $listing[$la]->listing_id;?>">
                                           <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                           </a></td>
                                        <td class="text-nowrap"><?php  echo $listing[$la]->listing_name;  ?></td>
                                        <td class="text-nowrap"><?php echo ($listing[$la]->region_name);?>, <?php echo ($listing[$la]->subregion_name);  ?></td>
                                        
                                         
                                       
                                        
                                    </tr>
                                          <?php } } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                                </div>
                                <div class="tab-pane fade" id="pills-hr-groom" role="tabpanel" aria-labelledby="pills-hr-groom-tab">
                             <div class="table-responsive mt-2">
                            <table class="table mb-0" id="waiting-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Action</th>
                                        
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                          for($lw = 0; $lw < $listing_count; $lw ++){
                                          $featured_image = $listing[$lw]->featured_image;
                                          $status = $listing[$lw]->status;
                                            if($status == "Expired"){
                                        ?>
                                    <tr>
                                        <td class="text-nowrap"><a href="supplier-singular/<?php echo $listing[$lw]->listing_id;?>">
                                           <img src="images/listing_featured/<?php if(!empty($featured_image)){ echo $featured_image;}else{?>vendor_img_1.jpg<?php }?>" class="rounded" alt="">
                                           </a></td>
                                        <td class="text-nowrap"><?php  echo $listing[$lw]->listing_name;  ?></td>
                                        <td class="text-nowrap"><?php echo ($listing[$lw]->region_name);?>, <?php echo ($listing[$lw]->subregion_name);  ?></td>
                                        <td class="text-nowrap">
                                          <button class="btn btn-primary approve-shaz" id="<?php echo $listing[$lw]->listing_id;?>">Approve</button> 
                                          <button class="btn btn-primary decline-shaz" id="<?php echo $listing[$lw]->listing_id;?>">Decline</button>
                                        </td>
                                         
                                       
                                        
                                    </tr>
                                          <?php } } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                          </div>
                                
                       </div>
                    </div>
                        
                        
                        
                    </div>

                </div>
            </div>
            
        </div>