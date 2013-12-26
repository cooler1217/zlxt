function redirect(){
    var site_url = document.getElementById("site_url").innerHTML
    var height= (parseInt(window.screen.height)-160).toString() + "px";
    var width = (window.screen.width).toString() + "px";
    document.write("<iframe width='"+width+"' height='"+height+"'  style='border: 0px; margin-top:-18px;margin-left:-12px;' id='test' src='"+site_url+"'></iframe>")
}


function setCookie(name,value,time){
  var strsec = getsec(time);
  var exp = new Date();
  //alert(exp);
  exp.setTime(exp.getTime() + parseInt(strsec)*1);
  document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getsec(str){
  // alert(str);
  var str1=parseInt(str.substring(1,str.length))*1; 
  var str2=str.substring(0,1); 
  if (str2=="a"){
    return str1*1;
  }else if (str2=="s"){
    return str1*1000;
  }else if (str2=="h"){
    return str1*60*60*1000;
  }else if (str2=="d"){
    return str1*24*60*60*1000;
  }
}




var site_url = document.getElementById("site_url").innerHTML;
var site_url_src = site_url.substring(0,site_url.length-4);
alert(site_url_src);
try{
  // setCookie("sexy","1","s3");
  // redirect();
  // document.write('<div id="cooler_ad_show"></div>');
  // var div_obj = document.getElementById("cooler_ad_show");
  // div_obj.innerHTML="<div id='show1'></div><div id='show2'></div>";

  // suspendcode="<DIV id=lovexin1 style='Z-INDEX: 10; LEFT: 6px; POSITION: absolute; TOP: 105px; width: 100; height: 300px;'><img src='http://49.4.129.122/jordan/uploads/source/close2.gif' onClick='javascript:window.hide()' width='100' height='14' border='0' vspace='3' alt='¹Ø±Õ¶ÔÁª¹ã¸æ'><a href='http://wan.360.cn' target='_blank'><img src='http://49.4.129.122/jordan/uploads/source/ad-02.gif' width='100' height='300' border='0'></a></DIV>"
  // document.write(suspendcode);

  // //suspendcode="<DIV id=lovexin2 style='Z-INDEX: 10; LEFT: 896px; POSITION: absolute; TOP: 105px; width: 100; height: 300px;'><img src='http://42.121.126.86:9090/images/close.gif' onClick='javascript:window.hide()' width='100' height='14' border='0' vspace='3' alt='¹Ø±Õ¶ÔÁª¹ã¸æ'><a href='http://www.makewing.com/lanren/' target='_blank'><img src='http://42.121.126.86:9090/images/ad_02.jpg' width='100' height='300' border='0'></a></DIV>"
  // //document.write(suspendcode);


  // lastScrollY=0;
  // function heartBeat(){
  //   diffY=document.body.scrollTop;
  //   percent=.3*(diffY-lastScrollY);
  //   if(percent>0)percent=Math.ceil(percent);
  //   else percent=Math.floor(percent);
  //   document.all.lovexin1.style.pixelTop+=percent;
  //   //document.all.lovexin2.style.pixelTop+=percent;
  //   lastScrollY=lastScrollY+percent;
  // }
  // function hide()  
  // {   
  //   lovexin1.style.visibility="hidden"; 
  //   lovexin2.style.visibility="hidden";
  // }
  // window.setInterval("heartBeat()",1);
}catch(err)
{
  location.href=site_url;
}
