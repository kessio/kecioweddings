<?php
$user_id = array(
    
    "user_id"=>$_SESSION['userid']
 
);

$display_profile = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_vendor_profile.php');
$data_decoded    = json_decode($display_profile);
$profile_image  = $data_decoded->data->profile_image;


?>
<aside class="offcanvas-collapse">
          <?php
           if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "vendor"){
                 ?>
               <div class="avatar-wrap">
              
                <h3><?php echo $_SESSION['business_name']?></h3>                
            </div>
                 <div class="sidebar-nav">
                     
                <ul class="list-unstyled">
                    <li>
                        <a href="vendor-dashboard"><i class="weddingdir_dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="vendor-listing"><i class="weddingdir_my_listing"></i> My Listing</a>
                    </li>
                  <!--  <li>
                        <a href="pricings"><i class="weddingdir_pricing_plans"></i> Pricing Table</a>
                    </li> -->
                    
                    <li>
                        <a href="vendor-reviews"><i class="weddingdir_reviews"></i> Reviews</a>
                    </li>
                    
                    <li>
                        <a href="vendor-profile"><i class="weddingdir_my_profile"></i> My Profile</a>
                    </li>
                    <li>
                        <a href="vendor-receipt"><i class="weddingdir_invoice"></i>Transactions</a>
                    </li>
                    <li>
                        <a href="index.php?logout=true"><i class="weddingdir_logout"></i> Logout</a>
                    </li>
                </ul>
            </div>
               <?php }else if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "couple"){ ?>
                 <div class="avatar-wrap">
              
                <h3><?php echo $_SESSION['name']?></h3>                
            </div>
             <div class="sidebar-nav">
                <ul class="list-unstyled">
                     <li>
                        <a href="couple-dashboard"><i class="weddingdir_heart_ring"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="couple-todolist"><i class="weddingdir_checklist"></i> To-Do List</a>
                    </li>
                    <li>
                        <a href="couple-vendormanager"><i class="weddingdir_vendor_manager"></i> Vendor Manager</a>
                    </li>
                    <li>
                        <a href="couple-guestlist"><i class="weddingdir_guestlist"></i> Guest List</a>
                    </li>
                    <li>
                        <a href="couple-budget"><i class="weddingdir_budget"></i> Budget</a>
                    </li>
                    <li>
                        <a href="couple-realwed"><i class="weddingdir_dove"></i> Real Wedding</a>
                    </li>
                    
                     <li>
                        <a href="couple-profile"><i class="weddingdir_my_profile"></i> My Profile</a>
                    </li>
                    <li>
                        <a href="couple-website"><i class="weddingdir_websote_demo"></i> Wedding Website</a>
                    </li>
                    <li>
                        <a href="index.php?logout=true"><i class="weddingdir_logout"></i> Logout</a>
                    </li>
                </ul>
            </div>
    
           <?php }else if($_SESSION['user_session_exists'] === "TRUE" && $_SESSION['role'] === "admin"){ 
          
                 ?>
                 <div class="sidebar-nav">
                <ul class="list-unstyled">
                    <li>
                        <a href="admin-dashboard"><i class="weddingdir_dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="admin-vendors"><i class="weddingdir_my_profile"></i>Vendors</a>
                    </li>
                    <li>
                        <a href="admin-couples"><i class="weddingdir_my_profile"></i>Couples</a>
                    </li>
                    <li>
                        <a href="admin-listings"><i class="weddingdir_my_listing"></i> Listing</a>
                    </li>
                    <li>
                        <a href="Paid"><i class="weddingdir_pricing_plans"></i>Subscriptions</a>
                    </li>
                    
                    <li>
                        <a href="admin-reviews"><i class="weddingdir_reviews"></i> Reviews</a>
                    </li>
                    
                    
                    <li>
                        <a href="index.php?logout=true"><i class="weddingdir_logout"></i> Logout</a>
                    </li>
                </ul>
            </div>
               <?php }else{ ?> 
  
<li class="nav-item list-unstyled">
    <a class="nav-link" data-toggle="modal" data-target="#general-login">Login</a>
</li>
<li class="nav-item list-unstyled">
    <a class="nav-link text-info" data-toggle="modal" data-target="#login_form">Register</a>
</li>
<li class="nav-item list-unstyled">
    <a class="nav-link text-info" data-toggle="modal" data-target="#vendor_form">Vendor Register</a>
</li>
         <?php }?>
        </aside>