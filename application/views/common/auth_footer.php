<!-- Student Login start-->
<div id="studentLogin" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner text-center">
            <h4 class="edu_admin_title edu_logt_title"></h4>
            <h6 class="edu_admin_sub_title edu_logt_title"><?php echo html_escape($this->common->languageTranslator('ltr_already_logout'));?></h6>
            <input type="hidden" value="<?php echo base_url();?>" id="base_url">
             <button type="button" class="edu_btn changeStudentLogin mb-2" data-id=""><?php echo html_escape($this->common->languageTranslator('ltr_yes'));?></button>
             <button type="button" class="edu_btn edu_btn_black PopupCancelBtn ml-2 mb-2"><?php echo html_escape($this->common->languageTranslator('ltr_cancel'));?></button>
        </div>
    </div>
</div>
<!-- Login end-->
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/login.js?<?php echo time();?>"></script>
    <script src="<?php echo base_url();?>assets/js/valid.js?<?php echo time();?>"></script>
</body>
</html>