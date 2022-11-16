<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_home_setting_wrapper">
	    <?php 
			if(!empty($notice_data)){
			?>
		<div class="edu_admin_informationdiv edu_main_wrappe">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
						<div class="edu_courses_section">
							<ul class="nav nav-tabs" role="tablist">
							    <li class="nav-item tabTableCls" data-url="front_ajax/notice_table/<?php echo $this->session->userdata('uid');?>">
									<a class="nav-link active" href="#personal" role="tab" data-toggle="tab" aria-selected="true">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_personal_notice'));?></p>
										</span>
									</a>
								</li>
								<li class="nav-item tabTableCls" data-url="front_ajax/notice_table/all">
									<a class="nav-link" href="#common" role="tab" data-toggle="tab" aria-selected="false">
										<span class="edu_tab_icons">
											<p><?php echo html_escape($this->common->languageTranslator('ltr_common_notice'));?></p>
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
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
                                        				<table class="server_datatable datatable table table-striped table-hover dt-responsive" data-url="front_ajax/notice_table/<?php echo $this->session->userdata('uid');?>" cellspacing="0" width="100%">
                                        					<thead>
                                        						<tr>
                                        							<th>#</th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_time'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
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
								<div role="tabpanel" class="tab-pane fade" id="common">
									<div class="edu_courses_content">
										<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
											<div class="edu_table_wrapper">
                                    			<div class="edu_admin_informationdiv sectionHolder">
                                    				<div class="tableFullWrapper">
                                        				<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                                        					<thead>
                                        						<tr>
                                        							<th>#</th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_time'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                        							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
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
			}else{ 
			    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_any_result')).'</div>
                            </div>
                        </div>
                    </section>';
			}
		?>
	</div>
	<input type="hidden" id="noticePage">
</section>
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