jQuery(document).ready(function() {

    $( "#saveSurveyForm" ).validate();

    $(".js-example-basic-multiple").select2({
        tags: true,
        tokenSeparators: [',', '  ']
    });

    jQuery('body').on( "click", '#saveSureveyFormOfSeller', function() {

        jQuery('#saveSurveyForm').submit();

    });

    jQuery('#saveSurveyForm').submit(function (e){

        e.preventDefault();

        if($('#title').val() == '')
        {
            return false;
        }

        jQuery.ajax({
            type: "post",
            url: cortiamajax.questionaddajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){
                if(response=="success"){
                    swal.fire({
                        title: "Question",
                        text: "Question saved successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if(response == "fail"){
                    swal.fire({
                        title: "Question",
                        text: "Question cannot saved",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                document.getElementById("saveSurveyForm").reset();

                jQuery("#questionModal").modal('hide');

                $("#js-example-basic-multiple").val(null).empty().select2();
                $(".js-example-basic-multiple").select2({
                    tags: true,
                    tokenSeparators: [',', '  ']
                });


            }
        });


        return false;
    });


    jQuery('body').on( "click", '.edit', function(ev) {

        $(".updateFeatures").attr("checked", false);
        let id = $(this).attr('data-edit');
        $('#updatequestionid').val(id);
        let base_url =$('#base_url').val();
        jQuery.ajax({
            type: "post",
            url: base_url+"ajax/backend/question-edit/"+id,
            data: { id : id},
            dataType: "json",
            success: function (response) {
                console.log(response);
                let id = response[0].id;
                let title = response[0].title;


                if (response !== '') {
                    $('#updatequestionid').val(id);

                    $('#editquestiontitle').val(title);
                }
            }
        });
    });



    jQuery('body').on( "click", '#questionUpdate', function(ev) {

        jQuery('#updatequestion').submit();

    });


    jQuery('#updatequestion').submit(function (){

        jQuery.ajax({
            type: "post",
            url: cortiamajax.questionupdateajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){


                if(response=="success"){
                    swal.fire({
                        title: "Question Plan",
                        text: "Question plan updated successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if(response == "fail"){
                    swal.fire({
                        title: "Question Plan",
                        text: "Question plan cannot updated",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                ourdatatable.draw();
                document.getElementById("saveSurveyForm").reset();
                jQuery("#editquestionModal").modal('hide');
            }
        });


        return false;
    });


});