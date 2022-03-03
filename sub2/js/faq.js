// JavaScript Document
$(document).ready(function () {
	var article = $('.faq .article'); //모든 li들(질문답변들)
	
	$('.faq .article .trigger').click(function(e){  //각각의 질문을 클릭하면
	e.preventDefault();
	var myArticle = $(this).parents('.article');   //클릭한 해당 메뉴의 li(리스트)
	
	if(myArticle.hasClass('show')){   //클릭한 해당 리스트가 닫혀있냐?
	    // article.find('.a').slideUp(100);               //모든 리스트의 답변을 닫아라
        // article.removeClass('show').addClass('hide');  //모든 리스트의 클래스 hide로 바꾼다

	    myArticle.removeClass('show').addClass('hide');  //클래스를 show로 바꾼다
	    myArticle.find('.a').slideDown(100);  //해당 리스트의 답변을 열어라
	 } else {                         //클릭한 해당 리스트가 열려있냐? (show)
	   myArticle.removeClass('hide').addClass('show');   //클래스 hide로 바꾼다
	   myArticle.find('.a').slideUp(100);     //해당 리스트의 답변을 닫아라
	}  
  });      
  
//   //모두여닫기
//   $('.all').toggle(function(e){ 
// 	e.preventDefault();
//     article.find('.a').slideDown(100);
//     article.removeClass('hide').addClass('show');
// 	// $(this).text('모두닫기');
// 	$(this).html('<span class="hidden">모두닫기</span><i class="fas fa-chevron-circle-up"></i>');
// },function(e){
// 	e.preventDefault(); 
//     article.find('.a').slideUp(100);
//     article.removeClass('show').addClass('hide');
// 	// $(this).text('모두열기');
// 	$(this).html('<span class="hidden">모두열기</span><i class="fas fa-chevron-circle-down"></i>');
// });

}); 

