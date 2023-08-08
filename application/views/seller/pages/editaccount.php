<div class="card shadow-sm my-0 mb-3 mb-lg-2" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;">
    <div class="card-body px-2 px-lg-0 py-3 py-lg-0 mx-1 mt-1">
        <ul class="nav edit-profile-dashbaord mt-0 border-bottom-0">

            <li class="nav-item">
                <a class="nav-link scroll-nav-edit-account px-3 border-0 active"
                   href="#personalInformationTab">Personal Information
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link scroll-nav-edit-account px-3 border-0"
                   href="#locationInformation">Location Information</a>
            </li>

            <li class="nav-item">
                <a class="nav-link scroll-nav-edit-account px-3 border-0"
                   href="#passwordChange"
                >Password Change</a>
            </li>

        </ul>
    </div>
</div>

<div class="card shadow-sm my-0 mb-3 mb-lg-2" style="border-top-left-radius: 0;border-top-right-radius: 0;">
    <div class="card-body px-2 px-lg-0 py-3 m-1">
        <div id="personalInformationTab">
            <!--  Personal Information-->
            <form method="POST" class="ajaxform w-100" data-source="formajaxurl">
                <div class="card shadow-none border position-relative mb-5 py-3">
                    <h6 class="position-absolute heading-top-align">Personal &amp; Location Information</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">First Name
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="text" name="first_name" id="first_name" placeholder="Enter Your First Name"
                                                   value="<?php echo $account['first_name']; ?>"/>
                                            <img src="<?php echo base_url('images/user.svg'); ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-6">
                                <fieldset class="scheduler-border mb-3">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Last Name
                                    </legend>
                                    <div class="control-group">
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name"
                                                   value="<?php echo $account['last_name']; ?>"/>
                                            <img src="<?php echo base_url('images/user.svg'); ?>">
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
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
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
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="text"
                                                   name="email" id="email"
                                                   placeholder="Enter Your Email Address"
                                                   value="<?php echo $account['email']; ?>"
                                            />
                                            <img src="<?php echo base_url('images/message_v.svg'); ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="" id="locationInformation">
                    <!--  Location Information-->
                    <div class="card shadow-none border position-relative py-3">
                        <h6 class="position-absolute heading-top-align">Location Information</h6>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <fieldset class="scheduler-border mb-3">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Address Line
                                        </legend>
                                        <div class="control-group">
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text"
                                                       placeholder="Enter Your Address Line"
                                                       name="address" id="address" class="setmap"
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
                                                       name="unit" id="unit"
                                                       placeholder="Enter Unit"
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
                                                       placeholder="Enter Zipcode"
                                                       value="<?php echo $account['zipcode']; ?>"
                                                />
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-sm button-orange rounded-5 w-165">Update Information
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



            </form>

            <div id="passwordChange">
                <!--  Password Change-->
                <div class="card shadow-none border position-relative py-3">
                    <h6 class="position-absolute heading-top-align">Password Change</h6>
                    <div class="card-body">

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
                                                class="icon-cancel-circle2 mr-2"></i>Remove Account</a>
                                </div>
                                <div>
                                    <button type="submit" class="button-orange w-100 rounded-5">Change Password</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!--<form method="POST" class="ajaxform w-100" data-source="formajaxurl">-->
<!--    <div class="card">-->
<!--        <div class="card-header header-elements-inline">-->
<!--            <h3 class="card-title"><span class="icon-co-big orange profile"></span> Profile</h3>-->
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
<!--                           value="Yes" --><?php //echo(($account['notifications'] == 'Yes') ? 'checked' : '');; ?>
<!--                    <span class="switchslider round"></span>-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-body">-->
<!--            <fieldset>-->
<!--                <div class="row">-->
<!--                    <h5 class="col-sm-12">Personal Information</h5>-->
<!--                    <div class="col-md-6">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" class="form-control" name="first_name" id="first_name"-->
<!--                                   placeholder="First Name" value="--><?php //echo $account['first_name']; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-6">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" class="form-control" name="last_name" id="last_name"-->
<!--                                   placeholder="Last Name" value="--><?php //echo $account['last_name']; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-6">-->
<!--                        <div class="form-group">-->
<!--                            <input type="tel" class="form-control format-phone-number" name="phone"-->
<!--                                   placeholder="Phone Number" id="phone"-->
<!--                                   value="--><?php //echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $account['phone']); ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-6">-->
<!--                        <div class="form-group">-->
<!--                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address"-->
<!--                                   value="--><?php //echo $account['email']; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <hr>-->
<!--                <div class="row">-->
<!--                    <h5 class="col-sm-12">Location Information</h5>-->
<!--                    <div class="col-md-9">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" name="address" id="address" class="form-control setmap"-->
<!--                                   placeholder="Address Line" value="--><?php //echo $account['address']; ?><!--">-->
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
<!--                            <input type="text" name="state" id="state" class="form-control" placeholder="State"-->
<!--                                   value="--><?php //echo $account['state']; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-md-5">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" name="city" id="city" class="form-control" placeholder="City"-->
<!--                                   value="--><?php //echo $account['city']; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-md-2">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zip Code"-->
<!--                                   value="--><?php //echo $account['zipcode']; ?><!--">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </fieldset>-->
<!---->
<!--        </div>-->
<!--        <div class="card-footer text-right">-->
<!--            <button type="submit" class="button-orange">Update Profile</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->
<!---->
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
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="card-body">-->
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
<!--            <a href="#" class="deactivateme" data-id="--><?php //echo $account['seller_id']; ?><!--"><i-->
<!--                        class="icon-cancel-circle2 mr-2"></i>Remove Account</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->