<style>
    fieldset.scheduler-border {
        border: 1px solid #d6d6d6e6 !important;
        padding: 0 1.4em 0.7em 1.4em !important;
        /*margin: 10px 0 10px 0 !important;*/
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        border-radius: 4px;
    }

    legend.scheduler-border {
        font-size: 0.8em !important;
        font-weight: bold !important;
        text-align: left !important;
    }

    legend.scheduler-border {
        width: inherit; /* Or auto */
        padding: 0 10px; /* To give a bit of padding on the left and right */
        border-bottom: none;
        color: #626262;
        font-weight: 100 !important;
    }
    .headline-sub-text{
        color: #00C48D;
    }

    fieldset input {
        width: 95% !important;
        border: none !important;
        outline: none;
    }

    .select2-selection {
        border: 0px !important;
    }
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
        padding: 7px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 13px;
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
    .form-shadow{
        border-radius: 20px;
        box-shadow: 0px 11px 24px rgba(119, 119, 119, 0.15);
    }
    @media only screen and (min-width:1200px){
        .agentsignup.jumbotron{
            padding: 9.6rem 2rem 7.2em 2rem;
        }
    }

    @media only screen and (min-width: 768px){
        body{
            margin-top: 40px !important;
        }

    }
    @media only screen and (max-width: 768px){
        .check-form .form-group input:checked + label:after{
            top: 2px !important;
        }
    }
    @media only screen and (max-width: 576px){
        body{
            margin-top: 53px !important;
        }
    }
</style>

<main role="main">
    <div class="findagent jumbotron jumbotron-fluid mb-0 position-relative">
        <div class="container">
            <h1 class="headline campton-bold mb-0">Real Estate Agent</h1><br>
            <h5 class="headline-sub-text text-uppercase">You're one step closer to selling on your terms! </h5>
        </div>
    </div>
    <div class="signup-content text-center">
        <div class="container">
            <div class="row px-3 px-md-5">

                <div class="col-md-11 col-lg-10 mx-auto">
                    <div id="response"></div>
                    <form method="POST" id="agentSignupform" class="signupform w-100 form-shadow p-lr py-4 rounded-sm">
                        <div class="col-md-12 mx-auto">
                            <h3 class="text-dark-blue">AGENT SIGN UP</h3>
                            <p class="mb-3">You are one step closer to meeting more customers. Fill out this form to create your
                                secure account.</p>
                        </div>
                        <div class="form-group">
                            <!--					    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">-->
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3 mb-md-2">
                                    <fieldset class="scheduler-border fname">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">First Name</legend>
                                        <div class="control-group">
                                            <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text" class="form-control" name="first_name"
                                                       id="first_name" placeholder="First Name">
                                                <!--                                            <i class="icon-lock2 "></i>-->
                                                <img src="<?php echo base_url('images/user.svg'); ?>">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-6 mb-3 mb-md-1">
                                    <!--                               <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">-->
                                    <fieldset class="scheduler-border l-name">
                                        <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Last Name</legend>
                                        <div class="control-group">
                                            <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                            <div class="controls bootstrap-timepicker d-flex">
                                                <input type="text" class="form-control" name="last_name" id="last_name"
                                                       placeholder="Last Name">
                                                <!--                                            <i class="icon-lock2 "></i>-->
                                                <img src="<?php echo base_url('images/user.svg'); ?>">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <!--					    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">-->
                                <fieldset class="scheduler-border email-address">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Email Address</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="Email Address">
                                            <img src="<?php echo base_url('images/message_v.svg'); ?>">
                                        </div>
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!--					    <input type="tel" class="form-control format-phone-number" name="phone" id="phone" placeholder="Phone Number">-->
                                <fieldset class="scheduler-border phone-nmbr">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Phone Number</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="tel" class="form-control format-phone-number" name="phone"
                                                   id="phone" placeholder="Phone Number">
                                            <img src="<?php echo base_url('images/phone_v.svg'); ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group text-left col-md-6 danger-border" id="statecontainer">
                                <!--							<input type="text" name="state" id="state" class="form-control" placeholder="State">-->
                                <fieldset class="scheduler-border state">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">State</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text" name="state" id="state" class="form-control"
                                                   placeholder="State">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group text-left col-md-6 danger-border" id="citycontainer">
                                <!--                                <input type="text" name="city" id="city" class="form-control" placeholder="City">-->
                                <fieldset class="scheduler-border city">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">City</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex">
                                            <input type="text" name="city" id="city" class="form-control"
                                                   placeholder="City">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!--					    <input type="password" class="form-control" name="password" id="password" placeholder="Create Password">-->
                                <fieldset class="scheduler-border create-pass">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Create Password</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="password" class="form-control" name="password" id="createpassword"
                                                   placeholder="Create Password">
                                            <img src="<?php echo base_url('images/confirm_pass.svg'); ?>" class="create-password">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!--					    <input type="password" class="form-control" name="passwordagain" id="passwordagain" placeholder="Repeat Password">-->
                                <fieldset class="scheduler-border confirm-pass">
                                    <legend class="scheduler-border mb-0 pb-0 border-bottom-0">Confirm Password</legend>
                                    <div class="control-group">
                                        <!--                                    <label class="control-label input-label" for="startTime">Start :</label>-->
                                        <div class="controls bootstrap-timepicker d-flex justify-content-between">
                                            <input type="password" class="form-control" name="passwordagain"
                                                   id="passwordagain" placeholder="Repeat Password">
                                            <img src="<?php echo base_url('images/confirm_pass.svg'); ?>" class="confirm-password">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-row check-form termsandcondition">
                            <div class="form-group text-left">
                                <div class="form-check pl-0 ml-1">
                                    <input class="form-check-input" type="checkbox" id="invalidSignerCheck" name="invalidSignerCheck" value="1">
                                    <label class="form-check-label text-secondary fs-12 d-flex align-items-center justify-content-center" for="invalidSignerCheck">
                                        I accept <a href="https://cortiam.devdimensions.com/terms-of-use" class="text-dark-blue fw-900 text-underline ml-1">Terms and Conditions</a>                                 </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="button-orange w-100 rounded-0" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
