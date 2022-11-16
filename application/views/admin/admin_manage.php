<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_teacher_manager">
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	        <a href="#input_feilds_admin" class="edu_admin_btn openPopupLink ml-2 addAdminPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_admin'));?></a>
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
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/admin_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_email'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_admin_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	</div>

</section>

<!-- Pop Up Start  -->
<div id="input_feilds_admin" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="PopupTitle"><?php echo html_escape($this->common->languageTranslator('ltr_add_admin'));?></h4>
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
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_email'));?><sup>*</sup></label>
                            <input type="text" class="form-control require" name="email" autocomplete="off" data-valid="email" data-error="Please enter a valid email." placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_email'));?>">
                        </div>
                     </div> 
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?><sup>*</sup></label>
                            <input type="file" class="form-control require" name="admin_image" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>">
                            <p class="fileNameShow"></p>
                        </div>
                    </div>
               
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_password'));?><sup class="hide">*</sup></label>
                            <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_password'));?>">
                        </div>
                     </div>                    
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <label><?php echo html_escape($this->common->languageTranslator('ltr_role'));?><sup>*</sup></label>
                           <div class="form-group">
                              <select name="role" class="galleryTypefile form-control edu_selectbox_without_search">
                                 <option value="1">Sub-Admin</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group eb_batchtype">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_module_access'));?><sup>*</sup></label><br>
                            <div class="form-control">
                               
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_academics'));?>
                                    <input type="checkbox" class="academics" name="academics" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_gallery_manager'));?>
                                    <input type="checkbox" class="gallary_manage" name="gallary_manage" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_library_manager'));?>
                                    <input type="checkbox" class="library_manager" name="library_manager" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_question_manager'));?>
                                    <input type="checkbox" class="question_manager" name="question_manager" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_video_lecture_manager'));?>
                                    <input type="checkbox" class="video_lecture" name="video_lecture" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_doubts_ask'));?>
                                    <input type="checkbox" class="doubtsask" name="doubtsask" value="1"></label>
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_exam'));?>
                                    <input type="checkbox" class="exam" name="exam" value="1"></label>  
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_teacher_manager'));?>
                                    <input type="checkbox" class="teacher_manager" name="teacher_manager" value="1"></label>  
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_student_details'));?>
                                    <input type="checkbox" class="student_manage" name="student_manage" value="1"></label> 
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_enquiry'));?>
                                  <input type="checkbox" class="enquiry" name="enquiry" value="1"></label> 
                            </div>
                        </div>
                    </div> 
                            
                      <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                      <label><?php echo html_escape($this->common->languageTranslator('ltr_login_creadential'));?><sup>*</sup></label><br>
                            <div class="custom-control custom-checkbox mb-3">                            
                              <input type="checkbox" class="custom-control-input" id="customCheck" name="sendMail" value="1">
                              <label class="custom-control-label" for="customCheck"><?php echo html_escape($this->common->languageTranslator('ltr_send_mail_user'));?></label>
                            </div>
                      </div>       
                      
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="edu_btn_wrapper">
                            <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_admin'));?>" class="btn btn-primary addAdmin" data-id/>
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