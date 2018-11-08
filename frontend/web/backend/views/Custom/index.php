<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\QnewCustomFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Qnew Custom Fields');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qnew-custom-fields-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Qnew Custom Fields'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'custom_id',
            'custom_page',
            'custom_catid',
            'custom_subcatid',
            'custom_name',
            // 'custom_title',
            // 'custom_type',
            // 'custom_content',
            // 'custom_min',
            // 'custom_max',
            // 'custom_required',
            // 'custom_options:ntext',
            // 'custom_default',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
