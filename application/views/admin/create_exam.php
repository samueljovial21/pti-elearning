<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_creat_exam">
	    	<?php 
			if(!empty($question_data) ){
			?>
		<div class="edu_admin_informationdiv sectionHolder mb_30">
		    <div class="edu_main_wrapper edu_table_wrapper">
			    <div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="filter_header">
								    <h3 class="edu_filter_title"><?php echo html_escape($this->common->languageTranslator('ltr_filter_by_subject')); ?></h3>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
								<div class="form-group">
									<span> 
										<select class="form-control filter_subject edu_selectbox_with_search" name="filter_subject" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?>">
											<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?></option>
											<?php
												if(!empty($subject)){
													foreach($subject as $sub){
																							echo '<option value="'.$sub['id'].'">'.$sub['subject_name'].'</option>';
													}
												}
											?> 
										</select>
									</span>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<div class="form-group">
									<span>
										<select class="form-control filter_chapter edu_selectbox_with_search" name="filter_chapter" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?>"> 
											<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?></option>
										</select>
									</span>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<div class="form-group">
									<span> 
										<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search')); ?>" class="edu_admin_btn filter_question"> 
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="filter_header">
								    <h3 class="edu_filter_title"><?php echo html_escape($this->common->languageTranslator('ltr_filter_by_word')); ?></h3>
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-12">
								<div class="form-group">
									<span>
										<input type="" name="filter_word" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_word_comma')); ?>" class="form-control filter_word">
									</span>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
								<div class="form-group">
									<span> 
										<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search')); ?>" class="btn btn-primary filter_by_word"> 
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="footer_popup_inner">
						<div class="fp_btn_wrpa">
							<p class="edu_sub_title nomarginbtm"><span class="SelectedQuestionCount">0</span> <?php echo html_escape($this->common->languageTranslator('ltr_questions_selected')); ?></p>
						</div>
						<div class="fp_btn_wrpa">
						    <div class="edu_addPaper_wrap">
    							<a class="edu_admin_btn showCreatePaperModal mr-2"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_create_paper')); ?></a>
    							<button class="btn btn-primary addQuestionLocalStorage"><i class="icofont-ui-reply"></i><?php echo html_escape($this->common->languageTranslator('ltr_reset')); ?></button>
							</div>
						</div>
					</div>
        		</div>
    		</div>
		</div>
		
		<div class="edu_admin_informationdiv sectionHolder">
		    <div class="edu_main_wrapper edu_creat_exm_table edu_table_wrapper">
    			<div class="tableFullWrapper">
    				<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/question_table/exam">
    					<thead>
    						<tr> 
    							<th><input type="checkbox" class="checkAllTableRow"></th>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_question')); ?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_options')); ?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_answer')); ?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_subject')); ?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_chapter')); ?></th>
    						</tr>
    					</thead>
    					<tbody></tbody>
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
    

<!-- Pop Up Start  -->
<div id="createExamModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="createExamModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_create_exam')); ?></h4>
            <form method="post">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<h4 class="edu_sub_title" id="no_of_totalselected_que" ><?php echo html_escape($this->common->languageTranslator('ltr_total_selected')); ?> : <b> 0
						</b></h4>
						<div class="quetionIdsArr hide"></div>
					</div>
					<input type="hidden" class="totalQuestions" name="total_question" value="0">
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_paper_type')); ?> <sup>*</sup></label>
							<select class="form-control require changePaperType edu_selectbox_without_search" name="type" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_type')); ?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_type')); ?></option>
								<option value="1"><?php echo html_escape($this->common->languageTranslator('ltr_mock_test_paper')); ?></option>
								<option value="2"><?php echo html_escape($this->common->languageTranslator('ltr_practice_paper')); ?></option>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_paper_name')); ?> <sup>*</sup></label>
							<input type="text" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_paper_name')); ?>" class="form-control require" name="name">
						</div>
					</div> 
					<div class="col-lg-6 col-md-12 col-sm-12 col-12 mocktesthideshow hide">
						<div class="form-group"> 
							<label><?php echo html_escape($this->common->languageTranslator('ltr_mock_test_schedule_date')); ?> <sup>*</sup></label>
							<input type="text" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_schedule_date')); ?>" class="form-control chooseDate" name="mock_sheduled_date">
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12 mocktesthideshow hide">
						<div class="form-group"> 
							<label><?php echo html_escape($this->common->languageTranslator('ltr_mock_test_schedule_date')); ?> <sup>*</sup></label>
							<input type="text" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_schedule_time')); ?>" class="form-control chooseTime" name="mock_sheduled_time">
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_time_duration_min')); ?> <sup>*</sup></label>
							<input type="number" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_time_duration_mini')); ?>" class="form-control require" name="time_duration">
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group"> 
							<label><?php echo html_escape($this->common->languageTranslator('ltr_batch')); ?> <sup>*</sup></label>
							<select name="batch_id" class="form-control require edu_selectbox_with_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch')); ?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch')); ?></option>
								<?php foreach($batch as $ba){ 
									echo '<option value="'.$ba['id'].'">'.$ba['batch_name'].'</option>';
								}?>
							</select>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_create_paper')); ?>"  class="btn btn-primary createFinalExamPaper" /> 
						</div>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

<!-- Pop view characters Start  -->
<div id="charactersViewPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
           .<h4 class="edu_sub_title" id="charaTitele"></h4>
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