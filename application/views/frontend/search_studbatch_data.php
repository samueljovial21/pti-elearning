		<div class="edu_dashboard_widgets mt-4">
    		<div class="row">
                <?php 
                if(!empty($batches)){
                    foreach($batches as $value){
                                    ?>
                     <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="edu_color_boxes box_left">
                        <div class="edu_dash_box_icon">
                        <img src="<?php if(!empty($value['batch_image'])) { echo base_url('uploads\batch_image/').$value['batch_image'] ; }else{ echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']); } ?>" alt="image">
                        </div>
                        <div class="edu_dash_box_data box-dash">
                        <a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2" target="_blank"><?php echo $value['batch_name'];?></a>

                            <!-- <a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2" target="_blank">Math Olympiad by Dr. Jon</a> -->
                            <h3><?php if($value['batch_type']==2){ if(!empty($value['batch_offer_price'])){ echo '<s>'.$currency_decimal.' '.$value['batch_price'].'</s> / '.$currency_decimal.' '.$value['batch_offer_price']; }else{ echo $currency_decimal.' '.$value['batch_price'];} }else{ echo html_escape($this->common->languageTranslator('ltr_free'));} ?></h3>
                        </div>
                        <div class="edu_dash_content">
                        <p><?php echo $value['description']; ?></p>
                        </div>
                        <div class="edu_dash_info">
                            <ul>
                            <li><p><a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2" target="_blank"><?php echo html_escape($this->common->languageTranslator('ltr_course_view'));?> </a> </p></li>
                                    <!-- <li><p><a href="#" class="cour_view"> online </a></p></li> -->
                                    <?php 
					              $purchase = $this->db_model->select_data('*', 'sudent_batchs',array('student_id' => $this->session->userdata('uid'),'batch_id'=>$value['id']));
					            if(empty($purchase)){
					             ?>
					            <li><p><a href="#" class="cour_view enrollNowSubmit" data-id="<?=$value['id'];?>" data-email="<?=$this->session->userdata('email')?>" data-name="<?=$this->session->userdata('name')?>" data-mobile="<?=$this->session->userdata('contact_no')?>"> <?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?> </a></p></li>
					            
					            <?php } else{?>
					            
					             <li><p><a href="#" class="cour_view"> <?php echo html_escape($this->common->languageTranslator('ltr_already_enrolled'));?> </a></p></li>
					             <?php } ?>
                                <li><p><a href="#" class="cour_view"> offline</a></p></li>
                                                                <ul>
                        </ul></ul></div>
                    </div>
                </div>
            <?php }
            }else{ echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_course_result')).'</div>
                            </div>
                        </div>
                    </section>';
                    
                }?>
              
               
        
    		</div>
        </div>

        <style>

.edu_dash_box_data{
padding-right: 0 !important;
}
.edu_dash_box_data_wrapper{
display: flex;
align-items: center;
}
.edu_dash_info ul{
align-items: center;
}
.edu_dash_info ul li:nth-child(3){
margin-left: 3px;
}
.edu-search-course .edu_color_boxes{
transition: all .3s linear;
}
.edu-search-course .edu_color_boxes:hover{
box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.1) !important;
}
.cour_view{
border: 1px solid #4267C8;
padding: 0 15px;
border-radius: 6px;
background-color: #4267C8;
color:#fff !important;
height: 35px;
display: flex;
align-items: center;
justify-content: center;
text-transform: capitalize;
}
.cour_view:hover{
background-color: transparent;
color: #4267C8 !important;
border: 1px solid #4267C8;
letter-spacing: 0px;
}
.edu_dash_box_icon img{
height: 170px;
width: 100%;
}
.edu_courses_view:hover{
letter-spacing: 0px !important;
}
.edu_dash_info ul{
align-items: center;
}
@media (max-width: 1880px){
.edu_dash_info ul li:first-child {
  margin-right: 7px !important;
  padding-right: 7px !important;
}
}
.edu_dash_box_icon{
margin-top: 53px;
}
.edu_color_boxes.box_left .edu_dash_box_icon{
background-color: transparent !important;
}
.edu_dash_box_data.box-dash {
margin-top: 70px;
}
.edu_color_boxes.box_left, .edu_dash_box_icon{
display: block;
}
.edu_color_boxes.box_left .edu_dash_box_icon{
width: 100% ;

} 
</style>
      