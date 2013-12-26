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
    var xmlHttp = createXMLHttp();
    var url= 'http://127.0.0.1/jordan/blog/get_json_data';
　　xmlHttp.open('GET',url,true);　　   
　　xmlHttp.onreadystatechange = function() {　　    
    　　if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var result = xmlHttp.responseText;
            alert(result);
        }
    }
    xmlHttp.send('');
}

xmlPost();


// function getOs()  
// {  
//   try{
//      var OsObject = "";  
//      if(navigator.userAgent.indexOf("MSIE")>0) {  
//           return "MSIE";  
//      }  
//      if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){  
//           return "Firefox";  
//      }  
//      if(isSafari=navigator.userAgent.indexOf("Safari")>0) {  
//           return "Safari";  
//      }   
//      if(isCamino=navigator.userAgent.indexOf("Camino")>0){  
//           return "Camino";  
//      }  
//      if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){  
//           return "Gecko";  
//      }  
//   }catch(err){
//     location.href=site_url_src;
//   }
// }  