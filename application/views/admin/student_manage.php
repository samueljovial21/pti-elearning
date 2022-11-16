<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_student_manager">
	    
	    <div class="edu_table_wrapper sectionHolder">
			<div class="edu_admin_informationdiv">
                <form method="post" action="" autocomplete="off">
                    <div class="edu_manage_studer_filter"> 
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                <?php 
                    			if(!empty($student_data)){
                    			?>
                                <div class="form-group"> 
                                    <span>
                                        <select class="form-control edu_selectbox_without_search" id="lgStatus" name="lgStatus">
                                            <option value=""> <?php echo html_escape($this->common->languageTranslator('ltr_none'));?> </option>
                                            <option value="1"> <?php echo html_escape($this->common->languageTranslator('ltr_login'));?> </option>
                                            <option  value="0"><?php echo html_escape($this->common->languageTranslator('ltr_logout'));?></option>
                                        </select>
                                    </span>
                                </div>
                                <?php } ?>
                            </div>	
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                <?php 
                    			if(!empty($student_data) ){
                    			?>
                                <div class="form-group"> 
                                    <span> 
                                        <select class="form-control edu_selectbox_without_search" id="user_status" name="user_status">
                                            <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_all'));?></option>
                                            <option value="1"><?php echo html_escape($this->common->languageTranslator('ltr_active'));?></option>
                                            <option  value="0"><?php echo html_escape($this->common->languageTranslator('ltr_inactive'));?></option>
                                        </select>
                                    </span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php 
                    			if(!empty($student_data)){
                    			?>
                                <div class="form-group"> 
                                    <span> 
                                        <select class="form-control edu_selectbox_without_search" id="user_batch" name="user_batch[]" multiple="multiple" data-placeholder="Select Batch">
                                         
                                            <?php if(!empty($batch_name)){
                                                foreach($batch_name as $batch){
                                                    echo '<option value="'.$batch['id'].'">'.$batch['batch_name'].'</option>';    
                                                }
                                            } ?>
                                        </select>
                                    </span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                <?php 
                    			if(!empty($student_data)){
                    			?>
                                <div class="form-group"> 
                                    <span> 
                                        <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary find_student"> 
                                    </span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12 text-sm-right">
                                <div class="form-group">                                
                                	        <a href="<?php echo base_url('admin/add-student');?>" class="edu_admin_btn"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_student'));?></a>
                                	   
                                </div>
                            </div>
                        </div>
                    </div>	
                </form>  
			</div>
		</div>
		
		<div class="createDivWrapper edu_add_question create_ppr_popup stdn_mng hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner student_mng_m">
        			<div class="footer_popup_inner">
        			    
						 <?php if($this->session->userdata('role')==1){ ?>
						 <div class="fp_btn_wrpa">
        			        <button class="btn btn-primary add_attendance "><?php echo html_escape($this->common->languageTranslator('ltr_add_regular_attendance'));?></button>
						 </div>
						 <div class="fp_btn_wrpa">
        			        <button class="btn btn-primary add_attendance_extra "><?php echo html_escape($this->common->languageTranslator('ltr_add_extra_class_attendance'));?></button>
						 </div>
						 <div class="fp_btn_wrpa">
						     <button class="multiDelete btn_delete btn btn-primary " data-table="students" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
						 </div> 
						
                        <?php }else{ ?>
                        <div class="fp_btn_wrpa">
        			        <button class="btn btn-primary add_attendance "><?php echo html_escape($this->common->languageTranslator('ltr_add_regular_attendance'));?></button>
						 </div>
						 <div class="fp_btn_wrpa">
        			        <button class="btn btn-primary add_attendance_extra "><?php echo html_escape($this->common->languageTranslator('ltr_add_extra_class_attendance'));?></button>
						 </div>
                        <?php }?>
                    
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if($this->session->userdata('admin_id') == 1 || $this->session->userdata('super_admin') == 1 || $this->session->userdata('role') == 3){
			?>
		<div class="edu_main_wrapper edu_table_wrapper sectionHolder ">
			<div class="edu_admin_informationdiv dropdown_height">
                <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" id="studentManager"  cellspacing="0" width="100%" data-url="ajaxcall/student_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_email'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_contact_number'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_enrolment_id'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_admission_date'));?></th>
                                <?php if($this->session->userdata('role') == 1){  echo '<th class="no-sort">'.html_escape($this->common->languageTranslator('ltr_status')).'</th>'; } ?>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
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
			    if($this->session->userdata('admin_id') == 1 || $this->session->userdata('super_admin') == 0){
			    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_students_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			    }else{
			         echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_students_no_data_te')).'</div>
                        </div>
                    </section>';
			    }
			}
			
		 ?>
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
<!-- Pop Up Change Password Start  -->
<div id="changePassword" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_change_password'));?></h4>
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <input type="password" id="newPass" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_new_password'));?>">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <input type="password" id="confirmPass" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_confirm_new_password'));?>">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
                            <button type="button" class="edu_admin_btn updateStudPassword"><?php echo html_escape($this->common->languageTranslator('ltr_change_password'));?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>