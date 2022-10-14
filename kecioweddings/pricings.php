<?php
$display_plan  = array("user_id"=>$_SESSION['userid']);
$data          = $little->shaz_curl(json_encode($display_plan), \NsLittle\Little::ROUTE.'/display_payments.php');
//print_r($data);
$decode_data   = json_decode($data);
$status        = $decode_data->data->status;
$plan_type     = $decode_data->data->plan_type;
$activedays    = $decode_data->data->active_days;

?>
<div class="body-content">
            <div class="main-contaner">
                <div class="container">
<!-- Page Heading -->
                    <div class="section-title">
                        <h2>Pricing Plan</h2>
                    </div>
                    <!-- Page Heading -->

                    <!-- My Pricing Section -->
                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            <div class="row align-items-center">
                                <div class="mb-0 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing-plan">
                                        <span class="sub-head">Plan Type</span>
                                        <h3><?php echo $plan_type;?></h3>
                                    </div>
                                </div>

                                <div class="mb-0 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing-plan">
                                        <span class="sub-head">Plan Days</span>
                                        <h3><?php echo $activedays;?></h3>
                                    </div>
                                </div>

                                
                                
                                <div class="mb-0 col-xl-1 col-lg-4 col-sm-6">
                                    <div class="pricing-plan p-0 text-xl-right text-md-left pl-md-3 text-center">
                                        <?php if($status == "Active"){?>
                                        <div class="badge badge-success">&nbsp;</div>
                                        <?php }else{ ?>
                                        <div class="badge badge-danger">&nbsp;</div>
                                        <?php } ?>
                                        <small><?php echo $status;?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
            <section class="wide-tb-50">
            <div class="container">
                <div class="row">
                   <div class="col-md-4">
                        <div class="pricing-table-wrap premium">
                            <h3>Standard Plan</h3>
                            <h4>3 Months<span class="text-warning text-small"> + (1 Month Free Offer)</span></h4>
                            <div class="plan-price">
                                <sup>Ksh</sup>3000
                           </div>
                            
                            <ul class="list-unstyled">
                                <li>Number of Listings : Unlimited</li>
                                <li>Featured Listing : 1</li>
                                <li>Support : 24/7</li>
                                <li>Validity : 3 months <span class="text-warning"> + 1 Month Free (Offer)</span></li>
                            </ul>
                           <input type="hidden" id="validitydays" value="122">
                           <input type="hidden" id="standardplan" value="Standard Plan">
                            <button id="3months" class="btn btn-primary btn-rounded">Buy Package</button>
                            <button id="3mthsloading" class="btn btn-primary btn-rounded buttonload" style="display:none"><i class="fa fa-spinner fa-spin"></i>Loading</button>
                        </div>
                    </div>
        
                    <!-- Pricing Plan Wrap -->
                    <div class="col-md-4">
                        <div class="pricing-table-wrap premium">
                            <h3>Premium Plan</h3>
                            <h4>6 Months <span class="text-warning">(17% off)</span></h4>
                            <div class="plan-price">
                                <sup>Ksh</sup>5000
                           </div>
                            
                            <ul class="list-unstyled">
                                <li>Number of Listings : Unlimited</li>
                                <li>Featured Listing : 3</li>
                                <li>Support : 24/7</li>
                                <li>Validity : 6 months</li>
                            </ul>
                            <input type="hidden" id="prevaliditydays" value="183">
                            <input type="hidden" id="premiumplan" value="Premium Plan">
                            <button id="6months" class="btn btn-primary btn-rounded">Buy Package</button>
                            <button id="6mthsloading" class="btn btn-primary btn-rounded buttonload" style="display:none"><i class="fa fa-spinner fa-spin"></i>Loading</button>
                        </div>
                    </div>
                    <!-- Pricing Plan Wrap -->
        
                    <!-- Pricing Plan Wrap -->
                    <div class="col-md-4">
                        <div class="pricing-table-wrap premium">
                            <h3>1 Year Plan</h3>
                            <h4>12 Months <span class="text-warning">(17% off)</span></h4>
                            <div class="plan-price">
                                <sup>Ksh</sup>10000
                            </div>
                            <ul class="list-unstyled">
                                <li>Number of Listings : Unlimited</li>
                                <li>Featured Listing : 6</li>
                                <li>Support : 24/7</li>
                                <li>Validity : 12 months</li>
                            </ul>
                            <input type="hidden" id="yearvaliditydays" value="365">
                            <input type="hidden" id="yaerlyplan" value="1 Year Plan">
                            <button id="12months" class="btn btn-primary btn-rounded">Buy Package</button>
                            <button id="12mthsloading" class="btn btn-primary btn-rounded buttonload" style="display:none"><i class="fa fa-spinner fa-spin"></i>Loading</button>
                        </div>
                    </div>
                    <!-- Pricing Plan Wrap -->
                </div>
            </div>
        </section>
                </div>
            </div>
</div>
            
                    <!-- My Pricing Section -->  