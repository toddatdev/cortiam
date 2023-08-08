<style>
    .error {

        color: red;
    }

</style>


<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>"/>

<!-- Highlighting rows and columns -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title']; ?></h5>
        <div class="header-elements" id="exportbuttons">
            <div class="list-icons">
                <a href="javascript:void(0);" class="btn btn-success btn-sm" data-toggle="modal"
                   data-target="#addquestionchoiceModal">Add New Question Choice</a>

                <a class="list-icons-item" data-action="collapse"></a>

                <a class="list-icons-item reload" data-action="reloadtable"></a>
            </div>
        </div>
    </div>

    <table class="table table-hover datatable-highlight" id="questionchoiceDataTable">
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Question</th>
            <th>Question Text</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /highlighting rows and columns -->


<!-- The Modal -->
<div class="modal modal-design" id="addquestionchoiceModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Question</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="addquestionchoice">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Questoion:</label>
                        <select name="question_id" class="form-control" id="question_id">
                            <?php
                            if (isset($questions) && count($questions) > 0) {
                                foreach ($questions as $dt) {
                                    ?>
                                    <option value="<?php echo $dt['id'] ?>"><?php echo $dt['title'] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Answer Text:</label>
                        <input type="text" class="form-control" placeholder="Enter text" id="questiontext" name="text"
                               required/>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <a herf="javascript:void(0);" class="btn btn-danger" data-dismiss="modal" style="color:#fff;">Close</a>
                    <button type="button" class="btn btn-success" id="questionchoiceFormSave">Save Question Choice</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- The Modal -->

<div class="modal" id="editquestionchoiceModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Question</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updatequestionchoice">
                <input type="hidden" id="updatequestionchoiceid" name="id" value=""/>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Question:</label>


                        <select name="question_id" class="form-control" id="question_choice_id">
                            <?php
                            if (isset($questions) && $questions !== '') {
                                foreach ($questions as $dt) {
                                    ?>
                                    <option value="<?= $dt['id'] ?>"><?= $dt['title'] ?></option>
                                <?php }
                            } ?>


                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editquestiontitle">Text:</label>
                        <input type="text" class="form-control" placeholder="Enter title" id="editquestionchoicetitle"
                               name="title" required/>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="questionchoiceUpdate">Update</button>
                        <a herf="javascript:void(0);" class="btn btn-danger" data-dismiss="modal" style="color:#fff;">Close</a>
                    </div>
            </form>
        </div>
    </div>
</div>
