jQuery(document).ready(function () {

    getPremiumListing();


});

$("#licenseState").select2({
    placeholder: "Select a state",
    allowClear: true,
});
$("#premium-listing-cities").select2({
    placeholder: "Select a cities",
    maximumSelectionLength: 10,
    allowClear: true,
});

$("#chooseOption").select2({
    placeholder: "Select a Choice",
    allowClear: true,
    minimumResultsForSearch: -1,

});

$("#selectedBundle").select2({
    placeholder: "Select a bundle",
    allowClear: true,
});


let getSettingValue = $('#getSettingValue').val();
let remainingDays = getSettingValue - 1;


$('#chooseOption').change(function () {
    let selection = $(this).val();
    if (selection === 'bundle') {
        $('.bundle-tab').css('display', 'block');
        $('.customize-tab-date-range').css('display', 'none');
        $('.customize-tab-state').css('display', 'none');
    } else {
        $('.bundle-tab').css('display', 'none');
        $('.customize-tab-date-range').css('display', 'block');
        $('.customize-tab-state').css('display', 'block');

        $('.date-time').daterangepicker({
            opens: 'left',
            minDate: new Date(),
            "autoApply": true,
            "drops": "up",
            "maxSpan": {
                "days": remainingDays,
            },
            // maxDate: moment(departpicker, 'YYYY-MM-DD').add(getSettingValue, 'days'),
        }, function (start, end, label) {

        });


    }
});


$('#selectedBundle').change(function () {
    let state_id = $(this).find(':selected').attr('data-val');
    let bundleDays = $(this).find(':selected').attr('data-days');

    $type = $('#chooseOption').val();

    if ($type == "bundle") {
        var remainingBundleDays = bundleDays - 1;
    }

    if (state_id !== null && state_id > 0) {

        $.ajax({
            url: "agent/ajax/get-licence-state-cities",
            type: "POST",
            dataType: "json",
            data: {
                cache: false,
                id: state_id
            },
            success: function (dataResult) {
                let data = [];
                if (dataResult) {
                    $("#premium-listing-cities").html("");
                    $.each(dataResult, function (i, data) {
                        $('#premium-listing-cities').append($('<option>', {
                            value: data.city_id,
                            text: data.city_name
                        }));
                    });


                    $('.date-time').daterangepicker({
                        opens: 'left',
                        minDate: new Date(),
                        "autoApply": true,
                        "drops": "up",
                        "maxSpan": {
                            "days": remainingBundleDays,
                        },

                    }, function (start, end, label) {

                    });


                    $("#premium-listing-cities").val('').trigger('change');

                }
            }
        });
    }

})


$('#licenseState').change(function () {

    let state_id = $(this).val();
    if ($(this).val() !== null) {
        $.ajax({
            url: "agent/ajax/get-licence-state-cities",
            type: "POST",
            dataType: "json",
            data: {
                cache: false,
                id: $(this).val()
            },
            success: function (dataResult) {
                let data = [];

                if (dataResult) {
                    $("#premium-listing-cities").html("");
                    $.each(dataResult, function (i, data) {
                        $('#premium-listing-cities').append($('<option>', {
                            value: data.city_id,
                            text: data.city_name
                        }));

                    });

                    $("#premium-listing-cities").val('').trigger('change');


                }
            }
        });
    }
});


