<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Faqs';
?>

<div class="container">
    <h2 class="head">Faqs</h2>




        <?php

        foreach($model as $list)
        {
            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h4><b>Q.</b> <?= $list['question']; ?></h4>
                </div>
                <div class="panel-body">
                    <b>A.</b> <?= $list['answer']; ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- tab Panel end--> travels agency


</div>