$(document).ready(function() { 
    
   //================= guest without whatsapp ============================================================================================//
    $(document).on('click', '.whatsappno', function(event) { 
    
    swal({
                     title: "No whatsapp number",
                     text: "You did not provide whatsapp number for this guest",
                     icon:"info",
                     type: "info"
                 });
                 return false;
    
    
    });
    //============= Invitation Status ==============================================================================//
     $(document).on('change', '.kecio-gst-status', function(event) { 
      
         var user_id  = $("input#userid").val();
     // alert(user_id);return false;
       var guest_id            = this.id;
       var new_id              = guest_id.replace('status', '');
       var invitation_status   = this.value;
       //alert(status);
       //alert(new_id);
       var dataString ='user_id=' + user_id +'&new_id=' + new_id + '&invitation_status=' + invitation_status;
      // alert(dataString); return false;
       $.ajax({
                type: "POST",
                 url: "bin/InvitationStatus.php",
                 beforeSend: function() { $("#loading").css("display", "block"); },
                 complete: function() { $("#loading").css("display", "none"); },
                 data: dataString,
                 success: function(data){
                     
           //  alert(data);
             var myData 		= JSON.parse(data); //receive json string from function login
             var status 		= myData.status;
            // alert(status);
             if(status === "SUCCESS"){
                    swal({
                     title: "Success",
                     text: "saved",
                     icon:"success",
                     type: "success"
                        
                      }); location.reload();
              }else{
                   swal({
                     title: "Fail",
                     text: "Status not saved, try again",
                     icon:"warning",
                     type: "warning"
                 });
                  
              }
                 }
             });
      
   });
    
    
    
    
    //======== Delete Guest =======================================================================================//
     $(document).on('click', '.del-guest',function(event){
       
        var guest_id        = this.id;
        var new_guest_id    = guest_id.replace('delguest-','');
       
        var dataString = "new_guest_id=" + new_guest_id;
        
        swal({
        title: "Are you sure You?",
        text: "You will not be able to Recover this Guest once Deleted!",
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
                 url: "bin/DeleteGuest.php",
                 beforeSend: function() { $("#loading").css("display", "block"); },
                 complete: function() { $("#loading").css("display", "none"); },
                 data: dataString,
                 success: function(data){
                     
             //alert(data);return false;
             var myData 		= JSON.parse(data); //receive json string from function login
             var status 		= myData.status;
              
              if(status === "SUCCESS"){
             swal("Deleted!", "Your Guest has been deleted.", "success");
             $('#delete-guest'+ new_guest_id).fadeOut('5000'); 
         }else if(status === "FAIL"){
             
             
                 swal({
        title: "Failed",
        text: "You can not delete a guest who has sent an RSVP. Change status to waiting to delete.",
        icon:"warning",
        type: "warning",
    });
                 
             }
             
             
         },
    
     });
        }else{ swal("Cancelled", "Your Guest has not been deleted ;)", "error");}
    
        });  
   
    
     });
     
    
    
    //============= Guest invitation sent ========================================================//
     $(document).on('click', '.kecio-chk', function(event) { 
      
      var user_id      = $("input#userid").val();
     // alert(user_id);return false;
       var guest_id    = this.id;
       var new_id      = guest_id.replace('checkbox', '');
     // alert(guest_id); return false;
      if ($('#' + this.id).is(":checked")) { 
            $('#' + this.id).prop("checked", true);
            var invite_sent = 'YES';
            
         }
      //alert(new_id);
      var dataString ='user_id='+ user_id + '&new_id=' +new_id +'&invite_sent=' +invite_sent;
      
      //alert(dataString); return false; 
      
       $.ajax({
                type: "POST",
                 url: "bin/GuestChckBox.php",
                 beforeSend: function() { $("#loading").css("display", "block"); },
                 complete: function() { $("#loading").css("display", "none"); },
                 data: dataString,
                 success: function(data){
                     
                    //alert (data); 
                   var myData 		= JSON.parse(data); //receive json string from function login
                   var status 		= myData.status;
                      if(status === "SUCCESS"){
                                   
                     swal({
                     title: "Success",
                     text: "saved",
                     icon:"success",
                     type: "success"
                        
                      });
                      location.reload();
                 }else{
                     swal({
                     title: "Fail",
                     text: "Not saved",
                     icon:"warning",
                     type: "warning"
                 });
                 }
             }
      
       });
      
      });
     
    
    
    //============= Add New Guest ==============================================//
     $("#guestlist-phone-number").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#guestlist-phone-err").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });
      $("#guestlist-whatsapp-phone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#guestlist-whatsapp-err").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });                       
    
    $(document).on('click','#savemyguest', function (event) {
            
        //alert ('save guest'); return false; 
         var user_id  =   $("input#userid").val();
         var name     =   $("input#guest-list-name").val();
         var relation =   $("input#guest-list-family").val();
         var contact  =   $("input#guestlist-phone-number").val();
         var whatsapp =   $("input#guestlist-whatsapp-phone").val();
         //alert(relation);return false;
         if(name === ''){
            $("input#guest-list-name").focus();
              $("input#guest-list-name").css("border-color","red");
                 return false;
        }else{
            $("input#guest-list-name").css("border-color","");
        }
         var phoneWords          = $.trim($("#guestlist-phone-number").val()).split("");
         var countphone          = phoneWords.length;
          if(countphone !== 10){
                            $("#guestlist-phone-number").css('border-color','red');
                            $("#guestlist-phonecount").show();
                            $("#guestlist-phone-number").focus();
                             return false;
                            }else{
                            $("#guestlist-phone-number").css('border-color','');
                            $("#guestlist-phonecount").hide();
                            
                            } 
                            
           var whatsappWords     = $.trim($("#guestlist-whatsapp-phone").val()).split("");
         var countwhatsapp       = whatsappWords.length;
          if(countwhatsapp !== 10){
                            $("#guestlist-whatsapp-phone").css('border-color','red');
                            $("#guestlist-whatsapp").show();
                            $("#guestlist-whatsapp-phone").focus();
                             return false;
                            }else{
                            $("#guestlist-whatsapp-phone").css('border-color','');
                            $("#guestlist-whatsapp").hide();
                            
                            }                  
      
           var dataString = 'user_id=' + user_id + '&name='+ name + '&relation=' + relation + '&contact=' + contact + '&whatsapp=' + whatsapp;
           
           //alert (dataString); return false;
           $.ajax({ // ajax post function
				type: "POST",
				url: "bin/AddGuest.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data){
                            //alert(data);
                                  
                               var myData 		= JSON.parse(data); //receive json string from function login
                               var status 		= myData.status;
                               
                               if(status === "SUCCESS"){
                                   
                                 swal({
                     title: "Success",
                     text: "Guest Added",
                     icon:"success",
                     type: "success"
                        
                      });
                       location.reload();
                      
                    }else{
                        swal({
                     title: "Fail",
                     text: "Guest Not Added, Try again",
                     icon:"warning",
                     type: "warning"
                        
                      });
                        
                    }     
                }
              });
            
    });
    
  
    
    
    
} );