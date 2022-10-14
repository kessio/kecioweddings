<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$requestquote = array(
    
   "listing_id"=>$security->sane_inputs("listing_id", "POST") 
    
    
);
//print_r($requestquote);

$data = $little->shaz_curl(json_encode($requestquote), \NsLittle\Little::ROUTE.'/display_request_pricing.php');
//print_r($data);

$data_decode = json_decode($data);
$quote = $data_decode->data;
//print_r($quote);
$count_quote = count($quote);


 
?>
<style
<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" />
 
 <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" />
 
</style>
 
<div class="card request-list-table table-responsive">
                            <table class="requestquotetable" id="<?php echo $requestquote[$listing_id];?>">
                                <thead>
                                    <tr>
                                        <th id="name">Name</th>
                                        <th id="phone">Phone</th>
                                        <th id="message">Message</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for($q = 0; $q < $count_quote; $q++ ){
    
                                    $pricing_name   = $quote[$q]->name;
                                    //$pricing_email = $quote[$q]->email;
                                    $pricing_phone = $quote[$q]->phone;
                                    $pricing_message = $quote[$q]->message;

    
                                    
                                    ?>
                                    
                                    
                                    <tr>
                                        <td id="request-name" class="requester-name col-xl-2 col-lg-3 col-md-2 col-sm-2 col-2"><?php echo $pricing_name;?></td>
                                       <td id="request-phone" class="requester-phone col-xl-2 col-lg-3 col-md-2 col-sm-2 col-2"><?php $pricing_phone;  ?></td>
                                        <td colspan="12" class="review-summary-action"><a class="btn btn-outline-pink btn-xs" data-toggle="collapse" id="example-<?php echo $q;?>" data-text-swap="close" data-text-original="Details" href="#collapseExample<?php echo $q;?>" aria-expanded="false" aria-controls="collapseExample<?php echo $q;?>">Details  </a>
                                        
                                        <div   class="expandable-info">
                                            <div class="collapse expandable-collapse" id="collapseExample<?php echo $q;?>">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <!-- review-user -->
                                                        <div class="review-user">                                          
                                                            <div class="user-meta">
                                                                <span class="user-name"><?php echo $pricing_name;     ?></span>
                                                                <span class="user-review-date">11 May, 2018</span>
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- /.review-user -->
                                                        <!-- review-descripttions -->
                                                        <div class="review-descriptions">
                                                            <p> <?php echo $pricing_message;?></p>
                                                        </div>
                                                        <!-- /.review-descripttions -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    
                                    <?php  } ?>
                                    
                                </tbody>
                            </table>
                        </div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script>
   
          $('.requestquotetable').DataTable({
            "searching": true,
            "lengthChange": true
          });

    

</script>