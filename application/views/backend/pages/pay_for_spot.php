<!-- Highlighting rows and columns -->
<style>
    .error{
        color: #f44336;
        display: none;
    }
    .select2-results__option[aria-selected=true] {
        color:#333;
        background-color: #f5f5f5;
    }
</style>


<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title']; ?></h5>
        <div class="header-elements" id="exportbuttons">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reloadtable"></a>
                <button type="button" class="btn btn-warning"
                        data-toggle="modal"
                        data-target="#sendMultipleMessageToUser">Add New Bundle
                </button>
            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="sendMultipleMessageToUser" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="addData">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Bundle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12">
                                    <div class="row">

                                        <div class="col-12 mb-1">
                                            <div class="form-group">
                                                <label for="title">Title:</label>
                                                <input type="text" class="form-control" id="title" name="title" maxlength="50"/>
                                                <span class="error" id="titleError">Please enter title</span>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="title">State:</label>

                                                <select class="form-control" id="setstate" name="state" >
                                                    <option></option>

                                                    <?php
                                                            if(isset($premiumStetes) && !empty($premiumStetes))
                                                            {
                                                                foreach ($premiumStetes as $state)
                                                                {
                                                    ?>
                                                                    <option value="<?= $state['state']  ?>"><?= $state['state'] ?></option>

                                                    <?php

                                                                }
                                                            }

                                                    ?>

                                                </select>

                                                <span class="error" id="stateError">Pleae select a state</span>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <div class="form-group">
                                                <label for="title">Number of Days:</label>
                                                <input type="number" class="form-control" id="perday" name="perday" min="1" max="365"/>
                                                <span class="error" id="perdayError">Only number allowed from 0 to 365</span>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <div class="form-group">
                                                <label for="price">Bundle Price ($):</label>
                                                <input type="number" step="1" class="form-control" id="price" name="price" />
                                                <span class="error" id="priceError">Please enter bundle price</span>

                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="modal-footer">
                                <a href="javascript:void(0)" class="btn btn-danger addCancelBtn" data-dismiss="modal">Cancel</a>
                                <a href="javascript:void(0)" class="btn btn-warning px-3" id="saveBundle">Save</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Edit Modal -->
            <div class="modal fade" id="editModal"  role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form id="editData">
                        <input type="hidden" name="id" id="id" value="" />
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Bundle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12">
                                    <div class="row">

                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="title">Title:</label>
                                                <input type="text" class="form-control" id="editTitle" name="title" />
                                                <span class="error" id="editTitleError">Pleae enter title</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="editstate">State:</label>
                                                <select  class="form-control" id="doeditstate" name="state">
                                                    <option></option>
                                                    <?php
                                                    if(isset($premiumStetes) && !empty($premiumStetes))
                                                    {
                                                        foreach ($premiumStetes as $state)
                                                        {
                                                            ?>
                                                            <option value="<?= $state['state']  ?>"><?= $state['state'] ?></option>

                                                            <?php

                                                        }
                                                    }

                                                    ?>

                                                </select>
                                                <span class="error" id="editStateError">Pleae select a state</span>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="title">Number of Days:</label>
                                                <input type="number" class="form-control" id="editPerday" name="perday" min="1" max="365">
                                                <span class="error" id="editPerdayError">Only number allowed from 0 to 365</span>

                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="price">Bundle Price ($):</label>
                                                <input type="number" step="1" class="form-control" id="editPrice" name="price" />
                                                <span class="error" id="editPriceError">Pleae enter bundle price</span>

                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="modal-footer">
                                <a href="javascript:void(0)" class="btn btn-warning" id="updateBundle">Save</a>
                                <a href="javascript:void(0)" class="btn btn-danger editCancelBtn" data-dismiss="modal">Cancel</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <table class="table table-hover datatable-highlight" id="payforspot">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Number of Days</th>
            <th>Bundle Price</th>
            <th>State</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /highlighting rows and columns -->