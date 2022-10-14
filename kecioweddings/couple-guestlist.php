<?php    
if($_SESSION['user_session_exists'] === "TRUE"){
$guest_userid = array(
    
    "user_id"=>$_SESSION['userid']
    
);
$couple_name = $_SESSION['name'] ;
//print_r($viewguests);
$userid = $guest_userid['user_id'];
//echo $userid;

$data = $little->shaz_curl(json_encode($guest_userid), \NsLittle\Little::ROUTE.'/display_guests.php');
//print_r($data);
$data_decoded = json_decode($data);
//print_r($data_decoded);
$allguests = $data_decoded->data;
//print_r($allguests);
$guest_count = count($allguests);



//=============== Count Attending guests ====================================================================//
$attending_data = $little->shaz_curl(json_encode($guest_userid), \NsLittle\Little::ROUTE. '/count_attendingguests.php');
//print_r($attending_data);
$decode_attending = json_decode($attending_data);
$total_attending   = $decode_attending->data->attending_guests;

//=============== Count Waiting guests ====================================================================//
$waiting_data = $little->shaz_curl(json_encode($guest_userid), \NsLittle\Little::ROUTE. '/count_waitingguests.php');
//print_r($waiting_data);
$decode_waiting = json_decode($waiting_data);
$total_waiting   = $decode_waiting->data->waiting;

//=============== Count Waiting guests ====================================================================//
$declined_data = $little->shaz_curl(json_encode($guest_userid), \NsLittle\Little::ROUTE. '/count_declinedguests.php');
//print_r($waiting_data);
$decode_declined = json_decode($declined_data);
$total_declined   = $decode_declined->data->declined;

//=====================Wedding website ===============================================================================//
$webuserid = array(
    "id"  => $_SESSION['userid']
);

$webdata = $little->shaz_curl(json_encode($webuserid), \NsLittle\Little::ROUTE.'/display_create_website.php');

$display_website_decode = json_decode($webdata);
//print_r($display_website_decode);

$about_groom     = $display_website_decode->data->about_groom;
$about_bride     = $display_website_decode->data->about_bride;
$ceremony_venue = $display_website_decode->data->church_venue;
$reception_venue = $display_website_decode->data->reception_venue;
$church_time     = $display_website_decode->data->church_time;
$reception_time  = $display_website_decode->data->reception_time;
$town            = $display_website_decode->data->town;
$rsvp_deadline   = $display_website_decode->data->rsvp_deadline;
$guest_message   = $display_website_decode->data->guest_message;
$cover_pic       = $display_website_decode->data->cover_pic;
$ourstory        = $display_website_decode->data->ourstory;
$webgallery      = $display_website_decode->data->webgallery;
$rsvpdate        = strtotime($rsvp_deadline);
?> 
<style>
   
.select2-container.select2-container--bordered-theme .select2-dropdown li:last-child,
.select2-container.select2-container--bordered-theme .select2-dropdown li:last-child::after{
    color: #5897fb;
}
</style>
        
        <div class="body-content">
            <div class="main-contaner">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <h2>My Guest Manager</h2>
                            <button class="btn btn-default" id="add_new_guestlist_button"><i class="fa fa-plus"></i> Add New Guest</button>
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
                                              <?php  echo $guest_count;?>
                                            </div>
                                            <div class="text">
                                                <strong>Total Guests</strong>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                                  <?php echo $total_attending;?>
                                            </div>
                                            <div class="text">
                                                <strong>Accepted</strong>
                                                <small>From Total</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                                <?php echo $total_waiting;?>
                                            </div>
                                            <div class="text">
                                                <strong>Waiting</strong>
                                                <small>From Total</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="couple-status-item">
                                            <div class="counter">
                                                  <?php echo $total_declined;?>
                                            </div>
                                            <div class="text">
                                                <strong>Declined</strong>
                                                <small>From Total</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            
                            <div class="d-flex align-items-center row">
                                <div class="col-md-8">
                                    <p>You can ask your guests to RSVP through your website by clicking on the whatsApp icon.They will get a message with your website link on their whatsApp </p>
                                </div>
                           </div>
                        </div>
                          <div class="ml-3">
                        <ul class="nav nav-pills mb-3 horizontal-tab-second justify-content-center nav-fill" id="pills-tab1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-hr-general-tab" data-toggle="pill" href="#pills-hr-general" role="tab" aria-controls="pills-hr-general" aria-selected="true">All Guests</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-vendor-tab" data-toggle="pill" href="#pills-hr-vendor" role="tab" aria-controls="pills-hr-vendor" aria-selected="false">Attending</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-groom-tab" data-toggle="pill" href="#pills-hr-groom" role="tab" aria-controls="pills-hr-groom" aria-selected="false">Waiting</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-hr-pricing-tab" data-toggle="pill" href="#pills-hr-pricing" role="tab" aria-controls="pills-hr-pricing" aria-selected="false">Declined</a>
                                  </li>
                            </ul>
                        <div class="tab-content" id="pills-tabContent1">
                                <div class="tab-pane fade show active" id="pills-hr-general" role="tabpanel" aria-labelledby="pills-hr-general-tab">
                                    
                             <div class="table-responsive mt-2">
                            <table class="table mb-0" id="example-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Relation</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Invitation Sent</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Share web site Link</th>
                                        <th scope="col">Action</th>
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                        for($g = 0 ; $g < $guest_count ; $g++){     
                                              $mywhstapp = $allguests[$g]->whatsapp; 
                                               $whatsaap = substr_replace($mywhstapp, "254",0,1);
                                        ?>
                                    <tr id="delete-guest<?php echo $allguests[$g]->guest_id;  ?>">
                                        <td class="text-nowrap"><?php echo $allguests[$g]->name; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$g]->relation; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$g]->contact; ?></td>
                                        <?php if($allguests[$g]->invite_sent == 'YES'){?><td class="guest-invite">Yes</td> <?php }else{ ?>  
                                            <td>
                                            <div class="custom-control custom-checkbox form-dark">
                                                <input type="checkbox" class="custom-control-input kecio-chk" id="checkbox<?php echo $allguests[$g]->guest_id;?>">
                                                <label class="custom-control-label pl-0" for="checkbox<?php echo  $allguests[$g]->guest_id;?>">&nbsp;</label>
                                            </div>
                                        </td>
                                                                    <?php } ?>
                                         <td>
                                            <select class="theme-combo select_bordered kecio-gst-status" id="status<?php echo  $allguests[$g]->guest_id; ?>" name="state" style="width: 100%;">
                                               <?php if($allguests[$g]->rsvp === 'Waiting'){?>
                                                <option  value="Waiting">Waiting</option>
                                                 <option value="Attending">Attending</option>
                                                 <option  value="Declined">Declined</option>
                                               <?php }elseif($allguests[$g]->rsvp === 'Attending'){?>
                                                <option  value="Attending">Attending</option>
                                                <option  value="Waiting">Waiting</option>
                                                <option  value="Declined">Declined</option>
                                                <?php }else if($allguests[$g]->rsvp === 'Declined'){ ?>
                                                <option value="Declined">Declined</option>
                                                <option  value="Attending">Attending</option>
                                                 <option value="Waiting">Waiting</option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                       <?php if (!empty($allguests[$g]->whatsapp)){?>
                                        <td><span><a href="https://wa.me/<?php echo $whatsaap;?>?text=Hello%20<?php echo $allguests[$g]->name;?>%2C%20%20it's%20<?php echo $couple_name;?>.%20You%20can%20confirm%20your%20attendance%20to%20my%20wedding%20through%20my%20website,<?php if(!empty($rsvp_deadline)){?>%20kindly%20do%20so%20before%20<?php  echo date("F d, Y",$rsvpdate);?>.<?php } else{}?>%20Click%20the%20link%20below%20to%20RSVP.
                                       <?php echo $website_url.$userid?>%20%20">
                                        <img src="images/native/whatsapp-32.png" width="20px" height="20px">  </a></span></td>
                                       <?php  }else { ?>
                                        <td><img src="images/native/whatsapp-32.png" width="20px" height="20px" class="whatsappno"></td>
                                          <?php }?>
                                        <td class="text-nowrap del-guest" id="delguest-<?php echo $allguests[$g]->guest_id; ?>">
                                            <a href="javascript:" class="action-links"><i class="fa fa-trash"></i></a> </td>
                                    </tr>
                                                                <?php } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>  
                                </div>
                                <div class="tab-pane fade" id="pills-hr-vendor" role="tabpanel" aria-labelledby="pills-hr-vendor-tab">
                               <div class="table-responsive mt-2">
                            <table class="table mb-0" id="attending-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Relation</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Invitation Sent</th>
                                        <th scope="col">Status</th>
                                       
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                        for($ga = 0 ; $ga < $guest_count ; $ga++){     
                                              $contact = $allguests[$ga]->contact; 
                                              if($allguests[$ga]->rsvp === 'Attending'){
                                        ?>
                                    <tr>
                                        <td class="text-nowrap"><?php echo $allguests[$ga]->name; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$ga]->relation; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$ga]->contact; ?></td>
                                        <td class="guest-invite">Yes</td> 
                                        <td class="guest-invite">Attending</td>    
                                       
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
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Relation</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Invitation Sent</th>
                                        <th scope="col">Status</th>
                                       
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                        for($gw = 0 ; $gw < $guest_count ; $gw++){     
                                              $contact = $allguests[$gw]->contact; 
                                              if($allguests[$gw]->rsvp === 'Waiting'){
                                        ?>
                                    <tr>
                                        <td class="text-nowrap"><?php echo $allguests[$gw]->name; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$gw]->relation; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$gw]->contact; ?></td>
                                        <td class="guest-invite">Yes</td> 
                                        <td class="guest-invite">Waiting</td>    
                                      </tr>
                                        <?php } } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                                </div>
                                <div class="tab-pane fade" id="pills-hr-pricing" role="tabpanel" aria-labelledby="pills-hr-pricing-tab">
                                    <div class="table-responsive mt-2">
                            <table class="table mb-0" id="declined-datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Relation</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Invitation Sent</th>
                                        <th scope="col">Status</th>
                                       
                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                        for($gd = 0 ; $gd < $guest_count ; $gd++){     
                                              $contact = $allguests[$gd]->contact; 
                                              if($allguests[$gd]->rsvp === 'Declined'){
                                        ?>
                                    <tr>
                                        <td class="text-nowrap"><?php echo $allguests[$gd]->name; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$gd]->relation; ?></td>
                                        <td class="text-nowrap"><?php echo $allguests[$gd]->contact; ?></td>
                                        <td class="guest-invite">Yes</td> 
                                       <td class="guest-invite">Declined</td>     
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
   <div id="add_new_guestlist_form" class="sliding-panel">
        <div class="card-shadow-header mb-0">
            <div class="dashboard-head">
                <h3>
                   Add Guest
                </h3>
               
            </div>
            
        </div>
        <div class="card-shadow-body">
            <form autocomplete="off" id="gusetlist-form">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <lable>Full Name</lable>
                        <div class="form-group">
                            <input id="guest-list-name" name="guestname" type="text" placeholder="Full Name" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Relation</label>
                        <div class="form-group">
                            <input id="guest-list-family" name="guestnumber" type="text" placeholder="e.g Bride Family, Groom Friend. etc" class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <input id="guestlist-whatsapp-phone" name="phonenumber" type="text" placeholder="Whatsapp Phone Number" class="form-control">&nbsp;<span id="guestlist-whatsapp-err" class="text-danger"></span>
                            <span id="guestlist-whatsapp" class="text-danger small" style="display:none">Invalid Phone number</span>
                        </div>
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <input id="guestlist-phone-number" name="phonenumber" type="text" placeholder="Phone Number" class="form-control">&nbsp;<span id="guestlist-phone-err" class="text-danger"></span>
                            <span id="guestlist-phonecount" class="text-danger small" style="display:none">Invalid Phone number</span>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button type="button" id="savemyguest" class="btn btn-default">Save Guest </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php }else{ include_once 'login.php';}?>   