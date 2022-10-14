$(document).ready(function(){
    $(document).on('click','.unpublish-sha', function (event){
      //alert("hry");
       var listing_id = this.id;
      // alert(listing_id);return false;
      var dataString = "listing_id=" + listing_id;
        
        $.ajax({ // ajax post function
				type: "POST",
				url: "bin/UnPublishListing.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
                                  //alert(data); return false;
                                 
                                       var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                         //alert(status); return false;
                                         
                                    if(status === "SUCCESS"){
                                             swal({
                     title: "Success",
                     text: "Un-Published!",
                     icon:"success",
                     type: "success"
                 }).then(function(){
                     location.reload(); 
                 });
                 }else{
                  swal({
                     title: "Fail",
                     text: "List not Published!",
                     icon:"warning",
                     type: "warning"
                 });
                   return false;
                                            
                                        }
                             }
                         });
         
  });
     $(document).on('click', '.del-declined-list', function (event) {
          
         //alert("save me"); return false;  
         var mylisting_id = this.id;
         var listing_id = mylisting_id.replace("dec-",'');
          //alert(lisitng_id); return false;
         
         var dataString = 'listing_id=' + listing_id;
       //alert(dataString);return false;
        
        swal({
        title: "Are you sure You?",
        text: "You will not be able to Recover this Listing once Deleted!",
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
                url: "bin/DeleteListing.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                  //  alert(data); return false;
                     
             swal("Deleted!", "Your Listing has been deleted.", "success");
            location.reload();
                }
                    
            });
         }else{ swal("Cancelled", "Your Listing has not been deleted ;)", "error");}
    
        }); 
         
      });
   
    
    
    $(document).on('click','.decline-shaz',function(event){
      var listing_id = this.id;
        // alert(listing_id); return false;
        // alert('hello'); return false;
        var dataString = "listing_id=" + listing_id;
        
        $.ajax({ // ajax post function
				type: "POST",
				url: "bin/DeclinedListing.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
                                 // alert(data); return false;
                                 
                                       var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                         //alert(status); return false;
                                         
                                    if(status === "SUCCESS"){
                                             swal({
                     title: "Success",
                     text: "Listing Decline !",
                     icon:"success",
                     type: "success"
                 }).then (function(){
                           
                       location.reload(); 
                 });
                              
              }else{
                 swal({
                     title: "Fail",
                     text: "List not Approved !",
                     icon:"warning",
                     type: "warning"
                 });
                    return false;
                                            
                                }
                             }
                         });
         
     });  
    $(document).on('click', '.approve-shaz', function(event) {
         
         var listing_id = this.id;
        // alert(listing_id); return false;
        // alert('hello'); return false;
        var dataString = "listing_id=" + listing_id;
        
        $.ajax({ // ajax post function
				type: "POST",
				url: "bin/ApproveListing.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
                                 // alert(data); return false;
                                 
                                       var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                         //alert(status); return false;
                                         
                                    if(status === "SUCCESS"){
                                             swal({
                     title: "Success",
                     text: "List Approved !",
                     icon:"success",
                     type: "success"
                 });
                 location.reload();
                                           
                                            
                                        }else{
                                           swal({
                     title: "Fail",
                     text: "List not Approved !",
                     icon:"warning",
                     type: "warning"
                 });
                                              return false;
                                            
                                        }
                             }
                         });
         
         
         
         
     });
    //  alert("edit gallery");
     $(document).on('click', '.del-declined-list', function (event) {
          
         //alert("save me"); return false;  
         var mylisting_id = this.id;
         var listing_id = mylisting_id.replace("dec-",'');
          //alert(lisitng_id); return false;
         
         var dataString = 'listing_id=' + listing_id;
       //alert(dataString);return false;
        
        swal({
        title: "Are you sure You?",
        text: "You will not be able to Recover this Listing once Deleted!",
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
                url: "bin/DeleteListing.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                   // alert(data); return false;
                     
             swal("Deleted!", "Your Listing has been deleted.", "success");
            location.reload();
                }
                    
            });
         }else{ swal("Cancelled", "Your Listing has not been deleted ;)", "error");}
    
        }); 
         
      });
    
    
 $(document).on('click','.publish-sha', function (event){
      //alert("hry");
      var  user_id    = $("input#userid").val();
       var listing_id = this.id;
     //alert(listing_id);return false;
      var dataString = "listing_id=" + listing_id + '&user_id=' +user_id;
        
        $.ajax({ // ajax post function
				type: "POST",
				url: "bin/PublishListing.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
                                 // alert(data); return false;
                                 
                                       var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                        var realdata            = myData.data.status_active;
                                       // alert(realdata);return false;
                                         //alert(status); return false;
                                         
                                if(status === "SUCCESS"){
                                             swal({
                     title: "Success",
                     text: "Wait for approval from the admin!",
                     icon:"success",
                     type: "success"
                 }).then(function (){
                       location.reload();
                 });
               
                                           
                                            
                              }else if(realdata === "FALSE"){
                                           swal({
                     title: "Not Active",
                     text: "Listing can not be published because your account is not active. Kindly purchase our packages to enjoy our services.",
                     icon:"warning",
                     type: "warning"
                 }). then(function  (){
                      $(location).attr('href','pricings'); 
                 });
                                              return false;
                                            
                                        }
                             }
                         });
         
  });
  });