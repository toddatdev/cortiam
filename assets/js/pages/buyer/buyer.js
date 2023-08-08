var tbl = '';
var selectedSlick2;
var favouriteSlick2;
var simpleSlick2;

jQuery(document).ready(function() {


	var scrollableDiv = $('#buyerScrollableDiv');
	scrollableDiv.scrollTop(scrollableDiv.prop("scrollHeight"));

	refreshCarousalFavourites2();
	refreshCarousalSelected2();

});

jQuery(document).ready(function() {

	jQuery('#agent_id').select2({
		placeholder: 'Please select an agent'
	});


	if($('#dashboard').val())
	{
		BuyerAgents();

	}
});


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

jQuery(document).on('click', '.Buyerfavoritebutton', function(ev) {
	ev.preventDefault();

	let agent_id = $(this).attr('data-agent');
	let value = $(this).attr('data-type');
	favbutton = jQuery(this);
	if(value ==  'add')
	{
		$(this).attr('data-type', 'remove');
	}else{
		$(this).attr('data-type', 'add');
	}

	jQuery.ajax({
		type: "post",
		url: cortiamajax.favoriteurl,
		data: {'agent_id' : agent_id, 'value' : value},
		dataType: "json",
		beforeSend: function() {
			jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
		},
		success: function(response){
			jQuery.unblockUI();


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
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {
						//
						location.reload(true);
					}
				})

			}
			if(response.fail){
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

jQuery('body').on( "click", '.favoritebutton', function(ev) {

	ev.preventDefault();
	favbutton = jQuery(this);
	favbutton_value = jQuery(favbutton).data('type');
	jQuery.ajax({
		type: "post",
		url: cortiamajax.favoriteurl,
		data: {'agent_id' : cortiamajax.agent_id, 'value' : favbutton_value},
		dataType: "json",
		beforeSend: function() {
			jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
		},
		success: function(response){
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
				});
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

jQuery('body').on( "click", '#search', function(ev) {

	ev.preventDefault();
	BuyerAgents();

});

jQuery('body').on( "click", '#cancel', function(ev) {
	let buyerState = $('#buyerState').val();
	let buyercity = $('#buyerCity').val();

	$('#getstate').val(buyerState).trigger('change');
	$('#getcity').val(buyercity).trigger('change');


	BuyerAgents();

});


function searchFindByerAgents()
{
	let state = $('#getstate').val();
	let city = $('#getcity').val();
	let zip = $('#zip').val();


	if(state == null && city == null && zip == '')
	{
		Swal.fire({
			icon: 'error',
			title:'Missing Search Parameter!',
			confirmButtonColor: '#00c48d',
			text: 'Please enter at least one of the Zip Code, City or State fields to define your search.',
		})
		return false;
	}


	$('#setFindBuyersAgentList').empty();
	setTimeout(
		function()
		{
			jQuery.ajax({
				type: "post",
				url: cortiamajax.searchAgents,
				data: {state : state, city :city, zip : zip},
				dataType: "json",
				beforeSend: function() {
					jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
				},
				success: function(response){

					if(response.length > 0)
					{
						console.log(response);
						response.forEach(element => {

							$('#setFindBuyersAgentList').append(element);


						});

					}else{
						$('#setFindBuyersAgentList').append('<h4 class="py-3 p-sm-5 text-center">You have no agents at this moment</h4>');

					}

					jQuery.unblockUI();



				}
			});
		});

}




function BuyerAgents()
{

	$('#setFindBuyersAgentList').empty();
	jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%', height:'100%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});


	setTimeout(
		function()
		{

			let state = $('#getstate').val();
			let city =$('#getcity').val();

			jQuery.ajax({
				type: "post",
				url: cortiamajax.searchAgents,
				dataType: "json",
				data : {state : state, city : city},
				success: function(response){

					if(response.length > 0)
					{
						response.forEach(element => {

							$('#setFindBuyersAgentList').append(element);


						});


					}else{
						$('#setFindBuyersAgentList').append('<h4 class="py-3 p-sm-5 text-center">You have no agents at this moment</h4>');

					}

					jQuery.unblockUI();


				}
			});
		}, 2000);

}

jQuery('body').on( "click", '.sendreview', function(ev) {
	ev.preventDefault();

	Swal.fire({
		title: 'Do you want to select this agent?',
		icon: 'info',
		iconColor: '#00c48d',
		showDenyButton: true,
		confirmButtonColor: "#00c48d",
		denyButtonColor: '#aaa',
		confirmButtonText: 'Yes',
		denyButtonText: `Cancel`,
	}).then((result) => {
		if (result.isConfirmed)
		{

			let agent_id = $(this).attr('data-agent-id');
			let buyer_id = $(this).attr('data-buyer-id');

			//favoriteAgentsurl

			jQuery.ajax({
				type: "post",
				url: cortiamajax.reviewurl,
				data: {'agent_id' : agent_id, 'buyer_id' : buyer_id},
				dataType: "json",
				beforeSend: function() {
					jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
				},
				success: function(response){

					if(response.success){


					}

					if(response.success){
						swal.fire({
							title: response.success_title,
							text: response.success_message,
							type: "success",
							confirmButtonClass: "button-success"
						}).then((result) => {
							if (result.isConfirmed) {
								$('#contactModalBox').modal('show');
							}
						});
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
		}
	});

});


jQuery('body').on( "click", '.deleletereview', function(ev) {
	ev.preventDefault();

	Swal.fire({
		title: 'Do you want to unselect this agent?',
		icon: 'info',
		iconColor: '#00c48d',
		showDenyButton: true,
		confirmButtonColor: "#00c48d",
		denyButtonColor: '#aaa',
		confirmButtonText: 'Yes',
		denyButtonText: `Cancel`,
	}).then((result) => {
		if (result.isConfirmed)
		{

			let agent_id = $(this).attr('data-agent-id');
			let buyer_id = $(this).attr('data-buyer-id');

			jQuery.ajax({
				type: "post",
				url: cortiamajax.removereviewurl,
				data: {'agent_id' : agent_id, 'buyer_id' : buyer_id},
				dataType: "json",
				beforeSend: function() {
					jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
				},
				success: function(response){

					if(response.success){

						$(".sendreview").css('display', 'block');
						$(".deleletereview").css('display', 'none');

					}

					if(response.success){
						swal.fire({
							title: response.success_title,
							text: response.success_message,
							type: "success",
							confirmButtonClass: "button-success"
						});
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
		}
	});

});




$('.buyerFavoriteAgents').click(function(e) {

	let buyer_id = $('#buyer_id').val();

	$('#setSelectedList').css("display", "none");
	$('#setFavoriteList').css("display", "block");
	$('#setFavoriteList').empty();

	jQuery.ajax({
		type: "post",
		url: cortiamajax.favoriteAgentsurl,
		data: {'buyer_id' : buyer_id},
		dataType: "json",
		beforeSend: function() {
			jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
		},
		success: function(responses){
			jQuery.unblockUI();

			$.each(responses, function(i, agent) {



				var myEle = $(agent).attr('id');
				if(myEle && favouriteSlick2 == 1){
				}
				else{
					$('#setFavoriteList').append(agent);
				}

			});

			if(favouriteSlick2 == 1)
			{
				$('.carouselFavourites').slick('refresh');
			}
			jQuery.unblockUI();
		}

	});


});

$('.buyerMyAgents').click(function(e) {

	let buyer_id = $('#buyer_id').val();


	$('#setFavoriteList').css("display", "none");
	$('#setSelectedList').css("display", "block");
	$('#setSelectedList').empty();

	jQuery.ajax({
		type: "post",
		url: cortiamajax.selectedAgentsurl,
		data: {'buyer_id' : buyer_id},
		dataType: "json",
		beforeSend: function() {
			jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
		},
		success: function(responses){
			jQuery.unblockUI();

			$.each(responses, function(i, agent) {

				var myEle = $(agent).attr('id');
				if(myEle && selectedSlick2 == 1){
				}
				else{
					$('#setSelectedList').append(agent);
				}


			});
			if (selectedSlick2 == 1)
			{
				$('.carouselSelected').slick('refresh');
			}
			jQuery.unblockUI();

		}
	});


});

function refreshCarousal2(){


	jQuery('.carouselSimple').each(function(key, carousel) {
		if(jQuery(carousel).find('.proplisting').length >= 4){
			simpleSlick2 = 1;
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

function refreshCarousalSelected2(){


	jQuery('.carouselSelected').each(function(key, carousel) {
		if(jQuery(carousel).find('.proplisting').length >= 4){
			selectedSlick2 = 1;
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

function refreshCarousalFavourites2(){




	jQuery('.carouselFavourites').each(function(key, carousel) {
		console.log("hello I am here");
		if(jQuery(carousel).find('.proplisting').length >= 4){
			favouriteSlick2 = 1;
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



jQuery(document).on("change", '#buyerNotifications', function (ev) {

	var notify = jQuery(this).prop('checked');

	console.log(notify)

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

$('#contactnotification').validate();
$('#contactnotification').submit(function() {

	if($('#buyername').val() == '')
	{
		return false;
	}

	if($('#notitication_phone').val() == '')
	{
		return false;
	}

	if($('#buyeremail').val() == '')
	{
		return false;
	}

	let agent_id = $('.sendreview').attr('data-agent-id');
	$('#contact_agent_id').val(agent_id);

	$.ajax({
		type: "post",
		url:  cortiamajax.notificationcontact,
		data: $(this).serialize(),
		dataType: "json",
		success: function(response) {
			if (response) {

				$(".sendreview").hide();
				$(".deleletereview").css('display', 'block');

				$('#contactModalBox').modal('hide');

				swal.fire({
					title: response.title,
					text: response.text,
					type: 'success',
					confirmButtonClass: "button-success",
					timer: 4000
				});
			}
		}
	});

	return false;
});


$('#willcontactagain').click(function(){
	$(".deleletereview").css('display', 'block');
	$(".sendreview").css('display', 'none');
	$('#contactModalBox').modal('hide');
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
			if($('#buyerNotifications').val() == true)
			{
				$('#buyerNotifications').val(false);
			}else{

				$('#buyerNotifications').val(true);
			}
		}

	});
}