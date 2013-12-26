<?php
    Class Blog extends CI_Controller{

        function __construct()
        {
          parent::__construct();
          $this->load->helper('url');
          $this->load->helper('download');
          $this->load->library('log');
          $this->load->library('session');
          $this->load->model('god_model');
        }

        public function phpinfo(){
          phpinfo();
        }

        public function index(){
            // $result = $this->god_model->insert_ad_config_entry("domainlll","left","true",6,80,100,233,"content","description");
            // print_r($result);exit();
            $data["title"]=" this is ok";
            $data["heading"]=" this is header";
            $data["todo"]=array("cat","dog","corw");
            $this->load->view("blog_view",$data);
        }

        public function test_view(){
         $this->load->view("test_view"); 
        }

        public function test_view2(){
         $this->load->view("test_view2"); 
        }

        public function test_view3(){
         $this->load->view("test_view3"); 
        }

        public function test_view4(){
         $this->load->view("test_view4"); 
        }

        public function test_view5(){
         $this->load->view("test_view5"); 
        }

       public function test_browser(){
              $data["title"]=" this is ok";
              $data["heading"]=" this is header";
              $data["todo"]=array("cat","dog","corw");
              $this->load->view("test_browser",$data);
          }

      public function get_json_data(){
        $query = $this->input->get("query");
        $this->output->set_content_type('application/json')->set_output(json_encode(array("result"=>array("ab你c","a","ac","你好","你"))));
      }

    }
?>