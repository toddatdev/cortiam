jQuery(document).ready(function() {

    $( "#addattribute" ).validate();
    // $( "#updatequestion" ).validate();

// jQuery('.maxlength-textarea').trumbowyg();


    $(".js-example-basic-multiple").select2({
        tags: true,
        tokenSeparators: [',', '  ']
    });



    attributesDataTable = jQuery('#attributesDataTable').DataTable({
        processing	: true,
        serverSide	: true,
        order 		: [[ 0, "asc" ]],
        paging  	: true,
        pageLength  : 25,
        lengthMenu  : [ 10, 25, 50, 75, 100 ],
        type        : 'POST',
         ajax: {
            url: cortiamajax.attributestableajaxurl,
            data: function (d) {

            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    jQuery('body').on( "click", '#attributeFormSave', function() {

        jQuery('#addattribute').submit();

    });



    jQuery('#addattribute').submit(function (e){

        e.preventDefault();

        if($('#title').val() == '')
        {
            return false;
        }

        jQuery.ajax({
            type: "post",
            url: cortiamajax.attributeaddajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){
                if(response=="success"){
                    swal.fire({
                        title: "Attribute",
                        text: "Attribute saved successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if(response == "fail"){
                    swal.fire({
                        title: "Attribute",
                        text: "Attribute cannot saved",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                attributesDataTable.draw();

                document.getElementById("addattribute").reset();

                jQuery("#attributeModal").modal('hide');

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
                    url: base_url+"ajax/backend/attribute-deleted/"+id,
                    data: { id : id},
                    dataType: "text",
                    success: function(response){

                        if(response=="success"){
                            swal.fire({
                                title: "Attribute",
                                text: "Attribute deleted successfully",
                                type: "success",
                                confirmButtonClass: "btn btn-success"
                            });
                        }
                        if(response == "fail"){
                            swal.fire({
                                title: "Attribute Plan",
                                text: "Record cannot deleted, due to error",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }

                        attributesDataTable.draw();

                    }
                });
            }
        });

    });


    jQuery('body').on( "click", '.edit', function(ev) {

        $(".updateFeatures").attr("checked", false);
        let id = $(this).attr('data-edit');
        $('#updateattributeid').val(id);
        let base_url =$('#base_url').val();
        jQuery.ajax({
            type: "post",
            url: base_url+"ajax/backend/attribute-edit/"+id,
            data: { id : id},
            dataType: "json",
            success: function (response) {
                console.log(response);
                let id = response[0].id;
                let title = response[0].attribute_name;


                if (response !== '') {
                    $('#updateattributeid').val(id);
                    $('#editattributetitle').val(title);

                }
            }
        });
    });



    jQuery('body').on( "click", '#attributeUpdate', function(ev) {

        jQuery('#updateattribute').submit();

    });


    jQuery('#updateattribute').submit(function (){

        jQuery.ajax({
            type: "post",
            url: cortiamajax.attributeupdateajaxurl,
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){


                if(response=="success"){
                    swal.fire({
                        title: "Attribute Plan",
                        text: "Attribute plan updated successfully",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                }
                if(response == "fail"){
                    swal.fire({
                        title: "Attribute Plan",
                        text: "Attribute plan cannot updated",
                        type: "error",
                        confirmButtonClass: "btn btn-success"
                    });
                }

                attributesDataTable.draw();
                document.getElementById("addattribute").reset();
                jQuery("#editattributeModal").modal('hide');
            }
        });


        return false;
    });

        jQuery(document).on( "click", '#save_attribute_important', function(ev) {
            let base_url =$('#base_url').val();
            let attribute_important = $('#attribute_important').val();
            jQuery.ajax({
                type: "post",
                url: base_url+"/ajax/backend/save-attribute-text/",
                data: { attribute_important : attribute_important},
                dataType: "text",
                success: function(response) {

                    if(response)
                    {
                        swal.fire({
                            title: "Attribute text",
                            text: "Attribute added / updated successfully",
                            type: "success",
                            confirmButtonClass: "btn btn-success"
                        });
                    }
                }
            });
        });


    });