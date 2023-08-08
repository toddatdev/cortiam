<style>
    .favmebutton
    {
        position: relative !important;
    }

    .error {
        color: #dc3545!important;
        font-size: 12px;
    }

</style>
<div class="card">
 			<div class="card-header header-elements-inline">
 				<h3 class="card-title"><span class="icon-co-big orange agent"></span> Agent Profile</h3>
 				<div class="header-elements">
 				</div>
 				<?php if (!$agent_licenses) { ?><div class="ribbon ribbon-top-right ribbonred"><span>Inactive</span></div><?php } ?>
 			</div>
 			<div class="card-body">
 				<div class="row">
 					<div class="col-md-12 py-3 px-lg-3 px-xl-3 dark-bg profile-header">
 						<img class="img-fluid rounded-circle user-avatar float-left mr-3" src="<?php echo (($agent_account['avatar_string']) ? base_url($agent_account['avatar_string']) : base_url('images/userphoto.jpg')); ?>" width="120" height="120">
 						<h3 class="mt-4 mb-0"><strong><?php echo $agent_account['first_name'] . ' ' . $agent_account['last_name']; ?></strong></h3>
 						<h6><?php echo $agent_account['brokerage_name']; ?></h6>
 						<div class="messagebutton">
 							<?php
								if (isset($agent_chat) && isset($agent_chat['feature_id'])) {
								?>

 								<a href="<?php echo cortiam_base_url('edit-account'); ?>" class="button-border-white smallerbutton sendmessagebutton">Send Message</a>

 							<?php

								}

								?>

							

<!-- 							--><?php //if ($favorite_status) { ?>
<!-- 								<a href="--><?php //echo cortiam_base_url('edit-account'); ?><!--" class="button-border-white smallerbutton favoritebutton" data-type="remove"><i class="icon-heart-broken2"></i></a>-->
<!-- 							--><?php //} else { ?>
<!-- 								<a href="--><?php //echo cortiam_base_url('edit-account'); ?><!--" class="button-border-white smallerbutton favoritebutton" data-type="add"><i class="icon-heart5"></i></a>-->
<!-- 							--><?php //} ?>


                            <?php if ($favorite_status) { ?>
                                <a href="javascript:void(0);"
                                   class=" smallerbutton favoritebutton" data-type="remove">
                            <span class="favmebutton ml-0 mt-3" data-display="tooltip" data-placement="left" title="" data-type="remove"  data-original-title="Remove From Favorites">
                                <i class="icon-heart-broken2 icon-2x"></i></span>
                                </a>
                            <?php } else { ?>
                                <a href="javascript:void(0);"
                                   class=" smallerbutton favoritebutton" data-type="add">
                            <span class="favmebutton ml-0 mt-3" data-display="tooltip" data-placement="left" title="Add To Favorites" data-type="add" >

                                <i class="icon-heart5 icon-2x"></i></span></a>

                            <?php } ?>
 						</div>
