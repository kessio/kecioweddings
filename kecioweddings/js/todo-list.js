$(document).ready(function(){
    
    //============ Delette item =======================================================================================//
    
   $(document).on("click", ".delete-btn", function () {
       
     var todo_item    = this.id;
     var new_todo     = todo_item.replace('del-todo-','');
     //alert(new_todo); return false;
     var user_id      = $("#userid").val();
     //alert(user_id); return false;
     var dataString = 'new_todo=' + new_todo + '&user_id=' + user_id;
      //alert(dataString); return false;
     $.ajax({
                type: "POST",
                 url: "bin/DeleteTodoItem.php",
                 beforeSend: function() { $("#loading").css("display", "block"); },
                 complete: function() { $("#loading").css("display", "none"); },
                 data: dataString,
                 success: function(data){
               // alert (data); return false; 
               
                   var myData 	       = JSON.parse(data); //receive json string from function login
                   var pstatus         = myData.pstatus;
                   var cstatus         = myData.cstatus;
                  var astatus          = myData.astatus;
                  var pedata           = myData.pdata;
                  var compdata         = myData.cdata;
                  var alldata          = myData.adata;  
                 
                 if(pstatus === 'SUCCESS') {
                        $('#pending-number').text(pedata.pending_no);
                         $('#mtodo-'+ new_todo).fadeOut('5000');
                                                  
                        
                    }
                 
                 if(cstatus === 'SUCCESS') {
                        $('#mtodo-'+ new_todo).fadeOut('7000');
                        $('#complete-number').text(compdata.complete_no);
                        
                   }
                   if(astatus === 'SUCCESS') {
                       
                  $("#all-tasks").text(alldata.total_no);
                   $('#mtodo-'+ new_todo).fadeOut('5000');
                   
                   }  
               
             }
             
             
             
         });
       event.preventDefault();
   });
   
    
    
    
    //================= Done items ===============================================================================//
   $(document).on('click', '.kecio_chk', function(event) {
       
       var user_id   = $("input#userid").val();
       //alert(user_id); return false;
       var todo_id    = this.id;
     //alert(todo_id); return false;
       var new_id     = todo_id.replace('customCheck', '');
       
       var duedate    = $("input#duedate-"+new_id).val();
      // alert(duedate); return false;
       //var d = new Date('01/29/2021').getTime()/1000;
      // alert(d);return false;
       var new_duedate = new Date(duedate).getTime()/1000;
       //alert(new_duedate);return false;
       var today = $.datepicker.formatDate('mm/dd/yy', new Date());
       var today_timestamp = new Date(today).getTime()/1000;
       //alert(today_timestamp); return false;
       
     if ($('#' + this.id).is(":checked")) {
         $('#' + this.id).prop("checked", true);
         var status ='complete';
       }else if(!($('#' + this.id).is(":checked")) && (today_timestamp > new_duedate  )){
         
           var status = 'due';
           
       }else{
           var status = 'pending';
       }
       
       if(status === 'pending' && 'due'){
           var datecompleted = ''; 
       }else if(status === 'complete'){
            var datecompleted = new Date();
      
       }
       
     
        var dataString = 'new_id=' +new_id + '&user_id='+ user_id +'&status=' + status + '&datecompleted=' + datecompleted;
       //alert(dataString); return false;
      $.ajax({
                type: "POST",
                 url: "bin/Todocheckbx.php",
                 beforeSend: function() { $("#loading").css("display", "block"); },
                 complete: function() { $("#loading").css("display", "none"); },
                 data: dataString,
                 success: function(data){
               //alert (data); return false;  
    
                 var myData 		= JSON.parse(data); //receive json string from function login
                  var pstatus 		= myData.pstatus;
                  var pdata             = myData.pdata;
                  var cstatus 		= myData.cstatus;
                  var cdata             = myData.cdata; 
                  var dstatus 		= myData.dstatus;
                  var ddata             = myData.ddata; 
                  
                  
                 //alert(status); return false;
                 if(status === 'complete'){
                   $('#myucess-'+ new_id).hide();
                    $('#mypending-'+ new_id).hide();
                     $('#date-completed'+ new_id).show();
                    $('#mysuc-'+ new_id).show(); 
                    $('#mydue-'+ new_id).hide();
                    
                 }else if(status === 'pending'){
                     $('#myucess-'+ new_id).hide();
                     $('#date-completed'+ new_id).hide();
                     $('#mypending-'+ new_id).show();
                     $('#mysuc-'+ new_id).hide();
                     $('#mydue-'+ new_id).hide();
                 }else if(status === 'due'){
                     $('#myucess-'+ new_id).hide();
                     $('#mypending-'+ new_id).hide();
                     $('#mysuc-'+ new_id).hide();
                     $('#mydue-'+ new_id).show();
                     
                 }
                 
                   if(pstatus && cstatus && dstatus  === "SUCCESS"){
                  
                    $('#pending-number').text(pdata.pending_no);
                    $('#complete-number').text(cdata.complete_no);
                     $('#complete-no').text(cdata.complete_no);
                    $('#due-number').text(ddata.due_no);
                       
                    }
                     return false; 
                 },
                
      });  
  
   });  
    
 //=================== add todo list================================================================================//
   $(document).on('click', '#todo_btn', function(event) {
        
       //alert('sabe'); return false;
       var user_id        = $("input#userid").val(); 
       var task           = $("#task").val(); 
       var timeframe      = $("input[type='radio']:checked").val(); 
       var duedate        = $("input#taskdate").val()
       //alert(timeframe);return false;
            if(task === ''){
                $("#mytasks").show();
                $("input#task").focus();
                $("input#task").css("border-color","red");
                return false;
            }else{
                $("input#task").css("border-color","");
                $("#mytasks").hide();
            }
            
            if(duedate === ''){
                $("#duetask").show();
                $("input#taskdate").focus();
                $("input#taskdate").css("border-color","red");
                return false;
            }else{
                $("#duetask").hide();
                 $("input#taskdate").css("border-color","");
            }
            
           if(timeframe === undefined){
              timeframe = 0;
           }
           
            var new_duedate = new Date(duedate).getTime()/1000;
      //alert(new_duedate);return false;
       var today = $.datepicker.formatDate('mm/dd/yy', new Date());
       var today_timestamp = new Date(today).getTime()/1000;
       
       if(today_timestamp > new_duedate){
           var status = 'due';
       }else{
           var status = 'pending';
       }
           
           
    
            
            var dataString = 'user_id=' +user_id + '&task=' + task + '&timeframe='+ timeframe + '&duedate=' + duedate + '&status=' + status ;
         //alert (dataString); return false;
            $("#load-todobtn").show();
            $("#todo_btn").hide();
            
            $.ajax({ // ajax post function
				type: "POST",
				url: "bin/TodoList.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data){
                              //alert (data); 
                                
                               var myData 		= JSON.parse(data); //receive json string from function login
                               var status 		= myData.status;
                               //alert(status); return false;
                                
                                if(status === "SUCCESS"){
                                    $("#load-todobtn").hide();
                                     $("#todo_btn").show();
                                    
                               swal({
                     title: "Success",
                     text: "Task added!",
                     icon:"success",
                     type: "success"
                 }).then(function() {
                     window.location = "couple-todolist";
                    });  
                      
                        return false;
                    }else{
                      swal({
                     title: "Fail",
                     text: "Todo list not saved, try again.",
                     icon:"warning",
                     type: "warning"
                 });
                        
                        return false;
                        
                    }
                                
                                
                                
                                },
       });
       
   });
      
    
    
    
});
