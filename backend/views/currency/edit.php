<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = "Currency Setting";
?>
<div class="row">
    <div class="col-lg-6">

        <div class="panel panel-default">
            <div class="panel-heading">
               <strong>Set Currency</strong>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['id' => 'rout-form']); ?>

                <?= $form->field($model, 'currency_name')->textInput(['autofocus' => true]) ?>

                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                        <label>Currency Symbol</label>
                        <h5>Font icon given by fontAwesome</h5>

                        <br>
                        <?php
                        $sym = $model->currency_symbol;
                        $symbol_array = array(
                             'fa fa-dollar',
                            'fa fa-eur',
                            'fa fa-gbp',
                            'fa fa-ils',
                            'fa fa-inr',
                            'fa fa-jpy',
                            'fa fa-krw',
                            'fa fa-rub',
                            'fa fa-try'
                        );
                        foreach($symbol_array as $list)
                        {
                            $str = array('fa','-',' ');
                            $rep = array('','','');
                            $name = str_replace($str,$rep,$list);
                        ?>
                        <a class="btn btn-app" onclick="currency('<?= $list; ?>','<?= $name; ?>')">
                            <?php
                            if($sym == $list)
                            {
                                ?><span id="selected" style="display: block;"  class="badge bg-green select">Selected</span><?php
                            }
                            else
                            {
                                ?><span id="<?= $name; ?>" style="display: none;" class="badge bg-green select">Selected</span><?php
                            }
                            ?>
                            <i class="<?= $list; ?>" ></i> <?= $name; ?>
                        </a>
                        <?php
                        }
                        ?>


                        <br>
                        <small>
                            for more icon please class reference
                            <a style="color: #333;" href="http://fontawesome.io" target="_blank">Click here</a>
                        </small>
                        <?= $form->field($model, 'currency_symbol')->hiddenInput()->label(false) ?>


                        <hr>
                    </div>
                </div>
                <?= $form->field($model, 'currency_initial') ?>

                <?= $form->field($model, 'currency_value')->hint('Value should be relevant from the default currency. Please compare currency value from default currency') ?>
                <br>
                <?= $form->field($model, 'currency_status')->radioList(array('disable'=>'disable','default'=>'default')); ?>

                <div class="form-group">
                    <br>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    function currency(currency,name)
    {
     //   alert("#selected_"+name);
        $("#currency-currency_symbol").val(currency);
        $(".select").css("display","none");
        $("#"+name).css("display","block");


    }
</script>