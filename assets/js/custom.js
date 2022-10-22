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
				this.fixHeader();
				this.fixMenu();
				this.sideBar();
				this.popupFix();
				this.dropDown();
				this.eduTimePiker();
				this.progressBar();
				this.actionDropdown();
				this.tooltip();
			},

			/*-----------------------------------------------------
				Tooltip
			-----------------------------------------------------*/
			tooltip: function () {
				$(function () {
                  $('[data-toggle="tooltip"]').tooltip()
                })
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
				Fix Sticky Header
			-----------------------------------------------------*/
			fixHeader: function () {
				$(window).scroll(function(){
        			var window_top = $(window).scrollTop() + 1; 
        				if (window_top > 150) {
        					$('.edu_admin_userlogin').addClass('menu_fixed animated fadeInDown');
        					$('.edu_admin_userlogin').css('top', '0px');
        				} else {
        					$('.edu_admin_userlogin').removeClass('menu_fixed animated fadeInDown');
        				}
        		});
			},
			
			
			/*-----------------------------------------------------
				Fix Menu
			-----------------------------------------------------*/
			fixMenu: function () {
				$('.edu_admin_menu ul li').has('.sub-menu').addClass('has_sub_menu');
            	$('.edu_admin_menu >ul >li > a').on('click', function(e){
            		if($(this).hasClass('active_menu')){
            			$('.edu_admin_menu > ul >li a').removeClass('active_menu');
            			$('.edu_admin_menu >ul >li.has_sub_menu').removeClass('active_li');
            			$('.edu_admin_menu > ul >li > ul').slideUp();
            		}else{
            			$('.edu_admin_menu > ul >li a').removeClass('active_menu');
            			$('.edu_admin_menu >ul >li.has_sub_menu').removeClass('active_li');
            			$('.edu_admin_menu > ul >li > ul').slideUp();
            			$(this).addClass('active_menu');
            			$(this).siblings('ul').slideDown();
            			 $(this).parent().addClass('active_li');
            		}
            	});
            	$('.edu_admin_menu >ul >li ul.sub-menu > li > a').on('click', function(e){
            		if($(this).hasClass('active_menu')){
            			$('.edu_admin_menu >ul >li ul.sub-menu > li > a').removeClass('active_menu');
            			$('.edu_admin_menu > ul >li > ul li >ul').slideUp();
            		}else{
            			$('.edu_admin_menu >ul >li ul.sub-menu > li > a').removeClass('active_menu');
            			$('.edu_admin_menu > ul >li > ul li >ul').slideUp();
            			$(this).addClass('active_menu');
            			$(this).siblings('ul').slideDown();
            		}
            	});
			},
			
			/*-----------------------------------------------------
    			Fix Sidebar JS
    		-----------------------------------------------------*/
    		sideBar: function () {
    		    
    		    var w = window.innerWidth;
				if (w >= 1400) {
				    var counter = 0;
                    $('body').addClass('edu_header_closed');
                    $('.edu_header_close').on("click", function(e) {
                    	e.stopPropagation();
                		if (counter == '0') {
                			$('body').addClass('edu_header_closed');
                			$('body').removeClass('edu_header_opened');
                			counter++;
                		} else {
                			$('body').removeClass('edu_header_closed');
                			$('body').addClass('edu_header_opened');
                			counter--;
                		}
                    	
                    });
				}
				if (w <= 1399) {
				    var counter = 0;
				    $('body').addClass('edu_header_opened');
                    $('.edu_header_close').on("click", function(e) {
                    	e.stopPropagation();
                		if (counter == '0') {
                			$('body').removeClass('edu_header_closed');
                			$('body').addClass('edu_header_opened');
                			counter++;
                		} else {
                			$('body').addClass('edu_header_closed');
                			$('body').removeClass('edu_header_opened');
                			counter--;
                		}
                    	
                    });
				}
				
				if (w <= 575) {
				    var srch = 0;
                    $('.edu_srch_btn').on("click", function(){
                    	if( srch == '0') {
                    		$('.edu_searc_box').addClass('edu_searc_show');
                    		$(this).children().removeAttr('class');
                    		$(this).children().attr('class','icofont-close-line');
                    		srch++;
                    	}
                    	else {
                    		$('.edu_searc_box').removeClass('edu_searc_show');
                    		$(this).children().removeAttr('class');
                    		$(this).children().attr('class','icofont-search');
                    		srch--;
                    	}		
                    });
                     $('.edu_searc_box, .edu_srch_btn').on('click',function(event) {
                        event.stopPropagation();
                    });
                    $('body').on("click", function() {
                		if (srch == '1') {
                			$('.edu_searc_box').removeClass('edu_searc_show');
                			srch--;
                		}
                    });
                    
				}
				
    		}, 
    		
    		/*-----------------------------------------------------
    			Fix Upload Image
    		-----------------------------------------------------*/
    		
    		popupFix: function () {
            	$('.openPopupLink').magnificPopup({
                  type: 'inline',
                  midClick: true,
                  mainClass: 'mfp-fade'
                });
            },
    		
    		/*-----------------------------------------------------
    			Fix Admin Fropdown
    		-----------------------------------------------------*/
    		
    		dropDown: function () {
                $('.edu_admin_bar').on("click", function(e) {
                	e.stopPropagation();
            		$(this).siblings('.edu_admin_option').toggleClass('show');
                });
                $('.edu_admin_option').on('click',function(event) {
                    event.stopPropagation();
                });
                $('body').on("click", function() {
            		$('.edu_admin_option').removeClass('show');
                });
            },
			
			/*-----------------------------------------------------
			    Fix Time Piker
    		-----------------------------------------------------*/
    		
    		eduTimePiker: function () {
            	$('.chooseTime').clockpicker({
                    placement: 'top',
                    align: 'left',
            		donetext: 'Done',
            		twelvehour: true,
            		autoclose: false,
            		leadingZeroHours: false,
            		upperCaseAmPm: true,
            		leadingSpaceAmPm: true,
            		afterHourSelect: function() {
            		   $('.clockpicker').clockpicker('realtimeDone');	   
            		},
            		afterMinuteSelect: function() {
            		   $('.clockpicker').clockpicker('realtimeDone');
            		},
            		afterAmPmSelect: function() {
            		   $('.clockpicker').clockpicker('realtimeDone');
            		}
				});
				
				$('.chooseBtmTime').clockpicker({
                    placement: 'bottom',
                    align: 'left',
            		donetext: 'Done',
            		twelvehour: true,
            		autoclose: false,
            		leadingZeroHours: false,
            		upperCaseAmPm: true,
            		leadingSpaceAmPm: true,
            		afterHourSelect: function() {
            		   $('.clockpicker').clockpicker('realtimeDone');	   
            		},
            		afterMinuteSelect: function() {
            		   $('.clockpicker').clockpicker('realtimeDone');
            		},
            		afterAmPmSelect: function() {
            		   $('.clockpicker').clockpicker('realtimeDone');
            		}
            	});

            },
            
            /*-----------------------------------------------------
				Fix Progress Bar
			-----------------------------------------------------*/
			progressBar: function () {
				
			

			},
			
			/*-----------------------------------------------------
    			action Dropdown
    		-----------------------------------------------------*/
    		actionDropdown: function () {
				$(document).on('click','.tbl_action_drop', function(e){
					$('.tbl_action_drop').removeClass('tbl_action_drop_open');
                    $(this).toggleClass('tbl_action_drop_open');
                     e.stopPropagation();
                });
                $(document).on('click','body', function(){ 
                    $('.tbl_action_drop').removeClass('tbl_action_drop_open');
                });
            },

        };

		Education.init();
		
		
    	
		/*-----------------------------------------------------
			Fix Frontend settings
		-----------------------------------------------------*/

		/*  Frontend settings js */

		$(document).ready(function(){
			toastr.clear();
			toastr.options = {
				"debug": false,
				"positionClass": "toast-top-right",
				"onclick": null,
				"fadeIn": 300,
				"fadeOut": 1000,
				"timeOut": 5000,
				"extendedTimeOut": 1000
			}

			/* select2*/
			
			$(".edu_selectbox_without_search").each(function() {
				$(this).select2({
					placeholder: $(this).attr("data-placeholder"),
					width: '100%',
					minimumResultsForSearch: -1,
				});
			});

			$(".edu_selectbox_with_search").each(function() {
				$(this).select2({
					placeholder: $(this).attr("data-placeholder"),
					width: '100%'
				});
				$('.select2-search__field').css('width', '100%');
			});


			$('.updateSiteDetails').on('click', function(){
				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));			
				if(valid_check == 'valid'){
					ajax_function(formdata,base_url+'front_ajax/site_settings');
				}
			});
			
			$('.updatePayment').on('click', function(){
				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));			
				if(valid_check == 'valid'){
					ajax_function(formdata,base_url+'front_ajax/payment_settings');
				}
			});

			$('.updateDetails').on('click', function(){
				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));			
				if(valid_check == 'valid'){
					ajax_function(formdata,base_url+$(this).attr('data-url'));
				}
			});
			
			$('.languageDetails').on('click', function(){
				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));			
				if(valid_check == 'valid'){
					ajax_function(formdata,base_url+'front_ajax/language_settings');
				}
			});
	
			function ajax_function(formdata,url){
				$('.edu_preloader').css('background-color','rgba(255,255,255,0.80)').css('display','block');
				$.ajax({
					method: "POST",
					url: url,
					data: formdata,
					processData: false, 
					contentType: false,
					success: function(resp){
						var resp = $.parseJSON(resp);
						if(resp['status'] == '1'){
							toastr.success(resp['msg']);
							location.reload();
						}else if(resp['status'] == '2'){
							toastr.error(resp['msg']);
						}else{
							toastr.error(ltr_something_msg);
						}
						$('.edu_preloader').fadeOut();
					},
					error:function(resp){
						toastr.error(ltr_something_msg);
						$('.edu_preloader').fadeOut();
					}
				});
			}

			$('.addNewRow').on('click',function(){
				var optionArr = $.parseJSON($('.studentArrayDiv').html());
				var options = '<option value="">'+ltr_select_student+'</option>';
				
				if(($(this).attr('data-type') == 'selection') || ($(this).attr('data-type') == 'testimonial')){
				    if(optionArr.length){
    					var i;
    					for (i = 0; i < optionArr.length; ++i) {
    						options += '<option value="'+optionArr[i]['id']+'">'+optionArr[i]['name']+'</option>';
    					}
    				}
				}else{
    				if(optionArr.length){
    					var i;
    					for (i = 0; i < optionArr.length; ++i) {
    						options += '<option value="'+optionArr[i]['name']+'--'+optionArr[i]['image']+'">'+optionArr[i]['name']+'</option>';
    					}
    				}
				}
				if($(this).attr('data-type') == 'selection'){
                    
					var appendHtml = '<div class="parentRow"><div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-12"><div class="form-group"><select name="select_stud[]" class="form-control require edu_selectbox_with_search" data-placeholder="'+ltr_select_student+'">'+options+'</select></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-12"><div class="form-group edu_delet_icon_input"><input type="text" class="form-control require" name="select_desc[]" value="" placeholder="'+ltr_enter_position+'"><div class="edu_detele_row_wrapper"><i class="icofont-ui-delete removeRow" title="Remove"></i></div></div></div></div></div>';

					$(this).closest('.parentFormWrappr').find('.parentRow:first').before(appendHtml);
					$(this).closest('.parentFormWrappr').find('.parentRow:first select').select2({
						placeholder: $(this).attr("data-placeholder"),
						width: '100%'
					});
				}else if($(this).attr('data-type') == 'testimonial'){
					var appendHtml = '<div class="parentRow"><div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-12"><div class="form-group"><select name="testi_stud[]" class="form-control require edu_selectbox_with_search" data-placeholder="'+ltr_select_student+'">'+options+'</select></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-12"><div class="form-group edu_delet_icon_input"><input type="text" class="form-control require" name="testi_desc[]" value="" placeholder="'+ltr_description+'"><div class="edu_detele_row_wrapper"><i class="icofont-ui-delete removeRow" title="Remove"></i></div></div></div></div></div>';

					$(this).closest('.parentFormWrappr').find('.parentRow:first').before(appendHtml);
					$(this).closest('.parentFormWrappr').find('.parentRow:first select').select2({
						placeholder: $(this).attr("data-placeholder"),
						width: '100%'
					});
				}else{
					$(this).closest('.parentFormWrappr').find('.parentRow:first').before($(this).closest('.parentFormWrappr').find('.parentRow:first')[0].outerHTML);
					$(this).closest('.parentFormWrappr').find('.parentRow:first select').select2();
					$(this).closest('.parentFormWrappr').find('.parentRow:first input').val('');
					$(this).closest('.parentFormWrappr').find('.parentRow:first textarea').val('');
					$(this).closest('.parentFormWrappr').find('.parentRow:first .edu_prev_img').html('');
					$(this).closest('.parentFormWrappr').find('.parentRow:first .fileNameShow').html('')
				}
				
			});
			
			$(document).on('click','.removeRow',function(){
			    if($(this).closest('.parentFormWrappr').find('.parentRow').length == 1){
			        toastr.error(ltr_can_remove_msg);
			        return false;
			    }else{
			        $(this).closest('.parentRow').remove();
			    }
			});
			
			$(document).on('click','.edu_question_options ol li label input',function () {
				$('.edu_question_options ol li label input:not(:checked)').parent().removeClass("selected");
				$('.edu_question_options ol li label input:checked').parent().addClass("selected");
			});   
	
			function validate_form(target){
				var check = 'valid';
				target.find('input , textarea , select').each(function(){
					var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/; 
					var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
					var websiteUrl = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;
					var image = /\.(jpe?g|gif|png|PNG|svg|SVG|JPE?G)$/;
					var mobile =  /((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/;
					var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
					var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
					var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
					var number = /^[\s()+-]*([0-9][\s()+-]*){1,20}$/; 
					var password = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#])[A-Za-z\d$@$!%*?&#]{8,}$/;
					var pdfimage = /\.(pdf|PDF)$/;
					var float_num = /^[-+]?[0-9]+\.[0-9]+$/;
					var TagReg = /[<>`;&=+/()|^%*+]/g;
		
					if($(this).hasClass('require')){
		
						if((typeof $(this).val() == 'object' && isEmpty($(this).val()) == true) || (typeof $(this).val() != 'object' && $(this).val().trim() == '')){ 
							toastr.error(ltr_some_required);
							$(this).addClass('error').focus();
							check = 'novalid';
							return false; 
						}else{
							$(this).removeClass('error');
							check = 'valid';
						} 
					}
		
					if((typeof $(this).val() == 'object' && isEmpty($(this).val()) == true) || (typeof $(this).val() != 'object' && $(this).val().trim() != '')){
						var valid = $(this).attr('data-valid'); 				
						if(typeof valid != 'undefined'){
							if(!eval(valid).test($(this).val().trim())){
								$(this).addClass('error').focus();
								toastr.error($(this).attr('data-error'));
								check = 'novalid';
								return false; 
							}else{
								$(this).removeClass('error');
								check = 'valid';
							}
						}
					}
					
					if($(this).attr('data-symb') != 'no'){
    					if(($(this).attr('type') != 'file') && TagReg.test($(this).val()) == true) {
    						$(this).addClass('error').focus();
    						toastr.error(ltr_only_letters_msg);
    						check = 'novalid';
    						return false;
    					}else{
    						$(this).removeClass('error');
    						check = 'valid';
    					}
					}
					
				});
				return check;
			}
		});

		/*  Frontend settings js */

})(jQuery);


/*  Fix PRogress bar  */
var forEach = function (array, callback, scope) {
	for (var i = 0; i < array.length; i++) {
		callback.call(scope, i, array[i]);
	}
};
window.onload = function(){
	var max = -219.99078369140625;
	forEach(document.querySelectorAll('.edu_progress'), function (index, value) {
	percent = value.getAttribute('data-progress');
		value.querySelector('.fill').setAttribute('style', 'stroke-dashoffset: ' + ((100 - percent) / 100) * max);
		var datacount = 0;
		for(var i=0; i<=percent; i++){
			datacount = i;
		}
		value.querySelector('.value').innerHTML = datacount + '';
	});
}


  


