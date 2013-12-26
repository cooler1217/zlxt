<?php
    date_default_timezone_set('PRC');
    
    function writeLog($logname,$content){
        $flog=fopen($logname,"a");
        fwrite($flog,$content);
        fclose($flog);
    }

?>

