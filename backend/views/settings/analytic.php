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
$this->title = 'Category';

?>
<div class="row">



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
                    message: "<strong> Success </strong>Your Analytic Code added successfully"

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
                <h4 class="title">Add New Category</h4>
                <p class="category">Create new category here!!!</p>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($cat, 'name') ?>


                <div class="form-group">
                    <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
