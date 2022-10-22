<section class="edu_admin_content">
	<div class="sectionHolder edu_admin_right edu_dashboard_wrap">
	  
	  <div class="edu-search-course edu-card-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="edu-select-category">
                    <h3>Categories</h3>
                    <ul>
                        <?php
                        foreach($category_data as $cat){ ?>
                        <li class="edu-category-panel"><a href="javascript:;"><?php echo $cat['name'];
                        ?></a><?php $cat_id = $cat['id']; 
                         $sub_data = $this->db_model->select_data('id,name,slug','batch_subcategory use index (id)',array('cat_id'=>$cat_id,'status'=>'1'));?>
                             <?php if(!empty($sub_data)) { 
                            ?>
                            <ul>
                                <?php foreach($sub_data as $sub){ ?>
                                <li><a class="subcatData" data-id="<?=$sub['id']?>" href="javascript:;"><?php echo $sub['name']; ?></a>
                                
                                </li>
                                <?php } ?>
                            </ul>
                                 <?php } ?>
                        </li>
                        
                        <?php } ?>
                           <li><a class="subcatData" data-id="0" href="javascript:;">Other</a>
                       
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-md-4">
                <div class="edu-search-form">
                    <input type="text" id="search_field" name="search_field" placeholder="Cari Course">
                    <span class="edu-search-icon">
                       <a href="javascript:;" id="search_button" name="search_button" placeholder="Cari Course"> <i class="fas fa-search"></i></a>
                    </span>
                </div> 
            </div>
        </div>
    
	    <div id="search_data_course">
		<div class="edu_dashboard_widgets mt-4">
    		<div class="row">
                <?php 
                if(!empty($batches)){
                    foreach($batches as $value){
                                    ?>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                    
                    <div class="edu_color_boxes box_left">
                        <div class="edu_dash_box_data">
                           <a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2" target="_blank"><?php echo $value['batch_name'];?></a>
                            <h3><?php if($value['batch_type']==2){ if(!empty($value['batch_offer_price'])){ echo '<s>'.$currency_decimal.' '.$value['batch_price'].'</s> / '.$currency_decimal.' '.$value['batch_offer_price']; }else{ echo $currency_decimal.' '.$value['batch_price'];} }else{ echo html_escape($this->common->languageTranslator('ltr_free'));} ?></h3>
                        </div>
                        <div class="edu_dash_box_icon">
                            <img src="<?php if(!empty($value['batch_image'])) { echo base_url('uploads\batch_image/').$value['batch_image'] ; }else{ echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']); } ?>" alt="image">
                        </div>
                        <div class="edu_dash_content">
                            <p><?php echo $value['description']; ?></p>
                            </div>
                        <div class="edu_dash_info">
    					    <ul>
					            <li><p><a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2" target="_blank"><?php echo html_escape($this->common->languageTranslator('ltr_course_view'));?> </a> </p></li>
					            <?php 
					              $purchase = $this->db_model->select_data('*', 'sudent_batchs',array('student_id' => $this->session->userdata('uid'),'batch_id'=>$value['id']));
					          
					            if(empty($purchase)){
					             ?>
					            <li><p><a href="#" class="courses_atc enrollNowSubmit" data-id="<?=$value['id'];?>" data-email="<?=$this->session->userdata('email')?>" data-name="<?=$this->session->userdata('name')?>" data-mobile="<?=$this->session->userdata('contact_no')?>"> <?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?> </a></p></li>
					            
					            <?php } else{?>
					            
					             <li><p><a href="#" class=""> <?php echo html_escape($this->common->languageTranslator('ltr_already_enrolled'));?> </a></p></li>
					             <?php } ?>
					        <ul>
					    </div>
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
      </div>
    
       </div>
</div>  
	</div>
</section> 

