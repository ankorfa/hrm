<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_Subscription_Settings extends CI_Controller {

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
        $param['page_header'] = "Subscription Settings";
        $param['module_id'] = $this->module_id;
        
        $this->db->select('com.id as com_id,usr.id as usr_id,com.email as company_email,com.*, usr.*');
        $this->db->from('main_company as com');
        $this->db->join('main_users as usr', 'com.company_user_id = usr.id');
        //$this->db->where('ew.department', $id);
        $param['query'] = $this->db->get();
        //echo $this->db->last_query();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_Subscription_Settings.php';
        $this->load->view('admin/home', $param);
    }    

     function edit_Subscription_Settings() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $com_id = $this->uri->segment(3);
        $usr_id = $this->uri->segment(4);

        $param['type'] = "2";
        $param['page_header'] = "Subscription Settings";
        $param['module_id'] = $this->module_id;

        $param['com_query'] = $this->db->get_where('main_company', array('id' => $com_id));
        $param['users_query'] = $this->db->get_where('main_users', array('id' => $usr_id));
        $param['subs_query'] = $this->db->get_where('main_subscription_settings', array('company_id' => $com_id));

        $ignore = array(12);
        $this->db->where_in('id', $ignore);
        $param['main_usergroup_query'] = $this->db->get_where('main_usergroup', array());
            
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addSubscription_Settings.php';
        $this->load->view('admin/home', $param);
    }
    
    public function edit_Subscription_data() {
        $this->form_validation->set_rules('name', 'User Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        //$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]',array('required'=> "Password Not matches, for more Info : %s."));
        $this->form_validation->set_rules('company_name', 'Company Name', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('company_email', 'Company Email', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $user_data = array('name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->Common_model->encrypt($this->input->post('password')),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            $ures = $this->Common_model->update_data('main_users', $user_data, array('id' => $this->input->post('id')));

            $company_data = array('company_full_name' => $this->input->post('company_name'),
                'email' => $this->input->post('company_email'),
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('company_state'),
                'zip_code' => $this->input->post('zip_code'),
                'mobile_phone' => $this->input->post('mobile_phone'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            $cres = $this->Common_model->update_data('main_company', $company_data, array('id' => $this->input->post('com_id')));

            $com_query = $this->db->get_where('main_subscription_settings', array('company_id' => $this->input->post('com_id')));
            if ($com_query->num_rows() > 0) {//update
                if ($this->input->post('welcome_email')) {
                    $welcome_email = $this->input->post('welcome_email');
                } else {
                    $welcome_email = 0;
                }
                if ($this->input->post('newslatter')) {
                    $newslatter = $this->input->post('newslatter');
                } else {
                    $newslatter = 0;
                }
                if ($this->input->post('library_promo')) {
                    $library_promo = $this->input->post('library_promo');
                } else {
                    $library_promo = 0;
                }
                if ($this->input->post('alerts')) {
                    $alerts = $this->input->post('alerts');
                } else {
                    $alerts = 0;
                }
                if ($this->input->post('ebooks')) {
                    $ebooks = $this->input->post('ebooks');
                } else {
                    $ebooks = 0;
                }
                $subscription_data = array('company_id' => $this->input->post('com_id'),
                    'welcome_email' => $welcome_email,
                    'newslatter' => $newslatter,
                    'library_promo' => $library_promo,
                    'alerts' => $alerts,
                    'ebooks' => $ebooks,
                    'start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('start_date')),
                    'end_date' => $this->Common_model->convert_to_mysql_date($this->input->post('end_date')),
                    'user_group' => $this->input->post('user_group'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );
                $subres = $this->Common_model->update_data('main_subscription_settings', $subscription_data, array('company_id' => $this->input->post('com_id')));
            } else {//Insert
                
                if ($this->input->post('welcome_email')) {
                    $welcome_email = $this->input->post('welcome_email');
                } else {
                    $welcome_email = 0;
                }
                if ($this->input->post('newslatter')) {
                    $newslatter = $this->input->post('newslatter');
                } else {
                    $newslatter = 0;
                }
                if ($this->input->post('library_promo')) {
                    $library_promo = $this->input->post('library_promo');
                } else {
                    $library_promo = 0;
                }
                if ($this->input->post('alerts')) {
                    $alerts = $this->input->post('alerts');
                } else {
                    $alerts = 0;
                }
                if ($this->input->post('ebooks')) {
                    $ebooks = $this->input->post('ebooks');
                } else {
                    $ebooks = 0;
                }

                $subscription_insert_data = array('company_id' => $this->input->post('com_id'),
                    'welcome_email' => $welcome_email,
                    'newslatter' => $newslatter,
                    'library_promo' => $library_promo,
                    'alerts' => $alerts,
                    'ebooks' => $ebooks,
                    'start_date' => $this->Common_model->convert_to_mysql_date($this->input->post('start_date')),
                    'end_date' => $this->Common_model->convert_to_mysql_date($this->input->post('end_date')),
                    'user_group' => $this->input->post('user_group'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );
                $subres = $this->Common_model->insert_data('main_subscription_settings', $subscription_insert_data);
            }

            if ($ures && $cres && $subres) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

}
