$(document).ready(function() {
    $('.selectreview').select2({
        width: 'resolve',
        theme:"form-light"
        
    });
    
    $(document).on('click', '.kecio-fedback', function(event) {
        var buttonreview   = this.id;
          var review_id    = buttonreview.replace("reveiew-",'');
          var feedback     = $("#web-"+review_id).val();
          var vendor_name  = $("#vendorname").val(); 
        
          if(feedback === ''){
              swal({
                     title: "Not sent",
                     text: "You can not send a blank message",
                     icon:"warning",
                     type: "warning"
                        });
                      }
                      
            var aboutWords = $.trim($("#web-"+review_id).val()).split(" ");
             var countabout = aboutWords.length; 
            // alert(countabout); return false;   
             if(countabout<= '9'){
                $("#web-"+review_id).css('border-color','red');
                $("#words-"+review_id).show();
                $("#web-"+review_id).focus();
                 return false;
            }else if(countabout>= '10'){
                $("#web-"+review_id).css('border-color','');
                $("#words-"+review_id).hide();
                            
                        }
          var dataString = 'review_id=' + review_id + '&feedback=' + feedback + '&vendor_name=' + vendor_name;
          
          $.ajax({
                 type: "POST",
                url: "bin/ReviewFeedback.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
              
                   var myData 		= JSON.parse(data); //receive json string from function login                  
                    var status 		= myData.status;  
                     if(status === "SUCCESS"){
                          swal({
                     title: "Success",
                     text: "Feedback sent",
                     icon:"success",
                     type: "success"
                          
                 }).then(function() {
                    location.reload();
                    });
                     } else{
                        swal({
                     title: "Not sent",
                     text: "Kindly Try again",
                     icon:"warning",
                     type: "warning"
                        });
                     }
                }
            
            });
        
    });
    
   // Add reviews ======================================================================================/// 
     $(document).on('click', '#save_review', function(event) {
   
     var user_id        = $("input#userid").val();
     var vendor_id      = $("input#thisvendor").val();
     var listing_id     = $("input#listing_id").val();
     var review         = $("#review").val();
     var ratings        = $("input[name='ratings']:checked").val();
     var name           = $("input#rname").val();
     var email          = $("input#remail").val();
     var profile_image  = $("input#prof_image").val();
     var listing_name   = $("input#listname").val();
     
     if(ratings === undefined){
         $("#ratingsrequired").show();
         return false;
     }else{
         $("#ratingsrequired").hide(); 
     }
     
            
             if(review === ''){
                $("#review").css('border-color','red');
                $("#reviewwords").show();
                $("#review").focus();
                 return false;
            }else {
                $("#review").css('border-color','');
                $("#reviewwords").hide();
                            
                    }
     
  //alert (profile_image); return false;
      var dataString = 'user_id=' +user_id  +'&listing_id='+ listing_id +'&ratings=' + ratings + '&review=' + review + '&name='+ name +'&email='+email +'&profile_image=' + profile_image + '&listing_name=' + listing_name +'&vendor_id=' + vendor_id ;
        //alert (dataString);
           $.ajax({
                 type: "POST",
                url: "bin/AddReview.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                //  alert (data); return false;
                    var myData 		= JSON.parse(data); //receive json string from function login                  
                    var status 		= myData.status;  
                     if(status === "SUCCESS"){
                          swal({
                     title: "Success",
                     text: "Thank You for your Review",
                     icon:"success",
                     type: "success"
                 }).then(function() {
                    location.reload();
                    });
                     }  
                 
              }
          });
         
   });
    
    
    
    $(document).on('change','#exampleFormControlSelect2', function(event){
    
   // alert('sha');return false;
    
   var listing_id    = $('select#exampleFormControlSelect2').val();
   //alert(listing_id); return false;
   var dataString = 'listing_id='+ listing_id;
   //alert (dataString); return false;
   $.ajax({ // ajax post function
				type: "POST",
				url: "bin/MyReviews.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				 success: function(data){
                                    // alert(data); return false;
                                   
                            $('#reviews-div').html(data);
                            
                     }
                              
     });
    
});
    
    
});