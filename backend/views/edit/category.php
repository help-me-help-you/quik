<?php
$this->title = "Edit Category";
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card">
    <div class="row" style="padding-top:100px;padding-bottom:150px;">
        <div class="col-lg-8 col-lg-push-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>
                        <i class="fa fa-pencil"></i> Category Edit
                    </strong>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>

                    <?= $form->field($cat, 'name')->label('Category name') ?>


                    <div class="form-group">
                        <a class="btn btn-info" href="<?= \yii\helpers\Url::toRoute('category/index'); ?>">
                            Back
                        </a>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
