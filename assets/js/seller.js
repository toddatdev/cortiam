var agentSlick;
var favouriteSlick;
var mySlick;

jQuery(document).on('click', '.dofullscreen', function (ev) {
	ev.preventDefault();
	jQuery(this).find('.icon-co').toggleClass('expand').toggleClass('target');
	jQuery(this).parents('.card').find('.card-body, .card-footer').slideToggle('fast');
});

jQuery(document).ready(function() {

	var scrollableDiv = $('#sellerScrollableDiv');
	scrollableDiv.scrollTop(scrollableDiv.prop("scrollHeight"));


	jQuery('.format-phone-number').formatter({
		pattern: '{{999}}-{{999}}-{{9999}}'
	});

	jQuery('*[placeholder]').CorTitle();

	jQuery('body').on('click', '#res_menu_icon', function (ev) {
		ev.preventDefault();
		jQuery('#membermenu').slideToggle('slow');
	});

	jQuery('[data-display="tooltip"]').tooltip();

	if(jQuery(window).width() > 1024){
		var topofmodal = '9%';
		var processpad = 25;
		var processwidth = '60%';
		var processleft = '20%';
	}else if(jQuery(window).width() > 700){
		var topofmodal = '6%';
		var processpad = 15;
		var processwidth = '86%';
		var processleft = '7%';
	}else{
		var topofmodal = '2%';
		var processpad = 10;
		var processwidth = '94%';
		var processleft = '3%';
	}

	jQuery('form.ajaxform').each(function(key, form) {
		jQuery(form).validate({
			ignore: ".ignore, :hidden, .returnbackbutton",
			submitHandler: function(form, event) {
				event.preventDefault();
				actionname = jQuery(form).data('source');
				jQuery(form).block({ message: '<img src="' + cortiamajax.loadingimage + '">', css: {border:'0px',background:'transparent',}, overlayCSS: {backgroundColor:'#f5f5f5',opacity:0.7}});
				jQuery(form).ajaxSubmit({
					url: cortiamajax[actionname],
					type: "POST",
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
									confirmButtonClass: "button-success"
								});
								jQuery(form).unblock();
							}
						}
						if(i.fail){
							swal.fire({
								title: i.fail_title,
								text: i.fail_message,
								type: "error",
								confirmButtonClass: "button-danger"
							});
							jQuery(form).unblock();
						}
						if(i.tos){
							jQuery.blockUI({message: i.tos_content ,onBlock: function(){jQuery("body").addClass("modal-open");}, onUnblock: function(){jQuery("body").removeClass("modal-open");}, css: {border:'0px',width:'100%',height:'100%',top:'0%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});

							jQuery('#tos_action .disablefornow').tooltip();
							ScrollCheckElement = document.getElementById('tos_popup');
							jQuery('#tos_popup').scroll(function() {
								if( ScrollCheckElement.scrollTop >= (ScrollCheckElement.scrollHeight - ScrollCheckElement.offsetHeight)){
									jQuery('#tos_action .disablefornow').fadeOut(500, function() {jQuery('#tos_action').removeClass('disabled');});
								}
							});

							jQuery('#tos_action .button-danger').one('click touchstart', function(ev) {
								jQuery.unblockUI();
								jQuery(form).unblock();
								jQuery("body").removeClass("modal-open");
							});

							jQuery('#tos_action .button-success').one('click touchstart', function(ev) {
								jQuery.ajax({
									type: "post",
									url: cortiamajax.accepttosurl,
									data: {'tos_accepted' : true},
									dataType: "json",
									beforeSend: function() {
										jQuery('#tos_action').block({ message: 'PLEASE WAIT...', css: {'font-size':'1rem','font-weight':'600',border:'0px',background:'transparent',}, overlayCSS: {backgroundColor:'#f5f5f5',opacity:0.7}});
									},
									success: function(response){
										if(response.success){
											jQuery("body").removeClass("modal-open");
											jQuery.unblockUI();
											jQuery('#addpropertyform #steps-fourth .button-orange').click();
										}else{
											jQuery.unblockUI();
											swal.fire({
												title: response.fail_title,
												text: response.fail_message,
												type: "error",
												confirmButtonClass: "button-orange"
											});
										}
									}
								});
							});
						}
						if(i.returntab){
							jQuery('#' + i.tabid + ' .tab-pane').removeClass('active');
							jQuery('#' + i.returntab).addClass('show').addClass('active');
						}
						if(i.errorfields){
							jQuery.each(i.errorfields, function(index, value) {
								jQuery("#"+index).addClass("border-danger").one("focus", function() {
									jQuery(this).removeClass("border-danger");
								});
							});
						}
					}
				});
			}
		});
	});

	jQuery('body').on('click', '.withdrawalbutton', function (ev) {
		ev.preventDefault();
		propertyID = jQuery(this).data('property');
		redirect = jQuery(this).data('redirect');
		jQuery('html, body').animate({scrollTop: jQuery('body').offset().top}, 500);
		jQuery.ajax({
			type: "post",
			url: cortiamgeneralajax.withdrawform,
			data: 'propertyID=' + propertyID + '&redirect=' + redirect,
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({
					message: '<div class="modalloader"><img src="' + cortiamgeneralajax.loadingimage  + '"></div>',
					overlayCSS:  {
						backgroundColor: '#000000',
						opacity:         0.4,
						cursor:          'default'
					},
					css: {
						top:        topofmodal,
						padding:        processpad,
						width:          processwidth,
						left:           processleft,
						color:          '#ffffff',
						border:         '0px solid #aaa',
						position:  'absolute',
						backgroundColor:'transparent',
					}
				});
			},
			success: function(response){
				if(response.form){
					jQuery('.blockMsg').html(response.form);
				}else{
					jQuery.unblockUI();
				}
			}
		});
	});

	jQuery('body').on('click', '.submitwithdraw', function (ev) {
		ev.preventDefault();
		jQuery('html, body').animate({scrollTop: jQuery('body').offset().top}, 500);
		jQuery.ajax({
			type: "post",
			url: cortiamgeneralajax.withdrawurl,
			data: jQuery('form.withdrawform').serialize(),
			dataType: "json",
			beforeSend: function() {
				jQuery('.modalform').block({ message: '<img src="' + cortiamgeneralajax.loadingimage + '">', css: {border:'0px',background:'transparent',}, overlayCSS: {backgroundColor:'#fff',opacity:0.7}});
			},
			success: function(response){
				if(response.success){
					if(response.redirect_to){
						window.location.replace(response.redirect_to);
					}else{
						swal.fire({
							title: response.success_title,
							text: response.success_message,
							type: "success",
							confirmButtonClass: "button-success"
						});
						jQuery.unblockUI();
					}
				}
				if(response.fail){
					swal.fire({
						title: response.fail_title,
						text: response.fail_message,
						type: "error",
						confirmButtonClass: "button-danger"
					});
				}
				if(response.errorfields){
					jQuery.each(response.errorfields, function(index, value) {
						jQuery("#"+index).addClass("border-danger").one("focus", function() {
							jQuery(this).removeClass("border-danger");
						});
					});
					jQuery('.modalform').unblock();
				}
			}
		});
	});

	jQuery('body').on('click touchstart', '.closemodal', function(ev) {
		jQuery.unblockUI();
	});

	if(typeof notify.theme != 'undefined'){
		iziToast.show(notify);
	}
});

