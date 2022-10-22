<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_gallery_manager">
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	      
                        <a href="#add_image_video" class="edu_admin_btn openPopupLink addGalleryPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_image'));?></a>
        </div>
	    
	    <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="gallery" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
    		if(!empty($gallery)){
    		?> 
	    <div class="edu_main_wrapper edu_table_wrapper">
		    <div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/gallery_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_type'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_gallery_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	</div>
</section>

<!-- Pop Up Start  -->
<div id="add_image_video" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_image'));?></h4>
            <form class="pxn_amin form" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id" id="gallery_id">
		    	<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?><sup>*</sup></label>
							<input type="text" class="form-control require" name="title" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>">
						</div>
					</div>	
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_type'));?><sup>*</sup></label>
							<select name="type" class="galleryType require form-control edu_selectbox_without_search">
								<option value="Image"><?php echo html_escape($this->common->languageTranslator('ltr_image'));?></option>
								<option value="Video"><?php echo html_escape($this->common->languageTranslator('ltr_video'));?></option>
							</select>
						</div>
					</div>	
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 galleryImgFld">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?><sup>*</sup></label>
							<input type="file" class="form-control Image require" accepts="image/*" name="image" data-valid="image" data-error="Please select jpg/png image.">
							<p class="fileNameShow"></p>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 galleryVideoFld hide">
					    <label><?php echo html_escape($this->common->languageTranslator('ltr_Source'));?><sup>*</sup></label>
	   					<div class="form-group">
	   					    	<select name="upload" class="galleryTypefile form-control edu_selectbox_without_search">
								<option value="File"><?php echo "File";?></option>
								<option value="URL"><?php echo "Url";?></option>
							</select>
						</div>
					</div>	
						<div class="col-lg-12 col-md-12 col-sm-12 col-12 galleryVideolink hide">
	   					<div class="form-group">
					<label><?php echo html_escape($this->common->languageTranslator('ltr_youtube_URL'));?><sup>*</sup></label>
						<input type="text" class="form-control"  name="video_url" data-valid="youtube" data-error="Please enter a valid youtube url." placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_youtube_URL'));?>" data-symb="no">
					</div>
					</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-12 galleryVideofile hide">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_video'));?><sup>*</sup></label>
							<input type="file" class="form-control video" name="video" data-valid="video" data-error="Please choose valid video Format.">
							<p class="fileNameShow"></p>
						</div>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addVideoImgGalry" /> 
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
<!-- view Pop Up Start  -->
<div id="view_video_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="viewVideoTopic"><?php echo html_escape($this->common->languageTranslator('ltr_view_video'));?></h4>
            <div class="row videoIframeShow">
            </div>
        </div>
    </div>
</div>
<!-- view image start-->
<div id="view_image_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_view_image'));?></h4>
             <form class="pxn_amin form" method="post">
               <img src="" alt="">
             </form>
        </div>
    </div>
</div>
<!-- view image end-->