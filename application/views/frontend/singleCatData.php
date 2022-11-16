
    <div class="container">
        <div class="edu-course-heading">
            <h1><?php echo $category[0]['name'];?></h1>
        </div>
        <ul class="nav edu-nav-tabs" role="tablist">
         <?php  if(!empty($batches)){
             $j=0;
             foreach($batches as $sub){
             $j++;
             ?>
            <li class="nav-item">
                <a class="<?=($j==1)?'active show':''?>" id="home-tab" data-toggle="tab" href="#trending<?=$j?>" role="tab" aria-selected="false"><?php echo $sub['SubcategoryName']; ?></a>
            </li>
            <?php } }?>
        </ul>
   
        <div class="tab-content">
             <?php 
             if(!empty($batches)){
                  $k=0;
             foreach($batches as $batch){ 
             $data = $batch['batchdata'];
            $k++;
             
                
             ?>
            <div class="tab-pane fade <?=($k==1)?'active show':''?>" id="trending<?=$k?>" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <?php if(!empty($data)){ foreach($data as $bat){ ?>
                    	  <div class="col-lg-3 col-sm-6">
                        <div class="edu-course-box">
                            <div class="edu-course-img">
                                <img src="<?php if(!empty($bat['batch_image'])) { echo base_url('uploads\batch_image/').$bat['batch_image'] ; }else{ echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']); } ?>" alt="image">
                               	 	<?php if(!empty($bat['batch_offer_price'])){ ?> <span class="edu-course-offer"><?php echo html_escape($this->common->languageTranslator('ltr_offer')); ?></span> <?php } ?>                               <a href="<?php echo base_url('enroll-now/'.$bat['id']); ?>" class="edu-enroll-btn"><?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?></a>
                            </div> 
                            <div class="edu-course-content">
                                <a href="<?php echo base_url('courses-details/'.$bat['id']); ?>" class="edu-course-title"><?php echo $bat['batch_name'];?></a>
                                <p><?php echo $bat['description']; ?></p>
                              
                                <h3 class="edu-course-price"><?php if($bat['batch_type']==2){ if(!empty($bat['batch_offer_price'])){ echo '<s>'.$currency_decimal.' '.$bat['batch_price'].'</s> / '.$currency_decimal.' '.$bat['batch_offer_price']; }else{ echo $currency_decimal.' '.$bat['batch_price'];} }else{ echo "Free";} ?></span></h3>
                                <a href="<?php echo base_url('courses-details/'.$bat['id']); ?>" class="edu_courses_view"><?php echo html_escape($this->common->languageTranslator('ltr_course_view'));?><i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } }else{ 
                    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_batch_found')).'</div>
                            </div>
                        </div>
                    </section>';}?>
                                       
                    </div>
                </div>
                <?php } }?>
            </div>
        </div>