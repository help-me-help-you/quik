<?php
use \common\models\User;
$this->title = "Message";
$current_url = \yii\helpers\Url::toRoute('mobile/message');
\yii\helpers\Url::remember($current_url,'currency_p');
?>
<div role="main" class="ui-content">
    <ul data-role="listview" data-inset="true">
        <?php
        if(count($msg) ==0)
        {
         echo "<li>".Yii::t('app', 'No Message yet')."</li>";
        }
        foreach($msg as $message)
        {
            ?>
            <li>
                <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/chat') ?>?chat=<?= $message['chat_id']  ?>">
                    <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById($message['sender']); ?>" >
                    <h2>
                        <?= \common\models\Ads::getTitle($message['ad_id']) ?>

                    </h2>
                    <span style="color:#004d40;font-size: 12px" class="pull-right">
                            <?= \common\models\Analytic::time_elapsed_string($message['time'])  ?> Ago
                     </span>
                    <p>
                        <?= User::getNameById($message['sender'])  ?>
                        <i class="fa fa-angle-right"></i>
                        <?= $message['text']  ?>
                        <i class="fa fa-angle-right"></i>

                    </p>
                </a>
            </li>
        <?php
        }
        ?>

    </ul>
</div>