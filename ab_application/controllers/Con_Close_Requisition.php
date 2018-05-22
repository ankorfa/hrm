<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Close_Requisition extends CI_Controller {

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
        $param['page_header'] = "Close Requisition";
        $param['module_id'] = $this->module_id;

        $this->db->where('req_status !=', 0);
        $this->db->where('is_close', 0);
        
        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('isactive' => 1));
        }
        //echo $this->db->last_query();
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_Close_Requisition.php';
        $this->load->view('admin/home', $param);
    }

    
    public function view_requisition() {
        
        $req_id=$this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['page_header'] = "Close Requisition";
        $param['module_id'] = $this->module_id;
        $param['req_id'] = $req_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'id' =>$req_id,'is_close' => 0 ));            
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('id' => $req_id,'is_close' => 0 ));            
        }
        
        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_CloseRequisitionDetail.php';
        $this->load->view('admin/home', $param);
    }
    
    
    
    public function update_Close_Requisition() {
        
        $this->form_validation->set_rules('requisition_id', 'requisition id', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
      
            $this->db->trans_begin();

            $data = array('is_close' => 1,
                'close_by' => $this->user_id,
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                //'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_opening_position', $data, array('id' => $this->input->post('requisition_id')));
            
            $cdata = array('is_close' => 1,
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                //'isactive' => '1',
            );
            
            $res = $this->Common_model->update_data('main_cv_management', $cdata, array('requisition_id' => $this->input->post('requisition_id')));
            $res = $this->Common_model->update_data('main_schedule', $cdata, array('requisition_id' => $this->input->post('requisition_id')));
            $res = $this->Common_model->update_data('main_interview_schedule', $cdata, array('requisition_id' => $this->input->post('requisition_id')));
            $res = $this->Common_model->update_data('main_candidate_interview', $cdata, array('requisition_id' => $this->input->post('requisition_id')));

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function multiple_Close_Requisition() {
         
        $this->form_validation->set_rules('requisition_id[]', 'requisition id', 'required',array('required'=> "Please the enter required field, for more Info : %s."));
       
       if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $this->db->trans_begin();
            
            $requisition_id = $this->input->post("requisition_id");
            for ($i = 0; $i < count($requisition_id); $i++) {

                $data[] = array('id' => $requisition_id[$i],
                    'is_close' => 1,                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    //'isactive' => '1',
                ); 
                
                $rdata[] = array('requisition_id' => $requisition_id[$i],
                    'is_close' => 1,                                       
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    //'isactive' => '1',
                );      
                
            }
            
            $res = $this->db->update_batch('main_opening_position', $data, 'id');
            
            $res = $this->db->update_batch('main_cv_management', $rdata, 'requisition_id');
            $res = $this->db->update_batch('main_schedule', $rdata, 'requisition_id');
            $res = $this->db->update_batch('main_interview_schedule', $rdata, 'requisition_id');
            $res = $this->db->update_batch('main_candidate_interview', $rdata, 'requisition_id');
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $flag = 0;
            } else {
                $this->db->trans_commit();
                $flag = 1;
            }
            
            if ($flag) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }


}
