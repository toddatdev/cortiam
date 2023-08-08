<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">-->
<!--<link rel="stylesheet" href="/resources/demos/style.css">-->
<!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->


<style>
    #ui-datepicker-div{

        left:auto;
        width: auto;
    }
</style>


    <?php

    //                echo '<pre>';
    //                print_r($this->page_data['review']);
    //                exit();

    ?>



<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>"/>

<!-- Highlighting rows and columns -->

<input type="hidden" id="selected_days" name="selected_days" value="<?= $selected_days ?>" />
<input type="hidden" id="formated_selected_days" name="formated_selected_days" value="<?= $formated_selected_days ?>" />

<div class="card">
    <div class="card-header">
       <div class="d-block d-md-flex justify-content-between">
           <h3 class="card-title"><span class="icon-co-big orange profile"></span> Agent Available Slots</h3>
           <div class="header-elements mt-2 mt-md-0" id="exportbuttons">
               <div class="list-icons">
                   <a href="javascript:void(0);" class="btn button-orange btn-sm w-165 slotopen" data-toggle="modal"
                      data-target="#addagentslotsModal">Add New Slot</a>

                   <a class="list-icons-item" data-action="collapse"></a>

                   <a class="list-icons-item reload" data-action="reloadtable"></a>
               </div>
           </div>
       </div>
    </div>
    <div class="card-body" style="padding: 10px">
        <div class="table-responsive">
            <table class="table table-hover datatable-highlight" id="agentavailableslots">
                <thead>
                <tr>
                    <th style="width:10%">No #</th>
                    <th style="width:10%">Date</th>
                    <th style="width:10%">Day</th>
                    <th style="width:10%">Time</th>
                    <th style="width:10%">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- /highlighting rows and columns -->


<!-- The Modal -->
<div class="modal" id="addagentslotsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Slot</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="addagentslots">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="week-selection">Date:</label>
                        <input type="text" class="form-control position-relative" id="week-selection" name="week-selection" value="" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input class="form-control time-slots" id="time-slot" type="text" name="time" required style="z-index: 9999999999999;">
                    </div>


                </div>
                <!-- Modal footer -->
                <div class="modal-footer modal-button-footer">
                    <button type="submit" class="btn button-orange w-110 rounded-5 " id="formagentslots">Add</button>
                    <a href="javascript:void(0);" class="btn btn-danger w-110 rounded-5 " data-dismiss="modal"
                       style="color:#fff;">close</a>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal" id="editagentslotsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Agent Slot</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateagentslots">
                <input type="hidden" id="id" name="id" value=""/>
                <input type="hidden" id="agent_id" name="agent_id" value="<?= $agent_id ?>"/>
                <input type="hidden" id="saved_day" name="saved_day" value="<?= $agent_id ?>"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="week-selection">Day:</label>
                        <input type="text" class="form-control position-relative week-selection update-selection" id="week-selections" name="week-selection" value="" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="time-slots">Time:</label>
                        <input class="form-control time-slots" id="time-slots" type="text" name="time" required style="z-index: 9999999999999;">
                    </div>


                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn button-orange w-110 rounded-5" id="formagentslots">Update</button>
                    <a href="javascript:void(0);" class="btn btn-danger w-110 rounded-5" data-dismiss="modal"
                       style="color:#fff;">close</a>
                </div>
            </form>
        </div>
    </div>
</div>