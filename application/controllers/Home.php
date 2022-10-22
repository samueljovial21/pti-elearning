<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct(){
	    	parent::__construct();
			
			// check select language
			$this->load->helper('file');
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

    function index(){
      $data['title'] =$this->lang->line('ltr_home');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      
      $data['Allcourses'] = $this->db_model->select_data('*','courses use index (id)',array('status'=>'1','admin_id'=>'1'),'');
      //print_r($data['Allcourses']);
      // die();
      $data['Allfacilities'] = $this->db_model->select_data('*','facilities use index (id)',array('status'=>'1'),6);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
       $batches = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','admin_id'=>'1'),3,array('id','DESC'));
	  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
       $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
	  if(!empty($batches)){
		  foreach($batches as $key =>$value){
			  $batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
		  }
		  $data['batches']= $batches;
	  }else{
		  $data['batches'] =''; 
	  }
      	  $this->load->view('common/front_header',$data);
		  $this->load->view('frontend/home',$data);
		  $this->load->view('common/front_footer',$data);
    }

    function login(){
      if(isset($this->session->userdata['role']))
      {
        $role = $this->session->userdata['role'];
        if($role==1){
          redirect(base_url().'admin/dashboard');
        }elseif($role==3){
          redirect(base_url().'teacher/dashboard');
        }else if($role=='student'){
          redirect(base_url().'student/my_course');
        }
      } 
      $header['title']=$this->lang->line('ltr_login'); 
      $this->load->view('common/auth_header',$header);
      $this->load->view('frontend/login');
      $this->load->view('common/auth_footer');
    }
    
    function register(){
     
      $header['title']=$this->lang->line('ltr_register'); 
      $this->load->view('common/auth_header',$header);
      $this->load->view('frontend/register');
      $this->load->view('common/auth_footer');
    }

    function forgot_password(){
      $header['title']=$this->lang->line('ltr_forgot_password'); 
      $this->load->view('common/auth_header',$header);
      $this->load->view('frontend/forgot_password');
      $this->load->view('common/auth_footer');
    }

    function about(){
      $data['title'] = $this->lang->line('ltr_about'); 
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/about',$data);
      $this->load->view('common/front_footer',$data);
    }
    
    function courses(){
    
     $header['title']=$this->lang->line('ltr_live_class');
   
      $header['title'] =$this->lang->line('ltr_courses_offered'); 
      $header['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1'),5);
      $data['category_data'] = $this->db_model->select_data('id,name,slug','batch_category use index (id)',array('status'=>'1'));
	  $batches = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1'));
// 	  $batches = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1'),'',array('id','desc'));
	  if(!empty($batches)){
		  foreach($batches as $key =>$value){
			  $batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
		  }
		  $data['batches']= $batches;
	  }else{
		  $data['batches'] =''; 
	  }
	   $data['video_lectures'] = $this->db_model->select_data('*','video_lectures use index (id)',array('status'=>1,'preview_type'=>'preview'),'',array('id','desc'));
    //   $data['Allcourses'] = $this->db_model->select_data('*','courses use index (id)',array('status'=>'1','admin_id'=>'1'),'');
        $data['Allcourses'] = $this->db_model->select_data('*','courses use index (id)',array('status'=>'1'),'');
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
	  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
	  $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
	  $data['trending_courses'] = $this->db_model->select_data('*','batches use index (id)',array('no_of_student = (SELECT MAX(no_of_student) FROM batches)','status'=>'1'));
	  $data['free_courses'] = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','batch_type'=>'1'),'',array('id','desc'));
	  //print_r($data['free_courses']);
	  $data['new_courses'] = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1'),'',array('id','desc'));
        $this->load->view('common/front_header',$header);
        $this->load->view('frontend/product',$data);
        $this->load->view('common/front_footer');
    }
    

