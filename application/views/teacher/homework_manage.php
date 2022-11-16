<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">			
		<div class="edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
				  
					<div class="col-lg-3 col-md-3 col-sm-6 col-12">
					    <?php
                    		if(!empty($hwo_data)){
                    		?>
						<div class="form-group">
							<span>
								<input type="text" Class="form-control chooseDate from_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_from_date'));?>"> 
							</span>
						</div>
						<?php }?>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-12">
					    <?php
                    		if(!empty($hwo_data)){
                    		?>
						<div class="form-group">
							<span>
								<input type="text" Class="form-control chooseDate to_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_to_date'));?>"> 
							</span>
						</div>
						<?php } ?>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-12">
					    <?php
                    		if(!empty($hwo_data)){
                    		?>
						<div class="form-group">
							<span> 
								<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" Class="btn btn-primary filter_homework"> 
							</span>
						</div>
						<?php } ?>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-12 text-sm-right">
						<a href="#homeworkPopup" class="edu_admin_btn openPopupLink add_homework"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_assignment'));?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="homeworks" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php
		if(!empty($hwo_data)){
		?>
        <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
				    
					<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/homework_table<?php echo (!empty($date))?'/'.$date:'';?>">
						<thead>
							<tr> 
							<th><input type="checkbox" class="checkAllAttendance"></th>
								<th>#</th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_homework_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
		}
		?>
	</div> 
</section> 

<!-- Pop Up Start  -->
<div id="homeworkPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="homeworkPopupLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_homework'));?></h4>
            <form class="pxn_amin form" enctype="multipart/form-data" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?><sup>*<sup></label>
                            <select class="form-control require edu_selectbox_with_search get_teacher_subject" name="batch_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>" >
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
                            <select class="form-control require edu_selectbox_with_search teacher_subject" name="subject_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?>" data-count="no">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
                                <?php if(!empty($subject))
                                {
                                    // foreach($subject as $sub){ 
                                    //     echo '<option value="'.$sub['id'].'" >'.$sub['subject_name'].'</option>';
                                    // }
                                }?>
                            </select>
                        </div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_date'));?> <sup>*</sup></label>
							<input type="text" Class="form-control chooseDate require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_date'));?>" name="date"> 
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
							<textarea name="description" rows="3" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>" class="form-control require"></textarea>
						</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="btn btn-primary addEditHomewrk" />
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
