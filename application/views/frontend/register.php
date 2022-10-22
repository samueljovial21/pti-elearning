<div class="pxn_login_main">
    <div class="pxn_login_box">
        <div class="pxn_login_box_inner">
            <div class="pxn_logo">
                <img src="<?php echo base_url();?>assets/images/logo.png" class="img-fluid">
            </div>
            <div class="pxn_login_data">
                <h4><?php echo html_escape($this->common->languageTranslator('ltr_p_register_continue'));?></h4>
                <form class="form" method="post" action="<?php echo base_url().'front_ajax/register'; ?>" data-redirect="yes">
                    <div class="edu_field_holder">
                        <input type="text" name="name" class="require edu_form_field" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_name'));?>">
                    </div>
                    <div class="edu_field_holder">
                        <input type="text" class="edu_form_field require" name="email" data-valid="email" data-error="Please enter a valid email address." placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_email'));?>" autocomplete="off">
                    </div>
                    <div class="edu_field_holder">
                        <input type="text" name="mobile" class="require edu_form_field" data-valid="mobile" data-error="Please enter a valid contact number." placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_mobile'));?>">
                    </div>
                    
                    <div class="login_btn_wrapper">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                               
                                <p class="edu-register-account"><?php echo html_escape($this->common->languageTranslator('ltr_already_account'));?><span><a href="<?php echo base_url().'home/login';?>"> <?php echo html_escape($this->common->languageTranslator('ltr_login_now'));?></a></span></p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-md-right">
                                <button class="edu_btn edu_btn_black" id="auth_login" type="button" data-action="submitThisForm"><?php echo html_escape($this->common->languageTranslator('ltr_register'));?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    