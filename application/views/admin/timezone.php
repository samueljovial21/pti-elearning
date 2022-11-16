<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_home_setting_wrapper">
		<div class="edu_admin_informationdiv edu_main_wrapper">
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_set_time_zone'));?></h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <select name="timezone" class="form-control require edu_selectbox_with_search" data-symb="no" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_time_zone'));?>"> 
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_time_zone'));?></option>
                                <?php
                                    $timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));
                                    $time_zone = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                   
                                    if(!empty($time_zone)){
                                        for($i=0; $i<count($time_zone); $i++){
                                            if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone']) && ($timezoneDB[0]['timezone'] == $time_zone[$i])){
                                                echo 'yes';
                                                $sel = 'selected';
                                            }else if(isset($timezoneDB[0]['timezone']) && empty($timezoneDB[0]['timezone']) && (date_default_timezone_get() == $time_zone[$i])){
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }
                                            echo '<option value="'.$time_zone[$i].'" '.$sel.'>'.$time_zone[$i].'</option>';		
                                        }
                                    }
                                ?>
                            </select>
                            <p class="edu_info"><?php echo html_escape($this->common->languageTranslator('ltr_set_note'));?></p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                                <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/timezone_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                        </div>
                    </div>
                </div>
            </form>
		</div>		
	</div>
</section>