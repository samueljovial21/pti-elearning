/*--------------------- Copyright (c) 2020 -----------------------
[Master Javascript]
Project: Education E Acadamy
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
				this.searchSlider();
				this.homeBannerSlider();
				this.wowAnimation();
				this.counter();
				this.tiltAnimation();
				this.StickyHeader();
				this.navMenu();
				this.focusText();
				this.selectionSlider();
				this.popupVideo();
				this.TeamSlider();
				this.TestimonialSlider();
				this.partner();
				this.topButton();
				this.popupGallery();
				
				
				
			},

			/*-----------------------------------------------------
				Fix PreLoader
			-----------------------------------------------------*/
			preLoader: function () {
				jQuery(window).on('load', function() {
					jQuery(".edu_preloader").fadeOut();
				});
			},

                // search slider start
                searchSlider: function () {
    				var selectionSliderSwiper = new Swiper('.edu-course-search-slider .swiper-container', {
    					autoplay: true,
    					spaceBetween: 30,
    					slidesPerView: 4,
    					loop: true,
    					speed: 2000,
    					autoplay: {
    						delay: 3000,
    					},
    					navigation: {
    						nextEl: ".ButtonNext",
    						prevEl: ".ButtonPrev"
    					},
    					breakpoints: {
    						0: {
    							slidesPerView: 1,
    							spaceBetween: 20,
    						},
    						575: {
    							slidesPerView: 1,
    							spaceBetween: 20,
    						},
    						767: {
    							slidesPerView: 2,
    							spaceBetween: 20,
    						},
    						992: {
    							slidesPerView: 3,
    							spaceBetween: 20,
    						},
    						1200: {
    							slidesPerView: 4,
    							spaceBetween: 30,
    						},
    					},
    				});
    			},
                // search slider end

			/*-----------------------------------------------------
				Fix Banner Slider
			-----------------------------------------------------*/
			homeBannerSlider: function () {
				var swiperOptions = {
					loop: true,
					speed: 1500,
					autoHeight: false,
					grabCursor: true,
					SlidesPerView: 3,
					watchSlidesProgress: true,
					mousewheelControl: true,
					keyboardControl: true,
					navigation: {
						nextEl: ".ButtonNext",
						prevEl: ".ButtonPrev"
					},
					autoplay: {
						delay: 3000,
					},
					fadeEffect: {
						crossFade: true
					},
				};
				var swiper = new Swiper(".homeBannerSlider", swiperOptions);
			},
			
			/*-----------------------------------------------------
				Fix Animation 
			-----------------------------------------------------*/
			wowAnimation: function () {
				new WOW().init();
			},

			/*-----------------------------------------------------
				Fix Counter
			-----------------------------------------------------*/
			counter: function () {
				$('.counter_item').appear(function () {
					$('.count_no').countTo();
				});
			},

			/*-----------------------------------------------------
				Fix Image Animation
			-----------------------------------------------------*/
			tiltAnimation: function () {
				var tiltAnimation = $('.parallax')
				if (tiltAnimation.length) {
					tiltAnimation.tilt({
						max: 12,
						speed: 1e3,
						easing: 'cubic-bezier(.03,.98,.52,.99)',
						transition: !1,
						perspective: 1e3,
						scale: 1
					})
				}
			},

			/*-----------------------------------------------------
				Fix  Sticky Header
			-----------------------------------------------------*/
			StickyHeader: function () {
				var header = $(".edu_header_wrapper");
				$(window).scroll(function() {
					var scroll = $(window).scrollTop();
					if (scroll >= 100 && $(this).width() > 769) {
						header.addClass("navbar-fixed-top animated fadeInDown");
					} else {
						header.removeClass('navbar-fixed-top animated fadeInDown');
					}
				});
			},

			/*-----------------------------------------------------
				Fix Mobile Menu 
			-----------------------------------------------------*/
			navMenu: function () {
			    var w = window.innerWidth;
                    if (w <= 991) {
        				$(".main_menu_wrapper>ul li").on('click', function () {
        					$(this).find('ul.sub_menu').slideToggle();
        					$(this).toggleClass("open");
        				});
        				$(".main_menu_wrapper>ul").on('click', function () {
        					event.stopPropagation();
        				});
        				$(".menu_btn").on('click', function (e) {
        					event.stopPropagation();
        					$(".main_menu_wrapper, .menu_btn_wrap").toggleClass("open");
        				});
        				$("body").on('click', function () {
        					$(".main_menu_wrapper, .menu_btn_wrap").removeClass("open");
        				});
                    }
			},

			/*-----------------------------------------------------
				Fix  On focus Placeholder
			-----------------------------------------------------*/
			focusText: function () {
				var place = '';
				$('input,textarea').focus(function () {
					place = $(this).attr('placeholder');
					$(this).attr('placeholder', '');
				}).blur(function () {
					$(this).attr('placeholder', place);
				});
			},

			/*-----------------------------------------------------
				Fix Selection Slider 
			-----------------------------------------------------*/
			selectionSlider: function () {
				var selectionSliderSwiper = new Swiper('.selectionSlider.swiper-container', {
					autoHeight: false,
					autoplay: true,
					spaceBetween: 30,
					slidesPerView: 1,
					loop: true,
					speed: 2000,
					centeredSlides: false,
					autoplay: {
						delay: 3000,
					},
					pagination: {
						el: '.swiperPagination',
						clickable: true,
					},
				});
			},

			/*-----------------------------------------------------
				Fix Tour Video Popup
			-----------------------------------------------------*/
			popupVideo: function () {
				$('.popupVideo').magnificPopup({
					type: 'iframe'
				});
			},
				
			/*-----------------------------------------------------
				Fix Team Slider 
			-----------------------------------------------------*/
			TeamSlider: function () {
				var TeamSwiper = new Swiper('.team_slider.swiper-container,.edu-course-slider .swiper-container', {
					autoHeight: false,
					autoplay: true,
					spaceBetween: 30,
					slidesPerView: 4,
					loop: true,
					speed: 1000,
					speed: 2000,
					centeredSlides: false,
					autoplay: {
						delay: 3000,
					},
					pagination: {
						el: '.swiperTeamPagination',
						clickable: true,
					},
					breakpoints: {
						0: {
							slidesPerView: 1,
							spaceBetween: 20,
						},
						575: {
							slidesPerView: 1,
							spaceBetween: 20,
						},
						767: {
							slidesPerView: 2,
							spaceBetween: 20,
						},
						992: {
							slidesPerView: 3,
							spaceBetween: 20,
						},
						1200: {
							slidesPerView: 4,
							spaceBetween: 30,
						},
					},
				});
			},

			/*-----------------------------------------------------
				Fix Testimonial Slider 
			-----------------------------------------------------*/
			TestimonialSlider: function () {
				var TestimonialSwiper = new Swiper('.testimonial_slider.swiper-container', {
					autoHeight: false,
					autoplay: true,
					autoplay: {
						delay: 2000,
					},
					speed: 2000,
					spaceBetween: 30,
					slidesPerView: 1,
					loop: true,
					speed: 1000,
					centeredSlides: false,
					pagination: {
						el: '.swiperTestimonialPagination',
						clickable: true,
					},
				});
			},

			/*-----------------------------------------------------
				Fix Partner Slider 
			-----------------------------------------------------*/
			partner: function () {
				var PartnerSwiper = new Swiper('.partner_slider.swiper-container', {
					autoHeight: false,
					autoplay: true,
					spaceBetween: 30,
					slidesPerView: 6,
					loop: true,
					speed: 2000,
					autoplay: {
						delay: 1000,
					},
					breakpoints: {
						0: {
							slidesPerView: 2,
							spaceBetween: 0,
						},
						575: {
							slidesPerView: 2,
							spaceBetween: 10,
						},
						767: {
							slidesPerView: 4,
							spaceBetween: 20,
						},
						992: {
							slidesPerView: 6,
							spaceBetween: 20,
						},
						1200: {
							slidesPerView: 6,
							spaceBetween: 30,
						},
					},
				});
			},

			/*-----------------------------------------------------
				Fix GoToTopButton
			-----------------------------------------------------*/
			topButton: function () {
				var scrollTop = $("#scroll");
				$(window).on('scroll', function () {
					if ($(this).scrollTop() < 500) {
						scrollTop.removeClass("active");
					} else {
						scrollTop.addClass("active");
					}
				});
				$('#scroll').on('click',function () {
					$("html, body").animate({
						scrollTop: 0
					}, 2000);
					return false;
				});
			},

			/*-----------------------------------------------------
				Fix Gallery Magnific Popup
			-----------------------------------------------------*/
			popupGallery: function () {
				jQuery(document).ready(function(){
					$('.popup_gallery').magnificPopup({
						delegate: 'a',
						type: 'image',
						tLoading: 'Loading image #%curr%...',
						mainClass: 'mfp-img-mobile',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function(item) {
								return item.el.attr('title') + '<small></small>';
							}
						}
					});
				});
			},

					

        };

		Education.init();

		/*  Contact form js */

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

			var cur_url = $(location).attr("href");
			if(cur_url.includes("blog")){
				//console.log();
				cur_url=base_url+'blog'
				$('.edu_nav_items ul li a').removeClass('active');
				$('.edu_nav_items ul li a[href="'+cur_url+'"]').addClass('active').closest('.has_submenu').find('a').addClass('active');
			}else{
				$('.edu_nav_items ul li a').removeClass('active');
				$('.edu_nav_items ul li a[href="'+cur_url+'"]').addClass('active').closest('.has_submenu').find('a').addClass('active');
			}

			$('.enquiryFormSubmit').on('click', function(){
				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));	
				var form = $(this).closest('form');	
				if(valid_check == 'valid'){
					$.ajax({
						method: "POST",
						url: $('#baseUrlId').val()+'front_ajax/enquiry_form',
						data: formdata,
						processData: false, 
						contentType: false,
						success: function(resp){
							var resp = $.parseJSON(resp);
							if(resp['status'] == '1'){
								toastr.success(resp['msg']);
								form.trigger('reset');
							}else{
								toastr.error(ltr_something_msg);
							}
						},
						error:function(resp){
							toastr.error(ltr_something_msg);
						}
					});
				}
			});
			
			$('.commentFormSubmit').on('click', function(){

				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));	
				var form = $(this).closest('form');	
				if(valid_check == 'valid'){
					$.ajax({
						method: "POST",
						url: $('#baseUrlId').val()+'front_ajax/comment_form',
						data: formdata,
						processData: false, 
						contentType: false,
						success: function(resp){
							var resp = $.parseJSON(resp);
							if(resp['status'] == '1'){
								toastr.success(resp['msg']);
								form.trigger('reset');
								setTimeout(function(){ location.reload(); }, 2000);
							}else{
								toastr.error(ltr_something_msg);
							}
						},
						error:function(resp){
							toastr.error(ltr_something_msg);
						}
					});
				}
			});
			$('.replyForm').on('click', function(){
				var id = $(this).attr('data-id');	
				var ses = $(this).attr('data-ses');
				var name = $(this).attr('data-name');
				var email = $(this).attr('data-email');
				$(".removetHtml").html("");
				if(ses==0){
					var formHtml = '<form method="post">								<input type="hidden" value="'+id+'" name="comment_id" >								<div class="row">									<div class="col-lg-6 col-md-6 col-sm-12 col-12">										<div class="edu_field_holder">											<input type="text" class="edu_form_field require" placeholder="'+ltr_enter_your_name+ '*" name="name">										</div>									</div>									<div class="col-lg-6 col-md-6 col-sm-12 col-12">										<div class="edu_field_holder">											<input type="text" class="edu_form_field require" placeholder="'+ltr_enter_your_email+'*" data-valid="email" data-error="'+ltr_valid_enter_your_email+'" name="email">										</div>								</div>									<div class="col-lg-12 col-md-12 col-sm-12 col-12">										<div class="edu_field_holder">											<input type="text" class="edu_form_field require" placeholder="'+ltr_enter_your_phone+' *" data-valid="mobile" data-error="'+ltr_valid_enter_your_phone+'" name="mobile" maxlength="12">										</div>									</div>									<div class="col-lg-12 col-md-12 col-sm-12 col-12">										<div class="edu_field_holder">											<textarea placeholder="'+ltr_enter_your_message+'*" class="edu_form_field require" name="message"></textarea>										</div>									</div>									<div class="col-lg-12 col-md-12 col-sm-12 col-12">										<button type="button" class="edu_btn FormSubmitReply">'+ltr_send+'</button>									</div>								</div>							</form>';
				}else{
					var formHtml = '<form method="post">								<input type="hidden" value="'+id+'" name="comment_id" >					<input type="hidden"  name="name" value="'+name+'" >					<input type="hidden" value="'+email+'" name="email" >							<div class="row">																										<div class="col-lg-12 col-md-12 col-sm-12 col-12">										<div class="edu_field_holder">											<textarea placeholder="'+ltr_enter_your_message+'*" class="edu_form_field require" name="message"></textarea>										</div>									</div>									<div class="col-lg-12 col-md-12 col-sm-12 col-12">										<button type="button" class="edu_btn FormSubmitReply">'+ltr_send+'</button>									</div>								</div>							</form>';
				}
				
				$('#reply_form'+id).html(formHtml);
			});
			$(".removetHtml").on("click",".FormSubmitReply", function(){
				 var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));	
				var form = $(this).closest('form');	
				if(valid_check == 'valid'){
					$.ajax({
						method: "POST",
						url: $('#baseUrlId').val()+'front_ajax/comment_form_reply',
						data: formdata,
						processData: false, 
						contentType: false,
						success: function(resp){
							var resp = $.parseJSON(resp);
							if(resp['status'] == '1'){
								toastr.success(resp['msg']);
								form.trigger('reset');
								setTimeout(function(){ location.reload(); }, 2000);
								
							}else{
								toastr.error(ltr_something_msg);
							}
						},
						error:function(resp){
							toastr.error(ltr_something_msg);
						}
					});
				}
			});
			$(document).keypress('.enrollNowSubmit',function(event){
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					$('.enrollNowSubmit').trigger('click');
				}
			});
			$('.enrollNowSubmit').on('click', function(){
				var formdata = new FormData($(this).closest('form')[0]);
				var valid_check = validate_form($(this).closest('form'));	
				var form = $(this).closest('form');	
				if(valid_check == 'valid'){
					$('.edu_preloader').css('background-color','rgba(255,255,255,0.80)').css('display','block');
					$.ajax({
						method: "POST",
						url: $('#baseUrlId').val()+'front_ajax/enroll_check',
						data: formdata,
						processData: false, 
						contentType: false,
						success: function(resp){
							var resp = $.parseJSON(resp);
							if(resp['status'] == '1'){
								if(resp['payment_type']==1){
									$('.edu_preloader').fadeOut();
									var data  = resp['data'];
									razorpay_form(data['amount'],data['batchId'],data['name'],data['email'],data['mobile'],data['currency']);
								}else{
									window.setTimeout(function() {
										window.location.href = resp['url'];
									}, 1000);
								}
								
							}else if(resp['status'] == '2'){
								window.setTimeout(function() {
									window.location.href = base_url + 'success';
								}, 1000);
							}else{
								toastr.error(resp['msg']);
							}
							$('.edu_preloader').fadeOut();
						},
						error:function(resp){
							toastr.error(ltr_something_msg);
							$('.edu_preloader').fadeOut();
						}
					});
				}
			});
			
			function razorpay_form(totalAmount,product_id,name,email,mobile,currency){
				
				var options = {
					"key": rzp_key,
					"amount": totalAmount*100, // 2000 paise = INR 20
					"name": name,
					"image": site_logo,
					"currency":currency,
					"handler": function (response){
						
						$.ajax({
							url: base_url + 'front_ajax/razorPaySuccess',
							type: 'post',
							dataType: 'json',
							data: {
								razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id, name : name, email :email, mobile :mobile
							}, 
							success: function (msg) {
							    
								window.location.href = base_url + 'success';
							}
						});
					},
					"theme": {
					"color": "#528FF0"
					}, "prefill": {
                		"name": name,
                		"email": email,
                		"contact": mobile
                	},
				};
				var rzp1 = new Razorpay(options);
				rzp1.open();
				//e.preventDefault();
			};

			$(document).on('click', '.loadMoreGallery', function(){		
				var limit = $(this).attr('data-limit');		
				var type = $(this).attr('data-type');		
				$.ajax({
					method: "POST",
					url: $('#baseUrlId').val()+'front_ajax/load_moreGallery',
					data: {'limit':limit,'type':type},
					success: function(resp){
						var resp = $.parseJSON(resp);
						if(resp['status'] == '1'){
							if(resp['html'] != ''){
								if($('.popup_gallery').length){
									$('.popup_gallery').prepend(resp['html']);
									$('.loadMoreGallery').attr('data-limit',$('.popup_gallery .edu_porfolio_section').length);
								}else{
									$('.videoP_gallery').prepend(resp['html']);
									$('.loadMoreGallery').attr('data-limit',$('.edu_videoGallery_wrapper .edu_videoGallery_section').length);
								}
							}
							else
								$('.loadMoreGallery').addClass('hide');
						}else{
							toastr.error(ltr_something_msg);
						}
					},
					error:function(resp){
						toastr.error(ltr_something_msg);
					}
				});
			});
	
			function validate_form(target){
				var check = 'valid';
				target.find('input , textarea , select').each(function(){
					var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/; 
					var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
					var websiteUrl = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;
					var image = /\.(jpe?g|gif|png|PNG|JPE?G)$/;
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

		//prevent to run script
		$(document).on("paste", "input,textarea", function(e) {
			e.preventDefault();
			var pasteText = e.originalEvent.clipboardData.getData("text/plain");
			document.execCommand("insertHTML", !1, pasteText);
		});

		/*  Contact form js */

		function parseVideoold(url) {
		    url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
				if (RegExp.$3.indexOf('youtu') > -1) {
				var YregEx = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
				var Ymatch = url.match(YregEx);
					if(Ymatch != null && Ymatch[0].indexOf('youtu') > -1){
						var src='https://www.youtube.com/embed/'+Ymatch[2];
					}
				}else if (RegExp.$3.indexOf('vimeo') > -1) {
		        	var src='https://player.vimeo.com/video/'+ RegExp.$6;
		    	}else{
		    		var src=url;
		    	}
				return src;
		}
		function parseVideo(url,type) {
		    if(type=="youtube"){
		    	var YregEx = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
				var Ymatch = url.match(YregEx);
				if(Ymatch != null && Ymatch[0].indexOf('youtu') > -1){
					var src='https://www.youtube.com/embed/'+Ymatch[2];
				}
		    }else if(type=="vimeo"){
		    	url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
		    	var src='https://player.vimeo.com/video/'+ RegExp.$6;
		    }else if(type=="dropbox"){
		    	var src = url.replace("dropbox.com", "dl.dropboxusercontent.com");
		    }else if(type=="drive"){
		    	var src = url.replace("view?usp=sharing", "preview");
		    }else{
		    	var src=url;
		    }
			return src;
	   
		}

		$(document).on('click','.viewVideoCourse',function(){
			var src = parseVideo($(this).attr('data-url'),$(this).attr('data-type'));
			var desc = $(this).attr("data-desc");

			console.log(src);
			var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><iframe width="100%" width="500" height="350" src="'+src+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span>'+desc+'</span></div>';
			$('#view_video_popup .videoIframeShow').html(html);
			$.magnificPopup.open({
				items: {
					src: '#view_video_popup',
				},
				type: 'inline'
			});
		
			$('#view_video_popup #viewVideoTopic').html($(this).attr('data-title'));
		});

	$(document).on('click','.mfp-close',function(){
		$('.videoIframeShow iframe').remove();
		$('#viewVideoTopic').text();
		
	});
	
	$('.cnfmlogOutBtn').on('click',function(){
	    $.magnificPopup.open({
			items: {
				src: '#logoutPopup',
			},
			type: 'inline'
		});
	});
	
	$('.logOutBtn, .logoutBtnCncl').on('click',function(){
	    if($(this).hasClass('logOutBtn')){
	        window.location.href = base_url+"front_ajax/logout";
	    }
	    $('#logoutPopup').find('.mfp-close').trigger('click');
	});


      /* View video */

	$(document).on('click','.viewVideo',function(){
		var src = parseVideo($(this).attr('data-url'),$(this).attr('data-type'));
		var desc = $(this).attr("data-desc");

		console.log(src);
		var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><iframe width="100%" width="500" height="350" src="'+src+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span>'+desc+'</span></div>';
		$('#view_video_popup .videoIframeShow').html(html);
		$.magnificPopup.open({
			items: {
				src: '#view_video_popup',
			},
			type: 'inline'
		});
		$('#view_video_popup #viewVideoTopic').html($(this).closest('tr').find('td:eq(2)').text());
		$('#view_video_popup #viewVideoTitle').html($(this).closest('tr').find('td:eq(1)').text());
	});
	

    $(document).on('click','#search_button', function(){
            var course = $('#search_field').val();
            	$.ajax({
					method: "POST",
					url: base_url +'front_ajax/search_batch',
					data: {'course_name':course},
					success: function(resp){
					  var resp = $.parseJSON(resp);
            			    $('#search_data_course').html(resp.data);
				
					},
					error:function(resp){
						toastr.error(ltr_something_msg);
					}
				});
       
    });
    
      $(document).ready(function(){
    $(".video").click(function(){
      $(".autoPlayoffvideo")[0].src += "?autoplay=0";
     });
});

$(document).on('click','#singleCatData', function(e){
            var id = $(this).attr('data-id');
            
                $.ajax({
					method: "POST",
					url: base_url +'front_ajax/search_singleCatData',
					data: {'id':id},
					success: function(resp){
					  var resp = $.parseJSON(resp);
            			    $('#search_data_course').html(resp.data);
				
					},
					error:function(resp){
						toastr.error(ltr_something_msg);
					}
				});
		
    });

})(jQuery);