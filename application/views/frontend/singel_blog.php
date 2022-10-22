<section class="edu_page_title_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <div class="edu_page_title_text">
                    <h1><?php echo html_escape($this->common->languageTranslator('ltr_blog_details')); ?></h1>
                    <ul>
                        <li><a href="<?=base_url()?>"><?php echo html_escape($this->common->languageTranslator('ltr_home')); ?></a></li>
                        <li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_contact_us')); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="edu_sglblog_wrapper">
    <div class="container">
        <div class="row">            
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="edu_sglblog_section">
					<div class="edu_sglblog_inner bgshadowradios mb_30">
                    <?php if(!empty($blog)){ 
						foreach($blog as $value){
							
							$added_by = $this->db_model->select_data('*','users',array('id'=>$value['added_by']),1);
				
					?>
                    
                        <img src="<?php echo base_url('/uploads/blog/').$value['image'] ; ?>" alt="image">
                        <a href="<?php echo base_url('/blog/').$value['id']; ?>" class="edu_sglblog_title"><?php if(!empty($value['title'])){ echo $value['title'] ; } ?></a>
                        <ul class="sglblog_metapost">
                            <li>
                                <a href="<?php echo base_url('/blog/').$value['id']; ?>"> <i class="fas fa-user"></i> <?php if(!empty($added_by)){ echo $added_by[0]['name'] ; } ?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('/blog/').$value['id']; ?>"> <i class="fas fa-calendar-alt"></i> <?php echo date('d-m-Y',strtotime($value['create_at'])) ; ?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('/blog/').$value['id']; ?>"> <i class="fas fa-comments"></i> <?php echo count($comments).' '.html_escape($this->common->languageTranslator('ltr_comments')) ; ?></a>
                            </li>
                        </ul>
                        <p class="edu_sglblog_des mb_30"><?php if(!empty($value['description'])){ echo  html_entity_decode($value['description'], ENT_QUOTES, 'UTF-8'); } ?></p>
                    
					<?php }
						}else{
							echo html_escape($this->common->languageTranslator('ltr_no_blog'));
							} ?>
					</div>
					<!-- reply -->
					<?php 
					if(!empty($comments)){
						?>
                    <div class="sglblog_cmntwrap bgshadowradios mb_30">
                        <h4 class="edu_cmntitle mb_50"> <?php echo html_escape($this->common->languageTranslator('ltr_comments')).' ('.count($comments).')' ; ?></h4>
						<?php 
						foreach($comments as $cvalue){
							$reply = $this->db_model->select_data('*','blog_comments_reply',array('comment_id'=>$cvalue['id'],'status'=>1));
						?>
                        <div class="sglblog_cmntbox">
                            <div class="sglblog_cmntimg">
                                <img src="<?php echo base_url('/uploads/comment/').$cvalue['user_image']; ?>" alt="image">
                            </div>
                            <div class="sglblog_cmntdata">
                                <div class="sglblog_cmnthead">    
                                    <div class="sglblog_cmntname">    
                                        <h4 class="sglblog_cmntauth"><?php echo $cvalue['user_name']; ?></h4>
                                        <a class="sglblog_cmnttime"  href=""><?php echo date('M d, Y H:i a',strtotime($cvalue['create_at'])) ; ?></a>
                                    </div>                                
                                    <div class="sglblog_cmntreply"> 
                                        <a class="sb_replybtn replyForm" data-id="<?php echo $cvalue['id']; ?>" data-ses="<?=($this->session->userdata('uid'))?1:0?>" data-name="<?=($this->session->userdata('name'))?$this->session->userdata('name'):''?>" data-email="<?=($this->session->userdata('email'))?$this->session->userdata('email'):''?>"> <i class="fa fa-reply-all" aria-hidden="true"></i><?php echo html_escape($this->common->languageTranslator('ltr_reply')); ?></a> 
                                    </div>
                                </div>
                                <p class="sglblog_cmntdes"><?php if(!empty($cvalue['comments'])){ echo  html_entity_decode($cvalue['comments'], ENT_QUOTES, 'UTF-8'); } ?></p>
                            </div>
							
							
                        </div>
                        <div id="reply_form<?php echo $cvalue['id']; ?>" class="removetHtml"> </div>
						<?php
								if(!empty($reply)){
									foreach($reply as $rvalue){ ?>
										<div class="sglblog_cmntbox sglblog_userreply">
											<div class="sglblog_cmntimg">
												<img src="<?php echo base_url('/uploads/reply/').$rvalue['image']; ?>" alt="image">
											</div>
											<div class="sglblog_cmntdata">
												<div class="sglblog_cmnthead">    
													<div class="sglblog_cmntname">    
														<h4 class="sglblog_cmntauth"><?php echo $rvalue['name']; ?></h4>
														<a class="sglblog_cmnttime" href=""><?php echo date('M d, Y H:i a',strtotime($rvalue['create_at'])) ; ?></a>
													</div>                                
													<!-- <div class="sglblog_cmntreply"> 
														<a class="sb_replybtn" href="" data-id="<?php echo $cvalue['id']; ?>" data-replyid="<?php echo $rvalue['id']; ?>"> <i class="fa fa-reply-all" aria-hidden="true"></i> <?php echo html_escape($this->common->languageTranslator('ltr_reply')); ?></a> 
													</div> -->
												</div>
												<p class="sglblog_cmntdes"><?php if(!empty($rvalue['reply'])){ echo  html_entity_decode($rvalue['reply'], ENT_QUOTES, 'UTF-8'); } ?></p>
											</div>
											<!-- <div id="reply_to_form<?php echo $cvalue['id']; ?>"> </div> -->

										</div>
									<?php }} ?>

						<?php	} ?>
						<!--
                        <div class="sglblog_cmntbox sglblog_userreply">
                            <div class="sglblog_cmntimg">
                                <img src="http://192.168.0.10/e-academy/assets/images/mission_bg.png" alt="image">
                            </div>
                            <div class="sglblog_cmntdata">
                                <div class="sglblog_cmnthead">    
                                    <div class="sglblog_cmntname">    
                                        <h4 class="sglblog_cmntauth">Princy Ducruz</h4>
                                        <a class="sglblog_cmnttime" href="">Jan 07, 2021 At 2:15 Am</a>
                                    </div>                                
                                    <div class="sglblog_cmntreply"> 
                                        <a class="sb_replybtn" href=""> <i class="fa fa-reply-all" aria-hidden="true"></i> Reply</a> 
                                    </div>
                                </div>
                                <p class="sglblog_cmntdes">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore atque officiis maxime suscipit and expedita and obcaecati nulla in ducimus iure quos quam dolor quas maiores.</p>
                            </div>
                        </div>
						-->
                      
                    </div>
					<?php } ?>
					<!-- comments -->
                    <div class="sglblog_postcomt bgshadowradios">
                        <h4 class="edu_cmntitle mb_50"><?php echo html_escape($this->common->languageTranslator('ltr_leave_comments')); ?></h4>
						<input type="hidden" value="<?php echo base_url()?>" id="baseUrlId">
                        <form method="post">
								<input type="hidden" value="<?php echo $id; ?>" name="blogId">
								<div class="row">
                                   <?php if(!empty($this->session->userdata('uid'))){ 
                                   // print_r($this->session->userdata());
                                    ?>

                                    <input type="hidden" name="name" value="<?=$this->session->userdata('name')?>">
                                    <input type="hidden" name="email" value="<?=$this->session->userdata('email')?>">
                                    <input type="hidden" name="mobile" value="<?=$this->session->userdata('mobile')?>">
                                    <?php }else{ ?>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="edu_field_holder">
                                            <input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_name')); ?> *" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="edu_field_holder">
                                            <input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_email')); ?> *" data-valid="email" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_email')); ?>" name="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="edu_field_holder">
                                            <input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_phone')); ?> *" data-valid="mobile" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_phone')); ?>" name="mobile" maxlength="12">
                                        </div>
                                    </div>
                                    <?php }?>
									
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="edu_field_holder">
											<textarea placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_message')); ?> *" class="edu_form_field require" name="message"></textarea>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<button type="button" class="edu_btn commentFormSubmit"><?php echo html_escape($this->common->languageTranslator('ltr_send')); ?></button>
									</div>
								</div>
							</form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="sglblog_sidebar">
                    <!--<div class="edu_sglblog_search bgshadowradios mb_30">
                        <form class="bs_search_form">
                            <input type="search" class="bs_search_field" placeholder="Search" value="" name="s">
                            <button type="submit" class="bs_search_submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div> -->
                    <div class="sglblog_recent bgshadowradios mb_30">
                        <h4 class="edu_cmntitle mb_30"><?php echo html_escape($this->common->languageTranslator('ltr_blog_recent'));?></h4>
                        <ul class="blog_recent_list">
						  <?php if(!empty($recent_blog)){ 
						  foreach($recent_blog as $rvalue){ ?>
                            <li>
                                <div class="blog_thumb">
                                    <a href="<?php echo base_url('/blog/').$rvalue['id']; ?>" >
                                        <img src="<?php echo base_url('/uploads/blog/').$rvalue['image'] ; ?>" alt="image" class="img-fluid">
                                    </a>
                                </div>
                                <div class="blog_content">
                                    <a href="<?php echo base_url('/blog/').$rvalue['id']; ?>"><?php if(!empty($value['title'])){ echo substr(strip_tags($rvalue['title']), 0, 50) ; } ?></a>
                                    <span><?php echo date('d-m-Y',strtotime($rvalue['create_at'])) ; ?></span>
                                </div>
                            </li>
						  <?php 
								}
							 }else{
								echo html_escape($this->common->languageTranslator('ltr_no_blog'));
							} ?>
                    
                        </ul>
                    </div>
					<!-- <div class="sglblog_recent bgshadowradios mb_30">
                        <h4 class="edu_cmntitle mb_30"><?php echo html_escape($this->common->languageTranslator('ltr_blog_news'));?></h4>
                        <ul class="blog_recent_list">
						  <?php if(!empty($recent_blog)){ 
						  foreach($recent_blog as $rvalue){ ?>
                            <li>
                                <div class="blog_thumb">
                                    <a href="<?php echo base_url('/blog/').$rvalue['id']; ?>" >
                                        <img src="<?php echo base_url('/uploads/blog/').$rvalue['image'] ; ?>" alt="image" class="img-fluid">
                                    </a>
                                </div>
                                <div class="blog_content">
                                    <a href="<?php echo base_url('/blog/').$rvalue['id']; ?>"><?php if(!empty($value['title'])){ echo substr(strip_tags($rvalue['title']), 0, 50)  ; } ?></a>
                                    <span><?php echo date('d-m-Y',strtotime($rvalue['create_at'])) ; ?></span>
                                </div>
                            </li>
						  <?php 
								}
							 }else{
								echo html_escape($this->common->languageTranslator('ltr_no_news'));
							} ?>
                    
                        </ul>
                    </div> -->
                    <!-- <div class="sglblog_archive bgshadowradios mb_30">
                        <h4 class="edu_cmntitle mb_30"><?php echo html_escape($this->common->languageTranslator('ltr_archives'));?></h4>
                        <ul class="blog_archive_list">
                            <li>
                            <a href="">
                                <span> <i class="fa fa-caret-right" aria-hidden="true"></i> January</span>
                                <span>2021</span>
                            </a>                            
                            </li>
                            <li>
                            <a href="">
                                <span> <i class="fa fa-caret-right" aria-hidden="true"></i> Fabuary</span>
                                <span>2022</span>
                            </a>                            
                            </li>
                            <li>
                            <a href="">
                                <span> <i class="fa fa-caret-right" aria-hidden="true"></i> March</span>
                                <span>2019</span>
                            </a>                            
                            </li>
                            <li>
                            <a href="">
                                <span> <i class="fa fa-caret-right" aria-hidden="true"></i> May</span>
                                <span>2018</span>
                            </a>                            
                            </li>
                            <li>
                            <a href="">
                                <span> <i class="fa fa-caret-right" aria-hidden="true"></i> April</span>
                                <span>2017</span>
                            </a>                            
                            </li>
                        </ul>
                    </div> -->
                    <div class="sglblog_glry bgshadowradios mb_30">
                        <h4 class="edu_cmntitle mb_30"><?php echo html_escape($this->common->languageTranslator('ltr_gallery'));?></h4>
                        <ul class="blog_glry_list">
						    <?php if(!empty($gallery)){ 
							foreach($gallery as $gvalue){?>
                            <li><a href="<?php echo base_url('gallery'); ?>"> <img src="<?php echo base_url('uploads/gallery/').$gvalue['image'] ;?>" alt="image"></a></li>
							<?php } }else{
								echo html_escape($this->common->languageTranslator('ltr_no_image'));
							} ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>