<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QnewCustomFields */

$this->title = Yii::t('app', 'Create Qnew Custom Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qnew Custom Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card" style="padding: 15px;">
    <h4><?= Html::encode($this->title) ?></h4>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
