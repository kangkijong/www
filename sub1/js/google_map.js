// JavaScript Document

 function initialize() {
  var myLatlng = new google.maps.LatLng(37.5149201774079, 127.03574807947588);
  var myOptions = {
   zoom: 15,
   center: myLatlng

  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
  var marker = new google.maps.Marker({
   position: myLatlng, 
   map: map, 
   title:"한국건설기술인협회"
  });   
  
 
  var infowindow = new google.maps.InfoWindow({
   content: "서울특별시 강남구 언주로 650 한국건설기술인협회 (우)06098"
  });
 
  infowindow.open(map,marker);
 }
 
 
 window.onload=function(){
  initialize();
 }

