<style>
    .error{

        color:red;
    }

</style>


<input type="hidden" id="base_url" name="base_url" value="<?=  base_url() ?>" />

<!-- Highlighting rows and columns -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title'];?></h5>
        <div class="header-elements" id="exportbuttons">
            <div class="list-icons">
                <a  href="javascript:void(0);" class="btn btn-success btn-sm" data-toggle="modal" data-target="#questionModal">Add New Question</a>

                <a class="list-icons-item" data-action="collapse"></a>

                <a class="list-icons-item reload" data-action="reloadtable"></a>
            </div>
        </div>
    </div>

    <table class="table table-hover datatable-highlight" id="questionDataTable">
        <thead>
        <tr>
            <th>#</th>
            <th>Question Title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /highlighting rows and columns -->


<!-- The Modal -->
<div class="modal modal-design" id="questionModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Question</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="addquestion">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Questoion Title:</label>
                        <input type="text" class="form-control" placeholder="Enter title" id="title" name="title" required />
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="questionFormSave">Add</button>
                    <a herf="javascript:void(0);" class="btn btn-danger" data-dismiss="modal" style="color:#fff;">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- The Modal -->

<div class="modal" id="editquestionModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Question</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updatequestion">
                <input type="hidden" id="updatequestionid" name="id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editquestiontitle">Title:</label>
                        <input type="text" class="form-control" placeholder="Enter title" id="editquestiontitle" name="title" required />
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="questionUpdate">Update</button>
                        <a herf="javascript:void(0);" class="btn btn-danger" data-dismiss="modal" style="color:#fff;">Close</a>
                    </div>
            </form>
        </div>
    </div>
</div>
