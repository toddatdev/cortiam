<div class="card">
    <div class="card-header header-elements-inline">
        <h3 class="card-title"><span class="icon-co-big orange talk"></span> Messages From Administrator</h3>
        <div class="header-elements">
            <a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>
        </div>
    </div>
    <div class="card-body">
        <ul class="media-list media-chat mb-3 pl-0">

            <?php
            if (isset($messages) && count($messages) > 0) {
                foreach ($messages as $message){

                    echo '<li class="media">
                        <div class="mr-3">
                            <img src="'.base_url('images/userphoto_mini.jpg').'" class="rounded-circle" width="40" height="40" alt="'.$message['seller'].'">
                        </div>
                        <div class="media-body">
                            <div class="media-chat-item">'.nl2br($message['message_text']).'</div>
                            <div class="font-size-sm text-muted mt-1 mb-2"><i class="icon-alarm text-muted"></i> '.time_elapsed_string($message['message_date']).' by Administrator</div>
                        </div>
                    </li>';

           }
            }
            ?>

        </ul>
    </div>
</div>
