<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Add Analytic code';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    input[type="radio"] {
        display: block;
    }
</style>
<div class="row">

    <div class="col-lg-7">

        <div class="card ">
            <div class="header">
                <h4 class="title">Analytic Setting</h4>
                <p class="category">Add you analytic code here!!</p>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['id' => 'analytic-form']); ?>

                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'script')->textarea(['row'=>'3']) ?>
                <ul class="list-inline checkboxes-radio">
                    <li class="ms-hover">
                        <?= $form->field($model, 'flag')->radioList(array('off'=>'Off','on'=>'On')); ?>

                        <label for="c5"><span></span>Unselected</label>
                    </li>
                </ul>



                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'analytic-button']) ?>
                    <a href="<?= \yii\helpers\Url::toRoute('analytic/index') ?>" class="btn btn-info">Back</a>

                </div>

                <?php ActiveForm::end(); ?>
                <!-- /row -->
            </div>
        </div>

    </div>
</div>