// $(document).ready(function() {
//
//
//
// 	$(".single-agent").select2({
// 		placeholder: "Select a Agent",
// 		allowClear: true
// 	});
//
// });


$(document).ready(function() {

	$(".select-single-agent").select2({
		placeholder: 'Select Agent',
		maximumSelectionLength: 1
	});

});




jQuery(document).ready(function() {


	$('.sellerAgents').click(function(e) {

		//favoriteAgentsurl
		let seller_id = $('#seller_id').val();


		jQuery.ajax({
			type: "post",
			url: cortiamajax.sellerGetAgents,
			data: {'seller_id' : seller_id},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(responses){


				$('#setAgentList').empty();
				$.each(responses, function(i, agent) {

					var myEle = $(agent).attr('id');
					if(myEle && agentSlick == 1){
						console.log("exists");
					}
					else{
						$('#setAgentList').append(agent);
					}


				});
				if(agentSlick == 1)
				{
					$('.carouselAgent').slick('refresh');
				}
				jQuery.unblockUI();

			}
		});

	});

	$('.sellerFavoriteAgents').click(function(e) {

		//favoriteAgentsurl
		let seller_id = $('#seller_id').val();


		jQuery.ajax({
			type: "post",
			url: cortiamajax.favoriteAgentsurl,
			data: {'seller_id' : seller_id},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(responses){

				$('#setFavoriteList').empty();
				$.each(responses, function(i, agent) {
					var myEle = $(agent).attr('id');
					if(myEle && favouriteSlick == 1){
						console.log("exists");
					}
					else{
						$('#setFavoriteList').append(agent);
					}

				});
				if(favouriteSlick == 1)
				{
					$('.carouselFavourites').slick('refresh');
				}

				jQuery.unblockUI();

			}
		});

	});

	$('.sellerMyAgents').click(function(e) {

		let seller_id = $('#seller_id').val();

		jQuery.ajax({
			type: "post",
			url: cortiamajax.sellerMyAgents,
			data: {'seller_id' : seller_id},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(responses){

				$('#sellerMyAgents').empty();
				$.each(responses, function(i, agent) {

					var myEle = $(agent).attr('id');
					if(myEle && mySlick == 1){
					}
					else{
						$('#sellerMyAgents').append(agent);
					}
				});
				if(mySlick == 1)
				{
					$('.carouselMy').slick('refresh');
				}
				jQuery.unblockUI();

			}
		});


	});

});

