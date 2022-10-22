<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_course_manager">
	    <div class="edu_btn_wrapper sectionHolder text-right">
	        <a href="#courseModal" class="edu_admin_btn openPopupLink add_course"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_course'));?></a>
	    </div>
	    	<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-placement="top" title="Delete" data-table="courses" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
	    <div class="edu_main_wrapper edu_table_wrapper">
		    <div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/course_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_image'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_end_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_course_duration'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_class_size'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_time_duration'));?></th>
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
<div id="courseModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="courseModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_course'));?></h4>
            <form method="post" autocomplete="off" id="courseForm">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_course_name'));?><sup>*</sup></label>
							<input type="text" class="form-control require"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_course_name'));?>" name="course_name"  id="courseName" >		
    					</div>
    				</div>
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?><sup>*</sup></label>
							<input type="text" class="form-control chooseDate require"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?>"  name="start_date"  id="c_startDate" >	
    					</div>
    				</div>
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_end_date'));?><sup>*</sup></label>
							<input type="text" class="form-control chooseDate require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_end_date'));?>" name="end_date"  id="c_endDate" >
    					</div>
    				</div> 
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_class_size'));?><sup>*</sup></label>
							<input type="number" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_class_size'));?>" name="class_size"  id="c_clsSize" >
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_class_time_duration'));?><sup>*</sup></label>
							<input type="text" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_class_time_duration'));?>" name="time_duration"  id="c_timeDurat" >
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
        				<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?><sup>*</sup></label>
    						<input type="file" class="form-control require" name="image"  id="c_crsImg" >
							<p class="fileNameShow"></p>		
    					</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
							<textarea name="description" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>" id="c_desc"  rows="3"></textarea>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="hidden" name="course_id" id="course_id" value="">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_save'));?>" class="edu_admin_btn addEditCourse" data-type="add" />
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
            <h4 class="edu_sub_title" id="stImgModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_course_image'));?></h4>
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group text-center">
						<img id="std_img" src="" alt="Course Image"/>
					</div>
				</div>
			</div>
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