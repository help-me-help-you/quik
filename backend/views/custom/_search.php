<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QnewCustomFieldsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qnew-custom-fields-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'custom_id') ?>

    <?= $form->field($model, 'custom_page') ?>

    <?= $form->field($model, 'custom_catid') ?>

    <?= $form->field($model, 'custom_subcatid') ?>

    <?= $form->field($model, 'custom_name') ?>

    <?php // echo $form->field($model, 'custom_title') ?>

    <?php // echo $form->field($model, 'custom_type') ?>

    <?php // echo $form->field($model, 'custom_content') ?>

    <?php // echo $form->field($model, 'custom_min') ?>

    <?php // echo $form->field($model, 'custom_max') ?>

    <?php // echo $form->field($model, 'custom_required') ?>

    <?php // echo $form->field($model, 'custom_options') ?>

    <?php // echo $form->field($model, 'custom_default') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
