<div class="card" id="couponlistpart">

    <div>
        <?php
        if ($this->session->flashdata('true')){
        ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('true'); ?>
            <?php
            } else if ($this->session->flashdata('err')) {
                ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('err'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span class="icon-co-big orange envelope"></span> Message Center</h3>
            <div class="dropdown d-inline">

                <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-3"
                     id="questiontab-3">
                    <p>Privacy Message</p>
                </div>
                <button type="button" class="btn btn-warning"
                        data-toggle="modal"
                        data-target="#sendMultipleMessageToAgent">Send Message
                </button>
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


        <!-- Modal -->
        <div class="modal fade" id="sendMultipleMessageToAgent" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="<?= base_url('seller/ajax/send-message') ?>"
                      method="post" id="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Send Message To Agents</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">To:</label>
                                <!--                                <select class="send-mail-to-multiple-agents" name="receivers[]" multiple="multiple">-->

                                <input type="hidden" name="message_from_seller_dashboard" value="1">

                                <select class="form-control select-single-agent" multiple="multiple" id=""
                                        name="agent_id">
                                    <?php
                                    if (isset($users) && count($users) > 0) {

                                        foreach ($users as $dt) {
                                            ?>
                                            <option value="<?= $dt->id ?>">

                                                <?php echo $dt->first_name ?>

                                                <span class="text-warning"
                                                      style="color: red !important;">(<?php echo $dt->email ?>) (<?php echo $dt->user_type ?>)</span>
                                            </option>
                                            <?php
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Message:</label>
                                <textarea name="message_text" id="message_text" required class="form-control" cols="30"
                                          rows="10"></textarea>
                            </div>

                            <input type="hidden" name="redirect" value="1">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card-body">
            <?php
            if ($messages) { ?>
                <?php foreach ($messages as $message) {
                    if (!is_null($message['admin_id'])) {
                        ?>
                        <form action="<?= base_url('seller/read-admin-message') ?>" method="post" id="">
                            <input type="hidden" name="seller_id" value="<?php echo $message['seller_id'] ?>">
                            <input type="hidden" name="admin_id" value="<?php echo $message['admin_id'] ?>">
                            <button type="submit" class="row no-gutters messagelistitem text-left border-0">
                                <div class="col-md-9 msgtitle"><strong><?php echo $message['msg_from']; ?></strong>
                                </div>
                                <div class="col-md-3 msgdate"><?php echo time_elapsed_string($message['message_date']); ?></div>
                                <div class="col-md-12 msgbody"><?php echo $message['message_text']; ?></div>
                            </button>
                        </form>
                    <?php } else { ?>

                        <a href="<?php echo cortiam_base_url('view-messages/') .$message['msg_from']."/" .$message['agent_id'] ?>"
                           class="row no-gutters messagelistitem">
                            <div class="col-md-9 msgtitle">
                                <strong><?php echo $message['first_name'] . ' ' . $message['last_name']; ?></strong>
                            </div>
                            <div class="col-md-3 msgdate"><?php echo time_elapsed_string($message['message_date']); ?></div>
                            <div class="col-md-12 msgbody"><?php echo $message['message_text']; ?></div>
                        </a>
                    <?php }

                } ?>
            <?php } else { ?>
                <div class="col-md-12"><p class="text-center py-3 p-sm-5">You do not have any messages.</p></div>
            <?php } ?>
        </div>
    </div>