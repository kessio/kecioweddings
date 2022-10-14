 Dropzone.autoDiscover = false;
$(document).ready(function(){
    
    $("#whatsapp").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
    
         });
   
   var myDropzone = new Dropzone('#add-listing-dropzone', {
  addRemoveLinks: true,
  autoProcessQueue: false,
  uploadProgress:true,
  paramName: "file",
  acceptedFiles:"image/*",
  uploadMultiple:true,
  maxFilesize:2,
  maxFiles:10,
  parallelUploads:10,
  clickable: true,
  url: 'bin/AddListing.php',
    
  init: function(){
     
   
          $("#savemylisting").click(function(e) {
          // alert("hey");
            e.preventDefault();
            e.stopPropagation();
            
            myDropzone.on("maxfilesexceeded", function(files) {
    myDropzone.removeFile(files);
});
            
            
            
            
            var aboutWords = $.trim($("#about").val()).split(" ");
             var countabout = aboutWords.length; 
             //alert(countabout);
             var phoneWords          = $.trim($("#whatsapp").val()).split("");
              var countphone          = phoneWords.length; 
            
           if (document.getElementById("title").value===''){
                $("#title").css('border-color','red');
                $("#listingname").show();
                $("input#title").focus();
                return false;
                
            }else if(document.getElementById("title").value!==''){
               $("#title").css('border-color','');
                $("#listingname").hide();
               
            }
           
                if(document.getElementById("mycategory_id").value===''){
                             $("#categoryfield").show(); 
                             $("#mycategory_id").focus();
                             return false;
                             
                         }else if(document.getElementById("mycategory_id").value!==''){
                             $("#categoryfield").hide(); 
                              
                         }  
                         if(document.getElementById("region").value===''){
                             $("#countyfield").show(); 
                             $("#region").focus();
                             return false;
                             
                         }else if(document.getElementById("region").value!==''){
                             $("#countyfield").hide(); 
                              
                         } 
                          if(document.getElementById("town").value===''){
                             $("#townfield").show(); 
                             $("#town").focus();
                             return false;
                             
                         }else if(document.getElementById("town").value!==''){
                             $("#townfield").hide(); 
                              
                         } 
                        
                       if(countabout<= '49'){
                            $("#about").css('border-color','red');
                            $("#aboutcount").show();
                            $("#about").focus();
                             return false;
                        }else if(countabout>= '50'){
                            $("#about").css('border-color','');
                            $("#aboutcount").hide();
                            
                        } 
                        
                         if(countphone !== 10){
                            $("#whatsapp").css('border-color','red');
                            $("#myphonecount").show();
                            $("#whatsapp").focus();
                             return false;
                            }else{
                            $("#whatsapp").css('border-color','');
                            $("#myphonecount").hide();
                            
                            } 
                            
                            if(document.getElementById("cover_picture").files.length === 0){
                               // alert(name);
                           $("#coverpicerror").show();
                            $("#cover_picture").focus();    
                              return false;  
                            }else{
                             $("#coverpicerror").hide();
                           
                            }
                          
                        var cover_image = document.getElementById("cover_picture").files[0].name;
                        // alert(cover_image);return false;
                        var ext = cover_image.split('.').pop().toLowerCase();
                        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) === -1) 
                        {
                         swal({
                                          title: "Fail",
                                          text: "Cover Picture format is not an image, upload an image!",
                                          icon: "warning",
                                          type: "warning"
                                      });
                                      return false;
                        }
        
 
              
            if (myDropzone.getQueuedFiles().length >= 5) {                
            myDropzone.processQueue();
        }else  if (myDropzone.getQueuedFiles().length > 10) {
          swal({
            title: "Fail",
            text: "Upload a Maximum of 10 images!",
            icon: "warning",
            type: "warning"
        });
        return false;    
        } else {
          swal({
            title: "Images not Enough",
            text: "Upload a Minimum of 5 images!",
            icon: "warning",
            type: "warning"
        });
        return false;   
        }
          $("#loading").show();
          
        });
        
  
  this.on("sendingmultiple", function(data, xhr, formData) {
      
      formData.append("vendor_id",$("#vendorid").val());
      formData.append("listing_name",$("#title").val());
      formData.append("cat_id",$("#mycategory_id").val());
      formData.append("subcategory",$("subcategory").val()); 
      formData.append("entertainment",$("entertainment").val());
     
      formData.append("price", $("#price").val());
      formData.append("country", $("#country").val());
      formData.append("region", $("#region").val());
      formData.append("subregion",$("#town").val());
      formData.append("about", $("#about").val());
     
      formData.append("facebook",$("#facebook").val());
      formData.append("instagram",$("#instagram").val());
      formData.append("whatsapp",$("#whatsapp").val());
      formData.append("price",$("#price")[0].files[0]);
      formData.append("cover_picture",$("#cover_picture")[0].files[0]);
            var amenities = new Array();
            $("input[name='amenity']:checked").each(function() {
                amenities.push($(this).val());
            });
            formData.append("amenity",amenities);
            
          var tents  = new Array();
      $("input[name='tent']:checked").each(function(){
          tents.push($(this).val());
      });
      formData.append("tent",tents);
      
       var furniture        = new Array();
      $("input[name='furniture']:checked").each(function(){
          furniture.push($(this).val());
      });
       formData.append("furniture",furniture); 
       
        var featured        = new Array();
      $("input[name='featured']:checked").each(function(){
          featured.push($(this).val());
      });
       formData.append("featured",featured);
       
      
       
       var services = $("#services").val();
       if(services === undefined){
           services = '';
           formData.append("services",services); 
           
       }else{
          formData.append("services",$("#services").val());  
       }
       var facility = $("#facilities").val();
       if(facility === undefined){
           facility = '';
           formData.append("facility",facility); 
           
       }else{
           formData.append("facility",$("#facilities").val());
       }
 
  });
  

  
  this.on("successmultiple", function(files, response) {
     // alert(response);
      $("#loading").hide();
      myDropzone.getFilesWithStatus(Dropzone.SUCCESS);
    // console.log(response) ; 
      var obj         = jQuery.parseJSON(response);
      var status      = obj.status;
        if (status === "SUCCESS" ) {
           
          swal({
                     title: "success",
                     text: "Listing saved",
                     icon:"success",
                     type: "success"
                 }).then(function() {
                     window.location = "vendor-listing";
                 });
                 return false;
    
       
  }else {
       swal({
                    title: "Fail",
                    text: "Listing not saved,try again later",
                    icon:"warning",
                    type: "warning"
                });
      
                   return false;
             
  }

      
   
        });
        
        
    }
    
    });
    
   
    
    
    
    
   // alert("add listing");
$(document).on('change', '.shaz-category', function (event) {
        
        //alert("category id"); return false;
        var cat_id       =  $('select#mycategory_id').val();;
        var dataString =  'cat_id=' + cat_id;
        
       //alert(dataString); return false;
        $.ajax({
                 type: "POST",
                url: "bin/CategoryControls.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                   $('#category-controls-div').html(data);
                   
                }
           
       });
       return false;
        
    });
});

 $(document).on('change', '#region', function (event) {
      // alert("save me"); return false;
        var County_id       =  $('select#region').val();;
        //alert(County_id);return false;
        var dataString =  'County_id=' + County_id;
        
      //alert(dataString) ;
        $.ajax({
                 type: "POST",
                url: "bin/CountyControls.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                  //  alert(data);return false;
                   $('#county-controls-div').html(data);
                   
                }
           
       });
       return false;
        
    });