<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_question_manager">
		<?php if($this->session->userdata('role')== 1 || $this->session->userdata('role')== 3){ ?>
	
	   <div class="edu_main_wrapper mb_30">
	
	    <div class="edu_accordion_container">
               
                    <div class="edu_accord_parent m-0">
                        <span class="edu_accordion_header">
                       <span class="subjects_name"><?php echo html_escape($this->common->languageTranslator('ltr_student_details'));?></span>
                            <i>
                                <i class="fa fa-angle-right upDownI"></i>
                                
                            </i>
                        </span>
                        <div class="edu_accordion_content">
                            <div class="row">
                                
                               	
		   		<?php 
					if(!empty($student_data)){
							$batchDetls = $this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$student_data[0]['batch_id'] ));
							if(!empty($batchDetls)){
								$batchName = $batchDetls[0]['batch_name'];
							}else{
								$batchName = '';
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
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_batch_name')).' - </span>'.$batchName.'</p>
									<p class="clsdesc"><span class="boldText">'.html_escape($this->common->languageTranslator('ltr_admission_date')).' - </span>'.$student_data[0]['admission_date'].'</p>
								</div>
							</div>';
						
					} ?>
                                
                                
                            </div>
                        </div>
                    </div>
            </div>
	
	</div>
	
		<?php } 
		if(!empty($practice_result_d) || !empty($mock_result_d)){
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
		
		<div class="row">
		    <div class="col-xl-12">
		        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_practice_paper_progress_report'));?></h4>
		    </div>
		    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
		        <div class="edu_main_wrapper edu_table_wrapper mb_30">
        			<div class="edu_admin_informationdiv sectionHolder">
        				<canvas id="practice_paper" width="800" height="400"></canvas>			
        			</div>
        		</div>
		    </div>
		    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
        		<div class="edu_main_wrapper edu_table_wrapper mb_30">
        			<div class="edu_admin_informationdiv sectionHolder">
        				<canvas id="mock_paper" width="800" height="400"></canvas>
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
<?php 
$practice_label = $mock_label = $pract_per = $mock_per = '';
if(!empty($practice_result)){
	$practice_date = [];
	$practice_percentage = [];
	foreach($practice_result as $result){
		
		$label = $result['date'].'('.$result['paper_name'].')';
		array_push($practice_percentage,number_format((float)$result['percentage'], 2, '.', ''));
		array_push($practice_date, "'".$label."'");
	}
	
	$practice_label = implode(',',$practice_date);

	$pract_per = implode(',',$practice_percentage);
}
if(!empty($mock_result)){
	$mock_date = [];
	$mock_percentage = [];
	foreach($mock_result as $result){
	
		$label = $result['date'].'('.$result['paper_name'].')';
		array_push($mock_percentage,number_format((float)$result['percentage'], 2, '.', ''));
		array_push($mock_date, "'".$label."'");
	}
	
	$mock_label = implode(',',$mock_date);
	$mock_per = implode(',',$mock_percentage);

}
?>
<script>
    
    var practice_config = {
        type: 'line',
        data: {
			labels: [<?php echo $practice_label;?>],
			datasets: [{ 
				data: [<?php echo $pract_per;?>],
				label: "Percentage",
				borderColor: "#8e5ea2",
				fill: true,
			}]
		},
		options: {
			legend: { display: false },
			title: {
				display: true,
				text: 'Practice Paper Progress Report'
			},
		}
    };

	var mock_config = {
        type: 'line',
        data: {
			labels: [<?php echo $mock_label;?>],
			datasets: [{ 
				data: [<?php echo $mock_per;?>],
				label: "Percentage",
				borderColor: "#3e95cd",
				fill: true,
			}]
		},
		options: {
			legend: { display: false },
			title: {
				display: true,
				text: 'Mock Test Paper Progress Report'
			}
		}
    };

    
</script>