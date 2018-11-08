<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<div class="post-ad-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' =>
            [
                'horizontalCssClasses' =>
                    [
                        'label' => 'col-sm-4',
                        'offset' => 'col-sm-offset-4',
                        'wrapper' => 'col-sm-6',
                        'error' => 'col-sm-12',
                        'hint' => 'col-sm-8  col-sm-push-3 imgHintS',
                    ],
            ],
        'options' => ['enctype' => 'multipart/form-data']
    ]) ?>



    <?php
    foreach($custom as $foAds)
    {
        echo $form->field($adCustom, 'more_title[]')->hiddenInput(['value'=>$foAds['custom_title']])->label(false);

        if($foAds['custom_type'] == "textinput")
        {
            echo $form->field($adCustom, 'more_value[]')->label($foAds['custom_title']);
        }
        elseif($foAds['custom_type'] == "select")
        {
            $option = explode(',',$foAds['custom_options']);
            echo $form->field($adCustom, 'more_value[]')->dropDownList($option)->label($foAds['custom_title']);

        }
        elseif($foAds['custom_type'] == "checkbox")
        {
    // echo $form->field($adCustom, 'more_value[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);
            $option = explode(',',$foAds['custom_options']);
            echo $form->field($adCustom, 'more_value[]')->checkboxList($option)->label($foAds['custom_title']);
        }
        elseif($foAds['custom_type'] == "radio")
        {
            $data = $foAds['custom_options'];
            $option = explode(',',$data);
            echo $form->field($adCustom, 'more_value[]')->radioList($option)->label($foAds['custom_title']);


        }
        else
        {
            echo $form->field($adCustom, 'more_value[]')->label($foAds['custom_title']);
            echo "<hr>";
        }



    }
    ?>



    <?php ActiveForm::end(); ?>
</div>
