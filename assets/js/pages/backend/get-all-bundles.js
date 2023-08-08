jQuery(document).ready(function() {
	jQuery( "#addPlanship" ).validate();
	jQuery( "#updatePlane" ).validate();

    $("#setstate").select2({
        placeholder: "Select a State",
        allowClear: true

    });

    $('#doeditstate').select2({
        placeholder: "Select a State",
        allowClear: true

    });


    ourdatatable  = jQuery('#payforspot').DataTable({
	processing	: true,
	serverSide	: true,
	responsive 	: true,
	order 		: [[ 0, "desc" ]],
	paging  	: true,
	pageLength  : 25,
	lengthMenu  : [ 10, 25, 50, 75, 100 ],
	type        : 'POST',
  	language: {
        searchPlaceholder: "Search By Title"
    	},
	ajax: {
	  url: cortiamajax.getallbundles,
	  data: function (d) {
			// d.email = $('.searchEmail').val(),
			// d.search = $('input[type="search"]').val()
		}
	},
	columns: [
		{data: 'id', name: 'id',},
		{data: 'title', name: 'title'},
		{data: 'durattion_days', name: 'durattion_days'},
		{data: 'per_day_price', name: 'per_day_price'},
        {data: 'state', name: 'state'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
	]
});


jQuery('body').on( "click", '#formSave', function(ev) {

	
	if($('#discount').val() === '') 
	{
		$('#discount').val('0');
	}
	jQuery('#discount').focusout();
	jQuery('#addPlanship').submit();
});



jQuery('body').on( "click", '#saveBundle', function(ev) {
    let findError = false;


    if(!$('#setstate').val())
    {
        $('#stateError').css('display', 'block');
        findError = true;
    }else{
        $('#stateError').css('display', 'none');
    }

    if(!$('#title').val())
    {
        $('#titleError').text('Please enter title');
        $('#titleError').css('display', 'block');
        findError = true;
    }else{
        $('#titleError').css('display', 'none');
    }
    if(!$('#perday').val() || $('#perday').val() > 365)
    {
        $('#perdayError').css('display', 'block');
        findError = true;
    }else{
        $('#perdayError').css('display', 'none');
    }
    if($('#perday').val() < 1)
    {
        $('#perday').val('');
        $('#perdayError').css('display', 'block');
        findError = true;
    }

    if(!$('#price').val())
    {
        $('#priceError').css('display', 'block');
        findError = true;
    }

    if($('#price').val() < 1)
    {
        $('#price').val('');
        $('#priceError').css('display', 'block');
        findError = true;
    }

    if(findError == true)
    {
            return false;

    }else{
        $('#titleError').css('display', 'none');
        $('#perdayError').css('display', 'none');
        $('#priceError').css('display', 'none');
    }
    console.log($( '#addData' ).serialize());
    Swal.fire({
        title: 'Do you want to save this record?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ok',
        denyButtonText: 'cancel',
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger"
      }).then((result) => {

        if(result.value)
        {   
            jQuery.ajax({
                type: "post",
                url: cortiamajax.saveBundle,
                data:$( '#addData' ).serialize(),
                    success: function(response){

                        if(response)
                        {
                            ourdatatable.draw();
                            $( '#addData' )[0].reset();
                            $('.close').click();

                            $("#setstate").select2('destroy');
                            $("#setstate").select2({
                                placeholder: "Select a State",
                                allowClear: true

                            });
                        }
                    }
                });
        }
       
      });
        

});
    jQuery(document).on( "click", '.delete', function(ev) {

		  let id       = $(this).attr('data-delete');


		  Swal.fire({
			title: 'Do you want to Delete the record?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: 'Ok',
			denyButtonText: 'cancel',
			confirmButtonClass: "btn btn-success",
			cancelButtonClass: "btn btn-danger"
		  }).then((result) => {
              if(result.value){

                  jQuery.ajax({
                    type: "post",
                    url: cortiamajax.deleteBundle,
                    data: { id : id},
                        success: function(response){
                            ourdatatable.draw();
                        }
                    });
              }
		  })   

	});


    jQuery(document).on( "click", '.edit', function(ev) {

		let id 		 = $(this).attr('data-edit');
        $('#id').val(id);
        let editTitle = $(this).closest('tr').find("td:eq(1)").text();
        let editPerday = $(this).closest('tr').find("td:eq(2)").text();
        let editPrice = $(this).closest('tr').find("td:eq(3)").text();
        let editState = $(this).closest('tr').find("td:eq(4)").text();
        var price = editPrice.replace("$", "");
        $('#doeditstate').val(editState).trigger("change");
        $('#editTitle').val(editTitle);
        $('#editPerday').val(editPerday);
        $('#editPrice').val(price);
        
	});

    jQuery(document).on( "click", '#updateBundle', function(ev) {

            jQuery.ajax({
                type: "post",
                url: cortiamajax.uniquedayedit,
                data:{day : $("#editPerday").val(), state : $('#doeditstate').val()},
                success: function(response){


                    if(response  > 1){
                        $('#editPerday').val('');
                        $('#editPerday').focus();
                        $('#editStateError').text("State already exist.");
                        $('#editStateError').css('display', 'block');
                        $('#editPerdayError').text("Days already exist.");
                        $('#editPerdayError').css('display', 'block');
                    }




        let findError = false;
        $('#editPerdayError').css("display", "none");
        $('#editPerdayError').text('Only number allowed from 0 to 365');
        if(!$('#doeditstate').val())
        {
            $('#editStateError').css('display', 'block');
            findError = true;
        }else{
            $('#editStateError').text('Pleae select a state');
            $('#editStateError').css('display', 'none');
        }

        if(!$('#editTitle').val())
        {
            $('#editTitleError').css('display', 'block');
            findError = true;
        }else{
            $('#editTitleError').css('display', 'none');
        }
        if(!$('#editPerday').val() || $('#editPerday').val() >365)
        {
            $('#editPerday').val('');
            $('#editPerdayError').css('display', 'block');
            findError = true;
        }else{
            $('#editPerdayError').css('display', 'none');
        }

        if($('#editPerday').val()< 1)
        {
            $('#editPerday').val('');
            $('#editPerdayError').css('display', 'block');
            findError = true;
        }

        if(!$('#editPrice').val())
        {
            $('#editPrice').val('');
            $('#editPriceError').css('display', 'block');
            findError = true;
        }

        if($('#editPrice').val()< 1 ||  $('#editPrice').val() == '')
        {
            $('#editPrice').val('');
            $('#editPriceError').css('display', 'block');
            findError = true;
        }

        if(findError == true)
        {
                return false;

        }else{
            $('#editTitleError').css('display', 'none');
            $('#editPerdayError').css('display', 'none');
            $('#editPriceError').css('display', 'none');
        }



            Swal.fire({
                title: 'Do you want to update the record?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ok',
                denyButtonText: 'cancel',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger"
              }).then((result) => {


                    jQuery.ajax({
                        type: "post",
                        url: cortiamajax.editBundle,
                        data:$( '#editData' ).serialize(),
                            success: function(response){


                                if(response >  1){
                                    $('#editStateError').css("display", "block");
                                    $('#editStateError').text("State already exist");
                                    $('#editPerdayError').css("display", "block");
                                    $('#editPerdayError').text('Days already exist.');

                                }else{
                                    ourdatatable.draw();
                                    $('.close').click();
                                }


                            }
                        });

              })


    }
    });
});
});



jQuery('body').on( "click", '#saveMaxDays', function(ev) {
    ev.preventDefault()

    let payfor_maxdays = $('#payfor_maxdays').val();


    if(!payfor_maxdays && ! $.isNumeric(payfor_maxdays))
    {
        $('#maxNoDays').css('display', 'block');
        return false;
    }else{
        $('#maxNoDays').css('display', 'none');

    }

    if(payfor_maxdays < 1)
    {
        $('#payfor_maxdays').val('');
        $('#maxNoDays').css('display', 'block');
        return false;
    }

    if(payfor_maxdays > 365)
    {
        $('#maxNoDays').css('display', 'block');
        return false;
    }

    // Swal.fire({
    //     title: 'Do you want to save / update the record?',
    //     showDenyButton: true,
    //     showCancelButton: true,
    //     confirmButtonText: 'Ok',
    //     denyButtonText: 'cancel',
    //     confirmButtonClass: "btn btn-success",
    //     cancelButtonClass: "btn btn-danger"
    // }).then((result) => {


        jQuery.ajax({
            type: "post",
            url: cortiamajax.saveMaxDays,
            data:{payfor_maxdays : $('#payfor_maxdays').val()},
            success: function(response){
                Swal.fire('Saved!', 'Record saved / updated Successfully!', 'success')

                Swal.fire({
                    title: 'Record saved / updated Successfully!',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    denyButtonText: 'cancel',
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger"
                })

                ourdatatable.draw();

            }
       });

    // })
});

jQuery('body').on( "click", '#saveNumberOfagensts', function(ev) {
    ev.preventDefault()

    let number_of_agents_at_premium = $('#number_of_agents_at_premium').val();
    if(!number_of_agents_at_premium &&  ! $.isNumeric(number_of_agents_at_premium))
    {
        $('#maxNoagents').css('display', 'block');
        return false;
    }else{
        $('#maxNoagents').css('display', 'none');

    }
    if(number_of_agents_at_premium < 1)
    {
        $('#number_of_agents_at_premium').val('');
        $('#maxNoagents').css('display', 'block');
        return false;
    }

    jQuery.ajax({
        type: "post",
        url: cortiamajax.saveMaxAgents,
        data:{number_of_agents_at_premium : $('#number_of_agents_at_premium').val()},
        success: function(response){



            Swal.fire({
                title: 'Record saved / updated Successfully!',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'Ok',
                denyButtonText: 'cancel',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger"
            })
            ourdatatable.draw();

        }
    });
});


$(document).on("input", "#perday", function() {
    if(this.value == 0){
        $(this).val('');
    }
    this.value = this.value.replace(/\D/g,'');
});

$(document).on("input", "#price", function() {
    if(this.value == 0){
        $(this).val('');
    }
    this.value = this.value.replace(/\D/g,'');
});


$(document).on("input", "#editPerday", function() {
    if(this.value == 0){
        $(this).val('');
    }
    this.value = this.value.replace(/\D/g,'');
});

$(document).on("input", "#editPrice", function() {
    if(this.value == 0){
        $(this).val('');
    }
    this.value = this.value.replace(/\D/g,'');
});


// $("#title").focusout(function(){
//
//     if($(this).val() !== ''){
//         jQuery.ajax({
//             type: "post",
//             url: cortiamajax.uniquetitle,
//             data:{title : $(this).val()},
//             success: function(response){
//
//                 if(response  > 0){
//                     $('#title').val('');
//                     $('#title').focus();
//                     $('#titleError').text("Title already exist.");
//                     $('#titleError').css('display', 'block');
//                 }
//             }
//         });
//
//     }
//
//
//     return false;
// });



// $("#editTitle").focusout(function(){
//
//     if($(this).val() !== ''){
//         jQuery.ajax({
//             type: "post",
//             url: cortiamajax.uniquetitle,
//             data:{title : $(this).val()},
//             success: function(response){
//
//                 if(response  > 0){
//                     $('#editTitle').val('');
//                     $('#editTitle').focus();
//                     $('#titleError').text("Title already exist.");
//                     $('#titleError').css('display', 'block');
//                 }
//             }
//         });
//
//     }
//
//
//     return false;
// });

$("#price").focusout(function(){
    if($('#perday').val() !== ''){
        jQuery.ajax({
            type: "post",
            url: cortiamajax.uniqueday,
            data:{day : $('#perday').val(), state : $('#setstate').val()},
            success: function(response){

                console.log(response);

                if(response  > 0){
                    $('#perday').val('');
                    $('#perday').focus();
                    $('#perdayError').text("Days already exist.");
                    $('#perdayError').css('display', 'block');
                }
            }
        });

    }


    return false;
});

$("#perday").focusout(function(){

    if($(this).val() !== ''){
        jQuery.ajax({
            type: "post",
            url: cortiamajax.uniqueday,
            data:{day : $(this).val(), state : $('#setstate').val()},
            success: function(response){
                if(response  > 0){
                    $('#perday').val('');
                    $('#perday').focus();
                    $('#perdayError').text("Days already exist.");
                    $('#perdayError').css('display', 'block');

                    $('#editPerdayError').css("display", "block");
                    $('#editPerdayError').text('Days already exist');
                }else{

                    $('#editPerdayError').css("display", "none");
                    $('#editPerdayError').text('Only number allowed from 0 to 365');
                }

            }
        });

    }


    return false;
});



$("#editPerday").focusout(function(){

    alreadyexistDays();
});

function alreadyexistDays()
{
    if($("#editPerday").val() !== ''){
        jQuery.ajax({
            type: "post",
            url: cortiamajax.uniquedayedit,
            data:{day : $("#editPerday").val(), state : $('#doeditstate').val()},
            success: function(response){


                if(response  > 0){
                    $('#editPerday').val('');
                    $('#editPerday').focus();
                    $('#editStateError').text("State already exist.");
                    $('#editStateError').css('display', 'block');
                    $('#editPerdayError').text("Days already exist.");
                    $('#editPerdayError').css('display', 'block');
                }

            }
        });

    }

    return false;
}

$('.addCancelBtn').click(function (){

    $('#titleError').css('display', 'none');
    $('#perdayError').css('display', 'none');
    $('#priceError').css('display', 'none');
    $("#stateError").css('display', 'none');

    $( '#addData' )[0].reset();

    $("#setstate").select2('destroy');
    $("#setstate").select2({
        placeholder: "Select a State",
        allowClear: true
    });

});

$('.editCancelBtn').click(function (){

    $('#editStateError').css('display', 'none');
    $('#editTitleError').css('display', 'none');
    $('#editPerdayError').css('display', 'none');
    $('#editPriceError').css('display', 'none');

});
