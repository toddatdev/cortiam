<style>
    .get-started {
        /*position: absolute;*/
        /*bottom: 0;*/
        /*left: 0;*/
        /*right: 0;*/
        /*bottom: 13px;*/
        /*width: 90%;*/
    }

    body {
        margin-top: 93px;
    }


    .scrollBarCss::-webkit-scrollbar-track
    {
        background-color: #F5F5F5;
    }

    .scrollBarCss::-webkit-scrollbar
    {
        width: 4px;
        background-color: #F5F5F5;
    }

    .scrollBarCss::-webkit-scrollbar-thumb
    {
        background-color: #00c48d;
    }


    /*.scrollBarCss::-webkit-scrollbar*/
    /*{*/
    /*    background-color: #F5F5F5 !important;*/
    /*}*/

    /*.scrollBarCss::-webkit-scrollbar*/
    /*{*/
    /*    border-radius: 20px;*/
    /*    width: 4px;*/
    /*    background-color: #00c48d;*/
    /*}*/


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

        min-height: 611px !important;
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
            <h3 class="card-title"><span class="icon-co-big orange coupon"></span> Membership Plans </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2">
                    <div class="form-group">
                        <h5 class="col-sm-12">Select a Plan</h5>
                        <input type="hidden" id="planExpiry" name="planExpiry" value="<?= $planExpiry ?>"/>

                        <div>
<?php
if(isset($free_days) && $free_days == 1 && $account['membership_due'] == NULL)
{
    ?>
    <div class="alert alert-success">
        Welcome to Cortiam! To begin your free trial, select any package of your choosing. No Credit Card or Payment will be required.
    </div>
    <?php
}
                               else if(isset($free_days) && $free_days == 1)
                                {
?>
                                    <div class="alert alert-success">
                                        Free
                                        Trial Period
                                        between <?php echo date('m/d/Y h:i A', $account['free_starts']); ?>
                                        and <?php echo date('m/d/Y h:i A', $account['free_ends']); ?>.
                                    </div>
<?php
                                }

