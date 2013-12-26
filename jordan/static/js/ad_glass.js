function getPageSize() 
  { 
    var body = document.documentElement;
    var bodyOffsetWidth = 0; 
    var bodyOffsetHeight = 0; 
    var bodyScrollWidth = 0; 
    var bodyScrollHeight = 0; 
    var pageDimensions = [0,0]; 
    pageDimensions[0]=body.clientHeight; 
    pageDimensions[1]=body.clientWidth; 
    bodyOffsetWidth=body.offsetWidth; 
    bodyOffsetHeight=body.offsetHeight; 
    bodyScrollWidth=body.scrollWidth; 
    bodyScrollHeight=body.scrollHeight; 
    if(bodyOffsetHeight > pageDimensions[0]) 
    { 
      pageDimensions[0]=bodyOffsetHeight; 
    } 
    if(bodyOffsetWidth > pageDimensions[1]) 
    { 
      pageDimensions[1]=bodyOffsetWidth; 
    } 
    if(bodyScrollHeight > pageDimensions[0]) 
    { 
      pageDimensions[0]=bodyScrollHeight; 
    } 
    if(bodyScrollWidth > pageDimensions[1]) 
    { 
      pageDimensions[1]=bodyScrollWidth; 
    } 
    return pageDimensions; 
  } 


  function DisablePage() 
  { 
    document.write('<div id="cooler_divSandglass" style="position:absolute;Z-INDEX: 9999; left:0; top:0; height:0; width:0; display:none; text-align:center;background:rgba(0,0,0,0.7); filter: progid:DXImageTransform.Microsoft.gradient(startcolorstr=#7F000000,endcolorstr=#7F000000); "></div>')
    var timeHdl; 
    var ctrlSandglass = document.getElementById("cooler_divSandglass"); 
    var glass_html =  ' <div style="margin-top:100px;">'+
                      '   <a href="http://www.fds321.com"><img src="http://127.0.0.1/jordan/static/images/jd.png"/></a>'+
                      ' </div>';
    ctrlSandglass.innerHTML=glass_html;
    //document.body.style.cursor = 'wait'; 
    var pageDimensions = getPageSize(); 
    ctrlSandglass.style.top = 0+"px"; 
    ctrlSandglass.style.left = 0+"px"; 
    ctrlSandglass.style.height = pageDimensions[0]+"px"; 
    ctrlSandglass.style.width = pageDimensions[1]+"px"; 
    ctrlSandglass.style.display = "block"; 
    timeHdl = window.setTimeout(function(){ClearDisablePage(timeHdl)},50000); 
  } 
  function ClearDisablePage(timeHdl){
      var ctrlSandglass = document.getElementById("cooler_divSandglass"); 
      window.clearTimeout(timeHdl); 
      ctrlSandglass.style.display = "none"; 
      //document.body.style.cursor = 'auto'; 
  }
  DisablePage() ;