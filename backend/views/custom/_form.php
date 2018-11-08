<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QnewCustomFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qnew-custom-fields-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'custom_catid')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Category::find()->all(),'id','name'),
        [
            'prompt'=>'Choos Category',
            'onchange'=>'
                        $.get("cat?id='.'"+$(this).val(),function(data)
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
                            $("select#qnewcustomfields-custom_subcatid").html(data);


                        });',

        ]) ?>

    <?= $form->field($model, 'custom_subcatid')->dropDownList(
        [
            'prompt'=>'Select sub category',

        ]) ?>
    <?php // $form->field($model, 'custom_subcatid')->textInput() ?>

    <?= $form->field($model, 'custom_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_type')
        ->dropDownList(
            array(
                'textinput'=>'text input',
                'select'=>'select',
                'textarea'=>'text area',
                'checkbox'=>'checkbox',
                'radio'=>'radio'
            )
        )
    ?>

    <?= $form->field($model, 'custom_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_min')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_required')->dropDownList(
        array(
            'no'=>'No',
            'required'=>'Yes',

        )
    )  ?>


    <?= $form->field($model, 'custom_default')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
