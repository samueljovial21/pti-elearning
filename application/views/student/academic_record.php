<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">
		<?php if($this->session->userdata('role')== 1 || $this->session->userdata('role')== 3){ ?>
		
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
							echo '
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<img src="'.base_url('uploads/students/'.$student_data[0]['image']).'" alt="Student Image" class="noticeStImage">
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
		<?php } 
		if(!empty($total_extra_class) || !empty($total_practice_test) || !empty($total_mock_test)){
		
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
									echo '<option value="">'.html_escape($this->common->languageTranslator('ltr_select_month')).'/option>';
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
								<select class="form-control filter-by-dob filter_year edu_selectbox_with_search" name="year" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_year'));?>>
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
		
		<div class="row">
		    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
		        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_academic_record'));?></h4>
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
		    </div>
		    
		  </div>
		</div>
		<?php }else{
		    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_progress_report_no')).'</div>
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
			labels: ["Extra Class (<?php echo $total_extra_class;?>)","Practice Paper (<?php echo $total_practice_test;?>)","Mock Test Paper (<?php echo $total_mock_test;?>)"],
			datasets: [{ 
				data: [<?php echo $extra_class.','.$practice_result.','.$mock_result;?>],
				label: "",
				backgroundColor: ["#3e95cd", "#3cba9f","#e8c3b9","#c45850"],
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
 
</script>