<?php
class God_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

   //ad_config == domain 指同一个表
    function get_request_entries_total($domain,$tableName)
    {
        $sql = "select count(id) as total from `$tableName` where domain like '%{$domain}%'";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_request_entries($domain,$count,$tableName)
    {
        $sql = "select * from `$tableName` where domain like '%{$domain}%' limit {$count},50";
        $query = $this->db->query($sql);
        return $query->result(); 
    
    }

    //ad_config == domain 指同一个表
    function get_ad_config_entries_total($domain)
    {
        $sql = "select count(id) as total from ad_config where domain like '%{$domain}%'";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_ad_config_entries($domain,$count)
    {
        $sql = "select * from ad_config where domain like '%{$domain}%' limit {$count},50";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_ad_config_byid($id)
    {
        $sql = "select * from ad_config where id =  '{$id}'";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function del_ad_config_entry($id){
        $this->db->where('id', $id);
        $this->db->delete('ad_config'); 
    }

    function change_ad_config_status($id,$status){
        $data['status'] = $status;
        $this->db->where('id', $id);
        $this->db->update('ad_config', $data);
    }

    function insert_request_entry($jordanGUID,$domain,$location,$sfrom,$request_datetime,$tableName)
    {
        $data['jordanGUID'] = $jordanGUID;
        $data['domain'] = $domain;
        $data['location'] = $location;
        $data['sfrom'] = $sfrom;
        $data['request_datetime'] = $request_datetime;    
        $this->db->insert($tableName, $data);
    }
    //分光数据
    function insert_request_fg_entry($jordanGUID,$domain,$location,$request_datetime,$tableName)
    {
        $data['jordanGUID'] = $jordanGUID;
        $data['domain'] = $domain;
        $data['location'] = $location;
        $data['request_datetime'] = $request_datetime;    
        $this->db->insert($tableName, $data);
    }

    function insert_ad_config_entry($domain,$position,$isfixed,$left,$top,$width,$height,$content,$description){
        $data['domain'] = $domain;
        $data['position'] = $position;
        $data['isfixed'] = $isfixed;
        $data['left'] = $left;
        $data['top'] = $top;
        $data['width'] = $width;
        $data['height'] = $height;
        $data['content'] = $content;
        $data['description'] = $description;
        $data['config_datetime'] = date('Y-m-d H:i:s',time());
        $lastId = -1;
        $this->db->trans_start();
        $this->db->insert('ad_config', $data);
        $lastId = $this->db->insert_id();
        $this->db->trans_complete();  
        return $lastId;     
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
        $this->db->query($create_table_sql);
    }

    function modify_ad_config_entry($id,$domain,$position,$isfixed,$left,$top,$width,$height,$content,$description)
    {
        $data['domain'] = $domain;
        $data['position'] = $position;
        $data['isfixed'] = $isfixed;
        $data['left'] = $left;
        $data['top'] = $top;
        $data['width'] = $width;
        $data['height'] = $height;
        $data['content'] = $content;
        $data['description'] = $description;
        $data['config_datetime'] = date('Y-m-d H:i:s',time());  
        $this->db->where('id', $id);
        $this->db->update('ad_config', $data);
    }

    function find_ad_config_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('ad_config');
        return $query->result(); 
    }

    function find_ad_config_by_domain($domain){
        $this->db->where('domain', $domain);
        $this->db->where('status', 1);
        $query = $this->db->get('ad_config');
        return $query->result(); 
    }

    function delete_ad_config_entry($id){
        $this->db->where('id', $id);
        $this->db->delete('ad_config'); 
    }


    function get_hour_data($tableName){
        $sql = "select count(*) as total from $tableName;";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

}
?>