<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Source extends CI_Controller {

   function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('log');
        $this->load->library('session');
        $this->load->model('god_model');
		$this->load->model('source_model');
    }

    public function _remap($method)
    {
        $userinfo = $this->session->userdata("userinfo");
        if ( $userinfo)
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
		$data['title'] = "资源管理";
		$this->load->view('header',$data);
		$active['active'] = "source";
		$this->load->view('menu',$active);

		$sourch_name = $this->input->get('sourch_name');
		$count = $this->input->get('count');
		if($sourch_name == null ){
			$sourch_name = "";
		}
		if($count == null || $count == ""){
			$count = 0;
		}
		$result = $this->source_model->get_source($sourch_name,$count);
		$total = $this->source_model->get_source_total($sourch_name);
		$data['result'] = $result;
		$this->load->library('pagination');

		$config['base_url'] = base_url().'source/index?sourch_name='.$sourch_name;
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
		$data['sourch_name'] = $sourch_name;

		$this->load->view('source_view',$data);
		$this->load->view('footer');
	}

	public function del_source(){
		$id = $this->input->get('id');
		$filename = $this->input->get('filename');
		$this->source_model->del_source($id);
		$this->delFileByName($filename);
		$this->index();
	}

	function delFileByName($filename){
		$fullpath = "./uploads/source/".$filename;
	  	if(!is_dir($fullpath)) {
      		unlink($fullpath);
      	} else {
          deldir($fullpath);
      	}
	}

	public function get_adconfigbyid(){
		$adconfigid = $this->input->get("adconfigid");
        $result = $this->god_model->find_ad_config_by_id($adconfigid);
        if(count($result)==0){
        	$result[0] = array();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array("result"=>$result[0])));
	}


	public function up(){
		$id = $this->input->post("id");

		$adconfigid = $this->input->post("adconfigid");
		$position = $this->input->post("position");
		$isfixed = $this->input->post("isfixed");

		$suffix = $this->input->post("suffix");
		$domain = $this->input->post("domain");
		$description = $this->input->post("description");
		$filename = time()."_".$this->input->post("new_name").".".$suffix;
		$path = base_url()."uploads/source/". $filename;
        $config['upload_path'] = './uploads/source/';
	    $config['allowed_types'] = 'gif|jpg|jpeg|png|swf';
	    $config['max_size'] = '100000000000';
	    $config['max_width']  = '10240';
	    $config['max_height']  = '7680';
	    $config['file_name']  = $filename;
	    $config['overwrite'] = TRUE;
	  
	    $this->load->library('upload', $config);
	 
	    if ( ! $this->upload->do_upload("myfile")){
	   		$error = array('error' => $this->upload->display_errors());
	   		echo "<hr>";
            print_r(var_dump($error));
            echo "<hr>";
	  	} else{
	   		$data = array('upload_data' => $this->upload->data());
   			$left = 6;
   			$top = 80;
   			$width = 100;
   			$height = 233;
   			$content = $this->initLeftContent($path);
   			if ($position == "right") {
   				$left = 106;
   			}else if($position == "bottom"){
   				$left = 10;
   				$top = 220;
   				$content = $this->initBottomContent($path);
   			}else if($position == "left_bottom"){
   				$content = $this->initLeftBottomContent($path);
   			}
   			if($isfixed=="glass"){
   				$content = $this->initGlassContent($path);
   			}
	   		if($id == -1){
	   			$adconfigid = $this->god_model->insert_ad_config_entry($domain,$position,$isfixed,$left,$top,$width,$height,$content,$description);
	   			$this->source_model->insert_source($adconfigid,$suffix,$domain,$path,$filename,$description);
	   		}else{
	   			$result = $this->god_model->find_ad_config_by_id($adconfigid);
	   			if (count($result)>0) {
	   				$this->god_model->modify_ad_config_entry($adconfigid,$domain,$position,$isfixed,$left,$top,$width,$height,$content,$description);
	   			}
	   			$source_old = $this->source_model->get_sourcebyid($id);
	   			foreach ($source_old as $key => $value) {
	   				$this->delFileByName($value->filename);
	   			}
	   			$this->source_model->update_source($id,$adconfigid,$suffix,$domain,$path,$filename,$description);
	   		}
	   		$this->index();
	  	}
    }

    function initLeftContent($path){
    	$content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="97" height="233"><param name="movie" value="'.$path.'"><param name="quality" value="high"><embed src="'.$path.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="97" height="233"></embed></object><img align="right" src="http://49.4.129.122/jordan/static/images/close.gif" class="close_ad_cooler">';
    	return $content;
    }

    function initBottomContent($path){
    	$content = '<object type="application/x-shockwave-flash" data="'.$path.'" width="100%" height="120"><param name="movie" value="'.$path.'"><param name="quality" value="high"><param name="bgcolor" value="#666666"><param name="play" value="true"><param name="loop" value="true"><param name="wmode" value="transparent"><param name="scale" value="showall"><param name="menu" value="true"><param name="devicefont" value="false"><param name="salign" value=""><param name="allowScriptAccess" value="sameDomain"></object> ';
    	return $content;
    }
 
    function initGlassContent($path){
    	$content = '<div style="margin-top:100px;weidth:600px;height:600px;"><embed src="'.$path.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"  width="750px" height="400px"></embed></div>';
    	return $content;
    }

    function initLeftBottomContent($path){
    	$content = '<div id="_AdSame_DIV441" name="_AdSame_DIV441" style="position: fixed; z-index: 100000000; top: auto; left: auto; width: 300px; height: 300px; overflow: hidden; right: 0px; bottom: 0px; display: block;"><embed style="display:block; padding-top:10px;" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" src="'.$path.'" id="VideoPlayer" name="VideoPlayer" allowscriptaccess="always" quality="high" width="300" height="330" swliveconnect="false" wmode="transparent"></div>';
    	return $content;
    }   
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */