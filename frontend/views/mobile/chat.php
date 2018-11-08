<?php
$this->title = "Message";
use \common\models\User;
use \common\models\Ads;


$data = $chat;


 // $data[0]['sender'];
 $uid = Yii::$app->user->identity->getId();
?>
<div data-role="page" data-theme="b">

    <div data-role="header"  data-position="fixed" align="left">
        <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/message') ?>" class="ui-input-btn ui-btn toggBtn" style="padding: 0;margin-top:0px !important; ">
            <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById( $data[0]['sender']); ?>" width="40px;" class="img-circle">
        </a>
        <h1 align="left">
            <b><?= Ads::getTitle($data[0]['ad_id']) ?></b><br>
            <?= User::getNameById($data[0]['sender'])  ?>
        </h1>
    </div><!-- /header -->

    <div role="main" class="ui-content" id="displayMsg">
        <input type="hidden" name="check" id="check" value="<?= count(\common\models\Message::LoadMsg($data[0]['sender'],$data[0]['ad_id'])) ?>">

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
    </div><!-- /content -->

    <div data-role="footer" data-position="fixed">
        <div class="col-xs-9">
            <textarea id="msgboxtext" class="chatboxtextarea form-control"></textarea>
        </div>
        <div class="col-xs-3" style="margin-left: -20px;">
            <button class="ui-btn ui-btn-c" style="width: 100%;font-size: 15px;padding: 12px 5px;" onclick="sendmsg(<?= $data[0]['sender'] ?>,<?= $data[0]['ad_id'] ?>)">
                Send
            </button>
        </div>
    </div><!-- /footer -->
</div><!-- /page -->
<script>
    $('.chatboxtextarea').keypress(function (e) {
        if (e.which == 13) {
            alert("Hellow");
            // $('form#login').submit();
            return false;    //<---- Add this line
        }
    });
    function sendmsg(id,ads)
    {
        setInterval(function(){ CheckUpdate(); }, 3000);

        var receiver = id;
        var url = "<?= \yii\helpers\Url::toRoute('message/send-msg'); ?>?msg="+$('#msgboxtext').val()+"&receiver="+receiver+"&ad="+ads+"&advertiser=yes";

        $.post(url,function(data){
            $('#displayMsgd').append(data);
        }).done(function(){$('#displayMsgd').append(data);}).fail( function(){ $('#displayMsg').append("<p>Connection Error...</p>"); } );
    }
    function CheckUpdate()
    {

        var chat = "<?= $data[0]['chat_id']; ?>";
        var receiver = "<?= $data[0]['sender'] ?>";
        var current = $('#check').val();

        //alert(current);

        var url = "<?= \yii\helpers\Url::toRoute('message/load-msg-tplm')?>?chat_id="+chat+"&current="+current;
        $.post(url,function(data){
            $('#displayMsg').append(data);

        }).done(function(){$('#displayMsg').append(data);}).fail( function(){ $('#displayMsg').append("<p>Connection Error...</p>"); } );


        var check = "<?= \yii\helpers\Url::toRoute('message/check'); ?>?chatId="+chat;
        $.post(check,function(data){
            if(data > current)
            {
                document.getElementById("check").value = data;

            }
        }).fail( function(){  alert(data +" urrent:"+current); } );
    }
</script>