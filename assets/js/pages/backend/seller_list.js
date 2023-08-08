jQuery(document).ready(function() {
	function buildTableData(){
		var obj = {
			start_date: jQuery("input[name='start_date']" ).val(),
			end_date: jQuery("input[name='end_date']" ).val(),
			status: jQuery("select[name='status']" ).val(),
		};
		return obj;
	}

	$.fn.dataTable.moment( 'D MMMM, YYYY' );


  seller();


  jQuery(document).on('change', '#userType', function(){


      if($(this).val() == 'Buyer')
      {
        $('#accountstable').DataTable().destroy();
        $('#accountstable').css('display', 'none');

        $('#accountstablebuyer').css('display', 'block');

        buyer();

      }else{


        $('#accountstablebuyer').DataTable().destroy();
        $('#accountstablebuyer').css('display', 'none');
        $('#accountstable').css('display', 'block');
        seller();

      }
  })

});



function seller(){

  function buildTableData(){
		var obj = {
			start_date: jQuery("input[name='start_date']" ).val(),
			end_date: jQuery("input[name='end_date']" ).val(),
			status: jQuery("select[name='status']" ).val(),
		};
		return obj;
	}

	$.fn.dataTable.moment( 'D MMMM, YYYY' );

  ourdatatable = jQuery('#accountstable').DataTable({
    dom: '<"datatable-buttons"B><"datatable-header"lf><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    language: {
        search: '<span>Filter:</span> _INPUT_',
        searchPlaceholder: 'Type to filter...',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
    },
    "responsive": true,
    "autoWidth": false,
    "bAutoWidth": false,
    "colReorder": true,
    "order": [],
    "paging": true,
    "pageLength": 25,
    "lengthMenu": [ 10, 25, 50, 75, 100 ],
    "oLanguage": {
      sLoadingRecords: '<div style="display:inline-block;width:100%;text-align:center;height:30px;"><div class="kt-spinner kt-spinner--lg kt-spinner--center kt-spinner--dark"></div></div>'
    },
    "rowId":function(a) {
      return 'record-' + a.user_id;
    },
    "columnDefs": [
      { "type": "string", "targets": 0, "data": "user_image", "title": "", "width": "80px"},
      { "type": "string", "targets": 1, "data": "fullname", "title": "Full Name", "width": "200px"},
      { "type": "html",  	"targets": 2, "data": "phone", "orderable": false, "title": "Phone Number", "width": "140px"},
      { "type": "html",  	"targets": 3, "data": "email", "title": "Email", "width": "250px" },
      { "type": "html",  	"targets": 4, "data": "type", "title": "Type", "width": "250px" },
      { "type": "html",  	"targets": 5, "data": "location", "title": "Location", "width": "250px" },
      { "type": "date",   "targets": 6, "data": "created_on", "title": "Created On", "width": "200px" },
      { "type": "html",   "targets": 7, "data": "status", "orderable": false, "searchable": false, "className": "text-center", "width": "100px" },
      { "type": "html",   "targets": 8, "data": "actions", "orderable": false, "searchable": false, "width": "150px" },
    ],
    buttons: {
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
              {
                  extend: 'print',
                  text: ' Print',
                  className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                  exportOptions: {
                    columns: ':visible'
                  }
              },
            {
                extend: 'excelHtml5',
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                customize: function (doc) {
                  doc.content[1].table.widths =
                      Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                },
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: '<i class="icon-three-bars"></i>',
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate btn-icon dropdown-toggle'
            }
        ]
    },
    "ajax": {
      'type': 'POST',
      'url': cortiamajax.datatableajaxurl,
      'data': buildTableData
    },
  } );

}


function buyer()
{
  function buildTableData(){
		var obj = {
			start_date: jQuery("input[name='start_date']" ).val(),
			end_date: jQuery("input[name='end_date']" ).val(),
			status: jQuery("select[name='status']" ).val(),
		};
		return obj;
	}

	$.fn.dataTable.moment( 'D MMMM, YYYY' );
  ourdatatable = jQuery('#accountstablebuyer').DataTable({
    dom: '<"datatable-buttons"B><"datatable-header"lf><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    language: {
        search: '<span>Filter:</span> _INPUT_',
        searchPlaceholder: 'Type to filter...',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
    },
    "responsive": true,
    "autoWidth": false,
    "bAutoWidth": false,
    "colReorder": true,
    "order": [],
    "paging": true,
    "pageLength": 25,
    "lengthMenu": [ 10, 25, 50, 75, 100 ],
    "oLanguage": {
      sLoadingRecords: '<div style="display:inline-block;width:100%;text-align:center;height:30px;"><div class="kt-spinner kt-spinner--lg kt-spinner--center kt-spinner--dark"></div></div>'
    },
    "rowId":function(a) {
      return 'record-' + a.user_id;
    },
    "columnDefs": [
      { "type": "string", "targets": 0, "data": "user_image", "title": "", "width": "80px"},
      { "type": "string", "targets": 1, "data": "fullname", "title": "Full Name", "width": "200px"},
      { "type": "html",  	"targets": 2, "data": "phone", "orderable": false, "title": "Phone Number", "width": "140px"},
      { "type": "html",  	"targets": 3, "data": "email", "title": "Email", "width": "250px" },
      { "type": "html",  	"targets": 4, "data": "type", "title": "Type", "width": "250px" },
      { "type": "html",  	"targets": 5, "data": "location", "title": "Location", "width": "250px" },
      { "type": "date",   "targets": 6, "data": "created_on", "title": "Created On", "width": "200px" },
      { "type": "html",   "targets": 7, "data": "status", "orderable": false, "searchable": false, "className": "text-center", "width": "100px" },
      { "type": "html",   "targets": 8, "data": "actions", "orderable": false, "searchable": false, "width": "150px" },
    ],
    buttons: {
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
              {
                  extend: 'print',
                  text: ' Print',
                  className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                  exportOptions: {
                    columns: ':visible'
                  }
              },
            {
                extend: 'excelHtml5',
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                customize: function (doc) {
                  doc.content[1].table.widths =
                      Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                },
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: '<i class="icon-three-bars"></i>',
                className: 'btn btn-outline bg-slate-800 text-slate-800 border-slate btn-icon dropdown-toggle'
            }
        ]
    },
    "ajax": {
      'type': 'POST',
      'url': cortiamajax.datatablebuyerajaxurl,
      'data': buildTableData
    },
  });

}