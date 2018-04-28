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
        $param['page_header'] = "Openings Positions";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['query'] = $this->db->get_where('main_opening_position', array('company_id' => $this->company_id,'isactive' => 1));
        } else {
            $param['query'] = $this->db->get_where('main_opening_position', array('isactive' => 1));
        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_OpeningsPositions.php';
        $this->load->view('admin/home', $param);
    }

    public function add_openings_positions() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['type'] = "1";
        $param['page_header'] = "Openings Positions";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['location_query'] = $this->db->get_where('main_location', array('company_id' => $this->company_id));
            $param['department_query'] = $this->db->get_where('main_department', array('company_id' => $this->company_id));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id));
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $param['employmentstatus_query'] = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id));
        } else {
            $param['location_query'] = $this->Common_model->listItem('main_location');
            $param['department_query'] = $this->Common_model->listItem('main_department');
            $param['positions_query'] = $this->Common_model->listItem('main_positions');
            $param['employees_query'] = $this->Common_model->listItem('main_employees');
            $param['employmentstatus_query'] = $this->Common_model->listItem('main_employmentstatus');
        }
        $param['priority_array'] = $this->Common_model->get_array('priority');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addOpeningsPositions.php';
        $this->load->view('admin/home', $param);
    }

    public function save_openings_positions() {
        $this->form_validation->set_rules('requisition_code', 'Requisition Code Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('due_date', 'Due Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('department_id', 'Department', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('requisitions_date', 'Requisition Date', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('position_id', 'Position', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('no_of_positions', 'No Of Positions', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('required_skills', 'Required Skills', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'requisition_code' => $this->input->post('requisition_code'),
                'due_date' => $this->Common_model->convert_to_mysql_date($this->input->post('due_date')),
                'location_id' => $this->input->post('location_id'),
                'department_id' => $this->input->post('department_id'),
                'requisitions_date' => $this->Common_model->convert_to_mysql_date($this->input->post('requisitions_date')),
                'position_id' => $this->input->post('position_id'),
                'reporting_manager_id' => $this->input->post('reporting_manager_id'),
                'no_of_positions' => $this->input->post('no_of_positions'),
                'job_description' => $this->input->post('job_description'),
                'required_skills' => $this->input->post('required_skills'),
                'additional_information' => $this->input->post('additional_information'),
                'required_qualification' => $this->input->post('required_qualification'),
                'experience_range' => $this->input->post('experience_range'),
                'employment_status_id' => $this->input->post('employment_status_id'),
                'priority' => $this->input->post('priority'),
                'approver_id' => $this->input->post('approver_id'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->insert_data('main_opening_position', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_openings_positions() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Openings Positions";
        $param['module_id'] = $this->module_id;

        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['location_query'] = $this->db->get_where('main_location', array('company_id' => $this->company_id));
            $param['department_query'] = $this->db->get_where('main_department', array('company_id' => $this->company_id));
            $param['positions_query'] = $this->db->get_where('main_positions', array('company_id' => $this->company_id));
            $param['employees_query'] = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $param['employmentstatus_query'] = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id));
        } else {
            $param['location_query'] = $this->Common_model->listItem('main_location');
            $param['department_query'] = $this->Common_model->listItem('main_department');
            $param['positions_query'] = $this->Common_model->listItem('main_positions');
            $param['employees_query'] = $this->Common_model->listItem('main_employees');
            $param['employmentstatus_query'] = $this->Common_model->listItem('main_employmentstatus');
        }

        $param['priority_array'] = $this->Common_model->get_array('priority');
        $param['OpeningsPositions_query'] = $this->db->get_where('main_opening_position', array('id' => $id));

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addOpeningsPositions.php';
        $this->load->view('admin/home', $param);
    }

    public function update_openings_positions() {
        $this->form_validation->set_rules('requisition_code', 'Requisition Code Type', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $data = array('company_id' => $this->company_id,
                'requisition_code' => $this->input->post('requisition_code'),
                'due_date' => $this->Common_model->convert_to_mysql_date($this->input->post('due_date')),
                'location_id' => $this->input->post('location_id'),
                'department_id' => $this->input->post('department_id'),
                'requisitions_date' => $this->Common_model->convert_to_mysql_date($this->input->post('requisitions_date')),
                'position_id' => $this->input->post('position_id'),
                'reporting_manager_id' => $this->input->post('reporting_manager_id'),
                'no_of_positions' => $this->input->post('no_of_positions'),
                'job_description' => $this->input->post('job_description'),
                'required_skills' => $this->input->post('required_skills'),
                'additional_information' => $this->input->post('additional_information'),
                'required_qualification' => $this->input->post('required_qualification'),
                'experience_range' => $this->input->post('experience_range'),
                'employment_status_id' => $this->input->post('employment_status_id'),
                'priority' => $this->input->post('priority'),
                'approver_id' => $this->input->post('approver_id'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_opening_position', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_OpeningsPositions() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_opening_position", $id);
        redirect('Con_OpeningsPositions/');
        exit;
    }

}
