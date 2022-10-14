<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$display_plan  = array("user_id"=>$_SESSION['userid']);
$data          = $little->shaz_curl(json_encode($display_plan), \NsLittle\Little::ROUTE.'/display_invoice.php');
//print_r($data);
$decode_data   = json_decode($data);
//print_r($decode_data);
$receipt = $decode_data->data;
//print_r($receipt);


?>            
<div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <h2>Receipt List</h2>
                    </div>
                    <!-- Page Heading -->

                    <!-- My Invoice Section -->
                    <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="receipt-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Plan Name</th>
                                            <th scope="col">Validity Days</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">VAT Tax</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for($r = 0; $r < count($receipt);$r++){
                                            $plan = $receipt[$r]->plan_type;
                                        ?>
                                        <tr>
                                           <td><?php echo $receipt[$r]->plan_type;?></td>
                                            <td><?php echo $receipt[$r]->active_days;?></td>
                                            <td><?php echo $receipt[$r]->payment_dates;?>	</td>
                                            <td><?php if($plan === 'Standard Plan'){ $tax = (16/100)*3000;  ?>Ksh <?php echo $tax;?><?php }else if($plan === 'Premium Plan'){ $tax = (16/100)*6000; ?> Ksh <?php echo $tax;?> <?php }else if($plan === '1 Year Plan'){ $tax = (16/100)*10000 ?> Ksh <?php echo $tax;?> <?php }?></td>
                                            <td><?php if($plan === 'Standard Plan'){?>Ksh 3,000.00<?php }else if($plan === 'Premium Plan'){ ?> Ksh 6,000.00 <?php }else if($plan === '1 Year Plan'){ ?> Ksh 10,000.00 <?php }?></td>
                                        </tr>
                                        <?php } ?>
                                        
                                        
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- My Invoice Section -->  
                </div>
            </div>
             </div>
<?php } else{     include_once 'login.php';}?>