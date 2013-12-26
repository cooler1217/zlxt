<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller {

   function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('log');
        $this->load->library('session');
        $this->load->model('show_model');
    }

    public function _remap($method)
    {
        $userinfo = $this->session->userdata("userinfo");
        if ($userinfo)
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

    $data['title'] = "汇总结果";
    $this->load->view('header',$data);
    $active['active'] = "total";
    $this->load->view('menu',$active);

		date_default_timezone_set('Asia/Shanghai');
		$totalArr = array();
		$title = "时间：".date ("m-d H" ,time()-3600*0)."时 至 ".date ("m-d H" ,time()-3600*11)."时"; 
		for ($i=23; $i >=0 ; $i--) { 
			$hour = date ("H" ,time()-3600*$i); 
			$datestr = date ("Y_m_d_H" ,time()-3600*$i); 
        	$tableName = "request_".$datestr;
        	$result = $this->show_model->get_hour_data($tableName); 
			foreach ($result as $key => $value) {
				$totalArr["$hour"] = $value->total;
			}
		}
    //print_r($totalArr);exit;
		$data['totalArr'] = $totalArr;
		$this->load->view('show_view',$data);
    $this->load->view('footer');
	}

  public function user_total()
  {
    $totalArr = array();
    $totalHour = array();
    date_default_timezone_set('Asia/Shanghai');
    $title = "时间：".date ("m-d H" ,time()-3600*0)."时 至 ".date ("m-d H" ,time()-3600*11)."时"; 
    for ($i=0; $i <24 ; $i++) { 
        $hour = date ("H" ,time()-3600*$i); 
        $datestr = date ("Y_m_d_H" ,time()-3600*$i); 
        $tableName = "request_".$datestr;
        $result = $this->show_model->get_hour_distinctUser($tableName); 
        $totalHour[$i] = $hour;
        $totalArr[$i] = $result[0]->total;

    }

    $this->output->set_content_type('application/json')->set_output(json_encode(array("total"=>$totalArr,"hour"=>$totalHour)));
  }


  public function get_url_top(){
    $top = $this->input->get('top');
    if($top == ""){
      $top = 30;
    }
    $results = $this->show_model->get_url_top($top);
    $this->output->set_content_type('application/json')->set_output(json_encode(array("results"=>$results)));
  }

  public function get_domain_top(){
    $top = $this->input->get('top');
    if($top == ""){
      $top = 30;
    }
    $results = $this->show_model->get_domain_top($top);
    $this->output->set_content_type('application/json')->set_output(json_encode(array("results"=>$results)));
  }

  public function get_domain_count(){
    $hour = $this->input->get('hour');
    if($hour == ""){
      $hour = 1;
    }
    $results = $this->show_model->get_domain_count($hour);
    $this->output->set_content_type('application/json')->set_output(json_encode(array("results"=>$results)));
  }

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */