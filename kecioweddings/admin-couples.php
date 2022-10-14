<?php

$display_couple = array();
$data = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/select_couple.php');
//print_r($data);
$decode_data = json_decode($data);
//print_r($decode_data);
$couples = $decode_data->data;
//print_r($couples);
 
$couple_count = count($couples);

$countdata = $little->shaz_curl(json_encode($display_listing), \NsLittle\Little::ROUTE.'/count_users.php');
//print_r($countdata);
$decodecouple = json_decode($countdata);
//print_r($decodecouple);
$couple_total = $decodecouple->data->couple_no;


?>

<div class="body-content">
     <div class="main-contaner">
         <div class="container-fluid">
                    <!-- Page Heading -->
               <div class="section-title">
                   <div class="d-sm-flex justify-content-between align-items-start">
                       <h2>Couples</h2>
                            
                      </div>                        
                    </div>
              <div class="card-shadow">
                        <div class="card-shadow-body">
                            <div class="couple-info p-0">
                                <div class="row row-cols-2 row-cols-md-4 row-cols-sm-2">
                                    <div class="col">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                              <?php  echo $couple_total;?>
                                            </div>
                                            <div class="text">
                                                <strong>Total Couples</strong>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                   <div class="card-shadow">
                    <div class="card-shadow-body">
                   <div class="table-responsive mt-2">
                            <table class="table mb-0" id="example-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">wedding date</th>
                                        <th scope="col">wedding venue</th>
                                        <th scope="col">Date joined</th>
                                        
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                          for($l = 0; $l < $couple_count; $l ++){
                                        
                                          $role = $couples[$l]->role; 
                                            if($role == "couple"){
                                        ?>
                                    <tr>
                                        
                                        <td class="text-nowrap"><?php  echo $couples[$l]->name;  ?></td>
                                        <td class="text-nowrap"><?php echo  $couples[$l]->phone_number;?></td>
                                        <td class="text-nowrap"><?php echo  $couples[$l]->wedding_date;?></td>
                                        <td class="text-nowrap"><?php echo  $couples[$l]->wedding_venue;?></td>
                                        <td class="text-nowrap"><?php echo  $couples[$l]->date_joined;?></td>
                                    </tr>
                                          <?php } } ?>
                                
                                </tbody>
                            </table>
                        </div>  
              </div> 
          </div>
       </div>
  </div>