<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_facility_seting_wrapper">
		<div class="pxn_admin_informationdiv edu_main_wrapper">
			<form class="pxn_amin" method="post">
				<div class="edu_facality_wrapper edu_from_wrapper">
					<div class="row">
					    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
							    <input type="text" class="form-control require" name="faci_heading" value="<?php echo !empty($facility_Details)?$facility_Details['0']['faci_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
							    <input type="text" class="form-control" name="faci_sub_heading" value="<?php echo !empty($facility_Details)?$facility_Details['0']['faci_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
							</div>
						</div>
					
						<div class="edu_btn_wrapper">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
								<span> 
									<button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/facility_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>		
	</div>
<!--</section>-->
<!--<section class="edu_admin_content">-->
	<div class="edu_admin_right sectionHolder edu_facility_manage">
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	        <a href="#faciModal" class="edu_admin_btn openPopupLink add_facility"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_facility'));?></a>
	    </div>
	    <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-placement="top" title="Delete" data-table="facilities" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
	    <div class="edu_main_wrapper edu_table_wrapper">
		    <div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    
                    <table class="server_datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/facility_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_icon'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</section> 

<!-- Pop Up Start  -->
<div id="faciModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="faciModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_facility'));?></h4>
            <form method="post" autocomplete="off">
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?><sup>*</sup></label>
    						<input type="text" class="form-control require"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>" name="title"  >				
    					</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_icon'));?><sup>*</sup></label>
    						<input type="text" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_icon'));?>" name="icon">
                            <p class="edu_info"><?php echo html_escape($this->common->languageTranslator('ltr_go_to'));?> <a href="https://icofont.com/icons" target="_blank"><?php echo html_escape($this->common->languageTranslator('ltr_icons'));?></a>, <?php echo html_escape($this->common->languageTranslator('ltr_icon_note'));?></p>
    					</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
                            <textarea name="description" class="form-control require" rows="3" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
    					</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
    						<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_save'));?>" class="btn btn-primary addEditFacility" data-id="" />
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