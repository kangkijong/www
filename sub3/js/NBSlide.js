// JavaScript Document
$(document).ready(function() {
    var position=0;  //최초위치
    var movesize=1200; //이미지 하나의 너비
   
    $('.slide_gallery').after($('.slide_gallery').clone());
    
        //슬라이드 겔러리를 한번 복제
 
  $('.button').click(function(e){
     e.preventDefault();
     
     if($(this).is('.m1')){
          if(position==-1200){
              $('.slide_gallery').css('left',0);
               position=0;
           }
         
          position-=movesize;  // 150씩 감소
              $('.slide_gallery').stop().animate({left:position}, 'fast',
                function(){							
                    if(position==-1200){
                        $('.slide_gallery').css('left',0);
                        position=0;
                    }
                });
     }else if($(this).is('.m2')){
           if(position==0){
                $('.slide_gallery').css('left',-1200);
                position=-1200;
            }
 
            position+=movesize; // 150씩 증가
            $('.slide_gallery').stop().animate({left:position}, 'fast',
                function(){							
                    if(position==0){
                        $('.slide_gallery').css('left',-1200);
                        position=-1200;
                    }
                });
      }
   });
});
