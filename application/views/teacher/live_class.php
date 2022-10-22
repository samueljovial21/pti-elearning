<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_batch_manager">
	    <?php 
	    if(!empty($live_data)){
	    ?>
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
		</div>
		<div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
    				<table class="server_datatable datatable table table-striped table-hover dt-responsive live_class_list_teacher" cellspacing="0" width="100%" data-url="ajaxcall/live_class_list_teacher">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_batch_name'));?></th>
    							<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_join'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_live_no_data_ta')).'</div>
                            </div>
                        </div>
                    </section>';
		}
		?>
	</div>
</section>


<!-- Pop Up Start  -->
<div id="classSettingModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" ><?php echo html_escape($this->common->languageTranslator('ltr_live_class'));?></h4>
            <form method="post" action="<?php echo base_url('teacher/start-class');?>" id="classForm" autocomplete="off" >
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_subjects'));?><sup>*</sup></label>
							<select class="form-control filter_subject edu_selectbox_with_search require " name="subject_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>">
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_sujects'));?></option>
										<?php
										if(!empty($subject)){
											foreach($subject as $sub){
												echo '<option value="'.$sub['id'].'">'.$sub['subject_name'].'</option>';
											}
										}
										?> 
									</select>	
    					</div>
    				</div>
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?><sup>*</sup></label>
							<select  class="form-control filter_chapter edu_selectbox_with_search require " name="chapter_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?>"> 
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?></option>
									</select>
    					</div>
    				</div>
    				
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="hidden" name="live_class_id" id="live_class_id" value="">
							<input type="button" value="continue" class="edu_admin_btn liveClassSetting"  />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>