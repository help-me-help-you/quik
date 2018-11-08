<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = $model['title'];
?>

<div class="row" style="background-color: #f7f7f7">
    <div class="col-lg-8">
        <br>
        <h2 style="font-family: proxima-semiBold;color: #555"><?= $model['title'] ?></h2>
        <div style="font-family: proxima-regular;color: #777;overflow: fragments">
            <?= $model['content'] ?>
        </div>
    </div>
    <div class="col-lg-4" align="right">
        <?= \common\models\Adsense::show('right') ?>
    </div>
</div>