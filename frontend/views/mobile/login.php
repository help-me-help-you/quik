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
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <div class="loginFormSetion col-lg-8 col-lg-push-2" style="margin-top: -10px;">
        <div align="center">
            <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="120px">
            <p class="title">
                <?=  $siteSetting['site_title']; ?>
            </p>

            <hr>
        </div>


        <?= $form->field($model, 'username')->textInput(['value'=>'barbara']) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>


        <?php $checkboxTemplate = '<fieldset data-role="controlgroup">{beginLabel}{input}{labelTitle}{endLabel}{error}{hint}</fieldset>'; ?>
        <?= $form->field($model, 'rememberMe')->checkbox(['template' => $checkboxTemplate]); ?>



        <div style="color:#999;margin:1em 0">
            <?=  Yii::t('app','If you forgot your password you can');?>
             <?= Html::a( Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'ui-btn  ui-shadow  ui-btn-c', 'name' => 'login-button']) ?>
        </div>
        <div class="new_people">
                    <span style="color: #555">
                        <?=  Yii::t('app', 'New Member? signup here');?>

                    </span>
            <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/signup') ?>"> <?=  Yii::t('app', 'Register Now');?>!</a>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>























