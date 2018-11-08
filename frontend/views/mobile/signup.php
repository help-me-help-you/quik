<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$uid = Yii::$app->user->id;
$usrInfo = \common\models\User::findOne($uid);
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Login';

$current_url = \yii\helpers\Url::toRoute('site/profile');
\yii\helpers\Url::remember($current_url,'currency_p');
$googleAds= \common\models\Analytic::find()->one();
$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = (isset($default_selected))?$default_selected:$currency_default;
?>

<div role="main" class="ui-content">

    <div class="loginFormSetion col-lg-8 col-lg-push-2" style="margin-top: -10px;">
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
            <?= Html::submitButton(Yii::t('app','Singup'), ['class' => 'ui-btn  ui-shadow  ui-btn-c', 'name' => 'signup-button']) ?>
        </div>

        <div class="new_people">
                    <span style="color: #555">

                        <?=  Yii::t('app','Already a member');?>

                    </span>
            <a href="<?= \yii\helpers\Url::toRoute('mobile/login') ?>"><?=  Yii::t('app','Login Now');?> !</a>
        </div>

    </div>


    <?php ActiveForm::end(); ?>
</div>


