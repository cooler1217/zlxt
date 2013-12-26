<?php
    date_default_timezone_set('PRC');

    //创建数据库链接
    function initConnection($db_config){
        $connect = mysql_connect($db_config['host'],$db_config['username'],$db_config['password']);
        if (!$connect){
          die('Could not connect: ' . mysql_error());
         }
        $mysqllink = mysql_select_db($db_config['database'], $connect);
        return $mysqllink;
    }


    //插入用户request数据
    function insert_request_entry($jordanGUID,$domain,$location,$sfrom,$request_datetime,$tableName)
    {
        $create_table_sql = "insert into $tableName 
                            (jordanGUID,domain,location,sfrom,request_datetime) 
                            values
                            ('$jordanGUID','$domain','$location','$sfrom','$request_datetime');";
        mysql_query($create_table_sql);
    }

     function create_request($tableName){

        $create_table_sql = "CREATE TABLE if not exists`$tableName` (
          `id` int(10) NOT NULL AUTO_INCREMENT,
          `domain` varchar(100) DEFAULT NULL,
          `location` varchar(200) DEFAULT NULL,
          `sfrom` varchar(10) DEFAULT NULL,
          `request_datetime` datetime DEFAULT NULL,
          `jordanGUID` varchar(40) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";
         mysql_query($create_table_sql);
    }

    function getRequestByDomain($domain,$sfrom,$tableName){
      if($sfrom=="0"){
        $sql = "select  * from request where domain like '%$domain%' limit 50;";
      }else{
        $sql = "select  * from request where domain like '%$domain%' and sfrom='$sfrom' limit 50;";
      }
      $result = mysql_query($sql);
      $requestList = array();
      while($row = mysql_fetch_array($result)) {
            $requestList[] = $row;
        }
      return $requestList;
    }


?>

