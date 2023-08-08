<style>
    .slick-next {
        right: -8px !important;
        z-index: 999 !important;
        height: 50px !important;
        width: 40px !important;
    }

    .slick-prev {
        left: -8px !important;
        z-index: 999 !important;
        height: 50px !important;
        width: 40px !important;
    }
    .slick-prev:hover {
        height: 50px !important;
        width: 40px !important;
        z-index: 999 !important;
    }
    .slick-next:hover {
        height: 50px !important;
        width: 40px !important;
        z-index: 999 !important;
    }

    .slick-prev:before, .slick-next:before {
        font-family: icomoon !important;
        font-size: 3rem;
        line-height: 1;
        opacity: .75;
        color: #4c525e;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .slick-prev:before {
        content: "\e9c8";
    }

    .slick-next:before {
        content: "\e9cb";
    }

    .blockUI.blockMsg.blockPage {
        left: 0 !important;
    }


    .agentcard {
        margin: 10px 0px;
        /*height: 300px;*/
        margin-bottom: 20px;
        border: none !important;
    }

    .agentbox {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin: 0px;
    }

    .agentsnoresult {
        display: inline-block;
        width: 100%;
        font-size: 1.2rem;
        font-weight: 600;
        text-align: center;
        margin: 3rem 0px;
        padding: 2rem 1rem;
        border: 2px solid #dedede;
        background: #fefefe;
        border-radius: 1rem;
    }

    agentbox .agentimage {
        display: inline-block;
        position: relative;
        margin-bottom: 2rem;
    }

    .agentbox .agentimage img {
        margin-top: 10px;
        max-width: 50%;
        border-radius: 65px;
    }

    .agentbox .agenttext {
        /*position:absolute;*/
        /*top:0px;*/
        /*left:0px;*/
        width: 100%;
        height: 100%;
        padding: 2rem;
        font-size: 1rem;
        line-height: 1.2;
        color: #ffffff;
        /*background:rgba(0,0,0,.3);*/
        text-align: left;
        overflow: hidden;
    }

    .agentbox:hover .agenttext {
        /*animation:fadeOut ease 1s;*/
        /*opacity:0;*/
    }

    .agentbox .agenttext .placer {
        /*position:absolute;*/
        /*bottom:1rem;*/
        /*left:1rem;*/
        width: 100%;
    }

    .agentbox h3 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: .5rem;
        color: #002C77;
        font-family: 'Campton', sans-serif;
    }

    .agentbox p {
        font-size: 16px;
        font-weight: 400;
        color: #00c48d;
        font-family: 'Campton', sans-serif;
    }

    .findagent-list {
        background: #ffffff;
        padding: 1rem 0px 1rem 0px;
    }

    .findagent-list .agentcard {
        margin: 10px 0px;
        /*height: 300px;*/
        margin-bottom: 20px;
        border: none !important;
    }

    .findagent-list .agentbox {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin: 0px;
    }

    .findagent-list .agentsnoresult {
        display: inline-block;
        width: 100%;
        font-size: 1.2rem;
        font-weight: 600;
        text-align: center;
        margin: 3rem 0px;
        padding: 2rem 1rem;
        border: 2px solid #dedede;
        background: #fefefe;
        border-radius: 1rem;
    }

    .findagent-list .agentbox .agentimage {
        display: inline-block;
        position: relative;
        margin-bottom: 2rem;
    }

    .findagent-list .agentbox .agentimage img {
        margin-top: 10px;
        max-width: 50%;
        border-radius: 65px;
    }

    .findagent-list .agentbox .agenttext {
        /*position:absolute;*/
        /*top:0px;*/
        /*left:0px;*/
        width: 100%;
        height: 100%;
        padding: 2rem;
        font-size: 1rem;
        line-height: 1.2;
        color: #ffffff;
        /*background:rgba(0,0,0,.3);*/
        text-align: left;
        overflow: hidden;
    }

    .findagent-list .agentbox:hover .agenttext {
        /*animation:fadeOut ease 1s;*/
        /*opacity:0;*/
    }

    .findagent-list .agentbox .agenttext .placer {
        /*position:absolute;*/
        /*bottom:1rem;*/
        /*left:1rem;*/
        width: 100%;
    }

    .findagent-list .agentbox h3 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: .5rem;
        color: #002C77;
        font-family: 'Campton', sans-serif;
    }

    .findagent-list .agentbox p {
        font-size: 16px;
        font-weight: 400;
        color: #00c48d;
        font-family: 'Campton', sans-serif;
    }

    @media (max-width: 576px) {
        .dataTables_filter > label {
            ;
            font-size: 0px;
        }
    }

    @media (max-width: 576px) {
        #getagentappointments_length {
            margin-right: 100px
        }
    }

    @media (max-width: 576px) {
        .dataTables_filter > label >label {
            font-size: .9rem;
        }
    }


    @media (max-width: 576px) {
        .dataTables_filter > label >input {
            font-size: .9rem;

        }
    }

    /*@media (max-width: 576px) {*/
    /*    #getagentappointments_length > select {*/
    /*        font-size:.9rem;*/
    /*    }*/
    /*}*/

</style>


<input type="hidden" id="buyer_id" name="buyer_id" value="<?= $buyer_id ?>"/>
<input type="hidden" name="userType" id="userType" value="<?= $userType ?>"/>
<input type="hidden" name="dashboard" id="dashboard" value="dashboard"/>
<?php if ($this->session->flashdata('msg')): ?>
    <div class="alert alert-success">
        <p><?php echo $this->session->flashdata('msg'); ?></p>
    </div>
<?php endif; ?>



