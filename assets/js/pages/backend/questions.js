jQuery(document).ready(function() {

    $( "#addquestion" ).validate();
    // $( "#updatequestion" ).validate();

// jQuery('.maxlength-textarea').trumbowyg();


    $(".js-example-basic-multiple").select2({
        tags: true,
        tokenSeparators: [',', '  ']
    });



    ourdatatable = jQuery('#questionDataTable').DataTable({
        processing	: true,
        serverSide	: true,
        order 		: [[ 0, "asc" ]],
        paging  	: true,
        pageLength  : 25,
        lengthMenu  : [ 10, 25, 50, 75, 100 ],
        type        : 'POST',
        language: {
            searchPlaceholder: "Search By Title"
        },
        ajax: {
            url: cortiamajax.questiontableajaxurl,
            data: function (d) {

            }
        },
        columns: [
            {data: 'id', name: 'id',

                render: function (data, type, row, meta ) {
                    return meta.row+1;
                },

            },
            {data: 'title', name: 'title'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    jQuery('body').on( "click", '#questionFormSave', function() {

        jQuery('#addquestion').submit();

    });



    jQuery('#addquestion').submit(function (e){

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

                ourdatatable.draw();

                document.getElementById("addquestion").reset();

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
                    url: base_url+"ajax/backend/question-deleted/"+id,
                    data: { id : id},
                    dataType: "text",
                    success: function(response){

                        if(response=="success"){
                            swal.fire({
                                title: "Question",
                                text: "Question deleted successfully",
                                type: "success",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                        if(response == "fail"){
                            swal.fire({
                                title: "Question Plan",
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
                document.getElementById("addquestion").reset();
                jQuery("#editquestionModal").modal('hide');
            }
        });


        return false;
    });


});