<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Pages Settings';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    input[type="radio"] {
        display: block;
    }
</style>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<hr/>
    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Page Settings Earnings
                        <span class="panel-options">
                           <a href="#" class="panel-refresh">
                               <i class="icon ti-reload"></i>
                           </a>
                          <a href="#" class="panel-minimize">
                              <i class="icon ti-angle-up"></i>
                          </a>
                          <a href="#" class="panel-close">
                              <i class="icon ti-close"></i>
                          </a>
                      </span>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'pages-form']); ?>

                    <?= $form->field($model, 'title') ?>
                    <?= $form->field($model, 'content')->textarea(['row'=>'3']) ?>
                    <ul class="list-inline checkboxes-radio">
                        <li class="ms-hover">
                            <?= $form->field($model, 'status')->radioList(array('enable'=>'enable','disable'=>'disable')); ?>
                        </li>
                    </ul>



                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'analytic-button']) ?>
                        <a href="<?= \yii\helpers\Url::toRoute('pages/index') ?>" class="btn btn-info">Back</a>

                    </div>

                    <?php ActiveForm::end(); ?>
                    <!-- /row -->
                </div>
            </div>

        </div>
    </div>
</div>
