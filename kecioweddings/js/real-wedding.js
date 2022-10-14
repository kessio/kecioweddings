Dropzone.autoDiscover = false;
$(document).ready(function(){
   
  var myDropzone = new Dropzone('#realwed-gallery', {
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
  url: 'bin/RealWed.php',
  
  init: function(){
    
      $("#real-wedding-info").click(function(e) {
          e.preventDefault();
            e.stopPropagation(); 
            
            if (document.getElementById("couple-bride-name").value===''){
                $("#couple-bride-name").css('border-color','red');
                $("input#couple-bride-name").focus();
                return false;
                
            }else if(document.getElementById("couple-bride-name").value!==''){
               $("#couple-bride-name").css('border-color','');
                
            }
            if (document.getElementById("couple-groom").value===''){
                $("#couple-groom").css('border-color','red');
                $("input#couple-groom").focus();
                return false;
                
            }else if(document.getElementById("couple-groom").value!==''){
               $("#couple-groom").css('border-color','');
                
            }
             if (document.getElementById("couple-weddingdate").value===''){
                $("#couple-weddingdate").css('border-color','red');
                $("input#couple-weddingdate").focus();
                return false;
                
            }else if(document.getElementById("couple-weddingdate").value!==''){
               $("#couple-weddingdate").css('border-color','');
                
            }
            if (document.getElementById("couple-weddingtown").value===''){
                $("#couple-weddingtown").css('border-color','red');
                $("input#couple-weddingtown").focus();
                return false;
                
            }else if(document.getElementById("couple-weddingtown").value!==''){
               $("#couple-weddingtown").css('border-color','');
                
            }
           
           if(document.getElementById("cover_picture").value===''){
            $("#coverpicerror").show(); 
            $("#cover_picture").focus();
            return false;

        }else if(document.getElementById("cover_picture").value!==''){
            $("#coverpicerror").hide(); 

        } 
        
         var featuredname = document.getElementById("cover_picture").files[0].name;
        // alert(name);return false;
        var ext = featuredname.split('.').pop().toLowerCase();
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
        
        
         if (myDropzone.getQueuedFiles().length >= 5) {  
         myDropzone.processQueue(); 
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
      formData.append("realwed_id",$("#relwedid").val());    
      formData.append("user_id",$("#userid").val());
      formData.append("bride_name",$("#couple-bride-name").val());
      formData.append("groom_name",$("#couple-groom").val());
      formData.append("wedding_date",$("#couple-weddingdate").val());
      formData.append("town",$("#couple-weddingtown").val());
      formData.append("wedding_theme",$("#couple-weddingtheme").val());
      formData.append("featured_image",$("#cover_picture")[0].files[0]);
      
       });
       
  this.on("successmultiple", function(files, response) {
     // alert(response);return false;
       var obj     = jQuery.parseJSON(response);
       var status  = obj.status;
     var imagewidth = obj.dimension;
       
       if(status === "SUCCESS"){
        
          swal({
                     title: "success",
                     text: "Gallery saved",
                     icon:"success",
                     type: "success"
                 }).then(function() {
                     window.location = "couple-realwed";
                 });
                 return false;
              } else if(imagewidth === "ImageSmall") {
          swal({
                     title: "Fail!",
                     text: "Ensure your featured Image minimum width is 800px",
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
    
    
    $(document).on('click','.editwebgal',function (event){
      // alert("hello");
      var user_id        =  $('input#userid').val();
      var gal_image = this.id;
 
       
       var dataString = 'user_id=' + user_id + '&gal_image=' + gal_image;
      // alert(dataString);return false;
    
         $.ajax({
                 type: "POST",
                url: 'bin/DeleteRealwedGallery.php',
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
    
    
    
    
  
    
});