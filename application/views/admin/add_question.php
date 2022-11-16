<section class="edu_admin_content">
	<?php $role = $this->session->userdata('role'); ?>
	<div class="edu_admin_right sectionHolder edu_question_manager">				
	    <div class="edu_btn_wrapper sectionHolder">
	    </div>
		<div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">					
				<div class="tableFullWrapper">
				    <ul class="nav nav-tabs" role="tablist">
							    <li class="nav-item" >
									<a class="nav-link active" href="#single" role="tab" data-toggle="tab" aria-selected="true">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_single_question'));?></p>
										</span>
									</a>
								</li>
								<li class="nav-item bulk_upload">
									<a class="nav-link" href="#bulk" role="tab" data-toggle="tab" aria-selected="false">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_bulk_upload'));?></p>
										</span>
									</a>
								</li>
						
							</ul>
							<div class="tab-content">
							     <div role="tabpanel" class="tab-pane fade active in show" id="single">
            <h4 class="edu_sub_title" id="questionPopupLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_question'));?></h4>
            <form class="pxn_amin form" enctype="multipart/form-data" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group "  >
							<label><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?><sup>*</sup></label>
							<select class="form-control filter_subject modalSubjectCls require edu_selectbox_with_search" name="subject_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>"> 
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
								<?php
									if(!empty($subject)){
										foreach($subject as $sub){
											$selected="";
											if(isset($single_question['subject_id'])){
												if($single_question['subject_id']==$sub['id']){
													$selected="selected";
												}
											}
											echo '<option value="'.$sub['id'].'" '.$selected.'>'.$sub['subject_name'].'</option>';
										}
									}
								?> 
							</select>
						</div>
    				</div>
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group  add_edit_question" data-id="<?=(isset($single_question['chapter_id']))?$single_question['chapter_id']:''?>">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?><sup>*</sup></label>
							<select  class="form-control filter_modal_chapter  edu_selectbox_with_search" name="chapter_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?>"> 
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?></option>
							</select>
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_question'));?><sup>*</sup></label>
							<span ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Note :-</b>If you want to insert a numerical equation please click on <img src="<?php echo base_url()?>assets/images/sum-sign.svg" style="width: 15px"> </span>
							<textarea name="question" rows="3" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_question'));?>" class="form-control"><?=(isset($single_question['question']))?$single_question['question']:""?></textarea>
						</div>
						<div  id="question_options">
						    <div  class="row">
        						<?php 
        							$op = '1';
        							$cn = 'A';
        							$option=(isset($single_question['options']))?json_decode($single_question['options']):"";
        							//print_r($option);
        							for($i=1; $i<5; $i++){
        								?>
        								<div class="col-lg-6 col-md-12 col-sm-12 col-12">
        									<div class="form-group">
        										<label>
        											<div class="ans_option"><?php echo html_escape($this->common->languageTranslator('ltr_option_'.$cn));?> <sup>*</sup></div>
        										</label>
        										<textarea type="text" class="form-control editor" name="options[]" id="option<?=$i?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_option_'.$cn));?>"><?=(isset($option[$i-1]))?$option[$i-1]:""?></textarea>
        									</div>
        								</div>
        							<?php
        								$op++;
        								$cn++;
        							} ?>
        					    </div>
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">

    				    <label class="ans_option"><?php echo html_escape($this->common->languageTranslator('ltr_right_answer'));?><sup>*</sup></label>
    					<div class="form-group edu_radio_holder_wrapper">
							<div class="edu_radio_holder">
							    <label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_a'));?></label>
							    <input type="radio" class="ansRadioChck" name="answer" value="A" <?php if(isset($single_question['answer']) && ($single_question['answer']=="A")){ echo "checked"; }?>>
							</div>
							<div class="edu_radio_holder">
							    <label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_b'));?></label>
							    <input type="radio" class="ansRadioChck" name="answer" value="B" <?php if(isset($single_question['answer']) && ($single_question['answer']=="B")){ echo "checked"; }?>>
							</div>
							<div class="edu_radio_holder">
							    <label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_c'));?></label>
							    <input type="radio" class="ansRadioChck" name="answer" value="C" <?php if(isset($single_question['answer']) && ($single_question['answer']=="C")){ echo "checked"; }?>>
							</div>
							<div class="edu_radio_holder">
							    <label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_d'));?></label>
							    <input type="radio" class="ansRadioChck" name="answer" value="D" <?php if(isset($single_question['answer']) && ($single_question['answer']=="D")){ echo "checked"; }?>>
							</div>
						</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_question'));?>" class="btn btn-primary add_Newquestion" data-id="<?php if(isset($single_question['id']) && ($single_question['id']!="")){ echo $single_question['id']; }?>">
						</div>
    				</div>
				</div>
            </form>
            </div>
             <div role="tabpanel" class="tab-pane fade" id="bulk">
                 <form class="pxn_amin form" enctype="multipart/form-data" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?><sup>*</sup></label>
							<select class="form-control filter_subject modalSubjectCls require edu_selectbox_with_search" name="subject_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>"> 
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
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
							<label><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?><sup>*</sup></label>
							<select  class="form-control filter_modal_chapter require edu_selectbox_with_search" name="chapter_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?>"> 
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?></option>
							</select>
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_excel'));?><sup>*</sup></label>
    						<input type="file" class="form-control require" name="result_file" id="result_file"  data-valid="excel" data-error="Upload xlsx format">
    						<p class="fileNameShow"></p>
						</div>
						
    				</div>
    				
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_upload_question'));?>" class="btn btn-primary upload_new_question"/>
							<a href="<?php echo base_url(); ?>uploads/demo/uploadQuestionExcel.xlsx" class="btn btn-primary" ><?php echo html_escape($this->common->languageTranslator('ltr_download_demo_file'));?></a>
						</div>
    				</div>
				</div>
            </form>
                 </div>
        </div>
    			</div>
			</div>
		</div>
		
	</div>
</section> 


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
