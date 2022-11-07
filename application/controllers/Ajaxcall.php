<?php
if(!defined("BASEPATH")) exit("No Direct Script Access Allowed");

class Ajaxcall extends CI_Controller{ 
	function __construct(){
        parent:: __construct();
        $timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));
        if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])){
            date_default_timezone_set($timezoneDB[0]['timezone']);
        }

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
    /********   Course Manage Start   ********/

    function general_settings($key_text=''){
        $data = $this->db_model->select_data('*','general_settings',array('key_text'=>$key_text),1);
        return $data[0]['velue_text'];
    }
    function course_table(){
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
                $like = array('course_name',$post['search']['value']);
            }else{
               $like = ''; 
            }
    
            $course_data = $this->db_model->select_data('*','courses use index (id)',array('admin_id'=>$this->session->userdata('uid')),$limit,array('id','desc'),$like);
    
            if(!empty($course_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($course_data as $course){
                   
                    if($course['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$course['id'].'" data-table ="courses" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$course['id'].'" data-table ="courses" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    $action = '<p class="actions_wrap"><a class="edit_course btn_edit" title="Edit" data-id="'.$course['id'].'" data-img="'.$course['image'].'"><i class="fa fa-edit""></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$course['id'].'" data-table="courses"><i class="fa fa-trash"></i></a></p>';
                    
                    $descriptionWord =$this->readMoreWord($course['description'], $this->lang->line('ltr_description'));
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$course['id'].'">',
                                $count,
                                '<img src="'.base_url('uploads/courses/'.$course['image']).'" alt="course" class="view_large_image">',
                                $course['course_name'],
                                date('d-m-Y',strtotime($course['start_date'])),
                                date('d-m-Y',strtotime($course['end_date'])),
                                $course['course_duration'],
                                $course['class_size'],
                                $course['time_duration'],
                                '<p class="descParaCls">'.$descriptionWord.'</p>',
                                $statusDrop,
                                $action   
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('courses use index (id)',array('admin_id'=>$this->session->userdata('uid')),'','',$like);
    
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

	function blog_table(){
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
                $like = array('blog_title',$post['search']['value']);
            }else{
               $like = ''; 
            }
            $blog_data = $this->db_model->select_data('*','blog',array('admin_id'=>$this->session->userdata('uid')),$limit,array('id','desc'),$like);
    
            if(!empty($blog_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($blog_data as $blog){
                   
                    if($blog['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$blog['id'].'" data-table ="courses" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$blog['id'].'" data-table ="courses" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    $action = '<p class="actions_wrap"><a class="edit_blog btn_edit" title="Edit" data-id="'.$blog['id'].'" data-img="'.$blog['image'].'" data-des="'.html_escape($blog['description']).'"><i class="fa fa-edit""></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$blog['id'].'" data-table="courses"><i class="fa fa-trash"></i></a>
                    <a class="btn_edit" href="'.base_url('admin/blog-reply/'.$blog['id']).'"><i class="fa fa-reply""></i></a>
                    </p>';
                    
                    $descriptionWord =$this->readMoreWord($blog['description'], $this->lang->line('ltr_description'));
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$blog['id'].'">',
                                $count,
                                '<img src="'.base_url('uploads/blog/'.$blog['image']).'" alt="course" class="view_large_image">',
                                $blog['title'],
                                // '<p class="descParaCls">'.$descriptionWord.'</p>',
								date('d-m-Y',strtotime($blog['create_at'])),
                                $statusDrop,
                                $action   
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('blog',array('admin_id'=>$this->session->userdata('uid')),'','',$like);
    
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
	function addBlog(){  
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('blog_title',TRUE))){
                $data_arr = array();
    
                $config['upload_path'] ='./uploads/blog/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size']    = '0';		
                $this->load->library('upload', $config);
                
                $admin_id = $this->session->userdata('uid');
                if($this->input->post('type',TRUE) == 'edit'){
                    $st_id = $this->input->post('id',TRUE);
                    $prevRecd = $this->db_model->select_data('*','blog',array('admin_id'=>$admin_id,'id !='=>$st_id,'title'=>$this->input->post('blog_title',TRUE)),1);
    
                    //pic upload
                    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                        if ($this->upload->do_upload('image')){
                            $uploaddata = $this->upload->data();
                            $pic = $uploaddata['raw_name'];
                            $pic_ext = $uploaddata['file_ext'];
                            $image_name = $pic.'_'.date('ymdHis').$pic_ext;
                            rename('./uploads/blog/'.$pic.$pic_ext,'./uploads/blog/'.$image_name);
                            $data_arr['image'] = $image_name;
                        }else{
                            $resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
                            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                            die();
                        }
                    }
					$data_arr['title'] = trim($this->input->post('blog_title',TRUE));
					$data_arr['description'] = $this->input->post('description');
					
                    $ins = $this->db_model->update_data_limit('blog',$data_arr,array('id'=>$st_id,'admin_id'=>$admin_id),1);
                    
                        $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_updated_msg'));
                    
                }else{
                    $prevRecd = $this->db_model->select_data('*','blog',array('admin_id'=>$admin_id,'title'=>$this->input->post('blog_title',TRUE)),1);
                    if(empty($prevRecd)){
                        $data_arr['title'] = trim($this->input->post('blog_title',TRUE));
                        $data_arr['description'] = $this->input->post('description');
                        $data_arr['status'] = 1;
						$data_arr['admin_id'] = $admin_id;
    
                        //pic upload
                        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                            if ($this->upload->do_upload('image')){
                                $uploaddata = $this->upload->data();
                                $pic = $uploaddata['raw_name'];
                                $pic_ext = $uploaddata['file_ext'];
                                $image_name = $pic.'_'.date('ymdHis').$pic_ext;
                                rename('./uploads/blog/'.$pic.$pic_ext,'./uploads/blog/'.$image_name);
                                $data_arr['image'] = $image_name;
                            }else{
                                $resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
                                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                                die();
                            }
                        }else{
							$data_arr['image']='student_img.png';
                        }
                        //$data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->insert_data('blog',$data_arr);
                        
						$resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_added_msg'));
                        
                    }else{
                        $resp = array('status'=>'0', 'msg' => $this->lang->line('ltr_something_msg')); 
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }  
    }
    function addcourse(){
       
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('course_name',TRUE))){
             
                $diff = abs(strtotime($this->input->post('end_date',TRUE))-strtotime($this->input->post('start_date',TRUE)));
                $years = floor($diff / (365*60*60*24));  
                $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24)); 
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($months > 0 and $months <= 1)
                    $mnth = $months.' month';
                else if($months > 1) 
                    $mnth = $months.' months';
                else 
                    $mnth = '';
    
                if($days > 0 and $days <= 1)
                    $dys = ' '.$days.' day';
                else if($days > 1) 
                    $dys = ' '.$days.' days';
                else 
                    $dys = '';
                
                $prevdata =  $this->db_model->select_data('id','courses use index (id)',array('course_name'=>$this->input->post('course_name',TRUE)),1);
                
                if($this->input->post('type',TRUE) == 'edit'){
                    if(empty($prevdata) || ($prevdata[0]['id'] == $this->input->post('course_id',TRUE))){
                        $data_arr = array(
                            'course_name'	=>	$this->input->post('course_name',TRUE),
                            'start_date'	=>	date('Y-m-d',strtotime($this->input->post('start_date',TRUE))),
                            'end_date'	=>	date('Y-m-d',strtotime($this->input->post('end_date',TRUE))),
                            'class_size'	=>	$this->input->post('class_size',TRUE),
                            'time_duration'	=>	$this->input->post('time_duration',TRUE),
                            'description'	=>	$this->input->post('description',TRUE)
                        ); 
                       
                        $data_arr['course_duration'] = trim($mnth.$dys);
                        
                        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                            $image = $this->upload_media($_FILES,'uploads/courses/','image');
                            if(is_array($image)){
                                $resp = array('status'=>'2', 'msg' => $image['msg']);
                                die();
                            }else{
                                $data_arr['image'] = $image;
                            }
                        }
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->update_data_limit('courses',$data_arr,array('id'=>$this->input->post('course_id',TRUE)),1);
                        if($ins==true){
                            $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_course_updated_msg'));
                        }else{
                            $resp = array('status'=>'0');
                        }
                    }else{
                         $resp = array('status'=>'2', 'msg' => $this->lang->line('ltr_course_name_already_msg'));
                    }
                }else{
                    if(empty($prevdata)){
                        $data_arr = array(
                            'course_name'	=>	$this->input->post('course_name',TRUE),
                            'status'	=>	1,
                            'start_date'	=>	date('Y-m-d',strtotime($this->input->post('start_date',TRUE))),
                            'end_date'	=>	date('Y-m-d',strtotime($this->input->post('end_date',TRUE))),
                            'admin_id' => $this->session->userdata('uid'), 
                            'class_size'	=>	$this->input->post('class_size',TRUE),
                            'time_duration'	=>	$this->input->post('time_duration',TRUE),
                            'description'	=>	$this->input->post('description',TRUE)
                        ); 
        
                        $data_arr['course_duration'] = trim($mnth.$dys);
                        
                        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                            $image = $this->upload_media($_FILES,'uploads/courses/','image');
                            if(is_array($image)){
                                $resp = array('status'=>'2', 'msg' => $image['msg']);
                                die();
                            }else{
                                $data_arr['image'] = $image;
                            }
                        }
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->insert_data('courses',$data_arr);
                        if($ins==true){
                            $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_course_add_msg'));
                        }else{
                            $resp = array('status'=>'0');
                        }
                    }else{
                         $resp = array('status'=>'2', 'msg' => $this->lang->line('ltr_course_name_already_msg'));
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function upload_media($files,$path,$file){   
        $config['upload_path'] =$path;
        $config['allowed_types'] = 'jpeg|jpg|png|SVG|svg|avi|mpeg|mp3|mp4|3gp';
        $config['max_size']    = '2048000';
        $filename = '';		
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file)){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            return $filename;
        }else{
            $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
            return $resp;
        }     
    }

    /********   Course Manage End   ********/

    /********   Batch Manage Start   ********/

    function batch_table(){
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
                $like = array('batch_name',$post['search']['value']);
            }else{
               $like = ''; 
            }
    
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                    $cond = array('admin_id'=>$this->session->userdata('uid'));
                  $or_like = "";
                //   $cond = '';
              }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                //   $cond = '';
                //   $or_like = array(array('batches.admin_id',1));
                  $cond = array('admin_id'=>$this->session->userdata('uid'));
              }else if($this->session->userdata('role') == 3){
                //   $cond = '';
                  $or_like = "";
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'));
              }else if($this->session->userdata('role') == 'student'){
                  $or_like = "";
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
              }
            // $batch_data = $this->db_model->select_data('*','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),$limit,array('id','desc'),$like);
             
            $batch_data = $this->db_model->select_data('*','batches use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            if(!empty($batch_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($batch_data as $batch){
                   $s_count = $this->db_model->countAll('sudent_batchs',array('batch_id'=>$batch['id']));
                    if($batch['batch_type']==2){
                            $price =$batch['batch_price'].' '.$this->general_settings('currency_decimal_code');
                        if(!empty($batch['batch_offer_price'])){
                            $price ='<s>'.$batch['batch_price'].' '.$this->general_settings('currency_decimal_code').'</s>'.' / '.$batch['batch_offer_price'].' '.$this->general_settings('currency_decimal_code');
                        }
                    }else{
                        $price =$this->lang->line('ltr_free');
                    }
                    // if($batch['status'] == 1){
                    //     $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$batch['id'].'" data-table ="batches" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    // }else{
                    //     $statusDrop = '<div class="admin_tbl_status_wrap">
                    // <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$batch['id'].'" data-table ="batches" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    // }
                    if($_SESSION['admin_id']!=$batch['admin_id']){
                         if($batch['status'] == 1){
                                $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$batch['id'].'" data-table ="batches" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                            }else{
                                $statusDrop = '<div class="admin_tbl_status_wrap">
                            <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$batch['id'].'" data-table ="batches" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                            }
                    }else{
                       if($batch['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor"><a class="tbl_status_btn light_sky_bg" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                        }else{
                            $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor">
                        <a class="tbl_status_btn light_red_bg " data-id="'.$vid['id'].'" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                        }
                    }
                    // $action = '<p class="actions_wrap"><a class="btn_edit" data-catId="'.$batch['cat_id'].'" data-sub-catId="'.$batch['sub_cat_id'].'" title="Edit" href="'.base_url('admin/add-batch/').$batch['id'].'"><i class="fa fa-edit"></i></a>
                    //     <a class="deleteData btn_delete" title="Delete" data-id="'.$batch['id'].'" data-table="batches"><i class="fa fa-trash"></i></a></p>';
                    // print_r($statusDrop);
                    // die();
                    if($_SESSION['admin_id']!=$batch['admin_id']){
                         $action = '<p class="actions_wrap"><a class="btn_edit" data-catId="'.$batch['cat_id'].'" data-sub-catId="'.$batch['sub_cat_id'].'" title="Edit" href="'.base_url('admin/add-batch/').$batch['id'].'"><i class="fa fa-edit"></i></a>
                                        <a class="deleteData btn_delete" title="Delete" data-id="'.$batch['id'].'" data-table="batches"><i class="fa fa-trash"></i></a></p>';
                        // if($batch['admin_id']!=$_SESSION['uid']){
                        //     //  $action = '<p class="actions_wrap"><a class="btn_edit" data-catId="'.$batch['cat_id'].'" data-sub-catId="'.$batch['sub_cat_id'].'" title="Edit" href="'.base_url('admin/add-batch/').$batch['id'].'"><i class="fa fa-edit"></i></a>
                        //     //             <a class="deleteData btn_delete" title="Delete" data-id="'.$batch['id'].'" data-table="batches"><i class="fa fa-trash"></i></a></p>';
                        // }else{
                        //     $action = '<p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                        //               <a class=" btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
                        // }
                    }else{
                       $action = '<p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                                  <a class=" btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
                    }
                   $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$batch['admin_id']),1);
                    // print_r($name);
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                     if($batch['pay_mode']!='offline' &&  $batch['pay_mode']!='Online'){
                        $pay_mode = "";
                     }else{
                         $pay_mode =$batch['pay_mode'];
                     }
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$batch['id'].'">',
                                $count,
                                $batch['batch_name'],
                                date('d-m-Y',strtotime($batch['start_date'])),
                                date('d-m-Y',strtotime($batch['end_date'])),
                                date('h:i A',strtotime($batch['start_time'])).' - '. date('h:i A',strtotime($batch['end_time'])),
                                // $price,
                                // $pay_mode,
                                $s_count,
                                $statusDrop,
                                $action,
                                $added_by
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('batches use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    
    function addbatch(){
    
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('batch_name',TRUE))){
                $prevdata =  $this->db_model->select_data('id','batches use index (id)',array('batch_name'=>$this->input->post('batch_name',TRUE)),1);
                if($this->input->post('type',TRUE) == 'edit'){
                    if(empty($prevdata) || ($prevdata[0]['id'] == $this->input->post('batch_id',TRUE))){
                        $data_arr = array(
                            'batch_name'	=>	$this->input->post('batch_name',TRUE),
                            'start_date'	=>	date('Y-m-d',strtotime($this->input->post('start_date',TRUE))),
                            'end_date'	=>	date('Y-m-d',strtotime($this->input->post('end_date',TRUE))),
                            'start_time'	=>	date('H:i:s',strtotime($this->input->post('start_time',TRUE))),
                            'end_time'	=>	date('H:i:s',strtotime($this->input->post('end_time',TRUE))),
                        ); 
                        //  print_r($_POST['batch_subject']);
                        // die();
						if(!empty($this->input->post('batchType',TRUE))){
							$data_arr['batch_type']=$this->input->post('batchType',TRUE);
						}
						
						if(!empty($this->input->post('batchPrice',TRUE))){
							$data_arr['batch_price']=$this->input->post('batchPrice',TRUE);
						}
						
						if(!empty($this->input->post('batchOfferPrice',TRUE))){
							$data_arr['batch_offer_price']=$this->input->post('batchOfferPrice',TRUE);
						}
                        if(!empty($this->input->post('batch_description',TRUE))){
							$data_arr['description']=$this->input->post('batch_description',TRUE);
						}
						if(!empty($this->input->post('category',TRUE))){
							$data_arr['cat_id']=$this->input->post('category',TRUE);
						}
						if(!empty($this->input->post('subcategory',TRUE))){
							$data_arr['sub_cat_id']=$this->input->post('subcategory',TRUE);
						}
						$data_arr['pay_mode']=$_POST['payMode'];
						
						 //batch image upload
						if(isset($_FILES['batch_image']) && !empty($_FILES['batch_image']['name'])){
							$config['upload_path'] ='./uploads/batch_image/';
							$config['allowed_types'] = 'jpeg|jpg|png';
							$config['max_size']    = '0';		
							$this->load->library('upload', $config); 
							if ($this->upload->do_upload('batch_image')){
								$uploaddata = $this->upload->data();
								$pic = $uploaddata['raw_name'];
								$pic_ext = $uploaddata['file_ext'];
								$image_name = $pic.'_'.date('ymdHis').$pic_ext;
								rename('./uploads/batch_image/'.$pic.$pic_ext,'./uploads/batch_image/'.$image_name);
								$data_arr['batch_image'] = $image_name;
							}else{
								$resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
								echo json_encode($resp,JSON_UNESCAPED_SLASHES);
								die();
							}
						}
                       
		
                        $data_arr = $this->security->xss_clean($data_arr);
                //       	 print_r($data_arr);
                //  die();
                        $ins = $this->db_model->update_data_limit('batches',$data_arr,array('id'=>$this->input->post('batch_id',TRUE)),1);

                        if($ins==true){

                            $batch_id = $this->input->post('batch_id');
                            $this->db_model->delete_data('batch_subjects',array('batch_id'=>$batch_id));
                            $data = $this->input->post();
                            
                            for($i=0; $i < count($data['batch_subject']); $i++){      
                                $teacher_id = $data['batch_teacher'][$i];                        
                                $subjectData = array(
                                    'batch_id'	=> $batch_id,
                                    'teacher_id' => $teacher_id,
                                    'subject_id' => $data['batch_subject'][$i],
                                    'chapter' => json_encode(json_decode($data['batch_chapter'],true)[$i]),
                                    'sub_start_date' => date('Y-m-d',strtotime($data['sub_start_date'][$i])),
                                    'sub_end_date'	=> date('Y-m-d',strtotime($data['sub_end_date'][$i])),
                                    'sub_start_time'	=> date('H:i:s',strtotime($data['sub_start_time'][$i])),
                                    'sub_end_time'	=> date('H:i:s',strtotime($data['sub_end_time'][$i])),
                                ); 
                               
                                $this->db_model->insert_data('batch_subjects',$subjectData);

                                $teacherData = $this->db_model->select_data('id,teach_batch','users use index (id)',array('id'=>$teacher_id),1);
                               
                                if(!empty($teacherData)){
                                    if(!empty($teacherData[0]['teach_batch'])){
                                        $newBatch = array_unique(array_merge(explode(',',$teacherData[0]['teach_batch']), array($batch_id)));
                                    }else{
                                        $newBatch = array($batch_id);
                                    }
                                   
                                    $result = $this->db_model->update_data_limit('users',array('teach_batch'=>implode(',',$newBatch)),array('id'=>$teacherData[0]['id']),1);
                                   
                                }
                            }
							
							// batch fecherd add
							if(!empty($data['batch_speci_heading'])){
								for($i=0; $i < count($data['batch_speci_heading']); $i++){     
									$speci_heading = array(
										'batch_id'	=> $batch_id,
										'batch_specification_heading' => $data['batch_speci_heading'][$i],
										'batch_fecherd' => json_encode(json_decode($data['batch_sub_fecherd'],true)[$i]),
									); 
                                   if(!empty($data['batch_speci_id'][$i])){
                                       $this->db_model->update_data_limit('batch_fecherd',$speci_heading,array('id'=>$data['batch_speci_id'][$i]));
                                   }else{
									$this->db_model->insert_data('batch_fecherd',$speci_heading);
							        }
								}
                            }
							
                            $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_batch_updated_msg'),'url' => base_url('admin/batch-manage'));
                        }else{
                            $resp = array('status'=>'0');
                        }
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->lang->line('ltr_batch_name_already_msg'));
                    }
                }else{
                    if(empty($prevdata)){
                        $data_arr = array(
                            'batch_name'	=>	$this->input->post('batch_name',TRUE),
                            'start_date'	=>	date('Y-m-d',strtotime($this->input->post('start_date',TRUE))),
                            'end_date'	=>	date('Y-m-d',strtotime($this->input->post('end_date',TRUE))),
                            'start_time'	=>	date('H:i:s',strtotime($this->input->post('start_time',TRUE))),
                            'end_time'	=>	date('H:i:s',strtotime($this->input->post('end_time',TRUE))),
                            'status'	=>	1,
                            'admin_id' => $this->session->userdata('uid')
                        );
						if(!empty($this->input->post('batchType',TRUE))){
							$data_arr['batch_type']=$this->input->post('batchType',TRUE);
						}
						
						if(!empty($this->input->post('batchPrice',TRUE))){
							$data_arr['batch_price']=$this->input->post('batchPrice',TRUE);
						}
						
						if(!empty($this->input->post('batchOfferPrice',TRUE))){
							$data_arr['batch_offer_price']=$this->input->post('batchOfferPrice',TRUE);
						}
						
						if(!empty($this->input->post('batch_description',TRUE))){
							$data_arr['description']=$this->input->post('batch_description',TRUE);
						}
						if(!empty($this->input->post('category',TRUE))){
							$data_arr['cat_id']=$this->input->post('category',TRUE);
						}
						if(!empty($this->input->post('subcategory',TRUE))){
							$data_arr['sub_cat_id']=$this->input->post('subcategory',TRUE);
						}
					
						 //batch image upload
						if(isset($_FILES['batch_image']) && !empty($_FILES['batch_image']['name'])){
							$config['upload_path'] ='./uploads/batch_image/';
							$config['allowed_types'] = 'jpeg|jpg|png';
							$config['max_size']    = '0';		
							$this->load->library('upload', $config); 
							if ($this->upload->do_upload('batch_image')){
								$uploaddata = $this->upload->data();
								$pic = $uploaddata['raw_name'];
								$pic_ext = $uploaddata['file_ext'];
								$image_name = $pic.'_'.date('ymdHis').$pic_ext;
								rename('./uploads/batch_image/'.$pic.$pic_ext,'./uploads/batch_image/'.$image_name);
								$data_arr['batch_image'] = $image_name;
							}else{
								$resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
								echo json_encode($resp,JSON_UNESCAPED_SLASHES);
								die();
							}
						}
						$data_arr['pay_mode']=$_POST['payMode'];
    
                        $data_arr = $this->security->xss_clean($data_arr);
  				 
                        $ins = $this->db_model->insert_data('batches',$data_arr);
                       
                        if($ins){
                            $batch_id = $this->db->insert_id();
                            $data = $this->input->post();
                            for($i=0; $i < count($data['batch_subject']); $i++){      
                                $teacher_id = $data['batch_teacher'][$i];
                                $teacherData = $this->db_model->select_data('id,teach_batch','users use index (id)',array('id'=>$teacher_id),1);
                               
                                if(!empty($teacherData)){
                                    if(!empty($teacherData[0]['teach_batch'])){
                                        $newBatch = array_unique(array_merge(explode(',',$teacherData[0]['teach_batch']), array($batch_id)));
                                    }else{
                                        $newBatch = array($batch_id);
                                    }
                                   
                                    $this->db_model->update_data_limit('users',array('teach_batch'=>implode(',',$newBatch)),array('id'=>$teacherData[0]['id']),1);
                                }

                                $subjectData = array(
                                    'batch_id'	=> $batch_id,
                                    'teacher_id' => $teacher_id,
                                    'subject_id' => $data['batch_subject'][$i],
                                    'chapter' => json_encode(json_decode($data['batch_chapter'],true)[$i]),
                                    'sub_start_date' => date('Y-m-d',strtotime($data['sub_start_date'][$i])),
                                    'sub_end_date'	=> date('Y-m-d',strtotime($data['sub_end_date'][$i])),
                                    'sub_start_time'	=> date('H:i:s',strtotime($data['sub_start_time'][$i])),
                                    'sub_end_time'	=> date('H:i:s',strtotime($data['sub_end_time'][$i])),
                                ); 

                                $this->db_model->insert_data('batch_subjects',$subjectData);
                            }
							// batch fecherd add
							if(!empty($data['batch_speci_heading'])){
								for($i=0; $i < count($data['batch_speci_heading']); $i++){     
									$speci_heading = array(
										'batch_id'	=> $batch_id,
										'batch_specification_heading' => $data['batch_speci_heading'][$i],
										'batch_fecherd' => json_encode(json_decode($data['batch_sub_fecherd'],true)[$i]),
									); 

									$this->db_model->insert_data('batch_fecherd',$speci_heading);
								}
                            }
                            $resp = array('status'=>'1', 'msg' => 'Batch added successfully.','url' => base_url('admin/batch-manage'));
                        }else{
                            $resp = array('status'=>'0');
                        }
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->lang->line('ltr_batch_name_already_msg'));
                    }
                }
                
            } 
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);  
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }  
    }

    function batchdetails_table($uid){
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
                $join = array('subjects',"subjects.subject_name like '%".$post['search']['value']."%' AND subjects.id = batch_subjects.subject_id");
            }else{
                $join = ''; 
            }
            
            $role = $this->session->userdata('uid');
            $cond = array('batch_subjects.teacher_id'=>$uid);
             
            if(isset($get['batch']) || isset($get['subject'])){
                if($get['batch']!='' && $get['subject']!=''){ 
                    $cond['batch_subjects.subject_id'] = $get['subject'];
                    $cond['batch_subjects.batch_id'] = $get['batch'];
                }else if($get['batch']!=''){
                    $cond['batch_subjects.batch_id'] = $get['batch'];
                }else if($get['subject']!=''){
                    $cond['batch_subjects.subject_id'] = $get['subject'];
                }
            }
            
            
            $batchSubjects = $this->db_model->select_data('batch_subjects.*','batch_subjects use index (id)',$cond,$limit,array('id','desc'),'',$join,'');
     
            if(!empty($batchSubjects)){
                foreach($batchSubjects as $sub){
                    $completedchaptr = json_decode($sub['chapter_status'],true);
                    if(!empty($completedchaptr)){
                        $dataIndx = implode(',',$completedchaptr);
                    }else{
                        $dataIndx = '';
                    }
    
                    $batchdata = $this->db_model->select_data('batch_name,start_time,end_time,status','batches use index (id)',array('id'=>$sub['batch_id']));
                    
                    $subject_name = $this->db_model->select_data('subject_name','subjects use index (id)',array('id'=>$sub['subject_id']));
                    $chapter_ids = implode(',',json_decode($sub['chapter']));
                    $chapterdata = $this->db_model->select_data('id,chapter_name','chapters use index (id)',"id in ($chapter_ids)");
                    
                    $chapters = '';
                    
                    if(!empty($batchdata)){
                        if(!empty($chapterdata)){
                            $i = 0;
                            $completedDate = json_decode($sub['chapter_complt_date'],true);
                            foreach($chapterdata as $chapter){
                                $style = '';
                                $title = '';
                                if(!empty($completedchaptr) && in_array($chapter['id'],$completedchaptr)){
                                    $style = 'style="background-color:#73d872;"';
                                }
                                
                                if(!empty($completedDate) && array_key_exists($chapter['id'],$completedDate)){
                                    
                                    $title = 'Completed on '.$completedDate[$chapter['id']];
                                }
                                
                                $chapters .= '<p class="chapter_wrap" data-id="'.$sub['id'].'" '.$style.' data-chapter="'.$chapter['id'].'" title="'.$title.'"><span>'.$chapter['chapter_name'].'</span></p>';
                                $i++;
                            }
                        }
                       
                            
                            if($batchdata[0]['status']==1){
                                 $batchon = 2;
                            }else{
                                $batchon = 1;
                            }
                            if($role != 1){
                                $action = '<p class="actions_wrap"><a href="javascript:;" data-tcsid="'.$sub['subject_id'].'" data-tcbid="'.$sub['batch_id'].'" class="btn_view tc_progress_popup" title="View progress"><i class="fa fa-eye"></i></a>
                                    <a class="edit_batchDetails btn_edit" data-id="'.$sub['id'].'" data-index="'.$dataIndx.'" data-batchon="'.$batchon.'"><i class="fa fa-edit" title="Edit"></i></a></p>';
                            }else{              
                                $action = '<p class="actions_wrap"><a href="javascript:;" data-tcsid="'.$sub['subject_id'].'" data-tcbid="'.$sub['batch_id'].'" class="btn_view tc_progress_popup" title="View progress"><i class="fa fa-eye"></i></a></p>';
                            }
                            $complt_date="";
                            if($sub['total_chapter_complt_date'] !='0000-00-00 00:00:00'){
                                $complt_date =date('d-m-Y h:i A',strtotime($sub['total_chapter_complt_date']));
                            }
                            $dataarray[] = array(
                                        $count,
                                        $batchdata[0]['batch_name'],
                                        date('h:i A',strtotime($batchdata[0]['start_time'])).' - '.date('h:i A',strtotime($batchdata[0]['end_time'])),
                                        date('d-m-Y',strtotime($sub['sub_start_date'])).' - '.date('d-m-Y',strtotime($sub['sub_end_date'])),
                                        date('h:i A',strtotime($sub['sub_start_time'])).' - '.date('h:i A',strtotime($sub['sub_end_time'])),
                                        $complt_date,
                                        ($subject_name)? $subject_name[0]['subject_name'] : '',
                                        $chapters,
                                        $action
                                    ); 
                       
                        $count++;
                    }
                      
                }
                 
                $recordsTotal = $this->db_model->countAll('batch_subjects use index (id)',$cond,'','','',$join,'');
                     
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

    function change_chapter_staus(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id'))){
                $prevData = $this->db_model->select_data('chapter_status,chapter_complt_date, chapter','batch_subjects use index (id)',array('id'=>$this->input->post('id')));
                if(!empty($prevData[0]['chapter_status'])){
                    $prevStatus = json_decode($prevData[0]['chapter_status'],true);
                    $newstatus = array_unique(array_merge($prevStatus,array($this->input->post('chapter'))));
                    
                    $prevCmplt = json_decode($prevData[0]['chapter_complt_date'],true);
                   
                    $newcmplt = $prevCmplt + array($this->input->post('chapter') => date('d-m-Y'));
                    $data = array('chapter_status'=>json_encode($newstatus),'chapter_complt_date'=>json_encode($newcmplt));
                }else{
                    $data = array('chapter_status'=>json_encode(array($this->input->post('chapter'))),'chapter_complt_date'=>json_encode(array($this->input->post('chapter') => date('d-m-Y'))));
                }
            
               if((count(json_decode($data['chapter_status'])))==(count(json_decode($prevData[0]['chapter'])))){
                   $data['total_chapter_complt_date']= date('Y-m-d H:i:s');
                   $ins = $this->db_model->update_data_limit('batch_subjects',$this->security->xss_clean($data),array('id'=>$this->input->post('id')));
               }else{
                $ins = $this->db_model->update_data_limit('batch_subjects',$this->security->xss_clean($data),array('id'=>$this->input->post('id')));
               }
                if($ins){
                    $resp = array('status'=>1);
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        } 
    }

    function get_progress(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('teacher_id'))){

                if(!empty($this->input->post('batch')) && !empty($this->input->post('subject'))){
                    $cond = array('batch_id'=>$this->input->post('batch'),'subject_id'=>$this->input->post('subject'),'teacher_id'=>$this->input->post('teacher_id'));
                }else if(!empty($this->input->post('batch'))){
                    $cond = array('batch_id'=>$this->input->post('batch'),'teacher_id'=>$this->input->post('teacher_id'));
                }else if(!empty($this->input->post('subject'))){
                    $cond = array('subject_id'=>$this->input->post('subject'),'teacher_id'=>$this->input->post('teacher_id'));
                }else{
                    $cond = array('teacher_id'=>$this->input->post('teacher_id'));
                }
               
                $chapter_data = $this->db_model->select_data('chapter,chapter_status','batch_subjects use index (id)',$cond);
               
                if(!empty($chapter_data)){
                    $pendingCount = 0;
                    $completeCount = 0;
                    $totalCount = 0;
                    foreach($chapter_data as $chapter){
                        $total = count(json_decode($chapter['chapter'],true));
                        if(!empty($chapter['chapter_status'])){
                            $complete = count(json_decode($chapter['chapter_status'],true));
                        }else{
                            $complete = 0;
                        }
                        
                        if($complete < $total){
                            $pending = ($total - $complete);
                        }else{
                            $pending = 0;
                        }
                        $pendingCount += $pending;
                        $completeCount += $complete;
                        $totalCount += $total;
                    }

                    $completeChapter = ($completeCount/$totalCount)*100;
                    $pendingChapter = ($pendingCount/$totalCount)*100;
                    $resp = array('status'=>1,'complete'=>$completeChapter,'pending'=>$pendingChapter);
                   
                }else{
                    $resp = array('status'=>0,'msg'=> $this->lang->line('ltr_no_data_msg'),'complete'=>0,'pending'=>100);
                }
                
            }else{
                $resp = array('status'=>0,'msg'=>$this->lang->line('ltr_something_msg'));
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        } 
    }

    /********   Batch Manage End   ********/

     /********   Student Manage Start   ********/
// function student_table(){
//         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
//             $post = $this->input->post(NULL,TRUE);
//             $get = $this->input->get(NULL,TRUE);
//             $super = $this->session->userdata('super_admin');
//             if(isset($post['length']) && $post['length']>0){
//                 if(isset($post['start']) && !empty($post['start'])){
//                     $limit = array($post['length'],$post['start']);
//                     $count = $post['start']+1;
//                 }else{ 
//                     $limit = array($post['length'],0);
//                     $count = 1;
//                 }
//             }else{
//                 $limit = '';
//                 $count = 1;
//             }
        
//             if($post['search']['value'] != ''){
//                 $like = array('name',$post['search']['value']);
//                 $or_like = '';
//             }else{
//               $like = ''; 
//               $or_like = ''; 
//             }
//             if(isset($get['admin'])){
//                 if($get['admin']!=''){   
//                     $like = array('admin_id',$get['admin']); 
//                 }
//             }
          
      
//             if(isset($get['user_status']) || isset($get['lgStatus']) || isset($get['user_batch'])){
//                 if($get['user_status']!='' && $get['lgStatus']!='' && $get['user_batch']!=''){
//                     if($this->session->userdata('role')==1){
//                         $cond['status'] = $get['user_status'];   
//                         $cond['login_status'] = $get['lgStatus'];   
//                         $cond_in['batch_id'] = $get['user_batch'];
//                     }else{
//                         $cond .= ' AND status='.$get['user_status'];
//                         $cond .= ' AND login_status='.$get['lgStatus'];
//                         $cond .= ' AND batch_id='.$get['user_batch'];
//                     }
                      
//                 }else if($get['user_status']!='' && $get['lgStatus']!=''){
//                     if($this->session->userdata('role')==1){
//                         $cond['status'] = $get['user_status'];   
//                         $cond['login_status'] = $get['lgStatus'];
//                     }else{
//                         $cond .= ' AND status='.$get['user_status'];
//                         $cond .= ' AND login_status='.$get['lgStatus'];
//                     }
//                 }else if($get['user_status']!='' && $get['user_batch']!=''){
//                     if($this->session->userdata('role')==1){
//                         $cond['status'] = $get['user_status'];   
//                         $cond_in['batch_id'] = $get['user_batch'];
//                     }else{
//                         $cond .= ' AND status='.$get['user_status'];
//                         $cond .= ' AND batch_id='.$get['user_batch'];
//                     }
//                 }else if($get['lgStatus']!='' && $get['user_batch']!=''){
//                     if($this->session->userdata('role')==1){
//                         $cond['login_status'] = $get['lgStatus'];  
//                         $cond_in['batch_id'] = $get['user_batch'];
//                     }else{
//                         $cond .= ' AND login_status='.$get['lgStatus'];
//                         $cond .= ' AND batch_id='.$get['user_batch'];
//                     }
//                 }else if($get['user_status']!='' ){
//                     if($this->session->userdata('role')==1){
//                         $cond['status'] = $get['user_status'];  
//                     }else{
//                         $cond .= ' AND status='.$get['user_status'];
//                     }
//                 }else if($get['lgStatus']!=''){
//                     if($this->session->userdata('role')==1){
//                         $cond['login_status'] = $get['lgStatus'];  
//                     }else{
//                         $cond .= ' AND login_status='.$get['lgStatus'];
//                     }
//                 }else if($get['user_batch']!=''){
//                     if($this->session->userdata('role')==1){
//                         $cond_in['batch_id'] = $get['user_batch'];  
//                     }else{
//                         $cond .= ' AND batch_id='.$get['user_batch'];
//                     }
//                 }
//             }
//             if(!empty($cond_in['batch_id'])){
//                 $where_in=array('batch_id',$cond_in['batch_id']);
//             }else{
//                 $where_in="";
//             }
//             $student_batch = $this->db_model->select_data('sudent_batchs.admin_id','sudent_batchs',array('sudent_batchs.admin_id'=>$this->session->userdata('uid')),'',array('sudent_batchs.id','desc'),'','','','','');
//             $student_data = $this->db_model->select_data('multi_batch,id','students use index (id)',array('students.email'=>$this->session->userdata('email')));
//             // print_r($where_in);
//           if($this->session->userdata('role') == 1 && $super == 1){ 
//                 $cond = array('students.admin_id'=>$this->session->userdata('uid'));
//             }else if($this->session->userdata('role') == 1 && $super == 0){
//                 $cond = array('students.admin_id'=>$this->session->userdata('uid'));
//             }else if($this->session->userdata('role') == 3 && $super == 0){
//                 $cond = array('students.admin_id'=>$this->session->userdata('admin_id'));
//                 // $or_like = array(array('students.multi_batch',implode(",",json_decode($student_data[0]['multi_batch']))));
//             }else{
//                 $batch_ids = $this->session->userdata('batch_id');
//                 $admin_id = $this->session->userdata('admin_id');
//                 if(!empty($batch_ids)){
//                     $or_like = array(array('students.batch_id',implode(",",$batch_ids)));
//                     $cond = "students.admin_id = $admin_id AND status = 1";
//                 }else{
//                     $cond = '';
//                     $or_like = ''; 
//                 }
//             }
//         //   $student_data1 = $this->db_model->select_data('*','sudent_batchs',$cond,$limit,array('id','desc'),$like,$like,'','',$or_like,$where_in);
//         //   foreach($student_data1 as $tttt){
//         //     //   print_r($tttt['student_id']);
//         //   }
          
//             $student_data = $this->db_model->select_data('*','students use index (id)',$cond,$limit,array('students.id','desc'),$like,$like,'','',$or_like);
          
//             //echo $this->db->last_query();
//             if(($this->session->userdata('role')==3) && empty($this->session->userdata('batch_id'))){
//                 $student_data = "";
//             }
//             if(!empty($student_data)){
//                 $role = $this->session->userdata('role');
//                 if($role == '1'){  
//                     $profile = 'admin';
//                 }else if($role == '3'){
//                     $profile = 'teacher';
//                 }
    
//                 $batch_array = $this->db_model->select_data('id,batch_name','batches use index (id)',array('id'=>$student_data[0]['batch_id']));
    
//                 foreach($student_data as $student){
//                     if (!empty($student['image']))                    { 
//                         $image = '<img src="'.base_url().'uploads/students/'.$student['image'].'" title="'.$student['name'].'" class="view_large_image"></a>';
//                     }else{
//                         $image = '<img src="'.base_url().'assets/images/student_img.png" title="'.$student['name'].'" class="view_large_image"></a>';
//                     }
    
//                     foreach($student_data as $studentData){
                        
//                     $join = array('batches',"batches.id = sudent_batchs.batch_id");
//                       $student_batch = $this->db_model->select_data('sudent_batchs.student_id,sudent_batchs.batch_id,batches.batch_name','sudent_batchs',array('student_id'=>$student['id']),'','','',$join);
//                     }

//                       $batch_name="";
                     
//                       foreach($student_batch as $batch){
//                         $batch_name .= $batch['batch_name'].', ';
                    
//                       }
//                      if(!empty($student_batch)){
//                         $batchData = rtrim($batch_name,", ");
//                       }else{
//                           $batch_name = "<h6>No Batch Purchased</h6>";
//                          $batchData = $batch_name;
//                       }  
                    
                   
//                     if($student['status'] == 1){
//                         $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$student['id'].'" data-table ="students" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
//                     }else{
//                         $statusDrop = '<div class="admin_tbl_status_wrap">
//                     <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$student['id'].'" data-table ="students" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
//                     }
                    
//                     if($student['payment_status']==1){
//                           $payment_status=$this->lang->line('ltr_paid'); 
//                       }else{
//                           $payment_status=$this->lang->line('ltr_unpaid'); 
//                       }
//                         //  $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$student['admin_id']),1);
                       
//                         //  if($name){
//                         //      if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
//                         //      {
//                         //          $added_by= $name[0]['name']."  (Super Admin) ";
//                         //      }else{
//                         //          $added_by = $name[0]['name']."  (Sub-Admin)";
//                         //      }
//                         //  // $added_by = $name[0]['name'];
//                         //  }else{
//                         //      $added_by = "Multi-Batches";
//                         //     //  $added_by = '';
//                         //  }
//                     if($role == '1'){
                                            
                       
//                             $action = '<div class="actions_wrap_dot">
//                             <span class="tbl_action_drop" >
//                                 <svg xmlns="https://www.w3.org/2000/svg" width="15px" height="4px">
//                                 <path fill-rule="evenodd" fill="rgb(77 74 129)" d="M13.031,4.000 C11.944,4.000 11.062,3.104 11.062,2.000 C11.062,0.895 11.944,-0.000 13.031,-0.000 C14.119,-0.000 15.000,0.895 15.000,2.000 C15.000,3.104 14.119,4.000 13.031,4.000 ZM7.500,4.000 C6.413,4.000 5.531,3.104 5.531,2.000 C5.531,0.895 6.413,-0.000 7.500,-0.000 C8.587,-0.000 9.469,0.895 9.469,2.000 C9.469,3.104 8.587,4.000 7.500,4.000 ZM1.969,4.000 C0.881,4.000 -0.000,3.104 -0.000,2.000 C-0.000,0.895 0.881,-0.000 1.969,-0.000 C3.056,-0.000 3.937,0.895 3.937,2.000 C3.937,3.104 3.056,4.000 1.969,4.000 Z"></path>
//                                 </svg>
//                                 <ul class="tbl_action_ul">
//                                     <li>
//                                         <a href="'.base_url('admin/student-attendance/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-check-circled"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_attendance').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url('admin/student-attendance-extra-class/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-tasks-alt"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_extra_class_attendance').'
//                                         </a>
//                                     </li>

                                //     <li>
                                //     <a href="'.base_url('admin/student-manage-certificate/').$student['id'].'">
                                //         <span class="action_drop_icon">
                                //             <i class="icofont-badge"></i>
                                //         </span>
                                //         '.$this->lang->line('ltr_manage_certificate').'
                                //     </a>
                                // </li>

//                                     <li>
//                                         <a href="'.base_url('admin/student-progress/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-paper"></i>
//                                             </span>
//                                              '.$this->lang->line('ltr_progress').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url('admin/student-academic-record/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-bars"></i>
//                                             </span>'.$this->lang->line('ltr_academic_record').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url().$profile.'/student-notice/'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="fas fa-bell"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_notice').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url().$profile.'/doubts-ask/'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-speech-comments"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_doubts_ask').' 
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url().$profile.'/add-student/'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="fa fa-edit"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_edit').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="javascript:void(0);" class="deleteData" title="Delete" data-id="'.$student['id'].'" data-table="students">
//                                             <span class="action_drop_icon">
//                                                 <i class="fa fa-trash"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_delete').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="javascript:void(0);" class="changePassModal" data-id="'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-gear"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_change_password').'
//                                         </a>
//                                     </li>'.
//                          /*
//                                     <li>
//                                         <a href="javascript:void(0);" class="paymentStatus" data-id="'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                               <i class="icofont-mail"></i>
//                                             </span>
//                                             '.$payment_status.'
//                                         </a>
//                                     </li>
//                          */ 
//                                 '</ul>
//                             </span>
//                          </div>';
//                          $user_name =$this->readMoreWord($student['name'], 'Student Name',15);
//                         $dataarray[] = array(
//                                 '<input type="checkbox" class="checkOneRow" value="'.$student['id'].'">',
//                                 $count,
//                                 $image.$user_name,
//                                 '<p class="email">'.$student['email'].'</p>',
//                                 $student['contact_no'],
//                                 $student['enrollment_id'],
//                                 $batchData,
//                                 date('d-m-Y',strtotime($student['admission_date'])),
//                                 $statusDrop,
//                                 $action,
//                                 // $added_by
//                         ); 
//                     }else if($role == '3'){
//                       if($_SESSION['admin_id']!=$vid['admin_id']){
//                         $action = '<div class="actions_wrap_dot">
//                             <span class="tbl_action_drop" >
//                                 <svg xmlns="https://www.w3.org/2000/svg" width="15px" height="4px">
//                                 <path fill-rule="evenodd" fill="rgb(77 74 129)" d="M13.031,4.000 C11.944,4.000 11.062,3.104 11.062,2.000 C11.062,0.895 11.944,-0.000 13.031,-0.000 C14.119,-0.000 15.000,0.895 15.000,2.000 C15.000,3.104 14.119,4.000 13.031,4.000 ZM7.500,4.000 C6.413,4.000 5.531,3.104 5.531,2.000 C5.531,0.895 6.413,-0.000 7.500,-0.000 C8.587,-0.000 9.469,0.895 9.469,2.000 C9.469,3.104 8.587,4.000 7.500,4.000 ZM1.969,4.000 C0.881,4.000 -0.000,3.104 -0.000,2.000 C-0.000,0.895 0.881,-0.000 1.969,-0.000 C3.056,-0.000 3.937,0.895 3.937,2.000 C3.937,3.104 3.056,4.000 1.969,4.000 Z"></path>
//                                 </svg>
//                                 <ul class="tbl_action_ul">
//                                     <li>
//                                         <a data-toggle="tooltip" data-placement="top" title="Attendance" href="'.base_url('teacher/student-attendance/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-check-circled"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_attendance').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a data-toggle="tooltip" data-placement="top" title="Extra Class Attendance" href="'.base_url('teacher/student-attendance-extra-class/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-tasks-alt"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_extra_class_attendance').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url('teacher/student-progress/').$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-paper"></i>
//                                             </span>
//                                              '.$this->lang->line('ltr_progress').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                          <a  href="'.base_url('teacher/student-academic-record/').$student['id'].'">
//                                                 <i class="icofont-bars"></i>
//                                             </span>'.$this->lang->line('ltr_academic_record').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                          <a href="'.base_url().$profile.'/student-notice/'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="fas fa-bell"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_notice').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="'.base_url().$profile.'/doubts-ask/'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-speech-comments"></i>
//                                             </span>
//                                           '.$this->lang->line('ltr_doubts_ask').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="javascript:void(0);" class="changePassModal" data-id="'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-gear"></i>
//                                             </span>
//                                             '.$this->lang->line('ltr_change_password').'
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <a href="javascript:void(0);" class="paymentStatus" data-id="'.$student['id'].'">
//                                             <span class="action_drop_icon">
//                                                 <i class="icofont-mail"></i>
//                                             </span>
//                                             '.$payment_status.'
//                                         </a>
//                                     </li>
//                                 </ul>
//                             </span>
//                          </div>';
//                     }else{
//                         $action = '<div class="actions_wrap_dot disabled button_disbled_cursor"disabled>
//                          </div>';
//                     }
//                          $user_name =$this->readMoreWord($student['name'], 'Student Name',15);
//                         $dataarray[] = array(
//                             '<input type="checkbox" class="checkOneRow" value="'.$student['id'].'">',
//                                 $count,
//                                 $image.$user_name,
//                                 '<p class="email">'.$student['email'].'</p>',
//                                 $student['contact_no'],
//                                 $student['enrollment_id'],
//                                 $batchData,
//                                 date('d-m-Y',strtotime($student['admission_date'])),
//                                 $action,
//                                 // $added_by
//                         ); 
//                     }
                    
//                     $count++;
//                 }
    
//                 $recordsTotal = $this->db_model->countAll('students use index (id)',$cond,'','',$like,'','',$or_like,$where_in);
    
//                 $output = array(
//                     "draw" => $post['draw'],
//                     "recordsTotal" => $recordsTotal,
//                     "recordsFiltered" => $recordsTotal,
//                     "data" => $dataarray,
//                 );
            
//             }else{
//                 $output = array(
//                     "draw" => $post['draw'],
//                     "recordsTotal" => 0,
//                     "recordsFiltered" => 0,
//                     "data" => array(),
//                 );
//             }
           
//             echo json_encode($output,JSON_UNESCAPED_SLASHES);
//         }else{
//             echo $this->lang->line('ltr_not_allowed_msg');
//         } 
//     }
     function student_table(){
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
                    $like = array('students.name',$post['search']['value']);
                     $like1 = $post['search']['value'];
                    $or_like = '';
                }else{
                    $like = ''; 
                    $like1 = '';
                    $or_like = ''; 
                }
                if($this->session->userdata('role')==1){
                    $uid = $this->session->userdata('uid');
                    // $cond='';
                    // $cond = array('students.admin_id'=>$this->session->userdata('uid'));
                    // $cond['students.admin_id'] = $this->session->userdata('uid');
                    //   $cond1 = "`students`";
                      $cond1 = "`sudent_batchs`";
                      $cond2 = "`admin_id`";
                      $cond3 = $uid;
                   $cond = ($cond1.'.'.$cond2.'='.$cond3); 
                }else{
                    $batch_ids = $this->session->userdata('batch_id');
                    $admin_id = $this->session->userdata('admin_id');
            		if(!empty($batch_ids)){
                		$cond1 = "`students`";
                        $cond2 = "`admin_id`";
                        $cond3 = "`sudent_batchs`";
                        $cond4 = "`batch_id`";
                        $cond5 = "`status`";
    
                        $cond = ($cond3.'.'.$cond4.' in ('.$batch_ids.') AND '.$cond1.'.'.$cond5.'= 1'); 
            // 		$cond = "students.admin_id = $admin_id AND sudent_batchs.batch_id in ($batch_ids) AND students.status = 1";
            		}else{
            			$cond = '';
            		}
                }
                
                if(isset($get['user_status']) || isset($get['lgStatus']) || isset($get['user_batch'])){
                    if($get['user_status']!='' && $get['lgStatus']!='' && $get['user_batch']!=''){
                        if($this->session->userdata('role')==1){
                            // $cond['status'] = $get['user_status'];   
                            // $cond['login_status'] = $get['lgStatus'];   
                            // $cond_in['batch_id'] = $get['user_batch'];
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            $cond .= ' AND '.$cond1.'.'.$cond6.'='.$get['lgStatus'];
                            $cond_in = ' AND '.$cond3.'.'.$cond4.'='.$get['user_batch'];
    
                            
                            // $cond .= ' AND students.status='.$get['user_status'];
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                            // $cond_in = ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }else{
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            $cond .= ' AND '.$cond1.'.'.$cond6.'='.$get['lgStatus'];
                            $cond .= ' AND '.$cond3.'.'.$cond4.'='.$get['user_batch'];
                            
                            
                            // $cond .= ' AND students.status='.$get['user_status'];
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                            // $cond .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }
                          
                    }else if($get['user_status']!='' && $get['lgStatus']!=''){
                        if($this->session->userdata('role')==1){
                            // $cond['status'] = $get['user_status'];   
                            // $cond['login_status'] = $get['lgStatus'];
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            $cond .= ' AND '.$cond1.'.'.$cond6.'='.$get['lgStatus'];
    
                            //  $cond .= ' AND students.status='.$get['user_status'];
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                        }else{
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            $cond .= ' AND '.$cond1.'.'.$cond6.'='.$get['lgStatus'];
    
                            // $cond .= ' AND students.status='.$get['user_status'];
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                        }
                    }else if($get['user_status']!='' && $get['user_batch']!=''){
                        if($this->session->userdata('role')==1){
                            // $cond['students.status'] = $get['user_status'];   
                            // $cond_in['sudent_batchs.batch_id'] = $get['user_batch'];
                            
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            $cond .= ' AND '.$cond1.'.'.$cond4.'='.$get['user_batch'];
    
                            // $cond .= ' AND students.status='.$get['user_status'];
                            // $cond .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }else{
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            $cond .= ' AND '.$cond1.'.'.$cond4.'='.$get['user_batch'];
                            
                            // $cond .= ' AND students.status='.$get['user_status'];
                            // $cond .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }
                    }else if($get['lgStatus']!='' && $get['user_batch']!=''){
                        if($this->session->userdata('role')==1){
                            // $cond['login_status'] = $get['lgStatus'];  
                            // $cond_in['batch_id'] = $get['user_batch'];
                            
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond6.'='.$get['lgStatus'];
                            $cond .= ' AND '.$cond1.'.'.$cond4.'='.$get['user_batch'];
                            
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                            // $cond_in .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }else{
                            
                            $cond1 = "`students`";
                            $cond2 = "`admin_id`";
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
                            $cond5 = "`status`";
                            $cond6 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond6.'='.$get['lgStatus'];
                            $cond .= ' AND '.$cond1.'.'.$cond4.'='.$get['user_batch'];
                            
                            
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                            // $cond .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }
                    }else if($get['user_status']!='' ){
                        if($this->session->userdata('role')==1){
                            // $cond['students.status'] = $get['user_status'];
                            
                            $cond1 = "`students`";
                            $cond5 = "`status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            
                            // $cond .= ' AND students.status='.$get['user_status'];
    
                        }else{
                            $cond1 = "`students`";
                            $cond5 = "`status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['user_status'];
                            
                            // $cond .= ' AND students.status='.$get['user_status'];
                             
                        }
                    }else if($get['lgStatus']!=''){
                        if($this->session->userdata('role')==1){
                            // $cond['login_status'] = $get['lgStatus'];
                            $cond1 = "`students`";
                            $cond5 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['lgStatus'];
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
    
                        }else{
                            $cond1 = "`students`";
                            $cond5 = "`login_status`";
    
                            $cond .= ' AND '.$cond1.'.'.$cond5.'='.$get['lgStatus'];
                            // $cond .= ' AND students.login_status='.$get['lgStatus'];
                        }
                    }else if($get['user_batch']!=''){
                        if($this->session->userdata('role')==1){
                            // $cond_in['batch_id'] = $get['user_batch'];
                            
                            $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
    
                            $cond .= ' AND '.$cond3.'.'.$cond4.'='.$get['user_batch'];
                            
                            // $cond .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
     
                        }else{
                              $cond3 = "`sudent_batchs`";
                            $cond4 = "`batch_id`";
    
                            $cond .= ' AND '.$cond3.'.'.$cond4.'='.$get['user_batch'];
                            // $cond .= ' AND sudent_batchs.batch_id='.$get['user_batch'];
                        }
                    }
                }
                
                if(!empty($cond_in['batch_id'])){
                    $where_in=array('sudent_batchs.batch_id',$cond_in['batch_id']);
                }else{
                    $where_in="";
                }


                $student_dat = $this->db_model->select_data('sudent_batchs.*,students.id as s_id,students.status,students.admission_date,students.name,students.email,students.contact_no,students.enrollment_id','sudent_batchs',$cond,$limit,array('students.id','asc'),$like,array('students','students.id=sudent_batchs.student_id','left'),'sudent_batchs.id',$or_like,$where_in);
                $new = [];
                foreach($student_dat as $row) {
                    $title = $row['s_id'];
                    if(!array_key_exists($title, $new)) {
                        $new[$title] = $row;
                    }
                    
                }
                // $student_data = $this->db_model->select_data('students.*','students use index (id)',$cond,$limit,array('students.id','desc'),$like,array('sudent_batchs','sudent_batchs.student_id=students.id','left'),'students.id',$or_like,$where_in);
                // print_r($student_data);
                // echo $this->db->last_query();
    
                if(($this->session->userdata('role')==3) && empty($this->session->userdata('batch_id'))){
                    $student_data = "";
                }
                if(!empty($student_dat)){
                    $role = $this->session->userdata('role');
                    if($role == '1'){  
                        $profile = 'admin';
                    }else if($role == '3'){
                        $profile = 'teacher';
                    }
     
                    $batch_array = $this->db_model->select_data('id,batch_name','batches use index (id)',array('id'=>$student_data[0]['batch_id']));
      
                    foreach($new as $student){
                       
                        if (!empty($student['image'])){ 
                            $image = '<img src="'.base_url().'uploads/students/'.$student['image'].'" title="'.$student['name'].'" class="view_large_image"></a>';
                        }else{
                            $image = '<img src="'.base_url().'assets/images/student_img.png" title="'.$student['name'].'" class="view_large_image"></a>';
                        }
        
                        foreach($new as $studentData){
                        $join = array('batches',"batches.id = sudent_batchs.batch_id");
                          $student_batch = $this->db_model->select_data('sudent_batchs.student_id,sudent_batchs.batch_id,batches.batch_name','sudent_batchs',array('student_id'=>$student['s_id']),'','','',$join,'batches.id');
                        // print_r($student_batch);
                        }
    
                          $batch_name="";
                         
                          foreach($student_batch as $batch){
                            $batch_name .= $batch['batch_name'].', ';
                        
                          }
                         if(!empty($student_batch)){
                            $batchData = rtrim($batch_name,", ");
                          }else{
                              $batch_name = "<h6>No Batch Purchased</h6>";
                             $batchData = $batch_name;
                          }  
                        if($student['status'] == 1){
                            $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$student['id'].'" data-table ="students" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                        }else{
                            $statusDrop = '<div class="admin_tbl_status_wrap">
                        <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$student['id'].'" data-table ="students" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                        }
                        
                        if($student['payment_status']==1){
    						  $payment_status=$this->lang->line('ltr_paid'); 
    					   }else{
    						  $payment_status=$this->lang->line('ltr_unpaid'); 
    					   }
                        if($role == '1'){
                           						
                           
                                $action = '<div class="actions_wrap_dot">
                                <span class="tbl_action_drop" >
                                    <svg xmlns="https://www.w3.org/2000/svg" width="15px" height="4px">
                    				<path fill-rule="evenodd" fill="rgb(77 74 129)" d="M13.031,4.000 C11.944,4.000 11.062,3.104 11.062,2.000 C11.062,0.895 11.944,-0.000 13.031,-0.000 C14.119,-0.000 15.000,0.895 15.000,2.000 C15.000,3.104 14.119,4.000 13.031,4.000 ZM7.500,4.000 C6.413,4.000 5.531,3.104 5.531,2.000 C5.531,0.895 6.413,-0.000 7.500,-0.000 C8.587,-0.000 9.469,0.895 9.469,2.000 C9.469,3.104 8.587,4.000 7.500,4.000 ZM1.969,4.000 C0.881,4.000 -0.000,3.104 -0.000,2.000 C-0.000,0.895 0.881,-0.000 1.969,-0.000 C3.056,-0.000 3.937,0.895 3.937,2.000 C3.937,3.104 3.056,4.000 1.969,4.000 Z"></path>
                    				</svg>
                    				<ul class="tbl_action_ul">
                                    <!--
                    				    <li>
                    				        <a href="'.base_url('admin/student-attendance/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-check-circled"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_attendance').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="'.base_url('admin/student-attendance-extra-class/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-tasks-alt"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_extra_class_attendance').'
                    				        </a>
                    				    </li>
                                        <li>
                                        <a href="'.base_url('admin/student-manage-certificate/').$student['s_id'].'">
                                            <span class="action_drop_icon">
                                                <i class="icofont-badge"></i>
                                            </span>
                                            '.$this->lang->line('ltr_manage_certificate').'
                                        </a>
                                    </li>
                    				    <li>
                    				        <a href="'.base_url('admin/student-progress/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-paper"></i>
                    				            </span>
                    				             '.$this->lang->line('ltr_progress').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="'.base_url('admin/student-academic-record/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-bars"></i>
                    				            </span>'.$this->lang->line('ltr_academic_record').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="'.base_url().$profile.'/student-notice/'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="fas fa-bell"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_notice').'
                    				        </a>
                    				    </li>
                                        -->
    									<li>
                    				        <a href="'.base_url().$profile.'/doubts-ask/'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-speech-comments"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_doubts_ask').' 
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="'.base_url().$profile.'/add-student/'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="fa fa-edit"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_edit').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="javascript:void(0);" class="deleteData" title="Delete" data-id="'.$student['s_id'].'" data-table="students">
                    				            <span class="action_drop_icon">
                    				                <i class="fa fa-trash"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_delete').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="javascript:void(0);" class="changePassModal" data-id="'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-gear"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_change_password').'
                    				        </a>
                    				    </li>'.
                    		 /*
    									<li>
                    				        <a href="javascript:void(0);" class="paymentStatus" data-id="'.$student['id'].'">
                    				            <span class="action_drop_icon">
                    				              <i class="icofont-mail"></i>
                    				            </span>
                    				            '.$payment_status.'
                    				        </a>
                    				    </li>
                    		 */ 
                    				'</ul>
                                </span>
                             </div>';
    						 $user_name =$this->readMoreWord($student['name'], 'Student Name',15);
    						
                            $dataarray[] = array(
                                    '<input type="checkbox" class="checkOneRow" value="'.$student['s_id'].'">',
                                    $count,
                                    $image.$user_name,
                                    '<p class="email">'.$student['email'].'</p>',
                                    $student['contact_no'],
                                    $student['enrollment_id'],
                                    $batchData,
                                    date('d-m-Y',strtotime($student['admission_date'])),
                                    $statusDrop,
                                    $action
                            ); 
                        }else if($role == '3'){
                            $action = '<div class="actions_wrap_dot">
                                <span class="tbl_action_drop" >
                                    <svg xmlns="https://www.w3.org/2000/svg" width="15px" height="4px">
                    				<path fill-rule="evenodd" fill="rgb(77 74 129)" d="M13.031,4.000 C11.944,4.000 11.062,3.104 11.062,2.000 C11.062,0.895 11.944,-0.000 13.031,-0.000 C14.119,-0.000 15.000,0.895 15.000,2.000 C15.000,3.104 14.119,4.000 13.031,4.000 ZM7.500,4.000 C6.413,4.000 5.531,3.104 5.531,2.000 C5.531,0.895 6.413,-0.000 7.500,-0.000 C8.587,-0.000 9.469,0.895 9.469,2.000 C9.469,3.104 8.587,4.000 7.500,4.000 ZM1.969,4.000 C0.881,4.000 -0.000,3.104 -0.000,2.000 C-0.000,0.895 0.881,-0.000 1.969,-0.000 C3.056,-0.000 3.937,0.895 3.937,2.000 C3.937,3.104 3.056,4.000 1.969,4.000 Z"></path>
                    				</svg>
                    				<ul class="tbl_action_ul">
                                    <!--
                    				    <li>
                    				        <a data-toggle="tooltip" data-placement="top" title="Attendance" href="'.base_url('teacher/student-attendance/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-check-circled"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_attendance').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a data-toggle="tooltip" data-placement="top" title="Extra Class Attendance" href="'.base_url('teacher/student-attendance-extra-class/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-tasks-alt"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_extra_class_attendance').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="'.base_url('teacher/student-progress/').$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-paper"></i>
                    				            </span>
                    				             '.$this->lang->line('ltr_progress').'
                    				        </a>
                    				    </li>
                                        <li>
                                        <a href="'.base_url('admin/student-manage-certificate/').$student['s_id'].'">
                                            <span class="action_drop_icon">
                                                <i class="icofont-badge"></i>
                                            </span>
                                            '.$this->lang->line('ltr_manage_certificate').'
                                        </a>
                                    </li>
                    				    <li>
                    				         <a  href="'.base_url('teacher/student-academic-record/').$student['s_id'].'">
                    				                <i class="icofont-bars"></i>
                    				            </span>'.$this->lang->line('ltr_academic_record').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				         <a href="'.base_url().$profile.'/student-notice/'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="fas fa-bell"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_notice').'
                    				        </a>
                    				    </li>
                                        -->
    									<li>
                    				        <a href="'.base_url().$profile.'/doubts-ask/'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-speech-comments"></i>
                    				            </span>
                    				           '.$this->lang->line('ltr_doubts_ask').'
                    				        </a>
                    				    </li>
                    				    <li>
                    				        <a href="javascript:void(0);" class="changePassModal" data-id="'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-gear"></i>
                    				            </span>
                    				            '.$this->lang->line('ltr_change_password').'
                    				        </a>
                    				    </li>
                                        <!--
    									<li>
                    				        <a href="javascript:void(0);" class="paymentStatus" data-id="'.$student['s_id'].'">
                    				            <span class="action_drop_icon">
                    				                <i class="icofont-mail"></i>
                    				            </span>
                    				            '.$payment_status.'
                    				        </a>
                    				    </li>
                                        -->
                    				</ul>
                                </span>
                             </div>';
    						 $user_name =$this->readMoreWord($student['name'], 'Student Name',15);
                           
                            $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$student['s_id'].'">',
                                    $count,
                                    $image.$user_name,
                                    '<p class="email">'.$student['email'].'</p>',
                                    $student['contact_no'],
                                    $student['enrollment_id'],
                                    $batchData,
                                    date('d-m-Y',strtotime($student['admission_date'])),
                                    $action
                            ); 
                        }
                        
                        $count++;
                    }
                    
                  $table = 'sudent_batchs';
                   $recordsTotal = $this->db_model->countAll('students use index (id)',array('admin_id'=>$_SESSION['uid']),'','',$like,'','',$or_like,$where_in);
                    // $recordsTotal = $this->db_model->custom_slect_query("COUNT(id) AS `numrows`
                    // FROM (SELECT `sudent_batchs`.`id` FROM $table LEFT JOIN `students` ON `students`.`id`=`sudent_batchs`.`student_id` WHERE $cond $where_in GROUP BY `students`.`id`) sada")[0]['numrows'];
                    
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
        function addNewStudent(){  
   
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('email',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
     
                $config['upload_path'] ='./uploads/students/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size']    = '0';		
                $this->load->library('upload', $config);
                
                $admin_id = $this->session->userdata('uid');
                if($this->input->post('type',TRUE) == 'edit'){
                    unset($data_arr['type']);
                    $st_id = $data_arr['student_id'];
                    unset($data_arr['student_id']);
                    $data['dob'] = date('Y-m-d',strtotime($data_arr['dob']));
                    $prevRecd = $this->db_model->select_data('batch_id','students use index (id)',array('admin_id'=>$admin_id,'id'=>$st_id),1);
    
                    if(isset($_FILES['stu_pic']) && !empty($_FILES['stu_pic']['name'])){
                        if ($this->upload->do_upload('stu_pic')){
                            $uploaddata = $this->upload->data();
                            $pic = $uploaddata['raw_name'];
                            $pic_ext = $uploaddata['file_ext'];
                            $image_name = $pic.'_'.date('ymdHis').$pic_ext;
                            rename('./uploads/students/'.$pic.$pic_ext,'./uploads/students/'.$image_name);
                            $data['image'] = $image_name;
                        }else{
                            $resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
                            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                            die();
                        }
                    }
                    if($_POST['payMode']=='offline'){
                        $batch_id = $this->input->post('batch_id',TRUE);
                    }else{
                        $batch_id =$_POST['multi_batch_id'];
                    }
                    
                    $data['batch_id'] = json_encode($batch_id);
                    $data['name'] = $data_arr['name'];
                    $data['father_name'] = $data_arr['father_name'];
                    $data['father_designtn'] = $data_arr['father_designtn'];
                    $data['gender'] = $data_arr['gender'];
                    $data['contact_no'] = $data_arr['contact_no'];
                    $data['email'] = $data_arr['email'];
                    $data['pay_mode'] = $data_arr['payMode'];
                    $data['address'] = $data_arr['address'];
                 
                    $data = $this->security->xss_clean($data);
                
                    $ins = $this->db_model->update_data_limit('students',$data,array('id'=>$st_id,'admin_id'=>$admin_id),1);
                   $batchName = array();
                    if($_POST['payMode']!='offline'){
                        $del = $this->db_model->delete_data('sudent_batchs',array('student_id'=>$st_id));
                    }
                //   $del = $this->db_model->delete_data('sudent_batchs',array('student_id'=>$st_id));
                    if($ins){
                    foreach($batch_id as $value){
                        $data2['batch_id'] = $value;
                        $data2['student_id'] = $st_id;
                        $data2['status'] = 0;
                        $data2['added_by'] = 'Admin';
                        $data2['admin_id'] = $value['admin_id'];
                     
                     $ins1 = $this->db_model->insert_data('sudent_batchs',$data2);
                     if($_POST['payMode']=='offline'){
                         $price = $data_arr['price'];
               
                            $data_pay = array(
                                'student_id'=>$st_id,
                                'batch_id'=>$value,
                                'transaction_id'=>'Cash',
                                'mode'=>'offline',
                                'amount'=>$price,
                                'admin_id'=>$_SESSION['uid'],
                            );
                      
                     $ins2 = $this->db_model->insert_data('student_payment_history',$data_pay);
                     }else{
                         $btupdate = $this->db_model->select_data('batch_offer_price','batches use index (id)',array('id'=>$value),1);
                        
                        $price = $data_arr['price'];
               
                            $data_pay = array(
                                'student_id'=>$st_id,
                                'batch_id'=>$value,
                                'transaction_id'=>'Cash',
                                'mode'=>'offline',
                                'amount'=>$btupdate[0]['batch_offer_price'],
                                'admin_id'=>$_SESSION['uid'],
                            );
                      
                     $ins2 = $this->db_model->insert_data('student_payment_history',$data_pay); 
                     }
                     $batch_type =$this->db_model->select_data('*','batches use index (id)',array('id'=>$value),1);
                     $batchName .= $batch_type[0]['batch_name'];
                    }
                     $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
                     $subj = $title.'- '.$this->lang->line('ltr_thanks_msg');
                     $em_msg = $this->lang->line('ltr_hey').' '.ucwords($this->input->post('name',TRUE)).', '.$this->lang->line('ltr_congratulations').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled_in').' '.$batchName.'<br/><br/>'.$this->lang->line('ltr_enjoy').'<br/><br/> '.$this->lang->line('ltr_thanks_msg').'<br/><br/>'.$this->lang->line('ltr_eacademy');
                     $this->SendMail($email, $subj, $em_msg);
                        $resp = array('status'=>'1', 'msg' => $this->input->post('name',TRUE).$this->lang->line('ltr_student_details_updated_msg'),'enroll_id'=>'', 'password'=>'');
                    }
                }else{
                    $prevRecd = $this->db_model->select_data('id','students use index (id)',array('admin_id'=>$admin_id,'email'=>$this->input->post('email',TRUE)),1);
                    $prevRecdTeacher = $this->db_model->select_data('id','users use index (id)',array('email'=>$this->input->post('email',TRUE)),1);
                    
                    $prevRecdstud = $this->db_model->select_data('id','students use index (id)',array('admin_id'=>$admin_id,'contact_no'=>$this->input->post('contact_no',TRUE)),1);
                 
                    // if(empty($prevRecdstud)){
                    if(empty($prevRecd) && empty($prevRecdTeacher)){
                        $siteData = array();
                        $siteData['word_for_enroll'] = $this->common->enrollWord;
                        unset($data_arr['type']);
                        $data['admin_id'] = $admin_id;            
                        $data['login_status'] = 0;
                        $lastrecord = $this->db_model->select_data('id','students use index (id)',array('admin_id'=>$admin_id),1,array('id','desc'));             
                        if(!empty($lastrecord)){
                            $last_id = $lastrecord[0]['id'];
                        }else{
                            $last_id = 0;
                        }
                        
                        $password = $siteData['word_for_enroll'].$admin_id.$last_id.rand(1000,5000);
                        $enrolid = $siteData['word_for_enroll'].$admin_id.$last_id.rand(10,100);
                        $data['enrollment_id'] = $enrolid;
                        $data['password'] = md5($password);
                        $data['admission_date'] = date('Y-m-d');
                        $data['dob'] = date('Y-m-d',strtotime($data_arr['dob']));
                        $data['status'] = 1;
    
                        //pic upload
                        if(isset($_FILES['stu_pic']) && !empty($_FILES['stu_pic']['name'])){
                            if ($this->upload->do_upload('stu_pic')){
                                $uploaddata = $this->upload->data();
                                $pic = $uploaddata['raw_name'];
                                $pic_ext = $uploaddata['file_ext'];
                                $image_name = $pic.'_'.date('ymdHis').$pic_ext;
                                rename('./uploads/students/'.$pic.$pic_ext,'./uploads/students/'.$image_name);
                                $data_arr['image'] = $image_name;
                            }else{
                                $resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
                                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                                die();
                            }
                        }else{
                        $data_arr['image']='student_img.png';
                        }
                    // if($_POST['payMode']==0){
                    //      $batch_id = $this->input->post('batch_id',TRUE);
                    // }else{
                    //     if($_POST['payMode']=='offline'){
                    //         $batch_id = $this->input->post('batch_id',TRUE);
                    //     }else{
                    //         $batch_id =$_POST['multi_batch_id'];
                    //     }
                    // }   
                    if($_POST['payMode']=='offline'){
                            $batch_id = $this->input->post('batch_id',TRUE);
                        }else{
                            $batch_id =$_POST['multi_batch_id'];
                        }
                    
                 
                    $data['image'] = $data_arr['image'];
                    $data['batch_id'] = json_encode($batch_id);
                    // $data['batch_id'] =$batch_id;
                    $data['name'] = $data_arr['name'];
                    $data['father_name'] = $data_arr['father_name'];
                    $data['father_designtn'] = $data_arr['father_designtn'];
                    $data['gender'] = $data_arr['gender'];
                    $data['contact_no'] = $data_arr['contact_no'];
                    $data['email'] = $data_arr['email'];
                    $data['address'] = $data_arr['address'];
                    $data['pay_mode'] = $data_arr['payMode'];
                 
                        $data = $this->security->xss_clean($data);
                        $ins = $this->db_model->insert_data('students',$data);
                        if($ins){
                           foreach($batch_id as $value){
                               $btupdate = $this->db_model->select_data('batch_offer_price','batches use index (id)',array('id'=>$value),1);
                                $pay = array(
                                'student_id'=>$ins,
                                'batch_id'=>$value,
                                'transaction_id'=>'Cash',
                                'mode'=>'offline',
                                'amount'=>$btupdate[0]['batch_offer_price'],
                                'admin_id'=>$admin_id
                              
                            );
                            $ins1 = $this->db_model->insert_data('student_payment_history',$pay);
                           }
                           
                        }
                           
                        // foreach($batch_id as $batch){
                        
                    //     $check_batch = $this->db_model->select_data('*','sudent_batchs',array('batch_id'=>$batch_id,'student_id'=>$ins));
                        
                    if(!empty($data['batch_id'])){
                        foreach($batch_id as $value){
                             $data2['batch_id'] = $value;
                            $data2['student_id'] = $ins;
                            $data2['status'] = 0;
                            $data2['added_by'] = 'Admin';
                            $data2['admin_id'] =$admin_id;
                            $ins1 = $this->db_model->insert_data('sudent_batchs',$data2);
                        }
                       
                    }
                       
                        if($ins1 && (!empty($data['batch_id']))){
                            // $this->db_model->update_with_increment('batches','no_of_student',array('id'=>$this->input->post('batch_id',TRUE)),'plus',1);
                            $resp = array('status'=>'1', 'msg' => $this->input->post('name',TRUE).$this->lang->line('ltr_added_msg'),'enroll_id'=>$enrolid, 'password'=>$password);
                            //send email
                            $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
                            $subj = $title.'- '.$this->lang->line('ltr_credentials');
                            $em_msg = $this->lang->line('ltr_hey').' '.ucwords($this->input->post('name',TRUE)).', '.$this->lang->line('ltr_congratulation').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_enrolment_id').' : '.$enrolid.'<br/><br/>'.$this->lang->line('ltr_password').' : '.$password.'';
                            $to_male =$this->input->post('email',TRUE);
                            $this->SendMail($to_male,$subj,$em_msg);
                        }
                    }else{
                        $resp = array('status'=>'0', 'msg' => $this->lang->line('ltr_email_already_msg')); 
                    }
                    // }else{
                    //     $resp = array('status'=>'0', 'msg' => $this->lang->line('ltr_mobile_already_msg')); 
                    // }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }  
    }

    
    function change_student_batch(){  
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('batch_id',TRUE))){          
                $admin_id = $this->session->userdata('uid');
                $prevRecd = $this->db_model->select_data('batch_id','students use index (id)',array('admin_id'=>$admin_id,'id'=>$this->input->post('id',TRUE)),1);
                $updt = $this->db_model->update_data_limit('students',$this->security->xss_clean(array('batch_id'=>$this->input->post('batch_id',TRUE))),array('id'=>$this->input->post('id',TRUE)),1);
                if($updt){
                    if($prevRecd[0]['batch_id']!=$this->input->post('batch_id',TRUE)){
                        $this->db_model->update_with_increment('batches','no_of_student',array('id'=>$this->input->post('batch_id',TRUE)),'plus',1);
                        $this->db_model->update_with_increment('batches','no_of_student',array('id'=>$prevRecd[0]['batch_id']),'minus',1);
                    }
                    $resp = array('status'=>'1'); 
                }else{
                    $resp = array('status'=>'0'); 
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function update_student_pass(){  
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('password',TRUE))){
                $updt = $this->db_model->update_data_limit('students',$this->security->xss_clean(array('password'=>md5($this->input->post('password',TRUE)))),array('id'=>$this->input->post('id',TRUE)),1);
                if($updt){
                    $resp = array('status'=>'1'); 
                }else{
                    $resp = array('status'=>'0'); 
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    

    /********   Student Manage End   ********/
    /********   subject Manage Start   ********/

    function subject_table(){
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
                $like = array('subject_name',$post['search']['value']);
            }else{
               $like = ''; 
               $or_like='';
            }
                if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                    $cond = array('admin_id'=>$this->session->userdata('uid'));
              }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                //    $or_like = array(array('subjects.admin_id',1));
                  $cond = array('admin_id'=>$this->session->userdata('uid'));
              }
              else if($this->session->userdata('role') == 3){
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'));
              }else if($this->session->userdata('role') == 'student'){
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
              }
            $subject_data = $this->db_model->select_data('*','subjects use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($subject_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($subject_data as $subject){
                    $chapterData = $this->db_model->select_data('id,chapter_name','chapters use index (id)',array('subject_id'=>$subject['id']),'',array('id','ASC'));           
                    $allchapters = '';
                    foreach($chapterData as $chaptr){
                        $chapter_nameWord = $this->readMoreChapter($chaptr['chapter_name'], 'Chapter name','15');
                        
                        $allchapters .= '<p class="chapter_wrap"><span>'.$chapter_nameWord.'</span><span class="ChapterEditDltWrap" data-word="'.$chaptr['chapter_name'].'" data-id="'.$chaptr['id'].'" data-sid="'.$subject['id'].'"><span class="editChapterName"><i class="icofont-edit"></i></span><span class="deleteChapterName"><i class="fa fa-times"></i></span></span></p>';
                    }
    
                 if($_SESSION['admin_id']!=$subject['admin_id']){
                    if($subject['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton"  data-id="'.$subject['id'].'" data-table ="subjects" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$subject['id'].'" data-table ="subjects" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                }else{
                   if($batch['status'] == 1){
                    $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor"><a class="tbl_status_btn light_sky_bg" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor">
                    <a class="tbl_status_btn light_red_bg " data-id="'.$vid['id'].'" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                }
                if($_SESSION['admin_id']!=$subject['admin_id']){
                    $action = '<p class="actions_wrap"><a class="edit_SbjectChaptr btn_edit" title="Edit" data-id="'.$subject['id'].'"><i class="fa fa-edit"></i></a>
                    <a class="deleteSubject btn_delete" title="Delete" data-id="'.$subject['id'].'"><i class="fa fa-trash"></i></a>
                    <a class="addChapers" data-id="'.$subject['id'].'" title="add chapter"><i class="fa fa-plus""></i></a></p>';
                }else{
                   $action = '<p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                              <a class=" btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a>
                              <a class="button_disbled_cursor"  title="add chapter"><i class="fa fa-plus disabled"></i></a></p>';
                }
                  $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$subject['admin_id']),1);
                 
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                    
                     }else{
                         $added_by = '';
                     }
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$subject['id'].'">',
                                $count,
                                $subject['subject_name'],
                                $allchapters,
                                $statusDrop,
                                $action,
                                $added_by
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('subjects use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    
    function add_subject(){
       
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $prevdata =  $this->db_model->select_data('id','subjects use index (id)',array('subject_name'=>$this->input->post('name',TRUE)),1,array('id','desc'));
       
                if(!empty($this->input->post('id',TRUE))){
                        $data_arr = array(
                            'subject_name'	=>	trim($this->input->post('name',TRUE))
                        );
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->update_data_limit('subjects',$data_arr,array('id'=>$this->input->post('id',TRUE)),1);
                        if($ins==true){
                            $resp = array('status'=>'1'); 
                        }else{
                            $resp = array('status'=>'0'); 
                        }
                   
                }else{
                        $data_arr = array(
                            'subject_name'	=>	trim($this->input->post('name',TRUE)),
                            'status'	=>	1,
                            'admin_id' => $this->session->userdata('uid')
                        ); 
                            $data_arr = $this->security->xss_clean($data_arr);
                            $ins = $this->db_model->insert_data('subjects',$data_arr);
                            if($ins==true){
                                $resp = array('status'=>'1'); 
                            }else{
                                $resp = array('status'=>'0'); 
                            }
                       
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function add_category(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $prevdata =  $this->db_model->select_data('id','batch_category use index (id)',array('name'=>$this->input->post('name',TRUE)),1);
                if(!empty($this->input->post('id',TRUE))){
                    if(empty($prevdata) || ($prevdata[0]['id'] == $this->input->post('id',TRUE))){
                        $data_arr = array(
                            'name'	=>	trim($this->input->post('name',TRUE))
                        );
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->update_data_limit('batch_category',$data_arr,array('id'=>$this->input->post('id',TRUE)),1);
                        if($ins==true){
                            $resp = array('status'=>'1'); 
                        }else{
                            $resp = array('status'=>'0'); 
                        }
                    }else{
                        $resp = array('status'=>'2'); 
                    }
                }else{
                    if(empty($prevdata)){
                        $data_arr = array(
                            'name'	=>	trim($this->input->post('name',TRUE)),
                            'slug'  => strtolower(str_replace(' ', '_', $this->input->post('name',TRUE))),
                            'status'	=>	1,
                            'admin_id'=>$_SESSION['uid']
                        ); 
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->insert_data('batch_category',$data_arr);
                        if($ins==true){
                            $resp = array('status'=>'1'); 
                        }else{
                            $resp = array('status'=>'0'); 
                        }
                    }else{
                        $resp = array('status'=>'2'); 
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    
function category_table(){
    
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
                //  $or_like = array(array('batch_category.admin_id',1));
            }else{
               $like = ''; 
                $or_like ='';
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                 $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                 $cond = array('admin_id'=>$this->session->userdata('uid'));
            }
            
            $category_data = $this->db_model->select_data('*','batch_category use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($category_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($category_data as $cat){
                 if($_SESSION['admin_id']!=$cat['admin_id']){
                    if($cat['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton"  data-id="'.$cat['id'].'" data-table ="batch_category" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$cat['id'].'" data-table ="batch_category" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                 }else{
                   if($batch['status'] == 1){
                    $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor"><a class="tbl_status_btn light_sky_bg" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor">
                    <a class="tbl_status_btn light_red_bg " data-id="'.$vid['id'].'" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                }
                if($_SESSION['admin_id']!=$cat['admin_id']){
                    $action = '<p class="actions_wrap"><a class="edit_Category btn_edit" title="Edit" data-id="'.$cat['id'].'"><i class="fa fa-edit"></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$cat['id'].'" data-table="batch_category"><i class="fa fa-trash"></i></a></p>';
                     $dtl = '<input type="checkbox" class="checkOneRow" value="'.$cat['id'].'">';
                }else{
                    $dtl = '';
                   $action = '<p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                              <a class=" btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
                }
                    $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$cat['admin_id']),1);
                 
                    if($name){
                        if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                        {
                            $added_by= $name[0]['name']."  (Super Admin) ";
                        }else{
                            $added_by = $name[0]['name']."  (Sub-Admin)"; 
                        }
                   
                    }else{
                        $added_by = ''; 
                    }
                  
                    $dataarray[] = array(
                                // '<input type="checkbox" class="checkOneRow" value="'.$cat['id'].'">',
                                $dtl,
                                $count,
                                $cat['name'],
                                $statusDrop,
                                $action,
                                $added_by
                    ); 
                    $count++;
                }
                $recordsTotal = $this->db_model->countAll('batch_category use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    
function add_subcategory(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $prevdata =  $this->db_model->select_data('id','batch_subcategory use index (id)',array('name'=>$this->input->post('name',TRUE)),1);
                if(!empty($this->input->post('id',TRUE))){
                    if(empty($prevdata) || ($prevdata[0]['id'] == $this->input->post('id',TRUE))){
                        $data_arr = array(
                            'name'	=>	trim($this->input->post('name',TRUE)),
                            'cat_id' => $this->input->post('cat_id',TRUE)
                        );
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->update_data_limit('batch_subcategory',$data_arr,array('id'=>$this->input->post('id',TRUE)),1);
                        if($ins==true){
                            $resp = array('status'=>'1'); 
                        }else{
                            $resp = array('status'=>'0'); 
                        }
                    }else{
                        $resp = array('status'=>'2'); 
                    }
                }else{
                    // if(empty($prevdata)){
                        $data_arr = array(
                            'name'	=>	trim($this->input->post('name',TRUE)),
                             'cat_id'	=>	trim($this->input->post('cat_id',TRUE)),
                            'slug'  => strtolower(str_replace(' ', '_', $this->input->post('name',TRUE))),
                            'status'	=>	1,
                            'admin_id'=>$_SESSION['uid']
                        ); 
                        $data_arr = $this->security->xss_clean($data_arr);
                       
                        $ins = $this->db_model->insert_data('batch_subcategory',$data_arr);
                        if($ins==true){
                            $resp = array('status'=>'1'); 
                        }else{
                            $resp = array('status'=>'0'); 
                        }
                    // }else{
                    //     $resp = array('status'=>'2'); 
                    // }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }


function subcategory_table(){
    
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
                $join_array = array('batch_category',"batch_category.name like '%".$post['search']['value']."%' AND batch_category.id = batch_subcategory.cat_id");
            }else{
              $join_array = array('batch_category',"batch_category.id = batch_subcategory.cat_id");
            }
            
            if(isset($get['admin'])){
                if($get['admin']!=''){    
                    $like = array('batch_category.admin_id',$get['admin']); 
                }
            }else{
                 $like = ''; 
                 $or_like = '';
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                 $cond = array('batch_subcategory.admin_id'=>$this->session->userdata('uid'));
            }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                 $or_like = array(array('batch_category.admin_id',1));
                 $cond = array('batch_subcategory.admin_id'=>$this->session->userdata('uid'));
            }
            $subcategory_data = $this->db_model->select_data('batch_subcategory.*,batch_category.name as catName,batch_category.id as catId','batch_subcategory use index (id)',$cond,$limit,array('id','desc'),$like,$join_array,'',$or_like);
         
            //echo $this->db->last_query();
            if(!empty($subcategory_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($subcategory_data as $subcat){
                 if($_SESSION['admin_id']!=$subcat['admin_id']){
                    if($subcat['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton"  data-id="'.$subcat['id'].'" data-table ="batch_subcategory" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$subcat['id'].'" data-table ="batch_subcategory" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                 }else{
                   if($batch['status'] == 1){
                    $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor"><a class="tbl_status_btn light_sky_bg" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor">
                    <a class="tbl_status_btn light_red_bg " data-id="'.$vid['id'].'" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                }
                if($_SESSION['admin_id']!=$subcat['admin_id']){
                    $action = '<p class="actions_wrap"><a class="editsub_Category btn_edit" title="Edit" data-catid="'.$subcat['catId'].'" data-cat="'.$subcat['catName'].'" data-subcat="'.$subcat['name'].'" data-id="'.$subcat['id'].'"><i class="fa fa-edit"></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$subcat['id'].'" data-table="batch_subcategory"><i class="fa fa-trash"></i></a></p>';
                }else{
                   $action = '<p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                              <a class=" btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
                }
                  $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$subcat['admin_id']),1);
                    
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                    
                     }else{
                         $added_by = '';
                     }
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$subcat['id'].'">',
                                $count,
                                $subcat['catName'],
                                $subcat['name'],
                                $statusDrop,
                                $action,
                                $added_by
                    ); 
                    $count++;
                }
                
                $recordsTotal = $this->db_model->countAll('batch_subcategory use index (id)',$cond,'','',$like,$join_array,'',$or_like);
    
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
            

    function deleteSubjects(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $res = $this->db_model->delete_data('subjects',array('id'=>$this->input->post('id',TRUE)));
                if($res){    
                    $this->db_model->delete_data('chapters',array('subject_id'=>$this->input->post('id',TRUE)));        
                    $this->db_model->delete_data('questions',array('subject_id'=>$this->input->post('id',TRUE)));        
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_char_qu_msg'));
                }else{
                    $resp = array('status'=>'0'); 
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
   
    function add_chapter(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $chapters = explode(',',$this->input->post('name',TRUE));
                foreach($chapters as $chpt){
                    if(!empty($chpt)){
                        $prevData = $this->db_model->select_data('id','chapters use index (id)',array('subject_id'=>$this->input->post('sid',TRUE),'chapter_name'=>trim($chpt)));
                        if(empty($prevData)){
                            $this->db_model->insert_data('chapters',$this->security->xss_clean(array('chapter_name'=>trim($chpt),'subject_id'=>$this->input->post('sid',TRUE),'status'=>1,'no_of_questions'=>0)));
                        }else{
                            
                            $resp = array('status'=>'2','char'=>trim($chpt));
                            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                            die();
                        }
                    }
                }
                $resp = array('status'=>'1');
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function edit_chapter(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $prevchapt =  $this->db_model->select_data('id','chapters use index (id)',array('chapter_name'=>$this->input->post('name',TRUE),'subject_id'=>$this->input->post('sid',TRUE)),1);
                if(empty($prevchapt) || ($prevchapt[0]['id'] == $this->input->post('id',TRUE))){
                    $prevData = $this->db_model->select_data('id','chapters use index (id)',array('subject_id'=>$this->input->post('sid',TRUE),'id'=>$this->input->post('id',TRUE)),1);
                    if(!empty($prevData)){
                        $res = $this->db_model->update_data_limit('chapters',$this->security->xss_clean(array('chapter_name'=>trim($this->input->post('name',TRUE)))),array('subject_id'=>$this->input->post('sid',TRUE),'id'=>$this->input->post('id',TRUE)),1);
                        if($res)
                            $resp = array('status'=>'1');
                        else
                            $resp = array('status'=>'0');
                    }else{
                        $resp = array('status'=>'0');
                    }
                }else{
                    $resp = array('status'=>'2');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function deleteChapter(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $res = $this->db_model->delete_data('chapters',array('id'=>$this->input->post('id',TRUE),'subject_id'=>$this->input->post('sid',TRUE)));
                if($res){        
                    $this->db_model->delete_data('questions',array('subject_id'=>$this->input->post('sid',TRUE),'chapter_id'=>$this->input->post('id',TRUE)));        
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_char_qus_msg'));
                }else{
                    $resp = array('status'=>'0'); 
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_char_qus_msg');
        }
    }

    /********   subject Manage End   ********/
    /********   Question Manage Start   ********/

    function question_table($page){
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
                $like = array('question',$post['search']['value']);
            }else{
               $like = ''; 
               $or_like = '';
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('questions.admin_id',$get['admin']); 
                }
            }
            $role = $this->session->userdata('role');
            if($role == '1'){  
                $profile = 'admin';
            }
            if($role == '3'){  
                $profile = 'teacher';
            }
           //print_r($_SESSSION);
            if($page == 'exam'){
                if($role == '1'){
                    $cond = array('admin_id'=>$this->session->userdata('uid'));
                }else{
                    $cond = array('admin_id'=>$this->session->userdata('admin_id'));
                }
            }else{
               
                if($role == '1' && $this->session->userdata('super_admin')==1){
                    // $cond = "";
                     $cond = array('admin_id'=>$this->session->userdata('uid'));
                }else if($role == '1' && $this->session->userdata('super_admin')==0){
                    $cond = array('admin_id'=>$this->session->userdata('uid'));
                    //  $or_like = array(array('questions.admin_id',1));
                    // $cond = "";
                }else if($role == '3' && $this->session->userdata('super_admin')==0){
                    $cond = array('admin_id'=>$this->session->userdata('admin_id'));
                }
            }
            
            if(isset($get['subject']) || isset($get['chapter'])){
                if($get['subject']!='' && $get['chapter']!=''){   
                    $cond['subject_id'] = $get['subject'];   
                    $cond['chapter_id'] = $get['chapter'];  
                }else if($get['subject']!=''){
                    $cond['subject_id'] = $get['subject'];   
                }
            }
    
            if(isset($get['word'])){
                if($get['word']!=''){
                    $like = array('question',$get['word']);  
                }
            }

            $question_data = $this->db_model->select_data('*','questions use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            //     print_r($question_data);
            // die();
            if(!empty($question_data)){
                
                foreach($question_data as $question){
    
                    $subject = $this->db_model->select_data('subject_name','subjects use index (id)',array('id'=>$question['subject_id']),1)[0]['subject_name'];
                    $chapter_data = $this->db_model->select_data('chapter_name','chapters use index (id)',array('id'=>$question['chapter_id']),1);
                    if(!empty($chapter_data)){
                        $chapter=$chapter_data[0]['chapter_name'];
                    }else{
                        $chapter="";

                    }
                    // $added_by = $this->db_model->select_data('name','users use index (id)',array('id'=>$question['added_by']),1)[0]['name'];
                     $added_by = $this->db_model->select_data('*','users use index (id)',array('id'=>$question['added_by']),1);
                    if($added_by){
                         if($added_by[0]['admin_id']==1 && $added_by[0]['super_admin'] == 1)
                         {
                             $added_by= $added_by[0]['name']."  (Super Admin) ";
                         }else  if($added_by[0]['admin_id']==1 && $added_by[0]['super_admin'] == 0 && $added_by[0]['role']==1){
                             $added_by = $added_by[0]['name']."  (Sub-Admin)";
                         }else{
                              $added_by = $added_by[0]['name']."  (Teacher)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    $optionArr = json_decode($question['options'],true);
                   //  echo $question['options'];
                   // print_r($optionArr);

                    $i = 'A';
                    $cnt = 1;
                    $options = '';
                    foreach($optionArr as $op){
                        $options .= '<div style="display: flex;">'.$i.'. &nbsp;&nbsp; <span class="option_'.$cnt.'">'.$op.'</span></div>';
                        $i++;
                        $cnt++;
                    }
    
                if($_SESSION['admin_id']!=$question['added_by']){
                    if($question['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$question['id'].'" data-table ="questions" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$question['id'].'" data-table ="questions" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                }else{
                   if($vid['status'] == 1){
                    $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor"><a class="tbl_status_btn light_sky_bg" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor">
                    <a class="tbl_status_btn light_red_bg "  data-table ="notes_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                }
                    $catDrop = '<select data-id="'.$question['id'].'" data-table ="questions" class="form-control changeCategory datatableSelect">
                        <option value="0" '.(($question['category'] == 0) ? 'selected':'').'>'.$this->lang->line('ltr_none').'</option>
                        <option value="1" '.(($question['category'] == 1) ? 'selected':'').'>'.$this->lang->line('ltr_imp').'</option>
                        <option value="2" '.(($question['category'] == 2) ? 'selected':'').'>'.$this->lang->line('ltr_vimp').'</option>
                    </select> ';
                    
                    if($_SESSION['admin_id']!=$question['added_by']){
                        $actions = '<p class="actions_wrap"><a  href="'.base_url().$profile.'/add-question/'.$question['id'].'" class="btn_edit" title="Edit"><i class="fa fa-edit"></i></a>
                        <a class="deleteData btn_delete" data-id="'.$question['id'].'" data-table="questions" title="Delete"><i class="fa fa-trash"></i></a></p>';
                    }else{
                       $actions = '<p class="actions_wrap"><a  class="btn_edit" title="Edit button_disbled_cursor"><i class="fa fa-edit disabled"></i></a>
                        <a class=" btn_delete button_disbled_cursor" data-id="'.$question['id'].'" data-table="questions" title="Delete"><i class="fa fa-trash disabled"></i></a></p>';
                    }
                    
                    // $actions = '<p class="actions_wrap"><a  href="'.base_url().$profile.'/add-question/'.$question['id'].'" class="btn_edit" title="Edit"><i class="fa fa-edit"></i></a>
                    // <a class="deleteData btn_delete" data-id="'.$question['id'].'" data-table="questions" title="Delete"><i class="fa fa-trash"></i></a></p>';
                    
                    // $questionWord =$this->readMoreWord($question['question'], 'Question');
                    if($page == 'exam'){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$question['id'].'">',
                            $count,
                            '<p class="descParaCls">'.$question['question'].'</p>',
                            $options,
                            $question['answer'],
                            $subject,
                            $chapter
                        ); 
                    }else{
                        if($this->session->userdata('role')==1){
                            $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$question['id'].'">',
                                $count,
                                '<p class="descParaCls">'.htmlspecialchars_decode($question['question']).'</p>',
                                $options,
                                $question['answer'],
                                $subject,
                                $chapter,
                                $statusDrop,
                                // $catDrop,
                                $added_by,
                                date('d-m-Y h:i A',strtotime($question['added_on'])),
                                $actions
                            ); 
                        }else{
                            
                            $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$question['id'].'">',
                                $count,
                                '<p class="descParaCls">'.$questionWord.'</p>',
                                $options,
                                $question['answer'],
                                $subject,
                                $chapter,
                                $statusDrop,
                                // $catDrop,
                                date('d-m-Y h:i A',strtotime($question['added_on'])),
                                $actions 
                            ); 
                        }
                    }
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('questions use index (id)',$cond,'','',$like,'','',$or_like);
    
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

    function get_chapter(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('subject',TRUE))){
                if(!empty($this->input->post('batch_id',TRUE))){
                     if(is_array($this->input->post('batch_id'))){

                    $batch_id = implode(', ', $this->input->post('batch_id',TRUE));
                    $subject =$this->input->post('subject',TRUE);
                   $conn="";
                    if(count($this->input->post('batch_id',TRUE))>1){
                        $chaData = $this->db_model->custom_slect_query(" `id`,`chapter` FROM batch_subjects use index (id) WHERE `batch_id` in($batch_id) AND `subject_id`=$subject ORDER BY `id` DESC");
                        $chapterArray=array();
                       
                        foreach($chaData as $key=>$value){
                            $chapterArray[] = json_decode($value['chapter']);
                        }
                        $a_diff=call_user_func_array('array_intersect',$chapterArray);
                        $chapterData = $this->db_model->select_data('id,chapter_name,no_of_questions','chapters use index (id)','','',array('id','desc'),'','','','',array('id',implode(',',$a_diff)));
                    }else{
                        $chaData = current($this->db_model->custom_slect_query(" `id`,`chapter` FROM batch_subjects use index (id) WHERE `batch_id` in($batch_id) AND `subject_id`=$subject ORDER BY `id` DESC"));
                        $chapterArray=json_decode($chaData['chapter']);
                        //print_r($chapterArray);
                         $chapterData = $this->db_model->select_data('id,chapter_name,no_of_questions','chapters use index (id)','','',array('id','desc'),'','','','',array('id',implode(',',$chapterArray)));
                        //echo $this->db->last_query();
                       // print_r($chapterData);
                        
                    }
                   // print_r($chapterData);
                    //die();
                    
                }else{
                    $chapterData = $this->db_model->select_data('id,chapter_name,no_of_questions','chapters use index (id)',array('subject_id'=>$this->input->post('subject',TRUE)),'',array('id','desc'));
                }
            }else{
                $chapterData = $this->db_model->select_data('id,chapter_name,no_of_questions','chapters use index (id)',array('subject_id'=>$this->input->post('subject',TRUE)),'',array('id','desc'));

            }
                $html = '';
                if(!empty($chapterData)){
                    foreach($chapterData as $chaptr){
                        if($chaptr['no_of_questions'] != 0){
                            $chcount = ' - ('.$chaptr['no_of_questions'].')';
                        }else{
                            $chcount = '';
                        }
                        
                            $html .= '<option value="'.$chaptr['id'].'">'.$chaptr['chapter_name'].'</option>';
                        
                    }
                }
                $teacherHtml = '';
                if(!empty($this->input->post('teacher',TRUE))){
                    $subject = $this->input->post('subject',TRUE);
                    $like = array('teach_subject','"'.$subject.'"');
                    $teacherData = $this->db_model->select_data('id,name','users use index (id)','','',array('id','desc'),$like);
                    //$teacherData);
                    $teacherHtml = '<option value="">'.$this->lang->line('ltr_select_teacher').'</option>';
                    if(!empty($teacherData)){
                        foreach($teacherData as $teachr){                          
                            $teacherHtml .= '<option value="'.$teachr['id'].'">'.$teachr['name'].'</option>';
                        }
                    }
                }
                $resp = array('status'=>1,'html'=>$html,'teacherHtml'=>$teacherHtml);
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	
	function get_chapter_tech(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('subject',TRUE))){
				
				$batch_id = $this->session->userdata('batch_id');
				$subData = $this->db_model->select_data('id,teacher_id,chapter','batch_subjects use index (id)',array('subject_id'=>$this->input->post('subject',TRUE),'batch_id'=>$batch_id),'',array('id','desc'));
				if(empty($subData)){
					$resp = array('status'=>0,'html'=>'sdsd');
				}else{
					$chid = implode(',', json_decode($subData[0]['chapter']));
					$conn ="id in ($chid)";
					$chapterData = $this->db_model->select_data('id,chapter_name','chapters use index (id)',$conn,'',array('id','desc'));
					$html = '<option value="">'.$this->lang->line('ltr_select_chapter').'</option>';
					if(!empty($chapterData)){
						foreach($chapterData as $chaptr){
							$html .= '<option value="'.$chaptr['id'].'">'.$chaptr['chapter_name'].'</option>';
						}
					}
					$teacherHtml = '';
					if(!empty($subData)){
						
						$teacherData = $this->db_model->select_data('id,name','users use index (id)',array('id'=>$subData[0]['teacher_id']),'',array('id','desc'));
						//$teacherData);
						$teacherHtml = '<option value="">'.$this->lang->line('ltr_select_teacher').'</option>';
						if(!empty($teacherData)){
							foreach($teacherData as $teachr){                          
								$teacherHtml .= '<option value="'.$teachr['id'].'">'.$teachr['name'].'</option>';
							}
						}
					}
					$resp = array('status'=>1,'html'=>$html,'teacherHtml'=>$teacherHtml);
				}
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function add_question(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if($this->session->userdata('role') == 1){
                    $profile = 'admin';
                }else{
                    $profile = 'teacher'; 
                }
               // print_r($this->input->post('question'));
            if(!empty($this->input->post('question',TRUE))){
                $data_arr = $this->input->post(NULL);
                unset($data_arr['option1']);
                unset($data_arr['option2']); 
                unset($data_arr['option3']);
                unset($data_arr['option4']);
                $data_arr['options'] = json_encode(array($this->input->post('option1'),$this->input->post('option2'),$this->input->post('option3'),$this->input->post('option4')),JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                $prevQuestion = $this->db_model->select_data('id','questions use index (id)',array('question'=>$this->input->post('question',TRUE),'subject_id'=>$this->input->post('subject_id',TRUE),'chapter_id'=>$this->input->post('chapter_id',TRUE)),1);
                if(!empty($this->input->post('question_id',TRUE))){
                    if(empty($prevQuestion) || ($prevQuestion[0]['id'] == $this->input->post('question_id',TRUE))){
                        $prevData = $this->db_model->select_data('id,subject_id,chapter_id','questions use index (id)',array('id'=>$this->input->post('question_id',TRUE)),1);
                        unset($data_arr['question_id']);
                        //$data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->update_data_limit_question('questions',$data_arr,array('id'=>$this->input->post('question_id',TRUE)),1);
                        if($ins==true){
                            if($prevData[0]['subject_id'] != $this->input->post('subject_id',TRUE)){
                                $this->db_model->update_with_increment('subjects','no_of_questions',array('id'=>$prevData[0]['subject_id']),'minus',1);
                                $this->db_model->update_with_increment('subjects','no_of_questions',array('id'=>$this->input->post('subject_id',TRUE)),'plus',1);
                            }
                            if($prevData[0]['chapter_id'] != $this->input->post('chapter_id',TRUE)){
                                $this->db_model->update_with_increment('chapters','no_of_questions',array('id'=>$prevData[0]['chapter_id']),'minus',1);
                                $this->db_model->update_with_increment('chapters','no_of_questions',array('id'=>$this->input->post('chapter_id',TRUE)),'plus',1);
                            }
                            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_question_updated_msg'),'url'=>base_url($profile.'/question-manage'));
                        }else{
                            $resp = array('status'=>0);
                        }
                    }else{
                        $resp = array('status'=>2,'msg'=>$this->lang->line('ltr_question_exists_msg'));
                    }
                }else{
                    if(empty($prevQuestion)){ 
                        unset($data_arr['question_id']);
                        if($this->session->userdata('role') == 1){
                            $data_arr['admin_id'] = $this->session->userdata('uid');
                        }else{
                            $data_arr['admin_id'] = $this->session->userdata('admin_id');
                        }
                        
                        $data_arr['added_by'] = $this->session->userdata('uid');
                        $data_arr['status'] = 1;
                       // $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->insert_data_question('questions',$data_arr);
                        if($ins==true){
                            $this->db_model->update_with_increment('chapters','no_of_questions',array('id'=>$this->input->post('chapter_id',TRUE)),'plus',1);
                            $this->db_model->update_with_increment('subjects','no_of_questions',array('id'=>$this->input->post('subject_id',TRUE)),'plus',1);
                            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_question_added_msg'),'url'=>base_url($profile.'/question-manage'));
                        }else{
                            $resp = array('status'=>0);
                        }
                    }else{
                        $resp = array('status'=>2,'msg'=>$this->lang->line('ltr_question_exists_msg'));
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    /********   Question Manage End   ********/
    /********   Notice Manage Start   ********/
    function notice_table($type){
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
                $like = array('title',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            $admin_id = $this->session->userdata('uid');
            if($admin_id==1 && $_SESSION['super_id']==0){
                if($type == 'common'){
                    $cond = array('notice_for'=>'Both');
                }else if($type == 'student'){
                    $cond = "(notice_for = 'Student' OR student_id != 0)";
                }else if($type == 'teacher'){
                    $cond = "(notice_for = 'Teacher' OR teacher_id != 0)";
                }
            }else{
                if($type == 'common'){
                    $cond = array('admin_id'=>$admin_id,'notice_for'=>'Both');
                }else if($type == 'student'){
                    $cond = "admin_id = $admin_id AND (notice_for = 'Student' OR student_id != 0)";
                }else if($type == 'teacher'){
                    $cond = "admin_id = $admin_id AND (notice_for = 'Teacher' OR teacher_id != 0)";
                }
            }
            // if($type == 'common'){
            //     $cond = array('admin_id'=>$admin_id,'notice_for'=>'Both');
            // }else if($type == 'student'){
            //     $cond = "admin_id = $admin_id AND (notice_for = 'Student' OR student_id != 0)";
            // }else if($type == 'teacher'){
            //     $cond = "admin_id = $admin_id AND (notice_for = 'Teacher' OR teacher_id != 0)";
            // }
            
            $notices = $this->db_model->select_data('*','notices use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($notices)){
                
                foreach($notices as $not){
                    
                    $descriptionWord =$this->readMoreWord($not['description'], $this->lang->line('ltr_description'));    
                    $action = '<p class="actions_wrap"><a class="deleteDataNotice btn_delete" title="Delete" data-id="'.$not['id'].'" data-table="notices"><i class="fa fa-trash"></i></a></p>';
                    if($not['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$not['id'].'" data-table ="notices" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$not['id'].'" data-table ="notices" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    
                    $userName = '';
                    if(empty($not['notice_for'])){
                        if($not['student_id'] != 0){
                            $userData = $this->db_model->select_data('name','students use index (id)',array('id'=>$not['student_id']),1);
                            if(!empty($userData))
                                $userName = $userData[0]['name'];
                        }else if($not['teacher_id'] != 0){
                            $userData = $this->db_model->select_data('name','users use index (id)',array('id'=>$not['teacher_id']),1);
                            if(!empty($userData))
                                $userName = $userData[0]['name'];
                        }
                    }
                 $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$not['admin_id']),1);
                    // print_r($name);
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 0 &&  $name[0]['role'] == 1){
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }else{
                             $added_by = $name[0]['name']."('Techer')";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    $dataarray[] = array(
                                $count,
                                $not['title'],
                                '<p class="descParaCls">'.$descriptionWord.'</p>',
                                (empty($not['notice_for'])?$userName:(($not['notice_for']!='Both')?'All '.$not['notice_for']:$not['notice_for'])),
                                $added_by,
                                $statusDrop,
                                date('d-m-Y',strtotime($not['date'])),
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
    
    function student_notice_table($id){
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
    
    function teacher_notice_table($id){
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
            
            $cond = array('admin_id'=>$this->session->userdata('uid'),'student_id'=> 0,'teacher_id'=>$id,'notice_for'=>'');
           
            $notices = $this->db_model->select_data('*','notices use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($notices)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($notices as $not){
                    $action = '<p class="actions_wrap"><a class="deleteData btn_delete" title="Delete" data-id="'.$not['id'].'" data-table="notices"><i class="fa fa-trash"></i></a></p>';
                     if($not['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$not['id'].'" data-table ="notices" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$not['id'].'" data-table ="notices" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    
                    $dataarray[] = array(
                                $count,
                                $not['title'],
                                '<p class="descParaCls">'.$not['description'].'</p>',
                                date('d-m-Y',strtotime($not['date'])),
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

    function add_notice(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                $data_arr['date'] = date('Y-m-d');
                $data_arr['status'] = 1;
                $data_arr['added_at'] = date('Y-m-d H:i:s');
                $data_arr['admin_id'] = $this->session->userdata('uid');
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('notices',$data_arr);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>'Notice added sucessfully.');
                    $notice_for = $this->input->post('notice_for',TRUE);
                    
                        $data['batch_id'] = $this->session->userdata('batch_id');
                        $data['notification_type'] = "Notice";
                        $data['msg'] = 'New Notice Added';
                        $data['url'] = 'student/notice';
                        $data['time'] = date('Y-m-d H:i:s');
                        $data['seen_by'] = '';
                        $student_data = $this->db_model->select_data('id','students', array('status'=>'1'));
                       
                      for($i=0;$i<count($student_data);$i++){
                      $data['student_id'] = $student_data[$i]['id'];
                        $notice_not = $this->db_model->insert_data('notifications',$data);     
                      }
                      
                    if(($notice_for=='Student') || ($notice_for=='Both')){
                        $title ="New notice";
                        $where ="notice_common";
                        $batch_id='';
                        if(!empty($where)){
                            $this->push_notification_android($batch_id='',$title,$where);
                        }
                    }
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
   
    function add_personal_notice(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title'))){
                $data_arr = $this->input->post();
                $data_arr['date'] = date('Y-m-d');
                $data_arr['status'] = 1;
                $data_arr['read_status'] = 0;
                if($this->session->userdata('role') == 1){
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                }else{
                    $data_arr['admin_id'] = $this->session->userdata('admin_id');
                }
                $data_arr['added_by'] = $this->session->userdata('uid');
                $data_arr['added_at'] = date('Y-m-d H:i:s');
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('notices',$data_arr);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_notice_added_msg'));
                    
                    $title ="New notice";
                    $where ="notice_personal";
                    $batch_id='';
                    $student_id =$this->input->post('student_id');
                    if(!empty($student_id)){
                        $this->push_notification_android($batch_id='',$title,$where,$student_id);
                    }
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    /********   Notice Manage End   ********/
    /********   Vacancy Manage Start   ********/

    // function vacancy_table(){
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
    //             $or_like = array(array('description',$post['search']['value']));
    //         }else{
    //         $like = ''; 
    //         $or_like = ''; 
    //         }
    
    //         if($this->session->userdata('role') == 1){
    //             $cond = array('admin_id'=>$this->session->userdata('uid'));
    //         }else{
    //             $cond = array('admin_id'=>$this->session->userdata('admin_id'));
    //         }
            
    
    //         $vacancy = $this->db_model->select_data('*','vacancy use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
    //         if(!empty($vacancy)){
    //             $role = $this->session->userdata('role');
    //             if($role == '1'){  
    //                 $profile = 'admin';
    //             }
    
    //             foreach($vacancy as $vac){
    //                 if($vac['status'] == 1){
    //                     $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vac['id'].'" data-table ="vacancy" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
    //                 }else{
    //                     $statusDrop = '<div class="admin_tbl_status_wrap">
    //                 <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vac['id'].'" data-table ="vacancy" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
    //                 }
                    
    //                 $descriptionWord =$this->readMoreWord($vac['description'],$this->lang->line('ltr_description'));
    //                 if($this->session->userdata('role') == 1){
    //                     $file ="'".$vac['files']."'";
    //                     $action = '<p class="actions_wrap"><a class="edit_vacancy btn_edit" title="Edit" data-id="'.$vac['id'].'" data-img='.$file.'><i class="fa fa-edit""></i></a><a class="deleteData btn_delete" title="Delete" data-id="'.$vac['id'].'" data-table="vacancy"><i class="fa fa-trash"></i></a>
    //                     <a class="showinPopData btn_view" title="View" data-id="'.$vac['id'].'" data-table="vacancy"><i class="fa fa-eye"></i></a></p>';
    
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vac['id'].'">',
    //                         $count,
    //                         $vac['title'],
    //                         '<p class="descParaCls">'.$descriptionWord.'</p>',
    //                         date('d-m-Y',strtotime($vac['start_date'])),
    //                         date('d-m-Y',strtotime($vac['last_date'])),
    //                         $vac['mode'],
    //                         $statusDrop,
    //                         $action
    //                     ); 
    //                 }else{
    
    //                     $action = '<p class="actions_wrap"><a class="showinPopData btn_view" title="View" data-id="'.$vac['id'].'" data-table="vacancy"><i class="fa fa-eye"></i></a></p>';
    
    //                     $dataarray[] = array(
    //                         $count,
    //                         $vac['title'],
    //                         '<p class="descParaCls">'.$descriptionWord.'</p>',
    //                         date('d-m-Y',strtotime($vac['start_date'])),
    //                         date('d-m-Y',strtotime($vac['last_date'])),
    //                         $vac['mode'],
    //                         $action
    //                     ); 
    //                 }
    
    //                 $count++;
    //             }
    
    //             $recordsTotal = $this->db_model->countAll('vacancy use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    function vacancy_table(){
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
                $like = array('title',$post['search']['value']);
                $or_like = array(array('description',$post['search']['value']));
            }else{
            $like = ''; 
            $or_like = ''; 
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
               $cond = '';
           }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else{
                $cond = array('admin_id'=>$this->session->userdata('admin_id'));
            }
            
    
            $vacancy = $this->db_model->select_data('*','vacancy use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($vacancy)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
                //$files = json_decode($fileData[0]['files'],true);
                        
                foreach($vacancy as $vac){
                    $files = json_decode($vac['files'],true);
                    foreach($files as $file){
                            $ext = pathinfo(base_url('uploads/vacancy/'.$file))['extension'];
                            if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg'){
                                $html = base_url('uploads/images/'.$file);
                            }else if($ext == 'pdf'){
                              $html = base_url('uploads/vacancy/'.$file);
                            }else{
                                $html = base_url('uploads/vacancy/'.$file);
                            }
                        }
                    if($vac['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vac['id'].'" data-table ="vacancy" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vac['id'].'" data-table ="vacancy" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }                    
                    $descriptionWord =$this->readMoreWord($vac['description'],$this->lang->line('ltr_description'));
                    if($this->session->userdata('role') == 1){
                        $file ="'".$vac['files']."'";                                            
                        $action = '<p class="actions_wrap"><a class="edit_vacancy btn_edit" title="Edit" data-id="'.$vac['id'].'" data-img='.$file.'><i class="fa fa-edit""></i></a><a class="deleteData btn_delete" title="Delete" data-id="'.$vac['id'].'" data-table="vacancy"><i class="fa fa-trash"></i></a>
                        <a class="showinPopData1 btn_view" title="View" data-id="'.$vac['id'].'" href="'.base_url('Admin_profile/file_view/').$vac['id'].'" target="_blank" data-url="'.$html.'"><i class="fa fa-eye"></i></a></p>';
                        $name = $this->db_model->select_data('admin_id,admin_id','users use index (id)',array('id'=>$vac['admin_id']),1);
                        // print_r($name);
                         if($name){
                             if($name[0]['admin_id']==1 && $name[0]['admin_id'] == 1)
                             {
                                 $added_by= $name[0]['name']."  (Super Admin) ";
                             }else{
                                 $added_by = $name[0]['name']."  (Sub-Admin)";
                             }
                         // $added_by = $name[0]['name'];
                         }else{
                             $added_by = '';
                         }
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vac['id'].'">',
                            $count,
                            $vac['title'],
                            '<p class="descParaCls">'.$descriptionWord.'</p>',
                            date('d-m-Y',strtotime($vac['start_date'])),
                            date('d-m-Y',strtotime($vac['last_date'])),
                            // $vac['mode'],
                            $statusDrop,
                            $action,
                            $added_by
                        ); 
                    }else{
                        $action = '<p class="actions_wrap"><a class="showinPopData1 btn_view" title="View" data-id="'.$vac['id'].'" href="'.base_url('Student_profile/file_view/').$vac['id'].'" target="_blank" data-url="'.$html.'"><i class="fa fa-eye"></i></a></p>';
                        /*$action = '<p class="actions_wrap"><a class="showinPopData btn_view " title="View" data-id="'.$vac['id'].'" data-table="vacancy"><i class="fa fa-eye"></i></a></p>';*/
    
                        $dataarray[] = array(
                            $count,
                            $vac['title'],
                            '<p class="descParaCls">'.$descriptionWord.'</p>',
                            date('d-m-Y',strtotime($vac['start_date'])),
                            date('d-m-Y',strtotime($vac['last_date'])),
                            $vac['mode'],
                            $action,
                            $added_by
                        ); 
                    }
    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('vacancy use index (id)',$cond,'','',$like,'','',$or_like);
    
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

    function add_vacancy(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
             
                //file upload
                
                $file_names = array();
                
                if(isset($_FILES) && !empty($_FILES['files']['name'][0])){
                    $fileArray = $_FILES;
                    $count = count($_FILES['files']['name']);
                    unset($_FILES['files']);
                    
                    
                    $arr = [];
                    $totalFiles = [];
                    for($i=0;$i<$count;$i++){
                            
                        $arr['name'] = $fileArray['files']['name'][$i];
                        $arr['type'] = $fileArray['files']['type'][$i];
                        $arr['tmp_name'] = $fileArray['files']['tmp_name'][$i];
                        $arr['error'] = $fileArray['files']['error'][$i];
                        $arr['size'] = $fileArray['files']['size'][$i];
                        
                        $_FILES['newfile_'.$i] = $arr;
                
                        $config['upload_path'] = 'uploads/vacancy'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|docx|doc|pdf';
                        $config['max_size'] = '0';
                
                        $this->load->library('upload',$config); 
                    
                        if($this->upload->do_upload('newfile_'.$i)){
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];
                            $totalFiles[] = $filename;
                        }else{
                            $resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
                            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                            die();
                        }
                    }  
                    $data_arr['files'] = json_encode($totalFiles);
                }
            unset($data_arr['id']);
                $data_arr['admin_id'] = $this->session->userdata('uid');
                $data_arr['start_date'] = date('Y-m-d',strtotime($data_arr['start_date']));
                $data_arr['last_date'] = date('Y-m-d',strtotime($data_arr['last_date']));
                $data_arr['status'] = 1;
                $data_arr['added_at'] = date('Y-m-d H:i:s');
                $data_arr = $this->security->xss_clean($data_arr);
               // print_r($data_arr);
                $ins = $this->db_model->insert_data('vacancy',$data_arr);
                if($ins==true){
                    
                     $data['batch_id'] = '';
                        $data['notification_type'] = "Vacancy";
                        $data['msg'] = 'New Upcoming Exam Added';
                        $data['url'] = 'student/vacancy';
                        $data['time'] = date('Y-m-d H:i:s');
                        $data['seen_by'] = '';
                       
                        $vacancy_not = $this->db_model->insert_data('notifications',$data);     
                     
                    
                    $resp = array('status'=>1,'msg'=> $this->lang->line('ltr_vacancy_added_msg'));
                    $title =$this->lang->line('ltr_upcoming_exams');
                    $where ="exam";
                    $batch_id='';
                    if(!empty($where)){
                        $this->push_notification_android($batch_id='',$title,$where);
                    }
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function edit_vacancy(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
             
                //file upload
                
                $file_names = array();
                
                if(isset($_FILES) && !empty($_FILES['files']['name'][0])){
                    $fileArray = $_FILES;
                    $count = count($_FILES['files']['name']);
                    unset($_FILES['files']);
                    
                    $arr = [];
                    $totalFiles = [];
                    for($i=0;$i<$count;$i++){
                            
                        $arr['name'] = $fileArray['files']['name'][$i];
                        $arr['type'] = $fileArray['files']['type'][$i];
                        $arr['tmp_name'] = $fileArray['files']['tmp_name'][$i];
                        $arr['error'] = $fileArray['files']['error'][$i];
                        $arr['size'] = $fileArray['files']['size'][$i];
                        
                        $_FILES['newfile_'.$i] = $arr;
                
                        $config['upload_path'] = 'uploads/vacancy'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|docx|doc|pdf';
                        $config['max_size'] = '0';
                
                        $this->load->library('upload',$config); 
                    
                        if($this->upload->do_upload('newfile_'.$i)){
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];
                            $totalFiles[] = $filename;
                        }else{
                            $resp = array('status'=>'0', 'msg' => $this->upload->display_errors());
                            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                            die();
                        }
                    }  
                    $data_arr['files'] = json_encode($totalFiles);
                }
            
                $data_arr['admin_id'] = $this->session->userdata('uid');
                $data_arr['start_date'] = date('Y-m-d',strtotime($data_arr['start_date']));
                $data_arr['last_date'] = date('Y-m-d',strtotime($data_arr['last_date']));
               
                $data_arr['added_at'] = date('Y-m-d H:i:s');
                $data_arr = $this->security->xss_clean($data_arr);
                $id = $data_arr['id'];
                unset($data_arr['id']);
               
                $ins = $this->db_model->update_data_limit('vacancy',$data_arr,array('id'=>$id),1);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_vacancy_updated_msg'));
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function showinPopData(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $fileData = $this->db_model->select_data('*','vacancy use index (id)',array('id'=>$this->input->post('id',TRUE)),1);
                
                if(!empty($fileData)){
                    $html = '<div class="gallery_maindiv">
                        <div class="gallery row">';
                    
                    if(!empty($fileData[0]['files'])){
                        $files = json_decode($fileData[0]['files'],true);
                        foreach($files as $file){
                            $ext = pathinfo(base_url('uploads/vacancy/'.$file))['extension'];
                            if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg'){
                                $html .= '<div class="col-lg-3 col-md-4 col-sm-3 vacancy_dataShow">
                                            <a href="'.base_url('uploads/vacancy/'.$file).'" target="_blank">
                                                <img src="'.base_url('uploads/vacancy/'.$file).'"  width="100" height="100" alt="" />
                                            </a>
                                        </div>';
                            }else if($ext == 'pdf'){
                                $html .= '<div class="col-lg-3 col-md-4 col-sm-3 vacancy_dataShow">
                                            <a href="'.base_url('uploads/vacancy/'.$file).'" target="_blank">
                                                <img src="'.base_url('assets/images/pdf-icon.png').'"  width="100" height="100" alt="" />
                                            </a>
                                        </div>';
                            }else{
                                $html .= '<div class="col-lg-3 col-md-4 col-sm-3 vacancy_dataShow">
                                            <a href="'.base_url('uploads/vacancy/'.$file).'" target="_blank">
                                                <img src="'.base_url('assets/images/doc_img.png').'"  width="100" height="100" alt="" />
                                            </a>
                                        </div>';
                            }
                        }
                    }else{
                        $html .= '<div class="col-lg-12 col-md-12 col-sm-12 vacancy_dataShow text-center">
                                           No file Available
                                        </div>';
                    }
                }
                $html .= '</div></div>';
                $resp = array('status'=>1,'html'=>$html);
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    /********   Vacancy Manage End   ********/
    /********   Video Manage Start   ********/
  public function video_edit_manger(){
        $common = $this->db_model->select_data('*',$_POST['table_name'],array('id'=> $_POST['id'])); 
         echo json_encode($common);
    }
    // function video_table(){
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         $post = $this->input->post(NULL,TRUE);
    //         $get = $this->input->get(NULL,TRUE);
    //         $role = $this->session->userdata('role');
    //         if($role =='student'){
    //         $like = array('batch','"'.$this->session->userdata('batch_id').'"');
    //         }else{
    //           $like ='';  
    //         }
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
    //           $or_like = ''; 
    //         }

    //         if(isset($get['subject']) || isset($get['chapter'])){
    //             if($get['subject']!='' && $get['chapter']!=''){   
    //                 $like = array('topic',urldecode($get['chapter'])); 
    //             }
    //         }
    
    //         if($role == 1){  
    //             $cond = array('admin_id'=>$this->session->userdata('uid'));
    //         }else if($role == 3){
    //             $cond = array('added_by'=>$this->session->userdata('uid'), 'admin_id'=>$this->session->userdata('admin_id'));
    //         }else if($role == 'student'){
    //             $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
    //         } 
    
    //         $videos = $this->db_model->select_data('*','video_lectures use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            
    //         if(!empty($videos)){
                
    //             foreach($videos as $vid){
    //                 $action = '<p class="actions_wrap"><a class="viewVideo btn_view" title="View" data-id="'.$vid['id'].'" data-url="'.base_url($vid['url']).'" data-type="'.$vid['video_type'].'" data-desc="'.$vid['description'].'"><i class="fa fa-eye"></i></a>
    //                 <a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="video_lectures"><i class="fa fa-trash"></i></a>
    //                 <p class="actions_wrap"><a  class="edit_video_url btn_edit" title="Edit" data-description="'.$vid['description'].'" data-id="'.$vid['id'].'" data-urle="'.$vid['url'].'"><i class="fa fa-edit"></i></a>
    //                 </p>';
                    
    //                 if($vid['status'] == 1){
    //                     $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="video_lectures" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                     
    //                 }else{
    //                     $statusDrop = '<div class="admin_tbl_status_wrap">
    //                 <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="video_lectures" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
    //                 }
    //                 $added_by = $this->db_model->select_data('name','users use index (id)',array('id'=>$vid['added_by']),1)[0]['name'];
    //                 $batch_id = json_decode($vid['batch']);
    //                 $bach_name = '';
                    
    //                 foreach($batch_id as $bid){
    //                     $batch = current($this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$bid),1));
    //                     $bach_name .= $batch['batch_name'].', ';
    //                 }
                   
    //                 $bach_name = rtrim($bach_name,", ");
    //                 if($vid['preview_type']=="preview"){
    //                     $preview_type = '<div class="edu-radio-btn"><input type="checkbox" class="changeprvButton" data-id="'.$vid['id'].'" checked value="not_preview" id="edu-radio-status"><span for="edu-radio-status"></span></div>';
    //                 }else{
    //                     $preview_type = '<div class="edu-radio-btn"><input type="checkbox" class="changeprvButton" data-id="'.$vid['id'].'" value="preview" id="edu-radio-status"><span for="edu-radio-status"></span></div>';
    //                 }                       

    //                 if($role == 1){
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
    //                         $count,
    //                         $vid['title'],
    //                         (!empty($bach_name)?$bach_name:''),
    //                         $vid['subject'],
    //                         $vid['topic'],
    //                         $vid['video_type'],
    //                         $preview_type,
    //                         $statusDrop,
    //                         $added_by,
    //                         $action
    //                     ); 
    //                 }else if($role == 3){
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
    //                         $count,
    //                         $vid['title'],
    //                         (!empty($batch)?$batch['batch_name']:''),
    //                         $vid['subject'],
    //                         $vid['topic'],
    //                         $vid['video_type'],
    //                         $preview_type,
    //                         $statusDrop,
    //                         $action
    //                     ); 
    //                 }else if($role == 'student'){
    //                     $action = '<p class="actions_wrap"><a class="viewVideo btn_view" title="View" data-id="'.$vid['id'].'" data-url="'.$vid['url'].'" data-type="'.$vid['video_type'].'" data-desc="'.$vid['description'].'"><i class="fa fa-eye"></i></a></p>';
    //                     $dataarray[] = array(
    //                         $count,
    //                         $vid['title'],
    //                         $vid['subject'],
    //                         $vid['topic'],
    //                         $action
    //                     ); 
    //                 }
                    
    //                 $count++;
    //             }
    
    //             $recordsTotal = $this->db_model->countAll('video_lectures use index (id)',$cond,'','',$like,'','',$or_like);
    
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
 function video_table(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            $role = $this->session->userdata('role');
            if($role =='student'){
            $like = array('batch','"'.$this->session->userdata('batch_id').'"');
            }else{
              $like ='';  
            }
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
              $or_like = ''; 
            }

            if(isset($get['subject']) || isset($get['chapter'])){
                if($get['subject']!='' && $get['chapter']!=''){   
                    $like = array('topic',urldecode($get['chapter'])); 
                }
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($role == 1 && $this->session->userdata('super_admin')==1){  
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else
            if($role == 1 && $this->session->userdata('super_admin')==0){  
                $cond = array('admin_id'=>$this->session->userdata('uid'));
                //  $cond = "";
            }else if($role == 3){
                 $cond = array('admin_id'=>$this->session->userdata('admin_id'));
                 //$cond = "";
            }else if($role == 'student'){
                //  $cond = "";
                $cond = array('batch'=>$this->session->userdata('batch_id'));
                 $like = array('batch',$this->session->userdata('batch_id')); 
            } 
  
            $videos = $this->db_model->select_data('*','video_lectures use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            
            if(!empty($videos)){
                
                foreach($videos as $vid){
                    if($_SESSION['admin_id']!=$vid['admin_id']){
                        
                    }else{
                        
                    }
                     $action = "
                    <a class='viewVideo btn_view' title='View' data-id='".$vid["id"]."' data-id='".$vid["id"]."'  data-url='".base_url($vid["url"])."' data-type='".$vid["video_type"]."' data-desc='".$vid["description"]."'><i class='fa fa-eye'></i></a>
                    <p class='actions_wrap'><a class='edit_video_url btn_edit' title='Edit' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-topic='".$vid['topic']."' data-table='video_lectures'  data-id='".$vid["id"]."' ><i class='fa fa-edit'></i></a>
                    <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='video_lectures'><i class='fa fa-trash'></i></a></p>";
            
                 
                    if($vid['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="video_lectures" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                     
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="video_lectures" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$vid['added_by']),1);
                    //  $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$cat['admin_id']),1);
                    // print_r($name);
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 0 &&  $name[0]['role'] == 3){
                             $added_by = $name[0]['name']."  (Teacher)";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    // $batch_id = json_decode($vid['batch']);
                       $batch_id = $vid['batch'];
                    $bach_name = '';
                     $subject = current($this->db_model->select_data('subject_name,id','subjects use index (id)',array('id'=>$vid['subject']),1));
                  
                    $topic = current($this->db_model->select_data('*','chapters use index (id)',array('id'=>$vid['topic']),1));
                
                    $bach_name = $this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$batch_id),1);
                    // foreach($batch_id as $bid){
                    //     $batch = current($this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$batch_id),1));
                    //     $bach_name .= $batch['batch_name'].', ';
                    // }
               
                    // $bach_name = rtrim($bach_name,", ");
                    // $bach_name = rtrim($bach_name);
                    if($vid['preview_type']=="preview"){
                        $preview_type = '<div class="edu-radio-btn"><input type="checkbox" class="changeprvButton" data-id="'.$vid['id'].'" checked value="not_preview" id="edu-radio-status"><span for="edu-radio-status"></span></div>';
                    }else{
                        $preview_type = '<div class="edu-radio-btn"><input type="checkbox" class="changeprvButton" data-id="'.$vid['id'].'" value="preview" id="edu-radio-status"><span for="edu-radio-status"></span></div>';
                    }                       
               
                    if($role == 1){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($bach_name[0]['batch_name'])?$bach_name[0]['batch_name']:''),
                            // $vid['subject_name'],
                            // $vid['chapter_name'],
                            $vid['subject'],
                            $vid['topic'],
                            $vid['video_type'],
                            $preview_type,
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 3){
                        // print_r($vid);
                        // die();
                        if($vid['admin_id'] !=28){
                           $action = "
                                <a class='viewVideo btn_view' title='View' data-id='".$vid["id"]."' data-id='".$vid["id"]."' data-url='".base_url($vid["url"])."' data-type='".$vid["video_type"]."' data-desc='".$vid["description"]."'><i class='fa fa-eye'></i></a>
                                <p class='actions_wrap' disabled><a  class='edit_video_url btn_edit' title='Edit' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-topic='".$vid['topic']."' data-table='video_lectures'  data-id='".$vid["id"]."' ><i class='fa fa-edit'></i></a>
                                <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='video_lectures'><i class='fa fa-trash'></i></a></p>";

                        }else{
                            $action = "
                                <a class='viewVideo btn_view' title='View' data-id='".$vid["id"]."' data-id='".$vid["id"]."' data-url='".base_url($vid["url"])."' data-type='".$vid["video_type"]."' data-desc='".$vid["description"]."'><i class='fa fa-eye'></i></a>
                                <p class='actions_wrap' disabled><a  class='edit_video_url btn_edit' title='Edit' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-topic='".$vid['topic']."' data-table='video_lectures'  data-id='".$vid["id"]."' ><i class='fa fa-edit'></i></a>
                                <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='video_lectures'><i class='fa fa-trash'></i></a></p>";
                        }
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($batch)?$bach_name[0]['batch_name']:''),
                            // $subject['subject_name'],
                            // $topic['chapter_name'],
                             $vid['subject'],
                            $vid['topic'],
                            $vid['video_type'],
                            $preview_type,
                            $statusDrop,
                            $action
                        ); 
                    }else if($role == 'student'){
                        $action = '<p class="actions_wrap"><a class="viewVideo btn_view" title="View" data-id="'.$vid['id'].'" data-url="'.base_url($vid["url"]).'" data-type="'.$vid['video_type'].'" data-desc="'.$vid['description'].'"><i class="fa fa-eye"></i></a></p>';
                        $dataarray[] = array(
                            $count,
                            $vid['title'],
                             $vid['subject'],
                            $vid['topic'],
                            // $subject['subject_name'],
                            // $topic['chapter_name'],
                            $action
                        ); 
                    }
                    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('video_lectures use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    // function add_video(){
    // //  print_r($_POST);
    // //  die();
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         if(!empty($this->input->post('title',TRUE))){
    //             $data_arr = $this->input->post();
                   
    //             if(isset($_FILES['video_file']) && !empty($_FILES['video_file']['name'])){
    //                     $image = $this->upload_media($_FILES,'uploads/video/','video_file');
                        
    //                     if(is_array($image)){
    //                         $resp = array('status'=>'2', 'msg' => $image['msg']);
    //                         die();
    //                     }else{
    //                         //$data_arr['url'] = base_url('uploads/video/').$image;
    //                         $data_arr['url'] ='uploads/video/'.$image;
    //                     }
    //                 }

    //             unset($data_arr['video_file']);
    //             if($this->session->userdata('role') == 1){
    //                 $data_arr['admin_id'] = $this->session->userdata('uid');
    //             }else{
    //                 $data_arr['admin_id'] = $this->session->userdata('admin_id');
    //             }
    //             if(empty($data_arr['id'])){
    //                 unset($data_arr['id']);
    //                 $data_arr['batch']=json_encode(explode(",", $data_arr['batch']));
    //                 $data_arr['added_by'] = $this->session->userdata('uid');
    //                 $data_arr['status'] = 1; 
    //                 $data_arr['added_at'] = date('Y-m-d H:i:s'); 
    //               // $data_arr['added_at'] = date('Y-m-d H:i:s'); 
    //                 $data_arr = $this->security->xss_clean($data_arr);
    //                 $ins = $this->db_model->insert_data('video_lectures',$data_arr);
                     
    //                 // notification
                    
    //                     $batch_data_id = json_decode($data_arr['batch']);
    //                     for($i=0;$i<count($batch_data_id);$i++){
    //                     $data['batch_id'] = $batch_data_id[$i];
    //                     $data['notification_type'] = "Video-Lecture";
    //                     $data['msg'] = 'New Video Added';
    //                     $data['url'] = 'student/video-lecture';
    //                     $data['time'] = date('Y-m-d H:i:s');
    //                     $data['seen_by'] = '';
    //                     $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $data['batch_id'],'status'=>'1'));
    //                     for($i=0;$i<count($student_data);$i++){
    //                     $data['student_id'] = $student_data[$i]['id'];
    //                     $video_not = $this->db_model->insert_data('notifications',$data);
    //                     }  
    //                 }
    //             }else{
    //                 $batch_data=$data_arr['batch'];
    //                 $data_arr['batch']=json_encode(explode(",", $data_arr['batch']));
    //                 $data_arr['added_by'] = $this->session->userdata('uid');
    //                 $data_arr['status'] = 1; 
    //                 $data_arr['added_at'] = date('Y-m-d H:i:s'); 
    //               // $data_arr['added_at'] = date('Y-m-d H:i:s'); 
    //                 $id = $data_arr['id'];
    //                 unset($data_arr['id']); 
    //                 $data_arr = $this->security->xss_clean($data_arr);
    //               // $ins = $this->db_model->insert_data('video_lectures',$data_arr);
                        
    //                 $ins = $this->db_model->update_data_limit('video_lectures',$data_arr,array('id'=>$id),1);
    //                 $title =$data_arr['title'];
    //                 $where ="videoLecture";
    //                 $url=$data_arr['url'];
                    
    //                 preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    //                 $batch_data_id = json_decode($data_arr['batch']);
    //                 for($i=0;$i<count($batch_data_id);$i++){
                        
    //                      $batch_id = $batch_data_id[$i];
    //                      $this->push_notification_android_video($batch_id,$title,$where,'',current($match),$url,$data_arr['video_type']);
    //                 }
                    
    //             }
                
    //             if($ins==true){
    //                 $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_video_added_msg'));
    //             }else{
    //                 $resp = array('status'=>0);
    //             }
    //             echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //         } 
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     } 
    // }
 function add_video(){

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post();
                   
                if(isset($_FILES['video_file']) && !empty($_FILES['video_file']['name'])){
                        $image = $this->upload_media($_FILES,'uploads/video/','video_file');
                        
                        if(is_array($image)){
                            $resp = array('status'=>'2', 'msg' => $image['msg']);
                            die();
                        }else{
                            // $data_arr['url'] = base_url('uploads/video/').$image;
                            $data_arr['url'] = 'uploads/video/'.$image;
                        }
                    }

                unset($data_arr['video_file']);
                if($this->session->userdata('role') == 1){
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                }else{
                    $data_arr['admin_id'] = $this->session->userdata('admin_id');
                }
                if(empty($data_arr['id'])){
                    unset($data_arr['id']);
                    // $data_arr['batch']=json_encode(explode(",", $data_arr['batch']));
                    $data_arr['batch']=$data_arr['batch'];
                    $data_arr['added_by'] = $this->session->userdata('uid');
                    $data_arr['status'] = 1; 
                    $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                   // $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                    $data_arr = $this->security->xss_clean($data_arr);
  
                    $ins = $this->db_model->insert_data('video_lectures',$data_arr);
                     
                    // notification
                    
                        // $batch_data_id = json_decode($data_arr['batch']);
                        $batch_data_id =$data_arr['batch'];
                        for($i=0;$i<count($batch_data_id);$i++){
                        $data['batch_id'] = $batch_data_id[$i];
                        $data['notification_type'] = "Video-Lecture";
                        $data['msg'] = 'New Video Added';
                        $data['url'] = 'student/video-lecture';
                        $data['time'] = date('Y-m-d H:i:s');
                        $data['seen_by'] = '';
                        $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $data['batch_id'],'status'=>'1'));
                        for($i=0;$i<count($student_data);$i++){
                        $data['student_id'] = $student_data[$i]['id'];
                        $video_not = $this->db_model->insert_data('notifications',$data);
                        }  
                    }
                }else{
                   
                     if($data_arr['video_type']=='video' && $_FILES['video_file']['name'] ==""){
                        $urlold = $this->db_model->select_data('url','video_lectures', array('id'=> $_POST['id'],'status'=>'1'));                     
                         $data_arr['url'] = $urlold[0]['url'];                        
                     }                   

                    $batch_data=$data_arr['batch'];                   
                    // $data_arr['batch']=json_encode(explode(",", $data_arr['batch']));
                    $data_arr['batch']=$batch_data;
                    $data_arr['added_by'] = $this->session->userdata('uid');
                    $data_arr['status'] = 1; 
                    $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                   // $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                    $id = $data_arr['id'];
                    unset($data_arr['id']); 
                    $data_arr = $this->security->xss_clean($data_arr);
                   // $ins = $this->db_model->insert_data('video_lectures',$data_arr);
                    
                    //  print_r($data_arr);
                    // die(); 
                    $ins = $this->db_model->update_data_limit('video_lectures',$data_arr,array('id'=>$_POST['id']),1);
                    $title =$data_arr['title'];
                    $where ="videoLecture";
                    $url=$data_arr['url'];
                    
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                    $batch_data_id = json_decode($data_arr['batch']);
                    for($i=0;$i<count($batch_data_id);$i++){
                        
                         $batch_id = $batch_data_id[$i];
                         $this->push_notification_android_video($batch_id,$title,$where,'',current($match),$url,$data_arr['video_type']);
                    }
                       
                    
                }
                
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_video_added_msg'));
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    /********   Video Manage End   ********/
    /********   Enquiry Manage Start  ********/

    function enquiry_table(){
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
                $or_like = array(array('mobile',$post['search']['value']),array('email',$post['search']['value']));
            }else{
               $like = ''; 
               $or_like = ''; 
            }
    
            $enquiry = $this->db_model->select_data('*','enquiry use index (id)','',$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($enquiry)){
                
                foreach($enquiry as $enq){
                    $messageWord =$this->readMoreWord($enq['message'], 'Message');
                    $action = '<p class="actions_wrap"><a class="deleteData btn_delete" title="Delete" data-id="'.$enq['id'].'" data-table="enquiry"><i class="fa fa-trash"></i></a></p>';
    
                    $dataarray[] = array(
                                $count,
                                $enq['name'],
                                $enq['mobile'],
                                $enq['email'],
                                $enq['subject'],
                                '<p class="descParaCls">'.$messageWord.'</p>',
                                date('d-m-Y',strtotime($enq['date'])),
                                $action
                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('enquiry use index (id)','','','',$like,'','',$or_like);
    
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

    /********   Enquiry Manage End   ********/
    /********   Teacher Manage Start  ********/

    function teacher_table(){
        
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            $super = $this->session->userdata('super_admin');
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
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $super == 1){  
                 $cond = array('admin_id'=>$this->session->userdata('uid'),'role'=>3);
                //  $cond = array('role'=>3);
            }else if($this->session->userdata('role') == 1 && $super == 0){
                $cond = array('parent_id'=>$this->session->userdata('uid'),'role'=>3);
            }else{
                $cond = array('parent_id'=>$this->session->userdata('admin_id'),'role'=>3);
            }
    
            $teachers = $this->db_model->select_data('*','users use index (id)',$cond,$limit,array('id','desc'),$like,'','');
             
            if(!empty($teachers)){
                
                foreach($teachers as $teach){
                    
                  $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$teach['admin_id']),1);
                    // print_r($name);
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 0){
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    $action = '<div class="actions_wrap_dot">
                    <span class="tbl_action_drop" >
                        <svg xmlns="https://www.w3.org/2000/svg" width="15px" height="4px">
        				<path fill-rule="evenodd" fill="rgb(77 74 129)" d="M13.031,4.000 C11.944,4.000 11.062,3.104 11.062,2.000 C11.062,0.895 11.944,-0.000 13.031,-0.000 C14.119,-0.000 15.000,0.895 15.000,2.000 C15.000,3.104 14.119,4.000 13.031,4.000 ZM7.500,4.000 C6.413,4.000 5.531,3.104 5.531,2.000 C5.531,0.895 6.413,-0.000 7.500,-0.000 C8.587,-0.000 9.469,0.895 9.469,2.000 C9.469,3.104 8.587,4.000 7.500,4.000 ZM1.969,4.000 C0.881,4.000 -0.000,3.104 -0.000,2.000 C-0.000,0.895 0.881,-0.000 1.969,-0.000 C3.056,-0.000 3.937,0.895 3.937,2.000 C3.937,3.104 3.056,4.000 1.969,4.000 Z"></path>
        				</svg>
        				<ul class="tbl_action_ul">
        				    <!--
        				    <li>
        				        <a href="'.base_url('admin/teacher-progress/').$teach['id'].'">
        				            <span class="action_drop_icon">
        				                <i class="icofont-paper"></i>
        				            </span>
        				             '.$this->lang->line('ltr_progress').'
        				        </a>
        				    </li>
        				    <li>
        				        <a href="'.base_url('admin/teacher-academic-record/').$teach['id'].'">
        				            <span class="action_drop_icon">
        				                <i class="icofont-bars"></i>
        				            </span>'.$this->lang->line('ltr_academic_record').'
        				        </a>
        				    </li>
        				    <li>
        				        <a href="'.base_url().'admin/teacher-notice/'.$teach['id'].'">
        				            <span class="action_drop_icon">
        				                <i class="fas fa-bell"></i>
        				            </span>
        				            '.$this->lang->line('ltr_notice').'
        				        </a>
        				    </li>
                            -->
							<li>
        				        <a href="'.base_url().'admin/doubts-class/'.$teach['id'].'">
        				            <span class="action_drop_icon">
        				                <i class="icofont-speech-comments" aria-hidden="true"></i>
        				            </span>
        				            '.$this->lang->line('ltr_doubts_class').'
        				        </a>
        				    </li>
        				    <li>
        				        <a href="javascript:void(0);" class="edit_teacher" title="Edit" data-id="'.$teach['id'].'" data-subject="'.implode(",",json_decode($teach['teach_subject'])).'" data-img="'.$teach['teach_image'].'">
        				            <span class="action_drop_icon">
        				                <i class="fa fa-edit"></i>
        				            </span>
        				            '.$this->lang->line('ltr_edit').'
        				        </a>
        				    </li>
        				    <li>
        				        <a  class="deleteData" title="Delete" data-id="'.$teach['id'].'" data-table="users" href="javascript:void(0);">
        				            <span class="action_drop_icon">
        				                <i class="fa fa-trash"></i>
        				            </span>
        				            '.$this->lang->line('ltr_delete').'
        				        </a>
        				    </li>
        				</ul>
                    </span>
                 </div>';
        
                    $statusDrop = '<select data-id="'.$teach['id'].'" data-table ="users" class="form-control changeStatus datatableSelect">
                        <option value="1" '.(($teach['status'] == 1) ? 'selected':'').'>'.$this->lang->line('ltr_active').'</option>
                        <option value="0" '.(($teach['status'] == 0) ? 'selected':'').'>'.$this->lang->line('ltr_inactive').'</option>
                    </select> ';
                    
                    if($teach['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$teach['id'].'" data-table ="users" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$teach['id'].'" data-table ="users" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    if (!empty($teach['teach_image'])){ 
                        $image = '<img src="'.base_url().'uploads/teachers/'.$teach['teach_image'].'" title="'.$teach['name'].'" class="view_large_image"></a>';
                    }else{
                        $image = '';
                    }
    
                    $newSubj = $newBatch = '';
                    
                    if(!empty($teach['teach_batch'])){
                        $batches =  $this->db_model->select_data('batch_name','batches use index (id)','id in ('.$teach['teach_batch'].')');
                        $batch = [];
                        for($i=0; $i<count($batches); $i++){
                            $batch[$i] = $batches[$i]['batch_name'];
                        }
                        $newBatch = implode(', ',$batch);
                    }
                    
                    if(!empty($teach['teach_subject'])){
                        $teach_subject_string =implode(",",json_decode($teach['teach_subject']));
                        $subjects =  $this->db_model->select_data('subject_name','subjects use index (id)','id in ('.$teach_subject_string.')');
                        $subject = [];
                        for($i=0; $i<count($subjects); $i++){
                            $subject[$i] = $subjects[$i]['subject_name'];
                        }
                        $newSubj = implode(',',$subject);
                    }
                    
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$teach['id'].'">',
                                $count,
                                $image.$teach['name'],
                                '<p class="email">'.$teach['email'].'</p>',
                                $teach['teach_education'],
                                $teach['teach_gender'],
                                $newBatch,
                                $newSubj,
                                $statusDrop,
                                $action,
                                $added_by
                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('users use index (id)',$cond,'','',$like,'','');
    
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
    function add_teacher(){
     
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                if(!empty($this->input->post('teacher_id',TRUE))){
                    if(!empty($data_arr['password'])){
                        $data_arr['password'] = md5($data_arr['password']);
                    }else{
                        unset($data_arr['password']);
                    }
    
                    if(isset($_FILES['teach_image']) && !empty($_FILES['teach_image']['name'])){
                        $image = $this->upload_media($_FILES,'uploads/teachers/','teach_image');
                        if(is_array($image)){
                            $resp = array('status'=>'2', 'msg' => $image['msg']);
                            die();
                        }else{
                            $data_arr['teach_image'] = $image;
                        }
                    }
    
                    $id = $data_arr['teacher_id'];
                    unset($data_arr['teacher_id']);
                    $data_arr['teach_subject'] = json_encode($data_arr['teach_subject']);
                        $data_arr['admin_id'] =$this->session->userdata('uid') ;
                        $access_data['academics'] = $this->input->post('academics',TRUE);
                        $access_data['live_class'] = $this->input->post('live_class',TRUE);
                        $access_data['notice'] = $this->input->post('notice',TRUE);
                        $access_data['assignment'] = $this->input->post('assignment',TRUE);
                        $access_data['extraclasses'] = $this->input->post('extraclasses',TRUE);
                        $access_data['doubtsask'] = $this->input->post('doubtsask',TRUE);
                        $access_data['video_lecture'] = $this->input->post('video_lecture',TRUE);
                        $access_data['question_manager'] = $this->input->post('question_manager',TRUE);
                        $access_data['course_content'] = $this->input->post('course_content',TRUE);
                        $access_data['student_leave'] = $this->input->post('student_leave',TRUE);
                        $access_data['student_manage'] = $this->input->post('student_manage',TRUE);
                        $access_data['exam'] = $this->input->post('exam',TRUE);
                       
                        $data_arr['access'] = json_encode($access_data);
                        
                        unset($data_arr['academics']);
                        unset($data_arr['live_class']);
                        unset($data_arr['notice']);
                        unset($data_arr['assignment']);
                        unset($data_arr['extraclasses']);
                        unset($data_arr['doubtsask']);
                        unset($data_arr['video_lecture']);
                        unset($data_arr['course_content']);
                        unset($data_arr['question_manager']);
                        unset($data_arr['exam']);
                        unset($data_arr['student_leave']);
                        unset($data_arr['student_manage']);
                        
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->update_data_limit('users',$data_arr,array('id'=>$id),1);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>'Teacher updated sucessfully.');
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    $prevData =  $this->db_model->select_data('id','users use index (id)',array('email'=>$data_arr['email'],'role'=>3),1);
                    $prevDataStu =  $this->db_model->select_data('id','students use index (id)',array('email'=>$data_arr['email'],'admin_id'=>$this->session->userdata('uid')),1);
                    if(empty($prevData) && empty($prevDataStu)){
                        unset($data_arr['teacher_id']);
                        $data_arr['parent_id'] = $this->session->userdata('uid');   
                        $data_arr['password'] = md5($data_arr['password']); 
                        $data_arr['teach_subject'] = json_encode($data_arr['teach_subject']);
                        $data_arr['role'] = 3;
                        $data_arr['status'] = 1;
                        $data_arr['admin_id'] =$this->session->userdata('uid') ;
                        if(isset($_FILES['teach_image']) && !empty($_FILES['teach_image']['name'])){
                            $image = $this->upload_media($_FILES,'uploads/teachers/','teach_image');
                            if(is_array($image)){
                                $resp = array('status'=>'2', 'msg' => $image['msg']);
                                die();
                            }else{
                                $data_arr['teach_image'] = $image;
                            }
                        }
                        
                        // $access_data['academics'] = $this->input->post('academics',TRUE);
                        $access_data['live_class'] = $this->input->post('live_class',TRUE);
                        $access_data['notice'] = $this->input->post('notice',TRUE);
                        $access_data['assignment'] = $this->input->post('assignment',TRUE);
                        $access_data['extraclasses'] = $this->input->post('extraclasses',TRUE);
                        $access_data['doubtsask'] = $this->input->post('doubtsask',TRUE);
                        $access_data['video_lecture'] = $this->input->post('video_lecture',TRUE);
                        $access_data['course_content'] = $this->input->post('course_content',TRUE);
                        $access_data['question_manager'] = $this->input->post('question_manager',TRUE);
                        $access_data['student_leave'] = $this->input->post('student_leave',TRUE);
                        $access_data['student_manage'] = $this->input->post('student_manage',TRUE);
                        $access_data['exam'] = $this->input->post('exam',TRUE);
                       
                        $data_arr['access'] = json_encode($access_data);
                        
                        // unset($data_arr['academics']);
                        unset($data_arr['live_class']);
                        unset($data_arr['notice']);
                        unset($data_arr['assignment']);
                        unset($data_arr['extraclasses']);
                        unset($data_arr['doubtsask']);
                        unset($data_arr['video_lecture']);
                        unset($data_arr['course_content']);
                        unset($data_arr['question_manager']);
                        unset($data_arr['exam']);
                        unset($data_arr['student_leave']);
                        unset($data_arr['student_manage']);
                       
                        $data_arr = $this->security->xss_clean($data_arr);
                        $ins = $this->db_model->insert_data('users',$data_arr);               
                        if($ins==true){
                            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_teacher_added_msg'));
                        }else{
                            $resp = array('status'=>0);
                        }
                    }else{
                        $resp = array('status'=>2,'msg'=> $this->lang->line('ltr_email_already_msg'));
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
 
    // function add_teacher(){
      
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         if(!empty($this->input->post('name',TRUE))){
    //             $data_arr = $this->input->post(NULL,TRUE);
    //             if(!empty($this->input->post('teacher_id',TRUE))){
    //                 if(!empty($data_arr['password'])){
    //                     $data_arr1['password'] = md5($data_arr['password']);
    //                 }else{
    //                     unset($data_arr1['password']);
    //                 }
    
    //                 if(isset($_FILES['teach_image']) && !empty($_FILES['teach_image']['name'])){
    //                     $image = $this->upload_media($_FILES,'uploads/teachers/','teach_image');
    //                     if(is_array($image)){
    //                         $resp = array('status'=>'2', 'msg' => $image['msg']);
    //                         die();
    //                     }else{
    //                         $data_arr1['teach_image'] = $image;
    //                     }
    //                 }
                    
                    
    //                 unset($data_arr['teacher_id']);
    //                 $data_arr['teach_subject'] = json_encode($data_arr['teach_subject']);
                    
    //                     $access_data['academics'] = $this->input->post('academics',TRUE);
    //                     $access_data['live_class'] = $this->input->post('live_class',TRUE);
    //                     $access_data['notice'] = $this->input->post('notice',TRUE);
    //                     $access_data['assignment'] = $this->input->post('assignment',TRUE);
    //                     $access_data['extraclasses'] = $this->input->post('extraclasses',TRUE);
    //                     $access_data['doubtsask'] = $this->input->post('doubtsask',TRUE);
    //                     $access_data['video_lecture'] = $this->input->post('video_lecture',TRUE);
    //                     $access_data['question_manager'] = $this->input->post('question_manager',TRUE);
    //                     $access_data['course_content'] = $this->input->post('course_content',TRUE);
    //                     $access_data['manage_s_leave'] = $this->input->post('student_leave',TRUE); 
    //                     $access_data['exam'] = $this->input->post('exam',TRUE);
                       
    //                     $data_arr1['access'] = json_encode($access_data);
                        
    //                     unset($data_arr['academics']);
    //                     unset($data_arr['live_class']);
    //                     unset($data_arr['notice']);
    //                     unset($data_arr['assignment']);
    //                     unset($data_arr['extraclasses']);
    //                     unset($data_arr['doubtsask']);
    //                     unset($data_arr['video_lecture']);
    //                     unset($data_arr['course_content']);
    //                     unset($data_arr['question_manager']);
    //                     unset($data_arr['exam']);
    //                     unset($data_arr['manage_s_leave']);
    //                     $data_arr1['name']  = $data_arr['name'];
    //                     $data_arr1['teach_gender']  = $data_arr['teach_gender'];
    //                     $data_arr1['email']  = $data_arr['email'];
    //                     $data_arr1['teach_education']  = $data_arr['teach_education'];
    //                     $data_arr1['password']  = $data_arr['password'];
    //                     $data_arr1['teach_subject']  = $data_arr['teach_subject'];                         
    //                     $id =$data_arr1['teacher_id'] =$data_arr['teacher_id'];
              
    //                 $data_arr = $this->security->xss_clean($data_arr1);
    //                         print_r($data_arr['teacher_id'] );
    //                die();
    //                 $ins = $this->db_model->update_data_limit('users',$data_arr,array('id'=>$id),1);
    //                 if($ins==true){
    //                     $resp = array('status'=>1,'msg'=>'Teacher updated sucessfully.');
    //                 }else{
    //                     $resp = array('status'=>0);
    //                 }
    //             }else{
    //                 $prevData =  $this->db_model->select_data('id','users use index (id)',array('email'=>$data_arr['email'],'role'=>3),1);
    //                 $prevDataStu =  $this->db_model->select_data('id','students use index (id)',array('email'=>$data_arr['email'],'admin_id'=>$this->session->userdata('uid')),1);
    //                 if(empty($prevData) && empty($prevDataStu)){
    //                     unset($data_arr['teacher_id']);
    //                     $data_arr['parent_id'] = $this->session->userdata('uid');   
    //                     $data_arr['password'] = md5($data_arr['password']); 
    //                     $data_arr['teach_subject'] = json_encode($data_arr['teach_subject']);
    //                     $data_arr['role'] = 3;
    //                     $data_arr['status'] = 1;
    
    //                     if(isset($_FILES['teach_image']) && !empty($_FILES['teach_image']['name'])){
    //                         $image = $this->upload_media($_FILES,'uploads/teachers/','teach_image');
    //                         if(is_array($image)){
    //                             $resp = array('status'=>'2', 'msg' => $image['msg']);
    //                             die();
    //                         }else{
    //                             $data_arr['teach_image'] = $image;
    //                         }
    //                     }
                        
    //                     $access_data['academics'] = $this->input->post('academics',TRUE);
    //                     $access_data['live_class'] = $this->input->post('live_class',TRUE);
    //                     $access_data['notice'] = $this->input->post('notice',TRUE);
    //                     $access_data['assignment'] = $this->input->post('assignment',TRUE);
    //                     $access_data['extraclasses'] = $this->input->post('extraclasses',TRUE);
    //                     $access_data['doubtsask'] = $this->input->post('doubtsask',TRUE);
    //                     $access_data['video_lecture'] = $this->input->post('video_lecture',TRUE);
    //                     $access_data['course_content'] = $this->input->post('course_content',TRUE);
    //                     $access_data['question_manager'] = $this->input->post('question_manager',TRUE);
    //                      $access_data['manage_s_leave'] = $this->input->post('student_leave',TRUE); 
    //                     $access_data['exam'] = $this->input->post('exam',TRUE);
                       
    //                     $data_arr['access'] = json_encode($access_data);
                        
    //                     unset($data_arr['academics']);
    //                     unset($data_arr['live_class']);
    //                     unset($data_arr['notice']);
    //                     unset($data_arr['assignment']);
    //                     unset($data_arr['extraclasses']);
    //                     unset($data_arr['doubtsask']);
    //                     unset($data_arr['video_lecture']);
    //                     unset($data_arr['course_content']);
    //                     unset($data_arr['question_manager']);
    //                     unset($data_arr['exam']);
    //                      unset($data_arr['manage_s_leave']);
                       
    //                     $data_arr = $this->security->xss_clean($data_arr);
    //                     $ins = $this->db_model->insert_data('users',$data_arr);               
    //                     if($ins==true){
    //                         $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_teacher_added_msg'));
    //                     }else{
    //                         $resp = array('status'=>0);
    //                     }
    //                 }else{
    //                     $resp = array('status'=>2,'msg'=> $this->lang->line('ltr_email_already_msg'));
    //                 }
    //             }
    //             echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //         } 
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     }
    // } 
    function extraclass_table(){
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
                $like = array('description',$post['search']['value']);
            }else{
               $like = ''; 
            }
    
            if($this->session->userdata('role')==1 && $this->session->userdata('super_admin')==1){
                 $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else  if($this->session->userdata('role')==1 && $this->session->userdata('super_admin')==0){
                 $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else {
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'));
            }
        
           
            if(isset($get['teacher']) || isset($get['status'])){
                if($get['teacher']!='' && $get['status']!=''){
                    $cond['status'] = $get['status'];   
                    $cond['teacher_id'] = $get['teacher'];
                }else if($get['teacher']!=''){
                    $cond['teacher_id'] = $get['teacher'];
                }else if($get['status']!=''){
                    $cond['status'] = $get['status'];
                }
            }
  
            $classes = $this->db_model->select_data('*','extra_classes use index (id)',$cond,$limit,array('id','desc'),$like,'','');
            if(!empty($classes)){
                
                foreach($classes as $cls){
                   $descriptionWord =$this->readMoreWord($cls['description'], $this->lang->line('ltr_description'));
                    $teacher =  $this->db_model->select_data('name','users use index (id)', array('id'=>$cls['teacher_id']),1)[0]['name'];
                  $d="'".$cls['batch_id']."'";
                    if($this->session->userdata('role')==1){
                        $action = '<p class="actions_wrap"><a class="edit_extraclass btn_edit" title="Edit" data-id="'.$cls['id'].'" data-teacher="'.$cls['teacher_id'].'" data-batch='.$d.'><i class="fa fa-edit"></i></a>
                            <a class="deleteData btn_delete" title="Delete" data-id="'.$cls['id'].'" data-table="extra_classes"><i class="fa fa-trash"></i></a></p>';
                            if($cls['status']=="Complete"){
                                $complete_date=date('d-m-Y h:i A',strtotime($cls['completed_date_time']));
                            }else{
                                $complete_date="";
                            }
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$cls['id'].'">',
                            $count,
                            date('d-m-Y',strtotime($cls['date'])),
                            date('h:i A',strtotime($cls['start_time'])).' - '.date('h:i A',strtotime($cls['end_time'])),
                            '<p class="descParaCls">'.$descriptionWord.'</p>',
                            $teacher,
                            $cls['status'],
                            $complete_date,
                            $action
                            
                        ); 
                    }else{
                        if($cls['date'] == date('Y-m-d') && $cls['status'] == 'Incomplete'){
                            $statusDrop = '<input type="checkbox" value="Complete" data-id="'.$cls['id'].'" class="extraClsCmplete">Mark as Complete';
                           
                        }else{
                            $statusDrop = '<p class="button_disbled_cursor actions_wrap"><a class="btn_edit"><i class="fa fa-edit disabled"></i></a>
                            <a class="btn_delete"><i class="fa fa-trash disabled"></i></a></p>';
                        }           
                        if($cls['status']=="Complete"){
                                $complete_date=date('d-m-Y h:i A',strtotime($cls['completed_date_time']));
                            }else{
                                $complete_date="";
                            }
                        $dataarray[] = array(
                            $count,
                            date('d-m-Y',strtotime($cls['date'])),
                            date('h:i A',strtotime($cls['start_time'])).' - '.date('h:i A',strtotime($cls['end_time'])),
                            '<p class="descParaCls">'.$descriptionWord.'</p>',
                            $cls['status'],
                            $complete_date,
                            $statusDrop,
                        ); 
                    }
    
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

    function add_extracls(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('date',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                //print_r($this->input->post(NULL,TRUE));
                if(!empty($this->input->post('edit_id',TRUE))){
                    $id = $data_arr['edit_id'];
                    unset($data_arr['edit_id']);
                    $data_arr['batch_id']=json_encode($data_arr['batch_id']);
                    $data_arr['date'] = date('Y-m-d',strtotime($data_arr['date']));
                    $data_arr['start_time'] = date('H:i:s',strtotime($data_arr['start_time']));
                    $data_arr['end_time'] = date('H:i:s',strtotime($data_arr['end_time']));
                    $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                    
                    $start_time =$data_arr['start_time'];
                    $end_time =$data_arr['end_time'];
                    $date = $data_arr['date'];
                    $idt = $this->input->post('teacher_id');
                    $cond = "(start_time <= CAST('$start_time' AS time) AND end_time >= CAST('end_time' AS time)) AND date = '$date' AND teacher_id = '$idt' AND id !='$id'";
                    $sem_time_teacher = $this->db_model->select_data('id','extra_classes use index (id)', $cond,1);
                    if((strtotime($data_arr['start_time'])) ==(strtotime($data_arr['end_time']))){
                        $resp = array('status'=>3);
                    }else{
                        if(empty($sem_time_teacher)){
                            $data_arr = $this->security->xss_clean($data_arr);
                            $ins = $this->db_model->update_data_limit('extra_classes',$data_arr,array('id'=>$id),1);
                            if($ins==true){
                                $resp = array('status'=>1,'msg'=>'Class updated sucessfully.');
                            }else{
                                $resp = array('status'=>0);
                            }
                        }else{
                            $resp = array('status'=>2);
                        }
                    }
                }else{
                    unset($data_arr['edit_id']);
                    $batch_aray= $this->input->post('batch_id[]');
                    $batch_id=implode(",",$batch_aray);
                    $data_arr['batch_id']=json_encode($data_arr['batch_id']);
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                    $data_arr['date'] = date('Y-m-d',strtotime($data_arr['date']));
                    $data_arr['start_time'] = date('H:i:s',strtotime($data_arr['start_time']));
                    $data_arr['end_time'] = date('H:i:s',strtotime($data_arr['end_time'])); 
                    $data_arr['status'] = 'Incomplete';
                    $data_arr['added_at'] = date('Y-m-d H:i:s');
                    
                    $start_time =$data_arr['start_time'];
                    $end_time =$data_arr['end_time'];
                    $date = $data_arr['date'];
                    $id = $this->input->post('teacher_id');
                    $cond = "(start_time <= CAST('$start_time' AS time) AND end_time >= CAST('end_time' AS time)) AND date = '$date' AND teacher_id = '$id'";
                    $sem_time_teacher = $this->db_model->select_data('id','extra_classes use index (id)', $cond,1);
                    if((strtotime($data_arr['start_time'])) ==(strtotime($data_arr['end_time']))){
                        $resp = array('status'=>3,'data'=> $batch_id);
                    }else{
                        if(empty($sem_time_teacher)){
                            $data_arr = $this->security->xss_clean($data_arr);
                            $ins = $this->db_model->insert_data('extra_classes',$data_arr);  
                            
                            if($ins==true){
                                $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_class_updated_msg'));
                                $title ="View extra class";
                                $where ="extraclasses";
                                
                            $data['batch_id'] = $batch_id;
                            $data['notification_type'] =  'Extra-class';
                            $data['msg'] = 'New ExtraClass Added';
                            $data['url'] = 'student/extra-classes';
                            $data['time'] = date('Y-m-d H:i:s');
                            $data['seen_by'] = '';
                            $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $data['batch_id'],'status'=>'1'));
                                for($i=0;$i<count($student_data);$i++){
                                    $data['student_id'] = $student_data[$i]['id'];
                                    $extra_not = $this->db_model->insert_data('notifications',$data);     
                      }
                                if(!empty($batch_id)){
                                    $this->push_notification_android($batch_id,$title,$where);
                                }
                            }else{
                                $resp = array('status'=>0,'data'=> $batch_id);
                            }
                        }else{
                            $resp = array('status'=>2,'data'=> $batch_id);
                        }
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function change_extraCls_status(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $ins = $this->db_model->update_Data_limit('extra_classes',$this->security->xss_clean(array('status'=>'Complete','completed_date_time'=>date('Y-m-d H:i:s'))),array('id'=>$this->input->post('id',TRUE)));
                if($ins){
                    $resp = array('status'=>1);
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    /********   Teacher Manage End   ********/
    /********   Exam Manage Start   ********/

    // function exam_table(){
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
    //         if(isset($get['admin'])){
    //             if($get['admin']!=''){   
    //                 $like = array('admin_id',$get['admin']); 
    //             }
    //         }
              
    //         if($this->session->userdata('role')==1){
    //             $cond = array('admin_id'=>$this->session->userdata('uid'));
    //             //  $cond ="";
    //             //  $btchcond ="";
    //             $btchcond = array('admin_id'=>$this->session->userdata('uid'));
    //         }else {
    //             $cond = array('admin_id'=>$this->session->userdata('uid'),'batch_id'=>$this->session->userdata('batch_id'));
    //              $admin_id = $this->session->userdata('admin_id');
    //             $batch_id = $this->session->userdata('batch_id');
    //             // if(!empty($batch_id)){
    //             //     $cond = "admin_id = $admin_id AND batch_id in ($batch_id)";
    //             // }
    //             $btchcond = "admin_id = $admin_id AND id in ($batch_id)";
    //         }
            
    //         $all_exams = $this->db_model->select_data('*','exams use index (id)',$cond,$limit,array('id','desc'),$like,'','');
    //         // if(!empty($cond)){
    //         //     $all_exams = $this->db_model->select_data('*','exams use index (id)',$cond,$limit,array('id','desc'),$like,'','');
    //         // }else{
    //         //     $all_exams = '';
    //         // }

    //         if(!empty($all_exams)){
    //             $batch_array = $this->db_model->select_data('id,batch_name','batches use index (id)',$btchcond);
                  
    //             foreach($all_exams as $exam){
                    
    //                 if($exam['status'] == 1){
    //                     $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$exam['id'].'" data-table ="exams" data-status ="0" href="javascript:;"> Active </a></div>';
    //                 }else{
    //                     $statusDrop = '<div class="admin_tbl_status_wrap">
    //                 <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$exam['id'].'" data-table ="exams" data-status ="1" href="javascript:;"> Inactive </a></div>';
    //                 }
                    
    //                 $batchData = '';
    //                 if(!empty($batch_array)){
    //                     foreach($batch_array as $batch){
    //                         if($exam['batch_id'] == $batch['id']){
                                
    //                             $batchData = $batch['batch_name'];
    //                         }
    //                     }
    //                 }   
    
    //                 $date = '';
    //                 if($exam['mock_sheduled_date'] != '0000-00-00'){
    //                     $date = date('d-m-Y',strtotime($exam['mock_sheduled_date']));
    //                 }
    //                 $time = '';
    //                 if($exam['mock_sheduled_time'] != '00:00:00'){
    //                     $time = date('h:i A',strtotime($exam['mock_sheduled_time']));
    //                 }

    //                 $added_Data = $this->db_model->select_data('*','users use index (id)',array('id'=>$exam['added_by']));
                   
    //                 // print_r($added_Data);
    //                 if($added_Data){
    //                  if($added_Data[0]['admin_id']==1 && $added_Data[0]['super_admin'] == 1)
    //                  {
    //                      $added_by= $added_Data[0]['name']."  (Super Admin) ";
    //                  }else if($added_Data[0]['admin_id']==1 && $added_Data[0]['super_admin'] == 0 && $added_Data[0]['role'] == 1){
    //                      $added_by = $added_Data[0]['name']."  (Sub-Admin)";
    //                  }else{
    //                      $added_by = $added_Data[0]['name']."  (Teacher)";
    //                  }
    //                  // $added_by = $name[0]['name'];
    //                  }else{
    //                      $added_by = '';
    //                  }
				// 	$mockkp = $this->lang->line('ltr_mock_test_paper');
				// 	$prakkp = $this->lang->line('ltr_practice_paper');
    //                 if($this->session->userdata('role')==1){
    //                 //   if($_SESSION['admin_id']!=$exam['added_by']){
    //                     $action = '<p class="actions_wrap"><a href="'.base_url('admin/view-paper/'.$exam['id']).'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>
    //                     <a class="deleteData btn_delete" title="Delete" data-id="'.$exam['id'].'" data-table="exams"><i class="fa fa-trash"></i></a></p>';
    //                     if($exam['format'] == 1){
    //                         $format ="Shuffle";
    //                     }else{
    //                         $format ="Fix";
    //                     }
                        
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$exam['id'].'">',
    //                         $count,
    //                         (($exam['type'] == 1)?$mockkp:$prakkp),
    //                         $exam['name'],
    //                         $exam['total_question'],
    //                         $exam['time_duration'],
    //                         $format,
    //                         $batchData,
    //                         $date,
    //                         $time,
    //                         $added_by,
    //                         //$statusDrop,
    //                         $action
    //                     ); 
    //                 }else{
    //                 //   print_r($_SESSION);
    //                   print_r($exam['added_by']);
    //                     if($exam['added_by'] == $this->session->userdata('admin_id')){
    //                         $action = '<p class="actions_wrap"><a href="'.base_url('teacher/view-paper/'.$exam['id']).'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>
    //                         <a class="deleteData btn_delete" title="Delete" data-id="'.$exam['id'].'" data-table="exams"><i class="fa fa-trash"></i></a></p>';
    //                         if($exam['format'] == 1){
    //                         $format ="Shuffle";
    //                         }else{
    //                             $format ="Fix";
    //                         }
    //                         $batchData = $batchData;
    //                         $statusDrop = $statusDrop;
    //                     }else{
    //                         $action = '<p class="actions_wrap"><a href="'.base_url('teacher/view-paper/'.$exam['id']).'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a></p>';

    //                         if($exam['format'] == 1){
    //                         $format ="Shuffle";
    //                         }else{
    //                             $format ="Fix";
    //                         }
    //                         $batchData =$batchData;
				// 			$ac = $this->lang->line('ltr_active');
				// 		    $iac = $this->lang->line('ltr_inactive');
    //                         $statusDrop = (($exam['status'] == 1) ? $ac:$iac);
    //                     }
                        
    
    //                     $dataarray[] = array(
    //                         $count,
    //                         (($exam['type'] == 1)? $mockkp :$prakkp),
    //                         $exam['name'],
    //                         $exam['total_question'],
    //                         $exam['time_duration'],
    //                         $format,
    //                         $batchData,
    //                         $date,
    //                         $time,
    //                         $added_by,
    //                         //$statusDrop,
    //                         $action
    //                     ); 
    //                 }
    
    //                 $count++;
    //             }
    //             $recordsTotal = $this->db_model->countAll('exams use index (id)',$cond,'','',$like,'','');
    //             // if($cond)
    //             //     $recordsTotal = $this->db_model->countAll('exams use index (id)',$cond,'','',$like,'','');
    //             // else
    //             //     $recordsTotal = 0;
    
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
  function exam_table(){
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
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
              
            // if($this->session->userdata('role')==1){
            //     $cond = array('admin_id'=>$this->session->userdata('uid'));
            //     //  $cond ="";
            //     //  $btchcond ="";
            //     $btchcond = array('admin_id'=>$this->session->userdata('uid'));
            // }else{
            //     $admin_id = $this->session->userdata('admin_id');
            //     $batch_id = $this->session->userdata('batch_id');
            //     if(!empty($batch_id)){
            //         $cond = "admin_id = $admin_id AND batch_id in ($batch_id)";
            //     }
            //     $btchcond = "admin_id = $admin_id AND id in ($batch_id)";
            // }
            if($this->session->userdata('role')==1 &&  $this->session->userdata('super_admin')==1){
                // $cond = array('admin_id'=>$this->session->userdata('uid'));
                //  $cond = "admin_id = $admin_id"; 
                $cond ="";
                $btchcond = "";
            }else if($this->session->userdata('admin_id')==1 &&  $this->session->userdata('super_admin')==0){
                 $cond ="";
                // print_r($_SESSION);
                 $admin_id = $this->session->userdata('uid');
                //  $cond = "admin_id = $admin_id"; 
                 
            }else{
                $admin_id = $this->session->userdata('uid');
                $batch_id = $this->session->userdata('batch_id');
                if(!empty($batch_id)){
                    $cond = "admin_id = $admin_id AND batch_id in ($batch_id)";
                }
                $btchcond = "admin_id = $admin_id AND id in ($batch_id)";
            }
            // die();
            $all_exams = $this->db_model->select_data('*','exams use index (id)',$cond,$limit,array('id','desc'),$like,'','');
            // print_r($cond);
            // dies();
            if(!empty($all_exams)){
                $batch_array = $this->db_model->select_data('id,batch_name','batches use index (id)',$btchcond);
                  
                foreach($all_exams as $exam){
                    
                    if($exam['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$exam['id'].'" data-table ="exams" data-status ="0" href="javascript:;"> Active </a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$exam['id'].'" data-table ="exams" data-status ="1" href="javascript:;"> Inactive </a></div>';
                    }
                    
                    $batchData = '';
                    if(!empty($batch_array)){
                        foreach($batch_array as $batch){
                            if($exam['batch_id'] == $batch['id']){
                                
                                $batchData = $batch['batch_name'];
                            }
                        }
                    }   
    
                    $date = '';
                    if($exam['mock_sheduled_date'] != '0000-00-00'){
                        $date = date('d-m-Y',strtotime($exam['mock_sheduled_date']));
                    }
                    $time = '';
                    if($exam['mock_sheduled_time'] != '00:00:00'){
                        $time = date('h:i A',strtotime($exam['mock_sheduled_time']));
                    }

                    $added_Data = $this->db_model->select_data('*','users use index (id)',array('id'=>$exam['added_by']));
                    
                    if($added_Data){
                     if($added_Data[0]['admin_id']==1 && $added_Data[0]['super_admin'] == 1)
                     {
                         $added_by= $added_Data[0]['name']."  (Super Admin) ";
                     }else{
                         $added_by = $added_Data[0]['name']."  (Sub-Admin)";
                     }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
					$mockkp = $this->lang->line('ltr_mock_test_paper');
					$prakkp = $this->lang->line('ltr_practice_paper');
                    if($this->session->userdata('role')==1){
                       
                        $action = '<p class="actions_wrap"><a href="'.base_url('admin/view-paper/'.$exam['id']).'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>
                        <a class="deleteData btn_delete" title="Delete" data-id="'.$exam['id'].'" data-table="exams"><i class="fa fa-trash"></i></a></p>';
                        if($exam['format'] == 1){
                            $format ="Shuffle";
                        }else{
                            $format ="Fix";
                        }
                        
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$exam['id'].'">',
                            $count,
                            (($exam['type'] == 1)?$mockkp:$prakkp),
                            $exam['name'],
                            $exam['total_question'],
                            $exam['time_duration'],
                            $format,
                            $batchData,
                            $date,
                            $time,
                            $added_by,
                            //$statusDrop,
                            $action
                        ); 
                    }else{
                       
                        if($exam['added_by'] == $this->session->userdata('admin_id')){
                            $action = '<p class="actions_wrap"><a href="'.base_url('teacher/view-paper/'.$exam['id']).'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>
                            <a class="deleteData btn_delete" title="Delete" data-id="'.$exam['id'].'" data-table="exams"><i class="fa fa-trash"></i></a></p>';
                            if($exam['format'] == 1){
                            $format ="Shuffle";
                            }else{
                                $format ="Fix";
                            }
                            $batchData = $batchData;
                            $statusDrop = $statusDrop;
                        }else{
                            $action = '<p class="actions_wrap"><a href="'.base_url('teacher/view-paper/'.$exam['id']).'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a></p>';

                            if($exam['format'] == 1){
                            $format ="Shuffle";
                            }else{
                                $format ="Fix";
                            }
                            $batchData =$batchData;
							$ac = $this->lang->line('ltr_active');
						    $iac = $this->lang->line('ltr_inactive');
                            $statusDrop = (($exam['status'] == 1) ? $ac:$iac);
                        }
                        
    
                        $dataarray[] = array(
                            $count,
                            (($exam['type'] == 1)? $mockkp :$prakkp),
                            $exam['name'],
                            $exam['total_question'],
                            $exam['time_duration'],
                            $format,
                            $batchData,
                            $date,
                            $time,
                            $added_by,
                            //$statusDrop,
                            $action
                        ); 
                    }
    
                    $count++;
                }
                $recordsTotal = $this->db_model->countAll('exams use index (id)',$cond,'','',$like,'','');
                // if($cond)
                //     $recordsTotal = $this->db_model->countAll('exams use index (id)',$cond,'','',$like,'','');
                // else
                //     $recordsTotal = 0;
    
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

    function add_exam_paper(){
       
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                if($this->session->userdata('role')==1)
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                else
                    $data_arr['admin_id'] = $this->session->userdata('uid');

                if($this->input->post('type',TRUE) == 1){
                    $data_arr['mock_sheduled_date'] = date('Y-m-d',strtotime($data_arr['mock_sheduled_date']));
                    $data_arr['mock_sheduled_time'] = date('H:i:s',strtotime($data_arr['mock_sheduled_time']));
                  
                    $admin_id = $this->session->userdata('uid');        
                    
                    $cond = array('type'=>$this->input->post('type',TRUE),'mock_sheduled_date'=>$data_arr['mock_sheduled_date'],'mock_sheduled_time'=>$data_arr['mock_sheduled_time'],'batch_id'=>$this->input->post('batch_id',TRUE),'admin_id'=>$admin_id,'status'=>1);
    
                    $prevData = $this->db_model->select_data('id','exams use index (id)',$cond,1);
                }else{
                    $data_arr['mock_sheduled_date'] = '';
                    $data_arr['mock_sheduled_time'] = '';
                    $prevData = array();
                }
    
                $data_arr['status'] = 1;
                $data_arr['format'] = 1;
                $data_arr['added_at'] = date('Y-m-d H:i:s');
                $data_arr['added_by'] = $this->session->userdata('uid');
                if($this->session->userdata('role') == 1){
                    $profile = 'admin';
                }else{
                    $profile = 'teacher';
                }
                if(empty($prevData)){
        //              print_r($data_arr);
        // die();
        //             $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->insert_data('exams',$data_arr);               
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_paper_added_msg'),'url'=>base_url($profile.'/exam-manage'));
                        
                        $batch_id = $this->input->post('batch_id',TRUE);
                        $paper_type =$this->input->post('type',TRUE);
                        
                        if($paper_type==1){
                            $title =$this->lang->line('ltr_view_mock_paper');
                            $where ="mock_test";
                            
                            // notification
                            
                        $data['batch_id'] = $batch_id;
                        $data['notification_type'] = "Exam";
                        $data['msg'] = 'New Mock Paper Added';
                        $data['url'] = 'student/mock-paper';
                        $data['time'] = date('Y-m-d H:i:s');
                        $data['seen_by'] = '';
                         $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $data['batch_id'],'status'=>'1'));
                      for($i=0;$i<count($student_data);$i++){
                      $data['student_id'] = $student_data[$i]['id'];
                        $exam_not = $this->db_model->insert_data('notifications',$data);  
                      } 
                            
                        }else{
                            $title =$this->lang->line('ltr_view_practice_paper');
                            $where ="practice";
                            
                             // notification
                            
                        $data['batch_id'] = $batch_id;
                        $data['notification_type'] = "Exam";
                        $data['msg'] = 'New Practice Paper Added';
                        $data['url'] = 'student/practice-paper';
                        $data['time'] = date('Y-m-d H:i:s');
                         $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $data['batch_id'],'status'=>'1'));
                      for($i=0;$i<count($student_data);$i++){
                      $data['student_id'] = $student_data[$i]['id'];
                        $exam_not = $this->db_model->insert_data('notifications',$data);  
                      }
                        }
                        if(!empty($batch_id)){
                            $this->push_notification_android($batch_id,$title,$where);
                        }
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    $resp = array('status'=>2,'msg'=>$this->lang->line('ltr_add_paper_already_msg'));
                }
                
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    /********   Exam Manage End   ********/
    /********   Result Manage Start   ********/

    // function result_table($type){
       
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
            
    //         if($type == 'practice'){
    //             $table_name = 'practice_result';
    //         }else{
    //             $table_name = 'mock_result';
    //         }
        
    //         if($post['search']['value'] != ''){
    //             $join_array = array('students',"students.name like '%".$post['search']['value']."%' AND students.id = $table_name.student_id");
    //         }else{
    //           $join_array = array('students',"students.id = $table_name.student_id");
    //         }
            
    //         $cond = '';
    //         $role = $this->session->userdata('role');
    //         if($role == '1'){
    //             $cond = array("$table_name.admin_id"=>$this->session->userdata('uid'));
    //         }else{
    //             $admin_id = $this->session->userdata('admin_id');
    //             $batch_id = $this->session->userdata('batch_id');
    //             if(!empty($batch_id)){
    //               $or_like = array(array('students.batch_id',implode(",",$batch_id)));
    //                 //$cond = $table_name.".admin_id = $admin_id AND students.batch_id like IN ($batch_id)";
    //                 $cond = $table_name.".admin_id = $admin_id";
    //             }else{
    //                 $cond = '';
    //             }
    //         }
    //         $like = '';
    //         if(isset($get['month']) || isset($get['year'])){
    //             if($get['month']!='' && $get['year']!=''){ 
    //                 $datefiltr = $get['year'].'-'.$get['month'];
    //                 $like = array('date',$datefiltr);  
    //             }
    //         }
    
    //         if(isset($get['paper'])){
    //             if($get['paper']!=''){
    //                 $cond[$table_name.'.paper_id'] = $get['paper'];  
    //             }
    //         }
    //         if(isset($get['batch_id'])){
    //             if($get['batch_id']!=''){
    //                 $cond['students.batch_id'] = $get['batch_id'];  
    //             }
    //         }
    
    //         if($role == 1){
    //             $profile = 'admin';
    //         }else if($role == 3){
    //             $profile = 'teacher';
    //         }
            
    //         if(!empty($cond)){
    //             // $result_data = $this->db_model->select_data("$table_name.*,students.name,students.image,students.enrollment_id", $table_name.' use index (id)',$cond,$limit,array("$table_name.id",'desc'),$like,$join_array);
    //               $result_data = $this->db_model->select_data("$table_name.*,students.name,students.image,students.enrollment_id", $table_name.' use index (id)',$cond,$limit,array("$table_name.id",'desc'),$like,$join_array,'',$or_like);
    //         }else{
    //             $result_data = ''; 
    //         }
    //         //echo $this->db->last_query();
    //         if(!empty($result_data)){
    //             foreach($result_data as $result){
                   
    //                 if (!empty($result['image'])){ 
    //                     $image = '<img src="'.base_url().'uploads/students/'.$result['image'].'" title="'.$result['name'].'" class="view_large_image"></a>';
    //                 }else{
    //                     $image = '';
    //                 }
    
    //                 $attemptedQuestion = json_decode($result['question_answer'],true);
    //                 $rightCount = 0;
    //                 $wrongCount = 0;
    //                 if(!empty($attemptedQuestion)){
    //                 foreach($attemptedQuestion as $key=>$value){
    //                         $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key));
    //                         if(!empty($right_ansrs)){
    //                             if(($key == $right_ansrs[0]['id']) && ($value == $right_ansrs[0]['answer'])){
    //                                 $rightCount++;
    //                             }else{
    //                                 $wrongCount++;
    //                             }
    //                         }
    //                 }
    //             }
                    
                    
    //                 $percData = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
    //                 if($percData < 0){
    //                      $percentage = 0;
    //                 }else{
    //                      $percentage = $percData;
    //                 }
    //                 $url = base_url($profile.'/answer-sheet/'.$type.'/'.$result['id']);
                    
    //                 $action = '<p class="actions_wrap"><a href="'.$url.'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>';
    
    //                 if($role == '1'){
    //                     $action .= '<a class="deleteData btn_delete" title="Delete" data-id="'.$result['id'].'" data-table="'.$table_name.'"><i class="fa fa-trash"></i></a></p>';
    //                 }else{
    //                     $action .= '</p>';
    //                 }
                    
    //                 $time_taken = '';
    //                 if($result['start_time']!="" || $result['submit_time']!=""){
    //                     $stime=strtotime($result['start_time']);
    //                     $etime=strtotime($result['submit_time']);
    //                     $elapsed = $etime - $stime;
    //                     $time_taken = gmdate("h:i", $elapsed);
    //                 }

    //                 if($role == '1'){
    //                     $dataarray[] = array(
    //                     '<input type="checkbox" class="checkOneRow" value="'.$result['id'].'">',
    //                     $count,
    //                     $image.$result['name'],
    //                     $result['enrollment_id'],
    //                     $result['paper_name'],
    //                     date('d-m-Y',strtotime($result['date'])),
    //                     date('h:i A',strtotime($result['start_time'])),
    //                     date('h:i A',strtotime($result['submit_time'])),
    //                     $result['total_question'],
    //                     $result['attempted_question'],
    //                     gmdate("H:i", $result['time_duration']*60),
    //                     $time_taken,
    //                     $rightCount,
    //                     number_format((float)$percentage, 2, '.', ''),
    //                     $action,
    //                 ); 
                        
    //                 }else{
    //                     $dataarray[] = array(
                        
    //                     $count,
    //                     $image.$result['name'],
    //                     $result['enrollment_id'],
    //                     $result['paper_name'],
    //                     date('d-m-Y',strtotime($result['date'])),
    //                     date('h:i A',strtotime($result['start_time'])),
    //                     date('h:i A',strtotime($result['submit_time'])),
    //                     $result['total_question'],
    //                     $result['attempted_question'],
    //                     gmdate("H:i", $result['time_duration']*60),
    //                     $time_taken,
    //                     $rightCount,
    //                     number_format((float)$percentage, 2, '.', ''),
    //                     $action,
    //                 ); 
    //                 }
                    
                    
    //                 $count++;
    //             }
    
    //             if(!empty($cond))
    //                 $recordsTotal = $this->db_model->countAll($table_name.' use index (id)',$cond,'','','',$join_array);
    //             else 
    //                 $recordsTotal = 0;
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
// function result_table($type){
	
//         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
//             $post = $this->input->post(NULL,TRUE);
//             $get = $this->input->get(NULL,TRUE);
			
//             if(isset($post['length']) && $post['length']>0){
//                 if(isset($post['start']) && !empty($post['start'])){
//                     $limit = array($post['length'],$post['start']);
//                     $count = $post['start']+1;
//                 }else{ 
//                     $limit = array($post['length'],0);
//                     $count = 1;
//                 }
//             }else{
//                 $limit = '';
//                 $count = 1;
//             }
            
//             if($type == 'practice'){
//                 $table_name = 'practice_result';
//             }else{
//                 $table_name = 'mock_result';
//             }

//             if($post['search']['value'] != ''){
//                 $join_array = array('students',"students.name like '%".$post['search']['value']."%' AND students.id = $table_name.student_id");
//             }else{
//               $join_array = array('students',"students.id = $table_name.student_id");
// 				//$join_array = array('sudent_batchs ','sudent_batchs.student_id=students.id');
//             }
         
//             $cond = '';
//             $role = $this->session->userdata('role');
//             $s_admin = $this->session->userdata('super_admin');
//             if($role == '1' && $s_admin==1){
//                 // $cond = array("$table_name.admin_id"=>$this->session->userdata('uid'));
//                 $cond ="";
//             }else{
//                 $admin_id = $this->session->userdata('admin_id');
//                 $batch_id = $this->session->userdata('batch_id');
//                 if(!empty($batch_id)){
// 					$or_like = array(array('students.batch_id',implode(",",$batch_id)));
					
//                     //$cond = $table_name.".admin_id = $admin_id AND students.batch_id like IN ($batch_id)";
// 					$cond = $table_name.".admin_id = $admin_id";
// 					$cond ="";
//                 }else{
// 					$or_like = '';
//                     $cond = '';
//                 }
//             }
		
//             $like = '';
//             if(isset($get['month']) || isset($get['year'])){
//                 if($get['month']!='' && $get['year']!=''){ 
//                     $datefiltr = $get['year'].'-'.$get['month'];
//                     $like = array('date',$datefiltr);  
//                 }
//             }
    
//             if(isset($get['paper'])){
//                 if($get['paper']!=''){
//                     $cond[$table_name.'.paper_id'] = $get['paper'];  
//                 }
//             }
//             if(isset($get['batch_id'])){
//                 if($get['batch_id']!=''){
//                     $cond['students.batch_id'] = $get['batch_id'];  
//                 }
//             }
    
//             if($role == 1){
//                 $profile = 'admin';
//             }else if($role == 3){
//                 $profile = 'teacher';
//             }
        
//             if(!empty($cond)){
               
//                 $result_data = $this->db_model->select_data("$table_name.*,students.name,students.image,students.enrollment_id", $table_name.' use index (id)',$cond,$limit,array("$table_name.id",'desc'),$like,$join_array,'',$or_like);
// 				// $student_data = $this->db_model->select_data("$table_name.*,students.name,students.image,students.enrollment_id",'students use index (id)',$cond,$limit,array("$table_name.id",'desc'),$like,,$join_array,$or_like);
//             }else{
//                 $result_data = ''; 
//             }
//             // echo $this->db->last_query();
//             if(!empty($result_data)){
//                 foreach($result_data as $result){
                   
//                     if (!empty($result['image'])){ 
//                         $image = '<img src="'.base_url().'uploads/students/'.$result['image'].'" title="'.$result['name'].'" class="view_large_image"></a>';
//                     }else{
//                         $image = '';
//                     }
    
//                     $attemptedQuestion = json_decode($result['question_answer'],true);
//                     $rightCount = 0;
//                     $wrongCount = 0;
//                     if(!empty($attemptedQuestion)){
//                     foreach($attemptedQuestion as $key=>$value){
//                             $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key));
//                             if(!empty($right_ansrs)){
//                                 if(($key == $right_ansrs[0]['id']) && ($value == $right_ansrs[0]['answer'])){
//                                     $rightCount++;
//                                 }else{
//                                     $wrongCount++;
//                                 }
//                             }
//                     }
//                 }
                    
                    
//                     $percData = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
// 					if($percData < 0){
// 						$percentage = 0;
// 					}else{
// 						$percentage = $percData;
// 					}
//                     $url = base_url($profile.'/answer-sheet/'.$type.'/'.$result['id']);
                    
//                     $action = '<p class="actions_wrap"><a href="'.$url.'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>';
    
//                     if($role == '1'){
//                         $action .= '<a class="deleteData btn_delete" title="Delete" data-id="'.$result['id'].'" data-table="'.$table_name.'"><i class="fa fa-trash"></i></a></p>';
//                     }else{
//                         $action .= '</p>'; 
//                     }
                    
//                     $time_taken = '';
//                     if($result['start_time']!="" || $result['submit_time']!=""){
//                         $stime=strtotime($result['start_time']);
//                         $etime=strtotime($result['submit_time']);
//                         $elapsed = $etime - $stime;
//                         $time_taken = gmdate("H:i:s", $elapsed);
//                     }
//                     if($role == '1'){
//                         $dataarray[] = array(
//                         '<input type="checkbox" class="checkOneRow" value="'.$result['id'].'">',
//                         $count,
//                         $image.$result['name'],
//                         $result['enrollment_id'],
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
//                   }else{
//                         $dataarray[] = array(
//                         $count,
//                         $image.$result['name'],
//                         $result['enrollment_id'],
//                         $result['paper_name'],
//                         date('d-m-Y',strtotime($result['date'])),
//                         date('h:i A',strtotime($result['start_time'])),
//                         date('h:i A',strtotime($result['submit_time'])),
//                         $result['total_question'],
//                         $result['attempted_question'],
//                         gmdate("H:i", $result['time_duration']*60),
//                         $time_taken,
//                         $rightCount,
//                         number_format((float)$percentage, 2, '.', ''),
//                         $action,
//                     ); 
// 					}
                    
                    
//                     $count++;
//                 }
    
//                 if(!empty($cond))
//                     $recordsTotal = $this->db_model->countAll($table_name.' use index (id)',$cond,'','','',$join_array);
//                 else 
//                     $recordsTotal = 0;
//                 $output = array(
//                     "draw" => $post['draw'],
//                     "recordsTotal" => $recordsTotal,
//                     "recordsFiltered" => $recordsTotal,
//                     "data" => $dataarray,
//                 );
    
//             }else{
//                 $output = array(
//                     "draw" => $post['draw'],
//                     "recordsTotal" => 0,
//                     "recordsFiltered" => 0,
//                     "data" => array(),
//                 );
//             }
//             echo json_encode($output,JSON_UNESCAPED_SLASHES);
//         }else{
//             echo $this->lang->line('ltr_not_allowed_msg');
//         }
//     }
function result_table($type){
		
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
            
            if($type == 'practice'){
                $table_name = 'practice_result';
            }else{
                $table_name = 'mock_result';
            }
        
            if($post['search']['value'] != ''){
                $join_array = array('students',"students.name like '%".$post['search']['value']."%' AND students.id = $table_name.student_id");
            }else{
               $join_array = array('students',"students.id = $table_name.student_id");
				//$join_array = array('sudent_batchs ','sudent_batchs.student_id=students.id');
            }
          //print_r(implode(",",$_SESSION['batch_id']));
			//die;
			//$join = array('multiple', array(array(student, COMPANY_TABLE . '.id=' . EMPLOYEES_TABLE . '.company_name', 'LEFT'), array(DEPARTMENT_TABLE, DEPARTMENT_TABLE . '.id=' . EMPLOYEES_TABLE . '.plant_name', 'LEFT')));


            $cond = '';
            $role = $this->session->userdata('role');
            if($role == '1'){
                $cond = array("$table_name.admin_id"=>$this->session->userdata('uid'));
            }else{
                $admin_id = $this->session->userdata('admin_id');
                $batch_id = $this->session->userdata('batch_id');
                if(!empty($batch_id)){
					$or_like = array(array('students.batch_id',implode(",",$batch_id)));
					
                    //$cond = $table_name.".admin_id = $admin_id AND students.batch_id like IN ($batch_id)";
					$cond = $table_name.".admin_id = $admin_id";

                }else{
					$or_like = '';
                    $cond = '';
                }
            }
			
            $like = '';
            if(isset($get['month']) || isset($get['year'])){
                if($get['month']!='' && $get['year']!=''){ 
                    $datefiltr = $get['year'].'-'.$get['month'];
                    $like = array('date',$datefiltr);  
                }
            }
    
            if(isset($get['paper'])){
                if($get['paper']!=''){
                    $cond[$table_name.'.paper_id'] = $get['paper'];  
                }
            }
            if(isset($get['batch_id'])){
                if($get['batch_id']!=''){
                    $cond['students.batch_id'] = $get['batch_id'];  
                }
            }
    
            if($role == 1){
                $profile = 'admin';
            }else if($role == 3){
                $profile = 'teacher';
            }
           
            if(!empty($cond)){
                $result_data = $this->db_model->select_data("$table_name.*,students.name,students.image,students.enrollment_id", $table_name.' use index (id)',$cond,$limit,array("$table_name.id",'desc'),$like,$join_array,'',$or_like);
				//$student_data = $this->db_model->select_data("$table_name.*,students.name,students.image,students.enrollment_id",'students use index (id)',$cond,$limit,array("$table_name.id",'desc'),$like,,$join_array,'');
            }else{
                $result_data = ''; 
            }
            //echo $this->db->last_query();
            if(!empty($result_data)){
                foreach($result_data as $result){
                   
                    if (!empty($result['image'])){ 
                        $image = '<img src="'.base_url().'uploads/students/'.$result['image'].'" title="'.$result['name'].'" class="view_large_image"></a>';
                    }else{
                        $image = '';
                    }
    
                    $attemptedQuestion = json_decode($result['question_answer'],true);
                    $rightCount = 0;
                    $wrongCount = 0;
                    if(!empty($attemptedQuestion)){
                    foreach($attemptedQuestion as $key=>$value){
                            $right_ansrs = $this->db_model->select_data('id,answer', 'questions use index (id)',array('id'=>$key));
                            if(!empty($right_ansrs)){
                                if(($key == $right_ansrs[0]['id']) && ($value == $right_ansrs[0]['answer'])){
                                    $rightCount++;
                                }else{
                                    $wrongCount++;
                                }
                            }
                    }
                }
                    
                    
                    $percData = (($rightCount - ($wrongCount*0.25))*100)/$result['total_question'];
					if($percData < 0){
						$percentage = 0;
					}else{
						$percentage = $percData;
					}
                    $url = base_url($profile.'/answer-sheet/'.$type.'/'.$result['id']);
                    
                    $action = '<p class="actions_wrap"><a href="'.$url.'" target="_blank" class="btn_view" title="View"><i class="fa fa-eye"></i></a>';
    
                    if($role == '1'){
                        $action .= '<a class="deleteData btn_delete" title="Delete" data-id="'.$result['id'].'" data-table="'.$table_name.'"><i class="fa fa-trash"></i></a></p>';
                    }else{
                        $action .= '</p>'; 
                    }
                    
                    $time_taken = '';
                    if($result['start_time']!="" || $result['submit_time']!=""){
                        $stime=strtotime($result['start_time']);
                        $etime=strtotime($result['submit_time']);
                        $elapsed = $etime - $stime;
                        $time_taken = gmdate("H:i:s", $elapsed);
                    }
                    if($role == '1'){
                        $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$result['id'].'">',
                        $count,
                        $image.$result['name'],
                        $result['enrollment_id'],
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
                   }else{
                        $dataarray[] = array(
                        
                        $count,
                        $image.$result['name'],
                        $result['enrollment_id'],
                        $result['paper_name'],
                        date('d-m-Y',strtotime($result['date'])),
                        date('h:i A',strtotime($result['start_time'])),
                        date('h:i A',strtotime($result['submit_time'])),
                        $result['total_question'],
                        $result['attempted_question'],
                        gmdate("H:i", $result['time_duration']*60),
                        $time_taken,
                        $rightCount,
                        number_format((float)$percentage, 2, '.', ''),
                        $action,
                    ); 
					}
                    
                    
                    $count++;
                }
    
                if(!empty($cond))
                    $recordsTotal = $this->db_model->countAll($table_name.' use index (id)',$cond,'','','',$join_array);
                else 
                    $recordsTotal = 0;
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

    /********   Result Manage End   ********/
    /********   Facility Manage Start   ********/
    
    function facility_table(){
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
                $like = array('title',$post['search']['value']);
            }else{
               $like = ''; 
            }
    
            $facilities = $this->db_model->select_data('*','facilities use index (id)','',$limit,array('id','desc'),$like,'','');
    
            if(!empty($facilities)){
                
                foreach($facilities as $faci){
                    $descriptionWord =$this->readMoreWord($faci['description'], $this->lang->line('ltr_description'));
                    $action = '<p class="actions_wrap"><a class="edit_facility btn_edit" title="Edit" data-id="'.$faci['id'].'"><i class="fa fa-edit"></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$faci['id'].'" data-table="facilities"><i class="fa fa-trash"></i></a></p>';
    
                   
                    if($faci['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$faci['id'].'" data-table ="facilities" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$faci['id'].'" data-table ="facilities" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$faci['id'].'">',
                                $count,
                                $faci['title'],
                                '<i class="'.$faci['icon'].'"></i>',
                                '<p class="descParaCls">'.$descriptionWord.'</p>',
                                $statusDrop,
                                $action
                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('facilities use index (id)','','','',$like,'','');
    
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

    function add_facility(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                if(!empty($this->input->post('edit_id',TRUE))){
                    $id = $data_arr['edit_id'];
                    unset($data_arr['edit_id']);
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->update_data_limit('facilities',$data_arr,array('id'=>$id),1);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_facility_updated_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    unset($data_arr['edit_id']);
                    $data_arr['status'] = '1';
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->insert_data('facilities',$data_arr);               
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_facility_added_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }  
    }

    /********   Facility Manage End   ********/
     /********   Homework Manage Start   ********/
    
    function homework_table($date=''){
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
                $like = array('description',$post['search']['value']);
            }else{
               $like = ''; 
            }
            $uid = $this->session->userdata('uid');
            $cond = "teacher_id = $uid";
    
            if(isset($get['from_date']) || isset($get['to_date'])){
                if($get['from_date']!='' && $get['to_date']!=''){ 
                    $frm_date = $this->db->escape(date('Y-m-d',strtotime($get['from_date'])));
                    $to_date = $this->db->escape(date('Y-m-d',strtotime($get['to_date'])));
                    $cond .= " AND date >= $frm_date AND date <= $to_date";
                }
            }
           
            $homeworks = $this->db_model->select_data('*','homeworks use index (id)',$cond,$limit,array('id','desc'),$like,'','');
    
            if(!empty($homeworks)){
               
                foreach($homeworks as $home){
                    
                    $descriptionWord =$this->readMoreWord($home['description'], $this->lang->line('ltr_description'));
                    $action = '<p class="actions_wrap"><a class="edit_homework btn_edit" title="Edit" data-id="'.$home['id'].'" data-batch="'.$home['batch_id'].'" data-sub="'.$home['subject_id'].'"><i class="fa fa-edit"></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$home['id'].'" data-table="homeworks"><i class="fa fa-trash"></i></a></p>';
    
                    $batch_name = $this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$home['batch_id']));
                    $subject_name = $this->db_model->select_data('subject_name','subjects use index (id)',array('id'=>$home['subject_id']));
                  
                    if(!empty($subject_name) && !empty($batch_name)){
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$home['id'].'">',
                                $count,
                                $batch_name[0]['batch_name'],
                                $subject_name[0]['subject_name'],
                                date('d-m-Y',strtotime($home['date'])),
                                '<p class="descParaCls">'.$descriptionWord.'</p>',
                                $action
                            ); 
                    }
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

    function add_homework(){
       
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('description',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                unset($data_arr['ci_csrf_token']);
                if(!empty($this->input->post('edit_id',TRUE))){
                    $id = $data_arr['edit_id'];
                    unset($data_arr['edit_id']);
                    $data_arr['date'] = date('Y-m-d',strtotime($data_arr['date']));
                    $data_arr['added_at'] = date('Y-m-d H:i:s');
                    $data_arr = $this->security->xss_clean($data_arr);
                  
                    $ins = $this->db_model->update_data_limit('homeworks',$data_arr,array('id'=>$id,'teacher_id'=>$this->session->userdata('uid'),'admin_id'=>$this->session->userdata('admin_id')),1);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_homework_updated_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    unset($data_arr['edit_id']);
                    $data_arr['date'] = date('Y-m-d',strtotime($data_arr['date']));
                    $data_arr['teacher_id'] = $this->session->userdata('uid');
                    $data_arr['admin_id'] = $this->session->userdata('admin_id');
                    $data_arr['added_at'] = date('Y-m-d H:i:s');
                    // $data_arr['batch_id'] = $data_arr['batch'];
                    $batch_id = $data_arr['batch'];
                    $data_arr = $this->security->xss_clean($data_arr);
                    // print_r($data_arr);
                    // die();
                    $ins = $this->db_model->insert_data('homeworks',$data_arr);               
                    if($ins==true){
                         $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_homework_added_msg'));
                         $batch_id = $this->input->post('batch');
                         
                        $title =$this->lang->line('ltr_view_homework');
                        $where ="homework";
                      
                        $data['batch_id'] = $batch_id;
                        $data['notification_type'] = "Assignment";
                        $data['msg'] = 'New Assignment Added';
                        $data['url'] = 'student/homework';
                        $data['time'] = date('Y-m-d H:i:s');
                        $data['seen_by'] = '';
                       
                       
                         $student_data = $this->db_model->select_data('id','students',array('batch_id'=> $data['batch_id'],'status' => '1'));
                        
                      for($i=0;$i<count($student_data);$i++){
                      $data['student_id'] = $student_data[$i]['id'];
                     
                        $notify = $this->db_model->insert_data('notifications',$data);     
                     
                      }
                         
                        if(!empty($batch_id)){
                            $batch = $batch_id;
                            $data = $this->push_notification_android($batch,$title,$where);
                         
                          }
                    }else{
                        $resp = array('status'=>0);
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    /********   Homework  Manage End   ********/
    /********   Gallery Manage Start   ********/

    function gallery_table(){
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
                $like = array('title',$post['search']['value']);
            }else{
               $like = ''; 
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                // $cond = '';
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else{
                $cond = array('admin_id'=>$this->session->userdata('admin_id'));
            }
            $gallery = $this->db_model->select_data('*','gallery use index (id)',$cond,$limit,array('id','desc'),$like,'','');
    
            if(!empty($gallery)){
               
                foreach($gallery as $gal){
                    if($gal['upload'] == 'URL'){
                        $viewIcn = '<p class="actions_wrap"><a class="viewVideo btn_view" title="View" data-id="'.$gal['id'].'" data-url="'.$gal['video_url'].'"><i class="fa fa-eye"></i></a>';
                        $editIcn = '<a class="editVideoImgGalry btn_edit" title="Edit" data-id="'.$gal['id'].'" data-type="'.$gal['type'].'" data-url="'.$gal['video_url'].'"><i class="fa fa-edit"></i></a>';
                    $deleteIcn = '<a class="deleteData btn_delete" title="Delete" data-id="'.$gal['id'].'" data-table="gallery" data-file="uploads/gallery/'.$gal['image'].'"><i class="fa fa-trash"></i></a></p>';

                    }elseif($gal['type'] == 'Video'){
                        $viewIcn = '<p class="actions_wrap"><a class="viewVideo btn_view" title="View" data-id="'.$gal['id'].'" data-url="'.base_url().'uploads/video/'.$gal['video'].'"><i class="fa fa-eye"></i></a>';
                        $editIcn = '<a class="editVideoImgGalry btn_edit" title="Edit" data-id="'.$gal['id'].'" data-type="'.$gal['type'].'" data-video="'.base_url().'uploads/video/'.$gal['video'].'"><i class="fa fa-edit"></i></a>';
                        $deleteIcn = '<a class="deleteData btn_delete" title="Delete" data-id="'.$gal['id'].'" data-table="gallery" data-file="uploads/video/'.$gal['video'].'"><i class="fa fa-trash"></i></a></p>';
                    }else{
                        $viewIcn = '<p class="actions_wrap"><a class="viewImage btn_view" title="View" data-id="'.$gal['id'].'" data-img="uploads/gallery/'.$gal['image'].'"><i class="fa fa-eye"></i></a>';
                         $editIcn = '<a class="editVideoImgGalry btn_edit" title="Edit" data-id="'.$gal['id'].'" data-type="'.$gal['type'].'" data-img="'.$gal['image'].'"><i class="fa fa-edit"></i></a>';
                        $deleteIcn = '<a class="deleteData btn_delete" title="Delete" data-id="'.$gal['id'].'" data-table="gallery" data-file="uploads/gallery/'.$gal['image'].'"><i class="fa fa-trash"></i></a></p>';

                    }           
                    
                    // $editIcn = '<a class="editVideoImgGalry btn_edit" title="Edit" data-id="'.$gal['id'].'" data-video="'.$gal['video'].'" data-img="'.$gal['image'].'" data-type="'.$gal['type'].'"><i class="fa fa-edit"></i></a>';
                    $action = $viewIcn.$editIcn.$deleteIcn;
    
                    if($gal['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$gal['id'].'" data-table ="gallery" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$gal['id'].'" data-table ="gallery" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$gal['admin_id']),1);
                    // print_r($name);
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$gal['id'].'">',
                                $count,
                                $gal['title'],
                                $gal['type'],
                                $statusDrop,
                                $action,
                                $added_by
                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('gallery use index (id)',$cond,'','',$like,'','');
    
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

    function add_gallery(){
       
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                 $id = $this->input->post('id',TRUE);
                if(!empty($id)){
                if($this->input->post('type',TRUE) == 'Image'){
                    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                        $image = $this->upload_media($_FILES,'uploads/gallery/','image');
                        if(is_array($image)){
                            $resp = array('status'=>'2', 'msg' => $image['msg']);
                            die();
                        }else{
                            $data_arr['upload'] = 'File';
                            $data_arr['image'] = $image;
                            $data_arr['admin_id'] = $_SESSION['uid'];
                        }
                    }
                    $data_arr['video_url'] = '';
                }else{
                    $data_arr['image'] = '';
                }
               if($this->input->post('upload',TRUE) == 'File'){
                   if(isset($_FILES['video']) && !empty($_FILES['video']['name'])){
                        $video = $this->upload_media($_FILES,'uploads/video/','video');
                         if(is_array($video)){
                            $resp = array('status'=>'2', 'msg' => $video['msg']);
                            die();
                        }else{
                            $data_arr['video'] = $video;
                             $data_arr['status'] = 1;
                             $data_arr['admin_id'] = $_SESSION['uid'];
                        }
                   }
               }
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit('gallery',$data_arr,array('id'=>$id),1);              
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_gallery').$this->input->post('type',TRUE).$this->lang->line('ltr_updated_msg'));
                }else{
                    $resp = array('status'=>0);
                }
            }else{
                $data_arr['status'] = 1;
                if($this->input->post('type',TRUE) == 'Image'){
                    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                        $image = $this->upload_media($_FILES,'uploads/gallery/','image');
                        if(is_array($image)){
                            $resp = array('status'=>'2', 'msg' => $image['msg']);
                            die();
                        }else{
                            $data_arr['upload'] = 'File';
                            $data_arr['image'] = $image;
                            $data_arr['admin_id'] = $_SESSION['uid'];
                        }
                    }
                    $data_arr['video_url'] = '';
                }else{
                    $data_arr['image'] = '';
                }
               if($this->input->post('upload',TRUE) == 'File'){
                   if(isset($_FILES['video']) && !empty($_FILES['video']['name'])){
                        $video = $this->upload_media($_FILES,'uploads/video/','video');
                         if(is_array($video)){
                            $resp = array('status'=>'2', 'msg' => $video['msg']);
                            die();
                        }else{
                            $data_arr['video'] = $video;
                             $data_arr['status'] = 1;
                             $data_arr['admin_id'] = $_SESSION['uid'];
                        }
                   }
               }
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('gallery',$data_arr);               
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_gallery').$this->input->post('type',TRUE).$this->lang->line('ltr_added_msg'));
                }else{
                    $resp = array('status'=>0);
                }
            }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

     /********   Gallery Manage End   ********/

     /********   Profile Manage Start   ********/

    function admin_change_password(){  
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('new_pass',TRUE))){
                $res = $this->db_model->update_data_limit('users',$this->security->xss_clean(array('password'=>md5($this->input->post('new_pass',TRUE)))),array('id'=>$this->session->userdata('uid')),1);
                if($res){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_password_changed_msg'));
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }  
    }

    function update_teacher_profile(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                $role = $this->session->userdata('role');
                if($role == 'student'){
                    $path = 'uploads/students/';
                    $table = 'students';
                    unset($data_arr['batch_name']);
                }else{
                    $path = 'uploads/teachers/';
                    $table = 'users';
                }
                if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                    $image = $this->upload_media($_FILES,$path,'image');
                    if(is_array($image)){
                        $resp = array('status'=>'2', 'msg' => $image['msg']);
                        echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                        die();
                    }else{
                        if($role == 'student'){
                            $data_arr['image'] = $image;
                        }else{
                            $data_arr['teach_image'] = $image;
                        }
                        
                        $this->session->set_userdata('profile_img',$image);
                    }
                }
                if($data_arr['password'] == ''){
                    unset($data_arr['password']);
                }else{
                    $data_arr['password'] = md5($data_arr['password']);
                }
                unset($data_arr['email']);
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit($table,$data_arr,array('id'=>$this->session->userdata('uid')));               
                if($ins==true){
                    $this->session->set_userdata('name',$data_arr['name']);
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_profile_updated_msg'));
                }else{
                    $resp = array('status'=>0,'data'=>$data_arr);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

     /********   Profile Manage End   ********/
     
    /********   Common start   ********/

    function change_status(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $ins = $this->db_model->update_Data_limit($this->input->post('table',TRUE),$this->security->xss_clean(array('status'=>$this->input->post('status',TRUE))),array('id'=>$this->input->post('id',TRUE)));
                if($ins){
                    
                    $resp = array('status'=>1);
                    $id = $this->input->post('id',TRUE);
                    $studData = $this->db_model->select_data('student_id','leave_management use index (id)',array('id'=>$id),1);
                    if(!empty($studData)){
                        if($studData[0]['student_id']){
                            $title ="Leave status";
                            $where ="Leave";
                            $batch_id='';
                            $student_id=$studData[0]['student_id'];
                            if(!empty($where)){
                                $this->push_notification_android($batch_id='',$title,$where,$student_id);
                            }
                        }
                    }
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function change_dropdown_Value(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $ins = $this->db_model->update_Data_limit($this->input->post('table',TRUE),$this->security->xss_clean(array($this->input->post('column',TRUE)=>$this->input->post('value',TRUE))),array('id'=>$this->input->post('id',TRUE)));
                if($ins){
                    $resp = array('status'=>1);
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function deleteData(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $studData = '';
                if($this->input->post('table',TRUE) == 'students'){
                    $studData = $this->db_model->select_data('batch_id','students use index (id)',array('id'=>$this->input->post('id',TRUE)),1);
                }
                
                if($this->input->post('table',TRUE) == 'vacancy'){
                    $vacnData = $this->db_model->select_data('files','vacancy use index (id)',array('id'=>$this->input->post('id',TRUE)),1);
                    
                }
    
                if($this->input->post('table',TRUE) == 'questions'){
                    $questData = $this->db_model->select_data('subject_id,chapter_id','questions use index (id)',array('id'=>$this->input->post('id',TRUE)),1);
                }
                if($this->input->post('table',TRUE) == 'blog_comments'){
                   $res = $this->db_model->delete_data('blog_comments_reply',array('comment_id'=>$this->input->post('id',TRUE)));
                }
                $res = $this->db_model->delete_data($this->input->post('table',TRUE),array('id'=>$this->input->post('id',TRUE)));
                
                if($res){
                    if(!empty($studData) && $studData[0]['batch_id']!=''){
                        $this->db_model->update_with_increment('batches','no_of_student',array('id'=>$studData[0]['batch_id']),'minus',1);
                    }
                    
                    if(!empty($vacnData) && $vacnData[0]['files']!=''){
                        $path = FCPATH.'uploads/vacancy/';
                        $files = json_decode($vacnData[0]['files'],true);
                        foreach($files as $file){
                            if(file_exists($path.$file))
                                unlink($path.$file);
                        }
                    }
                    
                    $file = $this->input->post('file',TRUE);
                    if(isset($file) && ($this->input->post('file',TRUE) != '')){
                        unlink(FCPATH.$this->input->post('file',TRUE));
                    }
    
                    if(!empty($questData) && $questData[0]['subject_id']!=''){
                        $this->db_model->update_with_increment('subjects','no_of_questions',array('id'=>$questData[0]['subject_id']),'minus',1);
                        $this->db_model->update_with_increment('chapters','no_of_questions',array('id'=>$questData[0]['chapter_id']),'minus',1);
                    }

                    if($this->input->post('table',TRUE) == 'batches'){
                       $this->db_model->delete_data('batch_subjects',array('batch_id'=>$this->input->post('id')));
                      
                        $teacherData = $this->db_model->select_data('id,teach_batch','users use index (id)','FIND_IN_SET('.$this->input->post('id').', teach_batch) > 0');
                        
                        if(!empty($teacherData)){
                            foreach($teacherData as $teacher){
                                $newBatch = explode(',',$teacher['teach_batch']);
                                $key = array_search($this->input->post('id'),$newBatch);
                                unset($newBatch[$key]);
                                $this->db_model->update_data('users',array('teach_batch'=>implode(',',$newBatch)),array('id'=>$teacher['id']));
                            }
                        }
                    } 
    
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_deleted_msg'));
                }else{
                    $resp = array('status'=>'0'); 
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function leave_table(){
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
                $like = array('subject',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }

            $role = $this->session->userdata('role');
            if($role == 1){  
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 3){
                $cond = array('teacher_id'=>$this->session->userdata('uid'), 'admin_id' => $this->session->userdata('admin_id'));
            }else if($role == 'student'){
                $cond = array('student_id'=>$this->session->userdata('uid'), 'admin_id' => $this->session->userdata('admin_id'));
            } 
    
            $leaves = $this->db_model->select_data('*','leave_management use index (user_id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    
            if(!empty($leaves)){
                
                foreach($leaves as $leave){
                    $action = '<p class="actions_wrap"><a class="viewLeave btn_view" title="View" data-id="'.$leave['id'].'"><i class="fa fa-eye"></i></a></p>';
                    if($leave['status'] == 1){
                        $statusDrop='<span style="color:green;">'.$this->lang->line('ltr_approved').'</span>';
                    }elseif($leave['status'] == 2){
                         $statusDrop='<span style="color:red;">'.$this->lang->line('ltr_decline').'</span>';
                    }else{
                        $statusDrop='<span style="color:red;">'.$this->lang->line('ltr_pending').'</span>';
                    }
    
                    if($role == 1){
                        $dataarray[] = array(
                            $count,
                            $vid['title'],
                            (!empty($batch)?$batch[0]['batch_name']:''),
                            $vid['subject'],
                            $vid['topic'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else{
                        $dataarray[] = array(
                            $count,
                            $leave['subject'],
                            date('d-m-Y',strtotime($leave['added_at'])),
                            date('d-m-Y', strtotime($leave['from_date'])),
                            date('d-m-Y', strtotime($leave['to_date'])),
                            $leave['total_days'],
                            $statusDrop,
                            $action
                        ); 
                    }
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('leave_management use index (user_id)',$cond,'','',$like,'','',$or_like);
    
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
    
    function apply_leave(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('leave_msg',TRUE))){
                $data_arr = $this->input->post();
                $data_arr['from_date'] = date('Y-m-d', strtotime($this->input->post('from_date')));
                $data_arr['to_date'] = date('Y-m-d', strtotime($this->input->post('to_date')));
                $role = $this->session->userdata('role');
                if($role == '3')
                    $data_arr['teacher_id'] = $this->session->userdata('uid');
                else if($role == 'student')
                    $data_arr['student_id'] = $this->session->userdata('uid');
                $data_arr['admin_id'] = $this->session->userdata('admin_id');
                $data_arr['batch_id'] = $this->session->userdata('batch_id');
                $data_arr['status'] = 0; 
                $Datediff = strtotime($this->input->post('to_date')) - strtotime($this->input->post('from_date'));               
                $data_arr['total_days'] = abs(round($Datediff / 86400)); 
                
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('leave_management',$data_arr);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_leave_apply_msg'));
                }else{
                    $resp = array('status'=>0);
                }
            }else{
                $resp = array('status'=>'0'); 
            } 
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function get_leave_data(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $getLeave = $this->db_model->select_data('leave_msg, subject','leave_management use index (id)',array('id'=>$this->input->post('id')),1);
                if(!empty($getLeave)){
                    $resp = array('status'=>1,'data'=>$getLeave[0]);
                }else{
                    $resp = array('status'=>0);
                }
            }else{
                $resp = array('status'=>'0'); 
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    
    function manage_leaves($type){ // if student (type = 1), if teacher (type = 2)
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
        if($type == 1){
                $cond = array('student_id !='=>'0', 'leave_management.admin_id' => $this->session->userdata('uid'));
                $table = 'students';
                $join = array('students', 'leave_management.student_id = students.id');
            }else{
                $cond = array('teacher_id !='=>'0', 'leave_management.admin_id' => $this->session->userdata('uid'));
                $table = 'users';
                $join = array('users', 'leave_management.teacher_id = users.id');
            }
            if($post['search']['value'] != ''){
                $like = array($table.'.name',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            

            if(isset($get['id'])){
                if($get['id']!=''){   
                    if($type == 1){
                        $cond['student_id'] = $get['id'];  
                    }else{
                        $cond['teacher_id'] = $get['id'];  
                    }
                }
            }
    
            $users_leave = $this->db_model->select_data('leave_management.subject,leave_management.leave_msg,leave_management.total_days,leave_management.from_date,leave_management.to_date,leave_management.added_at,leave_management.status,leave_management.id as leave_id,'.$table.'.name','leave_management',$cond,$limit,array('leave_management.id','desc'),$like,$join,'',$or_like);
        
            if(!empty($users_leave)){
                
                foreach($users_leave as $leave){
                    $from_date = $leave['from_date'];
                    $current = strtotime(date("Y-m-d"));
                    $date    = strtotime($from_date);
                    
                    $action = '<p class="actions_wrap "><a class="viewLeave btn_view" title="View" data-id="'.$leave['leave_id'].'"><i class="fa fa-eye"></i></a></p>';
                    if(($current>$date) && ($leave['status']!=1)){
                        $statusDrop = ($leave['status'] == 2) ? '<span>'.$this->lang->line('ltr_decline').'</span>' : '<span>'.$this->lang->line('ltr_pending').'</span>';
                    }else{
                    $statusDrop = ($leave['status'] == 1) ? '<span style="color:green;">'.$this->lang->line('ltr_approved').'</span>' : '<select data-id="'.$leave['leave_id'].'" data-table ="leave_management" class="form-control changeStatus datatableSelect">
                        <option value="1" '.(($leave['status'] == 1) ? 'selected':'').'>'.$this->lang->line('ltr_approved').'</option>
                        <option value="2" '.(($leave['status'] == 2) ? 'selected':'').'>'.$this->lang->line('ltr_decline').'</option>
                        <option value="0" '.(($leave['status'] == 0) ? 'selected':'').'>'.$this->lang->line('ltr_pending').'</option>
                    </select>';
                    }  
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$leave['leave_id'].'">',
                        $count,
                        $leave['name'],
                        
                        date('d-m-Y',strtotime($leave['added_at'])),
                        date('d-m-Y',strtotime($leave['from_date'])),
                        date('d-m-Y',strtotime($leave['to_date'])),
                        $leave['total_days'],
                        $statusDrop,
                        $action
                    ); 

                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('leave_management use index (user_id)',$cond,'','',$like,$join,'',$or_like);
    
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
  
    function student_manage_leaves(){
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
       
               
                $table = 'students';
                $join = array('students', 'leave_management.student_id = students.id');
                $batch_id = $this->session->userdata('batch_id');
            if(!empty($batch_id)){
                $where_in=array('leave_management.batch_id',$batch_id);
            }else{
                $where_in="";
            }
           
            if($post['search']['value'] != ''){
                $like = array($table.'.name',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            if($this->session->userdata('role') == 1 && $super == 1){ 
               $cond = array('student_id !='=>'0', 'leave_management.admin_id' => $this->session->userdata('uid'));
            }else if($this->session->userdata('role') == 1 && $super == 0){
                $cond = array('student_id !='=>'0', 'leave_management.admin_id' => $this->session->userdata('uid'));
            }else if($this->session->userdata('role') == 3 && $super == 0){
                $cond = array('student_id !='=>'0', 'leave_management.admin_id' => $this->session->userdata('uid'));
            }else{
               $cond = array('student_id !='=>'0', 'leave_management.admin_id' => $this->session->userdata('uid'));
            }
            $users_leave = $this->db_model->select_data('leave_management.subject,leave_management.leave_msg,leave_management.total_days,leave_management.from_date,leave_management.to_date,leave_management.added_at,leave_management.status,leave_management.id as leave_id,'.$table.'.name','leave_management',$cond,$limit,array('leave_management.id','desc'),$like,$join,'',$or_like,$where_in);
        
            if(!empty($users_leave)){
                
                foreach($users_leave as $leave){
                    $from_date = $leave['from_date'];
                    $current = strtotime(date("Y-m-d"));
                    $date    = strtotime($from_date);
                    
                    $action = '<p class="actions_wrap "><a class="viewLeave btn_view" title="View" data-id="'.$leave['leave_id'].'"><i class="fa fa-eye"></i></a></p>';
                    if(($current>$date) && ($leave['status']!=1)){
                        $statusDrop = ($leave['status'] == 2) ? '<span>'.$this->lang->line('ltr_decline').'</span>' : '<span>'.$this->lang->line('ltr_pending').'</span>';
                    }else{
                    $statusDrop = ($leave['status'] == 1) ? '<span style="color:green;">'.$this->lang->line('ltr_approved').'</span>' : '<select data-id="'.$leave['leave_id'].'" data-table ="leave_management" class="form-control changeStatus datatableSelect">
                        <option value="1" '.(($leave['status'] == 1) ? 'selected':'').'>'.$this->lang->line('ltr_approved').'</option>
                        <option value="2" '.(($leave['status'] == 2) ? 'selected':'').'>'.$this->lang->line('ltr_decline').'</option>
                        <option value="0" '.(($leave['status'] == 0) ? 'selected':'').'>'.$this->lang->line('ltr_pending').'</option>
                    </select>';
                    }  
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$leave['leave_id'].'">',
                        $count,
                        $leave['name'],
                        
                        date('d-m-Y',strtotime($leave['added_at'])),
                        date('d-m-Y',strtotime($leave['from_date'])),
                        date('d-m-Y',strtotime($leave['to_date'])),
                        $leave['total_days'],
                        $statusDrop,
                        $action
                    ); 

                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('leave_management use index (user_id)',$cond,'','',$like,$join,'',$or_like);
    
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
    
    
    
    function get_student_name(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->get('q', true))){
                
                $user_name = $this->db_model->select_data('id,name','students',"name LIKE '%".$this->input->post('q')."%'");
                if(!empty($user_name)){
                    $resp = array('status'=>1, 'data'=>$user_name, 'message'=>'');
                }else{
                    $resp = array('status'=>2, 'message'=>$this->lang->line('ltr_no_result'));
                }
            }else{
                $resp = array('status'=>0);
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function get_teacher_name(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->get('q', true))){
               
                $user_name = $this->db_model->select_data('id,name','users',"name LIKE '%".$this->input->post('q')."%' AND role = 3");
                if(!empty($user_name)){
                    $resp = array('status'=>1, 'data'=>$user_name, 'message'=>'');
                }else{
                    $resp = array('status'=>2, 'message'=>$this->lang->line('ltr_no_result'));
                }
            }else{
                $resp = array('status'=>0);
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function add_live_class_setting(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('batch',TRUE))){
                $setting_data = $this->db_model->select_data('*','live_class_setting',array('batch'=>$this->input->post('batch',TRUE)));
                if(empty($setting_data)){
                     $data_arr['batch'] = $this->input->post('batch',TRUE);
                    $data_arr['zoom_api_key'] = $this->input->post('zoom_api_key',TRUE);
                    $data_arr['zoom_api_secret'] = $this->input->post('zoom_api_secret',TRUE);
                    $data_arr['meeting_number'] = $this->input->post('meeting_number',TRUE);
                    $data_arr['password'] = $this->input->post('password',TRUE);
                    $data_arr['status'] = 1;
                    $data_arr['added_at'] = date('Y-m-d H:i:s');
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->insert_data('live_class_setting',$data_arr);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_class_added_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    $resp = array('status'=>2,'msg'=>$this->lang->line('ltr_batch_exists_msg'));
                }
                
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function add_live_class_Android(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('android_api_key',TRUE))){
                $setting_data = $this->db_model->select_data('*','zoom_api_credentials');
                if(empty($setting_data)){
                     $data_arr['android_api_key'] = $this->input->post('android_api_key',TRUE);
                    $data_arr['android_api_secret'] = $this->input->post('android_api_secret',TRUE);
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->insert_data('zoom_api_credentials',$data_arr);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_data_added_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                     $data_arr['android_api_key'] = $this->input->post('android_api_key',TRUE);
                    $data_arr['android_api_secret'] = $this->input->post('android_api_secret',TRUE);
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->update_data_limit('zoom_api_credentials',$data_arr,array('id'=>1),1);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_data_updated_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }
                
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function live_class_setting_table(){
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
                $like = array('batches.batch_name',$post['search']['value']);
            }else{
               $like = ''; 
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('live_class_setting.admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                $cond = array('live_class_setting.admin_id'=>$this->session->userdata('uid'));
            //   $cond = '';
            }else{
               $cond = array('live_class_setting.admin_id'=>$this->session->userdata('uid'));
            }
            
        
            $setting_data = $this->db_model->select_data('live_class_setting.*,batches.batch_name','live_class_setting',$cond,$limit,array('live_class_setting.id','desc'),$like,array('batches','batches.id=live_class_setting.batch'));

            if(!empty($setting_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($setting_data as $setting){
        // 			$live_class_h = $this->db_model->select_data('live_class_history.*','live_class_history',array('live_class_history.batch_id'=>$setting['batch']),'',array('id','ASC'),'','');
        // 			foreach($live_class_h as $setting1){
        // 				//print_r($setting1);
        // 				 if(!empty($setting1['start_time']) && empty($setting1['end_time']) )
        // 					{
        // 						$u=base_url('uploads/site_data/Dot.png');
        // 						$v=  "<img  src=".$u." class='active_status'>";	
        // 					}else{
        // 						$v= "";
        // 					}
        				
        // 			}
                    $action = '<p class="actions_wrap"><a class="edit_live_class btn_edit" data-table-name="live_class_setting" title="Edit" data-id="'.$setting['id'].'" data-batch="'.$setting['batch'].'"><i class="fa fa-edit"></i></a>
                        <a class="deleteData btn_delete" title="Delete" data-id="'.$setting['id'].'" data-table="live_class_setting"><i class="fa fa-trash"></i></a>
                        <a class="btn_view add_live_class_admin" title="Live Class" data-id="'.$setting['id'].'" data-batch="'.$setting['batch'].'"><i class="fa fa-users" aria-hidden="true" ></i></a>

                        </p>';
                        
                        
                      $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$setting['admin_id']),1);
                        // print_r($name);
                         if($name){
                             if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                             {
                                 $added_by= $name[0]['name']."  (Super Admin) ";
                             }else  if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 0 &&  $name[0]['super_admin'] == 1){
                                 $added_by = $name[0]['name']."  (Sub-Admin)";
                             }else{
                                 $added_by = $name[0]['name']."  (Teacher)";
                             }
                         // $added_by = $name[0]['name'];
                         }else{
                             $added_by = '';
                         }
                    $dataarray[] = array(
                                $count,
                                //  $v.' '.$setting['batch_name'],
                                $setting['batch_name'],
                                $setting['zoom_api_key'],
                                $setting['zoom_api_secret'],
                                $setting['meeting_number'],
                                $setting['password'],
                                $action,
                                $added_by
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('live_class_setting',$cond,'','',$like);
    
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
    
    function edit_live_class_setting(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('batch',TRUE))){
                $setting_data = $this->db_model->select_data('*','live_class_setting',array('batch'=>$this->input->post('batch',TRUE),'id !='=>$this->input->post('live_class_id',TRUE)));
                if(empty($setting_data)){
                    
                    $data_arr['batch'] = $this->input->post('batch',TRUE);
                    $data_arr['zoom_api_key'] = $this->input->post('zoom_api_key',TRUE);
                    $data_arr['zoom_api_secret'] = $this->input->post('zoom_api_secret',TRUE);
                    $data_arr['meeting_number'] = $this->input->post('meeting_number',TRUE);
                    $data_arr['password'] = $this->input->post('password',TRUE);
                    $data_arr = $this->security->xss_clean($data_arr);
                    $ins = $this->db_model->update_data_limit('live_class_setting',$data_arr,array('id'=>$this->input->post('live_class_id',TRUE)),1);
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_class_added_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    $resp = array('status'=>2,'msg'=>$this->lang->line('ltr_batch_exists_msg'));
                }
                
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function live_class_list_teacher(){
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
                $like = array('batches.batch_name',$post['search']['value']);
                
            }else{
               $like = ''; 
            }
            
            if(!empty($this->session->userdata('batch_id'))){
                 $admin_id = $this->session->userdata('admin_id');
            $batch_ids =$this->session->userdata('batch_id');
            $batCon = "batches.admin_id = $admin_id AND batches.id in ($batch_ids)";
            $setting_data = $this->db_model->select_data('live_class_setting.*,batches.batch_name','live_class_setting',$batCon,$limit,array('id','desc'),$like,array('batches','batches.id=live_class_setting.batch'));
            }else{
                $setting_data='';
            }
           

    
            if(!empty($setting_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
                foreach($setting_data as $setting){
                    $action = '<p class="actions_wrap">
                        <a class="btn_view add_live_class" title="Live Class" data-id="'.$setting['id'].'"><i class="fa fa-users" aria-hidden="true"></i></a>
                        </p>';
                    $dataarray[] = array(
                                $count,
                                $setting['batch_name'],
                                $action   
                    ); 
                    $count++;
                }
                $recordsTotal = $this->db_model->countAll('batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),'','',$like);
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
    
    function live_class_history_table(){
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
                $like = array(array('users.name',$post["search"]["value"]),array('batches.batch_name',$post["search"]["value"]));
            }else{
               $like = ''; 
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like1 = array('live_class_history.admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == '1' && $this->session->userdata('super_admin')==1){
                // $cond = "";
                 $cond = array('live_class_history.admin_id'=>$this->session->userdata('uid'));
            }else if($this->session->userdata('role') == '1' && $this->session->userdata('super_admin')==0){
                $cond = array('live_class_history.admin_id'=>$this->session->userdata('uid'));
            }
       
            $setting_data = $this->db_model->select_data('live_class_history.*,users.name,users.super_admin,batches.batch_name','live_class_history',$cond,$limit,array('id','desc'),$like1,array('multiple',array(array('users','users.id=live_class_history.uid'),array('batches','batches.id=live_class_history.batch_id'))),'',$like);
          
            if(!empty($setting_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($setting_data as $setting){
                $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$setting['admin_id']),1);
               
                 if($name){
                     if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                     {
                         $added_by= $name[0]['name']."  (Super Admin) ";
                     }else{
                         $added_by = $name[0]['name']."  (Sub-Admin)";
                     }
                 }else{
                     $added_by = '';
                 }
                    $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$setting['id'].'">',
                                $count,
                                $setting['batch_name'],
                                date('d-m-Y',strtotime($setting['date'])),
                                $setting['start_time'].' - '.$setting['end_time'],
                                // $setting['name'],
                                $added_by
                               
                             
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('live_class_history','','','','',array('multiple',array(array('users','users.id=live_class_history.uid'),array('batches','batches.id=live_class_history.batch_id'))),'',$like);
    
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
    
    function change_category(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $ins = $this->db_model->update_Data_limit($this->input->post('table',TRUE),$this->security->xss_clean(array('category'=>$this->input->post('category',TRUE))),array('id'=>$this->input->post('id',TRUE)));
                if($ins){
                    $resp = array('status'=>1);
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    /********   Common End   ********/
    function insert_excell(){
        
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
	    require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
        $this->excel = new PHPExcel(); 
    	$file_info = pathinfo($_FILES["result_file"]["name"]);
        $file_directory = "uploads/excel/";
        $new_file_name = date("d-m-Y ") . rand(000000, 999999) .".". $file_info["extension"];
        if($file_info["extension"]=='xlsx'){
            if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
            {   
                $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
                $objReader	= PHPExcel_IOFactory::createReader($file_type);
                $objPHPExcel = $objReader->load($file_directory . $new_file_name);
                $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
             array_shift($sheet_data);
            
                foreach($sheet_data as $data)
                {
                	$check=$this->db_model->select_data('*','questions',array('question'=>trim($data['A'])));
                	
                // 	if(!empty($check)){
                // 		continue;
                // 	}
                	switch ($data['F']) {
                      case $data['B']:
                        $answer='A';
                        break;
                      case $data['C']:
                        $answer='B';
                        break;
                      case $data['D']:
                        $answer='C';
                        break;
                      case $data['E']:
                        $answer='D';
                        break;
                    }
                   
                		$data_arr=array(
            				'subject_id'=>$_POST['subject_id'],
            				'chapter_id'=>$_POST['chapter_id'],
            				'question'=>trim($data['A']),
            				'options'=>json_encode(array($data['B'],$data['C'],$data['D'],$data['E'])),
            				'answer'=>$answer
            			);
            				
            			if($this->session->userdata('role') == 1){
                            $data_arr['admin_id'] = $this->session->userdata('uid');
                             $profile = 'admin';
                        }else{
                             $profile = 'teacher'; 
                            $data_arr['admin_id'] = $this->session->userdata('admin_id');
                        }
                        
                        $data_arr['added_by'] = $this->session->userdata('uid');
                        $data_arr['status'] = 1;
            		    $data_arr = $this->security->xss_clean($data_arr);
            //  print_r($data_arr);
            //  	die();
                        $ins = $this->db_model->insert_data('questions',$data_arr);
                       
                            $this->db_model->update_with_increment('chapters','no_of_questions',array('id'=>$this->input->post('chapter_id',TRUE)),'plus',1);
                            $this->db_model->update_with_increment('subjects','no_of_questions',array('id'=>$this->input->post('subject_id',TRUE)),'plus',1);
            	}
        
            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_question_added_msg'),'url'=>base_url($profile.'/question-manage'));
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            $resp = array('status'=>0);
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }
        
    }else{
         echo $this->lang->line('ltr_not_allowed_msg');
    }
    }
    
    function add_attendance(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $data= json_decode($this->input->post('ids',TRUE));
            for($i=0;$i<count($data);$i++){
                $data_arr['added_id'] = $this->session->userdata('uid');
                $data_arr['student_id'] = $data[$i];
                $data_arr['date'] = date('Y-m-d');
                $data_arr['time'] = date('h:i:s A');
                $data_arr['batch_id'] = $this->session->userdata('batch_id');
                $data_arr['admin_id'] = $this->session->userdata('admin_id');
                $check = $this->db_model->select_data('*','attendance',array('student_id'=>$data[$i],'date'=>date('Y-m-d')),'',array('id','desc'));
        //          print_r($_SESSION);
        // die();
                if(empty($check)){
                    $ins = $this->db_model->insert_data('attendance',$data_arr);
                }
                
            }
            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_attendance_added_msg'));
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    
    function add_attendance_extra(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            
            $data= json_decode($this->input->post('ids',TRUE));
            for($i=0;$i<count($data);$i++){
                $data_arr['added_id'] = $this->session->userdata('uid');
                $data_arr['student_id'] = $data[$i];
                $data_arr['date'] = date('Y-m-d');
                $data_arr['time'] = date('h:i:s A');
                $check = $this->db_model->select_data('*','extra_class_attendance',array('student_id'=>$data[$i],'date'=>date('Y-m-d')),'',array('id','desc'));
                if(empty($check)){
                    $ins = $this->db_model->insert_data('extra_class_attendance',$data_arr);
                }
                
            }
            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_attendance_added_msg'));
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    function student_attendance($id,$month,$year){
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
        $cond = array('student_id'=> $id);
        $like = array('date',$year.'-'.$month);
            $notices = $this->db_model->select_data('*','attendance',$cond,$limit,array('id','desc'),$like,'','',$or_like);
          //echo   $this->db->last_query();
            if(!empty($notices)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($notices as $not){
                   
                   if($this->session->userdata('role')==1){
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$not['id'].'">',
                                $count,
                                $not['date'],
                                $not['time'],
                                'Present',
                                '<a class="deleteData btn_delete" title="Delete" data-id="'.$not['id'].'" data-table="attendance"><i class="fa fa-trash"></i></a></p>'
                            ); 
                    $count++;
                   }else{
                       $dataarray[] = array(
                           
                                $count,
                                $not['date'],
                                $not['time'],
                                'Present'
                            ); 
                    $count++;
                   }
                }
    
                $recordsTotal = $this->db_model->countAll('attendance',$cond,'','',$like,'','',$or_like);
    
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
    
    
    function student_attendance_extra_class($id,$month,$year){
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
        $cond = array('student_id'=> $id);
        $like = array('date',$year.'-'.$month);
            $notices = $this->db_model->select_data('*','extra_class_attendance',$cond,$limit,array('id','desc'),$like,'','',$or_like);
          //echo   $this->db->last_query();
            if(!empty($notices)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($notices as $not){
                   
                   if($this->session->userdata('role')==1){
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$not['id'].'">',
                                $count,
                                $not['date'],
                                $not['time'],
                                'Present',
                                '<a class="deleteData btn_delete" title="Delete" data-id="'.$not['id'].'" data-table="attendance"><i class="fa fa-trash"></i></a></p>'
                            ); 
                    $count++;
                   }else{
                       $dataarray[] = array(
                           
                                $count,
                                $not['date'],
                                $not['time'],
                                'Present'
                            ); 
                    $count++;
                   }
                }
    
                $recordsTotal = $this->db_model->countAll('extra_class_attendance',$cond,'','',$like,'','',$or_like);
    
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
    
    // function multiDelete(){
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         $data= json_decode($this->input->post('ids',TRUE));
    //         $table= $this->input->post('table_name',TRUE);
    //         $column= $this->input->post('column',TRUE);
    //         for($i=0;$i<count($data);$i++){
    //             $id = $data[$i];
    //             $this->db_model->delete_data($table,array($column=>$id));
    //         }
    //         $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_data_delete_msg'));
    //         echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //     }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     }
    // }


    function multiDelete(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $data= json_decode($this->input->post('ids',TRUE));
            $table= $this->input->post('table_name',TRUE);
            $column= $this->input->post('column',TRUE);
            for($i=0;$i<count($data);$i++){
                $id = $data[$i];
                $admin_check = current($this->db_model->select_data('*',$table,array('id'=>$id)));
                if($admin_check['added_by']=='1'){
                   if($_SESSION['role']=='1'){
                    $this->db_model->delete_data($table,array($column=>$id));
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_data_delete_msg'));
                   }else{
                    $resp = array('status'=>0,'msg'=>$this->lang->line('ltr_access_files_msg'));
                   }
                    // $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_data_delete_msg'));
                }else if($admin_check['added_by']!='1'){
                    $this->db_model->delete_data($table,array($column=>$id));
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_data_delete_msg'));
                }
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }


    function generateCertificate(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post();
            // $data= json_decode($this->input->post('ids',TRUE));
            // for($i=0;$i<count($data);$i++){
                // $getBatch = $this->db_model->select_data('*','students',array('id'=>$data[$i]));
                // print_r($post);
                $data_arr['added_id'] = $this->session->userdata('uid');
                $data_arr['student_id'] = $post['id'];
                $data_arr['date'] = date('Y-m-d');
                $data_arr['batch_id'] = $post['batch_id'];
                
                $check = $this->db_model->select_data('*','certificate',array('student_id'=>$post['id'],'batch_id'=>$post['batch_id']),'',array('id','desc'));
                if(empty($check)){
                    $ins = $this->db_model->insert_data('certificate',$data_arr);
                    //send email
                    $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
                    $subj = $title.'- '.$this->lang->line('ltr_new_certificate');
                    $filename = "certificate_".$data[$i]."_".$getBatch[0]['batch_id'].'.pdf';
                    $em_msg = $this->lang->line('ltr_hey').' '.ucwords($this->input->post('name',TRUE)).', '.$this->lang->line('ltr_congratulation').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_earned_certificate').'<br/><br/><a href="'.base_url('uploads/certificate/').$filename.'" > '.$this->lang->line('ltr_link').'</a>';
                    $this->SendMail($getBatch[0]['email'],$subj,$em_msg);
                }
                
            // }
            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_certificate_generated_msg'));
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    
    function updateCertificateSetting(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('heading',false))){
                $data_arr = html_escape($this->input->post(NULL, false));
              
                if(isset($_FILES['signature_image']) && !empty($_FILES['signature_image']['name'])){
                    $logo = $this->upload_media($_FILES,'./uploads/site_data/','signature_image');
                    if(is_array($logo)){
                        $resp = array('status'=>'2', 'msg' => $logo['msg']);
                        die();
                    }else{
                        $data_arr['signature_image'] = $logo;
                    }
                }
                if(isset($_FILES['certificate_logo']) && !empty($_FILES['certificate_logo']['name'])){
                    $logo = $this->upload_media($_FILES,'./uploads/site_data/','certificate_logo');
                    if(is_array($logo)){
                        $resp = array('status'=>'2', 'msg' => $logo['msg']);
                        die();
                    }else{
                        $data_arr['certificate_logo'] = $logo;
                    }
                }
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit('certificate_setting',$data_arr,array('id'=>1),1);
                if($ins){
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_certificate_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function updatePrivacyPolicy(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('description',false))){
                $data_arr = html_escape($this->input->post(NULL, false));
              
                $data_arr = $this->security->xss_clean($data_arr);
               $privacy_data = $this->db_model->select_data('*','privacy_policy_data',array('id'=>'1'),1);
               if(!empty($privacy_data)){
                $ins = $this->db_model->update_data_limit('privacy_policy_data',$data_arr,array('id'=>1),1);
               }
               else{
                    $ins = $this->db_model->insert_data('privacy_policy_data',$data_arr);
               }
                //echo $this->db->last_query();
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_privacy_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
     
     function updatetermcondition(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('description',false))){
                $data_arr = html_escape($this->input->post(NULL, false));
              
                $data_arr = $this->security->xss_clean($data_arr);
               $term_data = $this->db_model->select_data('*','term_condition_data',array('id'=>'1'),1);
               if(!empty($term_data)){
                $ins = $this->db_model->update_data_limit('term_condition_data',$data_arr,array('id'=>1),1);
               }
               else{
                    $ins = $this->db_model->insert_data('term_condition_data',$data_arr);
               }
             
                if($ins){
                    $resp = array('status'=>'1', 'msg' => $this->lang->line('ltr_terms_updated_msg'));
                }else{
                    $resp = array('status'=>'0');
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);   
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    
    function get_subject_list(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('batch_id',TRUE))){
                $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',array('batch_id'=>$this->input->post('batch_id',TRUE)),'',array('id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
                $html = '<option value="">'.$this->lang->line('ltr_select_subject').'</option>';
                if(!empty($subjectData)){
                    foreach($subjectData as $subject){
                        
                            $html .= '<option value="'.$subject['id'].'">'.$subject['subject_name'].'</option>';
                        
                    }
                }
                $resp = array('status'=>1,'html'=>$html,);
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    function checkActiveLiveClass(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $batch_id = $this->session->userdata('batch_id');
		    $class_data = $this->db_model->select_data('users.name,users.teach_image AS teachImage,subjects.subject_name as subjectName,chapters.chapter_name as chapterName,live_class_history.end_time as endTime','live_class_history',array('batch_id'=>$batch_id),'1',array('live_class_history.id','desc'),'',array('multiple',array(array('users','users.id = live_class_history.uid'),array('subjects','subjects.id = live_class_history.subject_id'),array('chapters','chapters.id = live_class_history.chapter_id'))));
		   if(!empty($class_data)){
		       if(empty($class_data[0]['endTime'])){
		       $resp = array('status'=>1,'data'=>$class_data[0]);
		       }else{
		           $resp = array('status'=>0);
		       }
		   }else{
		       $resp = array('status'=>0);
		   }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    // function certificate_pdf_view(){
      
    //   if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         if(!empty($this->input->post('pdfb')) && !empty($this->input->post('pdfu')) ){
    //             $id=$this->input->post('pdfu',TRUE);
    //         	$batch_id = $this->input->post('pdfb',TRUE);
            
    //         	$data['student_certificate']=$this->db_model->select_data('*','certificate',array('student_id'=>$id,'batch_id'=>$batch_id),1,array('id','desc'));
    //         	if(!empty($data['student_certificate'])){
    //         	    $data['certificate_details']=$this->db_model->select_data('*','certificate_setting','',1,array('id','desc'));
    //             	$data['site_details_logo']=$this->db_model->select_data('site_logo','site_details','',1,array('id','desc'));
                
    //             	$data['student_details']=$this->db_model->select_data('name','students',array('id'=>$id),1,array('id','desc'));
    //             	$data['batchdata']=$this->db_model->select_data('batch_name','batches',array('id'=>$batch_id),1,array('id','desc'));
    //             	$data['baseurl'] = base_url();
    //                 $html=	$this->load->view("student/certificate_pdf",$data,true); 
    //                 // print_r($html);
    //                 // die();
    //                 $this->load->library('pdf'); // change to pdf_ssl for ssl
    //                 $filename = "certificate_".$id."_".$batch_id;
    //                 $result=$this->pdf->create($html);
                    
    //                 $file_path= explode("application",APPPATH);
    //                 file_put_contents($file_path[0].'uploads/certificate/'.$filename.'.pdf', $result);
    //                 $resp = array(
    //                     'fileName' => $filename.'.pdf',
    //                     'filesUrl' => base_url('uploads/certificate/'),
    //                     'status' => 1,
    //                     'msg' => 'Fetch Successfully.'
    //                 );
    //             }else{
    //                 $resp = array(
    //                     'status' => 0,
    //                     'msg' =>$this->lang->line('ltr_no_record_msg')
    //                 );
    //             }
    //         }else{
    //             $resp = array(
    //                 'status'=>0,
    //                 'msg'=>$this->lang->line('ltr_missing_parameters_msg')
    //             );
    //         }
    //         echo json_encode($resp,JSON_UNESCAPED_SLASHES);
    //   }else{
    //         echo $this->lang->line('ltr_not_allowed_msg');
    //     }
        
    // }
    function certificate_pdf_view(){
      
       if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('pdfb')) && !empty($this->input->post('pdfu')) ){
                $id=$this->input->post('pdfu',TRUE);
                $batch_id = $this->input->post('pdfb',TRUE);
            
                $data['student_certificate']=$this->db_model->select_data('*','certificate',array('student_id'=>$id,'batch_id'=>$batch_id),1,array('id','desc'));
                if(!empty($data['student_certificate'])){
                    $data['certificate_details']=$this->db_model->select_data('*','certificate_setting','',1,array('id','desc'));
                    $data['site_details_logo']=$this->db_model->select_data('site_logo','site_details','',1,array('id','desc'));
                
                    $data['student_details']=$this->db_model->select_data('name','students',array('id'=>$id),1,array('id','desc'));
                    $data['batchdata']=$this->db_model->select_data('batch_name','batches',array('id'=>$batch_id),1,array('id','desc'));
                    $data['baseurl'] = base_url();
                    $html=  $this->load->view("student/certificate_pdf",$data,true); 
                    // print_r($html);
                    // die(); 
                    $this->load->library('pdf'); // change to pdf_ssl for ssl
                    $filename = "certificate_".$id."_".$batch_id;
                    $result=$this->pdf->create($html);
                    
                    $file_path= explode("application",APPPATH);
                    file_put_contents($file_path[0].'uploads/certificate/'.$filename.'.pdf', $result);
                    $resp = array(
                        'fileName' => $filename.'.pdf',
                        'filesUrl' => base_url('uploads/certificate/'),
                        'status' => 1,
                        'msg' => 'Fetch Successfully.'
                    );
                }else{
                    $resp = array(
                        'status' => 0,
                        'msg' =>$this->lang->line('ltr_no_record_msg')
                    );
                }
            }else{
                $resp = array(
                    'status'=>0,
                    'msg'=>$this->lang->line('ltr_missing_parameters_msg')
                );
            }
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
       }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
        
    }
    public function push_notification_android($batch_id='',$title='',$where='',$student_id=''){
     
        if(!empty($batch_id)){
            $batchCon = "status = 1 AND token !='' AND batch_id in ($batch_id)";
	        $get_token = $this->db_model->select_data('token','students',$batchCon,'');
	        $batch_data = current($this->db_model->select_data('batch_name','batches',array('id' => $batch_id),'')); 
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
                $api_key = $this->general_settings('firebase_key');

                // $api_key = 'AAAAFU0Nyks:APA91bFWu1zpzRasM60cqJjMvfcL5Uc667MP38b5CaYd5O3g-ioRYGtVSvBCdFUt5ea4H8eIDbPKNs98z5W0RxFfRsswy07p1EbSKRRlQkUA1b9sb_fBC2sHvFJZWhpILlZlOqz0_M4u';
                $message = array(
                        'title' => $title,
                        'body' => array(
                            'where'=>$where,
                            'batch_name' =>(!empty($batch_data['batch_name'])) ? $batch_data['batch_name'] : "" ,
                            'batch_id'=>$batch_id
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
    public function push_notification_android_video($batch_id='',$title='',$where='',$student_id='',$videoId='',$url_video='',$videoType=''){
       
        if(!empty($batch_id)){
            $batchCon = "status = 1 AND token !='' AND batch_id in ($batch_id)";
	        $get_token = $this->db_model->select_data('token','students',$batchCon,'');
	        $batch_data = current($this->db_model->select_data('batch_name','batches',array('id' => $batch_id),'')); 
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
                $api_key = $this->general_settings('firebase_key');

                // $api_key = 'AAAAFU0Nyks:APA91bFWu1zpzRasM60cqJjMvfcL5Uc667MP38b5CaYd5O3g-ioRYGtVSvBCdFUt5ea4H8eIDbPKNs98z5W0RxFfRsswy07p1EbSKRRlQkUA1b9sb_fBC2sHvFJZWhpILlZlOqz0_M4u';
                $message = array(
                        'title' => $title,
                        'body' => array(
                            'where'=>$where,
                            'videoId'=>$videoId,
                            'videoName'=>$title,
                            'url'=>$url_video,
                            'videoType'=>$videoType,
                            'batch_name' =>(!empty($batch_data['batch_name'])) ? $batch_data['batch_name'] : "" ,
                            'batch_id'=>$batch_id
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
    function readMoreWord($story_desc, $title='',$C_word='') {
        $chars = 90;
        if(!empty($C_word)){
            $chars =$C_word;
        }
        
        $count_word = strlen($story_desc);
        if($count_word>$chars){
            $readMore = '<a class="charaViewPopupModel" data-title="'.$title.'" data-word="'.$story_desc.'"  href="javascript:;">  .... </a>';
    	    $story_desc = substr($story_desc,0,$chars);  
    	    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    	    $story_desc = $story_desc.' '.$readMore;  
    	    return $story_desc;  
    	    
        }else{
            return $story_desc; 
        }
    }
    
       function readMoreChapter($story_desc, $title='',$C_word='') {
        $chars = 90;
        if(!empty($C_word)){
            $chars =$C_word;
        }
        
        $count_word = strlen($story_desc);
        if($count_word>$chars){
            $readMore = '<a class="charaViewPopupModel" data-title="'.$title.'" data-word="'.$story_desc.'"  href="javascript:;">  .... </a>';
    	   // $story_desc = substr($story_desc,0,$chars);  
    	    $story_desc = substr($story_desc,0,strrpos($story_desc,' '));  
    	    $story_desc = $story_desc.' '.$readMore;  
    	    return $story_desc;  
    	    
        }else{
            return $story_desc; 
        }
    }
	
	function student_doubts_class($tid) {
        
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
                $or_like = '';
				$userdata = $this->db_model->select_data('id','students','','',array('id','desc'),$like);
				$usersId =array();
				foreach($userdata as $key){
					array_push($usersId,$key['id']);
				}
				$uId = implode(', ', $usersId);
				$condd = "student_id in ($uId) AND teacher_id = $tid";
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            if($this->session->userdata('role')==1){
                $cond = array('admin_id'=>$_SESSION['uid']);
                if(!empty($get['subject'])){
                    $cond.=" subjects_id=".$get['subject'];
                }
            }else{
                $cond = "teacher_id = $tid";
                if(!empty($get['subject'])){
                    $cond.=" AND subjects_id=".$get['subject'];
                }
            }
			
        			$doubts_data = $this->db_model->select_data('*','student_doubts_class',$cond,$limit,array('doubt_id','desc'));
//             if(!empty($condd)){
// 				if(!empty($uId)){
// 					$doubts_data = $this->db_model->select_data('*','student_doubts_class',$condd,$limit,array('doubt_id','desc'));
// 				}else{
// 					$doubts_data = '';
// 				}
// 			}else{
// 				$doubts_data = $this->db_model->select_data('*','student_doubts_class',$cond,$limit,array('doubt_id','desc'),'','','',$or_like);
//                 //echo $this->db->last_query();
//             }
            
            if(!empty($doubts_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }else if($role == '3'){
                    $profile = 'teacher';
                }
    
                foreach($doubts_data as $key=>$value){
                    
                    
                    $userName =$this->db_model->select_data('name,image','students',array('id'=>$value['student_id']),1);
                    
                    $batchName = current($this->db_model->select_data('batch_name,start_date,end_date','batches',array('id'=>$value['batch_id']),1));
                    
                    if (!empty($userName)){ 
                        $image = '<img src="'.base_url().'uploads/students/'.$userName[0]['image'].'" title="'.$userName[0]['name'].'" class="view_large_image"></a>';
                    }else{
                        $image = '<img src="'.base_url().'assets/images/student_img.png" title="" class="view_large_image"></a>';
                    }
                    if(!empty($userName)){
                        $user_name =$this->readMoreWord($userName[0]['name'], 'Student Name',15);
                    }else{
                        $user_name='';
                    }

                    if(!empty($batchName)){
                        $batch_name =$this->readMoreWord(!empty($batchName['batch_name'])?$batchName['batch_name']:'', 'Batch Name',15);
                    }else{
                        $batch_name='';
                    }
                    $subName =$this->db_model->select_data('subject_name','subjects',array('id'=>$value['subjects_id']),1);
                    
                    if(!empty($subName)){
                        $sub_name =$this->readMoreWord($subName[0]['subject_name'], 'Subject Name',15);
                    }else{
                        $sub_name='';
                    }
                    
                    $chapter_Name="";
                    $chap_id =$value['chapters_id'];
                    if(!empty($chap_id)){
                        $chapterCon = "id in ($chap_id)";
                    
	                $chapterName = current($this->db_model->select_data('chapter_name','chapters',$chapterCon,''));
                    }
                    else{
                        
                        $chapterName = '';
                    }
	                
	                if(!empty($chapterName)){
	                $chapter_Name =$this->readMoreWord($chapterName['chapter_name'], 'Subject Name',15);
	                $apru = !empty($value['appointment_time'])?'yes':'no';
					$statusDrop = ($value['status'] == 1) ? '<span class="greentext">'.$this->lang->line('ltr_approved').'</span>' : '<select data-id="'.$value['doubt_id'].'" data-apru="'.$apru.'" data-table ="student_doubts_class" data-userid="'.$value['student_id'].'" data-batchid="'.$value['batch_id'].'" class="form-control doubtStatus datatableSelect">
                        <option value="1" '.(($value['status'] == 1) ? 'selected':'').'>'.$this->lang->line('ltr_approve').'</option>
                        <option class="redtext" value="2" '.(($value['status'] == 2) ? 'selected':'').'>'.$this->lang->line('ltr_decline').'</option>
                        <option value="0" '.(($value['status'] == 0) ? 'selected':'').'>'.$this->lang->line('ltr_pending').'</option>
                    </select>';
					
	           }
					$doubtDate = ($value['appointment_date']!= '0000-00-00')?date('d-m-Y',strtotime($value['appointment_date'])):'';
					$doubtTime = !empty($value['appointment_time'])?$value['appointment_time']:'';
					$doubtDes = !empty($value['teacher_description'])?$value['teacher_description']:'';
					
					$action = '<p class="actions_wrap"><a class="appointmentDate" title="Date" data-startDate="'.date('d-m-Y').'" data-endDate="'.date('d-m-Y',strtotime($batchName['end_date'])).'" data-id="'.$value['doubt_id'].'" data-doubtDate="'.$doubtDate.'" data-doubtTime="'.$doubtTime.'" data-doubtDes="'.$doubtDes.'" data-userid="'.$value['student_id'].'" data-batchid="'.$value['batch_id'].'"><i class="fa fa-calendar"></i></a> 
				
                        <a class="doubtDeleteData btn_delete" title="Delete" data-id="'.$value['doubt_id'].'" data-table="student_doubts_class"><i class="fa fa-trash"></i></a></p>';
					
					$des =$this->readMoreWord($value['users_description'], $this->lang->line('ltr_description'),15);
	                $dataarray[] = array(
                                '<input type="checkbox" class="checkOneRow" value="'.$value['doubt_id'].'">',
                                $count,
                                $image.$user_name,
                                $batch_name,
                                $sub_name,
                                $chapter_Name,
                                $des,
                                $statusDrop,
								$action
                               
                        ); 
                
                $count++;
                }
               
                $recordsTotal = count($doubts_data);
    
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
	
	function change_status_doubts(){
	   
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                $ins = $this->db_model->update_Data_limit($this->input->post('table',TRUE),$this->security->xss_clean(array('status'=>$this->input->post('status',TRUE))),array('doubt_id'=>$this->input->post('id',TRUE)));
                if($ins){
                    $resp = array('status'=>1);
                    $user_id = $this->input->post('student_id',TRUE);
                    $batch = $this->input->post('batch_id',TRUE);

					if(!empty($user_id)){
					  
						$title =$this->lang->line('ltr_doubts_class');
						$where ="doubtsClass";
						$batch_id= $batch;
						$this->push_notification_android($batch_id,$title,$where,$user_id);
					
                    }
                   
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	
	function doubtsDeleteData(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
                
                $res = $this->db_model->delete_data($this->input->post('table',TRUE),array('doubt_id'=>$this->input->post('id',TRUE)));
                
                if($res){
                    
                    $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_deleted_msg'));
                }else{
                    $resp = array('status'=>'0'); 
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	
	function edit_doubts(){
    //   print_r($_POST);
    //   print_r($_SESSION);
    //   die();
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('doubts_date',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
               
                if($data_arr['doubt_id']=="all"){
                   // $data_up['admin_id'] = $this->session->userdata('uid');
                    $data_up['appointment_date'] = date('Y-m-d',strtotime($data_arr['doubts_date']));
                    $data_up['appointment_time'] = $data_arr['doubts_time'];
                   
                    $data_up['teacher_description'] = $data_arr['description'];
                    $data_up['status'] = 1;
                    $data_up = $this->security->xss_clean($data_up);
                    $ids=json_decode($data_arr['ids']);
                    for($i=0;$i<count($ids);$i++){
                        $id = $ids[$i];
                        $ins = $this->db_model->update_data_limit('student_doubts_class',$data_up,array('doubt_id'=>$id),1);
                    }               
                    
                    if($ins==true){
                        $user_id = $this->input->post('student_id',TRUE);
                        if(!empty($user_id)){
                            $title ="Doubts Class";
                            $where ="doubtsClass";
                            $batch_id=$data_arr['batch_id'];
                            $this->push_notification_android($batch_id,$title,$where,$user_id);         
                        }
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_updated_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                    $id = $data_arr['doubt_id'];
                    $data_up['admin_id'] = $this->session->userdata('uid');
                    $data_up['appointment_date'] = date('Y-m-d',strtotime($data_arr['doubts_date']));
                    $data_up['appointment_time'] = $data_arr['doubts_time'];
                   
                    $data_up['teacher_description'] = $data_arr['description'];
                    $data_up['status'] = 1;
                    $data_up = $this->security->xss_clean($data_up);
                    
                                   
                    $ins = $this->db_model->update_data_limit('student_doubts_class',$data_up,array('doubt_id'=>$id),1);
                    if($ins==true){
                          $user_id = $this->input->post('student_id',TRUE);
                        if(!empty($user_id)){
                            $title ="Doubts Class";
                            $where ="doubtsClass";
                            $batch_id=$data_arr['batch_id'];
                            $this->push_notification_android($batch_id,$title,$where,$user_id);         
                        }
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_updated_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }
                
                
            }else{
				$student_id = $this->session->userdata('uid');
				$batch_id = $this->session->userdata('batch_id');
				$arrayData=array(
								'student_id'=>$student_id,
								'batch_id'=>$batch_id,
								);
				if(!empty($this->input->post('subject_id',TRUE))){
					$arrayData['subjects_id']= $this->input->post('subject_id',TRUE);
				}
				
				if(!empty($this->input->post('teacher_id',TRUE))){
					$arrayData['teacher_id']= $this->input->post('teacher_id',TRUE);
				}
				
				if(!empty($this->input->post('chapter_id',TRUE))){
					$arrayData['chapters_id']= $this->input->post('chapter_id',TRUE);
				}
				
				if(!empty($this->input->post('description',TRUE))){
					$arrayData['users_description']= $this->input->post('description',TRUE);
				}
				$adm_id = $this->db_model->select_data('*','sudent_batchs',array('student_id'=>$student_id,'batch_id'=>$batch_id));
	        	$arrayData['admin_id']= $adm_id[0]['admin_id'];
				$checkusers = $this->db_model->select_data('doubt_id','student_doubts_class',array('teacher_id'=>$_POST['teacher_id'],'batch_id'=>$batch_id,'status'=>0,'student_id'=>$student_id,'subjects_id'=>$_POST['subject_id'],'chapters_id'=>$_POST['chapter_id']),'',array('doubt_id ','desc'));
		
				if(empty($checkusers)){
					$coundUsers = count($this->db_model->select_data('doubt_id ','student_doubts_class',array('teacher_id'=>$_POST['teacher_id'],'batch_id'=>$batch_id),'',array('doubt_id ','desc')));
					
					if($coundUsers<=10){
			
						$data_arr = $this->security->xss_clean($arrayData);
						$ins = $this->db_model->insert_data('student_doubts_class',$data_arr);
						$resp = array('status'=>1,'msg'=>$this->lang->line('ltr_doubt_request_msg'));
					}else{
						$resp = array('status'=>0,'msg'=>$this->lang->line('ltr_something_msg'));
					}
					
				}else{
					$resp = array('status'=>0,'msg'=> $this->lang->line('ltr_doubt_request_already_msg'));
				}
			} 
			echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	
	function student_doubts_ask($id) {
        
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
                $or_like = '';
				$userdata = $this->db_model->select_data('id','students','','',array('id','desc'),$like);
				$usersId =array();
				foreach($userdata as $key){
					array_push($usersId,$key['id']);
				}
				$uId = implode(', ', $usersId);
				$condd = "student_id in ($uId) AND student_id = $id";
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            
			$cond = "student_id = $id";
        		
            
         
            if(!empty($condd)){
				if(!empty($uId)){
					$doubts_data = $this->db_model->select_data('*','student_doubts_class',$condd,$limit,array('doubt_id','desc'));
				}else{
					$doubts_data = '';
				}
			}else{
				$doubts_data = $this->db_model->select_data('*','student_doubts_class',$cond,$limit,array('doubt_id','desc'),'','','',$or_like);
            }
            
            if(!empty($doubts_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }else if($role == '3'){
                    $profile = 'teacher';
                }
    
                foreach($doubts_data as $key=>$value){
                    
                    
                    $userName =$this->db_model->select_data('name,image','students',array('id'=>$value['student_id']),1);
                    
                    $batchName = $this->db_model->select_data('batch_name,start_date,end_date','batches',array('id'=>$value['batch_id']),1);
                    
                    if (!empty($userName[0]['image'])){ 
                        $image = '<img src="'.base_url().'uploads/students/'.$userName[0]['image'].'" title="'.$userName[0]['name'].'" class="view_large_image"></a>';
                    }else{
                        $image = '<img src="'.base_url().'assets/images/student_img.png" title="'.$userName[0]['name'].'" class="view_large_image"></a>';
                    }
                    $user_name =$this->readMoreWord($userName[0]['name'], 'Student Name',15);
                    
                    $batch_name =$this->readMoreWord(!empty($batchName[0]['batch_name'])?$batchName[0]['batch_name']:'', 'Batch Name',15);
                    
                    $subName =$this->db_model->select_data('subject_name','subjects',array('id'=>$value['subjects_id']),1);
                    
                    $sub_name =$this->readMoreWord($subName[0]['subject_name'], 'Subject Name',15);
                    
                    
                    $chap_id =$value['chapters_id'];
                    $chapterCon = "id in ($chap_id)";
	                $chapterName = $this->db_model->select_data('chapter_name','chapters',$chapterCon,'');
	                
	                $chapter_Name =$this->readMoreWord($chapterName[0]['chapter_name'], 'Subject Name',15);
	                $apru = !empty($value['appointment_time'])?'yes':'no';
					if($value['status'] == 1) { $statusDrop= '<span class="greentext">'.$this->lang->line('ltr_approved').'</span>' ;}else if($value['status'] == 2){ $statusDrop ='<span class="redtext">'.$this->lang->line('ltr_decline').'</span>' ;}else{ $statusDrop =$this->lang->line('ltr_pending') ;}
                        
					$doubtDate = ($value['appointment_date']!= '0000-00-00')?date('d-m-Y',strtotime($value['appointment_date'])):'';
					$doubtTime = !empty($value['appointment_time'])?$value['appointment_time']:'';
					$doubtDes = !empty($value['teacher_description'])?$value['teacher_description']:'';
					
					$action = '<p class="actions_wrap"><a class="appointmentDate hide" title="Date" data-startDate="'.date('d-m-Y').'" data-endDate="'.date('d-m-Y',strtotime($batchName[0]['end_date'])).'" data-id="'.$value['doubt_id'].'" data-doubtDate="'.$doubtDate.'" data-doubtTime="'.$doubtTime.'" data-doubtDes="'.$doubtDes.'"><i class="fa fa-calendar"></i></a> 
					<a class="viewDoubt btn_view" title="View" data-id="'.$value['doubt_id'].'"><i class="fa fa-eye"></i></a>
                        <a class="doubtDeleteData btn_delete" title="Delete" data-id="'.$value['doubt_id'].'" data-table="student_doubts_class"><i class="fa fa-trash"></i></a></p>';
					
					$des =$this->readMoreWord($value['users_description'], $this->lang->line('ltr_description'),15);
	                $dataarray[] = array(
                                $count,
                                $image.$user_name,
                                $batch_name,
                                $sub_name,
                                $chapter_Name,
                                $des,
                                $statusDrop,
								$action
                               
                        ); 
                
                $count++;
                }
               
                $recordsTotal = count($doubts_data);
    
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
	
	function studentDoubtsAsk($id) {
        
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
                $or_like = '';
				$userdata = $this->db_model->select_data('id','users','','',array('id','desc'),$like);
				$usersId =array();
				foreach($userdata as $key){
					array_push($usersId,$key['id']);
				}
				$uId = implode(', ', $usersId);
				$condd = "teacher_id in ($uId) AND student_id = $id";
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            
			$cond = "student_id = $id";
        		
            
         
            if(!empty($condd)){
				if(!empty($uId)){
					$doubts_data = $this->db_model->select_data('*','student_doubts_class',$condd,$limit,array('doubt_id','desc'));
				}else{
					$doubts_data = '';
				}
			}else{
				$doubts_data = $this->db_model->select_data('*','student_doubts_class',$cond,$limit,array('doubt_id','desc'),'','','',$or_like);
            }
            
            if(!empty($doubts_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }else if($role == '3'){
                    $profile = 'teacher';
                }
    
                foreach($doubts_data as $key=>$value){
                    
                    
                    $userName =$this->db_model->select_data('name,teach_image','users',array('id'=>$value['teacher_id']),1);
                    
                    $batchName = $this->db_model->select_data('batch_name,start_date,end_date','batches',array('id'=>$value['batch_id']),1);
                    
                    if (!empty($userName[0]['teach_image'])){ 
                        $image = '<img src="'.base_url().'uploads/teachers/'.$userName[0]['teach_image'].'" title="'.$userName[0]['teach_image'].'" class="view_large_image"></a>';
                    }else{
                        $image = '<img src="'.base_url().'assets/images/student_img.png" title="'.$userName[0]['teach_image'].'" class="view_large_image"></a>';
                    }
                    $user_name =$this->readMoreWord($userName[0]['name'], 'Student Name',15);
                    
                    $batch_name =$this->readMoreWord(!empty($batchName[0]['batch_name'])?$batchName[0]['batch_name']:'', 'Batch Name',15);
                    
                    $subName =$this->db_model->select_data('subject_name','subjects',array('id'=>$value['subjects_id']),1);
                    
                    $sub_name =$this->readMoreWord($subName[0]['subject_name'], 'Subject Name',15);
                    
                    
                    $chap_id =$value['chapters_id'];
                    $chapterCon = "id in ($chap_id)";
	                $chapterName = $this->db_model->select_data('chapter_name','chapters',$chapterCon,'');
	                
	                $chapter_Name =$this->readMoreWord($chapterName[0]['chapter_name'], 'Subject Name',15);
	                $apru = !empty($value['appointment_time'])?'yes':'no';
	                $disable='studentViewDoubt ';
					if($value['status'] == 1){
						$statusDrop='<span class="greentext">'.$this->lang->line('ltr_approve').'</span>';
					}else if($value['status'] == 2){
						$statusDrop='<span class="redtext">'.$this->lang->line('ltr_decline').'</span>';
					}else if($value['status'] == 0){
						$statusDrop=$this->lang->line('ltr_pending');
						$disable='';
					}
					
					$doubtDate = ($value['appointment_date']!= '0000-00-00')?date('d-m-Y',strtotime($value['appointment_date'])):'';
					$doubtTime = !empty($value['appointment_time'])?$value['appointment_time']:'';
					$doubtDes = !empty($value['teacher_description'])?$value['teacher_description']:'';
					
					$action = '<p class="actions_wrap">
					<a class="'.$disable.' btn_view" title="View" data-doubtDate="'.$doubtDate.'" data-doubtTime="'.$doubtTime.'" data-doubtDes="'.$doubtDes.'" data-id="'.$value['doubt_id'].'" ><i class="fa fa-eye"></i></a>
                     </p>';
					
					$des =$this->readMoreWord($value['users_description'], $this->lang->line('ltr_description'),15);
	                $dataarray[] = array(
                                $count,
                                $image.$user_name,
                                $batch_name,
                                $sub_name,
                                $chapter_Name,
                                $des,
                                $statusDrop,
								$action
                               
                        ); 
                
                $count++;
                }
               
                $recordsTotal = count($doubts_data);
    
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
	
	function payment_history(){
        
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            // print_r($_SESSION);
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                //  $con = array("student_id in ($uId)");
                $con='';
            }else if($this->session->userdata('role') == 1 && $super == 0){
                $con = array('admin_id'=>$this->session->userdata('uid'),"student_id in ($uId)");
            }else if($this->session->userdata('role') == 3 && $super == 0){
                $con = array('admin_id'=>$this->session->userdata('uid'),"student_id in ($uId)");
            }
             
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
                $or_like = '';
				$userdata = $this->db_model->select_data('id','students','','',array('id','desc'),$like);
				$usersId =array();
				foreach($userdata as $key){
					array_push($usersId,$key['id']);
				}
				$uId = implode(', ', $usersId);
				$condd = "student_id in ($uId)";
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            if(isset($get['from_date']) || isset($get['to_date'])){
                if($get['from_date']!='' && $get['to_date']!=''){ 
                    $frm_date = $this->db->escape(date('Y-m-d',strtotime($get['from_date'])));
                    $to_date = $this->db->escape(date('Y-m-d',strtotime($get['to_date'])));
                    $con .= " date(create_at) >= $frm_date AND date(create_at) <= $to_date";
                }
            }
            
         
            if(!empty($condd)){
				if(!empty($uId)){
                    if(isset($get['from_date']) || isset($get['to_date'])){
                        if($get['from_date']!='' && $get['to_date']!=''){ 
                            $frm_date = $this->db->escape(date('Y-m-d',strtotime($get['from_date'])));
                            $to_date = $this->db->escape(date('Y-m-d',strtotime($get['to_date'])));
                           $condd .= " AND date(create_at) >= $frm_date AND date(create_at) <= $to_date";
                        }
                    }
					$doubts_data = $this->db_model->select_data('*','student_payment_history',$condd,$limit,array('id','desc'));
				}else{
					$doubts_data = '';
				}
			}else{
				$doubts_data = $this->db_model->select_data('*','student_payment_history',$con,$limit,array('id','desc'),'','','',$or_like);
            }
            
            if(!empty($doubts_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }else if($role == '3'){
                    $profile = 'teacher';
                }
    
            
                foreach($doubts_data as $key=>$value){
                  
                    $userName =$this->db_model->select_data('name,image','students',array('id'=>$value['student_id']),1);
                   if(!empty($userName)){
                    $batchName = $this->db_model->select_data('batch_name,start_date,end_date','batches',array('id'=>$value['batch_id']),1);
                    
                    if (!empty($userName[0]['image'])){ 
                        $image = '<img src="'.base_url().'uploads/students/'.$userName[0]['image'].'" title="'.$userName[0]['image'].'" class="view_large_image"></a>';
                    }else{
                        $image = '<img src="'.base_url().'assets/images/student_img.png" title="'.$userName[0]['image'].'" class="view_large_image"></a>';
                    }
                    $user_name =$this->readMoreWord($userName[0]['name'], 'Student Name',15);
                    
                    $batch_name =$this->readMoreWord(!empty($batchName[0]['batch_name'])?$batchName[0]['batch_name']:'', 'Batch Name',15);
				   
                    
	                $dataarray[] = array(
                                $count,
                                $image.$user_name,
                                $batch_name,
                                $value['mode'],
                                $value['transaction_id'],
                                $value['amount'].' '.$this->general_settings('currency_decimal_code'),
                                date('d-m-Y',strtotime($value['create_at'])),
                               
                        ); 
				   }
                $count++;
                }
               
                $recordsTotal = count($doubts_data);
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => !empty($dataarray)?$dataarray:'',
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
        
        function edit_email_setting(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            
				if(!empty($this->input->post('server_type',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('server_type',TRUE)),array('key_text'=>'server_type'),1);
				}
				
				if(!empty($this->input->post('smtp_host',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('smtp_host',TRUE)),array('key_text'=>'smtp_host'),1);
				}
				
				if(!empty($this->input->post('smtp_username',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('smtp_username',TRUE)),array('key_text'=>'smtp_mail'),1);
				}
				
				if(!empty($this->input->post('smtp_password',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('smtp_password',TRUE)),array('key_text'=>'smtp_pwd'),1);
				}
				
				if(!empty($this->input->post('smtp_port',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('smtp_port',TRUE)),array('key_text'=>'smtp_port'),1);
				}
				
				if(!empty($this->input->post('smtp_encryption',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('smtp_encryption',TRUE)),array('key_text'=>'smtp_encryption'),1);
				}
			
				$resp = array('status'=>1,'msg'=>$this->lang->line('ltr_updated_msg'));
					
			    echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    
    function edit_firebase_setting(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){

            $where = array('key_text' => 'firebase_key');
            $check = $this->db_model->select_data('*','general_settings',$where);

            if(!empty($check)){
                
                if(!empty($this->input->post('firebase_key',TRUE))){
					$this->db_model->update_data_limit('general_settings',array('velue_text'=>$this->input->post('firebase_key',TRUE)),array('key_text'=>'firebase_key'),1);
                
                $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_updated_msg'));
                }
            }
            else{

                $data_arr['title'] = 'Firebase Accounts';
                $data_arr['key_text'] = 'firebase_key';
                $data_arr['velue_text'] = $_POST['firebase_key'];
                $data_arr = $this->security->xss_clean($data_arr);

                $result = $this->db_model->insert_data('general_settings',$data_arr);

                $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_added_msg'));

            }
				
					
			    echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    
    function convertCurrency(){
        // print_r($_POST);
        // die();
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
               if(!empty($_POST['amount'])){
                   $amount = $_POST['amount'];
                   $from_currency =$this->general_settings('currency_code');
    			   $payment_type_get =$this->general_settings('payment_type');
    			   if($payment_type_get==2){
    			       $to_currency='USD';
    			   }else{
    			       $to_currency='INR';
    			   }
                  $apikey = $this->general_settings('currency_converter_api');
                  $from_Currency = urlencode($from_currency);
                  $to_Currency = urlencode($to_currency);
                  $query =  "{$from_Currency}_{$to_Currency}";
                
                  // change to the free URL if you're using the free version
                  //$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
                 echo $url = "https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}";
                  $ch = curl_init();
                   curl_setopt ($ch, CURLOPT_URL, $url);
                   curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
                   curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                   $contents = curl_exec($ch);
                    
                  @$obj = json_decode($contents, true);
                  $val = floatval($obj["$query"]);
                 
                  echo $total = $val * $amount;
                  $convert = number_format($total, 2, '.', '');
                  $resp = array('status'=>1,'convert'=>$convert);
               }else{
                  $resp = array('status'=>2);
               }		
			  echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
                echo $this->lang->line('ltr_not_allowed_msg');
            } 
        }
        
        //new update
        // function add_book(){

        //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
        //         if(!empty($this->input->post('title',TRUE))){
        //             $data_arr = $this->input->post();
        //             $id = $this->input->post('id',TRUE);                
        //             if($this->session->userdata('role') == 1){
        //                 $data_arr['admin_id'] = $this->session->userdata('uid');
        //             }else{
        //                 $data_arr['admin_id'] = $this->session->userdata('admin_id');
        //             }
        //             //print_r($data_arr['batch']);
    
    
        //         if(!empty($id)){
        //             $batch_data = $data_arr['batch'];
        //             $data_arr['batch']=json_encode($data_arr['batch']);
        //             $data_arr['added_by'] = $this->session->userdata('uid');
        //             $data_arr['status'] = 1; 
        //             $data_arr['added_at'] = date('Y-m-d H:i:s'); 
        //              if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
        //                 $config['upload_path'] ='./uploads/book/';
        //                 $config['allowed_types'] = '*';
        //                 $config['max_size']    = '0';       
        //                 $this->load->library('upload', $config);
        //                 $filename = '';     
                        
        //                 if ($this->upload->do_upload('pdf_file')){
        //                     $uploaddata=$this->upload->data();
        //                     $pic=$uploaddata['raw_name'];
        //                     $pic_ext = $uploaddata['file_ext'];
        //                     $image=$pic.date('ymdHis').$pic_ext;
        //                     rename('./uploads/book/'.$pic.$pic_ext,'./uploads/book/'.$image);
                           
        //                   $data_arr['file_name'] =$image; 
        //                 }else{
        //                     $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
        //                     return $resp;
        //                 } 
        //             }    
        //             $data_arr = $this->security->xss_clean($data_arr);
        //             // $ins = $this->db_model->insert_data('book_pdf',$data_arr);
        //             $ins = $this->db_model->update_data_limit('book_pdf',$data_arr,array('id'=>$data_arr['id']),1);
        //             // echo $this->db->last_query();
        //             if($ins==true){
        //                 $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_book_update_msg'));
        //             }else{
        //                 $resp = array('status'=>0);
    
        //             }
        //         }else{
           
        //           $data_arr2['admin_id']= $data_arr['admin_id'];
        //           $data_arr2['title']= $data_arr['title'];                   
        //           $batch_data = $data_arr['batch_id'];
        //           $data_arr2['batch']=json_encode($data_arr['batch_id']);
        //           $data_arr2['subject']= $data_arr['subject_id'];                  
        //           $data_arr2['status'] = 1; 
        //           $data_arr2['added_by'] = $this->session->userdata('uid');
        //           $data_arr2['added_at'] = date('Y-m-d H:i:s'); 
        //              if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
        //                 $config['upload_path'] ='./uploads/book/';
        //                 $config['allowed_types'] = '*';
        //                 $config['max_size']    = '0';       
        //                 $this->load->library('upload', $config);
        //                 $filename = '';     
                        
        //                 if ($this->upload->do_upload('pdf_file')){
        //                     $uploaddata=$this->upload->data();
        //                     $pic=$uploaddata['raw_name'];
        //                     $pic_ext = $uploaddata['file_ext'];
        //                     $image=$pic.date('ymdHis').$pic_ext;
        //                     rename('./uploads/book/'.$pic.$pic_ext,'./uploads/book/'.$image);
                           
        //                   $data_arr2['file_name'] =$image; 
        //                 }else{
        //                     $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
        //                     return $resp;
        //                 } 
        //             }    
        //             $data_arr = $this->security->xss_clean($data_arr2);
        //   //     print_r($data_arr2);
        //   // die();
        //             $ins = $this->db_model->insert_data('book_pdf',$data_arr);
    
    
        //             if($ins==true){
                       
        //                     $data['batch_id'] = $batch_data[0];
        //                     $data['notification_type'] = "Library";
        //                     $data['msg'] = 'New Book Added';
        //                     $data['url'] = 'student/book';
        //                     $data['time'] = date('Y-m-d H:i:s');
        //                     $data['seen_by'] = '';
        //                     $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $batch_data[0],'status'=>'1'));
        //                   for($i=0;$i<count($student_data);$i++){
        //                   $data['student_id'] = $student_data[$i]['id'];
        //                   $book_not = $this->db_model->insert_data('notifications',$data);  
        //                   }
                          
        //                 //send push notice
                        
        //                 for($i=0;$i<count($batch_data);$i++){
        //                     $title="add New Book";
        //                     $where ="addNewBook";
        //                     $batch_id=$batch_data[$i];
        //                     $this->push_notification_android($batch_id,$title,$where);
        //                 }
        //                  $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_book_added_msg'));
                         
        //             }else{
        //                 $resp = array('status'=>0);
        //             }
        //         }
            
        //             echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        //         } 
        //     }else{
        //         echo $this->lang->line('ltr_not_allowed_msg');
        //     } 
        // }
         function add_book(){

            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
                if(!empty($this->input->post('title',TRUE))){
                    $data_arr = $this->input->post();
                    $id = $this->input->post('id',TRUE);                
                    if($this->session->userdata('role') == 1){
                        $data_arr['admin_id'] = $this->session->userdata('uid');
                    }else{
                        $data_arr['admin_id'] = $this->session->userdata('admin_id');
                    }
                    //print_r($data_arr['batch']);
    
    
                if(!empty($id)){
                   $data_arr2['admin_id']= $data_arr['admin_id'];
                   $data_arr2['title']= $data_arr['title'];                   
                   $batch_data = $data_arr['batch_id'];
                   $data_arr2['batch']=json_encode($data_arr['batch_id']);
                   $data_arr2['subject']= $data_arr['subject_id'];                  
                   $data_arr2['status'] = 1; 
                   $data_arr2['added_by'] = $this->session->userdata('uid');
                   $data_arr2['added_at'] = date('Y-m-d H:i:s'); 
                     if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                        $config['upload_path'] ='./uploads/book/';
                        $config['allowed_types'] = '*';
                        $config['max_size']    = '0';       
                        $this->load->library('upload', $config);
                        $filename = '';     
                        
                        if ($this->upload->do_upload('pdf_file')){
                            $uploaddata=$this->upload->data();
                            $pic=$uploaddata['raw_name'];
                            $pic_ext = $uploaddata['file_ext'];
                            $image=$pic.date('ymdHis').$pic_ext;
                            rename('./uploads/book/'.$pic.$pic_ext,'./uploads/book/'.$image);
                          
                           $data_arr2['file_name'] =$image; 
                        }else{
                            $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                            return $resp;
                        } 
                    }    
                    $data_arr = $this->security->xss_clean($data_arr2);
                    // $ins = $this->db_model->insert_data('book_pdf',$data_arr);
                  
                    $ins = $this->db_model->update_data_limit('book_pdf',$data_arr,array('id'=>$_POST['id']),1);
                    // echo $this->db->last_query();
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_book_update_msg'));
                    }else{
                        $resp = array('status'=>0);
    
                    }
                }else{
           
                   $data_arr2['admin_id']= $data_arr['admin_id'];
                   $data_arr2['title']= $data_arr['title'];                   
                   $batch_data = $data_arr['batch_id'];
                   $data_arr2['batch']=json_encode($data_arr['batch_id']);
                   $data_arr2['subject']= $data_arr['subject_id'];                  
                   $data_arr2['status'] = 1; 
                   $data_arr2['added_by'] = $this->session->userdata('uid');
                   $data_arr2['added_at'] = date('Y-m-d H:i:s'); 
                     if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                        $config['upload_path'] ='./uploads/book/';
                        $config['allowed_types'] = '*';
                        $config['max_size']    = '0';       
                        $this->load->library('upload', $config);
                        $filename = '';     
                        
                        if ($this->upload->do_upload('pdf_file')){
                            $uploaddata=$this->upload->data();
                            $pic=$uploaddata['raw_name'];
                            $pic_ext = $uploaddata['file_ext'];
                            $image=$pic.date('ymdHis').$pic_ext;
                            rename('./uploads/book/'.$pic.$pic_ext,'./uploads/book/'.$image);
                           
                           $data_arr2['file_name'] =$image; 
                        }else{
                            $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                            return $resp;
                        } 
                    }    
                    $data_arr = $this->security->xss_clean($data_arr2);
        //       print_r($data_arr2);
        //   die();
                    $ins = $this->db_model->insert_data('book_pdf',$data_arr);
    
    
                    if($ins==true){
                       
                            $data['batch_id'] = $batch_data[0];
                            $data['notification_type'] = "Library";
                            $data['msg'] = 'New Book Added';
                            $data['url'] = 'student/book';
                            $data['time'] = date('Y-m-d H:i:s');
                            $data['seen_by'] = '';
                            $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $batch_data[0],'status'=>'1'));
                          for($i=0;$i<count($student_data);$i++){
                          $data['student_id'] = $student_data[$i]['id'];
                          $book_not = $this->db_model->insert_data('notifications',$data);  
                          }
                          
                        //send push notice
                        
                        for($i=0;$i<count($batch_data);$i++){
                            $title="add New Book";
                            $where ="addNewBook";
                            $batch_id=$batch_data[$i];
                            $this->push_notification_android($batch_id,$title,$where);
                        }
                         $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_book_added_msg'));
                         
                    }else{
                        $resp = array('status'=>0);
                    }
                }
            
                    echo json_encode($resp,JSON_UNESCAPED_SLASHES);
                } 
            }else{
                echo $this->lang->line('ltr_not_allowed_msg');
            } 
        }
        
	
   function add_library(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post();
               
                if($this->session->userdata('role') == 1){
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                }else{
                    $data_arr['admin_id'] = $this->session->userdata('admin_id');
                }
                //print_r($data_arr['batch']);
                $data_arr['added_by'] = $this->session->userdata('uid');
				$data_arr['status'] =1;
                 if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                    $config['upload_path'] ='./uploads/library/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '0';       
                    $this->load->library('upload', $config);
                    $filename = '';     
                    
                    if ($this->upload->do_upload('pdf_file')){
                        $uploaddata=$this->upload->data();
                        $pic=$uploaddata['raw_name'];
                        $pic_ext = $uploaddata['file_ext'];
                        $image=$pic.date('ymdHis').$pic_ext;
                        rename('./uploads/library/'.$pic.$pic_ext,'./uploads/library/'.$image);
                       
                       $data_arr['file_name'] =$image; 
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                        return $resp;
                    } 
                }    
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('library_books',$data_arr);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_added_msg'));
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
	function library_table(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
             $role = $this->session->userdata('role');
            $like ='';
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
               $or_like = ''; 
            }
			
            if($role == 1){  
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 3){
                $cond = array('added_by'=>$this->session->userdata('uid'), 'admin_id'=>$this->session->userdata('admin_id'));
            }else if($role == 'student'){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
            } 
    
            $videos = $this->db_model->select_data('*','library_books',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            //echo $this->db->last_query();
            if(!empty($videos)){
                
                foreach($videos as $vid){
                    $action = '
                    <a class="viewPdf_ btn_view" title="View" data-id="'.$vid['id'].'" href="'.base_url('student/file-view/library/').$vid['id'].'" target="_blank" data-url="uploads/library/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
                    <a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="library_books"><i class="fa fa-trash"></i></a></p>';
                    
                    
                    if($vid['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="library_books" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table="library_books" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    $added_by = $this->db_model->select_data('name','users use index (id)',array('id'=>$vid['added_by']),1)[0]['name'];
                 
                    if($role == 1){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            $vid['author_name'],
						    $added_by,
							$statusDrop,
                            $action
                        ); 
                    }else if($role == 3){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            $vid['author_name'],
                            $statusDrop,
                            $action
                        ); 
                    }else if($role == 'student'){
                        $action = '<p class="actions_wrap"><a class="viewPdf1 btn_view" title="View" href="'.base_url('student/file-view/library/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/library/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a></p>';
                        $dataarray[] = array(
                            $count,
                            $vid['title'],
                            $vid['author_name'],
                            $action
                        ); 
                    }
                    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('library_books',$cond,'','',$like,'','',$or_like);
    
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
	
	function library_request(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
             $role = $this->session->userdata('role');
            $like ='';
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
        
           
            if($role == 1){  
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 3){
                $cond = array('added_by'=>$this->session->userdata('uid'), 'admin_id'=>$this->session->userdata('admin_id'));
            }else if($role == 'student'){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'),'user_id'=>$this->session->userdata('uid'));
            } 
    
            $videos = $this->db_model->select_data('*','library_request',$cond,$limit,array('id','desc'),$like);
            //echo $this->db->last_query();
            if(!empty($videos)){
        
                foreach($videos as $vid){
                    $action = '<a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="library_request"><i class="fa fa-trash"></i></a></p>';
                    
					if($role == 'student'){
						if($vid['status'] == 1) { $statusDrop= '<span class="greentext">'.$this->lang->line('ltr_approved').'</span>' ;
						}else if($vid['status'] == 2){ $statusDrop ='<span class="redtext">'.$this->lang->line('ltr_decline').'</span>' ;
						}else{ $statusDrop =$this->lang->line('ltr_pending') ;}
					}else{
						$statusDrop = '<select data-id="'.$vid['id'].'" data-table ="library_request"  class="form-control changesStatus">
							<option class="greentext" value="1" '.(($vid['status'] == 1) ? 'selected':'').'>'.$this->lang->line('ltr_approve').'</option>
							<option class="redtext" value="2" '.(($vid['status'] == 2) ? 'selected':'').'>'.$this->lang->line('ltr_decline').'</option>
							<option value="0" '.(($vid['status'] == 0) ? 'selected':'').'>'.$this->lang->line('ltr_pending').'</option>
						</select>';
					}
                   
                    $userName = $this->db_model->select_data('*','students use index (id)',array('id'=>$vid['user_id']),1);
					if (!empty($userName)){ 
                        $image = '<img src="'.base_url().'uploads/students/'.$userName[0]['image'].'" title="'.$userName[0]['name'].'" class="view_large_image"></a>';
                    }else{
                        $image = '<img src="'.base_url().'assets/images/student_img.png" title="" class="view_large_image"></a>';
                    }
                    if(!empty($userName)){
                        $user_name =$this->readMoreWord($userName[0]['name'], 'Student Name',15);
                    }else{
                        $user_name='';
                    }
					$check_book = $this->db_model->select_data('*','library_books',array('id'=>$vid['library_id']),1);
                    if(!empty($check_book)){
						
						$book_name =$this->readMoreWord($check_book[0]['title'], 'Book Name',30);
						$author_name =$this->readMoreWord($check_book[0]['author_name'], 'Author Name',30);
						$file_name =$check_book[0]['id'];
					}else{
						$book_name ='';
						$author_name ='';
						$file_name='';
					}
                    if($role == 1){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $image.$user_name,
                            $book_name,
						    date('d-m-Y',strtotime($vid['request_date'])),
							($vid['approved_date'] !='0000-00-00 00:00:00')? date('d-m-Y',strtotime($vid['approved_date'])) :'',
							$statusDrop,
                            $action
                        ); 
                    }else if($role == 3){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $image.$user_name,
                            $book_name,
                            date('d-m-Y',strtotime($vid['request_date'])),
							($vid['approved_date'] !='0000-00-00 00:00:00')? date('d-m-Y',strtotime($vid['approved_date'])) :'',
							$statusDrop,
                            $action
                        ); 
                    }else if($role == 'student'){
                        $action = '<p class="actions_wrap"><a class="viewPdf_1 btn_view" title="View" href="'.base_url('student/file-view/library/').$file_name.'" target="_blank"><i class="fa fa-eye"></i></a></p>';
                        $dataarray[] = array(
                            $count,
                            $book_name,
                            $author_name,
                            date('d-m-Y',strtotime($vid['request_date'])),
							($vid['approved_date'] !='0000-00-00 00:00:00')? date('d-m-Y',strtotime($vid['approved_date'])) :'',
							$statusDrop,
							($vid['status']==1)? $action:''
                            
							
                        ); 
                    }
                    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('library_request',$cond,'','',$like,'','');
    
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
	
	function changeStatus(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('table',TRUE))){
				if(($this->input->post('table',TRUE)=='library_request')){
					$date= date('Y-m-d H:i:s');
					$ins = $this->db_model->update_Data_limit($this->input->post('table',TRUE),$this->security->xss_clean(array('status'=>$this->input->post('status',TRUE),'approved_date'=>$date)),array('id'=>$this->input->post('id',TRUE)));
				}
                if($ins){
                    $resp = array('status'=>1);
                   
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    
    function preview_change(){
        
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
           
            $data['id'] = $this->input->post('id',TRUE);
            $preview = array('preview_type' => $this->input->post('preview_type',TRUE));
            // print_r($preview);
			$data = $this->security->xss_clean($data);
			$ins = $this->db_model->update_Data_limit('video_lectures',$preview,array('id'=>$data['id']));
			                    
                if($ins){
                    $resp = array('status'=>1);
                   
                }else{
                    $resp = array('status'=>0);
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        
    }
	
	function add_request(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('id',TRUE))){
				
				$user_id =$this->session->userdata('uid');
				$cond = array('user_id'=>$user_id,'library_id'=>$this->input->post('id',TRUE));
				$check_request = $this->db_model->select_data('*','library_request',$cond,'',array('id','desc'));
				if(empty($check_request)){
					$data_arr['user_id'] =$user_id;
					$data_arr['library_id'] =$this->input->post('id',TRUE);
					$data_arr['admin_id'] =$this->session->userdata('admin_id');
					$data_arr['request_date'] =date('Y-m-d H:i:s');
					$data_arr = $this->security->xss_clean($data_arr);
					$ins = $this->db_model->insert_data('library_request',$data_arr);
					
					if($ins){
						$resp = array('status'=>1,'msg'=>$this->lang->line('ltr_added_msg'));
					   
					}else{
						$resp = array('status'=>0,'msg'=>$this->lang->line('ltr_something_msg'));
					}
				}else{
					$resp = array('status'=>0,'msg'=>$this->lang->line('ltr_request_exists'));
				}
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    public function edit_library_module(){
         $common = $this->db_model->select_data('*',$_POST['table_name'],array('id'=> $_POST['id'])); 
         echo json_encode($common);
    }
	
    function book_table(){
      
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
             $role = $this->session->userdata('role');
             $super = $this->session->userdata('super_admin');
            if($role =='student'){
            $like = array('batch','"'.$this->session->userdata('batch_id').'"');
            }else{
              $like ='';  
            }
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
               $or_like = ''; 
            }

            if(isset($get['subject'])){
                if($get['subject']!=''){   
                    $like = array('subject',$get['subject']); 
                }
            }
            
              if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($role == 1 && $super == 1){  
                 $cond = '';
            }else if($role == 1 && $super == 1){
                $cond = '';
            }
            else if($role == 3){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'));
            }else if($role == 'student'){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'));
                // $cond = array('batch'=>$this->session->userdata('batch_id'));
            }
    
            $videos = $this->db_model->select_data('*','book_pdf use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            //echo $this->db->last_query();
            if(!empty($videos)){
                foreach($videos as $vid){
                    if($_SESSION['admin_id']!=$vid['added_by']){
                         $action = " 
                        <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/book/").$vid["id"]."' target='_blank' data-url='uploads/book/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                        <p class='actions_wrap'><a class='edit_book btn_edit' title='Edit' data-batch='".implode(",",json_decode($vid['batch']))."' data-table='book_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                        <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='book_pdf'><i class='fa fa-trash'></i></a></p>";
                    }else{
                         $action = " 
                            <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/book/").$vid["id"]."' target='_blank' data-url='uploads/book/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                            <p class='actions_wrap'><a class='btn_edit' title='Edit'><i class='fa fa-edit disabled'></i></a>
                            <a class='btn_delete button_disbled_cursor'><i class='fa fa-trash disabled'></i></a></p>";
                    }
                    // $action = " 
                    //     <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/book/").$vid["id"]."' target='_blank' data-url='uploads/book/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                    //     <p class='actions_wrap'><a class='edit_book btn_edit' title='Edit' data-batch='".implode(",",json_decode($vid['batch']))."' data-table='book_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                    //     <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='book_pdf'><i class='fa fa-trash'></i></a></p>";
                   if($_SESSION['admin_id']!=$vid['added_by']){
                        if($vid['status'] == 1){
                             $statusDrop = '<div class="admin_tbl_status_wrap" ><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="book_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                        }else{
                            $statusDrop = '<div class="admin_tbl_status_wrap" >
                            <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="book_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                        }
                   }else{
                        if($vid['status'] == 1){
                             $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor" ><a class="tbl_status_btn light_sky_bg "  data-table ="book_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                        }else{
                            $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor" >
                            <a class="tbl_status_btn light_red_bg " data-table ="book_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                        }
                   }
                    // if($vid['status'] == 1){
                    //          $statusDrop = '<div class="admin_tbl_status_wrap" ><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="book_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    //     }else{
                    //         $statusDrop = '<div class="admin_tbl_status_wrap" >
                    //         <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="book_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    //     }
                    $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$vid['added_by']),1);
                   
                    if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    $batch_id = json_decode($vid['batch']);
                    $bach_name = '';
                    
                    foreach($batch_id as $bid){
                        $batch = current($this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$bid),1));
                        $bach_name .= $batch['batch_name'].', ';
                    }
                   $subject = current($this->db_model->select_data('subject_name','subjects use index (id)',array('id'=>$vid['subject']),1));
                    $bach_name = rtrim($bach_name,", ");
                    if($role == 1){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($bach_name)?$bach_name:''),
                            $subject['subject_name'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 3){
                       // print_r($_SESSION);
                        if($_SESSION['admin_id']!=$vid['added_by']){
                            $action = "
                            <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("teacher/file-view/book/").$vid["id"]."' target='_blank' data-url='uploads/book/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                            <p class='actions_wrap'><a class='edit_book btn_edit' title='Edit' data-batch='".implode(",",json_decode($vid['batch']))."' data-table='book_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                            <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='book_pdf'><i class='fa fa-trash'></i></a></p>";
                        }else{
                            	$action = '
                            <a class="viewPdf_ btn_view" title="View" data-id="'.$vid['id'].'" href="'.base_url('teacher/file-view/book/').$vid['id'].'" target="_blank" data-url="uploads/book/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
                            <p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                            <a class=" btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
                        }
                    
                    
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($batch)?$batch['batch_name']:''),
                            $subject['subject_name'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 'student'){
                        $action = '<p class="actions_wrap"><a class="viewPdf1 btn_view" title="View" href="'.base_url('student/file-view/book/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/book/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a></p>';
                        $dataarray[] = array(
                            $count,
                            $vid['title'],
                            $subject['subject_name'],
                            $action
                        ); 
                    }
                    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('book_pdf use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    /*Book manage end*/

    /*Notes manage start*/
    function add_notes(){
       
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post();
                $id = $this->input->post('id',TRUE);                
                if($this->session->userdata('role') == 1){
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                }else{
                    $data_arr['admin_id'] = $this->session->userdata('admin_id');
                }
                // print_r($data_arr['batch']);
                // echo $data_arr['batch'][0];
                // die();
                if(empty($id)){
                $batch_data = $data_arr['batch'];
                
                $data_arr['batch']=json_encode($data_arr['batch']);
                $data_arr['added_by'] = $this->session->userdata('uid');
                $data_arr['status'] = 1; 
                $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                 if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                    $config['upload_path'] ='./uploads/notes/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '0';       
                    $this->load->library('upload', $config);
                    $filename = '';     
                    
                    if ($this->upload->do_upload('pdf_file')){
                        $uploaddata=$this->upload->data();
                        $pic=$uploaddata['raw_name'];
                        $pic_ext = $uploaddata['file_ext'];
                        $image=$pic.date('ymdHis').$pic_ext;
                        rename('./uploads/notes/'.$pic.$pic_ext,'./uploads/notes/'.$image);
                       
                       $data_arr['file_name'] =$image; 
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                        return $resp;
                    } 
                }    
              
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('notes_pdf',$data_arr);
                
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_notes_added_msg'));
                    
                    for($i=0;$i<count($batch_data);$i++){
                        
                    //send push notice

                        $title="add New Notes";
                        $where ="addNewNotes";
                        $batch_id= $batch_data[$i];
                        $this->push_notification_android($batch_id,$title,$where);
                    
                    // notification 
                     
                        $data['batch_id'] = $batch_data[$i];
                        $data['notification_type'] = "Notes";
                        $data['msg'] = 'New Notes Added';
                        $data['url'] = 'student/notes';
                        $data['time'] = date('Y-m-d H:i:s');
                        $data['seen_by'] = '';
                        $student_data = $this->db_model->select_data('id','students', array('batch_id'=> $data['batch_id'],'status'=>'1'));

                      for($j=0;$j<count($student_data);$j++){
                      $data['student_id'] = $student_data[$j]['id'];
                        $notes_not = $this->db_model->insert_data('notifications',$data);  
                      }
                    }
                    
                }else{
                    $resp = array('status'=>0);
                }
            }else{
                $batch_data = $data_arr['batch'];
                
                $data_arr['batch']=json_encode($data_arr['batch']);
                $data_arr['added_by'] = $this->session->userdata('uid');
                $data_arr['status'] = 1; 
                $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                 if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                    $config['upload_path'] ='./uploads/notes/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '0';       
                    $this->load->library('upload', $config);
                    $filename = '';     
                    
                    if ($this->upload->do_upload('pdf_file')){
                        $uploaddata=$this->upload->data();
                        $pic=$uploaddata['raw_name'];
                        $pic_ext = $uploaddata['file_ext'];
                        $image=$pic.date('ymdHis').$pic_ext;
                        rename('./uploads/notes/'.$pic.$pic_ext,'./uploads/notes/'.$image);
                       
                       $data_arr['file_name'] =$image; 
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                        return $resp;
                    } 
                }    
              
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->update_data_limit('notes_pdf',$data_arr,array('id'=>$data_arr['id']),1);
                // $ins = $this->db_model->insert_data('notes_pdf',$data_arr);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_notes_update_msg'));

                }else{
                    $resp = array('status'=>0);
                }
            }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    // function notes_table(){
      
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         $post = $this->input->post(NULL,TRUE);
    //         $get = $this->input->get(NULL,TRUE);
    //          $role = $this->session->userdata('role');
    //         if($role =='student'){
    //         $like = array('batch','"'.$this->session->userdata('batch_id').'"');
    //         }else{
    //           $like ='';
    //         }
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
    //           $or_like = ''; 
    //         }

    //          if(isset($get['subject']) || isset($get['chapter'])){
    //             if($get['subject']!='' && $get['chapter']!=''){   
    //                 $like = array('topic',urldecode($get['chapter'])); 
    //             }
    //         }
        
    //         if($role == 1){  
    //             $cond = array('admin_id'=>$this->session->userdata('uid'));
    //         }else if($role == 3){
    //             $cond = '';
    //         }else if($role == 'student'){
    //             $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
    //         } 
    
    //         $videos = $this->db_model->select_data('*','notes_pdf use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    //         //echo $this->db->last_query();
    //         if(!empty($videos)){
                
    //             foreach($videos as $vid){
    //                 // $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('admin/file-view/notes/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/notes/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
    //                 // <p class="actions_wrap"><a class="edit_note btn_edit" title="Edit" data-id="'.$vid['id'].'" data-file="'.$vid['file_name'].'"><i class="fa fa-edit""></i></a>
    //                 // <a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="notes_pdf"><i class="fa fa-trash"></i></a></p>';
    //                  $action = "
    //                     <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/notes/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
    //                     <p class='actions_wrap'><a class='edit_note btn_edit' title='Edit' data-topic_id='".implode(",",json_decode($vid['topic']))."' data-subject_id='".implode(",",json_decode($vid['subject']))."' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-table='notes_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
    //                     <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='notes_pdf'><i class='fa fa-trash'></i></a></p>";
    //                 if($vid['status'] == 1){
    //                     $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
    //                 }else{
    //                     $statusDrop = '<div class="admin_tbl_status_wrap">
    //                 <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
    //                 }
    //                 $added_by = current($this->db_model->select_data('name','users use index (id)',array('id'=>$vid['added_by']),1));
    //                 $batch_id = json_decode($vid['batch']);
    //                 $bach_name = '';
                    
    //                 foreach($batch_id as $bid){
    //                     $batch = current($this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$bid),1));
    //                     $bach_name .= $batch['batch_name'].', ';
    //                 }
                   
    //                 $bach_name = rtrim($bach_name,", ");
    //                 if($role == 1){
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
    //                         $count,
    //                         $vid['title'],
    //                         (!empty($bach_name)?$bach_name:''),
    //                         $vid['subject'],
    //                         $vid['topic'],
    //                         $statusDrop,
    //                         $added_by['name'],
    //                         $action
    //                     ); 
    //                 }else if($role == 3){
                        
    //                     if($vid['added_by'] != '1'){
    //                          $action = "
    //                             <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("teacher/file-view/notes/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
    //                             <p class='actions_wrap'><a class='edit_note btn_edit' title='Edit' data-topic_id='".implode(",",json_decode($vid['topic']))."' data-subject_id='".implode(",",json_decode($vid['subject']))."' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-table='notes_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
    //                             <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='notes_pdf'><i class='fa fa-trash'></i></a></p>";
						
				// // 		 $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('teacher/file-view/notes/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/notes/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
    // //                      <p class="actions_wrap"><a class="edit_note btn_edit" title="Edit" data-id="'.$vid['id'].'" data-file="'.$vid['file_name'].'"><i class="fa fa-edit""></i></a>
    // //                 <a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="notes_pdf"><i class="fa fa-trash"></i></a></p>';
                    
    //             }else{
    //                 $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('teacher/file-view/notes/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/notes/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
    //                 <p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
    //                 <a class="btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
    //             } 
                    
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
    //                         $count,
    //                         $vid['title'],
    //                         (!empty($batch)?$batch['batch_name']:''),
    //                         $vid['subject'],
    //                       $vid['topic'],
    //                         $statusDrop,
    //                         $added_by['name'],
    //                         $action
    //                     ); 
    //                 }else if($role == 'student'){
    //                     $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('student/file-view/notes/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/notes/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a></p>';
    //                     $dataarray[] = array(
    //                         $count,
    //                         $vid['title'],
    //                         $vid['subject'],
    //                         $vid['topic'],
    //                         $action
    //                     ); 
    //                 }
                    
    //                 $count++;
    //             }
    
    //             $recordsTotal = $this->db_model->countAll('notes_pdf use index (id)',$cond,'','',$like,'','',$or_like);
    
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
     function notes_table(){
      
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
             $role = $this->session->userdata('role');
             $super = $this->session->userdata('super_admin');
            if($role =='student'){
            $like = array('batch','"'.$this->session->userdata('batch_id').'"');
            }else{
              $like ='';
            }
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
               $or_like = ''; 
            }

             if(isset($get['subject']) || isset($get['chapter'])){
                if($get['subject']!='' && $get['chapter']!=''){   
                    $like = array('topic',urldecode($get['chapter'])); 
                }
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            
            if($role == 1 && $super == 1){  
                 $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 1 && $super == 0){
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 3){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'));
            }else if($role == 'student'){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
            }
            $videos = $this->db_model->select_data('*','notes_pdf use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
            //echo $this->db->last_query();
            if(!empty($videos)){
                
                foreach($videos as $vid){ 
                    if($_SESSION['admin_id']!=$vid['added_by']){
                        $action = "
                            <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/notes/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                            <p class='actions_wrap'><a class='edit_note btn_edit' title='Edit' data-topic_id='".implode(",",json_decode($vid['topic']))."' data-subject_id='".implode(",",json_decode($vid['subject']))."' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-table='notes_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                            <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='notes_pdf'><i class='fa fa-trash'></i></a></p>";
                    }else{
                         $action = " 
                            <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/book/").$vid["id"]."' target='_blank' data-url='uploads/book/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                            <p class='actions_wrap'><a class='btn_edit' title='Edit'><i class='fa fa-edit disabled'></i></a>
                            <a class='btn_delete button_disbled_cursor'><i class='fa fa-trash disabled'></i></a></p>";
                    }
                    
                   if($_SESSION['admin_id']!=$vid['added_by']){
                        if($vid['status'] == 1){
                            $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                        }else{
                            $statusDrop = '<div class="admin_tbl_status_wrap">
                            <a class="tbl_status_btn light_red_bg" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                        }
                    }else{
                       if($vid['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor"><a class="tbl_status_btn light_sky_bg" data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                        }else{
                            $statusDrop = '<div class="admin_tbl_status_wrap disabled button_disbled_cursor">
                        <a class="tbl_status_btn light_red_bg " data-id="'.$vid['id'].'" data-table ="notes_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                        }
                    }
                    // $name = current($this->db_model->select_data('*','users use index (id)',array('id'=>$vid['added_by']),1));
                    $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$vid['added_by']),1);
                    // print_r($name[0]['admin_id']);
                    // die();
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     }else{
                         $added_by = '';
                     }
                    $batch_id = json_decode($vid['batch']);
                    $bach_name = '';
                    
                    foreach($batch_id as $bid){
                        $batch = current($this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$bid),1));
                        $bach_name .= $batch['batch_name'].', ';
                    }
                   $subject = current($this->db_model->select_data('subject_name,id','subjects use index (id)',array('id'=>$vid['subject']),1));
                    // print_r($subject);
                    $topic = current($this->db_model->select_data('*','chapters use index (id)',array('id'=>$vid['topic']),1));
                    $bach_name = rtrim($bach_name,", ");
                    if($role == 1){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($bach_name)?$bach_name:''),
                            $subject['subject_name'],
                            $topic['chapter_name'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 3){
                        
                        if($_SESSION['admin_id']!=$vid['added_by']){
    						 $action = "
                            <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("teacher/file-view/notes/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                            <p class='actions_wrap'><a class='edit_note btn_edit' title='Edit' data-topic_id='".implode(",",json_decode($vid['topic']))."' data-subject_id='".implode(",",json_decode($vid['subject']))."' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-table='notes_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                            <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='notes_pdf'><i class='fa fa-trash'></i></a></p>";
                            
                        }else{
                            $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('teacher/file-view/notes/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/notes/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
                            <p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                            <a class="btn_delete button_disbled_cursor"><i class="fa fa-trash disabled"></i></a></p>';
                        } 
                    
                      
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            //(!empty($batch)?$batch['batch_name']:''),
                             (!empty($bach_name)?$bach_name:''),
                            $subject['subject_name'],
                            $topic['chapter_name'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 'student'){
                        $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('student/file-view/notes/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/notes/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a></p>';
                        $dataarray[] = array(
                            $count,
                            $vid['title'],
                            $subject['subject_name'],
                            $topic['chapter_name'],
                            $action
                        ); 
                    }
                    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('notes_pdf use index (id)',$cond,'','',$like,'','',$or_like);
    
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
    /*Notes manage end */
    
    function get_subjects(){
    //  print_r($_POST);
    //  die();
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('batch_id',TRUE))){

                if(is_array($this->input->post('batch_id'))){
                $batch_id = implode(', ', $this->input->post('batch_id',TRUE));
                
				$condd = "batch_id in ($batch_id)";
				if(count($this->input->post('batch_id',TRUE))>1){
                 
                 $chapterArray=array();
                  for($i=0;$i<count($this->input->post('batch_id',TRUE));$i++){
                      $sub_data = current($this->db_model->select_data('GROUP_CONCAT(subjects.id) as subject','subjects use index (id)',array('batch_id'=>$_POST['batch_id'][$i]),'','','',array('batch_subjects','batch_subjects.subject_id=subjects.id')));
                      $chapterArray[] = explode(',',$sub_data['subject']);
                    }
                        $a_diff=call_user_func_array('array_intersect',$chapterArray);
                        $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)','','','','','','','',array('id',implode($a_diff)));
                  
				}else{
				    $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',$condd,'',array('id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
                    
				}
            }else{
                $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',array('batch_id'=>$this->input->post('batch_id')),'',array('id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));

            }
                
                $html = '<option value="">select subject</option>';
                if(!empty($subjectData)){
                    foreach($subjectData as $subject){
                        
                            $html .= '<option value="'.$subject['id'].'">'.$subject['subject_name'].'</option>';
                        
                    }
                }
                $resp = array('status'=>1,'html'=>$html,);
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }
        }else{
            echo 'Not allowed to access direclty.';
        } 
    }

    function paidPreviewVideo(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $data= json_decode($this->input->post('ids',TRUE));
            $table= $this->input->post('table_name',TRUE);
            $column= $this->input->post('column',TRUE);
            for($i=0;$i<count($data);$i++){
                $id = $data[$i];
                //$this->db_model->delete_data($table,array($column=>$id));
                $data_arr =array('preview_type'=>'not_preview');
                $data_arr = $this->security->xss_clean($data_arr);
                $this->db_model->update_data_limit($table,$data_arr,array('id'=>$id));
            }
            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_updated_msg'));
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }

    function freePreviewVideo(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $data= json_decode($this->input->post('ids',TRUE));
            $table= $this->input->post('table_name',TRUE);
            $column= $this->input->post('column',TRUE);
            for($i=0;$i<count($data);$i++){
                $id = $data[$i];
                //$this->db_model->delete_data($table,array($column=>$id));
                $data_arr =array('preview_type'=>'preview');
                $data_arr = $this->security->xss_clean($data_arr);
                $this->db_model->update_data_limit($table,$data_arr,array('id'=>$id));
            }
            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_updated_msg'));
            echo json_encode($resp,JSON_UNESCAPED_SLASHES);
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    
    function add_old_paper(){
        // print_r($_POST);
        // die();
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('title',TRUE))){
                $data_arr = $this->input->post();
               $id = $this->input->post('id',TRUE);
                if($this->session->userdata('role') == 1){
                    $data_arr['admin_id'] = $this->session->userdata('uid');
                }else{
                    $data_arr['admin_id'] = $this->session->userdata('admin_id');
                }
                if(empty($id)){
                //print_r($data_arr['batch']);
                $batch_data=$data_arr['batch'];
                $data_arr['batch']=json_encode($data_arr['batch']);
                $data_arr['added_by'] = $this->session->userdata('uid');
                $data_arr['status'] = 1; 
                $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                 if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                    $config['upload_path'] ='./uploads/oldpaper/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '0';       
                    $this->load->library('upload', $config);
                    $filename = '';     
                    
                    if ($this->upload->do_upload('pdf_file')){
                        $uploaddata=$this->upload->data();
                        $pic=$uploaddata['raw_name'];
                        $pic_ext = $uploaddata['file_ext'];
                        $image=$pic.date('ymdHis').$pic_ext;
                        rename('./uploads/oldpaper/'.$pic.$pic_ext,'./uploads/oldpaper/'.$image);
                       
                       $data_arr['file_name'] =$image; 
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                        return $resp;
                    } 
                }    
                $data_arr = $this->security->xss_clean($data_arr);
                $ins = $this->db_model->insert_data('old_paper_pdf',$data_arr);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_oldp_added_msg'));
                    //send push notice
                    
                    for($i=0;$i<count($batch_data);$i++){
                        $title="add old paper";
                        $where ="addOldPaper";
                        $batch_id=$batch_data[$i];
                        $this->push_notification_android($batch_id,$title,$where);
                    }
                }else{
                    $resp = array('status'=>0);
                }
            }else{
                $batch_data=$data_arr['batch'];
                $data_arr['batch']=json_encode($data_arr['batch']);
                $data_arr['added_by'] = $this->session->userdata('uid');
                $data_arr['status'] = 1; 
                $data_arr['added_at'] = date('Y-m-d H:i:s'); 
                 if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])){
                    $config['upload_path'] ='./uploads/oldpaper/';
                    $config['allowed_types'] = '*';
                    $config['max_size']    = '0';       
                    $this->load->library('upload', $config);
                    $filename = '';     
                    
                    if ($this->upload->do_upload('pdf_file')){
                        $uploaddata=$this->upload->data();
                        $pic=$uploaddata['raw_name'];
                        $pic_ext = $uploaddata['file_ext'];
                        $image=$pic.date('ymdHis').$pic_ext;
                        rename('./uploads/oldpaper/'.$pic.$pic_ext,'./uploads/oldpaper/'.$image);
                       
                       $data_arr['file_name'] =$image; 
                    }else{
                        $resp = array('status'=>'2', 'msg' => $this->upload->display_errors());
                        return $resp;
                    } 
                }    
                $data_arr = $this->security->xss_clean($data_arr);
                // $ins = $this->db_model->insert_data('old_paper_pdf',$data_arr);
                $ins = $this->db_model->update_data_limit('old_paper_pdf',$data_arr,array('id'=>$data_arr['id']),1);
                if($ins==true){
                    $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_oldpaper_update_msg'));

                }else{
                    $resp = array('status'=>0);
                }
            }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }
    // function old_paper_table(){
    //     if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    //         $post = $this->input->post(NULL,TRUE);
    //         $get = $this->input->get(NULL,TRUE);
    //         $role = $this->session->userdata('role');
    //         if($role =='student'){
    //         $like = array('batch','"'.$this->session->userdata('batch_id').'"');
    //         }else{
    //           $like ='';  
    //         }
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
    //           $or_like = ''; 
    //         }

    //          if(isset($get['subject']) || isset($get['chapter'])){
    //             if($get['subject']!='' && $get['chapter']!=''){   
    //                 $like = array('topic',urldecode($get['chapter'])); 
    //             }
    //         }
        
    //         if($role == 1){  
    //             $cond = array('admin_id'=>$this->session->userdata('uid'));
    //         }else if($role == 3){
    //             $cond = '';
    //         }else if($role == 'student'){
    //             $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
    //         } 
    
    //         $videos = $this->db_model->select_data('*','old_paper_pdf use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);
    //     //   echo $this->db->last_query();
    //         if(!empty($videos)){
                
    //             foreach($videos as $vid){
    //                 $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('admin/file-view/old_paper/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/oldpaper/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
    //                 <p class="actions_wrap"><a class="edit_oldpaper btn_edit" title="Edit" data-id="'.$vid['id'].'" data-file="'.$vid['file_name'].'"><i class="fa fa-edit""></i></a>
    //                 <a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="old_paper_pdf"><i class="fa fa-trash"></i></a></p>';
    
    //                 if($vid['status'] == 1){
    //                     $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="old_paper_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
    //                 }else{
    //                     $statusDrop = '<div class="admin_tbl_status_wrap">
    //                 <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="old_paper_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
    //                 }
    //                 $added_by = $this->db_model->select_data('name','users use index (id)',array('id'=>$vid['added_by']),1)[0]['name'];
    //                 $batch_id = json_decode($vid['batch']);
    //                 $bach_name = '';
                    
    //                 foreach($batch_id as $bid){
    //                     $batch = $this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$bid),1);
    //                     if($batch){
    //                         $bach_name .= $batch[0]['batch_name'].', ';

    //                     }
    //                     $bach_name .='';
    //                 }
    //                 if($bach_name){
    //                 $bach_name = rtrim($bach_name,", ");
    //                 }
    //                 if($role == 1){
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
    //                         $count,
    //                         $vid['title'],
    //                         (!empty($bach_name)?$bach_name:''),
    //                         $vid['subject'],
    //                         $statusDrop,
    //                         $added_by,
    //                         $action
    //                     ); 
    //                 }else if($role == 3){           
    //                   if($vid['added_by'] != '1'){
    //                         $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('teacher/file-view/old_paper/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/oldpaper/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
    //                         <p class="actions_wrap"><a class="edit_oldpaper btn_edit" title="Edit" data-id="'.$vid['id'].'" data-file="'.$vid['file_name'].'"><i class="fa fa-edit""></i></a>
    //                         <a class="deleteData btn_delete" title="Delete" data-id="'.$vid['id'].'" data-table="old_paper_pdf"><i class="fa fa-trash"></i></a></p>';
    //                   }else{       
    //                       $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('teacher/file-view/old_paper/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/oldpaper/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
    //                       <p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
    //                       <a class="btn_delete button_disbled_cursor" title="Delete"><i class="fa fa-trash disabled"></i></a></p>';
    //                   }            
					                        
    //                     $dataarray[] = array(
    //                         '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
    //                         $count,
    //                         $vid['title'],
    //                         (!empty($batch)?$batch[0]['batch_name']:''),
    //                         $vid['subject'],
    //                         $statusDrop,
    //                         $added_by,
    //                         $action
    //                     ); 
    //                 }else if($role == 'student'){
    //                     $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('student/file-view/old_paper/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/oldpaper/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a></p>';
    //                     $dataarray[] = array(
    //                         $count,
    //                         $vid['title'],
    //                         $vid['subject'],
    //                         $action
    //                     ); 
    //                 }
                    
    //                 $count++;
    //             }
    
    //             $recordsTotal = $this->db_model->countAll('old_paper_pdf use index (id)',$cond,'','',$like,'','',$or_like);
    
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
     function old_paper_table(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            $role = $this->session->userdata('role');
            $super = $this->session->userdata('super_admin');
            if($role =='student'){
            $like = array('batch','"'.$this->session->userdata('batch_id').'"');
            }else{
              $like ='';  
            }
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
               $or_like = ''; 
            }

             if(isset($get['subject']) || isset($get['chapter'])){
                if($get['subject']!='' && $get['chapter']!=''){   
                    $like = array('topic',urldecode($get['chapter'])); 
                }
            }
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            
            if($role == 1 && $super == 1){  
                 $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 1 && $super == 0){
                $cond = array('admin_id'=>$this->session->userdata('uid'));
            }else if($role == 3){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'));
            }else if($role == 'student'){
                $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
            }
    
            $videos = $this->db_model->select_data('*','old_paper_pdf use index (id)',$cond,$limit,array('id','desc'),$like,'','',$or_like);

        //   echo $this->db->last_query();
            if(!empty($videos)){
                
                foreach($videos as $vid){
                    $subject = current($this->db_model->select_data('subject_name','subjects use index (id)',array('id'=>$vid['subject']),1));
                 if($_SESSION['admin_id']!=$vid['added_by']){
                     $action = "
                    <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/old_paper/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                    <p class='actions_wrap'><a class='edit_oldpaper  btn_edit' title='Edit' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-table='old_paper_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                    <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='old_paper_pdf'><i class='fa fa-trash'></i></a></p>";
                 }else{
                      $action = "
                    <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("admin/file-view/old_paper/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                    <p class='actions_wrap'><a class='btn_edit' title='Edit'><i class='fa fa-edit disabled'></i></a>
                    <a class='btn_delete button_disbled_cursor'><i class='fa fa-trash disabled'></i></a></p>";
                    
                 }
            if($_SESSION['admin_id']!=$vid['added_by']){
                    if($vid['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="old_paper_pdf" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$vid['id'].'" data-table ="old_paper_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
            }else{
                if($vid['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap  button_disbled_cursor disabled" ><a class="tbl_status_btn button_disbled_cursor light_sky_bg "  data-table ="old_paper_pdf" data-status ="0" href="javascript:;" disabled>'.$this->lang->line('ltr_active').'</a></div>';
                }else{
                    $statusDrop = '<div class="admin_tbl_status_wrap button_disbled_cursor disabled" >
                    <a class="tbl_status_btn light_red_bg "  disabled data-table ="old_paper_pdf" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                }
        }        
                    // $added_by = $this->db_model->select_data('name','users use index (id)',array('id'=>$vid['added_by']),1)[0]['name'];
                    $name = $this->db_model->select_data('*','users use index (id)',array('id'=>$vid['added_by']),1);
                     if($name){
                         if($name[0]['admin_id']==1 && $name[0]['super_admin'] == 1)
                         {
                             $added_by= $name[0]['name']."  (Super Admin) ";
                         }else{
                             $added_by = $name[0]['name']."  (Sub-Admin)";
                         }
                     // $added_by = $name[0]['name'];
                     }else{
                         $added_by = '';
                     }
                    $batch_id = json_decode($vid['batch']);
                    $bach_name = '';
                    
                    foreach($batch_id as $bid){
                        $batch = $this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$bid),1);
                        if($batch){
                            $bach_name .= $batch[0]['batch_name'].', ';

                        }
                        $bach_name .='';
                    }
                    if($bach_name){
                    $bach_name = rtrim($bach_name,", ");
                    }
                    if($role == 1){
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($bach_name)?$bach_name:''),
                            $subject['subject_name'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 3){           
                        if($_SESSION['admin_id']!=$vid['added_by']){
                        $action = "
                            <a class='viewPdf_ btn_view' title='View' data-id='".$vid["id"]."' href='".base_url("teacher/file-view/old_paper/").$vid["id"]."' target='_blank' data-url='uploads/notes/".$vid["file_name"]."'><i class='fa fa-eye'></i></a>
                            <p class='actions_wrap'><a class='edit_oldpaper  btn_edit' title='Edit' data-batch_id='".implode(",",json_decode($vid['batch']))."' data-subject='".$vid['subject']."' data-table='old_paper_pdf'  data-id='".$vid["id"]."' data-file='".$vid["file_name"]."'><i class='fa fa-edit'></i></a>
                            <a class='deleteData btn_delete' title='Delete' data-id='".$vid["id"]."' data-table='old_paper_pdf'><i class='fa fa-trash'></i></a></p>";
                       }else{       
                           $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('teacher/file-view/old_paper/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/oldpaper/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a>
                           <p class="actions_wrap"><a class="btn_edit" title="Edit"><i class="fa fa-edit disabled"></i></a>
                           <a class="btn_delete button_disbled_cursor" title="Delete"><i class="fa fa-trash disabled"></i></a></p>';
                       }            
					                        
                        $dataarray[] = array(
                            '<input type="checkbox" class="checkOneRow" value="'.$vid['id'].'">',
                            $count,
                            $vid['title'],
                            (!empty($batch)?$batch[0]['batch_name']:''),
                            $subject['subject_name'],
                            $statusDrop,
                            $added_by,
                            $action
                        ); 
                    }else if($role == 'student'){
                        $action = '<p class="actions_wrap"><a class="viewPdf_ btn_view" title="View" href="'.base_url('student/file-view/old_paper/').$vid['id'].'" target="_blank" data-id="'.$vid['id'].'" data-url="uploads/oldpaper/'.$vid['file_name'].'"><i class="fa fa-eye"></i></a></p>';
                        $dataarray[] = array(
                            $count,
                            $vid['title'],
                            $subject['subject_name'],
                            $action
                        ); 
                    }
                    
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('old_paper_pdf use index (id)',$cond,'','',$like,'','',$or_like);
    
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

   function change_notification_status(){
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
             
            $id = $this->input->post('id');
            $data['status'] = 1;
            $data['seen_by'] = date('Y-m-d H:i:s');
            $ins = $this->db_model->update_data_limit('notifications',$data,array('student_id'=>$id,'status'=>'0'));

             if(!empty($ins)){
                $resp = array('status'=>'1', 'msg' =>$this->lang->line('ltr_updated_msg'));
             }
             else{
                $resp = array('status'=>'0', 'msg' =>$this->lang->line('ltr_not_allowed_msg'));
             }

             echo json_encode($resp,JSON_UNESCAPED_SLASHES);

         }
    }
    
    
//     function batch_data(){
//          if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
//             $post = $this->input->post(NULL,TRUE);
            
//         $data['exam'] = $this->db_model->select_data('id,name,batch_id','exams  use index (id)',array('batch_id'=> $post['id'],'admin_id'=>$this->session->userdata('uid'),'type'=>1,'mock_sheduled_date <='=>date('Y-m-d')),'1',array('id','desc'));
	
// 		if(!empty($data['exam'])){
// 		$data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));

// 	   $data['good'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >='=>80));
	   
// 	   $data['poor'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>60));
	   
// 	   $data['avarage'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>80,'mock_result.percentage >='=>60));
// 		}
// 		$result = $this->load->view('admin/batch_data',$data,true);
// 	           echo json_encode(array('status'=>'1','data'=>$result));
//          }
//     }
     function batch_data(){
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);            
             if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                    $cond = array('batch_id'=> $post['id'],'admin_id'=>$post['admin_id'],'type'=>1,'mock_sheduled_date <='=>date('Y-m-d'));
                }
            }           
        $data['exam'] = $this->db_model->select_data('id,name,batch_id','exams  use index (id)',$cond,'1',array('id','desc'),$like);
	
		if(!empty($data['exam'])){
		$data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));

	   $data['good'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >='=>80));
	   
	   $data['poor'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>60));
	   
	   $data['avarage'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>80,'mock_result.percentage >='=>60));
		}
		$result = $this->load->view('admin/batch_data',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
         }
    }
     function batch_data_teacher(){
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            
        $data['exam'] = $this->db_model->select_data('id,name,batch_id','exams  use index (id)',array('batch_id'=> $post['id'],'type'=>1,'mock_sheduled_date <='=>date('Y-m-d')),'1',array('id','desc'));
	
		if(!empty($data['exam'])){
		$data['top_three'] = $this->db_model->select_data('*','mock_result  use index (id)',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >'=>0),'3',array('mock_result.percentage','desc'),'',array('students','students.id=mock_result.student_id'));

	   $data['good'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage >='=>80));
	   
	   $data['poor'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>60));
	   
	   $data['avarage'] = $this->db_model->countAll('mock_result',array('paper_id'=>$data['exam'][0]['id'],'mock_result.percentage <'=>80,'mock_result.percentage >='=>60));
		}
		$result = $this->load->view('teacher/batch_data',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
         }
    }
    
    function batch_data_student(){
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
        $admin_id = $this->session->userdata('admin_id');
       	$uid = $this->session->userdata('uid');
		$batch_id = $post['id'];
		$batch_id_like = '"'.$post['id'].'"';
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
		
		$result = $this->load->view('student/dashboard_student',$data,true);
	           echo json_encode(array('status'=>'1','data'=>$result));
         }
    }
    
    
    function subcategory_data(){
        // print_r($_POST); 
        // die();
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $sub_category = $this->db_model->select_data('id,name,slug','batch_subcategory use index (id)',array('cat_id'=>$post['category_id'],'status'=> 1),'',array('id','desc'));
            // print_r($sub_category);
            if($sub_category){
	        
	       // print_r($data);
	                $output = array(
                    "status" => 1,
                    "data" => $sub_category
                    );
            }else{
                $output = array(
                    "status" => 0,
                    "data" => ''
                );
            }
        
         echo json_encode($output,JSON_UNESCAPED_SLASHES);
         
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 

    }
    
    function single_batchdata(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
           $join = array('subjects', 'batch_subjects.subject_id = subjects.id');
             $subject_data = $this->db_model->select_data('subjects.id,subjects.subject_name','batch_subjects use index (id)',array('batch_id'=>$post['batch_id'],'status'=> 1),'','','',$join);
           
               if($subject_data){
                   foreach($subject_data as $sub){
                      
	                $action = '<option value="'.$sub['id'].'">'.$sub['subject_name'].'</option>';
	   
	                $output = array(
                    "status" => 1,
                    "data" => $action
                    );
                }
            }else{
                
                $action = '<option value="">'.$this->lang->line('ltr_no_result').'</option>';
                $output = array(
                    "status" => 0,
                    "data" => ''
                );
            }
        
         echo json_encode($output,JSON_UNESCAPED_SLASHES);
         
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
        }
        
        function my_batchcourse(){

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            if($post){
           $this->session->set_userdata(array('batch_id' => $post['id']));
                $output = array(
                    "status" => 1
                );
            }else{
                 $output = array(
                    "status" => 0
                    );
            }
	        echo json_encode($output,JSON_UNESCAPED_SLASHES);
         
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        } 
    }

    function manage_certificate($id){
        // print_r($id);
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
             $role = $this->session->userdata('role');
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
      
                $cond = array('sudent_batchs.student_id' => $id);
                $table = 'batches';
                $join = array('batches', 'sudent_batchs.batch_id = batches.id');
         
            if($post['search']['value'] != ''){
                $like = array($table.'.batch_name',$post['search']['value']);
                $or_like = '';
            }else{
               $like = ''; 
               $or_like = ''; 
            }
            
            
            // if(isset($get['id'])){
            //     if($get['id']!=''){   
            //         if($type == 1){
            //             $cond['student_id'] = $get['id'];  
            //         }else{
            //             $cond['teacher_id'] = $get['id'];  
            //         }
            //     }
            // }
    
            $batches = $this->db_model->select_data('batches.batch_name,sudent_batchs.batch_id,sudent_batchs.student_id','sudent_batchs',$cond,$limit,array('sudent_batchs.id','desc'),$like,$join,'',$or_like);
            // print_r($certify);
            // echo $this->db->last_query();
            if(!empty($batches)){
                
                foreach($batches as $cert){
                    $certify = $this->db_model->select_data('*','certificate',array('student_id'=>$cert['student_id'],'batch_id'=>$cert['batch_id']));
                if($role == '1'){
                   if(!empty($certify)){
                    $action = '<p class="actions_wrap ">'.$this->lang->line('ltr_assigned').'</p>';
                    $view = '<p class="actions_wrap"><a href="'.base_url('admin/view-certificate/').$cert['student_id'].'/'.$cert['batch_id'].'" title="View progress"><i class="fa fa-eye"></i></a>';

                   }else{
                    $action = '<button class="certificate btn btn-primary" data-table="students" data-column="id" data-id="'.$cert['student_id'].'" data-batch-id ="'.$cert['batch_id'].'">Assign Certificate</button>';
                    $view = '<p class="actions_wrap"><a class="button_disbled_cursor" title="View progress"><i class="fa fa-eye disabled"></i></a>';
                       
                   }
                }else{
                    if(!empty($certify)){
                    $base_url = base_url();
                    $uid = $this->session->userdata('uid');
                    $action = '<div class="certificate_btn_wrap"><input class="certificate_btn " data-pdfu="'.$uid.'" data-pdfb="'.$cert['batch_id'].'"  data-pdf_url="'.$base_url.'" type="button" id="dwl_create_pdf" value="Download"></div>';
                    $view = '<p class="actions_wrap"><a href="'.base_url('student/student-certificate').'/'.$cert['batch_id'].'" title="View progress"><i class="fa fa-eye"></i></a>';
                    }else{
                    $action = '<p class="actions_wrap ">'.$this->lang->line('ltr_not_assigned').'</p>';
                    $view = '<p class="actions_wrap"><a class="button_disbled_cursor" title="View progress"><i class="fa fa-eye disabled"></i></a>';
                    }

                }  
                 if($role == '1'){
                    $dataarray[] = array(
                        $count,
                        $cert['batch_name'],
                        $action,
                        $view
                    ); 
                 }else{
                      $dataarray[] = array(
                        $count,
                        $cert['batch_name'],
                        $action,
                        $view
                    );
                 }
                    $count++;
               
                }
    
                $recordsTotal = $this->db_model->countAll('sudent_batchs',$cond,'','',$like,$join,'',$or_like);
    
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

    function get_teacher_subject(){
        //  print_r($_POST);
        //  die();
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
                if(!empty($this->input->post('batch_id',TRUE))){
                    // $batch_id = implode(', ', $this->input->post('batch_id',TRUE));
                        if(is_array($this->input->post('batch_id'))){
                            $batch_id = implode(', ', $this->input->post('batch_id',TRUE));
                
				                $condd = "batch_id in ($batch_id)";
                            if(count($this->input->post('batch_id',TRUE))>1){
                        
                                $chapterArray=array();
                                for($i=0;$i<count($this->input->post('batch_id',TRUE));$i++){
                                    $sub_data = current($this->db_model->select_data('GROUP_CONCAT(subjects.id) as subject','subjects use index (id)',array('batch_id'=>$_POST['batch_id'][$i]),'','','',array('batch_subjects','batch_subjects.subject_id=subjects.id')));
                                    $chapterArray[] = explode(',',$sub_data['subject']);
                                }
                                    $a_diff=call_user_func_array('array_intersect',$chapterArray);
                                    $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)','','','','','','','',array('id',implode($a_diff)));
                                
                            }else{
                                $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',$condd,'',array('id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
                                // print_r($subjectData);
                                // die();
                            }  
                        } else{
                            $subjectData = $this->db_model->select_data('subjects.id,subjects.subject_name','subjects use index (id)',array('batch_id'=>$this->input->post('batch_id')),'',array('id','desc'),'',array('batch_subjects','batch_subjects.subject_id=subjects.id'));
                        }
                    // print_r($subjectData);
                }
                    $html = '<option value="">select subject</option>';
                    // print_r($subjectData);
                    // die();
                    if(!empty($subjectData)){
                        foreach($subjectData as $subject){
                            $html .= '<option value="'.$subject['id'].'">'.$subject['subject_name'].'</option>';
                        }
                    }else{
                        $html .= '<option value="">'.$this->lang->line('ltr_no_result').'</option>';
                    }
                    $resp = array('status'=>1,'html'=>$html,);
                    echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            }else{
                echo 'Not allowed to access directly.';
            } 
        }


        function get_batchPrice(){
         
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
                $post = $this->input->post(NULL,TRUE);
                 $batch_data = $this->db_model->select_data('id,batch_offer_price,batch_type','batches use index (id)',array('id'=>$post['batch_id'],'status'=> 1));
               
                   if($batch_data){
                       foreach($batch_data as $batch){
                          
                        // $action = '<option value="'.$batch['id'].'">'.$batch['batch_price'].'</option>';
           
                        $output = array(
                        "status" => 1,
                        "data" => array('id'=>$batch['id'],'price'=>$batch['batch_offer_price'],'batch_type'=>$batch['batch_type'])
                        );
                    }
                }else{
                    
                    // $action = '<option value="">'.$this->lang->line('ltr_no_result').'</option>';
                    $output = array(
                        "status" => 0,
                        "data" => array()
                    );
                }
            
             echo json_encode($output,JSON_UNESCAPED_SLASHES);
             
            }else{
                echo $this->lang->line('ltr_not_allowed_msg');
            } 
            }

            public function live_class_edit_common(){
                $table = $_POST['table'];
                 $setting_data = $this->db_model->select_data('*',$table,array('id'=> $_POST['id'])); 
                 echo json_encode($setting_data);

            }

            // Ravi Kushwaha has changed the function 
      public function techaer_edit_new(){
        $cond = array('id'=>$_POST['id'],'role'=>3);
            $teachers = $this->db_model->select_data('*','users use index (id)',$cond,'',array('id','desc'));
         echo json_encode($teachers,JSON_UNESCAPED_SLASHES);
    }
    
 /*multi admin code start */    
    
     function add_admin(){
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            if(!empty($this->input->post('name',TRUE))){
                $data_arr = $this->input->post(NULL,TRUE);
                //print_r($data_arr);
                if(!empty($this->input->post('id',TRUE))){
                    if(!empty($data_arr['password'])){
                        $data_arr1['password'] = md5($data_arr['password']);
                    }else{
                        unset($data_arr1['password']);
                    }
    
                    if(isset($_FILES['admin_image']) && !empty($_FILES['admin_image']['name'])){
                        $image = $this->upload_media($_FILES,'uploads/admin/','admin_image');
                        if(is_array($image)){
                            $resp = array('status'=>'2', 'msg' => $image['msg']);
                            die();
                        }else{
                            $data_arr1['teach_image'] = $image;
                        }
                    }
                        // Array
                        // (
                        //     [name] => Josiah Avila
                        //     [email] => nuzihub@mailinator.com
                        //     [password] => Pa$$w0rd!
                        //     [role] => 1
                        //     [academics] => 1
                        //     [gallary_manage] => 1
                        //     [library_manager] => 1
                        //     [question_manager] => 1
                        //     [video_lecture] => 1
                        //     [doubtsask] => 1
                        //     [exam] => 1
                        //     [teacher_manager] => 1
                        //     [student_manage] => 1
                        //     [enquiry] => 1
                        //     [id] => 
                        // )
                        $access_data['academics'] = $this->input->post('academics',TRUE);
                        $access_data['gallary_manage'] = $this->input->post('gallary_manage',TRUE);
                        $access_data['library_manager'] = $this->input->post('library_manager',TRUE);
                        $access_data['question_manager'] = $this->input->post('question_manager',TRUE);
                        $access_data['video_lecture'] = $this->input->post('video_lecture',TRUE);
                        $access_data['doubtsask'] = $this->input->post('doubtsask',TRUE);
                        $access_data['exam'] = $this->input->post('exam',TRUE);
                        $access_data['teacher_manager'] = $this->input->post('teacher_manager',TRUE);
                        $access_data['student_manage'] = $this->input->post('student_manage',TRUE);
                        $access_data['enquiry'] = $this->input->post('enquiry',TRUE);                      
                        // /$access_data['exam'] = $this->input->post('exam',TRUE);
                       
                        $data_arr1['access'] = json_encode($access_data);
                        $id = $data_arr['id'];
                        $data_arr1['name'] = $data_arr['name'];
                        $data_arr1['email'] = $data_arr['email'];
                        $data_arr1['password'] =  md5($data_arr['password']);
                        $data_arr1['role'] = $data_arr['role'];                  
                        $data_arr1['parent_id'] =  $this->session->userdata('uid');   
                        $data_arr1['admin_id'] = '1'; 
                        $data_arr1['status'] =  1;
                        unset($data_arr['id']);    
                                       
                  
                    $data_arr = $this->security->xss_clean($data_arr1);
                  
                    $ins = $this->db_model->update_data_limit('users',$data_arr,array('id'=>$id),1);
                    
                    if($ins==true){
                        $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_admin_updated_msg'));
                    }else{
                        $resp = array('status'=>0);
                    }
                }else{
                   
                    $prevData =  $this->db_model->select_data('id','users use index (id)',array('email'=>$data_arr['email']),1);
                    $prevDataStu =  $this->db_model->select_data('id','students use index (id)',array('email'=>$data_arr['email']),1);
                    if(empty($prevData) && empty($prevDataStu)){
                        $access_data['academics'] = $this->input->post('academics',TRUE);
                        $access_data['gallary_manage'] = $this->input->post('gallary_manage',TRUE);
                        $access_data['library_manager'] = $this->input->post('library_manager',TRUE);
                        $access_data['question_manager'] = $this->input->post('question_manager',TRUE);
                        $access_data['video_lecture'] = $this->input->post('video_lecture',TRUE);
                        $access_data['doubtsask'] = $this->input->post('doubtsask',TRUE);
                        $access_data['exam'] = $this->input->post('exam',TRUE);
                        $access_data['teacher_manager'] = $this->input->post('teacher_manager',TRUE);
                        $access_data['student_manage'] = $this->input->post('student_manage',TRUE);
                        $access_data['enquiry'] = $this->input->post('enquiry',TRUE); 
                       
                        $data_arr1['access'] = json_encode($access_data);

                        unset($data_arr['id']);
                        $data_arr1['name'] = $data_arr['name'];
                        $data_arr1['email'] = $data_arr['email'];
                        $data_arr1['password'] =  md5($data_arr['password']);
                        $data_arr1['role'] = $data_arr['role'];
                        $data_arr1['id'] =  $data_arr['id'];
                        $data_arr1['parent_id'] =  $this->session->userdata('uid');   
                        $data_arr1['admin_id'] = '1'; 
                        $data_arr1['status'] =  1;
                        if(isset($_FILES['admin_image']) && !empty($_FILES['admin_image']['name'])){
                            $image = $this->upload_media($_FILES,'uploads/admin/','admin_image');
                            if(is_array($image)){
                                $resp = array('status'=>'2', 'msg' => $image['msg']);
                                die();
                            }else{
                                $data_arr1['teach_image'] = $image;
                            }
                        }        
                        
                        $data_arr = $this->security->xss_clean($data_arr1);
                        $ins = $this->db_model->insert_data('users',$data_arr);  
                        if(isset($_POST['sendMail'])==1){
                            $url = base_url('login');
                            $title = $this->db_model->select_data('site_title','site_details','',1,array('id','desc'))[0]['site_title'];
                            $subj = $title.'- '.$this->lang->line('ltr_credentials');
                            $em_msg = $this->lang->line('ltr_hey').' '.ucwords($data_arr['email']).', '.$this->lang->line('ltr_congratulations').' <br/><br/>'.$this->lang->line('ltr_successfully_enrolled').'<br/><br/>'.$this->lang->line('ltr_login_details').'<br/><br/> '.$this->lang->line('ltr_email').' : '.$data_arr['email'].'<br/><br/>'.$this->lang->line('ltr_password').' : '.$_POST['password'].'<br/><br/>'.$this->lang->line('ltr_url').' : <a href="'.$url.'">Click here to Login.</a><br/><br/>'.$this->lang->line('ltr_thnx_msg').'';
                            $this->SendMail($data_arr['email'], $subj, $em_msg);
                        }
                        if($ins==true){ 
                                
                            $resp = array('status'=>1,'msg'=>$this->lang->line('ltr_admin_added_msg'));
                        
                        }else{
                            $resp = array('status'=>0);
                        }
                    }else{
                        $resp = array('status'=>2,'msg'=> $this->lang->line('ltr_email_already_msg'));
                    }
                }
                echo json_encode($resp,JSON_UNESCAPED_SLASHES);
            } 
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
    function revanue_table(){
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
                $like = array('batch_name',$post['search']['value']);
            }else{
               $like = ''; 
            }
    
            if(isset($get['admin'])){
                if($get['admin']!=''){   
                    $like = array('admin_id',$get['admin']); 
                }
            }
            if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 1){  
                    $cond = array('admin_id'=>$this->session->userdata('uid'));
              }else if($this->session->userdata('role') == 1 && $this->session->userdata('super_admin') == 0){
                  $cond = array('admin_id'=>$this->session->userdata('uid'));
              }
              else if($this->session->userdata('role') == 3){
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'));
              }else if($this->session->userdata('role') == 'student'){
                  $cond = array('admin_id'=>$this->session->userdata('admin_id'),'status'=>1);
              }
            // $batch_data = $this->db_model->select_data('*','batches use index (id)',array('admin_id'=>$this->session->userdata('uid')),$limit,array('id','desc'),$like);
            $batch_data = $this->db_model->select_data('*','batches use index (id)',$cond,$limit,array('id','desc'),$like);
            if(!empty($batch_data)){
                $role = $this->session->userdata('role');
                if($role == '1'){  
                    $profile = 'admin';
                }
    
                foreach($batch_data as $batch){
                   
                    //print_r($batch);
                    if($batch['batch_type']==2){
                            $price =$batch['batch_price'].' '.$this->general_settings('currency_decimal_code');
                        if(!empty($batch['batch_offer_price'])){
                            $price ='<s>'.$batch['batch_price'].' '.$this->general_settings('currency_decimal_code').'</s>'.' / '.$batch['batch_offer_price'].' '.$this->general_settings('currency_decimal_code');
                        }
                    }else{
                        $price =$this->lang->line('ltr_free');
                    }
                    $s_count = $this->db_model->countAll('sudent_batchs',array('batch_id'=>$batch['id']));
                    $dataarray[] = array(
                                $count,
                                $batch['batch_name'],
                                date('d-m-Y',strtotime($batch['start_date'])),
                                date('d-m-Y',strtotime($batch['end_date'])),
                                $price,
                                $s_count,
                                $batch['batch_offer_price']*$s_count." ".$this->general_settings('currency_decimal_code')
                    ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('batches use index (id)',$cond,'','',$like);
    
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
    function admin_table(){
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
            
            if($this->session->userdata('role') == '1'){
                $cond = array('parent_id'=>$this->session->userdata('uid'),'role'=>1);
            }
    
            $teachers = $this->db_model->select_data('*','users use index (id)',$cond,$limit,array('id','desc'),$like,'','');
            if(!empty($teachers)){
                foreach($teachers as $teach){
                    // $color = current($this->db_model->select_data('*','theme_color use index (id)',array('admin_id'=>$teach['id'])));
                    // $action = '<p class="actions_wrap"><a class="edit_admin btn_edit" data-id="'.$teach['id'].'" data-img="'.$teach['teach_image'].'" data-primarycolor="'.$color['primary_color'].'" data-bordercolor="'.$color['border_color'].'" data-fontcolor="'.$color['font_color'].'" ><i class="fa fa-edit""></i></a>
                     $action = '<p class="actions_wrap"><a class="edit_admin btn_edit" data-id="'.$teach['id'].'" data-img="'.$teach['teach_image'].'" ><i class="fa fa-edit""></i></a>
                    <a class="deleteData btn_delete" data-id="'.$teach['id'].'" data-table="users"><i class="fa fa-trash"></i></a></p>';
                    $statusDrop = '';
                    if($teach['status'] == 1){
                        $statusDrop = '<div class="admin_tbl_status_wrap"><a class="tbl_status_btn light_sky_bg changeStatusButton" data-id="'.$teach['id'].'" data-table ="users" data-status ="0" href="javascript:;">'.$this->lang->line('ltr_active').'</a></div>';
                    }else{
                        $statusDrop = '<div class="admin_tbl_status_wrap">
                    <a class="tbl_status_btn light_red_bg changeStatusButton" data-id="'.$teach['id'].'" data-table ="users" data-status ="1" href="javascript:;">'.$this->lang->line('ltr_inactive').'</a></div>';
                    }
                    if (!empty($teach['teach_image'])){ 
                        $image = '<img src="'.base_url().'uploads/admin/'.$teach['teach_image'].'" title="'.$teach['name'].'" class="view_large_image"></a>';
                    }else{
                        $image = '';
                    }
                    $dataarray[] = array(
                        '<input type="checkbox" class="checkOneRow" value="'.$teach['id'].'">',
                                $count,
                                $image.$teach['name'],
                                '<p class="email">'.$teach['email'].'</p>',
                                $statusDrop,
                                $action
                            ); 
                    $count++;
                }
    
                $recordsTotal = $this->db_model->countAll('users use index (id)',$cond,'','',$like,'','');
    
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

    /*multi admin code End */
     function getdatateacher(){
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $teacher_data = current($this->db_model->select_data('access','users use index (id)',array('id'=>$this->input->post('id'))));
            // print_r($teacher_data);
            // $output = array()
        // echo json_encode($output,JSON_UNESCAPED_SLASHES);
        echo $teacher_data['access'];
        }else{
            echo $this->lang->line('ltr_not_allowed_msg');
        }
    }
 
 
}




