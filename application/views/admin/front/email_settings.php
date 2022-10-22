<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_siteSetting_wrapper">
	    
			<div class="pxn_admin_informationdiv edu_main_wrapper">
				<form class="pxn_amin form" enctype="multipart/form-data" method="post">
					<div class="edu_site_setting_wrap edu_from_wrapper">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group eb_batchtype">
            						<label><?php echo html_escape($this->common->languageTranslator('ltr_server_type'));?><sup>*</sup></label><br>
        							<div class="form-control">
        								<label><?php echo html_escape($this->common->languageTranslator('ltr_smtp_server'));?></label>
            							<input type="radio" <?php if(!empty($server_type) && $server_type=='smtp'){ echo 'checked'; }else{ echo 'checked'; } ?> class="server_type" name="server_type" value="smtp">
        								<label><?php echo html_escape($this->common->languageTranslator('ltr_server_mail'));?></label>
        								<input type="radio" <?php if(!empty($server_type) && $server_type=='server_mail'){ echo 'checked'; }?> class="server_type" name="server_type" value="server_mail">
        							</div>
            					</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_smtp_host'));?><sup>*</sup></label>
									<input type="text" name="smtp_host" value="<?php if(!empty($smtp_host)){ echo $smtp_host ;} ?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_host'));?>">
								</div>
							</div> 
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_smtp_username'));?><sup>*</sup></label>
									<input type="text" class="form-control require" name="smtp_username" value="<?php if(!empty($smtp_mail)){ echo $smtp_mail ;} ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_smtp_emaila'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_smtp_password'));?><sup>*</sup></label>
									<input type="password" name="smtp_password" value="<?php if(!empty($smtp_pwd)){ echo $smtp_pwd ;} ?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_password'));?>">
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_smtp_port'));?><sup>*</sup></label>
									<input type="text" name="smtp_port" value="<?php if(!empty($smtp_port)){ echo $smtp_port ;} ?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_smtp_port'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group eb_batchtype">
            						<label><?php echo html_escape($this->common->languageTranslator('ltr_smtp_encryption'));?><sup>*</sup></label><br>
        							<div class="form-control">
        								<label><?php echo html_escape($this->common->languageTranslator('ltr_tlc'));?></label>
            							<input type="radio"  class="smtp_encryption" name="smtp_encryption" <?php if(!empty($smtp_encryption) && $smtp_encryption==='tlc'){ echo 'checked'; } ?> value="tlc">
        								<label><?php echo html_escape($this->common->languageTranslator('ltr_ssl'));?></label>
        								<input type="radio" class="smtp_encryption" <?php if(!empty($smtp_encryption) && $smtp_encryption==='ssl'){ echo 'checked'; } ?> name="smtp_encryption" value="ssl">
        							</div>
            					</div>
							</div>
							
							<div class="edu_btn_wrapper">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
									<button type="button" class="btn btn-primary updateEmailDetails"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
									
									<!--<button type="button" class="btn btn-primary updateTestEmailDetails"><?php echo html_escape($this->common->languageTranslator('ltr_test_email'));?></button>-->
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>		
	</div>
</section>