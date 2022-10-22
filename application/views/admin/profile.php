<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_profile_page">
		<div class="col-lg-8 col-md-10 col-sm-12 col-12 offset-lg-2 offset-md-1">
    		<div class="edu_main_wrapper">
        		<div class="edu_admin_informationdiv sectionHolder">
        		    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_new_password'));?></label>
                                <input type="Password" class="form-control" name="" id="admin_new_pass">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_re_password'));?></label>
                                <input type="Password" class="form-control" name="" id="admin_rep_pass">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="edu_btn_wrapper padderTop10">
                                <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_change_password'));?>" class="changePassword edu_admin_btn">
                            </div>
                        </div> 
                    </div>
        		</div>
        	</div>
    	</div>
	</div>
</section> 
