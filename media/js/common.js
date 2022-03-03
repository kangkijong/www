$(document).ready(function() {
  
   $('.topMove').click(function(e){
     e.preventDefault();
     $("html,body").stop().animate({"scrollTop":0},1000);
 });
          
     
});