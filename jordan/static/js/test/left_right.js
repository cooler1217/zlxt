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
    var url= 'a.php';
　　xmlHttp.open('GET',url,true);　　   
　　xmlHttp.onreadystatechange = function() {　　    
    　　if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var result = xmlHttp.responseText;
            var theFloaters = new floaters();
            var results = result.split('@$@');
            if (results && results.length == 2){
                theFloaters.addItem('followDiv2','document.body.clientWidth-106',80,results[1]);
                theFloaters.addItem('followDiv1',6,80,results[0]);
                theFloaters.play();
                
            }
        }
    }
    xmlHttp.send('');
}

var delta=0.8;
var collection;
var closeB=false;
function floaters() {
        this.items      = [];
        this.addItem    = function(id,x,y,content)
                          {
                                document.write('<DIV id='+id+' style="Z-INDEX: 10; POSITION: absolute;  width:80px; height:60px;left:'+(typeof(x)=='string'?eval(x):x)+'px;top:'+(typeof(y)=='string'?eval(y):y)+'">'+content+'</DIV>');

                                var newItem                             = {};
                                newItem.object                  = document.getElementById(id);
                                newItem.x                               = x;
                                newItem.y                               = y;

                                this.items[this.items.length]           = newItem;
                          }
        this.play       = function()
                          {
                                collection                              = this.items
                                setInterval('play()',30);
                          }
        }
        function play()
        {
                if(screen.width<=800 || closeB)
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

xmlPost()