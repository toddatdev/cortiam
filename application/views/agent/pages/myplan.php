<style>

    #agentplanstbl_wrapper {

        width: 100% !important;
    }

    .expand {
        height: 1em;
        width: 1em;
        margin-top: -9px;
        display: inline-block;
        color: white;
        border: .15em solid white;
        border-radius: 1em;
        box-shadow: 0 0 .2em #444;
        box-sizing: content-box;
        text-align: center;
        text-indent: 0 !important;
        font-family: "Courier New", Courier, monospace;
        line-height: 1em;
        content: "+";
        background-color: #31b131;

    }

    .notexpand {
        content: "-";
        background-color: #d33333;
        height: 1em;
        width: 1em;
        margin-top: -9px;
        display: inline-block;
        color: white;
        border: .15em solid white;
        border-radius: 1em;
        box-shadow: 0 0 .2em #444;
        box-sizing: content-box;
        text-align: center;
        text-indent: 0 !important;
        font-family: "Courier New", Courier, monospace;
        line-height: 1em;
    }
</style>
<style>
    .card-body-second {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .error {
        color: #f44336;
    }
</style>

<form method="POST" class="couponform w-100" data-source="couponadd">
    <div class="card" id="couponaddpart">
        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span class="icon-co-big orange coupon"></span> Coupons</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <h5 class="col-sm-12">Add New Coupon</h5>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Add Your Coupon Code" value="">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="button-orange mt-1 w-100">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php if(isset($usedCoupons)) {?>
    <div class="card" id="couponlistpart">
        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span classs="icon-co-big orange proplist"></span> Coupon Collection</h3>
        </div>
        <div class="card-body">
            <fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($account['auto_payment']) && $account['auto_payment'] == 'Yes') { ?>
                            <p class="alert alert-warning">Your coupons will be used automatically by their order while processing your payments. Please drag & drop coupons to adjust order of your coupons..</p>
                        <?php } ?>
                        <ul class="profile-list" id="couponlist">
                            <?php foreach ($usedCoupons as $coupon) { ?>
                                <li class="profile-list-item rowmovable" id="coupon-<?php echo $coupon['use_id'];?>">
                                    <div class="row no-gutters">
                                        <div class="col-sm-8">
                                            <p class="titlepart"><strong><?php echo $coupon['coupon_code'];?></strong></p>
                                            <p class="subtitlepart"><?php echo (($coupon['coupon_used'] == 'Yes')? 'Coupon used on '.date('F j, Y', $coupon['used_on']):'Coupon will expire on '.date('F j, Y', $coupon['end_date']));?></p>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php
                                            switch ($coupon['coupon_type']) {
                                                case 'Percentage':
                                                    echo '-'.$coupon['coupon_amount'].'%';
                                                    break;
                                                case 'coupons':
                                                    echo '-'.$coupon['coupon_amount'].' USD';
                                                    break;
                                                default:
                                                    echo '-'.$coupon['coupon_amount'].' USD';
                                                    break;
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-2 align-middle text-right">
                                            <?php
                                            if($coupon['coupon_used'] == 'Yes')
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-secondary">Used</span>
                                                <?php
                                            }elseif($coupon['coupon_used'] == 'No'){
                                                ?>
                                                <span class="badge badge-pill orange-bg">Active</span>
                                                <?php
                                            }else{
                                                ?>
                                                <span class="badge badge-pill badge-secondary">Expired</span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
<?php } ?>

<div class="card">
    <div class="card-header header-elements-inline d-block  d-md-flex justify-content-between">
        <h3 class="card-title"><span class="icon-co-big orange profile"></span> My Plan</h3>
        <div class="mt-2 mt-lg-0">
            <?php

            if (isset($plan_id) && !empty($plan_id)) {
                ?>
                <div>
                    <a href="<?= base_url('agent/unsubscribe-plan/') . $plan_id ?>"
                       class="button-orange unsubscribe mb-2 mb-sm-0 w-165">Unsubscribe Plan </a>
                    <a href="<?= base_url('agent/update-plan/') . $plan_id ?>" class="button-orange w-165">Take a
                        Plan</a>
                </div>
                <?php
            } else {
                ?>
                <a href="<?= base_url('agent/edit-account') ?>" class="button- w-165">Take a Plan</a>
                <?php
            }
            ?>
        </div>

    </div>

    <div class="card-body">

        <?php

        if (isset($featuresInfo) && !empty($featuresInfo)) {
            ?>
            <h3><?= (isset($planInfo['title']) && $planInfo['title'] !== '') ? $planInfo['title'] : '' ?></h3>
            <p class="mb-2"><?= (isset($planInfo['details']) && $planInfo['details'] !== '') ? $planInfo['details'] : '' ?></p>
        <?php } ?>

        <?php

        if (isset($featuresInfo) && !empty($featuresInfo)) {

            ?>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Title</th>
<!--                        <th>Price</th>-->
<!--                        <th>Discounted Price</th>-->

                    </tr>

                    <?php
                    $total = 0;
                    $price = 0;
                    $discountedPrice = 0;
                    foreach ($featuresInfo as $key => $feature) {
                        ?>
                        <tr>
                            <td><?= $feature['feature_name'] ?></td>
<!--                            <td>$--><?//= $feature['price'] ?><!--</td>-->
<!--                            <td>-->
<!--                                --><?php
//
//                                if ($feature['discount_type'] == 1) {
//                                    if ($feature['discount_value'] > 0 && $feature['price'] > 0) {
//                                        echo "$" . $total = $feature['price'] - $feature['discount_value'];
//                                        $discountedPrice += $total;
//                                    }
//
//                                    if ($feature['discount_value'] == 0) {
//                                        echo "$" . $feature['price'];
//
//                                        $discountedPrice += $feature['price'];
//
//                                    }
//
//
//                                } else {
//
//                                    if ($feature['discount_value'] > 0 && $feature['price'] > 0) {
//                                        echo "$" . $total = $feature['price'] - (($feature['price'] / 100) * $feature['discount_value']);
//                                        $discountedPrice += $total;
//                                    }
//
//
//                                    if ($feature['discount_value'] == 0) {
//                                        echo "$" . $feature['price'];
//
//                                        $discountedPrice += $feature['price'];
//
//                                    }
//
//
//                                }
//                                $price += $feature['price'];
//                                ?>
<!--                            </td>-->
                        </tr>

                        <?php
                    }

                    ?>

<!--                    <tr>-->
<!--                        <td></td>-->
<!--                        <td><strong>Sub-total :</strong> $--><?//= $price ?><!--</td>-->
<!--                        <td><strong>Total :</strong> $--><?//= $discountedPrice ?><!--</td>-->
<!--                    </tr>-->

                </table>
            </div>
            <?php
        } else {
            ?>

            <center><h3>You don't have any Plan</h3></center>
            <?php
        }
        ?>

        <hr>


    </div>
</div>


<?php
if (isset($allPlans) && !empty($allPlans)) {
    if (isset($allPlans['id']) && !empty($allPlans['id'])) {
        ?>

        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="card-title"><span class="icon-co-big orange envelope"></span> Plans List</h3>
            </div>
            <div class="card-body">
                <!-- agentplanstbl -->

                <div class="col-sm-12">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover datatable-highlight w-100 dataTable no-footer"
                                   id="agentplanstbl">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plan Name</th>
                                    <th>Sub-total</th>
<!--                                    <th>Discount</th>-->
                                    <th>Total</th>
                                    <th class="text-center">Status</th>

                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>


<div class="card" id="paymentpart">
    <div class="card-header header-elements-inline" >
        <h3 class="card-title"><span class="icon-co-big orange ccard"></span> Credit Cards</h3>
        <div class="header-elements">
            <div class="dropdown d-inline">
                <a href="#" role="button" id="questiontab-1" data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false"><span class="icon-co-big question"></span></a>
                <div class="dropdown-menu dropdown-menu-right larger"
                     aria-labelledby="questiontab-1"
                     id="questiontab-1">
                    <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel
                        blandit velit, ut accumsan
                        orci. Vestibulum sed rutrum mi. Proin sed dolor turpis.
                        Suspendisse sagittis faucibus eros a
                        sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor
                        eu imperdiet.</p>
                </div>
            </div>
            <a class="headerelementlink" id="addcart" data-toggle="tooltip"
               data-placement="bottom"
               title="Add new credit card"><span class="icon-co-big add"></span></a>
        </div>
    </div>
    <div class="card-body-second">
        <fieldset>
            <div class="row">
                <div class="col-md-12">
                    <div id="cardpart">

                    </div>
                </div>
                <div class="col-md-12" id="cardlistingpart">
                    <ul class="profile-list">
                        <?php if ($credit_cards) { ?>
                            <?php foreach ($credit_cards as $credit_card) { ?>
                                <li class="profile-list-item">
                                    <div class="row no-gutters">
                                        <div class="col-sm-9">
                                            <div class="float-left mr-2"><?php echo card_icons(ucfirst($credit_card['brand'])); ?></div>
                                            <p class="titlepart">
                                                <strong><?php echo ucfirst($credit_card['brand']); ?>
                                                    **** <?php echo $credit_card['last_digit']; ?></strong>
                                            </p>
                                            <p class="subtitlepart">Expires
                                                on <?php echo date('M Y', $credit_card['expire_date']); ?></p>
                                        </div>
                                        <div class="col-sm-3 align-middle text-right">
                                            <div class="btn-group dropleft <?php echo(($credit_card['payment_id'] == $account['payment_id']) ? 'invisible' : ''); ?>"
                                                 data-toggle="tooltip"
                                                 data-placement="left"
                                                 title="Click for options">
                                                    <span data-toggle="dropdown" aria-haspopup="true"
                                                          aria-expanded="false" class="cardopenmenu"><i
                                                                class="icon-menu"></i></span>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item"
                                                            type="button"
                                                            id="deletemycard"
                                                            data-id="<?php echo $credit_card['card_id']; ?>">
                                                        Delete
                                                    </button>
                                                    <button class="dropdown-item"
                                                            type="button" id="setmycard"
                                                            data-id="<?php echo $credit_card['card_id']; ?>">
                                                        Set As
                                                        Default
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } else { ?>
                            <li class="list-group-item text-center">Please add your
                                credit card to activate your
                                payment system.
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<?php if ($invoices) { ?>
    <div class="card" id="invoicepart">
        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span class="icon-co-big orange finance"></span> Payments
            </h3>
            <div class="header-elements">
                <div class="dropdown d-inline">
                    <a href="#" role="button" id="questiontab-1" data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false"><span class="icon-co-big question"></span></a>
                    <div class="dropdown-menu dropdown-menu-right larger"
                         aria-labelledby="questiontab-1"
                         id="questiontab-1">
                        <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel
                            blandit velit, ut accumsan
                            orci. Vestibulum sed rutrum mi. Proin sed dolor turpis.
                            Suspendisse sagittis faucibus eros a
                            sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor
                            eu imperdiet.</p>
                    </div>

                </div>
                <!--                                <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->

            </div>
        </div>

        <div class="card-body">
            <fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="profile-list expandable" id="invoicelistingpart">
                            <?php if ($invoices) { ?>
                                <?php foreach ($invoices as $invoice) { ?>
                                    <li class="profile-list-item">
                                        <?php if ($invoice['payment_type'] == 'Free Trial') { ?>
                                            <div class="trialmessage pl-3 text-center"
                                                 data-toggle="collapse"
                                                 href="#invoice-<?php echo $invoice['invoice_id']; ?>"
                                                 role="button"
                                                 aria-expanded="false"
                                                 aria-controls="invoice-<?php echo $invoice['invoice_id']; ?>">
                                                Free
                                                Trial Period
                                                between <?php echo date('m/d/Y', $account['free_starts']); ?>
                                                and <?php echo date('m/d/Y', $account['free_ends']); ?>
                                                .
                                            </div>
                                        <?php } else { ?>
                                            <div class="row pl-3 cursor-pointer collapsed"
                                                 data-toggle="collapse"
                                                 href="#invoice-<?php echo $invoice['invoice_id']; ?>"
                                                 role="button"
                                                 aria-expanded="false"
                                                 aria-controls="invoice-<?php echo $invoice['invoice_id']; ?>">
                                                <div class="col-sm-9 align-middle">
                                                    <p class="titlepart"><?php echo $invoice['payment_desc']; ?></p>
                                                </div>
                                                <div class="col-sm-1 align-middle">
                                                    <p class="mb-0 text-nowrap">
                                                        $<?php echo $invoice['final_amount']; ?></p>
                                                </div>
                                                <div class="col-sm-2 align-middle text-right">
                                                    <?php echo generate_invoice_status_pill($invoice['invoice_status']); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 multi-collapse collapse invoiceexplain"
                                                 id="invoice-<?php echo $invoice['invoice_id']; ?>">
                                                <?php
                                                switch ($invoice['invoice_status']) {
                                                    case 'Completed':
                                                        echo 'Payment completed on ' . date('m/d/Y h:i A', $invoice['payment_time']) . (($invoice['discount_amount']) ? '<br><b>' . $invoice['coupon_code'] . '</b> coupon used for this payment and saved $' . $invoice['discount_amount'] . '. Payment amount dropped from $' . $invoice['real_amount'] . ' to $' . $invoice['final_amount'] . '.' : '');
                                                        break;
                                                    case 'Refund':
                                                        echo 'Payment completed on ' . date('m/d/Y h:i A', $invoice['payment_time']) . ' and refund on ' . date('m/d/Y h:i A', $invoice['refund_date']) . '.';
                                                        break;
                                                    case 'Failed':
                                                        echo 'Payment failed ' . $invoice['try_amount'] . ' times and will be processed again on ' . date('m/d/Y h:i A', $invoice['try_time']);
                                                        break;
                                                    default:
                                                        echo 'Payment due date is ' . date('m/d/Y h:i A', $invoice['try_time']);
                                                        break;
                                                }
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li class="list-group-item text-center">Please add your
                                    credit card to activate your
                                    payment system.
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php if ($account['membership_due']) { ?>
                        <!--				<div class="col-md-12"><div class="approvalmessage mb-1">Next payment period of your membership is on <?php echo date('m/d/Y h:i A', $account['membership_due']); ?><div><div>-->
                    <?php } ?>
                </div>
            </fieldset>
        </div>
    </div>

<?php } ?>
