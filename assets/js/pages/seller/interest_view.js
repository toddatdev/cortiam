jQuery(document).ready(function() {

	datePickerCall();

	$('form.bookslotajaxform').each(function(key, form) {
		$(form).validate({
			ignore: ".ignore, :hidden, .returnbackbutton",
			submitHandler: function(form, event) {
				event.preventDefault();
				let currentSelectedDate = $("#select-date").val();
				let getDays             = $('#getDays').val();
				getDays = getDays.replace(/\s/g, '');

				getDays = getDays.split(',');
				let finalResult = getDays.filter(element => {
					return !currentSelectedDate.includes(element);
				});
				finalResult = finalResult.toString();
				$('#getDays').val(finalResult);

				datePickerCall();
				//	$('#getDays').val('');
				// actionname = $(form).data('source');

				$(form).block({ message: '<img src="' + cortiamajax.loadingimage + '">', css: {border:'0px',background:'transparent',}, overlayCSS: {backgroundColor:'#f5f5f5',opacity:0.7}});
				$(form).ajaxSubmit({
					url: cortiamajax.bookavailableagentslot,
					data: {'agent_id' : cortiamajax.agent_id},
					type: "POST",
					dataType: "json",
					success: function(response) {
						// $('#bookslotajaxform')[0].reset();
						$('form.bookslotajaxform')[0].reset();
						$('#getDays').val(response.bookeddays);

						$('#setDays').val(response.bookeddays);
						$('#monthArray').val(response.allowedMonths);
						$('#yearArray').val(response.allowedYears);

						$('#available-slots').empty();
						$(form).unblock();
						if(response){
							swal.fire({
								title: 'Appointment Booked',
								text: 'Appointment added successfully',
								type: 'success',
								confirmButtonClass: "button-success",
								timer: 4000
							});
						}


					}

				});

			}
		});
	});

	jQuery('body').on( "click", '.viewproposaldetails', function(ev) {
		ev.preventDefault();
		contract_length = jQuery(this).data('length');
		commission_rate = jQuery(this).data('com');
		proposal_text = jQuery(this).data('text');
		agent_name = jQuery(this).data('name');
		agent_image = jQuery(this).data('img');
		proposal_text = proposal_text.replace(/(?:\r\n|\r|\n)/g, '<br>');
		jQuery.blockUI({message: '<div class="proposalpopup"><div class="row"><div class="col-md-4 left-side"><div class="popupimg rounded-circle"><img class="img-fluid" src="' + agent_image + '"></div><div class="popupname">' + agent_name + '</div></div><div class="col-md-8 right-side"><div class="popupoptions"><span>Contract Length:</span>' + contract_length + ' Months</div><div class="popupoptions"><span>Commission Rate:</span>' + commission_rate + '%</div><div class="popupoptions"><span>Message:</span>' + proposal_text + '</div></div></div><a href="#" class="closeproposalpopup"><i class="icon-cancel-circle2 icon-2x"></i></a></div>',css: {border:'0px',width:'100%',top:'10%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
	});


	jQuery('body').on( "click", '.closeproposalpopup', function(ev) {
		ev.preventDefault();
		jQuery.unblockUI();
	});

	jQuery('body').on( "click", '.acceptproposal', function(ev) {
		ev.preventDefault();
		swal.fire({
	    title: "Are you sure?",
	    text: "Are you sure you want to accept this proposal?",
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
					url: cortiamajax.acceptproposalurl,
		  		data: {'proposal_id' : cortiamajax.proposal_id},
					dataType: "json",
					beforeSend: function() {
						jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
					},
					success: function(response){
						if(response.success){
							jQuery('.buttonsrow, .messagebutton').remove();
							swal.fire({
								title: response.success_title,
								text: response.success_message,
								type: "success",
								confirmButtonClass: "button-orange"
							});
							jQuery.unblockUI();
						}
				  	if(response.fail){
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
			}
		});
	});

	jQuery('body').on( "click", '.declineproposal', function(ev) {
		ev.preventDefault();
		swal.fire({
	    title: "Are you sure?",
	    text: "Are you sure you want to decline this proposal?",
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
					url: cortiamajax.declineproposalurl,
		  		data: {'proposal_id' : cortiamajax.proposal_id},
					dataType: "json",
					beforeSend: function() {
						jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
					},
					success: function(response){
						if(response.success){
							jQuery('.buttonsrow, .messagebutton').remove();
							swal.fire({
								title: response.success_title,
								text: response.success_message,
								type: "success",
								confirmButtonClass: "button-orange"
							});
							jQuery.unblockUI();
						}
				  	if(response.fail){
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
			}
		});
	});

	jQuery('body').on( "click", '.counterofferproposal', function(ev) {
		ev.preventDefault();
  	button = jQuery(this);
		jQuery.ajax({
			type: "post",
			url: cortiamajax.counterofferform,
		  data: {'proposal_id' : cortiamajax.proposal_id},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div id="co_form"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(response){
				if(response.success){
					jQuery('#co_form').html(response.form);
				  jQuery('.maxlength-textarea').maxlength({alwaysShow: true});
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

	jQuery('body').on( "click", '.withdrawproposal', function(ev) {
		ev.preventDefault();
  	button = jQuery(this);
  	proposal_id = jQuery(button).data('prop');
		swal.fire({
	    title: "Are you sure?",
	    text: "Are you sure you want to withdraw this proposal?",
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
					url: cortiamajax.withdrawproposalurl,
		  		data: {'proposal_id' : proposal_id},
					dataType: "json",
					beforeSend: function() {
						jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
					},
					success: function(response){
						if(response.success){
							jQuery('.buttonsrow, .messagebutton').remove();
							swal.fire({
								title: response.success_title,
								text: response.success_message,
								type: "success",
								confirmButtonClass: "button-orange"
							});
							jQuery('#couponlistpart .ribbon').replaceWith('<div class="ribbon ribbon-top-right ribbonred"><span>Withdrawn</span></div>');
						}
				  	if(response.fail){
							jQuery.unblockUI();
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
			}else{
				jQuery.unblockUI();
			}
		});
	});

	jQuery('body').on( "click", '#send-counter-offer', function(ev) {
		ev.preventDefault();
  	button = jQuery(this);
		var form_data = jQuery('#offer-form').serializeArray();
		form_data.push({name: "proposal_id", value: cortiamajax.proposal_id});
		jQuery.ajax({
			type: "post",
			url: cortiamajax.counterofferurl,
		  data: form_data,
			dataType: "json",
			beforeSend: function() {
				jQuery('#offer-form').block({message: '<img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#ffffff',opacity:.9}});
			},
			success: function(response){
				if(response.success){
					jQuery('.buttonsrow, .messagebutton').remove();
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
					jQuery('#offer-form').unblock();
		  	}
				if(response.errorfields){
					jQuery.each(response.errorfields, function(index, value) {
						if(jQuery("#"+index).hasClass('select2-hidden-accessible')){
							jQuery("#"+index).next('span.select2-container').find('.select2-selection--single').addClass("border-danger").one("focus", function() {
								jQuery(this).removeClass("border-danger");
							});
						}else{
							jQuery("#"+index).addClass("border-danger").one("focus", function() {
								jQuery(this).removeClass("border-danger");
							});
						}
			    });
				}
			}
		});
	});

	jQuery('body').on( "click", '#cancel-counter-offer', function(ev) {
		ev.preventDefault();
		jQuery.unblockUI();
	});

	$(document).on('change', '.select-date', function (e) {

		jQuery.ajax({
			type: "post",
			url: cortiamajax.getagentslotsurl,
			data: {'agent_id' : cortiamajax.ç, 'day' : $(this).val()},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(response){


				if (response.length > 0) {
					$('#available-slots').html('');
					for (let index = 0; index < response.length; index++) {
						$('#available-slots').append(`<option value="${response[index].slot_time}">${response[index].slot_time}</option>`)

					}
				}
				else {
					$('#available-slots').html('');
					$('#available-slots').append(`<option value="">No Time Slot Available This Day</option>`)
				}

				jQuery.unblockUI();
			}
		});
	});

});

var d = new Date();
var numberOfDays = getDaysInMonth(d.getMonth() + 1, d.getFullYear())
var selecteDates = new Array();
var getDays = '';
if(getDays == '' )
{
	getDays = $('#getDays').val();
}

getDays = getDays.replace(/\s/g, '');
var string = getDays;
var totalGetArray = string.split(",");
var datesForDisable = '';
var selectedmonth  = 0;
var selectedYear   = 0;

for (var i = 1; i <= numberOfDays; i++)
{
	let dayNmber = 0;
	if ( i < 10 )
	{
		dayNmber = "0" + i;
	}else{
		dayNmber = i;

	}
	selectedmonth = d.getMonth() + 1;
	selectedYear   = d.getFullYear() ;
	if ( selectedmonth < 10 )
	{
		selectedmonth = '0'+selectedmonth;
	}else{
		selectedmonth = selectedmonth;
	}

	var  currentDate = selectedmonth+"/"+dayNmber+"/"+d.getFullYear();

	if($.inArray(currentDate, totalGetArray) !== -1)
	{
		selecteDates.push(currentDate);
	}

}

function getDaysInMonth(month,year) {
	return new Date(year, month, 0).getDate();
}

function monthssetting()
{
	selecteDates  = new Array();
	var numberOfDays = getDaysInMonth(selectedmonth , selectedYear);
	for (var i = 1; i <= numberOfDays; i++)
	{
		let dayNmber = 0;
		if ( i < 10 )
		{
			dayNmber = "0" + i;
		}else{
			dayNmber = i;

		}
		var  currentDate = selectedmonth+"/"+dayNmber+"/"+d.getFullYear();
		if($.inArray(currentDate, totalGetArray) !== -1)
		{
			if(currentDate !== '')
			{
				selecteDates.push(currentDate);
			}
		}

	}


}


function unavailable(date) {
	let getDay = date.getDate();
	let getMonth = 0;

	getMonth = selectedmonth;

	let takeDays = $('#getDays').val();

	takeDays = takeDays.replace(/\s/g, '');
	selecteDates = takeDays.split(",");

	let dayNmber = 0;
	if ( getDay < 10 )
	{
		dayNmber = "0" + getDay;
	}else{
		dayNmber = getDay;
	}
	let monthNmber = 0;
	monthNmber = getMonth;
	mdy = monthNmber+"/" +  dayNmber + "/" + selectedYear;

	if($.inArray(mdy, selecteDates) !== -1)
	{
		return [true, ""];
	}
	return [false, "", "Unavailable"];

}
var setcondtionfindDates = false;

function datePickerCall()
{
	$("#select-date" ).datepicker( "destroy" );
	$( "#select-date" ).datepicker({
		minDate: 0,
		onSelect : function(){
			$.ajax({
				type: "post",
				url: cortiamajax.getagentslotsurl,
				data: {'agent_id' : cortiamajax.agent_id, 'day' : $(this).val()},
				dataType: "json",
				success: function(response){
					if (response.length > 0) {
						$('#available-slots').html('');
						for (let index = 0; index < response.length; index++) {
							$('#available-slots').append(`<option value="${response[index].slot_time}">${response[index].slot_time}</option>`)

						}
					}else {
						$('#available-slots').html('');
						$('#available-slots').append(`<option value="">No Time Slot Available This Day</option>`)
					}
				}
			});
		},
		beforeShowDay: function(date){
			if(setcondtionfindDates == true)
			{
				return [false, ""];
			}
			var selectedDateString =  $('#getDays').val();
			var selectedDateArray  = selectedDateString.split(',');
			var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
			return [ selectedDateArray.indexOf(string) == -1 ]
		},
		onChangeMonthYear: function(year, month, inst) {

			var selectdMonthString = $('#monthArray').val();
			var selectedDateArray = selectdMonthString.split(',');
			var yearArray = $('#yearArray').val();
			var selectedYyearArray = yearArray.split(',');
			year = year.toString();

			let monthNmber = 0;
			if (month < 10) {
				monthNmber = "0" + month;
			} else {
				monthNmber = month;
			}

			if ($.inArray(monthNmber, selectedDateArray) !== -1 && $.inArray(year, selectedYyearArray) !== -1) {
				setcondtionfindDates = false;
			} else {
				setcondtionfindDates = true;
			}
		}

	});

}