/*------ dandupeizhiguangao */
var delta=0.8;
var collection;
var closeADB=false;
var div_obj = document.getElementById("cooler_ad_show");
div_obj.innerHTML="<div id='show1'></div><div id='show2'></div><div id='show3'></div>";

function floaters() {
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

}

function play()
{
    if(screen.width<=80 || closeADB)
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
}
function closeADBanner()
{
        closeADB=true;
        return;
}

function initAdvise(){
    var theFloaters = new floaters();
     theFloaters.addItem('show1',6,180,
       '<embed '+
         'id="_COUPLET"'+
         'name="_COUPLET" '+
         'src="http://120.72.37.43/source/1387554459_duilian.swf" '+
         'quality="autohigh" '+
         'allowscriptaccess="always"'+
         'width="120" '+
         'height="270" '+
         'wmode="opaque" '+
         'type="application/x-shockwave-flash" '+
         'pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" '+
         'swliveconnect="true">'+
         '<img width="120" src=http://120.72.37.43/source/close2.gif onClick="closeADBanner();">');
      theFloaters.addItem('show2','document.body.clientWidth-190',10,
         '<embed '+
         'id="_COUPLET"'+
         'name="_COUPLET" '+
         'src="http://120.72.37.43/source/1387556700_qingtianzhu.swf" '+
         'quality="autohigh" '+
         'allowscriptaccess="always"'+
         'width="160" '+
         'height="600" '+
         'wmode="opaque" '+
         'type="application/x-shockwave-flash" '+
         'pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" '+
         'swliveconnect="true">'+
         '<img width="160" height="20" src=http://120.72.37.43/source/close2.gif onClick="closeADBanner();">'+
         '');
     theFloaters.addItem('show3','document.body.clientWidth-300','document.body.clientHeight-300',
         '<img  src=http://120.72.37.43/source/close.gif onClick="closeADBanner();">'+
       '<embed '+
         'id="_COUPLET"'+
         'name="_COUPLET" '+
         'src="http://120.72.37.43/source/1387554468_youxiajiao.swf" '+
         'quality="autohigh" '+
         'allowscriptaccess="always"'+
         'width="300" '+
         'height="250" '+
         'wmode="opaque" '+
         'type="application/x-shockwave-flash" '+
         'pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" '+
         'swliveconnect="true">'+
         '');
    theFloaters.play();
}

initAdvise();
