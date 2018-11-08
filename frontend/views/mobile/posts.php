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
$parSub = common\models\SubCategory::find()->where(['name'=>$sub])->one();

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




        <div style="position: absolute;">
            <?php
            echo $form->field($model, 'category')->hiddenInput(['value'=>$cat])->label(false);
            echo $form->field($model, 'sub_category')->hiddenInput(['value'=>$sub])->label(false);

            ?>
        </div>
        <strong>
            <?=  Yii::t('app', $cat );?> &nbsp; <i class="fa fa-angle-right"></i> &nbsp; <?=  Yii::t('app', $sub );?>
        </strong>
        <hr>
        <?= $form->field($model, 'type')->dropDownList(
            ArrayHelper::map(common\models\Type::find()->where(['parent'=>$parSub['id']])->all(),'name','name'),
            [
                'prompt'=>'Select Type',
            ])
           ->label(false) ?>
        <?= $form->field($model, 'ad_title') ?>

        <?= $form->field($model, 'ad_description')->textarea() ?>
        <div id="spFor">
            <script>
                function SpFor(srt)
                {
                    alert(srt);
                }
            </script>
            <?= $form->field($model, 'price')->hint('<i class="fa '.$currency['symbol'].'"> </i>'.$currency['initial'].Yii::t('app', 'is default currency')); ?>
            <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint(Yii::t('app', 'Press ctrl and select multiple image')) ?>
            <hr>
        </div>


        <?= $form->field($model, 'name')->textInput(['placeholder'=>'John Deo']) ?>

        <?= $form->field($model, 'mobile') ?>

        <?= $form->field($model, 'email')->textInput(['value'=>$usrInfo['email']]) ?>
        <br>
        <?php
        foreach($custom as $foAds)
        {
            echo $form->field($adCustom, 'more_title[]')->hiddenInput(['value'=>$foAds['custom_title']])->label(false);

            if($foAds['custom_type'] == "textinput")
            {
                echo $form->field($adCustom, 'more_value['.$foAds['custom_title'].'][]')->label($foAds['custom_title']);

            }
            elseif($foAds['custom_type'] == "select")
            {
                $option = explode(',',$foAds['custom_options']);
                ?>
                <label for="<?= $foAds['custom_title']; ?>" class="select"><?= $foAds['custom_title']; ?></label>
                <select name="AdsMore[more_value][<?= $foAds['custom_title']; ?>][]" id="<?= $foAds['custom_title']; ?>">
                    <?php
                    foreach($option as $ops)
                    {
                        ?>
                        <option value="<?=$ops?>"><?=$ops?></option>
                    <?php
                    }
                    ?>

                </select>
            <?php
            }
            elseif($foAds['custom_type'] == "checkbox")
            {
                // echo $form->field($adCustom, 'more_value[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);
                $option = explode(',',$foAds['custom_options']);
                ?>
                <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <legend><?= $foAds['custom_title']; ?>:</legend>
                    <?php
                    foreach($option as $ops)
                    {
                        ?>
                        <input class="col-xs-4 col-sm-4" value="<?=$ops?>" name="AdsMore[more_value][<?= $foAds['custom_title']; ?>][]" id="<?=$ops?>" type="checkbox">
                        <label for="<?=$ops?>"><?=$ops?></label>
                    <?php
                    }
                    ?>
                </fieldset>
            <?php
            }
            elseif($foAds['custom_type'] == "radio")
            {
                $data = $foAds['custom_options'];
                $option = explode(',',$data);
                ?>
                <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <legend><?= $foAds['custom_title']; ?>:</legend>
                    <?php
                    foreach($option as $ops)
                    {
                        ?>
                        <input name="AdsMore[more_value][<?= $foAds['custom_title']; ?>][]" id="<?=$ops?>" value="<?=$ops?>" checked="checked" type="radio">
                        <label for="<?=$ops?>"><?=$ops?></label>

                    <?php
                    }
                    ?>
                </fieldset>
            <?php

            }
            else
            {
                echo $form->field($adCustom, 'more_value[]['.$foAds['custom_title'].'][]')->label($foAds['custom_title']);
                echo "<hr>";
            }



        }
        ?>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4>
                            <?=  Yii::t('app', 'Premium Ad');?>
                        </h4>
                        <p>
                            <?=  Yii::t('app', 'The premium package help sellers promote their products or services by giving more visibility to their ads to attract more buyers and sell what they want faster.');?>

                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <fieldset data-role="controlgroup">

                    <input name="AdsForm[premium]" id="regular" value="regular" checked="checked" type="radio">
                    <label for="regular">
                        <?=  Yii::t('app', 'Regular ads');?>
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
                            <?=  Yii::t('app', $adsList['name']);?>
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
            <?= Html::submitButton('post ads', ['class' => 'yellowBtn', 'name' => 'ads-button']) ?>

        </div>

        <div class="clearfix"></div>


        <?php ActiveForm::end(); ?>
    </div>
</div>























