<?php
$this->title = "Edit Type/Brand";
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card">
    <div class="row" style="padding-top:100px;padding-bottom:150px;">
        <div class="col-lg-8 col-lg-push-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>
                        <i class="fa fa-pencil"></i> SubType/Brand
                    </strong>
                </div>
                <div class="panel-body">

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($cat, 'parent')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\SubCategory::find()->all(),'id','name'),
                        ['prompt'=>'Select Main Subcategory',

                        ])->hint('Like Mobile, Tablet, Mobile accessorise, or for Cars Spare Parts , Commercial Vehicles etc')
                    ?>
                    <?= $form->field($cat, 'name')->hint('eg. Nokia, samsung, or for Cars Maruti Suzuki, Hyundai, Toyota') ?>


                    <div class="form-group">
                        <a class="btn btn-info" href="<?= \yii\helpers\Url::toRoute('category/type'); ?>">
                            Back
                        </a>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-warning', 'name' => 'save-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
