$(document).ready(function () {
    //alert("hey cropper");return false;
    //
 //================ change email or phone number =================================================
 
  $("#vendorchangephone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("5000");
               return false;
    }
                            });
 
 $(document).on('click','#save-email-phone', function(event){
   var vendor_id         = $("input#userid").val();
   var business_name     = $("input#businessname").val();  
   var phone_number      = $("input#vendorchangephone").val(); 
    var phoneWords       = $.trim($("#vendorchangephone").val()).split("");
    var countphone       = phoneWords.length;
   var email             = $("input#vendorchangeemail").val();  
   
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
                                 if(business_name === ''){
                                    $("#businessname").css('border-color','red');
                                    $("input#businessname").focus();
                                    return false;
                                }else{
                                    $("#businessname").css('border-color','');
                                }
                                
                               if(email === ''){
                                   $("#vendorchangeemail").css('border-color','red');
                                    $("input#vendorchangeemail").focus();
                                    return false;
                                }else{
                                    $("#vendorchangeemail").css('border-color','');
                                }
                                if(IsEmail(email)===false){
                                    $('#edinvalidemail').show();
                                    $("#vendorchangeemail").css('border-color','red');
                                    return false;
                                }else{
                                    $("#vendorchangeemail").css('border-color','');
                                    $('#edinvalidemail').hide();
                                }
                                
                            if(countphone !== 10){
                            $("#vendorchangephone").css('border-color','red');
                            $("#editphonecount").show();
                            $("#vendorchangephone").focus();
                             return false;
                            }else{
                            $("#vendorchangephone").css('border-color','');
                            $("#editphonecount").hide();
                            
                            } 
   
   
   
   
   var dataString = 'vendor_id=' + vendor_id + '&business_name=' + business_name + '&email='+ email + '&phone_number=' + phone_number;  
   
  // alert(dataString);
  $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/VendorChangeEmailPass.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data){ 
                       //  alert(data);
                    var myData 		= JSON.parse(data); //receive json string from function login
                    var status 		= myData.status;
                    var real_data       = myData.data;

                     //alert(status); return false;
                         
                        if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Changes saved!",
                    icon: "success",
                    type: "Success"
                });
                        }else if(real_data.user_exists === "TRUE"){
                                             
                                            swal({
                                            title: "Fail!",
                                            text: "Email or phone number already in use!",
                                            icon:"warning",
                                            type: "warning"
                                        });}else{
                         swal({
                    title: "Failed!",
                    text: "Changes not successful, try again!",
                    icon: "warning",
                    type: "warning"
                });    
                        }
              }
  });  
     
 });
 
 
 
//================= profile information==========================================
 $(document).on('click','#save-business-profile', function(event){
    var vendor_id         = $("input#userid").val();
    //alert(vendor_id);return false;
    var vendor_name       = $("input#vendor-name").val();
    var phone_number      = $("input#vendor-contact-no").val();
    var business_website  = $("input#business-website").val();
    var business_address  = $("input#business-address").val();
    var vendor_facebook   = $("input#vendor-facebook").val();
    var vendor_instagram  = $("input#vendor-instagram").val();
    var vendor_twitter    = $("input#vendor-twitter").val();
    var vendor_youtube    = $("input#vendor-youtube").val();
    
    if(vendor_name === undefined){
        vendor_name = '';
    }
     if(phone_number === undefined){
        phone_number = '';
    }
     if(business_website === undefined){
        business_website = '';
    }
     if(business_address === undefined){
        business_address = '';
    }
     if(vendor_facebook === undefined){
        vendor_facebook = '';
    }
    if(vendor_instagram === undefined){
        vendor_instagram = '';
    }
     if(vendor_twitter === undefined){
        vendor_twitter = '';
    }
     if(vendor_youtube === undefined){
        vendor_youtube = '';
    }
    
    
     var dataString = 'vendor_id=' + vendor_id + '&vendor_name='+ vendor_name + '&phone_number=' + phone_number + '&business_website=' + business_website + '&business_address=' + business_address + '&vendor_facebook=' + vendor_facebook + '&vendor_instagram=' + vendor_instagram + '&vendor_twitter=' + vendor_twitter + '&vendor_youtube=' + vendor_youtube ; 
     //alert(dataString);return false;
     
      $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/VendorProfile.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                     success: function(data){
                       //alert(data); return false;
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                         
                         //alert(status); return false;
                         
                        if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Profile Saved!",
                    icon: "success",
                    type: "Success"
                }).then(location.reload());
                return false;
                  }else{
                      swal({
                    title: "Fail",
                    text: "Profile not Saved! Try again",
                    icon: "warning",
                    type: "warning"
                });
                return false;
                      
                  }
                     }
                     
     }); 
 });

//============================PRofile image ===================================================================================

    var $modal = $('#vendor-croppermodal');

    var image  = document.getElementById('vendor-sample-image');
    var input  = document.getElementById('vendor-cropper-upload-image');
    var avatar = document.getElementById('vendor-cropper-uploaded-image');
    var cropper;

    $('#vendor-cropper-upload-image').change(function (event) {

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

    $('#vendor-profile-crop').click(function () {
        var vendorid = $("input#vendor-cropper-profile-id").val();
        var initialAvatarURL;
        var canvas;
        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200

            });
            $modal.modal('hide');

            initialAvatarURL = avatar.src;
            avatar.src = canvas.toDataURL();

        }
        canvas.toBlob(function (blob) {
            var formData = new FormData();

            //var files = $('#upload_image')[0].files[0]; 
            formData.append('file', blob, vendorid +".jpg");

            $.ajax({
                method: 'POST',
                url: 'bin/VendorProfileImg.php?vendorid=' + vendorid,
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
                // alert(data);return false;

                    
                        var myData 		= JSON.parse(data); //receive json string from function login
                        var status 		= myData.status;
                         
                         //alert(status); return false;
                         
                        if(status === "SUCCESS"){
                      swal({
                    title: "Success",
                    text: "Profile pic Saved!",
                    icon: "success",
                    type: "success"
                });location.reload();
                return false;
                  }else{
                      swal({
                    title: "Fail",
                    text: "Profile Pic not Saved! Try again",
                    icon: "warning",
                    type: "warning"
                });
                return false;
                      
                  }
                    
                   
                }
            });
        }, );

    });

});

