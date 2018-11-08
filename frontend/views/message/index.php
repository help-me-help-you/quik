<?php
$this->title = "Message";
use \common\models\User;
use \common\models\Ads;
$countM  = count($msg);
$show = ($countM == 0)?"hidden":"";
?>
<div class="row">

    <h2 class="title">
        <?=  Yii::t('app', 'Inbox');?>
    </h2>
    <h6>
        <?=  Yii::t('app', 'User who want to contact you showing here');?>
    </h6>
    <?php
    if($countM == 0)
    {
        ?>
        <hr>
            <div class="col-lg-8 col-lg-push-2">
                <div class="panel">
                    <div class="panel-body">
                        <blockquote>
                            <?=  Yii::t('app', 'No Message yet');?>
                        </blockquote>
                    </div>
                </div>
            </div>
        <?php
    }
    ?>
    <div class="col-lg-4 <?= $show ?>">
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
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
    <div class="col-lg-6 <?= $show ?>">
        <div class="sweet-box">
            <ul class="list-unstyled">
                <?php
                foreach($msg as $message)
                {
                    ?>
                    <li>
                        <div class="row">
                            <div class="col-lg-1">
                                <img src="<?= Yii::getAlias('@web').'/images/user/'.User::getImgById($message['sender']); ?>" class="img-responsive">
                            </div>
                            <div class="col-lg-5">
                                <h5>
                                    <?= Ads::getTitle($message['ad_id']) ?>
                                </h5>
                                <h6>
                                    <?= User::getNameById($message['sender'])  ?>
                                </h6>

                            </div>
                        </div>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</div>