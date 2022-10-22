<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">
				
		<div class="edu_main_wrapper edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<form method="post">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="edu_title_wrapper">
								<h4 class="edu_filter_title white"><?php echo html_escape($this->common->languageTranslator('ltr_filter'));?></h4>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
							<div class="form-group">
								<select class="form-control filter-by-dob filter_month edu_selectbox_with_search" name="month" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_month'));?>">
								<?php
									echo '<option value="">'.html_escape($this->common->languageTranslator('ltr_select_month')).'</option>';
									for($i=1; $i<=12; $i++){
										if($i == $month){
											$sel = 'selected';
										}else{	
											$sel = '';
										}
										$mnth = ($i<10)?'0'.$i:$i;
										echo '<option value="'.$mnth.'" '.$sel.'>'.date("F",mktime(0,0,0,$mnth,10)).'</option>';
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">	
							<div class="form-group">
								<select class="form-control filter-by-dob filter_year edu_selectbox_with_search" name="year" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_year'));?>">
								<?php
									echo '<option value="">'.html_escape($this->common->languageTranslator('ltr_select_year')).'</option>';
									for($j=2020; $j<=date('Y'); $j++){
										if($j == $year){
											$sel = 'selected';
										}else{	
											$sel = '';
										}
										echo '<option value="'.$j.'" '.$sel.'>'.$j.'</option>';
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-4">
							<div class="form-group">
								<span> 
									<input type="submit" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" Class="btn btn-primary" name="filter_performance"> 
								</span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					
				    <?php if($this->session->userdata('role')==1){ ?>
				    <button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="extra_class_attendance" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
				    <?php }?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
        <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
				    
				    
				<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="Ajaxcall/student_attendance_extra_class/<?php echo $student_id; ?>/<?php echo $month; ?>/<?php echo $year; ?>">
                        <thead>
                            <tr> 
                            <?php echo ($this->session->userdata('role')==1)?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_time'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                               <?php echo ($this->session->userdata('role')==1)?'<th>'.html_escape($this->common->languageTranslator('ltr_action')).'</th>':''; ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
				</div>
			</div>
			
			
		</div>
	</div> 
</section> 
