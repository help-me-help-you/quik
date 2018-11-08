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
                <h4 class="title">Sub Category</h4>
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
                                    </label>
                                </td>
                                <td><?= $list->name; ?></td>
                                <td class="td-actions text-right">
                                    <a href="<?= \yii\helpers\Url::toRoute('edit/sub-category') ?>?id=<?= $list->id ?>" rel="tooltip" title="Edit" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= \yii\helpers\Url::toRoute('delete/sub-category') ?>?id=<?= $list->id ?>" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-xs">
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


            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!--        save alert-->
        <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Welcdddome to <b>Fine Admin Bootstrap Dashboard</b> - Easy And User Friendly."

                },{
                    type: 'info',
                    timer: 4000
                });

            });
        </script>
        <?php
        if($save == true)
        {
            $script = <<< JS
$(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-paperclip',
                    message: "<strong> Success </strong>Yoú added new category successfully"

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
                <h4 class="title">Add New Sub Category</h4>
                <p class="category">Create new category here!!!</p>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['id' => 'subcategory-form']); ?>

                <?= $form->field($cat, 'parent')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Category::find()->all(),'id','name'),
                   ['options'=>['required'=>'required']])
                ?>
                <?= $form->field($cat, 'name')->textInput(['required'=>'required']) ?>


                <div class="form-group">
                    <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
