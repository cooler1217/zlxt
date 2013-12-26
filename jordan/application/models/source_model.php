<?php
class Source_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

   //ad_config == domain 指同一个表
    function get_source_total($sourch_name)
    {
        $sql = "select count(id) as total from `source` where filename like '%{$sourch_name}%'";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_source($sourch_name,$count)
    {
        $sql = "select * from `source` where filename like '%{$sourch_name}%' limit {$count},50";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    

    function del_source($id){
        $this->db->where('id', $id);
        $this->db->delete('source'); 
    }

    function insert_source($adconfigid,$sourcetype,$domain,$path,$filename,$description)
    {
        $data['adconfigid'] = $adconfigid;
        $data['sourcetype'] = $sourcetype;
        $data['domain'] = $domain;
        $data['description'] = $description;
        $data['path'] = $path;
        $data['filename'] = $filename;
        $data['datetime'] = date('Y-m-d H:i:s',time());    
        $this->db->insert('source', $data);
    }

     function update_source($id,$adconfigid,$sourcetype,$domain,$path,$filename,$description)
    {
        $data['adconfigid'] = $adconfigid;
        $data['sourcetype'] = $sourcetype;
        $data['domain'] = $domain;
        $data['description'] = $description;
        $data['path'] = $path;
        $data['filename'] = $filename;
        $data['datetime'] = date('Y-m-d H:i:s',time());    
        $this->db->where('id', $id);
        $this->db->update('source', $data);
    }

    function get_sourcebyid($id){
       $sql = "select * from `source` where id=$id";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

}
?>