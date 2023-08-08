jQuery(document).ready(function () {

    table = jQuery('#agentplanstbl').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[4, "asc"]],
        paging: true,
        searching :true,
        pageLength: 10,
        lengthMenu: [5, 10, 15, 20, 25],
        type: 'POST',
        language: {
            searchPlaceholder: "Search By Plan Name"
        },

        ajax: {
            url: cortiamajax.agentoldplans,
            data: function (d) {
                // d.email = $('.searchEmail').val(),
                // d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: "id",
                "render": function ( data, type, full, meta ) {
                  
                    return '<a href="javascript:void(0);" data-id="'+data+'" class="expand">+</a>';
  
                }
            },
            {data: 'plan_name', name: 'plan_name'},
            {data: 'subtotal', name: 'subtotal'},
            // {data: 'discount', name: 'discount'},
            {data: 'totalprice', name: 'totalprice'},
            {data: 'status',

            "render": function ( data, type, full, meta ) {

                    if(data == 1)
                    {
                        return '<center><span class="badge orange-bg badge-pill">ACTIVE</span></center>';
                    }else if(data == 4){
                             return '<center><span class="badge refund-bg badge-pill">FREE TRIAL</span></center>';
                    }else{
                         return '<center><span class="badge refund-bg badge-pill">IN-ACTIVE</span></center>';
                   }

  
                }
            }

        ]
    });




    $('#agentplanstbl tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
       
        if (row.child.isShown()) {
             // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');

            $(this).find('a').removeClass('notexpand');
            $(this).find('a').addClass('expand');
            $(this).find('a').text('+');

        } else {           
            
            $(this).find('a').removeClass('expand');
            $(this).find('a').addClass('notexpand');
            $(this).find('a').text('-');

            row.child(format(row.data())).show();
            tr.addClass('shown');
            features(row.data().id);
        }
    });

});


function format(d) {

   // `d` is the original data object for the row
    return (
        '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%;">' +
          '<thead>'+
            '<tr>' +
                '<th>Feature Name</th>' +
                '<th>Price</th>' +
                '<th>Discounted Price</th>' +

            '<td>' +
          '<thead>'+  
          '<tbody id="featuresTblBody'+d.id+'"></tbody>'+      
        '</tr>' +
        '</table>'
    );
}

function features(id)
{
    $.ajax({
        type: "post",
        url: cortiamajax.agentoldplansFeatures,
        data: {'subscription_id': id },
        dataType: "json",
        success: function (response) {

            for (let index = 0; index < response.length; index++)
           {    
                let sign='';
                if(response[index].discount_type == 1)
                {
                    sign = "$";
                }else{
                    sign = "%";
                }
                let resultedValue = parseFloat(response[index].price).toFixed(2) - parseFloat(response[index].discount).toFixed(2);
                let tr = '<tr><td>'+response[index].feature_name+'</td><td>$'+parseFloat(response[index].price).toFixed(2)+'</td><td>$'+ parseFloat(resultedValue).toFixed(2) +'</td><tr>';                    
                $('#featuresTblBody'+id).append(tr);

           }
        }


    });

}




