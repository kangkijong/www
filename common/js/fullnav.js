
$(document).ready(function() {
  
    //2depth 열기/닫기
    $('ul.gnb_menu').hover(
       function() { 
          $('ul.gnb_menu li.menu ul').fadeIn('normal',function(){$(this).stop();}); //모든 서브를 다 열어라
          $('#headerArea').animate({height:400},'fast').clearQueue();
       },function() {
          $('ul.gnb_menu li.menu ul').fadeOut('fast'); //모든 서브를 다 닫아라
          $('#headerArea').animate({height:220},'normal').clearQueue();
     });
     
     //1depth 효과
     $('ul.gnb_menu li.menu').hover(
       function() { 
           $('.depth1',this).css('color','#001d6f');
       },function() {
          $('.depth1',this).css('color','#333');
     });

     //tab 처리
    $('ul.gnb_menu li.menu .depth1').on('focus', function () {        
        $('ul.gnb_menu li.menu ul').slideDown('normal');
        $('#headerArea').animate({height:400},'fast').clearQueue();
     });

    $('ul.gnb_menu li.m6 li:last').find('a').on('blur', function () {        
        $('ul.gnb_menu li.menu ul').slideUp('fast');
        $('#headerArea').animate({height:220},'normal').clearQueue();
    });


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

     
    $('.topMove').click(function(e){
      e.preventDefault();
      $("html,body").stop().animate({"scrollTop":0},1000);
  });
           
      
});
