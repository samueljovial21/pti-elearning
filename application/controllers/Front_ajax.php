<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_ajax extends CI_Controller {

	function __construct(){  
		parent::__construct();	
		// Load paypal library 
        $this->load->library('paypal_lib'); 
		
		$timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));
        if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])){
            date_default_timezone_set($timezoneDB[0]['timezone']);
        }
		require_once APPPATH . 'libraries/htmlpurifier/HTMLPurifier.auto.php';
    	$this->load->helper('htmlpurifier');
		
		$this->load->helper('language');
        
        // check select language
        $language = $this->general_settings('language_name');
        if($language=="french"){
            $this->lang->load('french_lang', 'french');
        }else if($language=="arabic"){
            $this->lang->load('arabic_lang', 'arabic');
        }else{
            $this->lang->load('english_lang', 'english');
        }
		
    }
	
	function general_settings($key_text=''){
        $data = $this->db_model->select_data('*','general_settings',array('key_text'=>$key_text),1);
        return $data[0]['velue_text'];
    }
    function random_strings($length_of_string) 
    { 
  
        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
      
        return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
    } 
   

  function login(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',false)) && !empty($this->input->post('password',false))){			
                $email = trim($this->input->post('email',TRUE));
                $pass = md5(trim($this->input->post('password',TRUE)));		
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $stud_cond = array('enrollment_id'=>$email,'password'=>$pass);
                }else{
                    $stud_cond = array('email'=>$email,'password'=>$pass);
                }
                $userDetails = $this->db_model->select_data('id,name,role,status,parent_id,teach_image,email,teach_batch,teach_subject,super_admin','users use index (id)',array('email'=>$email,'password'=>$pass),1);
                $studentDetails = $this->db_model->select_data('id,name,contact_no,batch_id,admin_id,enrollment_id,image,email,status,login_status','students use index (id)',$stud_cond,1);          
               
                if(!empty($userDetails)){
                      if($userDetails[0]['status']=='1'){
                        $brewers_strings = $this->random_strings(10);
                        $sess_arr = array(
                                    'uid'=> $userDetails[0]['id'],
                                    'name'=> $userDetails[0]['name'],
                                    'role'=> $userDetails[0]['role'],
                                    'status'=> $userDetails[0]['status'],
                                    'admin_id' => $userDetails[0]['parent_id'],
                                    'profile_img' => $userDetails[0]['teach_image'],
                                    'email' => $userDetails[0]['email'],
                                    'mobile' => $userDetails[0]['contact_no'],
                                    'brewers_check' => $brewers_strings,
                                    'super_admin' => $userDetails[0]['super_admin'],
                                   
                                );
                            
                        $url = '';
                        if($userDetails[0]['role']=='1'){
                            $url = base_url().'admin/dashboard';
                        }else if($userDetails[0]['role']=='3'){
                            $url = base_url().'teacher/dashboard';
                            $sess_arr['subject_id'] =implode(",",json_decode($userDetails[0]['teach_subject'])) ;
                            $sess_arr['batch_id'] = $userDetails[0]['teach_batch'];
                        }
    
                        $this->session->set_userdata($sess_arr);
                        
                        $this->db_model->update_data_limit('courses use index (id)',$this->security->xss_clean(array('status'=>0)),array('admin_id'=>$userDetails[0]['id'],'end_date <= '=>date('Y-m-d')));
                       
                        if($this->input->post('remember_me',TRUE)){	
                            $cookie = setcookie("UML", base64_encode(urlencode(base64_encode($email))), time() + 86400, '/');
                            $cookie =setcookie("SSD", base64_encode(urlencode(base64_encode($this->input->post('password',TRUE)))), time() + 86400,'/');
                         }
                         else{
                            $cookie =setcookie("UML", base64_encode(urlencode(base64_encode($email))), time() - 86400, '/');
                            $cookie =setcookie("SSD", base64_encode(urlencode(base64_encode($this->input->post('password',TRUE)))), time() - 86400, '/');
                        }
    
                        $resp = array('status'=>'1','msg'=>$this->lang->line('ltr_logged_msg'),'url'=>$url);
                        
                        $this->db_model->update_data_limit('users use index (id)',$this->security->xss_clean(array('token'=>1,'brewers_check'=>$brewers_strings)),array('id'=>$userDetails[0]['id']),1);
                      }else{
                        $resp = array('status' => '0','msg' =>$this->lang->line('ltr_contact_to_admin_msg'));
                    }
                  
                }else if(!empty($studentDetails)){
                    if($studentDetails[0]['status']=='1'){
                        $batch_details = $this->db_model->select_data('id,batch_name','batches use index (id)',array('status'=>1,'id'=>$studentDetails[0]['batch_id']),1);
                        
                    //   if(!empty($batch_details)){
                        if($studentDetails[0]['login_status'] == 1){
                            $resp = array('status' => '2','student_id' => $studentDetails[0]['id']);
                        }else{
                            $brewers_strings = $this->random_strings(10);
                            $sess_arr = array(
                                'uid'=> $studentDetails[0]['id'],
                                'name'=> $studentDetails[0]['name'],
                                'role'=> 'student',
                                'mobile' => $studentDetails[0]['contact_no'],
                                'admin_id' => $studentDetails[0]['admin_id'],
                                'profile_img' => $studentDetails[0]['image'],
                                'email' => $studentDetails[0]['email'],
                                'batch_id' => $studentDetails[0]['batch_id'],
                                'enrollment_id' => $studentDetails[0]['enrollment_id'],
                                'brewers_check' => $brewers_strings,
                            );
    
                            $this->session->set_userdata($sess_arr);
                            
                            if($this->input->post('remember_me',TRUE)){	
                                $cookie = setcookie("email", base64_encode($email), time() + 86400, '/');
                                $cookie =setcookie("password", base64_encode($this->input->post('password',TRUE)), time() + 86400,'/');
                            }
                            else{
                                $cookie =setcookie("email", base64_encode($email), time() - 86400, '/');
                                $cookie =setcookie("password", base64_encode($this->input->post('password',TRUE)), time() - 86400, '/');
                            }
                            
                            $this->db_model->update_data_limit('students use index (id)',$this->security->xss_clean(array('login_status'=>1,'token'=>1,'brewers_check'=>$brewers_strings)),array('id'=>$studentDetails[0]['id']),1);
    
                            $resp = array('status'=>'1','msg'=>$this->lang->line('ltr_logged_msg'),'url'=>base_url().'student/dashboard');
                        }
                    //   }else{
                    //       $resp = array('status' => '0','msg' => $this->lang->line('ltr_batch_in_msg'));
                    //   }
    
                      }else{
                        $resp = array('status' => '0','msg' =>$this->lang->line('ltr_contact_to_admin_msg'));
                    }
                }else{
                    $resp = array('status' => '0','msg' =>$this->lang->line('ltr_wrong_credentials_msg'));
                }
            }else{
                $resp = array('status' => '0','msg' =>$this->lang->line('ltr_wrong_credentials_msg'));
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    // function login(){
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         if(!empty($this->input->post('email',false)) && !empty($this->input->post('password',false))){			
    //             $email = trim($this->input->post('email',TRUE));
    //             $pass = md5(trim($this->input->post('password',TRUE)));		
    //             if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    //                 $stud_cond = array('enrollment_id'=>$email,'password'=>$pass);
    //             }else{
    //                 $stud_cond = array('email'=>$email,'password'=>$pass);
    //             }
    //             $userDetails = $this->db_model->select_data('id,name,role,status,parent_id,teach_image,email,teach_batch,teach_subject,super_admin','users use index (id)',array('email'=>$email,'password'=>$pass),1);
    //             $studentDetails = $this->db_model->select_data('id,name,contact_no,batch_id,admin_id,enrollment_id,image,email,status,login_status','students use index (id)',$stud_cond,1);    
              
                
    //             if(!empty($userDetails)){
    //                    if($userDetails[0]['status']=='1'){
    //                     $brewers_strings = $this->random_strings(10);
    //                     $sess_arr = array(
    //                                 'uid'=> $userDetails[0]['id'],
    //                                 'name'=> $userDetails[0]['name'],
    //                                 'role'=> $userDetails[0]['role'],
    //                                 'status'=> $userDetails[0]['status'],
    //                                 'admin_id' => $userDetails[0]['parent_id'],
    //                                 'profile_img' => $userDetails[0]['teach_image'],
    //                                 'email' => $userDetails[0]['email'],
    //                                 'mobile' => $userDetails[0]['contact_no'],
    //                                 'brewers_check' => $brewers_strings,
    //                                 'super_admin' => $userDetails[0]['super_admin'],
                                
    //                             );                      
                                
    //                     $url = '';
    //                     if($userDetails[0]['role']=='1'){
    //                         $url = base_url().'admin/dashboard';
    //                     }else if($userDetails[0]['role']=='3'){
    //                         $url = base_url().'teacher/dashboard';
    //                         $sess_arr['subject_id'] =implode(",",json_decode($userDetails[0]['teach_subject'])) ;
    //                         $sess_arr['batch_id'] = $userDetails[0]['teach_batch'];
    //                     }
    
    //                     $this->session->set_userdata($sess_arr);
                        
    //                     $this->db_model->update_data_limit('courses use index (id)',$this->security->xss_clean(array('status'=>0)),array('admin_id'=>$userDetails[0]['id'],'end_date <= '=>date('Y-m-d')));
                       
    //                     if($this->input->post('remember_me',TRUE)){	
    //                         $cookie = setcookie("UML", base64_encode(urlencode(base64_encode($email))), time() + 86400, '/');
    //                         $cookie =setcookie("SSD", base64_encode(urlencode(base64_encode($this->input->post('password',TRUE)))), time() + 86400,'/');
    //                      }
    //                      else{
    //                         $cookie =setcookie("UML", base64_encode(urlencode(base64_encode($email))), time() - 86400, '/');
    //                         $cookie =setcookie("SSD", base64_encode(urlencode(base64_encode($this->input->post('password',TRUE)))), time() - 86400, '/');
    //                     }
    
    //                     $resp = array('status'=>'1','msg'=>$this->lang->line('ltr_logged_msg'),'url'=>$url);
                        
    //                     $this->db_model->update_data_limit('users use index (id)',$this->security->xss_clean(array('token'=>1,'brewers_check'=>$brewers_strings)),array('id'=>$userDetails[0]['id']),1);
    //                   }else{
    //                     $resp = array('status' => '0','msg' =>$this->lang->line('ltr_contact_to_admin_msg'));
    //                 }
                  
    //             }
               
                
    //             else{
    //                 $resp = array('status' => '0','msg' =>$this->lang->line('ltr_wrong_credentials_msg'));
    //             }
    //         }else{
    //             $resp = array('status' => '0','msg' =>$this->lang->line('ltr_wrong_credentials_msg'));
    //         }
    //         echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     } 
    // }
       function register(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',false)) && !empty($this->input->post('email',false)) && !empty($this->input->post('mobile',false))){    
                $name = trim($this->input->post('name',TRUE));
                $email = trim($this->input->post('email',TRUE));
                $mobile = $this->input->post('mobile',false);
                    $admin_id =$this->db_model->select_data('id','users use index (id)',array('role'=>1),1)[0]['id'];
                
                $prevRecd = $this->db_model->select_data('id','students',array('email'=>$email));
                 $prevRecd_mobile = $this->db_model->select_data('id','students',array('contact_no'=>$mobile));     
                    if(empty($prevRecd)){
                        if(empty($prevRecd_mobile)){
                        $siteData = array();
                        $siteData['word_for_enroll'] = $this->common->enrollWord;
                        $data_arr['admin_id'] = 0; 
                        $lastrecord = $this->db_model->select_data('id','students use index (id)',array('admin_id'=>$admin_id),1,array('id','desc'));             
                        if(!empty($lastrecord)){
                            $last_id = $lastrecord[0]['id'];
                        }else{
                            $last_id = 0;
                        }
                        
                        $password = $siteData['word_for_enroll'].$admin_id.$last_id.rand(1000,5000);
                        $enrolid = $siteData['word_for_enroll'].$admin_id.$last_id.rand(10,100);
                        $data_arr['name'] = $name;
                        $data_arr['email'] = $email;
                        $data_arr['batch_id'] = '';
                        $data_arr['login_status'] = 0;
                        $data_arr['added_by'] = 'student';
                        $data_arr['status'] = 1;
                        $data_arr['enrollment_id'] = $enrolid;
                        $data_arr['password'] = md5(trim($password));
                        $data_arr['admission_date'] = date('Y-m-d');
                        $data_arr['image']='student_img.png';
                        $data_arr['contact_no']=$mobile;
                        //update app version and login status
                        $data_arr['login_status']= 0;
                        $data_arr['last_login_app']= date("Y-m-d H:i:s");
                        $data_arr['app_version']= '';
                        $data_arr['token']= '';
                        $data_arr['multi_batch'] =json_encode([""]);
                    // print_r($data_arr);
                    // die();
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->insert_data('students',$data_arr);
                    
                            if($ins){
                                
                            $brewers_strings = $this->random_strings(10);
                
                            $this->db_model->update_data_limit('students use index (id)',$this->security->xss_clean(array('login_status'=>1,'token'=>1,'brewers_check'=>$brewers_strings)),array('id'=>$ins),1);
                            $url = base_url().'login'; 
                            // send email 
                               $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
                                $subj = $title.'- '.$this->lang->line('ltr_credentials');
                                $em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulations').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_enrolment_id').' : '.$enrolid.'<br/><br/>'.$this->lang->line('ltr_password').' : '.$password.'<br/><br/>'.$this->lang->line('ltr_url').' : <a href="'.$url.'">Click here to Login.</a><br/><br/>'.$this->lang->line('ltr_thnx_msg').'';
                                $this->SendMail($email, $subj, $em_msg);
                                
                            $arr = array('status'=>'1','msg'=>$this->lang->line('ltr_registered_msg'),'url'=>base_url().'home/login');
                            }
                        }else{
                          $arr = array(
                            'status'=>'0',
                            'msg'=>$this->lang->line('ltr_mobile_already_msg'));    
                        }  
                        
                    }else{
                    $arr = array(
                    'status'=>'0',
                    'msg'=>$this->lang->line('ltr_email_already_msg'));    
                    }
            echo json_encode($arr,JSON_UNESCAPED_SLASHES);
        }
        
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
}