?>
                        </div>
                        <div class="row">
                            <?php
                            if (isset($plans) && $plans !== '') {
                                foreach ($plans as $key => $plan) {
                                    ?>
                                    <div class="col-sm-4">
                                        <div class="card  border-0 rounded-0 shadow mb-4">
                                            <div class="card-header bg-green text-center text-white border-0 py-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h3 class="mb-0 font-weight-bold text-capitalize text-left">
                                                        <strong>
                                                            <?php
                                                            if (strlen($plan['title']) > 15) {
                                                                echo substr($plan['title'], 0, 15) . "...";

                                                            } else {

                                                                echo substr($plan['title'], 0, 15);
                                                            }
                                                            ?>
                                                        </strong>

                                                    </h3>
                                                    <?php
                                                    $discountedPlanPrice = getFeaturesDiscountedPrice($plan['id']);
                                                    $planPrice = getPlanPrice($plan['id']);
                                                    ?>
                                                            <div class="d-flex py-4">
                                                            <?php
                                                            if ($discountedPlanPrice > 0)
                                                            {
                                                            ?>
                                                                <h1 class="text-center font-weight-bold text-white mb-0"
                                                                    style="font-size: 23px">
                                                                    $<?= getFeaturesDiscountedPrice($plan['id']) ?></h1>

                                                                <?php
                                                                } else {
                                                                    ?>
                                                                    <h1 class="text-center font-weight-bold text-white mb-0"
                                                                        style="font-size: 23px">
                                                                        $<?= getFeaturesDiscountedPrice($plan['id']) ?></h1>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <p>
                                                                    <del><sup>$<?= getPlanPrice($plan['id']) ?></sup></del>/ <?= $plan['payment'] ?>
                                                                </p>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="card-body bg-white scrollBarCss mt-1" style="max-height: 400px !important; height: 400px !important; overflow-y: scroll">
                                                <h5 class="text-capitalize text-center">
                                                    <?php
                                                    if (strlen($plan['details']) > 60) {
                                                        echo substr($plan['details'], 0, 60) . "...";

                                                    } else {

                                                        echo substr($plan['details'], 0, 60);
                                                    }
                                                    ?>
                                                </h5>
                                                <?php
                                                $features = getFeatures($plan['id']);
                                                if (isset($features) && $features !== '')
                                                {
                                                if (count($features) > 8)
                                                {
                                                ?>
                                                <ul class="list-group list-group-flush">
                                                    <?php
                                                    }else{
                                                    ?>

                                                    <ul class="list-group list-group-flush">
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $priceDicountPrice = 0;
                                                        $titleArray = array();
                                                        $totalDsicount = 0;
                                                        $featureIdsArray = array();
                                                        $subPrice = 0;

                                                        foreach ($features as $key => $feature) {
                                                            array_push($featureIdsArray, $feature['id']);
                                                            ?>
                                                            <li class="list-group-item px-2">
                                                                <?php

                                                                array_push($titleArray, $feature['slug_key']);

                                                                if (isset($feature['discount_type']) && $feature['discount_type'] == 1) {
                                                                    if ($feature['discount_value'] > 0 && $feature['price'] > 0) {
                                                                        $totalDsicount += $feature['discount_value'];
                                                                        $priceDicountPrice += $feature['price'] - $feature['discount_value'];
                                                                        $discount_price = $feature['price'] - $feature['discount_value'];

                                                                    }
                                                                } else {
                                                                    if ($feature['discount_value'] > 0 && $feature['price'] > 0) {
                                                                        $totalDsicount += ($feature['price'] / 100) * $feature['discount_value'];
                                                                        $priceDicountPrice += ($feature['price'] / 100) * $feature['discount_value'];
                                                                        $discount_price = ($feature['price'] / 100) * $feature['discount_value'];
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="col-sm-12 px-0">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-capitalize px-0">
                                                                            <strong><?= $feature['title'] ?></strong>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php

                                                        }

                                                        $listofFeatures = implode(",", $titleArray);
                                                        $listofFeaturesId = implode(",", $featureIdsArray);

                                                        ?>
                                                    </ul>
                                                </ul>
                                            </div>

                                            <!-- <p class="small text-center font-weight-bolder text-secondary">per month</p> -->

                                            <div class="p-2">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-primary text-white get-started w-100 payment_button"
                                                   id="payment_button"
                                                   data-pice="<?= $plan['price'] ?>" data-id="<?= $plan['id'] ?>"
                                                   data-title="<?= $plan['title'] ?>"
                                                   data-paymentfrequency="<?= $plan['payment'] ?>"
                                                   data-total-price="<?= $planPrice ?>"
                                                   list-of-features="<?= $listofFeatures ?>"
                                                   free-days="<?= $free_days ?>"
                                                   totalDsicount= <?= $discountedPlanPrice - userdiscount(); ?> featuresArray="<?= $listofFeaturesId ?>"
                                                   user-discount="<?= userdiscount(); ?>">Get Started</a>
                                            </div>


                                            <?php } ?>
                                        </div>

                                    </div>

                                    <?php
                                }

                            }
                            ?>

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
                        <h1 class="font-weight-bold text-warning text-center mb-3">Membership Plans</h1>
                        <div class="panel panel-default credit-card-box">
                            <div class="panel-heading display-table">
                                <div class="row display-tr">
                                    <h3 class="panel-title display-td">Payment Details</h3>
                                    <div class="display-td">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"></path>
                                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="alert alert-success" role="alert" id="payment-notification"
                                     style="display:none;">
                                    This is a success alert—check it out!
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="justify-content-center text-left mt-2">
                                        <p class="font-weight-bold d-flex justify-content-between mb-0">Membership Plan:<label
                                                    id="getPlanTitle"></label></p>
                                        <p class="font-weight-bold d-flex justify-content-between mb-0">Payment Frequency:<label
                                                    id="getPaymentFrequency"></label></p>
                                        <p class="font-weight-bold d-flex justify-content-between mb-0">Sub-total:<label
                                                    id="getSubToal"></label></p>
                                        <p class="font-weight-bold d-flex justify-content-between mb-0">Discount:<label
                                                    id="getDiscount"></label></p>
                                        <p class="font-weight-bold d-flex justify-content-between mb-0">Coupon Discount:<label
                                                    id="getCouponDiscount">$0</label></p>
                                        <p class="font-weight-bold d-flex justify-content-between mb-0">Total:<label
                                                    id="getTotal"></label></p>


                                        <div class="d-flex">
                                            <!-- <input type="text" id="coupon" name="coupon" value="" placeholder="Enter Coupon Number" class="mb-2 w-75"/>
                                            <a href="javascript:void(0);" id="gotnextforpayment" class="btn btn-success px-5 ml-3" data-toggle="modal" data-target="#paymentModal">Apply</a>
                                                                 -->
                                            <div class="input-group mb-3">
                                                <!--                                                <input type="text" class="form-control" id="coupon" name="coupon"-->
                                                <!--                                                       value="" placeholder="Enter Coupon Number">-->


                                                <select id="coupon" name="coupon" class="form-control">
                                                    <?php
                                                    if(isset($coupons) && count($coupons) > 0)
                                                    {
                                                        foreach ($coupons as $coupon)
                                                        {
                                                            ?>
                                                            <option value="<?= $coupon['coupon_code']?>"  data-coupon-type="<?= $coupon['coupon_type']?>" ><?= $coupon['coupon_code'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>


                                                <div class="input-group-append">
                                                    <a href="javascript:void(0);"
                                                       class="input-group-text ml-3 btn btn-secondary px-4"
                                                       id="basic-addon2">Apply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <form method="post" class="require-validation" data-cc-on-file="false"
                                      data-stripe-publishable-key="<?= $this->config->item('stripe_key') ?>"
                                      id="payment-form">
                                    <input type="hidden" id="phone" name="phone" value="<?= $phone ?>"/>
                                    <input type="hidden" id="username" name="username" value="<?= $username ?>"/>

                                    <div id="oldForm">
                                        <div class="form-row row">
                                            <div class="col-lg-12 form-group">
                                                <label class="control-label">Select a card</label>
                                                <select id="selectedCard" name="selectedCard" class="form-control">
                                                    <option value="">Select a card</option>
                                                    <?php


                                                    if (isset($cardsList) && !empty($cardsList)) {
                                                        foreach ($cardsList as $key => $value) {
                                                            ?>
                                                            <option value="<?= (isset($value["last_digit"]) && !empty($value["last_digit"])) ? $value["last_digit"] : "" ?>"><?= $value['brand'] . "  ****" . $value['last_digit'] ?></option>

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
                                        <a href="javascript:void(0);" class="btn btn-primary btn-lg btn-block"
                                           id="set-price" data-title="Standard" plan-price="40.00"
                                           list-features="specialization,premium_spot" totaldsicount="19" plan-id="50"
                                           featuresarray="43,45">$ Pay Now</a>
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
