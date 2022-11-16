<!----- Page Title Start ----->
<section class="edu_page_title_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
				<div class="edu_page_title_text">
					<h1><?php echo html_escape($this->common->languageTranslator('ltr_courses_offered'));?></h1>
					<ul>
						<li><a href="<?php echo base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
						<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_courses_offered'));?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- course info start -->
<div class="edu_courseInfo_box edu-course-info-bedge">
	<img src="./assets/images/course.png" alt="image">
<p><?php if($batches) {echo count($batches);}else echo "0 "; ?>+ <?php echo html_escape($this->common->languageTranslator('ltr_courses'));?></p>
</div>
<!-- course info end -->
<!-- Search Course Start -->
<div class="edu-search-course">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="edu-select-category">
                    <h3>Kategori</h3>
                    <ul>
                        <?php
                        foreach($category_data as $cat){ ?>
                        <li class="edu-category-panel"><a name="cat_id" id="singleCatData" href="javascript:;" data-id="<?php echo $cat['id'];?>"><?php echo $cat['name'];
                        ?></a><?php $cat_id = $cat['id']; 
                         $sub_data = $this->db_model->select_data('id,name,slug','batch_subcategory use index (id)',array('cat_id'=>$cat_id,'status'=>'1'));?>
                             <?php if(!empty($sub_data)) {?>
                            <ul>
                                <?php foreach($sub_data as $sub){ ?>
                                <li class="edu-category-panel"><a id="singleCatData" href="javascript:;"><?php echo $sub['name']; ?></a>
                                <?php $subcat_id = $sub['id'];
                                $batch_dat = $this->db_model->select_data('*','batches use index (id)',array('sub_cat_id'=>$subcat_id,'status'=>'1'));
                               if(!empty($batch_dat)){ 
                               ?>
                                    <ul>        
                                    <?php foreach($batch_dat as $batch_data) { ?>
                                        <li><a href="<?php echo base_url('courses-details/'.$batch_data['id']); ?>"><?php echo $batch_data['batch_name'];?></a></li>
                                        <?php } ?>
                                    </ul>
                                    <?php  } } ?>
                                </li>
                            </ul>
                                 <?php } ?>
                        </li>
                        
                        <?php } ?>
                           <li class="edu-category-panel"><a href="javascript:;">Other</a>
                        
                            <?php
                            $batch_data = $this->db_model->select_data('*','batches use index (id)',array('sub_cat_id'=>0,'status'=>'1'));
                        
                            if(!empty($batch_data)){ ?>
                            <ul>
                                    <?php foreach($batch_data as $batch){?>
                                        <li><a href="<?php echo base_url('courses-details/'.$batch['id']); ?>"><?php echo $batch['batch_name'];?></a></li>
                                        <?php }  ?>
                            </ul>
                            <?php }  ?>
                          
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-md-4">
                <form class="edu-search-form">
                    <input type="text" id="search_field" name="search_field" placeholder="Cari Course">
                    <span class="edu-search-icon">
                       <a href="javascript:;" id="search_button" name="search_button" placeholder="Cari Course"> <i class="fas fa-search"></i></a>
                    </span>
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- Search Course End -->
<!-- Course start -->
<div id="search_data_course">
    <div class="edu-course-wrap edu-course-search-slider">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
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
                                   
                                    <?php } } ?>
                           
                            </div>
                            <div class="edu_banner_button">
                				<div class="ButtonNext"><span class="icofont-simple-right"></span></div>
                				<div class="ButtonPrev"><span class="icofont-simple-left"></span></div>
                			</div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Course end -->

<!-- Trending Course start -->

<!-- Trending Course end -->

<!-- course content start -->
	<!--<div class="edu-course-content-wrap spacer-top spacer-bottom edu-course-bg-wrap" id="edu-course-accordian">-->
 <!--   <div class="container">-->
 <!--       <div class="edu_heading_wrapper text-center">-->
	<!--		<h4 class="edu_subTitle"><?php $ttd =html_escape($this->common->languageTranslator('ltr_enhance')); echo !empty($frontend_details[0]['sec_crse_sub_heading'])?$frontend_details[0]['sec_crse_sub_heading']: $ttd;?></h4>-->
	<!--		<h4 class="edu_heading"><?php $cttd =html_escape($this->common->languageTranslator('ltr_our_courses')); echo !empty($frontend_details[0]['sec_crse_heading'])?$frontend_details[0]['sec_crse_heading']:$cttd ;?></h4>-->
	<!--		<img src="<?php echo base_url();?>/assets/images/border.png" alt="">-->
	<!--	</div>-->
 <!--       <div class="row">-->
 <!--           <div class="col-md-6">-->
 <!--               <div class="edu-course-accordian">-->
                    <?php
//                     if(!empty($video_lectures)){
// 	$i = 0;
// 		    foreach($video_lectures as $video){ $i++;
			?>
                    <!--<div class="edu-course-accordian-list">-->
                    <!--    <p class="edu-course-accordian-title collapsed" data-toggle="collapse" data-target="#edu-course-accordian<?php echo $i;?>">-->
                    <!--       Subject : <?php echo $video['subject']." </br> Chapter : ".$video['topic'];?></p>-->
                    <!--    <div id="edu-course-accordian<?php echo $i;?>" class="collapse" data-parent="#edu-course-accordian">-->
                    <!--        <div class="edu-course-accordian-body">-->
                    <!--            <ul>-->
                    <!--                <li>            -->
                                       <?php
                                    //   echo $video['title'];
                                    //     echo '<span class="edu-video-preview"><a class="viewVideo btn_view" title="View" data-id="'.$video['id'].'" data-url="'.$video['url'].'" data-type="'.$video['video_type'].'" data-desc="'.$video['description'].'"><i class="fa fa-eye"></i></a></span>';
                                        ?>
                                           
                    <!--                </li>-->
                    <!--            </ul>-->
                    <!--        </div>-->
                           
                    <!--    </div>-->
                    <!--</div>-->
                      <?php
                    //   } } 
                      ?>
<!--                </div>-->
<!--            </div>  -->
           
<!--        </div>-->
<!--    </div>-->
<!--</div>  -->
<!-- course content end -->


<!-- view Pop Up Start  -->
<div id="view_video_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="viewVideoTopic"><?php echo html_escape($this->common->languageTranslator('ltr_view_video'));?></h4>
            <div class="row videoIframeShow">
            </div>
        </div>
    </div>
</div>