function change_student_status(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',false))){
                $res = $this->db_model->update_data_limit('students use index (id)',$this->security->xss_clean(array('login_status'=>0)),array('id'=>$this->input->post('id',TRUE)),1);
                if($res)
                    echo '1';
                else    
                    echo '0';
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    // function reset_password(){
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         if(!empty($this->input->post('email',false))){
    //             $email = $this->input->post('email',TRUE);
    //             $userDetails = $this->db_model->select_data('id,name','users use index (id)',array('email'=>$email),1);
    //             $studentDetails = $this->db_model->select_data('id,name','students use index (id)',array('email'=>$email),1);
    //             // echo $this->db->last_query();
    //             // print_r($studentDetails);
    //             if(!empty($userDetails)){
    //                 $this->load->library('email');
    //                 $frommail =$this->general_settings('smtp_mail');
    //                 $frompwd =$this->general_settings('smtp_pwd');
    //                 $config = array();
    //                 $config['protocol'] = $this->general_settings('server_type');
    //                 $config['smtp_host'] = $this->general_settings('smtp_host');
    //                 $config['smtp_port'] = $this->general_settings('smtp_port');
    //                 $config['smtp_user'] = $frommail;
    //                 $config['smtp_pass'] = $frompwd;
    //                 $config['charset'] = "utf-8";
    //                 $config['mailtype'] = "html";
    //                 $config['smtp_crypto'] = $this->general_settings('smtp_encryption');
    //                 $config['newline'] = "\r\n";
                    
    //                 $a=str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    //                 $pwd = substr($a, 0, 5);
                    
    //                 $subj = 'Recover your account password '.$this->common->siteTitle;
    //                 $em_msg = 'Hi '.ucwords($userDetails[0]['name']).',<br/><br/>We have received your request to reset your account password.<br/><br/>Here is your new password : '.$pwd.'<br/><br/> This is an auto-generated email. Please do not reply to this email.';
                    
    //                 $from_email = $this->common->siteOwnerEmail;
    //                 $this->email->initialize($config);
    //                 $this->email->from($from_email, 'Admin'); 
    //                 $this->email->to($email);
    //                 $this->email->subject($subj); 
    //                 $this->email->message($em_msg); 
    
    //                 if($this->email->send()){
    //                     $data = array( 
    //                         'password'=>md5($pwd)
    //                     );
    //                     $data = $this->security->xss_clean($data);
    //                     $this->db_model->update_data('users',$data, array('email'=>$email));
    
    //                     $resp = array(
    //                         'status'=>'1',
    //                         'msg'=>'We\'ve sent an email to '.$email.'.',
    //                         'url'=>base_url('login') 
    //                     );
    //                 }
    //                 else{
    //                     $resp = array(
    //                         'status'=>'0',
    //                         'msg'=>$this->lang->line('ltr_something_msg')
    //                     );
    //                 }
    //             }else if(!empty($studentDetails)){
                    
    //                 $this->load->library('email');
    //                 $frommail =$this->general_settings('smtp_mail');
    //                 $frompwd =$this->general_settings('smtp_pwd');
    //                 $config = array();
    //                 $config['protocol'] = $this->general_settings('server_type');
    //                 $config['smtp_host'] = $this->general_settings('smtp_host');
    //                 $config['smtp_port'] = $this->general_settings('smtp_port');
    //                 $config['smtp_user'] = $frommail;
    //                 $config['smtp_pass'] = $frompwd;
    //                 $config['charset'] = "utf-8";
    //                 $config['mailtype'] = "html";
    //                 $config['smtp_crypto'] = $this->general_settings('smtp_encryption');
    //                 $config['newline'] = "\r\n";
                    
    //                 $a=str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    //                 $pwd = substr($a, 0, 5);
                    
                    
    //                 $subj = 'Recover your account password '.$this->common->siteTitle;
    //                 $em_msg = 'Hi '.ucwords($studentDetails[0]['name']).',<br/><br/>We have received your request to reset your account password.<br/><br/>Here is your new password : '.$pwd.'<br/><br/> This is an auto-generated email. Please do not reply to this email.';
                    
    //                 $from_email = $this->common->siteOwnerEmail;
    //                 $this->email->initialize($config);
    //                 $this->email->from($from_email, 'Admin'); 
    //                 $this->email->to($email);
    //                 $this->email->subject($subj); 
    //                 $this->email->message($em_msg); 
    //                 $this->email->send();
    //                 echo $this->email->print_debugger();
    //                 if($this->email->send()){
    //                     $data = array( 
    //                         'password'=>md5($pwd)
    //                     );
    //                     $data = $this->security->xss_clean($data);
    //                     $this->db_model->update_data('students',$data, array('email'=>$email));
    
    //                     $resp = array(
    //                         'status'=>'1',
    //                         'msg'=>'We\'ve sent an email to '.$email.'.',
    //                         'url'=>base_url('login') 
    //                     );
    //                 }
    //                 else{
    //                     $resp = array(
    //                         'status'=>'0',
    //                         'msg'=>$this->lang->line('ltr_something_msg')
    //                     );
    //                 }
    //             }else{
    //                 $resp = array(
    //                     'status'=>'0',
    //                     'msg'=>$this->lang->line('ltr_email_not_exists_msg')
    //                 );
    //             }
    //             echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //         }
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     } 
    // }
        function reset_password(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',false))){
                $email = $this->input->post('email',TRUE);
                $userDetails = $this->db_model->select_data('id,name','users use index (id)',array('email'=>$email),1);
                $studentDetails = $this->db_model->select_data('id,name','students use index (id)',array('email'=>$email),1);
                // echo $this->db->last_query();
                // print_r($studentDetails);
                if(!empty($userDetails)){
                    $this->load->library('email');
                    $frommail =$this->general_settings('smtp_mail');
                    $frompwd =$this->general_settings('smtp_pwd');
                    $config = array();
                    $config['protocol'] = $this->general_settings('server_type');
                    $config['smtp_host'] = $this->general_settings('smtp_host');
                    $config['smtp_port'] = $this->general_settings('smtp_port');
                    $config['smtp_user'] = $frommail;
                    $config['smtp_pass'] = $frompwd;
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['smtp_crypto'] = $this->general_settings('smtp_encryption');
                    $config['newline'] = "\r\n";
                    
                    $a=str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
                    $pwd = substr($a, 0, 5);
                    
                    $subj = 'Recover your account password '.$this->common->siteTitle;
                    $em_msg = 'Hi '.ucwords($userDetails[0]['name']).',<br/><br/>We have received your request to reset your account password.<br/><br/>Here is your new password : '.$pwd.'<br/><br/> This is an auto-generated email. Please do not reply to this email.';
                    
                    $from_email = $this->common->siteOwnerEmail;
                    $this->email->initialize($config);
                    $this->email->from($from_email, 'Admin'); 
                    $this->email->to($email);
                    $this->email->subject($subj); 
                    $this->email->message($em_msg); 
    
                    if($this->email->send()){
                        $data = array( 
                            'password'=>md5($pwd)
                        );
                        $data = $this->security->xss_clean($data);
                        $this->db_model->update_data('users',$data, array('email'=>$email));
    
                        $resp = array(
                            'status'=>'1',
                            'msg'=>'We\'ve sent an email to '.$email.'.',
                            'url'=>base_url('login') 
                        );
                    }
                    else{
                        $resp = array(
                            'status'=>'0',
                            'msg'=>$this->lang->line('ltr_something_msg')
                        );
                    }
                }else if(!empty($studentDetails)){
                    
                    $this->load->library('email');
                    $frommail =$this->general_settings('smtp_mail');
                    $frompwd =$this->general_settings('smtp_pwd');
                    $config = array();
                    $config['protocol'] = $this->general_settings('server_type');
                    $config['smtp_host'] = $this->general_settings('smtp_host');
                    $config['smtp_port'] = $this->general_settings('smtp_port');
                    $config['smtp_user'] = $frommail;
                    $config['smtp_pass'] = $frompwd;
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['smtp_crypto'] = $this->general_settings('smtp_encryption');
                    $config['newline'] = "\r\n";
                    
                    $a=str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
                    $pwd = substr($a, 0, 5);
                    
                    
                    $subj = 'Recover your account password '.$this->common->siteTitle;
                    $em_msg = 'Hi '.ucwords($studentDetails[0]['name']).',<br/><br/>We have received your request to reset your account password.<br/><br/>Here is your new password : '.$pwd.'<br/><br/> This is an auto-generated email. Please do not reply to this email.';
                    
                    $from_email = $this->common->siteOwnerEmail;
                    $this->email->initialize($config);
                    $this->email->from($from_email, 'Admin'); 
                    $this->email->to($email);
                    $this->email->subject($subj); 
                    $this->email->message($em_msg); 
                    /*$this->email->send();
                    echo $this->email->print_debugger();*/
                    if($this->email->send()){
                        $data = array( 
                            'password'=>md5($pwd)
                        );
                        $data = $this->security->xss_clean($data);
                        $this->db_model->update_data('students',$data, array('email'=>$email));
    
                        $resp = array(
                            'status'=>'1',
                            'msg'=>'We\'ve sent an email to '.$email.'.',
                            'url'=>base_url('login') 
                        );
                    }
                    else{
                        $resp = array(
                            'status'=>'0',
                            'msg'=>$this->lang->line('ltr_something_msg')
                        );
                    }
                }else{
                    $resp = array(
                        'status'=>'0',
                        'msg'=>$this->lang->line('ltr_email_not_exists_msg')
                    );
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function logout(){
        if($this->session->userdata('role') == 'student'){
            $this->db_model->update_data_limit('students use index (id)',$this->security->xss_clean(array('login_status'=>0)),array('id'=>$this->session->userdata('uid')),1);
        }
		if($this->session->all_userdata()){
            $this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}
	
    function site_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('site_title',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
              
                if(isset($_FILES['site_logo']) && !empty($_FILES['site_logo']['name'])){
                    $logo = $this->upload_media('single',$_FILES,'./uploads/site_data/','site_logo');
                    if(is_array($logo)){
                        $resp = array('status'=>'2', 'msg' => $logo['msg']);
                       echo json_encode($resp,JSON_UNESCAPED_SLASHES); 
                      
                        die();
                    }else{
                        $data_arr['site_logo'] = $logo;
                    }
                }
                if(isset($_FILES['site_minilogo']) && !empty($_FILES['site_minilogo']['name'])){
                    $logo = $this->upload_media('single',$_FILES,'./uploads/site_data/','site_minilogo');
                    if(is_array($logo)){
                        $resp = array('status'=>'2', 'msg' => $logo['msg']);
                       echo json_encode($resp,JSON_UNESCAPED_SLASHES); 
                      
                        die();
                    }else{
                        $data_arr['site_minilogo'] = $logo;
                    }
                }
                if(isset($_FILES['site_loader']) && !empty($_FILES['site_loader']['name'])){
                    $loader = $this->upload_media('single',$_FILES,'./uploads/site_data/','site_loader');
                    if(is_array($loader)){
                        $resp = array('status'=>'2', 'msg' => $loader['msg']);
                        die();
                    }else{
                        $data_arr['site_loader'] = $loader;
                    }
                }
                if(isset($_FILES['site_favicon']) && !empty($_FILES['site_favicon']['name'])){
                    $favicon = $this->upload_media('single',$_FILES,'./uploads/site_data/','site_favicon');
                    if(is_array($favicon)){
                        $resp = array('status'=>'2', 'msg' => $favicon['msg']);
                        die();
                    }else{
                        $data_arr['site_favicon'] = $favicon;
                    }
                }
                
                $data_arr['enrollment_word'] = ucwords($data_arr['enrollment_word']);
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit('site_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_site_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	
	function payment_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('payment_type',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                $currency_sym = array(
                                    'AED' => 'د.إ',
                                    'AFN' => '؋',
                                    'ALL' => 'L',
                                    'AMD' => 'AMD',
                                    'ANG' => 'ƒ',
                                    'AOA' => 'Kz',
                                    'ARS' => '$',
                                    'AUD' => '$',
                                    'AWG' => 'ƒ',
                                    'AZN' => 'AZN',
                                    'BAM' => 'KM',
                                    'BBD' => '$',
                                    'BDT' => '৳ ',
                                    'BGN' => 'лв.',
                                    'BHD' => '.د.ب',
                                    'BIF' => 'Fr',
                                    'BMD' => '$',
                                    'BND' => '$',
                                    'BOB' => 'Bs.',
                                    'BRL' => 'R$',
                                    'BSD' => '$',
                                    'BTC' => '฿',
                                    'BTN' => 'Nu.',
                                    'BWP' => 'P',
                                    'BYR' => 'Br',
                                    'BZD' => '$',
                                    'CAD' => '$',
                                    'CDF' => 'Fr',
                                    'CHF' => 'CHF',
                                    'CLP' => '$',
                                    'CNY' => '¥',
                                    'COP' => '$',
                                    'CRC' => '₡',
                                    'CUC' => '$',
                                    'CUP' => '$',
                                    'CVE' => '$',
                                    'CZK' => 'Kč',
                                    'DJF' => 'Fr',
                                    'DKK' => 'DKK',
                                    'DOP' => 'RD$',
                                    'DZD' => 'د.ج',
                                    'EGP' => 'EGP',
                                    'ERN' => 'Nfk',
                                    'ETB' => 'Br',
                                    'EUR' => '€',
                                    'FJD' => '$',
                                    'FKP' => '£',
                                    'GBP' => '£',
                                    'GEL' => 'ლ',
                                    'GGP' => '£',
                                    'GHS' => '₵',
                                    'GIP' => '£',
                                    'GMD' => 'D',
                                    'GNF' => 'Fr',
                                    'GTQ' => 'Q',
                                    'GYD' => '$',
                                    'HKD' => '$',
                                    'HNL' => 'L',
                                    'HRK' => 'Kn',
                                    'HTG' => 'G',
                                    'HUF' => 'Ft',
                                    'IDR' => 'Rp',
                                    'ILS' => '₪',
                                    'IMP' => '£',
                                    'INR' => '₹',
                                    'IQD' => 'ع.د',
                                    'IRR' => '﷼',
                                    'IRT' => 'تومان',
                                    'ISK' => 'kr.',
                                    'JEP' => '£',
                                    'JMD' => '$',
                                    'JOD' => 'د.ا',
                                    'JPY' => '¥',
                                    'KES' => 'KSh',
                                    'KGS' => 'сом',
                                    'KHR' => '៛',
                                    'KMF' => 'Fr',
                                    'KPW' => '₩',
                                    'KRW' => '₩',
                                    'KWD' => 'د.ك',
                                    'KYD' => '$',
                                    'KZT' => 'KZT',
                                    'LAK' => '₭',
                                    'LBP' => 'ل.ل',
                                    'LKR' => 'රු',
                                    'LRD' => '$',
                                    'LSL' => 'L',
                                    'LYD' => 'ل.د',
                                    'MAD' => 'د.م.',
                                    'MDL' => 'MDL',
                                    'MGA' => 'Ar',
                                    'MKD' => 'ден',
                                    'MMK' => 'Ks',
                                    'MNT' => '₮',
                                    'MOP' => 'P',
                                    'MRO' => 'UM',
                                    'MUR' => '₨',
                                    'MVR' => '.ރ',
                                    'MWK' => 'MK',
                                    'MXN' => '$',
                                    'MYR' => 'RM',
                                    'MZN' => 'MT',
                                    'NAD' => '$',
                                    'NGN' => '₦',
                                    'NIO' => 'C$',
                                    'NOK' => 'kr',
                                    'NPR' => '₨',
                                    'NZD' => '$',
                                    'OMR' => 'ر.ع.',
                                    'PAB' => 'B/.',
                                    'PEN' => 'S/.',
                                    'PGK' => 'K',
                                    'PHP' => '₱',
                                    'PKR' => '₨',
                                    'PLN' => 'zł',
                                    'PRB' => 'р.',
                                    'PYG' => '₲',
                                    'QAR' => 'ر.ق',
                                    'RMB' => '¥',
                                    'RON' => 'lei',
                                    'RSD' => 'дин.',
                                    'RUB' => '₽',
                                    'RWF' => 'Fr',
                                    'SAR' => 'ر.س',
                                    'SBD' => '$',
                                    'SCR' => '₨',
                                    'SDG' => 'ج.س.',
                                    'SEK' => 'kr',
                                    'SGD' => '$',
                                    'SHP' => '£',
                                    'SLL' => 'Le',
                                    'SOS' => 'Sh',
                                    'SRD' => '$',
                                    'SSP' => '£',
                                    'STD' => 'Db',
                                    'SYP' => 'ل.س',
                                    'SZL' => 'L',
                                    'THB' => '฿',
                                    'TJS' => 'ЅМ',
                                    'TMT' => 'm',
                                    'TND' => 'د.ت',
                                    'TOP' => 'T$',
                                    'TRY' => '₺',
                                    'TTD' => '$',
                                    'TWD' => 'NT$',
                                    'TZS' => 'Sh',
                                    'UAH' => '₴',
                                    'UGX' => 'UGX',
                                    'USD' => '$',
                                    'UYU' => '$',
                                    'UZS' => 'UZS',
                                    'VEF' => 'Bs F',
                                    'VND' => '₫',
                                    'VUV' => 'Vt',
                                    'WST' => 'T',
                                    'XAF' => 'Fr',
                                    'XCD' => '$',
                                    'XOF' => 'Fr',
                                    'XPF' => 'Fr',
                                    'YER' => '﷼',
                                    'ZAR' => 'R',
                                    'ZMW' => 'ZK',
                                    );
                if(!empty($this->input->post('payment_type'))){
					$data_arrp['velue_text'] = $data_arr['payment_type'];
					$data_arr = $this->security->xss_clean($data_arrp);
					$ins = $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'payment_type'),1);
				} 
				if(!empty($_POST['razorpay_key_id'])){
					$data_arrk['velue_text'] =  trim($_POST['razorpay_key_id']);
					$data_arrk = $this->security->xss_clean($data_arrk);
					$ins = $this->db_model->update_data_limit('general_settings',$data_arrk,array('key_text'=>'razorpay_key_id'),1);
				}
				if(!empty($this->input->post('razorpay_secret_key'))){
					$data_arrs['velue_text'] = trim($_POST['razorpay_secret_key']);
					$data_arr = $this->security->xss_clean($data_arrs);
					$ins = $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'razorpay_secret_key'),1);
				}
				if(!empty($this->input->post('paypal_client_id'))){
					$data_arpr['velue_text'] = trim($_POST['paypal_client_id']);
					$data_arr = $this->security->xss_clean($data_arpr);
					$ins = $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'paypal_client_id'),1);
				}
				if(!empty($this->input->post('paypal_secret_key'))){
					$data_arrps['velue_text'] = trim($_POST['paypal_secret_key']);
					$data_arr = $this->security->xss_clean($data_arrps);
					$ins = $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'paypal_secret_key'),1);
				}
				if(!empty($this->input->post('currency_code'))){
					$data_arrpscc['velue_text'] = trim($_POST['currency_code']);
					$data_arr = $this->security->xss_clean($data_arrpscc);
				    $this->db_model->update_data_limit('general_settings',array('velue_text'=>$currency_sym[$_POST['currency_code']]),array('key_text'=>'currency_decimal_code'),1);
				    $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'currency_code'),1);
				}
				
				if(!empty($this->input->post('currency_converter_api'))){
					$data_arrpsc['velue_text'] = trim($_POST['currency_converter_api']);
					$data_arr = $this->security->xss_clean($data_arrpsc);
				    $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'currency_converter_api'),1);
				}
				if(!empty($this->input->post('sandbox_accounts'))){
					$data_arrpsc['velue_text'] = trim($_POST['sandbox_accounts']);
					$data_arr = $this->security->xss_clean($data_arrpsc);
				    $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'sandbox_accounts'),1);
				}
                
                if($ins){
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_payment_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function language_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('language_type',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                if(!empty($this->input->post('language_type'))){
					$data_arrp['velue_text'] = $data_arr['language_type'];
					$data_arr = $this->security->xss_clean($data_arrp);
					$ins = $this->db_model->update_data_limit('general_settings',$data_arr,array('key_text'=>'language_name'),1);
				} 
				
                
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_language_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function contact_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('address',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                $data_arr['address'] = preg_replace("/(<br\s*\/>\s*)+/", "<br /><br />", nl2br($data_arr['address']));
                $data_arr = $this->security->xss_clean($data_arr);			
                $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_contact_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function facility_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('faci_heading',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                $data_arr = $this->security->xss_clean($data_arr);			
                $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_facility_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function about_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('abt_frst_heading',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
               
                if(!empty($_FILES['abt_frst_img']['name']) || !empty($_FILES['abt_sec_img']['name']) || !empty($_FILES['abt_thrd_img']['name'])){
                    foreach($_FILES as $key => $value){
                        $image = $this->upload_media('single',$_FILES,'./uploads/site_data/',$key);
                        if(is_array($image)){
                            $resp = array('status'=>'2', 'msg' => $image['msg']);
                            die();
                        }else{
                            if(!empty($image)){
                                $data_arr[$key] = $image;
                            }
                        }
                    }
                }
    
                $data_arr['abt_frst_desc'] = preg_replace("/(<br\s*\/>\s*)+/", "<br /><br />", nl2br($data_arr['abt_frst_desc']));  
                $data_arr['abt_sec_desc'] = preg_replace("/(<br\s*\/>\s*)+/", "<br /><br />", nl2br($data_arr['abt_sec_desc']));   
                $data_arr['abt_thrd_desc'] = preg_replace("/(<br\s*\/>\s*)+/", "<br /><br />", nl2br($data_arr['abt_thrd_desc']));
                $data_arr = $this->security->xss_clean($data_arr);			
                $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_about_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function course_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('sec_crse_sub_heading',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));     
                $data_arr['frst_crse_desc'] = preg_replace("/(<br\s*\/>\s*)+/", "<br /><br />", nl2br($data_arr['frst_crse_desc'])); $data_arr = $this->security->xss_clean($data_arr);      
                $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_course_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function counter_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('years_of_histry',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_home_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
        
    }

    function testimonial_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('testi_heading',false))){
                $testimonial = array_combine(html_escape(html_purify($this->input->post('testi_stud',false))), html_escape(html_purify($this->input->post('testi_desc',false))));
                $ins = $this->db_model->update_data_limit('frontend_details',$this->security->xss_clean(array('testimonial'=>json_encode($testimonial),'testi_heading'=>html_escape(html_purify($this->input->post('testi_heading',false))),'testi_subheading'=>html_escape(html_purify($this->input->post('testi_subheading',false))))),array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_home_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function teacher_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('no_of_teacher',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false))); 
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_home_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function client_btn_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            
            $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
            $prevClient = $this->db_model->select_data('client_imgs','frontend_details',array('id'=>1),1);
            
            if(isset($_FILES['client_imgs']) && !empty($_FILES['client_imgs']['name'][0])){
                $client_imgs = $this->upload_media('multiple',$_FILES,'./uploads/site_data/','client_imgs');
                if(is_array($client_imgs)){
                    $resp = array('status'=>'2', 'msg' => $client_imgs['msg']);
                    die();
                }else{
                    $data_arr['client_imgs'] = $client_imgs;
                    if(!empty($prevClient[0]['client_imgs'])){
                        $clients = json_decode($prevClient[0]['client_imgs'],true);
                        foreach($clients as $cln){
                            unlink(FCPATH.'uploads/site_data/'.$cln);
                        }
                    }
                }
            }
            $data_arr = $this->security->xss_clean($data_arr);
            $ins = $this->db_model->update_data_limit('frontend_details',$data_arr,array('id'=>1),1);
            if($ins){
                $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_home_page_updated_msg'));
            }else{
                $resp = array('status'=>'0');
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES); 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function selection_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('selectn_heading',false))){
                $selection = array_combine(html_escape(html_purify($this->input->post('select_stud',false))), html_escape(html_purify($this->input->post('select_desc',false))));
                $ins = $this->db_model->update_data_limit('frontend_details',$this->security->xss_clean(array('selection'=>json_encode($selection),'selectn_heading'=>html_escape(html_purify($this->input->post('selectn_heading',false))),'selectn_subheading'=>html_escape(html_purify($this->input->post('selectn_subheading',false))))),array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_home_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function slider_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('slider_heading',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                
                $data_arr = $this->security->xss_clean($data_arr);
                $descs = $data_arr['slider_desc'];
                unset($data_arr['slider_desc']);
                foreach($descs as $desc){
                    $data_arr['slider_desc'][] = preg_replace("/(<br\s*\/>\s*)+/", "<br /><br />", nl2br($desc));    
                }
                
                $prevDetails = $this->db_model->select_data('slider_details','frontend_details',array('id'=>1),1);
                
                if(isset($_FILES['slider_img']) && !empty($_FILES['slider_img']['name'])){
                    $slider_img = $this->upload_media('multiple',$_FILES,'./uploads/site_data/','slider_img',json_decode(base64_decode($data_arr['prev_slides']),true));
                    if(is_array($slider_img)){
                        $resp = array('status'=>'2', 'msg' => $slider_img['msg']);
                        die();
                    }else{
                        $data_arr['slider_img'] = json_decode($slider_img,true);
                    }
                }
                unset($data_arr['prev_slides']);
                $ins = $this->db_model->update_data_limit('frontend_details',array('slider_details'=>json_encode($data_arr)),array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_home_page_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function upload_media($noOfImg,$files,$path,$file,$prevslide = []){
        
        if($noOfImg == 'single'){
            $config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|png|gif|SVG|svg';
            $config['max_size']    = '0';
            $filename = '';		
            $this->load->library('upload', $config);
            if(!empty($_FILES[$file]['name'])){
                if ($this->upload->do_upload($file)){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    return $filename;
                }else{
                    $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                    return $resp;
                }
            }
        }else{
            $file_names = array();
            if(isset($_FILES) && !empty($_FILES[$file])){
                $fileArray = $_FILES;
                $count = count($_FILES[$file]['name']);
                unset($_FILES[$file]);
                
                $arr = [];
                $resp = '';
                for($i=0;$i<$count;$i++){
                        
                    $arr['name'] = $fileArray[$file]['name'][$i];
                    $arr['type'] = $fileArray[$file]['type'][$i];
                    $arr['tmp_name'] = $fileArray[$file]['tmp_name'][$i];
                    $arr['error'] = $fileArray[$file]['error'][$i];
                    $arr['size'] = $fileArray[$file]['size'][$i];
                    
                    $_FILES['newfile_'.$i] = $arr;
            
                    $config['upload_path'] = $path; 
                    $config['allowed_types'] = 'jpg|jpeg|png|docx|doc|pdf';
                    $config['max_size'] = '0';
            
                    $this->load->library('upload',$config); 
                
                    if($this->upload->do_upload('newfile_'.$i)){
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $prevslide[$i] = $filename;
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                    }
                } 
                if(!empty($prevslide))
                    return json_encode($prevslide);
                else 
                    return $resp; 
            }
        } 
        
    }

    function timezone_settings(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('timezone',false))){
                $data_arr = $this->input->post(NULL, TRUE);
                $data_arr = $this->security->xss_clean($data_arr);			
                $ins = $this->db_model->update_data_limit('site_details',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_timezone_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function enquiry_form(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',false))){
                $data_arr = html_escape(html_purify($this->input->post(NULL, false)));
                $data_arr['date'] = date('Y-m-d');
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('enquiry',$data_arr);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_contact_send_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }  
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	
	function comment_form(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',false))){
                $data_arr['user_email'] =trim($this->input->post('email',false));
				$data_arr['admin_id'] = $this->db_model->select_data('*','users use index (id)',array('role'=>1),1)[0]['id'];
				$data_arr['blog_id'] =trim($this->input->post('blogId',false));
                if(!empty($this->input->post('name',false))){
					$data_arr['user_name'] =trim($this->input->post('name',false));
				}
				if(!empty($this->input->post('mobile',false))){
					$data_arr['user_mobile'] =trim($this->input->post('mobile',false));
				}
				if(!empty($this->input->post('message',false))){
					$data_arr['comments'] =trim($this->input->post('message',false));
				}
				if(!empty($this->session->userdata('uid'))){
					$data_arr['user_id'] =trim($this->session->userdata('uid'));
					$data_arr['user_role'] =trim($this->session->userdata('role'));
				}
				$data_arr['user_image'] = "student_img.png";
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('blog_comments',$data_arr);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_comments_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }  
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function comment_form_reply(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',false))){
                $data_arr['email'] =trim($this->input->post('email',false));
                //$data_arr['admin_id'] = $this->db_model->select_data('*','users use index (id)',array('role'=>1),1)[0]['id'];
                $data_arr['comment_id'] =trim($this->input->post('comment_id',false));
                if(!empty($this->input->post('name',false))){
                    $data_arr['name'] =trim($this->input->post('name',false));
                }
                if(!empty($this->input->post('mobile',false))){
                    $data_arr['mobile'] =trim($this->input->post('mobile',false));
                }
                if(!empty($this->input->post('message',false))){
                    $data_arr['reply'] =trim($this->input->post('message',false));
                }
                if(!empty($this->session->userdata('uid'))){
                    $data_arr['user_id'] =trim($this->session->userdata('uid'));
                   //$data_arr['user_role'] =trim($this->session->userdata('role'));
                }
                $data_arr['image'] = "student_img.png";
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('blog_comments_reply',$data_arr);
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_comments_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }  
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	function enroll_check(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',false))){
               $check_email = $this->db_model->select_data('*','students',array('email'=>trim($_POST['email'])));
    		    $check_email_t = $this->db_model->select_data('*','users',array('email'=>trim($_POST['email'])));
    		    if(!empty($check_email_t)){
    		        $resp = array('status'=>'0','msg'=>$this->lang->line('ltr_email_already_msg'));
    		        echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    		        die();
    		    }
				
    		    if(!empty($check_email)){
    		        $check_batch = $this->db_model->select_data('*','sudent_batchs',array('student_id'=>$check_email[0]['id'],'batch_id'=>$_POST['batchId']));
    		        if(!empty($check_batch)){
    		            $resp = array('status'=>'0','msg'=>$this->lang->line('ltr_email_already_msg'));
    		        }else{
						$check_batch = $this->db_model->select_data('*','batches',array('id'=>$_POST['batchId']));
						if($check_batch[0]['batch_type']==1){
							$this->student_signUp($_POST['name'],$_POST['email'],$check_email[0]['mobile'],$_POST['batchId']);
							$resp = array('status'=>'2',);
						}else{
						    $payment_type = $this->general_settings('payment_type');
							$currency = $this->general_settings('currency_code');
							$url = base_url().'buy-now/'.$_POST['batchId'].'?email='.$_POST['email'].'&mobile='.$_POST['mobile'].'&name='.$_POST['name'];
							$data = array('name'=>$_POST['name'],
									  'email'=>$_POST['email'],
									  'mobile'=>$_POST['mobile'],
									  'batchId'=>$_POST['batchId'],
									  'currency'=>$currency,
									  'amount'=>($check_batch[0]['batch_offer_price']!='')?$check_batch[0]['batch_offer_price']:$check_batch[0]['batch_price'],
									  );
								
							$resp = array('status'=>'1','url'=>$url, 'data'=>$data,'payment_type'=>$payment_type);
						}
    		        }
    		    }else{
					$check_batch = $this->db_model->select_data('*','batches',array('id'=>$_POST['batchId']));
					if($check_batch[0]['batch_type']==1){
							$this->student_signUp($_POST['name'],$_POST['email'],$_POST['mobile'],$_POST['batchId']);
							$resp = array('status'=>'2',);
					}else{
						$payment_type = $this->general_settings('payment_type');
						$url = base_url().'buy-now/'.$_POST['batchId'].'?email='.$_POST['email'].'&mobile='.$_POST['mobile'].'&name='.$_POST['name'];
						$currency = $this->general_settings('currency_code');
						$data = array('name'=>$_POST['name'],
									  'email'=>$_POST['email'],
									  'mobile'=>$_POST['mobile'],
									  'batchId'=>$_POST['batchId'],
									  'currency'=>$currency,
									  'amount'=>($check_batch[0]['batch_offer_price']!='')?$check_batch[0]['batch_offer_price']:$check_batch[0]['batch_price']);
						$resp = array('status'=>'1','url'=>$url, 'data'=>$data,'payment_type'=>$payment_type);
					}
    		    }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }  
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	function razorPaySuccess(){
	    
		 if(!empty($_POST)){
			$admin_id =$this->db_model->select_data('id','users use index (id)',array('role'=>1),1)[0]['id'];
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$mobile = $_POST['mobile'];
			$batchId = $_POST['product_id'];
			$totalAmount = $_POST['totalAmount'];
			$razorpay_payment_id = $_POST['razorpay_payment_id'];
			$prevRecd = $this->db_model->select_data('id as studentId,email as userEmail,name as fullName,enrollment_id as enrollmentId,contact_no as mobile,app_version as versionCode, batch_id as batchId,admin_id as adminId,admission_date as admissionDate, image, token,multi_batch','students use index (id)',array('email'=>$email),1);
               
			if(empty($prevRecd)){
				$siteData = array();
				$siteData['word_for_enroll'] = $this->common->enrollWord;
				$data_arr['admin_id'] = $admin_id;            
				$data_arr['login_status'] = 0;
				$lastrecord = $this->db_model->select_data('id','students use index (id)',array('admin_id'=>$admin_id),1,array('id','desc'),'','','',array(array('students.admin_id',0)));
			
				if(!empty($lastrecord)){
					$last_id = $lastrecord[0]['id'];
				}else{
				    $last_id = 0;
				}
			
				$password = $siteData['word_for_enroll'].$admin_id.$last_id.rand(1000,5000);
				$enrolid = $siteData['word_for_enroll'].$admin_id.$last_id.rand(10,100);
				$data_arr['name'] = $name;
				$data_arr['email'] = $email;
				$data_arr['batch_id'] = $batchId;
				$data_arr['added_by'] = 'student';
				$data_arr['status'] = 1;
				$data_arr['enrollment_id'] = $enrolid;
				$data_arr['password'] = md5($password);
				$data_arr['admission_date'] = date('Y-m-d');
				$data_arr['image']='student_img.png';
				$data_arr['contact_no']= $prevRecd[0]['mobile'];
				$data_arr['login_status']= 0;
				$data_arr['last_login_app']= date("Y-m-d H:i:s");
				 
				$data_arr = $this->security->xss_clean($data_arr);
				$ins = $this->db_model->insert_data('students',$data_arr);
				$arr = array('msg' => 'Payment successfully credited', 'status' => true);
				if($ins){
					$batch_type =$this->db_model->select_data('*','batches use index (id)',array('id'=>$batchId),1);
					if($batch_type[0]['batch_type']==2){
						if(!empty($totalAmount)){
							
						   $amount = $totalAmount;
						}
						
						$data_pay=array(
								   'student_id'=>$ins,
								   'batch_id'=>$batchId,
								   'mode'=> 'Razorpay',
								   'transaction_id'=> !empty($razorpay_payment_id)?$razorpay_payment_id:'',
								   'amount'=> !empty($amount)?$amount:'',
								   'admin_id'=>$_SESSION['admin_id'],
										);
						$data_pay = $this->security->xss_clean($data_pay);
						$insf = $this->db_model->insert_data('student_payment_history',$data_pay);
						
						$this->db_model->update_data_limit('students use index (id)',array('payment_status'=>1),array('id'=>$ins),1);
					}
					$session_arr['customerBatchName']= !empty($batch_type[0]['batch_name'])? trim($batch_type[0]['batch_name']):'';
					$session_arr['customerprice']= !empty($amount)? trim($amount):'';
					//batch asin
					$data_batch= array(
								 'student_id'=>$ins,
								 'batch_id'=>$batchId,
								 'added_by'=>'student',
								 'admin_id'=>$admin_id
										 );
				   $this->db_model->insert_data('sudent_batchs',$data_batch);
					// send email 
					
				   $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
					$subj = $title.'- '.$this->lang->line('ltr_credentials');
				$em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulation').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_enrolment_id').' : '.$enrolid.'<br/><br/>'.$this->lang->line('ltr_password').' : '.$password.'';
					@$this->SendMail($email, $subj, $em_msg);
					$this->session->set_userdata($session_arr);
				}
			}else{
			    
				$siteData = array();
				$data_arr['admin_id'] = $admin_id;
				$data_arr['login_status'] = 0;
				$last_id = $prevRecd[0]['studentId'] ;
				$enrolid = $prevRecd[0]['enrollmentId'];
				$data_arr['name'] = $name;
				$data_arr['batch_id'] = $batchId;
				$data_arr['added_by'] = 'student';
				$data_arr['status'] = 1;
		    	$data_arr['contact_no']= 	$prevRecd[0]['mobile'];
				$data_arr['login_status']= 0;
				$data_arr['last_login_app']= date("Y-m-d H:i:s");
				
				$data_arr = $this->security->xss_clean($data_arr);
				$this->db_model->update_data_limit('students',$data_arr,array('id'=>$last_id));
				
		        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
				 //check batch type
				$batch_type =$this->db_model->select_data('*','batches use index (id)',array('id'=>$batchId),1);
			
                	$data[] = $batch_type[0]['admin_id'];
                    $tempArray = json_decode($prevRecd[0]['multi_batch']);
                    array_push($tempArray, $batch_type[0]['admin_id']);
                    $jsonData = json_encode($tempArray);
			     //   print_r($jsonData);
			     //   die();
			    $this->db_model->update_data_limit('students',array('students.multi_batch'=>$jsonData),array('id'=>$prevRecd[0]['studentId']));
				if($batch_type[0]['batch_type']==2){
					if(!empty($totalAmount)){
							
						   $amount = $totalAmount;
						}
					$data_pay=array(
							   'student_id'=>$last_id,
							   'batch_id'=>$batchId,
							    'mode'=> 'Razorpay',
							 //  'transaction_id'=> !empty($batchId)? $batchId:'',
							 'transaction_id'=> !empty($razorpay_payment_id)?$razorpay_payment_id:'',
							   'amount'=> !empty($amount)?$amount:'',
							 //  'admin_id'=>$_SESSION['admin_id'],
							    'admin_id'=>$batch_type[0]['admin_id'],
									);
					$data_pay = $this->security->xss_clean($data_pay);
					$insg = $this->db_model->insert_data('student_payment_history',$data_pay);
					
					$this->db_model->update_data_limit('students use index (id)',array('payment_status'=>1),array('id'=>$last_id),1);
					
				}
				$session_arr['customerBatchName']= !empty($batch_type[0]['batch_name'])? trim($batch_type[0]['batch_name']):'';
				$session_arr['customerprice']= !empty($amount)? trim($amount):'';
				//batch asin
				$data_batch= array(
								 'student_id'=>$last_id,
								 'batch_id'=>$batchId,
								 'added_by'=>'student',
								  'admin_id'=>$batch_type[0]['admin_id']
										 );
				$this->db_model->insert_data('sudent_batchs',$data_batch);
				// send email 
			   $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
				$subj = $title.'- '.$this->lang->line('ltr_thanks_msg');
					$em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulations').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled_in').' '.$batch_type[0]['batch_name'].'<br/><br/>'.$this->lang->line('ltr_enjoy').'<br/><br/> '.$this->lang->line('ltr_thanks_msg').'<br/><br/>'.$this->lang->line('ltr_eacademy');
				@$this->SendMail($email, $subj, $em_msg);
				
				// $session_arr['customerId']= !empty($last_id)? trim($last_id):'';
				// $session_arr['customerPwd']= !empty($password)? trim($password):'';
				// $session_arr['customerBatchId']= !empty($batchId)? trim($batchId):'';
				$this->session->set_userdata($session_arr);
				
			}
			$resp = array('status'=>'1');
			echo json_encode($resp,JSON_UNESCAPED_SLASHES);
		 }
		    
	}
    
    function student_signUp($name='',$email='',$mobile='',$batchId=''){
	
            $admin_id =$this->db_model->select_data('id','users use index (id)',array('role'=>1),1)[0]['id'];
					
			$prevRecd = $this->db_model->select_data('id as studentId,email as userEmail,name as fullName,enrollment_id as enrollmentId,contact_no as mobile,app_version as versionCode, batch_id as batchId,admin_id as adminId,admission_date as admissionDate, image, token,admin_id','students use index (id)',array('email'=>$email),1);
		
			if(empty($prevRecd)){
				$siteData = array();
				$siteData['word_for_enroll'] = $this->common->enrollWord;
				// $data_arr['admin_id'] = $admin_id; 
	           	if($prevRecd[0]['admin_id']==0){
				    $data_arr['admin_id'] = $admin_id;
				}
				
				$data_arr['login_status'] = 0;
				$lastrecord = $this->db_model->select_data('id','students use index (id)',array('admin_id'=>$admin_id),1,array('id','desc'));             
				if(!empty($lastrecord)){
					$last_id = $lastrecord[0]['id'];
				}else{
					$last_id = 0;
				}
				$password = $siteData['word_for_enroll'].$admin_id.$last_id.rand(1000,5000);
				$enrolid = $siteData['word_for_enroll'].$admin_id.$last_id.rand(10,100);
				$data_arr['name'] = $name;
				$data_arr['email'] = $email;
				$data_arr['batch_id'] = $batchId;
				$data_arr['added_by'] = 'student';
				$data_arr['status'] = 1;
				$data_arr['enrollment_id'] = $enrolid;
				$data_arr['password'] = md5($password);
				$data_arr['admission_date'] = date('Y-m-d');
				$data_arr['image']='student_img.png';
				$data_arr['contact_no']=$mobile;
				//update app version and login status
				$data_arr['login_status']= 0;
				$data_arr['last_login_app']= date("Y-m-d H:i:s");
				$data_arr = $this->security->xss_clean($data_arr);
				$ins = $this->db_model->insert_data('students',$data_arr);
					if($prevRecd[0]['multi_batch']==""){
					   $jsonData =  json_encode(["$admin_id"]);
					}else{
					    $data[] = $prevRecd[0]['admin_id'];
                        $tempArray = json_decode($prevRecd[0]['multi_batch']);
                        array_push($tempArray, $batch_type[0]['admin_id']);
                        $jsonData = json_encode($tempArray);
					}
				 $this->db_model->update_data_limit('students',array('students.multi_batch'=>$jsonData),array('id'=>$prevRecd[0]['studentId']));
				if($ins){
					//batch asin
					$data_batch= array(
								 'student_id'=>$ins,
								 'batch_id'=>$batchId,
								 'added_by'=>'student',
								 'admin_id'=>$batch_type[0]['admin_id']
										 );
				   $this->db_model->insert_data('sudent_batchs',$data_batch);
					// send email 
				   $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
					$subj = $title.'- '.$this->lang->line('ltr_credentials');
					$em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulation').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_enrolment_id').' : '.$enrolid.'<br/><br/>'.$this->lang->line('ltr_password').' : '.$password.'';
					$this->SendMail($email, $subj, $em_msg);
					  
				}
			}else{
			
				$batch_type =$this->db_model->select_data('*','batches use index (id)',array('id'=>$batchId),1);
				$siteData = array();
				$data_arr['login_status'] = 0;
				$last_id = $prevRecd[0]['studentId'];
				$enrolid = $prevRecd[0]['enrollmentId'];
				$password = $prevRecd[0]['password'];
				if($prevRecd[0]['admin_id']==0){
				    $data_arr['admin_id'] = $batch_type[0]['admin_id']; 
				}
				
				$data_arr['name'] = $name;
				$data_arr['batch_id'] = $batchId;
				$data_arr['added_by'] = 'student';
				$data_arr['status'] = 1;
				$data_arr['contact_no']=$prevRecd[0]['mobile'];
				$data_arr['login_status']= 0;
				$data_arr['last_login_app']= date("Y-m-d H:i:s");
			
				$data_arr = $this->security->xss_clean($data_arr);
				$this->db_model->update_data_limit('students',$data_arr,array('id'=>$last_id));
				$this->db_model->update_with_increment('batches','no_of_student',array('id'=>$batchId),'plus',1);
					if($prevRecd[0]['multi_batch']==""){
					   $jsonData =  json_encode(["$admin_id"]);
					}else{
					    $data[] = $prevRecd[0]['admin_id'];
                        $tempArray = json_decode($prevRecd[0]['multi_batch']);
                        array_push($tempArray, $batch_type[0]['admin_id']);
                        $jsonData = json_encode($tempArray);
					}
			    $this->db_model->update_data_limit('students',array('students.multi_batch'=>$jsonData),array('id'=>$prevRecd[0]['studentId']));
			
				//batch asin
				$data_batch= array(
								 'student_id'=>$last_id,
								 'batch_id'=>$batchId,
								 'added_by'=>'student',
								 'admin_id'=>$batch_type[0]['admin_id']
										 );
				$this->db_model->insert_data('sudent_batchs',$data_batch);
				// send email 
			   $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
			   	
				$subj = $title.'- '.$this->lang->line('ltr_thanks_msg');
			    $em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulations').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled_in').' '.$batch_type[0]['batch_name'].'<br/><br/>'.$this->lang->line('ltr_enjoy').'<br/><br/> '.$this->lang->line('ltr_thanks_msg').'<br/><br/>'.$this->lang->line('ltr_eacademy');
				$this->SendMail($email, $subj, $em_msg);
				  
			}
            
    }
	
    function load_moreGallery(){
        if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('limit',false))){
                $limit = array(3,$this->input->post('limit',TRUE));
                $html = '';
                $gallery = $this->db_model->select_data('image,title,video_url','gallery use index (id)',array('status'=>1,'type'=>$this->input->post('type',TRUE)),$limit,array('id','desc'));
            
                if(!empty($gallery)){
                    foreach($gallery as $gal){
                        if($this->input->post('type',TRUE) == 'Image'){
                            $html .= '<div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="edu_porfolio_section">
                                    <img src="'.base_url('uploads/gallery/').$gal['image'].'" alt="">
                                    <div class="edu_overlay">
                                        <a href="'.base_url('uploads/gallery/').$gal['image'].'" title=""><span class="icofont-search-2"></span></a>
                                    </div>
                                </div>
                            </div>';
                        }else{
                            $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1",$gal['video_url']);
                            $html .= '<div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="edu_videoGallery_section">
                                    <iframe src="'.$url.'" frameborder="0" allowfullscreen></iframe>
                                    <div class="edu_videoGalleryTitle">
                                        <h5>'.$gal['title'].'</h5>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                } 
                $resp = array('status'=>'1', 'html' =>$html);
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }   
    }

    /**** Student Section Manage Start ****/

    // function notice_table($id){
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         $post = $this->input->post(NULL,TRUE);
    //         $get = $this->input->get(NULL,TRUE);
    //         if(isset($post['length']) && $post['length']>0){
    //             if(isset($post['start']) && !empty($post['start'])){
    //                 $limit = array($post['length'],$post['start']);
    //                 $count = $post['start']+1;
    //             }else{ 
    //                 $limit = array($post['length'],0);
    //                 $count = 1;
    //             }
    //         }else{
    //             $limit = '';
    //             $count = 1;
    //         }
        
    //         if($post['search']['value'] != ''){
    //             $like = array('title',$post['search']['value']);
    //             $or_like = '';
    //         }else{
    //           $like = ''; 
    //           $or_like = ''; 
    //         }
            
    //         $admin_id = $this->session->userdata('admin_id');
    //         $cond = "admin_id = $admin_id AND status = 1";
           
    //         if($this->session->userdata('role') == 'student'){
    //             if($id == 'all'){
    //                 $cond .= " AND (notice_for = 'Student' OR notice_for = 'Both')";
    //             }else{
    //                 $cond .= " AND student_id = $id";
    //             }
    //         }else{
    //             if($id == 'all'){
    //                 $cond .= " AND (notice_for = 'Teacher' OR notice_for = 'Both')";
    //             }else{
    //                 $cond .= " AND teacher_id = $id";
    //             }
    //         }
    //         //  print_r($cond);
    //         // die();
    //         $notices = $this->db_model->select_data('title,description,date','notices use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
    //         if(!empty($notices)){
    //             $role = $this->session->userdata('role');
    //             if($role == '1'){  
    //                 $profile = 'admin';
    //             }
    
    //             foreach($notices as $not){
    //                 $descriptionWord =$this->readMoreWord($not['description'], 'Description');
    //                 $dataarray[] = array(
    //                             $count,
    //                             $not['title'],
    //                             '<p class="descParaCls">'.$descriptionWord.'</p>',
    //                             date('d-m-Y',strtotime($not['date']))
    //                         ); 
    //                 $count++;
    //             }
    
    //             $recordsTotal = $this->db_model->countAll('notices use index (id)',$cond,'','',$like,'','',$or_like);
    
    //             $output = array(
    //                 "draw" => $post['draw'],
    //                 "recordsTotal" => $recordsTotal,
    //                 "recordsFiltered" => $recordsTotal,
    //                 "data" => $dataarray,
    //             );
    
    //         }else{
    //             $output = array(
    //                 "draw" => $post['draw'],
    //                 "recordsTotal" => 0,
    //                 "recordsFiltered" => 0,
    //                 "data" => array(),
    //             );
    //         }
    //         echo json_encode($output,JSON_UNESCAPED_SLASHES);
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     }
    // }
 function notice_table($id){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post();
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }
        
            if($post['search']['value'] != ''){
                $like = array('title',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            if($this->session->userdata('role') == 1){
                $cond = array('admin_id'=>$this->session->userdata('uid'),'student_id'=> $id,'teacher_id'=>0,'notice_for'=>'');
            }else if($this->session->userdata('role') == 3){
               $cond = array('admin_id'=>$this->session->userdata('admin_id'),'student_id'=> $id,'added_by' =>$this->session->userdata('uid'),'teacher_id'=>0,'notice_for'=>''); 
            }
    
            $notices = $this->db_model->select_data('*','notices use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($notices)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($notices as $not){
                    
                    $descriptionWord =$this->readMoreWord($not['description'], $this->lang->line('ltr_description'));
                    $action = '<p class="actions_wrap"><a class="deleteData btn_delete" title="Delete" data-id="'.$not['id'].'" data-table="notices"><i class="fa fa-trash"></i></a></p>';
    
                   if($not['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$not['id'].'" data-table ="notices" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$not['id'].'" data-table ="notices" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    
                    $added_by = $this->db_model->select_data('name','users use index (id)',array('id'=>$not['added_by']),1);
                    $dataarray[] = array(
                                $count,
                                $not['title'],
                                '<p class="descParaCls">'.$descriptionWord.'</p>',
                                date('d-m-Y',strtotime($not['date'])),
                                (!empty($added_by)?$added_by[0]['name']:''),
                                $statusDrop,
                                $action
                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('notices use index (id)',$cond,'','',$like,'','',$or_like);
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => $dataarray,
                );
    
            }else{
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
            }
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function notification_table($id){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }
        
            if($post['search']['value'] != ''){
                $like = array('msg',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            $admin_id = $this->session->userdata('admin_id');
            
            $notify = $this->db_model->select_data('notification_type,msg,time,url','notifications use index (id)',array('student_id' => $id),$limit,array('id','desc'),$like,'','',$or_like);
            if(!empty($notify)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }

                foreach($notify as $not){
                    $sec = strtotime( $not['time']);  
                    $newdate = date ("d-m-Y H:i", $sec);  
                    $newDate = $newdate . ":00";  
                   
                    $dataarray[] = array(
                                $count,
                                $not['notification_type'],
                               $not['msg'],
                               $newDate,
                            '<p class="actions_wrap"><a href="'.base_url($not['url']).'" target="_blank" class="btn_view"><i class="fa fa-eye"></i></a>'

                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('notifications use index (id)',array('student_id' => $id),'',$like,'','',$or_like);
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => $dataarray,
                );
    
            }else{
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
            }
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    
    function extraclass_table(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            // $like= array('batch_id','"'.$this->session->userdata('batch_id').'"');
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }
        
            if($post['search']['value'] != ''){
                $like = array('extra_classes.description',$post['search']['value']);
            }
    
        //  print_r($_SESSION);
        //  die();
          $cond = array('extra_classes.admin_id'=>$this->session->userdata('admin_id'));
           
    
            if(isset($get['date'])){
                if($get['date']!=''){ 
                    $cond =   array('extra_classes.admin_id'=>$this->session->userdata('admin_id'),'extra_classes.date'=>date('Y-m-d',strtotime($get['date'])));
                }
            }
    
            $classes = $this->db_model->select_data('extra_classes.*,users.name','extra_classes use index (id)',$cond,$limit,array('id','desc'),$like,array('users','users.id = extra_classes.teacher_id'),'');
            
            if(!empty($classes)){
                
                foreach($classes as $cls){
                    
                    $descriptionWord =$this->readMoreWord($cls['description'], 'Description');
                    $dataarray[] = array(
                        $count,
                        date('d-m-Y',strtotime($cls['date'])),
                        date('h:i A',strtotime($cls['start_time'])).' - '.date('h:i A',strtotime($cls['end_time'])),
                        '<p class="descParaCls">'.$descriptionWord.'</p>',
                        $cls['name'],
                    ); 
    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('extra_classes use index (id)',$cond,'','',$like,'','');
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => $dataarray,
                );
    
            }else{
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
            }
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function homewrok_table(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }
        
            if($post['search']['value'] != ''){
                $like = array('homeworks.description',$post['search']['value']);
            }else{
               $like = ''; 
            }
    
            $cond = array('homeworks.admin_id'=>$this->session->userdata('admin_id'),'homeworks.date >= '=>date('Y-m-d'),'homeworks.batch_id'=>$this->session->userdata('batch_id'));
            if(isset($get['date'])){
                if($get['date']!=''){ 
                    $cond =   array('homeworks.admin_id'=>$this->session->userdata('admin_id'),'homeworks.date'=>date('Y-m-d',strtotime($get['date'])),'homeworks.batch_id'=>$this->session->userdata('batch_id'));
                }
            }
    
            $homewrk = $this->db_model->select_data('homeworks.*,users.name,subjects.subject_name','homeworks use index (id)',$cond,$limit,array('id','desc'),$like,array('multiple',array(array('users','users.id = homeworks.teacher_id'),array('subjects','subjects.id = homeworks.subject_id'))),'');
    
            if(!empty($homewrk)){
                
                foreach($homewrk as $hw){
                    $descriptionWord =$this->readMoreWord($hw['description'], 'Description');
                    $dataarray[] = array(
                        $count,
                        date('d-m-Y',strtotime($hw['date'])),
                        $hw['subject_name'],
                        '<p class="descParaCls">'.$descriptionWord.'</p>',
                        $hw['name'],
                    ); 
    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('homeworks use index (id)',$cond,'','',$like,'','');
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => $dataarray,
                );
    
            }else{
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
            }
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function get_paper_details(){
     
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',false))){
                $timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));
    
                if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])){
                    date_default_timezone_set($timezoneDB[0]['timezone']);
                }
    
                $paperDetails = $this->db_model->select_data('*','exams use index (id)',array('id'=>$this->input->post('id',TRUE)),1);
                if(!empty($paperDetails)){
                    if($this->input->post('paper_type',TRUE) == 'practice'){
                        $instructions = '<li>'.$this->lang->line('ltr_all_questions_com').'</li>
                            <li>'.$this->lang->line('ltr_there_will_be').'</li>
                            <li>'.$this->lang->line('ltr_please_do_not').'</li>
                            <li>'.$this->lang->line('ltr_please_read').'</li>';
                        $timeRemain = '<p><span class="edu_paper_smallinfo">'.$this->lang->line('ltr_remaining_time').' : </span><span id="timer"> '.$this->lang->line('ltr_min').'</span></p>';
                        $totalTime = $paperDetails[0]['time_duration'];
                    }else{
                        
                        $current_time = date('Y-m-d H:i:s');
                        $start_time = $paperDetails[0]['mock_sheduled_date'].' '.$paperDetails[0]['mock_sheduled_time'];
                        $end_time =  date('Y-m-d H:i:s', strtotime($start_time.' +'.$paperDetails[0]['time_duration'].' minutes'));
                        
                        if($current_time < $end_time){
                            $time_diff = strtotime($end_time) - time();
                            $remaining_time = ($time_diff/60);
                        }else{
                            $remaining_time = '0';
                        }
                        $totalTime = $remaining_time;
                        $timeRemain = '<p><span class="edu_paper_smallinfo">'.$this->lang->line('ltr_remaining_time').' : </span><span id="timer"> '.$this->lang->line('ltr_min').'</span></p>';
    
                        $instructions = '<li>'.$this->lang->line('ltr_all_questions_com').'</li>
                            <li>'.$this->lang->line('ltr_there_will_be').'</li>
                            <li>'.$this->lang->line('ltr_please_do_not').'</li>
                            <li>'.$this->lang->line('ltr_on_time_completion').'</li>';
                    }
                   
                    $html = ' <!------- Paper Selecion Start -------->
                    <div class="sectionHolder mb_30">
                        <div class="edu_main_wrapper">
                            <h4 class="edu_sub_title padderTop10">'.$this->lang->line('ltr_instructions').'</h4>
                            <ol class="paper_instructions">
                            '.$instructions.'
                            </ol>
                        </div>
                    </div>
                    <!------- Question Papre Start -------->
                    <div class="edu_main_wrapper question_paper_wrapper">
                        <div class="question_paper_inner">
                            <div class="question_paper_header">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 padderBottom30">
                                        <div class="edu_paper_info responsive_center">
                                            <p><span class="edu_paper_smallinfo">'.$this->lang->line('ltr_paper').' : </span>'.$paperDetails[0]['name'].'</p>
                                            <p><span class="edu_paper_smallinfo">'.$this->lang->line('ltr_total_questions').' : </span>'.$paperDetails[0]['total_question'].'</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 padderBottom30">
                                            <div class="edu_paper_info responsive_center text-right">
                                            '.$timeRemain.'<p><span class="edu_paper_smallinfo">'.$this->lang->line('ltr_remaining_questions').': </span><span class="remainingQuest">'.$paperDetails[0]['total_question'].'</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="question_paper_body">
                                <div class="edu_question_section">
                                    <ol>';
    
                                    $questions = json_decode($paperDetails[0]['question_ids'],true);
                                    $question_id = implode(',',$questions);
                                    $questionData = $this->db_model->select_data('id,question,options,answer','questions use index (id)',"id in ($question_id)",'',array('id','desc'));
                                    
                                    if(!empty($questions)){
                                        $i = 1;
                                        
                                        if($paperDetails[0]['format'] == 1){
                                           $questionData = $this->shuffle_array($questionData);
                                        }
                                        foreach($questionData as $ques){
                                            
                                            $html .= '<li>
                                                <div class="edu_single_question_wrap questionDesrpWrap" data-id="'.$ques['id'].'" data-ans="'.$ques['answer'].'">
                                                    <div class="edu_single_question">
                                                        <p><span>'.$i.'.</span> '.$ques['question'].'</p>
                                                        <div class="edu_rest_btn resetAnswer"><a href="javascript:void(0)"><i class="icofont-ui-reply"></i></a></div>
                                                    </div>
                                                    <div class="edu_question_options">
                                                        <ol>';
                                                        $options = json_decode($ques['options'],true);
                                        $j = 'A';
                                        $k=1;
                                                        foreach($options as $op){
                                                            $html .= '<li><label><input type="radio" name="options_'.$i.'" value="'.$j.'" class="questionOptionRad">&nbsp;'.$op.'</label></li>';
                                        $j++;
                                        $k++;             
                                                        }
                                                        $html .= '</ol>
                                                    </div>
                                                </div>
                                            </li>';
                                            $i++;
                                            
                                        }
                                    }
                                        
                            $html .= '</ol>
                                </div>
                            </div>
                            <div class="question_paper_footer">
                                <div class="edu_btn_wrapper">
                                    <form method="post">
                                        <input type="hidden" name="paper_id" value="'.$this->input->post('id',TRUE).'">
                                        <input type="hidden" name="paper_name" value="'. $paperDetails[0]['name'].'">
                                        <input type="hidden" name="total_question" value="'. $paperDetails[0]['total_question'].'">
                                        <input type="hidden" name="start_time" id="start_time" value="'.date("H:i:s").'">
                                        <input type="hidden" name="time_duration" value="'.$paperDetails[0]['time_duration'].'">
                                        <input type="hidden" name="submit_time" id="submit_time" value="">
                                        <input type="hidden" name="paper_type" value="'.$this->input->post('paper_type',TRUE).'">
                                        <button type="button" class="edu_admin_btn submitPopupShow">'.$this->lang->line('ltr_submit').'</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!------- Question Papre End -------->';
                    if(isset($end_time) && (date('Y-m-d H:i:s') >= $end_time)){
                        $html = '<div class="sectionHolder mockPaperTimerWrapper mb_30 text-center">
                            <div class="edu_main_wrapper">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h4 class="edu_sub_title nomarginbtm">'.$this->lang->line('ltr_time_over').'</h4>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
    
                    $resp = array('status'=>'1', 'html' => $html,'totalTime' => $totalTime,'paper_type' => $this->input->post('paper_type',TRUE));
                }else{
                    $resp = array('status'=>'0', 'html' => '','totalTime' => 0);
                }
                
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function shuffle_array($array) {
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        return $new;
    }
function submit_paper(){
// 		print_r($_POST);
// 		die;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('question_answer',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                if($data_arr['paper_type'] == 'practice'){
                    $table = 'practice_result';
                    $url = base_url('student/practice-result');
                    $prevdata = array();
                }else{
                    $table = 'mock_result';
                    $url = base_url('student/mock-result');
                    $prevdata = $this->db_model->select_data('id','mock_result use index (id)',array('student_id'=>$this->session->userdata('uid'),'admin_id'=>$this->session->userdata('admin_id'),'paper_id'=>$this->input->post('paper_id',TRUE)),1);
                }
                unset($data_arr['paper_type']);
                $data_arr['admin_id'] = $this->session->userdata('admin_id');
                $data_arr['student_id'] = $this->session->userdata('uid');
                $data_arr['date'] = date('Y-m-d');
                $data_arr['attempted_question'] = count(json_decode($data_arr['question_answer'],true));
                /*code for percentage  calculation */
                 $rightCount = 0;
                 $wrongCount = 0;
                 $attemptedQuestion = json_decode($data_arr['question_answer'],true);
                 $question_ids = implode(',',array_keys($attemptedQuestion));
               
                 $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')');
                        $c = 0;
                
                 foreach($attemptedQuestion as $key=>$value){
                    if(isset($right_ansrs[$c])){
                        if(($key == $right_ansrs[$c]['id']) && ($value == $right_ansrs[$c]['answer'])){
                                    $rightCount++;
                                }else{
                                    $wrongCount++;
                                }
                            }
                            $c++;
                 }
                //  $pp = (( $rightCount - ($wrongCount*0.25) )*100 );
                //  $percentage = ($pp/$data_arr['total_question']);
                 $total_score = ($rightCount - ($wrongCount*0.25))/$data_arr['total_question'];
                 $percentage = $total_score*100;
                 //$percentage = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
                 $data_arr['percentage']=number_format((float)$percentage, 2, '.', '');
                 
                 /*code for percentage  calculation End*/
                if(empty($prevdata)){
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->insert_data($table,$data_arr);
                    if($ins){
                        $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_paper_submitted'),'url'=>$url);
                    }else{
                        $resp = array('status'=>'0');
                    }
                }else{
                    $resp = array('status'=>'3', 'url'=>$url);
                }
            }else{
                $resp = array('status'=>'2', 'msg' => $this->lang->line('ltr_paper_attempt'));
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    // function submit_paper(){
    //      $current_time = date('H:i:s');

    //     // echo ($current_time);
    //     // print_r($_POST);
    //     // die();
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         if(!empty($this->input->post('question_answer',TRUE))){
    //             $data_arr = $this->input->post(NULL,TRUE);
    //             if($data_arr['paper_type'] == 'practice'){
    //                 $table = 'practice_result';
    //                 $url = base_url('student/practice-result');
    //                 $prevdata = array();
    //             }else{
    //                 $table = 'mock_result';
    //                 $url = base_url('student/mock-result');
    //                 $prevdata = $this->db_model->select_data('id','mock_result use index (id)',array('student_id'=>$this->session->userdata('uid'),'admin_id'=>$this->session->userdata('admin_id'),'paper_id'=>$this->input->post('paper_id',TRUE)),1);
    //             }
    //             unset($data_arr['paper_type']);
    //             $data_arr['admin_id'] = $this->session->userdata('admin_id');
    //             $data_arr['student_id'] = $this->session->userdata('uid');
    //             $data_arr['date'] = date('Y-m-d');
    //             $data_arr['attempted_question'] = count(json_decode($data_arr['question_answer'],true));
    //             /*code for percentage  calculation */
    //              $rightCount = 0;
    //              $wrongCount = 0;
    //              $attemptedQuestion = json_decode($data_arr['question_answer'],true);
    //              $question_ids = implode(',',array_keys($attemptedQuestion));
               
    //              $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')');
    //                     $c = 0;
                
    //              foreach($attemptedQuestion as $key=>$value){
    //                 if(isset($right_ansrs[$c])){
    //                     if(($key == $right_ansrs[$c]['id']) && ($value == $right_ansrs[$c]['answer'])){
    //                                 $rightCount++;
    //                             }else{
    //                                 $wrongCount++;
    //                             }
    //                         }
    //                         $c++;
    //              }
    //             //  $pp = (( $rightCount - ($wrongCount*0.25) )*100 );
    //             //  $percentage = ($pp/$data_arr['total_question']);
    //              $total_score = ($rightCount - ($wrongCount*0.25))/$data_arr['total_question'];
    //              $percentage = $total_score*100;
    //              //$percentage = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
    //              $data_arr['percentage']=number_format((float)$percentage, 2, '.', '');
                 
    //              /*code for percentage  calculation End*/
    //             if(empty($prevdata)){
    //                 $data_arr = $this->security->xss_clean($data_arr);
    //                 $ins = $this->db_model->insert_data($table,$data_arr);
    //                 if($ins){
    //                     $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_paper_submitted'),'url'=>$url);
    //                 }else{
    //                     $resp = array('status'=>'0');
    //                 }
    //             }else{
    //                 $resp = array('status'=>'3', 'url'=>$url);
    //             }
    //         }else{
    //             $resp = array('status'=>'2', 'msg' => $this->lang->line('ltr_paper_attempt'));
    //         }
    //         echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     } 
    // }
    // function result_table($type){
    //     //  print_r($type);
    //     // die();
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         $post = $this->input->post(NULL,TRUE);
    //         $get = $this->input->get(NULL,TRUE);
    //         if(isset($post['length']) && $post['length']>0){
    //             if(isset($post['start']) && !empty($post['start'])){
    //                 $limit = array($post['length'],$post['start']);
    //                 $count = $post['start']+1;
    //             }else{ 
    //                 $limit = array($post['length'],0);
    //                 $count = 1;
    //             }
    //         }else{
    //             $limit = '';
    //             $count = 1;
    //         }
                            
           
    //         if($post['search']['value'] != ''){
    //             $like = array('name',$post['search']['value']);
    //         }else{
    //           $like = '';
    //         }
            
    //         $cond = array("admin_id"=>$this->session->userdata('admin_id'),'student_id'=>$this->session->userdata('uid'));
    
    //         if(isset($get['month']) || isset($get['year'])){
    //             if($get['month']!='' && $get['year']!=''){ 
    //                 $datefiltr = $get['year'].'-'.$get['month'];
    //                 if($type == 'practice'){
    //                   $like = array('date(added_at)',$datefiltr); 
    //                 }else{
    //                   $like = array('mock_sheduled_date',$datefiltr); 
    //                 }
                     
    //             }
    //         }
    
            
    //         if($type == 'practice'){
    //           $table_name = 'practice_result';
    //           $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>2,'batch_id'=>$this->session->userdata('batch_id'));
    //         }else{
    //           $table_name = 'mock_result';
    //           $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>1,'concat(mock_sheduled_date ," ",mock_sheduled_time)<=' => date('Y-m-d H:i:s'),'batch_id'=>$this->session->userdata('batch_id'));
    //         }
            
    //         if(isset($get['paper'])){
    //             if($get['paper']!=''){
    //                 $cond1['id'] = $get['paper'];  
    //             }
    //         }

    //         $exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,$limit,array('id','desc'),$like);
           
    //         $recordsTotal = $this->db_model->countAll('exams use index (id)',$cond1,'','','');
    //       //    print_r($recordsTotal);
    //       // die();
    //       if($exam_Data){
            
    //       foreach($exam_Data as $exams){
               
    //           $cond['paper_id'] = $exams['id'];  
    //         $result_data = $this->db_model->select_data('*', $table_name.' use index (id)',$cond,'',array('id','desc'));
           
    //         if(!empty($result_data)){
    //             foreach($result_data as $result){
    
    //                 $attemptedQuestion = json_decode($result['question_answer'],true);
    //                 //print_r($attemptedQuestion);
    //                 if(!empty($result['question_answer'])){
    //                     $question_ids = implode(',',array_keys($attemptedQuestion));
    //                     if(!empty($question_ids)){
    //                         $right_ansrs = current($this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')'));
    //                     }else{
    //                         $right_ansrs = array();
    //                     }
                        
    //                     $rightCount = 0;
    //                     $wrongCount = 0;
    //                     $c = 0;
    //                     foreach($attemptedQuestion as $key=>$value){
    //                         $right_ansrs = current($this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key)));
    //                         if(($key == $right_ansrs['id']) && ($value == $right_ansrs['answer'])){
    //                             $rightCount++;
    //                         }else{
    //                             $wrongCount++;
    //                         }
                          
    //                     }
        
    //                     $per_data = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
    //                     //update percentage
    //                     if($per_data < 0){
    //                         $percentage = 0;
    //                     }else{
    //                         $percentage =$per_data;
    //                     }
    //                     // print_r($percentage);
    //                     // die();
    //                     $PN = number_format((float)$percentage, 2, '.', '');
                        
    //                     $this->db_model->update_data_limit($table_name.' use index (id)',$this->security->xss_clean(array('percentage'=>$PN)),array('id'=>$result['id']));
    //                     $url = base_url('student/answer-sheet/'.$type.'/'.$result['id'].'/'.$exams['id']);
        
    //                     $action = '<p class="actions_wrap"><a href="'.$url.'" target="_blank" class="btn_view"><i class="fa fa-eye"></i></a>';
        
    //                     $time_taken = '';
    //                     if($result['start_time']!="" || $result['submit_time']!=""){
    //                         $stime=strtotime($result['start_time']);
    //                         $etime=strtotime($result['submit_time']);
    //                         $elapsed = $etime - $stime;
    //                         $time_taken = gmdate("H:i", $elapsed);
    //                     }
                       
    //                     // $dataarray[] = array(
    //                     //     $count,
    //                     //     $result['paper_name'],
    //                     //     date('d-m-Y',strtotime($result['date'])),
    //                     //     date('h:i A',strtotime($result['start_time'])),
    //                     //     date('h:i A',strtotime($result['submit_time'])),
    //                     //     $result['total_question'],
    //                     //     $result['attempted_question'],
    //                     //     gmdate("H:i", $result['time_duration']*60),
    //                     //     $time_taken,
    //                     //     $rightCount,
    //                     //     number_format((float)$percentage, 2, '.', ''),
    //                     //     $action,
    //                     // ); 
    //                     $dataarray[] = array(
    //                         $count,
    //                         $result['paper_name'],
    //                         date('d-m-Y',strtotime($result['date'])),
    //                         date('h:i A',strtotime($result['start_time'])),
    //                         date('h:i A',strtotime($result['submit_time'])),
    //                         $result['total_question'],
    //                         $result['attempted_question'],
    //                         gmdate("H:i:s", $result['time_duration']*60),
    //                         $time_taken,
    //                         $rightCount,
    //                         number_format((float)$percentage, 2, '.', ''),
    //                         $action,
    //                     ); 
                        
    //                     $count++;
    //                 }
    //             }
    //         }
    //       }
            
          
    //       $output = array(
    //                 "draw" => $post['draw'],
    //                 "recordsTotal" => $recordsTotal,
    //                 "recordsFiltered" => $recordsTotal,
    //                 "data" => (!empty($dataarray) ? $dataarray : ''),
    //             );
    //       }else{
            
    //           $output = array(
    //                 "draw" => $post['draw'],
    //                 "recordsTotal" => 0,
    //                 "recordsFiltered" => 0,
    //                 "data" => array(),
    //             );
    //       }
           
    //         echo json_encode($output,JSON_UNESCAPED_SLASHES);
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     }
    // }
    
   function result_table($type) {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }
            
            
        
            if($post['search']['value'] != ''){
                $like = array('name',$post['search']['value']);
            }else{
               $like = '';
            }
            
            $cond = array("admin_id"=>$this->session->userdata('admin_id'),'student_id'=>$this->session->userdata('uid'));
    
            if(isset($get['month']) || isset($get['year'])){
                if($get['month']!='' && $get['year']!=''){ 
                    $datefiltr = $get['year'].'-'.$get['month'];
                    if($type == 'practice'){
                       $like = array('date(added_at)',$datefiltr); 
                    }else{
                       $like = array('mock_sheduled_date',$datefiltr); 
                    }
                     
                }
            }
    
            
            if($type == 'practice'){
               $table_name = 'practice_result';
               $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>2,'batch_id'=>$this->session->userdata('batch_id'));
            }else{
               $table_name = 'mock_result';
               $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>1,'concat(mock_sheduled_date ," ",mock_sheduled_time)<=' => date('Y-m-d H:i:s'),'batch_id'=>$this->session->userdata('batch_id'));
            }
            
            if(isset($get['paper'])){
                if($get['paper']!=''){
                    $cond1['id'] = $get['paper'];  
                }
            }
           
            $exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,$limit,array('id','desc'),$like);
            
            $recordsTotal = $this->db_model->countAll('exams use index (id)',$cond1,'','','');
           if($exam_Data){
            
           foreach($exam_Data as $exams){
               
               $cond['paper_id'] = $exams['id'];  
            $result_data = $this->db_model->select_data('*', $table_name.' use index (id)',$cond,'',array('id','desc'));
           
            if(!empty($result_data)){
                foreach($result_data as $result){
    
                    $attemptedQuestion = json_decode($result['question_answer'],true);
                    //print_r($attemptedQuestion);
                    if(!empty($result['question_answer'])){
                        $question_ids = implode(',',array_keys($attemptedQuestion));
                        if(!empty($question_ids)){
                            $right_ansrs = current($this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')'));
                        }else{
                            $right_ansrs = array();
                        }
                        
                        $rightCount = 0;
                        $wrongCount = 0;
                        $c = 0;
                        foreach($attemptedQuestion as $key=>$value){
                            $right_ansrs = current($this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key)));
                            if(($key == $right_ansrs['id']) && ($value == $right_ansrs['answer'])){
                                $rightCount++;
                            }else{
                                $wrongCount++;
                            }
                          
                        } 
        
                        $per_data = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
                        //update percentage
						if($per_data < 0){
                            $percentage = 0;
                        }else{
                            $percentage =$per_data;
                        }
                        $PN = number_format((float)$percentage, 2, '.', '');
                        
                        $this->db_model->update_data_limit($table_name.' use index (id)',$this->security->xss_clean(array('percentage'=>$PN)),array('id'=>$result['id']));
                        $url = base_url('student/answer-sheet/'.$type.'/'.$result['id'].'/'.$exams['id']);
        
                        $action = '<p class="actions_wrap"><a href="'.$url.'" target="_blank" class="btn_view"><i class="fa fa-eye"></i></a>';
        
                        $time_taken = '';
                        if($result['start_time']!="" || $result['submit_time']!=""){
                            $stime=strtotime($result['start_time']);
                            $etime=strtotime($result['submit_time']);
                            $elapsed = $etime - $stime;
                            $time_taken = gmdate("H:i:s", $elapsed);
                        }
                       
                        $dataarray[] = array(
                            $count,
                            $result['paper_name'],
                            date('d-m-Y',strtotime($result['date'])),
                            date('h:i A',strtotime($result['start_time'])),
                            date('h:i A',strtotime($result['submit_time'])),
                            $result['total_question'],
                            $result['attempted_question'],
                            gmdate("H:i:s", $result['time_duration']*60),
                            $time_taken,
                            $rightCount,
                            number_format((float)$percentage, 2, '.', ''),
                            $action,
                        ); 
                        
                        $count++;
                    }
                }
            }
           }
           $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => (!empty($dataarray) ? $dataarray : ''),
                );
           }else{
               $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
           }
           
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    /**** Student Section Manage End ****/
    
    function readMoreWord($story_desc, $title='',$C_word='') {
        $chars = 90;
        if(!empty($C_word)){
            $chars =$C_word;
        }
        
        $count_word = strlen($story_desc);
        if($count_word>$chars){
            $readMore = '<a class="charaViewPopupModel" data-title="'.$title.'" data-word="'.$story_desc.'"  href="javascript:;"> ....</a>';
    	    $story_desc = substr($story_desc,0,$chars);  
    	    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    	    $story_desc = $story_desc.' '.$readMore;  
    	    return $story_desc;  
    	    
        }else{
            return $story_desc; 
        }
    }
	public function SendMail($tomail='', $subject='', $msg=''){
            $frommail =$this->general_settings('smtp_mail');
            $frompwd =$this->general_settings('smtp_pwd');
            $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];

            $this->load->library('email');
            $config = array();
            $config['protocol'] = $this->general_settings('server_type');
            $config['smtp_host'] = $this->general_settings('smtp_host');
            $config['smtp_port'] = $this->general_settings('smtp_port');
            $config['smtp_user'] = $frommail;
            $config['smtp_pass'] = $frompwd;
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['smtp_crypto'] = $this->general_settings('smtp_encryption');
            $config['newline'] = "\r\n";
            
            // Set to, from, message, etc.
            $this->email->initialize($config);
            $this->email->from($frommail, $title);
            $this->email->to($tomail);
            
            $this->email->subject($subject);
            $this->email->message($msg);
            
           @$this->email->send();
            return true;
        }
        
        function search_batch(){
             if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
        $data['batch_Data'] = $this->db_model->select_data('*', 'batches use index (id)',array('status'=>'1'),'',array('id','desc'),array('batch_name',$post['course_name']));
         $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
        if(!empty($data['batch_Data'])){
            $data['batches'] =  $data['batch_Data'] ;
        }
       	    $result = $this->load->view('frontend/search_batch_data',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
             }
            
        }
        
            function search_student_batch(){
             if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
          
        $data['batch_Data'] = $this->db_model->select_data('*', 'batches use index (id)',"batch_name LIKE '%".$post['course_name']."%' AND status=1");
        // echo $this->db->last_query();
         $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
         $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);

        if(!empty($data['batch_Data'])){
            $data['batches'] =  $data['batch_Data'] ;
        }
       	    $result = $this->load->view('frontend/search_studbatch_data',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
             }
            
        }
        
         function search_student_cat(){
             if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
           
        $data['batch_Data'] = $this->db_model->select_data('*', 'batches use index (id)',array('status'=>'1'),'',array('id','desc'),array('sub_cat_id',$post['id']));
        
         $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
         $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);

        if(!empty($data['batch_Data'])){
            $data['batches'] =  $data['batch_Data'];
        }
       	    $result = $this->load->view('frontend/search_studbatch_data',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
             }
            
        }
        
        function search_singleCatData(){
            
             if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
         
					   $cond = array('status'=>1,'id'=>$post['id']);
					    $data['category'] = $this->db_model->select_data('*','batch_category',$cond);
					   $cond_sub = array('status'=>1,'cat_id'=>$data['category'][0]['id']);
					    $subCategory = $this->db_model->select_data('id as SubcategoryId,name as SubcategoryName','batch_subcategory use index (id)',$cond_sub);
					   // echo $this->db->last_query();
					    if(!empty($subCategory)){
					        
					        foreach($subCategory as $subkey=>$value){
					   
					   $cond_sub1 = array('status'=>1,'sub_cat_id'=>$value['SubcategoryId']);
					   
	                $batchData = $this->db_model->select_data('*','batches use index (id)',$cond_sub1,'',array('id','desc'));
	                
                    $subCategory[$subkey]['batchdata'] = $batchData;
                       
	            }
	            
	            $data['batch_Data'] = $subCategory;
        }
        
         $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
         $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);

        if(!empty($data['batch_Data'])){
            $data['batches'] =  $data['batch_Data'] ;
        }
      
       	    $result = $this->load->view('frontend/singleCatData',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
             }
        }
}
