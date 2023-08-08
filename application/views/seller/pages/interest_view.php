<div class="card mb-3" id="couponlistpart">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span
                    class="icon-co-big orange talk"></span> <?php echo(($proposal['prop_from'] == 'Agent') ? $agent_account['first_name'] . ' ' . $agent_account['last_name'] . '\'s' : 'Your'); ?>
            Proposal</h3>
        <?php echo generate_seller_proposal_ribbon($proposal['prop_from'], $proposal['status'], $proposal['first_counter'], 'right', $proposal['main_id']); ?>
        <div class="header-elements">
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 py-3 px-lg-3 px-xl-3 dark-bg profile-header">
                <?php echo(($agent_account['approval'] != 'Completed') ? '<div class="ribbon ribbon-top-left ribbonred"><span>Inactive</span></div>' : ''); ?>
                <img class="img-fluid rounded-circle user-avatar float-left mr-3"
                     src="<?php echo(($agent_account['avatar_string']) ? base_url($agent_account['avatar_string']) : base_url('images/userphoto.jpg')); ?>"
                     width="120" height="120">
                <h3 class="mt-4 mb-0">
                    <strong><?php echo $agent_account['first_name'] . ' ' . $agent_account['last_name']; ?></strong>
                </h3>
                <h6><?php echo $agent_account['brokerage_name']; ?></h6>
                <div class="messagebutton">
                    <?php if (in_array($proposal['status'], array('Unread', 'Read')) && $proposal['prop_from'] == 'Agent') { ?>
                        <button class="button-border-orange smallerbutton acceptproposal">ACCEPT</button>
                        <button class="button-border-gray smallerbutton declineproposal">DECLINE</button>
                        <button class="button-border-white smallerbutton counterofferproposal">COUNTER OFFER</button>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-12 mt-3 px-lg-3 px-xl-3">
                <h5 class="mb-0"><strong>Biography</strong></h5>
                <?php echo nl2br($agent_account['bio']); ?>
            </div>

            <!--	  			--><?php //if($agent_account['estate_specialization']) {?>
            <!--		  		<div class="col-md-12 mt-3 px-lg-3 px-xl-3">-->
            <!--		  			<h5 class="mb-0"><strong>Real Estate Specialization</strong></h5>-->
            <!--		  			--><?php //echo nl2br($agent_account['estate_specialization']);?>
            <!--		  		</div>-->
            <!--					--><?php //} ?>

            <?php if (isset($agent_specializations) && !empty($agent_specializations)) { ?>

                <div class="col-md-12 mt-3 px-lg-3 px-xl-3">
                    <h5 class="mb-0"><strong>Specialization</strong></h5>

                    <?php
                    foreach ($agent_specializations as $special) {
                        ?>
                        <span class="badge badge-secondary"><?= $special['name'] ?></span>
                        <?php
                    }
                    ?>
                </div>


            <?php } ?>



            <?php if ($agent_licenses) { ?>
                <div class="col-md-7 mt-3 px-lg-3 px-xl-3">
                    <h5 class="mb-0"><strong>Real Estate Focus</strong></h5>
                    <?php foreach ($agent_licenses as $agent_license) { ?>
                        <?php echo(($agent_license['interested'] == 'Both') ? 'Residential & Commercial' : $agent_license['interested']); ?> Properties in <?php echo $agent_license['license_state']; ?>
                        <br>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="col-md-7 mt-3 px-lg-3 px-xl-3"></div>
            <?php } ?>
            <div class="col-md-5 mt-3 px-lg-3 px-xl-3">
                <h5 class="mb-0"><strong>Years Experience</strong></h5>
                <?php echo(date("Y") - $agent_account['experience']); ?>
            </div>
            <div class="col-md-12 mt-3 px-lg-3 px-xl-3">
                <h5 class="mb-0"><strong>Brokerage Address</strong></h5>
                <?php echo $agent_account['brokerage_address'] . ' ' . $agent_account['brokerage_unit'] . ', ' . $agent_account['brokerage_city'] . ', ' . $agent_account['brokerage_state'] . ' ' . $agent_account['brokerage_zipcode']; ?>
            </div>
            <div class="col-md-7 mt-3 px-lg-3 px-xl-3">
                <h5 class="mb-0"><strong>Brokerage Phone Number</strong></h5>
                <a href="tel:<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent_account['brokerage_phone']); ?>"
                   class="text-dark"><?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent_account['brokerage_phone']); ?></a>
            </div>
            <div class="col-md-5 mt-3 px-lg-3 px-xl-3">
                <h5 class="mb-0"><strong>Email</strong></h5>
                <a href="mailto:<?php echo $agent_account['email']; ?>"
                   class="text-dark"><?php echo $agent_account['email']; ?></a>
            </div>
            <div class="col-md-7 mt-3 px-lg-3 px-xl-3">
                <?php if ($agent_account['youtube_video']) { ?>
                    <?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $agent_account['youtube_video'], $match); ?>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/<?php echo $match[1]; ?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-5 mt-3 px-lg-3 px-xl-3">
                <?php if ($agent_account['facebook']) { ?>
                    <div class="my-2"><a href="<?php echo $agent_account['facebook']; ?>" target="_blank"
                                         class="text-gray"><span
                                class="icon-co-sm orange facebook"></span> <?php echo $agent_account['facebook']; ?></a>
                    </div><?php } ?>
                <?php if ($agent_account['linkedin']) { ?>
                    <div class="my-2"><a href="<?php echo $agent_account['linkedin']; ?>" target="_blank"
                                         class="text-gray"><span
                                class="icon-co-sm orange linkedin"></span> <?php echo $agent_account['linkedin']; ?></a>
                    </div><?php } ?>
                <?php if ($agent_account['twitter']) { ?>
                    <div class="my-2"><a href="<?php echo $agent_account['twitter']; ?>" target="_blank"
                                         class="text-gray"><span
                                class="icon-co-sm orange twitter"></span> <?php echo $agent_account['twitter']; ?></a>
                    </div><?php } ?>
                <?php if ($agent_account['google']) { ?>
                    <div class="my-2"><a href="<?php echo $agent_account['google']; ?>" target="_blank"
                                         class="text-gray"><span
                                class="icon-co-sm orange google"></span> <?php echo $agent_account['google']; ?></a>
                    </div><?php } ?>
                <?php if ($agent_account['instagram']) { ?>
                    <div class="my-2"><a href="<?php echo $agent_account['instagram']; ?>" target="_blank"
                                         class="text-gray"><span
                                class="icon-co-sm orange instagram"></span> <?php echo $agent_account['instagram']; ?>
                    </a></div><?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($days) && !empty($days)){
?>
<form method="POST" class="bookslotajaxform w-100" data-source="formajaxurl" autocomplete="off" id="bookslotajaxform">

    <input type="hidden" id="getDays" name="getDays" value="<?= implode(",", $days) ?>" />
    <input type="hidden" id="setDays" name="setDays" value="<?= implode(",", $days) ?>" />
    <input type="hidden" id="monthArray" name="monthArray" value="<?= implode(",", $monthArray) ?>" />
    <input type="hidden" id="yearArray" name="yearArray" value="<?= implode(',', $yearArray) ?>" />

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><span class="icon-co-big orange profile"></span>Agent Interview Request</h3>
        <br>
        <div><p> Click on Appointment Date to see available dates and times to meet over the phone or virtually with this agent. Available dates are bolded </p></div>
    </div>
    <div class="card-body">

        <fieldset>
            <div class="row mt-3">
                <div class="col-md-4">
                    <h5 class="mb-1"><strong>Select Date:</strong></h5>
                    <div class="form-group">

                        <?php  include_once('agentdate.php')?>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-1"><strong>Select Time Slot:</strong></h5>
                    <div class="form-group">
                        <select class="form-control available-slots" id="available-slots" name="available-slots" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-1"><strong>Select Type:</strong></h5>
                    <div class="form-group">
                        <select class="form-control available-slots" id="meet-type" name="meet-type" required>
                            <option value="video">Video Conference</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>
                </div>
            </div>

        </fieldset>

    </div>
    <div class="card-footer text-right">
        <button type="submit" class="button-orange">Book appointment</button>
    </div>
</div>

</form>
    <?php
}
?>

<div class="card bg-transparent shadow-none">
    <h6 class="font-weight-bold text-title-blue">Proposal Timelines</h6>
    <div class="card-body pl-4">
        <div class="row border-left">
            <div class="col-12 px-0 ">
                <!--  Start Odd card row-->
            <?php
            if ($property) {
            ?>
                <div class="row mb-3">
                    <div class="col-2 col-md-1 position-relative">
                        <div class="">
                            <img class="seller-view-img position-absolute" src="<?php echo  base_url('/assets/images/frontend/seller/even.svg'); ?>" alt="">
                        </div>
                    </div>
                    <div class="col-10 col-md-11 px-0 bg-white rounded-10">
                        <div class="card  shadow-none my-0 mx-0">
                            <a class="" data-toggle="collapse" href="#agentOfferedYou" role="button"
                               aria-expanded="false" aria-controls="agentOfferedYou">
                                <div class="card-header d-flex justify-content-between text-dark">
                                    <h6 class="font-weight-bold mb-0">You offered</h6>
                                    <div class="d-flex">
                                        <div class="">
                                            <img class="" width="16" src="<?php echo  base_url('/assets/images/frontend/seller/g-calendar.svg'); ?>" alt="">
                                            <?= date('m/d/Y', $proposal['prop_date']);?></div>
                                        <div class="ml-3">
                                            <img class="" width="16" src="<?php echo  base_url('/assets/images/frontend/seller/g-clock.svg'); ?>" alt="">
                                            <?= date('h:i A', $proposal['prop_date']);?></div>
                                    </div>
                                </div>
                            </a>

                            <div class="card-body collapse show " id="agentOfferedYou">
                                <div class="row">
                                    <div class="col-12 col-md-5 mb-2 mb-md-0">
                                        <div class="p-2 border rounded-10 card-blue">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/percent.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0" style="color: #626262 !important;">Commission  Rate</p>
                                                    <h6 class="font-weight-bold mb-0"><?php echo $property['commission_rate']; ?>%</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="p-2 border rounded-10 card-light-blue">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/files.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0" style="color: #626262 !important;">Length of contract</p>
                                                    <h6 class="font-weight-bold mb-0"><?php echo $proposal['contract_length']; ?> Months</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            if (isset($related_proposals)){ ?>
                <?php foreach ($related_proposals as $i => $related_proposal){ ?>
                <div class="row mb-3">
                    <div class="col-2 col-md-1 position-relative">
                        <div class="">
                            <?php
                                if ($i % 2 !== 0)
                                {
                            ?>
                                    <img class="seller-view-img position-absolute" src="<?php echo  base_url('/assets/images/frontend/seller/even.svg'); ?>" alt="">
                            <?php
                                    }else{
                             ?>
                                    <img class="seller-view-img position-absolute" src="<?php echo  base_url('/assets/images/frontend/seller/odd.svg'); ?>" alt="">
                             <?php
                                }
                             ?>
                        </div>
                    </div>
                    <div class="col-10 col-md-11 px-0 bg-white rounded-10">
                        <div class="card  shadow-none my-0 mx-0">
                            <a class="" data-toggle="collapse" href="#agent<?=$i?>OfferedYou" role="button"
                               aria-expanded="false" aria-controls="agent<?=$i?>OfferedYou">
                                <div class="card-header d-flex justify-content-between text-dark">
                                    <h6 class="font-weight-bold mb-0"><?php echo(($related_proposal['prop_from'] == 'Agent') ? 'Agents' : 'You'); ?> Offered</h6>
                                    <div class="d-flex">
                                        <div class=""><i class="fa fa-calendar text-warning"></i> <?php echo date('m/d/Y', $related_proposal['prop_date']); ?></div>
                                        <div class="ml-3"><i class="fa fa-clock-o text-warning"></i> <?php echo date('h:i:s A', $related_proposal['prop_date']); ?></div>
                                    </div>
                                </div>
                            </a>

                            <div class="card-body collapse" id="agent<?=$i?>OfferedYou">
                                <div class="row">
                                    <div class="col-12 col-md-5 mb-2 mb-md-0">
                                        <div class="p-2 border rounded-10 card-blue">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/percent.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Commission  Rate</p>
                                                    <h6 class="font-weight-bold mb-0"><?= $related_proposal['contract_length']; ?>%</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="p-2 border rounded-10 card-light-blue">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/files.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Length of contract</p>
                                                    <h6 class="font-weight-bold mb-0"><?= $related_proposal['commission_rate']; ?> Months</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <h6 class="font-weight-bold">Your Terms</h6>
                                    <p><?php echo $related_proposal['prop_text'];?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <?php } ?>
            <?php } ?>
                <!--  End Start card row-->


            </div>
        </div>

        <div class="row">
            <div class="col-12 px-0 ">
                <!--  Last card row-->
                <div class="row mb-3">
                    <div class="col-2 col-md-1 position-relative">
                        <div class="">
                            <img class="seller-view-img position-absolute" src="<?php echo  base_url('/assets/images/frontend/seller/checked-icon.svg'); ?>" alt="">
                        </div>
                    </div>
                    <div class="col-10 col-md-11 px-0 bg-card-primary rounded-10">
                        <div class="card  shadow-none my-0 mx-0 bg-card-primary">
                            <a class="" data-toggle="collapse" href="#selectedagentOfferedYou" role="button"
                               aria-expanded="false" aria-controls="selectedagentOfferedYou">
                                <div class="card-header d-flex justify-content-between bg-card-primary">
                                    <h6 class="font-weight-bold mb-0"> <?php echo(($proposal['prop_from'] == 'Agent') ? 'Agent Counter' : 'You'); ?> Offered</h6>
                                    <div class="d-flex">
                                        <div class="">
                                            <img class="" width="16" src="<?php echo  base_url('/assets/images/frontend/seller/w-calendar.svg'); ?>" alt="">
                                            <?= date('m/d/Y', $proposal['prop_date']);?></div>
                                        <div class="ml-3">
                                            <img class="" width="16" src="<?php echo  base_url('/assets/images/frontend/seller/w-clock.svg'); ?>" alt="">
                                            <?= date('h:i A', $proposal['prop_date']);?></div>
                                    </div>
                                </div>
                            </a>

                            <div class="card-body collapse show " id="selectedagentOfferedYou">
                                <div class="row">
                                    <div class="col-12 col-md-5 mb-2 mb-md-0">
                                        <div class="p-2 border rounded-10 bg-white text-dark">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/percent.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0" style="color: #626262 !important;">Commission Rate</p>
                                                    <h6 class="font-weight-bold mb-0"><?= $proposal['commission_rate'];  ?>%</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="p-2 border rounded-10 bg-white text-dark">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/files.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0" style="color: #626262 !important;">Length of contract</p>
                                                    <h6 class="font-weight-bold mb-0"><?php echo $proposal['contract_length']; ?> Months</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <?php if (in_array($proposal['status'], array('Unread', 'Read')) && $proposal['prop_from'] == 'Agent') { ?>
                                                <div class="col-md-12 mt-3 px-lg-3 px-xl-3 text-center buttonsrow btn-group">
                                                    <button class="btn smallerbutton text-center acceptproposal btn btn-warning border border-white">ACCEPT THIS
                                                        OFFER
                                                    </button>
                                                    <button class="btn smallerbutton text-center mx-3 declineproposal btn btn-warning border border-white">DECLINE THIS
                                                        OFFER
                                                    </button>
                                                    <button class="btn smallerbutton text-center counterofferproposal btn btn-warning border border-white">COUNTER OFFER
                                                    </button>
                                                </div>
                                            <?php } elseif (in_array($proposal['status'], array('Unread', 'Read', 'Countered')) && $proposal['prop_from'] == 'Seller') { ?>
                                                <div class="col-md-12 mt-1 px-lg-3 px-xl-3 text-center buttonsrow">
                                                    <button class="button-dark text-center mr-3 withdrawproposal"
                                                            data-prop="<?php echo $proposal['prop_id']; ?>">WITHDRAW
                                                    </button>
                                                </div>
                                            <?php }
                                            else { ?>
                                                <div class="col-md-12 mt-1 px-lg-3 px-xl-3 text-center buttonsrow ">
                                                    <button class="btn smallerbutton text-center mr-3 btn btn-warning border border-white"> Offer <?php echo $proposal['status'] ?>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--  End Last card row-->

            </div>
        </div>
    </div>
</div>


