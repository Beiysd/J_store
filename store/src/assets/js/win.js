/*风琴效果*/
function window(){
  console.log("fire")
  var lis=document.querySelectorAll(".winLi");
  console.log('winlis'+lis.length);
  var p1=document.querySelectorAll(".p1");//同名类  记得集合问题
  var p2=document.querySelectorAll(".p2");
  var go=document.querySelectorAll(".go");
  var img=document.querySelectorAll(".img img");


  for(var j=0;j<lis.length;j++){
    lis[j].index=j;    //index问题
    lis[j].onmouseover=function(){
//                   console.log("test");

//排他思想
      for(var i=0;i<lis.length;i++){
        lis[i].style.width=200+"px";
        lis[i].style.backgroundColor="#fff";
        p1[i].classList.remove("p1p");
        p2[i].classList.remove("p2p");
        go[i].classList.remove("gg");
        img[i].classList.remove("imgg");
      }

      this.style.width=400+"px";
      this.style.backgroundColor="#3288e6";
      p1[this.index].classList.add("p1p");//添加类名
      p2[this.index].classList.add("p2p");
      go[this.index].classList.add("gg");
      img[this.index].className="imgg";//img后所加类名  不需再次添加类名

    }
  }
}
export{
  window
}
