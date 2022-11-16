<!-- Pop view characters Start  -->
<div id="charactersViewPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
           <h4 class="edu_sub_title" id="charaTitele"></h4>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group">
                        <div class="charactersViewResult"></div>
                    </div>
				</div>
			</div>
        </div>
    </div>
</div>
<div class="edu_admin_footer hide">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p><?php echo html_escape($this->common->copyrightText); ?></p>
    </div>
</div>

<!-- Logout start-->
<div id="logoutPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner text-center">
            <h4 class="edu_title edu_logt_title padderBottom20"><?php echo html_escape($this->common->languageTranslator('ltr_already_logout'));?></h4>
            <button type="button" class="edu_admin_btn edu_admin_btn_black edu_btn_black edu_btn logoutBtnCncl mb-2"><?php echo html_escape($this->common->languageTranslator('ltr_cancel'));?></button>
            <button type="button" class="edu_admin_btn logOutBtn ml-2 mb-2"><?php echo html_escape($this->common->languageTranslator('ltr_yes'));?></button>
        </div>
    </div>
</div>
<!-- Logout end-->
<!-- live class start-->
<div id="liveclssPopup" class="liveclss_wrap" style="display: block;">
    <div class="liveclss_popup_wrap text-center">
        <div class="liveclss_popup_inner ">
            <h4 class="edu_title padderBottom10"><?php echo html_escape($this->common->languageTranslator('ltr_active_live_class'));?></h4>
            <div class="liveclss_teacher_wrap">
                <div class="liveclss_teacherimg">
                    <img src="" class="img-fluid live_teacher_image" alt="image">
                </div>
                <div class="liveclss_teachername">
                    <h3 class="tname_title"></h3>
                </div>
            </div>
            <h3 class="liveclss_sub"></h3>
            <p class="liveclss_topic"> </p>
            <a href="<?php echo base_url();?>student/start-class/<?php echo $this->session->userdata('batch_id');?>" class="edu_admin_btn liveclss_btn mt-3"><?php echo html_escape($this->common->languageTranslator('ltr_join'));?></a>
        </div>
    </div>
</div>
<!-- live class end-->

   
</div> 
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
<script src="<?php echo base_url();?>assets/js/timepicker/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/summernote.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="<?php echo base_url();?>assets/js/backend.js?<?php echo time();?>"></script>
<script src="<?php echo base_url();?>assets/js/custom.js?<?php echo time();?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>
<script>document.addEventListener('contextmenu', event => event.preventDefault());</script>
</body>
</html>