<?php 
	include('../config.php');
	include('../model/god_model.php');

    date_default_timezone_set('Asia/Shanghai');
    if(isset($_GET["date_hour"]) && isset($_GET["domain"])){
    	$date_hour = $_GET["date_hour"];
    	$domain = $_GET["domain"];
    }else{
    	$date_hour = date("Y_m_d_H");
    	$domain = "127.0.0.1";
    }
	$datestr = $date_hour;
	$tableName = "request_".$datestr;
    
    function getRequest($domain,$tableName){
		$db_config = initDBConfig();
		$mysqllink = initConnection($db_config);
		$result = getRequestByDomain($domain,$tableName);
		return $result;
    }

    $result  = getRequest($domain,$tableName);

?>