//     function courses(){
//       $data['title'] =$this->lang->line('ltr_courses_offered'); 
//       $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
//       $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      
// 	  $batches = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','admin_id'=>'1'));
// 	  if(!empty($batches)){
// 		  foreach($batches as $key =>$value){
// 			  $batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
// 		  }
// 		  $data['batches']= $batches;
// 	  }else{
// 		  $data['batches'] =''; 
// 	  }
//       $data['Allcourses'] = $this->db_model->select_data('*','courses use index (id)',array('status'=>'1','admin_id'=>'1'),'');
//       $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
// 	  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
// 	  $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
//       $this->load->view('common/front_header',$data);
//       $this->load->view('frontend/courses',$data);
//       $this->load->view('common/front_footer',$data);
//     }

// 	 function courses_details($id=""){
// 		  $data['title'] =$this->lang->line('ltr_course_details'); 
// 		  $data['currency_decimal'] =$this->general_settings('currency_decimal_code');
// 		  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
// 		  $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
// 		  $data['singel_batches'] = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','admin_id'=>'1','id'=>$id));
// 		  $data['batch_fecherd'] = $this->db_model->select_data('*','batch_fecherd',array('batch_id'=>$id));
// 		  $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
// 		  $batches = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','admin_id'=>'1','id !='=>$id));
// 		  if(!empty($batches)){
// 			  foreach($batches as $key =>$value){
// 				  $batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
// 			  }
// 			  $data['batches']= $batches;
// 		  }else{
// 			  $data['batches'] =''; 
// 		  }
//       $like = array('batch','"'.$id.'"');
//       $data['video_lectures'] = $this->db_model->select_data('*','video_lectures use index (id)',array('status'=>1),'','',$like,'','subject');
// 		  $this->load->view('common/front_header',$data);
// 		  $this->load->view('frontend/courses_details',$data);
// 		  $this->load->view('common/front_footer',$data);
// 	 }
	 
