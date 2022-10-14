$(document).ready(function(){
    
  
   var myDropzoneedit = new Dropzone('#edit-gall-dropzone', {
  addRemoveLinks: true,
  autoProcessQueue: false,
  uploadProgress:true,
  paramName: "file",
  acceptedFiles:"image/*",
  uploadMultiple:true,
  maxFilesize: 2,
  maxFiles:10,
  parallelUploads:10,
  clickable: true,
  url: 'bin/EditGallery.php',
     
  init: function(){
   //  alert("mr dropzone");
          $("#addeditgallery").click(function(e) {
         ///alert("hey");
            e.preventDefault();
            e.stopPropagation();
            
             myDropzoneedit.processQueue();
               $("#loading").show();
          });
       
        this.on("sendingmultiple", function(data, xhr, formData) {
            
      formData.append("listing_id",$("#editlisting_id").val());
      
        });
        ;
        this.on("successmultiple", function(files, response) {
            $("#loading").hide()
         //alert('success sending');
         //alert(response);
        // return false;
        if (myDropzoneedit.files[0].status === Dropzone.SUCCESS ) {
          swal({
                     title: "Success",
                     text: "Photos Added To Gallery",
                     icon:"success",
                     type: "sucess"
                 }).then(function() {
                      location .reload();
                    });
                 return false;
      } else {
          swal({
                     title: "Fail",
                     text: "Gallery not Saved!",
                     icon:"warning",
                     type: "warning"
                 });

      } 
      
        });
        this.on("errormultiple", function(files, response) {
          ('error sending');
        });
       return false; 
            
            
          },
    });
    
    
 
    
    
    
    
    
    
    
    
    //====================Delete Gallery -========================
    
    $(document).on('click','.editgal',function (event){
      // alert("hello");
      var listing_id     =  $('input#editlisting_id').val();
      var gal_image = this.id;
 
       
       var dataString = 'listing_id=' + listing_id + '&gal_image=' + gal_image;
      // alert(dataString);return false;
    
         $.ajax({
                 type: "POST",
                url: 'bin/DeleteGallery.php',
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data:dataString,
                success: function(data){
               // alert (data);return false;
               //  console.log(data);
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.mystatus;
               //  alert(status);
                 // console.log('status:' + status);
                 if(status === "SUCCESS"){
                  /// var tr = ("tash-"+gal_image);
                 //   console.log(tr);return false;
                   // alert("mamamama");
                   var trids = gal_image.replace(".","");
                   //alert(trids);
                  // $("#tashsuccess").show();
                     $("#tash-" + trids).fadeOut('5000');
                    // console.log("#tash-" + trids);
                     return false;
                     
                 }
                 
              }
          });
       event.preventDefault();
   });
   
 
   
    
    
    
    /////===================== Publish Listing ========================================//
    $(document).on('click','.publish-sha', function (event){
      //alert("hry");
       var listing_id = this.id;
     //alert(listing_id);return false;
      var dataString = "listing_id=" + listing_id;
        
        $.ajax({ // ajax post function
				type: "POST",
				url: "bin/PublishListing.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
                                  //alert(data); return false;
                                 
                                       var myData 		= JSON.parse(data); //receive json string from function login	
					var status 		= myData.status;
                                      
                                    if(status === "SUCCESS"){
                                             swal({
                     title: "Success",
                     text: "You Listing will be Published shortly!",
                     icon:"success",
                     type: "success"
                 }), $('#li-'+ listing_id).hide(); 
                
                 return false;
                        
                                            
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
  
   
    
    
    // multiple image upload//
    

    
    
    
    
      ///================================================edit coverpic=================================//
       $('#vendor-coverpic').change(function (event) {
    //alert ('image here');return false;
     
   var name = document.getElementById("vendor-coverpic").files[0].name;
   //alert(name);return false;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
 // alert(ext);return false;
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) === -1) 
  {
   swal({
                    title: "Fail",
                    text: "Format not supported, choose a different image!",
                    icon: "warning",
                    type: "warning"
                });
                return false;
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("vendor-coverpic").files[0]);
  var f = document.getElementById("vendor-coverpic").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 15000000)
  {
   swal({
                    title: "Fail",
                    text: "Photo too big, choose a different image!",
                    icon: "warning",
                    type: "warning"
                });
                return false;
  }
  else
  {
   form_data.append("vendor-coverpic", document.getElementById('vendor-coverpic').files[0]);
                         
                         var listing_id = $("input#editlisting_id").val();
                         //alert(listing_id);return false;
                         
            $.ajax({ 
               url: 'bin/ListingCoverImage.php?listing_id='+ listing_id,
               type: 'POST', 
               data: form_data, 
               contentType: false, 
               processData: false, 
                    success: function(data) {
                        
                      // alert(data); return false;
                         
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                         
                         //alert(status); return false;
                         
                        if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Cover pic Saved!",
                    icon: "Success",
                    type: "Success"
                });location.reload();
                return false;
                  }else{
                      swal({
                    title: "Fail",
                    text: "Cove Pic not Saved! Try again",
                    icon: "warning",
                    type: "warning"
                });
                return false;
                      
                  }
                    }
        
        
        });             
  }
    });
   
    
    // edit listing
     $("#editwhatsapp").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#editerrmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
    
         });
    
     $(document).on('click', '#editlist', function (event) {
        //alert("eyyyyy");
     var listing_id     =  $('input#editlisting_id').val();
     var listing_name   =  $('input#edittitle').val();
     var facility       =  $('#editfacilities').val();
     var price          =  $('input#editprice').val();
     var about          =  $('#editabout').val();
     var services       =  $('#editservices').val();
     var facebook       =  $('input#editfacebook').val();
     var instagram      =  $('input#editinstagram').val(); 
     var whatsapp       = $('input#editwhatsapp').val();
      var phoneWords    = $.trim(whatsapp).split("");
     var countphone     = phoneWords.length; 
     var tents        = new Array();
      $("input[name='tent']:checked").each(function(){
          
          tents.push($(this).val());
         
      });
      
       //alert("my tents are:" + tents); 
       
      var amenities = new Array();
            $("input[name='amenity']:checked").each(function() {
                amenities.push($(this).val());
            }); 
 
            //alert("My favourite programming languages are: " + amenities);
            
          var furniture        = new Array();
      $("input[name='furniture']:checked").each(function(){
          
          furniture.push($(this).val());
         
      });
    //  alert("my furniture are:" + furniture);
    
      
                                 var aboutWords = $.trim($("#editabout").val()).split(" ");
                               var countabout = aboutWords.length;
                             //alert(countabout);
                           if(countabout<= '49'){
                            $("#editabout").css('border-color','red');
                            $("#aboutcount").show();
                            $("#editabout").focus();
                             return false;
                        }else if(countabout>= '50'){
                            $("#editabout").css('border-color','');
                            $("#aboutcount").hide();
                            
                        }
                        
                        if(listing_name === ''){
                            $("#edittitle").css('border-color','red'); 
                            $("#edittitle").focus();
                             
                            return false;
                        }else{
                            $("#edittitle").css('border-color',''); 
                        }
             
                        if(countphone !== 10){
                            $("#editwhatsapp").css('border-color','red');
                            $("#editphonecount").show();
                            $("#editwhatsapp").focus();
                             return false;
                            }else{
                            $("#editwhatsapp").css('border-color','');
                            $("#editphonecount").hide();
                        }
                        
      
       var dataString = 'listing_id='+ listing_id + '&listing_name=' + listing_name +  '&facility=' + facility + '&tents='+tents + '&price=' + price + '&about=' + about+ '&services=' + services +'&furniture=' + furniture +'&whatsapp='+whatsapp+'&facebook=' + facebook + '&instagram=' + instagram;
        
     // alert (dataString); return false;
        $.ajax({
                 type: "POST",
                url: 'bin/EditListing.php',
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data:dataString,
                success: function(data){
                // alert (data);return false;
                   
                   var myData 		= JSON.parse(data); //receive json string from function login
                   var status 		= myData.status; 
                   
                   
                 if(status === "SUCCESS"){
                               swal({
                        title: "Success",
                        text: "Listing Edited successful!",
                        icon: "success",
                        type: "success"
                    });
                            
                      return false;
                    }else  if(status === "FAIL"){
                       
                        swal({
                        title: "Fail",
                        text: "Editing Failed!",
                        icon: "warning",
                        type: "Warning"
                    });
                        
                    }
                    
                   
                }
           
       });
     });
   
    
    
    
    
});