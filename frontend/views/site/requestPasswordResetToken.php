<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$siteSetting = \common\models\SiteSettings::find()->one();

//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row welcomeWrapper">
    <div style="display: block; min-height: 500px;">
        <div class="col-lg-6">

        </div>
        <div class="col-lg-6 formSection">
            <div class="loginFormSetion col-lg-8 col-lg-push-2">
                <div align="center">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="120px">
                    <p class="title">
                        <?=  $siteSetting['site_title']; ?>
                    </p>

                    <hr>
                </div>

                <h2  style="color: #555">
                    <?= $this->title; ?>
                </h2>
                <p style="color: #777">
                    Please fill out your email. A link to reset password will be sent there.
                </p>
                <hr>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email') ?>



                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
