<style>
    .get-started {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        bottom: 13px;
        width: 90%;
    }

    body {
        margin-top: 93px;
    }

    .card-sides {
        height: 100%;
        border: 1px solid #DAE1E7;
        padding: 27px;
        border-radius: 5px;
        position: relative;

    }

    .card-sides > h2 {
        color: #000;
        font-weight: 600;
        text-align: center;
    }

    .btn-primary-color {
        background-color: #ff7043;
        border-color: #ff7043;
        color: #fff;
    }

    .btn-primary-color:hover {
        background-color: #fff;
        color: #ff7043;
    }

    .minHeight {

        min-height: 311px !important;
    }


    .panel-title {
        display: inline;
        font-weight: bold;
    }

    .display-table {
        display: table;
    }

    .display-tr {
        display: table-row;
    }

    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 100%;
    }

    .hide {

        display: none;
    }

    .has-error, #card-errors {

        color: red;
    }

    .bg-green {
        background-color: #00c48d;
    }

    .btn-primary-css {
        position: absolute;
        left: 0;
        right: 0;
        width: 85%;
        bottom: 18px;
    }

    .modal-open {
        padding-right: 0px !important;
    }


    /**
	* The CSS shown here will not be introduced in the Quickstart guide, but shows
	* how you can use CSS to style your Element's container.
	*/
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    .CardField {

        margin-top: 5px !important;
    }


    .findagent-list {
        background: #ffffff;
        padding: 1rem 0px 5rem 0px;
    }

    .findagent-list .agentcard {
        margin: 10px 0px;
        height: 300px;
        margin-bottom: 20px;
        border: none !important;
    }

    .findagent-list .agentbox {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin: 0px;
    }

    .findagent-list .agentsnoresult {
        display: inline-block;
        width: 100%;
        font-size: 1.2rem;
        font-weight: 600;
        text-align: center;
        margin: 3rem 0px;
        padding: 2rem 1rem;
        border: 2px solid #dedede;
        background: #fefefe;
        border-radius: 1rem;
    }

    .findagent-list .agentbox .agentimage {
        display: inline-block;
        position: relative;
        margin-bottom: 2rem;
    }

    .findagent-list .agentbox .agentimage img {
        margin-top: 10px;
        max-width: 50%;
        border-radius: 65px;
    }

    .findagent-list .agentbox .agenttext {
        /*position:absolute;*/
        /*top:0px;*/
        /*left:0px;*/
        width: 100%;
        height: 100%;
        padding: 2rem;
        font-size: 1rem;
        line-height: 1.2;
        color: #ffffff;
        /*background:rgba(0,0,0,.3);*/
        text-align: left;
        overflow: hidden;
    }

    .findagent-list .agentbox:hover .agenttext {
        /*animation:fadeOut ease 1s;*/
        /*opacity:0;*/
    }

    .findagent-list .agentbox .agenttext .placer {
        /*position:absolute;*/
        /*bottom:1rem;*/
        /*left:1rem;*/
        width: 100%;
    }

    .findagent-list .agentbox h3 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: .5rem;
        color: #002C77;
        font-family: 'Campton', sans-serif;
    }

    .findagent-list .agentbox p {
        font-size: 16px;
        font-weight: 400;
        color: #00c48d;
        font-family: 'Campton', sans-serif;
    }
</style>
<input hidden="text" id="base_url" value="<?= base_url(); ?>"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<form method="POST" class="couponform w-100" data-source="formajaxurl" style="margin-top:-9px;">
    <div class="card" id="couponaddpart">
        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span class="icon-co-big orange coupon"></span> Property Payment </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2">
                    <div class="form-group">
                        <div class="col-md-6 col-xl-6 offset-md-3 offset-xl-3">
                            <div class="card  border-0 rounded-0 shadow-sm minHeight mb-4">
                                <h1 class="text-center font-weight-bold text-white mb-0 py-1"
                                    style="font-size: 23px; background-color: #00c48d;">Property Payment</h1>
                                <div class="card-body bg-white text-center d-flex justify-content-center align-items-center">
                                  <div>
                                      <h2 class="">
                                          Total Payable amount is
                                      </h2>
                                      <h1 class="font-weight-bold">$<?= $price ?></h1>

                                      <!-- <p class="small text-center font-weight-bolder text-secondary">per month</p> -->
                                      <a href="javascript:void(0);"
                                         class="btn btn-block bg-green text-white btn-primary-css mx-auto get-started"
                                         data-toggle="modal" data-target="#myModal">Pay Now </a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</form>

<div id="myModal" role="dialog" aria-modal="true" class="modal fade show shadow-lg border-0">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 700px;margin: 0 auto;">
        <!-- Modal content-->
        <div class="modal-content" style="max-width: 95%;margin:0 auto;">
            <!-- <div class="text-center">
                <h1 class="font-weight-bold text-warning">Membership Plans</h1>
            </div> -->
            <div style="max-width: 100%;" class="modal-body py-3">
                <div class="row strip-row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="font-size:30px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h1 class="font-weight-bold text-warning text-center mb-3">Property payment</h1>
                        <div class="panel panel-default credit-card-box">
                            <div class=" my-4 d-flex justify-content-center align-items-center">
                                <h3>Property price:</h3>
                                <h1 class="font-weight-bold ml-2 setprice">$<?= $price ?></h1>
                            </div>


                            <div class=" my-4 d-flex justify-content-center align-items-center">
                                <h3>Total price:</h3>
                                <h1 class="font-weight-bold ml-2 setTotalprice">$<?= $price ?></h1>
                            </div>


                            <div class="input-group mb-3">
                                <select id="coupon" name="coupon" class="form-control">
                                   <?php


                                    if (isset($agent_coupon_info) && !empty($agent_coupon_info)) {
                                        foreach ($agent_coupon_info as $key => $value) {
                                            ?>
                                            <option value="<?= $value['coupon_amount'] ?>" data-type="<?= $value['coupon_type'] ?>"><?= $value['coupon_code'] ?></option>

                                            <?php
                                        }

                                    }
                                    ?>

                                </select>


                                <div class="input-group-append">
                                    <a href="javascript:void(0);" class="input-group-text ml-3 btn btn-secondary px-4" id="basic-addon2">Apply</a>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="alert alert-success" role="alert" id="payment-notification"
                                     style="display:none;">
                                    This is a success alert—check it out!
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="justify-content-center text-left mt-2">

                                    </div>
                                </div>

                                <hr>
                                <form method="post" class="require-validation" data-cc-on-file="false"
                                      data-stripe-publishable-key="<?= $this->config->item('stripe_key') ?>"
                                      id="payment-form">
                                    <div id="oldForm">


                                        <div class="form-row row">
                                            <div class="col-lg-12 form-group">
                                                <label class="control-label">Select a card</label>
<!--                                                --><?php
//
//                                                print_r($agent_payment_id);
//                                                exit();
//
//                                                ?>

                                                <select id="selectedCard" name="selectedCard" class="form-control">
                                                    <option value="">Add New Card</option>
                                                    <?php


                                                    if (isset($cardsList) && !empty($cardsList)) {
                                                        foreach ($cardsList as $key => $value) {
                                                            ?>
                                                            <option
                                                                    value="<?= (isset($value["card"]) && !empty($value["card"])) ? $value["card"] :
                                                                        $value['intent'] ?>"
                                                                <?php

                                                                if($value['payment_id'] === $agent_payment_id){ echo 'selected'; }

                                                                ?>
                                                            >
                                                                <?= $value['brand'] . "  ****" . $value['last_digit'] ?>


                                                            </option>

                                                            <?php
                                                        }

                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="newForm">
                                        <div class="form-row row">
                                            <div class="col-lg-12 form-group required">
                                                <label class="control-label">Name on Card</label>
                                                <input type="text" id="cardholder-name" name="cardholder-name"
                                                       class="form-control" placeholder="Jane Doe" required/>
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="col-lg-12 form-group required">
                                                <label class="control-label">Phone number</label>
                                                <input autocomplete="off" type="text" id="cardholder-phone"
                                                       name="cardholder-phone" class="form-control card-number"
                                                       placeholder="123-789-02354" maxlength="20" type="text" required>
                                            </div>
                                        </div>

                                        <div id="card-element">
                                        </div>

                                        <div id="card-errors" role="alert"></div>

                                        <div class="form-row row">
                                            <div class="col-md-12 error form-group hide">
                                                <div class="alert-danger alert">Please correct the errors and try
                                                    again.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>


                                <div class="row my-3">
                                    <div class="col-sm-12">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-lg btn-block" data-agrid="<?= $agreements['agr_id'] ?>" data-propId="<?= $agreements['prop_id'] ?>" data-agentId="<?= $agreements['agent_id'] ?>"   data-sellerId="<?= $agreements['seller_id'] ?>" data-orderId="<?= $order_id ?>"
                                           id="set-price">Pay Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

</div>
