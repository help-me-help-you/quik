<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Verify panel';
$siteSetting = \common\models\SiteSettings::find()->one();

//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row ">
    <div style="display: block; min-height: 500px;">

        <div class="col-lg-8 col-lg-push-2 formSection">

            <div class="loginFormSetion col-lg-8 col-lg-push-2">
                <div align="center">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="120px">
                    <p class="title">
                    </p>
                    <h3 style="color:#555">
                        Verify Buyer panel
                    </h3>
                    <?php
                    if($msg)
                    {
                        echo "<h4 style='color: red'>".$msg."</h4>";
                    }
                    ?>
                    <hr>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'itemId')->label("Codecanyon item id"); ?>

                <?= $form->field($model, 'purchaseCode') ?>
                <?= $form->field($model, 'username')->label("Codecanyon Username") ?>
                <?= $form->field($model, 'email')->label("Your Email") ?>

                <div class="form-group">
                    <?= Html::submitButton('Verify', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="new_people">
                    <span style="color: #555">
                        I have OTP,
                    </span>
                    <a class="btn btn-link" href="<?= \yii\helpers\Url::toRoute('site/verify-me') ?>"> verify now!</a>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>

</div>

