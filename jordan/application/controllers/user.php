<?php
    Class User extends CI_Controller{

        function __construct()
        {
          parent::__construct();
          $this->load->helper('url');
          $this->load->library('log');
          $this->load->library('session');
          $this->load->model('god_model');
          $this->load->model('user_model');
          $this->load->library('encrypt');
        }

        public function _remap($method)
        {
            $userinfo = $this->session->userdata("userinfo");
            if ($method == 'auth' || $method == 'login' || $method == 'error' || $userinfo)
            {
                $this->$method();
            }else
            { 
                  $this->login();                
            }
        }

        public function auth()
        {
          $login_status = false;
          $error = "1";
          $username = $this->input->post("username");
          $password = $this->input->post("password");
          $result = $this->user_model->get_user_by_account($username);
          if(count($result)>0){
            $encrypted_pw = $this->encrypt->decode($result[0]->password);
            if($encrypted_pw == $password){
              $arr = array(
                "userinfo" => $result[0],
                );
              $this->session->set_userdata($arr);
              $login_status = true;
            }else{
              $error = "密码输入错误！";
            }
          }else{
            $error = "用户名输入错误！";
          }
          if($login_status){
            $this->index();
          }else{
            $this->error($error);
          }
          //secho "$password<br/>";
          // $encrypted_pw = $this->encrypt->encode($password);
          // echo "$encrypted_pw<br/>";
          // $encrypted_pw_jiemi = $this->encrypt->decode($encrypted_pw);
          // echo "$encrypted_pw_jiemi";
        }

        public function index(){
          $data['title'] = "域名配置";
          $this->load->view('header',$data);
          $active['active'] = "domain_result";
          $this->load->view('menu',$active);

          $domain = $this->input->get('domain');
          $count = $this->input->get('count');
          if($domain == null ){
            $domain = "";
          }
          if($count == null || $count == ""){
            $count = 0;
          }
          $result = $this->god_model->get_ad_config_entries($domain,$count);
          $total = $this->god_model->get_ad_config_entries_total($domain);
          $data['result'] = $result;
          foreach ($result as $key => $value) {
            $value->content = preg_replace("'\n'", "", $value->content);
            $value->content = preg_replace("'\r'", "", $value->content);
          }
          $this->load->library('pagination');

          $config['base_url'] = base_url().'god/show_ad_config_result?domain='.$domain;
          $config['total_rows'] = $total[0]->total;
          $config['per_page'] = 50; 
          $config['first_link'] = '第一页';
          $config['last_link'] = '最后一页';  
          $config['page_query_string'] = TRUE;
          $config['prev_link'] = '&lt;';
          $config['next_link'] = '&gt;';
          $config['query_string_segment'] ="count";


          $this->pagination->initialize($config); 

          $data['page_links'] =  $this->pagination->create_links();
          $data['domain'] = $domain;
          $this->load->view('domain_view',$data); 
          $this->load->view('footer');
        }

        public function login(){
          $data['title'] = "用户登录";
          $this->load->view('header',$data);
          $data['error'] = "1";
          //$this->session->set_userdata($arr);
          $this->load->view("login_view",$data);
          $this->load->view("footer");
        }

        public function logout(){
            $this->session->unset_userdata("userinfo");
            $this->login();          
        }

        public function error($error){

          log_message('debug', 'cooooooooooooooooooooooooooooooooler');
          $data['title'] = "用户登录";
          $this->load->view('header',$data);
          $data['error'] = $error;
          $this->load->view("login_view",$data);
          $this->load->view("footer");
        }

        public function show_user()
        {
          $data['title'] = "用户管理";
          $this->load->view('header',$data);
          $active['active'] = "user";
          $this->load->view('menu',$active);

          $username = $this->input->get('username');
          $count = $this->input->get('count');
          if($username == null ){
            $username = "";
          }
          if($count == null || $count == ""){
            $count = 0;
          }
          $result = $this->user_model->get_user($username,$count);
          $total = $this->user_model->get_user_total($username);
          $data['result'] = $result;
          $this->load->library('pagination');

          $config['base_url'] = base_url().'user/show_user?username='.$username;
          $config['total_rows'] = $total[0]->total;
          $config['per_page'] = 50; 
          $config['first_link'] = '第一页';
          $config['last_link'] = '最后一页';  
          $config['page_query_string'] = TRUE;
          $config['prev_link'] = '&lt;';
          $config['next_link'] = '&gt;';
          $config['query_string_segment'] ="count";
          $this->pagination->initialize($config); 
          $data['page_links'] =  $this->pagination->create_links();
          $data['username'] = $username;

          $this->load->view('user_view',$data);
          $this->load->view('footer');
        }

        public function save_user(){
          $userinfo = $this->session->userdata("userinfo");
          $id = $this->input->post('id');
          $username = $this->input->post('username');
          $password = $this->input->post('password');
          $encrypted_pw = $this->encrypt->encode($password);
          $domain = $this->input->post('domain');
          $right = $this->input->post('right');
          if($userinfo->right == 0){
            if($id=="-1"){
              $this->user_model->add_user($username,$encrypted_pw,$domain,$right);  
            }else{
              $this->user_model->update_user($id,$username,$encrypted_pw,$domain,$right);  
            }
            if($userinfo->username == $username){
              $userinfo->right = $right;
              $userinfo->domain = $domain;
              $userinfo->username = $username;
              $arr = array(
                "userinfo" => $userinfo,
                );
              $this->session->set_userdata($arr);
            }
            $this->show_user();
          }else if($userinfo->right == 1){
            if($id=="-1"){
              $data['title'] = "域名配置";
              $this->load->view('header',$data);
              $active['active'] = "domain_result";
              $this->load->view('menu',$active);
              $data['reason'] = "no right to add user ！ ";
              $this->load->view("no_right_view",$data);
              $this->load->view('footer');
            }else{
              if($userinfo->username == $username){
                $userinfo->right = 1;
                $userinfo->domain = $domain;
                $userinfo->username = $username;
                $arr = array(
                  "userinfo" => $userinfo,
                  );
                $this->user_model->update_user($id,$username,$encrypted_pw,$domain,1);  
                $this->session->set_userdata($arr);
                $this->show_user();
              }else{
                $data['title'] = "域名配置";
                $this->load->view('header',$data);
                $active['active'] = "domain_result";
                $this->load->view('menu',$active);
                $data['reason'] = "no right to modify it ！ ";
                $this->load->view("no_right_view",$data);
                $this->load->view('footer');
              }
            }
          }else{
              $data['title'] = "域名配置";
              $this->load->view('header',$data);
              $active['active'] = "domain_result";
              $this->load->view('menu',$active);
              $data['reason'] = "no right to modify it ！ ";
              $this->load->view("no_right_view",$data);
              $this->load->view('footer');
          }
        }

        public function del_user(){
          $id = $this->input->get('id');
          $userinfo = $this->session->userdata("userinfo");
          if ($userinfo->right == 0) {
              $this->user_model->delete_user($id);
              $this->show_user();
          }else{
              $data['title'] = "域名配置";
              $this->load->view('header',$data);
              $active['active'] = "domain_result";
              $this->load->view('menu',$active);
              $data['reason'] = "no right to delete it ！ ";
              $this->load->view("no_right_view",$data);
              $this->load->view('footer');
          }
        }

    }
?>