$('#premium-listing-cities').on('select2:select', function (e) {

    let selectedType = $('#chooseOption').val();

    if (selectedType == "bundle") {
        var selectedDateRange = $('#bundle-date-time').val();
        var stateID = $('#selectedBundle').find(':selected').attr('data-val');
    } else {
        var selectedDateRange = $('#customize-date-time').val();
        var stateID = $('#licenseState').val();
    }

    let cityArray = $('#premium-listing-cities').val();
    let collectionOfArray = new Array();

    for (let index = 0; index < cityArray.length; index++)
    {
        collectionOfArray.push(cityArray[index]);        
    }

    // let stateID = $('#licenseState').val();
    // let lastIndex = cityId.length;
    // let currentCity = cityId[lastIndex - 1];

    $.ajax({
        url: "agent/ajax/check-agents-state-counts",
        type: "POST",
        dataType: "json",
        data: {
            cache: false,
            city_id: e.params.data.id,
            state_id: stateID,
            selected_date_range: selectedDateRange
        },
        success: function (data) {
            // let data = [];       

            var maxCity = data.maxCities;
            var maxCityLimit = 10 - maxCity;

            $("#premium-listing-cities").select2('destroy');

            $("#premium-listing-cities").select2({
                placeholder: "Select a cities",
                maximumSelectionLength: maxCityLimit,
                allowClear: true,
            });

            if (data.error == "Error") {
                Swal.fire({
                    icon: data.error,
                    title: data.title,
                    showConfirmButton: true,
                    type: "error",
                    confirmButtonClass: "btn btn-secondary",
                    confirmButtonColor: '#00c48d',
                })

                $('.select2-selection__choice').each(function(i, obj) {

                    if($(this).attr('title') == data.city_name)
                    {
                        $(this).find('.select2-selection__choice__remove').click();
                    }
                    
                });
                // $('#premium-listing-cities').val('').trigger('change');
            }

            // $('#date-time').val('');

            // var totalDays = data.count_date_range_days;

            let dates = [];
            data.allAgentsPremiumListing.map(item => {

                let fromDate = moment(item.start_date)
                let toDate = moment(item.end_date)
                let diff = toDate.diff(fromDate, 'days')
                let range = []
                for (let i = 0; i < diff + 1; i++) {
                    dates.push(moment(item.start_date).add(i, 'days').format('MM-DD-YYYY'))
                }

            });



            $(function () {
                var departpicker = new Date();

                $('.date-time').daterangepicker({
                    opens: 'left',
                    minDate: new Date(),
                    "drops": "up",
                    "maxSpan": {
                        "days": remainingDays,
                    },

                    // "isInvalidDate": function (date) {
                    //
                    //     if (dates.indexOf(date.format('MM-DD-YYYY')) !== -1) {
                    //         return true;
                    //     } else {
                    //         return false;
                    //     }
                    // }

                    // maxDate: moment(departpicker, 'YYYY-MM-DD').add(getSettingValue, 'days'),
                }, function (start, end, label) {

                });
            });

        }
    });

});


$('#savePremiumPackage').click(function () {

    $(this).removeAttr('id');
    $(this).css({'cursor' :"default"});

    let error = false;

    if (!$('#chooseOption').val()) {
        $('#optionError').css('display', 'block');
        error = true;
    } else {
        $('#optionError').css('display', 'none');
    }

    if ($('#chooseOption').val() == 'bundle') {
        if (!$('#selectedBundle').val()) {
            $('#bundleError').css('display', 'block');
            error = true;
        } else {
            $('#bundleError').css('display', 'none');
        }
    } else {

        if (!$('#licenseState').val()) {
            $('#licenseError').css('display', 'block');
            error = true;
        } else {
            $('#licenseError').css('display', 'none');
        }

    }


    if ($('#premium-listing-cities').val() == '' || !$('#premium-listing-cities').val()) {
        $('#cityError').css('display', 'block');
        error = true;

    } else {
        $('#cityError').css('display', 'none');

    }

    if (error == true) {
        $('.savePremiumPackage').attr('id', 'savePremiumPackage');

        return false;
    }

    $('#addNewPremiumListQueryModal').modal('hide');

    jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'42%',left:'0%',background:'transparent',  cursor:'context-menu'},overlayCSS: {backgroundColor:'#fff',opacity:.7}});
    jQuery.ajax({
        type: "post",
        url: cortiamajax.savePackage,
        data: $('#bundleForm').serialize(),
        success: function (response) {

            if (response > 1) {

                $('#savePremiumPackage').css({'cursor':"pointer"});
                $('.savePremiumPackage').attr('id', 'savePremiumPackage');

                $('#bundleForm')[0].reset();
                $("#addNewPremiumListQueryModal").modal('hide');

                $("#licenseState").select2('destroy');
                $("#selectedBundle").select2('destroy');

                $("#premium-listing-cities").select2('destroy');

                $("#selectedBundle").select2({
                    placeholder: "Select a bundle",
                    allowClear: true,
                });
                $("#licenseState").select2({
                    placeholder: "Select a state",
                    allowClear: true,
                });

                $("#premium-listing-cities").select2({
                    placeholder: "Select a city",
                    maximumSelectionLength: 10,
                    allowClear: true,
                });
                jQuery.unblockUI();

                Swal.fire({
                    icon: 'success',
                    title: 'Record has been added successfully',
                    showConfirmButton: true,
                    type: "success",
                    confirmButtonClass: "btn btn-secondary",
                    confirmButtonColor: '#00c48d',

                })
                $('#chooseOption').val('').trigger('change');
                $("#premium-listing-cities").val('').trigger('change');
                getPremiumListing();

            } else {
                $('#editStateError').css("display", "none");
                $('#editStateError').text("Pleae select a state");
                // $('#editNumberofAgentsError').css("display", "none");
                // $('#editNumberofAgentsError').text("This field is required");

                $('#bundleForm')[0].reset();
                $('.close').click();

            }

        }
    });

});


$(document).on('click', '.btndeleteRecord', function () {

    let agent_id = $(this).attr('data-id');
    let state_id = $(this).attr('data-state-id');
    let date_range = $(this).attr('data-range');


    Swal.fire({
        title: 'Do you want to Delete the record?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ok',
        denyButtonText: 'cancel',
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        confirmButtonColor: '#00c48d',

    }).then((result) => {
        if (result.value) {

            jQuery.ajax({
                type: "post",
                url: cortiamajax.deletePremiumRecord,
                dataType: "json",
                data: {agent_id, agent_id, state_id: state_id, date_range: date_range},
                success: function (response) {

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Record deleted successfully',
                            showConfirmButton: true,
                            type: "success",
                            confirmButtonClass: "btn btn-secondary",
                            confirmButtonColor: '#00c48d',
                        })

                        getPremiumListing();
                    }

                }
            });
        }
    });

});


function getPremiumListing() {

    jQuery.ajax({
        type: "post",
        url: cortiamajax.premiumlisting,
        dataType: "json",
        data: $('#bundleForm').serialize(),
        success: function (response) {
            $('#premiumListingtbl').empty();
            let totalPrice = 0;
            let order_id = 0;
            let dateRange = 0
            let counterTableSet = 0;
            let oldState = 0;
            let oldType = 0;

            let citiesArray = new Array();

            if (response.data.length > 0) {
                for (i = 0; i < response.data.length; i++) {
                    let cities = '';
                    let currentCity = '';
                    let dateRanges = '';
                    if (response.data[i]['city']) {
                        citiesArray = response.data[i]['city'];
                        let state_id = response.data[i]['state_id'];
                        let city_id = response.data[i]['city_id'];
                        let agent_id = response.data[i]['agent_id'];
                        dateRange = response.data[i]['dateRange'];

                        dateRanges += '<span class="mb-1 align-items-center">' + dateRange + '</span> ';

                        let counter = 0;

                        for (j = 0; j < citiesArray.length; j++) {

                            city_id = citiesArray[j].city_id;
                            currentCity = citiesArray[j].city;

                            if (typeof currentCity !== "undefined") {

                                cities += '<span class="mb-1 align-items-center badge badge-dark p-1">' + ++counter + " : " + currentCity + ' ' +

                                    '<a href="javascript:void(0);" class="remove-single-city" data-date-range="' + dateRange + '" data-agent-id="' + agent_id + '" data-state-id="' + state_id + '" data-city-id="' + city_id + '" aria-label="Close">' +
                                    '  <span aria-hidden="true" class="text-white ml-1 px-1" style="background-color: #ff0000">&times;</span>\n' +
                                    '</a>' +
                                    '</span> ';
                            }

                        }

                    }
                    //console.log(dateRange);
                    if ((counterTableSet !== dateRange || oldState !== response.data[i]['state'] || oldType !== response.data[i]['type']) && (response.data[i]['status_price'] !== "Paid") && response.data[i]['status_price'] !== "Canceled") {

                        counterTableSet = dateRange;
                        oldState = response.data[i]['state'];
                        oldType = response.data[i]['type'];
                        let tr = '';
                        tr += '<tr class="premium' + response.data[i]['id'] + '">';
                        tr += '<td class="text-center px-1" style="font-size: 12px !important;font-weight: 500 !important;">';
                        tr += dateRanges;
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += capitalize(response.data[i]['type']);
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += response.data[i]['state'];
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += cities;
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += '$' + response.data[i]['price'];
                        tr += '</td>';
                        // tr += '<td>';
                        // tr += response.data[i]['status_price'];
                        // tr += '</td>';
                        tr += '<td>';
                        // tr += '<a class="btn btn-sm btn-primary checkoutpayment" href="javascript:void(0);" data-toggle="modal" data-target="#paymentModal">Checkout</a> ';
                        tr += '<div class="btn-group"><a class="btn btn-sm mr-1 rounded btn-danger btndeleteRecord"  ' +
                            'href="javascript:void(0);" style="font-size: 13px !important;" data-state-id="' + response.data[i]['state_id'] + '" data-id="' + response.data[i]['agent_id'] + '" data-range="' + response.data[i]['dateRange'] + '" >Delete</a> ';
                        tr += '<a href="javascript:void(0);" style="font-size: 13px !important;" class="editCities btn btn-success btn-sm rounded px-3" data-order-id="'+response.data[i]['order_id']+'" data-agent-id="'+response.data[i]['agent_id']+'">Edit</td></div></a>';

                        if (response.data[i]['status_price'] == 'Unpaid') {
                            totalPrice = totalPrice + parseFloat(response.data[i]['price']) + 0;

                        }


                        $('#premiumListingtbl').append(tr);
                        order_id = response.data[i]['order_id'];

                    }

                }

                totalPrice = parseFloat(totalPrice).toFixed(2);
                var base_url = window.location.origin;
                let premiumCheckoutUrl = '';

                if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
                    premiumCheckoutUrl = base_url + '/cortiam/agent/checkout-premium-bundle/' + totalPrice + '/' + order_id;
                } else {
                    premiumCheckoutUrl = base_url + '/agent/checkout-premium-bundle/' + totalPrice + '/' + order_id;
                }


                if (totalPrice > 0) {
                    let lastRow = '<tr>\n' +
                        '                            <td colspan="7" class="text-right " style="font-size: 20px !important;">\n' +
                        '                                <span>Total Price:</span>\n' +
                        '                                 <span class="font-weight-bold " style="font-size: 24px !important;">$' + totalPrice + '</span>\n' +
                        '                                <span>\n' +
                        '                                    <a href="' + premiumCheckoutUrl + '" class="btn btn-primary ml-3">Checkout All</a>\n' +
                        '                                </span>\n' +
                        '                            </td>\n' +
                        '                        </tr>';

                    $('#premiumListingtbl').append(lastRow);


                }


                $('#premiumListingtblPaid').empty();

                oldType = 0;
                for (i = 0; i < response.data.length; i++) {

                    // console.log(response.data);
                    let cities = '';
                    let currentCity = '';
                    let dateRanges = '';
                    if (response.data[i]['city']) {
                        citiesArray = response.data[i]['city'];
                        let state_id = response.data[i]['state_id'];
                        let city_id = response.data[i]['city_id'];
                        let agent_id = response.data[i]['agent_id'];
                        dateRange = response.data[i]['dateRange'];

                        dateRanges += '<span class="mb-1 align-items-center">' + dateRange + '</span> ';

                        let counter = 0;
                        for (j = 0; j < citiesArray.length; j++) {

                            city_id = citiesArray[j].city_id;
                            currentCity = citiesArray[j].city;

                            if (typeof currentCity !== "undefined") {
                                cities += '<span class="mb-1 align-items-center badge badge-dark p-1">' + ++counter + " : " + currentCity + ' ' +

                                    '</span> ';
                            }

                        }

                    }
                    //console.log(dateRange);
                    let order_id = 0;
                    if ((counterTableSet !== dateRange || oldState !== response.data[i]['state'] || oldType !== response.data[i]['type']) && response.data[i]['status_price'] == "Paid") {

                        counterTableSet = dateRange;
                        oldState = response.data[i]['state'];
                        oldType = response.data[i]['type'];

                        let tr = '';
                        tr += '<tr class="premium' + response.data[i]['id'] + '">';
                        tr += '<td class="text-center px-1" style="font-size: 12px !important;font-weight: 500 !important;">';
                        tr += dateRanges;
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += capitalize(response.data[i]['type']);
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += response.data[i]['state'];
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += cities;
                        tr += '</td>';
                        tr += '<td class="text-center font-weight-bold">';
                        tr += '<span class="badge px-2 text-white" style="font-size: 12px;background-color: #509150">' + response.data[i]['status_price'] + '</span>'
                        tr += '</td>';
                        // tr += '<td>';
                        // tr += response.data[i]['status_price'];
                        // tr += '</td>';
                        // tr += '<a class="btn btn-sm btn-primary checkoutpayment" href="javascript:void(0);" data-toggle="modal" data-target="#paymentModal">Checkout</a> ';


                        if (response.data[i]['status_price'] == 'Unpaid') {
                            totalPrice = totalPrice + parseFloat(response.data[i]['price']) + 0;

                        }


                        $('#premiumListingtblPaid').append(tr);
                        order_id = response.data[i]['order_id'];

                    }

                }




                $('#canceledPremiumListingtbl').empty();

                oldType = 0;
                for (i = 0; i < response.data.length; i++) {

                    // console.log(response.data);
                    let cities = '';
                    let currentCity = '';
                    let dateRanges = '';
                    if (response.data[i]['city']) {
                        citiesArray = response.data[i]['city'];
                        let state_id = response.data[i]['state_id'];
                        let city_id = response.data[i]['city_id'];
                        let agent_id = response.data[i]['agent_id'];
                        dateRange = response.data[i]['dateRange'];

                        dateRanges += '<span class="mb-1 align-items-center">' + dateRange + '</span> ';

                        let counter = 0;
                        for (j = 0; j < citiesArray.length; j++) {

                            city_id = citiesArray[j].city_id;
                            currentCity = citiesArray[j].city;

                            if (typeof currentCity !== "undefined") {
                                cities += '<span class="mb-1 align-items-center badge badge-dark p-1">' + ++counter + " : " + currentCity + ' ' +

                                    '</span> ';
                            }

                        }

                    }
                    //console.log(dateRange);
                    let order_id = 0;
                    if ((counterTableSet !== dateRange || oldState !== response.data[i]['state'] || oldType !== response.data[i]['type']) && response.data[i]['status_price'] == "Canceled") {

                        counterTableSet = dateRange;
                        oldState = response.data[i]['state'];
                        oldType = response.data[i]['type'];

                        let tr = '';
                        tr += '<tr class="premium' + response.data[i]['id'] + '">';
                        tr += '<td class="text-center px-1" style="font-size: 12px !important;font-weight: 500 !important;">';
                        tr += dateRanges;
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += capitalize(response.data[i]['type']);
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += response.data[i]['state'];
                        tr += '</td>';
                        tr += '<td class="text-center">';
                        tr += cities;
                        tr += '</td>';
                        tr += '<td class="text-center font-weight-bold">';
                        tr += '<span class="badge px-2 text-white" style="font-size: 12px;background-color: #e8641d">' + response.data[i]['status_price'] + '</span>'
                        tr += '</td>';
                        // tr += '<td>';
                        // tr += response.data[i]['status_price'];
                        // tr += '</td>';
                        // tr += '<a class="btn btn-sm btn-primary checkoutpayment" href="javascript:void(0);" data-toggle="modal" data-target="#paymentModal">Checkout</a> ';


                        if (response.data[i]['status_price'] == 'Unpaid') {
                            totalPrice = totalPrice + parseFloat(response.data[i]['price']) + 0;

                        }


                        $('#canceledPremiumListingtbl').append(tr);
                        order_id = response.data[i]['order_id'];

                    }

                }


            }
        }
    });

}

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}


$(document).on('click', '.editCities', function(){
    let agent_id = $(this).attr('data-agent-id');
    let order_id = $(this).attr('data-order-id');
    $('#addNewPremiumListQueryModal').modal('show');

    $('#order_id').val(order_id);

    jQuery.ajax({
        url: "agent/ajax/get_premium_data",
        type: "post",
        data: {agent_id: agent_id, order_id : order_id},
        dataType: "json",
        cache: false,
        success: function (response) {

            console.log(response);
            $("#premium-listing-cities").select2('destroy');

            $("#premium-listing-cities").select2({
                placeholder: "Select a city",
                maximumSelectionLength: 10,
                allowClear: true,
            });

            if(response !== '')
            {

                if(response[0].type == 'bundle')
                {
                    $("#selectedBundle > option").each(function() {
                            let bundleValue = $(this).val();
                         if($(this).attr('data-val') == response[0].state_id)
                         {
                             $("#selectedBundle").val(bundleValue).trigger('change');
                         }
                    });
                }


                $('#addNewPremiumListQueryModal').modal('show');
                $('#licenseState').val(response[0].state_id).trigger('change');
                $('#chooseOption').val(response[0].type).trigger('change');
                $('#customize-date-time').val(response[0].date_range);
                let multiCitiesArray = new Array();

                for(index = 0;  index < response.length; index++)
                {
                    multiCitiesArray.push(""+response[index].city_id);
                }
                setTimeout(
                    function()
                    {
                        $('#premium-listing-cities').val(multiCitiesArray).trigger('change');
                    }, 500);



            }
        }
    });




});



$("#addNewPremiumListQuery").click(function () {
    let agent_id = $(this).attr('data-agent-id');

    jQuery.ajax({
        url: "agent/ajax/account-isApproved",
        type: "post",
        data: {agent_id: agent_id},
        dataType: "json",
        cache: false,
        success: function (response) {
            if(response.approval == 'Completed')
            {
                $('#addNewPremiumListQueryModal').modal('show');

            }else if(response.approval == 'Waiting'){

                Swal.fire({
                    icon: "eror",
                    title: "Your account needs to be approved by cortiam administrators before you can begin.",
                    showConfirmButton: true,
                    type: "error",
                    confirmButtonClass: "btn btn-secondary",
                    confirmButtonColor: '#00c48d',
                })

            }else{

                Swal.fire({
                    icon: "eror",
                    title: "Your account not active",
                    showConfirmButton: true,
                    type: "error",
                    confirmButtonClass: "btn btn-secondary",
                    confirmButtonColor: '#00c48d',
                })
            }
        }
    });

    return false;

});

$(document).on('click', '.remove-single-city', function () {

    let agent_id = $(this).attr('data-agent-id');
    let state_id = $(this).attr('data-state-id');
    let city_id = $(this).attr('data-city-id');
    let date_range = $(this).attr('data-date-range');


    Swal.fire({
        title: 'Do you want to Delete the city?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ok',
        denyButtonText: 'cancel',
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        confirmButtonColor: '#00c48d',

    }).then((result) => {
        if (result.value) {
            jQuery.ajax({
                url: "agent/ajax/delete-city",
                type: "post",
                data: {agent_id: agent_id, state_id: state_id, city_id: city_id, date_range: date_range},
                dataType: "json",
                cache: false,
                success: function (response) {

                    getPremiumListing();


                }
            });
        }
    });

});


$(document).on('click', '.close', function () {

    $('#bundleForm')[0].reset();
    $("#licenseState").select2('destroy');
    $("#selectedBundle").select2('destroy');

    $("#premium-listing-cities").select2('destroy');

    $("#selectedBundle").select2({
        placeholder: "Select a bundle",
        allowClear: true,
    });
    $("#licenseState").select2({
        placeholder: "Select a state",
        allowClear: true,
    });

    $("#premium-listing-cities").select2({
        placeholder: "Select a city",
        maximumSelectionLength: 10,
        allowClear: true,
    });
    $('#chooseOption').val('').trigger('change');
    $("#premium-listing-cities").val('').trigger('change');
});


