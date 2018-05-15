<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_CV_Bank extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    
    public $module_data = array();
    public $module_id = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id =$this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type =$this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        
        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id =$this->module_data['module_id'];
        
        $this->load->model('Sendmail_model');
        
    }

    public function index($menu_id=0, $show_result = FALSE, $search_ids = array(), $search_criteria = array('requisition_id' => '','status' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;
            
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "CV Bank";
        $param['module_id']=$this->module_id;
        
        if (!empty($search_ids)) {
            $this->db->where_in('id', $search_ids);
        }
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_cv_management', array('isactive' => 1));
        }
        
        //echo $this->db->last_query();
        
        $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved
        $param['candidate_status'] = $this->Common_model->get_array('candidate_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_CV_Bank.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_CV_Bank() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_id'] = $requisition_id = $this->input->post('requisition_id');
        $search_criteria['status'] = $status = $this->input->post('status');

        if (($requisition_id != '') || ($status != '')) {
     
            $this->db->select('id');
            $this->db->from('main_cv_management');
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } 
            
            /* ----Conditions---- */
            if ($requisition_id != '') {
                $this->db->where('requisition_id', $requisition_id);
            }
            if ($requisition_id != '') {
                $this->db->where('status', $status);
            }
           
            $ids = $this->db->get()->result_array();
            
            //echo $this->db->last_query();
            
        }

        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
        
    }
    
   
    public function download_resume() {
        $resume_path = $this->uri->segment(3);
        if($resume_path!="")
        {
            $this->load->helper('download');
            //$data = file_get_contents(base_url('/uploads/candidate_resume/' . $resume_path));
            $url = Get_File_Directory('/uploads/candidate_resume/' . $resume_path);
            $data = file_get_contents($url);
            force_download($resume_path, $data);
        }
    }
    
    public function view_CVManagement() {
        
        $cvm_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "CV Management";
        $param['module_id'] = $this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'company_id' => $this->company_id)); //Approved
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
        } else {
           $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved
           $param['employees_query'] = $this->Common_model->listItem('main_employees');
        }

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id,'id' =>$cvm_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_cv_management', array('id' => $cvm_id ));            
        }        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_CVmanagementDetail.php';
        $this->load->view('admin/home', $param);
    }
    
    
}

