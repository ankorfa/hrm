<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Interview_Date_Acceptance extends CI_Controller {

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
        
    }

    public function index() {
        
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Interview Date Acceptance";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('interview_status', $status_id);
            $this->db->where_not_in('acceptance_status', 1);
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('interview_status', $status_id);
            $this->db->where_not_in('acceptance_status', 1);
            $param['query'] = $this->db->get_where('main_interview_schedule', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Date_Acceptance.php';
        $this->load->view('admin/home', $param);
    }
    
    public function view_Interview_Date_Acceptance() {
        
        $si_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Interview Date Acceptance";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'id' =>$si_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('id' => $si_id ));            
        }
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Date_Approval.php';
        $this->load->view('admin/home', $param);
    }
    
    public function save_allInterview_Date_Acceptance() {
         
        $this->form_validation->set_rules('acceptance_status', ' Status ', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id[]', 'Action Button', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $approver_id = $this->input->post("approver_id");
            for ($i = 0; $i < count($approver_id); $i++) {

                $data[] = array('id' => $approver_id[$i],
                    'acceptance_status' => $this->input->post('acceptance_status'),                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );                
                $res = $this->db->update_batch('main_interview_schedule', $data, 'id');
            } 
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function save_Interview_Date_Acceptance() {

        $this->form_validation->set_rules('acceptance_status', 'Status', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('acceptance_status' => $this->input->post('acceptance_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_interview_schedule', $data, array('id' => $this->input->post('schedule_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
   
    
}

