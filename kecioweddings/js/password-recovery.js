$(document).ready(function(){
  
   $(document).on('click', '#recovery-changepass', function (event) {
      var email      =  $("#changepass-email").val();
      var password   =  $("#New_Password").val();
      var cpassword  =  $("#Confirm_Password").val();
      
      if(password === ''){
        $("input#New_Password").focus();
       $("input#New_Password").css("border-color","red");
        return false;
    }else{
       $("input#New_Password").css("border-color","");
    }      
      if(cpassword !== password){
        $("input#Confirm_Password").focus();
        $("#passmismatch").show();
       $("input#Confirm_Password").css("border-color","red");
        return false;  
      }else{
         $("#passmismatch").hide();
       $("input#Confirm_Password").css("border-color","");  
      }
      
      var dataString = 'email=' + email + '&password=' + password; 
        $.ajax({ // ajax post function
              type: 'POST',
              url:'bin/RecoveryChangePass.php',
              beforeSend: function() { $("#loading").css("display", "block"); },
              complete: function() { $("#loading").css("display", "none"); },
              data: dataString,
              success: function(data) {
                //alert(data);
                 var myData 		= JSON.parse(data); //receive json string from function login	
                var status 		= myData.status;
               // alert(status);
               if(status === "SUCCESS"){
                  swal({
                title: "success",
                text: "You can now login with your new password.",
                icon:"success",
                type: "success"

                   });
                   
                    $("#general-login").modal('show');
                    
                   
               }
            }
        });
   });
    
    
     $("#recovercode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });
    
   $(document).on('click', '#keyin-code', function (event) {
     var recovery_code  =  $("#recovercode").val();
     var email          =  $("#code-email").val();
      if(recovery_code === ''){
       $("input#recovercode").focus();
       $("input#recovercode").css("border-color","red");
        return false;
    }else{
       $("input#recovercode").css("border-color","");
    }   
      
     var dataString = 'recovery_code=' + recovery_code + '&email=' + email;
      $.ajax({ // ajax post function
              type: 'POST',
              url:'bin/RecoveryCode.php',
              beforeSend: function() { $("#loading").css("display", "block"); },
              complete: function() { $("#loading").css("display", "none"); },
              data: dataString,
              success: function(data) {
              //  alert(data);
                var myData 		= JSON.parse(data); //receive json string from function login	
                var status 		= myData.status;
               // alert(status);
               if(status === "SUCCESS"){
                  
                      $("#get-recovery-code").hide();
                      $("#change-password").show();
                      $("#changepass-email").val(email);
                   
                   
               }else{
                   $("#invalid-code").show();
                   
               }
            }
        });
       
       
   }); 
    
    
  $(document).on('click', '#send-email', function (event) {
   var email = $("input#recovery_email").val();
   
   function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
      
      if(email === ''){
        $("input#recovery_email").focus();
         $("input#recovery_email").css("border-color","red");
        return false;
    }else{
       $("input#recovery_email").css("border-color","");
    }
    if(IsEmail(email)===false){
        $('#invalid-email').show();
        $("#recovery_email").css('border-color','red');
        return false;
    }else{
        $("#recovery_email").css('border-color','');
        $('#invalid-email').hide();
    }
      
     var dataString = 'email=' + email;
     // alert(dataString);
       $.ajax({ // ajax post function
              type: 'POST',
              url:'bin/PassRecovery.php',
              beforeSend: function() { $("#loading").css("display", "block"); },
              complete: function() { $("#loading").css("display", "none"); },
              data: dataString,
              success: function(data) {
                //alert(data);
                var myData 		= JSON.parse(data); //receive json string from function login	
                var status 		= myData.status;
                var mailsent            = myData.mailsent.Email_sent;
              
                if(status === "FAIL"){
                 swal({
                title: "Fail",
                text: "Kindly, Make sure the email you entered is what you registered with!",
                icon:"warning",
                type: "warning"

                   }); 
                   return false;
                }else if(mailsent === "TRUE"){
                  swal({
                title: "success",
                text: "Email has been sent with a recovery code! Kindly check your email.",
                icon:"success",
                type: "success"

                   }); 
                   $("#recoverycode").hide();
                   $("#get-recovery-code").show();
                   $("#code-email").val(email);
                } else{
                    swal({
                title: "Fail",
                text: "Code not sent to email, try again",
                icon:"warning",
                type: "warning"

                   });  
                }
                  
              }
          });
      
  });   
    
});