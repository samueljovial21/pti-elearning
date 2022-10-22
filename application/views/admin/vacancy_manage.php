<section class="edu_admin_content">
    <div class="edu_admin_right sectionHolder edu_vacancy_manager">
        <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
            
                        <?php echo ($this->session->userdata('role')==1)?'<a href="#input_feilds_vacancy" class="edu_admin_btn openPopupLink add_vacancy"><i class="icofont-plus"></i>'.html_escape($this->common->languageTranslator('ltr_add_upcoming_exam')).'</a>':''; ?>
                   
            	    
		
	    </div>
	    
	    <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					 <?php if($this->session->userdata('role') == 1){ ?>
                    <button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="vacancy" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
                    <?php } ?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if((!empty($vacancy_data)) || ($this->session->userdata('role') !=1)){
			    if(empty($vacancy_data) && $this->session->userdata('role')=='student'){
    		        echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_upcoming_no_data_student')).'</div>
                            </div>
                        </div>
                    </section>';
    		    }else{
			?>
	    <div class="edu_main_wrapper edu_table_wrapper">
            <div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                   
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" data-url="ajaxcall/vacancy_table" cellspacing="0" width="100%">
                        <thead>
                            <tr><?php if($this->session->userdata('role') == 1){ ?>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <?php } ?>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_last_date'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_mode'));?></th>
                                <?php echo ($this->session->userdata('role')==1)?'<th class="no-sort">'.html_escape($this->common->languageTranslator('ltr_status')).'</th>':''; ?>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php 
    		    }
		}else{
		    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_upcoming_no_data_admin')).'</div>
                            </div>
                        </div>
                    </section>';
		} ?>
        
    </div>
</section>

<!-- Pop Up Start  -->
<div id="input_feilds_vacancy" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_new_exam'));?></h4>
            <form method="post">
                <div class="row">
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_exam_title'));?><sup>*</sup></label>
    						<input type="text" class="form-control require" id="title" name="title" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>">
    					</div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
    						<textarea class="form-control require" id="description" name="description" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
    					</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?><sup>*</sup></label>
    						<input type="text" class="form-control require chooseDate" id="start_date" name="start_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?>">
    					</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_last_date'));?><sup>*</sup></label>
    						<input type="text" class="form-control require chooseDate" id="last_date" name="last_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_last_date'));?>">
    					</div>
    				</div>
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_application_mode'));?><sup>*</sup></label>
    						<select class="form-control require edu_selectbox_without_search" id="mode" name="mode" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_mode'));?>">
    							<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_mode'));?></option>
    							<option value="Online"><?php echo html_escape($this->common->languageTranslator('ltr_online_mode'));?></option>
    							<option value="Offline"><?php echo html_escape($this->common->languageTranslator('ltr_offline_mode'));?></option>
    						</select>
    					</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    					    <label><?php echo html_escape($this->common->languageTranslator('ltr_upload_files'));?></label>
    						<input type="file" class="form-control" name="files[]" multiple accept="image/*,.pdf,.doc,.docx">
    						<label><strong><?php echo html_escape($this->common->languageTranslator('ltr_note'));?> </strong> <?php echo html_escape($this->common->languageTranslator('ltr_upload_files_type'));?></label>
							<p class="fileNameShow"></p>
    					</div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
    					    <input type="hidden" name="id" id="vac_id">
    						<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_save'));?>" class="btn btn-primary addNewVacancy" />
    					</div>
    				</div>
    			</div>
			</form>
        </div>
    </div>
</div>
<!-- view Pop Up Start  -->
<div id="view_vacancy_files" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="VacancyTitlePop"><?php echo html_escape($this->common->languageTranslator('ltr_view_vacancy'));?></h4>
            <div id="VacancyDataPop">
            </div>
        </div>
    </div>
</div>
<!-- Pop view characters Start  -->
<div id="charactersViewPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
           <h4 class="edu_sub_title" id="charaTitele"></h4>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group">
                        <div class="charactersViewResult"></div>
                    </div>
				</div>
			</div>
        </div>
    </div>
</div>