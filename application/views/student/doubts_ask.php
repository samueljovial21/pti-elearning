<section class="edu_admin_content">
	
		<?php 
			if(!empty($doubts_class_data)){
				if(empty($id)){
					$id = $this->session->userdata('uid');
				}
			?>
		<div class="edu_main_wrapper edu_table_wrapper sectionHolder ">
			<div class="edu_admin_informationdiv">
                <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" id="studentManager"  cellspacing="0" width="100%" data-url="ajaxcall/student_doubts_ask/<?php echo $id; ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_chapters'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                            </tr>
                        </thead>
                        <tbody> 
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
		<?php 
			}else{ 
			    
		         echo '<section class="edu_admin_content">
                    <div class="edu_admin_right sectionHolder edu_add_users">
                        <div class="edu_admin_informationdiv edu_main_wrapper">
                            <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_progress_report_no')).'</div>
                    </div>
                </section>';
			    
			} ?>
	</div>
</section> 

<!-- Pop Up Start  -->
<div id="stImgModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="stImgModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_student_image'));?></h4>
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group text-center">
						<img id="std_img" class="stdnt_proflie_img" src="" alt="Student Image"/>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Pop Up Start  -->
<div id="input_feilds_vacancy" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_doubts_date_class'));?></h4>
            <form method="post">
                <div class="row">
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_date'));?><sup>*</sup></label>
							<input type="hidden" class="form-control require hasDatepicker" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?>" id="b_startDate" value="">
							<input type="hidden" class="form-control require hasDatepicker" placeholder="End Date" id="b_endDate" value="">
    						<input type="text" class="form-control require chooseDate" id="doubts_date" name="doubts_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_date'));?>">
    					</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_time'));?><sup>*</sup></label>
    						<div class="chooseTime">
    							<input type="text" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_time'));?>" name="doubts_time" id="doubts_time" value="">
    						</div>
    					</div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
    						<textarea class="form-control require" id="description" name="description" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
    					</div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
    					    <input type="hidden" name="doubt_id" id="doubt_id">
    						<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_save'));?>" class="btn btn-primary addDoubtsDate" />
    					</div>
    				</div>
    			</div>
			</form>
        </div>
    </div>
</div>


<!-- Pop Up Start  -->
<div id="input_feilds_teacher" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="PopupTitle"><?php echo html_escape($this->common->languageTranslator('ltr_student_doubts_class'));?></h4>
            <form class="pxn_amin form" action="" method="post" autocomplete="off">
                <div class="row">   
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_student_name'));?><sup>*</sup></label>
                            <input type="text" class="form-control require alphaField" name="name" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_name'));?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_batch_name'));?><sup>*</sup></label>
                            <input type="text" class="form-control require alphaField" name="batch" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_batch_name'));?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?><sup>*</sup></label>
                            <input type="text" class="form-control require" name="subject" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_subject'));?>">
                        </div>
                     </div> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?><sup>*</sup></label>
                            <input type="text" class="form-control require" name="chapter" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?>">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_student_description'));?><sup>*</sup></label>
    						<textarea class="form-control require" id="description" name="studescription" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
    					</div>
    				</div> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_appointment_date'));?><sup>*</sup></label>
    						<input type="text" class="form-control require"  name="doubts_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_date'));?>">
    					</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_time'));?><sup>*</sup></label>
    							<input type="text" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_time'));?>" name="doubts_time" value="">
    					</div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
    						<textarea class="form-control require" name="teacdescription" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
    					</div>
    				</div>
                </div>
            </form>
        </div>
    </div>
</div>