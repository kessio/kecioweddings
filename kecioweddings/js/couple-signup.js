$(document).ready(function(){
    
     $("#couple-phonenumber").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#couple-errmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });
    
      $(document).on('click', '#couple_signup', function(event) {
         // alert("hey");return false;
                  
                    var name               =  $("input#couple-name").val();
                    var email              =  $("input#couple-email").val();
                    var bride_name         =  $("input#bridename").val();
                    var groom_name         =  $("input#groomname").val();
                    var wedding_date       =  $("input#couple-weddingdate").val();
                    var wedding_venue      =  $("input#couple-weddingvenue").val();
                    var phone_number       =  $("input#couple-phonenumber").val();
                    var phoneWords         =  $.trim($("#couple-phonenumber").val()).split("");
                    var countphone         =    phoneWords.length; 
                    var password           =  $("input#couple-password").val();
                    var confirm_password   =  $("input#couple-confirmpassword").val();
                    
                     function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
                              if(name === ''){
                                   
                                    $("input#couple-name").focus();
                                    $("input#couple-name").css("border-color","red");
                                   return false;
                                }else{
                                  $("input#couple-name").css("border-color",""); 
                                }
                                  
                               
                                if(bride_name === ''){
                                    $("input#bridename").focus();
                                     $("input#bridename").css("border-color","red");
                                    return false;
                                }else{
                                     $("input#bridename").css("border-color","");
                                }
                                if(groom_name === ''){
                                   $("input#groomname").focus();
                                     $("input#groomname").css("border-color","red");
                                    return false;
                                }else{
                                  $("input#groomname").css("border-color","");
                                }
                                
                                if(email === ''){
                                    $("input#couple-email").focus();
                                     $("input#couple-email").css("border-color","red");
                                    return false;
                                }else{
                                   $("input#couple-email").css("border-color","");
                                }
                                if(IsEmail(email)===false){
                                    $('#couple-invalid-email').show();
                                    $("#couple-email").css('border-color','red');
                                    return false;
                                }else{
                                    $("#couple-email").css('border-color','');
                                    $('#couple-invalid-email').hide();
                                }
                               if(wedding_date === ''){
                                    $("input#couple-weddingdate").focus();
                                     $("input#couple-weddingdate").css("border-color","red");
                                    return false;
                                }else{
                                    $("input#couple-weddingdate").css("border-color","");
                                } 
                                
                            if(countphone !== 10){
                            $("#couple-phonenumber").css('border-color','red');
                            $("#couple-phonecount").show();
                            $("#couple-phonenumber").focus();
                             return false;
                            }else{
                            $("#couple-phonenumber").css('border-color','');
                            $("#couple-phonecount").hide();
                            
                            } 
                                 if(wedding_venue === ''){
                                   $("input#couple-weddingvenue").focus();
                                     $("input#couple-weddingvenue").css("border-color","red");
                                    return false;
                                }else{
                                     $("input#couple-weddingvenue").css("border-color","");
                                    
                                }
                                
                               if(password === ''){
                                    $("#passwordblank").show();
                                    $("input#couple-password").focus();
                                    $("input#couple-password").css("border-color","red");
                                    return false;
                                } else{
                                   $("#passwordblank").hide();
                                    $("input#couple-password").css("border-color",""); 
                                }
                                    
                                
                                 if(confirm_password !== password){
                                    $("#couple-passwordmismatch").show();
                                    $("input#couple-confirmpassword").focus();
                                    $("input#couple-confirmpassword").css("border-color","red");
                                    return false;
                                }else{
                                    $("#couple-passwordmismatch").hide();
                                    $("input#couple-confirmpassword").css("border-color","");
                                    
                                }
                                if(!($('#coupleterms').is(":checked"))){
                               $("#agree-terms").show();
                                  return false;
                             }else{
                                 $("#agree-terms").hide();
                             }  
                  
            var dataString =  'name=' + name + '&email=' + email + '&bride_name=' + bride_name + '&phone_number=' + phone_number + '&groom_name=' + groom_name + '&wedding_date=' + wedding_date + '&wedding_venue=' + wedding_venue + '&password=' + password;
            //alert(dataString);return false;
               

              $.ajax({ // ajax post function
              type: "POST",
              url: "bin/CoupleSignup.php",
              beforeSend: function() { $("#loading").css("display", "block"); },
              complete: function() { $("#loading").css("display", "none"); },
              data: dataString,
              success: function(data) {

                      //alert(data); return false;
                      var myData 		= JSON.parse(data); //receive json string from function login	
                      var status 		= myData.status; //access json string status from our function
                      var real_data             = myData.data; // access json string data from our function
                                        
                                        //alert(status); return false;
                                         //alert(real_data.email_exists); return false;
                    if(status === "SUCCESS"){
                       swal({
                            title: "Success",
                            text: "Signup Successful. You can now Login",
                            icon:"success",
                            type: "success"

                          });
                          $("#login_form").modal("hide");
                          $("#general-login").modal("show");
                                            
                                            return false;
                                            
                                             
                                         }else if(real_data.user_exists === "TRUE"){
                                             
                                              swal({
                                                    title: "Fail",
                                                    text: "Email or phone number already exists, try with a different one.",
                                                    icon:"warning",
                                                    type: "warning"

                                                  });
                                             return false;
                                             
                                             
                                         } 
                                         
                                    
                                    else {
                                             
                                            $('#signup-fail').show(); 
                                            $('#signup-success').hide();
                                            $('#missing-fields').hide();
                                            $("#emailexists").hide();
                                            $("#load-signup").hide();
                                            $("#couple_signup").show();
                                         }
                                         
                                         
                                        
                                    },
                                    
                                   
                                    
                                    
                                    
                                });
                            
event.preventDefault();
  });






});

