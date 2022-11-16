<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder">
		<div class="edu_admin_informationdiv sectionHolder">
            <?php 
                if(!empty($result_details)){
                    $results = $result_details[0];
                    //print_r($results);
                }
            ?>
            <!------- Answer Sheet Start -------->
            <div class="edu_main_wrapper answer_sheet_wrapper">
                <div class="answer_sheet_inner">
                    <?php if(!empty($results)){ ?>
                    <div class="answer_sheet_header">
                        <div class="row">
                            <?php if($this->session->userdata('role') != 'student'){ ?>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-12 padderBottom30">
                                    <div class="edu_paper_info responsive_center text-left">
                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_student_name'));?> : </span><?php echo (isset($results['name']))?$results['name']:'';?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-12 padderBottom30">
                                    <div class="edu_paper_info responsive_center text-center">
                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_paper'));?> : </span><?php echo (isset($results['paper_name']))?$results['paper_name']:'';?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-12 padderBottom30">
                                    <div class="edu_paper_info responsive_center text-right">
                                        <ul class="edu_count_timer">
                                            <li><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_time'));?>:</span><span id="timer"><?php echo (isset($results['time_duration']))?$results['time_duration'].' Min':'';?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 padderBottom30">
                                    <div class="edu_paper_info responsive_center">
                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_paper'));?> : </span><?php echo (isset($results['paper_name']))?$results['paper_name']:$results['name'];?></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12 padderBottom30">
                                    <div class="edu_paper_info responsive_center text-right">
                                        <ul class="edu_count_timer">
                                            <li><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_time'));?>:</span><span id="timer"><?php echo (isset($results['time_duration']))?$results['time_duration'].' Min':'';?></span></li>
                                        </ul>
                                    </div>
                                </div>
                           <?php } ?>
                        </div>
                    </div>
                    <div class="answer_sheet_body">
                        <div class="edu_answer_sheet_section">
                            <ol>
                                <?php 
                                    $allQuestionArr = json_decode($results['question_ids'],true);
                                    $allQuestions = implode(',',$allQuestionArr);
                                    $questionLists = $this->db_model->select_data('id,question,answer,options', 'questions use index (id)','id in ('.$allQuestions.')');

                                    $attemptedQuestion = (isset($results['question_answer']))?json_decode($results['question_answer'],true):'' ;
                                    
                                    if(!empty($questionLists)){
                                        $j = 1;
                                        foreach($questionLists as $quest){
                                            $ansCheck = array($quest['id']=>$quest['answer']);
                                            $optionArr = json_decode($quest['options'],true);
                                            $i = 'A';
                                            $option = '';
                                            foreach($optionArr as $op){
                                                $option .= '<li>'.$i.'. '.$op.'</li>';
                                                $i++;
                                            }
                                            echo ' <li>
                                                <div class="edu_single_answer_wrap">
                                                    <div class="edu_single_questionAns">
                                                        <p><span>'.$j.'. </span> '.$quest['question'].'</p>
                                                        <ul class="question_options">'.$option.'</ul>
                                                    </div>
                                                    <div class="edu_answer_wrapper">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 padderBottom10">
                                                                <div class="edu_answer edu_right_answer">
                                                                    <p><i class="icofont-checked"></i>'.$quest['answer'].'</p>
                                                                </div>
                                                            </div>';
                                        if(empty($attemptedQuestion)){
                                                 echo '<div class="col-lg-6 col-md-6 col-sm-12 col-12 padderBottom10">
                                                                    <div class="edu_answer edu_wrong_answer">
                                                                        <p>'.html_escape($this->common->languageTranslator('ltr_not_attempted')).'</p>
                                                                    </div>
                                                                </div>';   
                                        }else
                                        {
                                        if(!array_key_exists($quest['id'],$attemptedQuestion) ){
                                                                echo '<div class="col-lg-6 col-md-6 col-sm-12 col-12 padderBottom10">
                                                                    <div class="edu_answer edu_wrong_answer">
                                                                        <p>'.html_escape($this->common->languageTranslator('ltr_not_attempted')).'</p>
                                                                    </div>
                                                                </div>';
                                                            }else{
                                                                if($attemptedQuestion[$quest['id']] != $quest['answer']){
                                                                echo '<div class="col-lg-6 col-md-6 col-sm-12 col-12 padderBottom10">
                                                                    <div class="edu_answer edu_wrong_answer">
                                                                        <p><i class="icofont-close-squared-alt"></i>'.$attemptedQuestion[$quest['id']].'</p>
                                                                    </div>
                                                                </div>';
                                                                }  
                                                            }
                                                    echo '</div>
                                                    </div>
                                                </div>
                                            </li>';
                                            $i++;
                                        }
                                        $j++;
                                        }
                                    }
                                ?>
                            </ol>
                        </div>
                    </div>
                    <?php }else{
                           echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_live_his_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
                    } ?>
                </div>
            </div>
            <!------- Answer Sheet End -------->
		</div>
	</div>
</section>