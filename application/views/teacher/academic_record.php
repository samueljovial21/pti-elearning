<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">
	    <?php if(!empty($homework) || !empty($extra_class) || !empty($video_lecture)){
		?>
		<?php if($this->session->userdata('role')== 1){ ?>
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
					        $subject_idd = json_decode($teacher_data[0]['teach_subject']);
					        $subject_id =implode(',',$subject_idd);
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
		<?php } 
		
		?>	
		
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
        <div class="edu_main_wrapper edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<canvas id="chart_area" width="800" height="400"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		 <?php }else{
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

<script>

    var config = {
        type: 'bar',
        data: {
			labels: ["Extra Class","Homework","Video Lecture"],
			datasets: [{ 
				data: [<?php echo $extra_class.','.$homework.','.$video_lecture?>],
				label: "",
				backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			}]
		},
		options: {
			legend: { display: false },
			title: {
				display: true,
				text: 'Academic Report'
			},
			scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
		}
    };

    window.onload = function() {
        var ctx = document.getElementById('chart_area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };
    
</script>