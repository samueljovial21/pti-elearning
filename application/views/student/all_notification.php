<section class="edu_admin_content">
		<div class="edu_admin_right sectionHolder edu_home_setting_wrapper">
	    <?php 
			if(!empty($notification_data)){
			?>
		<div class="edu_admin_informationdiv edu_main_wrappe">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
						<div class="edu_courses_section">
							<div class="tab-content">
							    <div role="tabpanel" class="tab-pane fade active in show" id="personal">
									<div class="edu_courses_content">
										<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
											<div class="edu_table_wrapper">
                                    			<div class="edu_admin_informationdiv sectionHolder">
                                    				<div class="tableFullWrapper">
                                        				<table class="server_datatable datatable table table-striped table-hover dt-responsive" data-url="front_ajax/notification_table/<?php echo $this->session->userdata('uid');?>" cellspacing="0" width="100%">
                                        					<thead>
                                        						<tr>
                                        							<th>#</th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_type'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_time'));?></th>
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
		</div>
            <?php 
            }else{ echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_notification')).'</div>
                            </div>
                        </div>
                    </section>';
                    
                }?>
              
               
        
    		</div>
        </div>
      
       
	</div>
</section> 

