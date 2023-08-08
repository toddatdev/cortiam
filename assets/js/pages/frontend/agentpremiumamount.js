
var stripe   = Stripe(cortiamajax.stripekey);
var elements = stripe.elements();
var FoundError = false;

var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
card.mount('#card-element');

jQuery(document).ready(function(){
    var transaction = false;

    $('.get-started').click(function(){

        $('#set-price').attr('data-upgrate-plan', '0');

        if($( '#planExpiry' ).val())
        {
            Swal.fire({
                icon: 'info',
                iconColor: '#00c48d',
                title: 'Are you sure to upgrade the plan?',
                showDenyButton: true,
                confirmButtonColor: '#00c48d',
                denyButtonColor: '#aaa',
                confirmButtonText: 'Yes',
                denyButtonText: `Cancel`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed)
                {
                    $('#set-price').attr('data-upgrate-plan', '1');

                    // Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {

                    return false;
                }
            })

        }

        var plan_title      = $(this).attr('data-title');
        var plan_price      =  $('.setprice').text().replace(/\$/g, '');

        $('#set-price').text('$'+plan_price+ ' Pay Now' );


    });


    $('#basic-addon2').click(function(){

        let coupon = $('#coupon').val();
        $('#set-price').attr('data-coupon', coupon);
        $('#coupon').val('');


        let arr = {coupon:coupon};

        if(transaction == false && coupon !== '')
        {
            $.ajax({url: cortiamajax.couponamount,
                type: "post",
                dataType: "text",
                data:{coupon : arr},
                success: function(reponse){
                    if(reponse !== '')
                    {
                        let val = $('#getTotal').text().replace(/\$/g, '');
                        $('#basic-addon2').attr('disabled', true);
                        let res    =  val - reponse;
                        res = parseFloat(res).toFixed(2);

                        if(res <= 0)
                        {
                            swal.fire({
                                title: "Coupon",
                                text: "Unable to apply the coupon as the coupon value exceeds the actual value.",
                                type: "info",
                                confirmButtonClass: "btn btn-success"
                            });

                            $('#coupon').val('');
                            return false;
                        }


                        $('#getCouponDiscount').text("$"+reponse);
                        console.log(reponse);
                        transaction = true;
                        let total = "$" + (res);


                        $('#getTotal').text(total);
                    }else{

                        swal.fire({
                            title: "Coupon",
                            text: "Entered coupon is invalid or expired.",
                            type: "info",
                            confirmButtonClass: "btn btn-success"
                        });

                    }

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }
            });
        }




    });

});



jQuery(document).ready(function(){

    jQuery(document).on('click', '#set-price', function(){
        let selectplanPayment = $('#selectplan').val();

        if($('#selectedCard').val() !== '')
        {
            let checkSeti = $(this).val();
            let result    = checkSeti.includes("seti");
            if(result == true)
            {
                stripePayment();
                return false;
            }


            $('#myModal').modal('hide');
            stripeResponseHandler(null);
            return false;
        }



        if(selectplanPayment == '' || typeof  selectplanPayment == 'undefined')
        {
            $('form.require-validation').submit();

        }else{

            let plan_title    = $('#set-price').attr('data-title');
            let plan_price    = $('#set-price').attr('plan-price');
            let list_features = $('#set-price').attr('list-features');
            let totalDsicount = $('#set-price').attr('totalDsicount');
            let plan_id       = $('#set-price').attr('plan-id');
            let featuresarray = $('#set-price').attr('featuresarray');
            let coupon        = $('#set-price').attr('data-coupon');
            let getUserDiscount = $('#set-price').attr('getUserDiscount');
            let upgratePlan     = $('#set-price').attr('data-upgrate-plan');

            jQuery.ajax({
                type: "post",
                url: cortiamajax.paymentajaxurl,
                data: {upgratePlan: upgratePlan, plan_title : plan_title, plan_price :  plan_price, list_features :  list_features, totalDsicount : totalDsicount, plan_id : plan_id, featuresarray : featuresarray, coupon : coupon, getUserDiscount : getUserDiscount, selectplanPayment : selectplanPayment},
                dataType: "text",
                success: function(response){

                    console.log(response);

                    if(response.trim() == "true" )
                    {

                        $('#payment-notification').css('display', 'block');
                        $('#payment-notification').text(response.success);

                        setTimeout(function () {
                            $('#payment-notification').css('display', 'none');
                            $form[0].reset();


                            swal.fire({
                                title: "Membership Plan",
                                text: "Plan selected successfully!",
                                type: "success",
                                confirmButtonClass: "btn btn-success"
                            });


                        }, 3000);

                        let plan_id = $('#set-price').attr('plan-id');

                        console.log(plan_id);

                        $.ajax({url: cortiamajax.planajaxurl, data:{plan_id : plan_id} , success: function(result){
                                var host  = $('#base_url').val() +"agent/my-plan";

                                // Simulate an HTTP redirect:
                                window.location.replace(host);


//                      location.reload();
                            }});



                    }

                }
            });


        }


    });


    jQuery(document).on('change', '#selectplan', function(){

        if($(this).val() == '')
        {
            $('#payment-form').css('display', 'block');
        }else{

            $('#payment-form').css('display', 'none');
        }
        //$('form.require-validation').submit();

    });



    $('.card-number').on('keypress change', function (e) {


        var charCode = (e.which) ? e.which : event.keyCode

        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;

        $(this).val(function (index, value) {

            return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
        });
    });


    $('form.require-validation').submit(function(e) {
        FoundError = false;


        var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '')
            {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();

                FoundError = true;
            }
        });

        if(FoundError == false)
        {
            $("#myModal").modal('hide');
        }
        stripePayment();

        return false;

    });

});


document.getElementById("card-element").addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

function stripePayment()
{
    jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'42%',left:'0%',background:'transparent',  cursor:'context-menu'},overlayCSS: {backgroundColor:'#fff',opacity:.7}});

    stripe.createToken(card).then(function(result) {

        if (result.error)
        {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {

            console.log(result.token.id);

            jQuery.ajax({
                type: "get",
                url: cortiamajax.createStripCustomre,
                data: {token : result.token.id},
                dataType: "text",
                success: function(response){

                    if(response.trim() !== "" )
                    {
                        let clientSecret = response.trim();
                        stripe.confirmCardSetup(clientSecret, {
                            payment_method: {
                                card: card,
                                billing_details: {
                                    name: $('#cardholder-name').val(),
                                    phone: $('#cardholder-phone').val(),
                                },
                            }
                        }).then(function (result){
                            if (result.error) {
                                CheckCardError(result);
                            } else {

                                stripeResponseHandler(result.setupIntent.payment_method);

                            }

                        })



                    }


                }
            });

        }
    });

}


function stripeResponseHandler(payment_id) {

    jQuery.blockUI({message: '<div class="emptyloader"><img src="' + cortiamajax.loadingimage + '"></div>',css: {border:'0px',width:'100%',top:'42%',left:'0%',background:'transparent',  cursor:'context-menu'},overlayCSS: {backgroundColor:'#fff',opacity:.7}});
    let plan_title    = "Premium Search Query";

    let order_id       = $('#set-price').attr('data-orderid');

    let getPriceString = $('.setprice').text().replace(/\$/g, '');
    let plan_price     = getPriceString;
    let selectedCard   = $('#selectedCard').val();



    jQuery.ajax({
        type: "post",
        url: cortiamajax.paymentajaxurl,
        data: { payment_id: payment_id, plan_title : plan_title, plan_price :  plan_price,  selectedCard : selectedCard, order_id : order_id},
        dataType: "text",
        success: function(response){

            if(response.trim() == "true" )
            {

                $('#payment-notification').css('display', 'block');
                $('#payment-notification').text(response.success);

                setTimeout(function () {
                    $('#payment-notification').css('display', 'none');
                    $form[0].reset();
                    $("#myModal").modal('hide');

                    swal.fire({
                        title: "Premium Search",
                        text: "Now you are in premium search!",
                        type: "success",
                        confirmButtonClass: "btn btn-success"
                    });


                }, 3000);

                var host  = $('#base_url').val() +"agent/premium-account";
                // Simulate an HTTP redirect:
                window.location.replace(host);




            }

        }
    });
}


document.getElementById('cardholder-phone').addEventListener('input', function (e) {
    var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '');
});


if($('#selectedCard').val() !== '')
{
    $('#newForm').css('display','none');
}else{

    $('#newForm').css('display','block');
}

$("#selectedCard").on('change', function() {
    if($('#selectedCard').val() !== '')
    {
        $('#newForm').css('display','none');
    }else{

        $('#newForm').css('display','block');
    }
});
