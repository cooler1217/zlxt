<?php

function readJS($jsname){
	$content = "";
	$fp = fopen($jsname, "r");
	while(! feof($fp)) 
	{ 
		$content = $content.fgets($fp);
	} 
	fclose($fp);  
	return $content;
}

function readDomain($domainfile){
	$fp = fopen($domainfile, "r");
	$fileArray = array();
	while(! feof($fp)) 
	{ 
		array_push($fileArray,fgets($fp));

	} 
	fclose($fp);  
	return $fileArray;
}

//echo readJS();

function createJS($filename,$content){
	$js=fopen($filename,"w");
    fwrite($js,$content);
    fclose($js);
}
function clear_blank($str, $glue='')
{
	$replace = array(" ", "\r", "\n", "\t"); 
	return str_replace($replace, $glue, $str);
}

function create1(){

	$content = readJS("./static/js/www.17173.com.js");
	$fileArray = readDomain("filename.txt");
		// var_dump($fileArray);
	foreach ($fileArray as $key => $value) {
		$filename = clear_blank($value);
		$filenamearr = explode("/", $filename);
		// echo $filenamearr[0];
		// var_dump($filename);
		createJS("./anqita/".$filenamearr[0].".js",$content);
	}
	$count = count($fileArray); 
	echo " init $count js success~~";
}

function create2(){

	$content = readJS("./static/js/weather.news.sina.com.cn.js");
	$fileArray = readDomain("cpa.txt");
		// var_dump($fileArray);
	foreach ($fileArray as $key => $value) {
		$filename = clear_blank($value);
		$filenamearr = explode("/", $filename);
		// echo $filenamearr[0];
		// var_dump($filename);
		createJS("./anhei/".$filenamearr[0].".js",$content);
	}
	$count = count($fileArray); 
	echo " init $count js success~~";
}


function create3(){	
	$content = readJS("./static/js/weather.news.sina.com.cn.js");
	$fileArray = readDomain("cpa2.txt");
		// var_dump($fileArray);
	foreach ($fileArray as $key => $value) {
		$filename = clear_blank($value);
		$filenamearr = explode("/", $filename);
		// echo $filenamearr[0];
		// var_dump($filename);
		createJS("./anhei/www.".$filenamearr[0].".js",$content);
	}
	$count = count($fileArray); 
	echo " init $count js success~~";
}

function mainjs(){
	create1();
	create2();
	create3();
}

mainjs();

function createArray(){
	$arrayName = array();
	$content = "\"";
	$fileArray = readDomain("filename.txt");
	foreach ($fileArray as $key => $value) {
		$filename = clear_blank($value);
		$filenamearr = explode("/", $filename);
		$content = $content.$filenamearr[0];
		// $content = $content . 'AdvertiseList.push("'.$filenamearr[0].'");'."\n";
	}
	$fileArray = readDomain("cpa.txt");
	foreach ($fileArray as $key => $value) {
		$filename = clear_blank($value);
		$filenamearr = explode("/", $filename);
		$content = $content.$filenamearr[0];
		// $content = $content . 'AdvertiseList.push("'.$filenamearr[0].'");'."\n";
	}
	$fileArray = readDomain("cpa2.txt");
	foreach ($fileArray as $key => $value) {
		$filename = clear_blank($value);
		$filenamearr = explode("/", $filename);
		$content = $content.$filenamearr[0];
		// $content = $content . 'AdvertiseList.push("www.'.$filenamearr[0].'");'."\n";
	}
	createJS("array.js",$content."\"");
	echo "$content";

}

//createArray();



?>