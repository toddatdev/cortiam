<script src="https://js.stripe.com/v3/"></script>

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