
// 生成唯一id
function newGuid()
{
    var guid = "";
    for (var i = 1; i <= 32; i++){
      var n = Math.floor(Math.random()*16.0).toString(16);
      guid +=   n;
      if((i==8)||(i==12)||(i==16)||(i==20))
        guid += "-";
    }
    return guid;    
}
function getJordanGUID(){
  var strCookie = document.cookie;
  var arrCookie=strCookie.split("; "); 
  //遍历cookie数组，处理每个cookie对 
  for(var i=0;i<arrCookie.length;i++){ 
           var arr=arrCookie[i].split("="); 
           //找到名称为userId的cookie，并返回它的值 
           if("JordanGUID"==arr[0]){ 
                  return arr[1]; 
           } 
  } 
  return false;
}


function createXMLHttp() {    
    var XmlHttp;
    if (window.ActiveXObject){
            var arr=["MSXML2.XMLHttp.6.0","MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0","MSXML2.XMLHttp","Microsoft.XMLHttp"];
        for(var i=0;i<arr.length;i++) {
            try {
                XmlHttp = new ActiveXObject(arr[i]);
                return XmlHttp;
            }
            catch(error) { }
        }
    } else {
        try {
            XmlHttp=new XMLHttpRequest();
            return XmlHttp;
        }
        catch(otherError) { }
    } 
} 

function xmlPost() {   
    var jordanGUID = getJordanGUID();
    if(!jordanGUID){
      jordanGUID = newGuid();
      document.cookie="JordanGUID=" + jordanGUID;
    }
    var xmlHttp = createXMLHttp();
    var domain = document.location.host;
    var str_url = document.location.href;
    var arrAddress  = str_url.split(domain);
    var url= 'http://127.0.0.1/jordan/god/get_advise?jordanGUID='+jordanGUID+'&domain='+domain+'&protocol='+arrAddress[0] +"&path="+ arrAddress[1];
    xmlHttp.open('GET',url,true);　　   
　　xmlHttp.onreadystatechange = function() {　　    
    　　if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var result = xmlHttp.responseText;
            if(result != "false"){
              initAdvise(result);
              //var div_obj = document.getElementById("cooler_ad_show");
              //div_obj.innerHTML="<div id='show1'></div><div id='show2'></div>";
            }
        }
    }
    xmlHttp.send('');
}
//document.write("<div id='cooler_ad_js'></div>");
document.write("<div id='cooler_ad_show' ></div>");
xmlPost()



var delta_ad=0.8;
var collection_ad;
var closeB_ad=false;

//document.write('<div id="cooler_ad_show"></div>');

// var div_obj = document.getElementById("cooler_ad_show");
// div_obj.innerHTML="<div id='show1'></div><div id='show2'></div>";
function floaters() {
    this.items      = [];
    this.addItem    = function(id,x,y,w,h,content)
    {
        var div_obj = document.getElementById(id);
        div_obj.style.cssText="Z-INDEX: 9999; POSITION: absolute; width:"+w+"px; height:"+h+"px;left:"+x+"px;top:"+y+"px";
        div_obj.innerHTML=content;
        var newItem                             = {};
        newItem.object                          = document.getElementById(id);
        newItem.x                               = x;
        newItem.y                               = y;
        this.items[this.items.length]           = newItem;
    }
    this.play       = function()
        {
            collection_ad  = this.items
            setInterval('play()',30);
        }

}
function play()
{
    if(screen.width<=80 || closeB_ad)
    {
            for(var i=0;i<collection_ad.length;i++)
            {
                    collection_ad[i].object.style.display      = 'none';
            }
            return;
    }
    for(var i=0;i<collection_ad.length;i++)
    {
            var followObj           = collection_ad[i].object;
            var followObj_x         = (typeof(collection_ad[i].x)=='string'?eval(collection_ad[i].x):collection_ad[i].x);
            var followObj_y         = (typeof(collection_ad[i].y)=='string'?eval(collection_ad[i].y):collection_ad[i].y);
            if(followObj.offsetLeft!=(document.body.scrollLeft+followObj_x)) {
                    var dx=(document.body.scrollLeft+followObj_x-followObj.offsetLeft)*delta_ad;
                    dx=(dx>0?1:-1)*Math.ceil(Math.abs(dx));
                    followObj.style.left=(followObj.offsetLeft+dx) + "px";
                    }
            if(followObj.offsetTop!=(document.body.scrollTop+followObj_y)) {
                    var dy=(document.body.scrollTop+followObj_y-followObj.offsetTop)*delta_ad;
                    dy=(dy>0?1:-1)*Math.ceil(Math.abs(dy));
                    followObj.style.top=(followObj.offsetTop+dy)+"px";
                    }
            followObj.style.display = '';
    }
}
function closeB_adanner()
{
        closeB_ad=true;
        return;
}
//每一种广告的js中都会有这个初始化代码
function initAdvise(result){
    var theFloaters = new floaters();
    var adviseArr = result.split("@$@");
    var position = "left";
    var left = 6;
    var top =80;
    var width=80;
    var height=60;
    var div_obj = document.getElementById("cooler_ad_show");
    var ad_div="";
    for(var i=0;i<adviseArr.length-1;i++){
        ad_div += "<div id='show"+i+"'></div>";
    }
    div_obj.innerHTML=ad_div;
    for(var i=0;i<adviseArr.length-1;i++){
      var adviseItem = adviseArr[i].split("@!@");
      position = adviseItem[0];
      if(position=="left"){
          left = adviseItem[1];
      }else{
          left = document.body.clientWidth-adviseItem[1];
      } 
      top = adviseItem[2];
      width = adviseItem[3];
      height = adviseItem[4];
      content = adviseItem[5];
      theFloaters.addItem('show'+i,left,top,width,height,content);
    }
    //theFloaters.addItem('show1',6,180,'<a href="http://www.fds321.com"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100" height="50" style="cursor:hand"><param name="movie" value="http://42.121.126.86:9090/images/ad-02.swf"><param name="wmode" value="Opaque"> <param name="quality" value="high"><embed src="http://42.121.126.86:9090/images/ad-02.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="97" height="233"></embed></object></a><img src=http://42.121.126.86:9090/images/close.gif onClick="closeB_adanner();">');
      //'<a href="http://www.fds321.com"><img src="http://42.121.126.86:9090/images/ad-02.gif"/><br><br></a><img src="http://42.121.126.86:9090/images/close.gif" onClick="closeB_adanner();">',
    theFloaters.play();

}


