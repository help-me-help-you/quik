<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Edit Premium Ads price';

$uid = Yii::$app->user->id;
$usrInfo = \common\models\User::findOne($uid);
?>

<div class="row" style="padding-top: 50px;">
    <div class="col-lg-7 col-lg-push-2">
        <div class="detailBox panel  panel-default">
            <div class="panel-heading panel-title">
                <i class="fa fa-book"></i>
                Edit Premium Ads price
            </div>

            <div class="post-ad-form panel-body">

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
                                    'hint' => 'col-sm-8  col-sm-push-3',
                                ],
                        ],
                    'options' => ['enctype' => 'multipart/form-data']
                ]) ?>

                <?= $form->field($new, 'name')->label("type of ads") ?>

                <?= $form->field($new, 'price')->label("Price of your premium ads") ?>

                <?= $form->field($new, 'home_page')->dropDownList([
                    'no'=>'No',
                    'yes'=>'Yes '
                    ,])->label('ads display at home page?') ?>
                <br>
                <div class="clearfix"></div>

                <div align="center">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'ads-button']) ?>

                </div>

                <div class="clearfix"></div>


                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>



</div>

