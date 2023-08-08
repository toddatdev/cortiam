
jQuery(document).ready(function() {

    var	agentratingtablechange = jQuery('#buyerTable').DataTable({
        processing	: true,
        serverSide	: true,
        order 		: [[ 0, "desc" ]],
        paging  	: true,
        pageLength  : 25,
        lengthMenu  : [ 10, 25, 50, 75, 100 ],
        type        : 'POST',
        language: {
            searchPlaceholder: "Search By Title"
        },

        ajax: {

            url: cortiamajax.agentlist,
            data: function (d) {
                // d.email = $('.searchEmail').val(),
                // d.search = $('input[type="search"]').val()
            }
        },
        // alert("okkk");

        columns: [
            {data: 'id', name: 'id',

                render: function (data, type, row, meta ) {
                    return meta.row+1;
                },

            },
            {data: 'agent_firstName', name: 'agent_firstName'},
            {data: 'rating',   name: 'rating'},
            {data: 'comment',  name: 'comment'},
            {data: 'action',   name: 'action', orderable: false, searchable: false}
        ]
    });


    jQuery('body').on( "click", '.expand', function(ev) {

        var tr = $(this).closest('tr');
        var row = agentratingtablechange.row(tr);
        var agetId = $(this).attr('data-rating');

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(tableHead(row.data())).show();

            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    function tableHead(d)
    {

        var table = '<table id="expandedTable'+d.id+'" class="expandedTable" cellpadding="5" cellspacing="0" border="0" style=" width:100%; padding-left:200px;">' +
            '<thead><tr><th>Question</th><th>Rating</th><th>Created at</th></tr></thead>' +
            '<tbody id="optionsTbl'+d.id+'"></tbody>'+
            '</table>';
        return table;
    }



    function format(d) {
        // `d` is the original data object for the row

        let reviewid = d.id;

        $('#optionsTbl').empty();

        jQuery.ajax({
            type: "post",
            url: cortiamajax.getratingdetails,
            data: {reviewid :  reviewid},
            dataType: "json",
            success: function(response){

                for (let index = 0; index < response.length; index++)
                {

                    let stars = '';

                    switch (response[index].rate) {

                        case '1':

                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';

                            break;

                        case '2':

                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';


                            break;

                        case '3':
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';



                            break;

                        case '4':
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';


                            break;

                        case '5':

                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#00c48d ;"></i>';


                            break;

                        default:
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';
                            stars +='<i class="fa fa-star" aria-hidden="true" style="color:#cccccc9c;"></i>';

                            break;

                    }


                    $('#optionsTbl'+reviewid).prepend($('<tr class="row'+response[index].que+'"><td>'+response[index].que+'</td><td>'+stars+'</td><td>'+response[index].created_at+'</td><tr>'));

                }
            }

        });
    }


    jQuery(document).ready(function() {


        // alert("okkk");
        // jQuery('.maxlength-textarea').trumbowyg();
        // $(".js-example-basic-multiple").select2({
        //     tags: true,
        // 	tokenSeparators: [',', '  ']
        // });
        // $('.js-example-basic-multiple').select2();
        callTable();

    });


    $(document).on('click', ".viewComment", function() {
        var comment = $(this).attr("data-readMoreComment");

        $("#viewReadMoreComment").text(comment);

    });

    jQuery('body').on( "click", '.delete', function(ev) {

        let base_url =$('#base_url').val();
        let id = $(this).attr('data-delete');

        Swal.fire({
            title: 'Do you want to Delete the record?',
            showCancelButton: true,
            confirmButtonColor: '#00c48d',
            confirmButtonText: 'Ok',
            denyButtonText: false,
            confirmButtonClass: "btn btn-success",
            cancelButtonClass: "btn btn-danger"
        }).then((result) => {

            if (result.value)
            {
                jQuery.ajax({
                    type: "post",
                    url: cortiamajax.deleterecord,
                    data: { id : id},
                    dataType: "text",
                    success: function(response){

                        if(response=="success"){
                            swal.fire({
                                title: "Rating",
                                text: "Record deleted successfully",
                                type: "success",
                                confirmButtonClass: "btn btn-success"
                            });

                            agentratingtablechange.draw();

                        }
                        if(response == "fail"){
                            swal.fire({
                                title: "Agent Rating",
                                text: "Record cannot deleted, due to error",
                                type: "error",
                                confirmButtonClass: "btn btn-success"
                            });
                        }


                    }
                });
            }
        })
    });


});
