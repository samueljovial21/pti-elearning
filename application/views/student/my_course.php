
<section class="edu_admin_content">
	<div class="sectionHolder edu_admin_right edu_dashboard_wrap">
	    
	    
		<div class="edu_dashboard_widgets">
    		<div class="row">
                <?php 
                // print_r($batches);
                            if(!empty($batches)){
                                foreach($batches as $value){
                                    ?>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    <a class="<?php if($value['id']==$this->session->userdata('batch_id')){ echo 'course_active';} ?>" href="<?=base_url('student/select-course/'.$value['batch_id'])?>">
                    <div class="edu_color_boxes box_left">

                        <div class="edu_dash_box_data">
                            <p><?php echo $value['batch_name'];?></p>
                            <h3><?php if($value['batch_type']==2){ if(!empty($value['batch_offer_price'])){ echo '<s>'.$currency_decimal.' '.$value['batch_price'].'</s> / '.$currency_decimal.' '.$value['batch_offer_price']; }else{ echo $currency_decimal.' '.$value['batch_price'];} }else{ echo html_escape($this->common->languageTranslator('ltr_free'));} ?></h3>
                        </div>
                        <div class="edu_dash_box_icon">
                            <img src="<?php if(!empty($value['batch_image'])) { echo base_url('uploads\batch_image/').$value['batch_image'] ; }else{ echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']); } ?>" alt="image">
                        </div>
                        <div class="edu_dash_info">
    					    <ul>
					            <!-- <li><p><a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2" target="_blank">view more </a> </p></li> -->
					            <!-- <li><p><a href="#" class="courses_atc enrollNowSubmit" data-id="<?=$value['id'];?>" data-email="<?=$this->session->userdata('email')?>" data-name="<?=$this->session->userdata('name')?>">Enroll Now</a></p></li> -->
					        <ul>
					    </div>
                    </div>
                    </a>
                    
                </div>
            <?php } 
            }else{
                echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_Course_purchase')).'</div>
                            </div>
                        </div>
                    </section>';
            }?>
              
               
        
    		</div>
        </div>
      
       
	</div>
</section> 

