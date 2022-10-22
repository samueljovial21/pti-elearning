<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincommon{ 	
	function __Construct(){
		$this->CI = get_instance();
		$this->CI->load->model('db_model');
	}
	    
	function admin_dashboard($uid,$s_admin,$role){ 
	    if($s_admin==1 && $role=1){
	        $conds = array('admin_id'=>$uid,'student_id !='=>0);
	        $condt = array('admin_id'=>$uid,'teacher_id !='=>0);
	        $cond = array('admin_id'=>$uid,'status'=>'1');
	        $condbt = array('admin_id'=>$uid);
	        $cond1 = array('admin_id'=>$uid,'status'=>'0');
	        $condvimp =array('admin_id'=>$uid,'category'=>2);
	        $condimp =array('admin_id'=>$uid,'category'=>1);
	        
	        $where_in="`sudent_batchs`.`admin_id`=$uid";
	    }else if($s_admin==0 && $role=1){
	        $conds = array('admin_id'=>$uid,'student_id !='=>0);
	        $condt = array('admin_id'=>$uid,'teacher_id !='=>0);
	        $cond = array('admin_id'=>$uid,'status'=>'1');
	        $cond1 = array('admin_id'=>$uid,'status'=>'0');
	         $condbt = array('admin_id'=>$uid);
	        $condvimp =array('admin_id'=>$uid,'category'=>2);
	        $condimp =array('admin_id'=>$uid,'category'=>1);
	         $where_in="`sudent_batchs`.`admin_id`=$uid";
	    }else if($s_admin==0 && $role=3){
	        $conds = array('admin_id'=>$uid,'student_id !='=>0);
	        $condt = array('admin_id'=>$uid,'teacher_id !='=>0);
	        $cond = array('admin_id'=>$uid,'status'=>'1');
	        $cond1 = array('admin_id'=>$uid,'status'=>'0');
	        $condvimp =array('admin_id'=>$uid,'category'=>2);
	         $condbt = array('admin_id'=>$uid);
	        $condimp =array('admin_id'=>$uid,'category'=>1);
	        $where_in="`sudent_batchs`.`admin_id`=$uid";
	    }
	   // $total_student = $this->CI->db_model->custom_slect_query("COUNT(id) AS `numrows`
                    // FROM (SELECT `sudent_batchs`.`id` FROM sudent_batchs LEFT JOIN `students` ON `students`.`id`=`sudent_batchs`.`student_id` WHERE $where_in  ".($like1 != ''?"AND name LIKE '%".$like1."%' ESCAPE '!'":'')." GROUP BY `students`.`id`) sada")[0]['numrows'];
                     
	    $total_student=$this->CI->db_model->countAll('students use index (id)',array('admin_id'=>$uid,'status'=>'1','batch_id !='=>0));
		$total_batch=$this->CI->db_model->countAll('batches use index (id)',$condbt);
		$active_batch=$this->CI->db_model->countAll('batches use index (id)',$cond);
		$inactive_batch=$this->CI->db_model->countAll('batches use index (id)',$cond1);
		$total_question=$this->CI->db_model->countAll('questions use index(id)',$cond);
		$vimp_question=$this->CI->db_model->countAll('questions use index(id)',$condvimp);
		$imp_question=$this->CI->db_model->countAll('questions use index(id)',$condimp);
		$total_leave=$this->CI->db_model->countAll('leave_management use index(id)',$cond);
		$student_leave=$this->CI->db_model->countAll('leave_management use index(id)',$conds);
		$teacher_leave=$this->CI->db_model->countAll('leave_management use index(id)',$condt);
		$present = $this->CI->db_model->countAll('attendance',array('date'=>date('Y-m-d')),'','','','','student_id');
		$data['total_student'] = $total_student;
		$data['total_present'] = $present;
		$data['total_batch'] = $total_batch;	
		$data['active_batch'] = $active_batch;	
		$data['inactive_batch'] = $inactive_batch;	
		$data['total_question'] = $total_question;
		$data['vimp_question'] = $vimp_question;
		$data['imp_question'] = $imp_question;
		$data['total_leave'] = $total_leave;	
		$data['student_leave'] = $student_leave;	
		$data['teacher_leave'] = $teacher_leave;	
		return $data;
	}
}