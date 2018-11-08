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
$this->title = 'Sub Category';

?>
<div class="row">


    <div class="col-md-6">
        <div class="card ">
            <div class="header">
                <h4 class="title">Item Type/Brand</h4>
                <p class="category">Backend development</p>
            </div>
            <div class="content">
                <div class="table-full-width">
                    <table class="table">
                        <tbody>

                        <?php
                        foreach($model as $list)
                        {
                            ?>

                            <tr>
                                <td>
                                    <label class="checkbox">
                                        <?= $list->id; ?>
                                    </label>
                                </td>
                                <td>
                                    <?= $list->name; ?> :
                                    <span class="label label-success"><?= \common\models\SubCategory::findName($list->parent) ; ?></span>
                                </td>
                                <td class="td-actions text-right">
                                    <a href="<?= \yii\helpers\Url::toRoute('edit/type') ?>?id=<?= $list->id ?>" rel="tooltip" title="Edit" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= \yii\helpers\Url::toRoute('delete/type') ?>?id=<?= $list->id ?>" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>
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
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'class'=>'btn-pink ',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!--        save alert-->

        <?php
        if($save == true)
        {
            $script = <<< JS
$(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-paperclip',
                    message: "<strong> Success </strong>Yoú added new Type successfully"

                },{
                    type: 'info',
                    timer: 4000
                });

            });
JS;
            $this->registerJs($script, \yii\web\View::POS_END);
        }
        ?>

        <div class="card ">
            <div class="header">
                <h4 class="title">Add New Item Type Category</h4>
                <p class="category">Create new category here!!!</p>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['id' => 'type-form']); ?>

                <?= $form->field($cat, 'parent')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\SubCategory::find()->all(),'id','name'),
                    ['prompt'=>'Select Main Subcategory',

                    ])->hint('Like Mobile, Tablet, Mobile accessorise, or for Cars Spare Parts , Commercial Vehicles etc')
                ?>
                <?= $form->field($cat, 'name')->hint('eg. Nokia, samsung, or for Cars Maruti Suzuki, Hyundai, Toyota') ?>


                <div class="form-group">
                    <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-warning', 'name' => 'save-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
