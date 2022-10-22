
<section class="edu_admin_content">
    <div class="edu_admin_right sectionHolder edu_add_users">
        <div class="edu_admin_informationdiv edu_main_wrapper edu_add_student_wrapper">
            <form class="form" id="add_student_form" method="post" enctype="multipart/form-data" autocomplete="off" >
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="edu_title_wrapper">
                            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_PERSONAL_INFORMATION'));?></h4>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group edu_file_upload">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?></label>
                            <input type="file" id="file" name="stu_pic" value="<?php echo !empty($student_data)?base_url('uploads/students').$student_data[0]['image']:'';?>">
                            <p class="fileNameShow"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_name'));?><sup>*</sup></label>
                            <input type="text" class="form-control require alphaField" name="name" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_name'));?>" value="<?php echo !empty($student_data)?$student_data[0]['name']:'';?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_father_name'));?></label>
                           <input type="text" class="form-control alphaField" name="father_name" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_father_name'));?>" value="<?php echo !empty($student_data)?$student_data[0]['father_name']:'';?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_father_occupation'));?></label>
                            <input type="text" class="form-control" name="father_designtn" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_father_occupation'));?>" value="<?php echo !empty($student_data)?$student_data[0]['father_designtn']:'';?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_gender'));?><sup>*</sup></label>
                            <select class="form-control require edu_selectbox_with_search" name="gender" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_gender'));?>">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_gender'));?> </option>
                                <option value="male" <?php echo (!empty($student_data) && $student_data[0]['gender']=='male')?'selected':'';?>><?php echo html_escape($this->common->languageTranslator('ltr_male'));?></option>
                                <option value="female" <?php echo (!empty($student_data) && $student_data[0]['gender']=='female')?'selected':'';?>><?php echo html_escape($this->common->languageTranslator('ltr_female'));?></option>
                                <option value="other" <?php echo (!empty($student_data) && $student_data[0]['gender']=='other')?'selected':'';?>><?php echo html_escape($this->common->languageTranslator('ltr_other'));?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_date_birth'));?><sup>*</sup></label>
                            <span class="select-date">
                                <input type="text" class="form-control chooseDate dobpicker require" name="dob" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_dob'));?>" value="<?php echo !empty($student_data)?date('d-m-Y',strtotime($student_data[0]['dob'])):'';?>">
                            </span> 
                        </div>
                    </div>
                    <div class="offset-lg-6 offset-md-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <span>
                            <?php
                                if(!empty($student_data)){
                                    $date1 = new DateTime($student_data[0]['dob']);
                                    $date2 = new DateTime(date('Y-m-d'));
                                    $diff = $date1->diff($date2);
                                    $y = $diff->y.' Years';
                                    $m = $diff->m.' Months';
                                    $d = $diff->d.' Days';
                                }else{
                                    $y = '';
                                    $m = '';
                                    $d = '';
                                }
                                
                            ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_year'));?>" id="age_year" value="<?php echo  $y;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_month'));?>" id="age_month" value="<?php echo  $m;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_day'));?>"  id="age_day" value="<?php echo  $d;?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </span> 
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="edu_title_wrapper">
                            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_CONTACT_INFORMATION'));?></h4>
                        </div>
                    </div>
                     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_contact_number'));?><sup>*</sup></label>
                             <input type="text" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_contact_number'));?>"  name="contact_no" maxlength="12" value="<?php echo !empty($student_data)?$student_data[0]['contact_no']:'';?>" data-valid="mobile" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_contact_msg'));?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_email'));?><sup>*</sup></label>
                             <input type="text" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_email'));?>" name="email" value="<?php echo !empty($student_data)?$student_data[0]['email']:'';?>" data-valid="email" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_email_msg'));?>" <?php echo !empty($student_data)?'readonly':'';?>>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_address'));?></label>
                            <textarea name="address" rows="3" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_address'));?>" class="form-control"><?php echo !empty($student_data)?$student_data[0]['address']:'';?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12" >
                        <div class="edu_title_wrapper">
                            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_BATCH_INFORMATION'));?></h4>
                            <input type="radio" name="payMode"value="offline" class="payMode">Offline
                            <input type="radio" name="payMode"value="Online" class="payMode" checked>Online
                        </div>
                    </div>                              
                         <div class="col-lg-6 col-md-6 col-sm-12 col-12 multibatchAdd">
                        <div class="form-group"> 
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?><sup>*</sup></label>
                            <select class="form-control require edu_selectbox_with_search multibatchr" name="multi_batch_id[]" multiple data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>">
                                <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?></option>
                                <?php
                            
                            if(!empty($batch_name_online)){
                                
                                 
                                // print_r($student_batch_dtail);
                                  foreach($batch_name_online as $batch){
                                     $student_batch_dtail = $this->db_model->select_data('batch_id','sudent_batchs',array('student_id'=>$student_id,'batch_id'=>$batch['id']));
                                 
                                    if(!empty($student_batch_dtail))
                                      {
                                      $selected = 'selected';
                                      }
                                    else
                                      {
                                      $selected = "";
                                      }
                              
                                    echo '<option value="'.$batch['id'].'" '.$selected.'>'.$batch['batch_name'].'</option>';
                              
                                
                            }
                        }
                          
                            ?>
                            </select>
                        </div>
                    </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 edit_batch_hide_fileds" >
                            <div class="form-group" > 
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_batch'));?><sup>*</sup></label>
                                <select class="form-control edu_selectbox_with_search get_batch_price" name="batch_id[]" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?>">
                                    <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch'));?></option>
                                    <?php
                                
                                    if(!empty($batch_name_offline)){
                                        
                                         
                                        // print_r($batch_name);
                                          foreach($batch_name_offline as $batch){
                                            //  $student_batch_dtail = $this->db_model->select_data('batch_id','sudent_batchs',array('student_id'=>$student_id,'batch_id'=>$batch['id']));
                                         
                                            // if(!empty($student_batch_dtail))
                                            //   {
                                            //   $selected = 'selected';
                                            //   }
                                            // else
                                            //   {
                                            //   $selected = "";
                                            //   }
                                      
                                            echo '<option value="'.$batch['id'].'" '.$selected.'>'.$batch['batch_name'].'</option>';
                                        }
                                    }
                                  
                                    ?>
                                </select>
                            </div>
                            <!--<div class='hide subjectArrayDiv'><?php echo json_encode($batch_name);?></div>-->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 batchPrice">
                            <div class="form-group bt">                                  
                                <label><?php echo html_escape($this->common->languageTranslator('ltr_price'));?><sup>*</sup></label>
                                 <input type="text" class="form-control batch_price" maxlength="5" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_price'));?>" name="price" value="">
                            </div>
                        </div>
                    <div class="batch_new_fields_add col-lg-12 col-md-12 col-sm-12 col-12">                   
                    </div>
                </div>
                <?php if(!empty($student_id)){
                    echo '<input type="hidden" value="'.$student_id.'" name="student_id">';
                    $type = 'edit';
                }else{
                    $type = 'add';
                }
                $ltr_add_student = html_escape($this->common->languageTranslator('ltr_add_student'));
                $ltr_update_student = html_escape($this->common->languageTranslator('ltr_update_student'));
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <input type="button" value="<?php echo !empty($student_data)? $ltr_update_student : $ltr_add_student ;?>" class="edu_admin_btn addNewStudent" data-type="<?php echo html_escape($type);?>" />
                </div>
               
        </div>
    </div>
</section>