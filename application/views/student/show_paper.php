<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder">
		<div class="edu_admin_informationdiv sectionHolder showQuestionPaperWrapper">           
            <!------- Paper Selecion Start -------->
            <?php if($paper_type == 'practice'){ 
              if(!empty($practice_data)) { ?>
                <div class="sectionHolder select_paper_wrapper mb_30 text-center">
                    <div class="edu_main_wrapper question_paper_select">
                        <h4 class="edu_sub_title padderTop10"><?php echo html_escape($this->common->languageTranslator('ltr_select_paper'));?></h4>
                        <div class="row selectPpaerWrapper">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <select class="form-control selectPracticePaper edu_selectbox_with_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_paper'));?>">
                                        <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_paper'));?></option>
                                        <?php if(!empty($paper_list)){
                                            foreach($paper_list as $paper){
                                                echo '<option value="'.$paper['id'].'" data-ques="'.$paper['total_question'].'" data-time="'.$paper['time_duration'].'">'.$paper['name'].'</option>';
                                            }
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="paperDescriptionDiv row hide">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="edu_paper_info responsive_center">
                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_paper_name'));?>:</span><span class="paperName"></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="edu_paper_info responsive_center">
                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_total_questions'));?>:</span><span class="totalQuest"></span></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="edu_paper_info responsive_center text-right">
                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_total_time'));?>:</span><span class="totalTime"></span> <?php echo html_escape($this->common->languageTranslator('ltr_min'));?>.</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                    <div class="edu_btn_wrapper edu_paper_continue_btn">
                                        <strong><?php echo html_escape($this->common->languageTranslator('ltr_continue_exam'));?></strong>
                                        <button class="edu_admin_btn continuePaper" data-type="practice" ><?php echo html_escape($this->common->languageTranslator('ltr_yes'));?></button>
                                        <a href="" class="edu_admin_btn ml-2"><?php echo html_escape($this->common->languageTranslator('ltr_no'));?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
              }else{
                  echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_any_exam')).'</div>
                            </div>
                        </div>
                    </section>';
              }
            }else{ 
                if(!empty($mock_data)){
                if(!empty($paper_list)){
                    foreach($paper_list as $paper){

                        $resultArr = $this->db_model->select_data('id','mock_result use index (id)',array('student_id'=>$this->session->userdata('uid'),'paper_id'=>$paper['id']),1);

                        if(empty($resultArr)){
                            $start_time = $paper['mock_sheduled_date'].' '.$paper['mock_sheduled_time'];
                            $new_dateTime = date('M d, Y h:i:s A',strtotime($start_time));
                            $end_time = date('Y-m-d H:i:s', strtotime($start_time.' +'.$paper['time_duration'].' minutes'));
                       
                            if(date('Y-m-d H:i:s') <= $end_time){
                            
                            ?>
                                <div class="sectionHolder mockPaperTimerWrapper mb_30 text-center">
                                    <span class="mock_actual_date hide"><?php echo html_escape($new_dateTime);?></span>
                                    <div class="edu_main_wrapper">
                                        <div class="edu_question_paper_infomation">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="edu_paper_info responsive_center">
                                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_paper_name'));?>:</span><span class="paperName"><?php echo html_escape($paper['name']);?></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="edu_paper_info responsive_center text-center">
                                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_total_questions'));?>:</span><span class="totalQuest"><?php echo html_escape($paper['total_question']);?></span></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="edu_paper_info responsive_center text-right">
                                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_total_time'));?>:</span><span class="totalTime"><?php echo html_escape($paper['time_duration']);?></span> <?php echo html_escape($this->common->languageTranslator('ltr_min'));?>.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mockPaperTimer hide">
                                                <ul class="edu_sub_title edu_count_timer justify-content-center">
                                                    <li><span class="remain_days"></span> :</li>
                                                    <li><span class="remain_hours"></span> :</li>
                                                    <li><span class="remain_minutes"></span> :</li>
                                                    <li><span class="remain_seconds"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center paperDescriptionDiv hide">
                                                <div class="edu_btn_wrapper edu_paper_continue_btn">
                                                    <strong><?php echo html_escape($this->common->languageTranslator('ltr_continue_exam'));?></strong>
                                                    <button class="edu_admin_btn continuePaper" data-type="mock" data-id="<?php echo html_escape($paper['id']);?>"><?php echo html_escape($this->common->languageTranslator('ltr_yes'));?></button>
                                                    <a href="" class="edu_admin_btn ml-2"><?php echo html_escape($this->common->languageTranslator('ltr_no'));?></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php 
                            }else{
                               
                                echo '<div class="sectionHolder mockPaperTimerWrapper mb_30 text-center">
                                    <div class="edu_main_wrapper">
                                        <div class="edu_question_paper_infomation">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="edu_paper_info responsive_center">
                                                        <p><span class="edu_paper_smallinfo">'.html_escape($this->common->languageTranslator('ltr_paper_name')).':</span><span class="paperName">'.$paper['name'].'</span></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="edu_paper_info responsive_center text-center">
                                                        <p><span class="edu_paper_smallinfo">'.html_escape($this->common->languageTranslator('ltr_total_questions')).':</span><span class="totalQuest">'.$paper['total_question'].'</span></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="edu_paper_info responsive_center text-right">
                                                        <p><span class="edu_paper_smallinfo">'.html_escape($this->common->languageTranslator('ltr_total_time')).':</span><span class="totalTime">'.$paper['time_duration'].'</span> '.html_escape($this->common->languageTranslator('ltr_min')).'.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h4 class="edu_sub_title nomarginbtm">'.html_escape($this->common->languageTranslator('ltr_time_over')).'</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    }
                ?>
                <div class="edu_main_wrapper edu_table_wrapper">
    	       <div class="tableFullWrapper">
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="front_ajax/result_table/mock">
                        <thead>
                            <tr>  
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_paper_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_start_time'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_submit_time'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_total_questions'));?></th>
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
                    echo '<div class="sectionHolder mb_30 text-center">
                    <div class="edu_main_wrapper">
                        <h4 class="edu_sub_title nomarginbtm">'.html_escape($this->common->languageTranslator('ltr_no_any_mock')).'</h4>
                    </div>
                </div>';
                } 
            }else{
                echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_any_exam')).'</div>
                            </div>
                        </div>
                    </section>';
            }
            } ?>
		</div>
	</div>
</section>
<!-- Submit popup start-->
<div id="submitPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner text-center">
            <h4 class="edu_title edu_logt_title padderBottom20"><?php echo html_escape($this->common->languageTranslator('ltr_submit_paper'));?></h4>
            <button type="button" class="edu_admin_btn SubmitPaperForm mb-2" id="autosubmit"><?php echo html_escape($this->common->languageTranslator('ltr_yes'));?></button>
            <button type="button" class="edu_admin_btn edu_admin_btn_black edu_btn_black PopupCancelBtn ml-2 mb-2"><?php echo html_escape($this->common->languageTranslator('ltr_no'));?></button>
        </div>
    </div>
</div>
<!-- Submit popup end-->

<!-- Auto Submit popup start-->
<div id="autoSubmitPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner text-center">
            <h4 class="edu_sub_title nomarginbtm"><?php echo html_escape($this->common->languageTranslator('ltr_time_out'));?></h4>
            <button type="button" class="edu_admin_btn SubmitPaperForm hide" ><?php echo html_escape($this->common->languageTranslator('ltr_yes'));?></button>
        </div>
    </div>
</div>
<!-- Auto Submit popup end-->

