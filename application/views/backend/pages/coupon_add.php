				<!-- Inner container -->
				<div class="d-md-flex align-items-md-start" id="changeforlowres">

					<!-- Right content -->
					<form method="POST" class="ajaxform w-100">

							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<h6 class="card-title">Coupon Details</h6>
								</div>

								<div class="card-body">
									<div class="row">
										<div class="col-xl-6">
											<fieldset>
												<div class="form-group">
													<label>Coupon Code:</label>
													<input type="text" class="form-control" name="coupon_code" id="coupon_code">
												</div>

												<div class="form-group">
													<label>Description:</label>
													<textarea rows="1" cols="3" maxlength="225"  name="coupon_desc" id="coupon_desc" class="form-control maxlength-textarea"></textarea>
												</div>
											</fieldset>
										</div>
										<div class="col-xl-6">
											<fieldset>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Valid Between</label>
															<div class="input-group">
																<span class="input-group-prepend">
																	<span class="input-group-text"><i class="icon-calendar2"></i></span>
																</span>
																<input type="text" id="couponrange" class="form-control daterange-basic" value="">
						                   <input type="hidden" name="begin_date" id="begin_date" value="<?php echo date("F d, Y", strtotime("first day of this month"));?>">
						                   <input type="hidden" name="end_date" id="end_date" value="<?php echo date("F d, Y", strtotime("last day of this month"));?>">
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label>Coupon Type:</label>
															<select class="form-control select" name="coupon_type" id="coupon_type">
																<option value="">Please select an option</option>
																<option value="Amount" data-prepend="-" data-append="USD">Cash Discount</option>
																<option value="Percentage" data-prepend="-" data-append="Percent">Percentage Discount</option>
<!--																<option value="Win Limit" data-prepend="+" data-append="Extra Win">Extra Win Limit</option>-->
<!--																<option value="Interest Limit" data-prepend="+" data-append="Extra Interest">Extra Interest Limit</option>-->
															</select>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label>Discount value:</label>
															<div class="input-group group-indicator">
																<span class="input-group-prepend">
																	<span class="input-group-text" id="type_prepend"></span>
																</span>
																<input type="text" class="form-control valid" name="coupon_amount" id="coupon_amount">
																<span class="input-group-append">
																	<span class="input-group-text" id="type_append"></span>
																</span>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>

								<div class="card-footer bg-white text-right">
									<button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
								</div>
							</div>

					<!-- /right content -->
					</form>
				</div>
				<!-- /inner container -->