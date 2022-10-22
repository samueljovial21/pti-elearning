<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view_server_image extends CI_Controller {

		public function __construct()
        {
			parent::__construct();
			$this->load->helper('url');
		}
		
		function wiew_image(){
			$dirname = "assets/images/";
			//$images = glob($dirname."*.*");
			$images = array();
			$times = array();
			if($handle = opendir($dirname)) {
				while(false !== ($file = readdir($handle))) {
					$times = filemtime($dirname.'/'.$file);
					$images[$times] = $file;
				}
				closedir($handle);
			}
			krsort($images);
			$data['images'] = $images;
			$this->load->view('view_image',$data);
		} 
		
		function upload_blog_image(){
				$allowed =  array('jpeg','png' ,'jpg');
				$filename = $_FILES['upload']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext,$allowed) ) {
					echo 'Invalid Image Formate';
				}else{
					$this->load->library('Image_control');
					//print_r($_FILES);
					$imageName = $this->image_control->upload_image('/assets/images/' , 'upload','_test');
					$function_number = $_GET['CKEditorFuncNum'];
					$url=base_url().'assets/images/'.$imageName;
					  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '');</script>";
				}
			
		}
		
		function wiew_video(){
			$dirname = "assets/images/";
			$video = glob($dirname."*.*");
			$data['video'] = $video;
			$this->load->view('wiew_video',$data);
		
		}
		
		function upload_blog_video(){
				$allowed =  array('mp4','webm');
				$filename = $_FILES['upload']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext,$allowed) ) {
					echo 'Invalid Video Formate';
				}else{
					$this->load->library('Image_control');
					$imageName = $this->image_control->upload_image('/assets/images/' , 'upload','_test');
				}
			
		}
		
}		

 ?>