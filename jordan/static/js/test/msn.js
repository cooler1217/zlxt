var delta=0.8;
var collection;
var closeB=false;

//document.write('<div id="cooler_ad_show"></div>');

var div_obj = document.getElementById("cooler_ad_show");
div_obj.innerHTML="<div id='show1'></div><div id='show2'></div>";
function floaters() {
    this.items      = [];
    this.addItem    = function(id,x,y,content)
    {
        alert(x);
        //document.write('<DIV id='+id+' style="Z-INDEX: 10; POSITION: absolute;  width:80px; height:60px;left:'+(typeof(x)=='string'?eval(x):x)+'px;top:'+(typeof(y)=='string'?eval(y):y)+'">'+content+'</DIV>');
        var div_obj = document.getElementById(id);
        div_obj.style.cssText="Z-INDEX: 10; POSITION: absolute; background-color:red;  width:80px; height:60px;left:'+(typeof(x)=='string'?eval(x):x)+'px;top:'+(typeof(y)=='string'?eval(y):y)+'";
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

}
function play()
{
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
                    followObj.style.left=followObj.offsetLeft+dx;
                    }

            if(followObj.offsetTop!=(document.body.scrollTop+followObj_y)) {
                    var dy=(document.body.scrollTop+followObj_y-followObj.offsetTop)*delta;
                    dy=(dy>0?1:-1)*Math.ceil(Math.abs(dy));
                    followObj.style.top=followObj.offsetTop+dy;
                    }
            followObj.style.display = '';
    }
}
function closeBanner()
{
        closeB=true;
        return;
}
//每一种广告的js中都会有这个初始化代码
function initAdvise(){
    var theFloaters = new floaters();
    theFloaters.addItem('show1',6,180,'<a href="http://www.fds321.com"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100" height="50" style="cursor:hand"><param name="movie" value="http://42.121.126.86:9090/images/ad-02.swf"><param name="wmode" value="Opaque"> <param name="quality" value="high"><embed src="http://42.121.126.86:9090/images/ad-02.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="97" height="233"></embed></object></a><img src=http://42.121.126.86:9090/images/close.gif onClick="closeBanner();">');
    theFloaters.addItem('show2','document.body.clientWidth-106',180,'<a href="http://www.fds321.com"><img src="http://42.121.126.86:9090/images/ad-02.gif"/><br><br></a><img src=http://42.121.126.86:9090/images/close.gif onClick="closeBanner();">');
    theFloaters.play();

}

initAdvise();