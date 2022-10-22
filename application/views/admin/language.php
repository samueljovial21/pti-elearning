<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_home_setting_wrapper">
		<div class="edu_admin_informationdiv edu_main_wrapper">
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_set_language'));?></h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <select name="language_type" class="form-control require edu_selectbox_with_search" data-symb="no" data-placeholder="Select Language"> 
                                <option <?php if($language_name=="english"){ echo 'selected';} ?> value="english">English</option>
								<option <?php if($language_name=="french"){ echo 'selected';} ?> value="french">French</option>
								<option <?php if($language_name=="arabic"){ echo 'selected';} ?> value="arabic">Arabic</option>
								</select>
                            
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                                <button type="button" class="btn btn-primary languageDetails"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                        </div>
                    </div>
                </div>
            </form>
		</div>		
	</div>
</section>