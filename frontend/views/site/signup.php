<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$siteSetting = \common\models\SiteSettings::find()->one();

//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row welcomeWrapper">
    <div style="display: block; min-height: 500px;">
        <div class="col-lg-7">

        </div>
        <div class="col-lg-5 formSection">

            <div class="loginFormSetion col-lg-8 col-lg-push-2">
                <div align="center">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="120px">
                    <p class="title">
                        <?=  $siteSetting['site_title']; ?>
                    </p>

                    <hr>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Singup'), ['class' => 'btn btn-warning', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                <div class="new_people">
                    <span style="color: #555">
                        <?= Yii::t('app', 'Already a member') ?>
                    </span>
                    <a href="<?= \yii\helpers\Url::toRoute('site/login') ?>"> <?= Yii::t('app', 'Login Now') ?>!</a>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>

</div>





