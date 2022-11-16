<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_subject_manager">			
		<div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
		    
                        <a href="#subjectsPopup" class="edu_admin_btn openPopupLink addSubjctPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_subject'));?></a> 
                 
          
           
	    </div>
	    
	    
	    <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-placement="top" title="Delete" data-table="subjects" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if(!empty($subject_data) && $subject_data>=1){
			?>
	    <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/subject_table">
                        <thead>
                            <tr>  
                            <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_chapters_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
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
			}else{ 
			echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_chsapter_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	</div>
</section> 

<!-- Subject Pop Up Start  -->
<div id="subjectsPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_subject'));?></h4>
            <form method="post" class="pxn_amin form" action="javascript:void(0)" autocomplete="off"> 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subject_name'));?><sup>*</sup></label>
                            <input type="text" name="subject" id="subjectName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_subject_name'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" name="addsubject" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addSubject" data-id="" />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>
<!-- Pop Up2 Start  -->
<div id="subjectsEditPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_edit_subject'));?></h4>
            <form method="post" class="pxn_amin form" action="" autocomplete="off"> 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subject_name'));?><sup>*</sup></label>
                            <input type="text" name="subject" id="subjectEditName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_subject_name'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_update'));?>" class="edu_admin_btn editSubject"/>
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>
<!-- Pop Up3 Start  -->
<div id="chapterPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_chapters'));?></h4>
            <form class="pxn_amin form" action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <h6 class="subject_name mb_30"><?php echo html_escape($this->common->languageTranslator('ltr_subject')).' : '.html_escape($this->common->languageTranslator('ltr_subject'));?></h6>
                            <label for="chapterName"><?php echo html_escape($this->common->languageTranslator('ltr_chapter_names'));?><sup>*</sup></label>
                            <textarea placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_add_chapter'));?>" class="form-control"  name="chapter_name"  id="chapterName"></textarea>
                            <p><?php echo html_escape($this->common->languageTranslator('ltr_chsapter_note'));?></p>
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_chapters'));?>" class="edu_admin_btn addChapterofSub" />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div> 
</div>
<!-- Pop Up4 Start  -->
<div id="chapterEditPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_edit_chapter'));?></h4>
            <form class="pxn_amin form" action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <h6 class="subject_name mb_30"><?php echo html_escape($this->common->languageTranslator('ltr_subject')).' : '.html_escape($this->common->languageTranslator('ltr_subject'));?></h6>
                            <label for="chapterEditName"><?php echo html_escape($this->common->languageTranslator('ltr_chapter_names'));?><sup>*</sup></label>
                            <input type="text" name="chapter" id="chapterEditName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_chapter_names'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_update'));?>" class="edu_admin_btn editChapterofSub" />
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