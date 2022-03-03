$(document).ready(function () {
        
    $('#content div:eq(0)').addClass('boxMove');
    //첫번째 내용글 애니메이션 처리
    var smh= $('#content .visual').height();  //메인 비주얼의 높이
    var h1= $('#content .information').offset().top-600 ;
    var h2= $('#content .quick_menu').offset().top-600 ;
    var h3= $('#content .society').offset().top-600 ;
    var h4= $('#content .news').offset().top-600 ;
    var h4= $('#content .community').offset().top-600 ;

     //스크롤의 좌표가 변하면.. 스크롤 이벤트
    $(window).on('scroll',function(){
        var scroll = $(window).scrollTop();
        //스크롤top의 좌표를 담는다
       
        $('.text').text(scroll);
        //스크롤 좌표의 값을 찍는다.

        //스크롤의 거리의 범위를 처리
        if(scroll>=0 && scroll<h1){
            //첫번째 내용 콘텐츠 애니메이션
            $('.information').addClass('boxMove');
        }else if(scroll>=h1 && scroll<h2){
            //두번째 서브메뉴 활성화
            $('.quick_menu').addClass('boxMove');
        }else if(scroll>=h2 && scroll<h3){
            //세번째 서브메뉴 활성화
            $('.society').addClass('boxMove');
        }else if(scroll>=h3 && scroll<h4){
            //네번째 서브메뉴 활성화
            $('.news').addClass('boxMove');
        }else if(scroll>=h4 && scroll<h5){
            //네번째 서브메뉴 활성화
            $('.community').addClass('boxMove');
        }

    });


});