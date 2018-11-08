<?php
$this->title = "Edit State";
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="card">
    <div class="row" style="padding-top:100px;padding-bottom:150px;">
        <div class="col-lg-8 col-lg-push-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>
                        <i class="fa fa-pencil"></i> Edit State
                    </strong>
                </div>
                <div class="panel-body">

                    <?php $form = ActiveForm::begin(['id' => 'state-form']); ?>
                        <?= $form->field($cat, 'country_id')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Countries::find()->all(),'id','name'),
                            ['prompt'=>'Choose Countries',

                            ])->label('Choose Countries')
                        ?>
                        <?= $form->field($cat, 'name')->label('State name') ?>

                    <div class="form-group">
                        <a class="btn btn-info" href="<?= \yii\helpers\Url::toRoute('location/state'); ?>">
                            Back
                        </a>
                        <?= Html::submitButton('save', ['class' => 'btn btn-warning', 'name' => 'country-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>



                </div>
            </div>
        </div>
    </div>
</div>
