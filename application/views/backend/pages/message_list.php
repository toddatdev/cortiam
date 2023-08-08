<!-- Highlighting rows and columns -->
<div class="card">


    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title']; ?></h5>
        <div class="header-elements" id="exportbuttons">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reloadtable"></a>
                <button type="button" class="btn btn-warning"
                        data-toggle="modal"
                        data-target="#sendMultipleMessageToUser">Send Message
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="sendMultipleMessageToUser" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="<?= base_url('ct-admin/send-multiple-message-to-users') ?>"
                          method="post" id="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">To:</label>
                                    <select class="send-mail-to-multiple-users" name="receivers[]" multiple="multiple" required>
                                        <?php
                                        foreach ($this->page_data['users'] as $dt) {
                                            ?>
                                            <option value="<?= $dt->id ?>">

                                                <?php echo $dt->first_name ?>
                                                <span class="text-warning"
                                                      style="color: red !important;">(<?php echo $dt->email ?>)</span>
                                                (<?php echo $dt->user_type ?>)

                                            </option>
                                            <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Message:</label>
                                    <textarea name="message" id="" class="form-control" required cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

    <table class="table table-hover datatable-highlight" id="messagetable">
        <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Title</th>
            <th>Send Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /highlighting rows and columns -->