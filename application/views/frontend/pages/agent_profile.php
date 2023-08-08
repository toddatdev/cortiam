<style>
    .play_img {
        width: 80px;
        height: 80px;
        position: absolute;
        left: -16px;

    }
    .modal-backdrop.show{
        background: #0c0e12;
    }
    .modal-dialog {
        min-height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: auto;
    }
    @media only screen and (min-width:1200px){
        .findagent.jumbotron {
            padding:8.7rem 2rem 4rem 2rem !Important;
        }
    }
    @media only screen and (min-width: 991px) and (max-width: 1200px){
        .findagent.jumbotron {
            padding: 7.5rem 2rem 4rem 2rem !important;
        }
    }
        @media only screen and (min-width:768px) and (max-width:991px){
        .findagent.jumbotron {
            padding: 3rem 2rem 4rem 2rem !Important;
        }
    }
    @media(max-width: 767px) {
        .modal-dialog {
            min-height: calc(100vh - 20px);
        }
        .findagent.jumbotron {
            padding:4.2rem 2rem 2rem 2rem !Important;
        }
        .findagent.jumbotron .headline{
            font-size: 37px !important;
        }
    }
    @media(max-width: 576px) {
        .findagent.jumbotron {
            padding: 4rem 2rem 2rem 2rem !Important;
        }

        .brokerage-footer{
            padding :6rem 2rem 17rem 2rem !important;
        }
    }
    @media(max-width: 430px) {
        .findagent.jumbotron .headline{
            font-size: 25px !important;
        }
        .findagent.jumbotron {
            padding: 4rem 2rem 2rem 2rem !Important;
        }
    }


</style>
<main role="main">
    <div class="findagent jumbotron jumbotron-fluid mb-0 ">
        <div class="container">
            <h1 class="headline mb-2">Find Your Agent</h1>
            <div class="lead text-capitalize mb-0">Get to know your agent before you choose Them.</div>
            <br>
        </div>
    </div>
    <div class="profile-content">
        <div class="container">
            <!--			<div class="row">-->


            <div class="row agent-profile">
                <div class="col-md-8 px-lg-3 px-xl-3 profile-header">
                    <!--				  			<img class="img-fluid rounded-circle user-avatar float-left mr-3" src="-->
                    <?php //echo (($agent_account['avatar_string'])? base_url($agent_account['avatar_string']):base_url('images/userphoto.jpg'));?><!--" width="120" height="120">-->
                    <h3 class="mb-2 headline text-capitalize mt-3">
                        <strong><?php echo $agent_account['first_name'] . ' ' . $agent_account['last_name']; ?></strong>
                    </h3>
                    <h6 class="brokerage-name mb-2 text-capitalize"><?php echo $agent_account['brokerage_name']; ?></h6>
                    <span class="mb-2"><?php echo(date("Y") - $agent_account['experience']); ?> Years Experience</span>

                    <div class="d-flex">
                        <?php if ($agent_account['facebook']) { ?>
                            <div class="my-2"><a href="<?php echo $agent_account['facebook']; ?>" target="_blank"
                                                 class="text-gray"><span
                                        class="icon-co-sm green face-book"></span>
                            </a></div><?php } ?>
                        <?php if ($agent_account['linkedin']) { ?>
                            <div class="my-2"><a href="<?php echo $agent_account['linkedin']; ?>" target="_blank"
                                                 class="text-gray"><span
                                        class="icon-co-sm green linkedin"></span>
                            </a></div><?php } ?>
                        <?php if ($agent_account['twitter']) { ?>
                            <div class="my-2"><a href="<?php echo $agent_account['twitter']; ?>" target="_blank"
                                                 class="text-gray"><span
                                        class="icon-co-sm green twitter"></span>
                            </a></div><?php } ?>
                        <?php if ($agent_account['google']) { ?>
                            <div class="my-2"><a href="<?php echo $agent_account['google']; ?>" target="_blank"
                                                 class="text-gray"><span
                                        class="icon-co-sm green googlebrok"></span> </a>
                            </div><?php } ?>
                        <?php if ($agent_account['instagram']) { ?>
                            <div class="my-2"><a href="<?php echo $agent_account['instagram']; ?>" target="_blank"
                                                 class="text-gray"><span
                                        class="icon-co-sm green insta-gram"></span>
                            </a></div><?php } ?>
                    </div>


                    <h5 class="mt-4"><strong>Aagent Specializations</strong></h5>
                    <?php

                    foreach ($agent_specializations as $row)
                        {
                            ?>
                            <span class="badge badge-secondary"><?php echo ucfirst($row['name'])?> </span>
                    <?php
                        }
                    ?>

                    <h5 class="mt-4"><strong>Biography</strong></h5>
                    <div class="agent-bio"><?php echo nl2br($agent_account['bio']); ?></div>


                </div>


                <div class="col-md-4 py-3 px-lg-3 px-xl-1 profile-header d-flex justify-content-center  justify-content-md-end">
                    <div style="margin-top: 40px" class="position-relative">
                        <img class="img-fluid rounded-circle user-avatar float-left mr-3" style="background-color:#00c48d; "
                             src="<?php echo(($agent_account['avatar_string']) ? base_url($agent_account['avatar_string']) : base_url('images/userphoto.jpg')); ?>">
                        <?php if ($agent_account['youtube_video']) { ?>
                        <div>
                            <a href="javascript:void(0);" data-toggle="modal"
                               data-target="#playvideoModal"><span class="icon-co-sm green-bar play_img"></a>
                        </div>
                        <?php } ?>
                    </div>

                </div>
            </div>

            <div class="modal" id="playvideoModal">
                <div class="modal-dialog modal-lg playvideomodal">
                    <div class="modal-content">
                        <div class="">
                            <?php if ($agent_account['youtube_video']) { ?>
                            <?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $agent_account['youtube_video'], $match); ?>
                            <div class="embed-responsive embed-responsive-16by9 ytvideoiframe">
                                <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/<?php echo $match[1]; ?>" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="brokerage-footer text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 brok-margin">
                        <div class="d-flex">
                            <h5 class="mb-0 mt-1"><span class="icon-co-sm green-bar phonebrok"></span></h5>
                            <div>
                                <div class="mb-0 green-footer-heading">Brokerage Phone Number</div>
                                <div class="pt-1">
                                    <a href="tel:<?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent_account['brokerage_phone']); ?>"
                                       class="text-white font-weight-bold"><?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $agent_account['brokerage_phone']); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 brok-margin">
                        <div class="d-flex">
                            <h5 class="mb-0 mt-1"><span class="icon-co-sm green-bar message"></span></h5>
                            <div>
                                <div class="mb-0 green-footer-heading">Email</div>
                                <div class="pt-1">
                                    <a href="mailto: <?php echo $agent_account['email']; ?>"
                                       class="text-white font-weight-bold">
                                        <?php echo $agent_account['email']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 brokerage-address">
                        <div class="d-flex">
                            <h5 class="mb-0 mt-1"><span class="icon-co-sm green-bar location"></span></h5>
                            <div>
                                <div class="mb-0 green-footer-heading">Brokerage Address</div>
                                <div class="pt-1 font-weight-bold">
                                    <?php echo (($agent_account['brokerage_unit']) ? $agent_account['brokerage_unit'] . ' ' : '') . $agent_account['brokerage_address'] . ', ' . $agent_account['brokerage_city'] . ', ' . $agent_account['brokerage_state'] . ', ' . $agent_account['brokerage_zipcode']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
