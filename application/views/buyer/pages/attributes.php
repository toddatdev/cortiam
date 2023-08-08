<div class="container" style="margin-top: 9rem;">
<div class="card mb-5 " style="border: 0px !important;">
    <div class="card-header header-elements-inline notehistory">
        <h3 class="card-title"><span class="icon-co-big orange profile"></span><?= $userType ?> Match Making Attributes</h3>
        <div class="header-elements">

        </div>
    </div>
    <div class="card-body p-0">

        <div class="">
                <?php
                $attributeTet = getFrontendAttributesTxt();
                    if(isset($attributeTet) && $attributeTet !== '' )
                    {
                ?>
                    <div class="m-2 p-1">
                        <h3>Find a match that fits you</h3>
                        <p>
                            <?= getFrontendAttributesTxt() ?>
                        </p>
                    </div>
                <?php
                    }
                ?>

            <div class="m-2">
                <div class="jumbotron d-flex align-items-center justify-content-center mb-0 py-3">
                    <h3>Please tell us about yourself</h3>
                </div>
            </div>

            <form action="<?= base_url('/buyer/ajax/attribute-submit') ?>" method="post" id="agentSurveyFormSubmit">

                <input type="hidden" name="survey_submit_request" value="1">
                <input type="hidden" id="id" name="id" value="1">
                <input type="hidden" id="userType" name="userType" value="<?= $userType ?>" />



                <div class="card mb-3 shadow-none" style="border: 0px !important;">

                    <div class="col-sm-6 m-auto">
                     <select id="attributes" name="attributes[]" class="form-control border border-3 border-dark" multiple required>
                            <?php 
                                $questions = getAttributes();
                                if(isset($questions) && !empty($questions))
                                {
                                    foreach ($questions as $key => $val)
                                    {
                                        if(in_array($val['id'], $attributesSelectedArray))
                                        {
                            ?>
                                            <option value="<?= $val['id'] ?>" selected><?= $val['attribute_name'] ?></option>   

                            <?php
                                        }else{
                            ?>

                                            <option value="<?= $val['id'] ?>"><?= $val['attribute_name'] ?></option>   
                            <?php

                                        }
                                      
                                    }                          

                                }
                            ?>

                        </select>
                        <span class="from-validations" id="message" style="color:red;margin-bottom: 20px;text-align: start;font-size:14px;"></span>
                    </div>   

                    <div class="px-3 text-right">
                        <a  href="<?= base_url('/buyer') ?>" class="btn btn-primary mt-3" > Cancel </a>
                       <a  href="<?= base_url('skip') ?>" class="btn btn-primary mt-3" > Clear match making </a>
                        <a class="btn btn-warning mt-3" id="agentSubmitAns" style="color:white;"> Submit Answer </a>
                    </div>
                </div>
            </form>

        </div>


    </div>
</div>
</div>
