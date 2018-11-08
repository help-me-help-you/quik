<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QnewCustomFields */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Qnew Custom Fields',
]) . $model->custom_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qnew Custom Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->custom_id, 'url' => ['view', 'id' => $model->custom_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="card" style="padding: 15px;">
    <h4><?= Html::encode($this->title) ?></h4>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

