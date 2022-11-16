<!----- Page Title Start ----->
		<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1><?php echo html_escape($this->common->languageTranslator('ltr_facilities'));?></h1>
							<ul>
								<li><a href="<?php echo base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_facilities'));?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Service Section Start ----->
		<section class="edu_services_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['faci_sub_heading'])?$frontend_details[0]['faci_sub_heading']:'E-Academy';?></h4>
							<h4 class="edu_heading"><?php $ea =html_escape($this->common->languageTranslator('ltr_our_facilities')); echo !empty($frontend_details[0]['faci_heading'])?$frontend_details[0]['faci_heading']: $ea ;?></h4>
							<img src="<?php echo base_url(); ?>assets/images/border.png" alt=""/>
						</div>
					</div>
					<?php
						if(!empty($Allfacilities)){
							foreach($Allfacilities as $facility){ ?>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
									<div class="edu_services_section">
										<div class="edu_services_section_inner">
											<i class="<?php echo html_escape($facility['icon']);?>"></i>
											<h4><?php echo html_escape($facility['title']);?></h4>
											<p><?php echo html_escape($facility['description']);?></p>
										</div>
									</div>
								</div>
							<?php 
							}
						}
					?>
				</div>
			</div>
		</section>
	</section>