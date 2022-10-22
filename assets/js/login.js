/*--------------------- Copyright (c) 2020 -----------------------
[Master Javascript]
Project: E Academy
Version: 1.0.0
Assigned to: Theme Forest
-------------------------------------------------------------------*/
(function ($) {
	"use strict";
	/*-----------------------------------------------------
		Function  Start
	-----------------------------------------------------*/
		var Education = {
			initialised: false,
			version: 1.0,
			mobile: false,
			init: function () {
				if (!this.initialised) {
					this.initialised = true;
				} else {
					return;
				}
				/*-----------------------------------------------------
					Function Calling
				-----------------------------------------------------*/
				this.preLoader();
				this.popupFix();
			},

			/*-----------------------------------------------------
				Fix PreLoader
			-----------------------------------------------------*/
			preLoader: function () {
				jQuery(window).on('load', function() {
					jQuery(".edu_preloader").fadeOut();
				});
			},
			
    		
    		/*-----------------------------------------------------
    			Fix Popup Image
    		-----------------------------------------------------*/
    		
    		popupFix: function () {
            	$('.openPopupLink').magnificPopup({
                  type: 'inline',
                  midClick: true,
                  mainClass: 'mfp-fade'
                });
            },
    		
        };

		Education.init();

		/* Login Js */

		$(document).ready(function(){
			$('[data-action="submitThisForm"]').on('click' , function(){
				var targetForm = $(this).closest('form');
				if(!myCustom.checkFormFields(targetForm)){
					myCustom.callFormAjax(targetForm).done(function(res){
						var resp = $.parseJSON(res);
						if(resp.status == 1){
							if(typeof targetForm.attr('data-reset') != 'undefined' && targetForm.attr('data-reset') == 1){ //check reset form data
								targetForm[0].reset();
							}
							if(typeof targetForm.attr('data-redirect') != 'undefined'){ //check reset form data
								if(resp.msg != '')
									toastr.success(resp.msg)
								setTimeout(function(){
									location.href = resp.url;	
								},1500)
							}else if(resp.msg){
								toastr.success(resp.msg);
							}
						}else if(resp.status == 2){
							$.magnificPopup.open({
								items: {
									src: '#studentLogin',
								},
								type: 'inline'
							});
							$('#studentLogin .changeStudentLogin').attr('data-id',resp.student_id);
						}
						else if(resp.status == 0){
							toastr.error((resp.msg)?resp.msg:resp.error);
						}
					});
				}
			});
			
			$(document).keypress('#auth_login',function(event){
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					$('[data-action="submitThisForm"]#auth_login').trigger('click');
				}
			});
		
			$(document).on('click','.PopupCancelBtn',function(){
				$('#studentLogin').find('.mfp-close').trigger('click');
			}); 
		
			$(document).on('click','.changeStudentLogin',function(){
				$.ajax({
					method: "POST",
					url: $('#base_url').val()+'front_ajax/change_student_status',
					data: {'id':$(this).attr('data-id')},
					success: function(resp){
						if(resp == '1'){
							$('[data-action="submitThisForm"]#auth_login').trigger('click');
						}else{
							toastr.error(ltr_something_msg);
						}
					},
					error:function(resp){
						toastr.error(ltr_something_msg);
					}
				});
			}); 
		
		});

})(jQuery);
