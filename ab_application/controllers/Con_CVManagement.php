<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_CVManagement extends CI_Controller {

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

    public function index($menu_id=0, $show_result = FALSE, $search_ids = array(), $search_criteria = array('requisition_id' => '')) {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['show_result'] = $show_result;
        $param['search_ids'] = $search_ids;
        $param['search_criteria'] = $search_criteria;
            
        $param['menu_id']=$this->menu_id;
        $param['page_header'] = "Resume Explorer";
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
        
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_CVManagement.php';
        $this->load->view('admin/home', $param);
    }
    
    public function search_requisition() {
        
        $ids = $search_criteria = array();

        $search_criteria['requisition_id'] = $requisition_id = $this->input->post('requisition_id');

        if (($requisition_id != '')) {
     
            $this->db->select('id');
            $this->db->from('main_cv_management');
            
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
    
    public function add_CVManagement() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        
        $param['type'] = "1";
        $param['page_header'] = "CV Management";
        $param['module_id']=$this->module_id;
        
         if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'company_id' => $this->company_id)); //Approved
        } else {
           $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved
        }
        
        //echo $this->db->last_query();
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addCVManagement.php';
        $this->load->view('admin/home', $param);
    }
    
    public function upload_resume_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'candidate_resume';

        if ($status != "error") {
            $config['upload_path'] = './uploads/candidate_resume/';
            $config['allowed_types'] = 'doc|docx|txt|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;
            
            $newFileName = $_FILES[$file_element_name]['name'];
            $fileExt = explode(".", $newFileName);
            $filename = time().".".$fileExt[1];
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $file_path = $data['file_path'];
                $file_name = $data['file_name'];
                if (file_exists($file_path)) {
                    $status = "success";
                    $msg = "File Successfully uploaded";
                    //echo $this->Common_model->show_massege($_POST['employee_id'],2);
                } else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        
      if ($status == "success") {
            echo $this->Common_model->show_validation_massege($msg,1)."__".$file_name;
        } else {
            echo $this->Common_model->show_validation_massege($msg,2);
        }
        //echo json_encode(array('status' => $status, 'msg' => $msg));
        //echo $this->Common_model->show_massege($msg,2);
    }
    
    public function save_CVManagement() {
        
        $this->form_validation->set_rules('requisition_id', 'Requisition ID','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_first_name', 'Candidate First Name','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_last_name', 'Candidate Last Name','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_email', 'Email','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_number', 'Contact Number','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('qualification', 'Qualification','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('work_experience', 'Work Experience','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('skill_set', 'Skill Set','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('company_id' => $this->company_id,
                'requisition_id' => $this->input->post('requisition_id'),
                'status' => $this->input->post('candidate_status'),
                'candidate_first_name' => $this->input->post('candidate_first_name'),
                'candidate_last_name' => $this->input->post('candidate_last_name'),
                'candidate_email' => $this->input->post('candidate_email'),
                'contact_number' => $this->input->post('contact_number'),
                'qualification' => $this->input->post('qualification'),
                'work_experience' => $this->input->post('work_experience'),
                'skill_set' => $this->input->post('skill_set'),
                'education_summary' => $this->input->post('education_summary'),
                //'county_id' => $this->input->post('county_id'),
                'state' => $this->input->post('state'),
                'upload_resume_path' => $this->input->post('upload_resume_path'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->insert_data('main_cv_management',$data);
            
            $res = $this->Sendmail_model->candidate_mail($this->input->post('candidate_first_name'),$this->input->post('candidate_email'));
            
            if ($res) {
                echo $this->Common_model->show_massege(0,1);
            } else {
                echo $this->Common_model->show_massege(1,2);
            }
        }
         
    }
    
    function edit_CVManagement() {
        $this->Common_model->is_user_valid($this->user_id,$this->menu_id,$this->user_menu);
        $id = $this->uri->segment(3);
        
        $param['type']="2";
        $param['page_header']="CV Management";	
        $param['module_id']=$this->module_id;
        
        if ($this->user_group == 11 || $this->user_group == 12) {
            $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1,'company_id' => $this->company_id)); //Approved
        } else {
           $param['opening_position_query']=$this->db->get_where('main_opening_position', array('req_status' => 1)); //Approved
        }
        
        $param['approver_status'] = $this->Common_model->get_array('approver_status');
        $param['query'] = $this->db->get_where('main_cv_management', array('id' => $id));
        
	$param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'talentacquisition/view_addCVManagement.php';
        $this->load->view('admin/home', $param); 
    }
    
    public function update_CVManagement(){
        
        $this->form_validation->set_rules('requisition_id', 'Requisition ID','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_first_name', 'Candidate First Name','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_last_name', 'Candidate Last Name','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('candidate_email', 'Email','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('contact_number', 'Contact Number','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('qualification', 'Qualification','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('work_experience', 'Work Experience','required',array('required'=> "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('skill_set', 'Skill Set','required',array('required'=> "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(),2);
        } 
        else 
        {
            $data = array('company_id' => $this->company_id,
                'requisition_id' => $this->input->post('requisition_id'),
                'status' => $this->input->post('candidate_status'),
                'candidate_first_name' => $this->input->post('candidate_first_name'),
                'candidate_last_name' => $this->input->post('candidate_last_name'),
                'candidate_email' => $this->input->post('candidate_email'),
                'contact_number' => $this->input->post('contact_number'),
                'qualification' => $this->input->post('qualification'),
                'work_experience' => $this->input->post('work_experience'),
                'skill_set' => $this->input->post('skill_set'),
                'education_summary' => $this->input->post('education_summary'),
                //'county_id' => $this->input->post('county_id'),
                'state' => $this->input->post('state'),
                'upload_resume_path' => $this->input->post('upload_resume_path'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            
            $res=$this->Common_model->update_data('main_cv_management',$data,array('id' => $this->input->post('id')));
            
             if ($res) {
                echo $this->Common_model->show_massege(2,1);
            } else {
                echo $this->Common_model->show_massege(3,2);
            }
        }
         
    }
    
    public function delete_CVManagement() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_cv_management", $id);
        redirect('Con_CVManagement/');
        exit;
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
    
    public function load_county_name() {
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_county', array('state_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->county_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }
        
    
}

