$(document).ready(function () {
    //alert("hey cropper");return false;

    var $modal = $('#listing-croppermodal');

    var image              = document.getElementById('listing-sample-image');
    //var cropped_listing_id  = document.getElementById('upload_image');
   //var avatar              = document.getElementById('uploaded_image');
   var avatar;
    var cropper;
var cropped_listing_id;
    $('.upload-image').change(function (event) {
        
     cropped_listing_id = this.id;
    // alert(cropped_listing_id);return false;
        var files = event.target.files;
        var done = function (url) {
           image.src = url;
            cropped_listing_id.value = '';
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
    dragMode: 'move',
    cropBoxMovable: false,
    cropBoxResizable: false,
    minCropBoxWidth: 200,
    minCropBoxHeight: 150
            

        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $('#crop-listing-cover-img').click(function () {
     // cropped_listing_id;
   // alert(cropped_listing_id);return false;
      var vendor_id = $("input#vendor-listing-cover-id").val();
         // alert(vendor_id);return false;
        
       // avatar = "up-"+cropped_listing_id;
       //var initialAvatarURL;
        var canvas;
        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200

            });
            $modal.modal('hide');

          // initialAvatarURL = avatar.src;
          //avatar.src = canvas.toDataURL();

        }
        canvas.toBlob(function (blob) {
            var formData = new FormData();
            
            formData.append('file', blob, cropped_listing_id +"-featured.jpg");

            $.ajax({
                method: 'POST',
                url: 'bin/VendorFeaturedImage.php?cropped_listing_id='+ cropped_listing_id + '&vendor_id='+vendor_id,
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

                    swal({
                        title: "Success",
                        text: "Image Saved",
                        icon: "success",
                        type: "success"
                    }).then(function() {
                     window.location = "vendor-listing";
                    });
                        
                    
                    //$('#uploaded_image').attr('src', data);
                }
            });
            
        });
        
        
  });
  

  
  });
  
 