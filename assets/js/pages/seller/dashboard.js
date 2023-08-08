jQuery(document).ready(function() {


	jQuery(function() {
		let timeout = 2000; // in miliseconds (3*1000)
		jQuery(".alert-success").delay(timeout).fadeOut(300);

	});

	var userType = $('#userType').val();



	agentappointments = jQuery('#getagentappointments').DataTable({
		processing: true,
		serverSide: true,
		order: [[0, "desc"]],
		paging: true,
		pageLength: 10,
		lengthMenu: [5, 10, 15, 20, 25],
		type: 'POST',
		language: {
			searchPlaceholder: "Search By Type"
		},

		ajax: {
			url: cortiamajax.agentappointmentstableajaxurl,
			data: function (d) {
				// d.email = $('.searchEmail').val(),
				// d.search = $('input[type="search"]').val()
			}
		},
		columns: [
			{data: 'id', name: 'id'},
			{data: 'first_name', name: 'first_name'},
			{data: 'meet_type', name: 'meet_type'},
			{data: 'meet_at', name: 'meet_at'},
			{data: 'message', name: 'message'},
		],
		columnDefs: [ {
			targets: [3, 4], /* column index */
			orderable: false, /* true or false */
		}]
	});





	jQuery('#bio').trumbowyg({
		btns: [
			// ['formatting'],
			['strong', 'em'],
			['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
			['unorderedList', 'orderedList'],
			['undo', 'redo'], // Only supported in Blink browsers
			['insertImage', 'link'],
			['viewHTML'],
			['fullscreen']
		]
	});

	jQuery('.select').select2({
		minimumResultsForSearch: Infinity,
	});

	jQuery('#state').autocomplete({
		source: _states_,
		select: function( event, ui ) {
			jQuery('#city').autocomplete({
				source: _cities_[ui.item.value]
			});
		}
	});

	jQuery('#city').autocomplete({
		source: _cities_[''+jQuery('#state').val()+'']
	});

	jQuery('#brokerage_state').autocomplete({
		source: _states_,
		select: function( event, ui ) {
			jQuery('#brokerage_city').autocomplete({
				source: _cities_[ui.item.value]
			});
		}
	});

	jQuery('#brokerage_city').autocomplete({
		source: _cities_[''+jQuery('#brokerage_state').val()+'']
	});

	jQuery('#license_states').autocomplete({
		source: _states_
	});

	jQuery('.carousel').each(function(key, carousel) {
		if(jQuery(carousel).find('.proplisting').length >= 3){
			jQuery(carousel).slick({
				dots: false,
				infinite: false,
				speed: 300,
				slidesToShow: 3,
				slidesToScroll: 1,
				responsive: [
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		}
	});



	jQuery('body').on( "click", '.favmebutton', function(ev) {
		ev.preventDefault();
		favbutton = jQuery(this);
		favbutton_value = jQuery(favbutton).data('type');
		agent_id = jQuery(favbutton).data('agent');

		if(favbutton_value == 'add')
		{
			jQuery(favbutton).attr('type', 'remove');
		}else{
			jQuery(favbutton).attr('type', 'add');
		}



		jQuery.ajax({
			type: "post",
			url: cortiamajax.favoriteurl,
			data: {'agent_id' : agent_id, 'value' : favbutton_value, 'bigger' : true},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(response){

				console.log(response);
				if(response.buttonicon){
					jQuery(favbutton).html(response.buttonicon);
				}
				if(response.buttonvalue){
					jQuery(favbutton).data('type', response.buttonvalue);
				}
				if(response.success){
					swal.fire({
						title: response.success_title,
						text: response.success_message,
						type: "success",
						confirmButtonClass: "button-success"
					}).then((result) => {
						console.log(result);
							/* Read more about isConfirmed, isDenied below */
							if (result.value == true) {
								//
								location.reload(true);
							}
						});
				}
				if(response.removeagent){
					jQuery('#nav-fa .carousel #' + response.removeagent).remove();
					if(jQuery('#nofavtext').length < 1){
						jQuery('#nav-fa .carousel').append('<h4 class="p-5 text-center" id="nofavtext">You have no agents at this moment.</h4>');
					}
				}
				if(response.addagent){
					if(jQuery('#nofavtext').length > 0){
						jQuery('#nofavtext').remove();
					}
					jQuery('#nav-fa .carousel').append(response.addagent);
				}
				if(response.fail){
					swal.fire({
						title: response.fail_title,
						text: response.fail_message,
						type: "error",
						confirmButtonClass: "button-orange"
					});
				}
				jQuery.unblockUI();
			}
		});
	});

});
