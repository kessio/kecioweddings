<?php
if($_SESSION['user_session_exists'] === "TRUE"){
$user_id = array(
    
     "user_id"=>$_SESSION['userid']
);
//print_r($user_id);
$wedinfo = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_profile.php');
$wedinfo_decode = json_decode($wedinfo);
$wedinfo_data = $wedinfo_decode->data;
$groom_pic    = $wedinfo_data->groom_pic;
$bride_pic    = $wedinfo_data->bride_pic;
$facebook     = $wedinfo_data->facebook;
$instagram    = $wedinfo_data->instagram;
$bio_image     = $wedinfo_data->bio_img;
// vendor manager====================================================================================================//
$favourite = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/group_favourite.php');
$decode_favourite = json_decode($favourite);
$favs = $decode_favourite->favourites;

// todo list ========================================================================================================////
 $data = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/loop_startdate.php');
 $task_decoded  = json_decode($data);
 $tasks = $task_decoded->todo;
 $tasks_count = count($tasks);
//=========== Count complete ==================================================================
$dataa = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/count_status.php');
$status_decoded = json_decode($dataa);
$complete = $status_decoded->data;
//===============================count all tasks===========================================================================
  $all_data = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/count_tasks.php');
  $all_decoded = json_decode($all_data);
  $all_tasks = $all_decoded->data;
//================================Count Guestlist==========================================================================
$gustdata = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_guests.php');
$guestdata_decoded = json_decode($gustdata);
$allguests = $guestdata_decoded->data;
$guest_count = count($allguests);
//=============== Count Attending guests ====================================================================//
$attending_data = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE. '/count_attendingguests.php');
$decode_attending = json_decode($attending_data);
$total_attending   = $decode_attending->data->attending_guests;
//====================================Total budget===========================================================================///
$budget_total = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/budget_total.php');
$budget_decode = json_decode($budget_total);
$sumbudget = $budget_decode->data;
$sum_estimate     = $budget_decode->data->estimate;
$sum_actual       = $budget_decode->data->actual;
$sum_paid         = $budget_decode->data->paid;
$sum_pending       = $budget_decode->data->pending;
//====================== Count hired==========================================================================//
$hiredvendor = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/count_hired.php');
$decode_hired = json_decode($hiredvendor);
$hired = $decode_hired->data->hired;

$fav = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/count_favourites.php');
//print_r($fav);
$decode_fav = json_decode($fav);
$count_fav = $decode_fav->data->favorites;


//=================================================================================================================
$website_id = array( "id"=>$_SESSION['userid'] );    
$display_data = $little->shaz_curl(json_encode($website_id), \NsLittle\Little::ROUTE.'/website_info.php');
$data_decoded = json_decode($display_data);
$bride           = $data_decoded->data->bride_name;
$groom           = $data_decoded->data->groom_name;
$weddingaddress  = $data_decoded->data->wedding_venue;
$weddingdate     = $data_decoded->data->wedding_date;
$newdate = strtotime($weddingdate);
$wedding_date = date("F d, Y",$newdate);
$explode_bride = explode(" ", $bride);
$explode_groom = explode(" ", $groom);

// ================================Search vendors by location==========================================//
$getlocation = array();
$get_location =$little->shaz_curl(json_encode($getlocation), \NsLittle\Little::ROUTE.'/loop_location.php');
//print_r($get_location);
$location_decode = json_decode($get_location);
$mylocations = $location_decode->todo;

//=================== categories=============================================================//
$get_category = array();

$categories = $little->shaz_curl(json_encode($get_category), \NsLittle\Little::ROUTE.'/get_category.php');
//print_r($categories);
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
 

