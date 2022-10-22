<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_teacher_manager">
		<div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	        <a href="#input_feilds_teacher" class="edu_admin_btn ml-2 add_doubt_ask"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_doubt_ask'));?></a>
	    </div>
		<?php 
			if(!empty($doubts_class_data)){
				if(empty($id)){
					$id = $this->session->userdata('uid');
				}
			?>
		<div class="edu_main_wrapper edu_table_wrapper sectionHolder ">
			<div class="edu_admin_informationdiv">
                <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" id="studentManager"  cellspacing="0" width="100%" data-url="ajaxcall/studentDoubtsAsk/<?php echo $id; ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_teacher_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject_s'));?></th>
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
                            <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_record')).'</div>
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
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_doubt_ask'));?></h4>
            <form method="post">
                <div class="row">
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					 <div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?> <sup>*</sup></label>
							<select class="edu_selectbox_with_search form-control require filter_subject_doubt" name="subject_id" data-batchId="<?php echo $this->session->userdata('uid');?>" data-teacher="yes" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
								<?php if(!empty($subject))
								{
									foreach($subject as $sub){ 
										echo '<option value="'.$sub['id'].'" >'.$sub['subject_name'].'</option>';
									}
								}?>
							</select>
						</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?> <sup>*</sup></label>
							<select class="edu_selectbox_with_search form-control require filter_chapter" name="chapter_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?></option>
							</select>
						</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_teacher'));?><sup>*</sup></label>
							<select class="edu_selectbox_with_search form-control require filter_teacher" name="teacher_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_teacher'));?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_teacher'));?></option>
							</select>
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
    						<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="btn btn-primary addDoubtsDate" />
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
            <h4 class="edu_sub_title" id="PopupTitle"><?php echo html_escape($this->common->languageTranslator('ltr_student_doubts_class'));?> </h4>
            <form class="pxn_amin form" action="" method="post" autocomplete="off">
                <div class="row">   
                    
                    
                    
                   
                   
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_appointment_date'));?> <sup>*</sup></label>
    						<span class="form-control doubts_date"> </span>
    					</div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_time'));?><sup>*</sup></label>
    							<span class="form-control doubts_time"> </span>
    					</div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?> <sup>*</sup></label>
    						<span class="teacdescription form-control"></span>
    					</div>
    				</div>
                </div>
            </form>
        </div>
    </div>
</div>