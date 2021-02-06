$(function(){


	$("form[name='login']").validate({
		errorElement: "span",
		errorClass: "validation-error-label",
		
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true,
				minlength:6,
			},
		},
		//
		highlight: function (element, errorClass) {
			$(element).removeClass(errorClass);
		},
		unhighlight: function (element, errorClass) {
			$(element).removeClass(errorClass);
		},
		errorPlacement: function (error, element) {

			// Styled checkboxes, radios, bootstrap switch
			if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
				if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
					error.appendTo(element.parent().parent().parent().parent());
				}
				else {
					error.appendTo(element.parent().parent().parent().parent().parent());
				}
			}

			// Unstyled checkboxes, radios
			else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
				error.appendTo(element.parent().parent().parent());
			}

			// Input with icons and Select2
			else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
				error.appendTo(element.parent());
			}

			// Inline checkboxes, radios
			else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
				error.appendTo(element.parent().parent());
			}

			// Input group, styled file input
			else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
				error.appendTo(element.parent().parent());
			}

			else {
				error.insertAfter(element);
			}
		},
		
		// messages:{
		// 	email:{
		// 		required:"Email is required",
		// 		email:"Please enter valid email"
		// 	},
		// 	password:{
		// 		required:"Password is required",
		// 		minlength:"Please enter minimum 6 digit password"
		// 	}
		// },
		submitHandler:function(form){
			form.submit();
		}
	});
});