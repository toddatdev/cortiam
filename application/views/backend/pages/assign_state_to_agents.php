<!-- Highlighting rows and columns -->
<style>
    .error {
        color: #f44336;
        display: none;
    }

    .select2-results__option[aria-selected=true] {
        color: #333;
        background-color: #f5f5f5;
    }
</style>


<div class="card">
    <div class="card-body">
        <div class="row align-self-center">
            <div class="col-lg-12">
                <div class="border p-3">
                    <h4 class="font-weight-bold">Maximum number of days an agent can pay</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-7 col-lg-9">
                                <label for="payfor_maxdays" class="">Maximum Number of days an agent can remain on top as Premium Agent</label>
                                <input type="number" id="payfor_maxdays" name="payfor_maxdays" min="1" max="365" value="<?=  getSettingValue('agent_pay_max_no_days') ?>" class="form-control" placeholder="Agents can pay for max no of days">
                            </div>
                            <div class="col-md-5 col-lg-3 align-self-end">
                                <a class="btn btn-primary px-4 w-100" id="saveMaxDays" style="color:white;">Save / Update</a>
                            </div>
                            <span class="error" id="maxNoDays" >Only number allowed from 0 to 365</span>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card">

    <inptut type="hidden" id="totalNumberofAgents" name="totalNumberofAgents" value="<?= $total_agent_count ?>"/>

    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title']; ?></h5>
        <div class="header-elements" id="exportbuttons">

            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reloadtable"></a>
                <button type="button" class="btn btn-warning"
                        data-toggle="modal"
                        data-target="#sendMultipleMessageToUser">Add State Limit
                </button>

            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="sendMultipleMessageToUser" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="addData">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add State Limit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="title">State:</label>
                                                <input type="text" class="form-control" id="state" name="state"/>
                                                <span class="error" id="stateError">Pleae select a state</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="title">Number of Agents:</label>
                                                <input type="number" class="form-control" id="agents" name="agents"/>
                                                <span class="error"
                                                      id="numberofAgentsError">This field is required </span>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <div class="form-group">
                                                <label for="price">Per Day Price ($):</label>
                                                <input type="number" step="1" class="form-control" id="price"
                                                       name="price">
                                                <span class="error" id="priceError">Only positive numbers allowed</span>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" class="btn btn-warning" id="saveAgent">Save</a>
                                <a href="javascript:void(0)" class="btn btn-danger addCancelBtn" data-dismiss="modal">Cancel</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="editData">
                        <input type="hidden" name="id" id="id" value=""/>
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
                                                <label for="editstate">State:</label>
                                                <select class="form-control" id="editstate" name="state">
                                                </select>
                                                <span class="error" id="editStateError">Pleae select a state</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="editagents">Number of Agents:</label>
                                                <input type="number" class="form-control" id="editagents"
                                                       name="agents"/>
                                                <span class="error"
                                                      id="editNumberofAgentsError">This field is required</span>

                                            </div>
                                        </div>

                                        <div class="col-12 mb-1">
                                            <div class="form-grop">
                                                <label for="price">Per Day Price ($):</label>
                                                <input type="number" step="1" class="form-control" id="editPrice"
                                                       name="price">
                                                <span class="error"
                                                      id="editPriceError">Only positive numbers allowed</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" class="btn btn-warning" id="updateAgent">Save</a>
                                <a href="javascript:void(0)" class="btn btn-danger editCancelBtn" data-dismiss="modal">Cancel</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

   <div class="card-body">
       <table class="table table-hover datatable-highlight" id="payforspot">
           <thead>
           <tr>
               <th>Id</th>
               <th>State</th>
               <th>Number of Agents Per City</th>
               <th>State Per Day Price</th>
               <th>Action</th>
           </tr>
           </thead>
           <tbody>
           </tbody>
       </table>
   </div>
</div>
<!-- /highlighting rows and columns -->