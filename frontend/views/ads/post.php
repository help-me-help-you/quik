<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Resale a Classified Responsive Website | Post Free Ads';

$uid = Yii::$app->user->id;
$usrInfo = \common\models\User::findOne($uid);
$parSub = common\models\SubCategory::find()->where(['name'=>$sub])->one();
?>

<div class="row" style="padding-top: 50px;">

    <div class="col-lg-7">
        <div class="detailBox">
            <div class="adsPostTitle">
                <i class="fa fa-book"></i>
                <?=  Yii::t('app', 'Post an Ad');?>
            </div>

            <div class="post-ad-form" style="margin-top: -10px;">

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
                    'options' => ['enctype' => 'multipart/form-data']
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
                ?>

                <?= $form->field($model, 'ad_title') ?>

                <?= $form->field($model, 'ad_description')->textarea() ?>
                <div id="spFor">
                    <script>
                        function SpFor(srt)
                        {
                            alert(srt);
                        }
                    </script>
                    <?php
                    if($cat != 'Jobs')
                    {
                        echo $form->field($model, 'price', [
                            'inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa '.$currency['symbol'].'"></i></span>{input}</div>'
                        ])->hint('<i class="fa '.$currency['symbol'].'"> </i>'.$currency['initial'].Yii::t('app', 'is default currency'));
                        echo $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint(Yii::t('app', 'Press ctrl and select multiple image'));
                    }
                    ?>


                </div>
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
                        <div class="form-group field-adsmore-more_title required">
                            <label class="control-label col-sm-4" for="select"><?= $foAds['custom_title']; ?></label>
                            <div class="col-sm-6 col-sm-offset-4">
                                <select id="select" class="form-control" name="AdsMore[more_value][<?= $foAds['custom_title']; ?>][]">
                                    <?php
                                    foreach($option as $ops)
                                    {
                                        ?>
                                        <option value="<?=$ops?>"><?=$ops?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div class="help-block help-block-error col-sm-12"></div>
                            </div>

                        </div>
                        <?php
                    }
                    elseif($foAds['custom_type'] == "checkbox")
                    {
                        // echo $form->field($adCustom, 'more_value[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);
                        $option = explode(',',$foAds['custom_options']);
                        ?>

                        <div class="form-group field-adsmore-more_value required">
                            <label class="control-label col-sm-4"><?= $foAds['custom_title']; ?></label>
                            <div class="col-sm-6">
                                <div id="adsmore-more_value">
                                    <div class="checkbox">
                                        <?php
                                        foreach($option as $key=>$ops)
                                        {
                                            ?>
                                            <div class="checkbox">
                                                <label><input name="AdsMore[more_value][<?= $foAds['custom_title']; ?>][]" value="<?=$ops?>" type="checkbox"> <?=$ops?></label>
                                            </div>


                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="help-block help-block-error col-sm-12"></div>
                                </div>

                            </div>
                        </div>

                        <?php
                    }
                    elseif($foAds['custom_type'] == "radio")
                    {
                        $data = $foAds['custom_options'];
                        $option = explode(',',$data);
                        ?>
                        <div class="form-group field-adsmore-more_value required">
                            <label class="control-label col-sm-4"><?= $foAds['custom_title']; ?></label>
                            <div class="col-sm-6">
                                <div id="adsmore-more_value">
                                    <?php
                                    foreach($option as $ops)
                                    {
                                        ?>
                                        <div class="radio"><label><input name="AdsMore[more_value][<?= $foAds['custom_title']; ?>][]" value="<?=$ops?>" type="radio"> <?=$ops?></label></div>

                                        <?php
                                    }
                                    ?>

                                </div>
                                <div class="help-block help-block-error col-sm-12"></div>
                            </div>
                        </div>
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
                <?= $form->field($model, 'name')->textInput(['placeholder'=>'John Deo']) ?>

                <?= $form->field($model, 'mobile'); ?>

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
                                    <?=  Yii::t('app', 'The premium package help sellers promote their products or services by giving more visibility to their ads to attract more buyers and sell what they want faster.');?>

                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <li class="list-group-item" >
                                <strong>
                                    <input id="reg" type="radio" value="regular" name="AdsForm[premium]" >

                                    <label for="reg" style="cursor: pointer">
                                        <?=  Yii::t('app', 'Regular ads');?>
                                    </label>
                                </strong>
                                <span class="pull-right">
                                    $ 0/-
                                </span>
                            </li>
                            <?php
                            $premium = common\models\AdsPremium::find()->all();
                            foreach($premium as $adsList)
                            {
                                ?>
                                <li class="list-group-item" >
                                    <strong>
                                        <input id="<?= $adsList['id'] ?>" value="<?= $adsList['name'] ?>" type="radio" name="AdsForm[premium]" >

                                        <label for="<?= $adsList['id'] ?>" style="cursor: pointer">
                                            <?=  Yii::t('app',  $adsList['name']);?>
                                        </label>
                                    </strong>
                                    <small style="font-size: 10px;">
                                        &nbsp; <?= ($adsList['home_page']  == "yes")?"( Front page ad )":"" ?>
                                    </small>

                                    <span class="pull-right">
                                    $ <?= $adsList['price'] ?>/-
                                </span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>

                    </div>

                </div>
                <br>
                <div class="panel">
                    <div class="panel-body" id="moreCustValue">

                    </div>
                </div>
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
    </div>
    <div class="col-lg-3">
        <div class="panel">
            <div class="panel-body" align="center">
                <p style="color: #0088e4;font-family: raleway-SemiBold;font-size: 18px;">
                    Post a Free Classified
                </p>

                <p style="color: #999;font-family: raleway-Regular;font-size: 12px;">
                    Do you have something to sell, to rent, any service to offer or a job offer? Post it at bedigit.com,
                    its free, for local business and very easy to use!
                </p>
                <img src="<?= Yii::getAlias('@web') ?>/images/site/banner2.png" title="ad image" alt="" class="img-responsive" />

            </div>
        </div>

        <div class="panel panel-default">
            <div align="center" class="panel-heading panel-title" style="color: #777;font-family: raleway-SemiBold;font-size: 18px;">
                How to sell quickly?
            </div>
            <div class="panel-body" >
                <ul class="list-unstyled list-check">
                    <li>
                        &#10003; Use a brief title and description of the item
                    </li>
                    <li>
                        &#10003; Make sure you post in the correct category
                    </li>
                    <li>
                        &#10003; Add nice photos to your ad
                    </li>
                    <li>
                        &#10003; Put a reasonable price
                    </li>
                    <li>
                        &#10003; Check the item before publish
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function forType(value)
    {
        $.post("formtype?name="+value,function(data){ $("select#adsform-type").html(data);});
        $.post("custom?id="+value,function(data){ $("#moreCustValue").html(data);});
    }
</script>