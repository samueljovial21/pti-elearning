    		    <div class="row"> 
    		    <?php if(!empty($top_three)){ ?>
    				<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
				        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_top_scorer'));?></h4>
				        <div class="edu_topper_wrapper text-center"> 
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
                                        <p class="edu_student_scroe ddd"><?php $percentage= $top_threes['percentage'];
                                        if(!empty($percentage)){
                                        if(is_numeric($percentage)){
                                            echo number_format($percentage, 2);
                                        }else{
                                            echo number_format($percentage, 2);
                                        }}
                                        ?>%</p>
                                        <span class="edu_student_level"><?php echo $i;?><sup><?php echo $suffix;?></sup></span>
            				        </div>
            				    </div>
            				    <?php } ?>
            				    
            				</div>
            			</div>
				    </div>
				    <?php } ?>
				     <?php if(!empty($top_three)){ ?>
				    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
				        <?php }else{ ?>
				        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				        <?php } ?>
				        <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_student_performance'));?></h4>				       
            			<div class="edu_score_wrapper"> 
    				        <div class="row">
                				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            				        <div class="edu_score_section">
                                        <div  class="edu_progress edu_blue_bar" data-progress="<?php if(!empty($good)){ echo $good; } ?>">
                                    		<svg class="noselect" x="0px" y="0px" viewBox="0 0 80 80">
                                    			<path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                    			<path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                    		</svg>
                                    		
                                    		<div class="edu_score_info">
                                    		    <div class="edu_score_icon">
                                    		        <svg  class="score_por" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 106.059 106.059" >
                                                        <g>
                                                        	<path d="M90.544,90.542c20.687-20.685,20.685-54.342,0.002-75.024C69.857-5.172,36.199-5.172,15.515,15.513
                                                        		C-5.173,36.198-5.171,69.858,15.517,90.547C36.199,111.23,69.857,111.23,90.544,90.542z M21.301,21.3
                                                        		C38.794,3.807,67.261,3.805,84.758,21.302c17.494,17.494,17.492,45.962-0.002,63.455c-17.493,17.494-45.961,17.496-63.455,0.002
                                                        		C3.803,67.263,3.806,38.794,21.301,21.3z"/>
                                                        	<path d="M38.994,44.967c0.134,0.092,0.29,0.138,0.446,0.138c0.159,0,0.318-0.048,0.455-0.145c0.059-0.041,1.456-1.032,2.87-2.467
                                                        		c1.985-2.013,2.991-3.856,2.991-5.484c0-1.024-0.365-2.114-1.002-2.988c-0.728-1-1.683-1.551-2.688-1.551
                                                        		c-1,0-1.942,0.437-2.626,1.173c-0.683-0.736-1.625-1.173-2.625-1.173c-1.008,0-1.963,0.551-2.691,1.551
                                                        		c-0.637,0.874-1.002,1.963-1.002,2.988C33.123,40.898,38.754,44.802,38.994,44.967z"/>
                                                        	<path d="M53.089,78.697c10.084,0,19.084-5.742,22.927-14.629c0.657-1.521-0.042-3.287-1.562-3.944
                                                        		c-1.521-0.659-3.286,0.043-3.944,1.563c-2.893,6.689-9.729,11.011-17.42,11.011c-7.868,0-14.747-4.318-17.523-11.004
                                                        		c-0.479-1.154-1.596-1.85-2.771-1.85c-0.384,0-0.773,0.074-1.149,0.229c-1.531,0.637-2.256,2.393-1.62,3.921
                                                        		C33.734,72.927,42.788,78.697,53.089,78.697z"/>
                                                        	<path d="M67.113,44.967c0.134,0.092,0.29,0.138,0.445,0.138c0.159,0,0.318-0.048,0.455-0.145c0.06-0.041,1.456-1.032,2.87-2.467
                                                        		c1.985-2.013,2.991-3.856,2.991-5.484c0-1.024-0.365-2.114-1.002-2.988c-0.728-1-1.683-1.551-2.688-1.551
                                                        		c-1,0-1.942,0.437-2.627,1.173c-0.683-0.736-1.625-1.173-2.625-1.173c-1.008,0-1.963,0.551-2.69,1.551
                                                        		c-0.637,0.874-1.002,1.963-1.002,2.988C61.241,40.898,66.873,44.802,67.113,44.967z"/>
                                                        </g>
                                                    </svg>
                                    		    </div>
                                    	        <p class="value">0<p>
                                    	        <span><?php echo html_escape($this->common->languageTranslator('ltr_good'));?></span>
                                    	    </div>
                                    	</div>
            				        </div>
            				    </div>
            				    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            				        <div class="edu_score_section">
                                        <div  class="edu_progress edu_yellow_bar" data-progress="<?php if(!empty($avarage)) {echo $avarage; }?>">
                                    		<svg class="noselect" x="0px" y="0px" viewBox="0 0 80 80">
                                    			<path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                    			<path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                    		</svg>
                                    		<div class="edu_score_info">
                                    		    <div class="edu_score_icon">
                                    		        <svg class="score_avg" height="20px" viewBox="0 0 512 512" width="20px" xmlns="http://www.w3.org/2000/svg"><path d="m256 512c-68.38 0-132.667-26.629-181.02-74.98-48.351-48.353-74.98-112.64-74.98-181.02s26.629-132.667 74.98-181.02c48.353-48.351 112.64-74.98 181.02-74.98s132.667 26.629 181.02 74.98c48.351 48.353 74.98 112.64 74.98 181.02s-26.629 132.667-74.98 181.02c-48.353 48.351-112.64 74.98-181.02 74.98zm0-472c-119.103 0-216 96.897-216 216s96.897 216 216 216 216-96.897 216-216-96.897-216-216-216zm93.737 260.188c-9.319-5.931-21.681-3.184-27.61 6.136-.247.387-25.137 38.737-67.127 38.737s-66.88-38.35-67.127-38.737c-5.93-9.319-18.291-12.066-27.61-6.136s-12.066 18.292-6.136 27.61c1.488 2.338 37.172 57.263 100.873 57.263s99.385-54.924 100.873-57.263c5.93-9.319 3.183-21.68-6.136-27.61zm-181.737-135.188c13.807 0 25 11.193 25 25s-11.193 25-25 25-25-11.193-25-25 11.193-25 25-25zm150 25c0 13.807 11.193 25 25 25s25-11.193 25-25-11.193-25-25-25-25 11.193-25 25z"/></svg>
                                    		    </div>
                                    	        <p class="value">0<p>
                                    	        <span><?php echo html_escape($this->common->languageTranslator('ltr_average'));?></span>
                                    	    </div>
                                    	</div>
            				        </div>
            				    </div>
            				    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
            				        <div class="edu_score_section">
                                        <div  class="edu_progress edu_red_bar" data-progress="<?php if(!empty($poor)){ echo $poor; }?>">
                                    		<svg class="noselect" x="0px" y="0px" viewBox="0 0 80 80">
                                    			<path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                    			<path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                    		</svg>
                                    		<div class="edu_score_info">
                                    		    <div class="edu_score_icon">
                                    		        <svg class="score_god_svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 106.059 106.059">
                                                        <g>
                                                        	<path d="M90.544,90.542c20.687-20.685,20.685-54.342,0.002-75.024C69.858-5.172,36.198-5.172,15.515,15.513
                                                        		C-5.173,36.198-5.171,69.858,15.517,90.547C36.198,111.23,69.858,111.23,90.544,90.542z M21.302,21.3
                                                        		C38.795,3.807,67.261,3.805,84.759,21.302c17.494,17.494,17.492,45.962-0.002,63.455c-17.494,17.494-45.961,17.496-63.455,0.002
                                                        		C3.804,67.263,3.806,38.794,21.302,21.3z M58.857,41.671c0-4.798,3.903-8.701,8.703-8.701c4.797,0,8.699,3.902,8.699,8.701
                                                        		c0,1.381-1.119,2.5-2.5,2.5s-2.5-1.119-2.5-2.5c0-2.041-1.66-3.701-3.699-3.701c-2.044,0-3.703,1.66-3.703,3.701
                                                        		c0,1.381-1.119,2.5-2.5,2.5C59.976,44.171,58.857,43.051,58.857,41.671z M31.134,41.644c0-4.797,3.904-8.701,8.703-8.701
                                                        		c4.797,0,8.701,3.903,8.701,8.701c0,1.381-1.119,2.5-2.5,2.5c-1.381,0-2.5-1.119-2.5-2.5c0-2.041-1.66-3.701-3.701-3.701
                                                        		c-2.042,0-3.703,1.66-3.703,3.701c0,1.381-1.119,2.5-2.5,2.5S31.134,43.024,31.134,41.644z M54.089,59.371
                                                        		c10.084,0,19.084,5.742,22.927,14.63c0.658,1.521-0.041,3.286-1.562,3.943c-1.521,0.66-3.285-0.042-3.943-1.562
                                                        		c-2.894-6.689-9.73-11.012-17.421-11.012c-7.869,0-14.747,4.319-17.522,11.004c-0.48,1.154-1.596,1.851-2.771,1.851
                                                        		c-0.385,0-0.773-0.074-1.15-0.23c-1.53-0.636-2.256-2.392-1.619-3.921C34.735,65.143,43.788,59.371,54.089,59.371z M25.204,56.801
                                                        		c0.001-3.436,4.556-7.535,4.556-7.535c0.438,2.747,1.52,4.344,1.52,4.344c1.218,1.818,1.218,3.507,1.218,3.507
                                                        		c0,3.712-3.692,3.68-3.692,3.68C25.204,60.795,25.204,56.801,25.204,56.801z"/>
                                                        </g>
                                                    </svg>
                                    		    </div>
                                    	        <p class="value">0<p>
                                    	        <span><?php echo html_escape($this->common->languageTranslator('ltr_poor'));?></span>
                                    	    </div>
                                    	</div>
            				        </div>
            				    </div>
            				</div>
            			</div>
				    </div>
				</div>
			</div>
