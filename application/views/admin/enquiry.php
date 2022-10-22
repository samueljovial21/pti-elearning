<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_enquiry_wrap">
    	<?php 
		if(!empty($enquiry_data)){
		?> 
		<div class="edu_admin_informationdiv sectionHolder">
            <div class="edu_main_wrapper edu_table_wrapper">
                <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/enquiry_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_mobile'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_email'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_message'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_live_his_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
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