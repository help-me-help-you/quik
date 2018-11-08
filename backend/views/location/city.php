<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 11-05-2016
 * Time: 11:36
 */
//var_dump($model);

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'City Listing';

?>
<div class="row">

    <div class="col-md-12">


        <div class="card ">
            <div class="header">
                <h4 class="title">Add New City</h4>
                <hr>
            </div>
            <div class="">
                <?php $form = ActiveForm::begin(['id' => 'City-form']); ?>
                <div class="col-lg-3">


                    <?= $form->field($cat, 'country_id')->dropDownList(
                        ArrayHelper::map(common\models\Countries::find()->all(),'id','name'),
                        [
                            'prompt'=>'Select Countries',
                            'onchange'=>'
                        $.get("form-state/'.'"+$(this).val(),function(data){ $("select#cityform-state_id").html(data);});',
                        ])->label('Choose Country') ?>


                </div>
                <div class="col-lg-3">

                    <?= $form->field($cat, 'state_id')->dropDownList(['other'=>'other'],
                        ['prompt'=>'Select state',

                        ])->label('Choose State') ?>

                </div>
                <div class="col-lg-3">

                    <?= $form->field($cat, 'city')->label('City name') ?>
                </div>
                <div class="col-lg-3">
                    <br>
                    <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-warning', 'name' => 'city-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card ">
            <div class="header">
                <h4 class="title">City listing</h4>
                <p class="category">Backend development</p>
                <div class="container">
                    <div class="col-lg-8 col-lg-push-2" >
                        <h2>
                            Sort Cities from country
                        </h2>
                        <?php $form = ActiveForm::begin(['id' => 'City-serch-form']); ?>
                        <div class="col-lg-4">


                            <?= $form->field($serachCity, 'country_id')->dropDownList(
                                ArrayHelper::map(common\models\Countries::find()->all(),'id','name'),
                                [
                                    'prompt'=>'Select Countries',
                                    'onchange'=>'
                        $.get("form-state/'.'"+$(this).val(),function(data){ $("select#citysearchform-state_id").html(data);});',
                                ])->label('Choose Country') ?>


                        </div>
                        <div class="col-lg-4">

                            <?= $form->field($serachCity, 'state_id')->textInput(['id'=>'hello'])->dropDownList(['other'=>'other','class' => 'your_class', 'id' => 'your_id'],
                                ['prompt'=>'Select state'],
                                ['id'=>'hello']
                            )->label('Choose State') ?>

                        </div>

                        <div class="col-lg-4">
                            <br>
                            <?= Html::submitButton('Sort', ['class' => 'btn btn-warning', 'name' => 'city-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="table-full-width">
                    <table class="table">
                        <tr>
                            <th>
                                <label class="checkbox">
                                    Parent Country
                                </label>
                            </th>
                            <th>
                                <label class="checkbox">
                                    Parent State
                                </label>
                            </th>
                            <th>
                                <label class="checkbox">
                                    City Name
                                </label>
                            </th>
                            <th class="td-actions text-right">
                                <label class="checkbox">
                                    Action
                                </label>
                            </th>
                        </tr>
                        <tbody>

                        <?php
                        foreach($model as $list)
                        {
                            ?>

                            <tr>
                                <td>
                                    <?php
                                    if($pager == false)
                                    {
                                       ?>
                                        <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/country-flags/'.$country['sortname'] ?>.png" style="width: 20px;">

                                        <?= $country['name'] ?>
                                        <?php
                                    }
                                    ?>

                                </td>
                                <td>
                                    <label class="label label-warning">

                                        <?= \common\models\States::namebyid($list->state_id) ; ?>
                                    </label>
                                </td>
                                <td><?= $list->name; ?></td>
                                <td class="td-actions text-right">
                                    <a href="<?= \yii\helpers\Url::toRoute('edit/city') ?>?id=<?= $list->id ?>" rel="tooltip" title="Edit" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?= \yii\helpers\Url::toRoute('delete/city') ?>?id=<?= $list->id ?>" rel="tooltip" title="delete" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                    <?php
                    // display pagination
                    if($pager == true)
                    {
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                    }

                    ?>
                </div>


            </div>
        </div>
    </div>

</div>
