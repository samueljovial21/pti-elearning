<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_profile extends CI_Controller {
 
	function __construct(){
		parent::__construct();	
		 $timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));
		if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])){
            date_default_timezone_set($timezoneDB[0]['timezone']);
        }
		if(!empty($_SESSION['role'])){
	        if($_SESSION['role']=='student'){
	            redirect(base_url('student/dashboard')); 
	        }else if($_SESSION['role']==3){
	            redirect(base_url('teacher/dashboard')); 
	        }
	    }else{
	        redirect(base_url('login'));
	    }
		
		// check select language
		$this->load->helper('language');
		$language = $this->general_settings('language_name');
		if($language=="french"){
			$this->lang->load('french_lang', 'french');
		}else if($language=="arabic"){
			$this->lang->load('arabic_lang', 'arabic');
		}else{
			$this->lang->load('english_lang', 'english');
		}
			
		
	}
	public function index()
	{
		$header['title'] = $this->lang->line('ltr_dashboard');
		$uid = $this->session->userdata('uid');
		$data['exam'] = $this->db_model->select_data('id,name','exams  use index (id)',array('admin_id'=>$this->session->userdata('uid'),'type'=>1,'mock_sheduled_date <='=>date('Y-m-d')),'1',array('id','desc'));
		$data['all_batches'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',array('status'=>'1'),'',array('id','desc'));
		if(!empty($data['exam'])){
		$data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));

	   $data['good'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >='=>80));
	   
	   $data['poor'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>60));
	   
	   $data['avarage'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>80,'mock_result.percentage >='=>60));
		}
		$data['doubts_data'] = $this->db_model->countAll('student_doubts_class');
		$data['doubts_data_aprove'] = $this->db_model->countAll('student_doubts_class',array('status'=>1));
		$data['doubts_data_pending'] = $this->db_model->countAll('student_doubts_class',array('status'=>0));
		if($this->session->userdata('super_admin')==1 && $this->session->userdata('role')==1){
		   $condd = array('admin_id'=>$this->session->userdata('uid'));
		   $cnd = array('admin_id'=>$this->session->userdata('uid'),'mode'=>'offline');
		   $cnd1 = array('admin_id'=>$this->session->userdata('uid'),'mode'.'!='=>'offline');
		   $or_like = array(array('students.admin_id',0));
		}else if($this->session->userdata('super_admin')==0 && $this->session->userdata('admin_id')==1){
		   $condd = array('admin_id'=>$this->session->userdata('uid'));
		   $cnd = array('admin_id'=>$this->session->userdata('uid'),'mode'=>'offline');
		   $cnd1 = array('admin_id'=>$this->session->userdata('uid'),'mode'.'!='=>'offline');
		   $or_like = array(array('students.admin_id',0));
		}	

// 		$data['currSin'] = $this->db_model->select_data('*','general_settings',$condd);
		$data['currSin'] = $this->db_model->select_data('*','general_settings');
		$data['Amount'] = $this->db_model->aggregate_data('student_payment_history','amount','sum',$condd);
	    $data['offline'] =	$this->db_model->countAll('student_payment_history',$cnd);
	    $data['online'] =	$this->db_model->countAll('student_payment_history',$cnd1);
		$data['all_user'] = $this->db_model->select_data('id,name,role','users use index (id)',array('super_admin'=>0 , 'role'=>1));
		$this->load->library('admincommon');
		$data['dashboard_count']=$this->admincommon->admin_dashboard($uid,$_SESSION['super_admin'],$_SESSION['role']);
		$this->load->view('common/admin_header',$header);
		$this->load->view('admin/dashboard',$data);
		$this->load->view('common/admin_footer');
	}
	function student_doubts_class(){
		$header['title']=$this->lang->line('ltr_doubts_class');
		$admin_id = $this->session->userdata('uid');
		
		$subCon = "admin_id = $admin_id ";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$data['doubts_class_data'] = $this->db_model->select_data('doubt_id','student_doubts_class','',1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("teacher/doubts_class",$data); 
		$this->load->view("common/admin_footer");
	}
	function general_settings($key_text=''){
		$data = $this->db_model->select_data('*','general_settings',array('key_text'=>$key_text),1);
		return $data[0]['velue_text'];
	}
	
	function profile(){
		$header['title'] = $this->lang->line('ltr_change_password');
		$this->load->view('common/admin_header',$header);
		$this->load->view('admin/profile');
		$this->load->view('common/admin_footer');
	}

	function course_manage(){
		$header['title'] = $this->lang->line('ltr_manage_course');
		$this->load->view('common/admin_header',$header);
		$this->load->view('admin/course_manage');
		$this->load->view('common/admin_footer');
	}
	function blog_manage(){
		$header['title'] = $this->lang->line('ltr_blog_manage');
		$this->load->view('common/admin_header',$header);
		$this->load->view('admin/blog_manage');
		$this->load->view('common/admin_footer');
	}
// 	function batch_manage(){
// 		$header['title']= $this->lang->line('ltr_batch_manager');
// 		$this->load->view("common/admin_header",$header); 
// 		$dateToDay = date('Y-m-d');
// 		$batches = $this->db_model->select_data('*','batches  use index (id)',array('status'=>1,'end_date <='=>$dateToDay),'',array('id','desc'));
// 		$toDateTime = strtotime(date('Y-m-d H:i:s'));
// 		foreach($batches as $key){
		    
// 		    $endDateTime = strtotime($key['end_date'].' '.$key['end_time']);
// 		    if($toDateTime>=$endDateTime){
// 		        $data_arr=array('status'=>0);
// 		        $this->db_model->update_data_limit('batches',$data_arr,array('id'=>$key['id']),1);
// 		    }
		    
// 		}
// 		$data['batch_data'] = $this->db_model->select_data('*','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),1);
// 		$this->load->view("admin/batch_manage",$data);
// 		$this->load->view("common/admin_footer");
// 	}
	
	function batch_manage(){
		$header['title']= $this->lang->line('ltr_batch_manager');
		$this->load->view("common/admin_header",$header); 
		$dateToDay = date('Y-m-d');
		$batches = $this->db_model->select_data('*','batches  use index (id)',array('status'=>1,'end_date <='=>$dateToDay),'',array('id','desc'));
		$toDateTime = strtotime(date('Y-m-d H:i:s'));
		foreach($batches as $key){
		    
		    $endDateTime = strtotime($key['end_date'].' '.$key['end_time']);
		    if($toDateTime>=$endDateTime){
		        $data_arr=array('status'=>0);
		        $this->db_model->update_data_limit('batches',$data_arr,array('id'=>$key['id']),1);
		    }
		    
		}
        $cat_id = $this->input->get('category_id');
        $sub_cat_id = $this->input->get('sub_category_id');
            if($cat_id != null){

                $this->session->set_userdata(['cat_id'=>$cat_id]);
                $this->session->set_userdata(['sub_cat_id'=>$sub_cat_id]);

            }
            if($sub_cat_id != null){

                $this->session->set_userdata(['sub_cat_id'=>$sub_cat_id]);

            }

        if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            //$cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
            $cond = "";
        }else{
            $cond = "";
            //$cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
             
        }

        $data['batch_data'] = $this->db_model->select_data('*','batches use index (id)',$cond,1);
		$data['category'] = $this->db_model->select_data('id,name','batch_category',array('status'=>1));
        $data['selected_cat_id'] = $this->session->userdata('cat_id');
        $data['selected_sub_cat_id'] = $this->session->userdata('sub_cat_id');
        $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('super_admin'=>0 , 'role'=>1));
        // $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1)); 