function refreshCarousal(){

	jQuery('.carouselAgent').each(function(key, carousel) {
		if(jQuery(carousel).find('.proplisting').length >= 4){
			agentSlick = 1;
			jQuery(carousel).not('.slick-initialized').slick({
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
}

function refreshCarousalSelected(){

	jQuery('.carouselMy').each(function(key, carousel) {
		if(jQuery(carousel).find('.proplisting').length >= 4){
			mySlick = 1;
			jQuery(carousel).not('.slick-initialized').slick({
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
}

function refreshCarousalFavourites(){

	jQuery('.carouselFavourites').each(function(key, carousel) {
		if(jQuery(carousel).find('.proplisting').length >= 4){
			favouriteSlick = 1;
			jQuery(carousel).not('.slick-initialized').slick({
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

}


jQuery(document).ready(function() {

	refreshCarousal();
	refreshCarousalFavourites();
	refreshCarousalSelected();

});



jQuery(document).on("change", '#notifications', function (ev) {

	var notify = jQuery(this).prop('checked');

	if(notify !== true)
	{
		swal.fire({
			title: 'Please Confirm!',
			showCancelButton: true,
			html: 'Disabling email notifications might lead you to missing important emails and impact your ability to win properties. Are you sure you want to proceed and cancel email notifications?',
			type: "question",
			cancelButtonText: '<b><i class="icon-cross2"></i></b> Cancel',
			cancelButtonClass: "button-dark2 float-left",
			confirmButtonText: '<b><i class="icon-checkmark3"></i></b> Proceed',
			confirmButtonClass: "button-orange float-right",
		}).then(function (e) {
			console.log(e);
			if (e.value) {
				updateNotification(notify);
			}
		});

	}else{
		swal.fire({
			title: 'Please Confirm!',
			showCancelButton: true,
			html: 'Enabling email notification ensures you will receive emails and impacts your ability to win properties. Are you sure you want to proceed with email notifications?',
			type: "question",
			cancelButtonText: '<b><i class="icon-cross2"></i></b> Cancel',
			cancelButtonClass: "button-dark2 float-left",
			confirmButtonText: '<b><i class="icon-checkmark3"></i></b> Proceed',
			confirmButtonClass: "button-orange float-right",
		}).then(function (e) {
			console.log(e);
			if (e.value) {
				updateNotification(notify);
			}
		});
	}

});


function updateNotification(notify)
{
	jQuery.ajax({
		url: cortiamgeneralajax.setNotification,
		type: "get",
		data : {notification : notify},
		cache: false,
		success: function (data)
		{
			if($('#notifications').val() == true)
			{
				$('#notifications').val(false);
			}else{

				$('#notifications').val(true);
			}
		}

	});
}