<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chome extends CI_Controller {

    public $menu_id;
    public $mod_id;
    public $opration_id;
    public $user_data = array();
    public $user_id = null;
    public $user_type = null;
    public $user_module = null;
    public $date_time = null;
    public $company_id = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");
        $this->company_id = $this->user_data['company_id'];
        
        $this->load->model('Sendmail_model');
    }

    public function index() {
        //echo $this->user_id;
        //print_r($_COOKIE);
        //echo $this->Hr_login->logout();
        
        //echo CI_VERSION;
        //echo CI_VERSION;

        //if ($this->user_id) {
            //if ($this->hr_login->is_logged_in()) {
        if ($this->session->userdata('hr_logged_in')) {
            if ($this->user_type== 3) {
                redirect('Con_Admin_Dashbord/', 'refresh');
            } else {
                redirect('Con_dashbord/', 'refresh');
            }
        } else {
            //echo $this->Common_model->decrypt('Z5qlk5qY');
            //echo $this->Common_model->encrypt('123456');

            $param['topheader'] = 'uni_template/login_header.php';
            $param['title'] = 'HRM';
            $param['content'] = 'uni_template/main_content.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';
            $this->load->view('admin/home', $param);
        }
    }

    public function check_login() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() === FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $user_data = $this->session->userdata('hr_logged_in');
            $user_type = $user_data ['usertype'];
            $user_module = $user_data ['user_module'];
            $user_group = $user_data ['user_group'];

            if ($user_type == 1 || $user_type == 2 || $user_type == 3 || $user_type == 4) {
                
                if ($user_type == 3) {
                    $module_link = "Con_Admin_Dashbord";
                } else {
                    $user_module = explode(',', $user_module);
                    $module_link = $this->Common_model->get_selected_value($this, 'id', $user_module[0], 'main_module', 'module_link');
                }

                echo "1" . "__" . $module_link;

                //echo $user_module;
                /* if ($user_type == 1) {//1 for user
                  $param['content'] = 'sadmin/ticket.php';
                  $this->load->view('admin/home', $param);
                  } elseif ($user_type == 2) {//2 for bus owner
                  $param['content'] = 'sadmin/ticket.php';
                  $this->load->view('admin/home', $param);
                  } elseif ($user_type == 3) {//3 for sadmin
                  //$param['content'] = 'sadmin/home.php';
                  $param['left_menu_content'] = "Dashbord Page Left Menu Content";
                  $param['left_menu'] = 'sadmin/dashbord_leftmenu.php';
                  $param['content'] = 'sadmin/hrm_dashbord.php';
                  $this->load->view('admin/home', $param);
                  } */
            } else {
                echo "2" . "__" . $this->Common_model->show_massege('Please Check Username or Password', 1);
            }
        }
    }

    function check_database($password) {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        $password = $this->input->post("password");
        $result = $this->Hr_login->get_user($username, $password);

        if ($result) {
            //echo $result[0]->user_group;
            $result_menu = $this->Common_model->get_selected_row('main_roles_privileges', array('user_group_id' => $result[0]->user_group));
            if ($result_menu) {
                foreach ($result_menu->result() as $key) {
                    $this->menu_id = $key->menu_id;
                    $this->opration_id = $key->opration_id;
                    $this->mod_id = $key->module_id;
                }
            }

            $session_array = array(
                'id' => $result[0]->id,
                'company_id' => $result[0]->company_id,
                'username' => $result[0]->email,
                'name' => $result[0]->name,
                'usertype' => $result[0]->user_type,
                'user_group' => $result[0]->user_group,
                'user_image' => $result[0]->user_image,
                'parent_user' => $result[0]->parent_user,
                'candidate_id' => $result[0]->candidate_id,
                'user_menu' => $this->menu_id,
                'user_module' => $this->mod_id,
                'user_opration' => $this->opration_id
            );

            $this->session->set_userdata('hr_logged_in', $session_array);
            
            //$this->session->mark_as_temp('hr_logged_in', 300);
//            $login_data = array('user_id' => $result[0]->id,
//                'user_name' => $result[0]->email,
//                'lan_ip' => $this->Common_model->get_client_ip(),
//                'lan_mac' => '',
//                'wan_ip' => '',
//                'login_time' => date("H:i:s"),
//                'login_date' => date("Y-m-d"),
//                'logout_time' => '',
//                'logout_date' => '',
//                'login_status' => '1',
//            );
//            $login_history_res = $this->Common_model->insert_data('login_history', $login_data);

            return TRUE;
        } else {
            $session_array = array(
                'log_status' => '1',
            );
            $this->session->set_userdata('hr_logged_st', $session_array);
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    public function logout() {
        $this->Hr_login->logout();
    }

    public function Clear_DB() {
        //password : DBdestroy2017
        // isset($this->input->post('security_code'))
        if ($this->input->post('security_code')) {
            Clear_Database($this, $this->input->post('security_code'));
        } else {
            echo '<form method="post" action="' . base_url() . 'Chome/Clear_DB">
                    <input type="password" name="security_code" autocomplete="off" />&nbsp;
                    <input type="submit" value="GO" onsubmit="return confirm("Are you Sure??")"/>
                </form>';
        }
    }

    public function is_logged_in() {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $user_data = $this->session->userdata('hr_logged_in');
        $user_id = $user_data ['id'];

        if (!isset($user_id) || $user_id !== TRUE || $user_id == "") {
            //echo "sssssssdddddd";exit();
            redirect('Chome/');
        } else {
            $this->dashbord();
        }
    }
    
    public function change_password() {
         
        $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]|alpha_numeric', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $data = array(
                'password' => $this->Common_model->encrypt($this->input->post('password')),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );
            //pr($data,1);
            $res = $this->Common_model->update_data('main_users', $data, array('id' => $this->user_id));
           
            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }
    
    public function mail_settings() {

        if ($this->input->post('company_id') == "") {

            $this->form_validation->set_rules('useremail', 'User Name', 'required|valid_email|is_unique[main_mail_settings.useremail]', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('smtp_server', 'SMTP Server', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('port', 'Port', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {

                $data = array('company_id' => $this->company_id,
                    'useremail' => $this->input->post('useremail'),
                    //'password' => $this->Common_model->encrypt($this->input->post('password')),
                    'password' => $this->input->post('password'),
                    'smtp_server' => $this->input->post('smtp_server'),
                    'secure_transport_layer' => $this->input->post('secure_transport_layer'),
                    'port' => $this->input->post('port'),
                    'createdby' => $this->user_id,
                    'createddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->insert_data('main_mail_settings', $data);

                if ($res) {
                    echo $this->Common_model->show_massege(0, 1);
                } else {
                    echo $this->Common_model->show_massege(1, 2);
                }
            }
        } else {

            $this->form_validation->set_rules('useremail', 'User Name', 'required|valid_email', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('password', 'User Password', 'required|max_length[15]|min_length[5]', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('smtp_server', 'SMTP Server', 'required', array('required' => "Please the enter required field, for more Info : %s."));
            $this->form_validation->set_rules('port', 'Port', 'required', array('required' => "Please the enter required field, for more Info : %s."));

            if ($this->form_validation->run() == FALSE) {
                echo $this->Common_model->show_validation_massege(validation_errors(), 2);
            } else {

                $data = array(
                    'useremail' => $this->input->post('useremail'),
                    //'password' => $this->Common_model->encrypt($this->input->post('password')),
                    'password' => $this->input->post('password'),
                    'smtp_server' => $this->input->post('smtp_server'),
                    'secure_transport_layer' => $this->input->post('secure_transport_layer'),
                    'port' => $this->input->post('port'),
                    'modifiedby' => $this->user_id,
                    'modifieddate' => $this->date_time,
                    'isactive' => '1',
                );

                $res = $this->Common_model->update_data('main_mail_settings', $data, array('company_id' => $this->input->post('company_id')));

                if ($res) {
                    echo $this->Common_model->show_massege(2, 1);
                } else {
                    echo $this->Common_model->show_massege(3, 2);
                }
            }
        }
    }

    public function ajax_edit_mail_settings() {
        $this->db->from('main_mail_settings');
        $this->db->where('company_id', $this->company_id);
        $query = $this->db->get();
        $data= $query->row();
        echo json_encode($data);
    }
    
    public function forgot_password() {
        
        if ($this->session->userdata('hr_logged_in')) {
            redirect('Con_dashbord/', 'refresh');
        } else {
            //echo $this->Common_model->decrypt('Z5qlk5qY');
            //echo $this->Common_model->encrypt('123456');

            $param['topheader'] = 'uni_template/login_header.php';
            $param['title'] = 'HRM';
            $param['content'] = 'uni_template/forgot_password.php';
            $param['lastfooter'] = 'uni_template/login_footer.php';
            $this->load->view('admin/home', $param);
        }
    }
    
    public function generate_forgot_password() {

        $this->form_validation->set_rules('useremail', 'Email', 'trim|required|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {

            $query = $this->db->get_where('main_users', array('email' => $this->input->post('useremail')))->row();
            
            if (!empty($query)) {
                $password = $this->Common_model->decrypt($query->password);
                
                $res = $this->Sendmail_model->forgot_password_mail($query->name,$this->input->post('useremail'),$password);
                
                if($res) {
                    echo $this->Common_model->show_validation_massege('Please check your email.', 2);
                } else {
                    echo $this->Common_model->show_validation_massege('Email not send.', 2);
                }
            } else {
                echo $this->Common_model->show_validation_massege('This email is not user.', 2);
            }
        }
    }

}
