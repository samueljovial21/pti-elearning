<?php if(!empty($batchData)){?>
<section class="edu_admin_content">
		<div class="edu_admin_right sectionHolder edu_home_setting_wrapper">
	  
		<div class="edu_admin_informationdiv edu_main_wrappe">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
						<div class="edu_courses_section">
						    <div class="eca-subject-wrap">
                            <ul>
                                <li><span></span> Completed</li>
                                <li><span></span> Incompleted</li>
                            </ul>
                        </div>
						   <div class="edu_accordion_container_heading">
                            <?php
                           
                                foreach($batchData as $value){
                                ?>
                                <div class="edu_accord_parent">
                                    <span class="edu_accordion_header">
										<span class="speci_heading"><?php echo isset($value['subject_name'])?$value['subject_name']: html_escape($this->common->languageTranslator('ltr_benefit'));?></span> 
										<i>
											<i class="fa fa-plus upDownI"></i>
										
										</i>
                                    </span>
                                   <?php $chapter = $value['chapters']; foreach($chapter as $chap){?>
                                    <div class="edu_accordion_content count_heading" <?php echo $chap['style']; ?>">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                <p><?php echo $chap['chapter_name']; ?></p>
                                              
                                            </div>
											
                                        </div>
                                    </div>
                                   <?php } ?>
                                </div>
                                <?php }?>
						</div>
					</div>
				</div>
			</div>
        </div>
     
	</div>
</section> 
	<?php 
		    }else{ 
			echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_data_msg')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>