<div class="card">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span class="icon-co-big orange list"></span> Agents on Cortiam</h3>
        <div class="header-elements">`
            <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>
        </div>
    </div>
    <div class="card-body" style="">
        <input type="hidden" id="buyerState" name="buyerState" value="<?= $state ?>" />
        <input type="hidden" id="buyerCity" name="buyerCity" value="<?= $city ?>" />
        <div class="row mb-3">
            <div class="col-sm-6 col-md-3">
                <select id="getstate" name="state" class="form-control setStateEmpty">
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <select id="getcity"  name="city" class="form-control setCityEmpty">
                    <option></option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <input type="text" id="zip" name="zip" class="form-control" placeholder="Enter zip code"/>
            </div>

            <div class="col-sm-6 col-md-3 text-center search-buttons">
                <a href="javascript:void(0);" id="search" class="btn btn-success mt-1">Search</a>
                <a href="javascript:void(0);" id="cancel" class="btn btn-danger  mt-1">Cancel</a>

            </div>

        </div>

        <div class="row carouselSimple justify-content-center" id="setFindBuyersAgentList">
        </div>
    </div>
    <div class="card-footer" style=""></div>
</div>

<div class="card">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span class="icon-co-big orange agent"></span> Agents</h3>
        <div class="header-elements">

            <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>
        </div>
    </div>
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs nav-fill proptabs" id="nav-tab" role="tablist">
                <!-- <a class="nav-item nav-link active" id="nav-ag-tab" data-toggle="tab" href="#nav-ag" role="tab" aria-controls="nav-ag" aria-selected="false">Agents</a> -->
                <a class="nav-item nav-link buyerMyAgents active" id="nav-ya-tab" data-toggle="tab" href="#nav-ya" role="tab"
                   aria-controls="nav-ya" aria-selected="false">My Agents</a>
                <a class="nav-item nav-link buyerFavoriteAgents" id="nav-fa-tab" data-toggle="tab" href="#nav-fa"
                   role="tab" aria-controls="nav-fa" aria-selected="false">Favorites</a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade" id="nav-fa" role="tabpanel" aria-labelledby="nav-fa-tab">
                <?php if ($saved_agents) { ?>
                    <div class="row px-3 carouselFavourites justify-content-center findagent-list" id="setFavoriteList">
                        <?php

                        foreach ($saved_agents as $saved_agent) {
//                            echo generate_agent_card($saved_agent, true);
                            //$purl = base_url('/buyer/agent-profile/') . $saved_agent['agent_id'] . '-agent_account';
                            echo new_card($saved_agent, "buyer", $this->account['id']);
                        }
                        ?>
                    </div>
                <?php } else { ?>
                    <h4 class="py-3 p-sm-5 text-center" id="nofavtext">You have no favorite agents at this moment.</h4>
                <?php } ?>


            </div>
            <div class="tab-pane fade show active" id="nav-ya" role="tabpanel" aria-labelledby="nav-ya-tab">

                <?php if ($selected_agents) { ?>
                    <div class="row px-3 carouselSelected justify-content-center findagent-list" id="setSelectedList">
                        <?php
                        foreach ($selected_agents as $selected_agent) {
//                            echo generate_agent_card($selected_agent);

                            echo new_card($selected_agent, "buyer", $this->account['id']);
                        }
                        ?>
                    </div>
                <?php } else { ?>
                    <h4 class="py-3 p-sm-5 text-center">You have no agents at this moment.</h4>
                <?php } ?>

            </div>

        </div>
    </div>


    <div class="card-footer"></div>
</div>


<div class="card">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span class="icon-co-big orange profile"></span>Appointments</h3>
        <div class="header-elements">
            <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>
        </div>
    </div>
    <div class="card-body" style="padding: 10px;">
        <div class="table-responsive">
            <table class="table table-hover datatable-highlight" id="getagentappointments">
                <thead class="thead-dark">
                    <tr>
                        <th style="max-width: 100px">No #</th>
                        <th>Agent Name</th>
                        <th>Type</th>
                        <th>Meet At</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>



<br><br>


<!-- <div class="card">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span class="icon-co-big orange profile"></span>Appointments</h3>
    </div>
    <div class="card-body" style="padding: 10px;">
        <div class="table-responsive">
            <table class="table table-hover datatable-highlight" id="getagentappointments">
                <thead class="thead-dark">
                <tr>
                    <th style="max-width: 100px">No #</th>
                    <th>Agent Name</th>
                    <th>Type</th>
                    <th>Meet At</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div> -->


<?php if ($my_properties) { ?>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span class="icon-co-big orange proplist"></span> Your Properties</h3>
            <div class="header-elements">
                <div class="dropdown d-inline">
                    <a href="#" role="button" id="questiontab-2" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"><span class="icon-co-big question"></span></a>
                    <div class="dropdown-menu dropdown-menu-right larger" aria-labelledby="questiontab-2"
                         id="questiontab-2">
                        <p>Properties added by the seller up for bid.</p>
                    </div>
                </div>
                <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                foreach ($my_properties as $my_property) {
                    echo generate_seller_property_card($my_property);
                }
                ?>
            </div>
        </div>
        <div class="card-footer  text-center">
            <?php if (count($my_properties) >= 12) { ?>
                <div class="row">
                    <div class="col-md-12"><a href="<?php echo cortiam_base_url('list-properties'); ?>"
                                              class="button-underline-gray">View All Properties</a></div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>


<!-- <div class="card">
        <div class="card-header header-elements-inline">
            <h3 class="card-title"><span class="icon-co-big orange agent"></span> Survey</h3>

        </div>
        <div class="card-body">

            <a href="<?php echo base_url() ?>seller/survey" class="btn btn-warning w-100 btn-lg">Retake survey</a>

        </div>
        <div class="card-footer"></div>
    </div> -->
