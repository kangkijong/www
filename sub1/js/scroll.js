$(document).ready(function () {
        
    $('.sub_bar li:eq(0)').find('a').addClass('spy');
    //첫번째 서브메뉴 활성화
    
    $('#content div:eq(0)').addClass('boxMove');;
    //첫번째 내용글 애니메이션 처리
    var smh= $('.visual').height();  //메인 비주얼의 높이
    var h1= $('#content div:eq(1)').offset().top-600 ;
    var h2= $('#content div:eq(4)').offset().top-600 ;

     //스크롤의 좌표가 변하면.. 스크롤 이벤트
    $(window).on('scroll',function(){
        var scroll = $(window).scrollTop();
        //스크롤top의 좌표를 담는다
       
        $('.text').text(scroll);
        //스크롤 좌표의 값을 찍는다.
        
        //sticky menu 처리
        if(scroll>smh){ 
            $('.sub_bar').addClass('navOn');
            //스크롤의 거리가 visual 높이 이상이면 서브메뉴 고정
            $('header').hide();
        }else{
            $('.sub_bar').removeClass('navOn');
            //스크롤의 거리가 visual 높이보다 작으면 서브메뉴 원래 상태로
            $('header').show();
        }
        
        
        $('.sub_bar li').find('a').removeClass('spy');
        //모든 서브메뉴 비활성화~ 불꺼!!!
         
         //스크롤의 거리의 범위를 처리
        if(scroll>=0 && scroll<h1){
            $('.sub_bar li:eq(0)').find('a').addClass('spy');
            //첫번째 서브메뉴 활성화
        }else if(scroll>=h1 && scroll<h2){
            $('.sub_bar li:eq(1)').find('a').addClass('spy');
            //두번째 서브메뉴 활성화
        }
    });


});