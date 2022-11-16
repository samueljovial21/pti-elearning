<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_profile_page">
		<div class="col-lg-8 col-md-10 col-sm-12 col-12 offset-lg-2 offset-md-1">
    		<div class="edu_main_wrapper">
        		<div class="edu_admin_informationdiv sectionHolder">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_update_profile'));?></h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_name'));?><sup>*</sup></label>
                                    <input type="text" class="form-control username" name="name" value="<?php echo html_escape($this->session->userdata('name'));?>">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_email'));?></label>
                                    <input type="text" class="form-control" name="email" value="<?php echo html_escape($this->session->userdata('email'));?>" readonly>
                                </div>
                            </div> 
                            <?php
                            if($this->session->userdata('role')=='student'){
                              $batch_id =  $this->session->userdata('batch_id');
							$batchDetls = $this->db_model->select_data('batch_name','batches use index (id)',array('id'=>$batch_id));
							if(!empty($batchDetls)){
								$batchName = $batchDetls[0]['batch_name'];
							}else{
								$batchName = '';
							}
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_batch_name'));?></label>
                                    <input type="text" class="form-control" name="batch_name" value="<?php echo html_escape($batchName);?>" readonly>
                                </div>
                            </div> 
                            <?php } ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group edu_file_upload">
                                    <label for="file"><?php echo html_escape($this->common->languageTranslator('ltr_profile_image'));?></label>
                                    <input type="file" name="image" value="" id="file">
                                    <p class="fileNameShow"></p>
                                </div>
                            </div>   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <a class="openPassFld hidedfld" href="javascript:void(0)"><?php echo html_escape($this->common->languageTranslator('ltr_change_password'));?></a>
                                </div>
                            </div> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 passwordFields">
                                <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_new_password'));?></label>
                                    <input type="Password" class="form-control" name="password" id="newPasswrd">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 passwordFields">
                                <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_re_password'));?></label>
                                    <input type="Password" class="form-control" id="reNewPasswrd">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="edu_btn_wrapper padderTop10">
                                    <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_update'));?>" class="updateTeachrStudProfile edu_admin_btn">
                                </div>
                            </div> 
                        </div>
                    </form>
        		</div>
        	</div>
    	</div>
	</div>
</section> 