//        $data['selected_data'] = $this->db_model->select_data('*');
		if( $this->session->userdata('cat_id') != NULL ) {
            $data['sub_category'] = $this->db_model->select_data('id,name','batch_subcategory',array('status'=>1,'cat_id'=> $this->session->userdata('cat_id')));
        }

		$this->load->view("admin/batch_manage",$data);
		$this->load->view("common/admin_footer");
	}
	
	function batch_cat_manage(){
		$header['title']= $this->lang->line('ltr_batch_cat_manager');
	    $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('super_admin'=>0 , 'role'=>1));
// 		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header); 
		$data['cat_data'] = $this->db_model->countAll('batch_category use index (id)');
		$this->load->view("admin/batch_cat_manage",$data);
		$this->load->view("common/admin_footer");
	}
	
	function batch_subcat_manage(){
		$header['title']= $this->lang->line('ltr_batch_subcat_manager');
	    if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
           $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }else{
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }
		$this->load->view("common/admin_header",$header); 
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',$cond);
		$data['category_data'] = $this->db_model->select_data('*','batch_category use index (id)',$cond,'',array('id','desc'));
		$data['subcat_data'] = $this->db_model->countAll('batch_subcategory use index (id)',$cond);
		$this->load->view("admin/batch_subcat_manage",$data);
		$this->load->view("common/admin_footer");
	}
	 
    function live_class(){
        $header['title']=$this->lang->line('ltr_live_class');
        if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }else{
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }
        // $data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',array('admin_id'=>$this->session->userdata('uid'),'status'=>1),'',array('id','desc'));
        $data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$cond,'',array('id','desc'),'','');
        $data['android_key'] = $this->db_model->select_data('*','zoom_api_credentials');
		$data['live_data'] = $this->db_model->countAll('live_class_setting',$cond);
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header); 
		$this->load->view("admin/live_class",$data);
		$this->load->view("common/admin_footer");
    }
    
    function live_class_history(){
        $header['title']=$this->lang->line('ltr_live_class_history');
         if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
             $cond1 = array('admin_id'=>1 , 'role'=>1);
        }else{
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
            $cond1 = array('admin_id'=>1 , 'role'=>1);
        }
        $data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$cond,'',array('id','desc'));
        $data['live_data'] = $this->db_model->countAll('live_class_history');
         $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',$cond1);
		$this->load->view("common/admin_header",$header); 
		$this->load->view("admin/live_class_history",$data);
		$this->load->view("common/admin_footer");
    }
	function add_batch($id=''){ 
	    
		$data['batch_id'] = $id;
		if(!empty($id)){
			$data['batch_data'] = $this->db_model->select_data('*','batches use index (id)',array('admin_id'=>$this->session->userdata('uid'),'id'=>$id));
			$data['batch_fecherd'] = $this->db_model->select_data('*','batch_fecherd',array('batch_id'=>$id));
			$header['title']=$this->lang->line('ltr_edit_batch');
		}else{
			$header['title']=$this->lang->line('ltr_add_batch');
		}
		if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
             $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }else{
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }
		$data['currency_code'] = $this->db_model->select_data('*','general_settings',array('key_text'=>'currency_decimal_code'))[0]['velue_text'];
		$data['subject'] = $this->db_model->select_data('id,subject_name,no_of_questions','subjects use index (id)',$cond,'',array('id','desc'));
	    $data['category_data'] = $this->db_model->select_data('*','batch_category use index (id)',$cond,'',array('id','desc'));
		$data['subcat_data'] = $this->db_model->select_data('*','batch_subcategory use index (id)',$cond,'',array('id','desc'));

		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/add_batch",$data); 
		$this->load->view("common/admin_footer");
	}

	function student_manage(){
		$header['title']=$this->lang->line('ltr_student_manager');
		        
		if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            $cond = array('admin_id'=>$this->session->userdata('uid'));
            $or_like = "";
        }else{
            $cond = array('admin_id'=>$this->session->userdata('uid'));
             if($student_data[0][id] == $_SESSION['uid']){
                $or_like = "";
            }else{
                $or_like = array(array('students.multi_batch',implode(",",json_decode($student_data[0]['multi_batch']))));
            }
        }
		$data['batch_name'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',array('admin_id'=>$this->session->userdata('uid'),'status'=>1),'',array('id','desc'));
		$data['student_data'] = $this->db_model->countAll('students',$cond,'','','','','',$or_like);
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/student_manage",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function add_student($id=''){
		$header['title']=$this->lang->line('ltr_add_student');
		$data['student_id'] = $id;

		if(!empty($id)){
// 			$data['student_data'] = $this->db_model->select_data('*','students use index (id)',array('admin_id'=>$this->session->userdata('uid'),'id'=>$id));
			$data['student_data'] = $this->db_model->select_data('*','students use index (id)',array('id'=>$id));
			$header['title']=$this->lang->line('ltr_edit_student');
		}else{
			$header['title']=$this->lang->line('ltr_add_student');
		}
		if($_SESSION['super_admin']==1){
		    $condon = array('admin_id'=>$_SESSION['uid'],'status'=>1,'pay_mode'=>'Online');
		    $condof = array('admin_id'=>$_SESSION['uid'],'status'=>1,'pay_mode'=>'offline');
		}else{
		     $condon = array('admin_id'=>$this->session->userdata('uid'),'status'=>1,'pay_mode'=>'Online');
		    $condof = array('admin_id'=>$this->session->userdata('uid'),'status'=>1,'pay_mode'=>'offline');
		}
		$data['batch_name_online'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$condon,'',array('id','desc'));
		$data['batch_name_offline'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$condof,'',array('id','desc'));
// 		print_r($data);
// 		die();
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/add_student",$data); 
		$this->load->view("common/admin_footer");
	}

	function subject_manage(){
		
		$header['title']=$this->lang->line('ltr_subject_manager');
		if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');       
        }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');           
        }else{
			$cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
		}
		$data['subject_data'] = $this->db_model->countAll('subjects',$cond);
		// print_r($data1);
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/subject_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function question_manage(){
		$header['title']=$this->lang->line('ltr_question_manager');
		if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            $cond = array('added_by'=>$this->session->userdata('uid'),'status'=>'1');
            $cond1 = array('admin_id'=>$this->session->userdata('uid'),'status'=>1);
            $cond2 = array('admin_id'=>1 , 'role'=>1);
        }else{
            $cond = array('added_by'=>$this->session->userdata('uid'),'status'=>'1');
            $cond1 = array('admin_id'=>$this->session->userdata('uid'),'status'=>1);
            $cond2 = array('admin_id'=>1 , 'role'=>1);
        }
		$data['subject'] = $this->db_model->select_data('id,subject_name,no_of_questions','subjects use index (id)',$cond1,'',array('id','desc'));
