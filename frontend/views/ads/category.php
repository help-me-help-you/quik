<?php

$this->title= "All category";
$current_url = \yii\helpers\Url::current();
\yii\helpers\Url::remember($current_url,'currency_p');
 yii\helpers\BaseHtml::jsFile('@web/theme/js/easyResponsiveTabs.js');
$citySet = '<script>document.write(localStorage.getItem("setcity"))</script>';
$siteSetting = \common\models\SiteSettings::find()->one();
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
            <div class="col-lg-12 AduListBreg" style="margin-top: 30px;">
                <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>">
                    <i class="fa fa-home"></i>
                </a>
                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat) ?>"><?= $cat ?></a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat).'/'.$sub_cat ?>">
                    <?= $sub_cat ?>
                </a>

                <span class="span"><i class="fa fa-angle-right"></i> </span>
                <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat).'/'.$sub_cat.'/'.$type ?>">
                    <?= $type ?>
                </a>





                <h2>
                    <?=  Yii::t('app', $type);?> <?=  Yii::t('app', $sub_cat);?> <?=  Yii::t('app', $cat);?>  in <?= $citySet; ?>
                </h2>
                <h6>
                    <?= count($model); ?> <?=  Yii::t('app', 'Results on');?> <?= date("d-M-Y",time()) ?>
                </h6>
            </div>
            <div class="row">
                <div class="col-lg-3 hidden-xs hidden-sm row">
                    <div class="searchBox">


                        <h2> <?=  Yii::t('app', 'Filter Content');?></h2>
                        <?php
                        foreach($subList as $subCategory)
                        {
                            ?>

                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'/'.$subCategory['name']) ?>">
                                <?=  Yii::t('app', $subCategory['name']);?>  &nbsp;<i class="fa fa-angle-right"></i>
                            </a>

                        <?php
                        }
                        ?>

                        <h2><?=  Yii::t('app', 'Select Brand / Type');?></h2>

                        <?php
                        foreach($typeList as $typeLists)
                        {
                            ?>
                        <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'/'.$sub_cat.'/'.$typeLists['name']) ?>">
                            <?=  Yii::t('app', $typeLists['name']);?>    &nbsp;<i class="fa fa-angle-right"></i>
                            </a>
                        <?php
                        }
                        ?>

                    </div>
                    <?= \common\models\Adsense::show('left') ?>
                </div>
                <div class="col-lg-9 col-sm-12 col-xs-12">
                    <div class="panel hidden-xs hidden-sm" style="padding: 20px 10px;">
                        <div class="col-lg-10">

                            <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" width="80">
                            <?=  Yii::t('app', 'Explore items from any city across India and get doorstep delivery');?>
                        </div>
                        <div class="col-lg-2">
                            <div class="dropdown">
                                <button class="btn btn-xs btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                   <?=  Yii::t('app', 'Sort By');?>
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'/'.$sub_cat.'/'.$type.'&sort=new') ?>">
                                            <?=  Yii::t('app', 'Newest');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'/'.$sub_cat.'/'.$type.'&sort=htl') ?>">
                                            <?=  Yii::t('app', 'Price High to Low');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'/'.$sub_cat.'/'.$type.'&sort=lth') ?>">
                                            <?=  Yii::t('app', 'Price Low to High');?>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 subCat">
                        <?=  Yii::t('app', 'See also');?>
                            <?php
                            foreach($subList as $subCategory)
                            {
                                ?>
                                <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'/'.$subCategory['name']) ?>">
                                    #<?=  Yii::t('app', $subCategory['name']);?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-12 subCat">
                            <hr>
                            <?=  Yii::t('app', 'NearBy');?>
                             <small>(<?=  Yii::t('app', 'within');?>)</small>:-
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=5') ?>" class="nearByBtn">
                                5Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=15') ?>" class="nearByBtn">
                                15Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=25') ?>" class="nearByBtn">
                                25Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=50') ?>" class="nearByBtn">
                                50Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=100') ?>" class="nearByBtn">
                                100Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=500') ?>" class="nearByBtn">
                                500Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=1000') ?>" class="nearByBtn">
                                1000Km
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute('ads/category/'.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort='.$sort.'&near=2000') ?>" class="nearByBtn">
                                2000Km
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                    <div style="margin-top: 10px;margin-bottom: 20px;" class="col-lg-12 sweet-box">
                        <div id='afscontainer1'></div>
                    </div>
                    <div class="clearfix" style="margin-top: 10px;"></div>

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
                        <div class="ads-list">
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
                                <div class="ads-list_details <?= $controlHide ?>">
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
                            <div class="col-lg-3 col-sm-16 col-xs-6 price <?= $controlHide ?>" align="center">
                                <h3>
                                    <i class="<?= $default['symbol'] ?> currency"></i> <?= $item['price']*$default['value']; ?>/-
                                </h3>
                            </div>
                            <div class="col-lg-3 price col-sm-6 col-xs-6" align="center">

                                <a href="<?= \yii\helpers\Url::toRoute('ads/detail/'.$item['id'].'/'.str_replace(' ','-',$item['ad_title'])) ?>">
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
            <?= \common\models\Adsense::show('right') ?>

        </div>
    </div>
</div>

<?php
if($type)
{
     $Gads = $type." ".$sub_cat;
}
elseif($sub_cat)
{
    $Gads =  $sub_cat;
}
else
{
    $Gads =  $cat;
}
?>

<script type="text/javascript" charset="utf-8">

    var pageOptions = {
        "pubId": "pub-9616389000213823", // Make sure this the correct client ID!
        "query": "<?= $Gads; ?>",
        "adPage": 1
    };

    var adblock1 = {
        "container": "afscontainer1",
        "width": "700",
        "number": 2
    };

    _googCsa('ads', pageOptions, adblock1);

</script>
<script type="text/javascript">
    var setcity = localStorage.getItem("setcity");
    document.getElementById("cityy").innerHTML = setcity;
</script>
