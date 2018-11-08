<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ad sense';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-6">
        <?php
        foreach ($model as $list)
        {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <b><?= $list['position'] ?> Banner ad</b>

                    <a href="<?= \yii\helpers\Url::toRoute('settings/adsense-delete?id='.$list['id']) ?>" class="btn btn-xs btn-link pull-right" > <i class="fa fa-trash"></i>  Delete </a>
                    <span class="pull-right"> / </span>

                    <a href="<?= \yii\helpers\Url::toRoute('settings/adsense?id='.$list['id']) ?>" class="btn btn-xs btn-link pull-right" > <i class="fa fa-pencil"></i>  Edit </a>
                </div>
                <div class="panel-body">
                    <blockquote style="background: rgba(13,106,173,0.05);border-color: #0D6AAD;color: #0d6aad">
                        <?= $list['title'] ?>
                    </blockquote>
                    <h5><b>Ads:</b></h5>
                    <p>
                        <?= $list['script'] ?>
                    </p>
                    <h5><b>Positions:</b></h5>
                    <p>
                        <?= $list['position'] ?>
                    </p>
                    <h5><b>Status:</b></h5>
                    <p>
                        <span class="label label-info">
                            <?= $list['status'] ?>
                        </span>
                    </p>


                </div>

            </div>
            <?php
        }
        ?>

    </div>
    <div class="col-md-6">
        <!--        save alert-->


        <div class="card ">
            <div class="header">
                <h4 class="title">
                    <?php
                    if($edit)
                    {
                        echo "Edit ".$new['title'];
                    }
                    else
                    {
                        echo "Create";
                    }
                    ?>
                     Banner Adsense
                </h4>
                <p class="category">Create new Google Adsense</p>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['id' => 'type-form']); ?>
                <?= $form->field($new, 'title') ?>

                <?= $form->field($new, 'script')->textarea(array('row'=>'6'))->hint('Google Adsense Script code paste here...')->label('Ads Code') ?>

                <?= $form->field($new, 'position')->dropDownList(['top'=>'top','right'=>'Right','left'=>'Left','bottom'=>'Bottom'])->hint('appear your ads on that positions')->label('Ads Positions')
                ?>
                <?= $form->field($new, 'status')->dropDownList(array('active'=>'Active','disable'=>'Disable'))
                ?>

                <div class="form-group">
                    <?php
                    if($edit)
                    {
                        ?>
                        <?= Html::submitButton('Update', ['class' => 'btn btn-warning', 'name' => 'save-button']) ?>

                        <a href="<?= \yii\helpers\Url::toRoute('settings/adsense') ?>" class="btn btn-info"> Make New </a>
                        <?php
                    }
                    else
                    {
                        ?>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-warning', 'name' => 'save-button']) ?>
                        <?php
                    }

                    ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>



</div>

