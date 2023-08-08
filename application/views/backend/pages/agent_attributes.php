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

                <select class="form-control" id="userType" name="userType">
                    <option id="Agent">Agent</option>
                    <option id="Buyer">Buyer</option>
                    <option id="Seller">Seller</option>
                </select>

                <a class="list-icons-item" data-action="collapse"></a>

                <a class="list-icons-item reload" data-action="reloadtable"></a>
            </div>
        </div>
    </div>

    <table class="table table-hover datatable-highlight" id="attributesDataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Agents</th>
                <th>Attributes</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /highlighting rows and columns -->
