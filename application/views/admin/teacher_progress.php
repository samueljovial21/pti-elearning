<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">
	    <div class="edu_main_wrapper mb_30">
            <div class="edu_accordion_container">
               
                    <div class="edu_accord_parent m-0">
                        <span class="edu_accordion_header">
                       <span class="subjects_name"><?php echo html_escape($this->common->languageTranslator('ltr_teacher_details'));?></span>
                            <i>
                                <i class="fa fa-angle-right upDownI"></i>
                                
                            </i>
                        </span>
                        <div class="edu_accordion_content">
                            <div class="row">
                                
                               	<?php 
		    if(!empty($teacher_data)){
		        $batch_id = $teacher_data[0]['teach_batch'];
		        $subject_id = implode(",",json_decode($teacher_data[0]['teach_subject']));
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
		            $subjctDetls = $this->db_model->select_data('subject_name','subjects use index (id)','id in ('.$subject_id.')');
		            $subject = [];
                    for($i=0; $i<count($subjctDetls); $i++){
                        $subject[$i] = $subjctDetls[$i]['subject_name'];
                    }
                    $subjectName = implode(',',$subject);
		        }
				
				echo '
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<img src="'.base_url('uploads/teachers/'.$teacher_data[0]['teach_image']).'" alt="Teacher Image">
					</div>
					<div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-xs-12">
					<div class="edu_extra_class">
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
            </div>
        </div>
		<div class="edu_main_wrapper  mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="edu_title_wrapper">
							<h4 class="edu_filter_title white"><?php echo html_escape($this->common->languageTranslator('ltr_filter'));?></h4>
						</div>
                    </div>
					<div class="col-lg-5 col-md-4 col-sm-12 col-12">
						<div class="form-group">
							<select class="form-control edu_selectbox_with_search slctSubject">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject'));?></option>
								<?php 
									if(!empty($subjects)){
										foreach($subjects as $sub){
											echo '<option value="'.$sub['id'].'">'.$sub['subject_name'].'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-lg-5 col-md-4 col-sm-12 col-12">
						<div class="form-group">
							<select class="form-control edu_selectbox_with_search slctBatch">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?></option>
								<?php
									if(!empty($batches)){
										foreach($batches as $batch){
											echo '<option value="'.$batch['id'].'">'.$batch['batch_name'].'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 col-sm-12 col-12">
						<div class="form-group">
							<span> 
								<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" Class="btn btn-primary filter_progress"> 
							</span>
						</div>
					</div>
				</div>
			</div>
		
        
			<div class="edu_admin_informationdiv sectionHolder edu_table_wrapper">
				<div class="tableFullWrapper teacher_progresh_e">
					<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/batchdetails_table/<?php echo $id;?>">
						<thead>
							<tr> 
								<th>#</th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_batch_time'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_class_dates'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_class_time'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_complete_date'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_subjects'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_chapters'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
                <?php
                $pendingCount = 0;
                $completeCount = 0;
                $totalCount = 0;
                $completeChapter = 0;
                $pendingChapter = 0;

                if(!empty($chapter_data)){
                    foreach($chapter_data as $chapter){
                        $total = count(json_decode($chapter['chapter'],true));
                        if(!empty($chapter['chapter_status'])){
                            $complete = count(json_decode($chapter['chapter_status'],true));
                        }else{
                            $complete = 0;
                        }
                        
                        if($complete < $total){
                            $pending = ($total - $complete);
                        }else{
                            $pending = 0;
                        }
                        $pendingCount += $pending;
                        $completeCount += $complete;
                        $totalCount += $total;
                    }
                  
                    $completeChapter = ($completeCount/$totalCount)*100;
                    $pendingChapter = ($pendingCount/$totalCount)*100;
                }
                ?>
                <input type="hidden" value="<?php echo $completeChapter;?>" id="completeChapter">
                <input type="hidden" value="<?php echo $pendingChapter;?>" id="pendingChapter">
                <input type="hidden" value="<?php echo $id;?>" id="teacher_id">
                <div class="hide teacher_progress_popup edu_main_wrapper">
                    <div id="canvas-holder" style="width:60%; margin: 0 auto;">
                        <canvas id="chart-area"></canvas>
                    </div>
                </div>
			</div>
		</div>
	</div> 
</section> 

<script>

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    document.getElementById('completeChapter').value,
                    document.getElementById('pendingChapter').value
                ],
                backgroundColor: [
                    '#109618',
                    '#ee0808'
                ],
                hoverOffset: 4,
                borderWidth: [3]
            }],
            labels: [
                'Complete',
                'Pending'
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                enabled: false
            },
        }
    };
    window.onload = function() {
        var ctx = document.getElementById('chart-area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };
    
</script>
