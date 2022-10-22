<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_teacher_manager">
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	      
                        <a href="#input_feilds_teacher" class="edu_admin_btn openPopupLink ml-2 addTeacherPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_teacher'));?></a>
                 
	    </div>
	   
	    <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="users" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
			<?php 
			if(!empty($teacher_data) && $teacher_data>=1){
			?>
	    <div class="edu_main_wrapper edu_table_wrapper">		
			<div class="edu_admin_informationdiv sectionHolder dropdown_height">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/teacher_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_email'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_education'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_gender'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_batchs'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subjects'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
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
			}else{ 
			     echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_teacher_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	</div>
</section>

<!-- Pop Up Start  -->
<div id="input_feilds_teacher" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="PopupTitle"><?php echo html_escape($this->common->languageTranslator('ltr_add_teacher'));?></h4>
            <form class="pxn_amin form" action="" method="post" autocomplete="off">
                <div class="row">   
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_name'));?><sup>*</sup></label>
                            <input type="text" class="form-control require alphaField" name="name" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_name'));?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_gender'));?><sup>*</sup></label>
                            <select name="teach_gender" class="form-control require edu_selectbox_without_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_gender'));?>">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_gender'));?></option>
                                <option value="male"><?php echo html_escape($this->common->languageTranslator('ltr_male'));?></option>
                                <option value="female"><?php echo html_escape($this->common->languageTranslator('ltr_female'));?></option>
                                <option value="other"><?php echo html_escape($this->common->languageTranslator('ltr_other'));?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_email'));?><sup>*</sup></label>
                            <input type="text" class="form-control require" name="email" data-valid="email" data-error="Please enter a valid email." placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_email'));?>">
                        </div>
                     </div> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?><sup>*</sup></label>
                            <input type="file" class="form-control require" name="teach_image" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>">
                            <p class="fileNameShow"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_education'));?></label>
                            <input type="text" class="form-control" name="teach_education" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_education'));?>">
                        </div>
                    </div>   
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_password'));?><sup class="hide">*</sup></label>
                            <input type="password" class="form-control" name="password" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_password'));?>">
                        </div>
                     </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?><sup>*</sup></label>
                            <select class="form-control require multiSelectCls edu_selectbox_with_search" name="teach_subject[]" multiple="multiple" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>">
                                <?php if(!empty($subject))
                                {
                                    foreach($subject as $sub){ 
                                        echo '<option value="'.$sub['id'].'" >'.$sub['subject_name'].'</option>';
                                    }
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group eb_batchtype">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_module_access'));?><sup>*</sup></label><br>
                            <div class="form-control">
                               
                               <!--<label><?php echo html_escape($this->common->languageTranslator('ltr_academics'));?>-->
                               <!--     <input type="checkbox" class="academics" name="academics" value="1"></label>-->
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_homework'));?>
                                    <input type="checkbox" class="assignment" name="assignment" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_live_class'));?>
                                    <input type="checkbox" class="live_class" name="live_class" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_notice'));?>
                                    <input type="checkbox" class="notice" name="notice" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_extra_classes'));?>
                                    <input type="checkbox" class="extraclasses" name="extraclasses" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_library_manager'));?>
                                    <input type="checkbox" class="course_content" name="course_content" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_question_manager'));?>
                                    <input type="checkbox" class="question_manager" name="question_manager" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_video_lecture_manager'));?>
                                    <input type="checkbox" class="video_lecture" name="video_lecture" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_doubts_ask'));?>
                                    <input type="checkbox" class="doubtsask" name="doubtsask" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_exam'));?>
                                    <input type="checkbox" class="exam" name="exam" value="1"></label>  
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_manage_student_leave'));?>
                                    <input type="checkbox" class="student_leave" name="student_leave" value="1"></label>  
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_student_details'));?>
                                    <input type="checkbox" class="student_manage" name="student_manage" value="1"></label>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="edu_btn_wrapper">
                            <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_teacher'));?>" class="btn btn-primary addNewTeacher" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="stImgModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="stImgModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_teacher_image'));?></h4>
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group text-center">
						<img id="std_img" src="" alt="Student Image"/>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>