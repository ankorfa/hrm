<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Interview_Candidate extends CI_Controller {

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

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Interview Panel";
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('interview_status', $status_id);
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $status='0,4';
            $status = explode(",", $status);
            $status_id = array_map('intval', $status);
            $this->db->where_in('interview_status', $status_id);
            $param['query'] = $this->db->get_where('main_interview_schedule', array('isactive' => 1));
        }
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Interview_Candidate.php';
        $this->load->view('admin/home', $param);
    }
    
    
    function set_Interview_panel() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        
        $param['type']="3";
        $param['page_header']="Interview Panel";	
        $param['module_id']=$this->module_id;

        $param['query'] = $this->db->get_where('main_interview_schedule', array('id' => $id));
        //echo $this->db->last_query();
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addInterview_Candidate.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function view_resume() {
        $resume_path = $this->uri->segment(3);
        if($resume_path!="")
        {
            $this->load->helper('download');
            $data = file_get_contents(base_url('/uploads/candidate_resume/' . $resume_path));
            force_download($filename, $data);
        }
    }
    
    public function update_interview_status(){
        
        $this->form_validation->set_rules('up_interview_status', 'Interview Status','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('up_candidate_status', 'Candidate Status','required',array('required'=> "Please the enter required field, for more Info : %s."));
       
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('interview_status' => $this->input->post('up_interview_status'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
           
            $res=$this->Common_model->update_data('main_interview_schedule',$data,array('id' => $this->input->post('interview_schedule_id')));
            
            $cdata = array('status' => $this->input->post('up_candidate_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $cres=$this->Common_model->update_data('main_cv_management',$cdata,array('id' => $this->input->post('candidate_id')));
            
             if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    public function delete_ScheduledInterviews() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_interview_schedule", $id);
        redirect('Con_ScheduledInterviews/');
        exit;
    }
    
    public function view_ScheduledInterviews() {
        
        $si_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Schedule Interview";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('company_id' => $this->company_id,'id' =>$si_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_interview_schedule', array('id' => $si_id ));            
        }        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_ScheduleInterviewDetail.php';
        $this->load->view('admin/home', $param);
    }
    
    public function load_candidate_dropdown() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_cv_management', array('requisition_id' => $id,'status' => 0));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->candidate_first_name . "</option>";
            }
        } else {
            echo"<option> No Candidate Added </option>";
        }
    }
    
    public function load_candidate_status() {
        $id = $this->uri->segment(3);
        //$query = $this->db->get_where('main_cv_management', array('requisition_id' => $id));
        $candidate_status = $this->Common_model->get_array('candidate_status');
        if ($id == 0) {
            print"<option></option>";
            foreach ($candidate_status as $key=> $val) {
                if($key==1)
                {
                    print"<option value=" . $key . ">" . $val . "</option>";
                }
            }
        } else if($id == 3)
        {
            print"<option></option>";
            foreach ($candidate_status as $key=> $val) {
                if($key==2 || $key==5)
                {
                    print"<option value=" . $key . ">" . $val . "</option>";
                }
            } 
        } else if($id == 4)
        {
            print"<option></option>";
            foreach ($candidate_status as $key=> $val) {
                if($key==6)
                {
                    print"<option value=" . $key . ">" . $val . "</option>";
                }
            } 
        }else {
            echo"<option> No Candidate Added </option>";
        }
    }
    
}

