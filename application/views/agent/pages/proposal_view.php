	<?php if(@in_array($property['property_id'], $win_properties)){ ?>
	<div class="card mb-3" id="couponlistpart">
	  <div class="card-header header-elements-inline">
			<h3 class="card-title"><span class="icon-co-big orange license"></span> Property Owner Details</h3>
	  </div>
	  <div class="card-body">
			<div class="row whitedetails">
				<div class="col-md-4"><strong>Full Name</strong><br><?php echo $property['first_name'].' '.$property['last_name'];?></div>
				<div class="col-md-4"><strong>Email Address</strong><br><a href="mailto:<?php echo $property['email'];?>" class="text-dark"><?php echo $property['email'];?></a></div>
				<div class="col-md-4"><strong>Phone Number</strong><br><a href="tel:<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $property['phone']);?>" class="text-dark"><?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $property['phone']);?></a></div>
                <div class="col-md-12" style="margin-top: 20px "><strong>Address</strong><br><?php echo ($property['unit'] ? $property['unit'].', ' : '' ).
                        ($property['address'] ? $property['address'].', ' : '' ).
                        ($property['zipcode'] ? $property['zipcode'].', ' : '' ).
                        ($property['city'] ? $property['city'].', ' : '' ).
                        ($property['state'] ? $property['state'].', ' : '' )
                    ?></div>
            </div>
		</div>
	  <div class="card-footer text-center buttonsrow">
	 		<a href="<?php echo cortiam_base_url('view-messages/seller/').$property['seller_id'];?>" class="button-border-gray text-center">CLICK HERE TO MESSAGE SELLER</a>
		</div>
	</div>
	<?php } ?>
	<div class="card mb-3" id="couponlistpart">
	  <div class="card-header header-elements-inline">
			<h3 class="card-title"><span class="icon-co-big orange talk"></span> <?php echo (($proposal['prop_from'] == 'Seller')? 'Seller\'s':'Your');?> Proposal</h3>
			<?php echo generate_agent_proposal_ribbon($proposal['prop_from'],$proposal['status'], 'right',$proposal['main_id']);?>
	  </div>
	  <div class="card-body">
			<div class="row">
				<div class="propertyslider">
					<div id="PropertyImages"  class="carousel slide carousel-fade w-100 p-0" data-ride="carousel">
						<div class="carousel-inner">
						<?php echo ($property['front_image'])? '<a href="'.base_url($property['front_image']).'" class="carousel-item active" data-toggle="lightbox" data-gallery="gallery"><img src="'.base_url($property['front_image']).'" class="d-block w-100"></a>':'';?>
						<?php echo ($property['rear_image'])? '<a href="'.base_url($property['rear_image']).'" class="carousel-item" data-toggle="lightbox" data-gallery="gallery"><img src="'.base_url($property['rear_image']).'" class="d-block w-100"></a>':'';?>
						<?php echo ($property['left_image'])? '<a href="'.base_url($property['left_image']).'" class="carousel-item" data-toggle="lightbox" data-gallery="gallery"><img src="'.base_url($property['left_image']).'" class="d-block w-100"></a>':'';?>
						<?php echo ($property['right_image'])? '<a href="'.base_url($property['right_image']).'" class="carousel-item" data-toggle="lightbox" data-gallery="gallery"><img src="'.base_url($property['right_image']).'" class="d-block w-100"></a>':'';?>
						</div>
					  <a class="carousel-control-prev" href="#PropertyImages" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#PropertyImages" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if(@in_array($property['property_id'], $win_properties)){ ?>
				<div class="col-md-12 orange-address-bar">ADDRESS: <?php echo strtoupper((($property['unit'])? $property['unit'].' ':'').$property['address'].', '.$property['city'].', '.$property['state'].', '.$property['zipcode']);?></div>
				<?php }else{ ?>
				<div class="col-md-12 orange-address-bar">ADDRESS: <?php echo strtoupper($property['city'].', '.$property['state']);?></div>
				<?php } ?>
			</div>
			<div class="row rateandtime border-bottom">
				<div class="col-md-4"><strong>Commission Rate:</strong><br><?php echo $property['commission_rate'];?>%</div>
				<div class="col-md-4"><strong>Length of Contract:</strong><br><?php echo $property['contract_length'];?> Months</div>
				<div class="col-md-4"><strong>Approximate Value:</strong><br>$<?php echo number_format($property['approx_value'],2);?></div>
			</div>
			<div class="row gray-type-bar">
				<div class="col-md-12"><?php echo strtoupper($property['type'].' - '.$property['sub_type']);?></div>
			</div>
			<div class="row rateandtime border-bottom">
				<div class="col-md-4"><strong>Build Year:</strong><br><?php echo $property['built_date'];?></div>
				<div class="col-md-4"><strong>Land Size:</strong><br><?php echo $property['land_size'];?> Acres.</div>
				<div class="col-md-4"><strong>Building Size:</strong><br><?php echo $property['building_size'];?> <?= $property['property_type'] ?>.</div>
			</div>
			<?php
			if ($property['winning_fee']) {
				 $fee_amount = $property['winning_fee'];
			}elseif ($account['win_cost']) {
				 $fee_amount = $account['win_cost'];
			}else{
				$fee_amount = $property['win_fee'];
			}
			?>
			<?php if($property['type'] == 'Residential'){ ?>
			<div class="row graydetails border-bottom">
				<div class="col-md-4"><strong>Bedroom:</strong><br><?php echo $property['bedroom'];?></div>
				<div class="col-md-4"><strong>Bathroom:</strong><br><?php echo $property['bathroom'];?></div>
				<div class="col-md-4"><strong>Fee:</strong><br>$<?php echo number_format($fee_amount,2);?></div>
			</div>
			<?php }else{ ?>
			<div class="row graydetails border-bottom">
				<div class="col-md-12"><strong>Fee:</strong><br>$<?php echo number_format($fee_amount,2);?></div>
			</div>
			<?php } ?>

		  </div>
	  </div>


    <div class="card bg-transparent shadow-none">
        <h6 class="font-weight-bold text-title-blue">Proposal Timeline</h6>
        <div class="card-body pl-4">
            <div class="row border-left">
                <div class="col-12 px-0 ">
                <?php if (isset($related_proposals)){ ?>
                <?php foreach ($related_proposals as $i => $related_proposal){ ?>
                <div class="row mb-3">
                    <div class="col-md-1 position-relative">
                        <div class="">
                            <?php
                                if ($i % 2 !== 0)
                                {
                            ?>
                                    <img class="seller-view-img position-absolute" src="<?php echo  base_url('/assets/images/frontend/seller/even.svg'); ?>" alt="">
                            <?php
                                    }else{
                             ?>
                                    <img class="seller-view-img position-absolute" src="<?php echo  base_url('/assets/images/frontend/seller/odd.svg'); ?>" alt="">
                             <?php
                                }
                             ?>
                        </div>
                    </div>
                    <div class="col-md-11 px-0 bg-white rounded-10">
                        <div class="card  shadow-none my-0">
                            <a class="" data-toggle="collapse" href="#agent<?=$i?>OfferedYou" role="button"
                               aria-expanded="false" aria-controls="agent<?=$i?>OfferedYou">
                                <div class="card-header d-flex justify-content-between text-dark">
                                    <h6 class="font-weight-bold"><?php  echo (($related_proposal['prop_from'] == 'Agent')? 'You':'Seller'); ?> Offered</h6>
                                    <div class="d-flex">
                                        <div class=""><i class="fa fa-calendar text-warning"></i> <?php echo date('m/d/Y', $related_proposal['prop_date']); ?></div>
                                        <div class="ml-3"><i class="fa fa-clock-o text-warning"></i> <?php echo date('h:i:s A', $related_proposal['prop_date']); ?></div>
                                    </div>
                                </div>
                            </a>

                            <div class="card-body collapse show " id="agent<?=$i?>OfferedYou">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="p-2 border rounded-10 card-blue">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/percent.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Commision Rate</p>
                                                    <h6 class="font-weight-bold mb-0"><?= $related_proposal['contract_length']; ?>%</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="p-2 border rounded-10 card-light-blue">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-1">
                                                        <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/files.svg'); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Length of contract</p>
                                                    <h6 class="font-weight-bold mb-0"><?= $related_proposal['commission_rate']; ?> Months</h6>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <h6 class="font-weight-bold">Your Terms</h6>
                                    <p><?php echo $related_proposal['prop_text'];?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <?php } ?>
            <?php } ?>
                </div>
            </div>



            <div class="row">
                <div class="col-12 px-0 ">
                    <!--  Last card row-->
                    <div class="row mb-3">
                        <div class="col-md-1 position-relative">
                            <div class="circle-check position-absolute">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-md-11 px-0 bg-card-primary rounded-10">
                            <div class="card  shadow-none my-0 bg-card-primary">
                                <a class="" data-toggle="collapse" href="#selectedagentOfferedYou" role="button"
                                   aria-expanded="false" aria-controls="selectedagentOfferedYou">
                                    <div class="card-header d-flex justify-content-between bg-card-primary">
                                        <h6 class="font-weight-bold"> <?php echo(($proposal['prop_from'] == 'Agent') ? 'You' : 'Seller'); ?> Offered</h6>
                                        <div class="d-flex">
                                            <div class=""><i class="fa fa-calendar text-warning"></i><?php echo date('m/d/Y', $proposal['prop_date']); ?></div>
                                            <div class="ml-3"><i class="fa fa-clock-o text-warning"></i><?php echo date('h:i:s A', $proposal['prop_date']); ?></div>
                                        </div>
                                    </div>
                                </a>

                                <div class="card-body collapse show " id="selectedagentOfferedYou">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="p-2 border rounded-10 bg-white text-dark">
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        <div class="icon-1">
                                                            <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/percent.svg'); ?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Commision Rate</p>
                                                        <h6 class="font-weight-bold mb-0"><?= $proposal['commission_rate'];  ?>%</h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="p-2 border rounded-10 bg-white text-dark">
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        <div class="icon-1">
                                                            <img class="" width="20" src="<?php echo  base_url('/assets/images/frontend/seller/files.svg'); ?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Length of contract</p>
                                                        <h6 class="font-weight-bold mb-0"><?php echo $proposal['contract_length']; ?> Months</h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <?php if (in_array($proposal['status'], array('Unread', 'Read')) && $proposal['prop_from'] == 'Seller') { ?>
                                                    <div class="col-md-12 mt-3 px-lg-3 px-xl-3 text-center buttonsrow btn-group">
                                                        <button class="btn smallerbutton text-center acceptproposal btn btn-warning border border-white">ACCEPT THIS
                                                            OFFER
                                                        </button>
                                                        <button class="btn smallerbutton text-center mx-3 declineproposal btn btn-warning border border-white">DECLINE THIS
                                                            OFFER
                                                        </button>
                                                        <button class="btn smallerbutton text-center counterofferproposal btn btn-warning border border-white">COUNTER OFFER
                                                        </button>
                                                    </div>
                                                <?php } elseif (in_array($proposal['status'], array('Unread', 'Read', 'Countered')) && $proposal['prop_from'] == 'Agent') { ?>
                                                    <div class="col-md-12 mt-1 px-lg-3 px-xl-3 text-center buttonsrow">
                                                        <button class="button-dark text-center mr-3 withdrawproposal"
                                                                data-prop="<?php echo $proposal['prop_id']; ?>">WITHDRAW
                                                        </button>
                                                    </div>
                                                <?php } else { ?>
                                                <div class="col-md-12 mt-1 px-lg-3 px-xl-3 text-center buttonsrow ">
                                                    <button class="btn smallerbutton text-center mr-3 btn btn-warning border border-white"> Offer <?php echo $proposal['status'] ?>
                                                    </button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  End Last card row-->

                </div>
            </div>
        </div>
    </div>

