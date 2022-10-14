$(document).ready(function(){
    
  var wedding_date = $("input#bio-wedding-date").val();
  //alert(wedding_date);
 
 //var date = "Jan 5, 2022";
    
var finalEventDt = new Date(wedding_date).getTime();

var x = setInterval(function() {

  var now = new Date().getTime();
    
  var delay_total = finalEventDt - now;
    
  var days = Math.floor(delay_total / (1000 * 60 * 60 * 24));
  var hours = Math.floor((delay_total % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((delay_total % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((delay_total % (1000 * 60)) / 1000);
    
   // alert(days + hours + minutes); return false;
  document.getElementById("mydays").innerHTML      = "<span>" + days + "</span><div>Days</div>";
   document.getElementById("myhours").innerHTML    = "<span>" + hours + "</span><div>Hours</div>" ;       
    document.getElementById("myminutes").innerHTML = "<span>" + minutes + "</span><div>Minutes</div>" ;        
    document.getElementById("myseconds").innerHTML = "<span>" + seconds + "</span><div>Seconds</div>" ;       
    
},1000);


//================ Time conversioan to AM and PM =================================>





});  