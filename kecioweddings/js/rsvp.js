$(document).ready(function(){
    $(document).on('click','#send-rsvp',function(event){
        var userid    = $("#userid").val();
        var guest_id  = $("input#guest-id").val();
        
        if($("#customRadio1").is(":checked")){
        $('#customRadio1').prop("checked",true)
            var rsvp = "Attending";
        }else if($("#customRadio2").is(":checked")) {
            $('#customRadio2').prop("checked",true)
            var rsvp = "Declined"
        }
        
        //alert (rsvp);return false;
        var dataString = "userid=" + userid +"&guest_id=" + guest_id + "&rsvp=" + rsvp;
        //alert(dataString);return false;
        $.ajax({
                 type: "POST",
                url: 'bin/RsvpSend.php',
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data:dataString,
                success: function(data){
                    //alert(data);return false;
                    var myData 		= JSON.parse(data); //receive json string from function login
                   var status 		= myData.status;
                   if(status === "SUCCESS"){
                       swal({
                    title: "Success",
                    text: "We got it,Thanks for RSVPing",
                    icon: "success",
                    type: "success"
                }).then(function() {
                     setTimeout(location.reload.bind(location), 1000);
                    });
                     
                   }else if(status === "FAIL"){
                            swal({
                    title: "Fail",
                    text: "You can not submit blank RSVP, kindly choose one.",
                    icon: "warning",
                    type: "warning"
                });
            }
                    
                    
                }
                
        });
        
    });
  // Search rsvp number =================  
$(document).on('click','#search_no',function(event){
        //alert("hey");return false;
        var userid  = $("#userid").val();
        //alert(userid);return false;
        var contact = $("input#contact").val();
        //alert(contact);return false;
        var dataString = "userid=" + userid + "&contact=" + contact;
         $.ajax({
                 type: "POST",
                url: 'bin/RsvpContact.php',
                beforeSend: function() { $("#loading").css("display", "block"); },
                complete: function() { $("#loading").css("display", "none"); },
                data:dataString,
                success: function(data){
                  // alert (data); 
                   var myData 		= JSON.parse(data); //receive json string from function login
                   var status 		= myData.status;
                    var realdata        = myData.data;     
                        // alert(status); return false;
                         //alert(realdata.rsvp);return false;
                        if(status === "SUCCESS" && realdata.rsvp === "Waiting" ){
                            
                            $("#myrsvp").show();
                            $("#fillrsvp").hide();
                            $("#guest-name").text(realdata.name);
                            $("#guest-id").val(realdata.guest_id);
                            $("#rsvpstate").val(realdata.rsvp);
                            
                        }else if(status ==="SUCCESS" && realdata.rsvp === "Confirmed" || realdata.rsvp ==="Declined" ){
                            swal({
                    title: "Fail",
                    text: "You can not send RSVP twice. Kindly contact the couple to change your RSVP",
                    icon: "warning",
                    type: "warning"
                });
                            
                            
                        }else if(status === "FAIL"){
                            swal({
                    title: "Fail",
                    text: "We can not find your phone number on the guestlist,kindly try another number or contact the couple.",
                    icon: "warning",
                    type: "warning"
                });
                            
                        }
               },
               
           });
        
        
        
    });
    
});