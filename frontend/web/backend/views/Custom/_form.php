<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QnewCustomFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qnew-custom-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'custom_page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_catid')->textInput() ?>

    <?= $form->field($model, 'custom_subcatid')->textInput() ?>

    <?= $form->field($model, 'custom_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_min')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'custom_required')->textInput() ?>

    <?= $form->field($model, 'custom_options')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'custom_default')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
