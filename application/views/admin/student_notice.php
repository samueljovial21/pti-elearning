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
							<h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_student_details'));?></h4>
						</div>
					</div>
					<?php 
					if(!empty($student_data)){
							
						 $join = array('batches',"batches.id = sudent_batchs.batch_id");
                      $student_batch = $this->db_model->select_data('sudent_batchs.student_id,sudent_batchs.batch_id,batches.batch_name','sudent_batchs',array('student_id'=>$student_id),'','','',$join);
                   

                      $batch_name="";
                     
                      foreach($student_batch as $batch){
                        $batch_name .= $batch['batch_name'].', ';
                    
                      }
                     if(!empty($student_batch)){
                        $batchData = rtrim($batch_name,", ");
                      }else{
                          $batch_name = "<p>No Batch Purchased</p>";
                         $batchData = $batch_name;
                      }  
							
							if(!empty($student_data[0]['image'])){
							    $img_url =  'uploads/students/'.$student_data[0]['image'];
							}else{
							    $img_url =  'assets/images/student_img.png';
							}
							echo '
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<img src="'.base_url($img_url).'" alt="Student Image" class="noticeStImage">
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<div class="edu_extra_class padderTop20">
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_name')).' - </span>'.$student_data[0]['name'].'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_email')).' - </span>'.$student_data[0]['email'].'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_contact_no')).' - </span>'.$student_data[0]['contact_no'].'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_batch_name')).' - </span>'.$batchData.'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_admission_date')).' - </span>'.$student_data[0]['admission_date'].'</p>
								</div>
							</div>';
						
					} ?>	
				</div>
			</div>
		</div>
		<div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
    				<table class="server_datatable datatable table table-striped table-hover dt-responsive" data-url="ajaxcall/student_notice_table/<?php echo $student_id; ?>" cellspacing="0" width="100%">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_title'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
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
							<label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?><sup>*</sup></label>
							<input type="text" class="form-control require" name="title" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>">
						</div>
    				</div>  
					<input type="hidden" id="student_id" value="<?php echo $student_id?>" name="student_id">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">            
							<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
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