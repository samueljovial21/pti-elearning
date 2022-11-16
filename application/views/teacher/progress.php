<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">				
		<div class="edu_main_wrapper edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="edu_title_wrapper">
							<h4 class="edu_filter_title white"><?php echo html_escape($this->common->languageTranslator('ltr_filter'));?></h4>
						</div>
                    </div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-4">
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
					<div class="col-lg-4 col-md-4 col-sm-4 col-4">
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
					<div class="col-lg-4 col-md-4 col-sm-4 col-4">
						<div class="form-group">
							<span> 
								<input type="button" value="Search" Class="btn btn-primary filter_progress"> 
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
					<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/batchdetails_table/<?php echo $this->session->userdata('uid');?>">
						<thead>
							<tr> 
								<th>#</th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_batch_time'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_class_dates'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_class_time'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_complete_date'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_subject'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_chapter'));?></th>
								<th><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="edu_main_wrapper edu_table_wrapper mb_30 ">
			<div class="edu_admin_informationdiv sectionHolder" id="scrollGraph">
                <?php
                $pendingCount = 0;
                $completeCount = 0;
                $totalCount = 0;
                $pendingChapter = 0;
                $completeChapter = 0;
                
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
                <input type="hidden" value="<?php echo $this->session->userdata('uid');?>" id="teacher_id">
                <div class="teacher_progres">
                <div class="hide teacher_progress_popup">
                    <div id="canvas-holder" style="width:60%; margin: 0 auto;">
                        <canvas id="chart-area"></canvas>
                    </div>
               </div>               
                </div>
			</div>
		</div>
		
	</div> 
</section> 

<!-- Pop Up Start  -->
<div id="chapterModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_chapter_details'));?></h4>
			<div class="chapter_wrapperDiv">
			</div>
        </div>
    </div>
</div>

<script>

    var config = {
        type: 'pie',
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
            }
        }
    };

</script>
