<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_video_manager">
        <?php $role = $this->session->userdata('role');?>				
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
            <?php echo ($role != '1')?'<a href="#leave_apply_popup" class="edu_admin_btn openPopupLink"><i class="icofont-plus"></i>'.html_escape($this->common->languageTranslator('ltr_apply_leave')).'</a>':''; ?>
	    </div>
        <?php
        if(!empty($leave_data)){
            ?>
	    <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/leave_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_apply_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_from_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_to_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_total_days'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                            </tr>
                        </thead>
    			        <tbody>
    			        </tbody>
    		        </table> 
		        </div>
			</div> 
		</div>
		 <?php }else{
		    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_apply_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
		} ?>
	</div>
</section>


<!-- video Pop Up Start  -->
<div id="leave_apply_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_apply_leave'));?></h4>
            <form class="pxn_amin form" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_from_date'));?> <sup>*</sup></label>
							<input type="text" Class="form-control chooseDate from_date require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_from_date'));?>"> 
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_to_date'));?><sup>*</sup></label>
							<input type="text" Class="form-control chooseDate to_date require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_to_date_notc'));?>"> 
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?> <sup>*</sup></label>
                            <input type="text" class="form-control require" name="leave_sub" data-valid="text_only" data-error="Please enter a valid subject" id="leave_sub" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_subject'));?>">
                        </div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_message'));?> <sup>*</sup></label>
                            <textarea class="form-control require" name="leave_msg" id="leave_msg" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_message'));?>"><?php echo html_escape($this->common->languageTranslator('ltr_hello_sir'));?> </textarea>
                        </div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_button_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_apply'));?>" class="edu_admin_btn apply_leave_btn" />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>
<!-- view Pop Up Start  -->
<div id="view_leave_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="viewLeave"><?php echo html_escape($this->common->languageTranslator('ltr_view_leave'));?></h4>
            <div class="row leaveShow">
            </div>
        </div>
    </div>
</div>


