<?php
    date_default_timezone_set('PRC');
    // header("Content-type: text/html; charset=utf-8");
    // ini_set('memory_limit', '-1');
    // ini_set('display_errors','Off');
    //error_reporting(E_ALL);

    //创建数据库链接
    function initConnection($db_config){
        $connect = mysql_connect($db_config['host'],$db_config['username'],$db_config['password']);
        if (!$connect){
          die('Could not connect: ' . mysql_error());
         }
        $mysqllink = mysql_select_db($db_config['database'], $connect);
        return $mysqllink;
    }

    // // 更新用户提交预加载任务信息 完成
    // function updateUserOverTask($tid){
    //     $upsql = "update task_note  set overtime = now(),status=2  where  id = $tid";
    //     mysql_query($upsql);
    // }

    // //获取用户信息
    // function getUserInfo($name,$password){
    //     $sql = "select * from user   where name = '$name'  and  password = '$password'";
    //     $list = mysql_query($sql);
    //     $info = mysql_fetch_assoc($list);
    //     return $info;
    // }

    //   //获取用户信息
    // function insertIntoRequest(){
    //     $sql = "select * from user   where name = '$name'  and  password = '$password'";
    //     $list = mysql_query($sql);
    //     $info = mysql_fetch_assoc($list);
    //     return $info;
    // }



?>

