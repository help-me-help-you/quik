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
    <p class="ui-bar ui-bar-a ui-corner-all"><?=  Yii::t('app', 'Post an Ad');?></p>
    <div class="ui-body ui-body-a  ui-corner-all">

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' =>
                [
                    'horizontalCssClasses' =>
                        [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-4',
                            'wrapper' => 'col-sm-6',
                            'error' => 'col-sm-12',
                            'hint' => 'col-sm-8  col-sm-push-3 imgHintS',
                        ],
                ],
            'options' => ['enctype' => 'multipart/form-data','data-ajax'=>'false']
        ]) ?>




        <?= $form->field($model, 'category')->dropDownList(
            ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
            [
                'prompt'=>'Select Category',
                'class'=>'none',
                'data-ajax'=>'false',
                'onchange'=>'
                        $.post("cat?id='.'"+$(this).val(),function(data)
                        {
                        var cat = $("#adsform-category").val();
                        if(cat == "Jobs")
                        {
                        $("#spFor").hide();
                        }
                        else
                        {
                        $("#spFor").show();
                        }
                            $("select#ads-sub_category").html(data);


                        });',

            ])->label(false)
        ?>
        <?= $form->field($model, 'sub_category')->dropDownList(
            ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
            [
                'prompt'=>'Select sub category',
                'class'=>'none',
                'data-ajax'=>'false',
                'onchange'=>'
                        $.post("formtype?name='.'"+$(this).val(),function(data){ $("select#ads-type").html(data);});',
            ])->label(false) ?>
        <?= $form->field($model, 'type')->dropDownList(['other'=>'other'],
            ['prompt'=>'Select sub type','class'=>'none',

            ])->label(false) ?>
        <?= $form->field($model, 'ad_title') ?>

        <?= $form->field($model, 'ad_description')->textarea() ?>
        <div id="spFor">
            <script>
                function SpFor(srt)
                {
                    alert(srt);
                }
            </script>
            <?= $form->field($model, 'price')->hint('<i class="fa '.$currency['symbol'].'"> </i>'.$currency['initial'].' is default currency'); ?>
            <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint('Press ctrl and select multiple image') ?>
            <hr>
        </div>


        <?= $form->field($model, 'name')->textInput(['placeholder'=>'John Deo']) ?>

        <?= $form->field($model, 'mobile')->label('Mobile Number') ?>

        <?= $form->field($model, 'email')->textInput(['value'=>$usrInfo['email']]) ?>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4>
                            <?=  Yii::t('app', 'Premium Ad');?>
                        </h4>
                        <p>
                            <?=  Yii::t('app', 'The premium package help sellers promote their products or services by giving more visibility
                            to their ads to attract more buyers and sell what they want faster.');?>

                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <fieldset data-role="controlgroup">

                    <input name="AdsForm[premium]" id="regular" value="regular" checked="checked" type="radio">
                    <label for="regular">
                        Regular ads
                        <span class="pull-right">
                                    $ 0/-
                        </span>
                    </label>

                    <?php
                    $premium = common\models\AdsPremium::find()->all();
                    foreach($premium as $adsList)
                    {
                        ?>
                        <input name="AdsForm[premium]" id="<?= $adsList['id'] ?>" value="<?= $adsList['name'] ?>" type="radio">
                        <label for="<?= $adsList['id'] ?>">
                            <?= $adsList['name'] ?>
                            <span class="pull-right">
                                    $ <?= $adsList['price'] ?>/-
                                </span>
                        </label>

                    <?php
                    }
                    ?>


                </fieldset>

            </div>

        </div>
        <br>
        <div align="center">
            <img src="<?= Yii::getAlias('@web') ?>/images/site/paypal.png" width="50%">
        </div>
        <br>
        <div class="clearfix"></div>
        <p class="post-terms col-lg-8 col-lg-push-3">
            <?=  Yii::t('app', 'By clicking post Button you accept our Terms of Use and Privacy Policy');?>

        </p>
        <div align="center">
            <?= Html::submitButton('Edit ads', ['class' => 'yellowBtn', 'name' => 'ads-button']) ?>

        </div>

        <div class="clearfix"></div>


        <?php ActiveForm::end(); ?>
    </div>
</div>























