<style>
    .error{

        color:red;
    }

</style>


<input type="hidden" id="base_url" name="base_url" value="<?=  base_url() ?>" />

<!-- Highlighting rows and columns -->

<div class="card">

    <div class="card-header ">
        <h5 class="card-title pb-2">Why it is important?</h5>

    <div class="row ">
        <div class=" col-12 col-md-8 col-lg-10"  >
            <input type="text" class="form-control" id="attribute_important" name="attribute_important" value="<?=  getAttributesTxt() ?>" />
        </div>
        <div class=" col-12 col-md-4 col-lg-2 mt-2 mt-md-0">
            <a  href="javascript:void(0);" class="btn btn-success btn-sm w-100"  id="save_attribute_important">Save / Update</a>
        </div>
    </div>

    </div>
</div>
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title'];?></h5>
        <div class="header-elements" id="exportbuttons">
            <div class="list-icons">
                <a  href="javascript:void(0);" class="btn btn-success btn-sm" data-toggle="modal" data-target="#attributeModal" style="0.422rem .75rem !important;">Add New Attribute</a>

                <a class="list-icons-item" data-action="collapse"></a>

                <a class="list-icons-item reload" data-action="reloadtable"></a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover datatable-highlight" id="attributesDataTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Attribute Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- /highlighting rows and columns -->


<!-- The Modal -->
<div class="modal modal-design" id="attributeModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Attribute</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="addattribute">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Attribute Title:</label>
                        <input type="text" class="form-control" placeholder="Enter title" id="title" name="title" required />
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="attributeFormSave">Add</button>
                    <a herf="javascript:void(0);" class="btn btn-danger" data-dismiss="modal" style="color:#fff;">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- The Modal -->

<div class="modal" id="editattributeModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Attribute</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateattribute">
                <input type="hidden" id="updateattributeid" name="id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editattributetitle">Title:</label>
                        <input type="text" class="form-control" placeholder="Enter title" id="editattributetitle" name="title" required />
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="attributeUpdate">Update</button>
                        <a herf="javascript:void(0);" class="btn btn-danger" data-dismiss="modal" style="color:#fff;">Close</a>
                    </div>
            </form>
        </div>
    </div>
</div>