<!-- 						--><?php
//							$data = activeChatFeatures($agreement['agent_id'], 'agent_intro_video');
//							if (isset($data['id']) && !empty($data['id'])) {
//							?>
<!-- 							<div class="text-right mt-4">-->
<!-- 								<a href="--><?//= $get_zoom_auth_url ?><!--" class="button-orange">Connect With Zoom</a>-->
<!-- 							</div>-->
<!---->`
<!-- 						--><?php
//							}
//							?>



 					</div>
 					<div class="col-md-12 mt-3 px-lg-3 px-xl-3">
 						<h5 class="mb-0"><strong>Biography</strong></h5>
 						<?php echo nl2br($agent_account['bio']); ?>
 					</div>


 					<!--	  			--><?php //if($agent_account['estate_specialization']) {
												?>
 					<!--		  		<div class="col-md-12 mt-3 px-lg-3 px-xl-3">-->
 					<!--		  			<h5 class="mb-0"><strong>Real Estate Specialization</strong></h5>-->
 					<!--		  			--><?php //echo nl2br($agent_account['estate_specialization']);
													?>
 					<!--		  		</div>-->
 					<!--					--><?php //} 
												?>

 					<?php if (isset($agent_specializations) && !empty($agent_specializations)) { ?>
 						<div class="col-md-12 mt-3 px-lg-3 px-xl-3">
 							<h5 class="mb-0"><strong>Specialization</strong></h5>

 							<?php
								foreach ($agent_specializations as $special) { ?>
 								<span class="badge badge-secondary"><?= $special['name'] ?></span>
 							<?php
								}
								?>
 						</div>
 					<?php } ?>

					<?php if (isset($agent_attributes) && !empty($agent_attributes)) { ?>
						<div class="col-md-12 mt-3 px-lg-3 px-xl-3">
							<h5 class="mb-0"><strong>Agent Attributes</strong></h5>

							<?php
							foreach ($agent_attributes as $special) {
								if(in_array($special['attribute_name'], $seller_attributes))
									{
								?>
								<span class="badge badge-primary"><?= $special['attribute_name'] ?></span>
								<?php
								}
							}
							foreach ($agent_attributes as $special) {
								if(!in_array($special['attribute_name'], $seller_attributes))
								{
									?>
									<span class="badge badge-secondary"><?= $special['attribute_name'] ?></span>
									<?php
								}
							}
							?>
						</div>
					<?php } ?>


 					<?php if ($agent_licenses) { ?>
 						<div class="col-md-7 mt-3 px-lg-3 px-xl-3">
 							<h5 class="mb-0"><strong>Real Estate Focus</strong></h5>
 							<?php foreach ($agent_licenses as $agent_license) { ?>
 								<?php echo (($agent_license['interested'] == 'Both') ? 'Residential & Commercial' : $agent_license['interested']); ?> Properties in <?php echo $agent_license['license_state']; ?><br>
 							<?php } ?>
 						</div>
 					<?php } else { ?>
 						<div class="col-md-7 mt-3 px-lg-3 px-xl-3"></div>
 					<?php } ?>
 					<div class="col-md-5 mt-3 px-lg-3 px-xl-3">
 						<h5 class="mb-0"><strong>Years Experience</strong></h5>
 						<?php echo (date("Y") - $agent_account['experience']); ?>
 					</div>
 					<div class="col-md-12 mt-3 px-lg-3 px-xl-3">
 						<h5 class="mb-0"><strong>Brokerage Address</strong></h5>
 						<?php echo (($agent_account['brokerage_unit']) ? $agent_account['brokerage_unit'] . ' ' : '') . $agent_account['brokerage_address'] . ', ' . $agent_account['brokerage_city'] . ', ' . $agent_account['brokerage_state'] . ', ' . $agent_account['brokerage_zipcode']; ?>
 					</div>
 					<div class="col-md-7 mt-3 px-lg-3 px-xl-3">
 						<h5 class="mb-0"><strong>Brokerage Phone Number</strong></h5>
 						<a href="tel:<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent_account['brokerage_phone']); ?>" class="text-dark"><?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent_account['brokerage_phone']); ?></a>
 					</div>
 					<div class="col-md-5 mt-3 px-lg-3 px-xl-3">
 						<h5 class="mb-0"><strong>Email</strong></h5>
 						<a href="mailto:<?php echo $agent_account['email']; ?>" class="text-dark"><?php echo $agent_account['email']; ?></a>
 					</div>
 					<div class="col-md-7 mt-3 px-lg-3 px-xl-3">
 						<?php if ($agent_account['youtube_video']) { ?>
 							<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $agent_account['youtube_video'], $match); ?>
 							<div class="embed-responsive embed-responsive-16by9">
 								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $match[1]; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
 							</div>
 						<?php } ?>
 					</div>


                    <?php
                    if(isset($appointments) && !empty($appointments)){
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



                    <div class="col-md-5 mt-3 px-lg-3 px-xl-3">
 						<?php if ($agent_account['facebook']) { ?><div class="my-2"><a href="<?php echo $agent_account['facebook']; ?>" target="_blank" class="text-gray"><span class="icon-co-sm orange facebook"></span> <?php echo $agent_account['facebook']; ?></a></div><?php } ?>
 						<?php if ($agent_account['linkedin']) { ?><div class="my-2"><a href="<?php echo $agent_account['linkedin']; ?>" target="_blank" class="text-gray"><span class="icon-co-sm orange linkedin"></span> <?php echo $agent_account['linkedin']; ?></a></div><?php } ?>
 						<?php if ($agent_account['twitter']) { ?><div class="my-2"><a href="<?php echo $agent_account['twitter']; ?>" target="_blank" class="text-gray"><span class="icon-co-sm orange twitter"></span> <?php echo $agent_account['twitter']; ?></a></div><?php } ?>
 						<?php if ($agent_account['google']) { ?><div class="my-2"><a href="<?php echo $agent_account['google']; ?>" target="_blank" class="text-gray"><span class="icon-co-sm orange google"></span> <?php echo $agent_account['google']; ?></a></div><?php } ?>
 						<?php if ($agent_account['instagram']) { ?><div class="my-2"><a href="<?php echo $agent_account['instagram']; ?>" target="_blank" class="text-gray"><span class="icon-co-sm orange instagram"></span> <?php echo $agent_account['instagram']; ?></a></div><?php } ?>
 					</div>
 					<div>
 					</div>
 				</div>
 			</div>
 		</div>


 		<?php if ($agent_proposals) { ?>
 			<?php foreach ($agent_proposals as $agent_proposal) { ?>
 				<div class="card">
 					<div class="card-header header-elements-inline">
 						<h3 class="card-title"><?php echo strtoupper((($agent_proposal['unit']) ? $agent_proposal['unit'] . ' ' : '') . $agent_proposal['address'] . ', ' . $agent_proposal['city'] . ', ' . $agent_proposal['state'] . ', ' . $agent_proposal['zipcode']); ?></h3>
 						<?php echo generate_seller_proposal_ribbon($agent_proposal['prop_from'], $agent_proposal['status'], $agent_proposal['first_counter'], 'right', $agent_proposal['main_id']); ?>
 						<div class="header-elements"></div>
 					</div>
 					<div class="card-body">
 						<div class="row">
 							<div class="col-md-3"><img class="img-fluid" src="<?php echo base_url($agent_proposal['default_image']); ?>"></div>
 							<div class="col-md-9">
 								<div class="row no-gutters">
 									<div class="col-md-6 py-2 text-center dark-bg">
 										<strong>Commission Rate:</strong>
 										<p class="mb-0"><?php echo $agent_proposal['commission_rate']; ?>%</p>
 									</div>
 									<div class="col-md-6 py-2 text-center dark-bg">
 										<strong>Length of Contract:</strong>
 										<p class="mb-0"><?php echo $agent_proposal['contract_length']; ?> Months</p>
 									</div>
 									<?php if ($agent_proposal['prop_text']) { ?>
 										<div class="col-md-12 mt-2">
 											<strong>Agent Terms:</strong>
 											<p><?php echo $agent_proposal['prop_text']; ?></p>
 										</div>
 									<?php } ?>
 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="card-footer">
 						<?php if (in_array($agent_proposal['status'], array('Unread', 'Read'))) { ?>
 							<div class="col-md-12 mt-1 px-lg-3 px-xl-3 text-center buttonsrow">
 								<button class="button-border-orange smallerbutton text-center mr-3 acceptproposal" data-prop="<?php echo $agent_proposal['prop_id']; ?>">ACCEPT THIS OFFER</button>
 								<button class="button-border-dark smallerbutton text-center mr-3 declineproposal" data-prop="<?php echo $agent_proposal['prop_id']; ?>">DECLINE THIS OFFER</button>
 								<button class="button-border-gray smallerbutton text-center counterofferproposal" data-prop="<?php echo $agent_proposal['prop_id']; ?>">COUNTER OFFER</button>
 							</div>
 						<?php } ?>
 					</div>
 				</div>
 			<?php } ?>
 		<?php } ?>


 		<!--Agent Review Card-->

<?php
if (isset($agent_win_limit) && !empty($agent_win_limit)) {

    if (isset($agent_win_limit['win_limit']) && $agent_win_limit['win_limit'] > 0) {
        ?>
        <div class="card">
            <div class="card-body px-4">
                <h3 class="card-title mb-3"></span> Reviews</h3>
                <div class="row">

                    <?php
                    if (isset($agentreviewed) && !empty($agentreviewed)) {
                        foreach ($agentreviewed as $value) {

                            $rating = $value['rating'];
                            $totalRating = round($rating);
                            ?>


                            <div class="col-12">
                                <?php
                                for ($r= 1; $r <= $totalRating; $r++) {
                                    ?>

                                    <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         style="color: #00c48d" class="bi bi-star-fill" viewBox="0 0 16 16">
                                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                            </span>

                                    <?php

                                }
                                ?>

                                <?php
                                for ($r = 1; $r <= 5 - $totalRating; $r++) {
                                    ?>

                                    <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-star-fill" viewBox="0 0 16 16">
                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        </span>
                                    <?php

                                }

                                $data =  getUserName($value['seller_id'], $value['buyer_id']);
                                ?>

                                <h6 class="font-weight-bold mb-0 my-1">by:<span
                                            style="color: #00c48d "><?= $data['first_name'] . "  " . $data['last_name']?> <small>(<?=$data['user_type'] ?>)</small></span>
                                </h6>
                                <p><?= $value['comment'] ?></p>
                                <hr>
                            </div>

                            <?php
                        }
                    }
                    ?>


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

        <?php
    }
}
?>