<?php print_r($_SESSION);?>
<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_video_manager">
        <?php $role = $this->session->userdata('role');?>				
	    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	         
                        <?php echo ($role != 'student')?'<button class="edu_admin_btn addoldpaper_popup"><i class="icofont-plus"></i>'. html_escape($this->common->languageTranslator('ltr_add_old_paper')) .'</button>':''; ?>
               
            
	    </div>
         
        <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if($role != 'student'){?>
                    <button class="multiDelete btn_delete btn btn-primary"  data-placement="top" title="<?php echo html_escape($this->common->languageTranslator('ltr_delete'));?>" data-table="old_paper_pdf" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
                    <?php }?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
    		// if(!empty($notes_data)){
    		?> 
	    <div class="edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/old_paper_table">
                        <thead>
                            <tr>
                                <?php echo ($role != 'student')?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_paper_name'));?></th>
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_batch')).'</th>':''; ?>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_status')).'</th>':''; ?>
                                <?php echo ($role != 'student')?'<th>'.html_escape($this->common->languageTranslator('ltr_added_by')).'</th>':''; ?>
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
			// }else{ 
			//     if($role=='student'){
    		//         echo '<section class="edu_admin_content">
            //             <div class="edu_admin_right sectionHolder edu_add_users">
            //                 <div class="edu_admin_informationdiv edu_main_wrapper">
            //                     <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_notes_no_data_student')).'</div>
            //                 </div>
            //             </div>
            //         </section>';
    		//     }else if($role==3){
    		//          echo '<section class="edu_admin_content">
            //             <div class="edu_admin_right sectionHolder edu_add_users">
            //                 <div class="edu_admin_informationdiv edu_main_wrapper">
            //                     <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_oldp_no_data_admin')).'</div>
            //                 </div>
            //             </div>
            //         </section>';
    		//     }else{
			//      echo '<section class="edu_admin_content">
            //             <div class="edu_admin_right sectionHolder edu_add_users">
            //                 <div class="edu_admin_informationdiv edu_main_wrapper">
            //                     <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_oldp_no_data_admin')).'</div>
            //                 </div>
            //             </div>
            //         </section>';
    		//     }
			// }
             ?>
	</div>
</section>


<!-- video Pop Up Start  -->
<div id="add_oldpaper_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_old_paper'));?></h4>
            <form class="pxn_amin form" method="post">
            <input type="hidden" name="id" id="oldpaper_id">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?> <sup>*<sup></label>
                            <input type="text" class="form-control require video_title" name="title" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>">
                        </div>
    				</div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?><sup>*<sup></label>
                            <select id="old_paper_reset" class="form-control require edu_selectbox_with_search filter_batch book_batch" name="batch[]" multiple data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?></option>
                                <?php if(!empty($batch))
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
                            <select class="form-control require edu_selectbox_with_search filter_subject" name="subject" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>" data-count="no">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
                                
                            </select>
                        </div>
    				</div>
    				<div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_file'));?><sup>*</sup></label>
                            <input type="file" class="form-control require file_old_paper" accepts="application/pdf" name="pdf_file" data-valid="pdfimage" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_pdf_msg'));?>">
                            <p class="fileNameShow"></p>
                        </div>
                    </div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_button_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addNewOldPaper" />
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