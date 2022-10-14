$(document).ready(function(){
    ////======================= Delete budget expensec ==============================================================//
    
    $(document).on('click', '.delete-buditem', function (event) {
        var budget_id     = this.id;
        //alert(budget_id); return false;
        var bothids    = budget_id.replace('bud-','');
        var array_id   = bothids.split('-');
       // alert (array_id); return false;
        var budgetitem = array_id[0];
        var cat_id    = array_id[1];
        var user_id    = $("input#userid").val();
        
        var dataString = 'budgetitem='+ budgetitem + '&cat_id=' + cat_id + '&user_id='+ user_id;
          
        //alert (dataString);return false;
          
          $.ajax({
                 type: "POST",
                url: "bin/DeleteBudgetItem.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                   // alert(data);
                  var myData 		= JSON.parse(data); //receive json string from function login                  
                   var status 		= myData.status;  
                    //alert(status);
                  // var statuss         = myData.statuss; 
                  /// alert(statuss);
                    var realdata        = myData.data;
                    var realdataa       = myData.dataa;
                   // alert (realdataa.testimate); return false;
                    
                    // new summary totals
                     $('#ttl-est-'+ user_id).text(realdataa.testimate);
                     $('#ttl-actual'+ user_id).text(realdataa.tactual);
                     $('#ttl-paid' + user_id).text(realdataa.tpaid);
                     $('#ttl-pending' + user_id).text(realdataa.tpending);
                     
                     // new top summary board totals
                     $('#top-summary-est').text(realdataa.testimate);
                     $('#top-summary-actual').text(realdataa.tactual);
                     $('#top-summary-paid').text(realdataa.tpaid);
                     $('#top-summary-pending').text(realdataa.tpending);
                     
                    if(status === "SUCCESS"){  
                     $('#est-'+ cat_id).text(realdata.estimate);
                     $('#act-'+ cat_id).text(realdata.actual);
                     $('#pa-' + cat_id).text(realdata.paid);
                     $('#pend-' + cat_id).text(realdata.pending);
                     $('#row-'+ budgetitem).fadeOut('1000');
                     
                  //$('#totsupd-'+ cat_id).show();
                  // $('#totsbud-'+ cat_id).hide();
                   
                     $('#totalact-'+ cat_id).text(realdata.actual);
                     $('#totalpend-' + cat_id).text(realdata.pending);
                    
                    
                     
                     $("#summary-est"+ cat_id).text(realdata.estimate);
                     $("#summary-actual"+ cat_id).text(realdata.actual);
                     $("#summary-paid"+ cat_id).text(realdata.paid);
                     $("#summary-pending"+ cat_id).text(realdata.pending);
                   
                    }else{
                          $('#row-'+ budgetitem).fadeOut('1000');
                       
                         $('#catb-'+ cat_id).fadeOut('1000');
                         $('#summary-cats-'+ cat_id).hide();
                       
                       $('#totalact-'+ cat_id).hide();
                     $('#totalpend-' + cat_id).hide();
                        
                    } 
                    
               }
           
       });
       event.preventDefault();
      });
      
    
    
    //========================= Delete Category ==================================================================//
      $(document).on('click', '.delete-budcategory', function (event) {
          
         //alert("save me"); return false;  
         var budget_cat = this.id;
         var budget_catid = budget_cat.replace("cat-",'');
          //alert(budget_catid); return false;
         
         var dataString = 'budget_catid=' + budget_catid;
       //alert(dataString);
        
        swal({
        title: "Are you sure You?",
        text: "You will not be able to Recover this Category once Deleted!",
        icon:"warning",
        type: "warning",
        buttons: ["cancel","Yes, delete it!"],
        dangerMode:true,
        confirmButtonClass: "btn-danger",
        closeOnConfirm: false,
        closeOnCancel: false
      }).then(function(isConfirm) {
      
        if (isConfirm) {
        $.ajax({
                 type: "POST",
                url: "bin/DeleteBudgetCategory.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                    
                     
             swal("Deleted!", "Your Category has been deleted.", "success");
             location.reload();
                },
                    
            });
         }else{ swal("Cancelled", "Your Category has not been deleted ;)", "error");}
    
        }); 
         
      });
    
    
    
    //Add Budget ----===================================================================================//
    
    $(document).on('click', '#save-mybudget', function (event) {
        //alert("save me"); return false;
        var user_id        =  $('input#userid').val();
        var cat_id         =  $('#budget-category-id').val();
        var expense        = $('input#budget-expense').val();
        var estimate       = $('input#budget-estimate').val();
        var actual         = $('input#budget-actual').val();
        var paid           = $('input#budget-paid').val();
       
       // alert (cat_id); return false;
        
        if(expense === ''){
                   $("input#budget-expense").css("border-color","red");
                    $("input#budget-expense").focus();
                    return false;

                }else{
                    $("input#budget-expense").css("border-color","");

                }
        
      var dataString =  'user_id=' + user_id + '&cat_id=' + cat_id + '&expense=' + expense + '&estimate=' + estimate + '&actual=' + actual + '&paid='+ paid;
        
       // alert(dataString); return false;
         $("#save-mybudget").hide();
           $("#load-budget").show();
        $.ajax({
                 type: "POST",
                url: "bin/AddBudget.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                   // $('#adding-budget').hide();
                  // alert(data);
                      var myData 		= JSON.parse(data); //receive json string from function login
                      var status 		= myData.status;
                        if(status === "SUCCESS"){
                   $("#save-mybudget").show();
                  $("#load-budget").hide();
                     swal({
                     title: "Success",
                     text: "Budget Saved!",
                     icon:"success",
                     type: "success"
                 }).then(function() {
                     window.location = "couple-budget";
                    });
                  
                        }
                }
           
       });
              
    });
    //// Get modal category ids =======================
    $(document).on('click', '.kecio-edit', function (event) {
        
        //alert(this.id); return false;
        var budgetcat_id = this.id;
       //alert (catid);return false;
       
       var dataString =   'budgetcat_id='+ budgetcat_id;
       
        //alert(dataString); return false;
       $.ajax({
                 type: "POST",
                url: "bin/ModalData.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                   //alert (data); return false;
                      var myData 		= JSON.parse(data); //receive json string from function login
                      var status 		= myData.status;
                      var realdata              = myData.data;
                     
                    //alert (status);
                     if(status === "SUCCESS"){
                       
                        $('#expense').text(realdata.expense);
                        $('#mod-estimate').val(realdata.estimate);
                        $('#mod-actual').val(realdata.actual);
                        $('#mod-paid').val(realdata.paid);
                        $('#budgetcatid').val(budgetcat_id);
                        $('#budget-cat-id').val(realdata.cat_id);
                        return false;
                    } 
                }
           
       });
        
        //alert(dataString); return false;
    });
    //// edit budget on modal ================================================================================//////

    $(document).on('click', '#edit-modal-budget', function (event) {
        var cat_id        = $('#budget-cat-id').val();
        //alert(cat_id); return false;
        var user_id       = $('#user_id').val();
        var budgetcat_id  = $('#budgetcatid').val();
        var estimate      = $('#mod-estimate').val();
        var actual        = $('#mod-actual').val();
        var paid          = $('#mod-paid').val();
        
        
        var dataString =  'user_id=' + user_id + '&cat_id=' + cat_id + '&budgetcat_id=' + budgetcat_id + '&estimate=' + estimate + '&actual=' + actual + '&paid='+ paid;
        
       // alert(dataString);
        $.ajax({
                 type: "POST",
                url: "bin/UpdateBudget.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                    
                   // alert (data); return false;
                      var myData 		= JSON.parse(data); //receive json string from function login
                      var status 		= myData.status; 
                      var realdata              = myData.data;
                      var sstatus 		= myData.sstatus; 
                      var sdata                 = myData.sdata;
                      var tstatus 		= myData.tstatus; 
                      var tdata                 = myData.tdata;
                      
                    //alert(status);
                    
                     if(status === "SUCCESS"){
                         swal({
                     title: "Success",
                     text: "Budget Edited!",
                     icon:"success",
                     type: "success"
                 });
                         
                         $('#estimate-edit'+budgetcat_id).text(realdata.estimate);
                         $('#actual-edit'+budgetcat_id).text(realdata.actual);
                         $('#paid-edit'+budgetcat_id).text(realdata.paid);
                         $('#pending-edit'+budgetcat_id).text(realdata.pending);
                         //$('#modal-edit-budget').hide();
                           
                    
                    } 
                    if(sstatus === "SUCCESS"){
                       $('#est-'+cat_id).text(sdata.estimate);
                       $('#act-'+cat_id).text(sdata.actual);
                       $('#pa-'+cat_id).text(sdata.paid);
                       $('#pend-'+cat_id).text(sdata.pending);
                       
                     $("#summary-est"+ cat_id).text(sdata.estimate);
                     $("#summary-actual"+ cat_id).text(sdata.actual);
                     $("#summary-paid"+ cat_id).text(sdata.paid);
                     $("#summary-pending"+ cat_id).text(sdata.pending);
                       
                    }
                   if(tstatus === "SUCCESS"){
                       
                     $('#ttl-est-'+ user_id).text(tdata.testimate);
                     $('#ttl-actual'+ user_id).text(tdata.tactual);
                     $('#ttl-paid' + user_id).text(tdata.tpaid);
                     $('#ttl-pending' + user_id).text(tdata.tpending);
                     
                     $('#top-summary-est').text(tdata.testimate);
                     $('#top-summary-actual').text(tdata.tactual);
                     $('#top-summary-paid').text(tdata.tpaid);
                     $('#top-summary-pending').text(tdata.tpending);
                       
                   } 
                    location.reload();
                },
           
       });
        
    });
    
});