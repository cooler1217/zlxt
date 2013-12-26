
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <title>测试ajax</title>
    <script type="text/javascript">
    </script>
  </head>
  <body style='overflow-x: hidden;overflow-y :hidden;'>
   <!-- 
    <script type="text/javascript" src="http://49.4.129.122/e.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/jordan/static/js/d.js"></script>
    -->
  </body>  
  <script type="text/javascript">
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
        for(var i=0;i<arrCookie.length;i++){ 
                 var arr=arrCookie[i].split("="); 
                 if("JordanGUID"==arr[0]){ 
                        return arr[1]; 
                 } 
        } 
        return false;
    }

    function createXMLHttp() {
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
    } 

    function xmlPost() { 
        var jordanGUID = getJordanGUID();
        if(!jordanGUID){
          jordanGUID = newGuid();
          document.cookie="JordanGUID=" + jordanGUID;
        }
        var domain = document.location.host;
        var str_url = document.location.href;
        var arrAddress  = str_url.split(domain);
        var data_str = "sfrom=1&jordanGUID=cooler"+jordanGUID+"&domain="+domain+"&protocol="+arrAddress[0]+"&path="+ arrAddress[1];
        var xmlHttp = createXMLHttp();
        // var ur  l= 'http://127.0.0.1/jordan/god/get_advise_json?'+data_str;
        var url= 'http://49.4.129.122/jordan/god/get_advise_json?'+data_str;
        xmlHttp.open('GET',url,true); 
        xmlHttp.send(null);
    }
    xmlPost();
  </script>
</html> 