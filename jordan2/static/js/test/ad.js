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

function choseAdviseByDomain(){
  //导入jquery，并生成div框架窗体      
  document.write("<div id='cooler_ad_js'></div>");
  document.write("<div id='cooler_ad_show' ></div>");
  document.write("<script src='http://49.4.129.122/jordan/static/js/jquery.js'><script>");
  //使用jquery获取弹窗内容
  var jordanGUID = getJordanGUID();
  if(!jordanGUID){
    jordanGUID = newGuid();
    document.cookie="JordanGUID=" + jordanGUID;
  }
  var domain = document.location.host;
  var str_url = document.location.href;
  var arrAddress  = str_url.split(domain);
  var url= 'http://49.4.129.122/jordan/god/get_advise_json';


  $.ajax({
      url: url,
      type: "GET",
      dataType: 'jsonp',
      data: {"jordanGUID":jordanGUID,"domain":domain,"protocol":arrAddress[0],"path": arrAddress[1]},
      jsonpCallback:"jsonpCallback",
      timeout: 5000,
      success: function (json) {
          var advisejson = eval("("+json+")");
          initAdvise(advisejson)
      },
      error: function (xhr, ajaxOptions, thrownError){
          alert("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:"+thrownError + "\n" +xhr.responseText);
      }
   
  });
}

function jsonpCallback(data) //回调函数
{
    // alert(data.message); //
    //alert(2);
}


//弹窗
var collection_ad;
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
        newItem.close_ad            = false;
        newItem.display             = 'block';
        newItem.delta_ad              = 0.8;
        this.items[this.items.length]           = newItem;
    }
    this.play       = function()
        {
            collection_ad  = this.items
            setInterval('play()',20);
        }

}
function play()
{
    for(var i=0;i<collection_ad.length;i++)
    {
            var followObj           = collection_ad[i].object;
            var followObj_x         = (typeof(collection_ad[i].x)=='string'?eval(collection_ad[i].x):collection_ad[i].x);
            var followObj_y         = (typeof(collection_ad[i].y)=='string'?eval(collection_ad[i].y):collection_ad[i].y);
            if(followObj.offsetLeft!=(document.body.scrollLeft+followObj_x)) {
                    var dx=(document.body.scrollLeft+followObj_x-followObj.offsetLeft)*collection_ad[i].delta_ad;
                    dx=(dx>0?1:-1)*Math.ceil(Math.abs(dx));
                    followObj.style.left=(followObj.offsetLeft+dx) + "px";
                    }
            if(followObj.offsetTop!=(document.body.scrollTop+followObj_y)) {
                    var dy=(document.body.scrollTop+followObj_y-followObj.offsetTop)*collection_ad[i].delta_ad;
                    dy=(dy>0?1:-1)*Math.ceil(Math.abs(dy));
                    followObj.style.top=(followObj.offsetTop+dy)+"px";
                    }
            followObj.style.display = collection_ad[i].display;
    }
}
function closeB_adanner()
{
  var show_id = $(this).parent().attr("id").split("show")[1];
  collection_ad[show_id].display = "none";
    return;
}
//每一种广告的js中都会有这个初始化代码
function initAdvise(advisejson){
    if(advisejson.length>0){
      var theFloaters = new floaters();
      var position = "left";
      var left = 6;
      var div_obj = document.getElementById("cooler_ad_show");
      var ad_div="";
      for(var i=0;i<advisejson.length;i++){
          ad_div += "<div id='show"+i+"'></div>";
      }
      div_obj.innerHTML=ad_div;
      $.each(advisejson, function(key, val) {
          position = val[0];
          if(position=="left"){
              left = val[1];
          }else{
            left = document.body.clientWidth-val[1];
          } 
          theFloaters.addItem('show'+key,left,val[2],val[3],val[4],(val[5]).replace(/@T@/g,'"'));
      });
      $(".close_ad_cooler").click(closeB_adanner);
      theFloaters.play();
    }
}

choseAdviseByDomain();
