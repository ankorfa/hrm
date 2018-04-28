<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_AssetsInformation extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
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
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        if ($this->user_type == 2) {
            $this->company_id = $this->company_id;
        } else {
            $this->company_id = "";
        }

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Assets Information";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_AssetsInformation.php';
        $this->load->view('admin/home', $param);
    }

    public function add_AssetsInformation() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $param['type'] = "1";
        $param['page_header'] = "Assets Information";
        $param['module_id'] = $this->module_id;
        $param['asset_type'] = $this->db->get('main_assets_type');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAssetsInformation.php';
        $this->load->view('admin/home', $param);
    }

    public function save_AssetsInformation() {

        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required');
        $this->form_validation->set_rules('asset_category_id', 'asset category id', 'required');
        $this->form_validation->set_rules('asset_name_id', 'Asset Name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_massege(validation_errors(), 2);
        } else {
            $date=date("Y-m");
            $asset_name_id=$date.'-'.$this->input->post('asset_type_id').'-'.$this->input->post('asset_category_id').'-'.$this->input->post('asset_name_id');
            
            $model_name = $this->input->post('model_name');
            $serial_no = $this->input->post('serial_no');
            $value = $this->input->post('value');
            $description = $this->input->post('description');

            $data = array();
            for($i=0;$i < count($model_name);$i++){
//                $a=$i+1;
//                 $this->form_validation->set_rules('model_name_$a', 'Asset Model', 'required');
//                if ($this->form_validation->run() == FALSE) {
//                echo $this->Common_model->show_massege(validation_errors(), 2);
//                } else {

                $data[$i] = array(
                    'asset_type_id' => $this->input->post('asset_type_id'),
                    'asset_category_id' => $this->input->post('asset_category_id'),
                    'asset_name_id' => $this->input->post('asset_name_id'),
                    'quantity' => $this->input->post('quantity'),
                    'asset_id' => $asset_name_id . '-' . $serial_no[$i],
                    'model_name' => $model_name[$i],
                    'serial_no' => $serial_no[$i],
                    'value' => $value[$i],
                    'description' => $description[$i],
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
                
//                }
            }
            //print_r($data);
            $res = $this->db->insert_batch('main_assets', $data);

            if ($res) {
                echo $this->Common_model->show_massege('Data Insert Successful.', 1);
            } else {
                echo $this->Common_model->show_massege('Data Insert Not Successful.', 2);
            }
        }
    }

    public function edit_AssetsInformation() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "2";
        $param['page_header'] = "Assets Information";
        $param['module_id'] = $this->module_id;

        $this->db->where(array('asset_name_id' => $id));
        $this->db->group_by('asset_name_id','asset_type_id','asset_category_id','asset_name_id','quantity');
        $param['query'] = $this->db->get('main_assets');
        
        $param['asset_type'] = $this->db->get('main_assets_type');
        $param['asset_category'] = $this->db->get('main_assets_category');
        $param['asset_name'] = $this->db->get('main_assets_name');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAssetsInformation.php';
        $this->load->view('admin/home', $param);
    }
    

    public function update_AssetsInformation() {

        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required');
        $this->form_validation->set_rules('asset_category_id', 'asset category id', 'required');
        $this->form_validation->set_rules('asset_name_id', 'Asset Name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_massege(validation_errors(), 2);
        } else {
             $date=date("Y-m");
//            $asset_name_id=$date.'-'.$this->input->post('asset_type_id').'-'.$this->input->post('asset_category_id').'-'.$this->input->post('asset_name_id');
            
            $model_name = $this->input->post('model_name');
            $serial_no = $this->input->post('serial_no');
            $value = $this->input->post('value');
            $description = $this->input->post('description');
            $asset_id = $this->input->post('asset_id');
            $id = $this->input->post('id');
            
//            $asset_delete_id=$this->input->post('asset_name_id');
//            $this->db->where('asset_name_id', $asset_delete_id);
//            $this->db->delete('main_assets');

//            print_r($asset_id);
//            exit();
            
            $data = array();
            for($i=0;$i < count($model_name);$i++){
                $data[$i] = array(
                    'id' => $id[$i],
                    'asset_type_id' => $this->input->post('asset_type_id'),
                    'asset_category_id' => $this->input->post('asset_category_id'),
                    'asset_name_id' => $this->input->post('asset_name_id'),
                    'quantity' => $this->input->post('quantity'),
                    'asset_id' => $asset_id[$i],
//                    'asset_id' => $asset_name_id . '-' . $serial_no[$i],
                    'model_name' => $model_name[$i],
                    'serial_no' => $serial_no[$i],
                    'value' => $value[$i],
                    'description' => $description[$i],
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
                
                
            }
            //print_r($data);
            
//            $res = $this->db->insert_batch('main_assets', $data);
            $res = $this->db->update_batch('main_assets', $data, 'id'); 

            if ($res) {
                echo $this->Common_model->show_massege('This Post Edited Successfully.', 1);
            } else {
                echo $this->Common_model->show_massege('No Change found to update entry!', 2);
            }
        }
    }

    public function load_asset_category() {

        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_category', array('asset_type_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_category . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }

    public function load_asset_name() {
        
        $id = $this->uri->segment(3);
        $query = $this->db->get_where('main_assets_name', array('asset_category_id' => $id));
        if ($query->num_rows() > 0) {
            print"<option></option>";
            foreach ($query->result() as $row) {
                print"<option value=" . $row->id . ">" . $row->asset_name . "</option>";
            }
        } else {
            echo"<option> No Plan added </option>";
        }
    }
    
    public function asset_name_find($id) {
        $asset_name = $this->Common_model->get_name($this, $id, ' main_assets_name', 'asset_name');
        if ($asset_name) {
            echo $asset_name;
        } else {
            echo'No Name Found';
        }
    }
    
    public function edit_AssetsUniqueInformation() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);

        $param['type'] = "3";
        $param['page_header'] = "Assets Information";
        $param['module_id'] = $this->module_id;

        $this->db->where(array('id' => $id));
        $param['query'] = $this->db->get('main_assets');
        
        $param['asset_type'] = $this->db->get('main_assets_type');
        $param['asset_category'] = $this->db->get('main_assets_category');
        $param['asset_name'] = $this->db->get('main_assets_name');

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addAssetsInformation.php';
        $this->load->view('admin/home', $param);
    }
    
    public function update_AssetsUniqueInformation() {
        $this->form_validation->set_rules('asset_type_id', 'Asset Type', 'required');
        $this->form_validation->set_rules('asset_category_id', 'asset category id', 'required');
        $this->form_validation->set_rules('asset_name_id', 'Asset Name', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_massege(validation_errors(),2);
        } else {
            $data = array(
                    'asset_type_id' => $this->input->post('asset_type_id'),
                    'asset_category_id' => $this->input->post('asset_category_id'),
                    'asset_name_id' => $this->input->post('asset_name_id'),
                    'quantity' => $this->input->post('quantity'),
                    'asset_id' => $this->input->post('asset_id'),
                    'model_name' =>$this->input->post('model_name'),
                    'serial_no' => $this->input->post('serial_no'),
                    'value' => $this->input->post('value'),
                    'description' => $this->input->post('description'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_assets', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege('This Post Edited Successfully',1);
            } else {
                echo $this->Common_model->show_massege('No Change found to update entry!',2);
            }
        }
    }

    public function delete_AssetsInformation() {
        echo $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_assets", $id);
        redirect('con_AssetsInformation/');
        exit;
    }

}