function courses_details($id=""){
    // print_r($id);
    // die();
	$data['title'] =$this->lang->line('ltr_course_details'); 
	$data['currency_decimal'] =$this->general_settings('currency_decimal_code');
	$data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
	$data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
	$data['singel_batches'] = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','id'=>$id));
	$data['batch_fecherd'] = $this->db_model->select_data('*','batch_fecherd',array('batch_id'=>$id));
	$data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
	$batches = $this->db_model->select_data('*','batches use index (id)',array('status'=>'1','admin_id'=>'1','id !='=>$id));
	if(!empty($batches)){
		foreach($batches as $key =>$value){
			$batches[$key]['description'] = $this->readMoreWord($value['description'], 150);
		}
		$data['batches']= $batches;
	}else{
		$data['batches'] =''; 
	}
//   $like = array('batch','"'.$id.'"');
//   $arrStrVideoLectures = $this->db_model->select_data('*','video_lectures use index (id)',array('status'=>1),'','',$like,'','');

//   $arrStrVideos = [];
//   foreach ($arrStrVideoLectures as $arrStrVideoLecture){
//       $arrStrVideos[$arrStrVideoLecture['subject']][$arrStrVideoLecture['topic']][] = $arrStrVideoLecture;
//   }
  //  echo "<pre>".print_r($arrStrVideos, true)."</pre>";

//   $data['video_lectures'] = $arrStrVideos;

//   $join = array('subjects',"subjects.id = batch_subjects.batch_id"); 
$data['getsubjectchapter'] = $this->db_model->select_data('*','batch_subjects use index (id)',array('batch_id'=>$id),'','','','');

	$this->load->view('common/front_header',$data);
	$this->load->view('frontend/courses_details',$data);
	$this->load->view('common/front_footer',$data);
}
	 
	 function enroll_now($id=""){
		  $data['title'] =$this->lang->line('ltr_enroll_now'); 
		  if(isset($_SESSION['uid'])){
		      $cond = array('status'=>'1','id'=>$id);
		  }else{
		      $cond = array('status'=>'1','id'=>$id);
		  }
		  $data['currency_code'] =$this->general_settings('currency_code');
		  $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
		  $data['site_Details'] = $this->db_model->select_data('*','site_details',array('id'=>'1'),1);
		  $data['singel_batches'] = $this->db_model->select_data('*','batches use index (id)',$cond);
		   $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
		  $this->load->view('common/front_header',$data);
		  $this->load->view('frontend/enroll_now',$data);
		  $this->load->view('common/front_footer',$data);
	 }
	 
    function facilities(){
      $data['title'] = $this->lang->line('ltr_facilities');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['Allfacilities'] = $this->db_model->select_data('*','facilities use index (id)',array('status'=>'1'),6);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/facilities',$data);
      $this->load->view('common/front_footer',$data);
    }

    function contact(){
      $data['title'] = $this->lang->line('ltr_contact_us');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/contact',$data);
      $this->load->view('common/front_footer',$data);
    }

    function gallery(){
      $data['title'] = $this->lang->line('ltr_gallery');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/gallery',$data);
      $this->load->view('common/front_footer',$data);
    }

    function video_gallery(){
      $data['title'] =$this->lang->line('ltr_video_gallery'); 
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/video_gallery',$data);
      $this->load->view('common/front_footer',$data);
    }
    
    function privacypolicy(){
      $data['title'] = $this->lang->line('ltr_privacy_policy');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $data['policy'] = $this->db_model->select_data('*','privacy_policy_data',array('id'=>'1'),1);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/privacypolicy',$data);
      $this->load->view('common/front_footer',$data);
    }
     function privacyandpolicy(){
      $data['title'] = $this->lang->line('ltr_privacy_policy');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $data['policy'] = $this->db_model->select_data('*','privacy_policy_data',array('id'=>'1'),1);
      
      $this->load->view('frontend/privacyandpolicy',$data);
     
    }
    
    function termscondition(){
      $data['title'] = $this->lang->line('ltr_privacy_policy');
      $data['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
      $data['courses'] = $this->db_model->select_data('course_name','courses use index (id)',array('status'=>'1','admin_id'=>'1'),5);
      $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
      $data['terms'] = $this->db_model->select_data('*','term_condition_data',array('id'=>'1'),1);
      $this->load->view('common/front_header',$data);
      $this->load->view('frontend/termscondition',$data);
      $this->load->view('common/front_footer',$data);
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
	
	// payment methode
	function paypal_success(){ 
		
	  $header['title']=$this->lang->line('ltr_home_page');
	  
	  $this->load->view('common/front_header',$header);
      $this->load->view('frontend/success');
      $this->load->view('common/front_footer');
    } 
	
	function blog($id=""){ 
      $header['title']=$this->lang->line('ltr_blog');
	  $header['frontend_details'] = $this->db_model->select_data('*','frontend_details',array('id'=>'1'),1);
	  $this->load->view('common/front_header',$header);
	  if(empty($id)){
		  $data['gallery'] = $this->db_model->select_data('image, title','gallery use index (id)',array('status'=>'1','type'=>'Image'),9,array('id','desc'));
		  $data['blog']=$this->db_model->select_data('*','blog',array('status'=>1),5,array('id','desc'));
		  $data['recent_blog']=$this->db_model->select_data('*','blog',array('status'=>1),5,array('id','desc'));
		  $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
		  $this->load->view('frontend/blog',$data);
	  }else{
	      $data['blog']=$this->db_model->select_data('*','blog',array('status'=>1,'id'=>$id));
		  $data['recent_blog']=$this->db_model->select_data('*','blog',array('status'=>1),5,array('id','desc'));
          $data['id'] = $id;	
		  $data['comments'] = $this->db_model->select_data('*','blog_comments',array('blog_id'=>$id,'status'=>1));	
		  $data['facilities'] = $this->db_model->select_data('title','facilities use index (id)',array('status'=>'1'),5);
		   $data['gallery'] = $this->db_model->select_data('image, title','gallery use index (id)',array('status'=>'1','type'=>'Image'),9,array('id','desc'));
		  $this->load->view('frontend/singel_blog',$data);		  
	  }
      $this->load->view('common/front_footer');
    } 
	function convertCurrency(){
          $apikey = $this->general_settings('currency_converter_api');
        
          $from_Currency = urlencode($from_currency);
          $to_Currency = urlencode($to_currency);
          $query =  "{$from_Currency}_{$to_Currency}";
        
          // change to the free URL if you're using the free version
          $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
          $obj = json_decode($json, true);
        
          $val = floatval($obj["$query"]);
        
        
          $total = $val * $amount;
          return number_format($total, 2, '.', '');
        }
     function paypal_cancel(){ 
        // Load payment failed view 
        $this->load->view('paypal/cancel');
     } 
      
     function paypal_ipn(){ 
        // Retrieve transaction data from PayPal IPN POST 
        $paypalInfo = $this->input->post(); 
// 		print_r($paypalInfo);
// 		die();
        if(!empty($paypalInfo)){ 
            $admin_id =$this->db_model->select_data('id','users use index (id)',array('role'=>1),1)[0]['id'];
			$custom =explode(",",$paypalInfo['custom']);
			$name = $custom[0];
			$email = $custom[1];
			$mobile = $custom[2];
			$prevRecd = $this->db_model->select_data('id as studentId,email as userEmail,name as fullName,enrollment_id as enrollmentId,contact_no as mobile,app_version as versionCode, batch_id as batchId,admin_id as adminId,admission_date as admissionDate, image, token','students use index (id)',array('email'=>$email),1);
			
			if(empty($prevRecd)){
				$siteData = array();
				$siteData['word_for_enroll'] = $this->common->enrollWord;
				$data_arr['admin_id'] = $admin_id;            
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
				$data_arr['batch_id'] = $paypalInfo['item_number'];
				$data_arr['added_by'] = 'student';
				$data_arr['status'] = 1;
				$data_arr['enrollment_id'] = $enrolid;
				$data_arr['password'] = md5($password);
				$data_arr['admission_date'] = date('Y-m-d');
				$data_arr['image']='student_img.png';
				$data_arr['contact_no']= $mobile;
				//update app version and login status
				$data_arr['login_status']= 1;
				$data_arr['last_login_app']= date("Y-m-d H:i:s");
				
				$data_arr = $this->security->xss_clean($data_arr);
				$ins = $this->db_model->insert_data('students',$data_arr);
				if($ins){
					 //check batch type
					$batch_type =$this->db_model->select_data('*','batches use index (id)',array('id'=>$paypalInfo['item_number']),1);
					if($batch_type[0]['batch_type']==2){
						if(!empty($paypalInfo['mc_gross'])){
							
						   $amount = $paypalInfo['mc_gross'];
						}
						
						$data_pay=array(
								   'student_id'=>$ins,
								   'batch_id'=>$paypalInfo['item_number'],
								   'transaction_id'=> !empty($paypalInfo['txn_id'])?$paypalInfo['txn_id']:'',
									  'amount'=> !empty($amount)?$amount:'',
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
								 'batch_id'=>$paypalInfo['item_number'],
								 'added_by'=>'student'
										 );
				   $this->db_model->insert_data('sudent_batchs',$data_batch);
					// send email 
				   $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
					$subj = $title.'- '.$this->lang->line('ltr_credentials');
					$em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulation').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_enrolment_id').' : '.$enrolid.'<br/><br/>'.$this->lang->line('ltr_password').' : '.$password.'';

					@$this->SendMail($email, $subj, $em_msg);

					$session_arr['customerId']= !empty($ins)? trim($ins):'';
					$session_arr['customerPwd']= !empty($password)? trim($password):'';
					$session_arr['customerBatchId']= !empty($paypalInfo['item_number'])? trim($paypalInfo['item_number']):'';

					$this->session->set_userdata($session_arr);
					
					
				}
			}else{
				
				$siteData = array();
				$data_arr['login_status'] = 0;
				$last_id = $prevRecd[0]['studentId'] ;
				$enrolid = $prevRecd[0]['enrollmentId'];
				$password = $enrolid.$admin_id.$last_id.rand(1000,5000);
				
				$data_arr['name'] = $name;
				$data_arr['batch_id'] = $paypalInfo['item_number'];
				$data_arr['added_by'] = 'student';
				$data_arr['status'] = 1;
				$data_arr['password'] = md5($password);
				$data_arr['contact_no']= $mobile;
				//update app version and login status
				$data_arr['login_status']= 1;
				$data_arr['last_login_app']= date("Y-m-d H:i:s");
				
				$data_arr = $this->security->xss_clean($data_arr);
				$this->db_model->update_data_limit('students',$data_arr,array('id'=>$last_id));
		
				 //check batch type
				$batch_type =$this->db_model->select_data('*','batches use index (id)',array('id'=>$paypalInfo['item_number']),1);
				if($batch_type[0]['batch_type']==2){
					if(!empty($paypalInfo['payment_gross'])){
							
						   $amount = $paypalInfo['payment_gross'];
						}
					$data_pay=array(
							   'student_id'=>$last_id,
							   'batch_id'=>$paypalInfo['item_number'],
							   'transaction_id'=> !empty($paypalInfo['txn_id'])?$paypalInfo['txn_id']:'',
								  'amount'=> !empty($amount)?$amount:'',
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
								 'batch_id'=>$paypalInfo['item_number'],
								 'added_by'=>'student'
										 );
				$this->db_model->insert_data('sudent_batchs',$data_batch);
				// send email 
			   $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
				$subj = $title.'- '.$this->lang->line('ltr_credentials');
				$em_msg = $this->lang->line('ltr_hey').' '.ucwords($name).', '.$this->lang->line('ltr_congratulation').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_enrolment_id').' : '.$enrolid.'<br/><br/>'.$this->lang->line('ltr_password').' : '.$password.'';
				@$this->SendMail($email, $subj, $em_msg);
				
				$session_arr['customerId']= !empty($last_id)? trim($last_id):'';
				$session_arr['customerPwd']= !empty($password)? trim($password):'';
				$session_arr['customerBatchId']= !empty($paypalInfo['item_number'])? trim($paypalInfo['item_number']):'';
				$this->session->set_userdata($session_arr);
				
			}
        }
		return $paypalInfo;
    } 
	
	function paypal_form($batch_id=''){
		// Load paypal library 
        $this->load->library('paypal_lib'); 
		$batch_data = $this->db_model->select_data('*','batches',array('id'=>$batch_id));
		if($batch_data[0]['batch_type']==2){
			if(!empty($batch_data[0]['batch_offer_price'])){
				$amount = $batch_data[0]['batch_offer_price'];
			}else{
				$amount = $batch_data[0]['batch_price'];	
			}
		}
		$batc_name =$batch_data[0]['batch_name'];
		$custom_name= $_GET['name'].','.$_GET['email'].','.$_GET['mobile'];
        // Set variables for paypal form 
        $returnURL = base_url().'success'; //payment success url 
        $cancelURL = base_url().'enroll-now/'.$batch_id; //payment cancel url 
        $notifyURL = base_url().'paypal-ipn'; //ipn url 
        
         
        // Add fields to paypal form  
        $this->paypal_lib->add_field('return', $returnURL); 
        $this->paypal_lib->add_field('cancel_return', $cancelURL); 
        $this->paypal_lib->add_field('notify_url', $notifyURL); 
        $this->paypal_lib->add_field('item_name', $batc_name); 
        $this->paypal_lib->add_field('custom',$custom_name); 
        $this->paypal_lib->add_field('item_number',$batch_id); 
        $this->paypal_lib->add_field('amount',  $amount); 
        $this->paypal_lib->add_field('business',$this->general_settings('sandbox_accounts')); 
        $this->paypal_lib->add_field('rm','2');    // Return method = POST 
        $this->paypal_lib->add_field('cmd','_xclick'); 
        $this->paypal_lib->add_field('currency_code',$this->general_settings('currency_code') ); 
        $this->paypal_lib->add_field('quantity', '1'); 
       $this->paypal_lib->button('Pay Now!'); 
        // Render paypal form 
        $this->paypal_lib->paypal_auto_form(); 
    } 
    public function testMail(){
         $this->SendMail('sachin.mandloi@himanshusofttech.com','test','test');
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
           echo $this->email->print_debugger();
           echo "dsdas";
            return true;
        }
        


}