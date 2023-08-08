<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="utf-8"/>
    <title><?php echo $header_data['meta_title']; ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('/favicon.png'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if ($header_data['auto_refresh']) { ?>
        <meta http-equiv="refresh" content="<?php echo $header_data['auto_refresh']; ?>"><?php } ?>

    <!--begin::Global Theme Styles(used by all pages) -->
    <?php if (isset($header_data['css_files'])) {
        echo "\n\t<link rel=\"stylesheet\" href=\"" . implode("\" />\n\t<link rel=\"stylesheet\" href=\"", $header_data['css_files']) . "\" />\n";
    } ?>
    <?php if (isset($header_data['js_files'])) {
        echo "\n\t<script src=\"" . implode("\"></script>\n\t<script src=\"", $header_data['js_files']) . "\"></script>\n";
    } ?>
    <!--end::Global Theme Styles -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178011517-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-178011517-1');
    </script> -->
</head>
<header>
    <body style="padding-right:0px !important;">
    <div class="navigation">
        <div class="container">
            <div class="row align-items-center">
                <div class=" col-2 col-md-3 custom-flex">
                    <a href="<?php echo base_url('agent'); ?>" class="float-left">
                        <img src="<?php echo base_url('images/cortiam_logo_1.svg'); ?>"
                             class="cortiam-logo d-none d-md-block" alt="Cortiam">
                        <img src="<?php echo base_url('images/cortiam_responsive_logo.png'); ?>"
                             class="cortiam-logo d-block d-md-none" alt="Cortiam">
                    </a>
                </div>
                <div class="col-10 col-md-9 white-bg text-right custom-flex align-items-center">
                    <div class="dropdown d-inline">
                        <a href="<?php echo base_url('agent/tutorials'); ?>" class="icon-co-sm hat mr-3"
                           data-display="tooltip" data-placement="left" title="Click to view tutorials"></a>
                        <a href="<?php echo base_url('agent'); ?>" class="icon-co-sm envelope mr-3"
                           data-display="tooltip" data-placement="left" title="Your Messages" role="button"
                           id="latestmsg" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><?php echo(($count_pms = count($pms)) ? '<span class="badge orange-bg bubble animated flash">' . $count_pms . '</span>' : ''); ?></a>
                        <div class="dropdown-menu links dropdown-menu-right" aria-labelledby="latestmsg">
                            <?php

                            if ($pms) {


                                foreach ($pms as $pm) {
//                                    if ($pm['msg_type'] == 'message') {

                                        $pms_message++;

                                        if($pm['msg_from'] == 'Buyer')
                                        {
                                            $customer =  getCustomerName($pm['buyer_id'], 'Buyer');
                                            $id = $pm['buyer_id'];
                                        }elseif($pm['msg_from'] == 'Seller'){
                                            $customer = getCustomerName($pm['seller_id'], 'Seller');
                                            $id = $pm['seller_id'];
                                        }

                                        if (!isset($customer['first_name']) || (isset($customer['first_name']) && $customer['first_name'] == '')) {
                                            echo '<div class="dropdown-item"><a href="' . cortiam_base_url('view-messages/') .$pm["msg_from"]. '/'. $id.'"><span class="icon-co-sm message"></span> Message from Administrator</a></div>';
                                        } else {
                                            echo '<div class="dropdown-item"><a href="' . cortiam_base_url('view-messages/') . ($pm["msg_from"] == "Buyer" ? "buyer" : "seller").'/'.$id.'"><span class="icon-co-sm message"></span> Message from ' . $customer['first_name'] . ' ' . $customer['last_name'] . '</a></div>';
                                        }

//                                    } else {
//                                        $pms_supports++;
//                                        echo '<div class="dropdown-item"><a href="' . cortiam_base_url('support-center') . '"><span class="icon-co-sm support"></span> Support message from ' . $pm['first_name'] . ' ' . $pm['last_name'] . '</a></div>';
//                                    }
                                }
                            } else {
                                echo '<div class="dropdown-item text-center"><div class="p-2"><span class="icon-co-sm message"></span> No new messages</div></div>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="dropdown d-inline">
                        <a href="<?php echo base_url('agent'); ?>#" class="icon-co-sm bell mr-3" role="button"
                           id="latestnotify" data-display="tooltip" data-placement="left" title="Your Notifications"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><?php echo(($count_usno = (count($usnos) + count($usnots))) ? '<span class="badge orange-bg bubble animated flash">' . $count_usno . '</span>' : ''); ?></a>
                        <div class="dropdown-menu links dropdown-menu-right" aria-labelledby="latestnotify">
                            <?php
                            if ($usnos) {
                                foreach ($usnos as $usno) {
                                    echo '<div class="dropdown-item add-border"><a href="' . cortiam_base_url('proposals') . '"><span class="icon-co-sm proposal"></span> New proposal from ' . $usno['first_name'] . ' ' . $usno['last_name'] . '</a></div>';
                                }
                                if ($usnots) {
                                    foreach ($usnots as $usnot) {
                                        switch ($usnot['action']) {
                                            case 'account_declined':
                                                $usnotlink = cortiam_base_url('approval-process');
                                                break;
                                            default:
                                                $usnotlink = cortiam_base_url('notifications');
                                                break;
                                        }
                                        echo '<div class="dropdown-item add-border"><a href="' . $usnotlink . '"><span class="icon-co-sm bell"></span>' . $usnot['title'] . '</a></div>';
                                    }
                                }
                            } elseif ($usnots) {
                                foreach ($usnots as $usnot) {
                                    echo '<div class="dropdown-item add-border"><a href="' . cortiam_base_url('notifications') . '"><span class="icon-co-sm bell"></span>' . $usnot['title'] . '</a></div>';
                                }
                            } else {
                                echo '<div class="dropdown-item text-center empty"><span class="icon-co-sm bell"></span> No new notifications</div>';
                            }
                            ?>
                            <div class="dropdown-item text-center add-border">
                                <a href="<?php echo base_url('agent/notifications');?>">View All Notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown d-inline">
                        <img class="img-fluid rounded-circle user-avatar"
                             src="<?php echo(($account['avatar_string']) ? base_url($account['avatar_string']) : base_url('assets/images/backend/userphoto.jpg')); ?>"
                             width="46" height="46" role="button" id="useravatarsmall" data-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="useravatarsmall">
                            <div class="dropdown-item avatar-item"><img class="img-fluid"
                                                                        src="<?php echo(($account['avatar_string']) ? base_url($account['avatar_string']) : base_url('assets/images/backend/userphoto.jpg')); ?>"
                                                                        width="200" height="200" id="useravatarbig">
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <div class="dropdown-item"><a href="javacript:void(0);"
                                                          class="button-orange btn-file w-100 text-center"
                                                          data-toggle="tooltip" data-placement="left"
                                                          title="Click to change">Change Photo<input type="file"
                                                                                                     class="file-input property_img_upload"
                                                                                                     id="avatarupload"
                                                                                                     accept="image/*;capture=camera"></a>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <div class="dropdown-item"><a class="button-dark w-100 text-center"
                                                          href="<?php echo base_url('logout'); ?>">Logout</a></div>
                        </div>
                        <a href="#" id="res_menu_icon"><span class="icon-co-big orange menu"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main role="main" class="fill">
    <div class="content fill" style="background-color: #f5f5f5">
        <div class="container fill">
            <div class="row">
                <div class="col-12 col-lg-9 offset-lg-3 ">
                    <div class="bg-transparent pt-3">
                        <?php if ($account['approval'] == 'Waiting') { ?>
                            <div class="approvalmessage"> Your account is currently pending approval by the Cortiam
                                administrators. Please check your profile details to ensure that your information
                                correct and complete to speed up your approval process.
                            </div>

                        <?php } ?>
                        <?php if ($account['licenses']['no_license']) { ?>
                            <div class="approvalmessage">Please add your real estate agent license information before
                                you continue using our system. After you update your license information, the details
                                will need to be approved by the Cortiam administrators and your account will be enabled
                                shortly after.
                            </div>
                        <?php } ?>
                        <?php if ($account['licenses']['expired_license']) { ?>
                            <div class="approvalmessage">Your real estate
                                agent <?php echo (count($account['licenses']['expired_states']) > 1) ? 'licenses' : 'license'; ?>
                                for <?php echo implode(", ", $account['licenses']['expired_states']) ?> have expired. Please update your license
                                information with your new license details before you continue using our system. After you update your license information,
                                the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.                                                                                    .
                            </div>
                        <?php } ?>
                        <?php if ($account['licenses']['declined_license']) { ?>
                            <div class="approvalmessage">Your real estate
                                agent <?php echo (count($account['licenses']['declined']) > 1) ? 'licenses' : 'license'; ?>
                                for <?php echo implode(", ", $account['licenses']['declined_states']) ?> have declined.
                                Please update your license information with your new license details before you continue using our system. After you update your license information,
                                the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.
                            </div>
                        <?php } ?>
                        <?php if ($account['approval'] == 'Denied') { ?>
                            <?php if ($account['licenses']['no_license'] || $account['licenses']['no_active_license']) { ?>
                                <div class="approvalmessage"> Your account is locked because
                                    your <?php echo (count($account['licenses']['expired_states']) > 1) ? 'licenses' : 'license'; ?>
                                   have expired. Please update your license information with your new license details before you continue using our system. After you update your license information,
                                    the details will need to be approved by the Cortiam administrators and your account will be enabled shortly after.
                                </div>
                            <?php } else { ?>
                                <div class="approvalmessage"> Your account application is currently denied by the
                                    Cortiam administrators. Please check your <a
                                            href="<?php echo cortiam_base_url('approval-process'); ?>">approval page</a>
                                    for more details and ensure that your missing/wrong information fixed before apply
                                    again for a new approval process.
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if (($account['approval'] == 'Completed') && (!$account['payment_id'])) { ?>
                            <?php if ($account['free_starts'] && $account['free_ends']) { ?>
                                <?php if ($account['free_ends'] < time()) { ?>
                                    <div class="approvalmessage"> Your free trial period expired. Because your account
                                        doesn't have any active payment method, we cannot extend your membership period.
                                        Please check and update your payment method in <a
                                                href="<?php echo cortiam_base_url('edit-account'); ?>#paymentpart"
                                                class="button-orange">your account</a> details to continue your
                                        membership.
                                    </div>
                                <?php } else { ?>
                                    <?php if ($account['free_ends'] < strtotime('+ 7 days')) { ?>
                                        <div class="approvalmessage"> Your free trial period will expire
                                            on <?php echo date('m/d/Y', $account['free_ends']); ?>. Because your
                                            account doesn't have any active payment method, your membership will be
                                            stopped. If you want to continue your membership, please check and update
                                            your payment method in <a
                                                    href="<?php echo cortiam_base_url('edit-account'); ?>#paymentpart"
                                                    class="button-orange">your account</a> details.
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                        <?php } else if (($account['approval'] == 'Completed') && ($account['membership_due'] < time())) { ?>
                            <div class="approvalmessage">

                                Your account doesn't have any active payment method. Please check and update your payment method in <a
                                        href="<?php echo cortiam_base_url('edit-account'); ?>#paymentpart"
                                        class="button-orange">your account</a> details
                                to <?php echo((is_null($account['membership_due'])) ? 'start' : 'continue') ?> your
                                membership.
                            </div>
                        <?php } ?>
                        <?php } else { ?>
<!--                                                                Welcome to Cortiam! To begin your free trial, select any package of your choosing. No Credit Card or Payment-->
<!--                                                                will be required.-->

                            <?php
                            if(isset($account['free_ends']) && $account['free_ends'] > time())
                            {
                                $setdate      =  date('m/d/Y', $account['created_on']);
                                $setdate      =  strtotime($setdate. ' + '.$free_days_count.' days');
                                $setDateLimit = date('m/d/Y', $setdate);
                                ?>
                                <div class="approvalmessage">
                                    You are currently under a free trial period through <?php echo date('m/d/Y', $account['created_on']); ?> to <?= $setDateLimit ?>
                                    .  During this period no subscription fee will be charged. Other services on the site may require payment.
                                </div>
                                <?php
                            }
                            ?>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-9 offset-lg-3">
                    <div class="px-3 d-block d-sm-flex justify-content-between align-items-center question-dropdown">
                        <div class="agent-account">
                            <h3 class="font-weight-bold settings" style="color: #002C77"><?= $header_data['page_title'] ?></h3>
                        </div>
                        <div class="d-flex justify-content-start justify-content-sm-end align-items-center">
                            <p class="mt-1" style="color: #00C48D">Email Notification</p>
                            <label class="switchbutton ml-2 mb-1">

                                <input type="checkbox" name="notifications" id="notifications"
                                    <?php
                                    if($account['notifications'] == 'Yes'){ echo 'checked'; }
                                    ?>
                                >
                                <span class="switchslider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row fill">
                <div class="col-md-12 col-lg-3 mt-2" style="min-height:850px" id="membermenu">
                    <input type="hidden" id="nolicenses" name="nolicenses" value="<?= $nolicenses ?>" />
                    <div class="card shadow-sm border-0" style="border-radius: 20px">
                        <nav class="nav flex-column py-3 py-lg-1">
                            <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'dashboard') ? 'active' : ''); ?>"
                               href="<?php echo cortiam_base_url(''); ?>">Agent Dashboard</a>
                            <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'editaccount') ? 'active' : ''); ?>"
                               href="<?php echo cortiam_base_url('edit-account'); ?>">My Account</a>

                            <a class="nav-link pl-4" href="<?php echo base_url('agent/matchmaking'); ?>#">Match Making</a>
                            <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'myplan') ? 'active' : ''); ?>"
                               href="<?php echo cortiam_base_url('my-plan'); ?>">Memberships and Payment</a>

                            <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'premium') ? 'active' : ''); ?>"

                               href="<?php echo cortiam_base_url('premium-account'); ?>">Premium Placement</a>

                            <?php

                            $row = activeFeatures("introduct_on_limit");
                            if (isset($row['id']) && !empty($row['id'])) {
                                ?>
                            <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'proposals') ? 'active' : ''); ?>"
                               href="<?php echo cortiam_base_url('proposals'); ?>">
                                Introductions<?php echo(($count_usno = count($usnos)) ? '<span class="badge orange-bg bubble lmenu animated flash">' . $count_usno . '</span>' : ''); ?>
                                </a><?php

                            }
                            ?>

                            <?php

                            $row = activeFeatures("limit_of_wins");
                            if (isset($row['id']) && !empty($row['id'])) {
                                ?>
                                <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'agreements') ? 'active' : ''); ?>"
                                   href="<?php echo cortiam_base_url('agreements'); ?>">Properties
                                    Won<?php echo(($uswapp) ? '<span class="badge orange-bg bubble lmenu animated flash" style="padding: 0;line-height: 25px;width: 25px;height: 24px;top: -2px !important;">' . count($uswapp) . '</span>' : ''); ?>
                                </a>
                                <?php
                            }
                            ?>
                            <?php

                            $row = activeFeatures("chat");
                            if (isset($row['id']) && !empty($row['id'])) {
                                ?>
                                <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'messagecenter') ? 'active' : ''); ?>"
                                   href="<?php echo cortiam_base_url('message-center-all'); ?>">Message
                                    Center<?php echo(($pms_message) ? '<span class="badge orange-bg bubble lmenu animated flash" style="padding: 0;line-height: 25px;width: 25px;height: 24px;top: -2px !important;">' . $pms_message . '</span>' : ''); ?>
                                </a>
                                <?php
                            }
                            ?>


                            <?php

                            $row = activeFeatures("agent_intro_videos");
                            if (isset($row['id']) && !empty($row['id'])){
                                ?>

<!--                            <a class="nav-link pl-4 --><?php //echo(($header_data['current_menu'] == 'video') ? 'active' : ''); ?><!--"-->
<!--                               href="--><?php //echo cortiam_base_url('video'); ?><!--">Introduction Video</a>--><?php


                            }
                            ?>

                            <?php
                                $terms = $account['accept_tos'];
                                if(!isset($terms) || $terms == NULL)
                                {
                            ?>
                                    <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'termandconditions') ? 'active' : ''); ?>"
                                        href="javscript:void(0);" id="termandcondition">Terms & Conditions</a>
                            <?php
                                }
                            ?>


                            <a class="nav-link pl-4 <?php echo(($header_data['current_menu'] == 'support') ? 'active' : ''); ?>"
                               href="<?php echo cortiam_base_url('support-center'); ?>">Contact
                                Support<?php echo(($pms_supports) ? '<span class="badge orange-bg bubble lmenu animated flash">' . $pms_supports . '</span>' : ''); ?>
                            </a>

                            <a class="nav-link pl-4" href="<?php echo base_url('logout'); ?>#">Logout</a>
                        </nav>
                    </div>
