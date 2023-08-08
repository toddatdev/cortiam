				<!-- Inner container -->
				<div class="d-xl-flex align-items-md-start" id="changeforlowres">

					<!-- Left sidebar component -->
					<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

						<!-- Sidebar content -->
						<div class="sidebar-content">

							<!-- Navigation -->
							<div class="card">
								<div class="card-body bg-orange-800 text-center card-img-top" style="background-image: url(<?php echo base_url('assets/images/backend/panel_bg.png');?>); background-size: contain;">
									<div class="card-img-actions d-inline-block mb-3">
										<div class="previewAvatar border-2" style="border-radius:50%;width:170px;height:170px;overflow:hidden;background:white">
											<img class="img-fluid rounded-circle" src="<?php echo (($agent['avatar_string'])? base_url($agent['avatar_string']):base_url('assets/images/backend/userphoto.jpg'));?>" width="170" height="170" alt="" id="pageavatar">
										</div>
										<div class="card-img-actions-overlay rounded-circle">
											<div tabindex="500" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file" data-popup="tooltip" title="Change Profile Photo" data-placement="top"><i class="icon-compose"></i><input type="file" class="file-input" id="avatarupload"></div>
											<div data-profile="<?php echo $agent['agent_id'];?>" class="deleteprofileimg btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-1 <?php echo ((!$agent['avatar_string'])? 'd-none':'');?>" data-popup="tooltip" title="Remove Profile Photo"><i class="icon-trash"></i></div>
										</div>
									</div>

						    		<h6 class="font-weight-semibold mb-0"><?php echo $agent['first_name'];?> <?php echo $agent['last_name'];?></h6>
						    		<span class="d-block opacity-75"><?php echo $agent['city'].', '.$agent['state'];?><br>Created on <?php echo date("Y-m-d \a\\t h:i:s A",$agent['created_on']);?></span>

					    			<div class="list-icons list-icons-extended mt-2">
	                  	<?php if($agent['email']){?><a href="mailto:<?php echo $agent['email'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" title="Send Email" data-placement="top"><i class="icon-envelop3"></i></a><?php }?>
	                  	<?php if($agent['phone']){?><a href="tel:<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent['phone']);?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" title="Call Now" data-container="top"><i class="icon-phone"></i></a><?php }?>
                  	</div>
                  	<div class="clear"></div>
					    			<div class="list-icons list-icons-extended mt-2">
	                  	<?php if($agent['facebook']){?><a href="//<?php echo $agent['facebook'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Facebook" data-container="top"><i class="icon-facebook"></i></a><?php }?>
	                  	<?php if($agent['linkedin']){?><a href="//<?php echo $agent['linkedin'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="LinkedIn" data-container="top"><i class="icon-linkedin2"></i></a><?php }?>
	                  	<?php if($agent['twitter']){?><a href="//<?php echo $agent['twitter'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Twitter" data-container="top"><i class="icon-twitter"></i></a><?php }?>
	                  	<?php if($agent['google']){?><a href="//<?php echo $agent['google'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Google" data-container="top"><i class="icon-google-plus"></i></a><?php }?>
	                  	<?php if($agent['instagram']){?><a href="//<?php echo $agent['instagram'];?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round btn-file btn-sm" data-popup="tooltip" target="_blank" title="Instagram" data-container="top"><i class="icon-instagram"></i></a><?php }?>
                  	</div>
						    	</div>

								<div class="card-body p-0">
									<ul class="nav nav-sidebar mb-2">
										<li class="nav-item-header">Navigation</li>
																				
										<li class="nav-item">
											<a href="#tresult" class="nav-link active" data-toggle="tab"><i class="icon-lifebuoy"></i> Support History</a>
										</li>
									</ul>
								</div>
							</div>

						</div>
						<!-- /sidebar content -->

					</div>
					<!-- /left sidebar component -->


					<!-- Right content -->
					<form method="POST" class="editform w-100">
					<div class="tab-content w-100">
							
					
						<div class="tab-pane fade active show" id="tresult">
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<h6 class="card-title">Support History</h6>
								</div>

								<div class="card-body">
									<ul class="media-list media-chat media-chat-scrollable mb-3">
										<?php
										if ($history) {
											foreach ($history as $history_item) {
												if ($history_item['msg_from'] == 'Admin') {
												echo '<li class="media media-chat-item-reverse">
																<div class="media-body">
																	<div class="media-chat-item">'.nl2br($history_item['message_text']).'</div>
																	<div class="font-size-sm text-muted mt-2"><i class="icon-alarm ml-2 text-muted"></i> '.date("j F, Y h:i:s A",$history_item['message_date']).' by '.$history_item['admin'].'</div>
																</div>

																<div class="ml-3">
																		<div class="messageDisplayName text-uppercase">CS</div>	
																	</div>
															</li>';
												}else{
													echo '<li class="media">
																	<div class="mr-3">
                                            	                        <div class="messageDisplayName text-uppercase">'. $buyer['first_name'][0] . $buyer['last_name'][0] .'</div>	
																	</div>
																	<div class="media-body">
																		<div class="media-chat-item">'.nl2br($history_item['message_text']).'</div>
																		<div class="font-size-sm text-muted mt-2"><i class="icon-alarm ml-2 text-muted"></i> '.date("j F, Y h:i:s A",$history_item['message_date']).' by '.$history_item['agent'].'</div>
																	</div>
																</li>';
												}
											}
										}else{
											echo '<li class="media content-divider justify-content-center text-muted mx-0">No approval history</li>';
										}
										?>
									</ul>
								</div>
								<div class="card-header bg-transparent header-elements-inline border-top">
									<h6 class="card-title">Reply Support Request</h6>
								</div>
								<div class="card-body">
									<textarea name="message_text" id="message_text" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>
								</div>
								<div class="card-footer bg-white text-right">
									<button class="btn btn-success" id="sendsupport">Send <i class="icon-checkmark-circle ml-2"></i></button>
								</div>
							</div>
						</div>
						</form>
					<!-- /right content -->
				</div>
				<!-- /inner container -->