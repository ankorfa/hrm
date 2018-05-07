<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Admin_Dashbord extends CI_Controller {

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
                
        if( !$this->session->userdata('hr_logged_in') ) {
            redirect('Chome/logout', 'refresh');
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
            redirect('Chome/logout', 'refresh');
        } else {
            
            if ($this->user_group == 12) {//Company User
                $uquery = $this->db->get_where('main_users', array('parent_user' => $this->parent_user, 'user_group' => $this->user_group, 'company_id !=' => 0));
            } else if ($this->user_group == 1) {//Service Provider
                $uquery = $this->db->get_where('main_users', array('parent_user' => $this->user_id, 'user_group' => 12, 'company_id !=' => 0));
            }

            $ids = array();
            foreach ($uquery->result_array() as $id) {
                $ids[] = $id['company_id'];
            }

            if(!empty($ids))
            {
                $this->db->where_in('id', $ids);
                $param['query']=$this->db->get_where('main_company', array());
            }
            else {
                $param['query']=$this->db->get_where('main_company', array());
            }
            
            $param['corporation_type']=$this->Common_model->get_array('corporation_type');
            
            //echo $this->db->last_query();
            
            $param['module_id'] = 0;
            
            $param['user_group'] = $this->user_group;
            $param['user_id'] = $this->user_id;
            $param['user_name'] = $this->user_name;
            $param['user_email'] = $this->user_email;
            
            $param['user_group'] = $this->user_group;
            $param['page_header'] = "Dashboard";
            
            $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
            $param['content'] = 'sadmin/view_admin_dashbord.php';
            
            $this->load->view('admin/home', $param);
            
        }
    }


}
