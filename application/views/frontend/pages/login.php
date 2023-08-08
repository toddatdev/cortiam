
<style>
    fieldset.scheduler-border {
        border: 1px solid #d6d6d6e6 !important;
        padding: 0 1.4em 0.7em 1.4em !important;
        margin: 22px 0 22px 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
        border-radius: 4px;
    }

    legend.scheduler-border {
        font-size: 1em !important;
        font-weight: bold !important;
        text-align: left !important;
    }
    legend.scheduler-border {
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
        color: #626262;
        font-weight: 100 !important;
    }
    ::placeholder {
        color: #999999 !important;
    }

    fieldset input{
        width: 95% !important;
        border: none !important;
        outline: none;
    }
    /*fieldset input[type="password"]{*/
    /*    width: 95% !important;*/
    /*    border: 0;*/
    /*    outline: none;*/
    /*}*/
    @media only screen and (max-width:991px) {
        fieldset input{
            width: 93% !important;
        }
    }
    @media only screen and (max-width:430px) {
        fieldset input{
            width: 88% !important;
        }
    }
    /*  checkbox css styling  */
    .check-form .form-group {
        display: block;
        margin-bottom: 15px;
    }

    .check-form .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .check-form .form-group label {
        position: relative;
        cursor: pointer;
    }

    .check-form .form-group label:before {
        content:'';
        -webkit-appearance: none;
        background-color: transparent;
        border: 2px solid #00c48d;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 8px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
        border-radius: 2px;
    }

    .check-form .form-group input:checked + label:after {
        content: '';
        display: block;
        position: absolute;
        top: 5px;
        left: 7px;
        width: 5px;
        height: 12px;
        border: solid #00c48d;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    #user_type.user_type_child{
        background-color: #00c48d!important;
    }

</style>
<body>
<!-- Page content -->
<div class="page-content bg-white">
    <!-- Main content -->
    <div class="container-fluid content-wrapper">

        <div class="row content align-items-center p-0">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <!-- Login form -->
                <form class="login-form" id="logincard">
                    <div class="card login-page-my border-0 shadow-none">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div id="errorwrap">
                                </div>
                                <h3 class="mb-0 text-dark-blue fs-27">Account Login</h3>
                                <span class="d-block text-secondary">Your Credentials</span>
                            </div>

                            <!--							<div class="form-group form-group-feedback form-group-feedback-left">-->
                            <!--								<input class="form-control" type="email" placeholder="Email" name="lindentity" autocomplete="off" required value="">-->
                            <!--								<div class="form-control-feedback">-->
                            <!--									<i class="icon-user text-muted"></i>-->
                            <!--								</div>-->
                            <!--							</div>-->
                            <!--            fieldset             -->
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Username</legend>
                                <div class="control-group">
                                    <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                    <div class="controls bootstrap-timepicker d-flex">
                                        <input type="email" class="form-control" id="startTime" name="lindentity" placeholder="Email" autocomplete="off" required value  />
                                        <!--                                            <i class="icon-lock2 "></i>-->
                                        <img src="<?php echo base_url('images/user.svg'); ?>">
                                    </div>
                                </div>
                            </fieldset>
                            <!--      fieldset ends                      -->

                            <!--							<div class="form-group form-group-feedback form-group-feedback-left">-->
                            <!--								<input class="form-control" type="password" placeholder="Password" name="lpassword" required value="">-->
                            <!--								<div class="form-control-feedback">-->
                            <!--									<i class="icon-lock2 text-muted"></i>-->
                            <!--								</div>-->
                            <!--							</div>-->
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Password</legend>
                                <div class="control-group">
                                    <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                    <div class="controls bootstrap-timepicker d-flex">
                                        <input type="password" class="form-control"  name="lpassword" placeholder="Password" id="createpassword" required value />
                                        <img src="<?php echo base_url('images/confirm_pass.svg'); ?>" class="create-password">
                                    </div>
                                </div>
                            </fieldset>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <select name="user_type" class="form-control" id="user_type"  >
                                                <option value="">Interested in</option>
                                                <option  value="Seller">An agent to sell a home</option>
                                                <option  value="Buyer">An agent to buy a home</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6" style="margin:auto;">
                                        <div class="text-right">
                                            <a href="#"  id="triggerforgot" class="text-secondary">Forgot password?<span class="pl-1 text-dark-blue fw-900 text-underline">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          

                            <div class="form-group mt-3">
                                <button type="submit"  id="logmein" class="btn btn-primary btn-block fw-800">Login</button>
                            </div>
                            <!--                                <div class="form-group check-form">-->
                            <!--                                    <div class="form-check">-->
                            <!--                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>-->
                            <!--                                        <label class="form-check-label text-secondary" for="invalidCheck2" style="padding-top: 2px;">-->
                            <!--                                            I accept <a href="#" class="text-dark-blue fw-900">Terms & Conditions</a>  and <a href="#" class="text-dark-blue fw-900"> Cookie Policy </a>-->
                            <!--                                        </label>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
<!--                            <div class="form-row check-form">-->
<!--                                <div class="form-group text-left ">-->
<!--                                    <div class="form-check pl-1">-->
<!--                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required="">-->
<!--                                        <label class="form-check-label text-secondary fs-12" for="invalidCheck2" style="padding-top: 2px;">-->
<!--                                            I accept <a href="#" class="text-dark-blue fw-900">Terms & Conditions</a>  and <a href="#" class="text-dark-blue fw-900"> Cookie Policy </a>                                 </label>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                            <!--							<hr>-->

                            <span class="form-text text-center text-muted content-divider pt-2">Don’t have an account? <a href="<?php echo base_url('sign-up');?>" class="text-underline text-primary-green fw-900"> Create account</a></span>
                        </div>
                    </div>
                </form>
                <!-- /login form -->

                <!-- Forgot form -->
                <form class="forgot-form d-none mb-5" id="forgotcard" style="margin-top: 6.5rem;">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-spinner11 icon-2x text-warning border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Password recovery</h5>
                                <span class="d-block text-muted">Please enter your email to recieve instructions in email</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Email</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input class="form-control mr-2 pl-0" type="email" placeholder="Enter email" name="remail" id="kt_email" autocomplete="off" required >
                                            <img src="<?php echo base_url('images/message_v.svg'); ?>">
                                        </div>
                                    </div>
                                </fieldset>
<!--                                <div class="form-control-feedback">-->
<!--                                    <img src="--><?php //echo base_url('images/message_v.svg'); ?><!--">-->
<!--                                </div>-->
                            </div>

                            <div class="form-group">
                                <button type="submit" id="forgotmypass" class="btn btn-primary btn-block">Request <i class="icon-circle-right2 ml-2"></i></button>
                            </div>

                            <div class="text-center">
                                <a href="#"  id="triggerlogin">Cancel</a>
                            </div>

                            <hr>

                            <span class="form-text text-center text-muted content-divider">By continuing, you're confirming that you've read our <a href="<?php echo base_url('terms-of-use');?>" target="_blank">Terms &amp; Conditions</a> and <a href="<?php echo base_url('privacy-policy');?>" target="_blank">Cookie Policy</a></span>
                        </div>
                    </div>

                </form>
                <!-- /forgot form -->
            </div>
            <div class="col-md-6 text-center position-relative h-100 d-flex justify-content-center col-display bg-image-blue">
                <div class="img-fluid position-absolute bottom-0">
                    <img class="mobile-img img-fluid" src="<?php echo base_url('images/mobile.svg'); ?>">
                </div>
            </div>
        </div>
    </div>
    <!-- /main content-->

</div>
<!-- /page content -->
