<section class="edu_admin_content">
    <div class="edu_admin_right sectionHolder edu_home_setting_wrapper">
        <div class="edu_admin_informationdiv edu_main_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
                        <div class="edu_courses_section">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#sliderSet" role="tab" data-toggle="tab" aria-selected="false">
                                        <span class="edu_tab_icons">
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_slider'));?></p>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#counterSet" role="tab" data-toggle="tab" aria-selected="true">
                                        <span class="edu_tab_icons">
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_counter'));?></p>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#selectionSet" role="tab" data-toggle="tab" aria-selected="true">
                                        <span class="edu_tab_icons">
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_selection'));?></p>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#testimonialSet" role="tab" data-toggle="tab" aria-selected="true">
                                        <span class="edu_tab_icons">
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_testimonial'));?></p>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#teacherSet" role="tab" data-toggle="tab" aria-selected="true">
                                        <span class="edu_tab_icons">
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_teacher'));?></p>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#clientBtnSet" role="tab" data-toggle="tab" aria-selected="true">
                                        <span class="edu_tab_icons">
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_header_button'));?></p>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
                        <div class="edu_courses_section">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in show" id="sliderSet">
                                    <div class="edu_courses_content">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
                                            <div class="edu_courses_detail parentFormWrappr">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_banner_slides'));?></h4>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right responsive_center">
                                                            <button type="button" class="btn btn-primary addNewRow slideBannerDiv"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_more'));?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form class="pxn_amin" method="post">
                                                    <div class="edu_home_wrapper edu_from_wrapper">
                                                    <?php 
                                                        if(!empty($home_Details[0]['slider_details'])){
                                                            $sliders = json_decode($home_Details[0]['slider_details'],true);
                                                        }else{
                                                            $sliders = '';
                                                        }
    
                                                        if(!empty($sliders)){
                                                            for($i=0;$i<count($sliders['slider_heading']);$i++){
                                                        ?>
                                                        <div class="edu_home_slide_section parentRow">
                                                            <div class="row">
                                                                <div class="edu_detele_row_wrapper edu_slide_del">   
                                                                    <div class="removeRow">
                                                                        <i class="icofont-ui-delete removeRow" title="Remove"></i>
                                                                   </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
                                                                        <input type="text" class="form-control require" name="slider_heading[]" value="<?php echo html_escape($sliders['slider_heading'][$i]);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
                                                                        <input type="text" class="form-control" name="slider_subheading[]" value="<?php echo html_escape($sliders['slider_subheading'][$i]);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?> <?php echo (!empty($sliders['slider_img']) && !empty($sliders['slider_img'][$i]))?'':'<sup>*</sup>';?></label>
                                                                        <div class="edu_d_flex">
                                                                            <?php
                                                                            if(!empty($sliders['slider_img']) && !empty($sliders['slider_img'][$i])){
                                                                            ?>
                                                                            <div class="edu_prev_img">
                                                                                <div>
                                                                                    <img src="<?php echo base_url('uploads/site_data/'.$sliders['slider_img'][$i])?>">
                                                                                </div>
                                                                            </div>
                                                                            <?php } ?>
                                                                            <input type="hidden" value="<?php echo base64_encode(json_encode($sliders['slider_img']));?>" name="prev_slides" data-symb="no">
                                                                            <input type="file" data-valid="image" data-error="Please seelct a png or jpg image." class="form-control <?php echo (!empty($sliders['slider_img']) && !empty($sliders['slider_img'][$i]))?'':'require';?>" name="slider_img[]" value="" >
                                                                            <p class="fileNameShow"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
                                                                        <?php
                                                                            $breaks = array("<br />","<br>","<br/>");   
                                                                        ?>
                                                                        <textarea rows="3" class="form-control" name="slider_desc[]" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo str_replace($breaks, "\n", $sliders['slider_desc'][$i]);?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php }
                                                        }else{ ?>
                                                        <div class="edu_home_slide_section parentRow">
                                                            <div class="row">
                                                                <div class="edu_detele_row_wrapper edu_slide_del">
                                                                    <div class="removeRow">
                                                                        <i class="icofont-ui-delete removeRow" title="Remove"></i>
                                                                   </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
                                                                        <input type="text" class="form-control require" name="slider_heading[]" value="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
                                                                        <input type="text" class="form-control" name="slider_subheading[]" value="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
                                                                        <textarea rows="3" class="form-control" name="slider_desc[]" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?><sup>*</sup></label>
                                                                        <input type="file" data-valid="image" data-error="Please seelct a png or jpg image." class="form-control" name="slider_img[]" value="" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php }?>
                                                        <div class="edu_btn_wrapper">
                                                            <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/slider_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="counterSet">
                                    <div class="edu_courses_content">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
                                            <div class="edu_courses_detail">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_manage_counter'));?></h4>
                                                    </div>
                                                </div>
                                                <form class="pxn_amin" method="post">
                                                    <div class="edu_home_wrapper edu_from_wrapper">
                                                        <div class="edu_counter_section_setting">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_selected_students'));?><sup>*</sup></label>
                                                                        <input type="number" class="form-control require" name="total_toppers" value="<?php echo !empty($home_Details)?$home_Details['0']['total_toppers']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_selected_students'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_trusted_teachers'));?><sup>*</sup></label>
                                                                        <input type="number" class="form-control require" name="trusted_students" value="<?php echo !empty($home_Details)?$home_Details['0']['trusted_students']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_trusted_teachers'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label><?php echo html_escape($this->common->languageTranslator('ltr_years_history'));?><sup>*</sup></label>
                                                                        <input type="number" class="form-control require" name="years_of_histry" value="<?php echo !empty($home_Details)?$home_Details['0']['years_of_histry']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_years_history'));?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
                                                                    <div class="edu_btn_wrapper">
                                                                        <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/counter_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="selectionSet">
                                    <div class="hide studentArrayDiv"><?php echo json_encode($student_Data);?></div>
                                    <div class="edu_courses_content">

                                        <div class="edu_courses_detail parentFormWrappr">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_selected_students'));?></h4>
                                                </div>
                                            </div>
                                            <form method="post">
                                                <div class="edu_home_wrapper edu_from_wrapper">
                                                    <div class="headingSection">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
                                                                    <input type="text" class="form-control require" name="selectn_heading" value="<?php echo !empty($home_Details)?$home_Details['0']['selectn_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
                                                                    <input type="text" class="form-control" name="selectn_subheading" value="<?php echo !empty($home_Details)?$home_Details['0']['selectn_subheading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="edu_admin_testimonials">
                                                            <div class="row">
                                                                <div class="col-md-6 pl-0">
                                                            <label class="padderTop20"><?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?> &amp; <?php echo html_escape($this->common->languageTranslator('ltr_add_positions'));?><sup>*</sup></label></div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right responsive_center">
                                                        <button type="button" class="btn btn-primary addNewRow" data-type="selection"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_more'));?></button>
                                                    </div>
                                                </div>
                                                                <?php 
                                                                if(!empty($home_Details[0]['selection'])){
                                                                    $selection = json_decode($home_Details[0]['selection']);
                                                                }else{
                                                                    $selection = '';
                                                                }
                                                                
                                                                if(!empty($selection)){
                                                                    foreach($selection as $key => $value){
                                                                ?>
                                                                    <div class="parentRow">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                <div class="form-group">
                                                                                    <select name="select_stud[]" class="form-control require edu_selectbox_with_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?>"> 
                                                                                        <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?></option>
                                                                                        <?php
                                                                                        if(!empty($student_Data)){
                                                                                            foreach($student_Data as $stud){
                                                                                                if($key == $stud['id'])
                                                                                                    $sel = 'selected';
                                                                                                else
                                                                                                    $sel = '';
                                                                                                echo '<option value="'.$stud['id'].'" '.$sel.'>'.$stud['name'].'</option>';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
                                                                                <div class="form-group edu_delet_icon_input">
                                                                                    <input type="text" class="form-control require" name="select_desc[]" value="<?php echo html_escape($value); ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_positions'));?>">
                                                                                    <div class="edu_detele_row_wrapper">
                                                                                        <i class="icofont-ui-delete removeRow" title="Remove"></i>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } }else{ ?>
                                                                    <div class="parentRow">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                <div class="form-group">
                                                                                    <select name="select_stud[]" class="form-control require edu_selectbox_with_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?>"> 
                                                                                        <option value="">Select Student</option>
                                                                                        <?php
                                                                                        if(!empty($student_Data)){
                                                                                            foreach($student_Data as $stud){
                                                                                                echo '<option value="'.$stud['id'].'">'.$stud['name'].'</option>';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
                                                                                <div class="form-group edu_delet_icon_input">
                                                                                    <input type="text" class="form-control require" name="select_desc[]" value="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_position'));?>">
                                                                                    <div class="edu_detele_row_wrapper">
                                                                                        <i class="icofont-ui-delete removeRow" title="Remove"></i>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="edu_btn_wrapper">
                                                                    <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/selection_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="testimonialSet">
                                    <div class="edu_courses_content">
                                        <div class="edu_courses_detail parentFormWrappr">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_manage_testimonials'));?></h4>
                                                </div>
                                            </div>
                                            <form method="post">
                                                <div class="edu_home_wrapper edu_from_wrapper">
                                                    <div class="headingSection">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
                                                                    <input type="text" class="form-control require" name="testi_heading" value="<?php echo !empty($home_Details)?$home_Details['0']['testi_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
                                                                <div class="form-group">
                                                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
                                                                    <input type="text" class="form-control" name="testi_subheading" value="<?php echo !empty($home_Details)?$home_Details['0']['testi_subheading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="edu_admin_testimonials">
                                                            <div class="row">
                                                                <div class="col-md-6 pl-0">
                                                                <label class="padderTop20"><?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?> &amp; <?php echo html_escape($this->common->languageTranslator('ltr_add_their_feedbacks'));?><sup>*</sup></label></div>
                                                                <div class="col-md-6 pr-0">
                                                    <div class="edu_btn_wrapper sectionHolder padderBottom30 text-right responsive_center">
                                                        <button type="button" class="btn btn-primary addNewRow" data-type="testimonial"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_more'));?></button>
                                                    </div>
                                                </div>
                                                                <?php 
                                                                if(!empty($home_Details[0]['testimonial'])){
                                                                    $testimonial = json_decode($home_Details[0]['testimonial']);
                                                                }else{
                                                                    $testimonial = '';
                                                                }
        
                                                                if(!empty($testimonial)){
                                                                    foreach($testimonial as $key => $value){
                                                                ?>
                                                                    <div class="parentRow">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                <div class="form-group">
                                                                                    <select name="testi_stud[]" class="form-control require edu_selectbox_with_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?>"> 
                                                                                        <option value="">Select Student</option>
                                                                                        <?php
                                                                                        if(!empty($student_Data)){
                                                                                            foreach($student_Data as $stud){
                                                                                                if($key == $stud['id'])
                                                                                                    $sel = 'selected';
                                                                                                else
                                                                                                    $sel = '';
                                                                                                echo '<option value="'.$stud['id'].'" '.$sel.'>'.$stud['name'].'</option>';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
                                                                                <div class="form-group edu_delet_icon_input">
                                                                                    <input type="text" class="form-control require" name="testi_desc[]" value="<?php echo html_escape($value); ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>">
                                                                                    <div class="edu_detele_row_wrapper">
                                                                                        <i class="icofont-ui-delete removeRow" title="Remove"></i>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } }else{ ?>
                                                                    <div class="parentRow">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                <div class="form-group">
                                                                                    <select name="testi_stud[]" class="form-control require edu_selectbox_with_search" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_student'));?>"> 
                                                                                        <option value="">Select Student</option>
                                                                                        <?php
                                                                                        if(!empty($student_Data)){
                                                                                            foreach($student_Data as $stud){
                                                                                                echo '<option value="'.$stud['id'].'">'.$stud['name'].'</option>';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                <div class="form-group edu_delet_icon_input">
                                                                                    <input type="text" class="form-control require" name="testi_desc[]" value="" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>">
                                                                                    <div class="edu_detele_row_wrapper">
                                                                                        <i class="icofont-ui-delete removeRow" title="Remove"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="edu_btn_wrapper">
                                                                    <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/testimonial_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="teacherSet">
                                    <div class="edu_courses_content">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
                                            <div class="edu_courses_detail">
                                            <form class="pxn_amin" method="post">
                                                <div class="edu_home_wrapper edu_from_wrapper">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_teacher_section'));?></h4>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
                                                                <input type="text" class="form-control require" name="teacher_heading" value="<?php echo !empty($home_Details)?$home_Details['0']['teacher_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
                                                                <input type="text" class="form-control" name="teacher_subheading" value="<?php echo !empty($home_Details)?$home_Details['0']['teacher_subheading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label><?php echo html_escape($this->common->languageTranslator('ltr_no_of_teachers'));?><sup>*</sup></label>
                                                                <input type="number" class="form-control require" name="no_of_teacher" value="<?php echo !empty($home_Details)?$home_Details['0']['no_of_teacher']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_no_of_teachers'));?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
                                                            <div class="edu_btn_wrapper">
                                                                <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/teacher_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="clientBtnSet">
                                    <div class="edu_courses_content">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
                                            <div class="edu_courses_detail">
                                            <form class="pxn_amin" method="post">
                                                <div class="edu_home_wrapper edu_from_wrapper">
                                                    <div class="row mb_30">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_header_buttons'));?></h4>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label><?php echo html_escape($this->common->languageTranslator('ltr_button_text'));?></label>
                                                                <input type="text" class="form-control" name="header_btn_txt" value="<?php echo !empty($home_Details)?$home_Details['0']['header_btn_txt']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_button_text'));?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                            <div class="form-group">
                                                                <label><?php echo html_escape($this->common->languageTranslator('ltr_button_url'));?></label>
                                                                <input type="text" class="form-control" data-valid="url" data-error="Please enter a valid URL." name="header_btn_url" value="<?php echo !empty($home_Details)?$home_Details['0']['header_btn_url']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_button_url'));?>"  data-symb="no">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_client_images'));?></h4>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
                                                            <div class="form-group row">
                                                            <?php 
                                                            if(!empty($home_Details) && !empty($home_Details[0]['client_imgs'])){
                                                                $clients = json_decode($home_Details[0]['client_imgs'],true);
                                                                foreach($clients as $cln){
                                                                    echo '<div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mb_30"><div class="eduClientSingleImages"><img src="'.base_url('uploads/site_data/').$cln.'" width="80"></div></div>';
                                                                }
                                                            }?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
                                                            <div class="form-group">
                                                                <input type="file" data-valid="image" data-error="Please seelct a png or jpg image." class="form-control" name="client_imgs[]" value="" accepts="images/*" multiple>
                                                                <p class="fileNameShow"></p>
                                                                <p class="pxn_info"><?php echo html_escape($this->common->languageTranslator('ltr_upload_multiple_files'));?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <div class="edu_btn_wrapper">
                                                                <button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/client_btn_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</section>