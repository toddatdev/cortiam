$(document).ready(function() {


    ourdatatable = $('#attributesDataTable').DataTable({
        processing	: true,
        serverSide	: true,
        responsive 	: true,
        order 		: [[ 0, "asc" ]],
        paging  	: true,
        pageLength  : 25,
        lengthMenu  : [ 10, 25, 50, 75, 100 ],
        type        : 'get',
        language: {
            searchPlaceholder: "Search By Title"
        },
        ajax: {
            url: cortiamajax.attributestableajaxurl,
            data: function (d) {

                d.user_type = $('#userType').val();
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'first_name', name: 'first_name'},
            {data: 'attribute_name', name: 'attribute_name'},
        ]
    });


    $("#userType").change(function(){

        ourdatatable.draw();
    });


});