<style>
    .card-body-second {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .one {
        border: 0px;
        border-radius: 5px;
        background: #002c77;
        padding: 0px;
        overflow: hidden;
        width: 18rem;
        padding: 1rem;
        color: #ffffff;
        font-size: .9rem;
        margin: 0px;
    }

    .error {
        color: #f44336;
    }
</style>

<input type="hidden" id="getSettingValue" name="getSettingValue" value="<?= $getSettingValue ?>"/>
<div class="card shadow-sm my-0 mb-3 mb-lg-2">
    <div class="card-body-second px-2 px-lg-0 py-3 m-1">
        <div id="premiumSearchQuery">
            <!--  Premium Search Query-->
            <div class="card shadow-none border position-relative py-3">
                <h6 class="position-absolute heading-top-align">Premium Placement</h6>

                <div class="card-body-second">

                    <div class="col-sm12">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="row">
                                    <h5 class="ml-2">
                                        Buy Premium place to get featured on the top of the search results
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-right mb-3">

                                    <a href="javascript:void(0);" id="addNewPremiumListQuery" class="btn btn-sm button-orange">
                                        Get Started
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewPremiumListQueryModal"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Premium Placement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">


                                    <form method="post" id="bundleForm" name="bundleForm">
                                        <div class="row">
                                            <input type="hidden" name="order_id" id="order_id" value=""/>

                                            <!--                                            <input type="text" id="remainingDays" name="remainingDays">-->

                                            <div class="col-12" id="dateRange">
                                                <div class="form-group">
                                                    <label for="" class="mb-0">Select a Choice</label>
                                                    <select class="form-control" id="chooseOption"
                                                            name="type">
                                                        <option></option>
                                                        <option value="customize">Choose your date range</option>
                                                        <option value="bundle">Bundles</option>
                                                    </select>
                                                    <span class="error" id="optionError" style="display: none;">Please select an option</span>
                                                </div>
                                            </div>

                                            <div class="col-12 customize-tab-date-range " id="customize-tab-date-range">
                                                <div class="form-group">
                                                    <label for="query_value_state" class="mb-0">Select Date
                                                        Range</label>
                                                    <input type="text" class="form-control date-time"
                                                           id="customize-date-time" required
                                                           name="date_range">
                                                </div>
                                            </div>


                                            <div class="col-12 bundle-tab" style="display: none" id="bundle-tab">
                                                <div class="form-group">

                                                    <label for="" class="mb-0">Select a Bundle</label>
                                                    <select name="bundle_id" required id="selectedBundle"
                                                            class="form-control">
                                                        <option></option>
                                                        <?php

                                                        if (isset($state_bundle_results) && !empty($state_bundle_results)) {
                                                            foreach ($state_bundle_results as $result) {
                                                                ?>

                                                                <option style="padding: 10px 0 !important;"
                                                                        value="<?= $result['id'] ?>"
                                                                        data-val="<?= $result['state_id'] ?>"
                                                                        data-days="<?= $result['durattion_days'] ?>"><?= $result['title'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                                    <span class="error" id="bundleError" style="display: none;">Please select a bundle</span>

                                                </div>


                                                <div class="form-group">
                                                    <label for="query_value_state" class="mb-0">Select Date
                                                        Range</label>
                                                    <input type="text" class="form-control date-time"
                                                           id="bundle-date-time" required
                                                           name="date_range2">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="row" id="">
                                            <div class="col-12 customize-tab-state" id="customize-tab-state">
                                                <div class="form-group">
                                                    <label for="" class="mb-0">Select available State</label>
                                                    <select name="state_id" id="licenseState" required
                                                            class="form-control">
                                                        <option></option>
                                                        <?php
                                                        foreach ($state_results as $result) {
                                                            ?>
                                                            <option value="<?= $result['state_id'] ?>"><?= $result['state'] ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                    <span class="error" id="licenseError" style="display: none;">Please select a state</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="query_value" class="mb-0">Select City</label>
                                                    <select
                                                            id="premium-listing-cities"
                                                            name="city_id[]"
                                                            class="form-control premium-listing-cities"
                                                            multiple
                                                    >
                                                    </select>

                                                    <span class="error" id="cityError" style="display: none;">Please select a city</span>

                                                </div>
                                            </div>


                                            <div class="col-12 align-self-end">
                                                <div class="form-group">
                                                    <a href="javascript:void(0);" onclick="return false;"
                                                       class="btn btn-primary w-100 savePremiumPackage"
                                                       id="savePremiumPackage">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="addNewSearchQuery">
                        <div class=""

                        <!--                                <form method="post" id="form1" name="form1">-->
                        <!--                                    <div class="row">-->
                        <!--                                        <div class="col-12 col-lg-3">-->
                        <!--                                            <div class="form-group">-->
                        <!--                                                <label for="queryType">Select Type:</label>-->
                        <!--                                                <select-->
                        <!--                                                        class="form-control"-->
                        <!--                                                        id="query_type"-->
                        <!--                                                        name="query_type"-->
                        <!--                                                        required-->
                        <!--                                                >-->
                        <!--                                                    <option value="city">City</option>-->
                        <!--                                                    <option value="zipcode">Zipcode</option>-->
                        <!--                                                </select>-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!---->
                        <!--                                        <div class="col-12 col-lg-3 cities">-->
                        <!--                                            <div class="form-group">-->
                        <!--                                                <label for="query_value_state" class="mb-0">Select State</label>-->
                        <!--                                                <select name="query_value_state" id="query_value_state" class="form-control query_value_state">-->
                        <!--                                                    <option value="select_state">Select State</option>-->
                        <!--                                                --><?php
                        //                                                    foreach($state_results as $result)
                        //                                                    {
                        //                                                ?>
                        <!--                                                        <option value="-->
                        <? //= $result['state_id']?><!--">--><? //= $result['state'] ?><!--</option>-->
                        <!--                                                --><?php
                        //                                                    }
                        //                                                ?>
                        <!---->
                        <!--                                                </select>-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!---->
                        <!--                                        <div class="col-12 col-lg-3 cities">-->
                        <!--                                            <div class="form-group">-->
                        <!--                                                <label for="query_value" class="mb-0">Select City</label>-->
                        <!--                                                <select name="query_value" id="query_value_city" class="form-control query-value-city">-->
                        <!--                                                    <option value="select_city">Select City</option>-->
                        <!--                                                </select>-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!---->
                        <!---->
                        <!--                                        <div class="col-12 col-lg-3 zipcodes">-->
                        <!--                                            <div class="form-group">-->
                        <!--                                                <label for="query_value">Zipcode</label>-->
                        <!--                                                <input type="text"-->
                        <!--                                                       name="query_value"-->
                        <!--                                                       required-->
                        <!--                                                       class="form-control mt-0"-->
                        <!--                                                       id="query_value_zipcode"-->
                        <!--                                                >-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!--                                        <div class="col-12 col-lg-2 align-self-center">-->
                        <!--                                                                                  <input type="button" name="send" class="btn btn-primary mt-2 w-100"-->
                        <!--                                                                                          value="Add Data" id="addRow">-->
                        <!---->
                        <!--                                            <input type="button" name="save" class="btn btn-primary mt-2 w-100"-->
                        <!--                                                   value="Save"-->
                        <!--                                                   id="btnSavePremiumQueryData">-->
                        <!---->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </form>-->
                    </div>
                </div>
                <!-- invalid Zipcode HTML -->
                <div id="invalidZipCode" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center border-bottom-0">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                         fill="currentColor" class="bi bi-x-circle text-danger"
                                         viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </div>

                                <h4 class="fw-bold text-center my-3"
                                    style="color: #00000090">ZipCode is inValid</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Record Exist HTML -->
                <div id="recordExists" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center border-bottom-0">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                         fill="currentColor" class="bi bi-x-circle text-danger"
                                         viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>

                                </div>
                                <h4 class="fw-bold text-center my-3"
                                    style="color: #00000090">This record already exists!</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <!--                <center><h4>Unpaid Listing</h4></center>-->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #dddddd !important;">Date</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">Type</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">State</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">City</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">Price</th>
                            <!--                            <th style="border-bottom: 1px solid #dddddd !important;">Price Staus</th>-->
                            <th style="border-bottom: 1px solid #dddddd !important;">Action</th>
                        </tr>
                        </thead>
                        <tbody id="premiumListingtbl">
                        </tbody>
                    </table>
                </div>


                <br><br>
                <!--                <center><h4>Paid Listing</h4></center>-->

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-primary font-weight-bold">Your Active Listing</h6>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right mb-3">
                            <div class="dropdown d-inline">
                                <a href="#" role="button" id="questiontab-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-co-big question"></span></a>
                                <div class="one dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-2" id="questiontab-2">
                                    <p>Active Premium Placement list</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #dddddd !important;">Date</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">Type</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">State</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">City</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">Status</th>
                        </tr>
                        </thead>
                        <tbody id="premiumListingtblPaid">
                        </tbody>
                    </table>
                </div>


                <br><br>
                <!--                <center><h4>Paid Listing</h4></center>-->
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-primary font-weight-bold">Your Canceled Listing</h6>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right mb-3">
                            <div class="dropdown d-inline">
                                <a href="#" role="button" id="questiontab-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-co-big question" ></span></a>
                                <div class="one dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-2" id="questiontab-2">
                                    <p> Canceled Premium Placement list</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #dddddd !important;">Date</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">Type</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">State</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">City</th>
                            <th style="border-bottom: 1px solid #dddddd !important;">Status</th>
                        </tr>
                        </thead>
                        <tbody id="canceledPremiumListingtbl">
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <!--            --><?php
    //        }
    //        ?>
</div>


</div>
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

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="font-size:30px;">
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
                                                <select id="selectedCard" name="selectedCard" class="form-control">
                                                    <option value="">Select a card</option>
                                                    <?php


                                                    if (isset($cardsList) && !empty($cardsList)) {
                                                        foreach ($cardsList as $key => $value) {
                                                            ?>
                                                            <option value="<?= (isset($value["card"]) && !empty($value["card"])) ? $value["card"] : $value['intent'] ?>"><?= $value['brand'] . "  ****" . $value['last_digit'] ?></option>

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
