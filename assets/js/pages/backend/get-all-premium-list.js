jQuery(document).ready(function() {

    ourdatatable  = jQuery('#premiumlist').DataTable({
	processing	: true,
	serverSide	: true,
	responsive 	: true,
	order 		: [[ 0, "desc" ]],
	paging  	: true,
	pageLength  : 25,
	lengthMenu  : [ 10, 25, 50, 75, 100 ],
	type        : 'POST',
  	language: {
        searchPlaceholder: "Search..."
    	},
	ajax: {
	  url: cortiamajax.premiumlisting,
	  data: function (d) {
			// d.email = $('.searchEmail').val(),
			// d.search = $('input[type="search"]').val()
		}
	},
	columns: [
		{data: 'date_range', name: 'date_range',},
		{data : 'first_name',  name : 'first_name'},
		{data: 'type', name: 'type'},
		{data: 'state_id', name: 'state_id'},
		{data: 'city_id', name: 'city_id'},
		{data: 'description', name: 'description'},
        {data: 'status_price', name: 'status_price'},
        {data: 'action', name: 'action'},
	],columnDefs: [ {
			'targets': [5, 7], // column index (start from 0)
			'orderable': false, // set orderable false for selected columns
		}]
	});

	$(document).on('click', '.cancelOrder', function(){

		let order_id = $(this).attr('data-order-id');
		let agent_id = $(this).attr('data-agent-id');
		let amount   = $(this).attr('data-agent-amount');

		Swal.fire({
			title: 'Are you sure you want to cancel the listing? The agent will be refunded an amount of $'+amount,
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Ok',
			denyButtonText: 'cancel',
			confirmButtonClass: "btn btn-success",
			cancelButtonClass: "btn btn-danger"
		}).then((result) => {
			jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'42%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});

			if(result.value){
				jQuery.ajax({
					type: "post",
					url: cortiamajax.cancelstatus,
					dataType : "json",
					data:{order_id :  order_id, agent_id : agent_id},
					success: function(response){

						if(response.success)
						{
							jQuery.unblockUI();
							swal.fire({
								title: "Listing canceled successfully",
								type: response.success,
								confirmButtonClass: "btn btn-success"
							});


							ourdatatable.draw();
						}
					}
				});
			}else{
				jQuery.unblockUI();
			}
		});



	});
});

