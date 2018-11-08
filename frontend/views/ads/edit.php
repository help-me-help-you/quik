<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Quik a Classified Responsive Website | Post Free Ads';
?>

<div class="row" style="padding-top: 50px;">
    <div class="col-lg-7">
        <div class="detailBox">
            <div class="adsPostTitle">
                <i class="fa fa-book"></i>
                Edit <span style="color: #6e6dfe"><?= $model->ad_title ?> </span> ad
            </div>

            <div class="post-ad-form">

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



                <?= $form->field($model, 'category')->dropDownList(
                    ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
                    [
                        'prompt'=>'Select Category',
                        'onchange'=>'
                        $.post("cat?id='.'"+$(this).val(),function(data)
                        {
                        var cat = $("#ads-sub_category").val();
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

                    ])
                ?>
                <?= $form->field($model, 'sub_category')->dropDownList(
                    ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
                    [
                        'prompt'=>'Select sub category',
                        'onchange'=>'
                        $.post("formtype?name='.'"+$(this).val(),function(data){ $("select#ads-type").html(data);});',
                    ]) ?>
                <?= $form->field($model, 'type')->dropDownList(['other'=>'other'],
                    ['prompt'=>'Select sub type',

                    ]) ?>
                <?= $form->field($model, 'ad_title') ?>

                <?= $form->field($model, 'ad_description')->textarea() ?>
                <div id="spFor">
                    <script>
                        function SpFor(srt)
                        {
                            alert(srt);
                        }
                    </script>
                    <?= $form->field($model, 'price') ?>

                    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint('Press ctrl and select multiple image') ?>
                    <hr>
                </div>


                <?= $form->field($model, 'name')->textInput(['placeholder'=>'John Deo']) ?>

                <?= $form->field($model, 'mobile')->label('Mobile Number') ?>

                <?= $form->field($model, 'email')?>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <h4>
                                    Premium Ad
                                </h4>
                                <p>
                                    The premium package help sellers promote their products or services by giving more visibility
                                    to their ads to attract more buyers and sell what they want faster.
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
                                        Regular ads
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
                                            <?= $adsList['name'] ?>
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
                <div align="center">
                    <img src="<?= Yii::getAlias('@web') ?>/images/site/paypal.png" width="50%">
                </div>
                <br>
                <div class="clearfix"></div>
                <p class="post-terms col-lg-8 col-lg-push-3">
                    By clicking <strong>post Button</strong> you accept our
                    <a href="" target="_blank">Terms of Use </a>
                    and
                    <a href="" target="_blank">Privacy Policy</a>
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


