<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con_dashbord extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_name = null;
    public $user_email = null;
    public $user_menu = null;
    public $user_module = null;
    public $user_type = null;
    public $user_group = null;
    public $module_id = null;
    public $date_time = null;
    
    public function __construct() {
        parent::__construct();
        //$session_id = $this->session->userdata('hr_logged_in');
        //print_r($session_id);
        //echo $_SERVER['REMOTE_ADDR']."==";
        
        //echo $this->Common_model->get_client_ip();
                
        if( !$this->session->userdata('hr_logged_in') ) {
            redirect('chome/logout', 'refresh');
        }
        
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_name =$this->user_data['name'];
        $this->user_email =$this->user_data['username'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index() {
        if (!$this->user_id) {
            //if (!$this->hr_login->is_logged_in()) {
            redirect('chome/logout', 'refresh');
        } else {
            
            $this->module_id = $this->uri->segment(3);
            if (!$this->uri->segment(3)) {
               $user_module= explode(',',$this->user_module);
               $param['module_id'] = $user_module[0];
            } else {
                $param['module_id'] = $this->uri->segment(3);
            }
            
            $module_session_array = array();
            $module_session_array = array('module_id' => $param['module_id']);
            $this->session->set_userdata('active_module_id', $module_session_array);

            $param['user_group'] = $this->user_group;
            $param['user_id'] = $this->user_id;
            $param['user_name'] = $this->user_name;
            $param['user_email'] = $this->user_email;
            
            $param['user_group'] = $this->user_group;
            $param['page_header'] = "Dashboard";
            
            $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
            $param['content'] = 'sadmin/view_dashbord.php';
            $this->load->view('admin/home', $param);
        }
    }


}
