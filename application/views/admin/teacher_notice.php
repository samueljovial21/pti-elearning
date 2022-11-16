<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_notice_manage">
	   <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
	        <a href="#input_feilds_notice" class="edu_admin_btn openPopupLink"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_notice'));?></a>
	    </div>
		<div class="edu_main_wrapper edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="edu_title_wrapper">
							<h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_teacher_details'));?></h4>
						</div>
					</div>
					<?php 
					    if(!empty($teacher_data)){
					        $batch_id = $teacher_data[0]['teach_batch'];
					        $subject_id = $teacher_data[0]['teach_subject'];
					        $batchName = '';
					        $subjectName = '';
					        if(!empty($batch_id)){
					            $batchDetls = $this->db_model->select_data('batch_name','batches use index (id)','id in ('.$batch_id.')');
					           
					            $batch = [];
                                for($i=0; $i<count($batchDetls); $i++){
                                    $batch[$i] = $batchDetls[$i]['batch_name'];
                                }
                                $batchName = implode(',',$batch);
					        }
					        
					        if(!empty($subject_id)){
								$subject_id = implode(',', json_decode($subject_id));
	
					            $subjctDetls = $this->db_model->select_data('subject_name','subjects use index (id)','id in ('.$subject_id.')');
					            $subject = [];
                                for($i=0; $i<count($subjctDetls); $i++){
                                    $subject[$i] = $subjctDetls[$i]['subject_name'];
                                }
                                $subjectName = implode(',',$subject);
					        }
							
							echo '
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<img src="'.base_url('uploads/teachers/'.$teacher_data[0]['teach_image']).'" alt="Teacher Image" class="noticeStImage">
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<div class="edu_extra_class padderTop20">
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_name')).'- </span>'.$teacher_data[0]['name'].'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_email')).' - </span>'.$teacher_data[0]['email'].'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_eductaion')).'- </span>'.$teacher_data[0]['teach_education'].'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_batch_name')).'- </span>'.$batchName.'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_subject_name')).'- </span>'.$subjectName.'</p>
								</div>
							</div>';
						
					} ?>	
				</div>
			</div>
		</div>
		<div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
    				<table class="server_datatable datatable table table-striped table-hover dt-responsive" data-url="ajaxcall/teacher_notice_table/<?php echo $teacher_id; ?>" cellspacing="0" width="100%">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
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
					<input type="hidden" id="teacher_id" value="<?php echo $teacher_id; ?>" name="teacher_id">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_type_notice_here'));?> <sup>*</sup></label>
							<textarea class="form-control require" name="description" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
						</div>
    				</div>
    				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_notice'));?>" class="edu_admin_btn addPrsnlNotice" />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>