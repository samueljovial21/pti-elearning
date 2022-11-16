<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_notice_manage">
	    <div class="edu_admin_informationdiv ">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-12 padder0">
					    <?php 
            			// if((!empty($notice_data) && $notice_data>=1)){
            			?>
						<div class="edu_courses_section notic_mng">
							<ul class="nav nav-tabs" role="tablist">
			

				    <li class="nav-item tabTableCls Both" data-url="ajaxcall/notice_table/common">
									<a class="nav-link active" href="#common" role="tab" data-toggle="tab" aria-selected="true">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_common_notice'));?></p>
										</span>
									</a>
								</li>
								<li class="nav-item tabTableCls Student" data-url="ajaxcall/notice_table/student">
									<a class="nav-link" href="#student" role="tab" data-toggle="tab" aria-selected="false">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_student_notice'));?></p>
										</span>
									</a>
								</li>
								<li class="nav-item tabTableCls Teacher" data-url="ajaxcall/notice_table/teacher">
									<a class="nav-link" href="#teacher" role="tab" data-toggle="tab" aria-selected="false">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_teacher_notice'));?></p>
										</span>
									</a>
								</li>
							</ul>
						</div>
						<?php 
						// }
						?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-12 padder0 text-right">
					    
                                     <a href="#input_feilds_notice" class="edu_admin_btn openPopupLink"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_notice'));?></a> 
                          
					   
					</div>
				</div>
			</div>
			<?php 
			// if((!empty($notice_data) && $notice_data>=1)){
			?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
						<div class="edu_courses_section">
							<div class="tab-content">
							    <div role="tabpanel" class="tab-pane fade active in show" id="common">
									<div class="edu_courses_content">
										<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
											<div class="edu_table_wrapper">
                                    			<div class="edu_admin_informationdiv sectionHolder">
                                    				<div class="tableFullWrapper"> 
                                        				<table class="server_datatable datatable table table-striped table-hover dt-responsive" data-url="ajaxcall/notice_table/common" cellspacing="0" width="100%">
                                        					<thead>
                                        						<tr>
                                        							<th>#</th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_notice_for'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                                        						</tr>
                                        					</thead>
                                        					<tbody>
                                        					</tbody> 
                                        				</table>
                                        			</div>
                                    			</div>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="student">
									<div class="edu_courses_content">
										<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
											<div class="edu_table_wrapper">
                                    			<div class="edu_admin_informationdiv sectionHolder">
                                    				<div class="tableFullWrapper">
                                        				<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                        					<thead>
                                        						<tr>
                                        							<th>#</th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_notice_for'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                                        						</tr>
                                        					</thead>
                                        					<tbody>
                                        					</tbody> 
                                        				</table>
                                        			</div>
                                    			</div>
											</div>
										</div>
									</div>	
								</div>	
								<div role="tabpanel" class="tab-pane fade" id="teacher">
									<div class="edu_courses_content">
										<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
											<div class="edu_table_wrapper">
                                    			<div class="edu_admin_informationdiv sectionHolder">
                                    				<div class="tableFullWrapper">
                                        				<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                        					<thead>
                                        						<tr>
                                        								<th>#</th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_notice_for'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                                        						</tr>
                                        					</thead>
                                        					<tbody>
                                        					</tbody> 
                                        				</table>
                                        			</div>
                                    			</div>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			// }else{ 
			//      echo '<section class="edu_admin_content">
            //             <div class="edu_admin_right sectionHolder edu_add_users">
            //                 <div class="edu_admin_informationdiv edu_main_wrapper">
            //                     <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_notice_no_data')).'</div>
            //                 </div>
            //             </div>
            //         </section>';
			// } 
			?>
		</div>
	</div>
</section>

<!-- Pop Up Start  -->
<div id="input_feilds_notice" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_notice'));?></h4>
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_notice_title'));?><sup>*</sup></label>
							<input type="text" class="form-control require" name="title" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_notice_title'));?>">
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_notice_for'));?><sup>*</sup></label>
							<select class="form-control require edu_selectbox_without_search" name="notice_for" data-placeholder="Select Notice For">
								<option value="Both"><?php echo html_escape($this->common->languageTranslator('ltr_both'));?></option>
								<option value="Student"><?php echo html_escape($this->common->languageTranslator('ltr_students'));?></option>
								<option value="Teacher"><?php echo html_escape($this->common->languageTranslator('ltr_teachers'));?></option>
							</select>
						</div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_type_notice_here'));?><sup>*</sup></label>
							<textarea class="form-control require" name="description" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_notice_description'));?>"></textarea>
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_notice'));?>" class="edu_admin_btn addNewNotice" />
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
           <h4 class="edu_sub_title" id="charaTitele">Qustions</h4>
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