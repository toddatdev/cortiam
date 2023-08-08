<style>
		.get-started{
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			bottom: 13px;
			width: 90%;
		}

        body{
            margin-top: 93px;
        }
		.card-sides{
		height: 100%;
    	border: 1px solid #DAE1E7;
    	padding: 27px;
		border-radius: 5px;
		position: relative;

	}
	.card-sides > h2{
		color: #000;
    	font-weight: 600;
    	text-align: center;
	}
.btn-primary-color{
	background-color: #ff7043;
	border-color: #ff7043;
	color: #fff;
}
.btn-primary-color:hover{
	background-color: #fff;
	color: #ff7043;
}

.minHeight{

	min-height: 585px !important;
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

.hide{

	display: none;
}

.has-error{

	color : red;
}
.bg-green{
	background-color:#00c48d;
}
 .btn-primary-css{
	position: absolute;
	left: 0;
	right: 0;
	width: 85%;
	bottom: 18px;
 }
.modal-open{
	padding-right: 0px !important;
}
</style>
<input hidden="text" id="base_url" value="<?= base_url(); ?>" />

<form method="POST" class="couponform w-100" data-source="formajaxurl">
		<div class="card" id="couponaddpart">
			<div class="card-header header-elements-inline">
				<h3 class="card-title"><span class="icon-co-big orange coupon"></span> Membership Plans </h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 col-md-8 offset-md-2">
						<div class="form-group">
							<h5 class="col-sm-12">Select a Plan</h5>

							<div class="row">
								<?php
								if (isset($plans) && $plans !== '')
								{
									foreach ($plans as $key => $plan)
									{
								?>

										<div class="col-md-6 col-xl-4">
											<div class="card  border-0 rounded-0 shadow minHeight mb-4" >
												<div class="card-header bg-green text-center text-white border-0 py-1">
													<div class="d-flex justify-content-between align-items-center">
														<h3 class="mb-0 font-weight-bold text-capitalize text-left">
															<strong>
																<?php
																if (strlen($plan['title']) > 15)
																{
																	echo substr($plan['title'],0,15) ."...";

																}else{

																	echo substr($plan['title'],0,15);
																}
																?>
															</strong>
														</h3>

													<?php
														$discountedPlanPrice = getFeaturesDiscountedPrice($plan['id']);
														$planPrice           = getPlanPrice($plan['id']);
														if($discountedPlanPrice > 0 )
														{
													?>
														<div class="d-flex py-4">
															<h1 class="text-center font-weight-bold text-white mb-0" style="font-size: 23px">$<?=  getFeaturesDiscountedPrice($plan['id']) ?></h1>

													<?php
														}else{
													?>

															<h1 class="text-center font-weight-bold text-white mb-0" style="font-size: 23px">$<?=  getFeaturesDiscountedPrice($plan['id']) ?></h1>

													<?php
														}
													?>

															<p><del><sup>$<?=   getPlanPrice($plan['id']) ?></sup></del></p>
														</div>
													</div>


												</div>
											<div class="card-body bg-white">
											<p class="text-capitalize">

												<?php
													if (strlen($plan['details']) > 60)
													{
														echo substr($plan['details'],0,60) ."...";

													}else{

														echo substr($plan['details'],0,60);
													}
												?>
											</p>
											<?php
												$features = getFeatures($plan['id']);
                                                if(isset($features) && $features !== '')
                                                {
											?>

												<ul class="list-group list-group-flush">

													<?php

                                                        $priceDicountPrice = 0;
                                                        $titleArray        = array();
                                                        $totalDsicount     = 0;
                                                        $featureIdsArray   = array();
														$subPrice          = 0;

														foreach ($features as $key => $feature)
														{
                                                            array_push($featureIdsArray, $feature['id']);
													?>
															<li class="list-group-item">
													<?php

                                                            array_push($titleArray,$feature['slug_key']);

                                                            if( isset($feature['discount_type']) && $feature['discount_type'] == 1)
                                                            {
                                                                if($feature['discount_value'] > 0 && $feature['price'] > 0)
                                                                {
                                                                   $totalDsicount     +=  $feature['discount_value'];
                                                                   $priceDicountPrice += $feature['price'] - $feature['discount_value'];
																   $discount_price =  $feature['price'] - $feature['discount_value'];

                                                                }
                                                            }else{
                                                                if($feature['discount_value'] > 0 && $feature['price']  > 0)
                                                                {
                                                                    $totalDsicount     +=  ($feature['price']/ 100) * $feature['discount_value'];
                                                                    $priceDicountPrice += ($feature['price'] / 100) * $feature['discount_value'];
																	$discount_price = ($feature['price']/ 100) * $feature['discount_value'];
                                                                }
                                                            }
                                                            ?>
																	<div class="col-sm-12">
																		<div class="row">
																			<div class="col-sm-12 text-capitalize">
																				<strong><?=  $feature['title'] ?></strong>
																			</div>

																		</div>
																	</div>
                                                                </li>
                                                            <?php

														}

                                                        $listofFeatures = implode(",",$titleArray);
                                                        $listofFeaturesId = implode(",",$featureIdsArray);

													?>
												</ul>

													<!-- <p class="small text-center font-weight-bolder text-secondary">per month</p> -->
													<a href="javascript:void(0);" class="btn btn-block bg-green text-white btn-primary-css mx-auto get-started" data-toggle="modal" data-target="#myModal" data-pice="<?= $plan['price'] ?>" data-id="<?= $plan['id'] ?>"  data-title="<?= $plan['title'] ?>" data-total-price="<?= $planPrice ?>" list-of-features ="<?=$listofFeatures ?>" totalDsicount = <?= $discountedPlanPrice - userdiscount(); ?> featuresArray="<?= $listofFeaturesId ?>" user-discount="<?= userdiscount(); ?>">Get Started</a></div>
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
				<div class="col-sm-12">
					<div class="row justify-content-center">
					<div class="row strip-row">
							<div class="col-md-12">
							<div class="d-flex justify-content-between mb-3">
								<h1 class="font-weight-bold text-warning">Membership Plans</h1>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:30px;">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
								<div class="panel panel-default credit-card-box">
									<div class="panel-heading display-table">
										<div class="row display-tr">
											<h3 class="panel-title display-td">Payment Details</h3>
											<div class="display-td">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
													<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"></path>
													<path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"></path>
												</svg>
											</div>
										</div>
									</div>

									<div class="panel-body">
										<div class="alert alert-success" role="alert" id="payment-notification" style="display:none;">
											This is a success alert—check it out!
										</div>
										<div class="col-sm-12 p-0">
											<div class="justify-content-center text-left mt-2">
												<p class="font-weight-bold d-flex justify-content-between mb-0">Membership Plan:<label id="getPlanTitle"></label></p>
												<p class="font-weight-bold d-flex justify-content-between mb-0">Sub-total:<label id="getSubToal"></label> </p>
												<p class="font-weight-bold d-flex justify-content-between mb-0">Discount:<label id="getDiscount"></label></p>
												<p class="font-weight-bold d-flex justify-content-between mb-0">Coupon Discount:<label id="getCouponDiscount">$0</label> </p>
												<p class="font-weight-bold d-flex justify-content-between mb-0">Total:<label id="getTotal"></label> </p>


												<div class="d-flex">
												<!-- <input type="text" id="coupon" name="coupon" value="" placeholder="Enter Coupon Number" class="mb-2 w-75"/>
												<a href="javascript:void(0);" id="gotnextforpayment" class="btn btn-success px-5 ml-3" data-toggle="modal" data-target="#paymentModal">Apply</a>
																	 -->
												<div class="input-group mb-3">
													<input type="text" class="form-control" id="coupon" name="coupon" value="" placeholder="Enter Coupon Number">
													<div class="input-group-append">
													<a href="javascript:void(0);" class="input-group-text ml-3 btn btn-secondary px-4" id="basic-addon2">Apply</a>
													</div>
												</div>
											</div>
											</div>
										</div>
									<?php 

										if(isset($credit_cards) && $credit_cards)
										{									

									?>
										
										<hr>
											<p class="font-weight-bold d-flex justify-content-between mb-0">Select Any Card:</p>

											  <select id="selectplan" name="selectplan" class="form-control">
												<option value="">Select credit card</option>
<?php 
												foreach($credit_cards as $card)	
												{
?>
													<option value="<?= $card['payment_id'] ?>"><?= $card['last_digit'] ?></option>
<?php

												}
?>
											  </select>
								   <?php 
										}
								   ?>			  
										<hr>
										<form id="submitForm" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?= $this->config->item('stripe_key') ?>" id="payment-form">
												<div class="form-row row">
													<div class="col-lg-12 form-group required">
														<label class="control-label">Name on Card</label>
														<input type="text" id="cardholder-name" name="cardholder-name" class="form-control" placeholder="Jane Doe" />
													</div>
												</div>
												<div class="form-row row">
													<div class="col-lg-12 form-group required">
														<label class="control-label">Phone number</label> 
														<input autocomplete="off" type="tel" id="cardholder-phone" name="cardholder-phone" class="form-control card-number" maxlength="20" type="text">
													</div>
												</div>
												<!-- <div class="form-row row">
													<div class="col-sm-12 col-md-4 form-group cvc required">
														<label class="control-label">CVC</label> <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" maxlength="4" type="text">
													</div>
													<div class="col-sm-12 col-md-4 form-group expiration required">
														<label class="control-label">Expiration Month</label> <input class="form-control card-expiry-month" placeholder="MM" maxlength="2" type="text">
													</div>
													<div class="col-sm-12 col-md-4 form-group expiration required">
														<label class="control-label">Expiration Year</label> <input class="form-control card-expiry-year" placeholder="YYYY" maxlength="4" type="text">
													</div>
												</div>													 -->
												<div id="card-element">
												</div>



												<div class="form-row row">
													<div class="col-md-12 error form-group hide">
														<div class="alert-danger alert">Please correct the errors and try
															again.</div>
													</div>
												</div>
												<!-- <div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<label class='control-label'>Coupon (20% off)</label>
															<input class="form-control" type="hidden" readonly name="coupon_percentage" id="coupon_percentage" />
														</div>
													</div>
												</div>			 -->

										</form>

										
										<div class="row">
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
		</div>

	</div>



<!--
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-sm">
		Modal content
		<div class="modal-content py-4">
			<div class="text-center">
				<h1 class="font-weight-bold text-warning">Membership Plan Summary</h1>
			</div>
			<div class="modal-body py-3">
				<div class="col-sm-12">
					<div class="justify-content-center text-center">
					<p class="font-weight-bold">Membership Plan : <label id="getPlanTitle"></label></p>
						<p class="font-weight-bold">Sub-total : $<label id="getSubToal"></label> </p>
						<p class="font-weight-bold">Discount  : $<label id="getDiscount"></label></p>
						<p class="font-weight-bold">Total     : $<label id="getTotal"></label> </p>
						<input type="text" id="coupon" name="coupon" value="" placeholder="Enter Coupon Number" class="mb-2"/>
						<a href="javascript:void(0);" id="gotnextforpayment" class="btn btn-success btn-sm" data-toggle="modal" data-target="#paymentModal">Go Forward</a>
					</div>
				</div>
			</div>
		</div>
		</div>

	</div> -->
