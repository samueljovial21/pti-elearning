<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_video_manager">
        <?php $role = $this->session->userdata('role');?>				
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	     
                        <?php echo ($role != 'student')?'<a href="#add_video_popup" class="edu_admin_btn openPopupLink edu_admin_btn_video"><i class="icofont-plus"></i>'.html_escape($this->common->languageTranslator('ltr_add_video')).'</a>':''; ?>
               
	    </div>
	    
        <?php if(!empty($video_data) && $role == 'student'){ ?>
        <div class="edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
                                <select class="form-control video_subject filter_subject edu_selectbox_with_search" name="filter_subject" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>" data-count="no">
                                    <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
                                    <?php
                                    if(!empty($subject)){
                                        foreach($subject as $sub){
                                            echo '<option value="'.$sub['id'].'">'.$sub['subject_name'].'</option>';
                                        }
                                    }
                                    ?> 
                                </select>
							</span>
						</div>
					</div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
                                <select  class="form-control filter_chapter  get_chapter edu_selectbox_with_search" name="filter_chapter" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?>"> 
                                    <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?></option>
                                </select>
							</span>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
								<div class="pxn_admin_btnsection">
									<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary searchVideo"/>
								</div>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php } ?>
        <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if($role != 'student'){?>
                    <button class="multiDelete btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="video_lectures" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?>
                    </button>
                    <button class="paidPreviewVideo btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="video_lectures" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_not_preview'));?>
                    </button>
                    <button class="freePreviewVideo btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="video_lectures" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_preview'));?>
                    </button>
                    <?php }?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
    		if(!empty($video_data)){
    		?> 
	    <div class="edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/video_table">
                        <thead>
                            <tr>
                                <?php echo ($role != 'student')?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_batch')).'</th>':''; ?>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?></th>
                               
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_Source')).'</th>':''; ?>
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_preview')).'</th>':''; ?>
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_status')).'</th>':''; ?>
                                <?php echo ($role == 1)?'<th>'.html_escape($this->common->languageTranslator('ltr_added_by')).'</th>':''; ?>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
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
			    if($role=='student'){
    		        echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_video_no_data_student')).'</div>
                            </div>
                        </div>
                    </section>';
    		    }else if($role==3){
    		         echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_video_no_data_teacher')).'</div>
                            </div>
                        </div>
                    </section>';
    		    }else{
			     echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_video_no_data_admin')).'</div>
                            </div>
                        </div>
                    </section>';
    		    }
			} ?>
	</div>
</section>


<!-- video Pop Up Start  -->
<div id="add_video_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_video'));?></h4>
            <form class="pxn_amin form" method="post" id="uploadForm">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="preview_type" value="not_preview">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?> <sup>*<sup></label>
                            <input type="text" class="form-control require video_title" name="title" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>">
                        </div>
    				</div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?><sup>*<sup></label>
                            <select class="form-control require edu_selectbox_with_search video_batch" name="batch"  data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?></option>
                                <?php 
                                    if(!empty($batch))
                                    {
                                    foreach($batch as $bat){ 
                                        echo '<option value="'.$bat['id'].'" >'.$bat['batch_name'].'</option>';
                                    }
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?><sup>*<sup></label>
                            <select class="form-control require edu_selectbox_with_search video_subject filter_subject" name="subject" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>" data-count="no">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
                                <?php if(!empty($subject))
                                {
                                    foreach($subject as $sub){ 
                                        echo '<option value="'.$sub['id'].'" >'.$sub['subject_name'].'</option>';
                                    }
                                }?>
                            </select>
                        </div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?><sup>*<sup></label>
                            <select class="form-control require edu_selectbox_with_search filter_chapter" name="topic" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?>">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter'));?></option>
                            </select>
                        </div>
    				</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <label><?php echo html_escape($this->common->languageTranslator('ltr_Source'));?><sup>*<sup></label><br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input require" checked type="radio" name="video_type" id="inlineRadio1" value="youtube">
                          <label class="form-check-label" for="inlineRadio1"><?php echo html_escape($this->common->languageTranslator('ltr_youtube'));?></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input require" type="radio" name="video_type" id="inlineRadio2" value="vimeo">
                          <label class="form-check-label" for="inlineRadio2"><?php echo html_escape($this->common->languageTranslator('ltr_vimeo'));?></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input require" type="radio" name="video_type" id="inlineRadio3" value="dropbox">
                          <label class="form-check-label" for="inlineRadio3"><?php echo html_escape($this->common->languageTranslator('ltr_dropbox'));?></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input require" type="radio" name="video_type" id="inlineRadio4" value="embed">
                          <label class="form-check-label" for="inlineRadio4"><?php echo html_escape($this->common->languageTranslator('ltr_embed'));?></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input require" type="radio" name="video_type" id="inlineRadio5" value="video">
                          <label class="form-check-label" for="inlineRadio5"><?php echo html_escape($this->common->languageTranslator('ltr_upload'));?></label>
                        </div>
                       
                    </div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group video_type_all">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_url'));?><sup>*<sup></label>
                            <input type="text" class="form-control require video_url"  name="url" data-valid="youtube" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_url_msg'));?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_url'));?>" data-symb="no">
                        </div>
                        <div class="form-group hide video_type_video">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_file'));?><sup>*<sup></label>
                            <input type="file" class="form-control video_file"  name="video_file" data-valid="video" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_video_msg'));?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_file'));?>" data-symb="no">
                            	<p class="fileNameShow"></p>
                        </div>
                         <div class="progress hide">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"></div>
                        </div>
                        <div id="uploadStatus"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?> </label>
                            <textarea class="form-control video_description" name="description" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>">   
                            </textarea>
                        </div>
                    </div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_button_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addNewVideo" />
						</div>
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
