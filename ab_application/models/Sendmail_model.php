<?php

class Sendmail_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }

    public function selfuser_send_mail($name,$to_email,$password) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $to_email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Self User'); 
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br> <h3>New sign-in from HRM</h3> <br> <br>  Hi ". $name ." , <br> You Create New HRM Account <br> <br> USER ID :  ". $to_email ." <br> PASSWORD : ". $password ."  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
         if($this->email->send()) 
            return TRUE; 
         else 
             return FALSE; 
      }
      
    public function ob_hired_send_mail($firstname,$socialsecuritynumber,$to_email,$date_of_joining) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $to_email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Confirmation Email'); 
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br> <h3>Welcome</h3> <br> <br>  Hi ". $firstname ." , <br><br> This letter is to confirmation. <br><br><br><br> "
                 . "Your joining Date :  ". $date_of_joining ." <br><br><br><br>  "
                 . " Best, <br> The HRM Development team. <br><br><br><br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
         if($this->email->send()) 
            return TRUE; 
         else 
             return FALSE; 
      }

    public function absence_notification_send_mail($first_name,$to_email,$from_datea,$to_datea,$absent_type) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $to_email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Confirmation Email'); 
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br>  Hi ". $first_name ." , <br><br> This letter is to absence notification email. <br><br><br>"
                 . "Form Date :  ". $from_datea ." <br>"
                 . "To Date :  ". $to_datea ." <br>"
                 . "Absence Type :  ". $absent_type ." <br><br>"
                 . " Best, <br> The HRM Development team. <br><br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
         if($this->email->send()) 
            return TRUE; 
         else 
             return FALSE; 
    }
      
    public function selected_candidate_send_mail($first_name,$to_email,$password) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $to_email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Confirmation Email'); 
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br>  Hi ". $first_name ." , <br><br> Congratulations , You are Selected . <br><br> Please Add Onboarding Information. <br><br> Your Onboarding User ID : ". $to_email ." <br><br> Your Onboarding Password : ". $password ."<br><br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
         if($this->email->send()) 
            return TRUE; 
         else 
             return FALSE; 
    }
    
    public function alert_send_mail($first_name,$to_email) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $to_email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Confirmation Email');
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br>  Hi ". $first_name ." , <br><br> this is for your kind notification.... <br><br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
        if($this->email->send()) 
           return TRUE; 
        else 
            return FALSE; 
    }
    
    public function user_welcome_mail($name,$email) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('User Welcome Email');
         
//         $info['logo']= base_url()."assets/img/5412.jpg";
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br>  Hi ". $name ." , <br><br> This is for your User Welcome Message.... <br><br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
        if($this->email->send()) 
           return TRUE; 
        else 
            return FALSE; 
    }
    
    public function training_send_mail($employee_id,$proposed_date) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#390626'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         
        $employees_idd = array_map('intval', $employee_id);
        $this->db->order_by("employee_id", "asc");
        $this->db->where_in('employee_id', $employees_idd);
        $employees_query = $this->db->get('main_employees');
        
        if ($employees_query) {
            foreach ($employees_query->result() as $row) {
                if($row->email!="")
                {
                    
                    $this->email->from("sohelbijay@gmail.com", 'Sohel'); 
                    $this->email->to($row->email);
                    $this->email->subject('Training Notification Email');
                    
                    $info['msg'] = " <br>  Hi ". $row->first_name ." , <br><br> This is for your Training Notification Message.... <br><br><br> Proposed Date :  ". $proposed_date ." <br><br><br> "
                        . " Best, <br> The HRM Development team. <br><br> ";
                    $body = $this->load->view('sadmin/compose.php',$info,TRUE);
                    $this->email->message($body); 
                    
                    $rese=$this->email->send();
                    
                }
            }
        }

        if($rese) //Send mail 
           return TRUE; 
        else 
            return FALSE; 
    }
    
     public function forgot_password_mail($username,$email,$password) { 
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#123456'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Forgot Password Email');
         
//         $info['logo']= base_url()."assets/img/5412.jpg";
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br>  Hi ". $username ." , <br><br> This is for your User Password.... <br><br><br> "
             . " Password : ". $password ."  <br><br> "
             . " Best, <br> The HRM Development team. <br><br> ";
         //return $info['msg'];exit();
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);

         $this->email->message($body); 

        //Send mail 
        if($this->email->send()) 
           return TRUE; 
        else 
           return FALSE; 
    }
    
    
    public function candidate_mail($name,$to_email) {  
        
        $config['useragent']    = 'CodeIgniter';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_user']    = 'sohelbijay@gmail.com'; // Your gmail id
        $config['smtp_pass']    = '622655#123456'; // Your gmail Password
        $config['smtp_port']    = 465;
        $config['wordwrap']     = TRUE;    
        $config['wrapchars']    = 76;
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['validate']     = FALSE;
        $config['priority']     = 3;
        $config['newline']      = "\r\n";
        $config['crlf']         = "\r\n";
        
        //Load email library 
         $this->load->library('email'); 
         $this->email->initialize($config);
         
        $from_email = "sohelbijay@gmail.com"; 
        $to_email = $to_email; 
   
         $this->email->from($from_email, 'Sohel'); 
         $this->email->to($to_email);
         $this->email->subject('Thanking for Apply this Post.'); 
         
         $info['logo']= "http://103.78.53.73:750/hrm/assets/img/hrc_logo.png";
         $info['msg'] = " <br> <h3>Thanking for Apply from HRM</h3> <br> <br>  Hi ". $name ." , <br> Thank You for your application  <br> <br> <br> <br> Best, <br> The HRM Development team. <br> <br> <br> <br> ";
         
         $body = $this->load->view('sadmin/compose.php',$info,TRUE);
         
         $this->email->message($body); 

        //Send mail 
         if($this->email->send()) 
            return TRUE; 
         else 
             return FALSE; 
      }
      

//    public function send_password_recovery_mail($uid, $tbl){
//
//            // getting user info from database
//            $query = $this->db->get_where($tbl,array('id'=>$uid));
//            $row = $query->result();
//
//            $config = array();
//            $config['useragent']           = "CodeIgniter";
//            $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
//            $config['protocol']            = "smtp";
//            $config['smtp_host']           = "localhost";
//            $config['smtp_port']           = "587";
//            $config['mailtype']            = 'html';
//            $config['charset']             = 'utf-8';
//            $config['newline']             = "\r\n";
//            $config['wordwrap']            = TRUE;
//
//            $this->load->library('email');
//
//            $this->email->initialize($config);
//
//            $this->email->from('info@easycarrying.com', 'Easy Carrying');
//            $this->email->to($row[0]->email);
//            //$this->email->cc('another@anotherexample.com'); 
//            //$this->email->bcc('albratorss@gmail.com'); 
//            $this->email->subject('Password Change Notification: Continuous Impression');
//
//            $data['msg'] = "Gretting! Hello ".$row[0]->contact_person_name." Your account password has been successfully change. Bellow is your new password<br><strong>New Password : ".$row[0]->password."</strong>";
//            
//            $body = $this->load->view('partial/compose.php',$data,TRUE);
//            $this->email->message($body);   
//            $this->email->send(); 
//    }
      
      
}
