<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$siteSetting = \common\models\SiteSettings::find()->one();

//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row welcomeWrapper">
    <div style="display: block; min-height: 500px;">
        <div class="col-lg-7">

        </div>
        <div class="col-lg-5 formSection">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <div class="loginFormSetion col-lg-8 col-lg-push-2">
                <div align="center">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="120px">
                    <p class="title">
                       <?=  $siteSetting['site_title']; ?>
                    </p>

                    <hr>
                </div>


                <?= $form->field($model, 'username')->textInput(['value'=>'barbara']) ?>

                <?= $form->field($model, 'password')->passwordInput()->textInput(['value'=>'123456']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?=  Yii::t('app', 'If you forgot your password you can');?>  <?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton( Yii::t('app', 'Login'), ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                </div>
                <div class="new_people">
                    <span style="color: #555">
                       <?= Yii::t('app', 'New Member? signup here') ?>
                    </span>
                    <a href="<?= \yii\helpers\Url::toRoute('site/signup') ?>"><?= Yii::t('app', 'Register Now') ?> !</a>
                </div>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
        <div class="clearfix"></div>
    </div>

</div>

