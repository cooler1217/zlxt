<?php
class Show_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function get_hour_data($tableName){
        $sql = "select count(*) as total from $tableName;";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_hour_distinctUser($tableName){
        $sql = "select count(distinct jordanGUID) as total from $tableName;";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_url_top($top){
        $sql = "select location,count(id) as total from request group by (location) order by total desc limit $top;";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_domain_count($hour){
        date_default_timezone_set('Asia/Shanghai');
        $datestr = date ("Y-m-d H:i:s" ,time()-3600*$hour); 
        $sql = "select domain,count(id) as total from request where request_datetime > '$datestr' group by domain order by total desc limit 30;";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_domain_top($top){
        $sql = "select location,count(id) as total from request where location REGEXP '^.*/$' group by (location) order by total desc limit $top;";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

}
?>