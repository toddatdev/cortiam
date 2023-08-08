$('#editstate').select2();
let alreadyexist = false;

jQuery(document).ready(function() {

    jQuery.ajax({
        type: "post",
        url: cortiamajax.countAgents,
        data:{state : $(this).val()},
        success: function(response){
            $('#totalNumberofAgents').val(response);
        }
    });

	jQuery( "#addPlanship" ).validate();
	jQuery( "#updatePlane" ).validate();

    ourdatatable = jQuery('#payforspot').DataTable({
	processing	: true,
	serverSide	: true,
	responsive 	: true,
	order 		: [[ 0, "desc" ]],
	paging  	: true,
	pageLength  : 25,
	lengthMenu  : [ 10, 25, 50, 75, 100 ],
	type        : 'POST',
  	language: {
        searchPlaceholder: "Search By State"
    	},
	ajax: {
	  url: cortiamajax.getallagents,
	  data: function (d) {
			// d.email = $('.searchEmail').val(),
			// d.search = $('input[type="search"]').val()
		}
	},
	columns: [
		{data: 'id', name: 'id'},
		{data: 'state', name: 'state'},
		{data: 'number_of_agent', name: 'number_of_agent'},
        {data: 'per_day_price', name: 'per_day_price'},
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



jQuery('body').on( "click", '#saveAgent', function(ev) {

    let findError = false;
    let total_count_agents = $('#totalNumberofAgents').val();


    if(!$('#state').val())
    {   
        $('#stateError').css('display', 'block');
        findError = true;
    }else{
        $('#stateError').css('display', 'none');
    }

    if(!$('#agents').val())
    {

    }
    if(!$('#agents').val() && !$.isNumeric($('#agents').val()))
    {
        let string = '';
        $('#numberofAgentsError').css('display', 'block');

        if($('#agents').val()==''){
             string = "This field is required.";
        }else{
             string = `Only ${total_count_agents} agents are registered.`;
        }
        $('#numberofAgentsError').text(string);
        findError = true;
    }else{
        $('#numberofAgentsError').css('display', 'none');
    }

    if($('#agents').val()<1 )
    {
        $('#agents').val('');
        $('#numberofAgentsError').css('display', 'block');
        findError = true;
    }

    if(parseInt($('#agents').val())> total_count_agents)
    {
        let string = '';
        string = `Only ${total_count_agents} agents are registered.`;
        $('#numberofAgentsError').text(string);


        $('#agents').val('');
        $('#numberofAgentsError').css('display', 'block');
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
        $('#stateError').css('display', 'none');
        $('#numberofAgentsError').css('display', 'none');
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
                url: cortiamajax.saveAgent,
                data:$( '#addData' ).serialize(),
                    success: function(response){

                        if(response)
                        {
                            ourdatatable.draw();
                            $( '#addData' )[0].reset();
                            $('.close').click();

                            $("#state").select2('destroy');
                            $("#state").select2({
                                data : _states_,
                                placeholder: "Select a State",
                            });

                           // location.reload(true);

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
                    url: cortiamajax.deleteAgent,
                    data: { id : id},
                        success: function(response){
                            ourdatatable.draw();
                        }
                    });}
		  })

	});


    jQuery(document).on( "click", '.edit', function(ev) {

		let id 		 = $(this).attr('data-edit');
        $('#editNumberofAgentsError').text("This field is required");

        $('#id').val(id);
        let editState = $(this).closest('tr').find("td:eq(1)").text();
        
        

        let editAgent = $(this).closest('tr').find("td:eq(2)").text();
        let editPerday = $(this).closest('tr').find("td:eq(3)").text();
        var price = editPerday.replace('$','');
        $('#editstate').val(editState).trigger("change");
        $('#editagents').val(editAgent);
        $('#editPrice').val(price);


        // $('#editTitle').val(editTitle);
        // $('#editPerday').val(editPerday);     
        
	});

    jQuery(document).on( "click", '#updateAgent', function(ev) {

        let findError = false;
        let total_count_agents = $('#totalNumberofAgents').val();
        let stateName          = $('#editstate').val();
        $('#editNumberofAgentsError').text("This field is required");

        if(!$('#editstate').val())
        {   
            $('#editStateError').css('display', 'block');
            findError = true;
        }else{
            $('#editStateError').text('Pleae select a state');

            $('#editStateError').css('display', 'none');
        }


        if(!$('#editagents').val() && ! $.isNumeric($('#editagents').val()))
        {
            $('#editNumberofAgentsError').css('display', 'block');
            findError = true;
        }else{
            $('#editNumberofAgentsError').css('display', 'none');
        }


        if($('#editagents').val() < 1){
            $('#editagents').val('');
            $('#editNumberofAgentsError').css('display', 'block');
            let string = `This field is required`;
            $('#editNumberofAgentsError').text(string);
            findError = true;
        }

        if(parseInt($('#editagents').val())> total_count_agents ){
            $('#editagents').val('');
            $('#editNumberofAgentsError').css('display', 'block');
            let string = `Only ${total_count_agents} agents are registered.`;
            $('#editNumberofAgentsError').text(string);
            findError = true;
        }

        if(!$('#editPrice').val())
        {

            $('#editPriceError').css('display', 'block');
            findError = true;
        }

        if($('#editPrice').val()< 1)
        {
            $('#editPrice').val('');
            $('#editPriceError').css('display', 'block');
            findError = true;
        }

        if(findError == true)
        {
            return false;
        }else{
            $('#editStateError').css('display', 'none');
            $('#editNumberofAgentsError').css('display', 'none');
            $('#editPriceError').css('display', 'none');
        }
       if(alreadyexist == false){
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
                    url: cortiamajax.editAgent,
                    data:$( '#editData' ).serialize(),
                        success: function(response){

                        console.log(response);

                            if(response >  1){
                                $('#editStateError').css("display", "block");
                                $('#editStateError').text("State already exist");
                                // $('#editNumberofAgentsError').css("display", "block");
                                // $('#editNumberofAgentsError').text("Agents already exist");

                            }else{
                                $('#editStateError').css("display", "none");
                                $('#editStateError').text("Pleae select a state");
                                // $('#editNumberofAgentsError').css("display", "none");
                                // $('#editNumberofAgentsError').text("This field is required");

                                ourdatatable.draw();
                                $( '#editData' )[0].reset();
                                $('.close').click();

                            }



                        }
                    });

		     })
     }

    });


        jQuery(document).on( "change", '#state', function(ev) {


            jQuery.ajax({
                type: "post",
                url: cortiamajax.countAgents,
                data:{state : $(this).val()},
                success: function(response){
                    $('#totalNumberofAgents').val(response);
                }
            });

        });


        jQuery(document).on( "change", '#editstate', function(ev) {


             jQuery.ajax({
                type: "post",
                url: cortiamajax.countAgents,
                data:{state : $(this).val()},
                success: function(response){
                    $('#totalNumberofAgents').val(response);
                }
                });

            });
    });



$(document).on("input", "#agents", function() {
    if(this.value == 0){
        $(this).val('');
    }
    this.value = this.value.replace(/\D/g,'');
});

$(document).on("input", "#editagents", function() {
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


$(document).on("input", "#editPrice", function() {
    if(this.value == 0){
        $(this).val('');
    }
    this.value = this.value.replace(/\D/g,'');
});


$('.addCancelBtn').click(function (){

    $('#stateError').css('display', 'none');
    $('#numberofAgentsError').css('display', 'none');
    $('#priceError').css('display', 'none');

    $( '#addData' )[0].reset();

    $("#state").select2('destroy');
    $("#state").select2({
        data : _states_,
        placeholder: "Select a State",
    });

});

$('.editCancelBtn').click(function (){

    $('#editStateError').css('display', 'none');
    $('#editNumberofAgentsError').css('display', 'none');
    $('#editPriceError').css('display', 'none');

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