<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_profile extends CI_Controller { 

	function __construct(){
		parent::__construct();
		$timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));
		if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])){
            date_default_timezone_set($timezoneDB[0]['timezone']);
        }
		if(!empty($_SESSION['role'])){
	        if($_SESSION['role']=='student'){
	            redirect(base_url('student/dashboard')); 
	        }else if($_SESSION['role']==1){
	            redirect(base_url('admin/dashboard')); 
	        }
	    }else{
	        redirect(base_url('login'));
	    }
		
		$uid = $this->session->userdata('uid');
        $teacherData = $this->db_model->select_data('token, brewers_check, status','users  use index (id)',array('id'=>$uid),'1',array('id','desc'));
		if(!empty($teacherData)){
    	   if(($teacherData[0]['token'] !=1) || ($teacherData[0]['status'] !=1) || ($teacherData[0]['brewers_check'] !=$_SESSION['brewers_check'])){
        		if($this->session->all_userdata()){
                    $this->session->sess_destroy();
        			redirect(base_url('login'));
        		}
    	   }
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

	function general_settings($key_text=''){
        $data = $this->db_model->select_data('*','general_settings',array('key_text'=>$key_text),1);
        return $data[0]['velue_text'];
    }
	public function index()
	{
		$header['title'] =$this->lang->line('ltr_dashboard');
		$admin_id = $this->session->userdata('admin_id');
		$uid = $this->session->userdata('uid');
		$batch_id = $this->session->userdata('batch_id');
		if(!empty($batch_id)){
			$cond = "admin_id = $admin_id AND status = 1 AND type = 1 AND batch_id in ($batch_id) AND mock_sheduled_date = '".date('Y-m-d')."'";
			$data['total_mock_test']=$this->db_model->countAll('exams use index (id)',$cond);
		}else{
			$data['total_mock_test'] = 0;
		}
		
        $data['total_question']=$this->db_model->countAll('questions use index (id)',array('admin_id'=>$admin_id,'added_by'=>$uid));
        
        $data['imp_question']=$this->db_model->countAll('questions use index (id)',array('admin_id'=>$admin_id,'added_by'=>$uid,'category'=>1));
        $data['vimp_question']=$this->db_model->countAll('questions use index (id)',array('admin_id'=>$admin_id,'added_by'=>$uid,'category'=>2));
        
         $data['batch_count']=$this->db_model->countAll('batch_subjects',array('teacher_id'=>$uid),'','','','','','');
          
        $data['active_batch']=$this->db_model->countAll('batches',array( 'status'=>1),'','','','','','',array('id',$this->session->userdata('batch_id')));
        // echo $this->db->last_query();
        $data['inactive_batch']=$this->db_model->countAll('batches',array( 'status'=>0 ),'','','','','','',array('id',$this->session->userdata('batch_id'))); 
        
		$data['total_extra_class']=$this->db_model->countAll('extra_classes use index(id)',array('admin_id'=>$admin_id,'date'=>date('Y-m-d'),'teacher_id'=>$uid));
		$data['total_previous_class']=$this->db_model->countAll('extra_classes use index(id)',array('admin_id'=>$admin_id,'date < '=>date('Y-m-d'),'teacher_id'=>$uid));
		$data['total_upcoming_class']=$this->db_model->countAll('extra_classes use index(id)',array('admin_id'=>$admin_id,'date > '=>date('Y-m-d'),'teacher_id'=>$uid));
		
		$data['total_leave_request']=$this->db_model->countAll('leave_management ',array('admin_id'=>$admin_id,'teacher_id'=>$uid));
		$data['total_leave_aproved']=$this->db_model->countAll('leave_management ',array('admin_id'=>$admin_id,'teacher_id'=>$uid,'status'=>1));
		$data['total_leave_decline']=$this->db_model->countAll('leave_management ',array('admin_id'=>$admin_id,'teacher_id'=>$uid,'status'=>2));
		
		// if(!empty($batch_id)){
		// 	$batCon = "admin_id = $admin_id AND status=1 AND id in ($batch_id)";
		// 	$data['all_batches'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$batCon,'',array('id','desc'));
		// }else{
		// 	$data['all_batches'] = '';
		// }
		if(!empty($batch_id)){
			$batCon = "admin_id = $admin_id AND id in ($batch_id)";
			$data['all_batches'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$batCon,'',array('id','desc'));
		}else{
			$data['all_batches'] = '';
		}

		$data['exam'] = $this->db_model->select_data('id,name','exams  use index (id)',array('admin_id'=>$admin_id,'type'=>1,'mock_sheduled_date <='=>date('Y-m-d')),'1',array('id','desc'),'','','','',array('batch_id',$this->session->userdata('batch_id')));
		
		if(!empty($data['exam'][0]['id'])){
    		$data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));
    		
    	    $data['good'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >='=>80));
    	   
    	    $data['poor'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>60));
    	   
    	    $data['avarage'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>80,'mock_result.percentage >='=>60));
		}
		$data['doubts_data'] = $this->db_model->countAll('student_doubts_class',array('teacher_id' =>$uid));
		$data['doubts_data_aprove'] = $this->db_model->countAll('student_doubts_class',array('teacher_id' =>$uid,'status'=>1));
		$data['doubts_data_pending'] = $this->db_model->countAll('student_doubts_class',array('teacher_id' =>$uid,'status'=>0));
              
		$this->load->view('common/teacher_header',$header);
		$this->load->view('teacher/dashboard',$data);
		$this->load->view('common/teacher_footer');
	}
	
	function profile(){
		$header['title'] =$this->lang->line('ltr_profile');
		
		$this->load->view('common/teacher_header',$header);
		$this->load->view('teacher/profile');
		$this->load->view('common/teacher_footer');
	}
    
    function video_manage(){
		$header['title']=$this->lang->line('ltr_video_lecture_lanager');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));

		$batch_ids = $this->session->userdata('batch_id');
		if(!empty($batch_ids)){
			$batCon = "admin_id = $admin_id AND id in ($batch_ids)";
			$data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$batCon,'',array('id','desc'));
		}else{
			$data['batch'] = '';
		}
		$data['video_data'] = $this->db_model->select_data('id','video_lectures use index (id)',array('admin_id'=>$admin_id,'added_by'=>$this->session->userdata('uid')));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/video_manage",$data); 
		$this->load->view("common/teacher_footer");
	}

	function question_manage(){
		$header['title']=$this->lang->line('ltr_questions_manager');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$data['question_data'] = $this->db_model->countAll('questions','');
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/question_manage",$data); 
		$this->load->view("common/teacher_footer");
	}

	function exam_manage(){
		$header['title']=$this->lang->line('ltr_manage_paper');
		
		$data['question_data'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('admin_id')));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/exam_manage",$data); 
		$this->load->view("common/teacher_footer");
	}

	function view_paper($id){
		$header['title']=$this->lang->line('ltr_view_paper');
		
		$data['paperData'] = $this->db_model->select_data('*','exams use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'id'=>$id),1);
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/view_paper",$data); 
		$this->load->view("common/teacher_footer");
	}

	function practice_result(){
		$header['title']=$this->lang->line('ltr_practice_result');
		
		$data['paperList'] = $this->db_model->select_data('id,name','exams use index (id)',array('type'=>2,'admin_id'=>$this->session->userdata('admin_id')),'',array('id','desc'));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/practice_result",$data); 
		$this->load->view("common/teacher_footer");
	}

	function mock_result(){
		$header['title']=$this->lang->line('ltr_mock_test_result');
		
		$data['paperList'] = $this->db_model->select_data('id,name','exams use index (id)',array('type'=>1,'admin_id'=>$this->session->userdata('admin_id')),'',array('id','desc'));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/mock_result",$data); 
		$this->load->view("common/teacher_footer");
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
		
		$this->load->view("common/teacher_header",$header);
		$this->load->view("student/answer_sheet",$data); 
		$this->load->view("common/teacher_footer");
    }

	function extra_classes(){
		$header['title']=$this->lang->line('ltr_extra_classes');
		$data['teacher_data'] = $this->db_model->select_data('batch_id','extra_classes  use index (id)',array('admin_id'=>$this->session->userdata('admin_id'), 'teacher_id'=>$this->session->userdata('uid')),1);
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/extra_classes",$data); 
		$this->load->view("common/teacher_footer");
	}

	function homework_manage($date=''){
		$header['title']= $this->lang->line('ltr_assignment_manager');
		$data['date'] = $date;
		$admin_id = $this->session->userdata('admin_id');
		$subject_ids = $this->session->userdata('subject_id');
		// print_r($this->session);
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$batch_ids = $this->session->userdata('batch_id');
		if(!empty($batch_ids)){
			$batCon = "admin_id = $admin_id AND id in ($batch_ids)";
			$data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$batCon,'',array('id','desc'));
		}else{
			$data['batch'] = '';
		}
// 		echo $this->db->last_query();
		$data['hwo_data'] = $this->db_model->select_data('id','homeworks use index (id)',array('teacher_id'=>$this->session->userdata('uid'),'admin_id'=>$admin_id));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("teacher/homework_manage",$data); 
		$this->load->view("common/teacher_footer");
	}
	
	function notice(){
		$header['title'] = $this->lang->line('ltr_notice');
		$admin_id = $this->session->userdata('admin_id');
		$uid = $this->session->userdata('uid');
		$this->db_model->update_data('notices use index(id)',array('read_status'=>1),array('teacher_id'=>$this->session->userdata('uid')));
		$subCon = "admin_id = '$admin_id' AND notice_for in ('Both','Teacher') || teacher_id ='$uid'";
		$data['notice_data'] =$this->db_model->select_data('*','notices',$subCon,1,array('id','desc'));
		$this->load->view('common/teacher_header',$header);
		$this->load->view('student/notice',$data);
		$this->load->view('common/teacher_footer');
	}

	function progress(){
		$header['title'] = $this->lang->line('ltr_progress');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subjects'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$batch_id = $this->session->userdata('batch_id');
		if(!empty($batch_id)){
			$batchCon = "admin_id = $admin_id AND id in ($batch_id)";
			$data['batches'] = $this->db_model->select_data('id,batch_name','batches use index (id)',$batchCon,'',array('id','desc'));
		}else{
			$data['batches'] = '';
		}
		
		$data['chapter_data'] = $this->db_model->select_data('chapter,chapter_status','batch_subjects use index (id)',array('teacher_id'=>$this->session->userdata('uid')));
		$this->load->view('common/teacher_header',$header);
		$this->load->view('teacher/progress',$data);
		$this->load->view('common/teacher_footer');
	}

	function student_details(){
		$header['title']=$this->lang->line('ltr_student_details');
		$batch_id = $this->session->userdata('batch_id');
		$admin_id = $this->session->userdata('admin_id');
// 		print_r($_SESSION);
		if(!empty($batch_id)){
			$batchCon = "admin_id = $admin_id AND id in ($batch_id)";
			$data['batch_name'] = $this->db_model->select_data('id,batch_name','batches use index (id)',$batchCon,'',array('id','desc'));
			$cond = "admin_id = $admin_id AND batch_id in ($batch_id) AND status = 1";
	        $data1['student_data'] = $this->db_model->countAll('students',$cond);
		}else{
			$data['batch_name'] = '';
		}
		
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/student_manage",$data); 
		$this->load->view("common/teacher_footer");
	}
	
	function student_notice($id){
		$data['student_id'] = $id;
		$header['title']=$this->lang->line('ltr_student_notice');
		if(!empty($id)){
			$data['student_data'] = $this->db_model->select_data('name,image,email,contact_no,admission_date,batch_id','students use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'id'=>$id));
			$this->load->view("common/teacher_header",$header);
    		$this->load->view("admin/student_notice",$data); 
    		$this->load->view("common/teacher_footer");
		}else{
			redirect(base_url('teacher/student-details'));
		}
	}
	
	function apply_leave(){
		$header['title']=$this->lang->line('ltr_apply_leave');
		$data = array();
		$this->load->view("common/teacher_header",$header);
		$data['leave_data'] = $this->db_model->select_data('id','leave_management use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'teacher_id'=>$this->session->userdata('uid')),1);
		$this->load->view("teacher/apply_leave",$data); 
		$this->load->view("common/teacher_footer");
	} 

	function live_class($date=''){
		$header['title']=$this->lang->line('ltr_live_class');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		
		$batch_ids =$this->session->userdata('batch_id');
		if(!empty($batch_ids)){
        $batCon = "batches.admin_id = $admin_id AND batches.id in ($batch_ids)";
        $data['live_data']  = $this->db_model->select_data('live_class_setting.*,batches.batch_name','live_class_setting',$batCon,1,array('id','desc'),'',array('batches','batches.id=live_class_setting.batch'));
		}
		$this->load->view("common/teacher_header",$header);
		$this->load->view("teacher/live_class",$data); 
		$this->load->view("common/teacher_footer");
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
        $ins = $this->db_model->insert_data('live_class_history',$data);
    	$data['inser_id']=$ins;
		$data['signature'] = $this->generate_signature($livedata[0]['zoom_api_key'], $livedata[0]['zoom_api_secret'],$livedata[0]['meeting_number'],1);
		$data['api_key']=$livedata[0]['zoom_api_key'];
		$data['display_name']=$this->session->userdata('name');
		$data['meeting_number']=$livedata[0]['meeting_number'];
		$data['password']=$livedata[0]['password'];
		
		$this->load->view("teacher/start_live_class",$data);
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
		redirect(base_url().'teacher/live-class');
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
		$cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>2);
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
        $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>1);
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
		$data['student_data'] = $this->db_model->select_data('name,image,email,contact_no,admission_date,batch_id','students use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'id'=>$id));
		
		$data['practice_result_d'] = $this->db_model->select_data('total_question,question_answer,date,paper_name,percentage','practice_result',array('student_id'=>$id,'admin_id'=>$this->session->userdata('admin_id')),1);
	    $data['mock_result_d'] = $this->db_model->select_data('total_question,question_answer,date,paper_name,percentage','mock_result',array('student_id'=>$id,'admin_id'=>$this->session->userdata('admin_id')),1);
		$data['month'] = $month;
		$data['year'] = $year;

		$data['baseurl'] = base_url();
		$this->load->view("common/teacher_header",$header);
		$this->load->view("student/view_progress",$data); 
		$this->load->view("common/teacher_footer");
	}

	function academic_record(){
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
		
		$data['homework'] = $this->db_model->countAll('homeworks',array('admin_id'=>$this->session->userdata('admin_id'),'teacher_id'=>$this->session->userdata('uid')),'','',array('date',$like));
		
		$data['extra_class'] = $this->db_model->countAll('extra_classes',array('admin_id'=>$this->session->userdata('admin_id'),'status'=>'Complete','teacher_id'=>$this->session->userdata('uid')),'','',array('date',$like));
		
		$data['video_lecture'] = $this->db_model->countAll('video_lectures',array('admin_id'=>$this->session->userdata('admin_id'),'added_by'=>$this->session->userdata('uid')),'','',array('added_at',$like));
		
		$this->load->view("common/teacher_header",$header);
		$this->load->view("teacher/academic_record",$data); 
		$this->load->view("common/teacher_footer");
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
		
		$data['student_data'] = $this->db_model->select_data('name,image,email,contact_no,admission_date,batch_id','students use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'id'=>$id));
        $like_batch_id='"'.$data['student_data'][0]['batch_id'].'"';
		$data['extra_class'] = $this->db_model->countAll('extra_class_attendance',array('student_id'=>$id),'','',array('date',$like));
		$data['total_extra_class'] = $this->db_model->countAll('extra_classes','',array('batch_id'=>$like_batch_id),'',array('date',$like));
		
		$data['homework'] = $this->db_model->countAll('homeworks',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$data['student_data'][0]['batch_id']),'','',array('date',$like));
		
		$data['practice_result'] = $this->db_model->custom_slect_query(" COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_result` JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id` WHERE `practice_result`.`admin_id` = '".$this->session->userdata('admin_id')."' AND `student_id` = '".$id."' AND date(added_at) LIKE '%".$like."%' ESCAPE '!' GROUP BY `paper_id` ) a")[0]['numrows'];
		
		$data['total_practice_test'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$data['student_data'][0]['batch_id'],'type'=>2),'','',array('date(added_at)',$like));
		
		$data['mock_result'] = $this->db_model->countAll('mock_result',array('admin_id'=>$this->session->userdata('admin_id'),'student_id'=>$id),'','',array('date',$like));
		
		$data['total_mock_test'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$data['student_data'][0]['batch_id'],'type'=>1),'','',array('date(added_at)',$like));
		
		$this->load->view("common/teacher_header",$header);
		$this->load->view("student/academic_record",$data); 
		$this->load->view("common/teacher_footer");
	}

	function create_exam(){
		$header['title']= $this->lang->line('ltr_create_paper');
		$admin_id = $this->session->userdata('admin_id');
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name,no_of_questions','subjects use index (id)',$subCon,'',array('id','desc'));
		$batch_id = $this->session->userdata('batch_id');
		if(!empty($batch_id)){
			$batchCon = "admin_id = $admin_id AND id in ($batch_id)";
			$data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',$batchCon,'',array('id','desc'));
		}else{
			$data['batch'] = '';
		}
		$data['question_data'] = $this->db_model->countAll('questions',array('admin_id'=>$this->session->userdata('admin_id')));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/create_exam",$data); 
		$this->load->view("common/teacher_footer");
	}
    function student_attendance($id){
// 		print_r($_SESSION);
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$header['title']=$this->lang->line('ltr_student_attendance');
		$data['month'] = $month;
		$data['year'] = $year;
		$data['student_id'] = $id;
		$data['attendance'] = $this->db_model->select_data('id','attendance',array('added_id'=>$this->session->userdata('uid')),1);
	   
		$data['baseurl'] = base_url();
		$this->load->view("common/teacher_header",$header);
		$this->load->view("student/student_attendance",$data); 
		$this->load->view("common/teacher_footer");
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
		$this->load->view("common/teacher_header",$header);
		$this->load->view("student/student_attendance_extra_class",$data); 
		$this->load->view("common/teacher_footer");
	}
	
	function student_doubts_class(){
		
	
		$header['title']=$this->lang->line('ltr_doubts_class');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$data['doubts_class_data'] = $this->db_model->select_data('doubt_id','student_doubts_class',array('teacher_id'=>$this->session->userdata('uid')),1);
		$this->load->view("common/teacher_header",$header);
		$this->load->view("teacher/doubts_class",$data); 
		$this->load->view("common/teacher_footer");
	}
	function doubts_ask($id){
	    $header['title']=$this->lang->line('ltr_student_doubts_ask');
		$data['doubts_class_data'] = $this->db_model->select_data('doubt_id','student_doubts_class',array('student_id'=>$id),1);
		$data['id'] = $id;

		$this->load->view("common/teacher_header",$header);
		$this->load->view("student/doubts_ask",$data); 
		$this->load->view("common/teacher_footer");
	}
	function add_question($id=0){
		$header['title']=$this->lang->line('ltr_question_manager');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$data['question_data'] = $this->db_model->countAll('questions',array('added_by'=>$this->session->userdata('uid')));
		if($id>0){
			$data['single_question'] = $this->db_model->select_data('*','questions',array('added_by'=>$this->session->userdata('uid'),'id'=>$id))[0];
		}
		//print_r($data['single_question']);
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/add_question",$data); 
		$this->load->view("common/teacher_footer");
	}
	
	//new update
	
	function book_manage(){
		$header['title']=$this->lang->line('ltr_library_manager');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$batch_ids = $this->session->userdata('batch_id');
		if(!empty($batch_ids)){
			$batCon = "admin_id = $admin_id AND id in ($batch_ids)";
			$data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$batCon,'',array('id','desc'));
		}else{
			$data['batch'] = '';
		}
		$data['book_data'] = $this->db_model->select_data('id','book_pdf use index (id)',array('admin_id'=>$admin_id,'added_by'=>$this->session->userdata('uid')));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/book_manage",$data); 
		$this->load->view("common/teacher_footer");
	}
	function notes_manage(){
		$header['title']=$this->lang->line('ltr_notes_manage');
		$admin_id = $this->session->userdata('admin_id');
		
		$subject_ids = $this->session->userdata('subject_id');
		$subCon = "admin_id = $admin_id AND id in ($subject_ids)";
		$data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',$subCon,'',array('id','desc'));
		$batch_ids = $this->session->userdata('batch_id');
		if(!empty($batch_ids)){
			$batCon = "admin_id = $admin_id AND id in ($batch_ids)";
			$data['batch'] = $this->db_model->select_data('id,batch_name','batches  use index (id)',$batCon,'',array('id','desc'));
		}else{
			$data['batch'] = '';
		}
		$data['notes_data'] = $this->db_model->select_data('id','notes_pdf use index (id)',array('admin_id'=>$admin_id,'added_by'=>$this->session->userdata('uid')));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/notes_manage",$data); 
		$this->load->view("common/teacher_footer");
	}
	
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
		}
		
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/pdf_view_file",$data); 
		$this->load->view("common/teacher_footer");

	}
	
	function old_paper(){
		    
	    $header['title']=$this->lang->line('ltr_old_paper');
        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
        // $batch_id = current($this->db_model->select_data('teach_batch','users use index (id)',array('status' => '1'),'',array('id','desc'),array('teach_batch', $this->session->userdata('batch_id'))));
        // $batch_data = implode(',',$batch_id);
        $batch_id = $this->session->userdata('batch_id');
        	$Con = "status = 1 AND id in ($batch_id)";
        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',$Con,'',array('id','desc'));
    //   echo $this->db->last_query();
        // $like = array('batch','"'.$this->session->userdata('batch_id').'"');
        $data['notes_data'] = $this->db_model->select_data('*','old_paper_pdf use index (id)',array('status'=>1 ),'',array('id','desc'));
		$this->load->view("common/teacher_header",$header);
		$this->load->view("admin/old_paper_manage",$data); 
		$this->load->view("common/teacher_footer");
	}
	
		function manage_student_leave(){
	    $header['title']=$this->lang->line('ltr_manage_student_leave');
	    $data['page'] = 'student';
	    $data['student_leave'] = $this->db_model->countAll('leave_management',array('student_id !='=>0));
	   // $data['student_leave_c']=1;
	  
	    $this->load->view("common/teacher_header",$header);
		$this->load->view("teacher/student_leave",$data); 
		$this->load->view("common/teacher_footer");
	}
}
