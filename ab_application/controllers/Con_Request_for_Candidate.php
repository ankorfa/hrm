<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Request_for_Candidate extends CI_Controller {

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
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->load->model('Sendmail_model');
    }

    public function index($menu_id=0, $show_result = FALSE, $search_ids = array(), $search_criteria = array('requisition_idd' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Request for Candidate";
        $param['module_id'] = $this->module_id;

        if (!empty($search_ids)) {
            $this->db->where_in('id', $search_ids);
        }
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
            $param['query'] = $this->db->get_where('main_cv_management', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_cv_management', array('isactive' => 1));
        }
        
        $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Request_for_Candidate.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_Candidate() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_id'] = $requisition_id = $this->input->post('requisition_idd');

        if (($requisition_id != '')) {
     
            $this->db->select('id');
            $this->db->from('main_cv_management');
            $this->db->where('status', 0);
            
            if ($this->user_group == 11 || $this->user_group == 12) {
                $this->db->where('company_id', $this->company_id);
            } else {
                $this->db->where('createdby', $this->user_id);
            }

            /* ----Conditions---- */
            if ($requisition_id != '') {
                $this->db->where('requisition_id', $requisition_id);
            }
           
            $ids = $this->db->get()->result_array();
            
        }

        $ids = array_column($ids, 'id');

        $this->index($this->uri->segment(3), TRUE, $ids, $search_criteria);
        
    }
    
    public function save_Request_for_Candidate() {
        
        $this->form_validation->set_rules('candidate_id[]', 'Candidate','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('requisition_id', 'Requisition ID','required',array('required'=> "Please the enter required field, for more Info : %s."));
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            
            $this->db->trans_begin();
            
            $schedule_chk_query = $this->db->get_where('main_schedule', array('requisition_id' => $this->input->post('requisition_id'),'isactive' => 1));
            //echo $this->db->last_query();
            if ($schedule_chk_query->num_rows()== 0) {
                echo $this->Common_model->show_validation_massege('Schedule Not Created.', 2);
                exit();
            }
            
            $schedule_query = $this->db->get_where('main_schedule', array('requisition_id' => $this->input->post('requisition_id'),'isactive' => 1))->row();
           
            $candidate_id = $this->input->post("candidate_id");
            
            for ($i = 0; $i < count($candidate_id); $i++) {
                $data[] = array('company_id' => $this->company_id,
                    'requisition_id' => $this->input->post('requisition_id'),
                    'schedule_id' => $schedule_query->id,
                    'candidate_name' => $candidate_id[$i],
                    //'interview_status' => $this->input->post('interview_status'),
                    'interviewer' => $schedule_query->interviewer,
                    'location' => $schedule_query->location,
                    'interview_type' => $schedule_query->interview_type,
                    'interview_date' => $schedule_query->interview_date,
                    'interview_time' => $schedule_query->interview_time,
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
                
                $udata[] = array('id' => $candidate_id[$i],
                    'status' => 1,                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );      
            }
            
            $res = $this->db->insert_batch('main_interview_schedule', $data); 
            
            $res = $this->db->update_batch('main_cv_management', $udata, 'id');
            
            
            foreach ($candidate_id as $key => $val) {
                $candidate = $this->db->get_where('main_cv_management', array('id' => $val))->row();
                $interview_date=$this->Common_model->convert_to_mysql_date($schedule_query->interview_date);
                if ($candidate->candidate_email != "") {
                    $eres = $this->Sendmail_model->CandidateScheduled_mail($candidate->candidate_first_name, $candidate->candidate_email, $interview_date,$schedule_query->interview_time,$this->input->post('requisition_id'));
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
         
    }
    


}
