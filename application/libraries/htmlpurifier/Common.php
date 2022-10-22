<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Common{
		public $CI;
		public $siteLogo = '';
		public $siteFavicon = '';
		public $siteLoader = '';
		public $siteTitle = '';
		public $siteAuthorName = '';
		public $siteDescription = '';
		public $siteKeywords = '';
		public $enrollWord = '';		
		public $copyrightText = '';	
		public $siteOwnerEmail = '';	
		
		function __construct(){
			$this->CI = get_instance();
			$this->CI->load->model('db_model');

			$site_details = $this->CI->db_model->select_data('*','site_details',array('id'=>1),1);
			$front_details = $this->CI->db_model->select_data('email','frontend_details',array('id'=>1),1);
				if(!empty($site_details)){
					if($site_details[0]['site_logo']!='')
						$img = base_url().'uploads/site_data/'.$site_details[0]['site_logo'];
					else
                        $img = base_url().'assets/images/logo.png';
                        
                    if($site_details[0]['site_favicon']!='')
						$fav = base_url().'uploads/site_data/'.$site_details[0]['site_favicon'];
					else
                        $fav = base_url().'assets/images/favicon.png';

                    if($site_details[0]['site_loader']!='')
						$loader = base_url().'uploads/site_data/'.$site_details[0]['site_loader'];
					else
                        $loader = base_url().'assets/images/preloader.gif';
                    
                    $siteTitle = ($site_details[0]['site_title']!='')?$site_details[0]['site_title']:'E Academy';
                    $authorName = ($site_details[0]['site_author']!='')?$site_details[0]['site_author']:'E Academy';
                    $desccription = ($site_details[0]['site_description']!='')?$site_details[0]['site_description']:'E Academy';
                    $keyword = ($site_details[0]['site_keywords']!='')?$site_details[0]['site_keywords']:'E Academy';
                    $enrol_word = ($site_details[0]['enrollment_word']!='')?$site_details[0]['enrollment_word']:'ACAD';
                    $copyright = ($site_details[0]['copyright_text']!='')?$site_details[0]['copyright_text']:'Copyright &copy; 2020 E Academy. All Right Reserved.';
                    $siteemail = ($front_details[0]['email']!='')?$front_details[0]['email']:'';
					
					$this->siteLogo = $img;
                    $this->siteFavicon = $fav;
                    $this->siteLoader = $loader;
					$this->siteTitle = $siteTitle;
					$this->siteAuthorName = $authorName;
					$this->siteDescription = $desccription;
					$this->siteKeywords = $keyword;		
					$this->enrollWord = $enrol_word;		
					$this->copyrightText = $copyright;		
					$this->siteOwnerEmail = $siteemail;		
				}
		}			
	}
?>