<?php
/* @var $this yii\web\View */
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Home';
$current_url = \yii\helpers\Url::toRoute('mobile/index');
\yii\helpers\Url::remember($current_url,'currency_p');
$googleAds= \common\models\Analytic::find()->one();
$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = (isset($default_selected))?$default_selected:$currency_default;
$time = time();
?>
<!--slider corosal-->
<div>
    <?= $googleAds['script'] ?>
</div>
<div role="main" class="ui-content">
    <div data-role="navbar">
        <ul>
            <li>
                <a href="#sortby" data-rel="popup" data-transition="slideup">
                    <?=  Yii::t('app', 'Sort By');?>
                </a>
            </li>
            <li>
                <a href="#filter<?= $time; ?>" data-position-to="window" data-rel="popup" data-transition="pop">
                    <?=  Yii::t('app', 'Filter');?>
                </a>
            </li>
        </ul>
    </div>




    <hr>
    <div class="ui-block-solo ui-responsive">
        <?php
        foreach($model as $rank=>$item)
        {
            $imagebase = $item['image'];
            $imageArray = explode(",",$imagebase);
            $img = reset($imageArray);
            $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$img;;
            $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
            $controlShow = ($item['category'] == 'Jobs')?'':'hidden';
            ?>
        <a href="<?= \yii\helpers\Url::toRoute('mobile/detail?ads='.$item['id']) ?>&title=<?= $item['ad_title']; ?>" data-ajax="false">

        <div class="ui-block-solo">
                <div class="adsBlock ">

                    <div class="img-wrapper">
                        <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                    </div>
                    <div class="details">
                        <div class="name">
                            <div class="label label-info">
                                <?=  Yii::t('app', 'Urgent');?>
                            </div>
                        </div>
                    </div>
                    <div class="foot">
                        <h4 style="font-family: roboto-regular;color:#555">
                            <?= substr($item['ad_title'],0,28) ?>...
                        </h4>
                        <span class="MobilePrice <?= $controlHide ?>">
                           <i class="<?= $default['symbol'] ?> currency"></i> <?= $item['price']*$default['value']; ?>/-
                        </span>
                        <span style="font-size: 16px;">

                        in <a href=""><?= $item['sub_category']; ?></a>
                        <i class="fa fa-angle-right"></i>
                        <i class="fa fa-map-marker"></i>
                            <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?><?=  Yii::t('app', 'Km away');?>

                        </span>
                    </div>
                </div>
            </div>
        </a>
        <?php
        }
        ?>

    </div>
</div>

<div data-role="popup"  data-history="false" id="filter<?= $time; ?>" data-theme="none" data-overlay-theme="c">
    <div data-role="collapsibleset" data-theme="b" data-content-theme="a" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" style="margin:0; width:250px;">
        <div data-role="collapsible" data-inset="false">
            <h2><?=  Yii::t('app', 'Filter Content');?></h2>
            <ul data-role="listview">

                <?php
                foreach($subList as $subCategory)
                {
                    ?>
                    <li>
                        <a href="<?= \yii\helpers\Url::toRoute('mobile/category?cat='.$cat.'&sub_cat='.$subCategory['name']) ?>">
                            <?=  Yii::t('app', $subCategory['name']);?>  &nbsp;<i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div><!-- /collapsible -->
        <div data-role="collapsible" data-inset="false">
            <h2><?=  Yii::t('app', 'Select Brand / Type');?></h2>
            <ul data-role="listview">
                <?php
                foreach($typeList as $typeLists)
                {
                    ?>
                    <li>
                        <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$typeLists['name']) ?>">
                            <?=  Yii::t('app', $typeLists['name']);?>    &nbsp;<i class="fa fa-angle-right"></i>
                        </a>
                    </li>

                <?php
                }
                ?>

            </ul>
        </div><!-- /collapsible -->
    </div><!-- /collapsible set -->
</div><!-- /popup -->

<div data-role="popup" id="sortby" data-theme="b">
    <ul data-role="listview" data-inset="true" style="min-width:210px;">
        <li>
            <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort=new') ?>">
                <?=  Yii::t('app', 'Newest');?>
            </a>
        </li>
        <li>
            <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort=htl') ?>">
                <?=  Yii::t('app', 'Price High to Low');?>
            </a>
        </li>
        <li>
            <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/category?cat='.$cat.'&sub_cat='.$sub_cat.'&type='.$type.'&sort=lth') ?>">
                <?=  Yii::t('app', 'Price Low to High');?>
            </a>
        </li>
    </ul>
</div>

















