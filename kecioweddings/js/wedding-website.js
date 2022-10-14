Dropzone.autoDiscover = false;
$(document).ready(function(){
    
  var webDropzone = new Dropzone('#wed-website-gallery', {
  addRemoveLinks: true,
  autoProcessQueue: false,
  uploadProgress:true,
  paramName: "file",
  acceptedFiles:"image/*",
  uploadMultiple:true,
  maxFilesize: 2,
  maxFiles:10,
  parallelUploads: 10,
  clickable: true,
  url: 'bin/WeddingWebsiteGallery.php',
  
  init: function(){
    
      $("#save-wedding-gallery").click(function(e) {
          e.preventDefault();
            e.stopPropagation(); 
            
         if (webDropzone.getQueuedFiles().length >= 5) {  
         webDropzone.processQueue(); 
     }else{
         swal({
            title: "Images not Enough",
            text: "Upload a Minimum of 10 images!",
            icon: "warning",
            type: "warning"
        });
        return false;
      
     }
       
      });
      
      this.on("sendingmultiple", function(data, xhr, formData) {
        $('#web-gal-loading').show();
        $('#loading').show();
       $('#save-wedding-gallery').hide();
      formData.append("user_id",$("input#userid").val());
      
      });
       $('#web-gal-loading').hide();
       $("#loading").hide();
       $('#save-wedding-gallery').show();
  this.on("successmultiple", function(files, response) {
     
       if (webDropzone.files[0].status === Dropzone.SUCCESS ) {
        
            swal({
                     title: "success",
                     text: "Gallery saved",
                     icon:"success",
                     type: "success"
                 }).then(function() {
                     location.reload();
                 });
                 return false;
      } else {
            swal({
                     title: "Fail!",
                     text: "Website info not saved",
                     icon:"warning",
                     type: "warning"
                 }).then(function(){location.reload();
                 });
                 return false;
       } 
      
        });
        this.on("errormultiple", function(files, response) {
          ('error sending');
        });
       return false; 
      
      
      
      
  }
  
  
  
    }); 
    
     $('#mywebcoverpic').change(function (event) {
    //alert ('image here');return false;
     
   var name = document.getElementById("mywebcoverpic").files[0].name;
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
  oFReader.readAsDataURL(document.getElementById("mywebcoverpic").files[0]);
  var f = document.getElementById("mywebcoverpic").files[0];
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
   form_data.append("mywebcoverpic", document.getElementById('mywebcoverpic').files[0]);
                         
                         var user_id = $("input#userid").val();
                         //alert(listing_id);return false;
                         
            $.ajax({ 
               url: 'bin/WeddingWebsiteImg.php?user_id='+ user_id,
               type: 'POST', 
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
               data: form_data, 
               contentType: false, 
               processData: false, 
                    success: function(data) {
                   // alert(data); 
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                         
                         //alert(status); return false;
                         
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                          var imagewidth           = myData.dimension; 
                         //alert(imagewidth); return false;
                         
                        if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Image Saved!",
                    icon: "success",
                    type: "success"
                });location.reload();
                return false;
                  }else if(imagewidth === "WidthSmall"){
                      swal({
                    title: "Image small",
                    text: "Your Image Width Dimensions should be a minimum of 800 px",
                    icon: "warning",
                    type: "warning"
                });
                return false;
                      
                  }else{
                      swal({
                    title: "Fail",
                    text: "Image not Saved! Try again",
                    icon: "warning",
                    type: "warning"
                });
                return false;
                      
                  }
        
                    }
        });             
  }
    });
   
   
    
     //====================Delete Gallery -========================
    
    $(document).on('click','.editwebgal',function (event){
      // alert("hello");
      var user_id        =  $('input#userid').val();
      var gal_image = this.id;
 
       
       var dataString = 'user_id=' + user_id + '&gal_image=' + gal_image;
      // alert(dataString);return false;
    
         $.ajax({
                 type: "POST",
                url: 'bin/DeleteWebsiteGallery.php',
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data:dataString,
                success: function(data){
                //alert (data);
               //  console.log(data);
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.mystatus;
               if(status === "SUCCESS"){
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
    
    
    
    $(document).on('click', '#save-web-info',function(event){
        
      var user_id          = $("input#userid").val();
      var about_groom      = $("#about-groom").val();
      var about_bride      = $("#about-bride").val();
      var church_venue     = $("input#church-venue").val();
      var reception_venue  = $("input#reception-venue").val();
      var ceremony_time    = $("input#ceremony-time").val();
      var reception_time   = $("input#reception-time").val();
      var town             = $("input#wedding-town").val();
      var rsvp_deadline    = $("input#rsvp-deadline").val();
      var our_story        = $("#web-ourstory").val();
      var guest_message    = $("#web-message").val();
      
    
      
       var dataString = 'user_id=' + user_id + '&about_groom=' + about_groom + '&about_bride=' + about_bride +'&church_venue=' + church_venue + '&reception_venue=' + reception_venue + '&ceremony_time='+ceremony_time + '&reception_time='+reception_time+ '&town='+town + '&rsvp_deadline=' + rsvp_deadline + '&our_story='+our_story + '&guest_message=' + guest_message;  
       
        $.ajax({ // ajax post function
            type:"POST",
            url:"bin/WeddingWebsite.php",
            beforeSend: function() { $("#loading").css("display", "block"); },
            complete: function() { $("#loading").css("display", "none"); },
            data: dataString,
            success: function(data) {
       
            var myData = JSON.parse(data); //receive json string from function login	
            var status 		= myData.status;
            if(status === "SUCCESS"){
                swal({
        title: "Success",
        text: "Saved successfully!",
        icon:"success",
        type: "success"
    });

            location.reload();
    }else{
         swal({
             title: "Fail",
             text: "Not saved, try again!!",
             icon:"warning",
             type: "warning"
         });
         return false;
                                            
                                        }
       
    }
    });
        
    }); 
    
    
    
    
  
    });
    