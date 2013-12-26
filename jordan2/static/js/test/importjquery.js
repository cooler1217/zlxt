document.write("<script src='http://49.4.129.122/jordan/static/js/jquery.js'></script>");
//$.getJSON("http://49.4.129.122/jordan/god/kuayu_test?name=cooler&callback=?",{"name":"cooler"},function(data){
//  alert(data);
// 	$.each(data, function(key, val) {
// 	    alert(key);
// 	    alert(val);
// 	  });
//});

// $.ajax({
//       type : "get",
//       async : false,
//       url : "http://49.4.129.122/jordan/god/kuayu_test?name=cooler", //实际上访问时产生的地址为: ajax.ashx?callbackfun=jsonpCallback&id=10
//       data : {"name" : 10},
//       cache : false, //默认值true
//       dataType : "jsonp",
//       jsonp: "callbackfun",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
//       jsonpCallback:"jsonpCallback",
//           //自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名
//           //如果这里自定了jsonp的回调函数，则success函数则不起作用;否则success将起作用
//       success : function(json){
//         alert(1);
//           alert(json.message);
//       },
//       error:function(){
//           alert("erroe");
//       }
//   });

  function jsonpCallback(data) //回调函数
{
    // alert(data.message); //
    // alert(2);
}

$.ajax({
    url: "http://127.0.0.1/jordan/god/kuayu_test?name=cooler",//跨域的dns/index!searchJSONResult.action,
    type: "GET",
    dataType: 'jsonp',
    data: {"name":"cccc"},
    jsonpCallback:"jsonpCallback",
    timeout: 5000,
    success: function (json) {//客户端jquery预先定义好的callback函数,成功获取跨域服务器上的json数据后,会动态执行这个callback函数
        json = eval("("+json+")");
        $.each(json,function(key,val){
          alert(key+"====="+val)
        })
    },
    error: function (xhr, ajaxOptions, thrownError){
          alert("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:"+thrownError + "\n" +xhr.responseText);
    }
 
});

 // $.getJSON("http://127.0.0.1/jordan/god/kuayu_test?name=cooler&callback=?",
 //        function(data){//注意data 里边不能有换行符
 //            data = eval("("+data+")");//eval 是js内置函数,注意格式
 //            $.each(data,function(i){
 //                alert(data[i]);
 //            })            
 //        });

