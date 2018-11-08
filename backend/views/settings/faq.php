<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'FAQ Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="btn-group">
        <a href="<?= \yii\helpers\Url::toRoute('settings/site') ?>" class="btn btn-warning">Site Settings</a>
        <a href="<?= \yii\helpers\Url::toRoute('contact/index') ?>" class="btn btn-warning">Contact Setting</a>
        <a href="<?= \yii\helpers\Url::toRoute('settings/faq') ?>" class="btn btn-warning">FAQ Setting</a>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-7">
            <div class="panel-group" id="accordion">
                <?php
                if($list)
                {
                    foreach($list as $list)
                    {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $list['id']; ?>">
                                       <b>Q.</b> <?= $list['question']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?= $list['id']; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <b>A.</b> <?= $list['answer']; ?>
                                    <hr>
                                    <a href="<?= \yii\helpers\Url::to('index.php?r=settings/faqedit&id='.$list['id'],false) ?>" class="btn btn-xs btn-success">EDIT</a>
                                    <a href="<?= \yii\helpers\Url::to('index.php?r=settings/faqdelete&id='.$list['id'],false) ?>" class="btn btn-xs btn-danger">DELETE</a>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3><?= Html::encode($this->title) ?></h3>

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
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


                    <?= $form->field($model, 'question') ?>

                    <?= $form->field($model, 'answer')->textarea() ?>


                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>
                    <!-- /row -->
                </div>
            </div>

        </div>
    </div>
</div>
