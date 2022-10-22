<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_manage_exam_wrap">
	     
    	<?php 
		if(!empty($question_data) && $question_data>=1){
		?>
		<div class="edu_admin_informationdiv sectionHolder">
            <div class="edu_main_wrapper edu_table_wrapper">
		        <div class="tableFullWrapper">
		           
				    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/exam_table">
    			        <thead>
                            <tr> 
                               <?php echo ($this->session->userdata('role')==1)?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_paper_type'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_paper_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_total_question'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_time_duration'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_paper_format'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_scheduled_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_scheduled_time'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
                                <!--<th>Status</th>-->
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_create_paper_msg')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	</div>
</section>
<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					 <?php if($this->session->userdata('role')==1){ ?>
				    <button class="multiDelete btn_delete  btn btn-primary"  data-placement="top" title="Delete" data-table="exams" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
				    <?php }?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>