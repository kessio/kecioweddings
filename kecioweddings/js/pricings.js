$(document).ready(function(){
    //============================3 Months========================================================//
    
    $(document).on('click','#3months', function (event){
       // alert("hey");return false;
        swal({
                    title: "Info",
                    text: "Our packages will be available to you once your free package expires",
                    icon: "info",
                    type: "info"
                });
                return false;
        
        
        
  /*  var validitydays      = $("input#validitydays").val();
    var vendor_id         = $("input#userid").val();
    var plan_type        = $("input#standardplan").val();
   // alert(validitydays);return false;
        
      var dataString = 'vendor_id=' + vendor_id + '&validitydays=' + validitydays + '&plan_type=' + plan_type;   
    //  alert(dataString);return false;
      $("#3mthsloading").show();
      $("#3months").hide();
       $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/PaymentPlan.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                     // alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                  
                   $("#3mthsloading").hide();
                   $("#3months").show();
                    
                    if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Payment has been received. We have sent you a receipt.",
                    icon: "success",
                    type: "success"
                }).then(function() {
                      location .reload();
                    });
                 return false;
                    }else{
                     swal({
                    title: "Fail",
                    text: "Payment not received, try again later.",
                    icon: "warning",
                    type: "warning"
                });   
                return false;
                    }
                }
                    
                });
      */
      
    });
   
    $(document).on('click','#6months', function (event){
        
        swal({
                    title: "Info",
                    text: "Our packages will be available to you once your free package expires",
                    icon: "info",
                    type: "info"
                });
                return false;
        
        
   /* var validitydays      = $("input#prevaliditydays").val();
    var vendor_id         = $("input#userid").val();
    var plan_type        = $("input#premiumplan").val();
   // alert(validitydays);return false;
        
      var dataString = 'vendor_id=' + vendor_id + '&validitydays=' + validitydays + '&plan_type=' + plan_type;   
    //  alert(dataString);return false;
      $("#6mthsloading").show();
      $("#6months").hide();
       $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/PaymentPlan.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                     // alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                  
                   $("#6mthsloading").hide();
                   $("#6months").show();
                    
                    if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Payment has been received. We have sent you a receipt.",
                    icon: "success",
                    type: "success"
                }).then(function() {
                      location .reload();
                    });
                 return false;
                    }else{
                     swal({
                    title: "Fail",
                    text: "Payment not received, try again later.",
                    icon: "warning",
                    type: "warning"
                });   
                return false;
                    }
                }
                    
                });
      */
      
    });
    
    $(document).on('click','#12months', function (event){
        
        swal({
                    title: "Info",
                    text: "Our packages will be available to you once your free package expires",
                    icon: "info",
                    type: "info"
                });
                return false;
        
        
  /*  var validitydays      = $("input#yearvaliditydays").val();
    var vendor_id         = $("input#userid").val();
    var plan_type        = $("input#yaerlyplan").val();
   // alert(validitydays);return false;
        
      var dataString = 'vendor_id=' + vendor_id + '&validitydays=' + validitydays + '&plan_type=' + plan_type;   
    //  alert(dataString);return false;
      $("#12mthsloading").show();
      $("#12months").hide();
       $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/PaymentPlan.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                     // alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                  
                   $("#12mthsloading").hide();
                   $("#12months").show();
                    
                    if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Payment has been received. We have sent you a receipt.",
                    icon: "success",
                    type: "success"
                }).then(function() {
                      location .reload();
                    });
                 return false;
                    }else{
                     swal({
                    title: "Fail",
                    text: "Payment not received, try again later.",
                    icon: "warning",
                    type: "warning"
                });   
                return false;
                    }
                }
                    
                });
      
      */
    });
   // ==========================INVOICE==================================================================================//
    $(document).on('click','#3months', function (event){
        
   /* var validitydays      = $("input#validitydays").val();
    var vendor_id         = $("input#userid").val();
    var plan_type         = $("input#standardplan").val();
   // alert(validitydays);return false;
        
      var dataString = 'vendor_id=' + vendor_id + '&validitydays=' + validitydays + '&plan_type=' + plan_type;   
    //  alert(dataString);return false;
      $("#3mthsloading").show();
      $("#3months").hide();
       $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/Invoice.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                     // alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                  
                   $("#3mthsloading").hide();
                   $("#3months").show();
                    
                    if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Payment has been received. We have sent you a receipt.",
                    icon: "success",
                    type: "success"
                }).then(function() {
                      location .reload();
                    });
                 return false;
                    }else{
                     swal({
                    title: "Fail",
                    text: "Payment not received, try again later.",
                    icon: "warning",
                    type: "warning"
                });   
                return false;
                    }
                }
                    
                });
      
      */
    });
   
    $(document).on('click','#6months', function (event){
        
  /*  var validitydays      = $("input#prevaliditydays").val();
    var vendor_id         = $("input#userid").val();
    var plan_type        = $("input#premiumplan").val();
   // alert(validitydays);return false;
        
      var dataString = 'vendor_id=' + vendor_id + '&validitydays=' + validitydays + '&plan_type=' + plan_type;   
    //  alert(dataString);return false;
      $("#6mthsloading").show();
      $("#6months").hide();
       $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/Invoice.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                     // alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                  
                   $("#6mthsloading").hide();
                   $("#6months").show();
                    
                    if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Payment has been received. We have sent you a receipt.",
                    icon: "success",
                    type: "success"
                }).then(function() {
                      location .reload();
                    });
                 return false;
                    }else{
                     swal({
                    title: "Fail",
                    text: "Payment not received, try again later.",
                    icon: "warning",
                    type: "warning"
                });   
                return false;
                    }
                }
                    
                });
      */
      
    });
    
    $(document).on('click','#12months', function (event){
        
   /* var validitydays      = $("input#yearvaliditydays").val();
    var vendor_id         = $("input#userid").val();
    var plan_type        = $("input#yaerlyplan").val();
   // alert(validitydays);return false;
        
      var dataString = 'vendor_id=' + vendor_id + '&validitydays=' + validitydays + '&plan_type=' + plan_type;   
     // alert(dataString);return false;
      $("#12mthsloading").show();
      $("#12months").hide();
       $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/Invoice.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                     // alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                  
                   $("#12mthsloading").hide();
                   $("#12months").show();
                    
                    if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Payment has been received. We have sent you a receipt.",
                    icon: "success",
                    type: "success"
                }).then(function() {
                      location .reload();
                    });
                 return false;
                    }else{
                     swal({
                    title: "Fail",
                    text: "Payment not received, try again later.",
                    icon: "warning",
                    type: "warning"
                });   
                return false;
                    }
                }
                    
                });
      */
      
    });
    
    
    
    
    });