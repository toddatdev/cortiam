<style>
	/* Chrome, Safari, Edge, Opera */
	#commission_rate, #contract_length {
	-webkit-appearance: none;
	margin: 0;
	}

/* Firefox */
#commission_rate, #contract_length {
	-moz-appearance:"textfield";
	}

.error{
	color : red;
}
</style>			
			<script type="text/javascript" src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap" defer></script>
				<!-- Inner container -->
				<div class="d-xl-flex align-items-md-start" id="changeforlowres">

					<!-- Left sidebar component -->
					<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

						<!-- Sidebar content -->
						<div class="sidebar-content">

							<!-- Navigation -->
							<div class="card">
								<div class="card-body bg-orange-800 text-center card-img-top" style="background-image: url(<?php echo base_url('assets/images/backend/panel_bg.png');?>); background-size: contain;">
									<h5>Property Owner</h5>
									<div class="card-img-actions d-inline-block mb-3">
										<div class="previewAvatar">
<?php 	
										$imageFound = base_url($seller['avatar_string']);

										$image_type_check = @exif_imagetype($imageFound);
										if ($image_type_check == false) {
											$imageFound = base_url('assets/images/backend/userphoto.jpg');
										} 

?>
										
											<img class="img-fluid rounded-circle border-2" src="<?php echo (($seller['avatar_string'])? $imageFound:base_url('assets/images/backend/userphoto.jpg'));?>" width="170" height="170" alt="">
										</div>
									</div>

						    		<h6 class="font-weight-semibold mb-0"><?php echo $seller['first_name'];?> <?php echo $seller['last_name'];?></h6>
						    		<span class="d-block opacity-75"><?php echo $seller['city'].', '.$seller['state'];?><br>Created on <?php echo date("Y-m-d \a\\t h:i:s A",$seller['created_on']);?></span>

					    			<div class="list-icons list-icons-extended mt-2">
	                  	<a href="<?php echo base_url('ct-admin/edit-seller/'.$seller['seller_id']);?>" target="_blank" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" title="Visit Sellers Profile" data-placement="top"><i class="icon-link2"></i></a>
	                  	<?php if($seller['email']){?><a href="mailto:<?php echo $seller['email'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" title="Send Email" data-placement="top"><i class="icon-envelop3"></i></a><?php }?>
	                  	<?php if($seller['phone']){?><a href="tel:<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $seller['phone']);?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" title="Call Now" data-container="top"><i class="icon-phone"></i></a><?php }?>
                  	</div>
                  	<div class="clear"></div>
					    			<div class="list-icons list-icons-extended mt-2">
	                  	<?php if($seller['facebook']){?><a href="//<?php echo $seller['facebook'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Facebook" data-container="top"><i class="icon-facebook"></i></a><?php }?>
	                  	<?php if($seller['linkedin']){?><a href="//<?php echo $seller['linkedin'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="LinkedIn" data-container="top"><i class="icon-linkedin2"></i></a><?php }?>
	                  	<?php if($seller['twitter']){?><a href="//<?php echo $seller['twitter'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Twitter" data-container="top"><i class="icon-twitter"></i></a><?php }?>
	                  	<?php if($seller['google']){?><a href="//<?php echo $seller['google'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Google" data-container="top"><i class="icon-google-plus"></i></a><?php }?>
	                  	<?php if($seller['instagram']){?><a href="//<?php echo $seller['instagram'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Instagram" data-container="top"><i class="icon-instagram"></i></a><?php }?>
                  	</div>
						    	</div>

								<div class="card-body p-0">
									<ul class="nav nav-sidebar mb-2">
										<li class="nav-item-header">Navigation</li>
										<li class="nav-item">
											<a href="#tdetails" class="nav-link active" data-toggle="tab"><i class="icon-magazine"></i> General Details</a>
										</li>
										<li class="nav-item">
											<a href="#tlocation" class="nav-link" data-toggle="tab"><i class="icon-location3"></i> Location</a>
										</li>
										<li class="nav-item">
											<a href="#tphotos" class="nav-link" data-toggle="tab"><i class="icon-images3"></i> Photos</a>
										</li>
									</ul>
								</div>
							</div>

						</div>
						<!-- /sidebar content -->

					</div>
					<!-- /left sidebar component -->


					<!-- Right content -->
					<form method="POST" class="ajaxform w-100">
					<div class="tab-content w-100">
						<div class="tab-pane fade active show" id="tdetails">

							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<h6 class="card-title">General Details</h6>
								</div>

								<div class="card-body">
										<div class="row">
											<div class="col-xl-6">
												<fieldset>
													<legend class="font-weight-semibold text-orange-700"><i class="icon-home7 mr-2"></i> Basic details</legend>

													<div class="form-group">
														<label>Seller Account:</label>
														<select name="seller_id" id="seller_id">
															<option value="">Please select</option>
															<?php
															foreach ($sellers as $seller_account) {
																echo '<option value="'.$seller_account['seller_id'].'" '.(($property['seller_id'] == $seller_account['seller_id'])? 'selected':'').'>'.$seller_account['first_name'].' '.$seller_account['last_name'].' </option>';
															}
															?>
														</select>
													</div>

													<div class="row">
														<div class="col-xl-6">
															<div class="form-group">
																<label>Property:</label><br>
																<input name="type" id="type" type="checkbox" data-on-color="success" data-off-color="primary" data-on-text="Residential" data-off-text="Commercial" class="form-check-input-switchery" <?php echo ($property['type'] == 'Residential')? 'checked':'';?>>
															</div>
														</div>

														<div class="col-xl-6">
															<div class="form-group">
																<label>Property Type:</label>
																<select name="sub_type" id="sub_type"></select>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-xl-6">
															<div class="form-group row">
																<label class="col-form-label col-lg-12">Land Size:</label><br>
																<div class="col-lg-12">
																	<div class="input-group">
																		<input type="number" min="0.01" name="land_size" id="land_size" class="form-control mr-0" value="<?php echo $property['land_size'];?>" step="0.01" >
																			<span class="input-group-append">
																			<span class="input-group-text inputsetType">Acre</span>
																		</span>
																		
																	</div>
																	<div class="error"></div>

																</div>
															</div>
														</div>

														<div class="col-xl-6">
															<div class="form-group row">
																<label class="col-form-label col-lg-12">Building Size:</label>
																<div class="col-lg-12">
																	<div class="input-group">
																		<input type="number" min="0.01" name="building_size" id="building_size" class="form-control mr-0" value="<?php echo $property['building_size'];?>" step="0.01">
																		<span class="input-group-append">
																			<span class="input-group-text inputsetType">Acre</span>
																		</span>
																	</div>
																	<div class="error"></div>

																</div>
															</div>
														</div>

														
														

														<input type="hidden" name="property_type" id="property_type" value="<?= $property['property_type'] ?>"/>



														<div class="col-xl-4">
															<div class="form-group">
																<label class="col-form-label">Build Year:</label>
																<input type="text" name="built_date" id="built_date" class="form-control" value="<?php echo $property['built_date'];?>">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xl-6">
															<div class="form-group">
																<label class="col-form-label">Approx. Property Value:</label>
																<div class="input-group">
																	<input type="text" name="approx_value" id="approx_value" class="form-control" value="<?php echo number_format($property['approx_value'], 0, '.', ',');?>">
																	<span class="input-group-append">
																	<span class="input-group-text">.00</span>
																	<span class="input-group-append">
																	<span class="input-group-text">USD</span>
																</div>
															</div>
														</div>
														<div class="col-xl-6">
															<div class="form-group">
																<label class="col-form-label">Winning Fee:</label>
																<div class="input-group">
																	<input type="text" name="winning_fee" id="winning_fee" class="form-control" value="<?php echo number_format($property['winning_fee'], 0, '.', ',');?>">
																	<span class="input-group-append">
																	<span class="input-group-text">.00</span>
																	<span class="input-group-append">
																	<span class="input-group-text">USD</span>
																</div>
															</div>
														</div>
													</div>

													<div class="row" id="hideforcommercial" <?php echo ($property['type'] != 'Residential')? 'style="display:none;"':'';?>>

														<div class="col-xl-6">
															<div class="form-group">
																<label class="col-form-label">Bedroom Amount:</label>
																<input type="number" min="0" name="bedroom" id="bedroom" class="form-control" value="<?php echo $property['bedroom'];?>">
															</div>
														</div>

														<div class="col-xl-6">
															<div class="form-group">
																<label class="col-form-label">Bathroom Amount:</label>
																<input type="number" min="0" name="bathroom" id="bathroom" class="form-control" value="<?php echo $property['bathroom'];?>">
															</div>
														</div>

													</div>

												</fieldset>
											</div>


											<div class="col-xl-6">
												<fieldset>
													<legend class="font-weight-semibold text-orange-700"><i class="icon-cash2 mr-2"></i> Contract details</legend>

													<div class="row">
														<div class="col-xl-6">
															<div class="form-group">
																<div class="form-group row">
																	<label class="col-form-label col-lg-12">Commission Rate:</label><br>
																	<div class="col-xl-12">
																		<div class="input-group">
																			<input type="number" min="0" name="commission_rate" id="commission_rate" class="form-control" placeholder="%" value="<?php echo $property['commission_rate'];?>">
																		</div>
																		<div class="error"></div>
																	</div>
																</div>
															</div>

														</div>
														<div class="col-xl-6">
															<div class="form-group">
																<div class="form-group row">
																	<label class="col-form-label col-lg-12">Contract Length:</label><br>
																	<div class="col-xl-12">
																		<div class="input-group">
																			<input type="number" min="1" name="contract_length" id="contract_length" class="form-control" placeholder="Month" value="<?php echo $property['contract_length'];?>">
																		</div>
																		<div class="error"></div>

																	</div>
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

						</div>
						<div class="tab-pane fade" id="tlocation">


							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<h6 class="card-title">Location Details</h6>
								</div>

								<div class="card-body">
										<div class="row">
											<div class="col-xl-6">
												<fieldset>
													<legend class="font-weight-semibold text-orange-700"><i class="icon-location4 mr-2"></i> Location details</legend>

													<div class="row">
														<div class="col-xl-9">
															<div class="form-group">
																<label>Address line:</label>
																<textarea rows="1" cols="3" maxlength="225"  name="address" id="address" class="form-control maxlength-textarea"><?php echo $property['address'];?></textarea>
															</div>
														</div>

														<div class="col-xl-3">
															<div class="form-group">
																<label>Unit:</label>
																<input type="text" name="unit" id="unit" class="form-control" value="<?php echo $property['unit'];?>">
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-xl-4">
															<div class="form-group">
																<label>State:</label>
																<input type="text" name="state" id="state" class="form-control" value="<?php echo $property['state'];?>">
															</div>
														</div>

														<div class="col-xl-5">
															<div class="form-group">
																<label>City:</label>
																<input type="text" name="city" id="city" class="form-control" value="<?php echo $property['city'];?>">
															</div>
														</div>

														<div class="col-xl-3">
															<div class="form-group">
																<label>Zip Code:</label>
																<input type="text" name="zipcode" id="zipcode" class="form-control" value="<?php echo $property['zipcode'];?>">
															</div>
														</div>
													</div>
													<div class="form-group text-right">
														<button type="button" class="btn btn-primary getlocation" data-map="previewmap">Get Location <i class="icon-location3 ml-2"></i></button>
													</div>
												</fieldset>
											</div>


											<div class="col-xl-6">
												<div class="map-container border-1 border-grey-300" id="previewmap"></div>
											</div>
										</div>

								</div>
								<div class="card-footer bg-white text-right">
									<input type="hidden" name="recordID" value="<?php echo $property['property_id'];?>">
									<button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
								</div>
							</div>

						</div>
						<div class="tab-pane fade" id="tphotos">
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<h6 class="card-title">Photos</h6>
								</div>

								<div class="card-body">
									<div class="row">
										<div class="col-xl-3 col-md-6">
											<fieldset>
												<legend class="font-weight-semibold text-orange-700"><i class="icon-square-down mr-2"></i>  Outdoor Photo 1</legend>
												<div class="form-group">
													<div class="card">
														<div class="card-img-actions m-1">
															<img class="card-img img-fluid" id="show_front_image" src="<?php echo (($property['front_image'])? base_url($property['front_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" alt="">
															<div class="card-img-actions-overlay card-img flex-column">
																<div tabindex="500" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file"><i class="icon-image-compare"></i> Add/Change Image<input type="file" class="file-input property_img_upload" id="prop_front_image" data-file="prop_front_image" data-target="front_image" data-avatar="show_front_image"></div>
																<input type="hidden" name="front_image" id="front_image">
																<a href="<?php echo (($property['front_image'])? base_url($property['front_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1" download><i class="icon-download"></i> Download Image</a>
																<div data-image="front_image" data-property="<?php echo $property['property_id'];?>" class="changedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['front_image'])? 'd-none':'');?>"><i class="icon-image3"></i> Set As Default</div>
																<div data-image="front_image" data-property="<?php echo $property['property_id'];?>" class="deletedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['front_image'])? 'd-none':'');?>"><i class="icon-trash"></i> Delete Image</div>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</div>
										<div class="col-xl-3 col-md-6">
											<fieldset>
												<legend class="font-weight-semibold text-orange-700"><i class="icon-square-up mr-2"></i>  Outdoor Photo 2</legend>
												<div class="form-group">
													<div class="card">
														<div class="card-img-actions m-1">
															<img class="card-img img-fluid" id="show_rear_image" src="<?php echo (($property['rear_image'])? base_url($property['rear_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" alt="">
															<div class="card-img-actions-overlay card-img flex-column">
																<div tabindex="500" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file"><i class="icon-image-compare"></i> Add/Change Image<input type="file" class="file-input property_img_upload" id="prop_rear_image" data-file="prop_rear_image" data-target="rear_image" data-avatar="show_rear_image"></div>
																<input type="hidden" name="rear_image" id="rear_image">
																<a href="<?php echo (($property['rear_image'])? base_url($property['rear_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1" download><i class="icon-download"></i> Download Image</a>
																<div data-image="rear_image" data-property="<?php echo $property['property_id'];?>" class="changedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['rear_image'])? 'd-none':'');?>"><i class="icon-image3"></i> Set As Default</div>
																<div data-image="rear_image" data-property="<?php echo $property['property_id'];?>" class="deletedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['rear_image'])? 'd-none':'');?>"><i class="icon-trash"></i> Delete Image</div>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</div>
										<div class="col-xl-3 col-md-6">
											<fieldset>
												<legend class="font-weight-semibold text-orange-700"><i class="icon-square-left mr-2"></i>  Indoor Photo 1</legend>
												<div class="form-group">
													<div class="card">
														<div class="card-img-actions m-1">
															<img class="card-img img-fluid" id="show_left_image" src="<?php echo (($property['left_image'])? base_url($property['left_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" alt="">
															<div class="card-img-actions-overlay card-img flex-column">
																<div tabindex="500" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file"><i class="icon-image-compare"></i> Add/Change Image<input type="file" class="file-input property_img_upload" id="prop_left_image" data-file="prop_left_image" data-target="left_image" data-avatar="show_left_image"></div>
																<input type="hidden" name="left_image" id="left_image">
																<a href="<?php echo (($property['left_image'])? base_url($property['left_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1" download><i class="icon-download"></i> Download Image</a>
																<div data-image="left_image" data-property="<?php echo $property['property_id'];?>" class="changedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['left_image'])? 'd-none':'');?>"><i class="icon-image3"></i> Set As Default</div>
																<div data-image="left_image" data-property="<?php echo $property['property_id'];?>" class="deletedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['left_image'])? 'd-none':'');?>"><i class="icon-trash"></i> Delete Image</div>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										</div>
										<div class="col-xl-3 col-md-6">
											<fieldset>
												<legend class="font-weight-semibold text-orange-700"><i class="icon-square-right mr-2"></i>  Indoor Photo 2</legend>
												<div class="form-group">
													<div class="card">
														<div class="card-img-actions m-1">
															<img class="card-img img-fluid" id="show_right_image" src="<?php echo (($property['right_image'])? base_url($property['right_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" alt="">
															<div class="card-img-actions-overlay card-img flex-column">
																<div tabindex="500" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file"><i class="icon-image-compare"></i> Add/Change Image<input type="file" class="file-input property_img_upload" id="prop_right_image" data-file="prop_right_image" data-target="right_image" data-avatar="show_right_image"></div>
																<input type="hidden" name="right_image" id="right_image">
																<a href="<?php echo (($property['right_image'])? base_url($property['right_image']):base_url('assets/images/backend/propertyphoto.jpg'));?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1" download><i class="icon-download"></i> Download Image</a>
																<div data-image="right_image" data-property="<?php echo $property['property_id'];?>" class="changedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['right_image'])? 'd-none':'');?>"><i class="icon-image3"></i> Set As Default</div>
																<div data-image="right_image" data-property="<?php echo $property['property_id'];?>" class="deletedefaultimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round mt-1 <?php echo (($property['default_image'] == $property['right_image'])? 'd-none':'');?>"><i class="icon-trash"></i> Delete Image</div>
															</div>
														</div>
													</div>
												</div>

											</fieldset>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /right content -->
					</form>
				</div>
				<!-- /inner container -->

<div id="propertymodal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-center">Edit Image</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="image-cropper-container mb-3">
					<img src="<?php echo base_url('assets/images/backend/placeholder.png');?>" alt="" class="cropper" id="property-cropper-image">
				</div>
				<div class="form-group avatar-cropper-toolbar mb-0">
					<div class="btn-group btn-group-justified">
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="setDragMode" data-option="move" title="Move">
								<span class="icon-move"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="setDragMode" data-option="crop" title="Crop">
								<span class="icon-crop2"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="zoom" data-option="0.1" title="Zoom In">
								<span class="icon-zoomin3"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="zoom" data-option="-0.1" title="Zoom Out">
								<span class="icon-zoomout3"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="rotate" data-option="-45" title="Rotate Left">
								<span class="icon-rotate-ccw3"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="rotate" data-option="45" title="Rotate Right">
								<span class="icon-rotate-cw3"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="scaleX" data-option="-1" title="Flip Horizontal">
								<span class="icon-flip-vertical4"></span>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="scaleY" data-option="-1" title="Flip Vertical">
								<span class="icon-flip-vertical3"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn bg-danger btn-labeled btn-labeled-left rounded-round" data-dismiss="modal"><b><i class="icon-cross2"></i></b> Cancel</button>
				<button type="button" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round" id="getpropdata"><b><i class="icon-checkmark3"></i></b> Proceed</button>
			</div>
		</div>
	</div>
</div>