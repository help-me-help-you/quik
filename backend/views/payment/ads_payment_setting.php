<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Set Premium Ads price';

$uid = Yii::$app->user->id;
$usrInfo = \common\models\User::findOne($uid);
?>

<div class="row" style="padding-top: 50px;">
    <div class="col-lg-7 ">
        <div class="detailBox panel  panel-default">
            <div class="panel-heading panel-title">
                <i class="fa fa-book"></i>
                Set Premium Ads price
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

    <div class="col-lg-5 ">
        <div class="card ">
            <div class="header">
                <h4 class="title">Premium Ads price & Privileges</h4>
                <p class="category">Backend development</p>
            </div>
            <div class="content">
                <?php
                if(!$all)
                {
                    echo "<p> No premium feature found </p>";
                }
                ?>

                <div class="table-full-width">
                    <table class="table">
                        <tbody>

                        <?php

                        foreach($all as $list)
                        {
                            ?>

                            <tr>
                                <td>
                                    <label class="checkbox">
                                        <i class="fa fa-info"></i>
                                    </label>
                                </td>
                                <td>
                                    <?= $list->name; ?> :
                                    <span class="label label-success">$<?= $list->price ; ?></span>
                                </td>
                                <td>
                                   @ Home page
                                    <span class="label label-info"><?= $list->home_page ; ?></span>

                                </td>

                                <td class="td-actions text-right">
                                    <a href="<?= \yii\helpers\Url::to('index.php?r=payment/ads-edit&ads='.$list->id) ?>" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>

                <div align="center" class="col-lg-12">
                    <?php
//                    echo \yii\widgets\LinkPager::widget([
//                        'pagination' => $pages,
//                        'class'=>'btn-pink ',
//                    ]);
                    ?>
                </div>
            </div>
        </div>



    </div>


</div>

