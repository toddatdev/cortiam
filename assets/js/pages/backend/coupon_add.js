jQuery(document).ready(function() {
  jQuery('.maxlength-textarea').maxlength({
      alwaysShow: true,
  });

	jQuery('#coupon_type').select2({
  	minimumResultsForSearch: Infinity,
  }).on('select2:select', function (e) {
  	jQuery('#type_append').html(jQuery(e.params.data.element).data('append'));
  	jQuery('#type_prepend').html(jQuery(e.params.data.element).data('prepend'));
	});

	jQuery('#coupon_code').alphanum({
	  allowSpace: false,
	  allowNewline: false,
	  allowOtherCharSets: false,
	});

  jQuery('#couponrange').daterangepicker({
      applyClass: 'btn-primary',
      cancelClass: 'btn-light',
      ranges: {
          'Today': [moment(), moment()],
          'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
          'This Week': [moment().startOf('week'), moment().endOf('week')],
          'Next Week': [moment().add(1, 'week').startOf('week'), moment().add(1, 'week').endOf('week')],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
          'This Year': [moment().startOf('year'), moment().endOf('year')],
      },
      startDate: moment().startOf('month'),
      endDate: moment().endOf('month'),
      opens: 'left',
  }, function (start, end) {
		jQuery('#couponrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		jQuery('#begin_date').val(start.format('MMMM D, YYYY'));
		jQuery('#end_date').val(end.format('MMMM D, YYYY'));
  });
});


jQuery('#coupon_amount').keyup(function(){

    if($('#coupon_type').val() == 'Percentage')
    {
        if($(this).val() > 100)
        {
            $(this).val('');

            swal.fire({
                title: "Info",
                text: "Please enter discount less then 100%",
                type: "info",
                confirmButtonClass: "btn btn-success"
            });
        }
    }
});

$("#coupon_type").on('change', function(){
    if($('#coupon_type').val() == 'Percentage')
    {
        if($('#coupon_amount').val() > 100)
        {
            $('#coupon_amount').val('');

            swal.fire({
                title: "Info",
                text: "Please enter discount less then 100%",
                type: "info",
                confirmButtonClass: "btn btn-success"
            });

            $('#coupon_amount').focus();

        }
    }
});