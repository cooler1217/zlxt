<?php


  	function getDataJson(){
	  	if(isset($_GET['sfrom'])){
	  		$jordanGUID = $_GET['jordanGUID'];
	  		$domain = $_GET['domain'];
	  		$protocol = $_GET['protocol'];
			$path = $_GET['path'];
			$location = $protocol.$domain.$path;
	  		$sfrom = $_GET['sfrom'];
			initConnection($db_config);
	  		//redis 使用
			require '../Predis/Autoloader.php';
			Predis\Autoloader::register();
			$redis = new Predis\Client(array(
			    'database' => '0',
			    'host'   => '49.4.129.122',
			    'port'   => 6379,
			));
	        $datestr = date("Y_m_d_H");
	        $tableName = "request_".$datestr;

	        if($redis->get("tableName") != $tableName){
	        	create_request($tableName);
	        	$redis->set("tableName",$tableName);
	        }
	        $request_datetime = date('Y-m-d H:i:s',time());
	        writeLog('../logs/'.$tableName.'.log', "$jordanGUID\t$domain\t$location\t$request_datetime\n","a");
	        insert_request_entry($jordanGUID,$domain,$location,$sfrom,$request_datetime,$tableName);
			insert_request_entry($jordanGUID,$domain,$location,$sfrom,$request_datetime,"request");
			//echo "success";
	  	}else{
	  		//echo "failure";
	  	}
  	}



?>
