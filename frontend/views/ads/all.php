<?php

$this->title= "All category";

echo yii\helpers\BaseHtml::jsFile('@web/theme/js/easyResponsiveTabs.js');
$citySet = '<script>document.write(localStorage.getItem("setcity"))</script>';
$siteSetting = \common\models\SiteSettings::find()->one();

$current_url = \yii\helpers\Url::current();
\yii\helpers\Url::remember($current_url,'currency_p');

$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = (isset($default_selected))?$default_selected:$currency_default;
?>
<div class="row">
    <div class="col-lg-10 col-xs-12 col-sm-12">
        <div class="searchBox hidden row">
            <h2>
                Search anything in <?= $citySet; ?>
            </h2>
            <div class="col-lg-3">
                <input type="text" value="" placeholder="category">
            </div>
            <div class="col-lg-3">
                <input  type="text" value="" placeholder="Sub Category">
            </div>
            <div class="col-lg-3">
                <input type="text" value="" placeholder="Search">
            </div>
            <div class="col-lg-3">
                <input  type="submit" value="Search" placeholder="Search">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 AduListBreg" style="margin-top: 30px;">

                <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>">
                    <i class="fa fa-home"></i>
                </a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/all') ?>">All Ads</a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>

                <h2>
                    All ads  in <?= $citySet; ?>
                </h2>
                <h6>
                    <?= count($model); ?> Results on 22 June, 2017
                </h6>
            </div>
            <div class="col-lg-8 AduListBreg" style="margin-top: 30px;">
                <?= \common\models\Adsense::show('top') ?>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-3 hidden-xs hidden-sm row">
                <div class="searchBox">


                    <h2>Filter Content</h2>
                    <?php
                    foreach($category as $cat)
                    {
                        ?>

                        <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat['name']) ?>">
                            <?= $cat['name'] ?> &nbsp;<i class="fa fa-angle-right"></i>
                        </a>

                        <?php
                    }
                    ?>


                    <br>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <div class="panel hidden-xs hidden-sm" style="padding: 20px 10px;">
                    <div class="col-lg-10">

                        <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="80">
                        Explore items from any city across India and get doorstep delivery
                    </div>
                    <div class="col-lg-2">

                    </div>

                    <div class="clearfix"></div>
                </div>

                <?php
                if($model == null)
                {
                    ?>
                    <div class="col-lg-12">
                        <div  style="padding:50px 25px;border: 2px dashed #999;border-radius: 20px;;" align="center">
                            <h2  style="font-family: roboto-regular;font-size: 28px">
                                <?=  Yii::t('app','This is embarrassing. We didn’t find anyone');?> .
                            </h2>
                            <br>
                            <h6  style="font-family: roboto-bold;font-size: 12px">
                                <?=  Yii::t('app','Please post your product here, you still not post your product. please post your first product');?> .
                            </h6>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>" class="btn btn-warning"> <?=  Yii::t('app','Post Ad');?>   </a>


                        </div>
                    </div>

                    <?php
                }
                foreach($model  as $item)
                {
                    $imagebase = $item['image'];
                    $imageArray = explode(",",$imagebase);
                    $imgs = reset($imageArray);
                    $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$imgs;;
                    $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
                    $controlShow = ($item['category'] == 'Jobs')?'':'hidden';
                    ?>
                    <div class=" item ">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="adsBlock" style="border-radius: 7px;overflow: hidden">

                                <div class="label-blue <?=  ($item['premium'] == ''?'hidden':'');?>">
                                    <?=  $item['premium'];?>
                                </div>
                                <div class="img-wrapper">
                                    <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                                </div>
                                <div class="details">
                                    <div class="name">
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/detail/'.$item['id']."/".str_replace(' ','-',$item['ad_title'])) ?>">
                                            <?= substr($item['ad_title'],0,28) ?>...
                                        </a>
                                    </div>
                                </div>
                                <div class="foot">
                                    in <a href=""><?= $item['sub_category']; ?></a>
                                    <i class="fa fa-angle-right"></i>
                                    <i class="fa fa-map-marker"></i>
                                    <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?> <?=  Yii::t('app', 'Km away');?>
                                    <span class="price <?= $controlHide; ?>">
                                               <i class="<?= $default['symbol'].$controlHide; ?> currency"></i>
                                            <span class="price <?= $controlHide; ?>"> <?= $item['price']*$default['value']; ?>/- </span>
                                            </span>

                                </div>

                            </div>

                        </div>
                    </div>
                    <?php
                }
                ?>



            </div>
        </div>
    </div>
    <div class="col-lg-2 hidden-xs hidden-sm">
        <div class="">
            <br>
            <?= \common\models\Adsense::show('right') ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    var setcity = localStorage.getItem("setcity");
    document.getElementById("cityy").innerHTML = setcity;
</script>
