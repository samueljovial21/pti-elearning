<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_extra_classes"> 
	    
	    <div class="edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
					<?php if($this->session->userdata('role')==1){ ?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <?php 
            			if(!empty($teacher_data)){
            			?>
						<div class="form-group">
							<span>	
								<select class="form-control edu_selectbox_with_search" id="teacherIdSrch" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_teacher'));?>">
									<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_teacher'));?></option>
									<?php foreach($teacher as $teach){
										echo '<option value="'.$teach['id'].'">'.$teach['name'].'</option>';
									}?>
								</select>
							</span>
						</div>
						<?php } ?>
					</div>
					<?php } ?>	
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <?php 
            			if(!empty($teacher_data)){
            			?>
						<div class="form-group">
							<span>
								<select class="form-control edu_selectbox_without_search" id="classStatus" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_status'));?>">
									<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_status'));?></option>
									<option value="Complete"><?php echo html_escape($this->common->languageTranslator('ltr_complete'));?></option>
									<option value="Incomplete"><?php echo html_escape($this->common->languageTranslator('ltr_incomplete'));?></option>
								</select>
							</span>
						</div>
						<?php } ?>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <?php 
            			if(!empty($teacher_data)){
            			?>
						<div class="form-group">
							<span>
								<div class="pxn_admin_btnsection">
									<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary searchExtraClass"/>
								</div>
							</span>
						</div>
						<?php } ?>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-sm-right">
					    
                                	<?php if($this->session->userdata('role')==1){ ?>
                        			<a href="#pxn_extra_class" class="edu_admin_btn openPopupLink add_extaClassPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_extra_class'));?></a>
                        			<?php }else{
                        			    if(!empty($teacher_data)){
                        			    ?>
                        				<a href="<?php echo base_url('teacher/progress');?>" class="edu_admin_btn"><?php echo html_escape($this->common->languageTranslator('ltr_view_progress'));?></a>
                        			<?php } } ?>
                                
					
					</div>
				</div>
			</div>
		</div>
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if($this->session->userdata('role')==1){ ?>
				    <button class="multiDelete btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="extra_classes" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
				    <?php }?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if(!empty($teacher_data)){
			?>
		<div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
				    
    				<table  class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/extraclass_table">
    					<thead>
    						<tr>
    						    	<?php echo ($this->session->userdata('role')==1)?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
    						    
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_time'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
    							<?php echo ($this->session->userdata('role')==1)?'<th>'.html_escape($this->common->languageTranslator('ltr_teacher')).'</th>':''; ?>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_complete_date_time'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
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
			    if($this->session->userdata('role')==3){
			         echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_extra_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			    }else{
			     echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_extra_no_data_admin')).'</div>
                            </div>
                        </div>
                    </section>';
}			} ?>
	</div>
</section> 

<!-- Pop Up Start  -->
<div id="pxn_extra_class" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="PopupTitle"><?php echo html_escape($this->common->languageTranslator('ltr_add_extra_class'));?></h4>
            <form class="pxn_amin form" method="post" autocomplete="off">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_teacher'));?> <sup>*</sup></label>								
							<select class="form-control require edu_selectbox_with_search" name="teacher_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_teacher'));?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_teacher'));?></option>
								<?php foreach($teacher as $teach){
									echo '<option value="'.$teach['id'].'">'.$teach['name'].'</option>';
								}?>
							</select>								
						</div>	
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?> <sup>*</sup></label>								
							<select class="form-control  edu_selectbox_with_search" multiple name="batch_id[]" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>">
								
								<?php foreach($batches as $batch){
									echo '<option value="'.$batch['id'].'">'.$batch['batch_name'].'</option>';
								}?>
							</select>				 				
						</div>	
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_date'));?><sup>*</sup></label>
							<input type="text" class="form-control require chooseDate_extra" name="date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_date'));?>">
						</div>	
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_start_time'));?><sup>*</sup></label>
							<input type="text" class="form-control require chooseBtmTime" name="start_time" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_start_time'));?>">
						</div>	
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_end_time'));?><sup>*</sup></label>
							<input type="text" class="form-control require chooseBtmTime" name="end_time" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_end_time'));?>">
						</div>	
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
							<textarea class="form-control require" name="description" rows="3" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
						</div>	
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addNewExtraClss" />
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