<?php
$get_category = array();

$categories = $little->shaz_curl($get_category, \NsLittle\Little::ROUTE.'/get_category.php');
//print_r($categories);
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
//print_r($cat);
?>
<style>
    .dropdown-menu{
        overflow-y: scroll;
        height: 350px;
    }
</style>
<header class="fixed-top header-anim">    
        <!-- Main Navigation Start -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid text-nowrap bdr-nav px-0">
                <a href="javascript:" class="sidebar-toggle mobile" data-toggle="offcanvas">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="d-flex mx-auto align-items-center">                    
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/images/logo_dark.svg" alt="">
                    </a> 
                                      
                </div>
                
                <!-- Toggle Button Start -->
                <button class="navbar-toggler x collapsed" type="button" data-toggle="offcanvas-mobile"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Toggle Button End -->
    
                <!-- Topbar Request Quote End -->
    
                <div class="collapse navbar-collapse offcanvas-collapse-mobile" id="navbarCollapse" data-hover="dropdown"
                    data-animations="slideInUp slideInUp slideInUp slideInUp">
                    <ul class="navbar-nav ml-auto">
                        
                        <?php
                         if($_SESSION['vendor_session_exists'] === "TRUE"){
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vendor Dashboard <i class="fa fa-chevron-down"></i></a>    
                          <ul class="dropdown-menu dropdownhover-bottom">
                                        <li><a href="vendor-dashboard">Dashboard</a></li>
                                        <li><a href="vendor-listing">My Listing</a></li>
                                         <li><a href="vendor-reviews">Reviews</a></li>
                                        <li><a href="vendor-pricing">Pricing Table</a></li>
                                       <li><a href="vendor-profile">My Profile</a></li>
                                        <li><a href="javascript:">Logout</a></li>
                                    </ul>  
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="index.php?logout=true">Logout</a>
                       </li>

                         <?php } ?>
                       <?php
                         if($_SESSION['vendor_session_exists'] !== "TRUE"){
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-mob" href="index.html" id="dropdown03" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Vendors <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom" style='overflow-y:auto' aria-labelledby="dropdown03">
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
                            <a class="nav-link dropdown-toggle-mob" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Planning Tools <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu dropdownhover-bottom">                                
                                <li><a class="dropdown-item" href="couple-dashboard">Dashboard</a></li>                                
                                <li><a class="dropdown-item" href="couple-guestlist">Guest List</a></li>
                                <li><a class="dropdown-item" href="couple-todolist">To-do List</a></li>
                                <li><a class="dropdown-item" href="couple-budget">Budgeter</a></li>
                                <li><a class="dropdown-item" href="couple-rsvp">RSVP</a></li>
                                <li><a class="dropdown-item" href="couple-website">Wedding Website</a></li>                                
                            </ul>
                        </li>
                       <li class="nav-item">
                           <a class="nav-link" data-toggle="modal" data-target="#login_form">Login</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link text-info" data-toggle="modal" data-target="#login_form">Register</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link text-info" data-toggle="modal" data-target="#vendor_form">Vendor Register/Login</a>
                       </li>
                         <?php } ?>

                    </ul>
                    <!-- Main Navigation End -->
                </div>
            </div>
        </nav>
        <!-- Main Navigation End -->
    </header>







