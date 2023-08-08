$(document).ready(function() {
    var scrollableDiv = $('#agentScrollableDiv');
    scrollableDiv.scrollTop(scrollableDiv.prop("scrollHeight"));
});
$("form.ajaxform").submit(function(){
    $("form.ajaxform").validate({
        ignore: ".ignore, :hidden, .returnbackbutton",
        submitHandler: function (form, event) {
            event.preventDefault();
            actionname = $("form.ajaxform").data('source');
            jQuery(form).block({
                message: '<img src="' + cortiamajax.loadingimage + '">',
                css: {border: '0px', background: 'transparent',},
                overlayCSS: {backgroundColor: '#f5f5f5', opacity: 0.7}
            });

            $("form.ajaxform").ajaxSubmit({
                url: cortiamajax[actionname],
                type: "POST",
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
                                confirmButtonClass: "button-success"
                            });
                            jQuery(form).unblock();
                        }
                        if (typeof RunAjaxFormSuccess === 'function') {
                            RunAjaxFormSuccess();
                        }
                        if (i.orangemessage) {
                            jQuery('.approvalmessage').remove();
                            jQuery('.content .container .row .maincontent').prepend(i.orangemessage);
                        }
                    }
                    if (i.fail) {
                        swal.fire({
                            title: i.fail_title,
                            text: i.fail_message,
                            type: "error",
                            confirmButtonClass: "button-danger"
                        });
                        if (typeof RunAjaxFormFail === 'function') {
                            RunAjaxFormFail();
                        }
                        jQuery(form).unblock();
                    }
                    if (i.tos) {
                        jQuery.blockUI({
                            message: i.tos_content,
                            onBlock: function () {
                                jQuery("body").addClass("modal-open");
                            },
                            onUnblock: function () {
                                jQuery("body").removeClass("modal-open");
                            },
                            css: {
                                border: '0px',
                                width: '100%',
                                height: '100%',
                                top: '0%',
                                left: '0%',
                                background: 'transparent',
                                cursor: 'context-menu'
                            },
                            overlayCSS: {backgroundColor: '#000000', opacity: .7}
                        });

                        jQuery('#tos_action .disablefornow').tooltip();
                        ScrollCheckElement = document.getElementById('tos_popup');
                        jQuery('#tos_popup').scroll(function () {
                            if (ScrollCheckElement.scrollTop >= (ScrollCheckElement.scrollHeight - ScrollCheckElement.offsetHeight)) {
                                jQuery('#tos_action .disablefornow').fadeOut(500, function () {
                                    jQuery('#tos_action').removeClass('disabled');
                                });
                            }
                        });

                        jQuery('#tos_action .button-danger').one('click touchstart', function (ev) {
                            jQuery.unblockUI();
                            jQuery(form).unblock();
                            jQuery("body").removeClass("modal-open");
                        });

                        jQuery('#tos_action .button-success').one('click touchstart', function (ev) {
                            jQuery.ajax({
                                type: "post",
                                url: cortiamajax.accepttosurl,
                                data: {'tos_accepted': true},
                                dataType: "json",
                                beforeSend: function () {
                                    jQuery('#tos_action').block({
                                        message: 'PLEASE WAIT...',
                                        css: {
                                            'font-size': '1rem',
                                            'font-weight': '600',
                                            border: '0px',
                                            background: 'transparent',
                                        },
                                        overlayCSS: {backgroundColor: '#f5f5f5', opacity: 0.7}
                                    });
                                },
                                success: function (response) {
                                    if (response.success) {
                                        jQuery("body").removeClass("modal-open");
                                        jQuery.unblockUI();
                                        jQuery('#editprofileform .button-orange').click();
                                    } else {
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
                    if (i.errorfields) {
                        jQuery.each(i.errorfields, function (index, value) {
                            jQuery("#" + index).addClass("border-danger").one("focus", function () {
                                jQuery(this).removeClass("border-danger");
                            });
                        });
                    }
                }
            });


        }
    });
    return false;
});

jQuery(document).ready(function () {


    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        FullCalendar.BootstrapTheme.prototype.classes.button = 'btn btn-sm orange';
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,dayGridDay'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
            },
            eventColor: '#00c48d',
            events: function (info, successCallback, FailureCallback) {
                $.ajax({
                    type: "GET",
                    url: cortiamajax.getappointmentsurl,    //add url which will return the events in json
                    dataType: 'json',
                    data: {
                        // our hypothetical feed requires UNIX timestamps
                        start: info.start.getTime() / 1000,
                        end: info.end.getTime() / 1000
                    },
                    success: function (events) {
                        successCallback(events.map(e => {
                            let getdate = e.meet_date;
                            let dateArray = getdate.split("/");
                            return {
                                id: e.id + "*" + e.customer_id +"*"+e.user_type,
                                title: e.meet_type+" with "+e.first_name+" "+e.last_name + " at; \n"+ e.meet_time,
                                start: dateArray[2]+"-"+dateArray[0]+"-"+dateArray[1]
                            }
                        }));
                    }
                });
            },
            eventClick: function(arg) {

                    let idstring = arg.event.id;
                    let idsArray = idstring.split('*');

                    let  getUrl = '';
                    if(window.location.origin == 'http://localhost')
                    {
                        getUrl = window.location.origin+"/cortiam/agent/view-messages/"+idsArray[2]+"/"+idsArray[1];
                    }else if(window.location.origin == 'http://192.168.104.85'){
                        getUrl = window.location.origin+"/cortiam/agent/view-messages/"+idsArray[2]+"/"+idsArray[1];
                    }else{
                        getUrl = window.location.origin+"/agent/view-messages/"+idsArray[2]+"/"+idsArray[1];
                    }

                    window.location.replace(getUrl);
                }

        });
        calendar.render();
    }

  mullitDaySelect();
    function mullitDaySelect()
    {
        $( "#week-selection" ).multiDatesPicker({
            minDate: new Date(),
            onSelect : function(){

                let selected_days = $('#selected_days').val();
                let selectDay     = $(this).val();

                let selected_days_Array = selected_days.split(",");

                if($.inArray(selectDay, selected_days_Array) !== -1)
                {
                    swal.fire({
                        title: "Agent Slot",
                        text: "Day already selected!",
                        type: "info",
                        confirmButtonClass: "btn btn-success"
                    });

                    $('#addagentslots')[0].reset();
                }


            },
            beforeShowDay: function(date){
                var stringOfDates = $('#formated_selected_days').val();
                var arrayOfDates = stringOfDates.split(',');

                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [ arrayOfDates.indexOf(string) == -1 ]
            }
        });
    }

   mullitUpdateDaySelect();
    function mullitUpdateDaySelect()
    {


    $( "#week-selections" ).datepicker({
        minDate: new Date(),
        onSelect : function(){

            let selected_days = $('#selected_days').val();
            let selectDay     = $(this).val();
            let selected_days_Array = selected_days.split(",");

            if($.inArray(selectDay, selected_days_Array) !== -1)
            {
                swal.fire({
                    title: "Agent Slot",
                    text: "Day already selected!",
                    type: "info",
                    confirmButtonClass: "btn btn-success"
                });
                $('#updateagentslots')[0].reset();
            }

        },
        beforeShowDay: function(date){
            var stringOfDates = $('#formated_selected_days').val();
            var arrayOfDates = stringOfDates.split(',');
            console.log(arrayOfDates);
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [ arrayOfDates.indexOf(string) == -1 ]
        }
    });
 }

    // $('.week-selection').select2({
    //     placeholder : "select a day",
    //     allowClear: true
    // });
    // // $('.time-slots').select2();
    // $('#week-selection').on('select2:select', function (e) {

    // });


    $('.update-selection').on('select2:select', function (e) {
        let id        = $('#id').val();
        let agent_id  = $('#agent_id').val();
        let selectDay = $(this).val();

        let selectedDay = $('#saved_day').val();

        jQuery.ajax({
            type: "post",
            url: cortiamajax.updateagentday,
            data: {id : id , selectDay :  selectDay, agent_id : agent_id},
            dataType: 'json',
            success: function (response) {

               if(response.week_day !== '')
               {
                   swal.fire({
                       title: "Agent Slot",
                       text: "Day already selected, please select another one",
                       type: "info",
                       confirmButtonClass: "btn btn-success"
                   });

                   $('#week-selections').val(selectedDay).trigger("change");

               }
            }
        });


    });





    jQuery('#updateagentslots').submit(function () {

        jQuery.ajax({
            type: "post",
            url: cortiamajax.updateagentslotajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function (response) {


                if (response == "success") {
                    swal.fire({
                        title: "Agent Slot",
                        text: "Agent Slot updated successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if (response == "fail") {
                    swal.fire({
                        title: "Agent Slot",
                        text: "Agent Slot cannot updated",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                jQuery("#editagentslotsModal").modal('hide');
                agentavailableslots.draw();
                document.getElementById("addagentslots").reset();
            }
        });


        jQuery.ajax({
            type: "post",
            url: cortiamajax.alreadySeletedDates,
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $('#selected_days').val("");
                $('#selected_days').val(response.selected_days);
                $('#formated_selected_days').val(response.formated_selected_days);

                $('#week-selections').datepicker( "destroy" );
                mullitUpdateDaySelect();
            }
        })

        $('#week-selection').datepicker( "destroy" );
        mullitDaySelect();



        return false;
    });

    jQuery('body').on("click", '.delete', function (ev) {

        let base_url = $('#base_url').val();
        let id = $(this).attr('data-delete');


        Swal.fire({
            title: 'Do you want to Delete the record?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ok',
            denyButtonText: 'cancel',
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger"
        }).then((result) => {


            if (result.value) {
                jQuery.ajax({
                    type: "post",
                    url: base_url + "agent/ajax/agent-slot-deleted/" + id,
                    data: {id: id},
                    dataType: "text",
                    success: function (response) {

                        if (response == "success") {
                            swal.fire({
                                title: "Feature",
                                text: "Record deleted successfully",
                                type: "success",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                        if (response == "fail") {
                            swal.fire({
                                title: "Feature",
                                text: "Record cannot deleted, due to error",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }

                        agentavailableslots.draw();

                    }
                });


                jQuery.ajax({
                    type: "post",
                    url: cortiamajax.alreadySeletedDates,
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        $('#selected_days').val("");
                        $('#selected_days').val(response.selected_days);
                        $('#formated_selected_days').val(response.formated_selected_days);


                    }
                })
                $('#week-selection').datepicker( "destroy" );
                mullitDaySelect();
            }

        });




    });
    function convertTimeFrom12To24(timeStr) {

        let getCurrentTime = timeStr.replaceAll(/\s/g,'');
        let sperateMinutes = getCurrentTime.split(":");
        let getCurrentminutes = sperateMinutes[1].replace(/\D/g,'');

        var colon = timeStr.indexOf(':');
        var hours = timeStr.substr(0, colon),
            minutes = getCurrentminutes,
            meridian = timeStr.substr(colon+4, 2).toUpperCase();

        meridian = meridian.replaceAll(/\s/g,'');
        if (meridian === 'PM' || meridian == 'P')
        {
            hours = parseInt(hours, 10) + 12;
        }


       return hours + ":" + minutes;
    }

    jQuery('body').on("click", '.edit', function (ev) {

        let id = $(this).attr('data-edit');
        let base_url = $('#base_url').val();
        let dayName = $(this).closest('tr').find('td:eq(1)').text();

        let selectedTime = $(this).closest('tr').find('td:eq(3)').text();
        let getReturnTime = convertTimeFrom12To24(selectedTime);
        getReturnTime = getReturnTime.split(":");
        $('#time-slots').wickedpicker({now: getReturnTime[0]+":"+getReturnTime[1]});
        $('#saved_day').val(dayName);
        jQuery.ajax({
            type: "post",
            url: base_url + "agent/ajax/agent-slot-edit/" + id,
            data: {id: id},
            dataType: "json",
            success: function (response) {
                let id = response[0].id;
                let week_day = response[0].week_day;
                let slot_time = response[0].slot_time;
                let slots = [];

                for (let index = 0; index < response.length; index++) {
                    slots.push(response[index].week_day);

                }

                $('#week-selections').val(slots); // Select the option with a value of '1'
                $('#time-slots').val(response[0].slot_time);
                $('#id').val(id);
            }
        });
    });

    jQuery('#addagentslots').submit(function () {
          jQuery.ajax({
            type: "post",
            url: cortiamajax.addagentslotajaxurl,
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {

                $('#formated_selected_days').val('');
                $('#week-selection').multiDatesPicker( "destroy" );

                    if (response.existingDate) {
                        swal.fire({
                            title: "Existing Slot",
                            text: "Availability slot saved successfully, existing slots never saved",
                            type: "info",
                            confirmButtonClass: "btn btn-success"
                        }).then((result) => {

                            if (result.value) {
                                jQuery('#addagentslots')[0].reset();

                            }
                        })
                    }

                    if (response.dataSaved) {
                        swal.fire({
                            title: "Availability Slot",
                            text: "Availability slot saved successfully",
                            type: "success",
                            confirmButtonClass: "btn btn-success"
                        }).then((result) => {

                            if (result.value) {
                                jQuery('#addagentslots')[0].reset();

                            }
                        })
                    }

                    if (response.fail) {
                        swal.fire({
                            title: "Availability Slot",
                            text: "Slot already exist",
                            type: "error",
                            confirmButtonClass: "btn btn-success"
                        });
                    }
                jQuery.ajax({
                    type: "post",
                    url: cortiamajax.alreadySeletedDates,
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        $('#selected_days').val("");
                        $('#selected_days').val(response.selected_days);
                        $('#formated_selected_days').val(response.formated_selected_days);
                    }
                })

                agentavailableslots.draw();
                document.getElementById("addagentslots").reset();
                jQuery("#addagentslotsModal").modal('hide');

                mullitDaySelect();


            }
        });


        return false;
    });


    agentavailableslots = jQuery('#agentavailableslots').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        paging: true,
        pageLength: 10,
        lengthMenu: [5, 10, 15, 20, 25],
        type: 'POST',
        language: {
            searchPlaceholder: "Search By Day"
        },

        ajax: {
            url: cortiamajax.agentslotstableajaxurl,
            data: function (d) {
                // d.email = $('.searchEmail').val(),
                // d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            { data: 'id', name: 'id'},
            {data: 'week_day', name: 'week_day'},
            {data: 'day', name: 'day'},
            {data: 'slot_time', name: 'slot_time'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [ {
            targets: [0,1,2,3,4], /* column index */
            orderable: false, /* true or false */
        }]
    });


    jQuery('.format-phone-number').formatter({
        pattern: '{{999}}-{{999}}-{{9999}}'
    });

    jQuery('*[placeholder]').CorTitle();

    jQuery('body').on('click', '#res_menu_icon', function (ev) {
        ev.preventDefault();
        jQuery('#membermenu').slideToggle('slow');
    });

    jQuery('[data-display="tooltip"]').tooltip();
    jQuery('body').on('click', '.dofullscreen', function (ev) {
        ev.preventDefault();
//		jQuery(this).find('.icon-co').toggleClass('expand').toggleClass('target');
//		jQuery(this).parents('.card').toggleClass('makefull');
//		jQuery('html, body').animate({scrollTop: '0px'}, 300);
//		if(jQuery('.carousel').length){
//			jQuery('.carousel').slick('refresh');
//		}
        jQuery(this).find('.icon-co').toggleClass('expand').toggleClass('target');
        jQuery(this).parents('.card').find('.card-body, .card-footer').slideToggle('fast');
        if (jQuery('.carousel').length) {
            jQuery('.carousel').slick('refresh');
        }
    });

    var $image = jQuery("#avatar-cropper-image");
    var $filefield = jQuery(".property_img_upload")[0];
    var $currentavatar = jQuery('#useravatarbig').attr('src');


    jQuery('body').on("click", '.triggerphotochange', function (ev) {

        ev.preventDefault();
        jQuery('.property_img_upload').click();


    });

    jQuery('body').on("change", '.property_img_upload', function (ev) {
        jQuery('#avatarmodal').modal({show: true, backdrop: 'static'}).on('shown.bs.modal', function (e) {

            jQuery('#avatarmodal .modal-dialog').block({
                message: '<img src="' + cortiamphotoajax.loadingimage + '">',
                css: {border: '0px', background: 'transparent',},
                overlayCSS: {backgroundColor: '#fff', opacity: 0.9}
            });
            jQuery('.dropdown-menu').removeClass('show');
            var UploadfileName = $filefield.value
            var UploadfileNameExt = UploadfileName.substr(UploadfileName.lastIndexOf('.') + 1);
            var oFReader = new FileReader();
            if (UploadfileNameExt.toLowerCase() == "heic") {
                heic2any({
                    blob: $filefield.files[0],
                    toType: "image/png",
                }).then(function (resultBlob) {
                    oFReader.readAsDataURL(resultBlob);
                });
            } else {

                oFReader.readAsDataURL($filefield.files[0]);
            }

            oFReader.onload = function (oFREvent) {
                $image.attr('src', this.result);
                $image.cropper({
                    aspectRatio: 1,
                    autoCropArea: 1
                });
            };
            $image.on('ready', function () {
                jQuery('#avatarmodal .modal-dialog').unblock();
            });

        }).on('hidden.bs.modal', function () {

            jQuery('#avatarupload').val('');
            $image.attr('src', '');
            $image.cropper('destroy');
            jQuery('#useravatarbig, #useravatarsmall, .photoneedsupdate').attr('src', $currentavatar);
        });

    });

    jQuery('body').on('click', '#dophotocrop', function () {
        canvas = $image.cropper('getCroppedCanvas', {width: 250, height: 250});
        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                jQuery('#avatarmodal .modal-dialog').block({
                    message: '<img src="' + cortiamphotoajax.loadingimage + '">',
                    css: {border: '0px', background: 'transparent',},
                    overlayCSS: {backgroundColor: '#fff', opacity: 0.9}
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: cortiamphotoajax.avataruploadurl,
                    data: {image: base64data, type: 'admin', recordID: jQuery('input[name="recordID"]').val()},
                    success: function (data) {
                        $currentavatar = data.avatarurl;
                        jQuery('#avatarmodal').modal('hide');
                        jQuery('#avatarmodal .modal-dialog').unblock();
                    }
                });
            }
        });
    });

    jQuery('.avatar-cropper-toolbar').on('click', '[data-method]', function () {
        var $this = jQuery(this),
            data = $this.data(),
            $target,
            result;

        if ($image.data('cropper') && data.method) {
            data = $.extend({}, data);
            if (typeof data.target !== 'undefined') {
                $target = jQuery(data.target);
                if (typeof data.option === 'undefined') {
                    data.option = JSON.parse($target.val());
                }
            }

            result = $image.cropper(data.method, data.option, data.secondOption);
            switch (data.method) {
                case 'scaleX':
                case 'scaleY':
                    jQuery(this).data('option', -data.option);
                    break;
            }
        }
    });

    jQuery('form.ajaxform').each(function (key, form) {
        jQuery(form).validate({
            ignore: ".ignore, :hidden, .returnbackbutton",
            submitHandler: function (form, event) {
                event.preventDefault();
                actionname = jQuery(form).data('source');
                jQuery(form).block({
                    message: '<img src="' + cortiamajax.loadingimage + '">',
                    css: {border: '0px', background: 'transparent',},
                    overlayCSS: {backgroundColor: '#f5f5f5', opacity: 0.7}
                });
                jQuery(form).ajaxSubmit({
                    url: cortiamajax[actionname],
                    type: "POST",
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
                                    confirmButtonClass: "button-success"
                                });
                                jQuery(form).unblock();
                            }
                            if (typeof RunAjaxFormSuccess === 'function') {
                                RunAjaxFormSuccess();
                            }
                            if (i.orangemessage) {
                                jQuery('.approvalmessage').remove();
                                jQuery('.content .container .row .maincontent').prepend(i.orangemessage);
                            }
                        }
                        if (i.fail) {
                            swal.fire({
                                title: i.fail_title,
                                text: i.fail_message,
                                type: "error",
                                confirmButtonClass: "button-danger"
                            });
                            if (typeof RunAjaxFormFail === 'function') {
                                RunAjaxFormFail();
                            }
                            jQuery(form).unblock();
                        }
                        if (i.tos) {
                            jQuery.blockUI({
                                message: i.tos_content,
                                onBlock: function () {
                                    jQuery("body").addClass("modal-open");
                                },
                                onUnblock: function () {
                                    jQuery("body").removeClass("modal-open");
                                },
                                css: {
                                    border: '0px',
                                    width: '100%',
                                    height: '100%',
                                    top: '0%',
                                    left: '0%',
                                    background: 'transparent',
                                    cursor: 'context-menu'
                                },
                                overlayCSS: {backgroundColor: '#000000', opacity: .7}
                            });

                            jQuery('#tos_action .disablefornow').tooltip();
                            ScrollCheckElement = document.getElementById('tos_popup');
                            jQuery('#tos_popup').scroll(function () {
                                if (ScrollCheckElement.scrollTop >= (ScrollCheckElement.scrollHeight - ScrollCheckElement.offsetHeight)) {
                                    jQuery('#tos_action .disablefornow').fadeOut(500, function () {
                                        jQuery('#tos_action').removeClass('disabled');
                                    });
                                }
                            });

                            jQuery('#tos_action .button-danger').one('click touchstart', function (ev) {
                                jQuery.unblockUI();
                                jQuery(form).unblock();
                                jQuery("body").removeClass("modal-open");
                            });

                            jQuery('#tos_action .button-success').one('click touchstart', function (ev) {
                                jQuery.ajax({
                                    type: "post",
                                    url: cortiamajax.accepttosurl,
                                    data: {'tos_accepted': true},
                                    dataType: "json",
                                    beforeSend: function () {
                                        jQuery('#tos_action').block({
                                            message: 'PLEASE WAIT...',
                                            css: {
                                                'font-size': '1rem',
                                                'font-weight': '600',
                                                border: '0px',
                                                background: 'transparent',
                                            },
                                            overlayCSS: {backgroundColor: '#f5f5f5', opacity: 0.7}
                                        });
                                    },
                                    success: function (response) {
                                        if (response.success) {
                                            jQuery("body").removeClass("modal-open");
                                            jQuery.unblockUI();
                                            jQuery('#editprofileform .button-orange').click();
                                        } else {
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
                        if (i.errorfields) {
                            jQuery.each(i.errorfields, function (index, value) {
                                jQuery("#" + index).addClass("border-danger").one("focus", function () {
                                    jQuery(this).removeClass("border-danger");
                                });
                            });
                        }
                    }
                });

            }
        });
    });

    if (typeof popmeup != 'undefined' && typeof popmeup.messagetitle != 'undefined') {
        jQuery('body').on('click', '.nav-link:not(:last-child)', function (ev) {
           if($(this).text() == 'My Account' )
           { }else{
               ev.preventDefault();
               if(typeof licenseaddedyes == 'undefined' ) {
                   swal.fire({
                       title: popmeup.messagetitle,
                       text: popmeup.messagetext,
                       type: "error",
                       confirmButtonClass: "button-danger"
                   });
               }
           }
        });
    }

    if (typeof notify.theme != 'undefined') {
        iziToast.show(notify);
    }


});


jQuery(document).on('click', '.unsubscribe', function () {

    Swal.fire({
        title: 'Do you want to Unsubscribe Plan?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonColor: '#00c48d',
        denyButtonColor: '#aaa',
        confirmButtonText: 'Yes',
        denyButtonText: `Cancel`,
    }).then((result) => {


        /* Read more about isConfirmed, isDenied below */
        if (result.dismiss == "cancel") {
            return false;
        }

        let url = $(this).attr('href');

        window.location.href = url;

        return true;
    });

    return false;
});

jQuery(document).on("change", '#notifications', function (ev) {

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
                cancelButtonClass: "button-dark float-left",
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
            cancelButtonClass: "button-dark float-left",
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
        url: cortiamajax.setNotification,
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


jQuery(document).ready(function () {

    $('#sellerMessages').click(function () {


    });


    $('#buyerMessages').click(function () {
        alert("tet1");

    });

});


// $("#addNewPremiumListQuery").click(function () {
//     jQuery.ajax({
//         url: "agent/ajax/get-agent-days",
//         type: "get",
//         cache: false,
//         success: function (data, allAgentsPremiumListing) {
//             data = JSON.parse(data)
//             var totalDays = data.count_date_range_days;
//             $('#addNewPremiumListQueryModal').modal('show');
//
//             let dates = [];
//             data.allAgentsPremiumListing.map(item => {
//
//                 let fromDate = moment(item.start_date)
//                 let toDate = moment(item.end_date)
//                 let diff = toDate.diff(fromDate, 'days')
//                 // console.log(diff);
//                 let range = []
//                 for (let i = 0; i < diff + 1; i++) {
//                     dates.push(moment(item.start_date).add(i, 'days').format('YYYY-MM-DD'))
//                 }
//             });
//
//
//             $(function () {
//
//                 console.log(dates);
//
//                 let getSettingValue = $('#getSettingValue').val();
//                 // console.log(getSettingValue)
//                 let remainingDays = getSettingValue - 1;
//                 // console.log(remainingDays)
//                 var departpicker = new Date();
//
//                 $('.date-time').daterangepicker({
//                     opens: 'left',
//                     minDate: new Date(),
//                     "drops": "up",
//                     "maxSpan": {
//                         "days": remainingDays,
//                     },
//
//                     // format: 'mm-dd-yyyy',
//                     // datesDisabled: dates,
//
//                     "isInvalidDate": function (date) {
//                         dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
//                         if (dates.indexOf(dmy) !== -1) {
//                             return false;
//                         } else {
//                             return true;
//                         }
//                     },
//
//                     // beforeShowDay: function (date) {
//                     //     dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
//                     //     if (dates.indexOf(dmy) !== -1) {
//                     //         return false;
//                     //     } else {
//                     //         return true;
//                     //     }
//                     // },
//
//                     // maxDate: moment(departpicker, 'YYYY-MM-DD').add(getSettingValue, 'days'),
//                 }, function (start, end, label) {
//                     console.log(getSettingValue);
//                     console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
//                 });
//             });
//
//
//         }
//     });
// });


// Date Range
jQuery(document).ready(function () {


    // $(function () {
    //     let getSettingValue = $('#getSettingValue').val();
    //     var departpicker = new Date();
    //
    //     $('.date-time').daterangepicker({
    //         opens: 'left',
    //         minDate: new Date(),
    //         "drops": "up",
    //         "maxSpan": {
    //             "days": getSettingValue,
    //         },
    //         // maxDate: moment(departpicker, 'YYYY-MM-DD').add(getSettingValue, 'days'),
    //     }, function (start, end, label) {
    //         console.log(getSettingValue);
    //         console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    //     });
    // });

    $('#time-slot').wickedpicker();

});

$("#week-selection").click(function (e){
   $("#ui-datepicker-div").attr('style', 'top: 190px !important; display: block; position: fixed; z-index: 1051; left:500px');


});

$("#termandcondition").click(function (e) {
    let nolicenses = $('#nolicenses').val();
    if(nolicenses !== "nolicenses")
    {

        jQuery.ajax({
        url: cortiamphotoajax.termandcondition,
        type: "POST",
        dataType: "json",
        cache: false,
        success: function (i) {

            jQuery.blockUI({
                message: i.tos_content,
                    onBlock: function () {
                        jQuery("body").addClass("modal-open");
                    },
                    onUnblock: function () {
                        jQuery("body").removeClass("modal-open");
                    },
                    css: {
                        border: '0px',
                        width: '100%',
                        height: '100%',
                        top: '0%',
                        left: '0%',
                        background: 'transparent',
                        cursor: 'context-menu'
                    },
                    overlayCSS: {backgroundColor: '#000000', opacity: .7}
                });

                jQuery('#tos_action .disablefornow').tooltip();
                ScrollCheckElement = document.getElementById('tos_popup');
                jQuery('#tos_popup').scroll(function () {
                    if (ScrollCheckElement.scrollTop >= (ScrollCheckElement.scrollHeight - ScrollCheckElement.offsetHeight)) {
                        jQuery('#tos_action .disablefornow').fadeOut(500, function () {
                            jQuery('#tos_action').removeClass('disabled');
                        });
                    }
                });

                jQuery('#tos_action .button-danger').one('click touchstart', function (ev) {
                    jQuery.unblockUI();
                    jQuery(form).unblock();
                    jQuery("body").removeClass("modal-open");
                });


            jQuery('#tos_action .button-success').one('click touchstart', function (ev) {
                    jQuery.ajax({
                        url: cortiamphotoajax.updateaccepttos,
                        type: "POST",
                        dataType: "json",
                        beforeSend: function () {
                            jQuery('#tos_action').block({
                                message: 'PLEASE WAIT...',
                                css: {
                                    'font-size': '1rem',
                                    'font-weight': '600',
                                    border: '0px',
                                    background: 'transparent',
                                },
                                overlayCSS: {backgroundColor: '#f5f5f5', opacity: 0.7}
                            });
                        },
                        success: function (response) {
                            if (response.success) {
                                jQuery("body").removeClass("modal-open");
                                jQuery.unblockUI();
                                swal.fire({
                                    title: 'Term and services',
                                    text: 'You accepted term and services',
                                    type: "success",
                                    confirmButtonClass: "button-orange"
                                });

                                $("#termandcondition").css("display", 'none');
                                // jQuery('#editprofileform .button-orange').click();
                            } else {
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
    });
    }
});


$(document).ready(function(){

    jQuery.ajax({
        type: "get",
        url: cortiamajax.getcalenderyear,
        dataType : "text",
        success: function(response) {
            if (response) {
                $('#yearcalebderplace').html(response);
            }
        }
    });
});




