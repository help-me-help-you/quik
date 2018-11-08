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
            ?>
            <div class="form-group field-adsmore-more_title required">
                <label class="control-label col-sm-4" for="select"><?= $foAds['custom_title']; ?></label>
                <div class="col-sm-6 col-sm-offset-4">
                    <select id="select" class="form-control" name="AdsMore[more_value][]">
                        <?php
                        foreach($option as $ops)
                        {
                            ?>
                            <option value="<?=$ops?>"><?=$ops?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="help-block help-block-error col-sm-12"></div>
                </div>

            </div>
            <?php
        }
        elseif($foAds['custom_type'] == "checkbox")
        {
    // echo $form->field($adCustom, 'more_value[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);
            $option = explode(',',$foAds['custom_options']);
            ?>

            <div class="form-group field-adsmore-more_value required">
                <label class="control-label col-sm-4"><?= $foAds['custom_title']; ?></label>
                <div class="col-sm-6">
                    <div id="adsmore-more_value">
                        <div class="checkbox">
                        <?php
                        foreach($option as $ops)
                        {
                            ?>
                            <div class="checkbox">
                                <label><input name="AdsMore[more_value][]" value="<?=$ops?>" type="checkbox"> <?=$ops?></label>
                            </div>


                        <?php
                        }
                        ?>

                    </div>
                    <div class="help-block help-block-error col-sm-12"></div>
                </div>

            </div>
            </div>

        <?php
        }
        elseif($foAds['custom_type'] == "radio")
        {
            $data = $foAds['custom_options'];
            $option = explode(',',$data);
            ?>
            <div class="form-group field-adsmore-more_value required">
                <label class="control-label col-sm-4"><?= $foAds['custom_title']; ?></label>
                <div class="col-sm-6">
                    <div id="adsmore-more_value">
                        <?php
                        foreach($option as $ops)
                        {
                            ?>
                            <div class="radio"><label><input name="AdsMore[more_value][]" value="<?=$ops?>" type="radio"> <?=$ops?></label></div>

                        <?php
                        }
                        ?>

                    </div>
                    <div class="help-block help-block-error col-sm-12"></div>
                </div>
            </div>
            <?php

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
