<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class image_control{ 
	function __Construct(){
		$this->CI = get_instance();
	}	
	# function For upload images
	function upload_image($up_path , $name , $postFix = NULL){
		$path=dirname(__FILE__); 

		$abs_path=explode('application',$path);
		$uploadPath = $abs_path[0].$up_path;
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = '*';
		$this->CI->load->library('upload', $config);
		//print_r($abs_path);
		if ($this->CI->upload->do_upload($name)){

			$uploaddata=$this->CI->upload->data();
			
			$logo_name = $uploaddata['raw_name'];
			$logo_ext = $uploaddata['file_ext'];
			$randomstr = substr(md5(date('d-m-y h:i:sa')), 0, 12); 
			$logo_new_name = $randomstr.$postFix.$logo_ext;
            
			rename($uploadPath.$logo_name.$logo_ext, $uploadPath.$logo_new_name);
			return $logo_new_name;
		}else{ 
			return ''; //$this->CI->upload->display_errors();
		}
	}
	
	# function for resize image 
	function resizeImage($imgPath , $name , $height , $width , $thumb = NULL , $clear= NULL){
		$path=dirname(__FILE__); 
		$abs_path=explode('/application/',$path);
		$this->CI->load->library('image_lib');
		$config['source_image'] = $abs_path[0].$imgPath.$name;
		if($thumb != ""){
			$config['create_thumb'] = TRUE;
		}
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height; 
		$this->CI->image_lib->initialize($config);
		$this->CI->image_lib->resize();
		if($clear != ""){
			$this->CI->image_lib->clear();
		}
		//echo $this->image_lib->display_errors();
	}
	
	# function For upload multiple images
	function uploadMultipleImage($up_path , $name , $postFix = NULL){
		$imageId = '';
		$path=dirname(__FILE__); 
		$abs_path=explode('/application/',$path);
		$uploadPath = $abs_path[0].$up_path;
		$config['upload_path'] = $uploadPath;
		$config['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
		$files = $_FILES;
		$cpt = count($_FILES[$name]['name']);
		for($i=0; $i<$cpt; $i++)
		{    
			$_FILES[$name]['name']= $files[$name]['name'][$i];
			$_FILES[$name]['type']= $files[$name]['type'][$i];
			$_FILES[$name]['tmp_name']= $files[$name]['tmp_name'][$i];
			$_FILES[$name]['error']= $files[$name]['error'][$i];
			$_FILES[$name]['size']= $files[$name]['size'][$i];  
			$this->CI->load->library('upload', $config);
			if ($this->CI->upload->do_upload($name)){
				$uploaddata=$this->CI->upload->data();
				$logo_name = $uploaddata['raw_name'];
				$logo_ext = $uploaddata['file_ext'];
				$rand = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, '4');
				$randomstr = substr(md5(date('d-m-y h:i:sa').$rand), 0, 11);
				$logo_new_name = $randomstr.$postFix.$logo_ext;

				rename($uploadPath.$logo_name.$logo_ext, $uploadPath.$logo_new_name);
				$imageId .= $logo_new_name.' , ';
			}else{ 
				$imageId .= '';//$this->CI->upload->display_errors();
			} 
		}
		
		return $imageId;	
	}
	
	function remove_img($path , $image){
		$pth=dirname(__FILE__); 
		$abs_path=explode('/application/',$pth);
		$upath = $abs_path[0].$path;
		$uploadPath = $upath.$image;
		if(file_exists($uploadPath)){
			@unlink($uploadPath);
		}
	}
	
	
}

?>