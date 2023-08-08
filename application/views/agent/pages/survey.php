<div class="container" style="margin-top: 9rem;">
<div class="card mb-5 " style="border: 0px !important;">
    <div class="card-header header-elements-inline notehistory">
        <h3 class="card-title"><span class="icon-co-big orange profile"></span>Agent Survey</h3>
        <div class="header-elements">

        </div>
    </div>
    <div class="card-body p-0">

        <div class="">

            <div class="m-2">
                <div class="jumbotron d-flex align-items-center justify-content-center mb-0" style="height: 120px">
                    <h3>The big knowledge test!</h3>
                </div>
            </div>

            <form action="<?= base_url('/agent/ajax/survey-submit') ?>" method="post" id="agentSurveyFormSubmit">

                <input type="hidden" name="survey_submit_request" value="1">
                <input type="hidden" id="id" name="id" value="1">


                <div class="card mb-3 shadow-none" style="border: 0px !important;">
                    <?php
                    $questions = getQuestions();

                    if (isset($questions) && count($questions) > 0) {
                        $totalQuestions = count($questions);
                        foreach ($questions as $key => $dt) {
                            $question_choices = getAllAgentQuestionChoices($dt['id']);
                            ?>
                            <!--                            <input type="text" value="--><?php //echo $dt['id'] ?><!--" name="question_id">-->
                            <div id="q1" class="card-body mb-0 pb-0" aria-labelledby="h1">
                                <h5 class="text-capitalize"><b class="mr-2"><?php echo $key + 1; ?>:</b><?php echo $dt['title'] ?>
                                </h5>
                                <?php
                                if (isset($question_choices) && count($question_choices) > 0) {
                                    $totalQuestions = count($question_choices);
                                    foreach ($question_choices as $key => $qc) {
                                        ?>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" style="width: 20px;height: 20px"
                                                   type="radio"
                                                   name="choices[<?php echo $dt['id'] ?>]"
                                                   id="<?php echo $qc['id'] ?>"
                                                   value="<?php echo $qc['id'] ?>"
                                                   required
                                            >
                                            <label class="form-check-label font-weight-normal mt-1 text-capitalize"
                                                   for="<?php echo $qc['id'] ?>">
                                                <?php echo $qc['text'] ?>
                                            </label>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <?php
                        }
                    }
                    ?>

                    <div class="px-3 text-right">
                        <button class="btn btn-warning mt-3" id="agentSubmitAns"> Submit Answer </button>
                    </div>
                </div>
            </form>

        </div>


    </div>
</div>
</div>
