<!DOCTYPE html>
<html>
<head>
  <title>return data</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
</head>

<body>

<div id='site_url' style='display:none;'>http://www.sohu.com/</div>
<!-- 
-->
<div id='cooler_ad_show'>1234</div>
<script type="text/javascript">
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
    var url= 'http://127.0.0.1/jordan/blog/get_json_data?sfrom=6&jordanJUID=1234';
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
</script>
</body>
</html>