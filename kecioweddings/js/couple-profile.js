$(document).ready(function(){
    
    
     $('#couple-coverpic').change(function (event) {
    //alert ('image here');return false;
     
   var name = document.getElementById("couple-coverpic").files[0].name;
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
  oFReader.readAsDataURL(document.getElementById("couple-coverpic").files[0]);
  var f = document.getElementById("couple-coverpic").files[0];
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
   form_data.append("couple-coverpic", document.getElementById('couple-coverpic').files[0]);
                         
                         var user_id = $("input#userid").val();
                        // alert(user_id);return false;
                         
            $.ajax({ 
               url: 'bin/BioPic.php?user_id='+ user_id,
               type: 'POST', 
               beforeSend: function() { $("#loading").css("display", "block"); },
               complete: function () { $("#loading").css("display","none"); },
               data: form_data, 
               contentType: false, 
               processData: false, 
               success: function(data) {
                     // alert(data);return false;
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                          var imagewidth           = myData.dimension; 
                         //alert(imagewidth); return false;
                         
                        if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Image Saved!",
                    icon: "Success",
                    type: "Success"
                });location.reload();
                return false;
                  }else if(imagewidth === "Image Small"){
                      swal({
                    title: "Image small",
                    text: "Make sure your Image Width size is less than the height (potrait size) and the height should be a minimum of 800px",
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
   
   $("#profphone_no").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });
    
    
    $(document).on('click', '#couple-wedding-info', function(event) {
       var user_id        = $("input#userid").val(); 
       var email          = $("input#profemail").val();
       var phone_number   = $("input#profphone_no").val();
       var phoneWords     = $.trim($("#profphone_no").val()).split("");
       var countphone     = phoneWords.length;
       var bride          = $("input#couple-bride-name").val(); 
       var groom          = $("input#couple-groom").val(); 
       var weddingdate    = $("input#couple-weddingdate").val();
       var weddingaddress = $("input#couple-weddingvenue").val();
       
        function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
      if(email === ''){
        $("#profemail").css('border-color','red');
         $("input#profemail").focus();
         return false;
     }else{
         $("#profemail").css('border-color','');
     }
     if(IsEmail(email)===false){
         $('#edivprofemail').show();
         $("#profemail").css('border-color','red');
         $("input#profemail").focus();
         return false;
     }else{
         $("#profemail").css('border-color','');
         $('#edivprofemail').hide();
     }
       
       if(countphone !== 10){
        $("#profphone_no").css('border-color','red');
        $("#profphone_no").focus();
        $("#editprofphone_no").show();
        
         return false;
        }else{
        $("#profphone_no").css('border-color','');
        $("#editprofphone_no").hide();

        } 
       
       
       var dataString =  'user_id='+ user_id + '&email='+ email + '&phone_number=' + phone_number +  '&bride=' + bride + '&groom=' + groom + '&weddingaddress=' + weddingaddress + '&weddingdate=' + weddingdate;
       
       //alert (dataString); return false;
       $.ajax({ // ajax post function
				type: "POST",
				url: "bin/WeddingInfo.php",
				beforeSend: function() { $("#loading").css("display", "block"); },
                                complete: function() { $("#loading").css("display", "none"); },
				data: dataString,
				success: function(data) {
                                     // alert(data);return false; 
                                    var myData 		= JSON.parse(data); //receive json string from function login
                                    var status 		= myData.status;
                                    var real_data     = myData.data;
                                   //alert(status);return false;
                                    
                        if(status === "SUCCESS"){
                       swal({
                     title: "Success",
                     text: "Saved!",
                     icon:"success",
                     type: "success"
                 });
                       
                        
                    }else if(real_data.emailphone_exists === "TRUE"){
                                             
                                            swal({
                                            title: "Fail!",
                                            text: "Email or phone number already in use!",
                                            icon:"warning",
                                            type: "warning"
                                        });}else{
                      
                        return false;
                        
                    }
                                
                                    
           },
                    
         });
   
     });
    
    
    
    
    //couple profile (my profile)
   $(document).on('click', '#couple_socialmedia', function(event) {
            var user_id        = $("input#userid").val();
            var facebook       = $("input#couple-facebook").val();
            var instagram      = $("input#couple-instagram").val();
            var dataString     = 'user_id='+ user_id + '&facebook=' +facebook +'&instagram='+ instagram ;

        // alert(dataString); return false;
                   $.ajax({ 
                     type: "POST", 
                    url: "bin/CoupleProfile.php",                   
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString, 
                    success: function(data) {
                        
                    // alert (data); return false; 
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                        
                       // alert(status);return false;
                   if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Profile Updated!",
                    icon: "success",
                    type: "success"
                });
                      return false;
                  }
     
                    },
                    
            });
                                
     });
    
    
    
     
    
//======================== bride image upload ========================================================================================
      var $bridemodal          = $('#bridepic');
      var brideimage           = document.getElementById('bride_image');
      var brideinput             = document.getElementById('bride-cropper-upload-image');
      var brideavatar            = document.getElementById('bride-cropper-uploaded-image');
    // var avatar;
    var bridecropper;

    $('#bride-cropper-upload-image').change(function (event) {
       
    //var cropped_listing_id  = document.getElementById('upload_image');
   //var avatar              = document.getElementById('uploaded_image');
   
    //alert("hello");
       var files = event.target.files;
        var done = function (url) {
           brideimage.src = url;
           brideinput.value = '';
           $bridemodal.modal('show');
        };

      var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {


                if (url) {
                    done(url.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            } else {
                swal({
                    title: "Fail",
                    text: "Format not supported, choose a different image!",
                    icon: "warning",
                    type: "warning"
                });
                return false;
            }
        }
        
  
 }); 

    $bridemodal.on('shown.bs.modal', function () {
        bridecropper = new Cropper(brideimage, {
    aspectRatio: 1,
    dragMode: 'move',
    cropBoxMovable: false,
    cropBoxResizable: false,
    minCropBoxWidth: 200,
    minCropBoxHeight: 150
            

        });
    }).on('hidden.bs.modal', function () {
        bridecropper.destroy();
        bridecropper = null; 
    });
       

    $('#crop_bride').click(function () {
        $("#load-bridepic").show();
        $("#crop_bride").hide();
         var user_id = $("input#couple-id").val();
        var canvas;
        if (bridecropper) {
            canvas = bridecropper.getCroppedCanvas({
                width: 200,
                height: 200

            });
            $bridemodal.modal('hide');

         //initialAvatarURL = brideavatar.src;
         
          brideimage.src = canvas.toDataURL();

        }
       // alert(canvas);return false;
        canvas.toBlob(function (blob) {
            var formData = new FormData();
            
            formData.append('file', blob, user_id +"bride.jpg");

            $.ajax({
                method: 'POST',
                url: 'bin/BridePic.php?user_id='+ user_id,
                beforeSend: function () {
                    $("#loading").css("display", "block");
                },
                complete: function () {
                    $("#loading").css("display", "none");
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (data)
                {
                   //alert(data);return false;
                 var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status;
                         
                         //alert(status); return false;
                         
               if(status === "SUCCESS"){
                 swal({
                    title: "Success",
                    text: "Image Saved!",
                    icon: "success",
                    type: "success"
                });
                location.reload();
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
        });
       
        
  });
  
  //======= End of Bride Image=====
    
    //============================PRofile image ===================================================================================

    var $modal = $('#couple-croppermodal');

    var image  = document.getElementById('couple-sample-image');
    var input  = document.getElementById('couple-cropper-upload-image');
    var avatar = document.getElementById('couple-cropper-uploaded-image');
    var cropper;

    $('#couple-cropper-upload-image').change(function (event) {

        var files = event.target.files;
        var done = function (url) {
            image.src = url;
            input.value = '';
            $modal.modal('show');
        };

        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {


                if (url) {
                    done(url.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            } else {
                swal({
                    title: "Fail",
                    text: "Format not supported, choose a different image!",
                    icon: "warning",
                    type: "warning"
                });
                return false;
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview',

        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $('#couple_crop_profile').click(function () {
       $("#load-cprofpic").show();
        $("#couple_crop_profile").hide();
        var user_id = $("input#couple-id").val();
        //alert(user_id);return false;
        var initialAvatarURL;
        var canvas;
        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200

            });
            $modal.modal('hide');

            //initialAvatarURL = avatar.src;
            image.src = canvas.toDataURL();

        }
        canvas.toBlob(function (blob) {
            var formData = new FormData();

            //var files = $('#upload_image')[0].files[0]; 
            formData.append('file', blob, user_id +".jpg");

            $.ajax({
                method: 'POST',
                url: 'bin/CoupleProfileImage.php?user_id=' + user_id,
                beforeSend: function () {
                    $("#loading").css("display", "block");
                },
                complete: function () {
                    $("#loading").css("display", "none");
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (data)
                {
                // alert(data);
                   swal({
                    title: "Success",
                    text: "Profile pic Saved!",
                    icon: "success",
                    type: "success"
                });location.reload();
                return false;
                  
                   
                }
            });
        }, );

    });

    
});