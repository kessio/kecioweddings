
<div class="modal fade" id="modal-edit-budget" tabindex="-1" role="dialog" aria-labelledby="modal-edit-budgetLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
    <div class="modal-header">
         <h3 class="modal-title" id="expense"></h3>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </a>
        
        <input type="hidden" id="user_id" value="<?php  echo $_SESSION['userid'];?>" name="">
        
         <input type="hidden" id="budget-cat-id" value=""/>
         
        <input id="budgetcatid" name="DynamicTextBox" type="hidden" value="">
    </div>
           
            <div class="modal-body">

   
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                           <div class="form-group">
                           <label class="control-label" for="estimate">Estimate</label>
                               <input id="mod-estimate" name="estimate"  type="text" value="" placeholder="" class="form-control form-control">
                           </div>

                       </div>
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                           <div class="form-group">
                            <label class="control-label" for="actual">Actual</label>
                               <input id="mod-actual" name="actual" type="text" value="" placeholder="" class="form-control form-control">
                           </div>
                       </div>
                       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                           <div class="form-group">
                               <label class="control-label" for="paid">Paid</label>
                               <input id="mod-paid" name="paid" type="text" value="" placeholder="" class="form-control form-control">
                           </div>
                       </div>
                       
   </div>
            <div class="modal-footer">
                
                <button id="edit-modal-budget" class="btn btn-default">Save changes</button>
            </div>
        </div>
    </div>
</div>
