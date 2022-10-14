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
?>
<style>
    .dropdown-menu{
        overflow-y: scroll;
        height: 350px;
    }
</style>
   
        <!-- Main Navigation Start -->
        <nav class="navbar navbar-expand-lg" id="mobile-nav">
            <div class="container-fluid text-nowrap bdr-nav px-0">
               <?php   if($_SESSION['user_session_exists'] === "TRUE"){ ?>
                 <a href="javascript:" class="sidebar-toggle mobile" data-toggle="offcanvas">
                     <i class="fa fa-bars"></i>
                     
                </a>
               <?php }else{ ?>     
                <a href="javascript:" class="sidebar-toggle mobile" data-toggle="offcanvas">
                    <i class="fa fa-user-circle fa-2x"></i>
                </a>
               <?php } ?>
              
                 <?php
                if($_SESSION['role'] === "vendor"){ ?>
                <div class="d-flex mx-auto align-items-center">                    
                    <a class="navbar-brand" href="vendor-dashboard">
                        <img src="images/native/logo/mobilelogo.png" alt="">
                    </a> 
                 </div>
                <?php  }else{  ?>
                <div class="d-flex mx-auto align-items-center">                    
                    <a class="navbar-brand" href="index.php">
                        <img src="images/native/logo/mobilelogo.png" alt="">
                    </a> 
                 </div>
                
                <?php } ?>
               
                <!-- Toggle Button Start -->
               <?php
                if($_SESSION['user_session_exists'] !== "TRUE" ||  $_SESSION['role'] === "couple"){ ?>
               
                <button class="navbar-toggler x collapsed" type="button" data-toggle="offcanvas-mobile"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php } ?>
                <!-- Toggle Button End -->
    
                <!-- Topbar Request Quote End -->
    
                <div class="collapse navbar-collapse offcanvas-collapse-mobile" id="navbarCollapse" data-hover="dropdown"
                    data-animations="slideInUp slideInUp slideInUp slideInUp">
                    <ul class="navbar-nav ml-auto">
                       
                       
                       <?php
                         if($_SESSION['user_session_exists'] !== "TRUE" || ($_SESSION['user_session_exists'] == "TRUE" &&  $_SESSION['role'] == "couple")){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="suppliers-list/">All Vendors</a>
                      </li> 
                       <?php 
                        for($n = 0; $n < count($cat); $n++){
                             $cat_ids = $cat[$n]->cat_id; 
                              $cat_name = $cat[$n]->name; 
                           ?>
                        <li class="nav-item">
                           <a class="nav-link" href="suppliers-list/<?php echo $cat_ids;?>"><?php echo $cat_name;?></a>
                       </li>
                         <?php } } ?>
                    
                      
                    </ul>
                    <!-- Main Navigation End -->
                </div>
            </div>
        </nav>
        <!-- Main Navigation End -->
   







