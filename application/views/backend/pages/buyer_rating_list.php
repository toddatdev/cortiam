<!-- Highlighting rows and columns -->
<input type="hidden" id="base_url" name="base_url" value="<?=  base_url() ?>" />
<div class="card">

    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?php echo $header_data['page_title'];?></h5>
        <div class="header-elements" id="exportbuttons">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reloadtable"></a>
            </div>
        </div>
    </div>

    <table class="table table-hover datatable-highlight" id="agentratingtable">
        <thead>
        <tr>
            <th width="3%">id</th>
            <th width="10%">Agent</th>
            <th width="10%">Buyer</th>
            <th width="10%">Rating</th>
            <th width="10%">Property</th>
            <th width="15%">Address</th>
            <th class="text-center" width="20%">Comment</th>
            <th class="text-center" width="25%">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="readMoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <p id="viewReadMoreComment"></p>
            </div>

        </div>
    </div>
</div>


<!-- /highlighting rows and columns -->