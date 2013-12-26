document.write('<div id="cooler_ad_show"></div>');
var div_obj = document.getElementById("cooler_ad_show");
div_obj.innerHTML="<div id='show1'></div><div id='show2'></div>";

suspendcode="<DIV id=lovexin1 style='Z-INDEX: 10; LEFT: 6px; POSITION: absolute; TOP: 105px; width: 100; height: 300px;'><img src='http://42.121.126.86:9090/images/close.gif' onClick='javascript:window.hide()' width='100' height='14' border='0' vspace='3' alt='¹Ø±Õ¶ÔÁª¹ã¸æ'><a href='http://www.makewing.com/lanren/' target='_blank'><img src='http://42.121.126.86:9090/images/ad_100x300.jpg' width='100' height='300' border='0'></a></DIV>"
document.write(suspendcode);

suspendcode="<DIV id=lovexin2 style='Z-INDEX: 10; LEFT: 896px; POSITION: absolute; TOP: 105px; width: 100; height: 300px;'><img src='http://42.121.126.86:9090/images/close.gif' onClick='javascript:window.hide()' width='100' height='14' border='0' vspace='3' alt='¹Ø±Õ¶ÔÁª¹ã¸æ'><a href='http://www.makewing.com/lanren/' target='_blank'><img src='http://42.121.126.86:9090/images/ad_100x300.jpg' width='100' height='300' border='0'></a></DIV>"
document.write(suspendcode);


lastScrollY=0;
function heartBeat(){
diffY=document.body.scrollTop;
percent=.3*(diffY-lastScrollY);
if(percent>0)percent=Math.ceil(percent);
else percent=Math.floor(percent);
document.all.lovexin1.style.pixelTop+=percent;
document.all.lovexin2.style.pixelTop+=percent;
lastScrollY=lastScrollY+percent;
}
function hide()  
{   
lovexin1.style.visibility="hidden"; 
lovexin2.style.visibility="hidden";
}
window.setInterval("heartBeat()",1);