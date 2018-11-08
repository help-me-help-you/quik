<?php

$this->title= "All category";

echo yii\helpers\BaseHtml::jsFile('@web/theme/js/easyResponsiveTabs.js');
$citySet = '<script>document.write(localStorage.getItem("setcity"))</script>';
$siteSetting = \common\models\SiteSettings::find()->one();

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
            <div class="col-lg-12 AduListBreg" style="margin-top: 30px;">

                <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>">
                    <i class="fa fa-home"></i>
                </a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat) ?>"><?= $cat ?></a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/category') ?>#parentVerticalTab">
                    <?= $sub_cat ?>
                </a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/category') ?>#parentVerticalTab">
                    <?= $type ?>
                </a>
                <h2>
                    <?= $type ?> <?= $sub_cat ?> <?= $cat ?>  in <?= $citySet; ?>
                </h2>
                <h6>
                    <?= count($model); ?> Results on <?= date("d-M-Y",time()) ?>
                </h6>
            </div>
            <div class="row">
                <div class="col-lg-3 hidden-xs hidden-sm row">
                    <div class="searchBox">


                        <h2>Filter Content</h2>
                        <?php
                        foreach($subList as $subCategory)
                        {
                            ?>

                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$subCategory['name']) ?>">
                                <?= $subCategory['name'] ?> &nbsp;<i class="fa fa-angle-right"></i>
                            </a>

                        <?php
                        }
                        ?>

                        <h2>Select Brand / Type</h2>

                        <?php
                        foreach($typeList as $typeLists)
                        {
                            ?>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$typeLists['name']) ?>">
                                <?= $typeLists['name']; ?>  &nbsp;<i class="fa fa-angle-right"></i>
                            </a>
                        <?php
                        }
                        ?>
                        <h2>price Range</h2>

                        <input id="price" type="checkbox" name="brand">
                        <label for="price">0-to-5000</label>
                        <br>

                        <input id="price2" type="checkbox" name="brand">
                        <label for="price2">5000-to-10,000</label>
                        <br>

                        <input id="price3" type="checkbox" name="brand">
                        <label for="price3">10,000-to-20,000</label>
                        <br>

                        <input id="price4" type="checkbox" name="brand">
                        <label for="price4">20,000-to-10,00,000</label>
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
                            <div class="dropdown">
                                <button class="btn btn-xs btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                    Sort By
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort=new') ?>">
                                            Newest
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort=htl') ?>">
                                            Price High to Low
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort=lth') ?>">
                                            Price Low to High
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 subCat">
                            See also
                            <?php
                            foreach($subList as $subCategory)
                            {
                                ?>
                                <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$subCategory['name']) ?>">
                                    #<?= $subCategory['name']; ?>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-12 subCat">
                            <hr>
                            NearBy <small>(within)</small>:-
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=5') ?>" class="nearByBtn">
                                5Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=15') ?>" class="nearByBtn">
                                15Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=25') ?>" class="nearByBtn">
                                25Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=50') ?>" class="nearByBtn">
                                50Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=100') ?>" class="nearByBtn">
                                100Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=500') ?>" class="nearByBtn">
                                500Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=1000') ?>" class="nearByBtn">
                                1000Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=2000') ?>" class="nearByBtn">
                                2000Km
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
                        $img = reset($imageArray);
                        ?>
                        <div class="ads-list ">
                            <div class="col-lg-3 col-sm-12 col-xs-12 image">
                                <?php
                                if($item['premium'] != "")
                                {
                                    echo "<span class='label'>".$item['premium']."</span>";
                                }
                                ?>
                                <div class="img-wrapper">
                                    <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                                </div>
                                <div class="ads-list_details">
                                    <span class="hidden-lg col-sm-8  col-xs-8">
                                            <?= $item['ad_title'] ?>
                                    </span>
                                    <div class="pic pull-right  col-sm-2  col-xs-2" align="center" >
                                        <i class="fa fa-camera"></i>
                                        <?= count($imageArray); ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-xs-12 title">
                                <h2 class="hidden-xs hidden-sm">
                                    <?= $item['ad_title'] ?>
                                </h2>
                                <h5>
                                    <?= $item['ad_title'] ?>
                                </h5>
                                <br>
                                <p>
                                    <i class="fa fa-map-marker"></i>
                                    <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?>Km away
                                </p>

                            </div>
                            <div class="col-lg-3 col-sm-16 col-xs-6 price" align="center">
                                <h3>
                                    <i class="fa fa-usd"></i> <?= $item['price'] ?>
                                </h3>
                            </div>
                            <div class="col-lg-3 price col-sm-6 col-xs-6" align="center">

                                <a href="<?= \yii\helpers\Url::toRoute('ads/detail?ads='.$item['id']) ?>">
                                    view detail
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    <?php
                    }
                    ?>



                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-2 hidden-xs hidden-sm">
        <div class="">
            <br>
            <img src="<?= Yii::getAlias('@web') ?>/images/ads/google-adsPng2.png" class="img-responsive">
        </div>
    </div>
</div>


<script type="text/javascript">
    var setcity = localStorage.getItem("setcity");
    document.getElementById("cityy").innerHTML = setcity;
</script>
