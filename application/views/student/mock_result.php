<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_practice_manager">
		<div class="edu_admin_informationdiv sectionHolder">
		   <?php 
	    if(!empty($paperList)){
	    ?> 
		    <div class="edu_main_wrapper edu_table_wrapper mb_30">
			    <div class="edu_filter_wrapper">
    				<div class="row">
    					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    						<div class="row">
    						    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    								<div class="edu_filter_header"><h4 class="edu_filter_title"><?php echo html_escape($this->common->languageTranslator('ltr_select_month_year'));?></h4></div>
    							</div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">	
    						    	<div class="form-group">
    								    <select class="form-control filter-by-dob filter_month edu_selectbox_with_search" name="filter_month" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_month'));?>">
    									<?php
    										echo '<option value="">'.html_escape($this->common->languageTranslator('ltr_select_month')).'</option>';
    										for($i=1; $i<=12; $i++){
    											$mnth = ($i<10)?'0'.$i:$i;
    											echo '<option value="'.$mnth.'">'.date("F",mktime(0,0,0,$mnth,10)).'</option>';
    										}
    									?>
    								    </select>
    								</div>
    							</div>
    							<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
    						    	<div class="form-group">
    								    <select class="form-control filter-by-dob filter_year edu_selectbox_with_search" name="filter_year" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_year'));?>">
    									<?php
    										echo '<option value="">'.html_escape($this->common->languageTranslator('ltr_select_year')).'</option>';
    										for($j=2020; $j<=date('Y'); $j++){
    											echo '<option value="'.$j.'">'.$j.'</option>';
    										}
    									?>
    								    </select>
    								</div>
    							</div>
    							<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
    						    	<div class="form-group">
    							        <input type="button" value="Search" class="btn btn-primary filter_result_by_monyr">
    							    </div>
    							</div>
    						</div>
        		    	</div>
        		    	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    						<div class="filterByPaperDiv">
    						    <div class="row">
    							    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        								<div class="edu_filter_header"><h4 class="edu_filter_title"><?php echo html_escape($this->common->languageTranslator('ltr_select_paper_f'));?></h4></div>
        							</div>
    								<div class="col-lg-6 col-md-6 col-sm-12 col-12">	
    						    	    <div class="form-group">
        								    <select class="form-control filter-by-paper filter_paper edu_selectbox_with_search" name="filter_paper" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_paper'));?>">
        									<?php
        										echo '<option value="">'.html_escape($this->common->languageTranslator('ltr_select_paper')).'</option>';
        										if(!empty($paperList)){
        											foreach($paperList as $paper){	
        												echo '<option value="'.$paper['id'].'">'.$paper['name'].'</option>';
        											}
        										}
        									?>
        								    </select>
    								    </div>
    						    	</div>
    						    	<div class="col-lg-6 col-md-6 col-sm-12 col-12">	
    						    	    <div class="form-group">
    								        <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary filter_paper_by_name">
    							        </div>
    							    </div>
        				        </div>
        				    </div>
        				</div>
    	            </div>
    	       </div>
	        </div>
	        <div class="edu_main_wrapper edu_table_wrapper">
    	       <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="front_ajax/result_table/mock">
                        <thead>
                            <tr>  
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_paper_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_start_time'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_submit_time'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_total_question'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_attempted_question'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_time_duration'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_time_taken'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_right_answer'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_percentage'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
	</div>
</section>

<!-- Pop Up Start  -->
<div id="stImgModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="stImgModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_student_image'));?></h4>
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group">
						<img id="std_img" src="" alt="Student Image"/>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>