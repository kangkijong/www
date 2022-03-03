// top move
$('.topMove').hide();
           
$(window).on('scroll',function(){ //스크롤 값의 변화가 생기면
     var scroll = $(window).scrollTop(); //스크롤의 거리
             
     // $('.text').text(scroll);

      if(scroll>500){ //500이상의 거리가 발생되면
        $('.topMove').fadeIn('slow');  //top보여라~~~~
     }else{
        $('.topMove').fadeOut('fast');//top안보여라~~~~
     }
});

 
// $('.topMove').click(function(e){
//   e.preventDefault();
//   $("html,body").stop().animate({"scrollTop":0},1000);
// });