<!----- Page Title Start ----->
<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1><?php echo html_escape($this->common->languageTranslator('ltr_our_gallery'));?></h1>
							<ul>
								<li><a href="<?php base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_our_video_gallery'));?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Video Gallery Section Start ----->
		<section class="edu_videoGallery_wrapper">
			<div class="container">
				<div class="row videoP_gallery">
				<input type="hidden" id="baseUrlId" value="<?php echo base_url();?>">
					<?php 
					$gallery = $this->db_model->select_data('title,video_url,video','gallery use index (id)',array('status'=>'1','type'=>'Video'),9,array('id','desc'));
					if(!empty($gallery)){
						foreach($gallery as $gal){
						    if(!empty($gal['video_url'])){
							$url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1",$gal['video_url']);
							echo '<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="edu_videoGallery_section">
								<iframe src="'.$url.'" allowfullscreen></iframe>
								<div class="edu_videoGalleryTitle">
									<h5>'.$gal['title'].'</h5>
								</div>
							</div>
						</div>';
						}else{
						    	echo '<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="edu_videoGallery_section video">
							<video width="100%" height="430px" controls >
							<source src="'.base_url('uploads/video/').$gal['video'].'?enablejsapi=1&html5=1"  type="video/mp4">
							
							Your browser does not support the video tag.
						  </video>
								<!-- <iframe class="autoPlayoffvideo" src="'.base_url('uploads/video/').$gal['video'].'" allowfullscreen></iframe>-->
								<div class="edu_videoGalleryTitle">
									<h5>'.$gal['title'].'</h5>
								</div>
							</div>
						</div>';
						}
					}
					}
					if(count($gallery) > 9){
					?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<button type="button" class="edu_btn loadMoreGallery" data-limit="9" data-type="Video"><?php echo html_escape($this->common->languageTranslator('ltr_load_more'));?></button>
					</div>
					<?PHP } ?>
				</div>
			</div>
		</section>
	</section>