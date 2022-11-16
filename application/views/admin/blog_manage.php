<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_course_manager">
	    <div class="edu_btn_wrapper sectionHolder text-right">
	        <a href="#courseModal" class="edu_admin_btn openPopupLink add_blog"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_blog'));?></a>
	    </div>
	    	<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="blog" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
	    <div class="edu_main_wrapper edu_table_wrapper">
		    <div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/blog_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_image'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                <!-- <th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th> -->
								<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
    							<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
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
            <h4 class="edu_sub_title" id="blogModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_blog'));?></h4>
            <form method="post" autocomplete="off" id="blogForm">
                <input type="hidden" name="id" value="" id="blog_id">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
    						<label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?><sup>*</sup></label>
							<input type="text" class="form-control require"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>" name="blog_title"  id="blogTitle" >		
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
							<textarea name="description" class="form-control summernote require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>" id="c_desc"  rows="6"></textarea>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_save'));?>" class="edu_admin_btn addEditBlog" data-type="add" />
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