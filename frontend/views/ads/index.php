<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Resale a Classified Responsive Website | Post Free Ads';

$uid = Yii::$app->user->id;
$usrInfo = \common\models\User::findOne($uid);

?>
<style>
    .tabs-left, .tabs-right {
        border-bottom: none;
        padding-top: 2px;
    }
    .tabs-left {
        border-right: 1px dashed #6fa6d5;
    }
    .tabs-left:first-child {
        border-top: 0px dashed #ddd !important;
    }

    .tabs-right {
        border-left: 1px dashed #ddd;
    }
    .tabs-left>li, .tabs-right>li {
        float: none;
        margin-bottom: 2px;
    }
    .tabs-left>li {
        margin-right: -1px;
    }
    .tabs-right>li {
        margin-left: -1px;

    }
    .tabs-left>li.active>a,
    .tabs-left>li.active>a:hover,
    .tabs-left>li.active>a:focus {
        padding: 19px 20px !important;
        border-right-color: transparent;
        font-size: 16px;
        color: #007cd5;
        border-left:1px dashed  #6fa6d5 !important;
        border-top:1px dashed  #6fa6d5 !important;
        border-bottom:1px dashed #6fa6d5 !important;
    }

    .tabs-right>li.active>a,
    .tabs-right>li.active>a:hover,
    .tabs-right>li.active>a:focus {
        border-bottom: 1px dashed #ddd;
        border-left-color: transparent;
    }
    .tabs-left>li>a {
        border-radius: 4px 0 0 4px;
        margin-right: 0;
        padding: 19px 20px !important;
        border-right-color: transparent;
        font-size: 16px;
        display:block;
        color: #555;

    }
    .tabs-right>li>a {
        border-radius: 0 4px 4px 0;
        margin-right: 0;
    }
    .vertical-text {
        margin-top:50px;
        border: none;
        position: relative;
    }
    .vertical-text>li {
        height: 20px;
        width: 120px;
        margin-bottom: 100px;
    }
    .vertical-text>li>a {
        border-bottom: 1px dashed #ddd;
        border-right-color: transparent;
        text-align: center;
        border-radius: 4px 4px 0px 0px;
    }
    .vertical-text>li.active>a,
    .vertical-text>li.active>a:hover,
    .vertical-text>li.active>a:focus {
        border-bottom-color: transparent;
        border-right-color: #ddd;
        border-left-color: #ddd;
    }
    .vertical-text.tabs-left {
        left: -50px;
    }
    .vertical-text.tabs-right {
        right: -50px;
    }
    .vertical-text.tabs-right>li {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .vertical-text.tabs-left>li {
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
    .tab-pane > h3
    {
        font-family: roboto-light;
        color: #999;
        font-size: 18px;;
    }
</style>
<div class="row" style="padding-top: 50px;">

    <div class="col-lg-9">
        <div class="detailBox">
            <div class="adsPostTitle">
                <i class="fa fa-book"></i>
                <?=  Yii::t('app', 'Post an Ad');?>
            </div>

            <div class="row" style="margin-top: -30px;">
                <div class="col-xs-3">

                    <ul class="nav nav-tabs tabs-left">
                        <?php
                        foreach($category as $rank => $catList)
                        {  ?>

                            <li class="<?= ($rank == '0')?'active':'' ?>">
                                <a href="#<?=  str_replace(' ','-',Yii::t('app', $catList['name']));?>" data-toggle="tab">
                                    <i class="<?= $catList['fa-icon'] ?> "></i>
                                    <?=  Yii::t('app', $catList['name']);?>
                                </a>
                            </li>

                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <div class="col-xs-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php
                        foreach($category as $rank => $catList)
                        {
                            ?>
                            <div class="tab-pane <?= ($rank == '0') ? 'active' : '' ?>"
                                 id="<?=  str_replace(' ','-',Yii::t('app', $catList['name']));?>">
                                <h3>
                                    <strong><i class="<?= $catList['fa-icon'] ?> "></i>
                                        &nbsp;<?= Yii::t('app', $catList['name']); ?></strong>
                                </h3>
                                <hr>
                                <?php
                                $sub = \common\models\SubCategory::find()
                                    ->where(['parent' => $catList['id']])
                                    ->All();
                                foreach ($sub as $rank => $SubcatList)
                                {
                                    ?>
                                    <div class="col-lg-12" style="border-bottom: 1px dashed #b8d8e4;padding: 20px 10px;">
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/post-ads') ?>?category=<?= $catList['name']; ?>&kyind=<?= $SubcatList['name']; ?>">
                                            <?= Yii::t('app', $SubcatList['name']); ?>&nbsp; <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
                                        </a>
                                        
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel">
            <div class="panel-body" align="center">
                <p style="color: #0088e4;font-family: raleway-SemiBold;font-size: 18px;">
                    Post a Free Classified
                </p>

                <p style="color: #999;font-family: raleway-Regular;font-size: 12px;">
                    Do you have something to sell, to rent, any service to offer or a job offer? Post it at bedigit.com,
                    its free, for local business and very easy to use!
                </p>
                <img src="<?= Yii::getAlias('@web') ?>/images/site/banner2.png" title="ad image" alt="" class="img-responsive" />

            </div>
        </div>

        <div class="panel panel-default">
            <div align="center" class="panel-heading panel-title" style="color: #777;font-family: raleway-SemiBold;font-size: 18px;">
                How to sell quickly?
            </div>
            <div class="panel-body" >
                <ul class="list-unstyled list-check">
                    <li>
                        &#10003; Use a brief title and description of the item
                    </li>
                    <li>
                        &#10003; Make sure you post in the correct category
                    </li>
                    <li>
                        &#10003; Add nice photos to your ad
                    </li>
                    <li>
                        &#10003; Put a reasonable price
                    </li>
                    <li>
                        &#10003; Check the item before publish
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function forType(value)
    {
        $.post("formtype?name="+value,function(data){ $("select#adsform-type").html(data);});
        $.post("custom?id="+value,function(data){ $("#moreCustValue").html(data);});
    }
</script>