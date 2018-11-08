<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Resale a Classified Responsive Website | Post Free Ads';
?>

<!-- Submit Ad -->
<div class="submit-ad main-grid-border">
    <div class="container">
        <h2 class="head">Post an Ad</h2>
        <div class="post-ad-form">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?php $form->field($model, 'category')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
                ['prompt'=>'Select category',

                ])
            ?>

            <?= $form->field($model, 'category')->dropDownList(
                ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
                [
                    'prompt'=>'Select Category',
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
                            alert("You choose "+cat);
                            $("select#adsform-sub_category").html(data);


                        });',

                ])
            ?>
            <?= $form->field($model, 'sub_category')->dropDownList(
                ArrayHelper::map(common\models\Category::find()->all(),'name','name'),
                [
                    'prompt'=>'Select sub category',
                    'onchange'=>'
                        $.post("formtype?name='.'"+$(this).val(),function(data){ $("select#adsform-type").html(data);});',
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

                <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint('press ctrl and select multiple image') ?>
                <hr>
            </div>


            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'states')->dropDownList(ArrayHelper::map(\common\models\State::find()->all(),'id','state'),
                ['prompt'=>'Select State',
                    'onchange'=>'
                        $.post("state?id='.'"+$(this).val(),function(data){ $("select#adsform-city").html(data);});',

                ])
            ?>
            <?= $form->field($model, 'city')->dropDownList(
                ['prompt'=>'Select City'])
            ?>
            traveller
            <?= $form->field($model, 'mobile') ?>

            <?= $form->field($model, 'email') ?>
            <br>
            <div class="clearfix"></div>
            <p class="post-terms">
                By clicking <strong>post Button</strong> you accept our
                <a href="terms.html" target="_blank">Terms of Use </a>
                and
                <a href="privacy.html" target="_blank">Privacy Policy</a>
            </p>
            <div class="clearfix"></div>
            <?= Html::submitButton('post ads', ['class' => 'btn btn-lg btn-warning pull-right', 'name' => 'ads-button']) ?>

                <div class="clearfix"></div>


            <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
<!-- // Submit Ad -->