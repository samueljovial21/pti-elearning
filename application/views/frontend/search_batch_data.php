<!-- Course start -->
<div class="edu-course-wrap">
    <div class="container">
        <div class="row">
           	<?php 
				 	if(!empty($batches)){
				 		foreach($batches as $value){
								?>
            <div class="col-lg-3 col-sm-6">
                <div class="edu-course-box">
                    <div class="edu-course-img">
                       	<img src="<?php if(!empty($value['batch_image'])) { echo base_url('uploads\batch_image/').$value['batch_image'] ; }else{ echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']); } ?>" alt="image">
                        <?php if(!empty($value['batch_offer_price'])){ ?><span class="edu-course-offer"><?php echo html_escape($this->common->languageTranslator('ltr_offer')); ?></span><?php } ?>
                        <a href="<?php echo base_url('enroll-now/'.$value['id']); ?>" class="edu-enroll-btn"><?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?></a>
                    </div> 
                    <div class="edu-course-content">
                        <a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu-course-title"><?php echo $value['batch_name'];?></a>
                        <p><?php echo $value['description']; ?></p>
                        <!--<ul class="edu-course-rating">-->
                        <!--    <li><i class="fas fa-star"></i></li>-->
                        <!--    <li><i class="fas fa-star"></i></li>-->
                        <!--    <li><i class="fas fa-star"></i></li>-->
                        <!--    <li><i class="fas fa-star"></i></li>-->
                        <!--    <li><i class="fas fa-star"></i></li>-->
                        <!--</ul>-->
                        <h3 class="edu-course-price"><?php if($value['batch_type']==2){ if(!empty($value['batch_offer_price'])){ echo '<s>'.$currency_decimal.' '.$value['batch_price'].'</s> / '.$currency_decimal.' '.$value['batch_offer_price']; }else{ echo $currency_decimal.' '.$value['batch_price'];} }else{ echo "Free";} ?></h3>
                        <a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view"><?php echo html_escape($this->common->languageTranslator('ltr_course_view'));?><i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
           
           <?php
          } } 
           ?>
                </div>
            </div>
        </div>