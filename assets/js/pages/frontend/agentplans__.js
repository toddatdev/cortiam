jQuery(document).ready(function(){


  var transaction = false;

    //let url = $(this).attr('data-url');

    $('.get-started').click(function(){

        var plan_title      = $(this).attr('data-title');
        var plan_price      = $(this).attr('data-total-price');
        var list_features   = $(this).attr('list-of-features');
        var totalDsicount   = $(this).attr('totalDsicount');
        var plan_id         = $(this).attr('data-id');
        var featuresarray   = $(this).attr('featuresarray');
        var getUserDiscount = $(this).attr('user-discount');

        plan_price        = parseFloat(plan_price).toFixed(2);
        totalDsicount     = parseFloat(totalDsicount).toFixed(2);
        getUserDiscount   = parseFloat(getUserDiscount).toFixed(2);
        
        
        $('#getPlanTitle').text(plan_title);
        $('#getSubToal').text("$"+plan_price);
        let getTotal  = parseFloat(plan_price) - parseFloat(totalDsicount);

        getTotal       = parseFloat(getTotal).toFixed(2);
        $('#getDiscount').text("-$"+getTotal);
        $('#getTotal').text(`$${parseFloat(totalDsicount)}`);
        $('#getUserDiscount').text("$"+getUserDiscount);

        $('#set-price').attr('data-title', plan_title);
        $('#set-price').attr('plan-price', plan_price);
        $('#set-price').attr('list-features', list_features);
        $('#set-price').attr('totalDsicount', totalDsicount);
        $('#set-price').attr('plan-id', plan_id);
        $('#set-price').attr('featuresarray', featuresarray);
        $('#set-price').attr('getUserDiscount', getUserDiscount);



        var plan_price = $(this).attr('data-pice');
        $('#set-price').text('$'+plan_price+ ' Pay Now' );

    
    });


    $('#basic-addon2').click(function(){

        let coupon = $('#coupon').val();
        $('#set-price').attr('data-coupon', coupon);   


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

       $(this).attr('disabled', '');

       let selectplanPayment = $('#selectplan').val();



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


    


    jQuery.ajax({
        type: "post",            
        url: cortiamajax.paymentajaxurl,
        data: {plan_title : plan_title, plan_price :  plan_price, list_features :  list_features, totalDsicount : totalDsicount, plan_id : plan_id, featuresarray : featuresarray, coupon : coupon, getUserDiscount : getUserDiscount, selectplanPayment : selectplanPayment},            
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
                        $("#myModal").modal('hide');


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

            e.preventDefault();
      
            var stripe = Stripe('pk_test_XzLQCcuHS0Qc5xPIARiG8aNU');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
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

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });



                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    } else {
                    // Send the token to your server.
                      stripeTokenHandler(result.token);
                    }
                });
  


    });

  });



              // Submit the form with the token ID.
              function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                // var form = document.getElementById('payment-form');
                // var hiddenInput = document.createElement('input');
                // hiddenInput.setAttribute('type', 'text');
                // hiddenInput.setAttribute('name', 'stripeToken');
                // hiddenInput.setAttribute('value', token.id);
                // form.appendChild(hiddenInput);
                alert('Success! Got token: ' + token.id);

                // Submit the form
                // form.submit();
            }
      
  function stripeResponseHandler(status, response) {

        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
  
            let plan_title    = $('#set-price').attr('data-title');
            let plan_price    = $('#set-price').attr('plan-price');
            let list_features = $('#set-price').attr('list-features');
            let totalDsicount = $('#set-price').attr('totalDsicount');
            let plan_id       = $('#set-price').attr('plan-id');
            let featuresarray = $('#set-price').attr('featuresarray');
            let coupon        = $('#set-price').attr('data-coupon');
            let getUserDiscount = $('#set-price').attr('getUserDiscount');


            var stripe = Stripe(cortiamajax.stripekey);

            var elements = stripe.elements();
            var cardElement = elements.create('card', {
                iconStyle: 'solid',
                style: {
                    base: {
                        backgroundColor: '#ffffff',
                        lineHeight: '36px',
                        color: '#000000',
                        padding: 6,
                        fontWeight: 300,
                        fontFamily: 'Open Sans, Segoe UI, sans-serif',
                        fontSize: '16px',
                        fontSmoothing: 'antialiased',
                        ':-webkit-autofill': {
                            color: '#4c525e',
                        },
                        '::placeholder': {
                            color: '#999999',
                        },
                    },
                    invalid: {
                        iconColor: '#da0101',
                        color: '#da0101',
                    }
                },
                classes: {
                    focus: 'is-focused',
                    empty: 'is-empty',
                }
            });
            cardElement.mount('#card-element');
    

    
                    
            stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardholderName.value,
                            phone: cardholderPhone.value,
                        },
                    }
                })

        jQuery.ajax({
            type: "post",            
            url: cortiamajax.paymentajaxurl,
            data: {token : token, plan_title : plan_title, plan_price :  plan_price, list_features :  list_features, totalDsicount : totalDsicount, plan_id : plan_id, featuresarray : featuresarray, coupon : coupon, getUserDiscount : getUserDiscount},            
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
                            $("#myModal").modal('hide');


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
    }
     
