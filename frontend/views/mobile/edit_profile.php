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
    <p class="ui-bar ui-bar-a ui-corner-all">Edit Profile</p>
    <div class="ui-body ui-body-a  ui-corner-all">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'image')->fileInput(['required'=>'required','onchange'=>'sellerLogos()','id'=>'uploadImage'])->label("Profile Image");?>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>























