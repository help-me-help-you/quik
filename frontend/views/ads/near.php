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
    <div class="col-lg-12 col-xs-12 col-sm-12">
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
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="panel hidden-xs hidden-sm" style="padding: 20px 10px;" align="center">
                    <div class="col-lg-12">
                        <h1>
                            All Ad nearby around You
                        </h1>
                        <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="80">
                        <br>
                        Explore items from any city across India and get doorstep delivery
                    </div>

                    <div class="col-lg-12 subCat">
                        <hr>
                        NearBy <small>(within)</small>:-
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=5') ?>" class="nearByBtn">
                            5Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=15') ?>" class="nearByBtn">
                            15Km
                        </a>

                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=20') ?>" class="nearByBtn">
                            20Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=25') ?>" class="nearByBtn">
                            25Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=50') ?>" class="nearByBtn">
                            50Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=100') ?>" class="nearByBtn">
                            100Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=500') ?>" class="nearByBtn">
                            500Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=1000') ?>" class="nearByBtn">
                            1000Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=2000') ?>" class="nearByBtn">
                            2000Km
                        </a>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=5000') ?>" class="nearByBtn">
                            5000Km
                        </a>


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
                                This is embarrassing. We didn’t find anyone.
                            </h2>
                            <br>
                            <h6  style="font-family: roboto-bold;font-size: 12px">
                                If you set a lot of filters, or may be no one user is near from you, you might not get any results.
                                Try broadening your search settings.
                            </h6>

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
                    ?>
                        <div style="margin-top: 7px;"  class="col-md-3 col-sm-6 col-xs-12">
                            <div class="adsBlock white">
                                <?php
                                if($item['premium'] != null)
                                {
                                    ?>
                                    <div class="label-green">
                                        <?= $item['premium']; ?>
                                    </div>
                                    <?php
                                }
                                ?>

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
                                    <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?>Km away
                                    <span class="price">
                                       <i class="<?= $default['symbol'] ?> currency"></i> <?= $item['price']*$default['value']; ?>/-
                                    </span>
                                </div>
                            </div>

                        </div>
                    <?php
                }
                ?>



            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
    var setcity = localStorage.getItem("setcity");
    document.getElementById("cityy").innerHTML = setcity;
</script>
