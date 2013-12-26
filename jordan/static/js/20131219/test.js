function cooler () {
	this.show = function(){
		alert("show");
	}

	this.init = function(){
		alert("init");
	}
}

cooler.prototype = {
	show2:function() 
	{ 
		alert("ShapeBase show"); 
	}, 
	init2:function() 
	{ 
		alert("ShapeBase init"); 
	}
};

alert(0);

