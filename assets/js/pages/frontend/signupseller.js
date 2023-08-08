jQuery(document).ready(function() {

	jQuery('body').on("click", '.create-password', function() {
		var input = jQuery('#createpassword');
		if (!jQuery(this).hasClass('confirm')) {
			jQuery('.create-password').attr('src',cortiamajax.createpassword);
			input.attr('type', 'text');
			jQuery(this).addClass('confirm');
		} else  {
			jQuery('.create-password').attr('src',cortiamajax.confirmpassword);
			input.attr('type', 'password');
			jQuery(this).removeClass('confirm');
		}
	});

	jQuery('body').on("click", '.confirm-password', function() {
		var input = jQuery('#passwordagain');
		if (!jQuery(this).hasClass('confirm')) {
			jQuery('.confirm-password').attr('src',cortiamajax.createpassword);
			input.attr('type', 'text');
			jQuery(this).addClass('confirm');
		} else  {
			jQuery('.confirm-password').attr('src',cortiamajax.confirmpassword);
			input.attr('type', 'password');
			jQuery(this).removeClass('confirm');
		}


	});

	gtag('event', 'Signup', {'event_category' : 'Visit', 'User Type': 'Seller'});

	jQuery('#customer_type').select2({
		placeholder: 'Select a Type',
		minimumResultsForSearch: -1,
		allowClear: true
	});

	jQuery('#attributes').select2({
		placeholder: 'Select an Attribute',
		allowClear: true
	});

  jQuery('#state').select2({
		data: _states_,
	  placeholder: 'Select a State',
	  allowClear: true
  });

	jQuery('#state').on('select2:select', function (e) {
	  var selected_state = e.params.data;

		// if(selected_state.text !== 'Florida')
		// {
		// 	jQuery('#response').html('');
		// 	jQuery('#response').html('<div class="alert bg-info text-white alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Currently, our service is only available in Florida.</span></div>');
		//
		// }
		jQuery('#city').select2({
			data: _cities_[selected_state.id],
			placeholder: 'Select a City',
			allowClear: true
		});
	});

	jQuery('#city').select2({
		data:  _cities_[''+jQuery('#state').val()+''],
		placeholder: 'Select a City',
		allowClear: true
	});

	jQuery( "form.signupform" ).validate({
		ignore: ".ignore, :hidden, .returnbackbutton",
		submitHandler: function(form, event) {
		  event.preventDefault();

			if (!$('#first_name').val())
			{
				if ($("#first_name").parents('.fname').next(".from-validation").length == 0) // only add if not added
				{
					$("#first_name").parents('.fname').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please enter first name</div>");
				}
			}
			else {
				$("#first_name").parents('.fname').next(".from-validation").remove(); // remove it
			}

			if (!$('#last_name').val())
			{
				if ($("#last_name").parents('.l-name').next(".from-validation").length == 0) // only add if not added
				{
					$("#last_name").parents('.l-name').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please enter last name</div>");
				}
			}
			else {
				$("#last_name").parents('.l-name').next(".from-validation").remove(); // remove it
			}

			if (!$('#email').val())
			{
				if ($("#email").parents('.email-address').next(".from-validation").length == 0) // only add if not added
				{
					$("#email").parents('.email-address').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please enter email address</div>");
				}
			}
			else {
				$("#email").parents('.email-address').next(".from-validation").remove(); // remove it
			}

			if (!$('#phone').val())
			{
				if ($("#phone").parents('.phone-nmbr').next(".from-validation").length == 0) // only add if not added
				{
					$("#phone").parents('.phone-nmbr').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please enter phone number</div>");
				}
			}
			else {
				$("#phone").parents('.phone-nmbr').next(".from-validation").remove(); // remove it
			}

			if (!$('#state').val())
			{
				if ($("#state").parents('.state').next(".from-validation").length == 0) // only add if not added
				{
					$("#state").parents('.state').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please select state</div>");
				}
			}
			else {
				$("#state").parents('.state').next(".from-validation").remove(); // remove it
			}

			if (!$('#city').val())
			{
				if ($("#city").parents('.city').next(".from-validation").length == 0) // only add if not added
				{
					$("#city").parents('.city').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please select city</div>");
				}
			}
			else {
				$("#city").parents('.city').next(".from-validation").remove(); // remove it
			}


			if (!$('#customer_type').val())
			{
				if ($("#customer_type").parents('.customer_type').next(".from-validation").length == 0) // only add if not added
				{
					$("#customer_type").parents('.customer_type').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please select Type</div>");
				}
			}
			else {
				$("#customer_type").parents('.customer_type').next(".from-validation").remove(); // remove it
			}

			
			if (!$('#createpassword').val())
			{
				if ($("#createpassword").parents('.create-pass').next(".from-validation").length == 0) // only add if not added
				{
					$("#createpassword").parents('.create-pass').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please create password</div>");
				}
			}
			else {
				$("#createpassword").parents('.create-pass').next(".from-validation").remove(); // remove it
			}

			if (!$('#passwordagain').val() && $('#createpassword').val())
			{
				if ($("#passwordagain").parents('.confirm-pass').next(".from-validation").length == 0) // only add if not added
				{
					$("#passwordagain").parents('.confirm-pass').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please confirm password</div>");
				}
			}
			else {
				$("#passwordagain").parents('.confirm-pass').next(".from-validation").remove(); // remove it
			}

		  if($( "#invalidSellerCheck" ).prop( "checked") == false)
		  {
			  if ($("#invalidSellerCheck").parents('.termsandcondition').next(".from-validation").length == 0) // only add if not added
			  {
				  $("#invalidSellerCheck").parents('.termsandcondition').after("<div class='from-validation' style='color:red;margin-bottom: 20px;text-align: start'>Please! accept terms & Condtion</div>");
				  return false;
				  // jQuery('#response').html('<div class="alert bg-danger text-white alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Please! accept terms & Condtion</span></div>');
			  }else {
				  $("#invalidSellerCheck").parents('.termsandcondition').next(".from-validation").remove(); // remove it
				  jQuery('#response').html('');
			  }
		  }


			if ($( "#invalidSellerCheck" ).prop( "checked") == false){
				return false;
			}

		  jQuery('#response').html('');
		  jQuery('.signupform').block({ message: '<img src="' + cortiamajax.loadingimage + '">', css: {border:'0px',background:'transparent',}, overlayCSS: {backgroundColor:'#fff',opacity:0.7}});
			
			jQuery(form).ajaxSubmit({
			  url: cortiamajax.formajaxurl,
			  type: "POST",
			  dataType: "json",
			  success: function(i, s, r, a) {
			  	gtag('event', 'Submitted', {'event_category' : 'Signup', 'User Type': 'Seller'});
			  	if(i.askfor){
						swal.fire({
						  title: i.askfor_title,
						  showCancelButton: true,
					    html: i.askfor_message,
					    type: "question",
					    cancelButtonText: 'Cancel',
							cancelButtonClass: "button-red float-left",
					    confirmButtonText: 'Accept',
							confirmButtonClass: "button-orange float-right",
						}).then(function(e) {

							if(e.value){
								form_details = jQuery('.signupform').serialize();
								console.log(form_details);

								jQuery.ajax({
								  url: cortiamajax.notifyajaxurl,
								  type: "POST",
								  data: form_details,
								  dataType: "json",
								  success: function(i, s, r, a) {
								  	if(i.redirect_to){
								  		window.location.replace(i.redirect_to);
								  	}else{
									  	if(i.success){
									  		gtag('event', 'Waitlist', {'event_category' : 'Added', 'User Type': 'Seller'});
												swal.fire({
													title: i.success_title,
													text: i.success_message,
													type: "success",
													confirmButtonClass: "btn btn-success"
												});
												jQuery('#record-' + record_id).remove();
									  	}
								  	}
								  	if(i.fail){
											swal.fire({
												title: i.fail_title,
												text: i.fail_message,
												type: "error",
												confirmButtonClass: "btn btn-success"
											});
								  	}
								  }
								});
							}
							if(e.dismiss == 'cancel'){
								gtag('event', 'Waitlist', {'event_category' : 'Disagree', 'User Type': 'Seller'});
								swal.fire({
									title: i.cancelty_title,
									text: i.cancelty_message,
									type: "success",
									confirmButtonClass: "btn btn-success"
								});
		  					jQuery('#response').html('');
					  		jQuery('.signupform').unblock();
							}
						});
			  	}
			  	if(i.redirect_to){
			  		gtag('event', 'Completed', {'event_category' : 'Signup', 'User Type': 'Seller'});
			  		window.location.replace(i.redirect_to);
			  	}
			  	if(i.fail){
			  		jQuery('#response').html(i.fail_message);
			  		jQuery('.signupform').unblock();
			  	}
					if(i.errorfields){
						jQuery.each(i.errorfields, function(index, value) {
							jQuery("#"+index).addClass("border-danger").one("focus, mouseenter", function() {
								jQuery(this).removeClass("border-danger");
							});
				    });
					}
			  }
			});
		}
	});


	jQuery(document).on('focusout', '#email', function(){
		let email = $(this).val();
		jQuery.ajax({
			type: "post",
			url: cortiamajax.emailajaxurl,
  		    data: { email : email},
			dataType: "json",
			success: function(response){
				if(response.success == "success")
				{
					
					$('#email').val('');
					$('#email').focus();
					jQuery('#response').html('');
					jQuery('#response').html('<div class="alert bg-danger text-white alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">'+response.messsage+'</span></div>');
					jQuery('.signupform').unblock();


					return false;	
				}					

			}
		});
		
	});

});

