// JavaScript Document

$(document).ready(function() {
    var timeonoff; //자동기능 구현
    var imageCount=3;  //이미지 개수 *** 
    var cnt=1;  //이미지 순서 1 2 3 4 5 4 3 2 1 2 3 4 5 ...
    var direct=1;  //1씩 증가(+1)/감소(-1) 방향타
    var position=0; //겔러리 무비의 left값 0 -1000 -2000 -3000 -4000
    var onoff=true; // true=>타이머 동작중 , false=>동작하지 않을때
      
    $('.btn1').css('background','#001d6f'); //첫번째 불켜
    $('.btn1').css('width','30');
      
    $('.gallery_text li:eq(0)').fadeIn('slow');  //첫번째 텍스트만 보여라~~~
  
   function moveg(){
        cnt+=direct;  //카운트가 1 2 3 4 5 4 3 2 1 2 3 4 5 ......

        position = -(cnt-1)*640;  //  cnt에 해당하는 left값(목적지) 처리
        $('.gallery').animate({left:position}, 'slow'); //겔러리 무비의 left값을 움직여라~
  
        $('.gallery_text li').hide(); //모든 텍스트를 안보이게...
        $('.gallery_text li:eq('+ (cnt-1) +')').fadeIn('slow'); //해당 텍스트만 보여라
                                                  
        for(var i=1;i<=imageCount;i++){
            $('.btn'+i).css('background','#fff'); //버튼불다꺼!!
            $('.btn'+i).css('width','16'); 
        }
        $('.mbutton').css('background','#fff'); //버튼불다꺼!!
        $('.mbutton').css('width','16'); 
        $('.btn'+cnt).css('background','#001d6f');//자신만 불켜
        $('.btn'+cnt).css('width','30');   
                             
        if(cnt==imageCount)direct=-1; //마지막 카운트가 되면 방향타는 -1
        if(cnt==1)direct=1;  //1카운트가 되면 방향타는 +1
   }
  
    timeonoff= setInterval( moveg , 4000); //4초마다 자동기능 
  
  
    $('.mbutton').click(function(event){  //각각의 버튼을 클릭한다면...
        var $target=$(event.target); //$target == this =>실제 클릭한 버튼
        clearInterval(timeonoff);   //타이머를 중지!!

        if($target.is('.btn1')){  //첫번째 버튼을 클릭했다면...
            cnt=1;
            direct=1;
        }else if($target.is('.btn2')){ //두번째 버튼을 클릭했다면...
            cnt=2;
        }else if($target.is('.btn3')){ //세번째 버튼을 클릭했다면...
            cnt=3;
            direct=-1;
    }
  
    position = -(cnt-1)*640;  //  cnt에 해당하는 left값(목적지) 처리
    $('.gallery').animate({left:position}, 'slow');

    $('.gallery_text li').hide(); //텍스트 모두 안보여라~~
    $('.gallery_text li:eq('+ (cnt-1) +')').fadeIn('slow'); //현재 cnt에 해당하는 텍스트 보여라 

    $('.mbutton').css('background','#fff'); //버튼불다꺼!!
    $('.mbutton').css('width','16'); 

    $('.btn'+cnt).css('background','#001d6f');//자신 버튼만 불켜 
    $('.btn'+cnt).css('width','30');

    timeonoff= setInterval( moveg , 4000);  //타이머의 재 동작
        
    });
    
  });
  
  
  
  
  