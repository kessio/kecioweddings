  $(document).ready(function(){
  
  //============== Login ======================//
     $(document).on('click', '#vendor_login', function(event) {
           
          // alert('hello'); return false;
           
                    var cemail                 =  $("input#vendoremail").val();
                    var phone_number            =  $("input#login-phone-number").val();
                    var cpassword               =  $("input#vendorpassword").val();
                    
                    
                    
                               if(cpassword === ''){
                                    $("input#vendorpassword").focus();
                                     $("#vendorpassword").css('border-color','red');
                                    return false;
                                }else{
                                    $("#vendorpassword").css('border-color','');
                                }
                                
                                
                       var dataString ='cemail=' + cemail + '&phone_number='+ phone_number + '&cpassword=' + cpassword;
                   //    alert (dataString);
                       
                        $.ajax({ // ajax post function
				type: "POST",
				url: "bin/Login.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function () { $("#loading").css("display","none"); },
                                data: dataString,
				success: function(data) {
                           //   alert(data);
                                   
                                        var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                        var roledata            = myData.data; 
                                       var role = roledata.role;
                                      // alert(role);
                                        // alert(status); return false;
                                        
                                    if(status === "SUCCESS" & role === 'vendor'){
                                            $(location).attr('href','vendor-dashboard');
                                            
                                            return false;
                                            
                                        }else if(status === "SUCCESS" & role === 'couple'){
                                            $(location).attr('href','couple-dashboard');
                                            
                                            return false;
                                            
                                        }else if(status === "SUCCESS" & role === 'admin'){
                                            $(location).attr('href','admin-dashboard');
                                            
                                            return false;
                                            
                                        
                                    }else{
                                          $('#vloginerr').show();
                                            
                                              return false;  
                                        }
                                    
                                },
             
                            });
                       
    });
  });
    