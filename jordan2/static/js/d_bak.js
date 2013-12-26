function redirect(){
	var site_url = document.getElementById("site_url").innerHTML;
	var title = site_url;
	try{
		var title = site_url.split("//")[1].split("/")[0];
	}catch(err){

	}
	document.getElementsByTagName('title')[0].innerHTML =  title;

	var height= (parseInt(window.screen.height)-160).toString() + "px";
	var width = (window.screen.width).toString() + "px";
	document.write("<iframe width='"+width+"' height='"+height+"'  style='border: 0px; margin-top:-18px;margin-left:-12px;' id='test' src='"+site_url+"'></iframe>")
}


function setCookie(name,value,time){
	var strsec = getsec(time);
	var exp = new Date();
	exp.setTime(exp.getTime() + strsec*1);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getsec(str){
	var str1=str.substring(1,str.length)*1; 
	var str2=str.substring(0,1); 
	if (str2=="a"){
		return str1*1;
	}else if (str2=="s"){
		return str1*1000;
	}else if (str2=="h"){
		return str1*60*60*1000;
	}else if (str2=="d"){
		return str1*24*60*60*1000;
	}
}

setCookie("sexy","1","s3");
redirect();