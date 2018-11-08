<?php
$this->title = "Item No Longer Available";
?>
<div class="row" style="margin-top:50px;margin-bottom:150px;">
    <div class="col-lg-8 col-lg-offset-2">
        <div  style="padding:30px 25px;border: 2px dashed #999;border-radius: 20px;background-color: #fff;" align="center">
            <h2  style="font-family: roboto-regular;font-size: 28px">
                <?=  Yii::t('app','This is embarrassing. We didn’t find anyone');?> .
            </h2>
            <h6  style="font-family: roboto-bold;font-size: 12px">
                This Item No Longer Available
            </h6>

            <a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>" class="btn btn-warning"> <?=  Yii::t('app','Post Ad');?>   </a>


        </div>
    </div>
</div>