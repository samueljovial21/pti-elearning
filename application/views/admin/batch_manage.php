<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_batch_manager">
	    <div class="edu_btn_wrapper sectionHolder text-right">	     
         <a class="edu_admin_btn" href="<?php echo base_url('admin/add-batch')?>"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_new_batch'));?></a>
        </div>
		
		
	
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary"  data-placement="top" title="Delete" data-table="batches" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if((!empty($batch_data))){
			?>
		<div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
				    
    				<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/batch_table">
    					<thead>
    						<tr>
    						    <th><input type="checkbox" class="checkAllAttendance"></th>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_batch_name'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_start_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_end_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_batch_time'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_price'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_pay_mode'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_students'));?></th>
    							<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
    							<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
    							<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
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
                        <div class="edu_admin_right sectionHolder eac_page_re">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text">'.html_escape($this->common->languageTranslator('ltr_batch_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			}
		?>
	</div>
</section>