<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_user_by_account($account)
    {
        $this->db->where('username', $account);
        $query = $this->db->get('authority',1,0);
        return $query->result(); 
    }

   //ad_config == domain 指同一个表
    function get_user_total($username)
    {
        $sql = "select count(id) as total from `authority` where username like '%{$username}%'";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function get_user($username,$count)
    {
        $sql = "select * from `authority` where username like '%{$username}%' limit {$count},50";
        $query = $this->db->query($sql);
        return $query->result(); 
    }

    function add_user($username,$encrypted_pw,$domain,$right)
    {

        $data['username'] = $username;
        $data['password'] = $encrypted_pw; 
        $data['domain'] = $domain;
        $data['right'] = $right;
        $this->db->insert('authority', $data);
    }

    function update_user($id,$username,$encrypted_pw,$domain,$right)
    {
        $data['username'] = $username;
        $data['password'] = $encrypted_pw; 
        $data['domain'] = $domain;
        $data['right'] = $right;
        $this->db->where('id', $id);
        $this->db->update('authority', $data);
    }

    function delete_user($id){
        $this->db->where('id', $id);
        $this->db->delete('authority'); 
    }

}
?>