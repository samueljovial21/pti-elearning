<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_profile extends CI_Controller { 

	function __construct(){
		parent::__construct();		
		if(!empty($_SESSION['role'])){
	        if($_SESSION['role']=='1'){
	            redirect(base_url('admin/dashboard')); 
	        }else if($_SESSION['role']==3){
	            redirect(base_url('teacher/dashboard')); 
	      
	        }
	        
	    }else{          
	       
	        redirect(base_url('login'));
	    }
	      
        $uid = $this->session->userdata('uid');
        $studentData = $this->db_model->select_data('token, brewers_check, status','students  use index (id)',array('id'=>$uid),'1',array('id','desc'));
		if(!empty($studentData)){
    	   if(($studentData[0]['token'] !=1) || ($studentData[0]['status'] !=1) || ($studentData[0]['brewers_check'] !=$_SESSION['brewers_check'])){
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
	
// 		public function index()
// 	{

// 		$this->check_batch();
//         $header['title'] = $this->lang->line('ltr_dashboard');
//         $admin_id = $this->session->userdata('admin_id');
// 		$uid = $this->session->userdata('uid');
// 		$batch_id = $this->session->userdata('batch_id');
// 		$batch_id_like = '"'.$this->session->userdata('batch_id').'"';
// 		$data['batch_details'] = $this->db_model->custom_slect_query("sudent_batchs.student_id,batches.*  FROM `sudent_batchs` JOIN `batches` ON `batches`.`id`=`sudent_batchs`.`batch_id` WHERE `sudent_batchs`.`student_id` = '".$uid."' ");

		
// 	    $table_name = 'mock_result';
//         $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>1,'batch_id'=>$this->session->userdata('batch_id'));
//         $exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,'',array('id','asc'));


//         $dataarray =array();
//         if($exam_Data){
            
//           foreach($exam_Data as $exams){
               
//             $cond['paper_id'] = $exams['id'];  
//             $cond['student_id'] =$uid;  
//             $result_data = $this->db_model->select_data('*', $table_name.' use index (id)',$cond,'',array('id','desc'));
           
//             if(!empty($result_data)){
//                 $count = "";
//                 foreach($result_data as $rkey=>$result){
    
//                     $attemptedQuestion = json_decode($result['question_answer'],true);
//                     if(!empty($result['question_answer'])){
//                         $question_ids = implode(',',array_keys($attemptedQuestion));
//                         if(!empty($question_ids)){
//                             $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)','id in ('.$question_ids.')');
//                         }else{
//                             $right_ansrs = array();
//                         }
                        
//                         $rightCount = 0;
//                         $wrongCount = 0;
//                         $c = 0;
//                         foreach($attemptedQuestion as $key=>$value){
//                             $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key));
//                             if(($key == $right_ansrs[0]['id']) && ($value == $right_ansrs[0]['answer'])){
//                                 $rightCount++;
//                             }else{
//                                 $wrongCount++;
//                             }
                          
//                         }
        
//                         $percentage = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
        
//                         $time_taken = '';
//                         if($result['start_time']!="" || $result['submit_time']!=""){
//                             $stime=strtotime($result['start_time']);
//                             $etime=strtotime($result['submit_time']);
//                             $elapsed = $etime - $stime;
//                             $time_taken = gmdate("H:i", $elapsed);
//                         }
                     
//                         $dataarray[] = array(
//                             'id'=>$result['id'],
//                             'paper_id'=>$exams['id'],
//                             'paper_name'=>$result['paper_name'],
//                             'date'=>date('d-m-Y',strtotime($result['date'])),
//                             'start_time'=>date('h:i A',strtotime($result['start_time'])),
//                             'submit_time'=>date('h:i A',strtotime($result['submit_time'])),
//                             'total_question'=>$result['total_question'],
//                             'time_duration'=>gmdate("H:i", $result['time_duration']*60),
//                             'attempted_question'=>$result['attempted_question'],
//                             'question_answer'=>json_encode($attemptedQuestion),
//                             'percentage'=>number_format((float)$percentage, 2, '.', ''),
//                             'added_on'=>$result['added_on']
                           
//                         ); 
                        
//                         $count++;
//                     }
//                 }
//             }
//           }
//           }
//         $data['mock_result'] =$dataarray;
//         $exam = $this->db_model->select_data('id,name','exams  use index (id)',array('batch_id'=>$batch_id,'type'=>1,'mock_sheduled_date <='=>date('Y-m-d')),'1',array('id','desc'));
//         if(!empty($exam)){
//             $data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$exam[0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));
//         }else{
//             $data['top_three']='';
//         }
       
// 			$month = date('m');
// 			$year = date('Y');
		
// 		$like = $year.'-'.$month.'-';
// 	    $data['month'] = $month;
// 		$data['year'] = $year;
		
// 		$data['paper_list'] = $this->db_model->select_data('id,name,time_duration,total_question,mock_sheduled_date,mock_sheduled_time','exams use index (id)',array('type'=>1,'admin_id'=>$this->session->userdata('admin_id'),'status'=>1,'batch_id'=>$this->session->userdata('batch_id'),'mock_sheduled_date >='=>date('Y-m-d')),'1',array('mock_sheduled_time','desc'));
// 		$this->load->view('common/student_header',$header);
// 		$this->load->view('student/dashboard_student',$data);
// 		$this->load->view('common/student_footer');
//     }

	public function index()
	{
		$this->check_batch();
        $header['title'] = $this->lang->line('ltr_dashboard');
        $admin_id = $this->session->userdata('admin_id');
		$uid = $this->session->userdata('uid');
		$batch_id = $this->session->userdata('batch_id');
		$batch_id_like = '"'.$this->session->userdata('batch_id').'"';
		$data['batch_details'] = $this->db_model->custom_slect_query("sudent_batchs.student_id,batches.*  FROM `sudent_batchs` JOIN `batches` ON `batches`.`id`=`sudent_batchs`.`batch_id` WHERE `sudent_batchs`.`student_id` = '".$uid."' ");
		// $data['batch_details'] = $this->db_model->select_data('*', 'sudent_batchs',array('student_id' => $uid));
        $data['total_mock_test']=$this->db_model->countAll('exams use index (id)',array('admin_id'=>$admin_id,'status'=>1,'type'=>1,'mock_sheduled_date'=>date('Y-m-d'),'batch_id'=>$batch_id));
        $data['upcoming_mock_test']=$this->db_model->countAll('exams use index (id)',array('admin_id'=>$admin_id,'status'=>1,'type'=>1,'mock_sheduled_date >'=>date('Y-m-d'),'batch_id'=>$batch_id));
        
        $data['previous_mock_test']=$this->db_model->countAll('exams use index (id)',array('admin_id'=>$admin_id,'status'=>1,'type'=>1,'mock_sheduled_date <'=>date('Y-m-d'),'batch_id'=>$batch_id));
		$data['total_homework']=$this->db_model->countAll('homeworks use index (id)',array('admin_id'=>$admin_id,'batch_id'=>$batch_id));
		
		$data['today_homework']=$this->db_model->countAll('homeworks use index (id)',array('admin_id'=>$admin_id,'batch_id'=>$batch_id,'date'=>date('Y-m-d')));
		$data['previous_homework']=$this->db_model->countAll('homeworks use index (id)',array('admin_id'=>$admin_id,'batch_id'=>$batch_id,'date <'=>date('Y-m-d')));
		
		$data['total_extra_class']=$this->db_model->countAll('extra_classes use index(id)',array('admin_id'=>$admin_id,'date'=>date('Y-m-d')),'','',array('batch_id',$batch_id_like));
		$data['total_previous_class']=$this->db_model->countAll('extra_classes use index(id)',array('admin_id'=>$admin_id,'date <'=>date('Y-m-d')),'','',array('batch_id',$batch_id_like));
		$data['total_upcoming_class']=$this->db_model->countAll('extra_classes use index(id)',array('admin_id'=>$admin_id,'date >'=>date('Y-m-d')),'','',array('batch_id',$batch_id_like));
		
		$data['total_vacancy']=$this->db_model->countAll('vacancy use index(id)',array('admin_id'=>$admin_id,'last_date >= '=>date('Y-m-d')));
		$data['online_vacancy']=$this->db_model->countAll('vacancy use index(id)',array('admin_id'=>$admin_id,'last_date >= '=>date('Y-m-d'),'mode'=>'Online'));
		$data['offline_vacancy']=$this->db_model->countAll('vacancy use index(id)',array('admin_id'=>$admin_id,'last_date >= '=>date('Y-m-d'),'mode'=>'Offline'));
	    
	    $table_name = 'mock_result';
        $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>1,'batch_id'=>$this->session->userdata('batch_id'));
        $exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,'',array('id','asc'));
        
        $dataarray =array();
        if($exam_Data){
            
           foreach($exam_Data as $exams){
               
            $cond['paper_id'] = $exams['id'];  
            $cond['student_id'] =$uid;  
            $result_data = $this->db_model->select_data('*', $table_name.' use index (id)',$cond,'',array('id','desc'));
           
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
        $exam = $this->db_model->select_data('id,name','exams  use index (id)',array('batch_id'=>$batch_id,'type'=>1,'mock_sheduled_date <='=>date('Y-m-d')),'1',array('id','desc'));
        if(!empty($exam)){
            $data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$exam[0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));
        }else{
            $data['top_three']='';
        }
       
			$month = date('m');
			$year = date('Y');
		
		$like = $year.'-'.$month.'-';
	    $data['month'] = $month;
		$data['year'] = $year;
		
		$data['paper_list'] = $this->db_model->select_data('id,name,time_duration,total_question,mock_sheduled_date,mock_sheduled_time','exams use index (id)',array('type'=>1,'admin_id'=>$this->session->userdata('admin_id'),'status'=>1,'batch_id'=>$this->session->userdata('batch_id'),'mock_sheduled_date >='=>date('Y-m-d')),'1',array('mock_sheduled_time','desc'));
		$this->load->view('common/student_header',$header);
		$this->load->view('student/dashboard',$data);
		$this->load->view('common/student_footer');
    }


    function profile(){
		$header['title'] = $this->lang->line('ltr_profile');
		$this->load->view('common/student_header',$header);
		$this->load->view('teacher/profile');
		$this->load->view('common/student_footer');
    }

    function extra_classes(){
		$header['title']=$this->lang->line('ltr_extra_classes');
		$admin_id = $this->session->userdata('admin_id');
		$batch_id_like = '"'.$this->session->userdata('batch_id').'"';
		$data['todayClass']=$this->db_model->select_data('extra_classes.*,users.name,users.teach_gender','extra_classes use index(id)',array('extra_classes.admin_id'=>$admin_id,'extra_classes.date >= '=>date('Y-m-d')),'',array('date','asc'),array('batch_id',$batch_id_like),array('users','users.id = extra_classes.teacher_id'));
		
		 $like = array('batch_id','"'.$this->session->userdata('batch_id').'"');
		 $data['eclass_data'] = $this->db_model->select_data('batch_id','extra_classes  use index (id)','','',array('id','desc'),$like);

		$this->load->view("common/student_header",$header);
		$this->load->view("student/extra_classes",$data); 
		$this->load->view("common/student_footer");
	}

	function homework(){
		$header['title']=$this->lang->line('ltr_homework');
		$admin_id = $this->session->userdata('admin_id');
		
		$data['todayHW']=$this->db_model->select_data('homeworks.description,users.name,users.teach_gender,subjects.subject_name','homeworks use index(id)',array('homeworks.admin_id'=>$admin_id,'homeworks.date'=>date('Y-m-d'),'homeworks.batch_id'=>$this->session->userdata('batch_id')),'','','',array('multiple',array(array('users','users.id = homeworks.teacher_id'),array('subjects','subjects.id = homeworks.subject_id'))));
		
		$data['homeworks_data'] = $this->db_model->select_data('*','homeworks  use index (id)',array('admin_id'=>$admin_id,'batch_id'=>$this->session->userdata('batch_id'),'homeworks.date >= '=>date('Y-m-d')),'',array('id','desc'));
// 	$data['homeworks_data'] = $this->db_model->select_data('*','homeworks  use index (id)',array('admin_id'=>$admin_id,'batch_id'=>$this->session->userdata('batch_id'),'homeworks.date = '=>date('Y-m-d')),'',array('id','desc'));
// 		echo $this->db->last_query();
		$this->load->view("common/student_header",$header);
		$this->load->view("student/homework",$data); 
		$this->load->view("common/student_footer");
    }
    function start_class($id){
        $data =array();
		$livedata =$this->db_model->select_data('*','live_class_setting',array('batch' =>$id));
		$date = date('Y-m-d');
		$time_s = date('h:i:s A');
		$subCon = "batch_id = '$id' AND date ='$date' AND end_time =''";
		$livedata_his =$this->db_model->select_data('*','live_class_history',$subCon,1,array('id','desc'));
	    
	
		if(!empty($livedata) && !empty($livedata_his)){
    		$data['signature'] = $this->generate_signature($livedata[0]['zoom_api_key'], $livedata[0]['zoom_api_secret'],$livedata[0]['meeting_number'],0);
    		$data['api_key']=$livedata[0]['zoom_api_key'];
    		$data['display_name']=$this->session->userdata('name');
    		$data['meeting_number']=$livedata[0]['meeting_number'];
    		$data['password']=$livedata[0]['password'];
    		$this->load->view("student/start_live_class",$data);
        }else{
           
            $header['title']=$this->lang->line('ltr_live_class');
            $this->load->view("common/student_header",$header);
    		$this->load->view("student/no_live_class"); 
    		$this->load->view("common/student_footer");
        }
		
	}
	function generate_signature ( $api_key, $api_sercet, $meeting_number, $role){
		$time = (time()- 5*60) * 1000; //time in milliseconds (or close enough)
		$data = base64_encode($api_key . $meeting_number . $time . $role);
		$hash = hash_hmac('sha256', $data, $api_sercet, true);
		$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
		return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
	}
    function video_lecture(){
		$header['title']=$this->lang->line('ltr_video_lecture');
	//	$this->session->userdata('batch_id')
        $data['subject'] = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',array('subjects.admin_id'=>$this->session->userdata('admin_id'),'batch_subjects.batch_id'=>$this->session->userdata('batch_id')),'',array('subjects.id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
        $like = array('batch','"'.$this->session->userdata('batch_id').'"');
		$data['video_data'] = $this->db_model->select_data('batch','video_lectures  use index (id)','','',array('id','desc'));
		$this->load->view("common/student_header",$header);
		$this->load->view("admin/video_manage",$data); 
		$this->load->view("common/student_footer");
    }
    
    function vacancy(){
		$header['title']= $this->lang->line('ltr_upcoming_exams');
		$this->load->view("common/student_header",$header);
		$data['vacancy_data'] = $this->db_model->select_data('id','vacancy  use index (id)',array('admin_id'=>$this->session->userdata('admin_id')),'',array('id','desc'));
		$this->load->view("admin/vacancy_manage",$data); 
		$this->load->view("common/student_footer");
	}
    
    function notification(){
		$header['title']= $this->lang->line('ltr_notification');
		$this->load->view("common/student_header",$header);
		$data['notification_data'] = $this->db_model->select_data('notification_type,msg,time,url','notifications',array('batch_id'=>$this->session->userdata('batch_id')),'',array('id','desc'));
		$this->load->view("student/all_notification",$data); 
		$this->load->view("common/student_footer");
	}
    
    function notice(){
		$header['title'] = $this->lang->line('ltr_notice');
		$admin_id = $this->session->userdata('admin_id');
		$uid = $this->session->userdata('uid');
		$this->db_model->update_data('notices use index(id)',array('read_status'=>1),array('student_id'=>$this->session->userdata('uid')));
        $subCon = "notice_for in ('Both','Student') || student_id ='$uid'";
		$data['notice_data'] =$this->db_model->select_data('*','notices',$subCon,1,array('id','desc'));
		$this->load->view('common/student_header',$header);
		$this->load->view('student/notice',$data);
		$this->load->view('common/student_footer');
	}

	function answer_sheet($paper_type='',$result_id='',$paper_id){
		$header['title']=$this->lang->line('ltr_answer_sheet');
		if($paper_type == 'mock'){
			$type = 1;
			$table = 'mock_result';
		}else{
			$type = 2;
			$table = 'practice_result';
		}
		if($result_id!=0){
		    $data['result_details'] = $this->db_model->select_data("$table.*,exams.question_ids",$table.' use index (id)',array("$table.id"=>$result_id),1,'','',array('exams',"exams.id = $table.paper_id"));
		}else{
		    $data['result_details'] =$this->db_model->select_data("*",'exams use index (id)',array("id"=>$paper_id),1,'','');
		}
		
		$this->load->view("common/student_header",$header);
		$this->load->view("student/answer_sheet",$data); 
		$this->load->view("common/student_footer");
    }
    
    function practice_paper(){
        // print_r($_SESSION);
		$header['title']=$this->lang->line('ltr_practice_paper');
// 		$data['paper_list'] = $this->db_model->select_data('id,name,time_duration,total_question','exams use index (id)',array('type'=>2,'admin_id'=>$this->session->userdata('admin_id'),'status'=>1,'batch_id'=>$this->session->userdata('batch_id')),'',array('id','desc'));
		$data['paper_list'] = $this->db_model->select_data('id,name,time_duration,total_question','exams use index (id)',array('type'=>2,'admin_id'=>$this->session->userdata('admin_id'),'status'=>1,'batch_id'=>$this->session->userdata('batch_id')),'',array('id','desc'));
		
		$data['practice_data'] = $this->db_model->select_data('id','exams  use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'type'=>2),'',array('id','desc'));
	
		$data['paper_type'] = 'practice';
		$this->load->view("common/student_header",$header);
		$this->load->view("student/show_paper",$data); 
		$this->load->view("common/student_footer");
    } 
    
    function mock_paper(){
      
		$header['title']=$this->lang->line('ltr_mock_paper');
		$data['paper_list'] = $this->db_model->select_data('id,name,time_duration,total_question,mock_sheduled_date,mock_sheduled_time','exams use index (id)',array('type'=>1,'admin_id'=>$this->session->userdata('admin_id'),'status'=>1,'batch_id'=>$this->session->userdata('batch_id'),'mock_sheduled_date >='=>date('Y-m-d')),'',array('id','desc'));
		$data['mock_data'] = $this->db_model->select_data('id','exams  use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$this->session->userdata('batch_id'),'type'=>1),'',array('id','desc'));
		$data['paper_type'] = 'mock';
		$this->load->view("common/student_header",$header);
		$this->load->view("student/show_paper",$data); 
		$this->load->view("common/student_footer");
	}
 
	function practice_result(){
		$header['title']=$this->lang->line('ltr_practice_result');
		$data['paperList'] = $this->db_model->select_data('id,name','exams use index (id)',array('type'=>2,'admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$this->session->userdata('batch_id')),'',array('id','desc'));
		$data['papeResult'] = $this->db_model->select_data('id','practice_result use index (id)',array('student_id'=>$this->session->userdata('uid'),'admin_id'=>$this->session->userdata('admin_id')),1,array('id','desc'));
		$this->load->view("common/student_header",$header);
		$this->load->view("student/practice_result",$data); 
		$this->load->view("common/student_footer");
	}

	function mock_result(){
		$header['title']=$this->lang->line('ltr_mock_test_result');
		$data['paperList'] = $this->db_model->select_data('id,name','exams use index (id)',array('type'=>1,'admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$this->session->userdata('batch_id')),'',array('id','desc'));
		$this->load->view("common/student_header",$header);
		$this->load->view("student/mock_result",$data); 
		$this->load->view("common/student_footer");
	}
	
	function apply_leave(){
		$header['title']=$this->lang->line('ltr_apply_leave');
		$data = array();
		$data['leave_data'] = $this->db_model->select_data('id','leave_management use index (id)',array('admin_id'=>$this->session->userdata('admin_id'),'student_id'=>$this->session->userdata('uid')),1);
		$this->load->view("common/student_header",$header);
		$this->load->view("teacher/apply_leave",$data); 
		$this->load->view("common/student_footer");
	}

	function view_progress(){
		$uid = $this->session->userdata('uid');
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
		$header['title']=$this->lang->line('ltr_progress');
		$like = $year.'-'.$month.'-';
		
	
		$table_name = 'practice_result';
		$cond1=array('type'=>2,'batch_id'=>$this->session->userdata('batch_id'));
		$exam_Datap = $this->db_model->select_data('*', 'exams use index (id)',$cond1,'',array('id','asc'));
		
		$dataarray_pre =array();
        if($exam_Datap){
            
           foreach($exam_Datap as $exams){
               
            $cond['paper_id'] = $exams['id'];  
            $cond['student_id'] =$uid;  
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
        $cond1=array("admin_id"=>$this->session->userdata('admin_id'),'type'=>1,'batch_id'=>$this->session->userdata('batch_id'));
        $exam_Data = $this->db_model->select_data('*', 'exams use index (id)',$cond1,'',array('id','asc'));
        
        $dataarray =array();
        if($exam_Data){
            
           foreach($exam_Data as $exams){
               
            $cond['paper_id'] = $exams['id'];  
            $cond['student_id'] =$uid;  
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
		$data['practice_result_d'] = $this->db_model->select_data('total_question,question_answer,date,paper_name,percentage','practice_result',array('student_id'=>$this->session->userdata('uid'),'admin_id'=>$this->session->userdata('admin_id')),1);
	    $data['mock_result_d'] = $this->db_model->select_data('total_question,question_answer,date,paper_name,percentage','mock_result',array('student_id'=>$this->session->userdata('uid'),'admin_id'=>$this->session->userdata('admin_id')),1);
		
		$data['month'] = $month;
		$data['year'] = $year;
	    
		$this->load->view("common/student_header",$header);
		$this->load->view("student/view_progress",$data); 
		$this->load->view("common/student_footer");
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
		
		$like_batch_id='"'.$this->session->userdata('batch_id').'"';
		$data['extra_class'] = $this->db_model->countAll('extra_class_attendance',array('student_id'=>$this->session->userdata('uid')),'','',array('date',$like));
		
		$data['homework'] = $this->db_model->countAll('homeworks',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$this->session->userdata('batch_id')),'','',array('date',$like));
		
		$data['total_extra_class'] = $this->db_model->countAll('extra_classes','',array('batch_id'=>$like_batch_id),'',array('date',$like));
	    $data['practice_result'] = $this->db_model->custom_slect_query(" COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_result` JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id` WHERE `practice_result`.`admin_id` = '".$this->session->userdata('admin_id')."' AND `student_id` = '".$this->session->userdata('uid')."' AND date(added_at) LIKE '%".$like."%' ESCAPE '!' GROUP BY `paper_id` ) a")[0]['numrows'];
	
		$data['total_practice_test'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$this->session->userdata('batch_id'),'type'=>2),'','',array('date(added_at)',$like));
		
		$data['mock_result'] = $this->db_model->countAll('mock_result',array('admin_id'=>$this->session->userdata('admin_id'),'student_id'=>$this->session->userdata('uid')),'','',array('date',$like));
		
		$data['total_mock_test'] = $this->db_model->countAll('exams',array('admin_id'=>$this->session->userdata('admin_id'),'batch_id'=>$this->session->userdata('batch_id'),'type'=>1),'','',array('date(added_at)',$like));
		
		$this->load->view("common/student_header",$header);
		$this->load->view("student/academic_record",$data); 
		$this->load->view("common/student_footer");
	}
	function student_attendance(){
		if(isset($_POST['filter_performance'])){
			$month = $_POST['month']; 
			$year = $_POST['year'];	
		}else{ 	
			$month = date('m');
			$year = date('Y');
		}
			$header['title']="Attendance";	
		$id=$this->session->userdata('uid');
		$data['month'] = $month;
		$data['year'] = $year;
		$data['student_id'] = $id;
		$data['baseurl'] = base_url();
		$data['attendance'] = $this->db_model->select_data('id','attendance',array('student_id'=>$this->session->userdata('uid')),1);
		$this->load->view("common/student_header",$header);
		$this->load->view("student/student_attendance",$data); 
		$this->load->view("common/student_footer");
	}
	function certificate(){
		$header['title']=$this->lang->line('ltr_certificate');
		$id=$this->session->userdata('uid');
		$batch_id = $this->session->userdata('batch_id');
		$data['student_certificate']=$this->db_model->select_data('*','certificate',array('student_id'=>$id,'batch_id'=>$batch_id),1,array('id','desc'));
		$data['certificate_details']=$this->db_model->select_data('*','certificate_setting','',1,array('id','desc'));
		
		$data['batchdata']=$this->db_model->select_data('batch_name','batches',array('id'=>$batch_id),1,array('id','desc'));
		
		$data['baseurl'] = base_url();
// 		$data['uid'] = $id;
		$data['batch_id'] = $batch_id;
		$data['student_id'] = $id;

		$this->load->view("common/student_header",$header);
		$this->load->view("student/certificate_new",$data); 
		$this->load->view("common/student_footer");
		
	}
	
	function certificate_view($batch_id){
		$header['title']=$this->lang->line('ltr_certificate');
		$id=$this->session->userdata('uid');
// 		$batch_id = $this->session->userdata('batch_id');
		$data['student_certificate']=$this->db_model->select_data('*','certificate',array('student_id'=>$id,'batch_id'=>$batch_id),1,array('id','desc'));
		$data['certificate_details']=$this->db_model->select_data('*','certificate_setting','',1,array('id','desc'));
		
		$data['batchdata']=$this->db_model->select_data('batch_name','batches',array('id'=>$batch_id),1,array('id','desc'));
		
		$data['baseurl'] = base_url();
 		$data['uid'] = $id;
		$data['batch_id'] = $batch_id;
		$data['student_id'] = $id;

		$this->load->view("common/student_header",$header);
		$this->load->view("student/certificate",$data); 
		$this->load->view("common/student_footer");
		
	}
	
	function doubts_ask($id=''){
	    $header['title']=$this->lang->line('ltr_doubts_ask');	
		$id=$this->session->userdata('uid');
		$data['doubts_class_data'] = $this->db_model->select_data('doubt_id','student_doubts_class',array('student_id'=>$id),1);
		$data['id'] = $id;
		$batch_id = $this->session->userdata('batch_id');
		$subBatch = $this->db_model->select_data('subject_id, chapter','batch_subjects use index (id)',array('batch_id '=>$this->session->userdata('batch_id')),'',array('id','desc'));
		$condd ='';
		if(!empty($subBatch)){
			$subId =array();
			foreach($subBatch as $value){
				array_push($subId, $value['subject_id']);
			}
			$sid = implode(',', $subId);
			$condd = "id in ($sid)";
		}
		
		$data['subject'] = $this->db_model->select_data('id,subject_name,no_of_questions','subjects use index (id)',$condd,'',array('id','desc'));
		$this->load->view("common/student_header",$header);
		$this->load->view("student/add_doubts_ask",$data); 
		$this->load->view("common/student_footer");
	}
	
	//new update
	
	function book(){
		$header['title']=$this->lang->line('ltr_library');
	//	$this->session->userdata('batch_id')
        $data['subject'] = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',array('subjects.admin_id'=>$this->session->userdata('admin_id'),'batch_subjects.batch_id'=>$this->session->userdata('batch_id')),'',array('subjects.id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
        $like = array('batch','"'.$this->session->userdata('batch_id').'"');
		$data['book_data'] = $this->db_model->select_data('batch','book_pdf  use index (id)',array('admin_id'=>$this->session->userdata('admin_id')),'',array('id','desc'),$like);
		$this->load->view("common/student_header",$header);
		$this->load->view("admin/book_manage",$data); 
		$this->load->view("common/student_footer");
    }
     function notes(){
		$header['title']=$this->lang->line('ltr_notes');
	//	$this->session->userdata('batch_id')
	    if(!empty($this->session->userdata('batch_id'))){
			$data['subject'] = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',array('subjects.admin_id'=>$this->session->userdata('admin_id'),'batch_subjects.batch_id'=>$this->session->userdata('batch_id')),'',array('subjects.id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
			$like = array('batch','"'.$this->session->userdata('batch_id').'"');
		}else{
			$like='';
		}
		$data['notes_data'] = $this->db_model->select_data('*','notes_pdf  use index (id)',array('admin_id'=>$this->session->userdata('admin_id')),'',array('id','desc'),$like);
		$this->load->view("common/student_header",$header);
		$this->load->view("admin/notes_manage",$data); 
		$this->load->view("common/student_footer");
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
	// 	$this->load->view("common/student_header",$header);
	// 	$this->load->view("admin/pdf_view_file",$data); 
	// 	$this->load->view("common/student_footer");

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
				foreach($book_data as $vac){
					$files = json_decode($vac['files'],true);
					foreach($files as $file){
						$ext = pathinfo(base_url('uploads/vacancy/'.$file))['extension'];
						if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg'){
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
		$this->load->view("common/student_header",$header);
		$this->load->view("admin/pdf_view_file",$data); 
		$this->load->view("common/student_footer");

	}

	public function check_batch(){
		if(empty($_SESSION['batch_id'])){
		    $batches = $this->db_model->select_data('*','batches use index (id)',array('batches.status'=>'1','batches.admin_id'=>'1','student_id'=>$this->session->userdata('uid')),'','','',array('sudent_batchs','sudent_batchs.batch_id=batches.id'));
		    if(!empty($batches)){
    		  redirect(base_url('student/my-course')); 
        	  }else{
        		redirect(base_url('student/courses-data/All')); 
                // redirect(base_url('student/my-course')); 
        	  }
	        
	    }
	}
	public function select_course($id=''){
		if(empty($id)){
			redirect(base_url('student/courses-data')); 
		}
		 $this->session->set_userdata(array('batch_id' => $id));
		 redirect(base_url('student/dashboard')); 
	}
	
	function my_course(){
	    
		$header['title'] = $this->lang->line('ltr_my_course');
        // $batches = $this->db_model->select_data('*','batches use index (id)',array('batches.status'=>'1','admin_id'=>'1','student_id'=>$this->session->userdata('uid')),'','','',array('sudent_batchs','sudent_batchs.batch_id=batches.id'));
        $batches = $this->db_model->select_data('*','batches use index (id)',array('batches.status'=>'1','student_id'=>$this->session->userdata('uid')),'','','',array('sudent_batchs','sudent_batchs.batch_id=batches.id'));
	  if(!empty($batches)){
	  	
		  foreach($batches as $key =>$value){
			  $batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
		  }
		  $data['batches']= $batches;
	  }else{
		  $data['batches'] =''; 
	  }
	 
	   $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
	  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
		$this->load->view('common/student_header',$header);
		$this->load->view('student/my_course',$data);
		$this->load->view('common/student_footer');
	}
	public function courses_data($type=""){
		if(empty($type)){
			$type="All";
		}
		$header['title'] = $this->lang->line('ltr_courses');
		if(!empty($this->session->userdata('uid'))){
    		$batchs_id =$this->db_model->select_data('batch_id','sudent_batchs',array('student_id'=>$this->session->userdata('uid')));
    		
    	    if(!empty($batchs_id)){
    	        $batchId=array();
    	        foreach($batchs_id as $key=>$value){
    	            $batchId[$key] =$value['batch_id'];
    	        }
    	    }else{
    	         $batchId[0] = 0;
    	    }
		}
	   
	    $batch_id =implode(', ',$batchId);
		
		if($type=="All"){
		    $cond=array('status'=>'1');
    	   // $cond="id NOT IN ($batch_id) AND status=1";
    	    $batches = $this->db_model->select_data('*','batches use index (id)',$cond,'',array('id','desc'));
		}
		if($type=="free"){
		    
            $cond="id NOT IN ($batch_id) AND status=1 AND batch_type=1";
    	    $batches = $this->db_model->select_data('*','batches use index (id)',$cond,'',array('id','desc'));
		}
		if($type=="paid"){
            $cond="id NOT IN ($batch_id) AND status=1 AND batch_type=2";
    	    $batches = $this->db_model->select_data('*','batches use index (id)',$cond,'',array('id','desc'));
		}
	  if(!empty($batches)){
		  foreach($batches as $key =>$value){
			  $batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
		  }
		  $data['batches']= $batches;
	  }else{
		  $data['batches'] =''; 
	  }
	   $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
	  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
	  $data['category_data'] = $this->db_model->select_data('id,name,slug','batch_category use index (id)',array('status'=>'1'));
      $data['trending_courses'] = $this->db_model->select_data('*','batches use index (id)',array('no_of_student = (SELECT MAX(no_of_student) FROM batches)','status'=>'1','admin_id'=>'1'));
	  $data['free_courses'] = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','batch_type'=>'1','admin_id'=>'1'));
	  $data['new_courses'] = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','admin_id'=>$_SESSION['uid']),'',array('id','desc'));
	   $data['video_lectures'] = $this->db_model->select_data('*','video_lectures use index (id)',array('status'=>1),'',array('id','desc'));
		$this->load->view('common/student_header',$header);
		$this->load->view('student/courses_data_new',$data);
		$this->load->view('common/student_footer');
	}
	
// 	function old_paper(){
		    
// 		    $header['title']=$this->lang->line('ltr_old_paper');
// 	        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
// 	        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
// 	        $like = array('batch','"'.$this->session->userdata('batch_id').'"');
// 	        $data['notes_data'] = $this->db_model->select_data('*','old_paper_pdf use index (id)',array('status'=>1),'',array('id','desc'),$like);
// 			$this->load->view("common/admin_header",$header);
// 			$this->load->view("admin/old_paper_manage",$data); 
// 			$this->load->view("common/admin_footer");
// 		}
		
		
			function old_paper(){
		    
		    $header['title']=$this->lang->line('ltr_old_paper');
	        $data['subject'] = $this->db_model->select_data('id,subject_name','subjects use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $data['batch'] = $this->db_model->select_data('id,batch_name','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'',array('id','desc'));
	        $like = array('batch','"'.$this->session->userdata('batch_id').'"');
	        $data['notes_data'] = $this->db_model->select_data('*','old_paper_pdf use index (id)',array('status'=>1),'',array('id','desc'),$like);
			$this->load->view("common/student_header",$header);
			$this->load->view("admin/old_paper_manage",$data); 
			$this->load->view("common/student_footer");
		}
		
		
		function readMoreWord($story_desc,$C_word='') {
            $chars = 90;
            if(!empty($C_word)){
                $chars =$C_word;
            }
            
            $count_word = strlen($story_desc);
            if($count_word>$chars){
               
        	    $story_desc = substr($story_desc,0,$chars);  
        	    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
        	    $story_desc = $story_desc ;
        	    return $story_desc ;  
        	    
            }else{
                return $story_desc ; 
            }
        }
        
        function all_syllabus($id){
           
	    $header['title']=$this->lang->line('ltr_syllabus');	
	    
	        $join = array('subjects',"subjects.id = batch_subjects.subject_id");
            $cond = array('batch_subjects.batch_id'=>$id);
           $batchData = array();
            $batchSubjects = $this->db_model->select_data('batch_subjects.*','batch_subjects use index (id)',$cond,'',array('id','desc'),'',$join,'');
     
            if(!empty($batchSubjects)){
                foreach($batchSubjects as $subkey=> $sub){
                    $completedchaptr = json_decode($sub['chapter_status'],true);
                    if(!empty($completedchaptr)){
                        $dataIndx = implode(',',$completedchaptr);
                    }else{
                        $dataIndx = '';
                    }
    
                    $batchdata = $this->db_model->select_data('batch_name,start_time,end_time,status','batches use index (id)',array('id'=>$sub['batch_id']));
                   
                    $subject_name = $this->db_model->select_data('subject_name','subjects use index (id)',array('id'=>$sub['subject_id']));
                   
                    if(!empty($subject_name)){
                         $batchData[$subkey]['subject_name'] =  $subject_name[0]['subject_name'];
                   
                    }
                    $chapter_ids = implode(',',json_decode($sub['chapter']));
                    $chapterdata = $this->db_model->select_data('id,chapter_name','chapters use index (id)',"id in ($chapter_ids)");
                    if(!empty($chapterdata)){
                        $batchData[$subkey]['chapterdata'] =  $chapterdata;
                   
                    }
                    $chapters = array();
                    
                    if(!empty($batchdata)){
                        if(!empty($chapterdata)){
                            $i = 0;
                            $completedDate = json_decode($sub['chapter_complt_date'],true);
                            foreach($chapterdata as $ckey=> $chapter){
                                $style = '';
                                $title = '';
                                if(!empty($completedchaptr) && in_array($chapter['id'],$completedchaptr)){
                                    $style = 'style="background-color:#d7ffe0;"';
                                }else{
                                     $style = 'style="background-color:#ffe5e5;"';
                                }
                                 $chapterdata[$ckey]['style'] =  $style;
                                 
                                if(!empty($completedDate) && array_key_exists($chapter['id'],$completedDate)){
                                    
                                    $title = 'Completed on '.$completedDate[$chapter['id']];
                                }
                                 $chapterdata[$ckey]['title'] =  $title;
                             
                                // $chapters = '<p class="chapter_wrap" data-id="'.$sub['id'].'" '.$style.' data-chapter="'.$chapter['id'].'" title="'.$title.'"><span>'.$chapter['chapter_name'].'</span></p>';
                                // if(!empty($chapterdata)){
                                //      $chapterdata[$ckey]['chapters'] =  $chapters;
                                // }
                                $i++;
                            }
                            $batchData[$subkey]['chapters'] =  $chapterdata;
                            
                            
                        }
                    }
                }
                $data['batchData'] = $batchData;
                
            }else{
                $data = array();
            }
            
            // $id = $this->session->userdata('batch_id');
		$this->load->view("common/student_header",$header);
		$this->load->view("student/syllabus",$data); 
		$this->load->view("common/student_footer");
	}
	
	function check_batch_dashboard(){
	   
	  	    	if(empty($_SESSION['batch_id'])){
		    $batches = $this->db_model->select_data('*','batches use index (id)',array('batches.status'=>'1','admin_id'=>'1','student_id'=>$this->session->userdata('uid')),'','','',array('sudent_batchs','sudent_batchs.batch_id=batches.id'));
		  	if(is_array($batches)){
    		  redirect(base_url('student/select-dashboard')); 
        	  }else{
        		redirect(base_url('student/select-dashboard')); 
        	  }
	        
	    }
	}
	
	function select_dashboard(){
	    
	    $this->load->view("common/student_header",$header);
		$this->load->view("student/select_dashboard",$data); 
		$this->load->view("common/student_footer");
	}
	
        
	
}