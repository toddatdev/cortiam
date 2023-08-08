jQuery(document).ready(function() {

	jQuery('body').on( "click", '.closeproposalpopup', function(ev) {
		ev.preventDefault();
		jQuery.unblockUI();
	});

	jQuery('body').on( "click", '.thisisexpired', function(ev) {
		ev.preventDefault();
  	button = jQuery(this);
  	profile_url = jQuery(button).data('profile');
  	price = jQuery(button).data('price');
		swal.fire({
	    title: "You have exceeded your 48hr window!",
	    text: "If you would like to work with this seller you will need to reintroduce yourself and be accepted by them again.",
	    type: "question",
	    showCancelButton: !0,
	    cancelButtonText: 'Close',
			cancelButtonClass: "button-dark float-left",
	    confirmButtonText: 'Proceed',
			confirmButtonClass: "button-orange float-right"
		}).then(function(e) {
			if(e.value){
	  		window.location.replace(profile_url);
			}
		});
	});

	jQuery('body').on( "click", '.paymentidrequired', function(ev) {
		ev.preventDefault();

		let redirect_to = $('#property_payment_url').val();
		window.location.replace(redirect_to);
	//
	//
	// 	let agentId = $(this).data('agentid');
	// 	let sellerid = $(this).data('sellerid');
	// 	let propertyid = $(this).data('propertyid');
	// 	let setPrice   = 0;
	//
	//
	// 	$.ajax({
	// 			url		 : cortiamajax.latestcoupon,
	// 			data 	 : {agentId : agentId,sellerid:sellerid, propertyid : propertyid },
	// 			async	 : false,
	// 		    type 	 : 'post',
	// 			dataType : 'json',
	// 		success: function(result) {
	// 			console.log(result);
	// 			setPrice = result.agr_fee;
	// 	}});
	//
	// $(this).attr('data-price', setPrice);
	//
	//
  	// button = jQuery(this);
  	// profile_url = jQuery(button).data('profile');
  	// price = setPrice;
	// original = jQuery(button).data('original');
	// let textMessage = '';
	// if(original !== '')
	// {
	// 	 textMessage = "To accept this agreement, you need an active payment method to pay a one-time fee of $"+price+" USD as the agreement fee." +
	// 		" The total amount was $"+original+" USD, and after applying the coupon, the price is "+price+". " +
	// 		" Please add your credit card as a payment method in your account to accept" +
	// 		" this agreement."
	// }else{
	// 	textMessage = "To accept this agreement you need an active payment method to pay $" + price + "USD one time fee as agreement fee. Please add your credit card as payment method in your account to accept this agreement."
	// }
	//
	// 	swal.fire({
	//     title: "Payment Method Error",
	//     text: textMessage,
	//     type: "question",
	//     showCancelButton: !0,
	//     cancelButtonText: 'Close',
	// 		cancelButtonClass: "button-dark float-left",
	//     confirmButtonText: 'Proceed',
	// 		confirmButtonClass: "button-orange float-right"
	// 	}).then(function(e) {
	// 		if(e.value){
	// 		}
	// 	});
	});

	jQuery('body').on( "click", '.acceptagreement', function(ev) {
		ev.preventDefault();


		let agentId = $(this).data('agentid');
		let sellerid = $(this).data('sellerid');
		let propertyid = $(this).data('propertyid');
		let setPrice   = 0;
		let url        = $(this).data('url');


	// 	$.ajax({
	// 		url		 : cortiamajax.latestcoupon,
	// 		data 	 : {agentId : agentId,sellerid:sellerid, propertyid : propertyid },
	// 		async	 : false,
	// 		type 	 : 'post',
	// 		dataType : 'json',
	// 		success: function(result) {
	// 			console.log(result);
	// 			setPrice = result.agr_fee;
	// 		}});
	//
	// $(this).attr('data-price', setPrice);

  	button = jQuery(this);
  	agree_id = jQuery(button).data('agree');
  	price = setPrice;
	coupontype = jQuery(button).data('coupontype');
	couponamount = jQuery(button).data('couponamount');

		original = jQuery(button).data('original');
		let textMessage = '';


		// if(original !== '')
		// {
		// 	textMessage = "To accept this agreement, you need an active payment method to pay a one-time fee of $"+price+" USD as the agreement fee." +
		// 		" The total amount was $"+original+" USD, and after applying the coupon, the price is "+price+". " +
		// 		" Please add your credit card as a payment method in your account to accept" +
		// 		" this agreement."
		// }else{
		// 	textMessage = "To accept this agreement you need an active payment method to pay $" + price + "USD one time fee as agreement fee. Please add your credit card as payment method in your account to accept this agreement."
		// }

	// let showText = "";
	// if(couponamount !== '')
	// {
	// 	if(coupontype == "Percentage")
	// 	{
	// 	   showText = "By accepting this agreement you will be charged $" + price + "USD one time fee.You will get "+ couponamount+"%"+" discount on actual price. Are you sure you want to accept this agreement?";
	// 	}else{
    //  		showText = "By accepting this agreement you will be charged $" + price + "USD one time fee.You will get $"+ couponamount +" discount on actual price. Are you sure you want to accept this agreement?";
	// 	}
	// }else{
	// 	showText = "By accepting this agreement you will be charged $" + price + "USD one time fee.Are you sure you want to accept this agreement?";
	// }

		// swal.fire({
	    // title: "Are you sure?",
	    // text: textMessage,
	    // type: "question",
	    // showCancelButton: !0,
	    // cancelButtonText: 'Cancel',
		// 	cancelButtonClass: "button-dark float-left",
	    // confirmButtonText: 'Proceed',
		// 	confirmButtonClass: "button-orange float-right"
		// }).then(function(e) {
		// 	if(e.value){
				jQuery.ajax({
					type: "post",
					url: cortiamajax.accepturl,
		  		data: {'agree_id' : agree_id},
					dataType: "json",
					beforeSend: function() {
						jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
					},
					success: function(response){
				  	if(response.redirect_to){
				  		window.location.replace(response.redirect_to);
				  	}else{
							if(response.success){
								jQuery.unblockUI();
								window.location.replace(url);
							}
					  	if(response.fail){
								swal.fire({
									title: response.fail_title,
									text: response.fail_message,
									type: "error",
									confirmButtonClass: "button-orange"
								});
								jQuery.unblockUI();
					  	}
						}
					}
				});
			// }
		// });
	});

	jQuery('body').on( "click", '.declineagreement', function(ev) {
		ev.preventDefault();
  	button = jQuery(this);
  	agree_id = jQuery(button).data('agree');
		swal.fire({
	    title: "Are you sure?",
	    text: "Are you sure you want to decline this agreement?",
	    type: "question",
	    showCancelButton: !0,
	    cancelButtonText: 'Cancel',
			cancelButtonClass: "button-dark float-left",
	    confirmButtonText: 'Proceed',
			confirmButtonClass: "button-orange float-right"
		}).then(function(e) {
			if(e.value){
				jQuery.ajax({
					type: "post",
					url: cortiamajax.declineurl,
		  		data: {'agree_id' : agree_id},
					dataType: "json",
					beforeSend: function() {
						jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
					},
					success: function(response){
						if(response.success){
							jQuery('#agree-' + agree_id).replaceWith(response.newcard);
							swal.fire({
								title: response.success_title,
								text: response.success_message,
								type: "success",
								confirmButtonClass: "button-orange"
							});
							jQuery.unblockUI();
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
			}
		});
	});

});