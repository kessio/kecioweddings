<?php 
if($_SESSION['user_session_exists'] === "TRUE"){
        $display_todolist = array(

            "user_id"=>$_SESSION['userid']
        );

        //print_r ($display_todolist); 
        $data = $little->shaz_curl(json_encode($display_todolist), \NsLittle\Little::ROUTE.'/loop_startdate.php');
   //print_r($data);  
     $task_decoded  = json_decode($data);
     $tasks = $task_decoded->todo;
     //print_r($tasks);
     //echo $tasks[2]->title; get title of a specific array value
     $tasks_count = count($tasks);
      //loop to get all the values in the json object
     $count_complete = array(
    "user_id"=>$_SESSION['userid'] 
     
 );
     //count no of complete tasks
 //print_r($count_status);
 $dataa = $little->shaz_curl(json_encode($count_complete), \NsLittle\Little::ROUTE.'/count_status.php');
 //print_r($dataa);
  $status_decoded = json_decode($dataa);
  //print_r($status_decoded);
  $complete = $status_decoded->data;
  //echo $complete;
 
  // count total task
  $all_data = $little->shaz_curl(json_encode($count_complete), \NsLittle\Little::ROUTE.'/count_tasks.php');
  $all_decoded = json_decode($all_data);
  //print_r($all_decoded);
  $all_tasks = $all_decoded->data;
  //print_r($all_tasks);
  //count number of pending tasks
  
  $pending_data = $little->shaz_curl(json_encode($count_complete), \NsLittle\Little::ROUTE.'/count_pending_task.php');
  $pending_data_decoded = json_decode($pending_data);
  //print_r($status_decoded);
  $pending = $pending_data_decoded->data->pending_no;
  
  // count due tasks
  $due_data = $little->shaz_curl(json_encode($count_complete), \NsLittle\Little::ROUTE.'/count_due_task.php');
  $due_data_decoded = json_decode($due_data);
  //print_r($status_decoded);
  $due = $due_data_decoded->data->due_no;
  
  
  
  
  $delete_todolist      = $little->shaz_curl(json_encode($count_complete), \NsLittle\Little::ROUTE.'/delete_todo_item.php');
  $delete_item_decoded  = json_decode($delete_todolist);
  //print_r($delete_item_decoded);
  
  
  
   
?>
   
    <!-- =============================
       *
       *   Page Content Start
       *
    =============================== -->
   <div class="body-content">
            <div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>My To Do List</h2>
                            <button class="btn btn-default" id="add_new_todo_button"><i class="fa fa-plus"></i> Add New</button>
                        </div>                           
                    </div>
                    <!-- Page Heading -->

                    <div class="card-shadow">
                        <div class="card-shadow-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="todo-status">
                                        <div class="mr-3"> <strong><small><span id="complete-no"><?php echo $complete;?></span> out of <?php echo $all_tasks;?> tasks completed</small></strong></div>
                                        
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-md-end w-100">
                                        <div class="todo-done">
                                           <div class="badge badge-success">&nbsp;</div>
                                           <div id="complete-number" >
                                                <?php echo $complete;?>
                                           <span>Done</span>
                                           </div> 
                                        </div>
                                        <div class="todo-done">
                                            <div class="badge badge-warning">&nbsp;</div>
                                            <div id="pending-number">
                                               <?php echo $pending;?>
                                                 <span>Pending</span>
                                            </div> 
                                         </div>
                                        <div class="todo-done">
                                            <div class="badge badge-danger">&nbsp;</div>
                                            <div id="due-number">
                                               <?php echo $due;?>
                                                 <span>Due</span>
                                            </div> 
                                         </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                  <?php
           for($t = 0 ; $t < $tasks_count ; $t ++){  
           $records = $tasks[$t]->records;
          
           ?>
                        <div class="todo-subhead mb-0">
                            <h3>
                              <?php echo $tasks[$t]->title; ?>
                                
                            </h3>
                        </div>

                        <div class="upcoming-task">
                            <ul class="list-unstyled">
                                 <?php for($i = 0; $i < count($records); $i ++)
                                       
                                      {  ?>
                                <li id="mtodo-<?php echo $records[$i]->todo_id ; ?>" >
                                    <div class="d-flex align-items-center">
                                        <div class="custom-control custom-checkbox form-dark">
                                            <?php  if($records[$i]->status == 'complete'){ $checked = "checked"; }else{ $checked = "";} ?> 
                                            <input type="checkbox" class="custom-control-input option-input kecio_chk" id="customCheck<?php echo $records[$i]->todo_id ; ?>" <?php echo $checked;?>/>
                                            <label class="custom-control-label <?php echo $checked;?>-label-text" for="customCheck<?php echo $records[$i]->todo_id ; ?>">
                                                <span class="label-text"> <?php echo $records[$i]->task;  ?></span>
                                               <small id="date-completed<?php echo $records[$i]->todo_id; ?>"><?php  if(!empty($records[$i]->datecompleted)){ echo "Done On: ".$records[$i]->datecompleted; } ?></small>
                                          </label>
                                        </div>
                                    </div>
                                    <div class="info-listing align-items-center">
                                        <div class="badge-wrap">
                                            <div>Task Start Date</div>
                                            <span class="badge badge-primary todo-date"> 
                                               <?php echo $records[$i]->taskdate;?> 
                                            </span>                                                       
                                        </div>
                                        <div class="badge-wrap">
                                            <div>Due Date</div>
                                            <span class="badge badge-primary todo-date">                                                        
                                                <?php  if($duedate = strtotime($records[$i]->duedate)){  echo date("F d, Y",$duedate);}else{echo "unsheduled";}?><input type="hidden" name="duedate" id="duedate-<?php echo $records[$i]->todo_id;?>" value="<?php echo $records[$i]->duedate;?>"/></span>
                                           
                                        </div>
                                        <div class="badge-wrap" id="myucess-<?php echo $records[$i]->todo_id; ?>">
                                            <div>Status</div>
                                             <?php if($records[$i]->status === 'complete'){ ?>
                                                            
                                            <span class="badge badge-success">                                                        
                                                Done
                                            </span>
                                               <?php
                                                }else if($records[$i]->status === 'due'){ ?> 
                                                <span class="badge badge-danger">Due</span>
                                                <?php  }else{ ?>

                                                   <span class="badge badge-warning">Pending</span> 
                                               <?php } ?>
                                        </div>
                                        <div id="mysuc-<?php echo $records[$i]->todo_id; ?>" class="col-xl-2" style="display:none">
                                        <span  class="badge badge-success"> complete </span> <span class="todo-date"></span>
                                        </div>
                                                        
                                        <div id="mypending-<?php echo $records[$i]->todo_id; ?>" class="col-xl-2" style="display:none">
                                        <span class="badge badge-warning">Pending</span>
                                        </div>
                                        <div id="mydue-<?php echo $records[$i]->todo_id; ?>" class="col-xl-2" style="display:none">
                                        <span class="badge badge-default">due</span>
                                        </div>
                                        <div class="badge-wrap text-center">
                                            <span class="d-flex">
                                                <a href="javascript:" id="del-todo-<?php  echo $records[$i]->todo_id; ?>" class="action-links delete-btn"><i class="fa fa-trash"></i></a> 
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                      <?php } ?>                              
                             </ul>
                        </div>
                      <?php }?>
                    </div>
                 </div>
            </div>
            
        </div>        
  
    <div id="add_new_todo_form" class="sliding-panel">
        <div class="card-shadow-header mb-0">
            <div class="dashboard-head">
                <h3>
                    Create Task
                </h3>
            </div>
        </div>
        <div class="card-shadow-body">
            <form autocomplete="off">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input id="task" name="tasktitle" type="text" placeholder="Write task here" class="form-control">
                            <div id="mytasks" class="text-danger small" style="display:none">Item Name Required!</div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <input id="taskdate" name="taskdate" type="text" placeholder="Due Date" class="form-control" data-toggle="datepicker" >
                            <div id="duetask" class="text-danger small" style="display:none">Due Date Required!</div>
                        </div>
                    </div>
                    <label>Time Frame</label>
                    <div class="row m-2">
                    <div class="custom-control custom-radio custom-control-inline form-light m-2">
                    <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1day">
                    <label class="custom-control-label" for="inlineRadio1">1 Day</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline form-light m-2">
                    <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1week">
                    <label class="custom-control-label" for="inlineRadio2">1 Week</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline form-light m-2">
                    <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="1month">
                    <label class="custom-control-label" for="inlineRadio3">1 Month</label>
                  </div> 
                  <div class="custom-control custom-radio custom-control-inline form-light m-2">
                    <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="2months">
                    <label class="custom-control-label" for="inlineRadio4">2 Months</label>
                  </div>
                 <div class="custom-control custom-radio custom-control-inline form-light m-2">
                    <input class="custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="3months">
                    <label class="custom-control-label" for="inlineRadio5">3 Months</label>
                  </div>
                  </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button type="button" id="todo_btn" class="btn btn-default">Add to do</button>
                        </div>
                        <div class="form-group">
                            <button type="button" id="load-todobtn" class="btn btn-default buttonload" style="display:none"><i class="fa fa-spinner fa-spin"></i>Add to do</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } else{include_once 'login.php';}?>
   