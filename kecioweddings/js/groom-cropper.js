$(document).ready(function(){
   ///=========== start Groom image upload===================================================================================
  
     var $groommodal         = $('#groompic');
      var groomimage         = document.getElementById('groom_image');
       var groominput        = document.getElementById('groom-cropper-upload-image');
       var groomavatar       = document.getElementById('groom-cropper-image');
   
    var groomcropper;

    $('#groom-cropper-upload-image').change(function (event) {
      // alert("hey");
       var files = event.target.files;
       //alert(files);
        var done = function (url) {
           groomimage.src = url;
           groominput.value = '';
           $groommodal.modal('show');
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

    $groommodal.on('shown.bs.modal', function () {
        groomcropper = new Cropper(groomimage, {
    aspectRatio: 1,
    dragMode: 'move',
    cropBoxMovable: false,
    cropBoxResizable: false,
    minCropBoxWidth: 200,
    minCropBoxHeight: 150
            

        });
    }).on('hidden.bs.modal', function () {
        groomcropper.destroy();
        groomcropper = null; 
    });
       

    $('#crop_groom').click(function () {
        $("#load-groompic").show();
        $("#crop_groom").hide();
         var user_id = $("input#groom-user-id").val();
   //  alert(user_id);
       //var initialAvatarURL;
     $('#loader').removeClass('display-none');
        var canvas;
        if (groomcropper) {
            canvas = groomcropper.getCroppedCanvas({
                width: 200,
                height: 200

            });
            $groommodal.modal('hide');
            
           // initialAvatarURL = groomimage.src;
            groomimage.src= canvas.toDataURL();
            //console.log(initialAvatarURL);

        }
      //alert(canvas);return false;
        canvas.toBlob(function (blob) {
            var formData = new FormData();
            
            formData.append('file', blob, user_id +"groom-.jpg");

            $.ajax({
                method: 'POST',
                url:'bin/GroomPic.php?user_id='+ user_id,
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
                alert(data);
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status;
                 if(status === "SUCCESS"){
                 swal({
                    title: "Success",
                    text: "Image Saved!",
                    icon: "success",
                    type: "success"
                });
                location.reload();
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
  
  //===============End of groom image upload====================================================================================
    
  });
  
  