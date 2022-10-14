$(document).ready(function(){
    
    /// change password========================================================
    
     $(document).on('click', '#vchange_password', function(event) {
        // alert("hey");
        var user_id           = $("input#password-change-id").val(); 
        var keyedpass         = $("input#keyed_Password").val();
        var newpass           = $("input#New_Password").val();
        var confirm_password  = $("input#Confirm_Password").val();
       
        if(keyedpass ===''){
         $("input#keyed_Password").focus();
          $("input#keyed_Password").css("border-color","red");
          $("#currentpass").show();
         return false;
 
         }else{
              $("input#keyed_Password").css("border-color","");
              $("#currentpass").hide();
         }
       
       
         if(newpass ===''){
         $("input#New_Password").focus();
          $("input#New_Password").css("border-color","red");
          $("#newpass").show();
         return false;
 
         }else{
              $("input#New_Password").css("border-color","");
               $("#newpass").hide();
         }
     
        if(newpass !== confirm_password){
                 $("#passmatch").show();
                  $("input#Confirm_Password").focus();
                  $("input#Confirm_Password").css("border-color","red");
                  return false;
            
             }else if(newpass === confirm_password){
                 $("#passmatch").hide();
                 $("input#New_Password").css("border-color","");
                 
             }
         
         var dataString ='user_id='+ user_id + '&keyedpass=' + keyedpass + '&newpass=' + newpass + '&confirm_password=' + confirm_password; 
         //alert(dataString); return false;
         
         $.ajax({ // ajax post function
				type:"POST",
				url:"bin/PasswordChange.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
					var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                        if(status === "Password Match"){
                                            swal({
                                    title: "Success",
                                    text: "Password Changed!",
                                    icon:"success",
                                    type: "success"
                                });
                                
                                                location.reload();
                                        }else{
                                             swal({
                     title: "warning",
                     text: "The current password you entered is wrong, try again!",
                     icon:"warning",
                     type: "warning"
                 });
                 return false;
                                            
                                        }
                                      
                                }
                });
         
     });
    

   
    
    //================ Sign up===========================================================//
      $("#phone_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });
    
$(document).on('click', '#vendor_signup', function(event) {
                     // alert('hello'); return false;
                                
                    var business_name       =$("input#businessname").val();
                    var email               =$("input#vemail").val();
                    var password            =$("input#passwordregister").val();
                    var phone_no            =$("input#phone_no").val();
                    var phoneWords          = $.trim($("#phone_no").val()).split("");
                    var countphone          = phoneWords.length; 
                    var conpassword         =  $("input#conpassword").val();
                    // alert(countphone);return false;
                   // var vendor_type         =$("select#vendor_type").val(); 
                    //var description         =$("#description").val();
                    
                    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
                                 if(business_name === ''){
                                    $("#businessname").css('border-color','red');
                                    $("input#businessname").focus();
                                    return false;
                                }else{
                                    $("#businessname").css('border-color','');
                                }
                                
                               if(email === ''){
                                   $("#vemail").css('border-color','red');
                                    $("input#vemail").focus();
                                    return false;
                                }else{
                                    $("#vemail").css('border-color','');
                                }
                                if(IsEmail(email)===false){
                                    $('#invalid_email').show();
                                    $("#vemail").css('border-color','red');
                                    return false;
                                }else{
                                    $("#vemail").css('border-color','');
                                    $('#invalid_email').hide();
                                }
                                
                            if(countphone !== 10){
                            $("#phone_no").css('border-color','red');
                            $("#phonecount").show();
                            $("#phone_no").focus();
                             return false;
                            }else{
                            $("#phone_no").css('border-color','');
                            $("#phonecount").hide();
                            
                            } 
                             if(password === ''){
                                    $("#passwordregister").css('border-color','red');
                                    $("input#passwordregister").focus();
                                    return false;
                                }else{
                                    $("#passwordregister").css('border-color','');
                                }
                              if(conpassword !== password){
                                  $("#conpassword").css('border-color','red');
                                  $("#pass_match").show();
                                  return false;
                              }else{
                                    $("#conpassword").css('border-color','');
                                    $("#pass_match").hide();
                                }
                               
                               if(!($('#checkboxterms').is(":checked"))){
                               $("#agreeterms").show();
                                  return false;
                             }else{
                                 $("#agreeterms").hide();
                             }  
                                
                              var dataString =  'business_name=' + business_name + '&email=' + email +'&phone_no=' + phone_no + '&password=' + password; // prepare string to send to file bin
                                 
                              //  alert (dataString);
                                
                                $.ajax({ // ajax post function
				type: "POST",
				url: "bin/VendorSignup.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
					//alert(data); return false;
                                        var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status; //access json string status from our function
                                        var real_data           = myData.data; // access json string data from our function
                                        
                                         if(status === "SUCCESS"){
                                            swal({
                                            title: "Success",
                                            text: "Signup Successful.You can now login!",
                                            icon:"success",
                                            type: "success"
                                        });
                                        $("#vendor_form").modal("hide");
                                        $("#general-login").modal('show');
                                            return false;
                                             
                                         }else if(real_data.user_exists === "TRUE"){
                                             
                                            swal({
                                            title: "Fail!",
                                            text: "Email or phone number already exists!",
                                            icon:"warning",
                                            type: "warning"
                                        });
                                             
                                         }else {
                                    swal({
                                            title: "Signup Fail",
                                            text: "Signup Failed. Try Again!",
                                            icon:"warning",
                                            type: "warning"
                                        });
                                         
                                         
                                    }   
                                        
                                    }
                                    
                                });
  });
  
  
  
  
    
    
    
    
    
});
