$(document).ready(function() {
    $('#notitication_phone').formatter({
        pattern: '{{999}}-{{999}}-{{9999}}'
    });
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

            $(form).block({ message: '<img src="' + cortiamajax.loadingimage + '">', css: {border:'0px',background:'transparent',}, overlayCSS: {backgroundColor:'#f5f5f5',opacity:0.7}});
            $(form).ajaxSubmit({
                url: cortiamajax.bookavailableagentslot,
                data: {'agent_id' : cortiamajax.agent_id},
                type: "POST",
                dataType: "json",
                success: function(response) {
                    $('#bookslotajaxform')[0].reset();
                    $('#available-slots').html('');
                    if(response.type == 'fail'){
                        swal.fire({
                            title: response.title,
                            text: response.message,
                            type: response.type,
                            confirmButtonClass: "button-primary",
                            timer: 4000
                        });

                        $(form).unblock();
                        return false;
                    }


                    $('#getDays').val(response.bookeddays);




                    if(response.bookeddays == null)
                    {
                        location.reload();
                    }

                    $('#setDays').val(response.bookeddays);
                    $('#monthArray').val(response.allowedMonths);
                    $('#yearArray').val(response.allowedYears);

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
        minDate : 0,
        useCurrent: false,
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
            var selectedDateArray  = selectdMonthString.split(',');
            var yearArray          = $('#yearArray').val();
            var selectedYyearArray = yearArray.split(',');

            console.log(selectedYyearArray);
            // console.log(year);
            // console.log("------------------");
            // console.log(selectedDateArray);
            // console.log(month);

            let monthNmber = 0;
            if ( month < 10 )
            {
                monthNmber = "0" + month;
            }else{
                monthNmber = month;
            }
            console.log(year);
            year = year.toString();

            if($.inArray(monthNmber, selectedDateArray) !== -1 && $.inArray(year, selectedYyearArray) !== -1)
            {
                setcondtionfindDates  = false;
            }else{
                console.log("0");
                setcondtionfindDates = true;
            }
        }
    });

}
