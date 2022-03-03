window.onload = function () {
    var btn = document.getElementsByClassName('btn');
    var note = document.getElementByClassName('note');
    var oc = document.getElementByClassName('oc');

    var count = false; //false(닫힌상태) / true(열린상태)

    function updown() {
      if(count==false) {      //홀수면 연다
            note.style.display = 'block';
            oc.innerHTML = '△';
            count=true;
        }else{ //count==true    //짝수면 닫는다
            note.style.display = 'none';
            oc.innerHTML = '▽';
            count=false;
        }  
      }
    btn.onclick = updown;        
  };