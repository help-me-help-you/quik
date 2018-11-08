<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 11-05-2016
 * Time: 11:36
 */
//var_dump($model);

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'State Listing';

?>
<div class="row">

    <div class="col-md-12">


        <div class="card ">
            <div class="header">
                <h4 class="title">Add New State</h4>
                <hr>
            </div>
            <div class="">
                <?php $form = ActiveForm::begin(['id' => 'state-form']); ?>
                <div class="col-lg-5">
                    <?= $form->field($cat, 'country_id')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Countries::find()->all(),'id','name'),
                        ['prompt'=>'Choose Countries',

                        ])->label('Choose Countries')
                    ?>
                </div>
                <div class="col-lg-5">
                    <?= $form->field($cat, 'name')->label('State name') ?>
                </div>
                <div class="col-lg-2">
                    <br>
                    <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card ">
            <div class="header">
                <h4 class="title">State listing</h4>
                <p class="category">Backend development</p>
            </div>
            <div class="content">
                <div class="table-full-width">
                    <table class="table">
                        <tr>
                            <th>
                                <label class="checkbox">
                                    Parent Country
                                </label>
                            </th>
                            <th>
                                <label class="checkbox">
                                    State Name
                                </label>
                            </th>
                            <th class="td-actions text-right">
                                <label class="checkbox">
                                    Action
                                </label>
                            </th>
                        </tr>
                        <tbody>

                        <?php
                        foreach($model as $list)
                        {
                            ?>

                            <tr>
                                <td>
                                    <label class="checkbox">

                                        <?= \common\models\Countries::GetNameById($list->country_id) ; ?>
                                    </label>
                                </td>
                                <td><?= $list->name; ?></td>
                                <td class="td-actions text-right">
                                    <a href="<?= \yii\helpers\Url::toRoute('edit/state') ?>?id=<?= $list->id ?>" rel="tooltip" title="Edit" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= \yii\helpers\Url::toRoute('delete/state') ?>?id=<?= $list->id ?>" rel="tooltip" title="delete" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                    <?php
                    // display pagination
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]);

                    ?>
                </div>


            </div>
        </div>
    </div>

</div>
