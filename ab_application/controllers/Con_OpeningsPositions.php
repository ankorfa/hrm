<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_OpeningsPositions extends CI_Controller {

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
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Job Positing";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
//            $reqs=array('0','2','4');
//            //$reqs_arr = explode(",", $reqs);
//            $reqst_arr = array_map('intval', $reqs);
//            $this->db->where_in('req_status',$reqst_arr);
            
            //date("Y-m-d")<due_date;
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'req_status'=>1,'due_date > '=>date("Y-m-d")));
            //echo $this->db->last_query();
        } else {
            //$param['query'] =  $this->db->query("SELECT * FROM main_opening_position  WHERE req_status IN ('1') ");   
            $param['query'] = $this->db->get_where('main_opening_position', array('req_status'=>1,'due_date > '=>date("Y-m-d")));
        }
        //echo $this->db->last_query();
        
        $param['opening_status'] = $this->Common_model->get_array('opening_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_OpeningsPositions.php';
        $this->load->view('admin/home', $param);
    }

    public function update_op_Status() {
        $this->form_validation->set_rules('op_status', 'Opening Position Status', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('open_position_date', 'Open Position Date', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id[]', 'Action Button', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $approver_id = $this->input->post("approver_id");
            for ($i = 0; $i < count($approver_id); $i++) {

                $data[] = array('id' => $approver_id[$i],
                    'op_status' => $this->input->post('op_status'),
                    'open_position_date' => $this->Common_model->convert_to_mysql_date($this->input->post('open_position_date')),                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );                
                $res = $this->db->update_batch('main_opening_position', $data, 'id');
            } 
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function view_opening_position() {
        
        $opn_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

//        $param['type'] = "1";
        $param['page_header'] = "Open Positions";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$opn_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $opn_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobOpeningPositionDetail.php';
        $this->load->view('admin/home', $param);
    }

    public function view_job_posting() {
        
        $opn_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

//      $param['type'] = "1";
        $param['page_header'] = "Job Positing";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$opn_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $opn_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobPosting.php';
        $this->load->view('admin/home', $param);
    }
    
    public function add_CVManagement() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type'] = "1";
        $param['page_header'] = "Open Positions";
        $param['module_id']=$this->module_id;
        
        $param['req_id']= $this->uri->segment(3);
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'company_id' => $this->company_id)); //Approved
        } else {
           $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved
        }
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addPositionsCV.php';
        $this->load->view('admin/home', $param);
    }
}
