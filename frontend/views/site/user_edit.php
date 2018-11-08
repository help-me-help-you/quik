<?php
$this->title = "user profile Edit";
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="row " style="margin-top: 20px;">
    <div style="padding: 20px;" class="white">
        <div class="col-lg-2 col-sm-6 col-xs-12">
            <img id="sellerLogo"  src="<?= Yii::getAlias('@web') ?>/images/user/<?= $model['image']; ?>" class="img-responsive img-circle">
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <p style="padding: 5px 0px;font-size: 45px;margin-left: -5px;margin-top: -15px;text-transform: capitalize;">
                <?= $model['username']; ?>
            </p>
            <p style="padding: 5px 0px;font-size:15px;margin-left: -5px;margin-top: -15px;">
                <?= $model['city']; ?>
                <a href="<?= \yii\helpers\Url::to('') ?>">
                    Edit
                </a>
            </p>
        </div>
        <div class="col-lg-6" align="right">

        </div>
        <div class="clearfix"></div>
    </div>

    <h2 class="title">
        <?=  Yii::t('app', 'Edit Profile');?>
    </h2>
    <hr>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?=  Yii::t('app', 'Profile edit');?>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'image')->fileInput(['required'=>'required','onchange'=>'sellerLogos()','id'=>'uploadImage'])->label("Profile Image");?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'edit'), ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
<script>
    function sellerLogos() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("sellerLogo").src = oFREvent.target.result;
        };
        // $('#uploadPreview4').show();
    }
</script>