// 		$data['question_data'] = $this->db_model->countAll('questions',array('added_by'=>$this->session->userdata('uid')));
		$data['question_data'] = $this->db_model->countAll('questions',$cond);
		$data['all_user'] = $this->db_model->select_data('id,name,role','users use index (id)',array('super_admin'=>0 , 'role'=>1));
// 		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',$cond2);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/question_manage",$data); 
		$this->load->view("common/admin_footer");
	}
	function add_question($id=0){
		$header['title']=$this->lang->line('ltr_question_manager');
		$data['subject'] = $this->db_model->select_data('id,subject_name,no_of_questions','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid'),'status'=>1),'',array('id','desc'));
		$data['question_data'] = $this->db_model->countAll('questions',array('added_by'=>$this->session->userdata('uid')));
		if($id>0){
			$data['single_question'] = $this->db_model->select_data('*','questions',array('added_by'=>$this->session->userdata('uid'),'id'=>$id))[0];
		}
		//print_r($data['single_question']);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/add_question",$data); 
		$this->load->view("common/admin_footer");
	}
	function notice_manage(){
		$header['title']=$this->lang->line('ltr_notice_manager');
		$data = array();
		// $data['notice_data'] = $this->db_model->countAll('notices',array('notice_for!='=>'','admin_id'=>$this->session->userdata('uid')));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/notice_manage",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function student_notice($id){
		$data['student_id'] = $id;
		$header['title']=$this->lang->line('ltr_student_notice');
		if(!empty($id)){
			$data['student_data'] = $this->db_model->select_data('name,image,email,contact_no,admission_date,batch_id','students use index (id)',array('admin_id'=>$this->session->userdata('uid'),'id'=>$id));
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/student_notice",$data); 
			$this->load->view("common/admin_footer");
		}else{
			redirect(base_url('admin/student-manage'));
		}
	}
	
	function teacher_notice($id){
		$data['teacher_id'] = $id;
		$header['title']=$this->lang->line('ltr_teacher_notice');
		if(!empty($id)){
			$data['teacher_data'] = $this->db_model->select_data('name,teach_image,email,teach_education,teach_batch,teach_subject','users use index (id)',array('parent_id'=>$this->session->userdata('uid'),'id'=>$id));
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/teacher_notice",$data); 
			$this->load->view("common/admin_footer");
		}else{
			redirect(base_url('admin/teacher-manage'));
		}
	}

	function vacancy_manage(){
		$header['title']=$this->lang->line('ltr_upcoming_exams_manager');
		if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }else{
            $cond = array('admin_id'=>$this->session->userdata('uid'),'status'=>'1');
        }
		$data['vacancy_data'] = $this->db_model->countAll('vacancy',$cond);
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/vacancy_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function video_manage(){
		$header['title']=$this->lang->line('ltr_video_lecture_manager');
// 		print_r($_SESSION);
// 		die();
		if($_SESSION['super_admin']==1){
		    $cond = array('admin_id'=>$this->session->userdata('uid'));
		}else{
	        $cond = array('admin_id'=>$this->session->userdata('uid'));
		}
        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',$cond,'',array('id','desc'));
        $data['video_data'] = $this->db_model->select_data('id','video_lectures use index (id)');
        $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)');
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/video_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function enquiry(){
		$header['title']=$this->lang->line('ltr_enquiry');
		$this->load->view("common/admin_header",$header);
		$data['enquiry_data'] = $this->db_model->select_data('id','enquiry use index (id)');
		$this->load->view("admin/enquiry",$data); 
		$this->load->view("common/admin_footer");
	}

	function timezone(){
		$header['title']=$this->lang->line('ltr_time_zone');
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/timezone"); 
		$this->load->view("common/admin_footer");
	}

	function teacher_manage(){
		$header['title']=$this->lang->line('ltr_teacher_manager');
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
		
		$data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
		$data['teacher_data'] = $this->db_model->countAll('users',array('role'=>3));
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/teacher_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function teacher_progress($id){
		if(!empty($id)){
		    
			$header['title'] =$this->lang->line('ltr_teacher_progress');
			$prevData = $this->db_model->select_data('id,name,teach_subject,teach_batch,teach_image,email,teach_education,','users use index (id)',array('id'=>$id),1);
			$admin_id = $this->session->userdata('uid');
			if(!empty($prevData)){
				
				$subject_ids = json_decode($prevData[0]['teach_subject']);
			
				if(!empty($subject_ids)){
				    $array_subject=array();
				    foreach($subject_ids as $key){
					$subCon = "admin_id = $admin_id AND id  = $key";
					 $array_subject[]= current($this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'))); 
				    }
				    $data['subjects']= $array_subject;
				}else{
					$data['subjects'] = '';
				}
						
				$batch_id = $prevData[0]['teach_batch'];
				if(!empty($batch_id)){
					$batchCon = "admin_id = $admin_id AND id in ($batch_id)";
					$data['batches'] = $this->db_model->select_data('id,batch_name','batches use index (id)',$batchCon,'',array('id','desc'));
				}else{
					$data['batches'] = '';
				}

				$data['teacher_data'] = $prevData;
				
				$data['chapter_data'] = $this->db_model->select_data('chapter,chapter_status','batch_subjects use index (id)',array('teacher_id'=>$prevData[0]['id']));
				
			}
			$data['id'] = $id;
			$this->load->view('common/admin_header',$header);
			$this->load->view('admin/teacher_progress',$data);
			$this->load->view('common/admin_footer');
		}else{
			redirect(base_url('admin/dashboard'));
		}
	}

	function extra_classes(){
		$header['title']=$this->lang->line('ltr_extra_classes');
		$data['teacher'] = $this->db_model->select_data('id,name','users use index (id)',array('parent_id'=>$this->session->userdata('uid'),'role'=>3),'',array('id','desc'));
		$data['batches'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid'),'status'=>1),'',array('id','desc'));
		$data['teacher_data'] = $this->db_model->countAll('extra_classes',array('teacher_id !='=>0));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/extra_classes",$data); 
		$this->load->view("common/admin_footer");
	}

	function create_exam(){
		$header['title']=$this->lang->line('ltr_create_paper');
		$data['subject'] = $this->db_model->select_data('id,subject_name,no_of_questions','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
		$data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
		$data['question_data'] = $this->db_model->countAll('questions',array('admin_id'=>$this->session->userdata('uid')));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/create_exam",$data); 
		$this->load->view("common/admin_footer");
	}

	function exam_manage(){
		$header['title']=$this->lang->line('ltr_manage_paper');
		if($_SESSION['super_admin']==1){
		    $cond = array('admin_id'=>$this->session->userdata('uid'));
		}else{
	        $cond = array('admin_id'=>$this->session->userdata('uid'));
		}
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)');
		$this->load->view("common/admin_header",$header);
		$data['question_data'] = $this->db_model->countAll('exams','');
		$this->load->view("admin/exam_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function practice_result(){
		$header['title']=$this->lang->line('ltr_practice_result');
		$data['paperList'] = $this->db_model->select_data('id,name','exams use index (id)',array('type'=>2),'',array('id','desc'));
		$data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)','',array('id','desc'));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/practice_result",$data); 
		$this->load->view("common/admin_footer");
	}

	function mock_result(){
		$header['title']=$this->lang->line('ltr_mock_test_result');
		$data['paperList'] = $this->db_model->select_data('id,name','exams use index (id)',array('type'=>1,'admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
		$data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/mock_result",$data); 
		$this->load->view("common/admin_footer");
	}

	function view_paper($id){
		$header['title']=$this->lang->line('ltr_view_paper');
		$data['paperData'] = $this->db_model->select_data('*','exams use index (id)',array('admin_id'=>$this->session->userdata('uid'),'id'=>$id),1);
		//print_r($data['paperData']);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/view_paper",$data); 
		$this->load->view("common/admin_footer");
	}

	function answer_sheet($paper_type='',$result_id=''){
		$header['title']=$this->lang->line('ltr_answer_sheet');
		if($paper_type == 'mock'){
			$type = 1;
			$table = 'mock_result';
		}else{
			$type = 2;
			$table = 'practice_result';
		}
		$data['result_details'] = $this->db_model->select_data("$table.*,exams.question_ids,students.name",$table.' use index (id)',array("$table.id"=>$result_id),1,'','',array('multiple',array(array('students',"students.id = $table.student_id"),array('exams',"exams.id = $table.paper_id"))));
		$this->load->view("common/admin_header",$header);
		$this->load->view("student/answer_sheet",$data); 
		$this->load->view("common/admin_footer");
    }

	function facility_manage(){
		$header['title']=$this->lang->line('ltr_facility_manage');
		$data['facility_Details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/facility_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function gallery_manage(){
		$header['title']=$this->lang->line('ltr_gallery');
		$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)',array('admin_id'=>1 , 'role'=>1));
		$this->load->view("common/admin_header",$header);
		$data['gallery'] = $this->db_model->select_data('id','gallery use index (id)');
		$this->load->view("admin/gallery_manage",$data); 
		$this->load->view("common/admin_footer");
	}

	function site_settings(){
		$header['title']=$this->lang->line('ltr_site_settings');
		$data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/site_settings",$data); 
		$this->load->view("common/admin_footer");
	}

	function contact_page(){
		$header['title']=$this->lang->line('ltr_contact_settings');
		$data['contact_Details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/contact_page",$data); 
		$this->load->view("common/admin_footer");
	}

	function course_page(){
		$header['title']=$this->lang->line('ltr_course_page');
		$data['course_Details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/course_page",$data); 
		$this->load->view("common/admin_footer");
	}

	function about_page(){
		$header['title']=$this->lang->line('ltr_about_page');
		$data['about_Details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/about_page",$data); 
		$this->load->view("common/admin_footer");
	}

	function home_page(){
		$header['title']=$this->lang->line('ltr_home_page');
		$data['home_Details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
		$data['student_Data'] = $this->db_model->select_data('name,image,id','students',array('admin_id'=>$this->session->userdata('uid'),'status'=>1));
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/home_page",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function manage_student_leave(){
	    $header['title']=$this->lang->line('ltr_manage_student_leave');
	    $data['page'] = 'student';
	    $data['student_leave'] = $this->db_model->countAll('leave_management',array('student_id !='=>0));
	    $data['student_leave_c']=1;
	   
	    $this->load->view("common/admin_header",$header);
		$this->load->view("admin/manage_leave",$data); 
		$this->load->view("common/admin_footer");
	}

	function manage_teacher_leave(){
	    $header['title']=$this->lang->line('ltr_manage_teacher_leave');
	    $data['page'] = 'teacher';
	    $this->load->view("common/admin_header",$header);
	    $data['teacher_leave'] = $this->db_model->countAll('leave_management',array('teacher_id !='=>0));
		$this->load->view("admin/manage_leave",$data); 
		$this->load->view("common/admin_footer");
	}

	function student_progress($id){
		
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$header['title']=$this->lang->line('ltr_student_progress');
		$like = $year.'-'.$month.'-';
		
		$table_name = 'practice_result';
		$cond1=array("admin_id"=>$this->session->userdata('uid'),'type'=>2);
		$exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,'',array('id','asc'));
		$dataarray_pre =array();
        if($exam_Data){
            
           foreach($exam_Data as $exams){
               
            $cond['paper_id'] = $exams['id'];  
            $cond['student_id'] =$id;  
            $result_data = $this->db_model->select_data('*', $table_name.' use index (id)',$cond,'',array('id','asc'),array('date',$like));
            if(!empty($result_data)){
                $count = "";
                foreach($result_data as $rkey=>$result){
    
                    $attemptedQuestion = json_decode($result['question_answer'],true);
                    if(!empty($result['question_answer'])){
                        $question_ids = implode(',',array_keys($attemptedQuestion));
                        if(!empty($question_ids)){
                            $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')');
                        }else{
                            $right_ansrs = array();
                        }
                        
                        $rightCount = 0;
                        $wrongCount = 0;
                        $c = 0;
                        foreach($attemptedQuestion as $key=>$value){
                            $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key));
                            if(($key == $right_ansrs[0]['id']) && ($value == $right_ansrs[0]['answer'])){
                                $rightCount++;
                            }else{
                                $wrongCount++;
                            }
                          
                        }
        
                        $percentage = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
        
                        $time_taken = '';
                        if($result['start_time']!="" || $result['submit_time']!=""){
                            $stime=strtotime($result['start_time']);
                            $etime=strtotime($result['submit_time']);
                            $elapsed = $etime - $stime;
                            $time_taken = gmdate("H:i", $elapsed);
                        }
                     
                        $dataarray_pre[] = array(
                            'id'=>$result['id'],
                            'paper_id'=>$exams['id'],
                            'paper_name'=>$result['paper_name'],
                            'date'=>date('d-m-Y',strtotime($result['date'])),
                            'start_time'=>date('h:i A',strtotime($result['start_time'])),
                            'submit_time'=>date('h:i A',strtotime($result['submit_time'])),
                            'total_question'=>$result['total_question'],
                            'time_duration'=>gmdate("H:i", $result['time_duration']*60),
                            'attempted_question'=>$result['attempted_question'],
                            'question_answer'=>json_encode($attemptedQuestion),
                            'percentage'=>number_format((float)$percentage, 2, '.', ''),
                            'added_on'=>$result['added_on']
                           
                        ); 
                        
                        $count++;
                    }
                }
            }
           }
           }
        $data['practice_result'] =$dataarray_pre;
        
        $table_name = 'mock_result';
        $cond1=array("admin_id"=>$this->session->userdata('uid'),'type'=>1);
        $exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,'',array('id','asc'));
        
        $dataarray =array();
        if($exam_Data){
            
           foreach($exam_Data as $exams){
               
            $cond['paper_id'] = $exams['id'];  
            $cond['student_id'] =$id;  
            $result_data = $this->db_model->select_data('*', $table_name.' use index (id)',$cond,'',array('id','desc'),array('date',$like));
           
            if(!empty($result_data)){
                $count = "";
                foreach($result_data as $rkey=>$result){
    
                    $attemptedQuestion = json_decode($result['question_answer'],true);
                    if(!empty($result['question_answer'])){
                        $question_ids = implode(',',array_keys($attemptedQuestion));
                        if(!empty($question_ids)){
                            $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')');
                        }else{
                            $right_ansrs = array();
                        }
                        
                        $rightCount = 0;
                        $wrongCount = 0;
                        $c = 0;
                        foreach($attemptedQuestion as $key=>$value){
                            $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key));
                            if(($key == $right_ansrs[0]['id']) && ($value == $right_ansrs[0]['answer'])){
                                $rightCount++;
                            }else{
                                $wrongCount++;
                            }
                          
                        }
        
                        $percentage = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
        
                        $time_taken = '';
                        if($result['start_time']!="" || $result['submit_time']!=""){
                            $stime=strtotime($result['start_time']);
                            $etime=strtotime($result['submit_time']);
                            $elapsed = $etime - $stime;
                            $time_taken = gmdate("H:i", $elapsed);
                        }
                     
                        $dataarray[] = array(
                            'id'=>$result['id'],
                            'paper_id'=>$exams['id'],
                            'paper_name'=>$result['paper_name'],
                            'date'=>date('d-m-Y',strtotime($result['date'])),
                            'start_time'=>date('h:i A',strtotime($result['start_time'])),
                            'submit_time'=>date('h:i A',strtotime($result['submit_time'])),
                            'total_question'=>$result['total_question'],
                            'time_duration'=>gmdate("H:i", $result['time_duration']*60),
                            'attempted_question'=>$result['attempted_question'],
                            'question_answer'=>json_encode($attemptedQuestion),
                            'percentage'=>number_format((float)$percentage, 2, '.', ''),
                            'added_on'=>$result['added_on']
                           
                        ); 
                        
                        $count++;
                    }
                }
            }
           }
           }
        $data['mock_result'] =$dataarray;
        
		$data['student_data'] = $this->db_model->select_data('name,image,email,contact_no,admission_date,batch_id','students use index (id)',array('admin_id'=>$this->session->userdata('uid'),'id'=>$id));
		
        $data['practice_result_d'] = $this->db_model->select_data('total_question,question_answer,date,paper_name,percentage','practice_result',array('student_id'=>$id,'admin_id'=>$this->session->userdata('uid')),1);
	    $data['mock_result_d'] = $this->db_model->select_data('total_question,question_answer,date,paper_name,percentage','mock_result',array('student_id'=>$id,'admin_id'=>$this->session->userdata('uid')),1);
		$data['month'] = $month;
		$data['year'] = $year;
		$data['baseurl'] = base_url();
		$this->load->view("common/admin_header",$header);
		$this->load->view("student/view_progress",$data); 
		$this->load->view("common/admin_footer");
	}
    function student_attendance($id){
		
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$header['title']=$this->lang->line('ltr_attendance');
		$data['month'] = $month;
		$data['year'] = $year;
		$data['student_id'] = $id;
		$data['baseurl'] = base_url();
		$this->load->view("common/admin_header",$header);
		$this->load->view("student/student_attendance",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function student_attendance_extra_class($id){
		
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$header['title']=$this->lang->line('ltr_extra_class_attendance');
		$data['month'] = $month;
		$data['year'] = $year;
		$data['student_id'] = $id;
		$data['baseurl'] = base_url();
		$this->load->view("common/admin_header",$header);
		$this->load->view("student/student_attendance_extra_class",$data); 
		$this->load->view("common/admin_footer");
	}
	function teacher_academic_record($id){
		$header['title']=$this->lang->line('ltr_academic_record');
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$data['month'] = $month;
		$data['year'] = $year;
	
		$like = $year.'-'.$month.'-';
		
		$data['teacher_data'] = $this->db_model->select_data('name,teach_image,email,teach_education,teach_batch,teach_subject','users use index (id)',array('parent_id'=>$this->session->userdata('uid'),'id'=>$id));
		
		$data['homework'] = $this->db_model->countAll('homeworks',array('admin_id'=>$this->session->userdata('uid'),'teacher_id'=>$id),'','',array('date',$like));
		
		$data['extra_class'] = $this->db_model->countAll('extra_classes',array('admin_id'=>$this->session->userdata('uid'),'status'=>'Complete','teacher_id'=>$id),'','',array('date',$like));
		
		$data['video_lecture'] = $this->db_model->countAll('video_lectures',array('admin_id'=>$this->session->userdata('uid'),'added_by'=>$id),'','',array('added_at',$like));
		
		$this->load->view("common/admin_header",$header);
		$this->load->view("teacher/academic_record",$data); 
		$this->load->view("common/admin_footer");
	}

	function student_academic_record($id){
		$header['title']=$this->lang->line('ltr_student_academic_record');
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$data['month'] = $month;
		$data['year'] = $year;
	
		$like = $year.'-'.$month.'-';
			$data['student_id'] = $id;
		$data['student_data'] = $this->db_model->select_data('name,image,email,contact_no,admission_date,batch_id','students use index (id)',array('admin_id'=>$this->session->userdata('uid'),'id'=>$id));
        $like_batch_id='"'.$data['student_data'][0]['batch_id'].'"';
		$data['extra_class'] = $this->db_model->countAll('extra_class_attendance',array('student_id'=>$id),'','',array('date',$like));
		
		$data['total_extra_class'] = $this->db_model->countAll('extra_classes','',array('batch_id'=>$like_batch_id),'',array('date',$like));
		
		$data['homework'] = $this->db_model->countAll('homeworks',array('admin_id'=>$this->session->userdata('uid'),'batch_id'=>$data['student_data'][0]['batch_id']),'','',array('date',$like));
		
		$data['practice_result'] = $this->db_model->custom_slect_query(" COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_result` JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id` WHERE `practice_result`.`admin_id` = '".$this->session->userdata('uid')."' AND `student_id` = '".$id."' AND date(added_at) LIKE '%".$like."%' ESCAPE '!' GROUP BY `paper_id` ) a")[0]['numrows'];
	
		$data['total_practice_test'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('uid'),'batch_id'=>$data['student_data'][0]['batch_id'],'type'=>2),'','',array('date(added_at)',$like));
		
		$data['mock_result'] = $this->db_model->countAll('mock_result',array('admin_id'=>$this->session->userdata('uid'),'student_id'=>$id),'','',array('date',$like));
		$data['total_mock_test'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('uid'),'batch_id'=>$data['student_data'][0]['batch_id'],'type'=>1),'','',array('date(added_at)',$like));
		$this->load->view("common/admin_header",$header);
		$this->load->view("student/academic_record",$data); 
		$this->load->view("common/admin_footer");
	}
	function start_class(){
		$livedata =$this->db_model->select_data('*','live_class_setting',array('id' =>$_POST['live_class_id']));
		$data=array(
			'uid'=>$this->session->userdata('uid'),
			'batch_id'=>$livedata[0]['batch'],
			'subject_id'=>$_POST['subject_id'],
			'chapter_id'=>$_POST['chapter_id'],
			'start_time'=>date('h:i:s a'),
			'date'=>date('Y-m-d')
			);
		$batch_id = $livedata[0]['batch'];
		$student_data = $this->db_model->select_data('id','students', array('batch_id'=> $batch_id,'status'=>'1'));
			$title = 'Live Class';
			$where = 'live';
            for($i=0;$i<count($student_data);$i++){
                    $student_id = $student_data[$i]['id'];
            }
            
		$this->push_notification_android($batch_id,$title,$where,$student_id);
        $ins = $this->db_model->insert_data('live_class_history',$data);
    	$data['inser_id']=$ins;
		$data['signature'] = $this->generate_signature($livedata[0]['zoom_api_key'], $livedata[0]['zoom_api_secret'],$livedata[0]['meeting_number'],1);
		$data['api_key']=$livedata[0]['zoom_api_key'];
		$data['display_name']=$this->session->userdata('name');
		$data['meeting_number']=$livedata[0]['meeting_number'];
		$data['password']=$livedata[0]['password'];
		$this->load->view("admin/start_live_class",$data);
	}
	
        function generate_signature ( $api_key, $api_sercet, $meeting_number, $role){
		$time = (time()- 5*60) * 1000; //time in milliseconds (or close enough)
		$data = base64_encode($api_key . $meeting_number . $time . $role);
		$hash = hash_hmac('sha256', $data, $api_sercet, true);
		$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
		return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
	}
	function end_metting($id){
	   
	    $data=array(
			'end_time'=>date('h:i:s a')
			);
		 $ins = $this->db_model->update_data_limit('live_class_history',$data,array('id'=>$id),1);
		redirect(base_url().'admin/live-class');
	}
	
	
	function demotable(){
	   
	   $header['title']=$this->lang->line('ltr_student_manager');
		$data['batch_name'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	
		$this->load->view("admin/demotable",$data); 
		
	}
	function certificate(){
		$header['title']=$this->lang->line('ltr_certificate_settings');
		$data['certi_setting'] = $this->db_model->select_data('*','certificate_setting',array('id'=>'1'),1);
		if(empty($data['certi_setting'])){
		    	$data=array(
			        'heading'=>""
			       );
		    $ins = $this->db_model->insert_data('certificate_setting',$data);
		}
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/certificate",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function privacy_policy(){
		$header['title']=$this->lang->line('ltr_privacy_policy');
		$data['privacypolicy'] = $this->db_model->select_data('*','privacy_policy_data',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/privacy_policy",$data); 
		$this->load->view("common/admin_footer");
	}
	function terms_conditions(){
		$header['title']=$this->lang->line('ltr_terms_conditions');
		$data['terms_condition'] = $this->db_model->select_data('*','term_condition_data',array('id'=>'1'),1);
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/terms_condition",$data); 
		$this->load->view("common/admin_footer");   
	}
	
	function view_certificate_demo(){
	    $header['title']=$this->lang->line('ltr_view_certificate');	
		$data['certificate_details']=$this->db_model->select_data('*','certificate_setting','',1,array('id','desc'));
		$data['baseurl'] = base_url();
		$this->load->view("admin/view_certificate_demo",$data);
	}
	
	function view_certificate($id,$batch_id){
	    $header['title']=$this->lang->line('ltr_view_certificate');
	    $data['student_certificate']=$this->db_model->select_data('*','certificate',array('student_id'=>$id),1,array('id','desc'));
	   $data['student_name'] = current($this->db_model->select_data('*','students',array('id'=>$id),1,array('id','desc')));
	    $data['batchdata']=$this->db_model->select_data('batch_name','batches',array('id'=>$batch_id),1,array('id','desc'));
		$data['certificate_details']=$this->db_model->select_data('*','certificate_setting','',1,array('id','desc'));
		$data['baseurl'] = base_url();
		$this->load->view("admin/view_certificate",$data);
	}
	
	public function push_notification_android($batch_id='',$title='',$where='',$student_id=''){
        
        if(!empty($batch_id)){
            $batchCon = "status = 1 AND token !='' AND batch_id in ($batch_id)";
	        $get_token = $this->db_model->select_data('token','students',$batchCon,'');
        }else{
            if(!empty($student_id)){
                 $get_token = $this->db_model->select_data('token','students',array('status'=>1,'token !='=>'', 'id'=>$student_id),'');
            }else{
                $get_token = $this->db_model->select_data('token','students',array('status'=>1,'token !='=>''),'');
            }
        }
        if(!empty($get_token)){
            $array_chunk = array_chunk($get_token,999);
            $array_count = count($array_chunk);
            for ($x = 0; $x < $array_count; $x++) {
                $device_id=array();
                foreach($array_chunk[$x] as $get_tokens){
                    if(!empty($get_tokens['token'])){
                        array_push($device_id,$get_tokens['token']);
                    }
                }
           
                   
                $url = 'https://fcm.googleapis.com/fcm/send';
                $api_key = 'AAAAFU0Nyks:APA91bFWu1zpzRasM60cqJjMvfcL5Uc667MP38b5CaYd5O3g-ioRYGtVSvBCdFUt5ea4H8eIDbPKNs98z5W0RxFfRsswy07p1EbSKRRlQkUA1b9sb_fBC2sHvFJZWhpILlZlOqz0_M4u';
                $message = array(
                        'title' => $title,
                        'body' => array(
                            'where'=>$where
                            )
                );
                $fields = array (
                    'registration_ids' =>$device_id,
                    'data' => array (
                    "message" => $message
                    )
                );
                $headers = array(
                    'Content-Type:application/json',
                    'Authorization:key='.$api_key
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
               
                if ($result === FALSE) {
                    die('FCM Send Error: ' . curl_error($ch));
                }
                curl_close($ch);
               
            }
             return $result;
        }
   
    }
	
	
	function doubts_class($id){
	    $header['title']=$this->lang->line('ltr_doubts_class');	
		$data['doubts_class_data'] = $this->db_model->select_data('doubt_id','student_doubts_class',array('teacher_id'=>$id),1);
		$data['id'] = $id;
		$this->load->view("common/admin_header",$header);
		$this->load->view("teacher/doubts_class",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function doubts_ask($id){
	    $header['title']=$this->lang->line('ltr_student_doubts_ask');	
		$data['doubts_class_data'] = $this->db_model->select_data('doubt_id','student_doubts_class',array('student_id'=>$id),1);
		$data['id'] = $id;
		$this->load->view("common/admin_header",$header);
		$this->load->view("student/doubts_ask",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function payment_history(){
	    $header['title']=$this->lang->line('ltr_payment_history');	
		$data['payment_history'] = $this->db_model->select_data('id','student_payment_history');
		
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/payment_history",$data); 
		$this->load->view("common/admin_footer");
	}
	
	function payment_settings(){
	    $header['title']=$this->lang->line('ltr_payment_settings');	
		$data['payment_type'] = $this->general_settings('payment_type');
		$data['razorpay_key_id'] = $this->general_settings('razorpay_key_id');
		$data['razorpay_secret_key'] = $this->general_settings('razorpay_secret_key');
		$data['paypal_client_id'] = $this->general_settings('paypal_client_id');
		$data['paypal_secret_key'] = $this->general_settings('paypal_secret_key');
		$data['currency_converter_api'] = $this->general_settings('currency_converter_api');
		$data['sandbox_accounts'] = $this->general_settings('sandbox_accounts');
		$data['currency_code'] = $this->general_settings('currency_code');
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/payment_settings",$data); 
		$this->load->view("common/admin_footer");

	}
	
	function language_settings(){
		//$this->lang->load('french_lang', 'french');
		//echo $this->lang->line('hello');
	    $header['title']=$this->lang->line('ltr_language_settings');	
		$data['language_name'] = $this->general_settings('language_name');
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/language",$data); 
		$this->load->view("common/admin_footer");
		
		
	}
	function blog_reply($id){
		$header['title'] = $this->lang->line('ltr_blog_manage');
		// $data['blog_data'] = $this->db_model->select_data('*','blog_comments',array('blog_id'=>$id));
		$data['blog']=$this->db_model->select_data('*','blog',array('status'=>1,'id'=>$id));
		  $data['comments'] = $this->db_model->select_data('*','blog_comments',array('blog_id'=>$id));	
		$this->load->view('common/admin_header',$header);
		$this->load->view('admin/blog_reply',$data);
		$this->load->view('common/admin_footer');
	}
	function email_settings(){
		$data['server_type'] = $this->general_settings('server_type');
        $data['smtp_host'] = $this->general_settings('smtp_host');
        $data['smtp_port'] = $this->general_settings('smtp_port');
        $data['smtp_mail'] =$this->general_settings('smtp_mail');
        $data['smtp_pwd'] =$this->general_settings('smtp_pwd');
        $data['smtp_encryption'] = $this->general_settings('smtp_encryption');
	    $header['title']=$this->lang->line('ltr_email_settings');	
		$data['email_settings'] = $this->general_settings('language_name');
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/email_settings",$data); 
		$this->load->view("common/admin_footer");
		
	}
	
	function firebase_settings(){
		
        $data['firebase_key'] =$this->general_settings('firebase_key');
	    $header['title']=$this->lang->line('ltr_firebase_settings');	
		$data['firebase_settings'] = $this->general_settings('language_name');
		$this->load->view("common/admin_header",$header);
		$this->load->view("admin/front/firebase_settings",$data); 
		$this->load->view("common/admin_footer");
		
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
            
            $this->email->initialize($config);
            
            $this->email->from($frommail, $title);
            //$ci->email->bcc('example@gmail.com');
            $this->email->to($tomail);
            $this->email->subject($subject);
            $this->email->message($msg);
            @$this->email->send();
            return true;

        }
        
        //new update 
        
        function book_manage(){
			$header['title']=$this->lang->line('ltr_book_manage');
	        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['book_data'] = $this->db_model->select_data('id','book_pdf use index (id)');
	         $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)');
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/book_manage",$data); 
			$this->load->view("common/admin_footer");
		}
		function notes_manage(){
			$header['title']=$this->lang->line('ltr_notes_manage');
	        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['notes_data'] = $this->db_model->select_data('id','notes_pdf use index (id)');
	        $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)');
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/notes_manage",$data); 
			$this->load->view("common/admin_footer");
		}

		
		// function file_view($type='',$id=''){
			
		// 	$header['title']=$this->lang->line('ltr_file_view');
	 //        if($type=="library"){
		// 		$book_data =$this->db_model->select_data('*','library_books',array('id'=>$id,'status'=>1),'',array('id','desc'));
		// 		if(!empty($book_data)){
		// 		$data['file_name']= base_url('/uploads/library/').$book_data[0]['file_name'];
		// 		}
		// 	}elseif($type=="book"){
		// 		$book_data = $this->db_model->select_data('*','book_pdf',array('id'=>$id,'status'=>1),'',array('id','desc'));
		// 		if(!empty($book_data)){
		// 		$data['file_name']= base_url('/uploads/book/').$book_data[0]['file_name'];
		// 		}
		// 	}elseif($type=="notes"){
		// 		$book_data= $this->db_model->select_data('*','notes_pdf',array('id'=>$id,'status'=>1),'',array('id','desc'));
		// 		if(!empty($book_data)){
		// 		$data['file_name']= base_url('/uploads/notes/').$book_data[0]['file_name'];
		// 		}
		// 	}elseif($type=="old_paper"){
		// 		$book_data= $this->db_model->select_data('*','old_paper_pdf',array('id'=>$id,'status'=>1),'',array('id','desc'));
		// 		if(!empty($book_data)){
		// 		$data['file_name']= base_url('/uploads/oldpaper/').$book_data[0]['file_name'];
		// 		}
		// 	}
			
		// 	$this->load->view("common/admin_header",$header);
		// 	$this->load->view("admin/pdf_view_file",$data); 
		// 	$this->load->view("common/admin_footer");

		// }
		function file_view($type='',$id=''){	
			
			$header['title']=$this->lang->line('ltr_file_view');
	        if($type=="library"){
				$book_data =$this->db_model->select_data('*','library_books',array('id'=>$id,'status'=>1),'',array('id','desc'));
				if(!empty($book_data)){
				$data['file_name']= base_url('/uploads/library/').$book_data[0]['file_name'];
				}
			}elseif($type=="book"){
				$book_data = $this->db_model->select_data('*','book_pdf',array('id'=>$id,'status'=>1),'',array('id','desc'));
				if(!empty($book_data)){
				$data['file_name']= base_url('/uploads/book/').$book_data[0]['file_name'];
				}
			}elseif($type=="notes"){
				$book_data= $this->db_model->select_data('*','notes_pdf',array('id'=>$id,'status'=>1),'',array('id','desc'));
				if(!empty($book_data)){
				$data['file_name']= base_url('/uploads/notes/').$book_data[0]['file_name'];
				}
			}elseif($type=="old_paper"){
				$book_data= $this->db_model->select_data('*','old_paper_pdf',array('id'=>$id,'status'=>1),'',array('id','desc'));
				if(!empty($book_data)){
				$data['file_name']= base_url('/uploads/oldpaper/').$book_data[0]['file_name'];
				}
			}else{
				$book_data =$this->db_model->select_data('*','vacancy',array('id'=>$this->uri->segment(3),'status'=>1),'',array('id','desc'));
				 //$book_data = $this->db_model->select_data('*','vacancy use index (id)',array('id'=>$id,'status'=>1),'',array('id','desc'));
// 			print_r($book_data);
// 		die();
				foreach($book_data as $vac){
					$files = json_decode($vac['files'],true);
					foreach($files as $file){
						$ext = pathinfo(base_url('uploads/vacancy/'.$file))['extension'];
						if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg'){
				// 			$html = base_url('uploads/images/'.$file);
							$html = base_url('uploads/vacancy/'.$file);
						}else if($ext == 'pdf'){
							$html = base_url('uploads/vacancy/'.$file);
						}else{
							$html = base_url('uploads/vacancy/'.$file);
						}
					}
				}
				if(!empty($book_data)){
					$data['file_name']= $html;				
				}
			}		
				
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/pdf_view_file",$data); 
			$this->load->view("common/admin_footer");

		}
		
		function old_paper(){
		    
		    $header['title']=$this->lang->line('ltr_old_paper');
	        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['notes_data'] = $this->db_model->select_data('*','old_paper_pdf use index (id)');
	        $data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)');
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/old_paper_manage",$data); 
			$this->load->view("common/admin_footer");
		}

		function manage_certificate($id){
			$header['title']=$this->lang->line('ltr_manage_certificate');
// 			$data['month'] = $month;
// 			$data['year'] = $year;
			$data['student_id'] = $id;
			$data['baseurl'] = base_url();
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/manage_certificate",$data); 
			$this->load->view("common/admin_footer");
		}
		
		function manage_revanue(){
			$header['title']=$this->lang->line('ltr_revanue');
			$data['all_user'] = $this->db_model->select_data('id,name,role,super_admin','users use index (id)');
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/revenue_manage",$data); 
			$this->load->view("common/admin_footer");
		}
		function  manage_admin(){

			$header['title']=$this->lang->line('ltr_manager_admin');
			$data['teacher_data'] = $this->db_model->countAll('users',array('role'=>1,'super_admin'=>0));
			$this->load->view("common/admin_header",$header);
			$this->load->view("admin/admin_manage",$data); 
			$this->load->view("common/admin_footer");
		}
	
	
}
