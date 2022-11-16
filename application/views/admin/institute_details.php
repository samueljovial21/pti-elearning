<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_teacher_manager">
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	        <a href="#input_feilds_admin" class="edu_admin_btn openPopupLink ml-2 addAdminPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_Intitute_add'));?></a>
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
            <h4 class="edu_sub_title" id="PopupTitle"><?php echo html_escape($this->common->languageTranslator('ltr_Intitute_add'));?></h4>
            <form class="pxn_amin form" action="" method="post" autocomplete="off">
                <div class="row">   
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_Intitute_name'));?><sup>*</sup></label>
                            <input type="text" class="form-control require alphaField" name="name" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_Intitute_name'));?>">
                        </div> 
                    </div>    
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_Intitute_logo'));?><sup>*</sup></label>
                            <input type="file" class="form-control require" name="admin_image" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>">
                            <p class="fileNameShow"></p>
                        </div>
                    </div>             
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="edu_btn_wrapper">
                            <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_Intitute_add'));?>" class="btn btn-primary addInstitute" data-id/>
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