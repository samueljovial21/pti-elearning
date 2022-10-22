<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_video_manager">
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="leave_management" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if(!empty($student_leave)){
			?>
	    <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/student_manage_leaves">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <?php echo (isset($page) && $page == 'teacher')?'<th>'.html_escape($this->common->languageTranslator('ltr_teacher_name')).'</th>':'<th>'.html_escape($this->common->languageTranslator('ltr_student_name')).'</th>'?>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_apply_date'));?></th>
                                
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_from_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_to_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_total_dates'));?></th>
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
		<?php 
			}else{ echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_progress_report_no')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	</div>
</section>
<div id="view_leave_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="viewLeave"></h4>
            <div class="row leaveShow">
            </div>
        </div>
    </div>
</div>


