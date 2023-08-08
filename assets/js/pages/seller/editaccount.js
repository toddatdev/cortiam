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

	jQuery('body').on( "click", '.deactivateme', function(ev) {
		ev.preventDefault();
		record_id = jQuery(this).data('id');
		swal.fire({
		  title: 'Please Confirm!',
		  input: 'text',
		  inputAttributes: {
		    autocapitalize: 'on'
		  },
		  showCancelButton: true,
	    html: 'Your account will be removed and you won\'t be able to revert this action! If you still want to continue please type <b>"DELETE"</b> to the input box and click proceed button.',
	    type: "question",
	    cancelButtonText: '<b><i class="icon-cross2"></i></b> Cancel',
			cancelButtonClass: "button-dark float-left",
	    confirmButtonText: '<b><i class="icon-checkmark3"></i></b> Proceed',
			confirmButtonClass: "button-orange float-right",
		  inputValidator: (value) => {
		    return new Promise((resolve) => {
		      if (value === 'DELETE') {
		        resolve()
		      } else {
		        resolve('You should type "DELETE"')
		      }
		    })
		  }
		}).then(function(e) {
			if(e.value == 'DELETE'){
				jQuery.ajax({
				  url: cortiamajax.deactivateurl,
				  type: "POST",
				  data: {'recordID' : record_id},
				  dataType: "json",
				  success: function(i, s, r, a) {
				  	if(i.redirect_to){
				  		window.location.replace(i.redirect_to);
				  	}else{
					  	if(i.success){
								swal.fire({
									title: i.success_title,
									text: i.success_message,
									type: "success",
									confirmButtonClass: "btn btn-success"
								});
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
		});
	});

  jQuery('#state').select2({
		data: _states_,
	  placeholder: 'Select a State',
	  allowClear: true
  });

	jQuery('#state').on('select2:select', function (e) {
	  var selected_state = e.params.data;
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

});


$(".scroll-nav-edit-account").on('click', function(e) {

	e.preventDefault();

	$(".scroll-nav-edit-account").removeClass("active");
	$(this).addClass("active");

	var target = $(this).attr('href');
	$('html, body').animate({
		scrollTop: ($(target).offset().top - 200)
	}, 2000);
});



document.getElementById('phone').addEventListener('input', function (e) {
	var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
	e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
});