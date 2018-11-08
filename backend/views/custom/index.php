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
<div class="card" style="padding: 15px;">
    <div class="col-lg-6 ">
        <h3>
           All Custom Fields
        </h3>
    </div>
   <div class="col-lg-6 " align="right" >
       <?= Html::a(Yii::t('app', 'Create Qnew Custom Fields'), ['create'], ['class' => 'btn btn-success']) ?>
   </div>
    <div class="clearfix"></div>
    <hr>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'custom_id',
//            'custom_page',
            'custom_catid',
            'custom_subcatid',
//            'custom_name',
            'custom_title',
            'custom_type',
            // 'custom_content',
            // 'custom_min',
            // 'custom_max',
            // 'custom_required',
            // 'custom_options:ntext',
            // 'custom_default',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
