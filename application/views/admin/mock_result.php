<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_mock_result_wrap">
		<div class="edu_admin_informationdiv">
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
    					                <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary filter_result_by_monyr">
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
                                     <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group">
                                            
                                            <select class="form-control require filter_batch" name="batch"  data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>">
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
    								<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
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
            						<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
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
            <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if($this->session->userdata('role')==1){ ?>
				    <button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="mock_result" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
				    <?php } ?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
            <div class="edu_main_wrapper edu_table_wrapper">
				<div class="tableFullWrapper">
				    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/result_table/mock">
                        <thead>
                            <tr>
                                <?php echo ($this->session->userdata('role')==1)?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_student_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_enrolment_id'));?> </th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_record')).'</div>
                            </div>
                        </div>
                 </section>';
			    
			} ?>
        </div>
    </div>
</section>