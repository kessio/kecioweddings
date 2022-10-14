<?php

if($_SESSION['user_session_exists'] === "TRUE"){
$user_id = array(
    
     "user_id"=>$_SESSION['userid']
);

//print_r($display_budgetcat);

$info = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/display_budgetcategory.php');
//print_r($info);
$budgetcat_decoded = json_decode($info);
//print_r($budgetcat_decoded);
$category = $budgetcat_decoded->budget_group;
//print_r($category);

$first_records = $category[0]->records;
//print_r($first_records);

$get_category = array();

$categories = $little->shaz_curl(json_encode($get_category), \NsLittle\Little::ROUTE.'/get_category.php');
//print_r($categories);
$categories_decode = json_decode($categories);
$cat = $categories_decode->data;
//print_r($cat);

$budget_total = $little->shaz_curl(json_encode($user_id), \NsLittle\Little::ROUTE.'/budget_total.php');
//print_r($budget_total);
$budget_decode = json_decode($budget_total);
$sumbudget = $budget_decode->data;


    $sum_estimate     = $budget_decode->data->estimate;
    $sum_actual       = $budget_decode->data->actual;
    $sum_paid         = $budget_decode->data->paid;
   $sum_pending       = $budget_decode->data->pending;
include_once 'modals/modals-edit-budget.php';
include_once 'modals/modals-delete-budget-item.php';
//include_once 'modals/delete_budget_category.php';


?>
 <!-- =============================
       *
       *   Page Content Start
       *
    =============================== -->
 <style>
    .budget-head-icon {
    color: #FFF;
    background:#F48F00;
}

.select2-dropdown {
    overflow-y: scroll;
    height: 350px;
}

</style>
        <div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <h2>My Budget</h2>
                            
                        </div>
                    </div>
                    <!-- Page Heading -->
                      <div  class="card-shadow">
                        <div class="card-shadow-header">Add New Budget</div>
                <div class="card-shadow-body">
           <form>
                <div class="row">
                   <div class="col-md-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-light-select theme-combo home-select-cat" id="budget-category-id" name="state">
                            <option value="0">Choose Category</option>
                           <?php 
                            for($n = 0; $n < count($cat); $n++){
                              $cat_ids = $cat[$n]->cat_id; 
                               $cat_name = $cat[$n]->name; 

                               //echo $cat_name;  
                            ?>
                         <option value="<?php  echo $cat_ids ;?>"><?php echo $cat_name ;?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    </div>
                   <div class="col-md-6">
                    <div class="form-group">
                        <label>Expense</label>
                        <input type="text" class="form-control"  name="expense" id="budget-expense" placeholder="e.g Kecio Gardens">
                    </div>
                </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                         <label>Estimate Cost</label>
                        <input type="text" class="form-control"  name="Estimate" id="budget-estimate" placeholder="Estimate Cost">
                    </div>
                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                         <label>Actual Cost</label>
                        <input type="text" class="form-control"  name="Actual" id="budget-actual" placeholder="Actual Cost">
                    </div>
                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                         <label>Paid Cost</label>
                        <input type="text" class="form-control"  name="Paid" id="budget-paid" placeholder="paid">
                    </div>
                </div>
                    <div class="col-md-12">
                    <button type="button" id="save-mybudget" class="btn btn-primary btn-rounded">Add Budget</button>
                    <button type="button" id="load-budget" class="btn btn-primary btn-rounded buttonload" style="display:none"><i class="fa fa-spinner fa-spin"></i>Loading</button>
                </div> 
                </div>
            </form>
        </div>
    </div>
        <!------- budget=================================================================== --> 
            <ul class="nav nav-pills mb-3 horizontal-tab-second justify-content-center nav-fill" id="pills-tab1-budget" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-hr-general-tab-budget" data-toggle="pill" href="#pills-hr-general-budget" role="tab" aria-controls="pills-hr-general-budget" aria-selected="true">My budget</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-hr-vendor-tab-budget" data-toggle="pill" href="#pills-hr-vendor-budget" role="tab" aria-controls="pills-hr-vendor-budget" aria-selected="false">Download Budget</a>
                </li>
              </ul>
        
        <div class="tab-content" id="pills-tab-budgetContent1">
            <div class="tab-pane fade show active" id="pills-hr-general-budget" role="tabpanel" aria-labelledby="pills-hr-general-budget-tab">
              
               <div class="row">
                        <!-- Budget Start -->
                        <div class="col-12 col-lg-3">
                            <div class="nav flex-column nav-pills theme-tabbing-vertical budget-tab" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                               <a class="nav-link active" id="v-pills-<?php echo $category[0]->cat_id;?>-tab" data-toggle="pill" href="#v-pills-<?php echo $category[0]->cat_id;?>" role="tab"
                                aria-controls="v-pills-<?php echo $category[0]->cat_id;?>" aria-selected="true">
                                   <?php if($category[0]->cat_id == 0) {?>
                                     <i class="weddingdir_bell"></i>
                                    <?php }else if ($category[0]->cat_id == 1){?>
                                    <i class="weddingdir_heart_double_face"></i>
                                    <?php } elseif($category[0]->cat_id == 2){?>
                                     <i class="weddingdir_cake"></i>
                                    <?php } elseif($category[0]->cat_id == 3){?>
                                     <i class="weddingdir_guitar"></i>
                                    <?php } elseif($category[0]->cat_id == 4){?>
                                     <i class="weddingdir_florist"></i>
                                    <?php } elseif($category[0]->cat_id == 5){?>
                                     <i class="weddingdir_location_heart"></i>
                                    <?php } elseif($category[0]->cat_id == 6){?>
                                     <i class="weddingdir_tent"></i>
                                    <?php } elseif($category[0]->cat_id == 7){?>
                                     <i class="weddingdir_camera"></i>
                                    <?php } elseif($category[0]->cat_id == 8){?>
                                     <i class="weddingdir_videographer"></i>
                                    <?php } elseif($category[0]->cat_id == 9){?>
                                     <i class="weddingdir_pheras"></i>
                                    <?php } elseif($category[0]->cat_id == 10){?>
                                     <i class="weddingdir_seating_chart"></i>
                                    <?php } elseif($category[0]->cat_id == 11){?>
                                     <i class="weddingdir_fashion"></i>
                                    <?php } elseif($category[0]->cat_id == 12){?>
                                     <i class="weddingdir_vendor_manager"></i>
                                    <?php } elseif($category[0]->cat_id == 13){?>
                                     <i class="weddingdir_heart_envelope"></i>
                                    <?php }elseif($category[0]->cat_id == 14){?>
                                     <i class="weddingdir_church"></i>
                                    <?php } elseif($category[0]->cat_id == 15){?>
                                     <i class="weddingdir_vendor_truck"></i>
                                    <?php } elseif($category[0]->cat_id == 16){?>
                                     <i class="weddingdir_venue"></i>
                                    <?php }  ?>
                                   
                                       <?php if($category[0]->cat_id == 0){ echo "Other";}else{echo $category[0]->category; }?></a>
                                <?php
                                      for($tcat = 1; $tcat < count($category); $tcat++){
                                        //$records = $category[$t]->records;
                                       ?>
                                
                                
                                
                                <a class="nav-link " id="v-pills-<?php echo $category[$tcat]->cat_id;?>-tab" data-toggle="pill" href="#v-pills-<?php echo $category[$tcat]->cat_id;?>" role="tab"
                                aria-controls="v-pills-<?php echo $category[$tcat]->cat_id;?>" aria-selected="true">
                                    <?php if($category[$tcat]->cat_id == 0) {?>
                                     <i class="weddingdir_bell"></i>
                                    <?php }else if ($category[$tcat]->cat_id == 1){?>
                                    <i class="weddingdir_heart_double_face"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 2){?>
                                     <i class="weddingdir_cake"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 3){?>
                                     <i class="weddingdir_guitar"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 4){?>
                                     <i class="weddingdir_florist"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 5){?>
                                     <i class="weddingdir_location_heart"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 6){?>
                                     <i class="weddingdir_tent"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 7){?>
                                     <i class="weddingdir_camera"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 8){?>
                                     <i class="weddingdir_videographer"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 9){?>
                                     <i class="weddingdir_pheras"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 10){?>
                                     <i class="weddingdir_seating_chart"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 11){?>
                                     <i class="weddingdir_fashion"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 12){?>
                                     <i class="weddingdir_vendor_manager"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 13){?>
                                     <i class="weddingdir_heart_envelope"></i>
                                    <?php }elseif($category[$tcat]->cat_id == 14){?>
                                     <i class="weddingdir_church"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 15){?>
                                     <i class="weddingdir_vendor_truck"></i>
                                    <?php } elseif($category[$tcat]->cat_id == 16){?>
                                     <i class="weddingdir_venue"></i>
                                    <?php }  ?>
                                    <?php if($category[$tcat]->cat_id == 0){ echo "Other";}else{ echo $category[$tcat]->category;}?></a>  
                                    
                                       <?php } ?>
                                
                                
                                
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 mt-4 mt-md-0">
                            <div class="tab-content budget-tab-content" id="v-pills-tabContent">
                                   
                                <!-- Venue -->
                                <div class="tab-pane fade show active" id="v-pills-<?php echo $category[0]->cat_id;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $category[0]->cat_id;?>-tab">
                                    <div class="card-shadow">
                                        <div class="card-shadow-header p-0">
                                            <div class="d-sm-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <span class="budget-head-icon"> 
                                                       <?php if($category[0]->cat_id == 0) {?>
                                     <i class="weddingdir_bell"></i>
                                    <?php }else if ($category[0]->cat_id == 1){?>
                                    <i class="weddingdir_heart_double_face"></i>
                                    <?php } elseif($category[0]->cat_id == 2){?>
                                     <i class="weddingdir_cake"></i>
                                    <?php } elseif($category[0]->cat_id == 3){?>
                                     <i class="weddingdir_guitar"></i>
                                    <?php } elseif($category[0]->cat_id == 4){?>
                                     <i class="weddingdir_florist"></i>
                                    <?php } elseif($category[0]->cat_id == 5){?>
                                     <i class="weddingdir_location_heart"></i>
                                    <?php } elseif($category[0]->cat_id == 6){?>
                                     <i class="weddingdir_tent"></i>
                                    <?php } elseif($category[0]->cat_id == 7){?>
                                     <i class="weddingdir_camera"></i>
                                    <?php } elseif($category[0]->cat_id == 8){?>
                                     <i class="weddingdir_videographer"></i>
                                    <?php } elseif($category[0]->cat_id == 9){?>
                                     <i class="weddingdir_pheras"></i>
                                    <?php } elseif($category[0]->cat_id == 10){?>
                                     <i class="weddingdir_seating_chart"></i>
                                    <?php } elseif($category[0]->cat_id == 11){?>
                                     <i class="weddingdir_fashion"></i>
                                    <?php } elseif($category[0]->cat_id == 12){?>
                                     <i class="weddingdir_vendor_manager"></i>
                                    <?php } elseif($category[0]->cat_id == 13){?>
                                     <i class="weddingdir_heart_envelope"></i>
                                    <?php }elseif($category[0]->cat_id == 14){?>
                                     <i class="weddingdir_church"></i>
                                    <?php } elseif($category[0]->cat_id == 15){?>
                                     <i class="weddingdir_vendor_truck"></i>
                                    <?php } elseif($category[0]->cat_id == 16){?>
                                     <i class="weddingdir_venue"></i>
                                    <?php }  ?>
                                                    </span> 
                                                    <span class="head-simple"><?php  if($category[0]->cat_id == 0){ echo "Other";}else{echo $category[0]->category; }?></span> 
                                                </div>
                                                <div class="d-flex p-4 align-items-center justify-content-between ">
                                                    <div class="cost-details">
                                                        <span>Final Cost</span>
                                                        <div id="totalact-<?php echo $category[0]->cat_id; ?>" class="txt-success"><?php  echo "ksh ". number_format($category[0]->actual_total,0);?></div>
                                                    </div>
                                                    <div class="cost-details">
                                                        <span>Pending cost:</span>
                                                        <div id="totalpend-<?php echo $category[0]->cat_id; ?>"><?php  echo "ksh ". number_format($category[0]->pending_total,0);?></div>
                                                    </div>
                                                    <div class="remove-btn">
                                                        <a href="javascript:" id="cat-<?php  echo $category[0]->cat_id; ?>" class="action-links delete-budcategory">Remove <i class="fa fa-trash"></i></a> 
                                                    </div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-shadow-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Expense</th>
                                                            <th scope="col">Estimate</th>
                                                            <th scope="col">Actual</th>
                                                            <th scope="col">Paid</th>
                                                            <th scope="col">Pending</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        
                                                  for($c=0; $c < count($first_records); $c ++){
                                                      //echo $first_records[$c];
                                                ?>
                                                        <tr id="row-<?php echo $first_records[$c]->budgetcat_id; ?>">
                                                            <th scope="row"><?php  echo $first_records[$c]->expense;?></th>
                                                            <td id="estimate-edit<?php echo $first_records[$c]->budgetcat_id; ?>"><?php   echo number_format($first_records[$c]->estimate,0);?></td>
                                                            <td id="actual-edit<?php echo $first_records[$c]->budgetcat_id; ?>" ><?php  echo number_format($first_records[$c]->actual,0);?></td>
                                                            <td id="paid-edit<?php echo $first_records[$c]->budgetcat_id; ?>"><?php  echo number_format($first_records[$c]->paid,0);?></td>
                                                            <td id="pending-edit<?php echo $first_records[$c]->budgetcat_id; ?>"><?php  echo number_format($first_records[$c]->pending,0);?></td>
                                                            <td class="text-nowrap"><a href="javascript:" class="action-links edit kecio-edit" id="<?php echo $first_records[$c]->budgetcat_id; ?>"><i class="fa fa-pencil" data-toggle="modal" data-target="#modal-edit-budget"></i></a> 
                                                            <a href="javascript:" class="action-links"><i class="fa fa-trash delete-buditem" id="bud-<?php echo $first_records[$c]->budgetcat_id; ?>-<?php echo $category[0]->cat_id; ?>"></i></a> </td>
                                                        </tr>
                                                  <?php }?>
                                                       </tbody>
                                                </table>
                                            </div>
                                                 <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Total Cost</th>
                                                            <th scope="col">Estimate Total</th>
                                                            <th scope="col">Actual Total</th>
                                                            <th scope="col">Paid Total</th>
                                                            <th scope="col">Pending Total</th>
                                                            <th scope="col">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="catb-<?php echo $category[0]->cat_id; ?>">
                                                            <th scope="row"></th>
                                                            <td class="estimate-total"id="est-<?php echo $category[0]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ".number_format($category[0]->estimate_total,0);?></span></td>
                                                            <td class="actual-total"  id="act-<?php echo $category[0]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ". number_format($category[0]->actual_total,0);?></span></td>
                                                            <td class="paid-total"    id="pa-<?php echo $category[0]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ". number_format($category[0]->paid_total,0);?></span></td>
                                                            <td class="pending-total" id="pend-<?php echo $category[0]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ". number_format($category[0]->pending_total,0);?></span></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                           </div>
                                    </div>
                                </div>
                                <!--============================== Venue ---------- Loooop ======================================= ---->
                                     <?php 
                                    
                                     for($t = 1; $t < count($category); $t++){
                                         
                                        $records = $category[$t]->records;
                                       // echo $records[0];
                                    for($dt = 0; $dt < count($records); $dt++) { ?> 
                                
                                <div class="tab-pane fade" id="v-pills-<?php echo $category[$t]->cat_id;?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $category[$t]->cat_id;?>-tab">
                                    <div class="card-shadow">
                                        <div class="card-shadow-header p-0">
                                            <div class="d-sm-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <span class="budget-head-icon"> 
                                                                <?php if ($category[$t]->cat_id == 1){?>
                                                             <i class="weddingdir_heart_double_face"></i>
                                                             <?php } elseif($category[$t]->cat_id == 2){?>
                                                              <i class="weddingdir_cake"></i>
                                                             <?php } elseif($category[$t]->cat_id == 3){?>
                                                              <i class="weddingdir_guitar"></i>
                                                             <?php } elseif($category[$t]->cat_id == 4){?>
                                                              <i class="weddingdir_florist"></i>
                                                             <?php } elseif($category[$t]->cat_id == 5){?>
                                                              <i class="weddingdir_location_heart"></i>
                                                             <?php } elseif($category[$t]->cat_id == 6){?>
                                                              <i class="weddingdir_tent"></i>
                                                             <?php } elseif($category[$t]->cat_id == 7){?>
                                                              <i class="weddingdir_camera"></i>
                                                             <?php } elseif($category[$t]->cat_id == 8){?>
                                                              <i class="weddingdir_videographer"></i>
                                                             <?php } elseif($category[$t]->cat_id == 9){?>
                                                              <i class="weddingdir_pheras"></i>
                                                             <?php } elseif($category[$t]->cat_id == 10){?>
                                                              <i class="weddingdir_seating_chart"></i>
                                                             <?php } elseif($category[$t]->cat_id == 11){?>
                                                              <i class="weddingdir_fashion"></i>
                                                             <?php } elseif($category[$t]->cat_id == 12){?>
                                                              <i class="weddingdir_vendor_manager"></i>
                                                             <?php } elseif($category[$t]->cat_id == 13){?>
                                                              <i class="weddingdir_heart_envelope"></i>
                                                             <?php }elseif($category[$t]->cat_id == 14){?>
                                                              <i class="weddingdir_church"></i>
                                                             <?php } elseif($category[$t]->cat_id == 15){?>
                                                              <i class="weddingdir_vendor_truck"></i>
                                                             <?php } elseif($category[$t]->cat_id == 16){?>
                                                              <i class="weddingdir_venue"></i>
                                                             <?php }  ?>
                                                            
                                                        </i></span> 
                                                    <span class="head-simple"><?php echo $category[$t]->category;?></span> 
                                                </div>
                                                <div class="d-flex p-4 align-items-center justify-content-between ">
                                                    <div class="cost-details">
                                                        <span>Final Cost</span>
                                                        <div id="totalact-<?php  echo "ksh ". number_format($category[$t]->actual_total,0);?>" class="txt-success"><?php  echo "ksh ". number_format($category[0]->actual_total,0);?></div>
                                                    </div>
                                                    <div class="cost-details">
                                                        <span>Pending cost:</span>
                                                        <div><?php  echo "ksh ". number_format($category[$t]->pending_total,0);?></div>
                                                    </div>
                                                    <div class="remove-btn">
                                                        <a href="javascript:" id="cat-<?php  echo $category[$t]->cat_id; ?>" class="action-links delete-budcategory">Remove <i class="fa fa-trash"></i></a> 
                                                    </div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-shadow-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Expense</th>
                                                            <th scope="col">Estimate</th>
                                                            <th scope="col">Actual</th>
                                                            <th scope="col">Paid</th>
                                                            <th scope="col">Pending</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        
                                                    for($dt = 0; $dt < count($records); $dt++) {
                                                     
                                                ?>
                                                        <tr id="row-<?php echo $records[$dt]->budgetcat_id; ?>">
                                                            <th scope="row"><?php echo $records[$dt]->expense; ?></th>
                                                            <td id="estimate-edit<?php echo $records[$dt]->budgetcat_id; ?>"><?php echo number_format($records[$dt]->estimate,0); ?></td>
                                                            <td id="actual-edit<?php echo $records[$dt]->budgetcat_id; ?>"><?php echo number_format($records[$dt]->actual,0); ?></td>
                                                            <td id="paid-edit<?php echo $records[$dt]->budgetcat_id; ?>"><?php echo number_format($records[$dt]->paid,0); ?></td>
                                                            <td id="pending-edit<?php echo $records[$dt]->budgetcat_id; ?>"><?php echo number_format($records[$dt]->pending,0); ?></td>
                                                            <td class="text-nowrap"><a href="javascript:" class="action-links edit kecio-edit" id="<?php echo $records[$dt]->budgetcat_id; ?>"><i class="fa fa-pencil" data-toggle="modal" data-target="#modal-edit-budget"></i></a> 
                                                             <a href="javascript:" class="action-links" ><i class="fa fa-trash delete-buditem"  id="bud-<?php echo $records[$dt]->budgetcat_id; ?>-<?php echo $category[$t]->cat_id; ?>"></i></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                               <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Total Cost</th>
                                                            <th scope="col">Estimate Total</th>
                                                            <th scope="col">Actual Total</th>
                                                            <th scope="col">Paid Total</th>
                                                            <th scope="col">Pending Total</th>
                                                            <th scope="col">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"></th>
                                                            <td class="estimate-total"id="est-<?php echo $category[$t]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ".number_format($category[$t]->estimate_total,0);?></span></td>
                                                            <td class="actual-total"  id="act-<?php echo $category[$t]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ". number_format($category[$t]->actual_total,0);?></span></td>
                                                            <td class="paid-total"    id="pa-<?php echo $category[$t]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ". number_format($category[$t]->paid_total,0);?></span></td>
                                                            <td class="pending-total" id="pend-<?php echo $category[$t]->cat_id; ?>"><span class="total-amount"><?php  echo "ksh ". number_format($category[$t]->pending_total,0);?></span></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                     <?php } }?>
                                
                                <!-- Transportation --> 
                
                            </div>
                        </div>
                        <!-- Budget End -->
                    </div>    
                  </div>  
            
            <div class="tab-pane fade" id="pills-hr-vendor-budget" role="tabpanel" aria-labelledby="pills-hr-vendor-budget-tab">
              <div class="card-shadow">
                <div class="card-shadow-body p-0">
                <div class="table-responsive">
                <table class="table table-hover mb-0" id="budget-datatables">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Expense</th>
                            <th scope="col">Estimate</th>
                            <th scope="col">Actual</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Pending</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                <?php

                 for($mt = 0; $mt < count($category); $mt++){

                     $total_actual    = $category[$mt]->actual_total;
                     $total_estimate  = $category[$mt]->estimate_total;
                     $total_paid      = $category[$mt]->paid_total;
                     $total_pending   = $category[$mt]->pending_total;

                     $budget_records = $category[$mt]->records;


                     ?> 
                                                    
                        <tr id="summary-cats-<?php echo $category[$mt]->cat_id; ?>">
                            <th scope="row"><?php  if($category[$mt]->category == ''){ echo "Other";}else{ echo $category[$mt]->category; }?></th>
                            <td id="summary-est<?php echo $category[$mt]->cat_id; ?>"> <?php echo number_format($total_estimate,0);   ?></td>
                            <td id="summary-actual<?php echo $category[$mt]->cat_id; ?>"><?php  echo number_format($total_actual,0);  ?></td>
                            <td id="summary-paid<?php echo $category[$mt]->cat_id ?>"><?php  echo number_format($total_paid,0); ?></td>
                            <td id="summary-pending<?php echo $category[$mt]->cat_id ?>"><?php echo number_format($total_pending,0);?></td>
</tr>
                 <?php } ?>
                        </tbody>
                        <tfoot>
                    <tr>   
                        <td id="sum-all-totals"> Totals </td>

                       <td class="estimate-total"><span id="ttl-est-<?php echo $_SESSION['userid'];?>"class="total-amount"><?php  echo "ksh ".number_format(round($sum_estimate,2),0);   ?></span></td>
                           <td class="actual-total"><span id="ttl-actual<?php echo $_SESSION['userid'];?>" class="total-amount"><?php  echo "ksh ". number_format(round($sum_actual,2),0);   ?></span></td>
                           <td class="paid-total"><span id="ttl-paid<?php echo $_SESSION['userid'];?>" class="total-amount"><?php  echo "ksh ".number_format(round($sum_paid,2),0);   ?></span></td>
                           <td class="pending-total"><span id="ttl-pending<?php echo $_SESSION['userid'];?>" class="total-amount"><?php  echo "ksh ".number_format(round($sum_pending,2),0);   ?></span></td>
                           <td></td>
                          </tr>

                     </tfoot>
                </table>
            </div>   
              </div>
            </div>
                
            </div>
            </div>
        <!-- tab ends here ------>
         </div>
          </div>
           
        </div>        
<?php } else{include_once 'login.php';}?>    

    

  