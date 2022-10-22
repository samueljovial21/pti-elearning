<!----- Page Title Start ----->
		<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1><?php echo html_escape($this->common->languageTranslator('ltr_our_gallery'));?></h1>
							<ul>
								<li><a href="<?php base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_our_gallery'));?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Gallery Section Start ----->
		<section class="edu_gallery_wrapper">
			<div class="container">
				<div class="row popup_gallery">
				<input type="hidden" id="baseUrlId" value="<?php echo base_url();?>">
					<?php 
					$gallery = $this->db_model->select_data('image, title','gallery use index (id)',array('status'=>'1','type'=>'Image'),9,array('id','desc'));
					if(!empty($gallery)){
						foreach($gallery as $gal){
							echo '<div class="col-lg-4 col-md-4 col-sm-6 col-12">
							<div class="edu_porfolio_section">
								<img src="'.base_url('uploads/gallery/').$gal['image'].'" alt="">
								<div class="edu_overlay">
									<a href="'.base_url('uploads/gallery/').$gal['image'].'" title=""><span class="icofont-search-2"></span></a>
								</div>
								<div class="edu_videoGalleryTitle">
									<h5>'.$gal['title'].'</h5>
								</div>
							</div>
						</div>';
						}
					}
					if(count($gallery) > 9){
					?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<button type="button" class="edu_btn loadMoreGallery" data-limit="9" data-type="Image"><?php echo html_escape($this->common->languageTranslator('ltr_load_more'));?></button>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
	</section>