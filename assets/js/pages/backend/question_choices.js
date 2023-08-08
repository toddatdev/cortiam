jQuery(document).ready(function() {

    // $( "#addmembership" ).validate();
    // $( "#updatemembership" ).validate();

// jQuery('.maxlength-textarea').trumbowyg();


    $(".js-example-basic-multiple").select2({
        tags: true,
        tokenSeparators: [',', '  ']
    });

    ourdatatable = jQuery('#questionchoiceDataTable').DataTable({
        processing	: true,
        serverSide	: true,
        order 		: [[ 0, "desc" ]],
        paging  	: true,
        pageLength  : 25,
        lengthMenu  : [ 10, 25, 50, 75, 100 ],
        type        : 'POST',
        language: {
            searchPlaceholder: "Search By Text"
        },
        ajax: {
            url: cortiamajax.questionchoicestableajaxurl,
            data: function (d) {
                // d.email = $('.searchEmail').val(),
                // d.search = $('input[type="search"]').val()

            }
        },
        columns: [
            {data: 'id', name: 'id',

                render: function (data, type, row, meta ) {
                    return meta.row+1;
                },

            },
            {data: 'question_id', name: 'question_id', visible: false},
            {data: 'question_title', name: 'question_title'},
            {data: 'text', name: 'text'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });



    jQuery('body').on( "click", '#questionchoiceFormSave', function() {



        jQuery('#addquestionchoice').submit();

    });



    jQuery('#addquestionchoice').submit(function (e){

        e.preventDefault();

        // if($('#title').val() == '')
        // {
        //     return false;
        // }
        //
        // if($('#detail').val() == '')
        // {
        //     return false;
        // }

        jQuery.ajax({
            type: "post",
            url: cortiamajax.questionchoiceaddajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){


                if(response=="success"){
                    swal.fire({
                        title: "Questions Choice",
                        text: "Questions Choice saved successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if(response == "fail"){
                    swal.fire({
                        title: "Questions Choice",
                        text: "Questions Choice cannot saved",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                ourdatatable.draw();
                document.getElementById("addquestionchoice").reset();
                jQuery("#addquestionchoiceModal").modal('hide');




            }
        });


        return false;
    });



    jQuery('body').on( "click", '.delete', function(ev) {

        let base_url =$('#base_url').val();
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


            if (result.value)
            {

                jQuery.ajax({
                    type: "post",
                    url: base_url+"ajax/backend/question-choice-deleted/"+id,
                    data: { id : id},
                    dataType: "text",
                    success: function(response){

                        if(response=="success"){
                            swal.fire({
                                title: "Question Choice",
                                text: "Record deleted successfully",
                                type: "success",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                        if(response == "fail"){
                            swal.fire({
                                title: "Question Choice",
                                text: "Record cannot deleted, due to error",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }

                        ourdatatable.draw();

                    }
                });
            }
        });

    });


    jQuery('body').on( "click", '.edit', function(ev) {
        $(".updateFeatures").attr("checked", false);
        let id = $(this).attr('data-edit');
        $('#updatequestionid').val(id);
        let base_url =$('#base_url').val();
        jQuery.ajax({
            type: "post",
            url: base_url+"ajax/backend/question-choice-edit/"+id,
            data: { id : id},
            dataType: "json",
            success: function (response) {
                let id = response[0].id;
                let question_id = response[0].question_id;
                let text = response[0].text;

                $("#question_choice_id > option").each(function() {
                    $(this).attr("selected", false);
                    if(question_id == this.value)
                    {
                        $(this).attr("selected", true);
                    }
                });

                if (response !== '') {
                    $('#updatequestionchoiceid').val(id);

                    $('#editquestionchoicetitle').val(text);
                }
            }
        });


    });


    jQuery('body').on( "click", '#questionchoiceUpdate', function(ev) {

        jQuery('#updatequestionchoice').submit();

    });


    jQuery('#updatequestionchoice').submit(function (){

        //
        // if($('#editTitle').val() == '')
        // {
        //     return false;
        // }
        //
        // if($('#editDetail').val() == '')
        // {
        //     return false;
        // }

        jQuery.ajax({
            type: "post",
            url: cortiamajax.questionchoiceupdateajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){


                if(response=="success"){
                    swal.fire({
                        title: "Question Choice",
                        text: "Question Choice updated successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if(response == "fail"){
                    swal.fire({
                        title: "Question Choice",
                        text: "Question Choice cannot updated",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                ourdatatable.draw();
                // document.getElementById("addmembership").reset();
                jQuery("#editquestionchoiceModal").modal('hide');
            }
        });


        return false;
    });


});