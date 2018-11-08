<?php
$this->title = "All User";
?>
<div class="row">
    <div class="col-lg-8">
        <div class="box-body no-padding">
            <ul class="users-list clearfix">
                <?php
                foreach($member as $user)
                {
                    ?>
                    <li>
                        <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/user/'.$user['image'] ?>" class="img-thumbnail">

                        <a class="users-list-name" href="<?= \yii\helpers\Url::toRoute('site/user') ?>?id=<?= $user['id'] ?>"><?= $user['username'] ?></a>
                        <span class="users-list-date">
                            <?= \common\models\Analytic::time_elapsed_string($user['created_at']) ?> ago
                        </span>
                    </li>
                <?php
                }
                ?>


            </ul><!-- /.users-list -->
        </div><!-- /.box-body -->
    </div>
</div>