?>


        <div class="body-content">
            <div class="main-contaner">
                <div class="container">
               <input id="bio-wedding-date" type="hidden" value="<?php echo $wedding_date;?>">
                    <!-- Couple Info Section -->
                    <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                            <div class="row">
                                <div class="col-lg-6 col-xl-5">
                                    <div class="d-flex align-items-center h-100">
                                        <div class="couple-img">
                                            <img src="images/bride_groom/<?php echo $bio_image;?>" class="" alt="">
                                            <div class="couple-btn">
                                                <input type="file" name="couple-coverpic" class="image" id="couple-coverpic" style="display:none" accept="image/*" />
                                                <label class="btn btn-outline-white" for="couple-coverpic"><i class="fa fa-camera"></i> Photo</label>
                                               
                                            </div>
                                        </div>
                                        <div class="couple-counter">
                                            <ul id="wedding-countdown" class="list-unstyled list-inline">
                                                <li class="list-inline-item" id="mydays" ></li>
                                                <li class="list-inline-item" id="myhours" ></li>
                                                <li class="list-inline-item" id="myminutes" ></li>
                                                <li class="list-inline-item" id="myseconds" ></li>
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="col-lg-6 col-xl-7">
                                    <div class="couple-info">
                                        <div class="edit-btn">
                                            <a href="couple-profile" class="btn btn-outline-white btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                        </div>
                                        <div class="text-center">
                                            <div class="couple-avatar">
                                                <img src="images/bride_groom/<?php echo  $groom_pic;?>" alt="">
                                                <img src="images/bride_groom/<?php echo  $bride_pic;?>" alt="">

                                            </div>
                                            <h2><?php echo $explode_groom[0];  ?> & <?php echo $explode_bride[0] ;?></h2>
                                            <span class="save-date">Are getting married on <i class="fa fa-calendar"></i> <?php echo $_SESSION['wedding_date'];?></span>
                                        </div>

                                        <div class="couple-status">
                                            
                                            <div class="small-text">
                                                
                                                <span>Just said yes? Let's get started!</span>
                                            </div>
                                        </div>

                                        <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2">
                                            <div class="col">
                                                <div class="couple-status-item">
                                                    <div class="counter">
                                                        <?php echo $hired;?>
                                                    </div>
                                                    <div class="text">
                                                        <strong>Out of <?php echo $count_fav;?></strong>
                                                        <small>services hired</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="couple-status-item">
                                                    <div class="counter">
                                                        <?php echo $complete;?> 
                                                    </div>
                                                    <div class="text">
                                                        <strong>Out of <?php echo $all_tasks;?></strong>
                                                        <small>Tasks completed</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="couple-status-item">
                                                    <div class="counter">
                                                        <?php echo $total_attending;?>
                                                    </div>
                                                    <div class="text">
                                                        <strong>Out of <?php echo $guest_count;?></strong>
                                                        <small>Guests attending</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Couple Info Section -->

                    <div class="row">
                        <div class="col-xl-8">
                            <!-- Vendor Team -->
                            <div class="card-shadow">
                                <div class="card-shadow-header">
                                    <div class="dashboard-head">
                                        <h3>
                                            <span>Like vendors to save them on your vendor manager</span>
                                            Your vendor team
                                        </h3>
                                        <div class="links">
                                            <a href="couple-vendormanager">View all my vendors <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-light">
                                    <div class="card-shadow-body">
                                        <div class="row align-items-center">
                                            <div class="col-md mb-3 mb-md-0">
                                                <input type="text" id="box"  list="categories" name="category" class="form-control form-light" placeholder="Start your search">
                                                <datalist id="categories">
                         <?php 
                            for($n = 0; $n < count($cat); $n++){
                              $cat_ids = $cat[$n]->cat_id; 
                               $cat_name = $cat[$n]->name; 

                               //echo $cat_name;  
                            ?>
                       <option data-value="<?php  echo $cat_ids ;?>"  value="<?php echo $cat_name ;?>"></option>
                            <?php  } ?>   
                      </datalist>
                                            </div>
                                            <div class="col-md mb-3 mb-md-0">
                                                <input type="text" id="location-box" list="locations" class="form-control form-light" placeholder="Where">
                                                <datalist id="locations">
                                        <?php
                                       for($l= 0; $l < count($mylocations); $l++){
                                         $records = $mylocations[$l]->records;      
                                        ?>
                                  <option data-value="<?php echo $mylocations[$l]->county_id;?>" value="<?php echo $mylocations[$l]->county_name ;?>" style="font-size: 20px;"> </option>

                                       <?php    }?>  
                                     </datalist>
                                            </div>
                                            <div class="col-md-auto">
                                                <a href="javascript:" id="mymama" class="btn btn-default">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-shadow-body pb-2">
                                    <div class="row">
                                         <?php
                                      for($t = 0; $t < count($favs); $t++){
                                        $records = $favs[$t]->records;
                                       // print_r($records);
                                      $fav_category = $favs[$t]->cat_id;
                                      //print_r($fav_category);
                                       
                              
                                    
                                    
                                       ?>
                                        <div class="col-md-4">
                                            <div class="dash-categories selected" style="background-color:#434645; background-size: cover;">
                                             <div class="edit">
                                                    <a href="couple-vendormanager"><i class="fa fa-pencil"></i></a>
                                                </div>
                                                <div class="head">
                                                   <?php if($fav_category== 0) {?>
                                     <i class="weddingdir_bell"></i>
                                    <?php }else if ($fav_category == 1){?>
                                    <i class="weddingdir_heart_double_face"></i>
                                    <?php } elseif($fav_category == 2){?>
                                     <i class="weddingdir_cake"></i>
                                    <?php } elseif($fav_category == 3){?>
                                     <i class="weddingdir_guitar"></i>
                                    <?php } elseif($fav_category == 4){?>
                                     <i class="weddingdir_florist"></i>
                                    <?php } elseif($fav_category == 5){?>
                                     <i class="weddingdir_location_heart"></i>
                                    <?php } elseif($fav_category == 6){?>
                                     <i class="weddingdir_tent"></i>
                                    <?php } elseif($fav_category == 7){?>
                                     <i class="weddingdir_camera"></i>
                                    <?php } elseif($fav_category == 8){?>
                                     <i class="weddingdir_videographer"></i>
                                    <?php } elseif($fav_category == 9){?>
                                     <i class="weddingdir_pheras"></i>
                                    <?php } elseif($fav_category == 10){?>
                                     <i class="weddingdir_seating_chart"></i>
                                    <?php } elseif($fav_category == 11){?>
                                     <i class="weddingdir_fashion"></i>
                                    <?php } elseif($fav_category == 12){?>
                                     <i class="weddingdir_vendor_manager"></i>
                                    <?php } elseif($fav_category == 13){?>
                                     <i class="weddingdir_heart_envelope"></i>
                                    <?php }elseif($fav_category == 14){?>
                                     <i class="weddingdir_church"></i>
                                    <?php } elseif($fav_category == 15){?>
                                     <i class="weddingdir_vendor_truck"></i>
                                    <?php } elseif($fav_category == 16){?>
                                     <i class="weddingdir_venue"></i>
                                    <?php }  ?>
                                                    <?php if($fav_category == 0){ echo "No vendor liked";}else{ echo  $favs[$t]->category;} ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                      <?php  }?>
                                        
                                        
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Vendor Team -->
                              <div class="card-shadow">
                                <div class="card-shadow-header">
                                    <div class="dashboard-head">
                                        <h3>
                                            <span><?php echo $complete;?> tasks completed</span>
                                            Upcoming tasks
                                        </h3>
                                        <div class="links">
                                            <a href="couple-todolist">View all tasks <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-shadow-body p-0">
                                    <div class="upcoming-task">
                                        <ul class="list-unstyled">
                                             <?php
                        for($t = 0 ; $t < $tasks_count ; $t ++){  
                        $records = $tasks[$t]->records;
                         for($i = 0; $i < 8; $i ++){
                             if($records[$i]->status === 'pending'){          
                                      
                        ?>
                                            <li id="mtodo-<?php echo $records[$i]->todo_id ; ?>">
                                                <div class="d-flex align-items-center">
                                        <div class="custom-control custom-checkbox form-dark">
                                            <?php  if($records[$i]->status == 'complete'){ $checked = "checked"; }else{ $checked = "";} ?> 
                                            <input type="checkbox" class="custom-control-input option-input kecio_chk" id="customCheck<?php echo $records[$i]->todo_id ; ?>" <?php echo $checked;?>/>
                                            <label class="custom-control-label <?php echo $checked;?>-label-text" for="customCheck<?php echo $records[$i]->todo_id ; ?>">
                                                <span class="label-text"> <?php echo $records[$i]->task;  ?></span>
                                                <small>Due: <?php $duedate = strtotime($records[$i]->duedate);  if($duedate){  echo date("F d, Y",$duedate);}else{echo "unsheduled";}?><input type="hidden" name="duedate" id="duedate-<?php echo $records[$i]->todo_id;?>" value="<?php echo $records[$i]->duedate;?>"/></span></small>
                                          </label>
                                        </div>
                                    </div>
                                            </li>
                        <?php } } } ?>                                
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                       </div>

                        <div class="col-xl-4">
                            <!-- Guest List -->
                            <div class="card-shadow">
                                <div class="card-shadow-header">
                                    <div class="dashboard-head">
                                        <h3>
                                            Guest List
                                        </h3>
                                        <div class="links">
                                            <a href="couple-guestlist">See Guest List <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-shadow-body">
                                    <div class="empty-guest-list">
                                        <i class="weddingdir_guest_member"></i>
                                        <?php if($guest_count === 0){?>
                                        <p>You haven't added any guests yet</p>
                                        <?php }else{ ?>
                                        <p>You have added: <?php  echo $guest_count;  ?> Guests</p>
                                        <?php } ?>
                                        <a class="btn btn-outline-default btn-rounded" id="add_new_guestlist_button" href="javascript:">Add guest</a>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Guest List -->

                            <!-- Budget -->
                            <div class="card-shadow">
                                <div class="card-shadow-header">
                                    <div class="dashboard-head">
                                        <h3>
                                            Budget
                                        </h3>
                                        <div class="links">
                                            <a href="couple-budget">View Budget <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-shadow-body">
                                    <div class="budget-estimation">
                                        <div class="d-flex w-100">
                                            <div class="etimated-cost">
                                                <div class="icon"><i class="weddingdir_saving_money"></i></div> 
                                                <p class="cost-price"><?php echo "ksh ". number_format(round($sum_actual,2),0);?></p>
                                                <div>Total cost</div>
                                            </div>
                                            <div class="etimated-cost">
                                                <div class="icon"><i class="weddingdir_money_stack"></i></div>
                                                <p class="cost-price final"><?php echo "ksh ". number_format(round($sum_paid,2),0);?></p>
                                                <div>Money Paid</div>
                                            </div>
                                        </div>
                                        
                                        <a class="btn btn-outline-default btn-rounded" href="couple-budget">Manage expenses</a>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Budget -->
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

<!---- Add new guest slide panel -------------------------------------------->
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
                            <input id="guestlist-phone-number" name="phonenumber" type="text" placeholder="Whatsapp Phone Number" class="form-control">&nbsp;<span id="guestlist-phone-err" class="text-danger"></span>
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
<?php } else { include_once 'login.php';}?>
    
    

    