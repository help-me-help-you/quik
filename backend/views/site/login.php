<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$logo= \common\models\SiteSettings::find()->one();
?>
<div class="site-login" style="margin-top:10%">



    <div class="row" >
        <div class="col-lg-3" >
        </div>
        <div class="col-lg-6" align="center">
            <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/site/logo/'.$logo->logo ?>">
            <div class="panel panel-info" align="left">
                <div class="panel-heading">
                    <h4>Admin Login</h4>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
