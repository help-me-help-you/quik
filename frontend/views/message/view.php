<?php
$this->title = "Message";
use \common\models\User;
use \common\models\Ads;

?>
<div class="row" style="background-color: #fff;margin-top: 5px;">
    <div class="col-lg-4 " style="min-height: 400px;position: fixed;overflow-y: scroll;background-color: #fff;z-index: 99;height: 100%;">
        <div class="sweet-box">
            <ul class="list-unstyled">
                <?php
                foreach($msg as $message)
                {
                    ?>
                    <li>
                        <a href="<?= \yii\helpers\Url::toRoute('message/view') ?>?chat=<?= $message['chat_id']  ?>">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById($message['sender']); ?>" class="img-circle img-responsive">
                                </div>
                                <div class="col-lg-9">
                                    <h5>
                                        <strong>
                                            <?= Ads::getTitle($message['ad_id']) ?>
                                        </strong>
                                    </h5>
                                    <h4>
                                        <small>
                                            <?= $message['text']  ?>
                                        </small>
                                    </h4>
                                    <h5 >
                                        <small style="color: #999; !important;">
                                            <?= User::getNameById($message['sender'])  ?>
                                            <i class="fa fa-angle-right"></i>
                                            <?= \common\models\Analytic::time_elapsed_string($message['time'])  ?> Ago
                                        </small>
                                    </h5>

                                </div>
                            </div>
                        </a>
                    </li>                <?php
                }
                ?>
                <?php
                foreach($msg as $message)
                {
                    ?>
                    <li>
                        <a href="<?= \yii\helpers\Url::toRoute('message/view') ?>?chat=<?= $message['chat_id']  ?>">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById($message['sender']); ?>" class="img-circle img-responsive">
                                </div>
                                <div class="col-lg-9">
                                    <h5>
                                        <strong>
                                            <?= Ads::getTitle($message['ad_id']) ?>
                                        </strong>
                                    </h5>
                                    <h4>
                                        <small>
                                            <?= $message['text']  ?>
                                        </small>
                                    </h4>
                                    <h5 >
                                        <small style="color: #999; !important;">
                                            <?= User::getNameById($message['sender'])  ?>
                                            <i class="fa fa-angle-right"></i>
                                            <?= \common\models\Analytic::time_elapsed_string($message['time'])  ?> Ago
                                        </small>
                                    </h5>

                                </div>
                            </div>
                        </a>
                    </li>                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row chatuHead">
            <?php
            $data = array_merge($chat);
            $data[0]['sender'];
            ?>
            <div class="col-lg-12 chatwrapperVtop " >
                <div class="row" style="padding: 10px 20px;background-color: #007cd5; color: #fff;">
                    <div class="col-lg-1">
                        <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById( $data[0]['sender']); ?>" width="40px;" class="img-circle">
                    </div>
                    <div class="col-lg-11">
                        <strong>
                        <?= Ads::getTitle($data[0]['ad_id']) ?>
                        </strong>
                        <h6>
                            <?= User::getNameById($data[0]['sender'])  ?>
                        </h6>
                    </div>
                </div>

            </div>

            <div class="col-lg-12 chat-wrapper" id="displayMsg" >
                <input type="hidden" name="check" id="check" value="<?= count($msg) ?>">

                <?php
                foreach($chat as $message)
                {
                    ?>
                    <div class="chatboxmessage <?= ($message['sender'] == Yii::$app->user->identity->getId())?"":"ltr"; ?>">
                            <span class="chatboxmessagefrom">
                                <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById($message['sender']); ?>" width="35px;" class="img-circle">
                                <br>
                                <?= User::getNameById($message['sender'])  ?>
                            </span>
                        <div class="chatboxmessagecontent" style="padding: 15px;">
                            <?= $message['text'] ?>

                            <time datetime="<?= \common\models\Analytic::time_elapsed_string($message['time']) ?>">
                                <?= \common\models\Analytic::time_elapsed_string($message['time']) ?> ago
                            </time>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

            <div class="col-lg-12 chatwrapperVbot" style="padding: 10px 20px;background-color: #eed31d; color: #fff;">
                <textarea id="msgboxtext" class="chatboxtextarea form-control"></textarea>
                <button class="btn chatboxend" onclick="sendmsg(<?= $data[0]['sender'] ?>,<?= $data[0]['ad_id'] ?>)">Send</button>
            </div>
        </div>

    </div>
    <div class="clearfix" style="margin-bottom: 80px;"></div>

</div>
<script >

//    var div = $("#displayMsg");
//    div.scrollTop(div.prop('scrollHeight'));
    $('.chatboxtextarea').keypress(function (e) {
        if (e.which == 13) {
            alert("Hellow");
            // $('form#login').submit();
            return false;    //<---- Add this line
        }
    });
    function sendmsg(id,ads)
    {
//        var url = "<?//= \yii\helpers\Url::toRoute('user/sendmsg?id='.$model['id']) ?>//&msg="+$('#msgboxtext').val();
//        $.post(url,function(data){ $('#msgboxr').html(data); })
        setInterval(function(){ CheckUpdate(); }, 3000);

        var receiver = id;
        var url = "<?= \yii\helpers\Url::toRoute('message/send-msg'); ?>?msg="+$('#msgboxtext').val()+"&receiver="+receiver+"&ad="+ads+"&advertiser=yes";

        $.post(url,function(data){
            $('#msgboxtext').val(null);
        }).fail( function(){ $('#display-msg').append("<p>Connection Error...</p>"); } );
      //  var div = $("#displayMsg");
      //  div.scrollTop(div.prop('scrollHeight'));

    }

    function CheckUpdate()
    {

        var chat = "<?= $message['chat_id']; ?>";
        var current = $('#check').val();

        var check = "<?= \yii\helpers\Url::toRoute('message/check'); ?>?chatId="+chat;

        var url = "<?= \yii\helpers\Url::toRoute('message/load-msg-tplm')?>?chat_id="+chat+"&current="+current;
        $.post(url,function(data){
           $('#displayMsg').append(data);
            var div = $("#displayMsg");
            div.scrollTop(div.prop('scrollHeight'));
        }).fail( function(){ $('#display-msg').append("<p>Connection Error...</p>"); } );



        $.post(check,function(data){
            if(data > current)
            {
                document.getElementById("check").value = data;


            }
        }).fail( function(){  alert(data +" urrent:"+current); } );

    }
   // const messages = document.getElementById('displayMsg');

//    function appendMessage() {
//        const message = document.getElementsByClassName('chatboxmessage')[0];
//        const newMessage = message.cloneNode(true);
//        messages.appendChild(newMessage);
//    }
//
//    function getMessages() {
//        // Prior to getting your messages.
//        shouldScroll = messages.scrollTop + messages.clientHeight === messages.scrollHeight;
//        /*
//         * Get your messages, we'll just simulate it by appending a new one syncronously.
//         */
//        appendMessage();
//        // After getting your messages.
//        if (!shouldScroll) {
//            scrollToBottom();
//        }
//    }

//    function getMessages(letter) {
//        var div = $("#displayMsg");
//        div.scrollTop(div.prop('scrollHeight'));
//    }
//    $(function() {
//        getMessages();
//    });

</script>
