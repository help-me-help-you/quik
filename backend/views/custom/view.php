<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QnewCustomFields */

$this->title = $model->custom_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qnew Custom Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card" style="padding: 15px;">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->custom_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->custom_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'custom_id',
            'custom_page',
            'custom_catid',
            'custom_subcatid',
            'custom_name',
            'custom_title',
            'custom_type',
            'custom_content',
            'custom_min',
            'custom_max',
            'custom_required',
            'custom_options:ntext',
            'custom_default',
        ],
    ]) ?>

</div>
