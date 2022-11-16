<div class="pxn_login_main">
    <div class="pxn_login_box">
        <div class="pxn_login_box_inner">
            <div class="pxn_logo">
                <img src="<?php echo base_url();?>assets/images/logo.png" class="img-fluid">
            </div>
            <div class="pxn_login_data">
                <h4><?php echo html_escape($this->common->languageTranslator('ltr_forgot_password'));?></h4>
                <form class="form" method="post" action="<?php echo base_url().'front_ajax/reset_password'; ?>" data-redirect="yes" id="forgotForm">
                    <div class="edu_field_holder">
                        <input type="text" class="edu_form_field require" name="email" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_email_address'));?>" autocomplete="off" data-valid="email" data-error="Please enter a valid email address.">
                    </div>
                    <div class="login_btn_wrapper">
                        <div class="row align-items-center">
                             <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="backToHome"><a class="edu_btn edu_btn_black" href="<?php echo base_url('login');?>"><?php echo html_escape($this->common->languageTranslator('ltr_back_to_login'));?></a></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-md-right">
                                <div class="forgot_submit_btn">
                                    <button class="edu_btn" id="auth_forgot" type="button" data-action="submitThisForm"><?php echo html_escape($this->common->languageTranslator('ltr_submit'));?></button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
</div>  