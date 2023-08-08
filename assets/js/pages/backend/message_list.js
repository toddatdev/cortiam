jQuery(document).ready(function() {
	$.fn.dataTable.moment( 'YYYY-MM-DD hh:mm A' );
  messagedatatable = jQuery('#messagetable').DataTable({
      dom: '<"datatable-header"lf><"datatable-scroll-wrap"t><"datatable-footer"ip>',
      "responsive": true,
      "autoWidth": false,
      "bAutoWidth": false,
      "colReorder": true,
      "order": [[ 3, "desc" ]],
      "paging": true,
      "pageLength": 25,
      "lengthMenu": [ 10, 25, 50, 75, 100 ],
  		"language": {
	      "zeroRecords": "No message at this moment.",
	      "loadingRecords": '<div style="display:inline-block;width:100%;text-align:center;height:30px;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>'
	    },
	    "rowId":function(a) {
		    return 'message-' + a.record_id;
		  },
      "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
	      jQuery(nRow).attr("data-record", aData.record_id);
	      jQuery(nRow).addClass("clickmetrigger");
	      return nRow;
      },
			"columnDefs": [
			  { "type": "string", "targets": 0, "data": "from", "title": "Message From", "width": "120px", "className": "text-left"},
			  { "type": "string", "targets": 1, "data": "to", "title": "Message To", "width": "120px", "className": "text-left"},
			  { "type": "string", "targets": 2, "data": "title", "title": "Title", "width": "250px"},
			  { "type": "date",  	"targets": 3, "data": "date", "title": "Date", "width": "120px"},
			  { "type": "html", "targets": 4, "data": "status", "title": "Status", "width": "100px", "className": "text-center"},
			],
			"ajax": {
        'type': 'POST',
        'url': cortiamajax.messagetableajaxurl,
	    },
  });


	jQuery('body').on( "click", '.clickmetrigger', function(ev) {
		ev.preventDefault();
  	record_id = jQuery(this).data('record');
		jQuery.ajax({
			type: "post",
			url: cortiamajax.viewmessageurl,
  		data: {'record_id' : record_id},
			dataType: "json",
			beforeSend: function() {
				jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'10%',left:'0%',background:'transparent', cursor:'context-menu'},overlayCSS: {backgroundColor:'#000000',opacity:.7}});
			},
			success: function(response){
				if(response.success){
					swal.fire({
						html: response.html,
						confirmButtonText : 'Close',
						customClass: {
					    confirmButton: 'btn btn-secondary',
					    popup: 'longerpop'
					  }
					});
				}
		  	if(response.fail){
					swal.fire({
						title: response.fail_title,
						text: response.fail_message,
						type: "error",
						confirmButtonClass: "btn btn-success"
					});
		  	}
				jQuery.unblockUI();
			}
		});
	});
});

$(document).ready(function() {
	$('.send-mail-to-multiple-users').select2();
});