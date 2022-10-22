
	    <?php
	    if(!empty($paper_list)){
	        $paper=$paper_list[0];
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
                                                        <p><span class="edu_paper_smallinfo"><?php echo html_escape($this->common->languageTranslator('ltr_total_time'));?>:</span><span class="totalTime"><?php echo html_escape($paper['time_duration']);?></span> Min.</p>
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
                                                    <a href="<?php echo base_url()?>student/mock-paper" class="edu_admin_btn continuePaper"><?php echo html_escape($this->common->languageTranslator('ltr_open_exam'));?></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php 
                            }
                        }
	    }
                        ?>
	    
		<div class="edu_dashboard_widgets">
    		<div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <a href="<?php echo base_url()?>student/extra-classes">
                    <div class="edu_color_boxes box_left">
                        <div class="edu_dash_box_data">
                            <p><?php echo html_escape($this->common->languageTranslator('ltr_today_extra_class'));?></p>
                            <h3><?php echo html_escape($total_extra_class);?></h3>
                        </div>
                        <div class="edu_dash_box_icon">
                            <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m459.943 100.795c9.954-10.714 16.057-25.052 16.057-40.795 0-33.084-26.916-60-60-60s-60 26.916-60 60c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.124-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795 0-33.084-26.916-60-60-60s-60 26.916-60 60c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.123-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795 0-33.084-26.916-60-60-60s-60 26.916-60 60c0 15.743 6.103 30.081 16.057 40.795-30.32 15.887-51.057 47.668-51.057 84.205v100c0 8.284 6.716 15 15 15h20c0 15.743 6.103 30.081 16.057 40.795-30.32 15.887-51.057 47.668-51.057 84.205v72c0 8.284 6.716 15 15 15h480c8.284 0 15-6.716 15-15v-72c0-36.537-20.737-68.318-51.057-84.205 9.954-10.714 16.057-25.052 16.057-40.795h20c8.284 0 15-6.716 15-15v-100c0-36.537-20.737-68.318-51.057-84.205zm-73.943-40.795c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm30 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-190-60c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm30 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-190-60c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm30 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-30 180c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm90 0h40c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.123-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795zm70 0c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm90 0h40c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.124-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795zm-60 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-160 0c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm385 122h-450v-32h450zm-.19-62h-129.62c2.562-33.514 30.65-60 64.81-60s62.248 26.486 64.81 60zm-94.81-120c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm95-30h-13.072c-10.391-17.916-29.769-30-51.928-30s-41.537 12.084-51.928 30h-56.144c-10.391-17.916-29.769-30-51.928-30s-41.537 12.084-51.928 30h-56.144c-10.391-17.916-29.769-30-51.928-30s-41.537 12.084-51.928 30h-13.072v-60h450z"/></g></svg>
                        </div>
                        <div class="edu_dash_info">
    					    <ul>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_previous'));?> <span><?php echo html_escape($total_previous_class);?></span></p></li>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_upcoming'));?>  <span><?php echo html_escape($total_upcoming_class);?></span></p></li>
					        <ul>
					    </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <a href="<?php echo base_url()?>student/mock-paper">
                    <div class="edu_color_boxes box_center">
                        <div class="edu_dash_box_data">
                            <p><?php echo html_escape($this->common->languageTranslator('ltr_mock_test_s'));?></p>
                            <h3><?php echo html_escape($total_mock_test);?></h3>
                        </div>
                        <div class="edu_dash_box_icon">
                            <svg viewBox="0 -20 462.18955 462" xmlns="http://www.w3.org/2000/svg"><path d="m370.402344 243.332031-44.523438-96.191406c-.523437-38.78125-18.136718-75.546875-49.71875-103.703125-31.296875-27.695312-71.578125-43.097656-113.367187-43.34375-68.433594 0-133.289063 41.800781-154.398438 99.457031-15.28125 31.96875-6.390625 93.890625.757813 143.691407 1.832031 12.75 3.5625 24.796874 4.714844 35.15625l.753906 133.730468c.035156 4.335938 3.566406 7.828125 7.898437 7.816406l200.035157 2.429688h.101562c2.152344.050781 4.242188-.722656 5.835938-2.167969 1.578124-1.425781 2.515624-3.425781 2.601562-5.550781v-54.253906l48.757812 1.507812c11.710938.34375 23.066407-4.046875 31.503907-12.171875 8.4375-8.128906 13.242187-19.3125 13.335937-31.027343l.605469-63.125 38.050781-.890626c2.691406-.066406 5.171875-1.484374 6.59375-3.773437 1.425782-2.289063 1.597656-5.140625.460938-7.585937zm-53.242188-3.558593c-4.3125.101562-7.765625 3.605468-7.808594 7.917968l-.714843 70.855469c-.074219 7.4375-3.136719 14.53125-8.503907 19.679687-5.363281 5.148438-12.574218 7.921876-20.007812 7.695313l-114-3.507813c-4.410156-.125-8.097656 3.339844-8.242188 7.75-.03125 4.460938 3.511719 8.125 7.96875 8.242188l49.242188 1.503906v46.640625l-184.300781-2.363281-.820313-126.300781c-.019531-.277344-.050781-.554688-.101562-.832031-1.179688-10.710938-2.976563-23.039063-4.851563-36.09375-6.875-47.824219-15.433593-107.355469-2.046875-134.785157.121094-.257812.230469-.519531.324219-.785156 9.007813-24.863281 28.015625-47.558594 53.535156-63.898437 25.683594-16.410157 55.484375-25.214844 85.960938-25.398438 37.867187.226562 74.363281 14.183594 102.71875 39.28125 28.621093 25.515625 44.378906 58.734375 44.378906 93.546875 0 1.160156.253906 2.308594.742187 3.363281l40.125 86.691406zm0 0"/><path d="m371.308594 273.554688c-3.132813 3.117187-3.144532 8.183593-.023438 11.3125 19.710938 19.875 19.710938 51.921874 0 71.796874-2.039062 2.019532-2.835937 4.976563-2.09375 7.746094.742188 2.773438 2.914063 4.933594 5.6875 5.667969 2.773438.730469 5.726563-.078125 7.742188-2.125 25.914062-26.121094 25.914062-68.253906 0-94.375-3.117188-3.128906-8.183594-3.140625-11.3125-.023437zm0 0"/><path d="m420.136719 246.476562c-3.125 3.121094-3.125 8.1875 0 11.3125 34.78125 34.78125 34.761719 91.847657-.046875 127.199219-2.058594 2.027344-2.863282 5.003907-2.109375 7.792969.753906 2.785156 2.953125 4.949219 5.753906 5.660156 2.796875.710938 5.761719-.140625 7.757813-2.230468 40.949218-41.597657 40.925781-108.765626-.046876-149.738282-3.125-3.125-8.1875-3.121094-11.308593.003906zm0 0"/></svg>
                        </div>
                        <div class="edu_dash_info">
					        <ul>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_previous'));?> <span><?php echo html_escape($previous_mock_test);?></span></p></li>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_upcoming'));?><span> <?php echo html_escape($upcoming_mock_test);?></span></p></li>
					        <ul>
					    </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <a href="<?php echo base_url()?>student/vacancy">
                    <div class="edu_color_boxes box_right">
                        <div class="edu_dash_box_data">
                            <p><?php echo html_escape($this->common->languageTranslator('ltr_upcoming_exams'));?></p>
                            <h3><?php echo html_escape($total_vacancy);?></h3>
                        </div>
                        <div class="edu_dash_box_icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                	 viewBox="0 0 512 512" xml:space="preserve">
                                <g>
                                	<g>
                                		<path d="M363.383,0H13.517C8.798,0,4.983,3.823,4.983,8.533v494.933c0,4.71,3.814,8.533,8.533,8.533h349.867
                                			c4.719,0,8.533-3.823,8.533-8.533V8.533C371.917,3.823,368.102,0,363.383,0z M354.85,494.933H22.05V17.067h332.8V494.933z"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<path d="M150.05,332.8H81.783c-4.719,0-8.533,3.823-8.533,8.533V409.6c0,4.71,3.814,8.533,8.533,8.533h68.267
                                			c4.719,0,8.533-3.823,8.533-8.533v-68.267C158.583,336.623,154.769,332.8,150.05,332.8z M141.517,401.067h-51.2v-51.2h51.2
                                			V401.067z"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<path d="M161.562,104.448l-54.178,46.447L87.33,133.709l-11.093,12.962l25.6,21.939c1.587,1.374,3.575,2.057,5.547,2.057
                                			c1.971,0,3.959-0.683,5.547-2.057l59.733-51.2L161.562,104.448z"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<polygon points="156.083,227.9 144.017,215.834 115.917,243.934 87.817,215.834 75.75,227.9 103.851,256 75.75,284.1 
                                			87.817,296.166 115.917,268.066 144.017,296.166 156.083,284.1 127.983,256 		"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<rect x="201.25" y="128" width="102.4" height="17.067"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<rect x="201.25" y="247.467" width="102.4" height="17.067"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<rect x="201.25" y="366.933" width="102.4" height="17.067"/>
                                	</g>
                                </g>
                                <g>
                                	<g>
                                		<path d="M491.383,219.281v-57.148c0-4.71-3.814-8.533-8.533-8.533h-25.6v-34.133c0-14.114-11.486-25.6-25.6-25.6h-17.067
                                			c-14.114,0-25.6,11.486-25.6,25.6v256c0,1.545,0.418,3.063,1.22,4.395l25.6,42.667c1.536,2.569,4.309,4.139,7.313,4.139
                                			c3.004,0,5.777-1.57,7.313-4.139l25.6-42.667c0.802-1.331,1.22-2.85,1.22-4.395v-204.8h17.067v51.2
                                			c0,1.681,0.503,3.337,1.434,4.736l17.067,25.6l14.199-9.464L491.383,219.281z M423.117,401.545l-15.65-26.078h31.3
                                			L423.117,401.545z M440.183,358.4H406.05v-68.267h34.133V358.4z M440.183,273.067H406.05v-102.4h34.133V273.067z M440.183,153.6
                                			H406.05v-34.133c0-4.702,3.823-8.533,8.533-8.533h17.067c4.71,0,8.533,3.831,8.533,8.533V153.6z"/>
                                	</g>
                                </g>
                                </svg>
                        </div>
                        <div class="edu_dash_info">
					        <ul>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_online'));?> <span><?php echo html_escape($online_vacancy);?></span></p></li>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_offline'));?> <span><?php echo html_escape($offline_vacancy);?></span></p></li>
					        <ul>
					    </div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <a href="<?php echo base_url()?>student/homework">
                    <div class="edu_color_boxes box_other">
                        <div class="edu_dash_box_data">
                            <p><?php echo html_escape($this->common->languageTranslator('ltr_homework'));?></p>
                            <h3><?php echo html_escape($total_homework);?></h3>
                        </div>
                        <div class="edu_dash_box_icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                        	<g>
                        		<g>
                        			<path d="M509.071,86.613l-39.176-39.176c-3.904-3.905-10.236-3.903-14.142,0l-26.085,26.085c-1.318-3.99-5.08-6.875-9.508-6.875
                        				H279.817c-19.155,0-36.105,9.62-46.273,24.283c-10.168-14.663-27.118-24.283-46.273-24.283H46.917
                        				c-5.523,0-10.012,4.489-10.012,10.012v16.697H10c-5.523,0-10,4.478-10,10v354.135c0,5.522,4.477,10,10,10h447.076
                        				c5.523,0,10-4.478,10-10V142.752l41.996-41.996C512.977,96.85,512.976,90.518,509.071,86.613z M223.538,447.491H20V113.356h16.905
                        				v292.909c0,5.522,4.477,10,10,10h176.633V447.491z M223.538,396.265H56.905v-28.357h130.366c13.677,0,26.413,4.944,36.267,14
                        				V396.265z M187.271,347.907H56.905V86.647h130.366c20.002,0,36.273,16.272,36.273,36.273v167.481c0,5.522,4.477,10,10,10
                        				s10-4.478,10-10v-167.48c0-20.001,16.272-36.273,36.273-36.273H410.17v6.371L297.345,205.844c-1.367,1.367-2.309,3.102-2.71,4.993
                        				l-10.568,49.744c-0.704,3.312,0.316,6.755,2.71,9.149c1.895,1.895,5.723,3.269,9.149,2.71l49.744-10.567
                        				c1.891-0.401,3.625-1.343,4.993-2.71l59.507-59.507v148.251H279.817c-16.901,0-33.297,5.837-46.273,16.26
                        				C220.567,353.743,204.172,347.907,187.271,347.907z M313.586,220.054c4.063,4.063,9.122,6.848,14.753,8.198
                        				c1.239,5.485,4.009,10.563,8.115,14.67c0.129,0.128,0.258,0.256,0.389,0.382l-30.014,6.376l6.376-30.014
                        				C313.331,219.796,313.457,219.926,313.586,220.054z M410.171,367.908v28.357H243.538v-14.346
                        				c9.856-9.063,22.597-14.011,36.28-14.011H410.171z M447.076,447.491H243.538v-31.226h176.633c5.523,0,10-4.478,10-10V179.997
                        				c0-0.112-0.003-0.223-0.006-0.334l16.911-16.911V447.491z M351.76,229.783c-0.409-0.303-0.797-0.638-1.163-1.003
                        				c-2.228-2.229-3.293-5.306-2.92-8.443c0.347-2.923-0.611-5.85-2.619-8.002c-1.896-2.032-4.546-3.178-7.311-3.178
                        				c-0.163,0-0.326,0.004-0.49,0.012c-2.729,0.143-6.595-0.323-9.529-3.258c-0.365-0.365-0.7-0.754-1.002-1.162L431.883,99.592
                        				l25.034,25.034L351.76,229.783z M471.059,110.483l-25.034-25.034l16.799-16.799l25.034,25.034L471.059,110.483z"></path>
                        		</g>
                        	</g>
                        	<g>
                        		<g>
                        			<path d="M243.35,327.121c-0.13-0.641-0.32-1.271-0.57-1.88c-0.25-0.601-0.56-1.181-0.92-1.721c-0.37-0.55-0.78-1.06-1.24-1.52
                        				c-0.47-0.46-0.98-0.88-1.52-1.25c-0.55-0.36-1.13-0.66-1.73-0.91c-0.6-0.25-1.23-0.45-1.87-0.57c-1.29-0.26-2.62-0.26-3.91,0
                        				c-0.64,0.12-1.27,0.32-1.87,0.57c-0.6,0.25-1.18,0.55-1.73,0.91c-0.54,0.37-1.06,0.79-1.52,1.25c-0.46,0.46-0.88,0.97-1.24,1.52
                        				c-0.361,0.54-0.67,1.12-0.92,1.721c-0.25,0.609-0.44,1.239-0.57,1.88c-0.13,0.64-0.2,1.3-0.2,1.949c0,0.65,0.07,1.31,0.2,1.95
                        				c0.129,0.641,0.32,1.27,0.57,1.87c0.25,0.61,0.56,1.19,0.92,1.73c0.36,0.55,0.78,1.06,1.24,1.52c0.46,0.46,0.98,0.88,1.52,1.24
                        				c0.55,0.36,1.13,0.67,1.73,0.92c0.6,0.25,1.23,0.44,1.87,0.57c0.65,0.13,1.3,0.199,1.95,0.199c0.66,0,1.31-0.069,1.96-0.199
                        				c0.64-0.13,1.27-0.32,1.87-0.57c0.6-0.25,1.18-0.56,1.73-0.92c0.54-0.36,1.05-0.78,1.52-1.24c1.86-1.86,2.93-4.439,2.93-7.07
                        				C243.55,328.421,243.48,327.761,243.35,327.121z"></path>
                        		</g>
                        	</g>
                        </svg>
                        </div>
                        <div class="edu_dash_info">
					        <ul>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_previous'));?> <span><?php echo html_escape($previous_homework);?></span></p></li>
					            <li><p><?php echo html_escape($this->common->languageTranslator('ltr_today'));?>  <span><?php echo html_escape($today_homework);?></span></p></li>
					        <ul>
					    </div>
                    </div>
                    </a>
                </div>
    		</div>
        </div>
        <div class="sectionHolder score_info_wrap">
    		<div class="edu_admin_informationdiv">
    		    <div class="row"> 
    		       <?php
    		       if(!empty($mock_result[0]['percentage'])){
    		       ?>
    				<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
				        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_my_score'));?> </h4>
				        <div class="edu_topper_wrapper text-center student-pannel-toppers"> 
    				        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">  
    				        <div class="row">
                				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            				        <div class="edu_topper_section">
                                       
                                        <img src="<?php echo base_url();?>uploads/students/<?php echo $this->session->userdata['profile_img']; ?>" alt="" />
                                        
                                        <h4 class="edu_student_name"><?php echo $this->session->userdata['name'];?></h4>
                                        <p class="edu_student_standard">
                                            <?php if(!empty($mock_result)){ $coun =(count($mock_result)-1); echo $mock_result[$coun]['paper_name'];}?>
                                        </p>
                                        <p class="edu_student_scroe">
                                           <?php if(!empty($mock_result)){$coun =(count($mock_result)-1); echo number_format((float)$mock_result[$coun]['percentage'], 2, '.', '') ; } ?> %</p>
                                        <a href="<?php if(!empty($mock_result)){ $coun =(count($mock_result)-1); echo base_url('student/answer-sheet/mock/'.$mock_result[$coun]['id']); } ?>/<?php if(!empty($mock_result[$coun]['paper_id'])){ echo $mock_result[$coun]['paper_id']; } ?>" target="_blank" class="edu_student_level"><?php echo html_escape($this->common->languageTranslator('ltr_view'));?></a>
            				        </div>
            				    </div>
            				  
            				    </div>
            				</div>
            			</div>
				    </div>
				  
    		    <?php if(!empty($top_three)){ ?>
    				<div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
				        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_top_scorer'));?></h4>
				        <div class="edu_topper_wrapper text-center student-pannel-toppers"> 
    				        <div class="col-xl-12 col-lg-10 col-md-12 col-sm-12 col-12 p-0">  
    				        <div class="row">
    				        <?php 
    				        $i=0;
    				        foreach($top_three as $top_threes){
    				        $i++;
                            switch ($i) {
                              case "1":
                                $suffix= "st";
                                break;
                              case "2":
                                $suffix= "nd";
                                break;
                              case "3":
                               $suffix= "rd";
                                break;
                            }
    				        ?>
                				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            				        <div class="edu_topper_section">
                                       
                                        <img src="<?php echo base_url();?>uploads/students/<?php echo $top_threes['image'];?>" alt="" />
                                        
                                        <h4 class="edu_student_name"><?php echo $top_threes['name'];?></h4>
                                        <p class="edu_student_standard"><?php echo $top_threes['paper_name'];?></p>
                                        <p class="edu_student_scroe"><?php echo $top_threes['percentage'];?>%</p>
                                        <span class="edu_student_level"><?php echo $i;?><sup><?php echo $suffix;?></sup></span>
            				        </div>
            				    </div>
            				    <?php } ?>
            				    </div>
            				</div>
            			</div>
				    </div>
				    <?php } ?>
				     
				    
				</div>
			</div>
		</div>
        <div class="row">
		    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
		        
        		<div class="edu_main_wrapper edu_table_wrapper mb_30">
        			<div class="edu_admin_informationdiv sectionHolder">
        				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        					<div class="row">
        						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sdsds">
        							<canvas id="mock_paper" width="800" height="400"></canvas>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
		    </div>
		     <?php } ?>
		</div>
 

<?php 

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
	var mock_config = {
        type: 'line',
        data: {
			labels: [<?php if(!empty($mock_label)){ echo $mock_label; }?>],
			datasets: [{ 
				data: [<?php if(!empty($mock_per)){ echo $mock_per; }?>],
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