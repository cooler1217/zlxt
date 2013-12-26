<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class God extends CI_Controller {

   function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('log');
        $this->load->library('session');
        $this->load->model('god_model');
    }

    public function _remap($method)
    {
        $userinfo = $this->session->userdata("userinfo");
        if ($method == 'get_advise_json' || $method == 'get_advise_json_fg' ||$userinfo)
        {
            $this->$method();
        }else
        { 
          $data['title'] = "用户登录";
          $this->load->view('header',$data);
          $data['error'] = "1";
          //$this->session->set_userdata($arr);
          $this->load->view("login_view",$data);
          $this->load->view("footer");                
        }
    }

	public function index()
	{
		$this->load->view('god');
	}

	public function show_ad_config_result(){
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
		$config['per_page'] = 20; 
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

	public function show_request_result(){
		$data['title'] = "引入结果";
		$this->load->view('header',$data);
		$active['active'] = "request_result";
		$this->load->view('menu',$active);
		$date_hour = $this->input->get('date_hour');
		$domain = $this->input->get('domain');
		$count = $this->input->get('count');
		if($domain == null ){
			$domain = "";
		}
		if($count == null || $count == ""){
			$count = 0;
		}
		//redis 使用
		require 'Predis/Autoloader.php';
		Predis\Autoloader::register();
		$redis = new Predis\Client(array(
		    'database' => '0',
		    'host'   => '49.4.129.122',
		    'port'   => 6379,
		));
		date_default_timezone_set('Asia/Shanghai');
        $datestr = date("Y_m_d_H");
        if($date_hour!=""){
        	$datestr = $date_hour;
        }
        $tableName = "request_".$datestr;
        // if($redis->get("tableName") != $tableName){
        // 	$this->god_model->create_request($tableName);
        // 	$redis->set("tableName",$tableName);
        // }

		$result = $this->god_model->get_request_entries($domain,$count,$tableName);
		$total = $this->god_model->get_request_entries_total($domain,$tableName);
		$data['result'] = $result;
		$this->load->library('pagination');

		$config['base_url'] = base_url().'god/show_request_result?domain='.$domain."&date_hour=".$date_hour;
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
		$data['date_hour'] = $datestr;
		$this->load->view('request_view',$data);
		$this->load->view('footer');	
	}

	public function del_ad_config(){
		$userinfo = $this->session->userdata("userinfo");
		$id = $this->input->get('id');
		$del_status = false;
		if ($userinfo->right == 0) {
			$this->god_model->del_ad_config_entry($id);
		}else if ($userinfo->right == 1) {
			$ad_config = $this->god_model->get_ad_config_byid($id);
			if($userinfo->domain == $ad_config[0]->domain){
				$this->god_model->del_ad_config_entry($id);
			}else{
				$del_status = TRUE;
			}
		}
		if ($del_status) {
			$data['title'] = "域名配置";
			$this->load->view('header',$data);
			$active['active'] = "domain_result";
			$this->load->view('menu',$active);
			$data['reason'] = "no right to delete it ！ ";
			$this->load->view("no_right_view",$data);
			$this->load->view('footer');
		}else{
			$this->show_ad_config_result();
		}
	}

	public function mod_ad_config(){
		$data['title'] = "域名配置";
		$this->load->view('header',$data);
		$active['active'] = "domain_result";
		$this->load->view('menu',$active);
		$id = $this->input->get('id');
		$result = $this->god_model->find_ad_config_by_id($id);
		$data['domain'] = $result[0];
		$data["action"] = "modify";
		$this->load->view('add_ad_config',$data);
		$this->load->view('footer');
	}

	public function change_ad_config(){
		$id = $this->input->get('id');
		$status = $this->input->get('status');
		$this->god_model->change_ad_config_status($id,$status);
		$this->show_ad_config_result();
	}


	public function show_add_ad_config()
	{
		$data['title'] = "新增配置";
		$this->load->view('header',$data);
		$active['active'] = "add_domain";
		$this->load->view('menu',$active);
		$data["action"] = "add";
		$data["domain"] = array(
			"id"=>-1,
			"domain"=>"domain",
			"position" => "right",
			"isfixed" => "false",
			"left" => 106,
			"top" => 80,
			"width" => 80,
			"height" => 60,
			"description" => "description",
			"content"=>"advise html code"
			);
		$this->load->view('add_ad_config',$data);
		$this->load->view('footer');
	}

	public function add_ad_config()
	{
		$id = $this->input->post("id");
		$domain = $this->input->post("domain");
		$position = $this->input->post("position");
		$isfixed = $this->input->post("isfixed");
		$left = $this->input->post("left");
		$top = $this->input->post("top");
		$width = $this->input->post("width");
		$height = $this->input->post("height");
		$description = $this->input->post("description");
		$content = $this->input->post("content");

		if($id==-1){
			$this->god_model->insert_ad_config_entry($domain,$position,$isfixed,$left,$top,$width,$height,$content,$description);
		}else{
			$this->god_model->modify_ad_config_entry($id,$domain,$position,$isfixed,$left,$top,$width,$height,$content,$description);
		}
		$this->show_ad_config_result();
	}

	public function get_advise_json_fg(){
		$jordanGUID = $this->input->get("jordanGUID");
		$domain = $this->input->get("domain");
		$protocol = $this->input->get("protocol");
		$path = $this->input->get("path");
		$location = $protocol.$domain.$path;
		//redis 使用
		require 'Predis/Autoloader.php';
		Predis\Autoloader::register();
		$redis = new Predis\Client(array(
		    'database' => '3',
		    'host'   => '49.4.129.122',
		    'port'   => 6379,
		));
		date_default_timezone_set('Asia/Shanghai');
        $datestr = date("Y_m_d_H");
        $tableName = "request_fg_".$datestr;

        if($redis->get("tableName") != $tableName){
        	$this->god_model->create_request($tableName);
        	$redis->set("tableName",$tableName);
        }
        $request_datetime = date('Y-m-d H:i:s',time());
        write_file('./logs/'.$tableName.'.log', "$jordanGUID\t$domain\t$location\t$request_datetime\n","a");
		$this->god_model->insert_request_fg_entry($jordanGUID,$domain,$location,$request_datetime,$tableName);
		$this->god_model->insert_request_fg_entry($jordanGUID,$domain,$location,$request_datetime,"request_fg");
		echo "success";
	}

	// 引入广告方法
	public function get_advise_json()
	{
		$jordanGUID = $this->input->get("jordanGUID");
		$domain = $this->input->get("domain");
		$protocol = $this->input->get("protocol");
		$path = $this->input->get("path");
		$sfrom = $this->input->get("sfrom");
		$location = $protocol.$domain.$path;
		//redis 使用
		require 'Predis/Autoloader.php';
		Predis\Autoloader::register();
		$redis = new Predis\Client(array(
		    'database' => '0',
		    'host'   => '49.4.129.122',
		    'port'   => 6379,
		));
		date_default_timezone_set('Asia/Shanghai');
        $datestr = date("Y_m_d_H");
        $tableName = "request_".$datestr;

        if($redis->get("tableName") != $tableName){
        	$this->god_model->create_request($tableName);
        	$redis->set("tableName",$tableName);
        }
        $request_datetime = date('Y-m-d H:i:s',time());
        write_file('./logs/'.$tableName.'.log', "$jordanGUID\t$domain\t$location\t$sfrom\t$request_datetime\n","a");
		$this->god_model->insert_request_entry($jordanGUID,$domain,$location,$sfrom,$request_datetime,$tableName);
		$this->god_model->insert_request_entry($jordanGUID,$domain,$location,$sfrom,$request_datetime,"request");
		$redis->select(1);
		$domainConfig = $this->getDomainFromRedis($redis,$domain);
		echo $domainConfig;

	}

	function getDomainFromRedis($redis,$domain){
	
		$domainConfig = $redis->get($domain);
		if($domainConfig){
		}else{
			$domainConfig = $this->setDomainToRedis($redis,$domain);
			$domainConfig = $redis->get($domain);
		}

		return $domainConfig ;
	}

	function setDomainToRedis($redis,$domain){
		$result = $this->god_model->find_ad_config_by_domain($domain);
		$adviseArray = array();
		foreach ($result as $key => $value) {
			$adviseArray[$key] = array($value->position,$value->isfixed,$value->left,$value->top,$value->width,$value->height,str_replace('"', "@T@", $value->content));
		}
		$redis->setex($domain,6, "jsonpCallback('".json_encode($adviseArray)."')");
	}

	public function test(){
		//phpinfo();
		//$this->god_model->insert_request();
		// date_default_timezone_set('Asia/Shanghai');
		// echo date("Y-m-d-h");
		// $this->load->view('test_view');
		// $this->load->view('head_view');
		// redis 使用
		require 'Predis/Autoloader.php';
		Predis\Autoloader::register();
		$redis = new Predis\Client(array(
		    'database' => '0',
		    'host'   => '49.4.129.122',
		    'port'   => 6379,
		));
		echo $redis->ttl("tableName");
		// $redis->set('library', 'predis');
		// $retval = $redis->get('library');
		// echo "$retval";
		// echo $redis->get("a");
		// print_r($redis->keys("*"));
		//$this->load->view('test_view');
		$this->getDomainFromRedis($redis,"127.0.0.1");
	}

	public function kuayu_test(){
		//$a = array(array('aa'=>'aaa','bb'=>'bbb'),array('aa'=>'aaaa','bb'=>'bbbb'));
		//$get = $_GET['callback'];
		//echo $get."('".json_encode($a)."')";//注意格式
		$name = $this->input->get("name");
		// $json ='{"name":"yovae","password":"12345"}';    //虽然这行数据形式上是json格式，如果没有上面那句的话，它是不会被当做json格式的数据被处理的；
		 
		// //print_r(json_decode($json));
		// // echo $this->input->get("callback");
		 echo "jsonpCallback('".json_encode(array('name' => $name))."')";
		//$this->output->set_content_type('application/json')->set_output(json_encode(array('name' => $name)));
	}

	public function createTable(){

		// log_message('error', 'Some variable did not contain a value.');
		// log_message('debug', 'Some variable was correctly set');
		// log_message('info', 'The purpose of some variable is to provide some value.');
		// echo "string";exit();
		$tableName = $this->input->get("tableName");
		if($tableName == 24){
			for($i=0;$i<24;$i++){
				date_default_timezone_set('Asia/Shanghai');
		        $datestr = date('Y_m_d_H',time()-3600*$i);
		        $tableName = "request_".$datestr;
				$this->god_model->create_request($tableName);
			}
		}else{
			$this->god_model->create_request($tableName);
		}
	}

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */