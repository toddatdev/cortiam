jQuery(document).ready(function () {

    // getPremiumListing();
    $('#query_value_city').select2();
    $('#query_value_state').select2();
    $('#choosepackage').select2({
        placeholder: "select chooice",
        minimumResultsForSearch: -1,
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

    jQuery('body').on("click", '.create-password', function () {
        var input = jQuery('#createpassword');
        if (!jQuery(this).hasClass('confirm')) {
            jQuery('.create-password').attr('src', cortiamajax.createpassword);
            input.attr('type', 'text');
            jQuery(this).addClass('confirm');
        } else {
            jQuery('.create-password').attr('src', cortiamajax.confirmpassword);
            input.attr('type', 'password');
            jQuery(this).removeClass('confirm');
        }
    });

    jQuery('body').on("click", '.confirm-password', function () {
        var input = jQuery('#passwordagain');
        if (!jQuery(this).hasClass('confirm')) {
            jQuery('.confirm-password').attr('src', cortiamajax.createpassword);
            input.attr('type', 'text');
            jQuery(this).addClass('confirm');
        } else {
            jQuery('.confirm-password').attr('src', cortiamajax.confirmpassword);
            input.attr('type', 'password');
            jQuery(this).removeClass('confirm');
        }


    });


    $('.specialization-selection').select2();
    jQuery('body').on("click", '.deactivateme', function (ev) {
        ev.preventDefault();
        record_id = jQuery(this).data('id');
        swal.fire({
            title: 'Please Confirm!',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'on'
            },
            showCancelButton: true,
            html: 'Your account will be removed and you won\'t be able to revert this action! If you still want to continue please type <b>"DELETE"</b> to the input box and click proceed button.',
            type: "question",
            cancelButtonText: '<b><i class="icon-cross2"></i></b> Cancel',
            cancelButtonClass: "button-dark float-left",
            confirmButtonText: '<b><i class="icon-checkmark3"></i></b> Proceed',
            confirmButtonClass: "button-orange float-right",
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === 'DELETE') {
                        resolve()
                    } else {
                        resolve('You should type "DELETE"')
                    }
                })
            }
        }).then(function (e) {
            if (e.value == 'DELETE') {
                jQuery.ajax({
                    url: cortiamajax.deactivateurl,
                    type: "POST",
                    data: {'recordID': record_id},
                    dataType: "json",
                    success: function (i, s, r, a) {
                        if (i.redirect_to) {
                            window.location.replace(i.redirect_to);
                        } else {
                            if (i.success) {
                                swal.fire({
                                    title: i.success_title,
                                    text: i.success_message,
                                    type: "success",
                                    confirmButtonClass: "btn btn-secondary"
                                });
                            }
                        }
                        if (i.fail) {
                            swal.fire({
                                title: i.fail_title,
                                text: i.fail_message,
                                type: "error",
                                confirmButtonClass: "btn btn-secondary"
                            });
                        }
                    }
                });
            }
        });
    });

    jQuery('body').on("change", '#notifications', function (ev) {
        if (!jQuery(this).is(":checked")) {
            swal.fire({
                title: 'Please Confirm!',
                showCancelButton: true,
                html: 'Disabling email notifications might lead you to missing important emails and impact your ability to win properties. Are you sure you want to proceed and cancel email notifications?',
                type: "question",
                cancelButtonText: '<b><i class="icon-cross2"></i></b> Cancel',
                cancelButtonClass: "button-dark float-left",
                confirmButtonText: '<b><i class="icon-checkmark3"></i></b> Proceed',
                confirmButtonClass: "button-orange float-right",
            }).then(function (e) {
                if (e.dismiss == 'cancel') {
                    jQuery('#notifications').prop('checked', true);
                }
            });
        }
    });

    jQuery(document).on('keyup', function (e) {
        if (e.which === 27) {
            jQuery.unblockUI();
        }
    });

    jQuery('body').on('click touchstart', '.blockOverlay', function (ev) {
        jQuery.unblockUI();
    });


    jQuery('body').on("click", '#deletemycard', function (ev) {
        ev.preventDefault();
        payment_id = jQuery(this).data('id');
        payment_row = jQuery(this).parents('.profile-list-item');
        swal.fire({
            title: 'Payment Method Removal',
            text: 'Are you sure you want to delete selected payment method?',
            type: "question",
            showCancelButton: !0,
            cancelButtonText: 'Cancel',
            cancelButtonClass: "button-dark float-left",
            confirmButtonText: 'Proceed',
            confirmButtonClass: "button-orange float-right"
        }).then(function (e) {
            if (e.value) {
                jQuery('#paymentpart').block({
                    message: '<img src="' + cortiamajax.loadingimage + '">',
                    css: {border: '0px', background: 'transparent',},
                    overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
                });
                jQuery.ajax({
                    url: cortiamajax.deletecardurl,
                    type: "POST",
                    data: {'payment_id': payment_id},
                    dataType: "json",
                    success: function (i, s, r, a) {
                        if (i.success) {
                            swal.fire({
                                title: i.success_title,
                                text: i.success_message,
                                type: "success",
                                confirmButtonClass: "button-orange"
                            });
                            jQuery(payment_row).remove();
                        }
                        if (i.fail) {
                            swal.fire({
                                title: i.fail_title,
                                text: i.fail_message,
                                type: "error",
                                confirmButtonClass: "button-orange"
                            });
                        }
                        jQuery('#paymentpart').unblock();
                    }
                });
            }
        });
    });

    jQuery('body').on("click", '#setmycard', function (ev) {
        ev.preventDefault();
        payment_id = jQuery(this).data('id');
        current_buttons = jQuery(this).parents('.profile-list-item').find('.btn-group.dropleft');
        swal.fire({
            title: 'Set Default Payment Method',
            text: 'Are you sure you want to set selected payment method as default payment method?',
            type: "question",
            showCancelButton: !0,
            cancelButtonText: 'Cancel',
            cancelButtonClass: "button-dark float-left",
            confirmButtonText: 'Proceed',
            confirmButtonClass: "button-orange float-right"
        }).then(function (e) {
            if (e.value) {
                jQuery('#paymentpart').block({
                    message: '<img src="' + cortiamajax.loadingimage + '">',
                    css: {border: '0px', background: 'transparent',},
                    overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
                });
                jQuery.ajax({
                    url: cortiamajax.setpaymenturl,
                    type: "POST",
                    data: {'payment_id': payment_id},
                    dataType: "json",
                    success: function (i, s, r, a) {
                        if (i.success) {
                            swal.fire({
                                title: i.success_title,
                                text: i.success_message,
                                type: "success",
                                confirmButtonClass: "button-orange"
                            });
                            jQuery('.btn-group.dropleft').removeClass('invisible');
                            jQuery(current_buttons).addClass('invisible');
                        }
                        if (i.fail) {
                            swal.fire({
                                title: i.fail_title,
                                text: i.fail_message,
                                type: "error",
                                confirmButtonClass: "button-orange"
                            });
                        }
                        jQuery('#paymentpart').unblock();
                    }
                });
            }
        });
    });

    jQuery('body').on("click", '#card-cancel-button', function (ev) {
        ev.preventDefault();
        jQuery('#cardpart').slideUp().html('');
        jQuery('#addcart').show();
    });

    jQuery('body').on("click", '#addcart', function (ev) {
        jQuery(this).hide();
        ev.preventDefault();
        jQuery('#cardpart').hide();
        jQuery('#paymentpart').block({
            message: '<img src="' + cortiamajax.loadingimage + '">',
            css: {border: '0px', background: 'transparent',},
            overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
        });
        jQuery.ajax({
            url: cortiamajax.getformurl,
            type: "POST",
            dataType: "json",
            success: function (i, s, r, a) {
                if (i.success) {
                    jQuery('#cardpart').html(i.form);
                    jQuery('#cardpart').slideDown('slow');
                    jQuery('html, body').animate({scrollTop: jQuery("#cardpart").offset().top}, 1000);

                    var stripe = Stripe(cortiamajax.stripekey);

                    var elements = stripe.elements();
                    var cardElement = elements.create('card', {
                        iconStyle: 'solid',
                        style: {
                            base: {
                                backgroundColor: '#ffffff',
                                lineHeight: '36px',
                                color: '#000000',
                                padding: 6,
                                fontWeight: 300,
                                fontFamily: 'Open Sans, Segoe UI, sans-serif',
                                fontSize: '16px',
                                fontSmoothing: 'antialiased',
                                ':-webkit-autofill': {
                                    color: '#4c525e',
                                },
                                '::placeholder': {
                                    color: '#999999',
                                },
                            },
                            invalid: {
                                iconColor: '#da0101',
                                color: '#da0101',
                            }
                        },
                        classes: {
                            focus: 'is-focused',
                            empty: 'is-empty',
                        }
                    });
                    cardElement.mount('#card-element');

                    var cardholderName = document.getElementById('cardholder-name');
                    var cardholderPhone = document.getElementById('cardholder-phone');
                    var cardButton = document.getElementById('card-button');
                    var clientSecret = cardButton.dataset.secret;

                    function CheckCardError(result) {
                        var errorElement = document.querySelector('.error');
                        errorElement.classList.remove('visible');
                        if (result.error) {
                            errorElement.textContent = result.error.message;
                            errorElement.classList.add('visible');
                        }
                        jQuery('#paymentpart').unblock();
                    }

                    cardElement.on('change', function (event) {
                        CheckCardError(event);
                    });


                    jQuery('#cardpart input').each(function (key, input) {

                        input.addEventListener('focus', function () {
                            input.classList.add('is-focused');
                        });
                        input.addEventListener('blur', function () {
                            input.classList.remove('is-focused');
                        });
                        input.addEventListener('keyup', function (e) {

                            if (input.value.length === 0) {
                                input.classList.add('is-empty');
                            } else {
                                input.classList.remove('is-empty');

                            }
                        });
                    });


                    document.getElementById('cardholder-phone').addEventListener('input', function (e) {
                        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                        e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
                    });

                    cardButton.addEventListener("click", function (event) {
                        event.preventDefault();
                        _card_name_ = jQuery('#cardholder-name').val();
                        _card_phone_ = jQuery('#cardholder-phone').val();
                        phoneregex = /[0-9\-\(\)\s]+/;
                        if (_card_name_ == "") {
                            jQuery('#cardpart .outcome .error').html('Please fill your Name.').addClass('visible');
                            jQuery('#cardholder-name').one("click", function () {
                                jQuery('#cardpart .outcome .error').html(' ').removeClass('visible');
                            });
                        } else if (_card_phone_ == "") {
                            jQuery('#cardpart .outcome .error').html('Please fill your Phone number.').addClass('visible');
                            jQuery('#cardholder-phone').one("click", function () {
                                jQuery('#cardpart .outcome .error').html(' ').removeClass('visible');
                            });
                        } else if (!phoneregex.test(_card_phone_)) {
                            jQuery('#cardpart .outcome .error').html('Please fill a valid Phone number.').addClass('visible');
                            jQuery('#cardholder-phone').one("click", function () {
                                jQuery('#cardpart .outcome .error').html(' ').removeClass('visible');
                            });
                        } else {
                            jQuery('#paymentpart').block({
                                message: '<img src="' + cortiamajax.loadingimage + '">',
                                css: {border: '0px', background: 'transparent',},
                                overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
                            });

                            var getToken = '';
                            stripe.createToken(cardElement).then(function (result) {

                                getToken = result.token.id;
                            });


                            stripe.confirmCardSetup(clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: {
                                        name: cardholderName.value,
                                        phone: cardholderPhone.value,
                                    },
                                }
                            })
                                .then(function (result) {

                                    if (result.error) {
                                        CheckCardError(result);
                                    } else {

                                        jQuery.ajax({
                                            url: cortiamajax.newcreditcarddirect,
                                            type: "POST",
                                            data: {'payment_id': result.setupIntent.payment_method, "token": getToken},
                                            dataType: "json",
                                            success: function (i, s, r, a) {
                                                if (i.success) {
                                                    swal.fire({
                                                        title: i.success_title,
                                                        text: i.success_message,
                                                        type: "success",
                                                        confirmButtonClass: "button-orange"
                                                    });
                                                    jQuery.ajax({
                                                        url: cortiamajax.updatecardurl,
                                                        type: "POST",
                                                        dataType: "json",
                                                        success: function (response) {
                                                            if (response.success) {
                                                                jQuery('#cardlistingpart').html(response.html);
                                                                jQuery('#cardpart').slideUp().html('');
                                                                jQuery('#addcart').show();
                                                            }
                                                            if (response.fail) {
                                                                swal.fire({
                                                                    title: i.fail_title,
                                                                    text: i.fail_message,
                                                                    type: "error",
                                                                    confirmButtonClass: "button-orange"
                                                                });
                                                            }
                                                            jQuery('#paymentpart').unblock();
                                                        }
                                                    });
                                                }
                                                if (i.fail) {
                                                    swal.fire({
                                                        title: i.fail_title,
                                                        text: i.fail_message,
                                                        type: "error",
                                                        confirmButtonClass: "button-orange"
                                                    });
                                                    jQuery('#paymentpart').unblock();
                                                }
                                            }
                                        });
                                    }
                                });
                        }
                    });
                }
                if (i.fail) {
                    swal.fire({
                        title: i.fail_title,
                        text: i.fail_message,
                        type: "error",
                        confirmButtonClass: "button-orange"
                    });
                }
                jQuery('#paymentpart').unblock();
            }
        });
    });


    jQuery('body').on("change", '#paymentmethodchange', function (ev) {
        if (jQuery(this).is(":checked")) {
            new_payment_type = 'automatic';
            new_payment_variable = 'Yes';
            new_payment_cancel = false;
        } else {
            new_payment_type = 'manual';
            new_payment_variable = 'No';
            new_payment_cancel = true;
        }
        swal.fire({
            title: 'Payment Method Change',
            text: 'Are you sure you want to set your payments to ' + new_payment_type + '?',
            type: "question",
            showCancelButton: !0,
            cancelButtonText: 'Cancel',
            cancelButtonClass: "button-dark float-left",
            confirmButtonText: 'Proceed',
            confirmButtonClass: "button-orange float-right"
        }).then(function (e) {
            if (e.value) {
                jQuery('#paymentpart').block({
                    message: '<img src="' + cortiamajax.loadingimage + '">',
                    css: {border: '0px', background: 'transparent',},
                    overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
                });
                jQuery.ajax({
                    url: cortiamajax.changepaymenturl,
                    type: "POST",
                    data: {'auto_payment': new_payment_variable},
                    dataType: "json",
                    success: function (i, s, r, a) {
                        if (i.success) {
                            swal.fire({
                                title: i.success_title,
                                text: i.success_message,
                                type: "success",
                                confirmButtonClass: "button-orange"
                            });
                        }
                        if (i.fail) {
                            swal.fire({
                                title: i.fail_title,
                                text: i.fail_message,
                                type: "error",
                                confirmButtonClass: "button-orange"
                            });
                        }
                        jQuery('#paymentpart').unblock();
                    }
                });
            } else {
                jQuery('#paymentmethodchange').prop('checked', new_payment_cancel);
            }
        });
    });

    jQuery('#bio').trumbowyg({
        btns: [
            // ['formatting'],
            ['strong', 'em'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['insertImage', 'link'],
        ]
    });

    jQuery('#estate_specialization').trumbowyg({
        btns: [
            // ['formatting'],
            ['strong', 'em'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['insertImage', 'link'],
        ]
    });

    jQuery('.select').select2({
        minimumResultsForSearch: Infinity,
    });

    jQuery("#experience").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        endDate: new Date(),
        autoHide: true
    });

//   jQuery('#state').select2({
// 		data: _states_,
// 	  placeholder: 'Select a State',
// 	  allowClear: true
//   });

// 	jQuery('#state').on('select2:select', function (e) {
// 	  var selected_state = e.params.data;
// 		jQuery('#city').select2({
// 			data: _cities_[selected_state.id],
// 			placeholder: 'Select a City',
// 			allowClear: true
// 		});
// 	});

// 	jQuery('#city').select2({
// 		data:  _cities_[''+jQuery('#state').val()+''],
// 		placeholder: 'Select a City',
// 		allowClear: true
// 	});

//   jQuery('#brokerage_state').select2({
// 		data: _states_,
// 	  placeholder: 'Select a State',
// 	  allowClear: true
//   });

// 	jQuery('#brokerage_state').on('select2:select', function (e) {
// 	  var selected_state = e.params.data;
// 		jQuery('#brokerage_city').select2({
// 			data: _cities_[selected_state.id],
// 			placeholder: 'Select a City',
// 			allowClear: true
// 		});
// 	});

// 	jQuery('#brokerage_city').select2({
// 		data:  _cities_[''+jQuery('#brokerage_state').val()+''],
// 		placeholder: 'Select a City',
// 		allowClear: true
// 	});


    jQuery('body').on("click", '#addlicense', function (ev) {
        jQuery(this).hide();
        ev.preventDefault();
        jQuery('#addlicense').hide();
        jQuery('#licenselistingpart').slideUp();
        jQuery('#licensespart').block({
            message: '<img src="' + cortiamajax.loadingimage + '">',
            css: {border: '0px', background: 'transparent',},
            overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
        });
        jQuery.ajax({
            url: cortiamajax.getlicenseformurl,
            type: "POST",
            dataType: "json",
            success: function (i, s, r, a) {
                if (i.success) {
                    jQuery('#addnewlicense').html(i.form);
                    jQuery('#addnewlicense').slideDown('slow');
                    jQuery('html, body').animate({scrollTop: jQuery("#licensespart").offset().top}, 1000);

                    jQuery('#interested').select2({
                        minimumResultsForSearch: Infinity,
                    });
                    jQuery('#license_state').select2({
                        data: _states_,
                        placeholder: 'Select a State',
                        allowClear: true
                    });
                    jQuery('#license_expire').datepicker({format: 'mm/dd/yyyy', startDate: new Date(), autoHide: true});
                    jQuery('#new-license-form *[placeholder]').CorTitle();
                }
                if (i.fail) {
                    swal.fire({
                        title: i.fail_title,
                        text: i.fail_message,
                        type: "error",
                        confirmButtonClass: "button-orange"
                    });
                }
                jQuery('#licensespart').unblock();
            }
        });
    });


    jQuery('body').on("click", '#license-add-button', function (ev) {
        ev.preventDefault();
        //var form_data = jQuery('#new-license-form').serializeArray();

        let license_number = $('#license_number').val();
        let license_expire = $('#license_expire').val();
        let license_state = $('#license_state').val();
        let interested = $('#interested').val();

        jQuery('#addnewlicense').block({
            message: '<img src="' + cortiamajax.loadingimage + '">',
            css: {border: '0px', background: 'transparent',},
            overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
        });
        jQuery.ajax({
            url: cortiamajax.addlicenseurl,
            type: "POST",
            data: {
                license_number: license_number,
                license_expire: license_expire,
                license_state: license_state,
                interested: interested
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    swal.fire({
                        title: response.success_title,
                        text: response.success_message,
                        type: "success",
                        confirmButtonClass: "button-orange"
                    });

                    jQuery.ajax({
                        url: cortiamajax.listlicenseurl,
                        type: "POST",
                        dataType: "json",
                        success: function (i, s, r, a) {
                            if (i.success) {
                                jQuery('#licenselistingpart .profile-list').html(i.form);
                                jQuery('#licenselistingpart').slideDown('slow');
                                jQuery('#addnewlicense').html('').slideUp();
                                jQuery('html, body').animate({scrollTop: jQuery("#licensespart").offset().top}, 1000);
                                jQuery('#addlicense').show();
                                licenseaddedyes = 'Yes';
                            }
                        }
                    });
                }
                if (response.fail) {
                    swal.fire({
                        title: response.fail_title,
                        text: response.fail_message,
                        type: "error",
                        confirmButtonClass: "button-orange"
                    });
                }
                if (response.fail) {
                    swal.fire({
                        title: response.fail_title,
                        text: response.fail_message,
                        type: "error",
                        confirmButtonClass: "button-orange"
                    });
                }
                if (response.errorfields) {
                    jQuery.each(response.errorfields, function (index, value) {
                        if (jQuery("#" + index).hasClass('select2-hidden-accessible')) {
                            jQuery("#" + index).next('span.select2-container').find('.select2-selection--single').addClass("border-danger").one("focus", function () {
                                jQuery(this).removeClass("border-danger");
                            });
                        } else {
                            jQuery("#" + index).addClass("border-danger").one("focus", function () {
                                jQuery(this).removeClass("border-danger");
                            });
                        }
                    });
                }
                jQuery('#addnewlicense').unblock();
            }
        });
    });

    jQuery('body').on("click", '#editmylicense', function (ev) {
        ev.preventDefault();
        license_id = jQuery(this).data('id');
        jQuery('#addlicense').hide();
        jQuery('#licenselistingpart').slideUp();
        jQuery('#licensespart').block({
            message: '<img src="' + cortiamajax.loadingimage + '">',
            css: {border: '0px', background: 'transparent',},
            overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
        });
        jQuery.ajax({
            url: cortiamajax.getlicenseformurl,
            type: "POST",
            data: {'licenseid': license_id},
            dataType: "json",
            success: function (i, s, r, a) {
                if (i.success) {
                    jQuery('#addnewlicense').html(i.form);
                    jQuery('#addnewlicense').slideDown('slow');
                    jQuery('html, body').animate({scrollTop: jQuery("#licensespart").offset().top}, 1000);

                    jQuery('#interested').select2({
                        minimumResultsForSearch: Infinity,
                    });
                    jQuery('#license_state').select2({
                        data: _states_,
                        placeholder: 'Select a State',
                        allowClear: true
                    });
                    jQuery('#license_expire').datepicker({format: 'mm/dd/yyyy', startDate: new Date(), autoHide: true});
                    jQuery('#new-license-form *[placeholder]').CorTitle();
                }
                if (i.fail) {
                    swal.fire({
                        title: i.fail_title,
                        text: i.fail_message,
                        type: "error",
                        confirmButtonClass: "button-orange"
                    });
                }
                jQuery('#licensespart').unblock();
            }
        });
    });

    jQuery('body').on("click", '#license-update-button', function (ev) {
        ev.preventDefault();
        var form_data = jQuery('#new-license-form').serializeArray();
        jQuery('#addnewlicense').block({
            message: '<img src="' + cortiamajax.loadingimage + '">',
            css: {border: '0px', background: 'transparent',},
            overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
        });

        let license_number = $('#license_number').val();
        let license_expire = $('#license_expire').val();
        let license_state = $('#license_state').val();
        let interested = $('#interested').val();

        jQuery.ajax({
            url: cortiamajax.editlicenseurl,
            type: "POST",
            data: {
                license_id: license_id,
                license_number: license_number,
                license_expire: license_expire,
                license_state: license_state,
                interested: interested
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    swal.fire({
                        title: response.success_title,
                        text: response.success_message,
                        type: "success",
                        confirmButtonClass: "button-orange"
                    });

                    jQuery.ajax({
                        url: cortiamajax.listlicenseurl,
                        type: "POST",
                        dataType: "json",
                        success: function (i, s, r, a) {
                            if (i.success) {
                                jQuery('#licenselistingpart .profile-list').html(i.form);
                                jQuery('#licenselistingpart').slideDown('slow');
                                jQuery('#addnewlicense').html('').slideUp();
                                jQuery('html, body').animate({scrollTop: jQuery("#licensespart").offset().top}, 1000);
                                jQuery('#addlicense').show();
                            }
                        }
                    });
                }
                if (response.fail) {
                    swal.fire({
                        title: response.fail_title,
                        text: response.fail_message,
                        type: "error",
                        confirmButtonClass: "button-orange"
                    });
                }
                if (response.errorfields) {
                    jQuery.each(response.errorfields, function (index, value) {
                        if (jQuery("#" + index).hasClass('select2-hidden-accessible')) {
                            jQuery("#" + index).next('span.select2-container').find('.select2-selection--single').addClass("border-danger").one("focus", function () {
                                jQuery(this).removeClass("border-danger");
                            });
                        } else {
                            jQuery("#" + index).addClass("border-danger").one("focus", function () {
                                jQuery(this).removeClass("border-danger");
                            });
                        }
                    });
                }
                jQuery('#addnewlicense').unblock();
            }
        });
    });

    jQuery('body').on("click", '#license-cancel-button', function (ev) {
        ev.preventDefault();
        jQuery('#addnewlicense').slideUp().html('');
        jQuery('#addlicense').show();
        jQuery('#licenselistingpart').slideDown();
        jQuery('html, body').animate({scrollTop: jQuery("#licensespart").offset().top}, 1000);
    });

    jQuery('body').on("click", '#deletemylicense', function (ev) {
        ev.preventDefault();
        license_id = jQuery(this).data('id');
        payment_row = jQuery(this).parents('.profile-list-item');
        swal.fire({
            title: 'Agent License Removal',
            text: 'Are you sure you want to delete selected agent license?',
            type: "question",
            showCancelButton: !0,
            cancelButtonText: 'Cancel',
            cancelButtonClass: "button-dark float-left",
            confirmButtonText: 'Proceed',
            confirmButtonClass: "button-orange float-right"
        }).then(function (e) {
            if (e.value) {
                jQuery('#paymentpart').block({
                    message: '<img src="' + cortiamajax.loadingimage + '">',
                    css: {border: '0px', background: 'transparent',},
                    overlayCSS: {backgroundColor: '#fff', opacity: 0.7}
                });
                jQuery.ajax({
                    url: cortiamajax.deletelicenseurl,
                    type: "POST",
                    data: {'license_id': license_id},
                    dataType: "json",
                    success: function (i, s, r, a) {
                        if (i.success) {
                            swal.fire({
                                title: i.success_title,
                                text: i.success_message,
                                type: "success",
                                confirmButtonClass: "button-orange"
                            });
                            jQuery(payment_row).remove();
                        }
                        if (i.fail) {
                            swal.fire({
                                title: i.fail_title,
                                text: i.fail_message,
                                type: "error",
                                confirmButtonClass: "button-orange"
                            });
                        }
                        jQuery('#paymentpart').unblock();
                    }
                });
            }
        });
    });

});


$(document).ready(function () {

    showPremiumQueryData();
    $("#premiumQueryTable").hide();

    //Create New Data
    var id = 1;

    // $("#addRow").click(function () {
    //     var query_value_zipcode = $('#query_value_zipcode').val();
    //     var query_value_city = $('#query_value_city').find('option:selected').val();
    //
    //     // if (query_value_zipcode.length < 1) {
    //     //     $('#query_value_zipcode').addClass('border border-danger');
    //     //     return false;
    //     // } else {
    //     //     $('#query_value_zipcode').removeClass('border border-danger');
    //     // }
    //
    //     if (query_value_zipcode !== ''){
    //
    //         var query_value = query_value_zipcode;
    //
    //         $.ajax({
    //             url : "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCywz554GE2hipurlh2Yoc0XRhh7Ut3_3k&address=santa+cruz&components=postal_code:"+query_value+"&sensor=false",
    //             method: "POST",
    //             success:function(data){
    //                 latitude = data.results[0].geometry.location.lat;
    //                 longitude= data.results[0].geometry.location.lng;
    //             }
    //         });
    //
    //     }else{
    //         var query_value = query_value_city;
    //     }
    //
    //     $("#premiumQueryTable").show();
    //     var newid = id++;
    //
    //     $("#premiumQueryTable").append('<tr valign="top" id="' + newid + '">\n\
    // <td width="100px" >' + newid + '</td>\n\
    // <td width="100px" class="query_type' + newid + '">' + $("#query_type").val() + '</td>\n\
    // <td width="100px" class="query_value' + newid + '">' + query_value + '</td>\n\
    // <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
    // });
    //
    // $("#premiumQueryTable").on('click', '.remCF', function () {
    //     $(this).parent().parent().remove();
    // });


    $("#btnSavePremiumQueryData").click(function () {

        var query_type = $('#query_type').val();
        if (query_type == 'city') {
            $('#query_value_zipcode').val('');
        }
        var query_value_zipcode = $('#query_value_zipcode').val();
        var query_value_state = $('#query_value_state').find('option:selected').val();
        var query_value_city = $('#query_value_city').find('option:selected').val();


        if (query_type == 'city') {

            if (query_value_city == 'select_city') {
                $('#query_value_city').addClass('border border-danger');
                return false;
            } else {
                $('#query_value_city').removeClass('border border-danger');
            }

        } else {

            if (query_value_zipcode.length < 3) {
                $('#query_value_zipcode').addClass('border border-danger');
                return false;
            } else {
                $('#query_value_zipcode').removeClass('border border-danger');
            }

        }

        if (query_value_zipcode !== '') {

            var query_value = query_value_zipcode;


            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCywz554GE2hipurlh2Yoc0XRhh7Ut3_3k&address=santa+cruz&components=postal_code:" + query_value + "&sensor=false",
                method: "POST",
                success: function (data) {

                    console.log(data);
                    if (data.status == 'OK') {
                        latitude = data.results[0].geometry.location.lat;
                        longitude = data.results[0].geometry.location.lng;

                        var data = [];
                        data.push({
                            query_type: query_type,
                            query_value: query_value,
                            latitude: latitude,
                            longitude: longitude,
                        });
                    } else {

                        $('#invalidZipCode').modal('show');

                        return false;

                    }

                    jQuery.ajax({
                        url: 'agent/premium-search-query',
                        type: "post",
                        data: {
                            list_premium_query: data
                        },
                        success: function (data) {

                            var result = JSON.parse(data);

                            if (result.status == "record_exists") {
                                $('#recordExists').modal('show');
                            }

                            if (result.statusSave == "success") {
                                showPremiumQueryData();
                                $("#premiumQueryTable").empty();
                                $('#query_value_zipcode').val('');
                            }

                        }
                    });
                }
            });

        } else {
            var query_value = query_value_city;
            var data = [];

            data.push({
                query_type: query_type,
                query_value: query_value,
                query_value_state: query_value_state,
            });

            jQuery.ajax({
                url: 'agent/premium-search-query',
                type: "post",
                data: {
                    list_premium_query: data
                },
                success: function (data) {
                    var result = JSON.parse(data);

                    if (result.status == "record_exists") {
                        $('#recordExists').modal('show');
                    }

                    if (result.statusSave == "success") {
                        showPremiumQueryData();
                        $("#premiumQueryTable").empty();
                    }

                }
            });
        }
    });
});


$(document).ready(function () {
    $('.zipcode').hide();
    $("select#query_type").change(function () {
        $(this).find("option:selected").each(function () {
            var optionValue = $(this).attr("value")

            if (optionValue == 'city') {
                $('.stateOrCity').show();
                $('.zipcode').hide();

            } else {
                $('.stateOrCity').hide();
                $('.zipcode').show();
            }
        });
    }).change();
});


function showPremiumQueryData() {

    $.ajax({
        url: 'agent/premium-search-query-listing',
        type: "POST",
        cache: false,
        success: function (data) {
            $('#showListing').html(data);
        }
    });

}


//Delete Record
$(document).on("click", ".deletePremiumSearchQuery", function () {
    var $ele = $(this).parent().parent();

    // $('#deletePremiumSearchQueryModal').modal('show');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#00c48d',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "agent/delete-premium-search-query",
                type: "POST",
                data: {
                    cache: false,
                    id: $(this).attr("data-id")
                },
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $ele.fadeOut().remove();
                        showPremiumQueryData();
                    }
                }
            });
        }
    })

});


$("select#query_type").change(function () {

    $('.zipcodes').hide();

    $(this).find("option:selected").each(function () {
        var optionValue = $(this).attr("value");
        if (optionValue == 'city') {
            $('zipcode').hide();
            $('.cities').show();

        } else {

            $('.zipcodes').show();
            $('.cities').hide();

        }
    });
}).change();


jQuery('body').on("change", '#query_value_state', function (ev) {

    $.ajax({
        url: "agent/ajax/get-cities",
        type: "POST",
        dataType: "json",
        data: {
            cache: false,
            id: $(this).val()
        },
        success: function (dataResult) {
            let data = [];
            // $('#query_value_city').val("information").trigger('change');  

            // Append it to the select

            if (dataResult) {
                $("#query_value_city").html("");

                for (let index = 0; index < dataResult.length; index++) {
                    var newOption = new Option(dataResult[index].city_name, dataResult[index].city_name, true, true);
                    $('#query_value_city').append(newOption).trigger('change');

                }

            }
        }
    });
});


$(".scroll-nav-edit-account").on('click', function (e) {

    e.preventDefault();

    $(".scroll-nav-edit-account").removeClass("active");
    $(this).addClass("active");

    var target = $(this).attr('href');
    $('html, body').animate({
        scrollTop: ($(target).offset().top - 200)
    }, 2000);
});


$(".query-value-city").select2({
    maximumSelectionLength: 1
});


document.getElementById('phone').addEventListener('input', function (e) {
    var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
});


// $('#selectedBundle').change(function () {
//     let state_id = $(this).find(':selected').attr('data-val');
//     if (state_id !== null && state_id > 0) {
//
//         $.ajax({
//             url: "agent/ajax/get-licence-state-cities",
//             type: "POST",
//             dataType: "json",
//             data: {
//                 cache: false,
//                 id: state_id
//             },
//             success: function (dataResult) {
//                 let data = [];
//                 if (dataResult) {
//                     $("#premium-listing-cities").html("");
//                     $.each(dataResult, function (i, data) {
//                         $('#premium-listing-cities').append($('<option>', {
//                             value: data.city_id,
//                             text: data.city_name
//                         }));
//                     });
//
//
//                     $("#premium-listing-cities").val('').trigger('change');
//
//
//                     // for (let index = 0; index <dataResult.length; index++)
//                     // {
//                     //     var newOption = new Option(dataResult[index].city_name, dataResult[index].city_name, true, true);
//                     //     $('#premium-listing-cities').append(newOption);
//                     //
//                     // }
//
//                 }
//             }
//         });
//     }
//
// })



// $('#licenseState').change(function () {
//
//     if ($(this).val() !== null) {
//         $.ajax({
//             url: "agent/ajax/get-licence-state-cities",
//             type: "POST",
//             dataType: "json",
//             data: {
//                 cache: false,
//                 id: $(this).val()
//             },
//             success: function (dataResult) {
//                 let data = [];
//                 if (dataResult) {
//                     $("#premium-listing-cities").html("");
//                     $.each(dataResult, function (i, data) {
//                         $('#premium-listing-cities').append($('<option>', {
//                             value: data.city_id,
//                             text: data.city_name
//                         }));
//
//                     });
//
//                     $("#premium-listing-cities").val('').trigger('change')
//
//
//                 }
//             }
//         });
//     }
//
// });


//
//
// $('#premium-listing-cities').change(function () {
//     let cityId = $('#premium-listing-cities').val();
//     let stateID = $('#licenseState').val();
//
//    if(cityId.length > 0)
//    {
//        let lastIndex = cityId.length;
//        let getCity   = cityId[0];
//
//        if ($('#premium-listing-cities').val() !== null) {
//
//            $.ajax({
//                url: "agent/ajax/check-agents-state-counts",
//                type: "POST",
//                dataType: "json",
//                data: {
//                    cache: false,
//                    city_id: getCity,
//                    state_id:stateID
//                },
//                success: function (dataResult) {
//                    let data = [];
//
//                    if(dataResult.error == "Error"){
//
//                        Swal.fire({
//                            icon: dataResult.error,
//                            title: dataResult.title,
//                            showConfirmButton: true,
//                            type: "error",
//                            confirmButtonClass: "btn btn-secondary",
//                            confirmButtonColor: '#00c48d',
//                        })
//
//
//                        $("#premium-listing-cities").val('').trigger('change')
//                        return false;
//
//                    }
//
//                }
//            });
//        }
//
//    }
//
//
// });
//
// $('#chooseOption').change(function () {
//     let selection = $(this).val();
//     if (selection === 'bundle') {
//         $('.bundle-tab').css('display', 'block');
//         $('.customize-tab-date-range').css('display', 'none');
//         $('.customize-tab-state').css('display', 'none');
//     } else {
//         $('.bundle-tab').css('display', 'none');
//         $('.customize-tab-date-range').css('display', 'block');
//         $('.customize-tab-state').css('display', 'block');
//     }
// });

// $('#savePremiumPackage').click(function () {
//
//         $(this).removeAttr('id');
//
//         let error  = false;
//
//         if(!$('#chooseOption').val()){
//             $('#optionError').css('display', 'block');
//             error = true;
//         }else{
//             $('#optionError').css('display', 'none');
//         }
//
//         if($('#chooseOption').val() == 'bundle')
//         {
//             if(!$('#selectedBundle').val()){
//                 $('#bundleError').css('display', 'block');
//                 error = true;
//             }else{
//                 $('#bundleError').css('display', 'none');
//             }
//         }else{
//
//             if(!$('#licenseState').val()){
//                 $('#licenseError').css('display', 'block');
//                 error = true;
//             }else{
//                 $('#licenseError').css('display', 'none');
//             }
//
//         }
//
//
//         if($('#premium-listing-cities').val() == '' || !$('#premium-listing-cities').val())
//         {
//             $('#cityError').css('display', 'block');
//             error = true;
//
//         }else{
//             $('#cityError').css('display', 'none');
//
//         }
//
//         if(error == true)
//         {
//             $('.savePremiumPackage').attr('id', 'savePremiumPackage');
//
//             return false;
//         }
//
//
//
//         jQuery.ajax({
//             type: "post",
//             url: cortiamajax.savePackage,
//             data:$( '#bundleForm' ).serialize(),
//             success: function(response){
//
//                 if(response >  1){
//
//
//                     $('.savePremiumPackage').attr('id', 'savePremiumPackage');
//
//                     $('#bundleForm')[0].reset();
//                     $("#addNewPremiumListQueryModal").modal('hide');
//
//                     $("#licenseState").select2('destroy');
//                     $("#selectedBundle").select2('destroy');
//
//                     $("#premium-listing-cities").select2('destroy');
//
//                     $("#selectedBundle").select2({
//                         placeholder : "Select a bundle",
//                         allowClear: true,
//                     });
//                     $("#licenseState").select2({
//                         placeholder : "Select a state",
//                         allowClear: true,
//                     });
//
//                     $("#premium-listing-cities").select2({
//                         placeholder : "Select a city",
//                         maximumSelectionLength: 10,
//                         allowClear: true,
//                     });
//
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Record has been added successfully',
//                         showConfirmButton: true,
//                         type: "success",
//                         confirmButtonClass: "btn btn-secondary",
//                         confirmButtonColor: '#00c48d',
//
//                     })
//                     $('#chooseOption').val('').trigger('change');
//                     $("#premium-listing-cities").val('').trigger('change');
//                     getPremiumListing();
//
//                 }else{
//                     $('#editStateError').css("display", "none");
//                     $('#editStateError').text("Pleae select a state");
//                     // $('#editNumberofAgentsError').css("display", "none");
//                     // $('#editNumberofAgentsError').text("This field is required");
//
//                     $( '#bundleForm' )[0].reset();
//                     $('.close').click();
//
//                 }
//
//             }
//         });
//
// });


// $(document).on('click', '.btndeleteRecord', function(){
//
//     let id = $(this).attr('data-id');
//
//     Swal.fire({
//         title: 'Do you want to Delete the record?',
//         showDenyButton: true,
//         showCancelButton: true,
//         confirmButtonText: 'Ok',
//         denyButtonText: 'cancel',
//         confirmButtonClass: "btn btn-success",
//         cancelButtonClass: "btn btn-danger",
//         confirmButtonColor: '#00c48d',
//
//     }).then((result) => {
//         if(result.value) {
//
//             jQuery.ajax({
//                 type: "post",
//                 url: cortiamajax.deletePremiumRecord,
//                 dataType: "json",
//                 data: {id, id},
//                 success: function (response) {
//
//                     if (response.success) {
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'Record deleted successfully',
//                             showConfirmButton: true,
//                             type: "success",
//                             confirmButtonClass: "btn btn-secondary",
//                             confirmButtonColor: '#00c48d',
//                         })
//
//                         $('.premium' + id).remove();
//                         getPremiumListing();
//                     }
//
//                 }
//             });
//         }
//     });
//
// });


// function getPremiumListing(){
//
//     jQuery.ajax({
//         type: "post",
//         url: cortiamajax.premiumlisting,
//         dataType: "json",
//         data: $('#bundleForm').serialize(),
//         success: function (response) {
//             $('#premiumListingtbl').empty();
//                 let totalPrice = 0;
//             let order_id = 0;
//
//             if(response.data.length > 0)
//                 {
//                     console.log(response.data);
//                     for(i = 0; i < response.data.length; i++ )
//                     {
//                         let cities='';
//                         let currentCity = '';
//                         if(response.data[i]['city'])
//                         {
//                             let citiesArray = response.data[i]['city'];
//
//                             for (j = 0; j < citiesArray.length; j++ )
//                             {
//                                 currentCity = citiesArray[j].city;
//                                 console.log(currentCity);
//                                 cities+= '<span class="badge badge-info">'+currentCity+'</span> ';
//                             }
//                         }
//
//                         let tr = '';
//
//                         tr += '<tr class="premium'+response.data[i]['id']+'">';
//                         tr += '<td>';
//                         tr += response.data[i]['dateRange'];
//                         tr += '</td>';
//                         tr += '<td>';
//                         tr += capitalize(response.data[i]['type']);
//                         tr += '</td>';
//                         tr += '<td>';
//                         tr += response.data[i]['state'];
//                         tr += '</td>';
//                         tr += '<td>';
//                         tr += cities;
//                         tr += '</td>';
//                         tr += '<td>';
//                         tr += '$'+response.data[i]['price'];
//                         tr += '</td>';
//                         tr += '<td>';
//                         tr += response.data[i]['status_price'];
//                         tr += '</td>';
//                         tr += '<td>';
//                        // tr += '<a class="btn btn-sm btn-primary checkoutpayment" href="javascript:void(0);" data-toggle="modal" data-target="#paymentModal">Checkout</a> ';
//                         tr += '<a class="btn btn-sm btn-danger btndeleteRecord"  href="javascript:void(0);" data-id="'+response.data[i]['id']+'">Delete</a> ';
//                         tr += '</td>';
//
//                         if(response.data[i]['status_price'] == 'Unpaid')
//                         {
//                             totalPrice = totalPrice + parseFloat(response.data[i]['price']) + 0;
//
//                         }
//
//
//                         $('#premiumListingtbl').append(tr);
//                         order_id = response.data[i]['order_id'];
//
//                     }
//
//
//                     totalPrice = parseFloat(totalPrice).toFixed(2);
//                     var base_url = window.location.origin;
//                     let premiumCheckoutUrl = '';
//
//                     if (location.hostname === "localhost" || location.hostname === "127.0.0.1")
//                     {
//                         premiumCheckoutUrl = base_url + '/cortiam/agent/checkout-premium-bundle/'+totalPrice+'/'+order_id;
//                     }else{
//                         premiumCheckoutUrl = base_url + '/agent/checkout-premium-bundle/'+totalPrice+'/'+order_id;
//                     }
//
//
//                     if(totalPrice > 0)
//                     {
//                         let lastRow = '<tr>\n' +
//                             '                            <td colspan="7" class="text-right" style="font-size: 18px !important;">\n' +
//                             '                                <span>Total Price</span>\n' +
//                             '                                : <span class="font-weight-bold">$'+totalPrice+'</span>\n' +
//                             '                                <span>\n' +
//                             '                                    <a href="'+premiumCheckoutUrl+'" class="btn btn-primary ml-3">Checkout All</a>\n' +
//                             '                                </span>\n' +
//                             '                            </td>\n' +
//                             '                        </tr>';
//
//                         $('#premiumListingtbl').append(lastRow);
//
//
//                     }
//
//
//
//
//
//                 }
//           }
//         });
//
// }

// function capitalize(string) {
//     return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
// }
