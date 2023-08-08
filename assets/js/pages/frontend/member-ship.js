$(document).ready(function () {
    $('.resend-email').click(function () {
        let url = $(this).attr('data-url');
        $.ajax({
            url: url, success: function (result) {
                if (result) {
                    swal.fire({
                        title: "Resend Email",
                        text: "Email sent successfully!",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });
                } else {
                    swal.fire({
                        title: "Resend Email",
                        text: "Email not exist",
                        type: "error",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            }
        });

    });
});

$(document).ready(function () {


    $("#btnSubmitReviewForm").click(function (e) {

        let status = $('#status').val();
        if(status == null)
        {

        $('.spnErrorRating').text('');
        
        isValidComment = $('#comment').val();


     

    
            $('.mb-1').each(function(i, obj) {
                 
                if($(this).find('div').hasClass('click'))
                {

                }else{
                    e.preventDefault();
                    $(this).find('span').text('Star rating is required');
                }
            });

       


        // if (isValidRating == false){
        //     e.preventDefault();
        //     $("#spnErrorRating").text('Star rating is required');
        // } 

        if (isValidComment == '') {
            e.preventDefault();
            $("#spnErrorComment").text('Comment is required');

        } else {
            let words = 0;

            words = isValidComment.match(/\S+/g).length;


            if (words > 300){

                e.preventDefault();
                $("#spnErrorComment").text('Comment characters length should be less than 300');
                return false;     
    
            }

            
            $("#spnErrorComment").text('');

            }
        }

    });

});