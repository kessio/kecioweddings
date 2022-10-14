<?php
$get_category = array();

$categories = $little->shaz_curl(json_encode($get_category), \NsLittle\Little::ROUTE.'/get_category.php');
//print_r($categories);
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
//print_r($cat);

$user_id = array(
    
    "user_id"=>$_SESSION['userid']
 
);

$display_profile = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_vendor_profile.php');
$data_decoded    = json_decode($display_profile);
$profile_image  = $data_decoded->data->profile_image;

// couple -------->
$displayprofile = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_profile.php');
//print_r($display_profile);
$profile_decode = json_decode($displayprofile);
$profile_data   = $profile_decode->data;
$my_image       = $profile_data->cimage;
?>
<style>
    .dropdown-menu{
        overflow-y: scroll;
        height: 350px;
    }
</style>

   
        <!-- Main Navigation Start -->
        <nav class="navbar navbar-expand-lg" id="desktop-nav">
            <div class="container-fluid text-nowrap bdr-nav px-0">
                
                <div class="d-flex mx-auto align-items-center"> 
                    <?php if($_SESSION['role'] === "vendor"){ ?>
                    <a class="navbar-brand" href="vendor-dashboard">
                        <img src="images/native/logo/weblogo.png">
                    </a> 
                    <?php } else {?>  
                    <a class="navbar-brand" href="index.php">
                        <img src="images/native/logo/weblogo.png">
                    </a>
                    <?php } ?>
                </div>
                <?php
                         if($_SESSION['user_session_exists'] !== "TRUE"){
                        ?>
                <span class="order-lg-last d-inline-flex ml-3">
                    <a class="btn btn-default mr-2" href="#" role="button" data-toggle="modal" data-target="#general-login"> Login</a>
                    <a class="btn btn-primary d-none d-sm-block" href="#" role="button" data-toggle="modal" data-target="#vendor_form"> <i class="fa fa-plus"></i>Vendor Signup</a>
                </span>
                         <?php } ?>
                
                <!-- Toggle Button Start -->
                
                
                <!-- Toggle Button End -->
    
                <!-- Topbar Request Quote End -->
    
                <div class="collapse navbar-collapse"  data-hover="dropdown"
                    data-animations="slideInUp slideInUp slideInUp slideInUp">
                    <ul class="navbar-nav ml-auto">
                        <?php if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "couple"){?>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php">Home</a>
                       </li>
                        <?php } ?>
                      
                       
                        <?php
                         if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "vendor"){
                        ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendor Dashboard <i class="fa fa-chevron-down"></i></a>    
                          <ul class="dropdown-menu dropdownhover-bottom">
                                        <li><a href="vendor-dashboard">Dashboard</a></li>
                                        <li><a href="vendor-listing">My Listings</a></li>
                                         <li><a href="vendor-reviews">Reviews</a></li>
                                         <!--<li><a href="pricings">Pricing Table</a></li>--->
                                       
                                       <li><a href="vendor-receipt">Transactions</a></li>
                                   </ul>  
                        </li>
                        
                       <li class="nav-item dropdown user-profile ml-4">
                            <a class="nav-link" href="index.php" id="dropdown04" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"> <?php if(empty($profile_image)){?><img src="assets/images/dashboard/avatar_img.jpg" alt=""> <?php  } else {?><img src="images/profile_pic/<?php echo $profile_image;?>" alt=""><?php } ?>
                                <i class="fa fa-angle-down"><?php echo $_SESSION['business_name'];?></i>
                            </a>
                            <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" aria-labelledby="dropdown04">
                                
                                <li><a class="dropdown-item" href="vendor-profile">My Profile</a></li>
                                <li><a class="dropdown-item"  href="index.php?logout=true">Logout</a></li>
                            </ul>
                        </li>

                         <?php } ?>
                      <!---- ADMIN SESSION --------------------------------->
                       
                        <?php
                         if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "admin"){
                        ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin Dashboard <i class="fa fa-chevron-down"></i></a>    
                          <ul class="dropdown-menu dropdownhover-bottom">
                                        <li><a href="admin-dashboard">Dashboard</a></li>
                                        <li><a href="admin-couples">Couples</a></li>
                                        <li><a href="admin-vendors">Vendors</a></li>
                                        <li><a href="admin-listings">Listings</a></li>
                                        <li><a href="admin-reviews">Reviews</a></li>
                                        <li><a href="admin-pricing">Pricing</a></li>
                                        <li><a href="admin-weddings">Weddings</a></li>
                                        <li><a href="admin-websites">Weddings</a></li>
                                        
                                        
                                    </ul>  
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?logout=true">Logout</a>
                       </li>

                         <?php } ?>
                       
                       <?php
                         if($_SESSION['user_session_exists'] !== "TRUE"){
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="javascript:" id="dropdown03" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Vendors <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom" style='overflow-y:auto' aria-labelledby="dropdown03">
                                <li><a class="dropdown-item" href="suppliers-list/">All Vendors</a></li>
                                <?php 
                                                  for($n = 0; $n < count($cat); $n++){
                                                    $cat_ids = $cat[$n]->cat_id; 
                                                     $cat_name = $cat[$n]->name; 

                                                     //echo $cat_name;  
                                                  ?>
                                <li><a class="dropdown-item" href="suppliers-list/<?php echo $cat_ids;?>"><?php echo $cat_name;?></a></li>
                                                  <?php } ?>         
                            </ul>
                        </li>
                        
                        
                      <li class="nav-item">
                           <a class="nav-link text-info" data-toggle="modal" data-target="#login_form">Register</a>
                       </li>
                       
                         <?php } ?>
                       <?php
                         if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "couple"){
                        ?>
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="javascript:" id="dropdown03" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Vendors <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom" style='overflow-y:auto' aria-labelledby="dropdown03">
                                <li><a class="dropdown-item" href="suppliers-list/">View All</a></li>
                                <?php 
                                                  for($n = 0; $n < count($cat); $n++){
                                                    $cat_ids = $cat[$n]->cat_id; 
                                                     $cat_name = $cat[$n]->name; 

                                                     //echo $cat_name;  
                                                  ?>
                                <li><a class="dropdown-item" href="suppliers-list/<?php echo $cat_ids;?>"><?php echo $cat_name;?></a></li>
                                                  <?php } ?>         
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Planning Tools <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom">                                
                                <li><a class="dropdown-item" href="couple-dashboard">Dashboard</a></li>                                
                                <li><a class="dropdown-item" href="couple-guestlist">Guest List</a></li>
                                <li><a class="dropdown-item" href="couple-todolist">To-do List</a></li>
                                <li><a class="dropdown-item" href="couple-budget">Budgeter</a></li>
                                <li><a class="dropdown-item" href="couple-vendormanager">Vendor Manager</a>
                                <li><a class="dropdown-item" href="couple-realwed">Real Wedding</a></li>
                                <li><a class="dropdown-item" href="couple-website">Wedding Website</a></li>
                                <li><a class="dropdown-item" href="couple-reviews">My Reviews</a></li>
                            </ul>
                        </li>
                        
                       <li class="nav-item dropdown user-profile ml-4">
                            <a class="nav-link" href="index.html" id="dropdown04" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"> <?php if(empty($my_image)){?><img src="assets/images/dashboard/avatar_img.jpg" alt=""> <?php  } else {?><img src="images/profile_pic/<?php echo $my_image;?>" alt=""><?php } ?>
                                <i class="fa fa-angle-down"><?php echo $_SESSION['name'];?></i>
                            </a>
                            <ul class="dropdown-menu dropdownhover-bottom dropdown-menu-right" aria-labelledby="dropdown04">
                                
                                <li><a class="dropdown-item" href="couple-profile">My Profile</a></li>
                                <li><a class="dropdown-item"  href="index.php?logout=true">Logout</a></li>
                            </ul>
                        </li>
                       
                         <?php } ?>
                       
                    </ul>
                    <!-- Main Navigation End -->
                </div>
            </div>
        </nav>
        <!-- Main Navigation End -->







