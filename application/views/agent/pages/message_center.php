<div class="card" id="couponlistpart">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span class="icon-co-big orange envelope"></span> Message Center</h3>
        <div class="dropdown d-inline">
            <a href="#" role="button" id="questiontab-3" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><span class="icon-co-big question"></span></a>
            <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-3"
                 id="questiontab-3">
                <p>Privacy message</p>
            </div>
        </div>
        <!--			<div class="header-elements">
				<div class="dropdown d-inline">
					<span role="button" id="dropdownSettingsLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by <i class="icon-arrow-down5 mr-3 icon-2x"></i></span>
				  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownSettingsLink">
						<a href="<?php echo base_url('agent/'); ?>#" class="dropdown-item">Date Ascending</a>
						<a href="<?php echo base_url('agent/'); ?>#" class="dropdown-item">Date Descending</a>
				  </div>
				</div>
			</div>-->
    </div>
    <div class="card-body">
        <?php

        if ($messages) { ?>
            <?php foreach ($messages as $message) {
                if (!is_null($message['admin_id'])) {
                    ?>
                    <form action="<?= base_url('agent/read-admin-message') ?>" method="post" id="">
                        <input type="hidden" name="agent_id" value="<?php echo $message['agent_id']?>">
                        <input type="hidden" name="admin_id" value="<?php echo $message['admin_id']?>">
                        <button type="submit"  class="row no-gutters messagelistitem text-left border-0">
                            <div class="col-md-9 msgtitle"><strong><?php echo $message['msg_from']; ?></strong></div>
                            <div class="col-md-3 msgdate"><?php echo time_elapsed_string($message['message_date']); ?></div>
                            <div class="col-md-12 msgbody"><?php echo $message['message_text']; ?></div>
                        </button>
                    </form>

                <?php
                
                    } else {

                        if(isset($message['seller_id']) && $message['seller_id'] !== '')
                        {
                            $user_id =  $message['seller_id'];
                        }else{
                            $user_id =  $message['buyer_id'];
                        }
                       

                ?>
                    <a href="<?php echo cortiam_base_url('view-messages/') .($message['buyer_id'] ? "buyer" : "seller"). '/' .  $user_id; ?>"
                       class="row no-gutters messagelistitem">
                        <div class="col-md-9 msgtitle">
                            <strong><?php echo $message['first_name'] . ' ' . $message['last_name'] . ' '; ?></strong>
                        </div>
                        <?php
                          $lastmsgevnt = getLastMessageOfAgent($message['seller_id'], $message['buyer_id'], $message['agent_id']);
                        ?>
                        <div class="col-md-3 msgdate"><?php echo time_elapsed_string($lastmsgevnt['message_date']); ?></div>
                        <div class="col-md-12 msgbody"><?php echo $lastmsgevnt['message_text'] ?></div>
                    </a>

                <?php }
            }
            ?>
        <?php } else { ?>
            <div class="col-md-12"><p class="text-center py-3 p-sm-5">You do not have any messages</p></div>
        <?php } ?>
    </div>
</div>