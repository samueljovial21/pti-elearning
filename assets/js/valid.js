var myCustom = {
	checkFormFields : function(formId){
		var check = 0;
		var target = (typeof formId == 'object')? $(formId):$('#'+formId);
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
					check = 1;
					toastr.error(ltr_some_required);
					$(this).addClass('error').focus();
					return false; 
				}else{
					$(this).removeClass('error');
				} 
			}

			if((typeof $(this).val() == 'object' && isEmpty($(this).val()) == true) || (typeof $(this).val() != 'object' && $(this).val().trim() != '')){
				var valid = $(this).attr('data-valid'); 				
				if(typeof valid != 'undefined'){
					if(!eval(valid).test($(this).val().trim())){
						$(this).addClass('error').focus();
						check = 1;
						toastr.error($(this).attr('data-error'));
						return false; 
					}else{
						$(this).removeClass('error');
					}
				}
			}

			if(($(this).attr('type') != 'file') && TagReg.test($(this).val()) == true) {
				$(this).addClass('error').focus();
				toastr.error(ltr_only_letters_msg);
				check = 1;
				return false;
			}else{
				$(this).removeClass('error');
			}

		});
		return check;
		
		function isEmpty(obj) {
			for(var key in obj) {
				if(obj.hasOwnProperty(key))
					return false;
			}
			return true;
		}
	} , 

	callFormAjax : function(targetForm){
		var targetUrl = targetForm.attr('action');
		if(targetForm.find('[type="file"]').length){
			var AjaxOption = {
				url: targetUrl,
				method: "post",
				data : new FormData(targetForm[0]),
				processData: false,
				contentType: false,
			};
		}else{
			var AjaxOption = {
				url: targetUrl,
				method: "post",
				data : targetForm.serialize()
			};
		}	
		return $.ajax(AjaxOption);
	}

};