<?php if (isset($account['plan_id']) && !empty($account['plan_id'])) { ?>

                    <div class="memberbox">
                        <div class="dropdown">
                            <a href="#" role="button" id="questiontab-1" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"><span class="icon-co-big halfsize question"></span></a>
                            <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-1"
                                 id="questiontab-1">
                                <p><b>Remaining Introductions:</b> This number indicates the remaining opportunities you
                                    have to introduce yourself to potential clients. Each agent can have (10) pending
                                    introductions.</p>
                                <p><b>Remaining Wins:</b> This number indicates monthly clients allowed per agent</p>
                            </div>
                        </div>
                 


                            
                            <div class="memberboxrow">
                                <h5 class="mb-0"><?= planTitle($plan_id); ?></h5>
<?php 
                                if ($account['membership_due'] > time())
                                { 
?>                                  <div>Plan Price <?= "$". getPlanPrice($plan_id) ?></div>
                                    <div>Expiration Date
                                        - <?php echo date('m/d/Y', $account['membership_due']); ?></div>
                                <?php } else { ?>
                                    <div>Ends on <?php echo date('m/d/Y', $account['membership_due']); ?></div>
<?php 
                                } 
?>
                                <hr class="my-2">
                            </div>

                        <?php

                        $row = activeFeatures("limit_of_introduction");
                        if (isset($row['id']) && !empty($row['id'])) {
                            ?>

                            <div class="memberboxrow">
                                <h5 class="mb-0">Remaining Introductions</h5>
                                <div><?php echo $account['offer_remain']; ?>
                                    / <?php echo $account['offer_limit']; ?></div>
                                <hr class="my-2">
                            </div>

                            <?php
                        }
                        ?>


                        <?php

                        $row = activeFeatures("limit_of_wins");
                        if (isset($row['id']) && !empty($row['id'])) {
                            ?>
                            <div class="memberboxrow">
                                <h5 class="mb-0">Remaining Wins</h5>
                                <div><?php echo $account['win_remain']; ?> / <?php echo $account['win_limit']; ?></div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <?php } ?>

                </div>


                <div class="col-md-12 col-lg-9 mt-2 maincontent  min-vh-100 posunset">

