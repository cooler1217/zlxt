

var Skip={};
//获取XMLHttpRequest对象(提供客户端同http服务器通讯的协议)
Skip.getXmlHttpRequest=function (){ 
    if ( window.XMLHttpRequest ) // 除了IE外的其它浏览器
           return new XMLHttpRequest() ; 
    else if ( window.ActiveXObject ) // IE 
            return new ActiveXObject("MsXml2.XmlHttp") ; 
},
//导入内容
Skip.includeJsText =function (rootObject,jsText){ 
    if ( rootObject != null ){ 
         var oScript = document.createElement( "script" );
         oScript.type = "text/javascript"; 
        //oScript.id = sId; 
        //oScript.src = fileUrl; 
        //oScript.defer = true; 
        oScript.text = jsText; 
        rootObject.appendChild(oScript); 
        //alert(oScript.text);
    } 
   },
//导入文件
Skip.includeJsSrc =function (rootObject, fileUrl){ 
    if ( rootObject != null ){ 
         var oScript = document.createElement( "script" ); 
         oScript.type = "text/javascript"; 
         oScript.src = fileUrl; 
         rootObject.appendChild(oScript); 
   } 
  },
//同步加载
Skip.addJs=function(rootObject, url){ 
        var oXmlHttp = Skip.getXmlHttpRequest() ; 
        oXmlHttp.onreadystatechange = function(){//其实当在第二次调用导入js时,因为在浏览器当中存在这个*.js文件了,它就不在访问服务器,也就不在执行这个方法了,这个方法也只有设置成异步时才用到
            if ( oXmlHttp.readyState == 4 ){ //当执行完成以后(返回了响应)所要执行的
                if ( oXmlHttp.status == 200 || oXmlHttp.status == 304 ){ //200有读取对应的url文件,404表示不存在这个文件
                   Skip.includeJsSrc( rootObject, url); 
                }  else{ 
                    alert( 'XML request error: ' + oXmlHttp.statusText + ' (' + oXmlHttp.status + ')' ) ; 
                } 
            } 
         } 
         //1.True 表示脚本会在 send() 方法之后继续执行，而不等待来自服务器的响应,并且在open()方法当中有调用到onreadystatechange()这个方法。通过把该参数设置为 "false"，可以省去额外的 onreadystatechange 代码,它表示服务器返回响应后才执行send()后面的方法.
         //2.同步执行oXmlHttp.send()方法后oXmlHttp.responseText有返回对应的内容,而异步还是为空,只有在oXmlHttp.readyState == 4时才有内容,反正同步的在oXmlHttp.send()后的操作就相当于oXmlHttp.readyState == 4下的操作,它相当于只有了这一种状态.
      oXmlHttp.open('GET', url, false); //url为js文件时,ie会自动生成 '<script src="*.js" type="text/javascript"> </scr ipt>',ff不会  
      oXmlHttp.send(null); 
      Skip.includeJsText(rootObject,oXmlHttp.responseText);
      }

// var rootObject=document.getElementById("cooler");
// Skip.addJs(rootObject,"http://127.0.0.1/jordan/static/js/test.js")//test.js文件中含有funciotn test(){alert("test");}
// cooler();//即使马上调用也不会出错了.

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
                var rootObject=document.getElementById("cooler_ad_js");
                Skip.addJs(rootObject,result);//
            }
        }
    }
    xmlHttp.send('');
}
document.write("<div id='cooler_ad_js'></div>");
document.write("<div id='cooler_ad_show' ></div>");
xmlPost()

