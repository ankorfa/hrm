<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Requisitions_Approval extends CI_Controller {

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
        $param['page_header'] = "Requisitions Approval";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
//            $reqs=array('0','2','4');
//            //$reqs_arr = explode(",", $reqs);
//            $reqst_arr = array_map('intval', $reqs);
//            $this->db->where_in('req_status',$reqst_arr);
            $this->db->where("req_status !=",1);
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id));
            //echo $this->db->last_query();
        } else {
            $this->db->where("req_status !=",1);
            $param['query'] = $this->db->get_where('main_opening_position', array());
            
            //$param['query'] =  $this->db->query("SELECT * FROM main_opening_position  WHERE req_status IN ('0') ");           
        }
        
        //echo $this->db->last_query();
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Requisitions_Approval.php';
        $this->load->view('admin/home', $param);
    }

     public function update_req_Status() {
         
        $this->form_validation->set_rules('req_status', 'Approver', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('approver_id[]', 'Action Button', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $approver_id = $this->input->post("approver_id");
            for ($i = 0; $i < count($approver_id); $i++) {

                $data[] = array('id' => $approver_id[$i],
                    'req_status' => $this->input->post('req_status'),                                       
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
    
    public function view_requisition() {
        
        $req_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Job Requisition Detail";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$req_id ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $req_id ));            
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_JobRequisitionDetail.php';
        $this->load->view('admin/home', $param);
    }
    
    
    
    public function update_sing_req_Status() {

        $this->form_validation->set_rules('sing_req_status', 'Status', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('req_status' => $this->input->post('sing_req_status'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_opening_position', $data, array('id' => $this->input->post('requisition_id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

}
