$(document).ready(function(){
          
   $("#preloader").css("display");   
    /// Pagination ====================================================================================///
    
    
    
    
   //// renmove form favourites ====================================================================================// 
    $(document).on('click','.deletefav',function (event){
      var user_id         = $('input#userid').val();
      var listingid       = this.id;
      var listing_id     = listingid.replace('del','');
      //alert(listing_id);
      
      var dataString = 'user_id=' + user_id + '&listing_id=' + listing_id;
         var dataString = 'user_id='+ user_id + '&listing_id='+ listing_id ;
      //alert(dataString);
      $.ajax({
                 type: "POST",
                url: "bin/DeleteFavorites.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                  //alert (data); 
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status;
                  if(status === "SUCCESS"){
                      $("#list-" + listing_id).fadeOut('5000');
                     
                  }
              }
          });
        
    });
    
    $(document).on('click','.savefavs', function (event){
      var user_id      = $('input#userid').val();
      var listing_id = this.id;
     var notes       = $('#text-'+listing_id).val();
      var state      = $('#state'+listing_id).val();
      
       var dataString = 'user_id='+ user_id + '&listing_id='+ listing_id + '&notes=' + notes + '&state='+ state ;
      //alert(dataString);
      $.ajax({
                 type: "POST",
                url: "bin/UpdateFavorites.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                 // alert (data); return false;
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status; 
                  
                  if(status === "SUCCESS"){
                 
                  swal({
                     title: "Saved",
                     text: "Your notes saved",
                     icon:"success",
                     type: "success"
                 }); 
                 location.reload();
                 return false;
                  }
              }
          });
    });
    
    
    
    $(document).on('click','.kecio-whishlist', function (event){
       var user_id      = $('input#userid').val();
      var cat_id       = $('input#cat_id').val();
      var listing_id   = $('input#listing_id').val();
      
     // alert(listing_id);return false;
      var dataString = 'user_id='+ user_id + '&cat_id=' + cat_id + '&listing_id='+ listing_id;
      
       //alert (dataString); return false;
       
      
   $.ajax({
                 type: "POST",
                url: "bin/Favourites.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                  //alert (data); return false;
                    
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status; 
                  
                   if(status === "SUCCESS"){
                             
                            
                      return false;
                    } else if(status ==="FAIL"){
                        $("#myfavs").show();
                        $("#click-favs").hide(); 
                      
                      return false; 
                        
                        
                    }   
                      
                }
      
  });
        
      
  });
  
    
    
    
    $(document).on('click','.wishlist-sign', function (event){
      //alert('hello');return false;
      var user_id         = $('input#userid').val();
      var listingid       = this.id;
      var array           = listingid.split(",");
      var listing_id      = array[0];
      var cat_id          = array[1];
      var listing_name    = $("input#name"+ listing_id).val();
      var featured_image  =$("input#featured" + listing_id).val(); 
      //alert(featured_image);return false;
     
  //alert(listing_id); return false;
      var dataString = 'user_id='+ user_id + '&listing_id='+ listing_id + '&cat_id=' + cat_id + '&listing_name=' + listing_name + '&featured_image=' + featured_image;
      
       //alert (dataString); return false;
       
        $.ajax({
                 type: "POST",
                url: "bin/Favourites.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                //alert (data); return false;
                   
                   
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status; 
                  
                   if(status === "SUCCESS"){
                             $("#kec" + listing_id).hide();
                             $("#shazr-" + listing_id).show(); 
                            
                      return false;
                    }
                    
                   
               }
                   
               });
      
      return false;
  });
    
    
    
    
  
    $(document).on('click','.btn-default-wishlist', function (event){
      
      var user_id = $('input#sender_id').val();
      var cat_id  = $('input#cat_id').val();
      var listing_id = this.id;
      
     // alert(listing_id);return false;
      var dataString = 'user_id='+ user_id + '&cat_id=' + cat_id + '&listing_id='+ listing_id;
      
       //alert (dataString); return false;
      
   $.ajax({
                 type: "POST",
                url: "bin/Favourites.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                  //alert (data); return false;
                    
                  var myData 		= JSON.parse(data); //receive json string from function login
                  var status 		= myData.status; 
                  
                   if(status === "SUCCESS"){
                             $("#" + listing_id).hide();
                             $("#shazr-" + listing_id).show(); 
                            
                      return false;
                    } else if(status ==="FAIL"){
                        
                       $("#accountModal").modal("show");
                      return false; 
                        
                        
                    }   
                      
                }
      
  });
        
      
  });
    
    // filter location categor==================================================================================//
     $('#catdata').on('click',function(){
             jQuery("#catdata").hide();
             jQuery("#box").show();
             jQuery("#defaultbutton").show();
             jQuery("#searchgtn").hide();
         });
    
    
    $("#searchgtn").click(function (){
        var category   = $("#catdata").val();
        var location_value = $('#location-box').val();
        var mylocation = $('#locations [value="' + location_value + '"]').data('value');
         if(mylocation === undefined){
        mylocation = '';
    }
    
     $(location).attr('href','suppliers-list/'+category + '/' + mylocation);
    });
    
     $('#mymama').click(function()
    {
       
        var value    = $('#box').val();
        var category = $('#categories [value="' + value + '"]').data('value');
        //alert(category);
        
        var location_value = $('#location-box').val();
        var mylocation = $('#locations [value="' + location_value + '"]').data('value');
      //alert(mylocation);
    
    if(category === undefined && ' '){
        category = '';
    }
    if(mylocation === undefined){
        mylocation = '';
    }

     $(location).attr('href','suppliers-list/'+category + '/' + mylocation);
     
         
    });
    
   $(document).on('click','#search-home',function(){
       
       var category     = $('select#home-catgeory').val();
       var mylocation   = $('select#home-location').val();
       
      // alert(mylocation);return false;
       
       if(category === undefined && ' '){
        category = '';
    }
    if(mylocation === undefined && ''){
        mylocation = '';
    }
       $(location).attr('href','suppliers-list/'+category + '/' + mylocation); 
   });
   
   
   //======================== Phone number on lists =======================================================================================//
    
    $(document).on('click','.keciogetphone',function(){
       // alert("hie");return false;
       var list_id       = this.id;
       var listing_id    = list_id.replace('get-','');
       var phone_views   = $("input#ph-"+ listing_id).val();
      
      // var name          = $("input#user_name").val();
      // var phone         = $("input#user_phonenumber").val();
      // var vendor_id    = $("input#vendorid-"+listing_id).val();
       
      //var dataString     =   'listing_id='+ listing_id + '&name=' + name + '&phone=' + phone + '&vendor_id=' + vendor_id;
       var dataString     =   'listing_id='+ listing_id + '&phone_views=' + phone_views;
    //  alert(dataString);return false;
       $.ajax({
                 type: "POST",
                url: "bin/ListingViews.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
              // alert(data);return false;
               }
           });
    
      
  });
   $(document).on('click','.keciowhatsapp',function(){
       // alert("hie");return false;
       var list_id       = this.id;
       var listing_id    = list_id.replace('whts-','');
       var whatsapp_views   = $("input#wh-"+ listing_id).val();
      
     
       var dataString     =   'listing_id='+ listing_id + '&whatsapp_views=' + whatsapp_views;
      //alert(dataString);return false;
       $.ajax({
                 type: "POST",
                url: "bin/ListingViews.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
            // alert(data);return false;
               }
           });
    
      
  });
  
  $(document).on('click','.keciogal',function(){
       // alert("hie");return false;
       var list_id       = this.id;
       var listing_id    = list_id.replace('gv-','');
       var gallery_views = $("input#galviews-"+ listing_id).val();
      
     
       var dataString     =   'listing_id='+ listing_id + '&gallery_views=' + gallery_views;
      //alert(dataString);return false;
       $.ajax({
                 type: "POST",
                url: "bin/ListingViews.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
            // alert(data);return false;
               }
           });
    
      
  });
  
  $(document).on('click','.keciolisviews',function(){
       // alert("hie");return false;
       var list_id       = this.id;
     //  alert(list_id);
       var listing_id    = list_id.replace('lv-','');
       var listing_views = $("input#listview-"+ listing_id).val();
      
       var dataString     =   'listing_id='+ listing_id + '&listing_views=' + listing_views;
     // alert(dataString);
       $.ajax({
                 type: "POST",
                url: "bin/ListingViews.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
            // alert(data);return false;
               }
           });
    
      
  });
 $(document).on('click','.keciolistviews',function(){
       // alert("hie");return false;
       var list_id       = this.id;
      //alert(list_id);return false;
       var listing_id    = list_id.replace('namlist-','');
       var listing_views = $("input#listview-"+ listing_id).val();
      
       var dataString     =   'listing_id='+ listing_id + '&listing_views=' + listing_views;
      //alert(dataString);return false;
       $.ajax({
                 type: "POST",
                url: "bin/ListingViews.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
            // alert(data);return false;
               }
           });
    
      
  });
  
   $(document).on('click','.imglist',function(){
       // alert("hie");return false;
       var list_id       = this.id;
      //alert(list_id);return false;
       var listing_id    = list_id.replace('imgvi-','');
       var listing_views = $("input#listview-"+ listing_id).val();
      
       var dataString     =   'listing_id='+ listing_id + '&listing_views=' + listing_views;
      alert(dataString);return false;
       $.ajax({
                 type: "POST",
                url: "bin/ListingViews.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
            // alert(data);return false;
               }
           });
    
      
  });
    
    
  $(document).on('click','.keciophone',function(){
    
      
     var listing_id = this.id;
    // alert(listing_id);
    var dataString =   'listing_id='+ listing_id;
     
       $.ajax({
                 type: "POST",
                url: "bin/PhoneModalData.php",
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data: dataString,
                success: function(data){
                   //alert (data); 
                     var myData 		= JSON.parse(data); //receive json string from function login
                      var status 		= myData.status;
                      var realdata              = myData.data;
                    // alert(realdata.vendor_id);
                      if(status === "SUCCESS"){
                             $('#vendor-id').val(realdata.vendor_id);
                             $("#listingid").val(listing_id);
                      }
               }
           });
          
  });
    
    $("#modal-phone").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#couple-errmsgs").html("Digits Only").show().fadeOut("5000");
      return false;
    }
     });
    
    
    $(document).on('click','#requestphone',function(){
        
        var listing_id        = $("#listingid").val();
        var vendor_id         = $("#vendor-id").val();
        var name              = $("#modal-name").val();
        var phone             = $("#modal-phone").val();
        var phoneWords        = $.trim($("#modal-phone").val()).split("");
        var countphone        = phoneWords.length; 
  
        
        if(name === ''){
       $("#modal-name").css('border-color','red');
        $("input#modal-name").focus();
        return false;
    }else{
        $("#modal-name").css('border-color','');
    }  
     if(countphone !== 10){
    $("#modal-phone").css('border-color','red');
    $("#phonecount").show();
    $("#modal-phone").focus();
     return false;
    }else{
    $("#modal-phone").css('border-color','');
    $("#phonecount").hide();

    } 
      var dataString = 'listing_id=' + listing_id + '&vendor_id=' + vendor_id + '&name=' + name + '&phone=' + phone;
    // alert(dataString);
        $.ajax({ // ajax post function
                    type: "POST",
                    url: "bin/RequestContact.php",
                    beforeSend: function() { $("#loading").css("display", "block"); },
                    complete: function() { $("#loading").css("display", "none"); },
                    data: dataString,
                    success: function(data) {
              //   alert(data);return false;

                   var myData 		= JSON.parse(data); //receive json string from function login	
                   var mstatus          = myData.mstatus;
                   var mdata            = myData.mdata;
                   var astatus          = myData.astatus;
                   var adata            = myData.adata;
                   
                  // alert(astatus);
                   
                      if(mstatus === "SUCCESS"){
                          $("#fillcontact").hide();
                         $("#givecontact").show();
                          $('#vname').text(mdata.business_name);
                          $('#vphone_number').text(mdata.phone_number);
                          
                           $('#request_quote').on('hidden.bs.modal', function () { 
                          location.reload();
                            }); 
                        }else if(astatus === "SUCCESS"){
                          $("#fillcontact").hide();
                         $("#givecontact").show();
                          $('#vname').text(adata.business_name);
                          $('#vphone_number').text(adata.phone_number);
                          
                           $('#request_quote').on('hidden.bs.modal', function () { 
                          location.reload();
                            }); 
                        }else {
                         $("#givecontact").hide(); 
                         swal({
                     title: "Not available",
                     text: "Phone not available!",
                     icon:"warning",
                     type: "warning"
                 });
                       }
                       
                       


                        }
                    });
        
    }); 
   
});