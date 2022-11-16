<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_extra_classes"> 
		
	    
		<?php 
			if(!empty($homeworks_data)){
			?>
		<div class="edu_main_wrappe edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="edu_title_wrapper">
							<h4 class="edu_filter_title white"><?php echo html_escape($this->common->languageTranslator('ltr_filter_homeworks'));?></h4>
						</div>
                    </div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
								<input type="text" class="chooseDate form-control filter_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_date'));?>">
							</span>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
								<div class="pxn_admin_btnsection">
									<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary searchPRevCls"/>
								</div>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="edu_main_wrappe edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
    				<table  class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="front_ajax/homewrok_table">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_teacher'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_d_homeworks')).'</div>
                            </div>
                        </div>
                    </section>';
			}
		?>
	</div>
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