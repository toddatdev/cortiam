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

<input type="hidden" id="getSettingValue" name="getSettingValue" value="<?= $getSettingValue ?>"/>

<div class="card shadow-sm my-0 mb-3 mb-lg-2"
     style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;">
    <div class="card-body-second px-2 px-lg-0 py-3 py-lg-0 mx-1 mt-1">
        <nav class="">
            <ul class="nav edit-profile-dashbaord mt-0 border-bottom-0">
                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0 active"
                       href="#personalInformationTab"
                    >Personal Information
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0"
                       href="#locationInformation">Location Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0" href="#brokerageInfo"
                    >Brokerage Info</a>
                </li>
                <?php

                $row = activeFeatures("specializations");
                if (isset($row['id']) && !empty($row['id'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link scroll-nav-edit-account px-3 border-0"
                           href="#specializations">Specializations</a>
                    </li>
                    <?php
                }
                ?>
                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link scroll-nav-edit-account px-3 border-0" href="#statespecialization"-->
                <!--                    >Real Estate Specialization</a>-->
                <!--                </li>-->
                <?php
                $row = activeFeatures("social_media_links");

                if (isset($row['id']) && !empty($row['id'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link scroll-nav-edit-account px-3 border-0"
                           href="#socialMediaLinks"
                        >Social Media Links</a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0"
                       href="#biography"
                    >Biography</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0"
                       href="#licenses"
                    >Licenses</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0"
                       href="#passwordChange"
                    >Password Change</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0" href="#reviews">Reviews</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link scroll-nav-edit-account px-3 border-0" href="#agentAvailableSlots">Appointment slots</a>
                </li>

<!--                <li class="nav-item">-->
<!--                    <a class="nav-link scroll-nav-edit-account px-3 border-0"-->
<!--                       href="#creditCard"-->
<!--                    >Credit Card</a>-->
<!--                </li>-->




            </ul>
        </nav>
    </div>
</div>

<div class="card shadow-sm my-0 mb-3 mb-lg-2" style="border-top-left-radius: 0;border-top-right-radius: 0;">
    <div class="card-body-second px-2 px-lg-0 py-3 m-1">

        <form method="POST" class="ajaxform" data-source="formajaxurl" autocomplete="off" id="editprofileform">

            <div class="" id="personalInformationTab">
                <!--  Personal Information-->
                <div class="card shadow-none border position-relative mb-5 py-3">
                    <h6 class="position-absolute heading-top-align">Personal Information</h6>
                    <div class="card-body-second">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-2 mb-3">
                                <div class="mouseoverlayer">
                                    <img class="img-fluid rounded-circle user-avatar photoneedsupdate"
                                         src="<?php echo(($account['avatar_string']) ? base_url($account['avatar_string']) : base_url('assets/images/backend/userphoto.jpg')); ?>"
                                         width="95" height="95" id="editavatarstring">
                                    <!-- <input type="file" class="d-none property_img_upload"/> -->
                                    <a class="rounded-circle triggerphotochange" href="javascript:void(0);">
                                        <img src="<?php echo base_url('images/profile_icon.svg'); ?>"
                                             class="profile-icon">
                                    </a>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold mt-2 text-left"><?php echo $account['first_name'] . ' ' . $account['last_name'];; ?></h6>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-10 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <fieldset class="scheduler-border mb-3">
                                            <legend class="scheduler-border mb-0 pb-0 border-bottom-0">First Name
                                            </legend>
                                            <div class="control-group">
                                                <div class="controls bootstrap-timepicker d-flex">
                                                    <input type="text" name="first_name" id="first_name"
                                                           placeholder="Enter Your First Name"
                                                           value="<?php echo $account['first_name']; ?>"/>
                                                    <img src="<?php echo base_url('images/user.svg'); ?>"
                                                    >
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <fieldset class="scheduler-border mb-3">
                                            <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Last Name
                                            </legend>
                                            <div class="control-group">
                                                <div class="controls bootstrap-timepicker d-flex">
                                                    <input type="text" name="last_name" id="last_name"
                                                           placeholder="Enter Your Last Name"
                                                           value="<?php echo $account['last_name']; ?>"/>
                                                    <img src="<?php echo base_url('images/user.svg'); ?>"
                                                    >
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <fieldset class="scheduler-border mb-3">
                                            <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Phone
                                                Number
                                            </legend>
                                            <div class="control-group">
                                                <div class="controls bootstrap-timepicker d-flex">
                                                    <input type="tel"
                                                           name="phone"
                                                           id="phone"
                                                           placeholder="Enter Your Phone Number"
                                                           value="<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $account['phone']); ?>"
                                                    />
                                                    <img src="<?php echo base_url('images/phone_v.svg'); ?>">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <fieldset class="scheduler-border mb-3">
                                            <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Email
                                                Address
                                            </legend>
                                            <div class="control-group">
                                                <div class="controls bootstrap-timepicker d-flex">
                                                    <input type="text"
                                                           name="email" id="email"
                                                           placeholder="johnsmith12@gmail.com"
                                                           value="<?php echo $account['email']; ?>"
                                                    />
                                                    <img src="<?php echo base_url('images/message_v.svg'); ?>">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <?php
                                    $row = activeFeatures("agent_intro_videos");
                                    if (isset($row['id']) && !empty($row['id'])) {
                                        ?>
                                        <div class="col-12">
                                            <fieldset class="scheduler-border mb-3">
                                                <legend class="scheduler-border mb-0 pb-0 border-bottom-0">YouTube
                                                    Video
                                                </legend>
                                                <div class="control-group">
                                                    <div class="controls bootstrap-timepicker d-flex">
                                                        <input type="text"
                                                               name="youtube_video" id="youtube_video"
                                                               placeholder="Enter Video URL"
                                                               value="<?php echo $account['youtube_video']; ?>"
                                                        />
                                                        <img src="<?php echo base_url('images/video.svg'); ?>"
                                                             style="margin-left: 7px;"
                                                        >
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div class="col-12">
                                            <fieldset class="scheduler-border mb-3">
                                                <legend class="scheduler-border mb-0 pb-0 border-bottom-0">YouTube
                                                    Video
                                                </legend>
                                                <div class="control-group">
                                                    <p style="justify-content: center; align-content: center; display: flex">Please upgrade to add a Youtube video URL to profile.</p>
                                                    <a href= "<?php echo base_url('agent/my-plan');?>" style="justify-content: center; align-content: center; display: flex" class="btn button-orange">Upgrade</a>
                                                </div>
                                            </fieldset>

                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="alert alert-info bg-primary text-white"><span class="font-weight-semibold">Next account membership payment is due <?php echo date('m/d/Y',$account['membership_due']);?> for <?= "$". getPlanPrice($account['plan_id']) ?></span></div>

                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a class="btn btn-sm button-orange" href="<?php echo cortiam_base_url('my-profile'); ?>">Preview Profile</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="" id="locationInformation">
                <!--  Location Information-->
                <div class="card shadow-none border position-relative py-3">
                    <h6 class="position-absolute heading-top-align">Location Information</h6>
                    <div class="card-body-second">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Address Line</legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text"
                                                   name="address" id="address" class="setmap"
                                                   placeholder="Enter Your Address Line"
                                                   value="<?php echo $account['address']; ?>"/>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-4">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Unit</legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text"
                                                   name="unit" id="unit" placeholder="Enter Unit"
                                                   value="<?php echo $account['unit']; ?>"
                                            />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-4">


                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">State</legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <select name="state" id="state">
                                                <?php
                                                if (isset($account['state']) && $account['state']) {
                                                    ?>
                                                    <option value="<?= $account['state'] ?>"><?= $account['state'] ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option>Select Your State</option>

                                                    <?php

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-4">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">City</legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <select name="city" id="city" class="">
                                                <?php
                                                if (isset($account['city']) && $account['city']) {
                                                    ?>
                                                    <option value="<?= $account['city'] ?>"><?= $account['city'] ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option>Select Your City</option>

                                                    <?php

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-4">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Zipcode</legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text"
                                                   name="zipcode" id="zipcode"
                                                   placeholder="Enter Zip Code"
                                                   value="<?php echo $account['zipcode']; ?>"
                                            />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="brokerageInfo">
                <!--  Brokergae Information-->
                <div class="card shadow-none border position-relative mb-5 py-3">
                    <h6 class="position-absolute heading-top-align">Brokerage Information</h6>
                    <div class="card-body-second">
                        <div class="row">
                            <div class="col-12">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Company Name
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text"
                                                   name="brokerage_name" id="brokerage_name"
                                                   placeholder="Enter Your Company Name"
                                                   value="<?php echo $account['brokerage_name']; ?>"/>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-8">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Address
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text" name="brokerage_address" id="brokerage_address"
                                                   class="form-control"
                                                   value="<?php echo $account['brokerage_address']; ?>"/>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-4">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Unit
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="tel"
                                                   name="brokerage_unit" id="brokerage_unit"
                                                   placeholder="Enter Unit"
                                                   value="<?php echo $account['brokerage_unit']; ?>"
                                            />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-5">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Brokerage State
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <select name="brokerage_state" id="brokerage_state">
                                                <?php
                                                if (isset($account['brokerage_state']) && $account['brokerage_state']) {
                                                    ?>
                                                    <option value="<?= $account['brokerage_state'] ?>"><?= $account['brokerage_state'] ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option>Select Your State</option>

                                                    <?php

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-12 col-lg-5">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Brokerage City
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <select name="brokerage_city" id="brokerage_city">
                                                <?php
                                                if (isset($account['brokerage_city']) && $account['brokerage_city']) {
                                                    ?>
                                                    <option value="<?= $account['brokerage_city'] ?>"><?= $account['brokerage_city'] ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option>Select Your City</option>

                                                    <?php

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                            <div class="col-12 col-lg-2">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Zipcode
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="tel"
                                                   placeholder="Enter Zipcode"
                                                   name="brokerage_zipcode" id="brokerage_zipcode"
                                                   value="<?php echo $account['brokerage_zipcode']; ?>"
                                            />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                            <div class="col-12 col-lg-6">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Phone Number
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="tel"
                                                   name="brokerage_phone" id="brokerage_phone"
                                                   placeholder="Enter Your Phone Number"
                                                   class="format-phone-number"
                                                   value="<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $account['brokerage_phone']); ?>"
                                            />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                            <div class="col-12 col-lg-6">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Real Estate
                                        Experience

                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex" id="yearcalebderplace">
<!--                                            <input-->
<!--                                                    type="number" name="experience" id="experience"-->
<!--                                                    placeholder="Enter Real Estate Experience"-->
<!--                                                    value="--><?php //echo $account['experience']; ?><!--"-->
<!--                                            />-->
                                        </div>

<!--                                        <div id="yearcalebderplace">-->
<!---->
<!--                                        </div>-->
                                    </div>
                                </fieldset>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <?php

            $row = activeFeatures("specializations");
            if (isset($row['id']) && !empty($row['id'])) {
                ?>
                <div id="specializations">
                    <!--  Brokergae Information-->
                    <div class="card shadow-none border position-relative mb-5 py-3">
                        <h6 class="position-absolute heading-top-align">Specialization</h6>
                        <div class="card-body-second">
                            <div class="row">


                                <div class="col-12 col-lg-12">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">
                                            Specialization (click below to choose your option)
                                        </legend>

                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <select class="form-control specialization-selection border"
                                                        id="specialization-selection"
                                                        name="specializations[]" multiple="multiple">
                                                    <?php
                                                    foreach ($specializations as $key => $val) {
                                                        ?>
                                                        <option value="<?= $val['id'] ?>" <?= array_search($val['id'], array_column($agentspecializations, 'specialization_id')) !== false ? 'selected' : '' ?>><?= $val['name'] ?></option>
                                                        <?php

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            else{
                ?>
                <div id="specializations">
                    <!--  Brokergae Information-->
                    <div class="card shadow-none border position-relative mb-5 py-3">
                        <h6 class="position-absolute heading-top-align">Specialization</h6>
                        <div class="card-body-second">
                                <p style="justify-content: center; align-content: center; display: flex">Please upgrade to view specialization feature</p>
                                <a href= "<?php echo base_url('agent/my-plan');?>" style="justify-content: center; align-content: center; display: flex" class="btn button-orange">Upgrade</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
            <!--            <div id="statespecialization">-->
            <!--                <div class="card shadow-none border position-relative mb-5 py-3">-->
            <!--                    <h6 class="position-absolute heading-top-align">Real Estate Specialization</h6>-->
            <!--                    <div class="card-body-second">-->
            <!--                        <div class="row">-->
            <!--                            <div class="col-12 col-lg-12">-->
            <!--                                <fieldset class="scheduler-border mb-3" style="border: none !important;">-->
            <!--                                    <div class="control-group">-->
            <!--                                        <div class="controls bootstrap-timepicker d-flex">-->
            <!--                                            <div id="estate_specialization"-->
            <!--                                                 placeholder="Please describe your particular real estate specialization such as waterfront, mountain homes...">-->
            <?php //echo $account['estate_specialization']; ?><!--</div>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </fieldset>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->


                <div id="socialMediaLinks">
                    <!--  Social Media Links-->
                    <div class="card shadow-none border position-relative py-3">
                        <h6 class="position-absolute heading-top-align">Social Media Links</h6>
                        <div class="card-body-second">
                            <?php
                            $row = activeFeatures("social_media_links");
                            if (isset($row['id']) && !empty($row['id'])) {


                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Facebook Profile
                                        </legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text"
                                                       name="facebook" id="facebook"
                                                       placeholder="Enter Facebook Profile Link"
                                                       value="<?php echo $account['facebook']; ?>"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">LinkedIn Profile
                                        </legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text"
                                                       name="linkedin" id="linkedin"
                                                       placeholder="Enter LinkedIn Profile Link"
                                                       value="<?php echo $account['linkedin']; ?>"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Twitter Profile
                                        </legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text"
                                                       name="twitter" id="twitter"
                                                       placeholder="Enter Twitter Profile Link"
                                                       value="<?php echo $account['twitter']; ?>"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Google Profile
                                        </legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text"
                                                       name="google" id="google"
                                                       placeholder="Enter Google Link"
                                                       value="<?php echo $account['google']; ?>"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Instagram Profile
                                        </legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text"
                                                       name="instagram" id="instagram"
                                                       placeholder="Enter Instagram Profile Link"
                                                       value="<?php echo $account['instagram']; ?>"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                            </div>
                            <?php
                            }
                            else{
                                ?>
                                <div>
                                    <p style="justify-content: center; align-content: center; display: flex">Please upgrade to add social media links</p>
                                    <a href= "<?php echo base_url('agent/my-plan');?>" style="justify-content: center; align-content: center; display: flex" class="btn button-orange">Upgrade</a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>

            <div id="biography">
                <!--  Biography-->
                <div class="card shadow-none border position-relative py-3">
                    <h6 class="position-absolute heading-top-align">Biography</h6>
                    <div class="card-body-second">
                        <div class="row">
                            <div class="col-12">
                                <div id="bio"
                                     placeholder="Please include a short biography introducing yourself to potential clients."><?php echo $account['bio']; ?></div>
                            </div>

                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-sm button-orange">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="licenses">
                <!--  Licenses-->
                <div class="card shadow-none border position-relative py-3">
                    <h6 class="position-absolute heading-top-align">Your Real Estate License Information</h6>
                    <div class="card-body-second">
                        <!-- .maincontent .card .card-header .dropdown-menu p -->
                        <!--Licenses-->
                        <div class="card" id="licensespart">
                            <div class="d-flex justify-content-end align-items-center card-header">
                                <div class="dropdown d-inline">
                                    <a href="#" role="button" id="questiontab-2" data-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false"><span class="icon-co-big question"></span></a>
                                    <div class="dropdown-menu dropdown-menu-right larger"
                                         aria-labelledby="questiontab-2"
                                         id="questiontab-2">
                                        <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel blandit
                                            velit, ut accumsan orci.
                                            Vestibulum sed rutrum mi. Proin sed dolor turpis. Suspendisse sagittis
                                            faucibus eros a sodales.
                                            Nulla in tempor magna. Proin efficitur imperdiet dolor eu imperdiet.</p>
                                    </div>
                                </div>
                                <a class="headerelementlink" id="addlicense" data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="Add new license"><span class="icon-co-big add"></span></a>
                            </div>
                            <div class="col-md-12">
                                <div class="card-body mr-2 ml-2 p-0 p-lg-2 pb-2 liscense-body">

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="addnewlicense">
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="licenselistingpart">
                                                <ul class="profile-list">
                                                    <?php if ($licenses) { ?>
                                                        <?php foreach ($licenses as $license) { ?>
                                                            <li class="profile-list-item">
                                                                <div class="no-gutters d-flex align-items-center justify-content-between">
                                                                    <div class="flex-grow-1">
                                                                        <p class="titlepart">
                                                                            <strong><?php echo(($license['interested'] == 'Both') ? 'Residential & Commercial' : $license['interested']); ?>
                                                                                License
                                                                                for <?php echo $license['license_state']; ?></strong>
                                                                        </p>
                                                                        <p class="subtitlepart">Expires
                                                                            on <?php echo date('m-d-Y', $license['license_expire']); ?></p>
                                                                    </div>
                                                                    <div class="align-items-center d-flex justify-content-between"
                                                                         style="text-align: end !important">
                                                                        <div class="mx-2"> <?php echo generate_license_status_pill($license['license_status']); ?></div>
                                                                    </div>
                                                                    <div class="btn-group mt-2 dropleft"
                                                                         data-toggle="tooltip"
                                                                         data-placement="left"
                                                                         title="Click for options">
                                                <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                      class="cardopenmenu"><i class="icon-menu"></i></span>
                                                                        <div class="dropdown-menu">
                                                                            <button class="dropdown-item"
                                                                                    type="button" id="editmylicense"
                                                                                    data-id="<?php echo $license['license_id']; ?>">
                                                                                Edit Details
                                                                            </button>
                                                                            <button class="dropdown-item"
                                                                                    type="button"
                                                                                    id="deletemylicense"
                                                                                    data-id="<?php echo $license['license_id']; ?>">
                                                                                Delete
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <li class="list-group-item text-center">Please add your agent
                                                            license for your account.
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                            </div>

                        </div>

                        <div class="text-right mt-3">

                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--        --><?php
        //        $row = activeFeatures("premium_query_search");
        //        if (isset($row['id']) && !empty($row['id'])) {
        //            ?>


    <!--            --><?php
    //        }
    //        ?>
</div>


<div id="passwordChange">
    <!--  Password Change-->
    <div class="card shadow-none border position-relative py-3">
        <h6 class="position-absolute heading-top-align">Password Change</h6>
        <div class="card-body-second">

            <!--Password Change-->
            <form method="POST" class="ajaxform w-100" data-source="passwordajaxurl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">Password and confirm password are not
                            mandatory fields for
                            updating your profile details. Please only use when you want to
                            update/change your account
                            password.
                        </div>
                    </div>
                    <div class="col-12">
                        <fieldset class="scheduler-border mb-3">
                            <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Password
                            </legend>
                            <div class="control-group">
                                <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Create Password"
                                           id="createpassword"
                                    />
                                    <img src="<?php echo base_url('images/confirm_pass.svg'); ?>"
                                         class="create-password">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset class="scheduler-border mb-3">
                            <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Confirm
                                Password
                            </legend>
                            <div class="control-group">
                                <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                    <input type="password" class="form-control" name="passwordagain"
                                           placeholder="Confirm Password"
                                           id="passwordagain"
                                    />
                                    <img src="<?php echo base_url('images/confirm_pass.svg'); ?>"
                                         class="confirm-password">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="d-block d-sm-flex justify-content-between mt-3">
                    <div class="">
                        <a href="#" class="deactivateme btn btn-danger w-100  mb-2 mb-sm-0 rounded-5" style=""
                           data-id="<?php echo $account['agent_id']; ?>"><i
                                    class="icon-cancel-circle2 mr-2" style="font-size: 14px !important;"></i>Remove Account</a>
                    </div>
                    <div>
                        <button type="submit" class="button-orange w-100 rounded-5">Change Password</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


    <div id="reviews">
        <!--  Password Change-->
        <div class="card shadow-none border position-relative py-3">
            <h6 class="position-absolute heading-top-align">Reviews</h6>
            <div class="card-body-second">
                <!--Reviews-->

                <?php
                if (isset($this->page_data['review']) && count($this->page_data['review']) > 0) {

                    foreach ($this->page_data['review'] as $dt) { ?>
                        <div class="col-12 mb-2 border-bottom pb-2">
                            <?php
                            for ($x = 1; $x <= $dt->rating; $x++) { ?>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>

                            <?php }

                            for ($x = 1; $x <= 5 - $dt->rating; $x++) { ?>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>

                            <?php }
                            ?>
                            <p class="my-1"><?php echo $dt->comment ?></p>

                            <blockquote class="blockquote mb-0">
                                <footer class="blockquote-footer">
                                    <cite title="Review by <?php echo $dt->name ?? '' ?>"
                                          class=" text-warning"><?php echo $dt->name ?? '' ?></cite>
                                </footer>
                            </blockquote>
                        </div>

                        <?php
                    }
                }

                ?>
            </div>

        </div>
    </div>


    <div id="agentAvailableSlots">
        <div class="card shadow-none border position-relative py-3">
            <h6 class="position-absolute heading-top-align">Create Appointment Slots</h6>
            <div class="card-body-second">
                <!--Agent Slots-->
                <?php

                $row  = activeFeatures("appointment");

                if(isset($row['id']) && !empty($row['id']) )
                {
                ?>
                    <?php include_once("agentslots.php") ?>

                <?php
                }else{
                ?>
                    <div class="card-body-second">
                        <p style="justify-content: center; align-content: center; display: flex">Please upgrade to view Appointment feature</p>
                        <a href= "<?php echo base_url('agent/my-plan');?>" style="justify-content: center; align-content: center; display: flex" class="btn button-orange">Upgrade</a>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>





<!--<div id="creditCard">-->
<!--    Credit Card -->
<!--    <div class="card shadow-none border position-relative py-3">-->
<!--        <h6 class="position-absolute heading-top-align">Credit Card</h6>-->
<!--        <div class="card-body-second">-->
<!--            Credit Cards-->
<!---->
<!---->
<!--            --><?php //if (isset($account['stripe_id']) && (isset($invoices) && $invoices[0]['payment_type'] !== 'Free Trial')) { ?>
<!--            <div class="card" id="paymentpart">-->
<!--                <div class="card-header header-elements-inline">-->
<!--                    <h3 class="card-title"><span class="icon-co-big orange ccard"></span> Credit-->
<!--                        Cards</h3>-->
<!--                    <div class="header-elements">-->
<!--                        <div class="dropdown d-inline">-->
<!--                            <a href="#" role="button" id="questiontab-1" data-toggle="dropdown"-->
<!--                               aria-haspopup="true"-->
<!--                               aria-expanded="false"><span class="icon-co-big question"></span></a>-->
<!--                            <div class="dropdown-menu dropdown-menu-right larger"-->
<!--                                 aria-labelledby="questiontab-1"-->
<!--                                 id="questiontab-1">-->
<!--                                <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel-->
<!--                                    blandit velit, ut accumsan-->
<!--                                    orci. Vestibulum sed rutrum mi. Proin sed dolor turpis.-->
<!--                                    Suspendisse sagittis faucibus eros a-->
<!--                                    sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor-->
<!--                                    eu imperdiet.</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <a class="headerelementlink" id="addcart" data-toggle="tooltip"-->
<!--                           data-placement="bottom"-->
<!--                           title="Add new credit card"><span class="icon-co-big add"></span></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="card-body-second">-->
<!--                    <fieldset>-->
<!--                        <div class="row">-->
<!--                            <div class="col-md-12">-->
<!--                                <div id="cardpart">-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-12" id="cardlistingpart">-->
<!--                                <ul class="profile-list">-->
<!--                                    --><?php //if ($credit_cards) { ?>
<!--                                        --><?php //foreach ($credit_cards as $credit_card) { ?>
<!--                                            <li class="profile-list-item">-->
<!--                                                <div class="row no-gutters">-->
<!--                                                    <div class="col-sm-9">-->
<!--                                                        <div class="float-left mr-2">--><?php //echo card_icons(ucfirst($credit_card['brand'])); ?><!--</div>-->
<!--                                                        <p class="titlepart">-->
<!--                                                            <strong>--><?php //echo ucfirst($credit_card['brand']); ?>
<!--                                                                **** --><?php //echo $credit_card['last_digit']; ?><!--</strong>-->
<!--                                                        </p>-->
<!--                                                        <p class="subtitlepart">Expires-->
<!--                                                            on --><?php //echo date('M Y', $credit_card['expire_date']); ?><!--</p>-->
<!--                                                    </div>-->
<!--                                                    <div class="col-sm-3 align-middle text-right">-->
<!--                                                        <div class="btn-group dropleft --><?php //echo(($credit_card['payment_id'] == $account['payment_id']) ? 'invisible' : ''); ?><!--"-->
<!--                                                             data-toggle="tooltip"-->
<!--                                                             data-placement="left"-->
<!--                                                             title="Click for options">-->
<!--                                                    <span data-toggle="dropdown" aria-haspopup="true"-->
<!--                                                          aria-expanded="false" class="cardopenmenu"><i-->
<!--                                                                class="icon-menu"></i></span>-->
<!--                                                            <div class="dropdown-menu">-->
<!--                                                                <button class="dropdown-item"-->
<!--                                                                        type="button"-->
<!--                                                                        id="deletemycard"-->
<!--                                                                        data-id="--><?php //echo $credit_card['card_id']; ?><!--">-->
<!--                                                                    Delete-->
<!--                                                                </button>-->
<!--                                                                <button class="dropdown-item"-->
<!--                                                                        type="button" id="setmycard"-->
<!--                                                                        data-id="--><?php //echo $credit_card['card_id']; ?><!--">-->
<!--                                                                    Set As-->
<!--                                                                    Default-->
<!--                                                                </button>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </li>-->
<!--                                        --><?php //} ?>
<!--                                    --><?php //} else { ?>
<!--                                        <li class="list-group-item text-center">Please add your-->
<!--                                            credit card to activate your-->
<!--                                            payment system.-->
<!--                                        </li>-->
<!--                                    --><?php //} ?>
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </fieldset>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //}?>
<!---->
<!--        Payment-->
<!--        --><?php //if ($invoices) { ?>
<!--        <div class="card" id="invoicepart">-->
<!--            <div class="card-header header-elements-inline">-->
<!--                <h3 class="card-title"><span class="icon-co-big orange finance"></span> Payments-->
<!--                </h3>-->
<!--                <div class="header-elements">-->
<!--                    <div class="dropdown d-inline">-->
<!--                        <a href="#" role="button" id="questiontab-1" data-toggle="dropdown"-->
<!--                           aria-haspopup="true"-->
<!--                           aria-expanded="false"><span class="icon-co-big question"></span></a>-->
<!--                        <div class="dropdown-menu dropdown-menu-right larger"-->
<!--                             aria-labelledby="questiontab-1"-->
<!--                             id="questiontab-1">-->
<!--                            <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel-->
<!--                                blandit velit, ut accumsan-->
<!--                                orci. Vestibulum sed rutrum mi. Proin sed dolor turpis.-->
<!--                                Suspendisse sagittis faucibus eros a-->
<!--                                sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor-->
<!--                                eu imperdiet.</p>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                    <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="card-body">-->
<!--                <fieldset>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12">-->
<!--                            <ul class="profile-list expandable" id="invoicelistingpart">-->
<!--                                --><?php //if ($invoices) { ?>
<!--                                    --><?php //foreach ($invoices as $invoice) { ?>
<!--                                        <li class="profile-list-item">-->
<!--                                            --><?php //if ($invoice['payment_type'] == 'Free Trial') { ?>
<!--                                                <div class="trialmessage pl-3 text-center"-->
<!--                                                     data-toggle="collapse"-->
<!--                                                     href="#invoice---><?php //echo $invoice['invoice_id']; ?><!--"-->
<!--                                                     role="button"-->
<!--                                                     aria-expanded="false"-->
<!--                                                     aria-controls="invoice---><?php //echo $invoice['invoice_id']; ?><!--">-->
<!--                                                    Free-->
<!--                                                    Trial Period-->
<!--                                                    between --><?php //echo date('m/d/Y h:i A', $account['free_starts']); ?>
<!--                                                    and --><?php //echo date('m/d/Y h:i A', $account['free_ends']); ?>
<!--                                                    .-->
<!--                                                </div>-->
<!--                                            --><?php //} else { ?>
<!--                                                <div class="row pl-3 cursor-pointer collapsed"-->
<!--                                                     data-toggle="collapse"-->
<!--                                                     href="#invoice---><?php //echo $invoice['invoice_id']; ?><!--"-->
<!--                                                     role="button"-->
<!--                                                     aria-expanded="false"-->
<!--                                                     aria-controls="invoice---><?php //echo $invoice['invoice_id']; ?><!--">-->
<!--                                                    <div class="col-sm-9 align-middle">-->
<!--                                                        <p class="titlepart">--><?php //echo $invoice['payment_desc']; ?><!--</p>-->
<!--                                                    </div>-->
<!--                                                    <div class="col-sm-1 align-middle">-->
<!--                                                        <p class="mb-0 text-nowrap">-->
<!--                                                            $--><?php //echo $invoice['final_amount']; ?><!--</p>-->
<!--                                                    </div>-->
<!--                                                    <div class="col-sm-2 align-middle text-right">-->
<!--                                                        --><?php //echo generate_invoice_status_pill($invoice['invoice_status']); ?>
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="col-sm-12 multi-collapse collapse invoiceexplain"-->
<!--                                                     id="invoice---><?php //echo $invoice['invoice_id']; ?><!--">-->
<!--                                                    --><?php
//                                                    switch ($invoice['invoice_status']) {
//                                                        case 'Completed':
//                                                            echo 'Payment completed on ' . date('m/d/Y h:i A', $invoice['payment_time']) . (($invoice['discount_amount']) ? '<br><b>' . $invoice['coupon_code'] . '</b> coupon used for this payment and saved $' . $invoice['discount_amount'] . '. Payment amount dropped from $' . $invoice['real_amount'] . ' to $' . $invoice['final_amount'] . '.' : '');
//                                                            break;
//                                                        case 'Refund':
//                                                            echo 'Payment completed on ' . date('m/d/Y h:i A', $invoice['payment_time']) . ' and refund on ' . date('m/d/Y h:i A', $invoice['refund_date']) . '.';
//                                                            break;
//                                                        case 'Failed':
//                                                            echo 'Payment failed ' . $invoice['try_amount'] . ' times and will be processed again on ' . date('m/d/Y h:i A', $invoice['try_time']);
//                                                            break;
//                                                        default:
//                                                            echo 'Payment due date is ' . date('m/d/Y h:i A', $invoice['try_time']);
//                                                            break;
//                                                    }
//                                                    ?>
<!--                                                </div>-->
<!--                                            --><?php //} ?>
<!--                                        </li>-->
<!--                                    --><?php //} ?>
<!--                                --><?php //} else { ?>
<!--                                    <li class="list-group-item text-center">Please add your-->
<!--                                        credit card to activate your-->
<!--                                        payment system.-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                            </ul>-->
<!--                        </div>-->
<!--                        --><?php //if ($account['membership_due']) { ?>
<!--                            <div class="col-md-12"><div class="approvalmessage mb-1">Next payment period of your membership is on --><?php //echo date('m/d/Y h:i A', $account['membership_due']); ?><!--<div><div>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                </fieldset>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    --><?php //} ?>
<!--</div>-->
<!--</div>-->


</div>
</div>
</div>


<!--Profile-->
<div>
    <!--    <form method="POST" class="ajaxform w-100" data-source="formajaxurl" autocomplete="off" id="editprofileform">-->
    <!--        <div class="card">-->
    <!--            <div class="card-header header-elements-inline">-->
    <!--                <h3 class="card-title"><span class="icon-co-big orange profile"></span> Profile</h3>-->
    <!--            <div class="header-elements">-->
    <!--                <div class="dropdown d-inline mr-0 mr-sm-2">-->
    <!--                    <a href="#" role="button" id="questiontab-1" data-toggle="dropdown" aria-haspopup="true"-->
    <!--                       aria-expanded="false"><span class="icon-co-big question"></span></a>-->
    <!--                    <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-1"-->
    <!--                         id="questiontab-1">-->
    <!--                        <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel blandit velit, ut accumsan-->
    <!--                            orci. Vestibulum sed rutrum mi. Proin sed dolor turpis. Suspendisse sagittis faucibus eros a-->
    <!--                            sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor eu imperdiet.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <h6 class="d-inline mt-1 align-middle">EMAIL NOTIFICATION</h6>-->
    <!--                <label class="switchbutton ml-2">-->
    <!--                    <input type="checkbox" name="notifications" id="notifications"-->
    <!--                           value="Yes" -->
    <?php //echo(($account['notifications'] == 'Yes') ? 'checked' : '');; ?><!--
                              <span class="switchslider round"></span>-->
    <!--                </label>-->
    <!--            </div>-->
    <!--            </div>-->
    <!--            <div class="card-body-second">-->
    <!--                <fieldset>-->
    <!--                    <div>-->
    <!--                <div class="row">-->
    <!--                    <div class="col-md-3 text-center">-->
    <!--                        <h5 class="text-left">Profile-->
    <!--                        </h5>-->
    <!--                        <div class="d-inline-block my-3 mt-lg-4 mt-xl-4 mouseoverlayer">-->
    <!--                            <img class="img-fluid rounded-circle user-avatar photoneedsupdate"-->
    <!--                                 src="-->
    <?php //echo(($account['avatar_string']) ? base_url($account['avatar_string']) : base_url('assets/images/backend/userphoto.jpg')); ?><!--"-->
    <!--                                 width="120" height="120" id="editavatarstring">-->
    <!--                            <div class="hoverlayer rounded-circle triggerphotochange">-->
    <!--                                <div class="centerer" data-toggle="tooltip" data-placement="left"-->
    <!--                                     title="Click to change"><span class="icon-co-big white write"></span></div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-9">-->
    <!--                        <div class="row">-->
    <!--                            <h5 class="col-sm-12">Personal Information</h5>-->
    <!--                            <div class="col-md-6">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input type="text" class="form-control" name="first_name" id="first_name"-->
    <!--                                           placeholder="First Name" value="-->
    <?php //echo $account['first_name']; ?><!--">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-6">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input type="text" class="form-control" name="last_name" id="last_name"-->
    <!--                                           placeholder="Last Name" value="-->
    <?php //echo $account['last_name']; ?><!--">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="row">-->
    <!--                            <div class="col-md-6">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input type="tel" class="form-control format-phone-number"-->
    <!--                                           name="phone"-->
    <!--                                           placeholder="Phone Number" id="phone"-->
    <!--                                           value="-->
    <?php //echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $account['phone']); ?><!--">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-6">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input type="email" class="form-control" name="email" id="email"-->
    <!--                                           placeholder="Email Address" value="-->
    <?php //echo $account['email']; ?><!--">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-12">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input type="text" name="youtube_video" id="youtube_video" class="form-control"-->
    <!--                                           placeholder="YouTube Video URL"-->
    <!--                                           value="-->
    <?php //echo $account['youtube_video']; ?><!--">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--    <hr>-->

    <!--                <div class="row">-->
    <!--                    <h5 class="col-sm-12">Location Information</h5>-->
    <!--                    <div class="col-md-9">-->
    <!--                        <div class="form-group">-->
    <!--                            <input type="text" name="address" id="address" class="form-control setmap"-->
    <!--                                   placeholder="Address Line" value="-->
    <?php //echo $account['address']; ?><!--">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!---->
    <!--                    <div class="col-md-3">-->
    <!--                        <div class="form-group">-->
    <!--                            <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit"-->
    <!--                                   value="--><?php //echo $account['unit']; ?><!--">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->


    <!--                <div class="row">-->
    <!--                    <div class="col-md-5">-->
    <!--                        <div class="form-group">-->
    <!--                            <select name="state" id="state" class="form-control">-->
    <!--                                --><?php
    //                                if (isset($account['state']) && $account['state']) {
    //                                    ?>
    <!--                                    <option value="--><? //= $account['state'] ?><!--">-->
    <? //= $account['state'] ?><!--</option>-->
    <!--                                    --><?php
    //                                } else {
    //                                    ?>
    <!--                                    <option>Select a State</option>-->
    <!---->
    <!--                                    --><?php
    //
    //                                }
    //                                ?>
    <!--                            </select>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!---->
    <!--                    <div class="col-md-5">-->
    <!--                        <div class="form-group">-->
    <!--                            <select name="city" id="city" class="form-control">-->
    <!--                                --><?php
    //                                if (isset($account['city']) && $account['city']) {
    //                                    ?>
    <!--                                    <option value="--><? //= $account['city'] ?><!--">-->
    <? //= $account['city'] ?><!--</option>-->
    <!--                                    --><?php
    //                                } else {
    //                                    ?>
    <!--                                    <option>Select a City</option>-->
    <!---->
    <!--                                    --><?php
    //
    //                                }
    //                                ?>
    <!--                            </select>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!---->
    <!--                    <div class="col-md-2">-->
    <!--                        <div class="form-group">-->
    <!--                            <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zip Code"-->
    <!--                                   value="--><?php //echo $account['zipcode']; ?><!--">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!---->
    <!--                </div>-->
    <!--                    </div>-->

    <!--                    <div>-->
    <!--                 <div class="row mt-3">-->
    <!--                     <h5 class="col-sm-12">Brokerage Info</h5>-->
    <!--                     <div class="col-md-12">-->
    <!--                         <div class="form-group">-->
    <!--                             <input type="text" name="brokerage_name" id="brokerage_name" class="form-control"-->
    <!--                                    placeholder="Company Name" value="-->
    <?php //echo $account['brokerage_name']; ?><!--">-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-9">-->
    <!--                         <div class="form-group">-->
    <!--                             <input type="text" name="brokerage_address" id="brokerage_address" class="form-control"-->
    <!--                                    placeholder="Address" value="-->
    <?php //echo $account['brokerage_address']; ?><!--">-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-3">-->
    <!--                         <div class="form-group">-->
    <!--                             <input type="text" name="brokerage_unit" id="brokerage_unit" class="form-control"-->
    <!--                                    placeholder="Unit" value="-->
    <?php //echo $account['brokerage_unit']; ?><!--">-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-5">-->
    <!--                         <div class="form-group">-->
    <!--                             <select name="brokerage_state" id="brokerage_state" class="form-control">-->
    <!--                                 --><?php
    //                                 if (isset($account['brokerage_state']) && $account['brokerage_state']) {
    //                                     ?>
    <!--                                     <option value="-->
    <? //= $account['brokerage_state'] ?><!--">--><? //= $account['brokerage_state'] ?><!--</option>-->
    <!--                                     --><?php
    //                                 } else {
    //                                     ?>
    <!--                                     <option>Select a State</option>-->
    <!---->
    <!--                                     --><?php
    //
    //                                 }
    //                                 ?>
    <!--                             </select>-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-5">-->
    <!--                         <div class="form-group">-->
    <!---->
    <!--                             <select name="brokerage_city" id="brokerage_city" class="form-control">-->
    <!--                                 --><?php
    //                                 if (isset($account['brokerage_city']) && $account['brokerage_city']) {
    //                                     ?>
    <!--                                     <option value="-->
    <? //= $account['brokerage_city'] ?><!--">--><? //= $account['brokerage_city'] ?><!--</option>-->
    <!--                                     --><?php
    //                                 } else {
    //                                     ?>
    <!--                                     <option>Select a City</option>-->
    <!---->
    <!--                                     --><?php
    //
    //                                 }
    //                                 ?>
    <!--                             </select>-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-2">-->
    <!--                         <div class="form-group">-->
    <!--                             <input type="text" name="brokerage_zipcode" id="brokerage_zipcode" class="form-control"-->
    <!--                                    placeholder="Zip Code" value="-->
    <?php //echo $account['brokerage_zipcode']; ?><!--">-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-12">-->
    <!--                         <div class="form-group">-->
    <!--                             <input type="text" name="brokerage_phone" id="brokerage_phone"-->
    <!--                                    class="form-control format-phone-number" placeholder="Phone Number"-->
    <!--                                    value="-->
    <?php //echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $account['brokerage_phone']); ?><!--">-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <hr class="mt-3">-->
    <!--                     <h5 class="col-sm-12">Real Estate Experience</h5>-->
    <!--                     <div class="col-md-12">-->
    <!--                         <div class="form-group">-->
    <!--                             <input type="number" name="experience" id="experience" class="form-control"-->
    <!--                                    placeholder="First Year Licensed" value="-->
    <?php //echo $account['experience']; ?><!--">-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <h5 class="col-sm-12">Specialization</h5>-->
    <!--                     <div class="col-12">-->
    <!--                         <div class="form-group">-->
    <!---->
    <!--                             <select class="form-control specialization-selection border" id="specialization-selection"-->
    <!--                                     name="specializations[]" multiple="multiple">-->
    <!--                                 --><?php
    //                                 if (isset($specializations) && $specializations !== '') {
    //                                     foreach ($specializations as $key => $val) {
    //                                         ?>
    <!--                                         <option value="--><? //= $val['id'] ?><!--" -->
    <? //= array_search($val['id'], array_column($agentspecializations, 'specialization_id')) !== false ? 'selected' : '' ?><? //= $val['name'] ?><!--</option>-->
    <!--                                         --><?php
    //
    //                                     }
    //                                 }
    //                                 ?>
    <!--                             </select>-->
    <!--                         </div>-->
    <!--                     </div>-->
    <!--                     <h5 class="col-sm-12">Real Estate Specialization</h5>-->
    <!--                     <div class="col-md-12">-->
    <!--                         <div id="estate_specialization"-->
    <!--                              placeholder="Please describe your particular real estate specialization such as waterfront, mountain homes...">-->
    <?php //echo $account['estate_specialization']; ?><!--</div>-->
    <!--                     </div>-->
    <!--                 </div>-->
    <!--                        <hr class="mt-3">-->
    <!--                    </div>-->


    <!--                    <div class="row">-->
    <!--                        <h5 class="col-sm-12">Social Media</h5>-->
    <!--                        <div class="col-md-6">-->
    <!--                            <div class="form-group">-->
    <!--                                <input type="text" name="facebook" id="facebook" class="form-control"-->
    <!--                                       placeholder="Facebook Profile" value="-->
    <?php //echo $account['facebook']; ?><!--">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-6">-->
    <!--                            <div class="form-group">-->
    <!--                                <input type="text" name="linkedin" id="linkedin" class="form-control"-->
    <!--                                       placeholder="LinkedIn Profile" value="-->
    <?php //echo $account['linkedin']; ?><!--">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-6">-->
    <!--                            <div class="form-group">-->
    <!--                                <input type="text" name="twitter" id="twitter" class="form-control"-->
    <!--                                       placeholder="Twitter Profile" value="-->
    <?php //echo $account['twitter']; ?><!--">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-6">-->
    <!--                            <div class="form-group">-->
    <!--                                <input type="text" name="google" id="google" class="form-control"-->
    <!--                                       placeholder="Google Profile" value="-->
    <?php //echo $account['google']; ?><!--">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="col-md-6">-->
    <!--                            <div class="form-group">-->
    <!--                                <input type="text" name="instagram" id="instagram" class="form-control"-->
    <!--                                       placeholder="Instagram Profile" value="-->
    <?php //echo $account['instagram']; ?><!--">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <hr>-->
    <!--                    <div class="row">-->
    <!--                        <h5 class="col-sm-12">Biography</h5>-->
    <!--                        <div class="col-md-12">-->
    <!--                            <div id="bio" placeholder="Please describe your short biography, its important part of introducing yourself to potential clients...">-->
    <?php //echo $account['bio']; ?><!--</div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                </fieldset>-->

    <!--            </div>-->

    <!--        </div>-->
    <!--    </form>-->
</div>


<!--Licenses-->
<div>
    <!--    <div class="card" id="licensespart">-->
    <!--        <div class="card-header header-elements-inline">-->
    <!--            <h3 class="card-title"><span class="icon-co-big orange license"></span> Licenses</h3>-->
    <!--            <div class="header-elements">-->
    <!--                <div class="dropdown d-inline">-->
    <!--                    <a href="#" role="button" id="questiontab-1" data-toggle="dropdown" aria-haspopup="true"-->
    <!--                       aria-expanded="false"><span class="icon-co-big question"></span></a>-->
    <!--                    <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-1"-->
    <!--                         id="questiontab-1">-->
    <!--                        <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel blandit velit, ut accumsan orci.-->
    <!--                            Vestibulum sed rutrum mi. Proin sed dolor turpis. Suspendisse sagittis faucibus eros a sodales.-->
    <!--                            Nulla in tempor magna. Proin efficitur imperdiet dolor eu imperdiet.</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <a class="headerelementlink" id="addlicense" data-toggle="tooltip" data-placement="bottom"-->
    <!--                   title="Add new license"><span class="icon-co-big add"></span></a>-->
    <!--                <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="card-body-second">-->
    <!--            <fieldset>-->
    <!--                <div class="row">-->
    <!--                    <div class="col-md-12">-->
    <!--                        <div id="addnewlicense">-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-12" id="licenselistingpart">-->
    <!--                        <ul class="profile-list">-->
    <!--                            --><?php //if ($licenses) { ?>
    <!--                                --><?php //foreach ($licenses as $license) { ?>
    <!--                                    <li class="profile-list-item">-->
    <!--                                        <div class="row no-gutters">-->
    <!--                                            <div class="col-sm-8">-->
    <!--                                                <p class="titlepart">-->
    <!--                                                    <strong>--><?php //echo(($license['interested'] == 'Both') ? 'Residential & Commercial' : $license['interested']); ?>
    <!--                                                        License for -->
    <?php //echo $license['license_state']; ?><!--</strong></p>-->
    <!--                                                <p class="subtitlepart">Expires-->
    <!--                                                    on -->
    <?php //echo date('m-d-Y', $license['license_expire']); ?><!--</p>-->
    <!--                                            </div>-->
    <!--                                            <div class="col-sm-2 align-middle text-center">-->
    <!--                                                --><?php //echo generate_license_status_pill($license['license_status']); ?>
    <!--                                            </div>-->
    <!--                                            <div class="col-sm-2 align-middle text-right">-->
    <!--                                                <div class="btn-group mt-2 dropleft" data-toggle="tooltip"-->
    <!--                                                     data-placement="left" title="Click for options">-->
    <!--                                                <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"-->
    <!--                                                      class="cardopenmenu"><i class="icon-menu"></i></span>-->
    <!--                                                    <div class="dropdown-menu">-->
    <!--                                                        <button class="dropdown-item" type="button" id="editmylicense"-->
    <!--                                                                data-id="-->
    <?php //echo $license['license_id']; ?><!--">Edit Details-->
    <!--                                                        </button>-->
    <!--                                                        <button class="dropdown-item" type="button" id="deletemylicense"-->
    <!--                                                                data-id="-->
    <?php //echo $license['license_id']; ?><!--">Delete-->
    <!--                                                        </button>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </li>-->
    <!--                                --><?php //} ?>
    <!--                            --><?php //} else { ?>
    <!--                                <li class="list-group-item text-center">Please add your agent license for your account.</li>-->
    <!--                            --><?php //} ?>
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </fieldset>-->
    <!--        </div>-->
    <!---->
    <!--    </div>-->
</div>


<!--Premium Search Query-->
<!--<div class="card" id="">-->
<!--    <div class="card-header header-elements-inline">-->
<!--        <h3 class="card-title">Premium Search Query</h3>-->
<!--        <div class="header-elements">-->
<!--            <div class="dropdown d-inline">-->
<!--                <a href="#" role="button" id="searchQuery-1" data-toggle="dropdown" aria-haspopup="true"-->
<!--                   aria-expanded="false"></a>-->
<!--                <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="searchQuery-1"-->
<!--                     id="searchQuery-1">-->
<!--                </div>-->
<!--            </div>-->
<!--            <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="card-body-second">-->

<!--        <form method="post" id="form1" name="form1">-->
<!--            <div class="row">-->
<!--                <div class="col-12 col-lg-5">-->
<!--                    <div class="form-group">-->
<!--                        <label for="queryType">Select Type:</label>-->
<!--                        <select-->
<!--                                class="form-control"-->
<!--                                id="query_type"-->
<!--                                name="query_type"-->
<!--                                required-->
<!--                        >-->
<!--                            <option value="city">City</option>-->
<!--                            <option value="zipcode">ZipCode</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-12 col-lg-5">-->
<!--                    <div class="form-group">-->
<!--                        <label for="query_value">ZipCode / City Name:</label>-->
<!--                        <input type="text"-->
<!--                               name="query_value"-->
<!--                               required-->
<!--                               class="form-control mt-0"-->
<!--                               id="query_value"-->
<!--                               placeholder="CityName / ZipCode"-->
<!--                        >-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-12 col-lg-2 align-self-center">-->
<!--                    <input type="button" name="send" class="btn btn-primary mt-2 w-100" value="Add Data" id="addRow">-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--        <table id="premiumQueryTable" name="premiumQueryTable" class="table table-bordered">-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <th>ID</th>-->
<!--                <th>Query Type</th>-->
<!--                <th>Query Value</th>-->
<!--                <th>Action</th>-->
<!--            <tr>-->
<!--            </tbody>-->
<!--        </table>-->
<!---->
<!--        <table class="table table-bordered">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>ID</th>-->
<!--                <th>Query Type</th>-->
<!--                <th>Query Value</th>-->
<!--                <th>Action</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody id="showListing">-->
<!---->
<!--            </tbody>-->
<!--        </table>-->
<!---->
<!--        <div class="text-right">-->
<!--            <input type="button" name="save" class="btn btn-primary" value="Save" id="btnSavePremiumQueryData">-->
<!--        </div>-->


<!--    </div>-->
<!--</div>-->

<!--Password Change-->
<!--<form method="POST" class="ajaxform w-100" data-source="passwordajaxurl">-->
<!--    <div class="card">-->
<!--        <div class="card-header header-elements-inline">-->
<!--            <h3 class="card-title"><span class="icon-co-big orange profile"></span> Password Change</h3>-->
<!--            <div class="header-elements">-->
<!--                <div class="dropdown d-inline">-->
<!--                    <a href="#" role="button" id="questiontab-1" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"><span class="icon-co-big question"></span></a>-->
<!--                    <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-1"-->
<!--                         id="questiontab-1">-->
<!--                        <p>Password and confirm password are not mandatory fields for updating your profile details.-->
<!--                            Please only use when you want to update/change your account password.</p>-->
<!--                    </div>-->
<!--                    <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-body-second">-->
<!--            <fieldset>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="alert alert-info">Password and confirm password are not mandatory fields for-->
<!--                            updating your profile details. Please only use when you want to update/change your account-->
<!--                            password.-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="form-group">-->
<!--                            <input type="password" class="form-control" name="password" id="password"-->
<!--                                   placeholder="Password"">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="form-group">-->
<!--                            <input type="password" class="form-control" name="passwordagain" id="passwordagain"-->
<!--                                   placeholder="Repeat Password">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </fieldset>-->
<!---->
<!--        </div>-->
<!--        <div class="card-footer text-right">-->
<!--            <button type="submit" class="button-orange">Change Password</button>-->
<!--        </div>-->
<!--        <div class="card-footer text-left dark">-->
<!--            <a href="#" class="deactivateme" data-id="--><?php //echo $account['agent_id']; ?><!--"><i-->
<!--                        class="icon-cancel-circle2 mr-2"></i>Remove Account</a></button>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->


<!--Credit Cards-->
<?php //if ($account['stripe_id']) { ?>
<!--    <div class="card" id="paymentpart">-->
<!--        <div class="card-header header-elements-inline">-->
<!--            <h3 class="card-title"><span class="icon-co-big orange ccard"></span> Credit Cards</h3>-->
<!--            <div class="header-elements">-->
<!--                <div class="dropdown d-inline">-->
<!--                    <a href="#" role="button" id="questiontab-1" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"><span class="icon-co-big question"></span></a>-->
<!--                    <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-1"-->
<!--                         id="questiontab-1">-->
<!--                        <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel blandit velit, ut accumsan-->
<!--                            orci. Vestibulum sed rutrum mi. Proin sed dolor turpis. Suspendisse sagittis faucibus eros a-->
<!--                            sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor eu imperdiet.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <a class="headerelementlink" id="addcart" data-toggle="tooltip" data-placement="bottom"-->
<!--                   title="Add new credit card"><span class="icon-co-big add"></span></a>-->
<!--                <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-body-second">-->
<!--            <fieldset>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <div id="cardpart">-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-12" id="cardlistingpart">-->
<!--                        <ul class="profile-list">-->
<!--                            --><?php //if ($credit_cards) { ?>
<!--                                --><?php //foreach ($credit_cards as $credit_card) { ?>
<!--                                    <li class="profile-list-item">-->
<!--                                        <div class="row no-gutters">-->
<!--                                            <div class="col-sm-9">-->
<!--                                                <div class="float-left mr-2">--><?php //echo card_icons($credit_card['brand']); ?><!--</div>-->
<!--                                                <p class="titlepart">-->
<!--                                                    <strong>--><?php //echo ucfirst($credit_card['brand']); ?>
<!--                                                        **** --><?php //echo $credit_card['last_digit']; ?><!--</strong></p>-->
<!--                                                <p class="subtitlepart">Expires-->
<!--                                                    on --><?php //echo date('M Y', $credit_card['expire_date']); ?><!--</p>-->
<!--                                            </div>-->
<!--                                            <div class="col-sm-3 align-middle text-right">-->
<!--                                                <div class="btn-group dropleft --><?php //echo(($credit_card['payment_id'] == $account['payment_id']) ? 'invisible' : ''); ?><!--"-->
<!--                                                     data-toggle="tooltip" data-placement="left"-->
<!--                                                     title="Click for options">-->
<!--                                                    <span data-toggle="dropdown" aria-haspopup="true"-->
<!--                                                          aria-expanded="false" class="cardopenmenu"><i-->
<!--                                                                class="icon-menu"></i></span>-->
<!--                                                    <div class="dropdown-menu">-->
<!--                                                        <button class="dropdown-item" type="button" id="deletemycard"-->
<!--                                                                data-id="--><?php //echo $credit_card['card_id']; ?><!--">Delete-->
<!--                                                        </button>-->
<!--                                                        <button class="dropdown-item" type="button" id="setmycard"-->
<!--                                                                data-id="--><?php //echo $credit_card['card_id']; ?><!--">Set As-->
<!--                                                            Default-->
<!--                                                        </button>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                            --><?php //} else { ?>
<!--                                <li class="list-group-item text-center">Please add your credit card to activate your-->
<!--                                    payment system.-->
<!--                                </li>-->
<!--                            --><?php //} ?>
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </fieldset>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<?php //} ?>


<!--Payment-->
<?php //if ($invoices) { ?>
<!--    <div class="card" id="invoicepart">-->
<!--        <div class="card-header header-elements-inline">-->
<!--            <h3 class="card-title"><span class="icon-co-big orange finance"></span> Payments</h3>-->
<!--            <div class="header-elements">-->
<!--                <div class="dropdown d-inline">-->
<!--                    <a href="#" role="button" id="questiontab-1" data-toggle="dropdown" aria-haspopup="true"-->
<!--                       aria-expanded="false"><span class="icon-co-big question"></span></a>-->
<!--                    <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-1"-->
<!--                         id="questiontab-1">-->
<!--                        <p>Vivamus in tellus hendrerit, euismod erat in, tempus mi. Sed vel blandit velit, ut accumsan-->
<!--                            orci. Vestibulum sed rutrum mi. Proin sed dolor turpis. Suspendisse sagittis faucibus eros a-->
<!--                            sodales. Nulla in tempor magna. Proin efficitur imperdiet dolor eu imperdiet.</p>-->
<!--                    </div>-->
<!--                    <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-body-second">-->
<!--            <fieldset>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <ul class="profile-list expandable" id="invoicelistingpart">-->
<!--                            --><?php //if ($invoices) { ?>
<!--                                --><?php //foreach ($invoices as $invoice) { ?>
<!--                                    <li class="profile-list-item">-->
<!--                                        --><?php //if ($invoice['payment_type'] == 'Free Trial') { ?>
<!--                                            <div class="trialmessage pl-3 text-center" data-toggle="collapse"-->
<!--                                                 href="#invoice---><?php //echo $invoice['invoice_id']; ?><!--" role="button"-->
<!--                                                 aria-expanded="false"-->
<!--                                                 aria-controls="invoice---><?php //echo $invoice['invoice_id']; ?><!--">Free-->
<!--                                                Trial Period-->
<!--                                                between --><?php //echo date('m/d/Y h:i A', $account['free_starts']); ?>
<!--                                                and --><?php //echo date('m/d/Y h:i A', $account['free_ends']); ?><!--.-->
<!--                                            </div>-->
<!--                                        --><?php //} else { ?>
<!--                                            <div class="row pl-3 cursor-pointer collapsed" data-toggle="collapse"-->
<!--                                                 href="#invoice---><?php //echo $invoice['invoice_id']; ?><!--" role="button"-->
<!--                                                 aria-expanded="false"-->
<!--                                                 aria-controls="invoice---><?php //echo $invoice['invoice_id']; ?><!--">-->
<!--                                                <div class="col-sm-9 align-middle">-->
<!--                                                    <p class="titlepart">--><?php //echo $invoice['payment_desc']; ?><!--</p>-->
<!--                                                </div>-->
<!--                                                <div class="col-sm-1 align-middle">-->
<!--                                                    <p class="mb-0 text-nowrap">-->
<!--                                                        $--><?php //echo $invoice['final_amount']; ?><!--</p>-->
<!--                                                </div>-->
<!--                                                <div class="col-sm-2 align-middle text-right">-->
<!--                                                    --><?php //echo generate_invoice_status_pill($invoice['invoice_status']); ?>
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="col-sm-12 multi-collapse collapse invoiceexplain"-->
<!--                                                 id="invoice---><?php //echo $invoice['invoice_id']; ?><!--">-->
<!--                                                --><?php
//                                                switch ($invoice['invoice_status']) {
//                                                    case 'Completed':
//                                                        echo 'Payment completed on ' . date('m/d/Y h:i A', $invoice['payment_time']) . (($invoice['discount_amount']) ? '<br><b>' . $invoice['coupon_code'] . '</b> coupon used for this payment and saved $' . $invoice['discount_amount'] . '. Payment amount dropped from $' . $invoice['real_amount'] . ' to $' . $invoice['final_amount'] . '.' : '');
//                                                        break;
//                                                    case 'Refund':
//                                                        echo 'Payment completed on ' . date('m/d/Y h:i A', $invoice['payment_time']) . ' and refund on ' . date('m/d/Y h:i A', $invoice['refund_date']) . '.';
//                                                        break;
//                                                    case 'Failed':
//                                                        echo 'Payment failed ' . $invoice['try_amount'] . ' times and will be processed again on ' . date('m/d/Y h:i A', $invoice['try_time']);
//                                                        break;
//                                                    default:
//                                                        echo 'Payment due date is ' . date('m/d/Y h:i A', $invoice['try_time']);
//                                                        break;
//                                                }
//                                                ?>
<!--                                            </div>-->
<!--                                        --><?php //} ?>
<!--                                    </li>-->
<!--                                --><?php //} ?>
<!--                            --><?php //} else { ?>
<!--                                <li class="list-group-item text-center">Please add your credit card to activate your-->
<!--                                    payment system.-->
<!--                                </li>-->
<!--                            --><?php //} ?>
<!--                        </ul>-->
<!--                    </div>-->
<!--                    --><?php //if ($account['membership_due']) { ?>
<!--
	<div class="col-md-12"><div class="approvalmessage mb-1">Next payment period of your membership is on -->
<?php //echo date('m/d/Y h:i A', $account['membership_due']); ?><!--<div><div>-->
<!--                    --><?php //} ?>
<!--                </div>-->
<!--            </fieldset>-->
<!--        </div>-->
<!--    </div>-->
<?php //} ?>




<div id="paymentModal" role="dialog" aria-modal="true" class="modal fade show shadow-lg border-0">
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

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:30px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h1 class="font-weight-bold text-warning text-center mb-3">Premium Listing Price</h1>
                        <div class="panel panel-default credit-card-box">
                            <div class=" my-4 d-flex justify-content-center align-items-center">
                                <h3>Total Premium Listing price:</h3>
                                <h1 class="font-weight-bold ml-2 setprice">$599.00</h1>
                            </div>

                            <div class="panel-body">
                                <div class="alert alert-success" role="alert" id="payment-notification" style="display:none;">
                                    This is a success alert—check it out!
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="justify-content-center text-left mt-2">
                                            
                                    </div>
                                </div>

                                <hr>
                                <form method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?= $this->config->item('stripe_key') ?>" id="payment-form">
                                      <div id="oldForm">
                                        <div class="form-row row">
                                            <div class="col-lg-12 form-group">
                                                <label class="control-label">Select a card</label>
                                                <select id="selectedCard" name="selectedCard" class="form-control">
                                                    <option value="">Select a card</option>
                                                    <?php


                                                    if(isset($cardsList) && !empty($cardsList))
                                                    {
                                                        foreach ($cardsList as $key => $value)
                                                        {
                                                            ?>
                                                            <option value="<?= (isset($value["card"]) && !empty($value["card"])) ? $value["card"] : $value['intent'] ?>"><?=$value['brand'] ."  ****" . $value['last_digit']?></option>

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
                                                <input type="text" id="cardholder-name" name="cardholder-name" class="form-control" placeholder="Jane Doe" required/>
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="col-lg-12 form-group required">
                                                <label class="control-label">Phone number</label>
                                                <input autocomplete="off" type="text" id="cardholder-phone" name="cardholder-phone" class="form-control card-number" placeholder="123-789-02354" maxlength="20" type="text" required>
                                            </div>
                                        </div>

                                        <div id="card-element">
                                        </div>

                                        <div id="card-errors" role="alert"></div>

                                        <div class="form-row row">
                                            <div class="col-md-12 error form-group hide">
                                                <div class="alert-danger alert">Please correct the errors and try
                                                    again.</div>
                                            </div>
                                        </div>
                                    </div>

                                </form>


                                <div class="row my-3">
                                    <div class="col-sm-12">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-lg btn-block" id="set-price" data-title="Standard" plan-price="40.00" list-features="specialization,premium_spot" totaldsicount="19" plan-id="50" featuresarray="43,45">$ Pay Now</a>
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
